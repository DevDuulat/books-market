<div
        x-data="{
        value: @entangle($getStatePath()),
        directory: $el.getAttribute('directory'),
        label: $el.getAttribute('label'),
        uploading: false,
        upload(event){
            const files = event.target.files
            const form = new FormData()

            for(let i=0;i<files.length;i++){
                form.append('file[]', files[i])
            }

            form.append('directory', this.directory)
            this.uploading = true

            fetch('/upload-images', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: form
            })
            .then(r => r.json())
            .then(data => {
                if(!Array.isArray(this.value)){
                    this.value = []
                }

                data.paths.forEach(p => this.value.push(p))

                this.uploading = false
            })
        },
        remove(index){
            this.value.splice(index, 1)
        }
    }"
        class="space-y-2"
>
    <div class="text-sm font-medium text-gray-700">{{ $getLabel() }}</div>


    <label class="cursor-pointer flex flex-col items-center justify-center border border-gray-300 rounded-xl p-6 hover:bg-gray-50 transition w-48 h-32 text-center">
        <input type="file" class="hidden" multiple @change="upload">
        <div x-show="!uploading && (!value || value.length===0)" class="text-gray-600 text-sm flex items-center justify-center h-full">
            Загрузить изображения
        </div>
        <div x-show="uploading" class="text-gray-500 text-sm flex items-center justify-center h-full">
            Загрузка...
        </div>
    </label>

    <div x-show="value && value.length" class="flex flex-row gap-2 mt-2 overflow-x-auto">
        <template x-for="(img, index) in value" :key="index">
            <div class="relative w-16 h-16 rounded-lg overflow-hidden flex-shrink-0 group">
                <img
                        :src="`/storage/${img}`"
                        class="w-full h-full object-cover"
                >
                <button
                        type="button"
                        @click="remove(index)"
                        class="absolute top-0 right-0 bg-white text-red-600 rounded-full text-xs w-4 h-4 flex items-center justify-center shadow-sm opacity-0 group-hover:opacity-100 transition"
                >
                    ×
                </button>
            </div>
        </template>
    </div>
</div>

<div
        x-data="{
        value: @entangle($getStatePath()),
        directory: $el.getAttribute('directory'),
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

    <label class="cursor-pointer flex flex-col items-center justify-center border border-gray-300 rounded-xl p-4 hover:bg-gray-50 transition w-48 h-32 text-center">
        <input type="file" class="hidden" multiple @change="upload">
        <div x-show="!uploading && (!value || value.length===0)" class="text-gray-600 text-sm flex items-center justify-center h-full">
            <span>Загрузить изображения</span>
        </div>
        <div x-show="uploading" class="text-gray-500 text-sm flex items-center justify-center h-full">
            Загрузка...
        </div>
    </label>

    <div x-show="value && value.length" class="flex flex-row gap-3 mt-2 overflow-x-auto">
        <template x-for="(img, index) in value" :key="index">
            <div class="relative w-28 h-28 rounded-lg overflow-hidden flex-shrink-0 group border border-gray-200 shadow-sm">
                <img :src="`/storage/${img}`" class="w-full h-full object-cover">

                <button
                        type="button"
                        @click="remove(index)"
                        class="delete-btn"
                >
                    ×
                </button>
            </div>
        </template>
    </div>
</div>

<style>
    .delete-btn {
        position: absolute;
        top: 4px;
        right: 4px;
        width: 18px;
        height: 18px;
        border-radius: 50%;
        background-color: red;
        color: white;
        font-weight: bold;
        font-size: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        cursor: pointer;
        box-shadow: 0 1px 4px rgba(0,0,0,0.3);
        transition: background-color 0.2s;
    }
    .delete-btn:hover {
        background-color: darkred;
    }
</style>

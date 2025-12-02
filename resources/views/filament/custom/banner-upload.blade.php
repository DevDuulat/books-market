<div
        x-data="{
        value: @entangle($getStatePath()),
        directory: $el.getAttribute('directory'),
        uploading: false,
        upload(event){
            const file = event.target.files[0]
            const form = new FormData()
            form.append('file', file)
            form.append('directory', this.directory)
            this.uploading = true

            fetch('/upload-image', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: form
            })
            .then(r => r.json())
            .then(data => {
                this.value = data.path
                this.uploading = false
            })
        }
    }"
        class="flex flex-col gap-3"
>
    <div class="text-sm font-medium text-gray-700">{{ $getLabel() }}</div>

    <label class="cursor-pointer flex flex-col items-center justify-center border border-gray-300 rounded-xl p-6 hover:bg-gray-50 transition">
        <input type="file" class="hidden" @change="upload">
        <div x-show="!uploading && !value" class="text-center text-gray-600">
            <div class="text-sm">Выберите изображение</div>
        </div>
        <div x-show="uploading" class="text-gray-500 text-sm">
            Загрузка...
        </div>
        <div x-show="value" class="w-full flex justify-center mt-2">
            <img :src="`/storage/${value}`" class="rounded-xl w-48 h-32 object-cover shadow-sm">
        </div>
    </label>

    <button
            x-show="value"
            type="button"
            @click="value = null"
            class="text-sm text-red-600 hover:text-red-700 w-fit"
    >
        Удалить изображение
    </button>
</div>

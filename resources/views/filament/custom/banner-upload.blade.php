<div
        x-data="{
        url: @entangle($getStatePath()),
        uploading: false,
        upload(event){
            const file = event.target.files[0]
            const form = new FormData()
            form.append('file', file)
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
                this.url = data.path
                this.uploading = false
            })
        }
    }"
        class="space-y-2"
>
    <input type="file" @change="upload">

    <template x-if="uploading">
        <div>Загрузка...</div>
    </template>

    <template x-if="url">
        <img :src="`/storage/${url}`" class="w-48 h-32 object-cover">
    </template>
</div>

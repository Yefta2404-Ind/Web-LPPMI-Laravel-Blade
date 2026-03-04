<form action="{{ $document->id ? route('admin.documents.update', $document->id) : route('admin.documents.store') }}" 
      method="POST">
    @csrf
    @if($document->id)
        @method('PUT')
    @endif

    <div class="mb-4">
        <label for="title" class="block font-medium text-gray-700">Judul Dokumen</label>
        <input type="text" name="title" id="title" 
               value="{{ old('title', $document->title ?? '') }}" 
               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
    </div>

    <div class="mb-4">
        <label for="content" class="block font-medium text-gray-700">Konten</label>
        <textarea name="content" id="editor">{{ old('content', $document->content ?? '') }}</textarea>
    </div>

    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">
        {{ $document->id ? 'Update' : 'Create' }}
    </button>
</form>

<!-- CKEditor CDN -->
<script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => { console.error(error); });
</script>
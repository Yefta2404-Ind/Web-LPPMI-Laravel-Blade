@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Buat Halaman Baru</h2>

    <form action="{{ route('admin.pages.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Judul Halaman</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Isi Halaman</label>
            <textarea name="content" id="editor" class="form-control" rows="10"></textarea>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="is_active" class="form-check-input" checked>
            <label class="form-check-label">Aktifkan Halaman</label>
        </div>

        <button class="btn btn-primary">Simpan</button>
    </form>
</div>

<!-- CKEditor -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor.create(document.querySelector('#editor'));
</script>
@endsection
@extends('layouts.cms')

@section('content')
<div class="container">
    <h2>Tambah Mutu Eksternal</h2>

    <form action="{{ route('staff.mutu-eksternal.store') }}"
      method="POST"
      enctype="multipart/form-data">

        @csrf

        <div class="mb-3">
            <label>Judul</label>
            <input type="text"
                   name="title"
                   class="form-control"
                   required>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="description"
                      class="form-control"
                      rows="6"
                      required></textarea>
        </div>
        <div class="mb-3">
    <label>Upload File (PDF / Word)</label>
    <input type="file" name="file" class="form-control"
           accept=".pdf,.doc,.docx">
</div>

<div class="mb-3">
    <label>Atau Masukkan URL</label>
    <input type="url" name="external_url" class="form-control"
           placeholder="https://example.com">
</div>


        <button type="submit" class="btn btn-success">
            Simpan
        </button>

        <a href="{{ route('staff.mutu-eksternal.index') }}"
           class="btn btn-secondary">
            Kembali
        </a>
    </form>
</div>
@endsection

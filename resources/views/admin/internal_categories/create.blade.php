@extends('layouts.admin')

@section('content')
<div class="container">

    <h4>Tambah Kategori Mutu Internal</h4>

    <form action="{{ route('admin.internal_categories.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama Kategori</label>
            <input type="text"
                   name="name"
                   class="form-control"
                   required>
        </div>

        <button class="btn btn-primary">
            Simpan
        </button>

        <a href="{{ route('admin.internal_categories.index') }}"
           class="btn btn-secondary">
           Kembali
        </a>
    </form>

</div>
@endsection

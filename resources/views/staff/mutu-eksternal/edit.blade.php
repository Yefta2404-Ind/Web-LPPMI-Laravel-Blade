@extends('layouts.cms')

@section('content')
<div class="container">
    <h2>Edit Mutu Eksternal</h2>

    <form action="{{ route('staff.mutu-eksternal.update', $data->id) }}"
          method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Judul</label>
            <input type="text"
                   name="title"
                   value="{{ $data->title }}"
                   class="form-control"
                   required>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="description"
                      class="form-control"
                      rows="6"
                      required>{{ $data->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">
            Update
        </button>

        <a href="{{ route('staff.mutu-eksternal.index') }}"
           class="btn btn-secondary">
            Kembali
        </a>
    </form>
</div>
@endsection

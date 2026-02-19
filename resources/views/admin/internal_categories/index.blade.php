@extends('layouts.admin')

@section('content')
<div class="container">

    <h4>Data Kategori Mutu Internal</h4>

    <a href="{{ route('admin.internal_categories.create') }}"
       class="btn btn-primary mb-3">
        Tambah Kategori
    </a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Kategori</th>
                <th width="180">Aksi</th>
            </tr>
        </thead>
        <tbody>
        @forelse($categories as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>
                    <a href="{{ route('admin.internal_categories.edit',$category->id) }}"
                       class="btn btn-sm btn-warning">
                        Edit
                    </a>

                    <form action="{{ route('admin.internal_categories.destroy',$category->id) }}"
                          method="POST"
                          class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="2" class="text-center">
                    Belum ada kategori.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

</div>
@endsection

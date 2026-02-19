@extends('layouts.cms')

@section('content')
<div class="container">

    <h4>Mutu Internal</h4>

    <a href="{{ route('staff.mutu-internal.create') }}"
       class="btn btn-primary mb-3">
       Tambah Data
    </a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kategori</th>
                <th>Tahun</th>
                <th>Status</th>
                <th width="150">Aksi</th>
            </tr>
        </thead>
        <tbody>
        @forelse($data as $item)
            <tr>
                <td>{{ $item->category->name }}</td>
                <td>{{ $item->year }}</td>
                <td>
                    <span class="badge bg-warning">
                        {{ $item->status }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('staff.mutu-internal.edit',$item->id) }}"
                       class="btn btn-sm btn-info">
                       Edit
                    </a>

                    <form action="{{ route('staff.mutu-internal.destroy',$item->id) }}"
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
                <td colspan="4" class="text-center">
                    Belum ada data.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

</div>
@endsection

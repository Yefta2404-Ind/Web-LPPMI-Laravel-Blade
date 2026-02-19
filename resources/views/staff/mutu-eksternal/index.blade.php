@extends('layouts.cms')

@section('content')
<div class="container">
    <h2>Mutu Eksternal Saya</h2>

    <a href="{{ route('staff.mutu-eksternal.create') }}"
       class="btn btn-primary mb-3">
        + Tambah Data
    </a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Status</th>
                <th>Catatan Admin</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @forelse($data as $item)
            <tr>
                <td>{{ $item->title }}</td>
                <td>
                    @if($item->status == 'pending')
                        <span class="badge bg-warning">Pending</span>
                    @elseif($item->status == 'approved')
                        <span class="badge bg-success">Approved</span>
                    @else
                        <span class="badge bg-danger">Rejected</span>
                    @endif
                </td>
                <td>{{ $item->rejection_note ?? '-' }}</td>
                <td>
                    @if($item->status != 'approved')
                        <a href="{{ route('staff.mutu-eksternal.edit', $item->id) }}"
                           class="btn btn-sm btn-warning">
                            Edit
                        </a>
                    @endif

                    <form action="{{ route('staff.mutu-eksternal.destroy', $item->id) }}"
                          method="POST"
                          style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger"
                                onclick="return confirm('Yakin hapus?')">
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

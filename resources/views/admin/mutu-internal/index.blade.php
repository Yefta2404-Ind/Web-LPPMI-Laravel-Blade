@extends('layouts.admin')

@section('content')
<div class="container">

    <h4>Approval Mutu Internal</h4>

    <form method="GET" class="mb-3">
        <select name="status" onchange="this.form.submit()" class="form-select w-25">
            <option value="">Semua Status</option>
            <option value="pending">Pending</option>
            <option value="approved">Approved</option>
            <option value="rejected">Rejected</option>
        </select>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kategori</th>
                <th>Tahun</th>
                <th>Uploader</th>
                <th>Status</th>
                <th width="220">Aksi</th>
            </tr>
        </thead>
        <tbody>

        @forelse($data as $item)
            <tr>
                <td>{{ $item->category->name }}</td>
                <td>{{ $item->year }}</td>
                <td>{{ $item->user->name }}</td>
                <td>
                    @if($item->status == 'pending')
                        <span class="badge bg-warning">Pending</span>
                    @elseif($item->status == 'approved')
                        <span class="badge bg-success">Approved</span>
                    @else
                        <span class="badge bg-danger">Rejected</span>
                    @endif
                </td>

                <td>

                    {{-- View File --}}
                    @if($item->file_path)
                        <a href="{{ asset('storage/'.$item->file_path) }}"
                           target="_blank"
                           class="btn btn-sm btn-secondary">
                           Lihat
                        </a>
                    @elseif($item->external_url)
                        <a href="{{ $item->external_url }}"
                           target="_blank"
                           class="btn btn-sm btn-secondary">
                           Link
                        </a>
                    @endif

                    {{-- Approve --}}
                    @if($item->status == 'pending')
                        <form action="{{ route('admin.mutu-internal.approve',$item->id) }}"
                              method="POST"
                              class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-sm btn-success">
                                Approve
                            </button>
                        </form>

                        <form action="{{ route('admin.mutu-internal.reject',$item->id) }}"
                              method="POST"
                              class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-sm btn-warning">
                                Reject
                            </button>
                        </form>
                    @endif

                    {{-- Delete --}}
                    <form action="{{ route('admin.mutu-internal.destroy',$item->id) }}"
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
                <td colspan="5" class="text-center">
                    Belum ada data.
                </td>
            </tr>
        @endforelse

        </tbody>
    </table>

</div>
@endsection

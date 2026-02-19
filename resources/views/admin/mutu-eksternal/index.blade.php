@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Approval Mutu Eksternal</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Dibuat Oleh</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @forelse($data as $item)
            <tr>
                <td>{{ $item->title }}</td>
                <td>{{ $item->user->name ?? '-' }}</td>
                <td>
                   @if($item->status == 'pending')

<form action="{{ route('admin.mutu-eksternal.approve', $item->id) }}" method="POST">
    @csrf

    <select name="section" class="form-control mb-2" required>
        <option value="">-- Pilih Section --</option>
        <option value="layanan">Layanan</option>
        <option value="akreditasi">Akreditasi</option>
        <option value="internasional">Internasional</option>
        <option value="sertifikasi">Sertifikasi</option>
        <option value="ipepa">Visualisasi IPEPA</option>
    </select>

    <button class="btn btn-success btn-sm">
        Approve
    </button>
</form>

@endif

                </td>
                <td>
                    @if($item->status == 'pending')
                        <form action="{{ route('admin.mutu-eksternal.approve', $item->id) }}"
                              method="POST"
                              style="display:inline;">
                            @csrf
                            <button class="btn btn-sm btn-success">
                                Approve
                            </button>
                        </form>

                        <button class="btn btn-sm btn-danger"
                                data-bs-toggle="collapse"
                                data-bs-target="#reject{{ $item->id }}">
                            Reject
                        </button>

                        <div id="reject{{ $item->id }}"
                             class="collapse mt-2">

                            <form action="{{ route('admin.mutu-eksternal.reject', $item->id) }}"
                                  method="POST">
                                @csrf
                                <textarea name="rejection_note"
                                          class="form-control mb-2"
                                          placeholder="Alasan penolakan..."
                                          required></textarea>

                                <button class="btn btn-danger btn-sm">
                                    Kirim Penolakan
                                </button>
                            </form>
                        </div>
                    @else
                        -
                    @endif
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

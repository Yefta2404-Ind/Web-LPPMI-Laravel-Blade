@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Video Saya</h3>
        <a href="{{ route('videos.create') }}" class="btn btn-primary">
            + Tambah Video
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($videos->count())
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Status</th>
                        <th>Published</th>
                        <th>Dibuat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($videos as $video)
                        <tr>
                            <td>{{ $video->title }}</td>
                            <td>
                                <span class="badge 
                                    @if($video->status === 'approved') bg-success
                                    @elseif($video->status === 'pending') bg-warning
                                    @else bg-danger @endif
                                ">
                                    {{ ucfirst($video->status) }}
                                </span>
                            </td>
                            <td>
                                {{ $video->is_published ? 'Ya' : 'Tidak' }}
                            </td>
                            <td>{{ $video->created_at->format('d M Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info">
            Belum ada video yang kamu upload.
        </div>
    @endif
</div>
@endsection

@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold mb-0">Halaman</h1>
            <p class="text-muted small mb-0">Kelola semua halaman website</p>
        </div>
        <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Tambah Halaman
        </a>
    </div>

    {{-- Alert --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Table --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">#</th>
                        <th>Judul</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Dibuat</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pages as $page)
                    <tr>
                        <td class="ps-4 text-muted">{{ $loop->iteration }}</td>
                        <td>
                            <div class="fw-semibold">{{ $page->title }}</div>
                            @if($page->meta_description)
                                <small class="text-muted">{{ Str::limit($page->meta_description, 60) }}</small>
                            @endif
                        </td>
                        <td><code class="small">/{{ $page->slug }}</code></td>
                        <td>
                            <form action="{{ route('admin.pages.toggle-status', $page) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="badge border-0 {{ $page->status === 'published' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $page->status === 'published' ? 'Published' : 'Draft' }}
                                </button>
                            </form>
                        </td>
                        <td class="text-muted small">{{ $page->created_at->format('d M Y') }}</td>
                        <td class="text-end pe-4">
                            <a href="{{ url('/' . $page->slug) }}" target="_blank"
                               class="btn btn-sm btn-outline-secondary me-1" title="Preview">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.pages.edit', $page) }}"
                               class="btn btn-sm btn-outline-primary me-1">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.pages.destroy', $page) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Hapus halaman ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="fas fa-file-alt fa-2x mb-2 d-block"></i>
                            Belum ada halaman. <a href="{{ route('admin.pages.create') }}">Buat sekarang</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
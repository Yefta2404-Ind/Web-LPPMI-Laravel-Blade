@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold mb-0">Menu Navigasi</h1>
            <p class="text-muted small mb-0">Kelola menu dan navigasi website</p>
        </div>
        <a href="{{ route('admin.menus.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Tambah Menu
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
            <h6 class="fw-semibold mb-0">Daftar Menu</h6>
            <small class="text-muted"><i class="fas fa-grip-vertical me-1"></i> Drag untuk mengubah urutan</small>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4" style="width:40px"></th>
                        <th>Judul</th>
                        <th>Halaman / URL</th>
                        <th>Parent</th>
                        <th>Urutan</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody id="menuSortable">
                    @forelse($menus as $menu)
                    <tr data-id="{{ $menu->id }}">
                        <td class="ps-4 text-muted" style="cursor:grab;">
                            <i class="fas fa-grip-vertical"></i>
                        </td>
                        <td>
                            <span class="fw-semibold">{{ $menu->title }}</span>
                            @if($menu->parent_id)
                                <span class="badge bg-light text-muted ms-1">sub</span>
                            @endif
                        </td>
                        <td class="text-muted small">
                            @if($menu->page)
                                <i class="fas fa-file-alt me-1"></i>{{ $menu->page->title }}
                            @elseif($menu->url)
                                <i class="fas fa-link me-1"></i>{{ $menu->url }}
                            @else
                                <span class="text-danger">— tidak ada —</span>
                            @endif
                        </td>
                        <td class="text-muted small">
                            {{ $menu->parent?->title ?? '— utama —' }}
                        </td>
                        <td><span class="badge bg-light text-dark">{{ $menu->order }}</span></td>
                        <td>
                            <span class="badge {{ $menu->is_active ? 'bg-success' : 'bg-secondary' }}">
                                {{ $menu->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="text-end pe-4">
                            <a href="{{ route('admin.menus.edit', $menu) }}"
                               class="btn btn-sm btn-outline-primary me-1">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST"
                                  class="d-inline" onsubmit="return confirm('Hapus menu ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="fas fa-bars fa-2x mb-2 d-block"></i>
                            Belum ada menu. <a href="{{ route('admin.menus.create') }}">Tambah sekarang</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
const sortable = Sortable.create(document.getElementById('menuSortable'), {
    animation: 150,
    handle: '.fa-grip-vertical',
    onEnd: function() {
        const order = [...document.querySelectorAll('#menuSortable tr[data-id]')]
            .map(row => row.dataset.id);

        fetch('{{ route("admin.menus.reorder") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ order })
        });
    }
});
</script>
@endpush
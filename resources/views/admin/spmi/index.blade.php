@extends('layouts.admin')

@section('title', 'Manajemen Dokumen SPMI')

@section('content')
<div class="admin-container">
    <!-- Header -->
    <div class="header">
        <h2>📄 Dokumen SPMI</h2>
        <a href="{{ route('admin.spmi.index') }}" class="btn-refresh">↻</a>
    </div>

    <!-- Statistik -->
    <div class="stats">
        <div class="stat-card total">
            <span class="stat-icon">📊</span>
            <div>
                <div class="stat-label">Total</div>
                <div class="stat-value">{{ $documents->total() }}</div>
            </div>
        </div>
        <div class="stat-card pending">
            <span class="stat-icon">⏳</span>
            <div>
                <div class="stat-label">Pending</div>
                <div class="stat-value">{{ $documents->where('status', 'pending')->count() }}</div>
            </div>
        </div>
        <div class="stat-card approved">
            <span class="stat-icon">✅</span>
            <div>
                <div class="stat-label">Approved</div>
                <div class="stat-value">{{ $documents->where('status', 'approved')->count() }}</div>
            </div>
        </div>
        <div class="stat-card rejected">
            <span class="stat-icon">❌</span>
            <div>
                <div class="stat-label">Rejected</div>
                <div class="stat-value">{{ $documents->where('status', 'rejected')->count() }}</div>
            </div>
        </div>
    </div>

    <!-- Alert -->
    @if(session('success'))
        <div class="alert success">✅ {{ session('success') }}</div>
    @endif

    <!-- Filter & Search -->
    <div class="filter-bar">
        <div class="filter-tabs">
            <a href="{{ route('admin.spmi.index') }}" class="filter {{ !request('status') ? 'active' : '' }}">Semua ({{ $documents->total() }})</a>
            <a href="?status=pending" class="filter {{ request('status') == 'pending' ? 'active' : '' }}">Pending ({{ $documents->where('status', 'pending')->count() }})</a>
            <a href="?status=approved" class="filter {{ request('status') == 'approved' ? 'active' : '' }}">Approved ({{ $documents->where('status', 'approved')->count() }})</a>
            <a href="?status=rejected" class="filter {{ request('status') == 'rejected' ? 'active' : '' }}">Rejected ({{ $documents->where('status', 'rejected')->count() }})</a>
        </div>
        <form class="search" method="GET">
            <input type="text" name="search" placeholder="Cari..." value="{{ request('search') }}">
            <button type="submit">🔍</button>
        </form>
    </div>

    <!-- Tabel -->
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kategori</th>
                    <th>Judul</th>
                    <th>Uploader</th>
                    <th>Status</th>
                    <th>Aksi</th>
                    <th>Tgl</th>
                </tr>
            </thead>
            <tbody>
                @forelse($documents as $index => $doc)
                <tr>
                    <td>{{ $documents->firstItem() + $index }}</td>
                    <td><span class="badge">{{ $doc->category->name }}</span></td>
                    <td>
                        {{ $doc->title }}
                        @if($doc->file_path) <a href="{{ Storage::url($doc->file_path) }}" target="_blank" style="margin-left:5px;">📎</a> @endif
                    </td>
                    <td>{{ $doc->creator->name }}</td>
                    <td>
                        @if($doc->status == 'approved') <span class="badge success">✅ Approved</span>
                        @elseif($doc->status == 'rejected') <span class="badge danger">❌ Rejected</span>
                        @else <span class="badge warning">⏳ Pending</span> @endif
                    </td>
                    <td>
                        @if($doc->status != 'approved')
                        <form action="{{ route('admin.spmi.approve', $doc->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button class="btn-icon success" title="Setujui">✅</button>
                        </form>
                        @endif
                        @if($doc->status != 'rejected')
                        <form action="{{ route('admin.spmi.reject', $doc->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button class="btn-icon danger" title="Tolak">❌</button>
                        </form>
                        @endif
                        <button class="btn-icon" onclick="alert('{{ $doc->title }}')" title="Detail">👁️</button>
                    </td>
                    <td><small>{{ $doc->created_at->format('d/m/y') }}</small></td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center; padding:40px;">
                        <div style="font-size:3rem; margin-bottom:10px;">📭</div>
                        <div>Belum ada dokumen</div>
                        @if(request('search')) <a href="{{ route('admin.spmi.index') }}" class="btn" style="margin-top:10px;">Reset</a> @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($documents->hasPages())
    <div class="pagination">
        {{ $documents->links() }}
    </div>
    @endif
</div>

<style>
* { margin: 0; padding: 0; box-sizing: border-box; }
.admin-container {
    max-width: 1300px;
    margin: 0 auto;
    padding: 20px;
    font-family: system-ui, -apple-system, sans-serif;
}
.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}
.header h2 { font-size: 1.5rem; color: #333; }
.btn-refresh {
    padding: 8px 12px;
    background: #f0f0f0;
    border-radius: 6px;
    text-decoration: none;
    color: #555;
    font-size: 1.2rem;
}
.btn-refresh:hover { background: #e0e0e0; }

/* Stats */
.stats {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 12px;
    margin-bottom: 20px;
}
.stat-card {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 15px;
    background: white;
    border-radius: 8px;
    border: 1px solid #eee;
    box-shadow: 0 2px 4px rgba(0,0,0,0.02);
}
.stat-icon { font-size: 2rem; }
.stat-label { font-size: 0.75rem; color: #666; text-transform: uppercase; }
.stat-value { font-size: 1.5rem; font-weight: 600; color: #333; }
.total { border-left: 4px solid #0056b3; }
.pending { border-left: 4px solid #ffc107; }
.approved { border-left: 4px solid #28a745; }
.rejected { border-left: 4px solid #dc3545; }

/* Alert */
.alert {
    padding: 12px 16px;
    background: #d4edda;
    border: 1px solid #c3e6cb;
    color: #155724;
    border-radius: 6px;
    margin-bottom: 20px;
}

/* Filter Bar */
.filter-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 15px;
    margin-bottom: 20px;
    padding: 12px;
    background: white;
    border-radius: 8px;
    border: 1px solid #eee;
}
.filter-tabs { display: flex; gap: 8px; flex-wrap: wrap; }
.filter {
    padding: 5px 12px;
    background: #f5f5f5;
    border: 1px solid #ddd;
    border-radius: 20px;
    text-decoration: none;
    color: #666;
    font-size: 0.9rem;
}
.filter:hover { background: #eee; }
.filter.active {
    background: #0056b3;
    border-color: #0056b3;
    color: white;
}
.search { display: flex; gap: 5px; }
.search input {
    padding: 6px 12px;
    border: 1px solid #ddd;
    border-radius: 6px;
    width: 200px;
}
.search input:focus { outline: none; border-color: #0056b3; }
.search button {
    padding: 6px 12px;
    background: #0056b3;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}

/* Table */
.table-wrapper {
    background: white;
    border-radius: 8px;
    border: 1px solid #eee;
    overflow-x: auto;
}
table {
    width: 100%;
    border-collapse: collapse;
    min-width: 900px;
}
th {
    background: #0056b3;
    color: white;
    padding: 12px;
    font-weight: 500;
    text-align: left;
}
td { padding: 12px; border-bottom: 1px solid #eee; }
tr:hover { background: #f9f9f9; }

/* Badges */
.badge {
    display: inline-block;
    padding: 4px 8px;
    background: #f0f0f0;
    border-radius: 4px;
    font-size: 0.85rem;
}
.badge.success { background: #d4edda; color: #155724; }
.badge.danger { background: #f8d7da; color: #721c24; }
.badge.warning { background: #fff3cd; color: #856404; }

/* Buttons */
.btn-icon {
    width: 30px;
    height: 30px;
    border: none;
    border-radius: 4px;
    background: #f0f0f0;
    cursor: pointer;
    font-size: 0.9rem;
    margin: 0 2px;
}
.btn-icon:hover { background: #e0e0e0; }
.btn-icon.success:hover { background: #28a745; color: white; }
.btn-icon.danger:hover { background: #dc3545; color: white; }

/* Pagination */
.pagination {
    margin-top: 20px;
    display: flex;
    justify-content: center;
}
.pagination a, .pagination span {
    padding: 6px 12px;
    margin: 0 3px;
    border: 1px solid #ddd;
    border-radius: 4px;
    text-decoration: none;
    color: #333;
}
.pagination .active {
    background: #0056b3;
    color: white;
    border-color: #0056b3;
}

/* Responsive */
@media (max-width: 768px) {
    .stats { grid-template-columns: repeat(2, 1fr); }
    .filter-bar { flex-direction: column; align-items: stretch; }
    .search input { width: 100%; }
}
@media (max-width: 480px) {
    .stats { grid-template-columns: 1fr; }
    .filter-tabs { flex-direction: column; }
    .filter { text-align: center; }
}
</style>

<script>
setTimeout(() => {
    document.querySelector('.alert')?.remove();
}, 3000);
</script>
@endsection
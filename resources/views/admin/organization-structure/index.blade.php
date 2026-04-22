@extends('layouts.admin')

@section('page-title', 'Struktur Organisasi')

@section('content')

<style>
    /* ========================================
       SIMPLE PROFESSIONAL STYLES
    ======================================== */
    
    :root {
        --primary: #4f46e5;
        --primary-dark: #4338ca;
        --primary-light: #eef2ff;
        --success: #10b981;
        --success-light: #d1fae5;
        --danger: #ef4444;
        --danger-light: #fee2e2;
        --warning: #f59e0b;
        --dark: #0f172a;
        --gray: #64748b;
        --gray-light: #f1f5f9;
        --border: #e2e8f0;
        --white: #ffffff;
        --shadow-sm: 0 1px 3px 0 rgb(0 0 0 / 0.1);
        --shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        --shadow-md: 0 10px 15px -3px rgb(0 0 0 / 0.1);
    }

    /* Main Container */
    .org-container {
        padding: 24px;
        max-width: 1400px;
        margin: 0 auto;
    }

    /* Header */
    .org-header {
        background: white;
        border-radius: 16px;
        padding: 20px 28px;
        margin-bottom: 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 16px;
        box-shadow: var(--shadow-sm);
    }
    .header-left { display: flex; align-items: center; gap: 16px; }
    .header-icon {
        width: 48px;
        height: 48px;
        background: var(--primary);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 22px;
    }
    .header-title h1 { font-size: 22px; font-weight: 700; color: var(--dark); margin: 0 0 4px 0; }
    .header-title p { color: var(--gray); font-size: 13px; margin: 0; }
    
    .stats {
        display: flex;
        gap: 12px;
        align-items: center;
        flex-wrap: wrap;
    }
    .stat-badge {
        background: var(--gray-light);
        padding: 6px 16px;
        border-radius: 30px;
        font-size: 13px;
        font-weight: 600;
        color: var(--dark);
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .stat-badge.primary { background: var(--primary-light); color: var(--primary); }
    .stat-badge.warning { background: #fef3c7; color: #d97706; }
    .stat-badge.danger { background: var(--danger-light); color: #dc2626; }
    
    .btn-create {
        background: var(--primary);
        color: white;
        padding: 8px 20px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
    }
    .btn-create:hover { background: var(--primary-dark); transform: translateY(-1px); color: white; }

    /* Filter Bar */
    .filter-bar {
        background: white;
        border-radius: 16px;
        padding: 14px 20px;
        margin-bottom: 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 16px;
        box-shadow: var(--shadow-sm);
    }
    .filter-group { display: flex; gap: 8px; flex-wrap: wrap; }
    .filter-btn {
        padding: 6px 18px;
        border: 1px solid var(--border);
        background: white;
        border-radius: 30px;
        cursor: pointer;
        font-size: 13px;
        font-weight: 500;
        transition: all 0.2s;
        color: var(--gray);
    }
    .filter-btn:hover { border-color: var(--primary); color: var(--primary); }
    .filter-btn.active { background: var(--primary); color: white; border-color: var(--primary); }
    
    .search-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }
    .search-wrapper i {
        position: absolute;
        left: 12px;
        color: var(--gray);
        font-size: 13px;
    }
    .search-wrapper input {
        padding: 8px 12px 8px 36px;
        border: 1px solid var(--border);
        border-radius: 30px;
        width: 240px;
        font-size: 13px;
        transition: all 0.2s;
    }
    .search-wrapper input:focus {
        outline: none;
        border-color: var(--primary);
        width: 280px;
    }

    /* Grid */
    .org-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(420px, 1fr));
        gap: 20px;
        margin-bottom: 40px;
    }

    /* Card */
    .org-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        transition: all 0.2s ease;
    }
    .org-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-md);
    }
    .card-stripe {
        height: 4px;
        background: var(--primary);
    }
    .card-stripe.inactive { background: var(--gray); }
    .card-body { padding: 20px; }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 16px;
    }
    .card-title { font-size: 17px; font-weight: 700; color: var(--dark); margin-bottom: 6px; }
    .card-date { font-size: 11px; color: var(--gray); display: flex; align-items: center; gap: 6px; }
    
    .status {
        padding: 4px 12px;
        border-radius: 30px;
        font-size: 11px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .status.active { background: var(--success-light); color: #065f46; }
    .status.inactive { background: var(--danger-light); color: #991b1b; }

    /* Tree Preview */
    .tree-section {
        background: #f8fafc;
        border-radius: 14px;
        padding: 14px;
        margin: 16px 0;
        border: 1px solid var(--border);
    }
    .tree-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
        padding-bottom: 8px;
        border-bottom: 1px solid var(--border);
    }
    .tree-label { font-size: 11px; font-weight: 700; color: var(--gray); text-transform: uppercase; letter-spacing: 0.5px; }
    .tree-count { font-size: 11px; font-weight: 600; background: white; padding: 3px 10px; border-radius: 30px; color: var(--primary); }

    .tree-container {
        max-height: 260px;
        overflow-y: auto;
        padding: 6px;
    }
    .tree-container ul {
        list-style: none;
        margin: 0;
        padding-left: 0;
    }
    .tree-container li {
        margin: 6px 0;
        position: relative;
    }
    .tree-container ul ul {
        margin-left: 28px;
        padding-left: 20px;
        border-left: 1px dashed var(--border);
    }
    .tree-node-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 8px 12px;
        background: white;
        border-radius: 12px;
        border: 1px solid var(--border);
        cursor: pointer;
        transition: all 0.2s;
    }
    .tree-node-item:hover {
        background: var(--primary-light);
        border-color: var(--primary);
    }
    .tree-avatar-icon {
        width: 36px;
        height: 36px;
        min-width: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 14px;
        overflow: hidden;
        background: var(--primary);
    }
    .tree-avatar-icon img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .tree-info-content { flex: 1; }
    .tree-name-text { font-weight: 600; font-size: 13px; color: var(--dark); }
    .tree-position-text { font-size: 10px; color: var(--gray); }
    .tree-level-badge {
        font-size: 9px;
        padding: 2px 8px;
        border-radius: 20px;
        background: var(--gray-light);
        color: var(--gray);
        font-weight: 600;
    }

    .more-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 12px;
        padding-top: 10px;
        border-top: 1px solid var(--border);
    }
    .more-text { font-size: 11px; color: var(--gray); }
    .btn-detail {
        background: none;
        border: none;
        color: var(--primary);
        font-size: 11px;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 5px 10px;
        border-radius: 20px;
        transition: all 0.2s;
    }
    .btn-detail:hover { gap: 8px; background: var(--primary-light); }

    /* Actions */
    .divider { height: 1px; background: var(--border); margin: 16px 0 14px; }
    .actions {
        display: flex;
        gap: 10px;
        justify-content: flex-end;
    }
    .action-btn {
        width: 34px;
        height: 34px;
        border-radius: 10px;
        background: var(--gray-light);
        border: none;
        cursor: pointer;
        color: var(--gray);
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
    }
    .action-btn:hover:not(:disabled) { background: var(--primary); color: white; }
    .action-btn.active { background: var(--primary-light); color: var(--primary); }
    .action-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    /* Pagination */
    .pagination-wrap {
        display: flex;
        justify-content: center;
        margin-top: 24px;
    }
    .pagination-wrap .pagination { display: flex; gap: 6px; flex-wrap: wrap; }
    .pagination-wrap .page-item .page-link {
        padding: 6px 12px;
        border: 1px solid var(--border);
        border-radius: 10px;
        color: var(--gray);
        text-decoration: none;
        font-size: 13px;
        transition: all 0.2s;
    }
    .pagination-wrap .page-item.active .page-link {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 20px;
    }
    .empty-state i { font-size: 48px; color: var(--primary); opacity: 0.4; margin-bottom: 16px; display: block; }
    .empty-state h3 { font-size: 18px; color: var(--dark); margin-bottom: 8px; }
    .empty-state p { color: var(--gray); font-size: 13px; margin-bottom: 20px; }

    /* Modal */
    .modal-custom .modal-content {
        border-radius: 20px;
        border: none;
    }
    .modal-custom .modal-header {
        background: var(--primary);
        color: white;
        border: none;
        padding: 16px 24px;
    }
    .modal-custom .modal-body {
        padding: 24px;
        max-height: 60vh;
        overflow-y: auto;
    }

    /* Alert */
    .alert-toast {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        padding: 12px 20px;
        background: white;
        border-radius: 12px;
        box-shadow: var(--shadow-md);
        border-left: 4px solid;
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 13px;
    }
    .alert-toast.success { border-left-color: var(--success); }
    .alert-toast.error { border-left-color: var(--danger); }

    @media (max-width: 768px) {
        .org-container { padding: 16px; }
        .org-grid { grid-template-columns: 1fr; }
        .org-header { flex-direction: column; text-align: center; }
        .header-left { flex-direction: column; text-align: center; }
        .filter-bar { flex-direction: column; }
        .search-wrapper input, .search-wrapper input:focus { width: 100%; }
        .tree-container ul ul { margin-left: 16px; padding-left: 12px; }
    }
</style>

{{-- ALERT --}}
@if(session('success'))
<div class="alert-toast success" id="alertToast">
    <i class="fas fa-check-circle" style="color: #10b981;"></i>
    <span>{{ session('success') }}</span>
    <button style="margin-left: auto; background: none; border: none; cursor: pointer;" onclick="this.parentElement.remove()">×</button>
</div>
@endif
@if(session('error'))
<div class="alert-toast error" id="alertToast">
    <i class="fas fa-exclamation-circle" style="color: #ef4444;"></i>
    <span>{{ session('error') }}</span>
    <button style="margin-left: auto; background: none; border: none; cursor: pointer;" onclick="this.parentElement.remove()">×</button>
</div>
@endif

<div class="org-container">

    @php
        $activeCount = \App\Models\OrganizationStructure::where('is_active', true)->count();
        $maxActive = 3;
        $isFull = $activeCount >= $maxActive;
    @endphp

    {{-- HEADER --}}
    <div class="org-header">
        <div class="header-left">
            <div class="header-icon"><i class="fas fa-diagram-project"></i></div>
            <div class="header-title">
                <h1>Struktur Organisasi</h1>
                <p>Kelola hierarki dan keanggotaan organisasi</p>
            </div>
        </div>
        <div class="stats">
            <span class="stat-badge"><i class="fas fa-layer-group"></i> Total: {{ $data->total() }}</span>
            <span class="stat-badge {{ $isFull ? 'warning' : 'primary' }}">
                <i class="fas fa-check-circle"></i> 
                Aktif: {{ $activeCount }}/{{ $maxActive }}
                @if($isFull) <span style="margin-left: 5px;">(Penuh)</span> @endif
            </span>
            <a href="{{ route('admin.organization-structure.create') }}" class="btn-create"><i class="fas fa-plus"></i> Buat Baru</a>
        </div>
    </div>

    {{-- FILTER --}}
    @if($data->count() > 0)

    @endif

    {{-- CARDS GRID --}}
    @if($data->count() > 0)
    <div class="org-grid">
        @foreach($data as $idx => $struct)
        <div class="org-card">
            <div class="card-stripe {{ $struct->is_active ? '' : 'inactive' }}"></div>
            <div class="card-body">

                {{-- HEADER CARD --}}
                <div class="card-header">
                    <div>
                        {{-- FIX: gunakan 'name' bukan 'title' --}}
                        <div class="card-title">{{ $struct->name }}</div>
                        <div class="card-date"><i class="far fa-calendar-alt"></i> {{ $struct->created_at->translatedFormat('d M Y') }}</div>
                    </div>
                    @if($struct->is_active)
                        <span class="status active"><i class="fas fa-circle" style="font-size: 6px;"></i> Aktif</span>
                    @else
                        <span class="status inactive"><i class="fas fa-circle" style="font-size: 6px;"></i> Nonaktif</span>
                    @endif
                </div>

                {{-- TREE PREVIEW --}}
                <div class="tree-section">
                    <div class="tree-header">
                        <span class="tree-label"><i class="fas fa-diagram-project"></i> Hierarki</span>
                        <span class="tree-count"><i class="fas fa-users"></i> {{ $struct->memberCount }} anggota</span>
                    </div>
                    <div class="tree-container">
                        @if($struct->memberCount > 0 && $struct->treeFull && trim(strip_tags($struct->treeFull)) != '')
                            {!! $struct->treeFull !!}
                        @elseif($struct->memberCount > 0)
                            <ul>
                                @php
                                    $members = $struct->members ?? collect([]);
                                    $rootMembers = $members->where('parent_id', null);
                                @endphp
                                @foreach($rootMembers->take(3) as $root)
                                <li>
                                    <div class="tree-node-item">
                                        <div class="tree-avatar-icon">
                                            @if($root->photo && Storage::disk('public')->exists($root->photo))
                                                <img src="{{ asset('storage/' . $root->photo) }}" alt="{{ $root->name }}">
                                            @else
                                                <i class="fas fa-user"></i>
                                            @endif
                                        </div>
                                        <div class="tree-info-content">
                                            <div class="tree-name-text">{{ Str::limit($root->name, 20) }}</div>
                                            <div class="tree-position-text">{{ Str::limit($root->position, 25) }}</div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                                @if($rootMembers->count() > 3)
                                <li style="text-align: center; padding: 6px; color: var(--gray); font-size: 11px;">
                                    +{{ $rootMembers->count() - 3 }} anggota lainnya
                                </li>
                                @endif
                            </ul>
                        @else
                            <div style="text-align: center; padding: 24px; color: var(--gray); font-size: 12px;">
                                <i class="fas fa-users mb-2 d-block"></i>
                                Belum ada anggota
                            </div>
                        @endif
                    </div>

                    @if($struct->memberCount > 0)
                    
                    @endif
                </div>

                {{-- ACTIONS --}}
                <div class="divider"></div>
                <div class="actions">
                    <form method="POST" action="{{ route('admin.organization-structure.toggle-active', $struct->id) }}" class="toggleForm">
                        @csrf @method('PATCH')
                        @php
                            $canActivate = !$struct->is_active && $activeCount >= $maxActive;
                            $toggleTitle = $struct->is_active ? 'Nonaktifkan' : ($canActivate ? 'Maksimal ' . $maxActive . ' struktur aktif' : 'Aktifkan');
                        @endphp
                        <button 
                            type="submit" 
                            class="action-btn {{ $struct->is_active ? 'active' : '' }}"
                            {{ $canActivate ? 'disabled' : '' }}
                            title="{{ $toggleTitle }}"
                        >
                            <i class="fas {{ $struct->is_active ? 'fa-toggle-on' : 'fa-toggle-off' }}"></i>
                        </button>
                    </form>
                    <button class="action-btn" data-bs-toggle="modal" data-bs-target="#modal-{{ $struct->id }}" title="Detail"><i class="fas fa-eye"></i></button>
                    <a href="{{ route('admin.organization-structure.edit', $struct->id) }}" class="action-btn" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                    <form method="POST" action="{{ route('admin.organization-structure.destroy', $struct->id) }}" onsubmit="return confirm('Yakin ingin menghapus struktur ini? Semua anggota akan ikut terhapus.')" class="deleteForm">
                        @csrf @method('DELETE')
                        <button class="action-btn" title="Hapus"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </div>
            </div>
        </div>

        @endforeach
    </div>

    {{-- PAGINATION --}}
    <div class="pagination-wrap">
        {{ $data->appends(request()->query())->links() }}
    </div>

    @else
    <div class="empty-state">
        <i class="fas fa-diagram-project"></i>
        <h3>Belum Ada Struktur Organisasi</h3>
        <p>Buat struktur organisasi pertama untuk mulai mengelola hierarki</p>
        <a href="{{ route('admin.organization-structure.create') }}" class="btn-create d-inline-flex"><i class="fas fa-plus me-2"></i> Buat Struktur Baru</a>
    </div>
    @endif

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto close alert
        const toast = document.getElementById('alertToast');
        if(toast) {
            setTimeout(() => {
                toast.style.opacity = '0';
                setTimeout(() => toast.remove(), 300);
            }, 3500);
        }

        // Filter buttons
        const filterBtns = document.querySelectorAll('.filter-btn');
        const filterHidden = document.getElementById('filterHidden');
        const filterForm = document.getElementById('filterForm');
        
        if(filterBtns.length && filterHidden && filterForm) {
            filterBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    filterHidden.value = this.dataset.filter;
                    filterForm.submit();
                });
            });
        }

        // Search debounce
        const searchInput = document.getElementById('searchInput');
        let timer;
        if(searchInput && filterForm) {
            searchInput.addEventListener('input', function() {
                clearTimeout(timer);
                timer = setTimeout(() => filterForm.submit(), 500);
            });
        }

        // Loading effect on forms
        document.querySelectorAll('.toggleForm, .deleteForm').forEach(form => {
            form.addEventListener('submit', function() {
                const btn = this.querySelector('button');
                if(btn) {
                    btn.style.opacity = '0.5';
                    btn.disabled = true;
                }
            });
        });
    });
</script>

@endsection
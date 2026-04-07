@extends('layouts.admin')

@section('page-title', 'Struktur Organisasi')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">

<style>
* { margin: 0; padding: 0; box-sizing: border-box; }

:root {
    --font-main: 'Plus Jakarta Sans', sans-serif;
    --blue-50: #EFF6FF;
    --blue-100: #DBEAFE;
    --blue-200: #BFDBFE;
    --blue-600: #2563EB;
    --blue-700: #1D4ED8;
    --blue-800: #1E40AF;
    --slate-50: #F8FAFC;
    --slate-100: #F1F5F9;
    --slate-200: #E2E8F0;
    --slate-300: #CBD5E1;
    --slate-400: #94A3B8;
    --slate-500: #64748B;
    --slate-600: #475569;
    --slate-700: #334155;
    --slate-800: #1E293B;
    --slate-900: #0F172A;
    --green-50: #F0FDF4;
    --green-100: #DCFCE7;
    --green-600: #16A34A;
    --green-700: #15803D;
    --red-50: #FFF1F2;
    --red-600: #E11D48;
    --amber-50: #FFFBEB;
    --amber-600: #D97706;
    --radius-sm: 8px;
    --radius-md: 12px;
    --radius-lg: 16px;
    --radius-xl: 20px;
    --shadow-xs: 0 1px 2px rgba(15,23,42,0.04);
    --shadow-sm: 0 1px 3px rgba(15,23,42,0.06);
    --shadow-md: 0 4px 12px rgba(15,23,42,0.08);
    --shadow-lg: 0 12px 28px rgba(15,23,42,0.10);
}

/* Animations */
@keyframes slideIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

/* Alerts */
.alert-os {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 16px;
    border-radius: var(--radius-lg);
    font-size: 13px;
    font-weight: 500;
    margin-bottom: 16px;
    animation: slideIn 0.3s ease-out;
    background: #fff;
    box-shadow: var(--shadow-sm);
}

.alert-os.success { 
    background: var(--green-50);
    color: var(--green-700); 
    border-left: 3px solid var(--green-600);
}

.alert-os.error { 
    background: var(--red-50);
    color: var(--red-600); 
    border-left: 3px solid var(--red-600);
}

.alert-os .close-btn {
    margin-left: auto;
    background: none;
    border: none;
    cursor: pointer;
    color: inherit;
    opacity: 0.6;
    font-size: 18px;
    padding: 0 4px;
}

/* Page Container */
.os-page {
    background: var(--slate-50);
    min-height: 100vh;
    padding: 0;
}

/* Top Bar - Mobile First */
.os-topbar {
    background: #fff;
    border-bottom: 1px solid var(--slate-100);
    padding: 16px;
    display: flex;
    flex-direction: column;
    gap: 14px;
    position: sticky;
    top: 0;
    z-index: 10;
    background: rgba(255,255,255,0.98);
    backdrop-filter: blur(10px);
}

.topbar-left {
    display: flex;
    align-items: center;
    gap: 12px;
}

.topbar-icon {
    width: 44px;
    height: 44px;
    border-radius: var(--radius-lg);
    background: linear-gradient(135deg, var(--blue-50), var(--blue-100));
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--blue-600);
    font-size: 20px;
    flex-shrink: 0;
}

.topbar-title h1 {
    font-size: 18px;
    font-weight: 700;
    color: var(--slate-900);
    margin: 0;
    line-height: 1.3;
}

.topbar-sub {
    font-size: 12px;
    color: var(--slate-500);
    margin-top: 2px;
}

.topbar-right {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    flex-wrap: wrap;
}

/* Pill stats */
.pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 12px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 500;
    white-space: nowrap;
    background: var(--slate-100);
    color: var(--slate-600);
}

.pill-blue {
    background: var(--blue-50);
    color: var(--blue-700);
}

/* Add button */
.btn-os-add {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    background: linear-gradient(135deg, var(--blue-600), var(--blue-700));
    color: #fff !important;
    border: none;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 600;
    text-decoration: none;
    white-space: nowrap;
}

.btn-os-add i { font-size: 11px; }

/* Filter Bar */
.os-filterbar {
    padding: 16px;
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.filter-group {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
    justify-content: center;
}

.filter-btn {
    padding: 6px 14px;
    border-radius: 999px;
    border: 1px solid var(--slate-200);
    background: #fff;
    color: var(--slate-600);
    font-size: 12px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s;
    flex: 0 0 auto;
}

.filter-btn.active {
    background: var(--blue-600);
    border-color: var(--blue-600);
    color: #fff;
}

.search-box {
    position: relative;
    width: 100%;
}

.search-box i {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--slate-400);
    font-size: 12px;
}

.search-box input {
    width: 100%;
    padding: 10px 12px 10px 34px;
    border: 1px solid var(--slate-200);
    border-radius: 999px;
    font-size: 13px;
    background: #fff;
}

.search-box input:focus {
    outline: none;
    border-color: var(--blue-600);
    box-shadow: 0 0 0 2px var(--blue-100);
}

/* Grid - Mobile First */
.os-grid {
    display: flex;
    flex-direction: column;
    gap: 16px;
    padding: 0 16px 20px 16px;
}

/* Card */
.os-card {
    background: #fff;
    border-radius: var(--radius-lg);
    border: 1px solid var(--slate-100);
    box-shadow: var(--shadow-xs);
    transition: all 0.2s;
    overflow: hidden;
    width: 100%;
}

.os-card-stripe {
    height: 3px;
    background: linear-gradient(90deg, var(--blue-600), #60a5fa);
}

.os-card-stripe.inactive {
    background: linear-gradient(90deg, var(--slate-300), var(--slate-400));
}

.os-card-body {
    padding: 16px;
}

/* Card header */
.os-card-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 10px;
    margin-bottom: 14px;
    flex-wrap: wrap;
}

.os-card-name {
    font-size: 15px;
    font-weight: 700;
    color: var(--slate-900);
    line-height: 1.3;
    word-break: break-word;
}

.os-card-date {
    font-size: 10px;
    color: var(--slate-400);
    display: flex;
    align-items: center;
    gap: 5px;
    margin-top: 4px;
}

/* Status badge */
.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 3px 10px;
    border-radius: 999px;
    font-size: 10px;
    font-weight: 600;
    white-space: nowrap;
    flex-shrink: 0;
}

.status-active {
    background: var(--green-50);
    color: var(--green-700);
}

.status-active::before {
    content: '';
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: var(--green-600);
    display: inline-block;
    animation: pulse 1.5s infinite;
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

.status-inactive {
    background: var(--slate-100);
    color: var(--slate-500);
}

.status-inactive::before {
    content: '';
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: var(--slate-400);
    display: inline-block;
}

/* Members section */
.os-members {
    border: 1px solid var(--slate-100);
    border-radius: var(--radius-md);
    overflow: hidden;
    margin-bottom: 16px;
    background: var(--slate-50);
}

.os-members-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 12px;
    background: #fff;
    border-bottom: 1px solid var(--slate-100);
}

.members-label {
    font-size: 11px;
    font-weight: 600;
    color: var(--slate-500);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.members-count {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 11px;
    font-weight: 600;
    color: var(--blue-600);
    background: var(--blue-50);
    padding: 2px 8px;
    border-radius: 999px;
}

.os-member-row {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 12px;
    border-bottom: 1px solid var(--slate-100);
    background: #fff;
}

.os-member-row:last-child { border-bottom: none; }

.member-avatar {
    width: 36px;
    height: 36px;
    border-radius: var(--radius-md);
    overflow: hidden;
    background: linear-gradient(135deg, var(--slate-100), var(--slate-200));
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--slate-400);
    font-size: 14px;
    flex-shrink: 0;
}

.member-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.member-text {
    flex: 1;
    min-width: 0;
}

.member-name {
    font-size: 13px;
    font-weight: 600;
    color: var(--slate-800);
    line-height: 1.3;
    word-break: break-word;
}

.member-pos {
    font-size: 10px;
    color: var(--slate-500);
    margin-top: 2px;
    word-break: break-word;
}

/* More members */
.more-members-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    padding: 10px 12px;
    background: var(--slate-50);
    border-top: 1px solid var(--slate-100);
}

.more-label {
    font-size: 11px;
    color: var(--slate-500);
    font-weight: 500;
}

.btn-see-all {
    font-size: 11px;
    color: var(--blue-600);
    background: none;
    border: none;
    cursor: pointer;
    padding: 4px 8px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 5px;
    border-radius: var(--radius-sm);
}

.empty-members-box {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 28px 16px;
    color: var(--slate-300);
    gap: 8px;
    background: #fff;
    text-align: center;
}

.empty-members-box i { font-size: 24px; }
.empty-members-box span { font-size: 11px; color: var(--slate-400); }

/* Action buttons */
.actions-divider {
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--slate-200), transparent);
    margin-bottom: 14px;
}

.os-actions {
    display: flex;
    gap: 8px;
    align-items: center;
    justify-content: flex-end;
}

.btn-icon {
    width: 38px;
    height: 38px;
    border-radius: var(--radius-md);
    border: 1px solid var(--slate-200);
    background: #fff;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 13px;
    color: var(--slate-500);
    transition: all 0.2s;
}

.btn-icon-toggle-on { 
    color: var(--green-600); 
    border-color: var(--green-100); 
    background: var(--green-50);
}

.btn-icon-toggle-off { 
    color: var(--slate-400);
    background: var(--slate-50);
}

/* Pagination */
.os-pagination {
    padding: 0 16px 20px 16px;
}

.os-pagination .pagination {
    margin: 0;
    gap: 5px;
    flex-wrap: wrap;
    justify-content: center;
}

.os-pagination .page-link {
    border: 1px solid var(--slate-200);
    color: var(--slate-600);
    border-radius: var(--radius-sm);
    padding: 6px 11px;
    font-size: 12px;
    font-weight: 500;
}

.os-pagination .page-item.active .page-link {
    background: linear-gradient(135deg, var(--blue-600), var(--blue-700));
    border-color: var(--blue-600);
    color: #fff;
}

/* Empty State */
.os-empty {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 50px 20px;
    text-align: center;
    gap: 14px;
}

.os-empty-icon {
    width: 70px;
    height: 70px;
    border-radius: var(--radius-2xl);
    background: linear-gradient(135deg, var(--slate-100), var(--slate-200));
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--slate-400);
    font-size: 28px;
}

.os-empty h5 {
    font-size: 16px;
    font-weight: 700;
    color: var(--slate-800);
    margin: 0;
}

.os-empty p {
    font-size: 13px;
    color: var(--slate-500);
    max-width: 260px;
    margin: 0;
}

/* Modal Mobile */
.modal-os .modal-content {
    border-radius: var(--radius-lg);
    margin: 16px;
}

.modal-os .modal-header {
    padding: 16px;
}

.modal-os .modal-title {
    font-size: 16px;
}

.modal-os .modal-body {
    padding: 16px;
    max-height: 60vh;
}

.modal-os .modal-footer {
    padding: 12px 16px;
    gap: 10px;
}

.modal-meta-row {
    gap: 10px;
    margin-bottom: 16px;
    padding-bottom: 12px;
}

.modal-member-card {
    padding: 10px 12px;
    gap: 12px;
}

.modal-member-avatar {
    width: 42px;
    height: 42px;
}

.modal-member-name {
    font-size: 13px;
}

.modal-member-pos {
    font-size: 11px;
}

.btn-modal-close,
.btn-modal-edit {
    padding: 7px 16px;
    font-size: 12px;
}

/* ============================================
   RESPONSIVE BREAKPOINTS
   ============================================ */

/* Tablet ke atas (min-width: 768px) */
@media (min-width: 768px) {
    .os-topbar {
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        padding: 20px 24px;
    }
    
    .topbar-right {
        justify-content: flex-end;
        flex-wrap: nowrap;
    }
    
    .os-filterbar {
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        padding: 20px 24px 0 24px;
    }
    
    .filter-group {
        justify-content: flex-start;
    }
    
    .search-box {
        width: 260px;
    }
    
    .os-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
        gap: 20px;
        padding: 24px;
    }
    
    .os-card-body {
        padding: 20px;
    }
    
    .os-pagination {
        padding: 0 24px 24px;
    }
}

/* Desktop (min-width: 1024px) */
@media (min-width: 1024px) {
    .os-grid {
        grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
        gap: 24px;
    }
    
    .btn-icon:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-sm);
    }
}

/* Touch device optimizations */
@media (hover: none) and (pointer: coarse) {
    .btn-icon,
    .filter-btn,
    .btn-os-add,
    .btn-see-all {
        min-height: 44px;
    }
    
    .btn-icon {
        min-width: 44px;
    }
    
    .filter-btn {
        padding: 8px 16px;
    }
}

/* Print styles */
@media print {
    .os-topbar,
    .os-filterbar,
    .os-actions,
    .os-pagination,
    .btn-icon,
    .btn-os-add,
    .alert-os {
        display: none;
    }
    
    .os-card {
        break-inside: avoid;
        border: 1px solid #ddd;
        margin-bottom: 20px;
    }
}
</style>

{{-- Alerts --}}
@if(session('success'))
<div class="alert-os success" id="alert-success">
    <i class="fas fa-check-circle"></i>
    <span style="flex: 1;">{{ session('success') }}</span>
    <button class="close-btn" onclick="this.parentElement.remove()">×</button>
</div>
@endif

@if(session('error'))
<div class="alert-os error" id="alert-error">
    <i class="fas fa-exclamation-circle"></i>
    <span style="flex: 1;">{{ session('error') }}</span>
    <button class="close-btn" onclick="this.parentElement.remove()">×</button>
</div>
@endif

<div class="os-page">

    {{-- Top Bar --}}
    <div class="os-topbar">
        <div class="topbar-left">
            <div class="topbar-icon">
                <i class="fas fa-sitemap"></i>
            </div>
            <div>
                <div class="topbar-title">
                    <h1>Struktur Organisasi</h1>
                </div>
                <div class="topbar-sub">Kelola struktur dan keanggotaan</div>
            </div>
        </div>
        <div class="topbar-right">
            <span class="pill">
                <i class="fas fa-layer-group"></i> 
                {{ $data->total() }}
            </span>
            <span class="pill pill-blue">
                <i class="fas fa-check-circle"></i> 
                {{ $data->where('is_active', true)->count() }}
            </span>
            <a href="{{ route('admin.organization-structure.create') }}" class="btn-os-add">
                <i class="fas fa-plus"></i> Tambah
            </a>
        </div>
    </div>

    {{-- Filter & Search --}}
    @if($data->count() > 0)
    <div class="os-filterbar">
        <div class="filter-group">
            <button class="filter-btn {{ request('filter') == 'all' || !request('filter') ? 'active' : '' }}" data-filter="all">Semua</button>
            <button class="filter-btn {{ request('filter') == 'active' ? 'active' : '' }}" data-filter="active">Aktif</button>
            <button class="filter-btn {{ request('filter') == 'inactive' ? 'active' : '' }}" data-filter="inactive">Nonaktif</button>
        </div>
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" id="search-structure" placeholder="Cari struktur..." value="{{ request('search') }}">
        </div>
    </div>
    @endif

    @if($data->count() > 0)

    {{-- Grid --}}
    <div class="os-grid" id="structure-grid">
        @foreach($data as $structure)
        @php
            $members = $structure->members->sortBy('order');
            $memberCount = $members->count();
            $previewMembers = $members->take(3);
        @endphp
        <div class="os-card" data-name="{{ strtolower($structure->name) }}" data-active="{{ $structure->is_active ? 'active' : 'inactive' }}">
            <div class="os-card-stripe {{ $structure->is_active ? '' : 'inactive' }}"></div>
            <div class="os-card-body">

                {{-- Header --}}
                <div class="os-card-header">
                    <div style="flex: 1; min-width: 0;">
                        <div class="os-card-name">{{ $structure->name }}</div>
                        <div class="os-card-date">
                            <i class="far fa-calendar-alt"></i>
                            {{ $structure->created_at->translatedFormat('d M Y') }}
                        </div>
                    </div>
                    @if($structure->is_active)
                        <span class="status-badge status-active">Aktif</span>
                    @else
                        <span class="status-badge status-inactive">Nonaktif</span>
                    @endif
                </div>

                {{-- Members --}}
                <div class="os-members">
                    <div class="os-members-header">
                        <span class="members-label">Anggota</span>
                        <span class="members-count">
                            <i class="fas fa-users"></i> {{ $memberCount }}
                        </span>
                    </div>

                    @forelse($previewMembers as $member)
                    <div class="os-member-row">
                        <div class="member-avatar">
                            @if($member->photo)
                                <img src="{{ asset('storage/'.$member->photo) }}" alt="{{ $member->name }}">
                            @else
                                <i class="fas fa-user"></i>
                            @endif
                        </div>
                        <div class="member-text">
                            <div class="member-name">{{ Str::limit($member->name, 25) }}</div>
                            <div class="member-pos">{{ Str::limit($member->position, 30) }}</div>
                        </div>
                    </div>
                    @empty
                    <div class="empty-members-box">
                        <i class="fas fa-user-plus"></i>
                        <span>Belum ada anggota</span>
                    </div>
                    @endforelse

                    @if($memberCount > 3)
                    <div class="more-members-row">
                        <span class="more-label">+{{ $memberCount - 3 }} lainnya</span>
                        <button type="button" class="btn-see-all"
                                data-bs-toggle="modal"
                                data-bs-target="#previewModal{{ $structure->id }}">
                            Lihat semua <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                    @endif
                </div>

                {{-- Actions --}}
                <div class="actions-divider"></div>
                <div class="os-actions">
                    <form method="POST" action="{{ route('admin.organization-structure.toggle-active', $structure->id) }}" class="d-inline">
                        @csrf
                        <button type="submit"
                                class="btn-icon {{ $structure->is_active ? 'btn-icon-toggle-on' : 'btn-icon-toggle-off' }}"
                                data-tooltip="{{ $structure->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                            <i class="fas {{ $structure->is_active ? 'fa-toggle-on' : 'fa-toggle-off' }}"></i>
                        </button>
                    </form>

                    <button type="button"
                            class="btn-icon"
                            data-bs-toggle="modal"
                            data-bs-target="#previewModal{{ $structure->id }}"
                            data-tooltip="Preview">
                        <i class="fas fa-eye"></i>
                    </button>

                    <a href="{{ route('admin.organization-structure.edit', $structure->id) }}"
                       class="btn-icon" data-tooltip="Edit">
                        <i class="fas fa-pencil-alt"></i>
                    </a>

                    <form method="POST"
                          action="{{ route('admin.organization-structure.destroy', $structure->id) }}"
                          class="d-inline"
                          onsubmit="return confirm('Hapus struktur \"{{ $structure->name }}\"? Semua anggota akan terhapus.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-icon" data-tooltip="Hapus">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </div>

            </div>
        </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="os-pagination">
        {{ $data->appends(request()->query())->links() }}
    </div>

    @else

    {{-- Empty state --}}
    <div class="os-empty">
        <div class="os-empty-icon">
            <i class="fas fa-sitemap"></i>
        </div>
        <h5>Belum ada struktur</h5>
        <p>Tambahkan struktur organisasi pertama</p>
        <a href="{{ route('admin.organization-structure.create') }}" class="btn-os-add">
            <i class="fas fa-plus"></i> Tambah Struktur
        </a>
    </div>

    @endif

</div>



<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-dismiss alerts
    const alerts = document.querySelectorAll('.alert-os');
    alerts.forEach(alert => {
        setTimeout(() => {
            if (alert && alert.remove) {
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 300);
            }
        }, 4000);
    });

    // Search functionality with debounce
    const searchInput = document.getElementById('search-structure');
    if (searchInput) {
        let debounceTimer;
        searchInput.addEventListener('input', function() {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                const searchTerm = this.value.toLowerCase();
                const cards = document.querySelectorAll('.os-card');
                
                cards.forEach(card => {
                    const name = card.getAttribute('data-name') || '';
                    if (name.includes(searchTerm)) {
                        card.style.display = '';
                    } else {
                        card.style.display = 'none';
                    }
                });
                
                // Update URL
                const url = new URL(window.location.href);
                if (searchTerm) {
                    url.searchParams.set('search', searchTerm);
                } else {
                    url.searchParams.delete('search');
                }
                window.history.pushState({}, '', url);
            }, 300);
        });
    }

    // Filter functionality
    const filterBtns = document.querySelectorAll('.filter-btn');
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const filter = this.getAttribute('data-filter');
            
            filterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            const cards = document.querySelectorAll('.os-card');
            cards.forEach(card => {
                const isActive = card.getAttribute('data-active');
                if (filter === 'all' || isActive === filter) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
            
            const url = new URL(window.location.href);
            if (filter === 'all') {
                url.searchParams.delete('filter');
            } else {
                url.searchParams.set('filter', filter);
            }
            window.history.pushState({}, '', url);
        });
    });
    
    // Restore filter from URL
    const urlParams = new URLSearchParams(window.location.search);
    const currentFilter = urlParams.get('filter');
    if (currentFilter && currentFilter !== 'all') {
        const filterBtn = document.querySelector(`.filter-btn[data-filter="${currentFilter}"]`);
        if (filterBtn) filterBtn.click();
    }
    
    const searchQuery = urlParams.get('search');
    if (searchQuery && searchInput) {
        searchInput.value = searchQuery;
        searchInput.dispatchEvent(new Event('input'));
    }
});
</script>
@endsection
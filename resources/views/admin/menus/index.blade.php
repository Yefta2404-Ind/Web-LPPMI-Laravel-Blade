@extends('layouts.admin')

@section('content')
<div class="menu-dashboard">
    <!-- Modern Header Section -->
    <div class="dashboard-header">
        <div class="header-left">
            <div class="header-icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M3 12h18M3 6h18M3 18h18"/>
                    <path d="M8 12v6M16 12v6"/>
                </svg>
            </div>
            <div>
                <h1 class="dashboard-title">Menu Navigasi</h1>
                <p class="dashboard-subtitle">Kelola struktur dan tampilan menu website Anda</p>
            </div>
        </div>
        <a href="{{ route('admin.menus.create') }}" class="btn-create">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 5v14M5 12h14"/>
            </svg>
            Tambah Menu Baru
        </a>
    </div>

    <!-- Alert Notifications -->
    @if(session('success'))
    <div class="alert alert-success" id="statusAlert">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
            <polyline points="22 4 12 14.01 9 11.01"/>
        </svg>
        <span>{{ session('success') }}</span>
        <button class="alert-close" onclick="this.parentElement.remove()">×</button>
    </div>
    @endif

    <!-- Stats Cards -->
    <div class="stats-wrapper">
        <div class="stat-card">
            <div class="stat-icon stat-icon-primary">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M3 12h18M3 6h18M3 18h18"/>
                </svg>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $menus->count() }}</div>
                <div class="stat-label">Total Menu</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon stat-icon-success">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M3 6h18M3 12h18M3 18h18"/>
                    <path d="M8 6v12"/>
                </svg>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $menus->whereNull('parent_id')->count() }}</div>
                <div class="stat-label">Menu Utama</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon stat-icon-warning">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M4 4h16v16H4z"/>
                    <path d="M9 9h6v6H9z"/>
                </svg>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $menus->whereNotNull('parent_id')->count() }}</div>
                <div class="stat-label">Sub Menu</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon stat-icon-info">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="12" cy="12" r="10"/>
                    <path d="M12 6v6l4 2"/>
                </svg>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $menus->where('is_active', true)->count() }}</div>
                <div class="stat-label">Menu Aktif</div>
            </div>
        </div>
    </div>

    <!-- Main Card -->
    <div class="main-card">
        <div class="card-header-custom">
            <div class="header-left-section">
                <div class="section-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 12h18M3 6h18M3 18h18"/>
                    </svg>
                </div>
                <div>
                    <h3>Daftar Menu Navigasi</h3>
                    <p>Drag & drop untuk mengatur urutan • Klik judul untuk collapse/expand</p>
                </div>
            </div>
            <div class="header-right-section">
                <span class="info-badge">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="12" y1="12" x2="12" y2="16"/>
                        <line x1="12" y1="8" x2="12.01" y2="8"/>
                    </svg>
                    Total {{ $menus->count() }} entri
                </span>
            </div>
        </div>

        <div class="table-wrapper">
            @if($menus->count() > 0)
            <div class="menu-container" id="menuSortable">
                @foreach($menus->whereNull('parent_id') as $menu)
                <!-- Parent Menu Item -->
                <div class="menu-item parent-item" data-id="{{ $menu->id }}" data-order="{{ $menu->order }}">
                    <div class="menu-item-content">
                        <div class="drag-handle">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="9" cy="12" r="1"/>
                                <circle cx="9" cy="5" r="1"/>
                                <circle cx="9" cy="19" r="1"/>
                                <circle cx="15" cy="12" r="1"/>
                                <circle cx="15" cy="5" r="1"/>
                                <circle cx="15" cy="19" r="1"/>
                            </svg>
                        </div>
                        
                        <div class="menu-info">
                            <div class="menu-title-section">
                                @if($menu->children->count() > 0)
                                <button class="collapse-toggle" data-parent="{{ $menu->id }}">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="9 18 15 12 9 6"/>
                                    </svg>
                                </button>
                                @endif
                                <div class="menu-title">
                                    <span class="title-text">{{ $menu->title }}</span>
                                    @if($menu->children->count() > 0)
                                    <span class="child-count-badge">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/>
                                        </svg>
                                        {{ $menu->children->count() }} sub
                                    </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="menu-meta">
                                <div class="meta-item">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/>
                                        <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/>
                                    </svg>
                                    <span>
                                        @if($menu->page)
                                            {{ $menu->page->title }}
                                        @elseif($menu->url)
                                            {{ Str::limit($menu->url, 30) }}
                                        @else
                                            <span class="text-muted">Tidak ada URL</span>
                                        @endif
                                    </span>
                                </div>
                                <div class="meta-item">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M3 6h18M3 12h18M3 18h18"/>
                                    </svg>
                                    <span>Parent: {{ $menu->parent?->title ?? 'Utama' }}</span>
                                </div>
                                <div class="meta-item">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="12" r="10"/>
                                        <line x1="12" y1="8" x2="12" y2="16"/>
                                        <line x1="8" y1="12" x2="16" y2="12"/>
                                    </svg>
                                    <span>Urutan: {{ $menu->order }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="menu-actions">
                            <label class="toggle-switch">
                                <input type="checkbox" class="toggle-active" data-id="{{ $menu->id }}" {{ $menu->is_active ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                            <span class="status-text {{ $menu->is_active ? 'active' : 'inactive' }}">
                                {{ $menu->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                            
                            <div class="action-buttons">
                                <a href="{{ route('admin.menus.edit', $menu) }}" class="action-btn edit-btn" title="Edit">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M17 3l4 4-7 7H10v-4l7-7z"/>
                                        <path d="M4 20h16"/>
                                    </svg>
                                </a>
                                <button type="button" class="action-btn delete-btn btn-open-delete" title="Hapus"
                                        data-id="{{ $menu->id }}"
                                        data-title="{{ $menu->title }}"
                                        data-url="{{ route('admin.menus.destroy', $menu) }}"
                                        data-children='@json($menu->children->map(fn($c) => ["id" => $c->id, "title" => $c->title]))'>
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="3 6 5 6 21 6"/>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Child Menu Items -->
                    @foreach($menu->children as $child)
                    <div class="menu-item child-item" data-parent="{{ $menu->id }}">
                        <div class="menu-item-content child-content">
                            <div class="drag-handle-placeholder"></div>
                            
                            <div class="menu-info">
                                <div class="menu-title-section">
                                    <div class="child-indent-line"></div>
                                    <div class="menu-title">
                                        <span class="title-text">{{ $child->title }}</span>
                                        <span class="sub-badge">Sub Menu</span>
                                    </div>
                                </div>
                                
                                <div class="menu-meta">
                                    <div class="meta-item">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/>
                                            <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/>
                                        </svg>
                                        <span>
                                            @if($child->page)
                                                {{ $child->page->title }}
                                            @elseif($child->url)
                                                {{ Str::limit($child->url, 30) }}
                                            @else
                                                <span class="text-muted">Tidak ada URL</span>
                                            @endif
                                        </span>
                                    </div>
                                    <div class="meta-item">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M3 6h18M3 12h18M3 18h18"/>
                                        </svg>
                                        <span>Parent: {{ $menu->title }}</span>
                                    </div>
                                    <div class="meta-item">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <circle cx="12" cy="12" r="10"/>
                                            <line x1="12" y1="8" x2="12" y2="16"/>
                                            <line x1="8" y1="12" x2="16" y2="12"/>
                                        </svg>
                                        <span>Urutan: {{ $child->order }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="menu-actions">
                                <label class="toggle-switch">
                                    <input type="checkbox" class="toggle-active" data-id="{{ $child->id }}" {{ $child->is_active ? 'checked' : '' }}>
                                    <span class="toggle-slider"></span>
                                </label>
                                <span class="status-text {{ $child->is_active ? 'active' : 'inactive' }}">
                                    {{ $child->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                                
                                <div class="action-buttons">
                                    <a href="{{ route('admin.menus.edit', $child) }}" class="action-btn edit-btn" title="Edit">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M17 3l4 4-7 7H10v-4l7-7z"/>
                                            <path d="M4 20h16"/>
                                        </svg>
                                    </a>
                                    <button type="button" class="action-btn delete-btn btn-open-delete" title="Hapus"
                                            data-id="{{ $child->id }}"
                                            data-title="{{ $child->title }}"
                                            data-url="{{ route('admin.menus.destroy', $child) }}"
                                            data-children='[]'>
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="3 6 5 6 21 6"/>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endforeach
            </div>
            @else
            <!-- Empty State -->
            <div class="empty-state">
                <div class="empty-icon">
                    <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path d="M3 12h18M3 6h18M3 18h18"/>
                        <path d="M8 12v6M16 12v6"/>
                    </svg>
                </div>
                <h3>Belum Ada Menu</h3>
                <p>Mulai buat menu navigasi pertama untuk website Anda</p>
                <a href="{{ route('admin.menus.create') }}" class="btn-create-empty">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 5v14M5 12h14"/>
                    </svg>
                    Tambah Menu Pertama
                </a>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal-overlay" id="deleteModal">
    <div class="modal-container">
        <div class="modal-header">
            <div class="modal-icon danger">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polygon points="12 2 2 7 12 12 22 7 12 2"/>
                    <polyline points="2 17 12 22 22 17"/>
                    <polyline points="2 12 12 17 22 12"/>
                </svg>
            </div>
            <div>
                <h3>Hapus Menu</h3>
                <p id="modalSubtitle">Tindakan ini tidak dapat dibatalkan</p>
            </div>
            <button class="modal-close" id="closeModalBtn">×</button>
        </div>
        <div class="modal-body">
            <div class="children-warning" id="childrenWarning">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="12" y1="8" x2="12" y2="12"/>
                    <line x1="12" y1="16" x2="12.01" y2="16"/>
                </svg>
                <div>
                    <strong>Menu ini memiliki sub-menu!</strong>
                    <p>Menghapus menu induk akan ikut menghapus semua sub-menu di bawahnya:</p>
                    <ul id="childrenList"></ul>
                </div>
            </div>
            <p class="confirm-text">
                Apakah Anda yakin ingin menghapus menu <strong id="modalMenuName"></strong>?
                Tindakan ini permanen dan tidak dapat dikembalikan.
            </p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn-cancel" id="cancelDeleteBtn">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"/>
                    <line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
                Batal
            </button>
            <button type="button" class="btn-confirm" id="confirmDeleteBtn">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="3 6 5 6 21 6"/>
                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                </svg>
                <span id="confirmBtnLabel">Hapus Menu</span>
            </button>
        </div>
    </div>
</div>

<form id="deleteForm" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
</form>

<style>
/* ============================================
   MODERN MENU MANAGEMENT SYSTEM
   Full Responsive Design
   ============================================ */

:root {
    --primary: #3b82f6;
    --primary-dark: #2563eb;
    --primary-light: #eff6ff;
    --success: #10b981;
    --success-light: #f0fdf4;
    --warning: #f59e0b;
    --warning-light: #fffbeb;
    --danger: #ef4444;
    --danger-light: #fef2f2;
    --gray-50: #f9fafb;
    --gray-100: #f3f4f6;
    --gray-200: #e5e7eb;
    --gray-300: #d1d5db;
    --gray-400: #9ca3af;
    --gray-500: #6b7280;
    --gray-600: #4b5563;
    --gray-700: #374151;
    --gray-800: #1f2937;
    --gray-900: #111827;
    --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
    --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1);
    --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1);
    --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1);
}

/* Main Container */
.menu-dashboard {
    max-width: 1600px;
    margin: 0 auto;
    padding: 32px;
    background: linear-gradient(135deg, var(--gray-50) 0%, #ffffff 100%);
    min-height: 100vh;
}

/* Header Section */
.dashboard-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 32px;
    flex-wrap: wrap;
    gap: 20px;
    padding: 24px;
    background: white;
    border-radius: 24px;
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--gray-200);
}

.header-left {
    display: flex;
    align-items: center;
    gap: 20px;
}

.header-icon {
    width: 56px;
    height: 56px;
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    box-shadow: var(--shadow-md);
}

.dashboard-title {
    font-size: 28px;
    font-weight: 700;
    background: linear-gradient(135deg, var(--gray-800), var(--gray-600));
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    margin: 0 0 4px 0;
}

.dashboard-subtitle {
    font-size: 14px;
    color: var(--gray-500);
    margin: 0;
}

.btn-create {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 24px;
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    color: white;
    border: none;
    border-radius: 12px;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: var(--shadow-sm);
}

.btn-create:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

/* Alert */
.alert {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 16px 20px;
    border-radius: 16px;
    margin-bottom: 24px;
    background: var(--success-light);
    border-left: 4px solid var(--success);
    color: var(--success);
    animation: slideDown 0.3s ease-out;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.alert-close {
    margin-left: auto;
    background: none;
    border: none;
    font-size: 24px;
    cursor: pointer;
    color: inherit;
    opacity: 0.6;
    transition: opacity 0.2s;
}

.alert-close:hover {
    opacity: 1;
}

/* Stats Cards */
.stats-wrapper {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 24px;
    margin-bottom: 32px;
}

.stat-card {
    background: white;
    border-radius: 20px;
    padding: 24px;
    display: flex;
    align-items: center;
    gap: 20px;
    border: 1px solid var(--gray-200);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--primary), var(--success));
    transform: scaleX(0);
    transition: transform 0.3s;
}

.stat-card:hover::before {
    transform: scaleX(1);
}

.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-lg);
    border-color: transparent;
}

.stat-icon {
    width: 56px;
    height: 56px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: transform 0.3s;
}

.stat-card:hover .stat-icon {
    transform: scale(1.1);
}

.stat-icon-primary {
    background: linear-gradient(135deg, var(--primary-light), #dbeafe);
    color: var(--primary);
}

.stat-icon-success {
    background: linear-gradient(135deg, var(--success-light), #d1fae5);
    color: var(--success);
}

.stat-icon-warning {
    background: linear-gradient(135deg, var(--warning-light), #fef3c7);
    color: var(--warning);
}

.stat-icon-info {
    background: linear-gradient(135deg, #e0e7ff, #c7d2fe);
    color: #6366f1;
}

.stat-content {
    flex: 1;
}

.stat-value {
    font-size: 36px;
    font-weight: 800;
    background: linear-gradient(135deg, var(--gray-800), var(--gray-600));
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    line-height: 1.2;
    margin-bottom: 4px;
}

.stat-label {
    font-size: 13px;
    font-weight: 600;
    color: var(--gray-500);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Main Card */
.main-card {
    background: white;
    border-radius: 24px;
    border: 1px solid var(--gray-200);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
}

.card-header-custom {
    padding: 24px;
    background: linear-gradient(135deg, #ffffff, var(--gray-50));
    border-bottom: 1px solid var(--gray-200);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 16px;
}

.header-left-section {
    display: flex;
    align-items: center;
    gap: 12px;
}

.section-icon {
    width: 40px;
    height: 40px;
    background: var(--primary-light);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--primary);
}

.header-left-section h3 {
    font-size: 18px;
    font-weight: 600;
    color: var(--gray-800);
    margin: 0 0 4px 0;
}

.header-left-section p {
    font-size: 13px;
    color: var(--gray-500);
    margin: 0;
}

.info-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 16px;
    background: var(--gray-100);
    border-radius: 40px;
    font-size: 13px;
    color: var(--gray-600);
}

/* Table Wrapper */
.table-wrapper {
    padding: 0;
}

/* Menu Container */
.menu-container {
    display: flex;
    flex-direction: column;
}

/* Menu Item */
.menu-item {
    border-bottom: 1px solid var(--gray-100);
    transition: all 0.3s;
}

.menu-item:last-child {
    border-bottom: none;
}

.menu-item-content {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 20px 24px;
    transition: background 0.2s;
}

.parent-item .menu-item-content:hover {
    background: var(--primary-light);
}

.child-item .menu-item-content {
    background: var(--gray-50);
    padding-left: 56px;
}

.child-item .menu-item-content:hover {
    background: #f3f4f6;
}

/* Drag Handle */
.drag-handle {
    cursor: grab;
    color: var(--gray-400);
    transition: color 0.2s;
    flex-shrink: 0;
}

.drag-handle:hover {
    color: var(--primary);
}

.drag-handle:active {
    cursor: grabbing;
}

.drag-handle-placeholder {
    width: 20px;
    flex-shrink: 0;
}

/* Menu Info */
.menu-info {
    flex: 1;
}

.menu-title-section {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 12px;
}

.collapse-toggle {
    background: none;
    border: none;
    cursor: pointer;
    padding: 0;
    color: var(--gray-500);
    transition: transform 0.2s, color 0.2s;
    display: inline-flex;
    align-items: center;
}

.collapse-toggle:hover {
    color: var(--primary);
}

.collapse-toggle svg {
    transition: transform 0.2s;
}

.collapse-toggle.collapsed svg {
    transform: rotate(-90deg);
}

.menu-title {
    display: flex;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
}

.title-text {
    font-size: 16px;
    font-weight: 600;
    color: var(--gray-800);
}

.child-count-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 4px 10px;
    background: var(--primary-light);
    border-radius: 40px;
    font-size: 11px;
    font-weight: 600;
    color: var(--primary-dark);
}

.sub-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 4px 10px;
    background: var(--gray-200);
    border-radius: 40px;
    font-size: 11px;
    font-weight: 600;
    color: var(--gray-600);
}

.child-indent-line {
    width: 20px;
    height: 2px;
    background: linear-gradient(90deg, var(--gray-300), transparent);
}

.menu-meta {
    display: flex;
    align-items: center;
    gap: 20px;
    flex-wrap: wrap;
}

.meta-item {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    color: var(--gray-500);
}

.meta-item svg {
    flex-shrink: 0;
}

.text-muted {
    color: var(--gray-400);
    font-style: italic;
}

/* Menu Actions */
.menu-actions {
    display: flex;
    align-items: center;
    gap: 16px;
    flex-shrink: 0;
}

.toggle-switch {
    position: relative;
    width: 44px;
    height: 24px;
    flex-shrink: 0;
}

.toggle-switch input {
    opacity: 0;
    width: 0;
    height: 0;
    position: absolute;
}

.toggle-slider {
    position: absolute;
    inset: 0;
    background: var(--gray-300);
    border-radius: 24px;
    cursor: pointer;
    transition: background 0.2s;
}

.toggle-slider::after {
    content: '';
    position: absolute;
    left: 3px;
    top: 3px;
    width: 18px;
    height: 18px;
    background: white;
    border-radius: 50%;
    transition: transform 0.2s;
    box-shadow: var(--shadow-sm);
}

.toggle-switch input:checked + .toggle-slider {
    background: var(--success);
}

.toggle-switch input:checked + .toggle-slider::after {
    transform: translateX(20px);
}

.status-text {
    font-size: 13px;
    font-weight: 600;
    min-width: 60px;
}

.status-text.active {
    color: var(--success);
}

.status-text.inactive {
    color: var(--gray-500);
}

.action-buttons {
    display: flex;
    gap: 8px;
}

.action-btn {
    width: 32px;
    height: 32px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    border: 1px solid var(--gray-200);
    background: white;
    cursor: pointer;
    transition: all 0.2s;
    text-decoration: none;
}

.edit-btn {
    color: var(--primary);
}

.edit-btn:hover {
    background: var(--primary-light);
    border-color: var(--primary);
    transform: translateY(-2px);
}

.delete-btn {
    color: var(--danger);
}

.delete-btn:hover {
    background: var(--danger-light);
    border-color: var(--danger);
    transform: translateY(-2px);
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 80px 20px;
}

.empty-icon {
    margin-bottom: 24px;
    color: var(--gray-300);
    animation: bounce 2s infinite;
}

@keyframes bounce {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-10px);
    }
}

.empty-state h3 {
    font-size: 24px;
    font-weight: 700;
    color: var(--gray-800);
    margin-bottom: 12px;
}

.empty-state p {
    font-size: 14px;
    color: var(--gray-500);
    margin-bottom: 32px;
}

.btn-create-empty {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 28px;
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    color: white;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s;
}

.btn-create-empty:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

/* Modal */
.modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(4px);
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.3s;
}

.modal-overlay.active {
    opacity: 1;
    pointer-events: all;
}

.modal-container {
    background: white;
    border-radius: 24px;
    max-width: 500px;
    width: 100%;
    transform: translateY(20px) scale(0.96);
    transition: transform 0.3s, opacity 0.3s;
    opacity: 0;
    overflow: hidden;
}

.modal-overlay.active .modal-container {
    transform: translateY(0) scale(1);
    opacity: 1;
}

.modal-header {
    padding: 24px;
    background: linear-gradient(135deg, var(--danger-light), #fff1f2);
    display: flex;
    align-items: center;
    gap: 16px;
    border-bottom: 1px solid #fecaca;
    position: relative;
}

.modal-icon {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.modal-icon.danger {
    background: #fee2e2;
    color: var(--danger);
}

.modal-header h3 {
    font-size: 18px;
    font-weight: 700;
    color: #7f1d1d;
    margin: 0 0 4px 0;
}

.modal-header p {
    font-size: 13px;
    color: #991b1b;
    margin: 0;
}

.modal-close {
    position: absolute;
    top: 20px;
    right: 20px;
    background: none;
    border: none;
    font-size: 28px;
    cursor: pointer;
    color: var(--gray-400);
    transition: color 0.2s;
}

.modal-close:hover {
    color: var(--gray-600);
}

.modal-body {
    padding: 24px;
}

.children-warning {
    background: var(--warning-light);
    border: 1px solid #fbbf24;
    border-radius: 12px;
    padding: 16px;
    margin-bottom: 20px;
    display: none;
    gap: 12px;
    align-items: flex-start;
}

.children-warning.visible {
    display: flex;
}

.children-warning svg {
    color: #d97706;
    flex-shrink: 0;
}

.children-warning strong {
    display: block;
    color: #92400e;
    font-size: 14px;
    font-weight: 700;
    margin-bottom: 8px;
}

.children-warning p {
    color: #78350f;
    font-size: 13px;
    margin-bottom: 12px;
}

#childrenList {
    list-style: none;
    padding: 0;
    margin: 0;
}

#childrenList li {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    color: #78350f;
    padding: 4px 0;
}

#childrenList li::before {
    content: '•';
    color: #d97706;
}

.confirm-text {
    font-size: 14px;
    color: var(--gray-600);
    line-height: 1.6;
    margin: 0;
}

.confirm-text strong {
    color: var(--gray-800);
}

.modal-footer {
    padding: 20px 24px;
    display: flex;
    gap: 12px;
    justify-content: flex-end;
    border-top: 1px solid var(--gray-200);
}

.btn-cancel, .btn-confirm {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    border: none;
}

.btn-cancel {
    background: white;
    border: 1px solid var(--gray-200);
    color: var(--gray-600);
}

.btn-cancel:hover {
    background: var(--gray-100);
}

.btn-confirm {
    background: var(--danger);
    color: white;
}

.btn-confirm:hover {
    background: #dc2626;
    transform: translateY(-1px);
}

.btn-confirm:disabled {
    opacity: 0.7;
    cursor: not-allowed;
}

/* Sortable Styles */
.sortable-drag {
    opacity: 0.9;
    box-shadow: var(--shadow-lg);
}

.sortable-ghost {
    opacity: 0.3;
    background: var(--primary-light);
}

/* Responsive Design */
@media (max-width: 1024px) {
    .menu-dashboard {
        padding: 24px;
    }
}

@media (max-width: 768px) {
    .menu-dashboard {
        padding: 20px;
    }
    
    .dashboard-header {
        flex-direction: column;
        text-align: center;
        padding: 20px;
    }
    
    .header-left {
        flex-direction: column;
        text-align: center;
    }
    
    .stats-wrapper {
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }
    
    .menu-item-content {
        flex-wrap: wrap;
        padding: 16px;
    }
    
    .menu-actions {
        width: 100%;
        justify-content: flex-start;
    }
    
    .menu-meta {
        gap: 12px;
    }
    
    .meta-item {
        font-size: 12px;
    }
    
    .child-item .menu-item-content {
        padding-left: 24px;
    }
    
    .card-header-custom {
        flex-direction: column;
        text-align: center;
    }
    
    .header-left-section {
        flex-direction: column;
        text-align: center;
    }
}

@media (max-width: 640px) {
    .menu-dashboard {
        padding: 16px;
    }
    
    .stats-wrapper {
        grid-template-columns: 1fr;
    }
    
    .dashboard-title {
        font-size: 24px;
    }
    
    .stat-value {
        font-size: 28px;
    }
    
    .menu-title {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .menu-meta {
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
    }
    
    .action-buttons {
        width: 100%;
        justify-content: center;
    }
    
    .modal-footer {
        flex-direction: column;
    }
    
    .btn-cancel, .btn-confirm {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .menu-dashboard {
        padding: 12px;
    }
    
    .dashboard-header {
        padding: 16px;
    }
    
    .header-icon {
        width: 48px;
        height: 48px;
    }
    
    .btn-create {
        width: 100%;
        justify-content: center;
    }
    
    .menu-item-content {
        padding: 12px;
    }
    
    .title-text {
        font-size: 14px;
    }
}
</style>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    
    // Auto dismiss alert
    const alertEl = document.getElementById('statusAlert');
    if (alertEl) {
        setTimeout(() => {
            alertEl.style.opacity = '0';
            setTimeout(() => alertEl.remove(), 300);
        }, 4000);
    }
    
    // Collapse/Expand functionality
    document.querySelectorAll('.collapse-toggle').forEach(btn => {
        btn.addEventListener('click', function() {
            const parentId = this.dataset.parent;
            const childItems = document.querySelectorAll(`.child-item[data-parent="${parentId}"]`);
            const isCollapsed = this.classList.contains('collapsed');
            
            childItems.forEach(item => {
                if (isCollapsed) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
            
            this.classList.toggle('collapsed');
        });
    });
    
    // Toggle active status
    document.querySelectorAll('.toggle-active').forEach(toggle => {
        toggle.addEventListener('change', function() {
            const menuId = this.dataset.id;
            const checked = this.checked;
            const statusText = this.closest('.menu-actions').querySelector('.status-text');
            const toggleSwitch = this.closest('.toggle-switch');
            
            toggleSwitch.classList.add('loading');
            this.disabled = true;
            
            fetch(`/admin/menus/${menuId}/toggle`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ is_active: checked })
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    statusText.textContent = checked ? 'Aktif' : 'Nonaktif';
                    statusText.className = `status-text ${checked ? 'active' : 'inactive'}`;
                    showNotification(`Menu "${data.title}" berhasil ${checked ? 'diaktifkan' : 'dinonaktifkan'}`, 'success');
                } else {
                    this.checked = !checked;
                    showNotification('Gagal mengubah status menu', 'error');
                }
            })
            .catch(() => {
                this.checked = !checked;
                showNotification('Terjadi kesalahan', 'error');
            })
            .finally(() => {
                toggleSwitch.classList.remove('loading');
                this.disabled = false;
            });
        });
    });
    
    // Delete Modal
    const modal = document.getElementById('deleteModal');
    const deleteForm = document.getElementById('deleteForm');
    const menuNameEl = document.getElementById('modalMenuName');
    const subtitleEl = document.getElementById('modalSubtitle');
    const childrenWarning = document.getElementById('childrenWarning');
    const childrenList = document.getElementById('childrenList');
    const confirmBtn = document.getElementById('confirmDeleteBtn');
    const confirmLabel = document.getElementById('confirmBtnLabel');
    const cancelBtn = document.getElementById('cancelDeleteBtn');
    const closeBtn = document.getElementById('closeModalBtn');
    
    let currentDeleteUrl = '';
    
    function openModal(btn) {
        const title = btn.dataset.title;
        const url = btn.dataset.url;
        const children = JSON.parse(btn.dataset.children || '[]');
        
        currentDeleteUrl = url;
        menuNameEl.textContent = `"${title}"`;
        
        if (children.length > 0) {
            childrenWarning.classList.add('visible');
            childrenList.innerHTML = children.map(c => `<li>${c.title}</li>`).join('');
            subtitleEl.textContent = 'Semua sub-menu akan ikut terhapus!';
            confirmLabel.textContent = `Hapus Semua (${children.length + 1} menu)`;
        } else {
            childrenWarning.classList.remove('visible');
            childrenList.innerHTML = '';
            subtitleEl.textContent = 'Tindakan ini tidak dapat dibatalkan';
            confirmLabel.textContent = 'Hapus Menu';
        }
        
        confirmBtn.disabled = false;
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    
    function closeModal() {
        modal.classList.remove('active');
        document.body.style.overflow = '';
    }
    
    document.querySelectorAll('.btn-open-delete').forEach(btn => {
        btn.addEventListener('click', () => openModal(btn));
    });
    
    cancelBtn.addEventListener('click', closeModal);
    closeBtn.addEventListener('click', closeModal);
    modal.addEventListener('click', (e) => {
        if (e.target === modal) closeModal();
    });
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && modal.classList.contains('active')) closeModal();
    });
    
    confirmBtn.addEventListener('click', function() {
        deleteForm.action = currentDeleteUrl;
        this.disabled = true;
        this.querySelector('svg').innerHTML = '<circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>';
        confirmLabel.textContent = 'Menghapus...';
        deleteForm.submit();
    });
    
    // Sortable
    const menuContainer = document.getElementById('menuSortable');
    if (menuContainer) {
        new Sortable(menuContainer, {
            animation: 200,
            handle: '.drag-handle',
            draggable: '.parent-item',
            ghostClass: 'sortable-ghost',
            dragClass: 'sortable-drag',
            chosenClass: 'sortable-chosen',
            onStart: () => document.body.style.cursor = 'grabbing',
            onEnd: function() {
                document.body.style.cursor = '';
                const order = [];
                document.querySelectorAll('#menuSortable .parent-item').forEach(item => {
                    order.push(item.dataset.id);
                });
                
                fetch('{{ route("admin.menus.reorder") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ order })
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        document.querySelectorAll('#menuSortable .parent-item').forEach((item, index) => {
                            const orderBadge = item.querySelector('.meta-item:last-child span');
                            if (orderBadge) {
                                orderBadge.textContent = `Urutan: ${index + 1}`;
                            }
                        });
                        showNotification('Urutan menu berhasil diperbarui', 'success');
                    } else {
                        showNotification('Gagal memperbarui urutan', 'error');
                    }
                })
                .catch(() => showNotification('Terjadi kesalahan', 'error'));
            }
        });
    }
    
    // Notification Toast
    function showNotification(message, type = 'success') {
        const existingToast = document.querySelector('.notification-toast');
        if (existingToast) existingToast.remove();
        
        const colors = {
            success: '#10b981',
            error: '#ef4444'
        };
        
        const icons = {
            success: '✓',
            error: '✗'
        };
        
        const toast = document.createElement('div');
        toast.className = 'notification-toast';
        toast.style.cssText = `
            position: fixed;
            bottom: 24px;
            right: 24px;
            z-index: 10000;
            min-width: 280px;
            max-width: 360px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.12);
            border-left: 4px solid ${colors[type]};
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 14px;
            color: #334155;
            animation: slideInRight 0.3s ease;
        `;
        
        toast.innerHTML = `
            <div style="width: 24px; height: 24px; border-radius: 50%; background: ${colors[type]}20; display: flex; align-items: center; justify-content: center; color: ${colors[type]}; font-weight: bold;">
                ${icons[type]}
            </div>
            <span style="flex: 1">${message}</span>
            <button onclick="this.parentElement.remove()" style="background: none; border: none; color: #94a3b8; cursor: pointer; font-size: 18px;">×</button>
        `;
        
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.style.animation = 'slideOutRight 0.3s ease';
            setTimeout(() => toast.remove(), 300);
        }, 3500);
    }
    
    // Add animations
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        @keyframes slideOutRight {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);
});
</script>
@endpush
@endsection
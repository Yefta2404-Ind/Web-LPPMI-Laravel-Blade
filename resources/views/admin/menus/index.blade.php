@extends('layouts.admin')

@section('page-title', 'Menu Navigasi')

@section('content')
<style>
@import url('https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,400&display=swap');

:root {
    --ink:        #0c0e14;
    --ink-2:      #1e2130;
    --ink-3:      #4a5068;
    --ink-4:      #8891aa;
    --surface:    #ffffff;
    --surface-2:  #f6f7fb;
    --surface-3:  #eef0f8;
    --border:     rgba(30, 33, 48, 0.09);
    --border-md:  rgba(30, 33, 48, 0.15);

    --blue:       #2563eb;
    --blue-2:     #1d4ed8;
    --blue-bg:    #eff4ff;
    --blue-text:  #1a3ea8;
    --blue-ring:  rgba(37, 99, 235, 0.2);

    --green:      #059669;
    --green-bg:   #ecfdf5;
    --green-ring: rgba(5, 150, 105, 0.2);

    --red:        #dc2626;
    --red-bg:     #fff1f2;
    --red-ring:   rgba(220, 38, 38, 0.2);

    --amber:      #d97706;
    --amber-bg:   #fffbeb;
    --purple:     #7c3aed;
    --purple-bg:  #ede9fe;

    --r-sm: 8px;
    --r-md: 12px;
    --r-lg: 16px;
    --r-xl: 20px;
    --r-2xl: 28px;
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

body { font-family: 'DM Sans', sans-serif; background: var(--surface-2); color: var(--ink-2); }

/* ── MAIN CONTAINER ── */
.menu-dashboard {
    max-width: 1600px;
    margin: 0 auto;
    padding: 20px 16px 48px;
}
@media (min-width: 640px) { .menu-dashboard { padding: 24px 24px 64px; } }
@media (min-width: 1024px) { .menu-dashboard { padding: 32px 32px 80px; } }

/* ── BREADCRUMB ── */
.sc-crumb {
    width: 100%;
    display: flex; align-items: center; gap: 8px;
    font-size: 0.75rem; color: var(--ink-4);
    margin-bottom: 20px;
    flex-wrap: wrap;
}
@media (min-width: 640px) { .sc-crumb { font-size: 0.78rem; margin-bottom: 24px; } }
.sc-crumb a { color: var(--blue); text-decoration: none; font-weight: 500; }
.sc-crumb a:hover { text-decoration: underline; }
.sc-crumb i { font-size: 0.6rem; opacity: 0.6; }

/* ── HEADER SECTION ── */
.dashboard-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
    flex-wrap: wrap;
    gap: 20px;
    background: var(--surface);
    border: 1.5px solid var(--border);
    border-radius: var(--r-xl);
    padding: 20px 24px;
}
@media (min-width: 640px) {
    .dashboard-header { padding: 24px 32px; border-radius: var(--r-2xl); margin-bottom: 28px; }
}

.header-left {
    display: flex;
    align-items: center;
    gap: 16px;
}
@media (min-width: 640px) { .header-left { gap: 20px; } }

.header-icon {
    width: 48px; height: 48px;
    background: linear-gradient(135deg, var(--blue), var(--blue-2));
    border-radius: var(--r-lg);
    display: flex; align-items: center; justify-content: center;
    color: white;
    box-shadow: 0 4px 14px rgba(37,99,235,0.35);
}
@media (min-width: 640px) { .header-icon { width: 56px; height: 56px; } }

.dashboard-title {
    font-family: 'Sora', sans-serif;
    font-size: 1.25rem; font-weight: 800;
    color: var(--ink); letter-spacing: -0.02em;
    margin-bottom: 4px;
}
@media (min-width: 640px) { .dashboard-title { font-size: 1.5rem; } }

.dashboard-subtitle {
    font-size: 0.8rem; color: var(--ink-3);
}
@media (min-width: 640px) { .dashboard-subtitle { font-size: 0.85rem; } }

.btn-create {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    background: var(--blue);
    color: white;
    border: none;
    border-radius: var(--r-lg);
    font-size: 0.8rem; font-weight: 600;
    text-decoration: none;
    transition: all 0.2s;
    box-shadow: 0 2px 8px rgba(37,99,235,0.3);
}
@media (min-width: 640px) {
    .btn-create { padding: 12px 24px; font-size: 0.875rem; }
}
.btn-create:hover {
    background: var(--blue-2);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(37,99,235,0.4);
}

/* ── ALERT ── */
.alert {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px 18px;
    border-radius: var(--r-md);
    margin-bottom: 24px;
    background: var(--green-bg);
    border-left: 4px solid var(--green);
    color: var(--green);
    animation: slideDown 0.3s ease-out;
}
@media (min-width: 640px) { .alert { padding: 16px 20px; margin-bottom: 28px; } }
@keyframes slideDown {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
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
    line-height: 1;
}
.alert-close:hover { opacity: 1; }

/* ── STATS CARDS ── */
.stats-wrapper {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
    margin-bottom: 24px;
}
@media (min-width: 640px) { .stats-wrapper { gap: 20px; margin-bottom: 28px; } }
@media (min-width: 768px) { .stats-wrapper { grid-template-columns: repeat(4, 1fr); gap: 24px; } }

.stat-card {
    background: var(--surface);
    border: 1.5px solid var(--border);
    border-radius: var(--r-lg);
    padding: 16px;
    display: flex;
    align-items: center;
    gap: 12px;
    transition: all 0.2s;
}
@media (min-width: 640px) { .stat-card { padding: 20px; gap: 16px; border-radius: var(--r-xl); } }
.stat-card:hover {
    transform: translateY(-2px);
    border-color: var(--border-md);
    box-shadow: 0 4px 12px rgba(0,0,0,0.04);
}

.stat-icon {
    width: 44px; height: 44px;
    border-radius: var(--r-md);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
@media (min-width: 640px) { .stat-icon { width: 52px; height: 52px; } }
.stat-icon-primary { background: var(--blue-bg); color: var(--blue); }
.stat-icon-success { background: var(--green-bg); color: var(--green); }
.stat-icon-warning { background: var(--amber-bg); color: var(--amber); }
.stat-icon-info { background: var(--purple-bg); color: var(--purple); }

.stat-content { flex: 1; }
.stat-value {
    font-family: 'Sora', sans-serif;
    font-size: 1.5rem; font-weight: 800;
    color: var(--ink);
    line-height: 1.2;
    margin-bottom: 4px;
}
@media (min-width: 640px) { .stat-value { font-size: 1.75rem; } }
.stat-label {
    font-size: 0.7rem; font-weight: 600;
    color: var(--ink-4);
    text-transform: uppercase;
    letter-spacing: 0.3px;
}
@media (min-width: 640px) { .stat-label { font-size: 0.75rem; } }

/* ── MAIN CARD ── */
.main-card {
    background: var(--surface);
    border: 1.5px solid var(--border);
    border-radius: var(--r-xl);
    overflow: hidden;
}
@media (min-width: 640px) { .main-card { border-radius: var(--r-2xl); } }

.card-header-custom {
    padding: 16px 20px;
    background: var(--surface-2);
    border-bottom: 1px solid var(--border);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
}
@media (min-width: 640px) { .card-header-custom { padding: 20px 24px; } }

.header-left-section {
    display: flex;
    align-items: center;
    gap: 10px;
}
@media (min-width: 640px) { .header-left-section { gap: 12px; } }

.section-icon {
    width: 36px; height: 36px;
    background: var(--blue-bg);
    border-radius: var(--r-md);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--blue);
}
@media (min-width: 640px) { .section-icon { width: 40px; height: 40px; } }

.header-left-section h3 {
    font-family: 'Sora', sans-serif;
    font-size: 0.9rem; font-weight: 700;
    color: var(--ink);
    margin: 0 0 2px 0;
}
@media (min-width: 640px) { .header-left-section h3 { font-size: 1rem; margin-bottom: 4px; } }
.header-left-section p {
    font-size: 0.7rem; color: var(--ink-4);
    margin: 0;
}
@media (min-width: 640px) { .header-left-section p { font-size: 0.75rem; } }

.info-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 12px;
    background: var(--surface);
    border: 1px solid var(--border-md);
    border-radius: 99px;
    font-size: 0.7rem;
    color: var(--ink-3);
}
@media (min-width: 640px) {
    .info-badge { gap: 8px; padding: 8px 16px; font-size: 0.75rem; }
}

/* ── MENU CONTAINER ── */
.menu-container {
    display: flex;
    flex-direction: column;
}

/* Menu Item */
.menu-item {
    border-bottom: 1px solid var(--border);
}
.menu-item:last-child { border-bottom: none; }

.menu-item-content {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px 16px;
    transition: background 0.2s;
}
@media (min-width: 640px) { .menu-item-content { gap: 16px; padding: 18px 24px; } }

.parent-item .menu-item-content:hover { background: var(--blue-bg); }
.child-item .menu-item-content { background: var(--surface-2); }
.child-item .menu-item-content:hover { background: var(--surface-3); }

/* Level indentation */
.child-item.level-1 .menu-item-content { padding-left: 48px; }
.child-item.level-2 .menu-item-content { padding-left: 72px; }
.child-item.level-3 .menu-item-content { padding-left: 96px; }
.child-item.level-4 .menu-item-content { padding-left: 120px; }
.child-item.level-5 .menu-item-content { padding-left: 144px; }
@media (min-width: 640px) {
    .child-item.level-1 .menu-item-content { padding-left: 56px; }
    .child-item.level-2 .menu-item-content { padding-left: 80px; }
    .child-item.level-3 .menu-item-content { padding-left: 104px; }
    .child-item.level-4 .menu-item-content { padding-left: 128px; }
    .child-item.level-5 .menu-item-content { padding-left: 152px; }
}

/* Drag Handle */
.drag-handle {
    cursor: grab;
    color: var(--ink-4);
    transition: color 0.2s;
    flex-shrink: 0;
    display: inline-flex;
    align-items: center;
}
.drag-handle:hover { color: var(--blue); }
.drag-handle:active { cursor: grabbing; }

/* Menu Info */
.menu-info { flex: 1; }

.menu-title-section {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 8px;
}
@media (min-width: 640px) { .menu-title-section { gap: 12px; margin-bottom: 10px; } }

.collapse-toggle {
    background: none;
    border: none;
    cursor: pointer;
    padding: 0;
    color: var(--ink-4);
    transition: transform 0.2s, color 0.2s;
    display: inline-flex;
    align-items: center;
}
.collapse-toggle:hover { color: var(--blue); }
.collapse-toggle.collapsed svg { transform: rotate(-90deg); }

.menu-title {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
}
.title-text {
    font-size: 0.9rem; font-weight: 600;
    color: var(--ink-2);
}
@media (min-width: 640px) { .title-text { font-size: 1rem; } }

.child-count-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 2px 8px;
    background: var(--blue-bg);
    border-radius: 99px;
    font-size: 0.6rem; font-weight: 600;
    color: var(--blue);
}
@media (min-width: 640px) { .child-count-badge { padding: 3px 10px; font-size: 0.65rem; } }

.menu-meta {
    display: flex;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
}
@media (min-width: 640px) { .menu-meta { gap: 20px; } }

.meta-item {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-size: 0.65rem;
    color: var(--ink-4);
}
@media (min-width: 640px) { .meta-item { gap: 6px; font-size: 0.7rem; } }
.meta-item i { font-size: 0.6rem; }

.text-muted {
    color: var(--ink-4);
    font-style: italic;
}

/* Menu Actions */
.menu-actions {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-shrink: 0;
}
@media (min-width: 640px) { .menu-actions { gap: 16px; } }

.toggle-switch {
    position: relative;
    width: 40px;
    height: 22px;
    flex-shrink: 0;
}
@media (min-width: 640px) { .toggle-switch { width: 44px; height: 24px; } }
.toggle-switch input {
    opacity: 0;
    width: 0;
    height: 0;
    position: absolute;
}
.toggle-slider {
    position: absolute;
    inset: 0;
    background: var(--border-md);
    border-radius: 22px;
    cursor: pointer;
    transition: background 0.2s;
}
.toggle-slider::after {
    content: '';
    position: absolute;
    left: 3px;
    top: 3px;
    width: 16px;
    height: 16px;
    background: white;
    border-radius: 50%;
    transition: transform 0.2s;
    box-shadow: 0 1px 2px rgba(0,0,0,0.1);
}
@media (min-width: 640px) {
    .toggle-slider::after { width: 18px; height: 18px; }
}
.toggle-switch input:checked + .toggle-slider { background: var(--green); }
.toggle-switch input:checked + .toggle-slider::after { transform: translateX(18px); }
@media (min-width: 640px) {
    .toggle-switch input:checked + .toggle-slider::after { transform: translateX(20px); }
}

.status-text {
    font-size: 0.7rem; font-weight: 600;
    min-width: 55px;
}
@media (min-width: 640px) { .status-text { font-size: 0.75rem; min-width: 60px; } }
.status-text.active { color: var(--green); }
.status-text.inactive { color: var(--ink-4); }

.action-buttons {
    display: flex;
    gap: 6px;
}
.action-btn {
    width: 28px; height: 28px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: var(--r-sm);
    border: 1.5px solid var(--border-md);
    background: var(--surface);
    cursor: pointer;
    transition: all 0.2s;
    text-decoration: none;
}
@media (min-width: 640px) { .action-btn { width: 32px; height: 32px; } }
.edit-btn { color: var(--blue); }
.edit-btn:hover {
    background: var(--blue-bg);
    border-color: var(--blue);
    transform: translateY(-2px);
}
.delete-btn { color: var(--red); }
.delete-btn:hover {
    background: var(--red-bg);
    border-color: var(--red);
    transform: translateY(-2px);
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 60px 20px;
}
@media (min-width: 640px) { .empty-state { padding: 80px 20px; } }
.empty-icon {
    margin-bottom: 20px;
    color: var(--ink-4);
    font-size: 3rem;
}
@media (min-width: 640px) { .empty-icon { font-size: 4rem; margin-bottom: 24px; } }
.empty-state h3 {
    font-family: 'Sora', sans-serif;
    font-size: 1.25rem; font-weight: 700;
    color: var(--ink);
    margin-bottom: 8px;
}
@media (min-width: 640px) { .empty-state h3 { font-size: 1.5rem; margin-bottom: 12px; } }
.empty-state p {
    font-size: 0.8rem; color: var(--ink-4);
    margin-bottom: 24px;
}
@media (min-width: 640px) { .empty-state p { font-size: 0.875rem; margin-bottom: 32px; } }
.btn-create-empty {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    background: var(--blue);
    color: white;
    border-radius: var(--r-lg);
    text-decoration: none;
    font-weight: 600;
    font-size: 0.8rem;
    transition: all 0.2s;
}
@media (min-width: 640px) { .btn-create-empty { padding: 12px 28px; font-size: 0.875rem; } }
.btn-create-empty:hover {
    background: var(--blue-2);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(37,99,235,0.3);
}

/* Sortable Styles */
.sortable-drag {
    opacity: 0.9;
    box-shadow: 0 8px 24px rgba(0,0,0,0.12);
}
.sortable-ghost {
    opacity: 0.3;
    background: var(--blue-bg);
}

/* Responsive */
@media (max-width: 640px) {
    .menu-actions {
        width: 100%;
        justify-content: flex-start;
        margin-top: 8px;
    }
    .menu-item-content {
        flex-wrap: wrap;
    }
    .menu-info {
        flex: 1 1 100%;
    }
    .action-buttons {
        margin-left: auto;
    }
    .drag-handle {
        align-self: flex-start;
        margin-top: 4px;
    }
}
</style>

<div class="menu-dashboard">
    
    {{-- BREADCRUMB --}}
    <div class="sc-crumb">
        <a href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <i class="fas fa-chevron-right"></i>
        <span>Menu Navigasi</span>
    </div>

    {{-- HEADER --}}
    <div class="dashboard-header">
        <div class="header-left">
            <div class="header-icon">
                <i class="fas fa-bars" style="font-size: 1.25rem;"></i>
            </div>
            <div>
                <h1 class="dashboard-title">Menu Navigasi</h1>
                <p class="dashboard-subtitle">Kelola struktur dan tampilan menu website Anda</p>
            </div>
        </div>
        <a href="{{ route('admin.menus.create') }}" class="btn-create">
            <i class="fas fa-plus"></i> Tambah Menu Baru
        </a>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
    <div class="alert" id="statusAlert">
        <i class="fas fa-check-circle"></i>
        <span>{{ session('success') }}</span>
        <button class="alert-close" onclick="this.parentElement.remove()">×</button>
    </div>
    @endif

    {{-- STATS CARDS --}}
    <div class="stats-wrapper">
        <div class="stat-card">
            <div class="stat-icon stat-icon-primary">
                <i class="fas fa-bars"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $menus->count() }}</div>
                <div class="stat-label">Total Menu</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon stat-icon-success">
                <i class="fas fa-folder"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $menus->whereNull('parent_id')->count() }}</div>
                <div class="stat-label">Menu Utama</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon stat-icon-warning">
                <i class="fas fa-folder-open"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $menus->whereNotNull('parent_id')->count() }}</div>
                <div class="stat-label">Sub Menu</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon stat-icon-info">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $menus->where('is_active', true)->count() }}</div>
                <div class="stat-label">Menu Aktif</div>
            </div>
        </div>
    </div>

    {{-- MAIN CARD --}}
    <div class="main-card">
        <div class="card-header-custom">
            <div class="header-left-section">
                <div class="section-icon">
                    <i class="fas fa-list"></i>
                </div>
                <div>
                    <h3>Daftar Menu Navigasi</h3>
                    <p>Drag & drop untuk mengatur urutan • Klik ikon panah untuk expand/collapse</p>
                </div>
            </div>
            <div class="header-right-section">
                <span class="info-badge">
                    <i class="fas fa-chart-simple"></i>
                    Total {{ $menus->count() }} entri
                </span>
            </div>
        </div>

        <div class="table-wrapper">
            @if($menus->whereNull('parent_id')->count() > 0)
            <div class="menu-container" id="menuSortable">
                @foreach($menus->whereNull('parent_id')->sortBy('order') as $menu)
                <!-- Parent Menu Item -->
                <div class="menu-item parent-item" data-id="{{ $menu->id }}" data-order="{{ $menu->order }}">
                    <div class="menu-item-content">
                        <div class="drag-handle">
                            <i class="fas fa-grip-vertical" style="font-size: 1rem;"></i>
                        </div>
                        
                        <div class="menu-info">
                            <div class="menu-title-section">
                                @if($menu->childrenRecursive && $menu->childrenRecursive->count() > 0)
                                <button class="collapse-toggle" data-parent="{{ $menu->id }}">
                                    <i class="fas fa-chevron-down" style="font-size: 0.75rem;"></i>
                                </button>
                                @else
                                <div style="width: 20px;"></div>
                                @endif
                                <div class="menu-title">
                                    <span class="title-text">{{ $menu->title }}</span>
                                    @if($menu->childrenRecursive && $menu->childrenRecursive->count() > 0)
                                    <span class="child-count-badge">
                                        <i class="fas fa-layer-group"></i>
                                        {{ $menu->childrenRecursive->count() }} sub
                                    </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="menu-meta">
                                <div class="meta-item">
                                    <i class="fas fa-link"></i>
                                    <span>
                                        @if($menu->page)
                                            {{ $menu->page->title }}
                                        @elseif($menu->url)
                                            {{ \Illuminate\Support\Str::limit($menu->url, 30) }}
                                        @else
                                            <span class="text-muted">Tidak ada URL</span>
                                        @endif
                                    </span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-folder"></i>
                                    <span>Parent: {{ $menu->parent?->title ?? 'Utama' }}</span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-sort"></i>
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
                                    <i class="fas fa-pen"></i>
                                </a>
                                <button type="button" class="action-btn delete-btn btn-open-delete" title="Hapus"
                                        data-id="{{ $menu->id }}"
                                        data-title="{{ $menu->title }}"
                                        data-url="{{ route('admin.menus.destroy', $menu) }}"
                                        data-children='@json($menu->childrenRecursive)'>
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Render Children (Submenu) Recursively -->
                @if($menu->childrenRecursive && $menu->childrenRecursive->count() > 0)
                    @include('admin.menus.partials.children', ['children' => $menu->childrenRecursive, 'parentId' => $menu->id, 'level' => 1])
                @endif
                @endforeach
            </div>
            @else
            <!-- Empty State -->
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-bars" style="font-size: 3rem;"></i>
                </div>
                <h3>Belum Ada Menu</h3>
                <p>Mulai buat menu navigasi pertama untuk website Anda</p>
                <a href="{{ route('admin.menus.create') }}" class="btn-create-empty">
                    <i class="fas fa-plus"></i> Tambah Menu Pertama
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
                <i class="fas fa-trash-alt"></i>
            </div>
            <div>
                <h3>Hapus Menu</h3>
                <p id="modalSubtitle">Tindakan ini tidak dapat dibatalkan</p>
            </div>
            <button class="modal-close" id="closeModalBtn">×</button>
        </div>
        <div class="modal-body">
            <div class="children-warning" id="childrenWarning">
                <i class="fas fa-exclamation-triangle"></i>
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
                <i class="fas fa-times"></i> Batal
            </button>
            <button type="button" class="btn-confirm" id="confirmDeleteBtn">
                <i class="fas fa-trash-alt"></i>
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
/* Modal Styles */
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
    background: var(--surface);
    border-radius: var(--r-xl);
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
    padding: 20px 24px;
    background: var(--red-bg);
    display: flex;
    align-items: center;
    gap: 16px;
    border-bottom: 1px solid rgba(220,38,38,0.2);
    position: relative;
}
.modal-icon {
    width: 48px; height: 48px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}
.modal-icon.danger {
    background: #fee2e2;
    color: var(--red);
}
.modal-header h3 {
    font-family: 'Sora', sans-serif;
    font-size: 1.125rem; font-weight: 700;
    color: #7f1d1d;
    margin: 0 0 4px 0;
}
.modal-header p {
    font-size: 0.75rem;
    color: #991b1b;
    margin: 0;
}
.modal-close {
    position: absolute;
    top: 20px; right: 20px;
    background: none;
    border: none;
    font-size: 1.5rem;
    cursor: pointer;
    color: var(--ink-4);
    transition: color 0.2s;
}
.modal-close:hover { color: var(--ink-2); }
.modal-body {
    padding: 24px;
}
.children-warning {
    background: var(--amber-bg);
    border: 1px solid #fbbf24;
    border-radius: var(--r-md);
    padding: 16px;
    margin-bottom: 20px;
    display: none;
    gap: 12px;
    align-items: flex-start;
}
.children-warning.visible { display: flex; }
.children-warning i { color: var(--amber); font-size: 1.1rem; }
.children-warning strong {
    display: block;
    color: #92400e;
    font-size: 0.8rem;
    margin-bottom: 6px;
}
.children-warning p {
    color: #78350f;
    font-size: 0.75rem;
    margin-bottom: 10px;
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
    font-size: 0.75rem;
    color: #78350f;
    padding: 4px 0;
}
#childrenList li::before {
    content: '•';
    color: var(--amber);
}
.confirm-text {
    font-size: 0.8rem;
    color: var(--ink-3);
    line-height: 1.6;
    margin: 0;
}
.confirm-text strong { color: var(--ink-2); }
.modal-footer {
    padding: 16px 24px;
    display: flex;
    gap: 12px;
    justify-content: flex-end;
    border-top: 1px solid var(--border);
}
.btn-cancel, .btn-confirm {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 18px;
    border-radius: var(--r-md);
    font-size: 0.75rem; font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    border: none;
}
@media (min-width: 640px) {
    .btn-cancel, .btn-confirm { padding: 10px 20px; font-size: 0.8rem; }
}
.btn-cancel {
    background: var(--surface);
    border: 1.5px solid var(--border-md);
    color: var(--ink-3);
}
.btn-cancel:hover { background: var(--surface-3); }
.btn-confirm {
    background: var(--red);
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
@media (max-width: 640px) {
    .modal-footer { flex-direction: column; }
    .btn-cancel, .btn-confirm { width: 100%; justify-content: center; }
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
            alertEl.style.transition = 'opacity 0.3s';
            alertEl.style.opacity = '0';
            setTimeout(() => alertEl.remove(), 300);
        }, 4000);
    }
    
    // Function to toggle children visibility
    function toggleChildren(parentId, isCollapsed) {
        const childItems = document.querySelectorAll(`.child-item[data-parent="${parentId}"]`);
        childItems.forEach(item => {
            item.style.display = isCollapsed ? 'none' : '';
        });
    }
    
    // Collapse/Expand functionality
    document.querySelectorAll('.collapse-toggle').forEach(btn => {
        const parentId = btn.dataset.parent;
        toggleChildren(parentId, false);
        
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            const parentId = this.dataset.parent;
            const isCollapsed = this.classList.contains('collapsed');
            
            toggleChildren(parentId, !isCollapsed);
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
    
    function collectAllChildren(children, result = []) {
        if (!children || !Array.isArray(children)) return result;
        for (const child of children) {
            result.push({ id: child.id, title: child.title });
            if (child.children && child.children.length > 0) {
                collectAllChildren(child.children, result);
            }
        }
        return result;
    }
    
    function openModal(btn) {
        const title = btn.dataset.title;
        const url = btn.dataset.url;
        let children = [];
        
        try {
            const rawChildren = btn.dataset.children;
            if (rawChildren && rawChildren !== '[]') {
                const parsedChildren = JSON.parse(rawChildren);
                children = collectAllChildren(parsedChildren);
            }
        } catch (e) {
            console.error('Error parsing children:', e);
        }
        
        currentDeleteUrl = url;
        menuNameEl.textContent = `"${title}"`;
        
        if (children.length > 0) {
            childrenWarning.classList.add('visible');
            const renderChildrenList = (items, level = 0) => {
                return items.map(child => {
                    const indent = level > 0 ? '&nbsp;&nbsp;'.repeat(level) + '↳ ' : '';
                    return `<li style="margin-left: ${level * 20}px">${indent}${child.title}</li>`;
                }).join('');
            };
            childrenList.innerHTML = renderChildrenList(children);
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
        confirmLabel.textContent = 'Menghapus...';
        deleteForm.submit();
    });
    
    // Sortable - only for parent items
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
        
        const colors = { success: '#059669', error: '#dc2626' };
        const icons = { success: 'fa-check-circle', error: 'fa-exclamation-circle' };
        
        const toast = document.createElement('div');
        toast.className = 'notification-toast';
        toast.style.cssText = `
            position: fixed;
            bottom: 24px;
            right: 24px;
            z-index: 10000;
            min-width: 280px;
            max-width: 360px;
            background: var(--surface);
            border-radius: var(--r-md);
            box-shadow: 0 8px 24px rgba(0,0,0,0.12);
            border-left: 4px solid ${colors[type]};
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.8rem;
            color: var(--ink-2);
            animation: slideInRight 0.3s ease;
        `;
        
        toast.innerHTML = `
            <i class="fas ${icons[type]}" style="color: ${colors[type]}; font-size: 1rem;"></i>
            <span style="flex: 1">${message}</span>
            <button onclick="this.parentElement.remove()" style="background: none; border: none; color: var(--ink-4); cursor: pointer; font-size: 1.1rem;">×</button>
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
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        @keyframes slideOutRight {
            from { transform: translateX(0); opacity: 1; }
            to { transform: translateX(100%); opacity: 0; }
        }
    `;
    document.head.appendChild(style);
});
</script>
@endpush
@endsection
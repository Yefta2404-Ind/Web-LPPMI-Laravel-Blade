@extends('layouts.admin')

@section('content')
<style>
:root {
    --primary-color: #2563eb;
    --primary-light: #3b82f6;
    --primary-dark: #1d4ed8;
    --primary-soft: #dbeafe;
    --primary-very-soft: #eff6ff;
    --success-color: #059669;
    --danger-color: #dc2626;
    --secondary-color: #64748b;
    --light-bg: #f8fafc;
    --border-color: #e2e8f0;
    --text-muted: #64748b;
    --text-primary: #0f172a;
    --text-secondary: #334155;
    --hover-bg: #eff6ff;
    --child-bg: #f8fafc;
    --child-border: #c7d7fe;
}

.container-fluid { max-width: 1400px; margin: 0 auto; padding: 1.5rem 1rem; }

.header-wrapper { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem; }

.header-title h1 { font-size: calc(1.4rem + 0.6vw); font-weight: 700; margin-bottom: 0.25rem; color: var(--text-primary); line-height: 1.2; display: flex; align-items: center; gap: 0.75rem; }
.header-title h1 i { color: white; background: var(--primary-color); padding: 0.65rem; border-radius: 1rem; font-size: 1.2rem; box-shadow: 0 4px 8px rgba(37,99,235,0.25); }
.header-title p { font-size: 0.9rem; color: var(--text-muted); margin-bottom: 0; display: flex; align-items: center; gap: 0.5rem; }

.btn-primary { background: var(--primary-color); border: none; padding: 0.65rem 1.25rem; font-size: 0.9rem; font-weight: 500; border-radius: 0.5rem; transition: all 0.2s; display: inline-flex; align-items: center; gap: 0.5rem; color: white; box-shadow: 0 2px 4px rgba(37,99,235,0.1); text-decoration: none; }
.btn-primary:hover { background: var(--primary-dark); transform: translateY(-2px); box-shadow: 0 6px 12px rgba(37,99,235,0.25); color: white; }

.alert { border-radius: 0.75rem; border: none; box-shadow: 0 4px 10px rgba(0,0,0,0.05); margin-bottom: 1.5rem; padding: 1rem 1.25rem; font-size: 0.95rem; display: flex; align-items: center; gap: 0.75rem; }
.alert-success { background: #ecfdf5; color: #065f46; border-left: 4px solid var(--success-color); }

.card { border-radius: 1rem; overflow: hidden; background: white; box-shadow: 0 1px 3px rgba(0,0,0,0.06), 0 4px 16px rgba(37,99,235,0.06); border: 1px solid var(--border-color); }
.card-header { background: white; border-bottom: 1px solid var(--border-color); padding: 1.25rem 1.5rem; display: flex; justify-content: space-between; align-items: center; }
.card-header h6 { font-size: 1rem; font-weight: 600; margin: 0; color: var(--text-primary); display: flex; align-items: center; gap: 0.5rem; }
.card-header h6 i { color: var(--primary-color); }
.card-header small { color: var(--text-muted); font-size: 0.8rem; }

/* TABLE */
.table-responsive { overflow-x: auto; -webkit-overflow-scrolling: touch; }
.table { margin: 0; min-width: 900px; width: 100%; border-collapse: separate; border-spacing: 0; }
.table thead th { background: var(--light-bg); font-weight: 600; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.6px; color: var(--primary-dark); border-bottom: 2px solid var(--border-color); padding: 0.875rem 0.75rem; white-space: nowrap; }

/* PARENT ROW */
.row-parent td { padding: 0.9rem 0.75rem; vertical-align: middle; border-bottom: 1px solid var(--border-color); font-size: 0.9rem; color: var(--text-secondary); background: white; transition: background 0.15s; }
.row-parent:hover td { background: var(--hover-bg); }
.row-parent:hover td:first-child { border-left: 3px solid var(--primary-color); }

/* CHILD ROW */
.row-child td { padding: 0.7rem 0.75rem; vertical-align: middle; border-bottom: 1px solid #eef2ff; font-size: 0.875rem; color: var(--text-secondary); background: var(--child-bg); transition: background 0.15s; }
.row-child:hover td { background: #eef2ff; }
.row-child.collapsed { display: none; }

/* Child indent line */
.child-indent { display: flex; align-items: center; gap: 0.5rem; padding-left: 1.5rem; position: relative; }
.child-indent::before { content: ''; position: absolute; left: 0.5rem; top: 50%; width: 0.75rem; height: 1px; background: var(--child-border); }

/* DRAG */
.drag-handle { color: var(--text-muted); cursor: grab; font-size: 1rem; display: inline-flex; align-items: center; justify-content: center; width: 28px; height: 28px; border-radius: 0.4rem; transition: all 0.15s; }
.drag-handle:hover { color: var(--primary-color); background: var(--primary-soft); }
.drag-handle:active { cursor: grabbing; }

/* COLLAPSE BUTTON */
.collapse-btn { background: none; border: none; padding: 0; cursor: pointer; display: inline-flex; align-items: center; gap: 0.5rem; color: var(--text-primary); font-weight: 600; font-size: 0.9rem; transition: color 0.15s; }
.collapse-btn:hover { color: var(--primary-color); }
.collapse-icon { width: 20px; height: 20px; border-radius: 0.35rem; background: var(--primary-soft); color: var(--primary-color); display: inline-flex; align-items: center; justify-content: center; font-size: 0.62rem; transition: transform 0.2s, background 0.15s; flex-shrink: 0; }
.collapse-btn.open .collapse-icon { transform: rotate(90deg); background: var(--primary-color); color: white; }

/* CHILD COUNT */
.child-count { background: var(--primary-soft); color: var(--primary-dark); font-size: 0.63rem; font-weight: 700; padding: 0.15rem 0.5rem; border-radius: 2rem; border: 1px solid var(--child-border); white-space: nowrap; }

/* BADGES */
.sub-indicator { background: var(--primary-soft); color: var(--primary-dark); font-size: 0.6rem; font-weight: 700; padding: 0.15rem 0.5rem; border-radius: 1rem; border: 1px solid var(--child-border); display: inline-flex; align-items: center; gap: 0.2rem; text-transform: uppercase; }
.order-badge { background: var(--primary-soft); color: var(--primary-dark); font-weight: 600; font-size: 0.75rem; padding: 0.25rem 0.55rem; border-radius: 0.35rem; border: 1px solid var(--child-border); display: inline-flex; align-items: center; gap: 0.25rem; }

/* TOGGLE SWITCH */
.toggle-wrap { display: flex; align-items: center; gap: 0.5rem; }
.toggle-switch { position: relative; width: 40px; height: 22px; flex-shrink: 0; }
.toggle-switch input { opacity: 0; width: 0; height: 0; position: absolute; }
.toggle-slider { position: absolute; inset: 0; background: #cbd5e1; border-radius: 22px; cursor: pointer; transition: background 0.2s; }
.toggle-slider::after { content: ''; position: absolute; left: 3px; top: 3px; width: 16px; height: 16px; background: white; border-radius: 50%; transition: transform 0.2s; box-shadow: 0 1px 3px rgba(0,0,0,0.2); }
.toggle-switch input:checked + .toggle-slider { background: var(--success-color); }
.toggle-switch input:checked + .toggle-slider::after { transform: translateX(18px); }
.toggle-switch.loading .toggle-slider { opacity: 0.5; cursor: wait; }
.toggle-label { font-size: 0.75rem; font-weight: 500; color: var(--text-muted); min-width: 52px; }
.toggle-label.active { color: var(--success-color); }

/* URL & PREVIEW */
.url-cell { position: relative; display: inline-block; max-width: 220px; }
.url-text { display: inline-flex; align-items: center; gap: 0.45rem; font-size: 0.82rem; background: var(--light-bg); padding: 0.3rem 0.65rem; border-radius: 0.45rem; border: 1px solid var(--border-color); max-width: 220px; transition: border-color 0.15s; }
.url-text:hover { border-color: var(--primary-light); }
.url-text i { color: var(--primary-color); font-size: 0.78rem; flex-shrink: 0; }
.url-text span { color: var(--text-secondary); font-weight: 500; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 160px; }
.url-text .text-danger { color: var(--danger-color) !important; }

.url-preview { position: absolute; top: calc(100% + 6px); left: 0; background: #1e293b; color: white; font-size: 0.72rem; padding: 0.4rem 0.75rem; border-radius: 0.5rem; white-space: nowrap; z-index: 200; pointer-events: none; opacity: 0; transform: translateY(-4px); transition: opacity 0.15s, transform 0.15s; max-width: 300px; overflow: hidden; text-overflow: ellipsis; box-shadow: 0 4px 12px rgba(0,0,0,0.25); }
.url-preview::before { content: ''; position: absolute; top: -4px; left: 12px; width: 8px; height: 8px; background: #1e293b; transform: rotate(45deg); }
.url-cell:hover .url-preview { opacity: 1; transform: translateY(0); }

/* PARENT TEXT */
.parent-text { color: var(--text-muted); font-size: 0.82rem; background: var(--primary-very-soft); padding: 0.3rem 0.65rem; border-radius: 0.45rem; display: inline-block; border: 1px dashed var(--child-border); }
.parent-text i { color: var(--primary-color); margin-right: 0.3rem; }

/* ACTION BUTTONS */
.action-buttons { display: flex; gap: 0.35rem; justify-content: flex-end; }
.btn-sm { padding: 0.38rem 0.75rem; font-size: 0.78rem; border-radius: 0.45rem; transition: all 0.15s; border-width: 1.5px; display: inline-flex; align-items: center; gap: 0.35rem; font-weight: 500; white-space: nowrap; }
.btn-outline-primary { border-color: var(--primary-color); color: var(--primary-color); background: white; }
.btn-outline-primary:hover { background: var(--primary-color); color: white; transform: translateY(-1px); box-shadow: 0 3px 8px rgba(37,99,235,0.25); }
.btn-outline-danger { border-color: var(--danger-color); color: var(--danger-color); background: white; }
.btn-outline-danger:hover { background: var(--danger-color); color: white; transform: translateY(-1px); box-shadow: 0 3px 8px rgba(220,38,38,0.25); }

/* EMPTY STATE */
.empty-state { text-align: center; padding: 4rem 2rem; }
.empty-icon { width: 72px; height: 72px; background: var(--primary-soft); border-radius: 1.5rem; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; font-size: 1.75rem; color: var(--primary-color); }
.empty-state p { font-size: 1rem; margin-bottom: 1.25rem; color: var(--text-secondary); }

/* DELETE MODAL */
.delete-modal-overlay { position: fixed; inset: 0; background: rgba(15,23,42,0.6); backdrop-filter: blur(4px); z-index: 9999; display: flex; align-items: center; justify-content: center; padding: 1rem; opacity: 0; pointer-events: none; transition: opacity 0.2s; }
.delete-modal-overlay.active { opacity: 1; pointer-events: all; }
.delete-modal-box { background: white; border-radius: 1.25rem; width: 100%; max-width: 460px; box-shadow: 0 24px 60px rgba(15,23,42,0.2); transform: translateY(20px) scale(0.96); transition: transform 0.25s, opacity 0.25s; opacity: 0; overflow: hidden; }
.delete-modal-overlay.active .delete-modal-box { transform: translateY(0) scale(1); opacity: 1; }
.dmodal-header { background: linear-gradient(135deg, #fef2f2, #fff1f2); padding: 1.5rem; display: flex; align-items: center; gap: 1rem; border-bottom: 1px solid #fecaca; }
.dmodal-icon { background: #fee2e2; border-radius: 50%; width: 48px; height: 48px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.dmodal-icon i { color: var(--danger-color); font-size: 1.2rem; }
.dmodal-header-text h5 { font-size: 1.05rem; font-weight: 700; color: #7f1d1d; margin: 0 0 0.2rem; }
.dmodal-header-text p { font-size: 0.83rem; color: #991b1b; margin: 0; }
.dmodal-body { padding: 1.25rem 1.5rem; }
.children-warning { background: #fffbeb; border: 1px solid #fbbf24; border-radius: 0.75rem; padding: 1rem 1.1rem; margin-bottom: 1rem; display: none; gap: 0.75rem; align-items: flex-start; }
.children-warning.visible { display: flex; }
.children-warning > i { color: #d97706; font-size: 1rem; margin-top: 0.15rem; flex-shrink: 0; }
.children-warning-body strong { display: block; color: #92400e; font-size: 0.85rem; font-weight: 700; margin-bottom: 0.35rem; }
.children-warning-body p { color: #78350f; font-size: 0.82rem; margin: 0 0 0.5rem; line-height: 1.5; }
.children-list { list-style: none; padding: 0; margin: 0; }
.children-list li { display: flex; align-items: center; gap: 0.45rem; font-size: 0.8rem; color: #78350f; padding: 0.15rem 0; }
.children-list li i { color: #d97706; font-size: 0.72rem; }
.dmodal-confirm-text { font-size: 0.9rem; color: var(--text-secondary); line-height: 1.6; margin: 0; }
.dmodal-confirm-text strong { color: var(--text-primary); }
.dmodal-footer { padding: 1rem 1.5rem 1.5rem; display: flex; gap: 0.75rem; justify-content: flex-end; }
.btn-dcancel { background: white; border: 1.5px solid var(--border-color); color: var(--text-secondary); padding: 0.6rem 1.25rem; font-size: 0.88rem; font-weight: 500; border-radius: 0.5rem; cursor: pointer; transition: all 0.2s; display: inline-flex; align-items: center; gap: 0.4rem; }
.btn-dcancel:hover { background: var(--light-bg); }
.btn-dconfirm { background: var(--danger-color); border: none; color: white; padding: 0.6rem 1.25rem; font-size: 0.88rem; font-weight: 600; border-radius: 0.5rem; cursor: pointer; transition: all 0.2s; display: inline-flex; align-items: center; gap: 0.4rem; box-shadow: 0 4px 8px rgba(220,38,38,0.25); }
.btn-dconfirm:hover { background: #b91c1c; }
.btn-dconfirm:disabled { opacity: 0.7; pointer-events: none; }

/* SORTABLE */
.sortable-drag { opacity: 0.9; box-shadow: 0 12px 24px rgba(37,99,235,0.2); }
.sortable-ghost { opacity: 0.3; background: var(--primary-soft); }
.sortable-chosen { box-shadow: 0 8px 16px rgba(37,99,235,0.15); }

@media (max-width: 768px) {
    .header-wrapper { flex-direction: column; align-items: flex-start; }
    .btn-primary { width: 100%; justify-content: center; }
    .table { min-width: 800px; }
    .dmodal-footer { flex-direction: column; }
    .btn-dcancel, .btn-dconfirm { width: 100%; justify-content: center; }
}

@keyframes rowIn { from { opacity: 0; transform: translateX(-6px); } to { opacity: 1; transform: translateX(0); } }
.row-parent { animation: rowIn 0.18s ease forwards; }
</style>

{{-- DELETE MODAL --}}
<div class="delete-modal-overlay" id="deleteModal" role="dialog" aria-modal="true">
    <div class="delete-modal-box">
        <div class="dmodal-header">
            <div class="dmodal-icon"><i class="fas fa-trash-alt"></i></div>
            <div class="dmodal-header-text">
                <h5>Hapus Menu</h5>
                <p id="dmodalSubtitle">Tindakan ini tidak dapat dibatalkan.</p>
            </div>
        </div>
        <div class="dmodal-body">
            <div class="children-warning" id="childrenWarning">
                <i class="fas fa-exclamation-triangle"></i>
                <div class="children-warning-body">
                    <strong><i class="fas fa-sitemap me-1"></i>Menu ini memiliki sub-menu!</strong>
                    <p>Menghapus menu induk akan <strong>ikut menghapus semua sub-menu</strong> di bawahnya:</p>
                    <ul class="children-list" id="childrenList"></ul>
                </div>
            </div>
            <p class="dmodal-confirm-text">
                Apakah Anda yakin ingin menghapus menu <strong id="dmodalMenuName"></strong>?
                Tindakan ini permanen dan tidak dapat dikembalikan.
            </p>
        </div>
        <div class="dmodal-footer">
            <button type="button" class="btn-dcancel" id="cancelDeleteBtn">
                <i class="fas fa-times"></i> Batal
            </button>
            <button type="button" class="btn-dconfirm" id="confirmDeleteBtn">
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

<div class="container-fluid">
    <div class="header-wrapper">
        <div class="header-title">
            <h1><i class="fas fa-bars"></i> Menu Navigasi</h1>
            <p><i class="fas fa-info-circle me-1" style="color:var(--primary-light)"></i> Kelola menu dan navigasi website</p>
        </div>
        <a href="{{ route('admin.menus.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Menu Baru
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <i class="fas fa-check-circle" style="color:var(--success-color)"></i>
        {{ session('success') }}
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h6><i class="fas fa-list-ul"></i> Daftar Menu</h6>
            <small class="text-muted">
                <i class="fas fa-arrows-alt me-1" style="color:var(--primary-light)"></i>
                Drag & drop untuk mengubah urutan • Klik judul untuk collapse sub-menu
            </small>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width:48px"></th>
                        <th>Judul Menu</th>
                        <th>Halaman / URL</th>
                        <th>Parent</th>
                        <th style="width:70px">Urutan</th>
                        <th style="width:140px">Status</th>
                        <th style="width:155px; text-align:right">Aksi</th>
                    </tr>
                </thead>
                <tbody id="menuSortable">
                    @forelse($menus as $menu)

                    {{-- ===== PARENT ROW ===== --}}
                    <tr class="row-parent" data-id="{{ $menu->id }}" data-order="{{ $menu->order }}">
                        <td>
                            <span class="drag-handle"><i class="fas fa-grip-vertical"></i></span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                @if(!$menu->parent_id && $menu->children->count() > 0)
                                    <button type="button" class="collapse-btn open" data-parent="{{ $menu->id }}">
                                        <span class="collapse-icon"><i class="fas fa-chevron-right"></i></span>
                                        <span>{{ $menu->title }}</span>
                                    </button>
                                    <span class="child-count">
                                        <i class="fas fa-layer-group fa-xs me-1"></i>{{ $menu->children->count() }} sub
                                    </span>
                                @else
                                    <span class="fw-semibold" style="color:var(--text-primary)">{{ $menu->title }}</span>
                                    @if($menu->parent_id)
                                        <span class="sub-indicator"><i class="fas fa-level-down-alt fa-xs"></i> sub</span>
                                    @endif
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="url-cell">
                                <div class="url-text">
                                    @if($menu->page)
                                        <i class="fas fa-file-alt"></i><span>{{ $menu->page->title }}</span>
                                    @elseif($menu->url)
                                        <i class="fas fa-link"></i><span>{{ $menu->url }}</span>
                                    @else
                                        <i class="fas fa-exclamation-circle" style="color:var(--danger-color)"></i>
                                        <span class="text-danger">tidak ada</span>
                                    @endif
                                </div>
                                @if($menu->page || $menu->url)
                                <div class="url-preview">
                                    <i class="fas fa-external-link-alt me-1"></i>
                                    {{ $menu->page ? (url('/') . '/' . ($menu->page->slug ?? $menu->page->title)) : $menu->url }}
                                </div>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="parent-text">
                                <i class="fas fa-sitemap"></i>{{ $menu->parent?->title ?? 'Utama' }}
                            </div>
                        </td>
                        <td><span class="order-badge"><i class="fas fa-hashtag fa-xs"></i>{{ $menu->order }}</span></td>
                        <td>
                            <div class="toggle-wrap">
                                <label class="toggle-switch">
                                    <input type="checkbox" class="toggle-active" data-id="{{ $menu->id }}" {{ $menu->is_active ? 'checked' : '' }}>
                                    <span class="toggle-slider"></span>
                                </label>
                                <span class="toggle-label {{ $menu->is_active ? 'active' : '' }}">
                                    {{ $menu->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </div>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.menus.edit', $menu) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-edit"></i><span class="d-none d-lg-inline">Edit</span>
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-danger btn-open-delete"
                                        data-id="{{ $menu->id }}"
                                        data-title="{{ $menu->title }}"
                                        data-url="{{ route('admin.menus.destroy', $menu) }}"
                                        data-children='@json($menu->children->map(fn($c) => ["id" => $c->id, "title" => $c->title]))'>
                                    <i class="fas fa-trash"></i><span class="d-none d-lg-inline">Hapus</span>
                                </button>
                            </div>
                        </td>
                    </tr>

                    {{-- ===== CHILD ROWS ===== --}}
                    @foreach($menu->children as $child)
                    <tr class="row-child" data-id="{{ $child->id }}" data-parent="{{ $menu->id }}">
                        <td></td>
                        <td>
                            <div class="child-indent">
                                <span style="color:var(--text-primary);font-weight:500">{{ $child->title }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="url-cell">
                                <div class="url-text">
                                    @if($child->page)
                                        <i class="fas fa-file-alt"></i><span>{{ $child->page->title }}</span>
                                    @elseif($child->url)
                                        <i class="fas fa-link"></i><span>{{ $child->url }}</span>
                                    @else
                                        <i class="fas fa-exclamation-circle" style="color:var(--danger-color)"></i>
                                        <span class="text-danger">tidak ada</span>
                                    @endif
                                </div>
                                @if($child->page || $child->url)
                                <div class="url-preview">
                                    <i class="fas fa-external-link-alt me-1"></i>
                                    {{ $child->page ? (url('/') . '/' . ($child->page->slug ?? $child->page->title)) : $child->url }}
                                </div>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="parent-text">
                                <i class="fas fa-sitemap"></i>{{ $menu->title }}
                            </div>
                        </td>
                        <td><span class="order-badge"><i class="fas fa-hashtag fa-xs"></i>{{ $child->order }}</span></td>
                        <td>
                            <div class="toggle-wrap">
                                <label class="toggle-switch">
                                    <input type="checkbox" class="toggle-active" data-id="{{ $child->id }}" {{ $child->is_active ? 'checked' : '' }}>
                                    <span class="toggle-slider"></span>
                                </label>
                                <span class="toggle-label {{ $child->is_active ? 'active' : '' }}">
                                    {{ $child->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </div>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.menus.edit', $child) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-edit"></i><span class="d-none d-lg-inline">Edit</span>
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-danger btn-open-delete"
                                        data-id="{{ $child->id }}"
                                        data-title="{{ $child->title }}"
                                        data-url="{{ route('admin.menus.destroy', $child) }}"
                                        data-children='[]'>
                                    <i class="fas fa-trash"></i><span class="d-none d-lg-inline">Hapus</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach

                    @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <div class="empty-icon"><i class="fas fa-bars"></i></div>
                                <p>Belum ada menu navigasi.</p>
                                <a href="{{ route('admin.menus.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Tambah Menu Pertama
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(count($menus) > 0)
        <div class="card-footer bg-white border-top py-3 px-4">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                <small class="text-muted">
                    <i class="fas fa-info-circle me-1" style="color:var(--primary-color)"></i>
                    Total {{ count($menus) }} entri •
                    Parent: {{ $menus->whereNull('parent_id')->count() }} •
                    Sub-menu: {{ $menus->whereNotNull('parent_id')->count() }}
                </small>
                <small class="text-muted">
                    <i class="fas fa-mouse-pointer me-1" style="color:var(--primary-color)"></i>
                    Hover URL untuk preview • Toggle untuk ubah status
                </small>
            </div>
        </div>
        @endif
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ============================================================
    // COLLAPSIBLE CHILDREN
    // ============================================================
    document.querySelectorAll('.collapse-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const parentId = this.dataset.parent;
            const childRows = document.querySelectorAll(`.row-child[data-parent="${parentId}"]`);
            const isOpen = this.classList.contains('open');

            if (isOpen) {
                childRows.forEach(row => row.classList.add('collapsed'));
                this.classList.remove('open');
            } else {
                childRows.forEach(row => row.classList.remove('collapsed'));
                this.classList.add('open');
            }
        });
    });

    // ============================================================
    // TOGGLE AKTIF / NONAKTIF (inline AJAX)
    // ============================================================
    document.querySelectorAll('.toggle-active').forEach(toggle => {
        toggle.addEventListener('change', function () {
            const menuId  = this.dataset.id;
            const checked = this.checked;
            const label   = this.closest('.toggle-wrap').querySelector('.toggle-label');
            const sw      = this.closest('.toggle-switch');

            sw.classList.add('loading');
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
                    label.textContent = checked ? 'Aktif' : 'Nonaktif';
                    label.className   = 'toggle-label' + (checked ? ' active' : '');
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
                sw.classList.remove('loading');
                this.disabled = false;
            });
        });
    });

    // ============================================================
    // DELETE MODAL
    // ============================================================
    const overlay      = document.getElementById('deleteModal');
    const deleteForm   = document.getElementById('deleteForm');
    const menuNameEl   = document.getElementById('dmodalMenuName');
    const subtitleEl   = document.getElementById('dmodalSubtitle');
    const childrenWarn = document.getElementById('childrenWarning');
    const childrenList = document.getElementById('childrenList');
    const confirmBtn   = document.getElementById('confirmDeleteBtn');
    const confirmLabel = document.getElementById('confirmBtnLabel');
    const cancelBtn    = document.getElementById('cancelDeleteBtn');

    function openModal(btn) {
        const title    = btn.dataset.title;
        const url      = btn.dataset.url;
        const children = JSON.parse(btn.dataset.children || '[]');

        deleteForm.action    = url;
        menuNameEl.textContent = '"' + title + '"';

        if (children.length > 0) {
            childrenWarn.classList.add('visible');
            childrenList.innerHTML = children.map(c => `<li><i class="fas fa-angle-right"></i>${c.title}</li>`).join('');
            subtitleEl.textContent = 'Semua sub-menu akan ikut terhapus!';
            confirmLabel.textContent = 'Hapus Semua (' + (children.length + 1) + ' menu)';
        } else {
            childrenWarn.classList.remove('visible');
            childrenList.innerHTML = '';
            subtitleEl.textContent = 'Tindakan ini tidak dapat dibatalkan.';
            confirmLabel.textContent = 'Hapus Menu';
        }

        confirmBtn.disabled = false;
        confirmBtn.querySelector('i').className = 'fas fa-trash-alt';
        overlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        overlay.classList.remove('active');
        document.body.style.overflow = '';
    }

    document.querySelectorAll('.btn-open-delete').forEach(btn => btn.addEventListener('click', () => openModal(btn)));
    cancelBtn.addEventListener('click', closeModal);
    overlay.addEventListener('click', e => { if (e.target === overlay) closeModal(); });
    document.addEventListener('keydown', e => { if (e.key === 'Escape' && overlay.classList.contains('active')) closeModal(); });
    confirmBtn.addEventListener('click', function () {
        this.disabled = true;
        this.querySelector('i').className = 'fas fa-spinner fa-spin';
        confirmLabel.textContent = 'Menghapus...';
        deleteForm.submit();
    });

    // ============================================================
    // SORTABLE — hanya parent rows
    // ============================================================
    const menuTable = document.getElementById('menuSortable');
    if (menuTable) {
        new Sortable(menuTable, {
            animation: 200,
            handle: '.drag-handle',
            draggable: '.row-parent',
            ghostClass: 'sortable-ghost',
            dragClass: 'sortable-drag',
            chosenClass: 'sortable-chosen',
            onStart: () => document.body.style.cursor = 'grabbing',
            onEnd: function () {
                document.body.style.cursor = '';
                const order = [];
                document.querySelectorAll('#menuSortable .row-parent[data-id]').forEach(row => order.push(row.dataset.id));

                fetch('{{ route("admin.menus.reorder") }}', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
                    body: JSON.stringify({ order })
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        document.querySelectorAll('#menuSortable .row-parent[data-id]').forEach((row, i) => {
                            const badge = row.querySelector('.order-badge');
                            if (badge) badge.innerHTML = `<i class="fas fa-hashtag fa-xs"></i>${i + 1}`;
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

    // ============================================================
    // AUTO-HIDE ALERT
    // ============================================================
    const alertEl = document.querySelector('.alert');
    if (alertEl) setTimeout(() => { alertEl.classList.remove('show'); setTimeout(() => alertEl.remove(), 150); }, 5000);

    // ============================================================
    // NOTIFICATION TOAST
    // ============================================================
    function showNotification(message, type = 'success') {
        document.querySelector('.notif-toast')?.remove();
        const c = { success: '#059669', error: '#dc2626' };
        const ic = { success: 'fa-check-circle', error: 'fa-exclamation-circle' };
        const n = document.createElement('div');
        n.className = 'notif-toast';
        n.style.cssText = `position:fixed;top:20px;right:20px;z-index:10000;min-width:280px;max-width:360px;background:white;border-radius:0.75rem;box-shadow:0 8px 24px rgba(0,0,0,0.12);border-left:4px solid ${c[type]};padding:0.875rem 1rem;display:flex;align-items:center;gap:0.6rem;font-size:0.875rem;color:#334155;animation:toastIn 0.25s ease;`;
        n.innerHTML = `<i class="fas ${ic[type]}" style="color:${c[type]};flex-shrink:0"></i><span style="flex:1">${message}</span><button onclick="this.parentElement.remove()" style="background:none;border:none;color:#94a3b8;cursor:pointer;font-size:1.1rem;line-height:1;padding:0">&times;</button>`;
        document.body.appendChild(n);
        setTimeout(() => { n.style.cssText += 'opacity:0;transform:translateX(8px);transition:all 0.3s;'; setTimeout(() => n.remove(), 300); }, 3500);
    }

    document.head.insertAdjacentHTML('beforeend', '<style>@keyframes toastIn{from{transform:translateX(100%);opacity:0}to{transform:translateX(0);opacity:1}}</style>');
});
</script>
@endpush
@endsection
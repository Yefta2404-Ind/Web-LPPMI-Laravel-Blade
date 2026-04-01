@extends('layouts.admin')

@section('page-title', 'Struktur Organisasi')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
* { margin: 0; padding: 0; box-sizing: border-box; }

:root {
    --font-main: 'Plus Jakarta Sans', sans-serif;
    --blue-50: #EFF6FF;
    --blue-100: #DBEAFE;
    --blue-200: #BFDBFE;
    --blue-600: #2563EB;
    --blue-700: #1D4ED8;
    --blue-900: #1E3A8A;
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
    --radius-2xl: 24px;
    --shadow-xs: 0 1px 2px rgba(15,23,42,0.04);
    --shadow-sm: 0 1px 3px rgba(15,23,42,0.06), 0 1px 2px rgba(15,23,42,0.04);
    --shadow-md: 0 4px 12px rgba(15,23,42,0.08), 0 2px 4px rgba(15,23,42,0.04);
    --shadow-lg: 0 12px 28px rgba(15,23,42,0.10), 0 4px 8px rgba(15,23,42,0.04);
}

body, .os-page * { font-family: var(--font-main); }

/* ── Animation ── */
@keyframes slideIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

/* ── Alert ── */
.alert-os {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px 20px;
    border-radius: var(--radius-lg);
    font-size: 13.5px;
    font-weight: 500;
    margin-bottom: 24px;
    animation: slideIn 0.3s ease-out;
    backdrop-filter: blur(8px);
}
.alert-os.success { 
    background: linear-gradient(135deg, var(--green-50), #ECFDF5);
    color: var(--green-700); 
    border-left: 4px solid var(--green-600);
}
.alert-os.error { 
    background: linear-gradient(135deg, var(--red-50), #FFF5F5);
    color: var(--red-600); 
    border-left: 4px solid var(--red-600);
}
.alert-os .close-btn {
    margin-left: auto;
    background: none;
    border: none;
    cursor: pointer;
    color: inherit;
    opacity: 0.6;
    font-size: 18px;
    line-height: 1;
    padding: 0 4px;
    transition: opacity 0.2s;
}
.alert-os .close-btn:hover { opacity: 1; }

/* ── Page Shell ── */
.os-page {
    background: var(--slate-50);
    min-height: 100vh;
    padding: 0;
}

/* ── Top Bar ── */
.os-topbar {
    background: #fff;
    border-bottom: 1px solid var(--slate-100);
    padding: 24px 32px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    flex-wrap: wrap;
    position: sticky;
    top: 0;
    z-index: 10;
    backdrop-filter: blur(10px);
    background: rgba(255,255,255,0.95);
}

.topbar-left {
    display: flex;
    align-items: center;
    gap: 16px;
}

.topbar-icon {
    width: 48px;
    height: 48px;
    border-radius: var(--radius-lg);
    background: linear-gradient(135deg, var(--blue-50), var(--blue-100));
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--blue-600);
    font-size: 20px;
    flex-shrink: 0;
}

.topbar-title {
    font-size: 20px;
    font-weight: 700;
    color: var(--slate-900);
    letter-spacing: -0.3px;
    line-height: 1.2;
}

.topbar-sub {
    font-size: 13px;
    color: var(--slate-500);
    margin-top: 2px;
}

.topbar-right {
    display: flex;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
}

/* Pill stats */
.pill {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 16px;
    border-radius: 999px;
    font-size: 13px;
    font-weight: 500;
    white-space: nowrap;
    transition: all 0.2s;
}
.pill-neutral {
    background: var(--slate-100);
    color: var(--slate-600);
}
.pill-neutral i { color: var(--slate-400); font-size: 12px; }
.pill-blue {
    background: var(--blue-50);
    color: var(--blue-700);
}
.pill-blue i { font-size: 12px; }
.pill:hover {
    transform: translateY(-1px);
}

/* Add button */
.btn-os-add {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 20px;
    background: linear-gradient(135deg, var(--blue-600), var(--blue-700));
    color: #fff !important;
    border: none;
    border-radius: 999px;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 2px 8px rgba(37,99,235,0.25);
    letter-spacing: -0.1px;
}
.btn-os-add:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(37,99,235,0.35);
    color: #fff !important;
    text-decoration: none;
    background: linear-gradient(135deg, var(--blue-700), var(--blue-800));
}
.btn-os-add i { font-size: 12px; }

/* ── Filter Bar ── */
.os-filterbar {
    padding: 20px 32px 0 32px;
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
}

.filter-group {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

.filter-btn {
    padding: 6px 16px;
    border-radius: 999px;
    border: 1px solid var(--slate-200);
    background: #fff;
    color: var(--slate-600);
    font-size: 12px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s;
}
.filter-btn:hover {
    border-color: var(--blue-600);
    color: var(--blue-600);
}
.filter-btn.active {
    background: var(--blue-600);
    border-color: var(--blue-600);
    color: #fff;
}

.search-box {
    position: relative;
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
    padding: 6px 12px 6px 32px;
    border: 1px solid var(--slate-200);
    border-radius: 999px;
    font-size: 13px;
    width: 240px;
    transition: all 0.2s;
}
.search-box input:focus {
    outline: none;
    border-color: var(--blue-600);
    box-shadow: 0 0 0 3px var(--blue-100);
}

/* ── Grid ── */
.os-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
    gap: 24px;
    padding: 28px 32px;
}

/* ── Card ── */
.os-card {
    background: #fff;
    border-radius: var(--radius-xl);
    border: 1px solid var(--slate-100);
    box-shadow: var(--shadow-xs);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    animation: fadeIn 0.5s ease-out;
}
.os-card:hover {
    box-shadow: var(--shadow-lg);
    transform: translateY(-4px);
    border-color: var(--slate-200);
}

/* Card top stripe */
.os-card-stripe {
    height: 4px;
    background: linear-gradient(90deg, var(--blue-600), #60a5fa, #93c5fd);
    transition: all 0.3s;
}
.os-card-stripe.inactive {
    background: linear-gradient(90deg, var(--slate-300), var(--slate-400));
}

.os-card-body {
    padding: 20px 24px;
    flex: 1;
    display: flex;
    flex-direction: column;
}

/* Card header row */
.os-card-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 20px;
}

.os-card-name {
    font-size: 16px;
    font-weight: 700;
    color: var(--slate-900);
    letter-spacing: -0.2px;
    line-height: 1.3;
    margin-bottom: 6px;
}

.os-card-date {
    font-size: 11px;
    color: var(--slate-400);
    display: flex;
    align-items: center;
    gap: 6px;
}
.os-card-date i { font-size: 10px; }

/* Status badge */
.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 4px 12px;
    border-radius: 999px;
    font-size: 11px;
    font-weight: 600;
    white-space: nowrap;
    letter-spacing: 0.2px;
    flex-shrink: 0;
}
.status-active {
    background: var(--green-50);
    color: var(--green-700);
    border: 1px solid var(--green-100);
}
.status-active::before {
    content: '';
    display: inline-block;
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: var(--green-600);
    animation: pulse 2s infinite;
}
@keyframes pulse {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.6; transform: scale(1.2); }
}
.status-inactive {
    background: var(--slate-100);
    color: var(--slate-500);
    border: 1px solid var(--slate-200);
}
.status-inactive::before {
    content: '';
    display: inline-block;
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: var(--slate-300);
}

/* Member section */
.os-members {
    flex: 1;
    border: 1px solid var(--slate-100);
    border-radius: var(--radius-lg);
    overflow: hidden;
    margin-bottom: 20px;
    background: var(--slate-50);
}

.os-members-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 16px;
    background: #fff;
    border-bottom: 1px solid var(--slate-100);
}

.members-label {
    font-size: 12px;
    font-weight: 600;
    color: var(--slate-500);
    text-transform: uppercase;
    letter-spacing: 0.6px;
}

.members-count {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 12px;
    font-weight: 600;
    color: var(--blue-600);
    background: var(--blue-50);
    padding: 3px 10px;
    border-radius: 999px;
}
.members-count i { font-size: 10px; }

.os-member-row {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 16px;
    border-bottom: 1px solid var(--slate-100);
    transition: all 0.2s;
    background: #fff;
}
.os-member-row:last-child { border-bottom: none; }
.os-member-row:hover { 
    background: var(--slate-50);
    transform: translateX(4px);
}

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
    border: 1px solid var(--slate-100);
}
.member-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.member-text {
    flex: 1;
}
.member-name {
    font-size: 13px;
    font-weight: 600;
    color: var(--slate-800);
    line-height: 1.3;
}
.member-pos {
    font-size: 11px;
    color: var(--slate-500);
    margin-top: 2px;
}

/* More members row */
.more-members-row {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 10px 16px;
    background: var(--slate-50);
    border-top: 1px solid var(--slate-100);
}
.more-label {
    font-size: 12px;
    color: var(--slate-500);
    font-weight: 500;
}
.btn-see-all {
    margin-left: auto;
    font-size: 12px;
    color: var(--blue-600);
    background: none;
    border: none;
    cursor: pointer;
    padding: 4px 8px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 6px;
    border-radius: var(--radius-sm);
    transition: all 0.2s;
    font-family: var(--font-main);
}
.btn-see-all:hover { 
    background: var(--blue-50);
    transform: translateX(-2px);
}

/* Empty members */
.empty-members-box {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 32px 20px;
    color: var(--slate-300);
    gap: 10px;
    background: #fff;
}
.empty-members-box i { font-size: 28px; color: var(--slate-200); }
.empty-members-box span { font-size: 12px; color: var(--slate-400); }

/* Action bar */
.os-actions {
    display: flex;
    gap: 8px;
    align-items: center;
    justify-content: flex-end;
}

.btn-icon {
    width: 36px;
    height: 36px;
    border-radius: var(--radius-md);
    border: 1px solid var(--slate-200);
    background: #fff;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 14px;
    color: var(--slate-500);
    transition: all 0.2s;
    text-decoration: none;
}
.btn-icon:hover { 
    transform: translateY(-2px);
    box-shadow: var(--shadow-sm);
}

.btn-icon-toggle-on  { 
    color: var(--green-600); 
    border-color: var(--green-100); 
    background: var(--green-50);
}
.btn-icon-toggle-on:hover {
    background: var(--green-100);
    color: var(--green-700);
}
.btn-icon-toggle-off { 
    color: var(--slate-400);
    background: var(--slate-50);
}

.btn-icon-edit:hover   { 
    color: var(--amber-600); 
    border-color: #FDE68A; 
    background: var(--amber-50);
}
.btn-icon-eye:hover    { 
    color: var(--blue-600);  
    border-color: var(--blue-100); 
    background: var(--blue-50);
}
.btn-icon-delete:hover { 
    color: var(--red-600);   
    border-color: #FECDD3; 
    background: var(--red-50);
}

/* Divider before actions */
.actions-divider {
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--slate-200), transparent);
    margin-bottom: 16px;
}

/* ── Pagination ── */
.os-pagination {
    display: flex;
    justify-content: center;
    padding: 0 32px 32px;
}
.os-pagination .pagination { margin: 0; gap: 6px; flex-wrap: wrap; justify-content: center; }
.os-pagination .page-link {
    border: 1px solid var(--slate-200);
    color: var(--slate-600);
    border-radius: var(--radius-sm);
    padding: 8px 14px;
    font-size: 13px;
    font-family: var(--font-main);
    font-weight: 500;
    transition: all 0.2s;
}
.os-pagination .page-item.active .page-link {
    background: linear-gradient(135deg, var(--blue-600), var(--blue-700));
    border-color: var(--blue-600);
    color: #fff;
    box-shadow: 0 2px 8px rgba(37,99,235,0.3);
}
.os-pagination .page-link:hover:not(.active) {
    background: var(--slate-100);
    border-color: var(--slate-300);
    transform: translateY(-1px);
}

/* ── Empty State ── */
.os-empty {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 80px 40px;
    text-align: center;
    gap: 16px;
    animation: fadeIn 0.5s ease-out;
}
.os-empty-icon {
    width: 88px;
    height: 88px;
    border-radius: var(--radius-2xl);
    background: linear-gradient(135deg, var(--slate-100), var(--slate-200));
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--slate-400);
    font-size: 36px;
    margin-bottom: 8px;
}
.os-empty h5 {
    font-size: 18px;
    font-weight: 700;
    color: var(--slate-800);
    letter-spacing: -0.2px;
}
.os-empty p {
    font-size: 14px;
    color: var(--slate-500);
    max-width: 320px;
    line-height: 1.5;
}

/* ── Modal ── */
.modal-os .modal-content {
    border-radius: var(--radius-2xl);
    border: none;
    box-shadow: var(--shadow-lg);
    font-family: var(--font-main);
    overflow: hidden;
    animation: fadeIn 0.3s ease-out;
}
.modal-os .modal-header {
    padding: 24px 28px 20px;
    border-bottom: 1px solid var(--slate-100);
    background: linear-gradient(135deg, #fff, var(--slate-50));
}
.modal-os .modal-title {
    font-size: 18px;
    font-weight: 700;
    color: var(--slate-900);
    letter-spacing: -0.2px;
}
.modal-os .modal-header .modal-sub {
    font-size: 12px;
    color: var(--slate-500);
    margin-top: 4px;
}
.modal-os .modal-body {
    padding: 24px 28px;
    max-height: 520px;
    overflow-y: auto;
    background: #fff;
}
.modal-os .modal-footer {
    padding: 16px 28px;
    border-top: 1px solid var(--slate-100);
    background: var(--slate-50);
    gap: 12px;
}

.modal-meta-row {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    margin-bottom: 20px;
    padding-bottom: 16px;
    border-bottom: 1px solid var(--slate-100);
}

.modal-member-card {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 14px 16px;
    background: var(--slate-50);
    border: 1px solid var(--slate-100);
    border-radius: var(--radius-lg);
    margin-bottom: 10px;
    transition: all 0.2s;
}
.modal-member-card:hover { 
    transform: translateX(4px);
    background: #fff;
    box-shadow: var(--shadow-sm);
}
.modal-member-card:last-child { margin-bottom: 0; }

.modal-member-avatar {
    width: 48px;
    height: 48px;
    border-radius: var(--radius-lg);
    object-fit: cover;
    background: linear-gradient(135deg, var(--slate-100), var(--slate-200));
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--slate-400);
    font-size: 18px;
    border: 1px solid var(--slate-100);
    overflow: hidden;
}
.modal-member-avatar img { width: 100%; height: 100%; object-fit: cover; }

.modal-member-name {
    font-size: 15px;
    font-weight: 600;
    color: var(--slate-800);
}
.modal-member-pos {
    font-size: 12px;
    color: var(--slate-500);
    margin-top: 2px;
}

.btn-modal-close {
    background: var(--slate-100);
    color: var(--slate-600);
    border: none;
    padding: 8px 20px;
    border-radius: 999px;
    font-size: 13px;
    font-weight: 600;
    font-family: var(--font-main);
    cursor: pointer;
    transition: all 0.2s;
}
.btn-modal-close:hover { 
    background: var(--slate-200);
    transform: translateY(-1px);
}

.btn-modal-edit {
    background: linear-gradient(135deg, var(--blue-600), var(--blue-700));
    color: #fff;
    border: none;
    padding: 8px 20px;
    border-radius: 999px;
    font-size: 13px;
    font-weight: 600;
    font-family: var(--font-main);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s;
}
.btn-modal-edit:hover { 
    background: linear-gradient(135deg, var(--blue-700), var(--blue-800));
    transform: translateY(-1px);
    color: #fff; 
    text-decoration: none;
}

/* ── Tooltip ── */
[data-tooltip] {
    position: relative;
}
[data-tooltip]:before {
    content: attr(data-tooltip);
    position: absolute;
    bottom: 100%;
    left: 50%;
    transform: translateX(-50%);
    padding: 4px 8px;
    background: var(--slate-800);
    color: #fff;
    font-size: 11px;
    border-radius: var(--radius-sm);
    white-space: nowrap;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.2s;
    margin-bottom: 6px;
}
[data-tooltip]:hover:before {
    opacity: 1;
}

/* ── Responsive ── */
@media (max-width: 768px) {
    .os-topbar { padding: 20px 20px; }
    .os-filterbar { padding: 16px 20px 0 20px; }
    .os-grid { 
        grid-template-columns: 1fr; 
        padding: 20px;
        gap: 20px;
    }
    .os-pagination { padding: 0 20px 24px; }
    .topbar-icon { width: 40px; height: 40px; font-size: 16px; }
    .topbar-title { font-size: 18px; }
    .search-box input { width: 180px; }
}

@media (max-width: 480px) {
    .topbar-title { font-size: 16px; }
    .topbar-sub { font-size: 11px; }
    .pill { font-size: 11px; padding: 6px 12px; }
    .btn-os-add { padding: 6px 16px; font-size: 12px; }
    .filter-group { width: 100%; justify-content: center; }
    .search-box { width: 100%; }
    .search-box input { width: 100%; }
}
</style>

{{-- Alerts with auto-dismiss --}}
@if(session('success'))
<div class="alert-os success" id="alert-success">
    <i class="fas fa-check-circle"></i>
    {{ session('success') }}
    <button class="close-btn" onclick="this.parentElement.remove()">×</button>
</div>
@endif
@if(session('error'))
<div class="alert-os error" id="alert-error">
    <i class="fas fa-exclamation-circle"></i>
    {{ session('error') }}
    <button class="close-btn" onclick="this.parentElement.remove()">×</button>
</div>
@endif

<div class="os-page">

    {{-- ── Top Bar ── --}}
    <div class="os-topbar">
        <div class="topbar-left">
            <div class="topbar-icon">
                <i class="fas fa-sitemap"></i>
            </div>
            <div>
                <div class="topbar-title">Struktur Organisasi</div>
                <div class="topbar-sub">Kelola struktur dan keanggotaan organisasi</div>
            </div>
        </div>
        <div class="topbar-right">
            <span class="pill pill-neutral" data-tooltip="Total struktur organisasi">
                <i class="fas fa-layer-group"></i> {{ $data->total() }} Total
            </span>
            <span class="pill pill-blue" data-tooltip="Struktur yang aktif ditampilkan">
                <i class="fas fa-check-circle"></i> {{ $data->where('is_active', true)->count() }} Aktif
            </span>
            <a href="{{ route('admin.organization-structure.create') }}" class="btn-os-add">
                <i class="fas fa-plus"></i> Tambah Struktur
            </a>
        </div>
    </div>

    {{-- ── Filter & Search ── --}}
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

    {{-- ── Grid ── --}}
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
                    <div style="flex: 1; min-width: 0; padding-right: 12px;">
                        <div class="os-card-name">{{ $structure->name }}</div>
                        <div class="os-card-date">
                            <i class="far fa-calendar-alt"></i>
                            {{ $structure->created_at->translatedFormat('d F Y') }}
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
                            <div class="member-name">{{ Str::limit($member->name, 28) }}</div>
                            <div class="member-pos">{{ Str::limit($member->position, 35) }}</div>
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
                        <span class="more-label">+{{ $memberCount - 3 }} anggota lainnya</span>
                        <button type="button" class="btn-see-all"
                                data-bs-toggle="modal"
                                data-bs-target="#previewModal{{ $structure->id }}">
                            Lihat semua <i class="fas fa-arrow-right" style="font-size: 10px;"></i>
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
                            <i class="fas {{ $structure->is_active ? 'fa-toggle-on' : 'fa-toggle-off' }}" style="font-size: 16px;"></i>
                        </button>
                    </form>

                    <button type="button"
                            class="btn-icon btn-icon-eye"
                            data-bs-toggle="modal"
                            data-bs-target="#previewModal{{ $structure->id }}"
                            data-tooltip="Preview">
                        <i class="fas fa-eye"></i>
                    </button>

                    <a href="{{ route('admin.organization-structure.edit', $structure->id) }}"
                       class="btn-icon btn-icon-edit" data-tooltip="Edit">
                        <i class="fas fa-pencil-alt"></i>
                    </a>

                    <form method="POST"
                          action="{{ route('admin.organization-structure.destroy', $structure->id) }}"
                          class="d-inline"
                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus struktur \"{{ $structure->name }}\"?\\nSemua anggota di dalamnya juga akan terhapus permanen.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-icon btn-icon-delete" data-tooltip="Hapus">
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

    {{-- Empty state with illustration --}}
    <div class="os-empty">
        <div class="os-empty-icon">
            <i class="fas fa-sitemap"></i>
        </div>
        <h5>Belum ada struktur organisasi</h5>
        <p>Mulai dengan menambahkan struktur organisasi pertama untuk ditampilkan di halaman publik.</p>
        <a href="{{ route('admin.organization-structure.create') }}" class="btn-os-add" style="margin-top: 8px;">
            <i class="fas fa-plus"></i> Tambah Struktur
        </a>
    </div>

    @endif

</div>{{-- .os-page --}}


{{-- ── Preview Modals ── --}}
@foreach($data as $structure)
@php
    $members = $structure->members->sortBy('order');
    $memberCount = $members->count();
@endphp
<div class="modal fade modal-os" id="previewModal{{ $structure->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 460px;">
        <div class="modal-content">
            <div class="modal-header">
                <div>
                    <div class="modal-title">{{ $structure->name }}</div>
                    <div class="modal-sub">
                        <i class="far fa-calendar-alt me-1"></i> Dibuat {{ $structure->created_at->translatedFormat('d F Y') }}
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <div class="modal-meta-row">
                    <span class="pill pill-neutral" style="font-size: 12px;">
                        <i class="fas fa-users" style="font-size: 11px;"></i> {{ $memberCount }} Anggota
                    </span>
                    @if($structure->is_active)
                        <span class="status-badge status-active" style="font-size: 11px;">Aktif</span>
                    @else
                        <span class="status-badge status-inactive" style="font-size: 11px;">Nonaktif</span>
                    @endif
                </div>

                @if($memberCount > 0)
                    @foreach($members as $member)
                    <div class="modal-member-card">
                        <div class="modal-member-avatar">
                            @if($member->photo)
                                <img src="{{ asset('storage/'.$member->photo) }}" alt="{{ $member->name }}">
                            @else
                                <i class="fas fa-user"></i>
                            @endif
                        </div>
                        <div>
                            <div class="modal-member-name">{{ $member->name }}</div>
                            <div class="modal-member-pos">{{ $member->position }}</div>
                        </div>
                    </div>
                    @endforeach
                @else
                <div style="display: flex; flex-direction: column; align-items: center; padding: 48px 20px; color: var(--slate-300); gap: 12px;">
                    <i class="fas fa-user-friends" style="font-size: 36px;"></i>
                    <span style="font-size: 13px; color: var(--slate-400);">Belum ada anggota dalam struktur ini</span>
                </div>
                @endif
            </div>
            <div class="modal-footer" style="justify-content: flex-end;">
                <button type="button" class="btn-modal-close" data-bs-dismiss="modal">Tutup</button>
                <a href="{{ route('admin.organization-structure.edit', $structure->id) }}" class="btn-modal-edit">
                    <i class="fas fa-pencil-alt" style="font-size: 12px;"></i> Edit Struktur
                </a>
            </div>
        </div>
    </div>
</div>
@endforeach

<script>
// Auto-dismiss alerts after 5 seconds
document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alert-os');
    alerts.forEach(alert => {
        setTimeout(() => {
            if (alert && alert.remove) {
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-10px)';
                setTimeout(() => alert.remove(), 300);
            }
        }, 5000);
    });

    // Search functionality
    const searchInput = document.getElementById('search-structure');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
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
        });
    }

    // Filter functionality
    const filterBtns = document.querySelectorAll('.filter-btn');
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const filter = this.getAttribute('data-filter');
            
            // Update active state
            filterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            // Filter cards
            const cards = document.querySelectorAll('.os-card');
            cards.forEach(card => {
                const isActive = card.getAttribute('data-active');
                if (filter === 'all' || isActive === filter) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
            
            // Update URL without reload
            const url = new URL(window.location.href);
            if (filter === 'all') {
                url.searchParams.delete('filter');
            } else {
                url.searchParams.set('filter', filter);
            }
            window.history.pushState({}, '', url);
        });
    });
    
    // Preserve filter from URL
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
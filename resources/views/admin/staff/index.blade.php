@extends('layouts.admin')

@section('page-title', 'Manajemen Staff')

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
.staff-dashboard {
    max-width: 1600px;
    margin: 0 auto;
    padding: 20px 16px 48px;
}
@media (min-width: 640px) { .staff-dashboard { padding: 24px 24px 64px; } }
@media (min-width: 1024px) { .staff-dashboard { padding: 32px 32px 80px; } }

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
    box-shadow: 0 1px 2px rgba(0,0,0,0.02);
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

/* ── CONTROL BAR ── */
.control-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
    flex-wrap: wrap;
    gap: 16px;
    background: var(--surface);
    border: 1.5px solid var(--border);
    border-radius: var(--r-lg);
    padding: 12px 16px;
}
@media (min-width: 640px) {
    .control-bar { padding: 16px 24px; border-radius: var(--r-xl); margin-bottom: 28px; }
}

.filter-group {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}
.filter-chip {
    padding: 6px 16px;
    background: var(--surface);
    border: 1.5px solid var(--border-md);
    border-radius: 99px;
    font-size: 0.75rem; font-weight: 600;
    color: var(--ink-3);
    cursor: pointer;
    transition: all 0.2s;
    font-family: 'DM Sans', sans-serif;
}
@media (min-width: 640px) { .filter-chip { padding: 8px 20px; font-size: 0.8rem; } }
.filter-chip:hover { border-color: var(--blue); color: var(--blue); }
.filter-chip.active {
    background: var(--blue);
    border-color: var(--blue);
    color: white;
    box-shadow: 0 2px 8px rgba(37,99,235,0.3);
}

.search-area {
    position: relative;
    min-width: 240px;
}
@media (min-width: 640px) { .search-area { min-width: 280px; } }
.search-icon {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--ink-4);
    font-size: 0.85rem;
}
.search-field {
    width: 100%;
    padding: 8px 12px 8px 36px;
    border: 1.5px solid var(--border-md);
    border-radius: 99px;
    font-size: 0.8rem;
    font-family: 'DM Sans', sans-serif;
    transition: all 0.2s;
    background: var(--surface);
}
@media (min-width: 640px) {
    .search-field { padding: 10px 16px 10px 42px; font-size: 0.85rem; }
}
.search-field:focus {
    outline: none;
    border-color: var(--blue);
    box-shadow: 0 0 0 3px var(--blue-ring);
}
.search-field::placeholder { color: var(--ink-4); }

/* ── STAFF GRID ── */
.staff-container {
    display: grid;
    grid-template-columns: 1fr;
    gap: 20px;
}
@media (min-width: 640px) { .staff-container { gap: 24px; } }
@media (min-width: 768px) { .staff-container { grid-template-columns: repeat(2, 1fr); } }
@media (min-width: 1200px) { .staff-container { grid-template-columns: repeat(3, 1fr); } }

/* ── STAFF CARD ── */
.staff-card {
    background: var(--surface);
    border: 1.5px solid var(--border);
    border-radius: var(--r-xl);
    overflow: hidden;
    transition: all 0.2s;
    animation: fadeInUp 0.4s ease-out;
}
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
.staff-card:hover {
    transform: translateY(-4px);
    border-color: var(--border-md);
    box-shadow: 0 8px 24px rgba(12, 14, 20, 0.08);
}

.card-header {
    padding: 20px;
    display: flex;
    gap: 14px;
    border-bottom: 1px solid var(--border);
    background: linear-gradient(135deg, var(--surface), var(--surface-2));
}
@media (min-width: 640px) { .card-header { padding: 24px; gap: 16px; } }

.staff-avatar {
    width: 52px; height: 52px;
    border-radius: var(--r-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    font-weight: 700;
    font-size: 1.1rem;
    transition: transform 0.2s;
}
@media (min-width: 640px) { .staff-avatar { width: 60px; height: 60px; font-size: 1.25rem; } }
.staff-card:hover .staff-avatar { transform: scale(1.05); }
.staff-avatar-admin { background: linear-gradient(135deg, var(--blue), var(--blue-2)); color: white; }
.staff-avatar-staff { background: linear-gradient(135deg, var(--green), #047857); color: white; }
.staff-avatar-user { background: linear-gradient(135deg, var(--amber), #b45309); color: white; }

.staff-info { flex: 1; }
.staff-name {
    font-family: 'Sora', sans-serif;
    font-size: 1rem; font-weight: 700;
    color: var(--ink);
    margin-bottom: 4px;
}
@media (min-width: 640px) { .staff-name { font-size: 1.125rem; margin-bottom: 6px; } }
.staff-email {
    font-size: 0.7rem; color: var(--ink-4);
    margin-bottom: 8px;
    word-break: break-all;
}
@media (min-width: 640px) { .staff-email { font-size: 0.75rem; margin-bottom: 10px; } }
.staff-meta {
    display: flex;
    flex-direction: column;
    gap: 2px;
    font-size: 0.6rem;
    color: var(--ink-4);
}
@media (min-width: 640px) { .staff-meta { flex-direction: row; gap: 12px; font-size: 0.65rem; } }
.staff-meta span { display: inline-flex; align-items: center; gap: 4px; }

.role-badge {
    padding: 4px 12px;
    border-radius: 99px;
    font-size: 0.65rem; font-weight: 700;
    height: fit-content;
    text-transform: uppercase;
    letter-spacing: 0.3px;
}
@media (min-width: 640px) { .role-badge { padding: 6px 14px; font-size: 0.7rem; } }
.role-admin { background: var(--blue-bg); color: var(--blue); }
.role-staff { background: var(--green-bg); color: var(--green); }
.role-user { background: var(--amber-bg); color: var(--amber); }

/* Card Body */
.card-body {
    padding: 16px 20px;
}
@media (min-width: 640px) { .card-body { padding: 20px 24px; } }
.info-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px 0;
}
.info-row:first-child { border-bottom: 1px solid var(--border); margin-bottom: 8px; }
.info-row span:first-child {
    font-size: 0.7rem; color: var(--ink-4); font-weight: 500;
}
@media (min-width: 640px) { .info-row span:first-child { font-size: 0.75rem; } }
.info-row span:last-child {
    font-size: 0.7rem; font-weight: 600; color: var(--ink-2);
}
@media (min-width: 640px) { .info-row span:last-child { font-size: 0.75rem; } }

.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 3px 12px;
    border-radius: 99px;
    font-size: 0.65rem; font-weight: 600;
}
@media (min-width: 640px) { .status-badge { padding: 4px 14px; font-size: 0.7rem; } }
.status-badge.verified { background: var(--green-bg); color: var(--green); }
.status-badge.pending { background: var(--amber-bg); color: var(--amber); }
.status-badge .dot {
    width: 6px; height: 6px;
    border-radius: 50%;
    background: currentColor;
}
@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}
.status-badge.pending .dot { animation: pulse 1.5s infinite; }

/* Card Footer */
.card-footer {
    display: flex;
    gap: 10px;
    padding: 14px 20px;
    background: var(--surface-2);
    border-top: 1px solid var(--border);
}
@media (min-width: 640px) {
    .card-footer { gap: 12px; padding: 16px 24px; }
}
.btn-edit, .btn-delete {
    flex: 1;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    padding: 8px 12px;
    border-radius: var(--r-md);
    font-size: 0.7rem; font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    text-decoration: none;
    border: 1.5px solid transparent;
}
@media (min-width: 640px) {
    .btn-edit, .btn-delete { gap: 8px; padding: 10px 16px; font-size: 0.75rem; }
}
.btn-edit {
    background: var(--surface);
    color: var(--ink-2);
    border-color: var(--border-md);
}
.btn-edit:hover {
    background: var(--surface-3);
    border-color: var(--ink-4);
}
.btn-delete {
    background: var(--surface);
    color: var(--red);
    border-color: var(--border-md);
}
.btn-delete:hover {
    background: var(--red-bg);
    border-color: var(--red);
}
.delete-form { flex: 1; }
.delete-form button { width: 100%; }

/* Empty State */
.empty-state {
    grid-column: 1 / -1;
    text-align: center;
    padding: 60px 20px;
    background: var(--surface);
    border: 1.5px solid var(--border);
    border-radius: var(--r-2xl);
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

/* Touch-friendly for mobile */
@media (max-width: 640px) {
    .filter-chip, .btn-edit, .btn-delete, .btn-create {
        touch-action: manipulation;
    }
    .search-field {
        font-size: 16px;
    }
}
</style>

<div class="staff-dashboard">
    
    {{-- BREADCRUMB --}}
    <div class="sc-crumb">
        <a href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <i class="fas fa-chevron-right"></i>
        <span>Manajemen Staff</span>
    </div>

    {{-- HEADER --}}
    <div class="dashboard-header">
        <div class="header-left">
            <div class="header-icon">
                <i class="fas fa-users" style="font-size: 1.25rem;"></i>
            </div>
            <div>
                <h1 class="dashboard-title">Manajemen Staff</h1>
                <p class="dashboard-subtitle">Kelola akses dan verifikasi staff Anda</p>
            </div>
        </div>
        <a href="{{ route('admin.staff.create') }}" class="btn-create">
            <i class="fas fa-plus"></i> Tambah Staff
        </a>
    </div>

    {{-- ALERT --}}
    @if(session('status'))
        <div class="alert" id="statusAlert">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('status') }}</span>
            <button class="alert-close" onclick="this.parentElement.remove()">×</button>
        </div>
    @endif

    {{-- STATS CARDS --}}
    <div class="stats-wrapper">
        <div class="stat-card">
            <div class="stat-icon stat-icon-primary">
                <i class="fas fa-user-friends" style="font-size: 1.25rem;"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $staffs->count() }}</div>
                <div class="stat-label">Total Staff</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon stat-icon-success">
                <i class="fas fa-check-circle" style="font-size: 1.25rem;"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $staffs->whereNotNull('email_verified_at')->count() }}</div>
                <div class="stat-label">Terverifikasi</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon stat-icon-warning">
                <i class="fas fa-clock" style="font-size: 1.25rem;"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $staffs->whereNull('email_verified_at')->count() }}</div>
                <div class="stat-label">Belum Verifikasi</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon stat-icon-info">
                <i class="fas fa-chart-line" style="font-size: 1.25rem;"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ number_format(($staffs->whereNotNull('email_verified_at')->count() / max($staffs->count(), 1)) * 100, 0) }}%</div>
                <div class="stat-label">Aktivasi Rate</div>
            </div>
        </div>
    </div>

    {{-- FILTER & SEARCH --}}
    <div class="control-bar">
        <div class="filter-group">
            <button class="filter-chip active" data-filter="all">Semua Staff</button>
            <button class="filter-chip" data-filter="verified">Terverifikasi</button>
            <button class="filter-chip" data-filter="unverified">Belum Verifikasi</button>
        </div>
        <div class="search-area">
            <i class="fas fa-search search-icon"></i>
            <input type="text" id="searchStaff" placeholder="Cari staff..." class="search-field">
        </div>
    </div>

    {{-- STAFF GRID --}}
    <div class="staff-container" id="staffContainer">
        @forelse($staffs as $staff)
        <div class="staff-card" data-status="{{ $staff->email_verified_at ? 'verified' : 'unverified' }}" 
             data-name="{{ strtolower($staff->name) }}" 
             data-email="{{ strtolower($staff->email) }}">
            
            <div class="card-header">
                <div class="staff-avatar staff-avatar-{{ $staff->role }}">
                    {{ strtoupper(substr($staff->name, 0, 2)) }}
                </div>
                <div class="staff-info">
                    <h3 class="staff-name">{{ $staff->name }}</h3>
                    <p class="staff-email">{{ $staff->email }}</p>
                    <div class="staff-meta">
                        <span><i class="fas fa-id-card"></i> #{{ str_pad($staff->id, 4, '0', STR_PAD_LEFT) }}</span>
                        <span><i class="far fa-calendar-alt"></i> {{ $staff->created_at->format('d M Y') }}</span>
                    </div>
                </div>
                <div class="role-badge role-{{ $staff->role }}">
                    {{ $staff->role === 'admin' ? 'Admin' : ($staff->role === 'staff' ? 'Staff' : 'User') }}
                </div>
            </div>
            
            <div class="card-body">
                <div class="info-row">
                    <span>Status Verifikasi</span>
                    @if($staff->email_verified_at)
                        <span class="status-badge verified">
                            <span class="dot"></span>
                            Terverifikasi
                        </span>
                    @else
                        <span class="status-badge pending">
                            <span class="dot"></span>
                            Menunggu Verifikasi
                        </span>
                    @endif
                </div>
                
                @if($staff->email_verified_at)
                <div class="info-row">
                    <span>Verifikasi Pada</span>
                    <span>{{ $staff->email_verified_at->format('d M Y') }}</span>
                </div>
                @endif
            </div>
            
            <div class="card-footer">
                <a href="{{ route('admin.staff.edit', $staff) }}" class="btn-edit">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <form action="{{ route('admin.staff.destroy', $staff) }}" method="POST" onsubmit="return confirm('Yakin hapus staff ini?')" class="delete-form">
                    @csrf 
                    @method('DELETE')
                    <button type="submit" class="btn-delete">
                        <i class="fas fa-trash-alt"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fas fa-user-friends"></i>
            </div>
            <h3>Belum Ada Staff</h3>
            <p>Tambahkan staff baru ke sistem</p>
            <a href="{{ route('admin.staff.create') }}" class="btn-create-empty">+ Tambah Staff</a>
        </div>
        @endforelse
    </div>
</div>

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

    // Filter functionality
    document.querySelectorAll('.filter-chip').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.filter-chip').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            const filter = this.dataset.filter;
            const cards = document.querySelectorAll('.staff-card');
            
            cards.forEach(card => {
                if (filter === 'all' || card.dataset.status === filter) {
                    card.style.display = '';
                    card.style.animation = 'fadeInUp 0.4s ease-out';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

    // Search functionality with debounce
    let searchTimeout;
    const searchInput = document.getElementById('searchStaff');

    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            clearTimeout(searchTimeout);
            
            searchTimeout = setTimeout(() => {
                const searchTerm = e.target.value.toLowerCase();
                const cards = document.querySelectorAll('.staff-card');
                let hasVisible = false;
                
                cards.forEach(card => {
                    const name = card.dataset.name || '';
                    const email = card.dataset.email || '';
                    const matches = name.includes(searchTerm) || email.includes(searchTerm);
                    
                    if (matches) {
                        card.style.display = '';
                        card.style.animation = 'fadeInUp 0.4s ease-out';
                        hasVisible = true;
                    } else {
                        card.style.display = 'none';
                    }
                });
            }, 300);
        });
    }

    // Delete confirmation enhancement
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!confirm('Apakah Anda yakin ingin menghapus staff ini? Tindakan ini tidak dapat dibatalkan.')) {
                e.preventDefault();
            }
        });
    });

    // Fix for iOS zoom on input focus
    const inputs = document.querySelectorAll('.search-field, .filter-chip');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            if (window.innerWidth < 768) {
                setTimeout(() => {
                    input.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }, 300);
            }
        });
    });
});
</script>
@endsection
@extends('layouts.admin')

@section('content')
<div class="staff-dashboard">
    <!-- Header Section -->
    <div class="dashboard-header">
        <div class="header-left">
            <div class="header-icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
            </div>
            <div>
                <h1 class="dashboard-title">Manajemen Staff</h1>
                <p class="dashboard-subtitle">Kelola akses dan verifikasi staff Anda</p>
            </div>
        </div>
        <a href="{{ route('admin.staff.create') }}" class="btn-create">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 5v14M5 12h14"/>
            </svg>
            Tambah Staff
        </a>
    </div>

    <!-- Alert -->
    @if(session('status'))
        <div class="alert alert-success" id="statusAlert">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                <polyline points="22 4 12 14.01 9 11.01"/>
            </svg>
            <span>{{ session('status') }}</span>
            <button class="alert-close" onclick="this.parentElement.remove()">×</button>
        </div>
    @endif

    <!-- Stats Cards -->
    <div class="stats-wrapper">
        <div class="stat-card">
            <div class="stat-icon stat-icon-primary">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $staffs->count() }}</div>
                <div class="stat-label">Total Staff</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon stat-icon-success">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                    <polyline points="22 4 12 14.01 9 11.01"/>
                </svg>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $staffs->whereNotNull('email_verified_at')->count() }}</div>
                <div class="stat-label">Terverifikasi</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon stat-icon-warning">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="12" y1="8" x2="12" y2="12"/>
                    <line x1="12" y1="16" x2="12.01" y2="16"/>
                </svg>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $staffs->whereNull('email_verified_at')->count() }}</div>
                <div class="stat-label">Belum Verifikasi</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon stat-icon-info">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/>
                </svg>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ number_format(($staffs->whereNotNull('email_verified_at')->count() / max($staffs->count(), 1)) * 100, 0) }}%</div>
                <div class="stat-label">Aktivasi Rate</div>
            </div>
        </div>
    </div>

    <!-- Filter & Search -->
    <div class="control-bar">
        <div class="filter-group">
            <button class="filter-chip active" data-filter="all">Semua Staff</button>
            <button class="filter-chip" data-filter="verified">Terverifikasi</button>
            <button class="filter-chip" data-filter="unverified">Belum Verifikasi</button>
        </div>
        <div class="search-area">
            <svg class="search-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <circle cx="11" cy="11" r="8"/>
                <line x1="21" y1="21" x2="16.65" y2="16.65"/>
            </svg>
            <input type="text" id="searchStaff" placeholder="Cari staff..." class="search-field">
        </div>
    </div>

    <!-- Staff Grid -->
    <div class="staff-container" id="staffContainer">
        @forelse($staffs as $staff)
        <div class="staff-card" data-status="{{ $staff->email_verified_at ? 'verified' : 'unverified' }}" 
             data-name="{{ strtolower($staff->name) }}" 
             data-email="{{ strtolower($staff->email) }}">
            
            <div class="card-header">
                <div class="staff-avatar staff-avatar-{{ $staff->role }}">
                    <span>{{ strtoupper(substr($staff->name, 0, 2)) }}</span>
                </div>
                <div class="staff-info">
                    <h3 class="staff-name">{{ $staff->name }}</h3>
                    <p class="staff-email">{{ $staff->email }}</p>
                    <div class="staff-meta">
                        <span>ID: #{{ str_pad($staff->id, 4, '0', STR_PAD_LEFT) }}</span>
                        <span>Bergabung: {{ $staff->created_at->format('d M Y') }}</span>
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
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path d="M17 3l4 4-7 7H10v-4l7-7z"/>
                        <path d="M4 20h16"/>
                    </svg>
                    Edit
                </a>
                <form action="{{ route('admin.staff.destroy', $staff) }}" method="POST" onsubmit="return confirm('Yakin hapus staff ini?')" class="delete-form">
                    @csrf 
                    @method('DELETE')
                    <button type="submit" class="btn-delete">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <polyline points="3 6 5 6 21 6"/>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                        </svg>
                        Hapus
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="empty-state">
            <div class="empty-icon">
                <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
            </div>
            <h3>Belum Ada Staff</h3>
            <p>Tambahkan staff baru ke sistem</p>
            <a href="{{ route('admin.staff.create') }}" class="btn-create-empty">+ Tambah Staff</a>
        </div>
        @endforelse
    </div>
</div>

<style>
/* ============================================
   CLEAN & MODERN STAFF MANAGEMENT
   Focus on Visual Appearance Only
   ============================================ */

:root {
    --blue-50: #eff6ff;
    --blue-100: #dbeafe;
    --blue-500: #3b82f6;
    --blue-600: #2563eb;
    --blue-700: #1d4ed8;
    --green-50: #f0fdf4;
    --green-500: #22c55e;
    --green-600: #16a34a;
    --orange-50: #fff7ed;
    --orange-500: #f97316;
    --red-50: #fef2f2;
    --red-500: #ef4444;
    --red-600: #dc2626;
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
}

/* Main Container */
.staff-dashboard {
    max-width: 1400px;
    margin: 0 auto;
    padding: 32px;
    background: var(--gray-50);
    min-height: 100vh;
}

/* Header */
.dashboard-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 32px;
    flex-wrap: wrap;
    gap: 20px;
}

.header-left {
    display: flex;
    align-items: center;
    gap: 16px;
}

.header-icon {
    width: 52px;
    height: 52px;
    background: var(--blue-600);
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}

.dashboard-title {
    font-size: 28px;
    font-weight: 700;
    color: var(--gray-800);
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
    padding: 10px 22px;
    background: var(--blue-600);
    color: white;
    border: none;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s;
}

.btn-create:hover {
    background: var(--blue-700);
    transform: translateY(-1px);
}

/* Alert */
.alert {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px 20px;
    border-radius: 12px;
    margin-bottom: 24px;
    background: var(--green-50);
    border-left: 4px solid var(--green-500);
    color: var(--green-600);
}

.alert-close {
    margin-left: auto;
    background: none;
    border: none;
    font-size: 24px;
    cursor: pointer;
    color: inherit;
    opacity: 0.6;
}

.alert-close:hover {
    opacity: 1;
}

/* Stats Cards */
.stats-wrapper {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin-bottom: 32px;
}

.stat-card {
    background: white;
    border-radius: 16px;
    padding: 20px;
    display: flex;
    align-items: center;
    gap: 16px;
    border: 1px solid var(--gray-200);
    transition: all 0.2s;
}

.stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    border-color: transparent;
}

.stat-icon {
    width: 52px;
    height: 52px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.stat-icon-primary {
    background: var(--blue-100);
    color: var(--blue-600);
}

.stat-icon-success {
    background: var(--green-50);
    color: var(--green-500);
}

.stat-icon-warning {
    background: var(--orange-50);
    color: var(--orange-500);
}

.stat-icon-info {
    background: var(--blue-100);
    color: var(--blue-500);
}

.stat-content {
    flex: 1;
}

.stat-value {
    font-size: 32px;
    font-weight: 700;
    color: var(--gray-800);
    line-height: 1.2;
    margin-bottom: 4px;
}

.stat-label {
    font-size: 12px;
    font-weight: 500;
    color: var(--gray-500);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Control Bar */
.control-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 32px;
    flex-wrap: wrap;
    gap: 20px;
    background: white;
    padding: 12px 20px;
    border-radius: 14px;
    border: 1px solid var(--gray-200);
}

.filter-group {
    display: flex;
    gap: 8px;
}

.filter-chip {
    padding: 8px 18px;
    background: white;
    border: 1px solid var(--gray-200);
    border-radius: 40px;
    font-size: 13px;
    font-weight: 500;
    color: var(--gray-600);
    cursor: pointer;
    transition: all 0.2s;
}

.filter-chip:hover {
    border-color: var(--blue-500);
    color: var(--blue-600);
}

.filter-chip.active {
    background: var(--blue-600);
    border-color: var(--blue-600);
    color: white;
}

.search-area {
    position: relative;
    min-width: 260px;
}

.search-icon {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--gray-400);
}

.search-field {
    width: 100%;
    padding: 10px 14px 10px 42px;
    border: 1px solid var(--gray-200);
    border-radius: 40px;
    font-size: 14px;
    transition: all 0.2s;
}

.search-field:focus {
    outline: none;
    border-color: var(--blue-500);
    box-shadow: 0 0 0 3px var(--blue-100);
}

/* Staff Grid */
.staff-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
    gap: 24px;
}

/* Staff Card */
.staff-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    border: 1px solid var(--gray-200);
    transition: all 0.3s;
}

.staff-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 24px rgba(0,0,0,0.1);
    border-color: transparent;
}

/* Card Header */
.card-header {
    padding: 20px;
    display: flex;
    gap: 16px;
    border-bottom: 1px solid var(--gray-100);
    position: relative;
}

.staff-avatar {
    width: 56px;
    height: 56px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.staff-avatar-admin {
    background: linear-gradient(135deg, var(--blue-500), var(--blue-600));
    color: white;
    font-size: 20px;
    font-weight: 600;
}

.staff-avatar-staff {
    background: linear-gradient(135deg, var(--green-500), var(--green-600));
    color: white;
    font-size: 20px;
    font-weight: 600;
}

.staff-avatar-user {
    background: linear-gradient(135deg, var(--orange-500), #ea580c);
    color: white;
    font-size: 20px;
    font-weight: 600;
}

.staff-info {
    flex: 1;
}

.staff-name {
    font-size: 16px;
    font-weight: 600;
    color: var(--gray-800);
    margin: 0 0 4px 0;
}

.staff-email {
    font-size: 13px;
    color: var(--gray-500);
    margin: 0 0 8px 0;
}

.staff-meta {
    display: flex;
    gap: 12px;
    font-size: 11px;
    color: var(--gray-400);
}

.staff-meta span {
    display: inline-flex;
    align-items: center;
    gap: 4px;
}

.role-badge {
    padding: 6px 12px;
    border-radius: 30px;
    font-size: 11px;
    font-weight: 600;
    height: fit-content;
}

.role-admin {
    background: var(--blue-100);
    color: var(--blue-700);
}

.role-staff {
    background: var(--green-50);
    color: var(--green-600);
}

.role-user {
    background: var(--orange-50);
    color: var(--orange-500);
}

/* Card Body */
.card-body {
    padding: 20px;
}

.info-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid var(--gray-100);
}

.info-row:last-child {
    border-bottom: none;
}

.info-row span:first-child {
    font-size: 13px;
    color: var(--gray-500);
}

.info-row span:last-child {
    font-size: 13px;
    font-weight: 500;
    color: var(--gray-700);
}

.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 4px 12px;
    border-radius: 30px;
    font-size: 12px;
    font-weight: 500;
}

.status-badge.verified {
    background: var(--green-50);
    color: var(--green-600);
}

.status-badge.pending {
    background: var(--orange-50);
    color: var(--orange-500);
}

.status-badge .dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: currentColor;
}

/* Card Footer */
.card-footer {
    display: flex;
    gap: 12px;
    padding: 16px 20px;
    background: var(--gray-50);
    border-top: 1px solid var(--gray-100);
}

.btn-edit, .btn-delete {
    flex: 1;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 8px 16px;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s;
    text-decoration: none;
    border: 1px solid transparent;
}

.btn-edit {
    background: white;
    color: var(--gray-700);
    border-color: var(--gray-200);
}

.btn-edit:hover {
    background: var(--gray-100);
    border-color: var(--gray-300);
}

.btn-delete {
    background: white;
    color: var(--red-500);
    border-color: var(--gray-200);
}

.btn-delete:hover {
    background: var(--red-50);
    border-color: var(--red-200);
    color: var(--red-600);
}

.delete-form {
    flex: 1;
}

.delete-form button {
    width: 100%;
}

/* Empty State */
.empty-state {
    grid-column: 1 / -1;
    text-align: center;
    padding: 80px 20px;
    background: white;
    border-radius: 20px;
    border: 1px solid var(--gray-200);
}

.empty-icon {
    margin-bottom: 24px;
    color: var(--gray-300);
}

.empty-state h3 {
    font-size: 20px;
    font-weight: 600;
    color: var(--gray-800);
    margin-bottom: 8px;
}

.empty-state p {
    font-size: 14px;
    color: var(--gray-500);
    margin-bottom: 24px;
}

.btn-create-empty {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 24px;
    background: var(--blue-600);
    color: white;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.2s;
}

.btn-create-empty:hover {
    background: var(--blue-700);
    transform: translateY(-2px);
}

/* Responsive */
@media (max-width: 1024px) {
    .staff-dashboard {
        padding: 24px;
    }
}

@media (max-width: 768px) {
    .staff-dashboard {
        padding: 20px;
    }
    
    .stats-wrapper {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .staff-container {
        grid-template-columns: 1fr;
    }
    
    .control-bar {
        flex-direction: column;
        align-items: stretch;
    }
    
    .filter-group {
        justify-content: center;
    }
    
    .search-area {
        width: 100%;
    }
}

@media (max-width: 480px) {
    .staff-dashboard {
        padding: 16px;
    }
    
    .stats-wrapper {
        grid-template-columns: 1fr;
    }
    
    .dashboard-header {
        flex-direction: column;
        text-align: center;
    }
    
    .header-left {
        flex-direction: column;
    }
    
    .card-header {
        flex-wrap: wrap;
    }
    
    .role-badge {
        width: 100%;
        text-align: center;
    }
    
    .card-footer {
        flex-direction: column;
    }
}
</style>

<script>
// Auto dismiss alert
const alertEl = document.getElementById('statusAlert');
if (alertEl) {
    setTimeout(() => {
        alertEl.style.opacity = '0';
        setTimeout(() => alertEl.remove(), 300);
    }, 4000);
}

// Filter
document.querySelectorAll('.filter-chip').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.filter-chip').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        
        const filter = this.dataset.filter;
        document.querySelectorAll('.staff-card').forEach(card => {
            if (filter === 'all' || card.dataset.status === filter) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    });
});

// Search
const searchInput = document.getElementById('searchStaff');
if (searchInput) {
    searchInput.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        document.querySelectorAll('.staff-card').forEach(card => {
            const name = card.dataset.name || '';
            const email = card.dataset.email || '';
            card.style.display = name.includes(searchTerm) || email.includes(searchTerm) ? '' : 'none';
        });
    });
}
</script>
@endsection
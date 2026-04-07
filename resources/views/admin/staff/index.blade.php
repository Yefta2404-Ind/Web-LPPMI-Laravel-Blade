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
   MODERN & RESPONSIVE STAFF MANAGEMENT
   Enhanced Layout & Visual Design
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

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Main Container */
.staff-dashboard {
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

/* Control Bar */
.control-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 32px;
    flex-wrap: wrap;
    gap: 20px;
    background: white;
    padding: 16px 24px;
    border-radius: 20px;
    border: 1px solid var(--gray-200);
    box-shadow: var(--shadow-sm);
}

.filter-group {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}

.filter-chip {
    padding: 8px 20px;
    background: white;
    border: 1px solid var(--gray-200);
    border-radius: 40px;
    font-size: 13px;
    font-weight: 600;
    color: var(--gray-600);
    cursor: pointer;
    transition: all 0.3s;
}

.filter-chip:hover {
    border-color: var(--primary);
    color: var(--primary);
    transform: translateY(-1px);
}

.filter-chip.active {
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    border-color: transparent;
    color: white;
    box-shadow: var(--shadow-sm);
}

.search-area {
    position: relative;
    min-width: 280px;
}

.search-icon {
    position: absolute;
    left: 16px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--gray-400);
}

.search-field {
    width: 100%;
    padding: 10px 16px 10px 44px;
    border: 1px solid var(--gray-200);
    border-radius: 40px;
    font-size: 14px;
    transition: all 0.3s;
}

.search-field:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
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
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    animation: fadeInUp 0.5s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.staff-card:hover {
    transform: translateY(-6px);
    box-shadow: var(--shadow-xl);
    border-color: transparent;
}

/* Card Header */
.card-header {
    padding: 24px;
    display: flex;
    gap: 16px;
    border-bottom: 1px solid var(--gray-100);
    position: relative;
    background: linear-gradient(135deg, #ffffff, var(--gray-50));
}

.staff-avatar {
    width: 64px;
    height: 64px;
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    font-weight: 700;
    font-size: 22px;
    transition: transform 0.3s;
}

.staff-card:hover .staff-avatar {
    transform: scale(1.05);
}

.staff-avatar-admin {
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    color: white;
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
}

.staff-avatar-staff {
    background: linear-gradient(135deg, var(--success), #059669);
    color: white;
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
}

.staff-avatar-user {
    background: linear-gradient(135deg, var(--warning), #d97706);
    color: white;
    box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
}

.staff-info {
    flex: 1;
}

.staff-name {
    font-size: 18px;
    font-weight: 700;
    color: var(--gray-800);
    margin: 0 0 6px 0;
}

.staff-email {
    font-size: 13px;
    color: var(--gray-500);
    margin: 0 0 10px 0;
    word-break: break-all;
}

.staff-meta {
    display: flex;
    gap: 16px;
    font-size: 11px;
    color: var(--gray-400);
}

.staff-meta span {
    display: inline-flex;
    align-items: center;
    gap: 4px;
}

.role-badge {
    padding: 6px 14px;
    border-radius: 30px;
    font-size: 11px;
    font-weight: 700;
    height: fit-content;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.role-admin {
    background: linear-gradient(135deg, var(--primary-light), #dbeafe);
    color: var(--primary-dark);
}

.role-staff {
    background: linear-gradient(135deg, var(--success-light), #d1fae5);
    color: #059669;
}

.role-user {
    background: linear-gradient(135deg, var(--warning-light), #fef3c7);
    color: #d97706;
}

/* Card Body */
.card-body {
    padding: 20px 24px;
}

.info-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid var(--gray-100);
}

.info-row:last-child {
    border-bottom: none;
}

.info-row span:first-child {
    font-size: 13px;
    color: var(--gray-500);
    font-weight: 500;
}

.info-row span:last-child {
    font-size: 13px;
    font-weight: 600;
    color: var(--gray-700);
}

.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 4px 14px;
    border-radius: 30px;
    font-size: 12px;
    font-weight: 600;
}

.status-badge.verified {
    background: linear-gradient(135deg, var(--success-light), #d1fae5);
    color: #059669;
}

.status-badge.pending {
    background: linear-gradient(135deg, var(--warning-light), #fef3c7);
    color: #d97706;
}

.status-badge .dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: currentColor;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.5;
    }
}

/* Card Footer */
.card-footer {
    display: flex;
    gap: 12px;
    padding: 16px 24px;
    background: var(--gray-50);
    border-top: 1px solid var(--gray-100);
}

.btn-edit, .btn-delete {
    flex: 1;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 10px 16px;
    border-radius: 12px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
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
    transform: translateY(-1px);
}

.btn-delete {
    background: white;
    color: var(--danger);
    border-color: var(--gray-200);
}

.btn-delete:hover {
    background: var(--danger-light);
    border-color: var(--danger);
    transform: translateY(-1px);
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
    animation: fadeInUp 0.5s ease-out;
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

/* Responsive Design */
@media (max-width: 1280px) {
    .staff-dashboard {
        padding: 24px;
    }
}

@media (max-width: 1024px) {
    .staff-container {
        grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
    }
}

@media (max-width: 768px) {
    .staff-dashboard {
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
    
    .dashboard-title {
        font-size: 24px;
    }
}

@media (max-width: 640px) {
    .staff-dashboard {
        padding: 16px;
    }
    
    .stats-wrapper {
        grid-template-columns: 1fr;
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
    
    .staff-name {
        font-size: 16px;
    }
    
    .stat-value {
        font-size: 28px;
    }
}

@media (max-width: 480px) {
    .staff-dashboard {
        padding: 12px;
    }
    
    .dashboard-header {
        padding: 16px;
    }
    
    .header-icon {
        width: 48px;
        height: 48px;
    }
    
    .staff-avatar {
        width: 56px;
        height: 56px;
        font-size: 18px;
    }
    
    .staff-meta {
        flex-direction: column;
        gap: 4px;
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
                card.style.animation = 'fadeInUp 0.5s ease-out';
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
            
            cards.forEach(card => {
                const name = card.dataset.name || '';
                const email = card.dataset.email || '';
                const matches = name.includes(searchTerm) || email.includes(searchTerm);
                
                if (matches) {
                    card.style.display = '';
                    card.style.animation = 'fadeInUp 0.5s ease-out';
                } else {
                    card.style.display = 'none';
                }
            });
        }, 300);
    });
}

// Add loading animation for delete confirmation
document.querySelectorAll('.delete-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        if (!confirm('Apakah Anda yakin ingin menghapus staff ini? Tindakan ini tidak dapat dibatalkan.')) {
            e.preventDefault();
        }
    });
});
</script>
@endsection
@extends('layouts.admin')

@section('content')
<div class="staff-page">
    <!-- Header -->
    <div class="staff-header">
        <div class="header-left">
            <h1 class="staff-title">👥 Kelola Staff</h1>
            <p class="staff-subtitle">{{ $staffs->count() }} staff terdaftar</p>
        </div>
        <a href="{{ route('admin.staff.create') }}" class="btn-primary">
            + Tambah Staff
        </a>
    </div>

    <!-- Alert -->
    @if(session('status'))
        <div class="alert" id="statusAlert">
            <span>✅</span>
            <span>{{ session('status') }}</span>
            <button class="alert-close" onclick="this.parentElement.remove()">×</button>
        </div>
    @endif

    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card blue">
            <div class="stat-value">{{ $staffs->count() }}</div>
            <div class="stat-label">Total Staff</div>
        </div>
        <div class="stat-card red">
            <div class="stat-value">{{ $staffs->whereNotNull('email_verified_at')->count() }}</div>
            <div class="stat-label">Terverifikasi</div>
        </div>
        <div class="stat-card yellow">
            <div class="stat-value">{{ $staffs->whereNull('email_verified_at')->count() }}</div>
            <div class="stat-label">Belum Verifikasi</div>
        </div>
    </div>

    <!-- Filters -->
    <div class="filters">
        <div class="filter-group">
            <button class="filter-btn blue active" data-filter="all">Semua</button>
            <button class="filter-btn red" data-filter="verified">Terverifikasi</button>
            <button class="filter-btn yellow" data-filter="unverified">Belum Verifikasi</button>
        </div>
        <input type="text" id="search" placeholder="Cari nama atau email..." class="search-input">
    </div>

    <!-- Staff Cards Grid -->
    <div class="staff-grid" id="staffGrid">
        @forelse($staffs as $staff)
        <div class="staff-card" data-status="{{ $staff->email_verified_at ? 'verified' : 'unverified' }}">
            <!-- Card Header -->
            <div class="card-header role-{{ $staff->role }}">
                <div class="staff-avatar">{{ substr($staff->name, 0, 1) }}</div>
                <div class="staff-info">
                    <div class="staff-name">{{ $staff->name }}</div>
                    <div class="staff-email">{{ $staff->email }}</div>
                </div>
                <div class="staff-role">{{ $staff->role }}</div>
            </div>

            <!-- Card Body -->
            <div class="card-body">
                <div class="info-row">
                    <span>Status</span>
                    @if($staff->email_verified_at)
                        <span class="badge blue">Terverifikasi</span>
                    @else
                        <span class="badge red">Belum Verifikasi</span>
                    @endif
                </div>
                
                @if($staff->email_verified_at)
                <div class="info-row">
                    <span>Verifikasi</span>
                    <span>{{ $staff->email_verified_at->format('d/m/Y') }}</span>
                </div>
                @endif
                
                <div class="info-row">
                    <span>Bergabung</span>
                    <span>{{ $staff->created_at->format('d/m/Y') }}</span>
                </div>
                
                <div class="info-row">
                    <span>ID</span>
                    <span>#{{ $staff->id }}</span>
                </div>
            </div>

            <!-- Card Footer -->
            <div class="card-footer">
                <a href="{{ route('admin.staff.edit', $staff) }}" class="btn-edit">
                    ✏️ Edit
                </a>
                <form action="{{ route('admin.staff.destroy', $staff) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-delete">
                        🗑️ Hapus
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="empty-state">
            <div class="empty-icon">👥</div>
            <h3>Belum Ada Staff</h3>
            <a href="{{ route('admin.staff.create') }}" class="btn-primary">Tambah Staff</a>
        </div>
        @endforelse
    </div>
</div>

<style>
/* ===== VARIABLES ===== */
:root {
    --blue: #0066CC;
    --blue-light: #E6F0FF;
    --red: #CC0000;
    --red-light: #FFE6E6;
    --yellow: #FFCC00;
    --yellow-light: #FFF7E6;
    --gray: #666666;
    --gray-light: #F5F5F5;
    --gray-border: #DDDDDD;
    --white: #FFFFFF;
    --black: #333333;
}

/* ===== BASE ===== */
.staff-page {
    max-width: 1280px;
    margin: 0 auto;
    padding: 20px;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    background: var(--gray-light);
    min-height: 100vh;
}

/* ===== HEADER ===== */
.staff-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    flex-wrap: wrap;
    gap: 15px;
    background: var(--white);
    padding: 20px;
    border: 1px solid var(--gray-border);
    border-radius: 4px;
}

.staff-title {
    font-size: 24px;
    font-weight: 600;
    color: var(--black);
    margin: 0 0 5px 0;
}

.staff-subtitle {
    font-size: 14px;
    color: var(--gray);
    margin: 0;
}

.btn-primary {
    display: inline-block;
    padding: 10px 20px;
    background: var(--blue);
    color: var(--white);
    border: none;
    border-radius: 4px;
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
    cursor: pointer;
}

.btn-primary:hover {
    background: #0052a3;
}

/* ===== ALERT ===== */
.alert {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 16px;
    background: var(--yellow-light);
    border: 1px solid var(--yellow);
    border-radius: 4px;
    color: var(--black);
    margin-bottom: 20px;
}

.alert-close {
    margin-left: auto;
    background: none;
    border: none;
    font-size: 20px;
    cursor: pointer;
    color: var(--gray);
}

/* ===== STATS CARDS ===== */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 15px;
    margin-bottom: 20px;
}

.stat-card {
    padding: 20px;
    border: 1px solid var(--gray-border);
    border-radius: 4px;
    background: var(--white);
    text-align: center;
}

.stat-card.blue { border-left: 4px solid var(--blue); }
.stat-card.red { border-left: 4px solid var(--red); }
.stat-card.yellow { border-left: 4px solid var(--yellow); }

.stat-value {
    font-size: 32px;
    font-weight: 600;
    color: var(--black);
    line-height: 1.2;
}

.stat-label {
    font-size: 13px;
    color: var(--gray);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* ===== FILTERS ===== */
.filters {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    flex-wrap: wrap;
    gap: 15px;
    background: var(--white);
    padding: 15px 20px;
    border: 1px solid var(--gray-border);
    border-radius: 4px;
}

.filter-group {
    display: flex;
    gap: 5px;
    flex-wrap: wrap;
}

.filter-btn {
    padding: 6px 12px;
    border: 1px solid var(--gray-border);
    border-radius: 4px;
    background: var(--white);
    font-size: 13px;
    color: var(--gray);
    cursor: pointer;
}

.filter-btn.blue.active {
    background: var(--blue);
    color: var(--white);
    border-color: var(--blue);
}

.filter-btn.red.active {
    background: var(--red);
    color: var(--white);
    border-color: var(--red);
}

.filter-btn.yellow.active {
    background: var(--yellow);
    color: var(--black);
    border-color: var(--yellow);
}

.search-input {
    min-width: 250px;
    padding: 8px 12px;
    border: 1px solid var(--gray-border);
    border-radius: 4px;
    font-size: 13px;
}

.search-input:focus {
    outline: none;
    border-color: var(--blue);
}

/* ===== STAFF GRID ===== */
.staff-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 20px;
}

/* Card */
.staff-card {
    background: var(--white);
    border: 1px solid var(--gray-border);
    border-radius: 4px;
    overflow: hidden;
}

/* Card Header */
.card-header {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 15px;
    background: #FAFAFA;
    border-bottom: 1px solid var(--gray-border);
}

.card-header.role-admin { background: var(--blue-light); }
.card-header.role-staff { background: var(--red-light); }
.card-header.role-user { background: var(--yellow-light); }

.staff-avatar {
    width: 40px;
    height: 40px;
    background: var(--white);
    border: 1px solid var(--gray-border);
    border-radius: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    color: var(--black);
}

.staff-info {
    flex: 1;
    min-width: 0;
}

.staff-name {
    font-weight: 600;
    color: var(--black);
    margin-bottom: 4px;
}

.staff-email {
    font-size: 12px;
    color: var(--gray);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.staff-role {
    font-size: 11px;
    font-weight: 500;
    padding: 4px 8px;
    background: var(--white);
    border: 1px solid var(--gray-border);
    border-radius: 4px;
    text-transform: uppercase;
}

/* Card Body */
.card-body {
    padding: 15px;
}

.info-row {
    display: flex;
    justify-content: space-between;
    padding: 8px 0;
    border-bottom: 1px dashed var(--gray-border);
    font-size: 13px;
}

.info-row:last-child {
    border-bottom: none;
}

.info-row span:first-child {
    color: var(--gray);
}

.info-row span:last-child {
    font-weight: 500;
    color: var(--black);
}

/* Badge */
.badge {
    padding: 2px 8px;
    border-radius: 4px;
    font-size: 11px;
    font-weight: 500;
}

.badge.blue {
    background: var(--blue-light);
    color: var(--blue);
}

.badge.red {
    background: var(--red-light);
    color: var(--red);
}

/* Card Footer */
.card-footer {
    display: flex;
    gap: 10px;
    padding: 15px;
    background: #FAFAFA;
    border-top: 1px solid var(--gray-border);
}

.btn-edit, .btn-delete {
    flex: 1;
    padding: 8px;
    border: 1px solid var(--gray-border);
    border-radius: 4px;
    font-size: 12px;
    font-weight: 500;
    text-align: center;
    cursor: pointer;
    text-decoration: none;
    background: var(--white);
}

.btn-edit:hover {
    background: var(--yellow-light);
    border-color: var(--yellow);
}

.btn-delete:hover {
    background: var(--red-light);
    border-color: var(--red);
}

/* ===== EMPTY STATE ===== */
.empty-state {
    grid-column: 1 / -1;
    text-align: center;
    padding: 60px 20px;
    background: var(--white);
    border: 1px solid var(--gray-border);
    border-radius: 4px;
}

.empty-icon {
    font-size: 48px;
    margin-bottom: 15px;
    opacity: 0.5;
}

.empty-state h3 {
    font-size: 18px;
    font-weight: 500;
    color: var(--gray);
    margin-bottom: 20px;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    .staff-page { padding: 15px; }
    .staff-header { flex-direction: column; }
    .btn-primary { width: 100%; text-align: center; }
    .filters { flex-direction: column; }
    .filter-group { width: 100%; }
    .filter-btn { flex: 1; }
    .search-input { width: 100%; }
    .staff-grid { grid-template-columns: 1fr; }
}

@media (max-width: 480px) {
    .staff-page { padding: 10px; }
    .stats-grid { grid-template-columns: 1fr; }
    .card-header { flex-wrap: wrap; }
    .staff-role { width: 100%; text-align: center; }
    .card-footer { flex-direction: column; }
}
</style>

<script>
// Auto hide alert
const alert = document.getElementById('statusAlert');
if (alert) {
    setTimeout(() => {
        alert.style.opacity = '0';
        setTimeout(() => alert.remove(), 300);
    }, 4000);
}

// Filter
document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        
        const filter = this.dataset.filter;
        document.querySelectorAll('.staff-card').forEach(card => {
            card.style.display = filter === 'all' || card.dataset.status === filter ? '' : 'none';
        });
    });
});

// Search
document.getElementById('search')?.addEventListener('input', function(e) {
    const search = e.target.value.toLowerCase();
    document.querySelectorAll('.staff-card').forEach(card => {
        const name = card.querySelector('.staff-name')?.textContent.toLowerCase() || '';
        const email = card.querySelector('.staff-email')?.textContent.toLowerCase() || '';
        card.style.display = name.includes(search) || email.includes(search) ? '' : 'none';
    });
});
</script>
@endsection
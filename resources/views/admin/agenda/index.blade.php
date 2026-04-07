@extends('layouts.admin')

@section('page-title', 'Manajemen Agenda')
@section('content')
<style>
    /* ========== VARIABEL ========== */
    :root {
        --primary: #2563eb;
        --primary-dark: #1d4ed8;
        --primary-light: #dbeafe;
        --success: #10b981;
        --success-light: #d1fae5;
        --warning: #f59e0b;
        --warning-light: #fef3c7;
        --danger: #ef4444;
        --danger-light: #fee2e2;
        --gray-50: #f8fafc;
        --gray-100: #f1f5f9;
        --gray-200: #e2e8f0;
        --gray-300: #cbd5e1;
        --gray-400: #94a3b8;
        --gray-500: #64748b;
        --gray-600: #475569;
        --gray-700: #334155;
        --gray-800: #1e293b;
        --gray-900: #0f172a;
        --radius: 1rem;
        --radius-sm: 0.75rem;
        --shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        --transition: all 0.2s ease;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Container utama - lebih lega di mobile */
    .admin-container {
        width: 100%;
        max-width: 1440px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    /* Layar kecil: tambah padding horizontal */
    @media (max-width: 640px) {
        .admin-container {
            padding: 0 0.875rem;
        }
    }
    @media (max-width: 480px) {
        .admin-container {
            padding: 0 1rem;
        }
    }
    @media (min-width: 1024px) {
        .admin-container {
            padding: 0 2rem;
        }
    }

    /* ========== HEADER ========== */
    .page-header {
        margin-bottom: 1.5rem;
    }
    .page-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--gray-900);
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-bottom: 0.5rem;
    }
    .page-description {
        color: var(--gray-500);
        font-size: 0.875rem;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 0.75rem;
    }
    @media (max-width: 480px) {
        .page-title {
            font-size: 1.25rem;
        }
        .page-description {
            font-size: 0.75rem;
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }
    }
    @media (min-width: 768px) {
        .page-title { font-size: 1.875rem; }
        .page-description { font-size: 0.95rem; }
    }

    /* ========== TAB STATUS ========== */
    .status-tabs {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
    }
    .status-tab {
        flex: 1 0 auto;
        min-width: 90px;
        padding: 0.625rem 1rem;
        border-radius: 2rem;
        font-size: 0.75rem;
        font-weight: 600;
        background: white;
        color: var(--gray-600);
        border: 1.5px solid var(--gray-200);
        transition: var(--transition);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        white-space: nowrap;
        cursor: pointer;
    }
    @media (max-width: 480px) {
        .status-tab {
            flex: 1;
            min-width: 70px;
            padding: 0.5rem 0.75rem;
            font-size: 0.7rem;
        }
        .status-tab i {
            font-size: 0.7rem;
        }
    }
    @media (min-width: 640px) {
        .status-tab { flex: none; padding: 0.625rem 1.5rem; font-size: 0.875rem; }
        .status-tab i { font-size: 0.875rem; }
    }

    /* ========== STATISTIK GRID ========== */
    .stats-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 0.75rem;
        margin-bottom: 1.5rem;
    }
    .stat-card {
        background: white;
        border-radius: var(--radius-sm);
        border: 1px solid var(--gray-200);
        padding: 1rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        transition: var(--transition);
        box-shadow: var(--shadow);
    }
    .stat-icon {
        width: 3rem;
        height: 3rem;
        border-radius: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        flex-shrink: 0;
    }
    .stat-content {
        flex: 1;
        min-width: 0;
    }
    .stat-label {
        font-size: 0.7rem;
        color: var(--gray-500);
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 0.25rem;
    }
    .stat-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--gray-900);
        line-height: 1.2;
    }
    .stat-sub {
        font-size: 0.65rem;
        color: var(--gray-500);
        margin-top: 0.25rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    @media (max-width: 480px) {
        .stat-card {
            padding: 0.875rem;
            gap: 0.75rem;
        }
        .stat-icon {
            width: 2.5rem;
            height: 2.5rem;
            font-size: 1rem;
        }
        .stat-value {
            font-size: 1.25rem;
        }
        .stat-label {
            font-size: 0.6rem;
        }
    }
    @media (min-width: 768px) {
        .stats-grid { grid-template-columns: repeat(3, 1fr); gap: 1.25rem; }
        .stat-card { padding: 1.5rem; }
        .stat-value { font-size: 1.75rem; }
    }

    /* ========== ALERT ========== */
    .alert {
        padding: 0.75rem 1rem;
        border-radius: var(--radius-sm);
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 0.875rem;
        border-left: 3px solid;
        background: white;
        animation: slideIn 0.3s ease;
    }
    @media (max-width: 480px) {
        .alert {
            padding: 0.75rem;
            font-size: 0.8rem;
            gap: 0.5rem;
        }
    }

    /* ========== TABEL & CARD VIEW ========== */
    .table-container {
        background: white;
        border-radius: var(--radius);
        border: 1px solid var(--gray-200);
        overflow: hidden;
        margin-bottom: 1.5rem;
        box-shadow: var(--shadow);
    }
    .table-scroll {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    .agenda-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 800px;
    }
    .agenda-table th {
        background: var(--gray-50);
        padding: 0.75rem 1rem;
        font-size: 0.7rem;
        font-weight: 600;
        color: var(--gray-600);
        text-transform: uppercase;
        letter-spacing: 0.05em;
        text-align: left;
        border-bottom: 1px solid var(--gray-200);
        white-space: nowrap;
    }
    .agenda-table td {
        padding: 1rem;
        font-size: 0.85rem;
        color: var(--gray-700);
        border-bottom: 1px solid var(--gray-100);
        vertical-align: middle;
    }

    /* Mobile card view - lebih lega */
    .mobile-card-view {
        display: none;
    }
    .agenda-card {
        background: white;
        border-bottom: 1px solid var(--gray-100);
        padding: 1rem;
    }
    @media (max-width: 480px) {
        .agenda-card {
            padding: 1rem 0.75rem;
        }
    }
    .card-header {
        display: flex;
        gap: 0.75rem;
        margin-bottom: 0.75rem;
    }
    .card-image {
        width: 60px;
        height: 60px;
        flex-shrink: 0;
    }
    .card-image img,
    .card-image .placeholder {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 0.5rem;
        border: 1px solid var(--gray-200);
    }
    .card-title {
        font-weight: 600;
        color: var(--gray-900);
        margin-bottom: 0.25rem;
        font-size: 0.95rem;
    }
    .card-desc {
        font-size: 0.75rem;
        color: var(--gray-500);
        margin-bottom: 0.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .card-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-top: 0.5rem;
    }
    .card-meta-item {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        padding: 0.25rem 0.5rem;
        background: var(--gray-100);
        border-radius: 1rem;
        font-size: 0.7rem;
        color: var(--gray-600);
    }
    .card-row {
        display: flex;
        justify-content: space-between;
        padding: 0.5rem 0;
        border-bottom: 1px solid var(--gray-100);
        font-size: 0.8rem;
    }
    .card-row:last-child { border-bottom: none; }
    .card-label { color: var(--gray-500); font-weight: 500; }
    .card-value { color: var(--gray-700); text-align: right; }
    .card-actions {
        display: flex;
        gap: 0.5rem;
        margin-top: 0.75rem;
        flex-wrap: wrap;
    }
    .card-actions .btn { flex: 1; justify-content: center; }

    @media (max-width: 768px) {
        .desktop-table-view { display: none; }
        .mobile-card-view { display: block; }
    }

    /* ========== BADGE ========== */
    .badge {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        padding: 0.25rem 0.75rem;
        border-radius: 2rem;
        font-size: 0.65rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        white-space: nowrap;
    }
    .badge-pending { background: var(--warning-light); color: var(--warning); }
    .badge-approved { background: var(--success-light); color: var(--success); }
    .badge-rejected { background: var(--danger-light); color: var(--danger); }

    /* ========== TOMBOL ========== */
    .btn {
        padding: 0.5rem 0.75rem;
        border-radius: var(--radius-sm);
        font-size: 0.75rem;
        font-weight: 500;
        border: 1px solid transparent;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.375rem;
        cursor: pointer;
        background: white;
        text-decoration: none;
    }
    .btn-sm { padding: 0.375rem 0.75rem; font-size: 0.7rem; }
    .btn-outline { border: 1px solid var(--gray-200); color: var(--gray-700); }
    .btn-outline:hover { background: var(--gray-100); border-color: var(--gray-300); }
    .btn-approve { background: var(--success); color: white; }
    .btn-approve:hover { background: #0da271; }
    .btn-reject { background: var(--danger); color: white; }
    .btn-reject:hover { background: #dc2626; }

    @media (max-width: 480px) {
        .btn {
            padding: 0.5rem 0.6rem;
            font-size: 0.7rem;
        }
        .btn-sm {
            padding: 0.4rem 0.6rem;
            font-size: 0.65rem;
        }
    }

    /* ========== EMPTY STATE ========== */
    .empty-state {
        padding: 3rem 1rem;
        text-align: center;
    }
    .empty-icon {
        font-size: 3rem;
        color: var(--gray-300);
        margin-bottom: 1rem;
    }
    .empty-title {
        font-size: 1rem;
        font-weight: 600;
        color: var(--gray-700);
        margin-bottom: 0.5rem;
    }
    .empty-text {
        color: var(--gray-500);
        margin-bottom: 1.5rem;
        font-size: 0.875rem;
    }
    @media (max-width: 480px) {
        .empty-state { padding: 2rem 0.75rem; }
        .empty-icon { font-size: 2.5rem; }
        .empty-title { font-size: 0.9rem; }
        .empty-text { font-size: 0.75rem; }
    }

    /* ========== SCROLL HINT ========== */
    .scroll-hint {
        display: none;
        position: sticky;
        bottom: 1rem;
        left: 50%;
        transform: translateX(-50%);
        background: var(--gray-800);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 2rem;
        font-size: 0.7rem;
        align-items: center;
        gap: 0.5rem;
        z-index: 10;
        width: fit-content;
        margin: 0 auto;
    }
    @media (max-width: 768px) {
        .scroll-hint { display: flex; }
    }
    @media (max-width: 480px) {
        .scroll-hint {
            font-size: 0.6rem;
            padding: 0.4rem 0.8rem;
        }
    }

    /* ========== MODAL RESPONSIF - LEBIH LEBAR DI MOBILE ========== */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        align-items: center;
        justify-content: center;
        padding: 1rem;
        z-index: 1000;
        backdrop-filter: blur(4px);
    }
    .modal-content {
        background: white;
        border-radius: var(--radius);
        max-width: 90%;
        width: 100%;
        max-height: 90vh;
        overflow-y: auto;
        padding: 1.25rem;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        animation: modalSlideUp 0.3s ease;
    }
    @media (max-width: 480px) {
        .modal-content {
            max-width: 95%;
            padding: 1rem;
        }
        .modal-title {
            font-size: 1.1rem;
        }
        .detail-value {
            font-size: 0.85rem;
        }
    }
    @media (min-width: 480px) {
        .modal-content { max-width: 450px; padding: 1.5rem; }
    }
    @media (min-width: 768px) {
        .modal-content { max-width: 500px; padding: 2rem; }
    }

    .detail-item {
        margin-bottom: 1rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--gray-100);
    }
    .detail-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }
    .detail-label {
        font-size: 0.7rem;
        color: var(--gray-500);
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 0.25rem;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }
    .detail-value {
        font-size: 0.9rem;
        color: var(--gray-800);
        line-height: 1.5;
        word-break: break-word;
    }
    @media (min-width: 768px) {
        .detail-label { font-size: 0.75rem; }
        .detail-value { font-size: 1rem; }
    }

    .text-truncate { overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
    .w-100 { width: 100%; }
    .agenda-image {
        width: 60px;
        height: 45px;
        object-fit: cover;
        border-radius: 6px;
    }
    @keyframes slideIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes modalSlideUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="admin-container">
    <!-- HEADER -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-calendar-check" style="color: var(--primary);"></i>
            Manajemen Agenda
        </h1>
        <p class="page-description">
            <i class="fas fa-info-circle"></i>
            Kelola semua pengajuan agenda dari staff
            <span class="meta-tag" style="background: var(--gray-100); padding: 0.2rem 0.6rem; border-radius: 1rem;">
                <i class="fas fa-calendar"></i> {{ now()->format('d F Y') }}
            </span>
        </p>
    </div>

    <!-- TAB STATUS -->
    <div class="status-tabs">
        <a href="{{ route('admin.agenda.index', ['status' => 'pending']) }}" 
           class="status-tab {{ request('status') == 'pending' || !request('status') ? 'active' : '' }}">
            <i class="fas fa-clock"></i> Pending
        </a>
        <a href="{{ route('admin.agenda.index', ['status' => 'approved']) }}" 
           class="status-tab {{ request('status') == 'approved' ? 'active' : '' }}">
            <i class="fas fa-check-circle"></i> Approved
        </a>
        <a href="{{ route('admin.agenda.index', ['status' => 'rejected']) }}" 
           class="status-tab {{ request('status') == 'rejected' ? 'active' : '' }}">
            <i class="fas fa-times-circle"></i> Rejected
        </a>
    </div>

    <!-- STATISTIK -->
    @php
        $currentStatus = request('status', 'pending');
        $totalCount = $agendas->count();
        $monthCount = $agendas->where('created_at', '>=', now()->startOfMonth())->count();
        $weekCount = $agendas->where('created_at', '>=', now()->startOfWeek())->count();
    @endphp
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon" style="background: var(--gray-100); color: var(--gray-600);">
                <i class="fas fa-database"></i>
            </div>
            <div class="stat-content">
                <div class="stat-label">Total {{ ucfirst($currentStatus) }}</div>
                <div class="stat-value">{{ $totalCount }}</div>
                <div class="stat-sub">Semua waktu</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: var(--warning-light); color: var(--warning);">
                <i class="fas fa-calendar-week"></i>
            </div>
            <div class="stat-content">
                <div class="stat-label">Minggu Ini</div>
                <div class="stat-value">{{ $weekCount }}</div>
                <div class="stat-sub">{{ $weekCount > 0 ? '+' . $weekCount : '0' }} baru</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: var(--primary-light); color: var(--primary);">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <div class="stat-content">
                <div class="stat-label">Bulan Ini</div>
                <div class="stat-value">{{ $monthCount }}</div>
                <div class="stat-sub">{{ $totalCount > 0 ? round(($monthCount / $totalCount) * 100) : 0 }}% dari total</div>
            </div>
        </div>
    </div>

    <!-- NOTIFIKASI -->
    @if(session('success'))
        <div class="alert" style="border-left-color: var(--success); background: var(--success-light);">
            <i class="fas fa-check-circle" style="color: var(--success);"></i>
            <div style="flex: 1;">{{ session('success') }}</div>
            <button onclick="this.parentElement.remove()" style="background: none; border: none; color: inherit; cursor: pointer;">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert" style="border-left-color: var(--danger); background: var(--danger-light);">
            <i class="fas fa-exclamation-circle" style="color: var(--danger);"></i>
            <div style="flex: 1;">{{ session('error') }}</div>
            <button onclick="this.parentElement.remove()" style="background: none; border: none; color: inherit; cursor: pointer;">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif

    <!-- TABEL DESKTOP -->
    <div class="table-container desktop-table-view">
        <div class="table-scroll">
            @if($agendas->count() > 0)
                <table class="agenda-table">
                    <thead>
                        <tr><th>Gambar</th><th>Agenda</th><th>Tanggal</th><th>Waktu</th><th>Lokasi</th><th>Status</th><th>Aksi</th></tr>
                    </thead>
                    <tbody>
                        @foreach($agendas as $agenda)
                        <tr>
                            <td>
                                @if($agenda->image)
                                    <img src="{{ asset('storage/'.$agenda->image) }}" class="agenda-image" alt="{{ $agenda->title }}">
                                @else
                                    <div style="width:60px; height:45px; background:var(--gray-100); border-radius:6px; display:flex; align-items:center; justify-content:center;">
                                        <i class="fas fa-image" style="color: var(--gray-400);"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div style="font-weight:600;">{{ $agenda->title }}</div>
                                @if($agenda->deskripsi)<div style="font-size:0.7rem; color:var(--gray-500);">{{ Str::limit($agenda->deskripsi, 50) }}</div>@endif
                                <div style="display:flex; gap:0.5rem; margin-top:0.25rem;">
                                    <span style="font-size:0.65rem; background:var(--gray-100); padding:0.1rem 0.5rem; border-radius:1rem;"><i class="fas fa-user"></i> {{ $agenda->user->name ?? 'Unknown' }}</span>
                                    <span style="font-size:0.65rem; background:var(--gray-100); padding:0.1rem 0.5rem; border-radius:1rem;"><i class="fas fa-clock"></i> {{ $agenda->created_at->diffForHumans() }}</span>
                                </div>
                            </td>
                            <td class="text-nowrap">{{ $agenda->date ? \Carbon\Carbon::parse($agenda->date)->format('d/m/Y') : '-' }}</td>
                            <td class="text-nowrap">{{ $agenda->time ? \Carbon\Carbon::parse($agenda->time)->format('H:i') : '-' }}</td>
                            <td class="text-truncate" style="max-width:150px;">{{ $agenda->location ?? '-' }}</td>
                            <td>
                                @if($agenda->status === 'pending')
                                    <span class="badge badge-pending"><i class="fas fa-clock"></i> Pending</span>
                                @elseif($agenda->status === 'approved')
                                    <span class="badge badge-approved"><i class="fas fa-check"></i> Approved</span>
                                @else
                                    <span class="badge badge-rejected"><i class="fas fa-times"></i> Rejected</span>
                                @endif
                            </td>
                            <td>
                                @if($agenda->status === 'pending')
                                    <div style="display:flex; gap:0.5rem; flex-wrap:wrap;">
                                        <button onclick="viewAgenda({{ $agenda->id }})" class="btn btn-outline btn-sm"><i class="fas fa-eye"></i> Detail</button>
                                        <form method="POST" action="{{ route('admin.agenda.approve', $agenda->id) }}" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-approve btn-sm" onclick="return confirm('Setujui agenda ini?')"><i class="fas fa-check"></i> Approve</button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.agenda.reject', $agenda->id) }}" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-reject btn-sm" onclick="return confirm('Tolak agenda ini?')"><i class="fas fa-times"></i> Reject</button>
                                        </form>
                                    </div>
                                @elseif($agenda->status === 'rejected')
                                    <div style="display:flex; gap:0.5rem; flex-wrap:wrap;">
                                        <button onclick="viewAgenda({{ $agenda->id }})" class="btn btn-outline btn-sm"><i class="fas fa-eye"></i> Detail</button>
                                        <form method="POST" action="{{ route('admin.agenda.approve', $agenda->id) }}" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-approve btn-sm" onclick="return confirm('Setujui agenda yang sebelumnya ditolak?')"><i class="fas fa-check"></i> Approve Ulang</button>
                                        </form>
                                    </div>
                                @else
                                    <button onclick="viewAgenda({{ $agenda->id }})" class="btn btn-outline btn-sm"><i class="fas fa-eye"></i> Detail</button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state">
                    <div class="empty-icon"><i class="fas fa-calendar-times"></i></div>
                    <div class="empty-title">Tidak ada agenda {{ $currentStatus }}</div>
                    <p class="empty-text">
                        @if($currentStatus == 'pending') Semua agenda sudah diproses.
                        @elseif($currentStatus == 'approved') Belum ada agenda yang disetujui.
                        @else Belum ada agenda yang ditolak. @endif
                    </p>
                    @if($currentStatus != 'pending')
                        <a href="{{ route('admin.agenda.index', ['status' => 'pending']) }}" class="btn btn-outline"><i class="fas fa-clock"></i> Lihat Pending</a>
                    @endif
                </div>
            @endif
        </div>
    </div>

    <!-- CARD VIEW MOBILE (lebih lega) -->
    <div class="mobile-card-view">
        @if($agendas->count() > 0)
            @foreach($agendas as $agenda)
                <div class="agenda-card">
                    <div class="card-header">
                        <div class="card-image">
                            @if($agenda->image)
                                <img src="{{ asset('storage/'.$agenda->image) }}" alt="{{ $agenda->title }}">
                            @else
                                <div class="placeholder"><i class="fas fa-image"></i></div>
                            @endif
                        </div>
                        <div style="flex:1;">
                            <div class="card-title">{{ $agenda->title }}</div>
                            @if($agenda->deskripsi)<div class="card-desc">{{ Str::limit($agenda->deskripsi, 80) }}</div>@endif
                            <div class="card-meta">
                                <span class="card-meta-item"><i class="fas fa-user"></i> {{ $agenda->user->name ?? 'Unknown' }}</span>
                                <span class="card-meta-item"><i class="fas fa-clock"></i> {{ $agenda->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-row">
                        <span class="card-label"><i class="fas fa-calendar-day"></i> Tanggal</span>
                        <span class="card-value">{{ $agenda->date ? \Carbon\Carbon::parse($agenda->date)->format('d/m/Y') : '-' }}</span>
                    </div>
                    <div class="card-row">
                        <span class="card-label"><i class="fas fa-clock"></i> Waktu</span>
                        <span class="card-value">{{ $agenda->time ? \Carbon\Carbon::parse($agenda->time)->format('H:i').' WIB' : '-' }}</span>
                    </div>
                    <div class="card-row">
                        <span class="card-label"><i class="fas fa-map-marker-alt"></i> Lokasi</span>
                        <span class="card-value">{{ $agenda->location ?? '-' }}</span>
                    </div>
                    <div class="card-row">
                        <span class="card-label"><i class="fas fa-info-circle"></i> Status</span>
                        <span class="card-value">
                            @if($agenda->status === 'pending') <span class="badge badge-pending"><i class="fas fa-clock"></i> Pending</span>
                            @elseif($agenda->status === 'approved') <span class="badge badge-approved"><i class="fas fa-check"></i> Approved</span>
                            @else <span class="badge badge-rejected"><i class="fas fa-times"></i> Rejected</span>
                            @endif
                        </span>
                    </div>
                    <div class="card-actions">
                        <button onclick="viewAgenda({{ $agenda->id }})" class="btn btn-outline btn-sm"><i class="fas fa-eye"></i> Detail</button>
                        @if($agenda->status === 'pending')
                            <form method="POST" action="{{ route('admin.agenda.approve', $agenda->id) }}" style="flex:1;">
                                @csrf
                                <button type="submit" class="btn btn-approve btn-sm w-100" onclick="return confirm('Setujui agenda ini?')"><i class="fas fa-check"></i> Approve</button>
                            </form>
                            <form method="POST" action="{{ route('admin.agenda.reject', $agenda->id) }}" style="flex:1;">
                                @csrf
                                <button type="submit" class="btn btn-reject btn-sm w-100" onclick="return confirm('Tolak agenda ini?')"><i class="fas fa-times"></i> Reject</button>
                            </form>
                        @elseif($agenda->status === 'rejected')
                            <form method="POST" action="{{ route('admin.agenda.approve', $agenda->id) }}" style="flex:1;">
                                @csrf
                                <button type="submit" class="btn btn-approve btn-sm w-100" onclick="return confirm('Setujui agenda yang sebelumnya ditolak?')"><i class="fas fa-check"></i> Approve Ulang</button>
                            </form>
                        @else
                            <span style="flex:1; text-align:center; color:var(--gray-400);"><i class="fas fa-check-circle"></i> Selesai</span>
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <div class="empty-state">
                <div class="empty-icon"><i class="fas fa-calendar-times"></i></div>
                <div class="empty-title">Tidak ada agenda {{ $currentStatus }}</div>
                <p class="empty-text">
                    @if($currentStatus == 'pending') Semua agenda sudah diproses.
                    @elseif($currentStatus == 'approved') Belum ada agenda yang disetujui.
                    @else Belum ada agenda yang ditolak. @endif
                </p>
                @if($currentStatus != 'pending')
                    <a href="{{ route('admin.agenda.index', ['status' => 'pending']) }}" class="btn btn-outline"><i class="fas fa-clock"></i> Lihat Pending</a>
                @endif
            </div>
        @endif
    </div>

    <!-- SCROLL HINT (mobile) -->
    @if($agendas->count() > 0)
        <div class="scroll-hint">
            <i class="fas fa-arrows-alt-h"></i> <span>Geser ke kanan untuk info lengkap</span>
        </div>
    @endif
</div>

<!-- MODAL DETAIL -->
<div id="agendaModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title"><i class="fas fa-info-circle" style="color: var(--primary);"></i> Detail Agenda</h3>
            <button onclick="closeModal()" class="modal-close">&times;</button>
        </div>
        <div id="modalContent" class="modal-body"></div>
    </div>
</div>

<script>
// Data agenda untuk modal
const agendas = {};
@foreach($agendas as $agenda)
agendas[{{ $agenda->id }}] = {
    id: {{ $agenda->id }},
    title: {!! json_encode($agenda->title) !!},
    deskripsi: {!! json_encode($agenda->deskripsi) !!},
    image: {!! json_encode($agenda->image) !!},
    date: {!! json_encode($agenda->date) !!},
    time: {!! json_encode($agenda->time) !!},
    location: {!! json_encode($agenda->location) !!},
    status: {!! json_encode($agenda->status) !!},
    user: {!! json_encode($agenda->user ? ['name' => $agenda->user->name, 'email' => $agenda->user->email] : null) !!},
    created_at: {!! json_encode($agenda->created_at ? $agenda->created_at->toISOString() : null) !!},
    updated_at: {!! json_encode($agenda->updated_at ? $agenda->updated_at->toISOString() : null) !!}
};
@endforeach

function viewAgenda(id) {
    const a = agendas[id];
    if (!a) return;
    const statusBadge = {
        pending: '<span class="badge badge-pending"><i class="fas fa-clock"></i> Pending</span>',
        approved: '<span class="badge badge-approved"><i class="fas fa-check"></i> Approved</span>',
        rejected: '<span class="badge badge-rejected"><i class="fas fa-times"></i> Rejected</span>'
    };
    const formatDate = (d) => d ? new Date(d).toLocaleDateString('id-ID', { day:'numeric', month:'long', year:'numeric', hour:'2-digit', minute:'2-digit' }) : '-';
    const formatDateOnly = (d) => d ? new Date(d).toLocaleDateString('id-ID', { day:'numeric', month:'long', year:'numeric' }) : '-';
    document.getElementById('modalContent').innerHTML = `
        <div class="detail-item"><div class="detail-label"><i class="fas fa-tag"></i> Judul</div><div class="detail-value" style="font-weight:600;">${a.title || '-'}</div></div>
        ${a.image ? `<div class="detail-item"><div class="detail-label"><i class="fas fa-image"></i> Gambar</div><div class="detail-value"><img src="{{ asset('storage') }}/${a.image}" style="width:100%; max-height:200px; object-fit:cover; border-radius:8px;"></div></div>` : ''}
        <div class="detail-item"><div class="detail-label"><i class="fas fa-align-left"></i> Deskripsi</div><div class="detail-value">${a.deskripsi || '<span style="color:var(--gray-400);">Tidak ada deskripsi</span>'}</div></div>
        <div class="detail-item"><div class="detail-label"><i class="fas fa-calendar-alt"></i> Waktu & Tempat</div><div class="detail-value">
            <div><i class="fas fa-calendar-day"></i> ${formatDateOnly(a.date)}</div>
            <div><i class="fas fa-clock"></i> ${a.time ? a.time+' WIB' : '-'}</div>
            <div><i class="fas fa-map-marker-alt"></i> ${a.location || '-'}</div>
        </div></div>
        <div class="detail-item"><div class="detail-label"><i class="fas fa-info-circle"></i> Status</div><div class="detail-value">${statusBadge[a.status] || '-'}</div></div>
        <div class="detail-item"><div class="detail-label"><i class="fas fa-user"></i> Dibuat Oleh</div><div class="detail-value"><div style="font-weight:500;">${a.user?.name || 'Unknown'}</div><div style="font-size:0.8rem; color:var(--gray-500);">${a.user?.email || ''}</div></div></div>
        <div class="detail-item"><div class="detail-label"><i class="fas fa-history"></i> Riwayat</div><div class="detail-value"><div>Dibuat: ${formatDate(a.created_at)}</div><div>Diperbarui: ${formatDate(a.updated_at)}</div></div></div>
    `;
    document.getElementById('agendaModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}
function closeModal() {
    document.getElementById('agendaModal').style.display = 'none';
    document.body.style.overflow = 'auto';
}
document.getElementById('agendaModal').addEventListener('click', (e) => { if(e.target === e.currentTarget) closeModal(); });
document.addEventListener('keydown', (e) => { if(e.key === 'Escape') closeModal(); });
</script>
@endsection
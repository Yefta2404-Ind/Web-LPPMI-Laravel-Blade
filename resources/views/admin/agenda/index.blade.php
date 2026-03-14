@extends('layouts.admin')

@section('page-title', 'Agenda Pending')
@section('content')
<style>
    /* ===== VARIABLES - Mempertahankan warna asli ===== */
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
        --radius: 12px;
        --radius-sm: 8px;
        --shadow: 0 1px 3px rgba(0,0,0,0.05);
        --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.1);
        --transition: 150ms ease;
    }

    /* ===== RESET ===== */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* ===== LAYOUT - Improved Responsive ===== */
    .admin-container {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 24px;
        width: 100%;
    }

    /* Responsive padding */
    @media (max-width: 1024px) {
        .admin-container { 
            padding: 0 20px; 
        }
    }

    @media (max-width: 768px) {
        .admin-container { 
            padding: 0 16px; 
        }
    }

    @media (max-width: 480px) {
        .admin-container { 
            padding: 0 12px; 
        }
    }

    /* ===== HEADER ===== */
    .page-header {
        margin-bottom: 32px;
    }

    .page-title {
        font-size: 1.875rem;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 8px;
        letter-spacing: -0.02em;
    }

    .page-description {
        color: var(--gray-500);
        font-size: 0.95rem;
    }

    /* Responsive header */
    @media (max-width: 1024px) {
        .page-title { 
            font-size: 1.75rem; 
        }
    }

    @media (max-width: 768px) {
        .page-title { 
            font-size: 1.5rem; 
        }
    }

    @media (max-width: 480px) {
        .page-title { 
            font-size: 1.35rem; 
        }
    }

    /* ===== STATUS TABS - Improved Responsive ===== */
    .status-tabs {
        display: flex;
        gap: 12px;
        margin-bottom: 32px;
        flex-wrap: wrap;
    }

    .status-tab {
        padding: 10px 24px;
        border-radius: 40px;
        font-size: 0.9rem;
        font-weight: 600;
        background: white;
        color: var(--gray-600);
        border: 1.5px solid var(--gray-200);
        transition: var(--transition);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        white-space: nowrap;
    }

    .status-tab i {
        font-size: 0.85rem;
    }

    .status-tab:hover {
        background: var(--gray-50);
        border-color: var(--gray-300);
    }

    .status-tab.active {
        background: var(--gray-900);
        color: white;
        border-color: var(--gray-900);
    }

    .status-tab.active i {
        color: white;
    }

    /* Responsive tabs */
    @media (max-width: 768px) {
        .status-tabs {
            gap: 8px;
            justify-content: center;
        }
        
        .status-tab {
            flex: 1;
            justify-content: center;
            padding: 8px 12px;
            font-size: 0.85rem;
        }
    }

    @media (max-width: 480px) {
        .status-tab {
            padding: 8px 10px;
            font-size: 0.8rem;
        }
        
        .status-tab i {
            font-size: 0.75rem;
        }
    }

    /* ===== STATS CARD - Improved Grid ===== */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
        margin-bottom: 32px;
    }

    .stat-card {
        background: white;
        padding: 24px;
        border-radius: var(--radius);
        border: 1px solid var(--gray-200);
        display: flex;
        align-items: center;
        gap: 16px;
        transition: var(--transition);
    }

    .stat-card:hover {
        border-color: var(--gray-300);
        box-shadow: var(--shadow-md);
    }

    .stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
    }

    .stat-icon.pending {
        background: var(--warning-light);
        color: var(--warning);
    }

    .stat-icon.approved {
        background: var(--success-light);
        color: var(--success);
    }

    .stat-icon.rejected {
        background: var(--danger-light);
        color: var(--danger);
    }

    .stat-content {
        flex: 1;
    }

    .stat-label {
        font-size: 0.8rem;
        color: var(--gray-500);
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 4px;
    }

    .stat-value {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--gray-900);
        line-height: 1;
    }

    /* Responsive stats */
    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .stat-card {
            padding: 20px;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            font-size: 1.1rem;
        }

        .stat-value {
            font-size: 1.5rem;
        }
    }

    /* ===== ALERTS - Improved ===== */
    .alert {
        padding: 16px 20px;
        border-radius: var(--radius-sm);
        margin-bottom: 28px;
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 0.95rem;
        border-left: 4px solid;
        background: white;
        animation: slideIn 0.3s ease;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .alert-success {
        border-left-color: var(--success);
        background: var(--success-light);
        color: var(--success);
    }

    .alert-error {
        border-left-color: var(--danger);
        background: var(--danger-light);
        color: var(--danger);
    }

    .alert-info {
        border-left-color: var(--primary);
        background: var(--primary-light);
        color: var(--primary);
    }

    /* ===== TABLE - Improved Responsive ===== */
    .table-container {
        background: white;
        border-radius: var(--radius);
        border: 1px solid var(--gray-200);
        overflow: hidden;
        position: relative;
        margin-bottom: 32px;
        box-shadow: var(--shadow);
    }

    .table-scroll {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: thin;
        scrollbar-color: var(--gray-300) var(--gray-100);
    }

    .table-scroll::-webkit-scrollbar {
        height: 8px;
    }

    .table-scroll::-webkit-scrollbar-track {
        background: var(--gray-100);
    }

    .table-scroll::-webkit-scrollbar-thumb {
        background: var(--gray-300);
        border-radius: 20px;
    }

    .table-scroll::-webkit-scrollbar-thumb:hover {
        background: var(--gray-400);
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        min-width: 1000px;
    }

    .table th {
        background: var(--gray-50);
        padding: 18px 24px;
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--gray-600);
        text-transform: uppercase;
        letter-spacing: 0.05em;
        text-align: left;
        border-bottom: 1px solid var(--gray-200);
        white-space: nowrap;
    }

    .table td {
        padding: 24px;
        font-size: 0.95rem;
        color: var(--gray-700);
        border-bottom: 1px solid var(--gray-100);
        vertical-align: middle;
    }

    .table tr:last-child td {
        border-bottom: none;
    }

    .table tbody tr {
        transition: var(--transition);
    }

    .table tbody tr:hover {
        background: var(--gray-50);
    }

    /* Responsive table cells */
    @media (max-width: 768px) {
        .table td { 
            padding: 20px; 
        }
    }

    /* ===== AGENDA INFO ===== */
    .agenda-info {
        max-width: 350px;
    }

    .agenda-title {
        font-weight: 600;
        color: var(--gray-900);
        font-size: 1rem;
        margin-bottom: 6px;
        line-height: 1.4;
    }

    .agenda-desc {
        font-size: 0.85rem;
        color: var(--gray-500);
        margin-bottom: 12px;
        line-height: 1.5;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .agenda-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
    }

    .meta-tag {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 10px;
        background: var(--gray-100);
        border-radius: 20px;
        font-size: 0.75rem;
        color: var(--gray-600);
        transition: var(--transition);
    }

    .meta-tag:hover {
        background: var(--gray-200);
    }

    .meta-tag i {
        color: var(--gray-500);
        font-size: 0.7rem;
    }

    /* Responsive agenda info */
    @media (max-width: 768px) {
        .agenda-info {
            max-width: 280px;
        }
    }

    /* ===== IMAGE STYLES ===== */
    .agenda-image {
        width: 70px;
        height: 50px;
        object-fit: cover;
        border-radius: 6px;
        border: 1px solid var(--gray-200);
        transition: var(--transition);
    }

    .agenda-image:hover {
        transform: scale(1.05);
        box-shadow: var(--shadow);
    }

    .agenda-image-placeholder {
        width: 70px;
        height: 50px;
        background: var(--gray-100);
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--gray-400);
        font-size: 1.2rem;
        border: 1px solid var(--gray-200);
    }

    /* Responsive image */
    @media (max-width: 480px) {
        .agenda-image,
        .agenda-image-placeholder {
            width: 60px;
            height: 45px;
        }
    }

    /* ===== BADGES ===== */
    .badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 14px;
        border-radius: 30px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        gap: 8px;
        white-space: nowrap;
    }

    .badge-pending {
        background: var(--warning-light);
        color: var(--warning);
        border: 1px solid rgba(245, 158, 11, 0.2);
    }

    .badge-approved {
        background: var(--success-light);
        color: var(--success);
        border: 1px solid rgba(16, 185, 129, 0.2);
    }

    .badge-rejected {
        background: var(--danger-light);
        color: var(--danger);
        border: 1px solid rgba(239, 68, 68, 0.2);
    }

    /* Responsive badges */
    @media (max-width: 480px) {
        .badge {
            padding: 4px 10px;
            font-size: 0.7rem;
        }
    }

    /* ===== ACTION BUTTONS - Improved Responsive ===== */
    .action-group {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .btn {
        padding: 8px 16px;
        border-radius: var(--radius-sm);
        font-size: 0.85rem;
        font-weight: 500;
        border: 1px solid transparent;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        cursor: pointer;
        background: white;
        text-decoration: none;
    }

    .btn-sm {
        padding: 6px 14px;
        font-size: 0.8rem;
    }

    .btn-outline {
        border: 1px solid var(--gray-200);
        color: var(--gray-700);
    }

    .btn-outline:hover {
        background: var(--gray-100);
        border-color: var(--gray-300);
        transform: translateY(-1px);
    }

    .btn-approve {
        background: var(--success);
        color: white;
    }

    .btn-approve:hover {
        background: #0da271;
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(16, 185, 129, 0.2);
    }

    .btn-reject {
        background: var(--danger);
        color: white;
    }

    .btn-reject:hover {
        background: #dc2626;
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(239, 68, 68, 0.2);
    }

    /* Responsive action buttons */
    @media (max-width: 768px) {
        .action-group {
            flex-direction: column;
            width: 100%;
            min-width: 120px;
        }

        .action-group .btn {
            width: 100%;
        }
    }

    /* ===== NO ACTIONS MESSAGE ===== */
    .no-actions {
        color: var(--gray-400);
        font-size: 0.85rem;
        font-style: italic;
        padding: 4px 0;
        display: flex;
        align-items: center;
        gap: 6px;
        white-space: nowrap;
    }

    /* ===== EMPTY STATE ===== */
    .empty-state {
        padding: 64px 24px;
        text-align: center;
    }

    .empty-icon {
        font-size: 3.5rem;
        color: var(--gray-300);
        margin-bottom: 16px;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    .empty-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--gray-700);
        margin-bottom: 8px;
    }

    .empty-text {
        color: var(--gray-500);
        margin-bottom: 24px;
    }

    /* Responsive empty state */
    @media (max-width: 480px) {
        .empty-state {
            padding: 40px 16px;
        }

        .empty-icon {
            font-size: 3rem;
        }

        .empty-title {
            font-size: 1rem;
        }
    }

    /* ===== SCROLL HINT ===== */
    .scroll-hint {
        display: none;
        position: sticky;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        background: var(--gray-800);
        color: white;
        padding: 8px 20px;
        border-radius: 30px;
        font-size: 0.8rem;
        align-items: center;
        gap: 10px;
        z-index: 10;
        opacity: 0.9;
        box-shadow: var(--shadow-md);
        width: fit-content;
        animation: bounce 2s infinite;
    }

    @keyframes bounce {
        0%, 100% { transform: translateX(-50%) translateY(0); }
        50% { transform: translateX(-50%) translateY(-5px); }
    }

    @media (max-width: 768px) {
        .scroll-hint {
            display: flex;
        }
    }

    /* ===== MODAL - Improved Responsive ===== */
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
        padding: 20px;
        z-index: 1000;
        backdrop-filter: blur(4px);
    }

    .modal-content {
        background: white;
        border-radius: var(--radius);
        max-width: 500px;
        width: 100%;
        max-height: 90vh;
        overflow-y: auto;
        padding: 32px;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        animation: modalSlideUp 0.3s ease;
    }

    @keyframes modalSlideUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 28px;
        padding-bottom: 16px;
        border-bottom: 1px solid var(--gray-200);
    }

    .modal-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--gray-900);
    }

    .modal-close {
        background: none;
        border: none;
        font-size: 2rem;
        color: var(--gray-400);
        cursor: pointer;
        line-height: 1;
        padding: 0 8px;
        border-radius: 50%;
        transition: var(--transition);
    }

    .modal-close:hover {
        background: var(--gray-100);
        color: var(--gray-600);
    }

    .detail-item {
        margin-bottom: 20px;
        padding-bottom: 20px;
        border-bottom: 1px solid var(--gray-100);
    }

    .detail-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .detail-label {
        font-size: 0.75rem;
        color: var(--gray-500);
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 6px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .detail-value {
        font-size: 1rem;
        color: var(--gray-800);
        line-height: 1.6;
    }

    /* Responsive modal */
    @media (max-width: 768px) {
        .modal-content {
            padding: 24px;
        }

        .modal-title {
            font-size: 1.35rem;
        }
    }

    @media (max-width: 480px) {
        .modal-content {
            padding: 20px;
        }

        .modal-title {
            font-size: 1.25rem;
        }

        .detail-item {
            margin-bottom: 16px;
            padding-bottom: 16px;
        }
    }

    /* ===== ADDITIONAL UTILITIES ===== */
    .text-nowrap {
        white-space: nowrap;
    }

    .d-inline-flex {
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .w-100 {
        width: 100%;
    }

    /* Print styles */
    @media print {
        .status-tabs,
        .action-group,
        .btn,
        .modal,
        .scroll-hint {
            display: none !important;
        }

        .table-container {
            border: 1px solid black;
            box-shadow: none;
        }

        .table th,
        .table td {
            border: 1px solid black;
        }
    }
</style>

<div class="admin-container">
    <!-- Header -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-calendar-check" style="color: var(--primary); margin-right: 10px;"></i>
            Manajemen Agenda
        </h1>
        <p class="page-description">
            <i class="fas fa-info-circle" style="color: var(--gray-400);"></i>
            Kelola semua pengajuan agenda dari staff
            <span style="margin-left: 10px; padding: 4px 10px; background: var(--gray-100); border-radius: 30px; font-size: 0.8rem;">
                <i class="fas fa-calendar"></i> {{ now()->format('d F Y') }}
            </span>
        </p>
    </div>

    <!-- Status Tabs - Active State Based on Current Route -->
    <div class="status-tabs">
        <a href="{{ route('admin.agenda.index', ['status' => 'pending']) }}" 
           class="status-tab {{ request('status') == 'pending' || !request('status') ? 'active' : '' }}">
            <i class="fas fa-clock"></i> 
            <span>Pending</span>
            @if(request('status') == 'pending' || !request('status'))
                <span style="background: rgba(255,255,255,0.2); padding: 2px 8px; border-radius: 30px; font-size: 0.7rem;">
                    {{ $agendas->count() }}
                </span>
            @endif
        </a>
        <a href="{{ route('admin.agenda.index', ['status' => 'approved']) }}" 
           class="status-tab {{ request('status') == 'approved' ? 'active' : '' }}">
            <i class="fas fa-check-circle"></i> 
            <span>Approved</span>
            @if(request('status') == 'approved')
                <span style="background: rgba(255,255,255,0.2); padding: 2px 8px; border-radius: 30px; font-size: 0.7rem;">
                    {{ $agendas->count() }}
                </span>
            @endif
        </a>
        <a href="{{ route('admin.agenda.index', ['status' => 'rejected']) }}" 
           class="status-tab {{ request('status') == 'rejected' ? 'active' : '' }}">
            <i class="fas fa-times-circle"></i> 
            <span>Rejected</span>
            @if(request('status') == 'rejected')
                <span style="background: rgba(255,255,255,0.2); padding: 2px 8px; border-radius: 30px; font-size: 0.7rem;">
                    {{ $agendas->count() }}
                </span>
            @endif
        </a>
    </div>

    <!-- Dynamic Stats Based on Current Status -->
    @php
        $currentStatus = request('status', 'pending');
        $totalCount = $agendas->count();
        $monthCount = $agendas->where('created_at', '>=', now()->startOfMonth())->count();
        $weekCount = $agendas->where('created_at', '>=', now()->startOfWeek())->count();
    @endphp

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon {{ $currentStatus }}">
                <i class="fas 
                    @if($currentStatus == 'pending') fa-clock
                    @elseif($currentStatus == 'approved') fa-check-circle
                    @else fa-times-circle
                    @endif
                "></i>
            </div>
            <div class="stat-content">
                <div class="stat-label">Total {{ ucfirst($currentStatus) }}</div>
                <div class="stat-value">{{ $totalCount }}</div>
                <div style="font-size: 0.7rem; color: var(--gray-500); margin-top: 4px;">
                    <i class="fas fa-database"></i> Semua waktu
                </div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon {{ $currentStatus }}">
                <i class="fas fa-calendar-week"></i>
            </div>
            <div class="stat-content">
                <div class="stat-label">Minggu Ini</div>
                <div class="stat-value">{{ $weekCount }}</div>
                <div style="font-size: 0.7rem; color: var(--gray-500); margin-top: 4px;">
                    <i class="fas fa-chart-line"></i> {{ $weekCount > 0 ? '+' . $weekCount : '0' }} baru
                </div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon {{ $currentStatus }}">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <div class="stat-content">
                <div class="stat-label">Bulan Ini</div>
                <div class="stat-value">{{ $monthCount }}</div>
                <div style="font-size: 0.7rem; color: var(--gray-500); margin-top: 4px;">
                    <i class="fas fa-percent"></i> 
                    {{ $totalCount > 0 ? round(($monthCount / $totalCount) * 100) : 0 }}% dari total
                </div>
            </div>
        </div>
    </div>

    <!-- Alerts -->
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            <div style="flex: 1;">{{ session('success') }}</div>
            <button onclick="this.parentElement.remove()" style="background: none; border: none; color: inherit; cursor: pointer;">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i>
            <div style="flex: 1;">{{ session('error') }}</div>
            <button onclick="this.parentElement.remove()" style="background: none; border: none; color: inherit; cursor: pointer;">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif

    <!-- Table Container -->
    <div class="table-container">
        <div class="table-scroll">
            @if($agendas->count() > 0)
                <table class="table">
                    <thead>
                        <tr>
                            <th>Gambar</th>
                            <th>Agenda</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Lokasi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($agendas as $agenda)
                            <tr>
                                <td onclick="event.stopPropagation()">
                                    @if($agenda->image)
                                        <img src="{{ asset('storage/'.$agenda->image) }}" 
                                             class="agenda-image"
                                             alt="{{ $agenda->title }}">
                                    @else
                                        <div class="agenda-image-placeholder">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    @endif
                                </td>
                                
                                <!-- Agenda Info -->
                                <td>
                                    <div class="agenda-info">
                                        <div class="agenda-title">{{ $agenda->title }}</div>
                                        @if($agenda->deskripsi)
                                            <div class="agenda-desc">{{ Str::limit($agenda->deskripsi, 60) }}</div>
                                        @endif
                                        <div class="agenda-meta">
                                            <span class="meta-tag">
                                                <i class="fas fa-user"></i>
                                                {{ $agenda->user->name ?? 'Unknown' }}
                                            </span>
                                            <span class="meta-tag">
                                                <i class="fas fa-clock"></i>
                                                {{ $agenda->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                    </div>
                                </td>

                                <!-- Date -->
                                <td>
                                    @if($agenda->date)
                                        <span class="d-inline-flex">
                                            <i class="fas fa-calendar-day" style="color: var(--gray-400);"></i>
                                            {{ \Carbon\Carbon::parse($agenda->date)->format('d/m/Y') }}
                                        </span>
                                    @else
                                        <span style="color: var(--gray-400);">-</span>
                                    @endif
                                </td>

                                <!-- Time -->
                                <td>
                                    @if($agenda->time)
                                        <span class="d-inline-flex">
                                            <i class="fas fa-clock" style="color: var(--gray-400);"></i>
                                            {{ \Carbon\Carbon::parse($agenda->time)->format('H:i') }}
                                        </span>
                                    @else
                                        <span style="color: var(--gray-400);">-</span>
                                    @endif
                                </td>

                                <!-- Location -->
                                <td>
                                    @if($agenda->location)
                                        <span class="d-inline-flex">
                                            <i class="fas fa-map-marker-alt" style="color: var(--gray-400);"></i>
                                            {{ Str::limit($agenda->location, 20) }}
                                        </span>
                                    @else
                                        <span style="color: var(--gray-400);">-</span>
                                    @endif
                                </td>

                                <!-- Status Badge -->
                                <td>
                                    @if($agenda->status === 'pending')
                                        <span class="badge badge-pending">
                                            <i class="fas fa-clock"></i> Pending
                                        </span>
                                    @elseif($agenda->status === 'approved')
                                        <span class="badge badge-approved">
                                            <i class="fas fa-check"></i> Approved
                                        </span>
                                    @elseif($agenda->status === 'rejected')
                                        <span class="badge badge-rejected">
                                            <i class="fas fa-times"></i> Rejected
                                        </span>
                                    @endif
                                </td>

                                <!-- Actions -->
                                <td>
                                    @if($agenda->status === 'pending')
                                        <!-- PENDING: Show all actions -->
                                        <div class="action-group">
                                            <button onclick="viewAgenda({{ $agenda->id }})" class="btn btn-outline btn-sm">
                                                <i class="fas fa-eye"></i> Detail
                                            </button>
                                            <form method="POST" action="{{ route('admin.agenda.approve', $agenda->id) }}" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-approve btn-sm" onclick="return confirm('Setujui agenda ini?')">
                                                    <i class="fas fa-check"></i> Approve
                                                </button>
                                            </form>
                                            <form method="POST" action="{{ route('admin.agenda.reject', $agenda->id) }}" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-reject btn-sm" onclick="return confirm('Tolak agenda ini?')">
                                                    <i class="fas fa-times"></i> Reject
                                                </button>
                                            </form>
                                        </div>

                                    @elseif($agenda->status === 'rejected')
                                        <!-- REJECTED: Show Detail + Approve (Re-approve) -->
                                        <div class="action-group">
                                            <button onclick="viewAgenda({{ $agenda->id }})" class="btn btn-outline btn-sm">
                                                <i class="fas fa-eye"></i> Detail
                                            </button>
                                            <form method="POST" action="{{ route('admin.agenda.approve', $agenda->id) }}" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-approve btn-sm" onclick="return confirm('Setujui agenda yang sebelumnya ditolak?')">
                                                    <i class="fas fa-check"></i> Approve Ulang
                                                </button>
                                            </form>
                                        </div>

                                    @elseif($agenda->status === 'approved')
                                        <!-- APPROVED: Only show detail -->
                                        <div class="action-group">
                                            <button onclick="viewAgenda({{ $agenda->id }})" class="btn btn-outline btn-sm">
                                                <i class="fas fa-eye"></i> Detail
                                            </button>
                                            <span class="no-actions">
                                                <i class="fas fa-check-circle" style="color: var(--success);"></i> Selesai
                                            </span>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <!-- Empty State -->
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas 
                            @if($currentStatus == 'pending') fa-clock
                            @elseif($currentStatus == 'approved') fa-check-circle
                            @else fa-times-circle
                            @endif
                        "></i>
                    </div>
                    <div class="empty-title">
                        Tidak ada agenda {{ $currentStatus }}
                    </div>
                    <p class="empty-text">
                        @if($currentStatus == 'pending')
                            Semua agenda sudah diproses
                        @elseif($currentStatus == 'approved')
                            Belum ada agenda yang disetujui
                        @else
                            Belum ada agenda yang ditolak
                        @endif
                    </p>
                    @if($currentStatus != 'pending')
                        <a href="{{ route('admin.agenda.index', ['status' => 'pending']) }}" class="btn btn-outline">
                            <i class="fas fa-clock"></i> Lihat Pending
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>

    <!-- Scroll Hint for Mobile -->
    @if($agendas->count() > 0)
        <div class="scroll-hint">
            <i class="fas fa-arrows-alt-h"></i>
            <span>Geser untuk lihat lebih banyak</span>
        </div>
    @endif
</div>

<!-- Modal -->
<div id="agendaModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">
                <i class="fas fa-info-circle" style="color: var(--primary);"></i>
                Detail Agenda
            </h3>
            <button onclick="closeModal()" class="modal-close">&times;</button>
        </div>
        <div id="modalContent" class="modal-body"></div>
    </div>
</div>

<script>
// Data agendas
const agendas = @json($agendas->keyBy('id'));

// View agenda details
function viewAgenda(id) {
    const agenda = agendas[id];
    if (!agenda) return;

    const statusBadge = {
        pending: '<span class="badge badge-pending"><i class="fas fa-clock"></i> Pending</span>',
        approved: '<span class="badge badge-approved"><i class="fas fa-check"></i> Approved</span>',
        rejected: '<span class="badge badge-rejected"><i class="fas fa-times"></i> Rejected</span>'
    };

    const formatDate = (date) => {
        return new Date(date).toLocaleDateString('id-ID', { 
            day: 'numeric', 
            month: 'long', 
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
    };

    const content = document.getElementById('modalContent');
    content.innerHTML = `
        <div class="detail-item">
            <div class="detail-label">
                <i class="fas fa-tag"></i> Judul Agenda
            </div>
            <div class="detail-value" style="font-weight: 600; font-size: 1.1rem;">
                ${agenda.title}
            </div>
        </div>
        
        ${agenda.image ? `
        <div class="detail-item">
            <div class="detail-label">
                <i class="fas fa-image"></i> Gambar
            </div>
            <div class="detail-value">
                <img src="{{ asset('storage') }}/${agenda.image}" 
                     style="width: 100%; max-height: 200px; object-fit: cover; border-radius: 8px; border: 1px solid var(--gray-200);">
            </div>
        </div>
        ` : ''}
        
        <div class="detail-item">
            <div class="detail-label">
                <i class="fas fa-align-left"></i> Deskripsi
            </div>
            <div class="detail-value">
                ${agenda.deskripsi || '<span style="color: var(--gray-400);">Tidak ada deskripsi</span>'}
            </div>
        </div>
        
        <div class="detail-item">
            <div class="detail-label">
                <i class="fas fa-calendar-alt"></i> Waktu & Tempat
            </div>
            <div class="detail-value">
                <div style="margin-bottom: 5px;">
                    <i class="fas fa-calendar-day" style="color: var(--gray-500); width: 20px;"></i>
                    ${agenda.date ? new Date(agenda.date).toLocaleDateString('id-ID', { 
                        day: 'numeric', 
                        month: 'long', 
                        year: 'numeric' 
                    }) : '<span style="color: var(--gray-400);">Tanggal tidak ditentukan</span>'}
                </div>
                <div style="margin-bottom: 5px;">
                    <i class="fas fa-clock" style="color: var(--gray-500); width: 20px;"></i>
                    ${agenda.time ? agenda.time + ' WIB' : '<span style="color: var(--gray-400);">Waktu tidak ditentukan</span>'}
                </div>
                <div>
                    <i class="fas fa-map-marker-alt" style="color: var(--gray-500); width: 20px;"></i>
                    ${agenda.location || '<span style="color: var(--gray-400);">Lokasi tidak ditentukan</span>'}
                </div>
            </div>
        </div>
        
        <div class="detail-item">
            <div class="detail-label">
                <i class="fas fa-info-circle"></i> Status
            </div>
            <div class="detail-value">
                ${statusBadge[agenda.status] || '-'}
            </div>
        </div>
        
        <div class="detail-item">
            <div class="detail-label">
                <i class="fas fa-user"></i> Dibuat Oleh
            </div>
            <div class="detail-value">
                <div style="font-weight: 500;">${agenda.user?.name || 'Unknown'}</div>
                <div style="font-size: 0.8rem; color: var(--gray-500);">${agenda.user?.email || ''}</div>
            </div>
        </div>
        
        <div class="detail-item">
            <div class="detail-label">
                <i class="fas fa-history"></i> Riwayat
            </div>
            <div class="detail-value">
                <div style="margin-bottom: 3px; font-size: 0.9rem;">
                    <span style="color: var(--gray-500);">Dibuat:</span> ${formatDate(agenda.created_at)}
                </div>
                <div style="font-size: 0.9rem;">
                    <span style="color: var(--gray-500);">Diperbarui:</span> ${formatDate(agenda.updated_at)}
                </div>
            </div>
        </div>
    `;

    document.getElementById('agendaModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

// Close modal
function closeModal() {
    document.getElementById('agendaModal').style.display = 'none';
    document.body.style.overflow = 'auto';
}

// Click outside modal to close
document.getElementById('agendaModal').addEventListener('click', function(e) {
    if (e.target === this) closeModal();
});

// ESC key to close
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeModal();
});

// Scroll hint visibility
const tableScroll = document.querySelector('.table-scroll');
const scrollHint = document.querySelector('.scroll-hint');

if (tableScroll && scrollHint) {
    tableScroll.addEventListener('scroll', function() {
        scrollHint.style.opacity = '0.5';
        setTimeout(() => {
            scrollHint.style.opacity = '0.9';
        }, 1000);
    });
}

// Add animation on page load
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.stat-card');
    cards.forEach((card, index) => {
        card.style.animation = `slideIn 0.3s ease ${index * 0.1}s both`;
    });
});
</script>
@endsection
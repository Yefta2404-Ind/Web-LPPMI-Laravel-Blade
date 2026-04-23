@extends('layouts.cms')

@section('page-title', 'Agenda Saya')
@section('content')
<style>
    /* ============================================================
       RESET & BASE
    ============================================================ */
    *, *::before, *::after {
        box-sizing: border-box;
    }

    /* ============================================================
       CSS VARIABLES
    ============================================================ */
    :root {
        --pr: #2563eb;
        --pr-dk: #1d4ed8;
        --pr-lt: #eff6ff;
        --ok: #10b981;
        --ok-lt: #d1fae5;
        --ok-dk: #065f46;
        --wn: #f59e0b;
        --wn-lt: #fef3c7;
        --wn-dk: #92400e;
        --er: #ef4444;
        --er-lt: #fee2e2;
        --er-dk: #991b1b;
        --in: #3b82f6;
        --in-lt: #dbeafe;
        --in-dk: #1e40af;
        --g50: #f9fafb;
        --g100: #f3f4f6;
        --g200: #e5e7eb;
        --g300: #d1d5db;
        --g400: #9ca3af;
        --g500: #6b7280;
        --g600: #4b5563;
        --g700: #374151;
        --g800: #1f2937;
        --rad: 8px;
        --rad-lg: 12px;
        --shadow: 0 1px 3px rgba(0,0,0,.08);
        --shadow-md: 0 4px 8px -1px rgba(0,0,0,.1);
    }

    /* ============================================================
       CONTAINER
    ============================================================ */
    .agenda-wrap {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 clamp(12px, 2vw, 32px);
        container-type: inline-size;
    }

    /* ============================================================
       HEADER
    ============================================================ */
    .agenda-hdr {
        padding-bottom: 16px;
        margin-bottom: 20px;
        border-bottom: 1px solid var(--g200);
    }

    .agenda-hdr h1 {
        font-size: clamp(1.125rem, 2.5cqi, 1.625rem);
        font-weight: 700;
        color: var(--g800);
        margin: 0 0 4px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .agenda-hdr p {
        font-size: clamp(0.75rem, 1.5cqi, 0.875rem);
        color: var(--g600);
        margin: 0;
    }

    /* ============================================================
       INFO NOTE
    ============================================================ */
    .info-note {
        background: var(--in-lt);
        border-left: 4px solid var(--in);
        border-radius: 0 var(--rad) var(--rad) 0;
        padding: clamp(10px, 1.5cqi, 14px) clamp(12px, 2cqi, 18px);
        margin-bottom: 20px;
        display: flex;
        gap: clamp(8px, 1.5cqi, 12px);
        align-items: flex-start;
    }

    .info-note-icon {
        color: var(--in);
        font-size: clamp(0.875rem, 1.5cqi, 1.125rem);
        flex-shrink: 0;
        margin-top: 2px;
    }

    .info-note-title {
        font-weight: 600;
        font-size: clamp(0.75rem, 1.4cqi, 0.875rem);
        color: var(--g800);
        margin-bottom: 4px;
    }

    .info-note-text {
        font-size: clamp(0.6875rem, 1.2cqi, 0.8125rem);
        color: var(--g700);
        line-height: 1.55;
        margin: 0;
    }

    .info-note-text strong {
        color: var(--in-dk);
        font-weight: 600;
    }

    /* ============================================================
       ALERTS
    ============================================================ */
    .alert {
        padding: clamp(10px, 1.5cqi, 13px) clamp(12px, 2cqi, 16px);
        border-radius: var(--rad);
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: clamp(0.75rem, 1.4cqi, 0.875rem);
        border-left: 3px solid;
    }

    .alert-success {
        background: var(--ok-lt);
        color: var(--ok-dk);
        border-color: var(--ok);
    }

    .alert-error {
        background: var(--er-lt);
        color: var(--er-dk);
        border-color: var(--er);
    }

    /* ============================================================
       STATS GRID
    ============================================================ */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: clamp(8px, 1.5cqi, 16px);
        margin-bottom: 20px;
    }

    .stat-card {
        background: #fff;
        border: 1px solid var(--g200);
        border-radius: var(--rad-lg);
        padding: clamp(10px, 1.8cqi, 18px);
        cursor: pointer;
        transition: border-color .2s, transform .2s, box-shadow .2s;
        display: flex;
        flex-direction: column;
        gap: clamp(6px, 1cqi, 10px);
    }

    .stat-card:hover {
        border-color: var(--pr);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .stat-card.active {
        border-color: var(--pr);
        background: var(--pr-lt);
    }

    .stat-icon {
        width: clamp(32px, 4cqi, 44px);
        height: clamp(32px, 4cqi, 44px);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: clamp(0.875rem, 1.5cqi, 1.125rem);
        flex-shrink: 0;
    }

    .stat-icon.total  { background: #dbeafe; color: var(--pr); }
    .stat-icon.pending { background: var(--wn-lt); color: var(--wn); }
    .stat-icon.approved { background: var(--ok-lt); color: var(--ok); }

    .stat-label {
        font-size: clamp(0.6rem, 1.1cqi, 0.6875rem);
        color: var(--g500);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .04em;
    }

    .stat-value {
        font-size: clamp(1.125rem, 2.8cqi, 1.75rem);
        font-weight: 700;
        color: var(--g800);
        line-height: 1;
    }

    /* stats horizontal on very small containers */
    @container (max-width: 420px) {
        .stats-grid {
            grid-template-columns: 1fr;
            gap: 8px;
        }
        .stat-card {
            flex-direction: row;
            align-items: center;
            gap: 12px;
        }
        .stat-info { flex: 1; }
    }

    /* ============================================================
       FILTERS CARD
    ============================================================ */
    .filters-card {
        background: #fff;
        border: 1px solid var(--g200);
        border-radius: var(--rad-lg);
        padding: clamp(12px, 2cqi, 18px);
        margin-bottom: 20px;
    }

    .filters-form {
        display: grid;
        grid-template-columns: 1fr;
        gap: clamp(8px, 1.5cqi, 14px);
    }

    @container (min-width: 580px) {
        .filters-form { grid-template-columns: repeat(2, 1fr); }
    }

    @container (min-width: 860px) {
        .filters-form { grid-template-columns: repeat(4, 1fr); }
    }

    .filter-label {
        font-size: clamp(0.6875rem, 1.2cqi, 0.8125rem);
        font-weight: 600;
        color: var(--g700);
        margin-bottom: 5px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .filter-select,
    .filter-input {
        width: 100%;
        padding: clamp(8px, 1.2cqi, 10px) clamp(10px, 1.5cqi, 13px);
        border: 1px solid var(--g300);
        border-radius: 6px;
        font-size: clamp(0.8125rem, 1.3cqi, 0.875rem);
        color: var(--g800);
        background: #fff;
        outline: none;
        transition: border-color .2s, box-shadow .2s;
        font-family: inherit;
    }

    .filter-select:focus,
    .filter-input:focus {
        border-color: var(--pr);
        box-shadow: 0 0 0 3px rgba(37,99,235,.1);
    }

    .search-group {
        display: flex;
        gap: 6px;
    }

    .search-group .filter-input {
        flex: 1;
        min-width: 0;
    }

    /* Buttons */
    .btn {
        padding: clamp(8px, 1.2cqi, 10px) clamp(12px, 1.8cqi, 16px);
        border-radius: 6px;
        font-size: clamp(0.75rem, 1.2cqi, 0.875rem);
        font-weight: 600;
        cursor: pointer;
        border: 1px solid transparent;
        transition: all .2s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        text-decoration: none;
        white-space: nowrap;
        font-family: inherit;
    }

    .btn-primary {
        background: var(--pr);
        color: #fff;
        border-color: var(--pr);
    }

    .btn-primary:hover { background: var(--pr-dk); border-color: var(--pr-dk); }

    .btn-outline {
        background: #fff;
        border-color: var(--g300);
        color: var(--g700);
    }

    .btn-outline:hover { background: var(--g50); }

    /* ============================================================
       AGENDA GRID
    ============================================================ */
    .agenda-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: clamp(12px, 2cqi, 22px);
        margin-bottom: 32px;
    }

    @container (min-width: 580px) {
        .agenda-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @container (min-width: 920px) {
        .agenda-grid { grid-template-columns: repeat(3, 1fr); }
    }

    @container (min-width: 1240px) {
        .agenda-grid { grid-template-columns: repeat(4, 1fr); }
    }

    /* ============================================================
       AGENDA CARD
    ============================================================ */
    .agenda-card {
        background: #fff;
        border: 1px solid var(--g200);
        border-radius: var(--rad-lg);
        overflow: hidden;
        transition: border-color .2s, transform .2s, box-shadow .2s;
        display: flex;
        flex-direction: column;
    }

    .agenda-card:hover {
        border-color: var(--pr);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .agenda-card.archived {
        opacity: .8;
        border-left: 3px solid var(--in);
    }

    /* Card Header */
    .card-header {
        padding: clamp(12px, 2cqi, 18px);
        background: var(--g50);
        border-bottom: 1px solid var(--g200);
    }

    .card-date {
        font-size: clamp(0.6875rem, 1.1cqi, 0.75rem);
        color: var(--g500);
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 5px;
        flex-wrap: wrap;
    }

    .card-title {
        font-size: clamp(0.875rem, 1.6cqi, 1rem);
        font-weight: 600;
        color: var(--g800);
        margin: 0 0 10px;
        line-height: 1.4;
    }

    /* Status Badge */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: clamp(3px, .5cqi, 4px) clamp(7px, 1cqi, 10px);
        border-radius: 20px;
        font-size: clamp(0.625rem, 1cqi, 0.6875rem);
        font-weight: 600;
    }

    .status-draft    { background: var(--g100); color: var(--g600); }
    .status-pending  { background: var(--wn-lt); color: var(--wn-dk); }
    .status-approved { background: var(--ok-lt); color: var(--ok-dk); }
    .status-rejected { background: var(--er-lt); color: var(--er-dk); }
    .status-archived { background: var(--in-lt); color: var(--in-dk); }

    /* Card Body */
    .card-body {
        padding: clamp(12px, 2cqi, 18px);
        flex: 1;
    }

    .card-description {
        color: var(--g600);
        font-size: clamp(0.75rem, 1.2cqi, 0.8125rem);
        line-height: 1.55;
        margin-bottom: 12px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .details-list {
        background: var(--g50);
        border-radius: 6px;
        padding: clamp(8px, 1.2cqi, 10px);
        margin-bottom: 0;
    }

    .detail-item {
        display: flex;
        align-items: flex-start;
        gap: 7px;
        padding: clamp(3px, .6cqi, 5px) 0;
        font-size: clamp(0.6875rem, 1.1cqi, 0.75rem);
        color: var(--g600);
        line-height: 1.4;
    }

    .detail-item i {
        width: 14px;
        text-align: center;
        flex-shrink: 0;
        color: var(--g400);
        margin-top: 1px;
        font-size: 0.75rem;
    }

    /* Card Footer */
    .card-footer {
        padding: clamp(10px, 1.5cqi, 14px) clamp(12px, 2cqi, 18px);
        border-top: 1px solid var(--g200);
        display: flex;
        gap: 8px;
    }

    @container (max-width: 320px) {
        .card-footer { flex-direction: column; }
    }

    .action-btn {
        flex: 1;
        padding: clamp(7px, 1.1cqi, 9px) clamp(8px, 1.3cqi, 12px);
        border-radius: 6px;
        font-size: clamp(0.6875rem, 1.1cqi, 0.8125rem);
        font-weight: 600;
        text-align: center;
        cursor: pointer;
        border: 1px solid;
        background: #fff;
        transition: all .2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        font-family: inherit;
    }

    .action-edit { border-color: var(--pr); color: var(--pr); }
    .action-edit:hover { background: var(--pr); color: #fff; }

    .action-delete { border-color: var(--er); color: var(--er-dk); }
    .action-delete:hover { background: var(--er); color: #fff; }

    .locked-msg {
        background: var(--g100);
        border-radius: 6px;
        padding: clamp(7px, 1.1cqi, 9px) clamp(8px, 1.3cqi, 12px);
        text-align: center;
        color: var(--g500);
        font-size: clamp(0.6875rem, 1.1cqi, 0.75rem);
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
    }

    /* ============================================================
       EMPTY STATE
    ============================================================ */
    .empty-state {
        text-align: center;
        padding: clamp(28px, 5cqi, 56px) 16px;
        grid-column: 1 / -1;
    }

    .empty-state i {
        font-size: clamp(2rem, 5cqi, 3.5rem);
        color: var(--g300);
        display: block;
        margin-bottom: 14px;
    }

    .empty-state h3 {
        font-size: clamp(0.9375rem, 1.8cqi, 1.0625rem);
        font-weight: 600;
        color: var(--g600);
        margin: 0 0 6px;
    }

    .empty-state p {
        font-size: clamp(0.8125rem, 1.3cqi, 0.875rem);
        color: var(--g500);
        margin: 0 0 16px;
    }

    /* ============================================================
       PAGINATION
    ============================================================ */
    .pagination-wrap {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 32px;
    }

    .pagination-info {
        font-size: clamp(0.75rem, 1.2cqi, 0.8125rem);
        color: var(--g500);
    }

    .pagination {
        display: flex;
        align-items: center;
        gap: 4px;
        flex-wrap: wrap;
    }

    .page-link {
        padding: clamp(5px, .8cqi, 7px) clamp(9px, 1.2cqi, 12px);
        border-radius: 6px;
        font-size: clamp(0.75rem, 1.2cqi, 0.8125rem);
        border: 1px solid var(--g200);
        background: #fff;
        color: var(--g700);
        cursor: pointer;
        transition: all .2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        font-family: inherit;
    }

    .page-link:hover { background: var(--pr-lt); border-color: var(--pr); color: var(--pr); }
    .page-link.active { background: var(--pr); border-color: var(--pr); color: #fff; }
    .page-link[disabled] { opacity: .4; cursor: default; pointer-events: none; }

    /* ============================================================
       RESPONSIVE: mobile-first overrides
    ============================================================ */

    /* Mobile: stats become row cards */
    @media (max-width: 380px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
        .stat-card {
            flex-direction: row;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
        }
        .stat-icon { margin: 0; }
        .stat-info { flex: 1; }
        .stat-value { font-size: 1.25rem; }

        .card-footer { flex-direction: column; }
        .action-btn, .locked-msg { width: 100%; }

        .search-group { flex-direction: column; }
        .search-group .btn { width: 100%; }

        .pagination-wrap { justify-content: center; }
        .pagination-info { width: 100%; text-align: center; }
    }

    /* Touch devices */
    @media (hover: none) and (pointer: coarse) {
        .stat-card, .action-btn, .btn, .agenda-card {
            -webkit-tap-highlight-color: transparent;
        }
        .stat-card:active { transform: scale(.98); }
        .action-btn:active { transform: scale(.97); }
    }

    /* PC Scale 125% ~ viewport ~80% → tighten spacing */
    @media (max-width: 1200px) and (min-width: 900px) {
        .agenda-grid { grid-template-columns: repeat(2, 1fr); }
    }

    /* PC Scale 150% ~ viewport ~67% → same as tablet */
    @media (max-width: 900px) and (min-width: 640px) {
        .agenda-grid { grid-template-columns: repeat(2, 1fr); }
        .filters-form { grid-template-columns: repeat(2, 1fr); }
    }

    /* Large / 4K monitors */
    @media (min-width: 1600px) {
        .agenda-grid { grid-template-columns: repeat(4, 1fr); }
    }
</style>

<div class="agenda-wrap">

    {{-- ===== HEADER ===== --}}
    <div class="agenda-hdr">
        <h1>
            <i class="fas fa-calendar-alt"></i>
            Agenda Saya
        </h1>
        <p>Kelola semua agenda yang Anda buat</p>
    </div>

    {{-- ===== INFO NOTE ===== --}}
    <div class="info-note">
        <div class="info-note-icon">
            <i class="fas fa-info-circle"></i>
        </div>
        <div>
            <div class="info-note-title">
                <i class="fas fa-archive"></i> Sistem Arsip Otomatis
            </div>
            <p class="info-note-text">
                <strong>Perhatian:</strong> Agenda yang telah melewati <strong>3 (tiga) hari</strong>
                dari tanggal pelaksanaan akan <strong>secara otomatis ditarik</strong> dan
                <strong>tidak ditampilkan lagi</strong> di halaman publik.
                Agenda yang sudah diarsipkan hanya dapat dilihat di menu ini dan tidak dapat diedit kembali.
                <br>
                <i class="fas fa-clock"></i>
                <strong>Contoh:</strong> Agenda dengan tanggal 1 Januari 2024 akan otomatis diarsipkan
                pada tanggal 4 Januari 2024.
            </p>
        </div>
    </div>

    {{-- ===== ALERTS ===== --}}
    @if(session('success'))
        <div class="alert alert-success" id="js-alert">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error" id="js-alert">
            <i class="fas fa-exclamation-circle"></i>
            {{ session('error') }}
        </div>
    @endif

    {{-- ===== STATS ===== --}}
    @php
        $total    = $agendas->count();
        $pending  = $agendas->where('status', 'pending')->count();
        $approved = $agendas->where('status', 'approved')->count();
        $currSt   = request('status');
    @endphp

    <div class="stats-grid">
        <div class="stat-card {{ !$currSt ? 'active' : '' }}"
             onclick="filterByStatus('')">
            <div class="stat-icon total">
                <i class="fas fa-calendar"></i>
            </div>
            <div class="stat-info">
                <div class="stat-label">Total Agenda</div>
                <div class="stat-value">{{ $total }}</div>
            </div>
        </div>

        <div class="stat-card {{ $currSt == 'pending' ? 'active' : '' }}"
             onclick="filterByStatus('pending')">
            <div class="stat-icon pending">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-info">
                <div class="stat-label">Menunggu</div>
                <div class="stat-value">{{ $pending }}</div>
            </div>
        </div>

        <div class="stat-card {{ $currSt == 'approved' ? 'active' : '' }}"
             onclick="filterByStatus('approved')">
            <div class="stat-icon approved">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-info">
                <div class="stat-label">Disetujui</div>
                <div class="stat-value">{{ $approved }}</div>
            </div>
        </div>
    </div>

    {{-- ===== FILTERS ===== --}}
    <div class="filters-card">
        <form method="GET" action="{{ route('staff.agenda.index') }}"
              class="filters-form" id="filter-form">
            <div>
                <label class="filter-label">
                    <i class="fas fa-filter"></i> Status
                </label>
                <select name="status" class="filter-select"
                        onchange="this.form.submit()">
                    <option value="">Semua Status</option>
                    <option value="draft"    {{ request('status') == 'draft'    ? 'selected' : '' }}>Draft</option>
                    <option value="pending"  {{ request('status') == 'pending'  ? 'selected' : '' }}>Menunggu</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>

            <div>
                <label class="filter-label">
                    <i class="fas fa-sort"></i> Urutkan
                </label>
                <select name="sort" class="filter-select"
                        onchange="this.form.submit()">
                    <option value="latest"    {{ request('sort') == 'latest'    ? 'selected' : '' }}>Terbaru</option>
                    <option value="oldest"    {{ request('sort') == 'oldest'    ? 'selected' : '' }}>Terlama</option>
                    <option value="date_asc"  {{ request('sort') == 'date_asc'  ? 'selected' : '' }}>Tanggal (Awal)</option>
                    <option value="date_desc" {{ request('sort') == 'date_desc' ? 'selected' : '' }}>Tanggal (Akhir)</option>
                </select>
            </div>

            <div>
                <label class="filter-label">
                    <i class="fas fa-search"></i> Cari
                </label>
                <div class="search-group">
                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Cari judul agenda..."
                           class="filter-input">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                        <span>Cari</span>
                    </button>
                </div>
            </div>

            @if(request()->hasAny(['status', 'sort', 'search']))
                <div>
                    <label class="filter-label">&nbsp;</label>
                    <a href="{{ route('staff.agenda.index') }}"
                       class="btn btn-outline" style="width:100%">
                        <i class="fas fa-times"></i> Reset Filter
                    </a>
                </div>
            @endif
        </form>
    </div>

    {{-- ===== AGENDA GRID ===== --}}
    <div class="agenda-grid">
        @forelse($agendas as $agenda)
            @php
                $isArchived = \Carbon\Carbon::parse($agenda->date)->addDays(3)->isPast();
                $archiveDate = \Carbon\Carbon::parse($agenda->date)->addDays(3)->translatedFormat('d F Y');
                $statusIcon = match($agenda->status) {
                    'pending'  => 'fa-clock',
                    'approved' => 'fa-check-circle',
                    'rejected' => 'fa-times-circle',
                    default    => 'fa-edit',
                };
                $statusLabel = match($agenda->status) {
                    'pending'  => 'Menunggu',
                    'approved' => 'Disetujui',
                    'rejected' => 'Ditolak',
                    default    => 'Draft',
                };
            @endphp

            <div class="agenda-card {{ $isArchived ? 'archived' : '' }}">

                {{-- Card Header --}}
                <div class="card-header">
                    <div class="card-date">
                        <i class="far fa-calendar-alt"></i>
                        {{ \Carbon\Carbon::parse($agenda->date)->translatedFormat('d F Y') }}
                        @if($isArchived)
                            <span class="status-badge status-archived">
                                <i class="fas fa-archive"></i> Diarsipkan
                            </span>
                        @endif
                    </div>
                    <h3 class="card-title">{{ Str::limit($agenda->title, 65) }}</h3>
                    <span class="status-badge status-{{ $agenda->status }}">
                        <i class="fas {{ $statusIcon }}"></i>
                        {{ $statusLabel }}
                    </span>
                </div>

                {{-- Card Body --}}
                <div class="card-body">
                    @if($agenda->description)
                        <div class="card-description">
                            {{ Str::limit($agenda->description, 110) }}
                        </div>
                    @endif

                    <div class="details-list">
                        <div class="detail-item">
                            <i class="fas fa-clock"></i>
                            <span>{{ \Carbon\Carbon::parse($agenda->time)->format('H:i') }} WIB</span>
                        </div>

                        @if($agenda->location)
                            <div class="detail-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>{{ Str::limit($agenda->location, 38) }}</span>
                            </div>
                        @endif

                        <div class="detail-item">
                            <i class="fas fa-calendar-plus"></i>
                            <span>Dibuat {{ $agenda->created_at->diffForHumans() }}</span>
                        </div>

                        @if($isArchived)
                            <div class="detail-item">
                                <i class="fas fa-archive"></i>
                                <span>Diarsipkan sejak {{ $archiveDate }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Card Footer --}}
                <div class="card-footer">
                    @if($agenda->status !== 'approved' && !$isArchived)
                        <a href="{{ route('staff.agenda.edit', $agenda->id) }}"
                           class="action-btn action-edit">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form method="POST"
                              action="{{ route('staff.agenda.destroy', $agenda->id) }}"
                              style="flex:1; display:flex;"
                              onsubmit="return confirm('Yakin ingin menghapus agenda ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="action-btn action-delete"
                                    style="width:100%">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>

                    @elseif($isArchived)
                        <div class="locked-msg">
                            <i class="fas fa-archive"></i>
                            Telah diarsipkan
                        </div>

                    @else
                        <div class="locked-msg">
                            <i class="fas fa-lock"></i>
                            Sudah disetujui
                        </div>
                    @endif
                </div>
            </div>

        @empty
            <div class="empty-state">
                <i class="fas fa-calendar-times"></i>
                <h3>
                    @if(request()->hasAny(['status', 'search']))
                        Tidak ada agenda ditemukan
                    @else
                        Belum ada agenda
                    @endif
                </h3>
                <p>
                    @if(request()->hasAny(['status', 'search']))
                        Coba ubah filter atau kata kunci pencarian
                    @else
                        Mulai buat agenda pertama Anda
                    @endif
                </p>
                @if(request()->hasAny(['status', 'search']))
                    <a href="{{ route('staff.agenda.index') }}"
                       class="btn btn-outline">
                        <i class="fas fa-times"></i> Reset Filter
                    </a>
                @endif
            </div>
        @endforelse
    </div>

    {{-- ===== PAGINATION ===== --}}
    @if($agendas instanceof \Illuminate\Pagination\LengthAwarePaginator && $agendas->hasPages())
        <div class="pagination-wrap">
            <div class="pagination-info">
                Menampilkan {{ $agendas->firstItem() }}–{{ $agendas->lastItem() }}
                dari {{ $agendas->total() }} agenda
            </div>
            <div class="pagination">
                {{-- Previous --}}
                @if($agendas->onFirstPage())
                    <button class="page-link" disabled>
                        <i class="fas fa-chevron-left"></i>
                    </button>
                @else
                    <a class="page-link"
                       href="{{ $agendas->previousPageUrl() }}&{{ http_build_query(request()->except('page')) }}">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                @endif

                {{-- Page Numbers --}}
                @foreach($agendas->getUrlRange(1, $agendas->lastPage()) as $pg => $url)
                    <a class="page-link {{ $pg == $agendas->currentPage() ? 'active' : '' }}"
                       href="{{ $url }}&{{ http_build_query(request()->except('page')) }}">
                        {{ $pg }}
                    </a>
                @endforeach

                {{-- Next --}}
                @if($agendas->hasMorePages())
                    <a class="page-link"
                       href="{{ $agendas->nextPageUrl() }}&{{ http_build_query(request()->except('page')) }}">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                @else
                    <button class="page-link" disabled>
                        <i class="fas fa-chevron-right"></i>
                    </button>
                @endif
            </div>
        </div>
    @endif

</div>{{-- end .agenda-wrap --}}

<script>
/* ============================================================
   filterByStatus — klik stat card → ubah param URL
============================================================ */
function filterByStatus(status) {
    const url = new URL(window.location.href);
    url.searchParams.delete('page');
    if (status) {
        url.searchParams.set('status', status);
    } else {
        url.searchParams.delete('status');
    }
    window.location.href = url.toString();
}

/* ============================================================
   Auto-hide alert setelah 4 detik
============================================================ */
(function () {
    const alert = document.getElementById('js-alert');
    if (!alert) return;
    setTimeout(() => {
        alert.style.transition = 'opacity .4s ease';
        alert.style.opacity = '0';
        setTimeout(() => alert.remove(), 400);
    }, 4000);
})();
</script>
@endsection
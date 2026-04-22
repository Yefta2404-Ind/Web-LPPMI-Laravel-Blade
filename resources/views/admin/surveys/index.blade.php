@extends('layouts.admin')

@section('page-title', 'Manajemen Survey')

@section('content')
<style>
@import url('https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,400&display=swap');

:root {
    --ink:       #0c0e14;
    --ink-2:     #1e2130;
    --ink-3:     #4a5068;
    --ink-4:     #8891aa;
    --surface:   #ffffff;
    --surface-2: #f6f7fb;
    --surface-3: #eef0f8;
    --border:    rgba(30, 33, 48, 0.09);
    --border-md: rgba(30, 33, 48, 0.15);

    --blue:      #2563eb;
    --blue-2:    #1d4ed8;
    --blue-bg:   #eff4ff;
    --blue-text: #1a3ea8;

    --green:     #059669;
    --green-bg:  #ecfdf5;
    --green-text:#065f46;

    --amber:     #d97706;
    --amber-bg:  #fffbeb;
    --amber-text:#92400e;

    --red:       #dc2626;
    --red-bg:    #fff1f2;
    --red-text:  #991b1b;

    --slate:     #64748b;
    --slate-bg:  #f1f5f9;
    --slate-text:#334155;

    --r-sm: 8px;
    --r-md: 12px;
    --r-lg: 16px;
    --r-xl: 20px;
    --r-2xl:28px;
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

body { font-family: 'DM Sans', sans-serif; background: var(--surface-2); color: var(--ink-2); }

/* ── WRAP ── */
.sw-wrap {
    max-width: 1320px;
    margin: 0 auto;
    padding: 28px 16px 64px;
}
@media (min-width: 768px)  { .sw-wrap { padding: 36px 28px 64px; } }
@media (min-width: 1280px) { .sw-wrap { padding: 44px 40px 64px; } }

/* ── HEADER ── */
.sw-hdr {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 16px;
    margin-bottom: 32px;
    padding-bottom: 24px;
    border-bottom: 1px solid var(--border);
}
.sw-hdr-left h1 {
    font-family: 'Sora', sans-serif;
    font-size: clamp(1.35rem, 3vw, 1.85rem);
    font-weight: 800;
    color: var(--ink);
    letter-spacing: -0.03em;
    line-height: 1.2;
    margin-bottom: 5px;
}
.sw-hdr-left p { font-size: 0.875rem; color: var(--ink-3); }

.btn-new {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    background: var(--blue);
    color: #fff;
    border: none;
    border-radius: var(--r-lg);
    font-family: 'DM Sans', sans-serif;
    font-size: 0.875rem;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    transition: background 0.2s, transform 0.2s, box-shadow 0.2s;
    box-shadow: 0 2px 12px rgba(37,99,235,0.3);
    white-space: nowrap;
}
.btn-new:hover { background: var(--blue-2); transform: translateY(-2px); box-shadow: 0 6px 20px rgba(37,99,235,0.35); }

/* ── ALERTS ── */
.alert {
    display: flex; align-items: center; gap: 10px;
    padding: 13px 16px;
    border-radius: var(--r-md);
    font-size: 0.875rem; font-weight: 500;
    margin-bottom: 24px;
    animation: slideDown 0.3s ease;
}
@keyframes slideDown { from { opacity:0; transform:translateY(-10px); } to { opacity:1; transform:translateY(0); } }
.alert-success { background: var(--green-bg); color: var(--green-text); border: 1px solid rgba(5,150,105,0.2); }
.alert-error   { background: var(--red-bg);   color: var(--red-text);   border: 1px solid rgba(220,38,38,0.2); }

/* ── STATS ── */
.stats-row {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 12px;
    margin-bottom: 28px;
}
@media (min-width: 640px)  { .stats-row { grid-template-columns: repeat(4, 1fr); gap: 16px; } }
@media (min-width: 1024px) { .stats-row { gap: 20px; } }

.stat-card {
    background: var(--surface);
    border: 1.5px solid var(--border);
    border-radius: var(--r-xl);
    padding: 18px 16px;
    transition: transform 0.2s, box-shadow 0.2s, border-color 0.2s;
    cursor: default;
    position: relative;
    overflow: hidden;
}
.stat-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    border-radius: 2px 2px 0 0;
    opacity: 0;
    transition: opacity 0.2s;
}
.stat-card:hover { transform: translateY(-3px); box-shadow: 0 8px 28px rgba(12,14,20,0.08); border-color: var(--border-md); }
.stat-card:hover::before { opacity: 1; }
.stat-card.c-blue::before   { background: var(--blue); }
.stat-card.c-green::before  { background: var(--green); }
.stat-card.c-amber::before  { background: var(--amber); }
.stat-card.c-slate::before  { background: var(--slate); }

.stat-ico {
    width: 42px; height: 42px;
    border-radius: var(--r-md);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.1rem;
    margin-bottom: 14px;
}
.ico-blue  { background: var(--blue-bg);  color: var(--blue); }
.ico-green { background: var(--green-bg); color: var(--green); }
.ico-amber { background: var(--amber-bg); color: var(--amber); }
.ico-slate { background: var(--slate-bg); color: var(--slate); }

.stat-lbl {
    font-size: 0.68rem; font-weight: 700;
    text-transform: uppercase; letter-spacing: 0.07em;
    color: var(--ink-4); margin-bottom: 4px;
}
.stat-val {
    font-family: 'Sora', sans-serif;
    font-size: clamp(1.6rem, 3vw, 2rem);
    font-weight: 800;
    color: var(--ink);
    letter-spacing: -0.04em;
    line-height: 1;
}

/* ── INFO TIP ── */
.info-tip {
    display: flex; align-items: flex-start; gap: 10px;
    background: var(--blue-bg);
    border: 1px solid rgba(37,99,235,0.2);
    border-radius: var(--r-md);
    padding: 12px 16px;
    margin-bottom: 28px;
    font-size: 0.8rem;
    color: var(--blue-text);
    line-height: 1.5;
}
.info-tip i { flex-shrink: 0; margin-top: 2px; font-size: 0.9rem; }

/* ── SECTION LABEL ── */
.section-label {
    font-family: 'Sora', sans-serif;
    font-size: 0.875rem; font-weight: 700;
    color: var(--ink);
    letter-spacing: -0.01em;
    margin-bottom: 14px;
    display: flex; align-items: center; gap: 8px;
}
.section-label span {
    display: inline-flex; align-items: center;
    background: var(--surface-3);
    border: 1px solid var(--border-md);
    border-radius: 99px;
    padding: 2px 10px;
    font-size: 0.7rem; color: var(--ink-3); font-weight: 600;
}

/* ── DESKTOP TABLE ── */
.tbl-wrap {
    background: var(--surface);
    border: 1.5px solid var(--border);
    border-radius: var(--r-xl);
    overflow: hidden;
}
.tbl-wrap table {
    width: 100%;
    border-collapse: collapse;
    min-width: 720px;
}
.tbl-wrap table thead tr {
    background: var(--surface-2);
    border-bottom: 1.5px solid var(--border);
}
.tbl-wrap table th {
    padding: 13px 18px;
    text-align: left;
    font-size: 0.68rem; font-weight: 700;
    text-transform: uppercase; letter-spacing: 0.06em;
    color: var(--ink-4);
    white-space: nowrap;
}
.tbl-wrap table td {
    padding: 16px 18px;
    font-size: 0.82rem;
    border-bottom: 1px solid var(--border);
    vertical-align: middle;
}
.tbl-wrap table tbody tr:last-child td { border-bottom: none; }
.tbl-wrap table tbody tr { transition: background 0.15s; }
.tbl-wrap table tbody tr:hover { background: var(--surface-2); }
.tbl-wrap table tbody tr.row-active { background: var(--blue-bg); }
.tbl-wrap table tbody tr.row-active:hover { background: #e5edff; }

.tbl-title { font-weight: 600; color: var(--ink); font-size: 0.875rem; margin-bottom: 3px; }
.tbl-sub   { font-size: 0.72rem; color: var(--ink-3); line-height: 1.4; }
.tbl-meta  { font-size: 0.7rem; color: var(--ink-4); display: flex; align-items: center; gap: 5px; margin-top: 4px; }

/* ── STATUS BADGES ── */
.badge {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 4px 11px; border-radius: 99px;
    font-size: 0.68rem; font-weight: 700;
    letter-spacing: 0.02em; white-space: nowrap;
}
.badge-active  { background: var(--blue-bg);  color: var(--blue-text); border: 1px solid rgba(37,99,235,0.25); }
.badge-pending { background: var(--amber-bg); color: var(--amber-text);border: 1px solid rgba(217,119,6,0.25); }
.badge-archive { background: var(--slate-bg); color: var(--slate-text);border: 1px solid rgba(100,116,139,0.25); }
.badge i { font-size: 0.55rem; }

/* ── QR IN TABLE ── */
.qr-cell {
    display: flex; flex-direction: column; align-items: center; gap: 5px;
}
.qr-cell img {
    width: 52px; height: 52px;
    border: 1px solid var(--border-md);
    border-radius: var(--r-sm);
    padding: 2px;
    cursor: pointer;
    transition: transform 0.2s, box-shadow 0.2s;
}
.qr-cell img:hover { transform: scale(1.08); box-shadow: 0 4px 12px rgba(0,0,0,0.12); }
.qr-dl { font-size: 0.65rem; color: var(--blue); text-decoration: none; font-weight: 500; }
.qr-dl:hover { text-decoration: underline; }

/* ── ACTION BUTTONS ── */
.act-col { display: flex; flex-direction: column; gap: 6px; }
.btn-act {
    display: inline-flex; align-items: center; justify-content: center; gap: 6px;
    padding: 7px 14px; border-radius: var(--r-sm);
    font-family: 'DM Sans', sans-serif;
    font-size: 0.74rem; font-weight: 600;
    border: 1.5px solid transparent;
    cursor: pointer; transition: all 0.18s;
    text-decoration: none; white-space: nowrap;
}
.btn-act i { font-size: 0.7rem; }

.btn-approve { background: var(--green-bg); color: var(--green-text); border-color: rgba(5,150,105,0.3); }
.btn-approve:hover { background: var(--green); color: #fff; border-color: var(--green); }

.btn-activate { background: var(--blue-bg); color: var(--blue-text); border-color: rgba(37,99,235,0.3); }
.btn-activate:hover { background: var(--blue); color: #fff; border-color: var(--blue); }

.btn-del { background: var(--red-bg); color: var(--red-text); border-color: rgba(220,38,38,0.25); }
.btn-del:hover { background: var(--red); color: #fff; border-color: var(--red); }

.btn-off { background: var(--slate-bg); color: var(--slate-text); border-color: rgba(100,116,139,0.2); cursor: default; }

/* ── MOBILE CARDS ── */
.sw-cards { display: flex; flex-direction: column; gap: 14px; }

.sw-card {
    background: var(--surface);
    border: 1.5px solid var(--border);
    border-radius: var(--r-xl);
    overflow: hidden;
    transition: box-shadow 0.2s, border-color 0.2s;
    animation: cardIn 0.4s ease both;
}
@keyframes cardIn { from { opacity:0; transform:translateY(16px); } to { opacity:1; transform:translateY(0); } }
.sw-card:hover { box-shadow: 0 8px 28px rgba(12,14,20,0.08); border-color: var(--border-md); }

.sw-card.s-active  { border-left: 4px solid var(--blue); }
.sw-card.s-pending { border-left: 4px solid var(--amber); }
.sw-card.s-archive { border-left: 4px solid var(--slate); }

.sw-card-top {
    padding: 16px 16px 12px;
    border-bottom: 1px solid var(--border);
}
.sw-card-title-row {
    display: flex; align-items: flex-start; justify-content: space-between;
    gap: 10px; margin-bottom: 8px;
}
.sw-card-title {
    font-family: 'Sora', sans-serif;
    font-size: 0.95rem; font-weight: 700;
    color: var(--ink); line-height: 1.35;
    letter-spacing: -0.01em;
}
.sw-card-desc {
    font-size: 0.78rem; color: var(--ink-3); line-height: 1.5; margin-bottom: 10px;
}
.sw-card-metas {
    display: flex; flex-wrap: wrap; gap: 12px;
}
.sw-card-meta {
    display: flex; align-items: center; gap: 5px;
    font-size: 0.7rem; color: var(--ink-4);
}
.sw-card-meta a { color: var(--blue); text-decoration: none; font-weight: 500; }
.sw-card-meta i { font-size: 0.65rem; color: var(--blue); }

.sw-card-qr {
    display: flex; align-items: center; justify-content: space-between;
    padding: 12px 16px;
    background: var(--surface-2);
    border-bottom: 1px solid var(--border);
    gap: 12px;
}
.sw-card-qr-left { display: flex; align-items: center; gap: 10px; }
.sw-card-qr img {
    width: 48px; height: 48px;
    border: 1px solid var(--border-md);
    border-radius: var(--r-sm);
    padding: 2px; cursor: pointer;
}
.sw-card-qr-label { font-size: 0.72rem; font-weight: 600; color: var(--ink-3); }
.sw-card-qr-dl { font-size: 0.7rem; color: var(--blue); text-decoration: none; font-weight: 500; }
.sw-card-qr-none { font-size: 0.75rem; color: var(--ink-4); display: flex; align-items: center; gap: 6px; }

.sw-card-actions {
    display: flex; flex-wrap: wrap; gap: 8px;
    padding: 14px 16px;
}
.sw-card-actions .btn-act { flex: 1; min-width: 120px; }

/* ── OVERFLOW WRAPPER FOR DESKTOP TABLE ── */
.tbl-scroll { overflow-x: auto; }

/* ── RESPONSIVE VISIBILITY ── */
.desktop-only { display: none; }
.mobile-only  { display: flex; flex-direction: column; }
@media (min-width: 768px) {
    .desktop-only { display: block; }
    .mobile-only  { display: none; }
}

/* ── EMPTY STATE ── */
.empty-state {
    text-align: center;
    padding: 72px 24px;
    background: var(--surface);
    border-radius: var(--r-xl);
    border: 2px dashed var(--border-md);
}
.empty-ico {
    width: 72px; height: 72px;
    border-radius: 50%;
    background: var(--blue-bg);
    display: flex; align-items: center; justify-content: center;
    font-size: 2rem; color: var(--blue);
    margin: 0 auto 18px;
}
.empty-state h3 {
    font-family: 'Sora', sans-serif;
    font-size: 1.1rem; font-weight: 700; color: var(--ink); margin-bottom: 6px;
}
.empty-state p { font-size: 0.875rem; color: var(--ink-3); margin-bottom: 20px; }

/* ── QR MODAL ── */
.qr-modal-bd {
    display: none;
    position: fixed; top:0; left:0;
    width:100%; height:100%;
    background: rgba(12,14,20,0.7);
    backdrop-filter: blur(6px);
    z-index: 99999;
    align-items: center; justify-content: center;
    padding: 20px;
}
.qr-modal-bd.open { display: flex; }
.qr-modal-box {
    background: var(--surface);
    border-radius: var(--r-2xl);
    width: 100%; max-width: 380px;
    overflow: hidden;
    box-shadow: 0 32px 80px rgba(12,14,20,0.28);
    border: 1.5px solid var(--border-md);
    animation: modalIn 0.3s cubic-bezier(.34,1.56,.64,1);
}
@keyframes modalIn { from { opacity:0; transform:scale(0.9); } to { opacity:1; transform:scale(1); } }
.qr-modal-hdr {
    display: flex; align-items: center; justify-content: space-between;
    padding: 18px 22px;
    border-bottom: 1px solid var(--border);
}
.qr-modal-hdr h3 {
    font-family: 'Sora', sans-serif;
    font-size: 0.95rem; font-weight: 700; color: var(--ink);
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    max-width: 260px;
}
.qr-modal-close {
    width: 30px; height: 30px;
    border-radius: 50%;
    background: var(--surface-3);
    border: none; cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.9rem; color: var(--ink-3);
    transition: background 0.15s, color 0.15s;
}
.qr-modal-close:hover { background: var(--red-bg); color: var(--red); }
.qr-modal-body {
    padding: 24px 22px 20px;
    display: flex; flex-direction: column; align-items: center; gap: 18px;
}
.qr-modal-body img {
    width: 200px; height: 200px;
    border: 1px solid var(--border-md);
    border-radius: var(--r-lg);
    padding: 8px;
}
.qr-modal-dl {
    display: inline-flex; align-items: center; gap: 7px;
    padding: 10px 22px; border-radius: var(--r-md);
    background: var(--blue); color: #fff;
    font-family: 'DM Sans', sans-serif;
    font-size: 0.875rem; font-weight: 600;
    text-decoration: none;
    transition: background 0.2s, transform 0.2s;
    box-shadow: 0 3px 12px rgba(37,99,235,0.3);
}
.qr-modal-dl:hover { background: var(--blue-2); transform: translateY(-1px); }

/* form display fix */
form { display: contents; }

/* ── TOUCH DEVICE ── */
@media (hover:none) and (pointer:coarse) {
    .btn-act, .btn-new { min-height: 44px; }
}
</style>

<div class="sw-wrap">

    {{-- HEADER --}}
    <div class="sw-hdr">
        <div class="sw-hdr-left">
            <h1>Manajemen Survey</h1>
            <p>Kelola, aktifkan, dan pantau survey publik</p>
        </div>
        <a href="{{ route('admin.surveys.create') }}" class="btn-new">
            <i class="fas fa-plus"></i> Buat Survey Baru
        </a>
    </div>

    {{-- ALERTS --}}
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif
    @if(session('error') || $errors->any())
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i>
            {{ session('error') ?? $errors->first() }}
        </div>
    @endif

    {{-- STATS --}}
    @php
        $totalSurveys    = $surveys->count();
        $activeSurveys   = $surveys->where('status', 'approved')->count();
        $pendingSurveys  = $surveys->where('status', 'pending')->count();
        $archivedSurveys = $surveys->where('status', 'archived')->count();
    @endphp

    <div class="stats-row">
        <div class="stat-card c-blue">
            <div class="stat-ico ico-blue"><i class="fas fa-poll"></i></div>
            <div class="stat-lbl">Total Survey</div>
            <div class="stat-val">{{ $totalSurveys }}</div>
        </div>
        <div class="stat-card c-green">
            <div class="stat-ico ico-green"><i class="fas fa-circle-check"></i></div>
            <div class="stat-lbl">Aktif</div>
            <div class="stat-val">{{ $activeSurveys }}</div>
        </div>
        <div class="stat-card c-amber">
            <div class="stat-ico ico-amber"><i class="fas fa-hourglass-half"></i></div>
            <div class="stat-lbl">Pending</div>
            <div class="stat-val">{{ $pendingSurveys }}</div>
        </div>
        <div class="stat-card c-slate">
            <div class="stat-ico ico-slate"><i class="fas fa-box-archive"></i></div>
            <div class="stat-lbl">Diarsipkan</div>
            <div class="stat-val">{{ $archivedSurveys }}</div>
        </div>
    </div>

    {{-- INFO TIP --}}
    <div class="info-tip">
        <i class="fas fa-lightbulb"></i>
        <div><strong>Tips:</strong> Klik <strong>Aktifkan</strong> untuk menampilkan survey ke publik. Hanya satu survey yang dapat aktif dalam satu waktu — mengaktifkan survey baru akan menonaktifkan yang lama.</div>
    </div>

    @if($surveys->count() > 0)
        @php $activeSurvey = $surveys->where('status', 'approved')->first(); @endphp

        <div class="section-label">
            Semua Survey <span>{{ $surveys->count() }} entri</span>
        </div>

        {{-- ═══ DESKTOP TABLE ═══ --}}
        <div class="desktop-only">
            <div class="tbl-wrap">
                <div class="tbl-scroll">
                    <table>
                        <thead>
                            <tr>
                                <th>Informasi Survey</th>
                                <th>Status</th>
                                <th>QR Code</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($surveys as $survey)
                                @php $isActive = $activeSurvey && $survey->id === $activeSurvey->id; @endphp
                                <tr class="{{ $isActive ? 'row-active' : '' }}">
                                    <td style="max-width:320px;">
                                        <div class="tbl-title">{{ $survey->title }}</div>
                                        @if($survey->description)
                                            <div class="tbl-sub">{{ Str::limit($survey->description, 70) }}</div>
                                        @endif
                                        <div class="tbl-meta">
                                            <i class="fas fa-user"></i> {{ $survey->user->name ?? 'Admin' }}
                                            <span style="opacity:0.4;">·</span>
                                            <i class="fas fa-calendar"></i> {{ $survey->created_at->format('d M Y') }}
                                            @if($survey->survey_url)
                                                <span style="opacity:0.4;">·</span>
                                                <a href="{{ $survey->survey_url }}" target="_blank" style="color:var(--blue);text-decoration:none;font-weight:500;">
                                                    <i class="fas fa-external-link-alt"></i> Buka Form
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        @if($isActive)
                                            <span class="badge badge-active"><i class="fas fa-play"></i> Aktif</span>
                                        @elseif($survey->status === 'pending')
                                            <span class="badge badge-pending"><i class="fas fa-clock"></i> Pending</span>
                                        @else
                                            <span class="badge badge-archive"><i class="fas fa-archive"></i> Arsip</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($survey->qr_code)
                                            <div class="qr-cell">
                                                <img src="{{ asset('storage/' . $survey->qr_code) }}"
                                                     onclick="openQr('{{ asset('storage/' . $survey->qr_code) }}', '{{ addslashes($survey->title) }}')"
                                                     alt="QR">
                                                <a href="{{ asset('storage/' . $survey->qr_code) }}" download class="qr-dl">
                                                    <i class="fas fa-download"></i> Download
                                                </a>
                                            </div>
                                        @else
                                            <span style="font-size:0.75rem;color:var(--ink-4);">Tidak ada</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="act-col">
                                            @if($isActive)
                                                <span class="btn-act btn-off"><i class="fas fa-check-circle"></i> Sedang Aktif</span>
                                            @elseif($survey->status === 'pending')
                                                <form method="POST" action="{{ route('admin.surveys.approve', $survey) }}">
                                                    @csrf
                                                    <button class="btn-act btn-approve" onclick="return confirm('Setujui survey ini?')">
                                                        <i class="fas fa-check"></i> Approve
                                                    </button>
                                                </form>
                                                <form method="POST" action="{{ route('admin.surveys.destroy', $survey) }}">
                                                    @csrf @method('DELETE')
                                                    <button class="btn-act btn-del" onclick="return confirm('Hapus survey ini?')">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            @else
                                                <form method="POST" action="{{ route('admin.surveys.activate', $survey) }}">
                                                    @csrf
                                                    <button class="btn-act btn-activate" onclick="return confirm('Aktifkan survey ini?')">
                                                        <i class="fas fa-play"></i> Aktifkan
                                                    </button>
                                                </form>
                                                <form method="POST" action="{{ route('admin.surveys.destroy', $survey) }}">
                                                    @csrf @method('DELETE')
                                                    <button class="btn-act btn-del" onclick="return confirm('Hapus permanen?')">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- ═══ MOBILE CARDS ═══ --}}
        <div class="mobile-only sw-cards">
            @foreach($surveys as $index => $survey)
                @php
                    $isActive = $activeSurvey && $survey->id === $activeSurvey->id;
                    $sc = $isActive ? 's-active' : ($survey->status === 'pending' ? 's-pending' : 's-archive');
                @endphp
                <div class="sw-card {{ $sc }}" style="animation-delay:{{ $index * 0.05 }}s">
                    <div class="sw-card-top">
                        <div class="sw-card-title-row">
                            <div class="sw-card-title">{{ $survey->title }}</div>
                            @if($isActive)
                                <span class="badge badge-active"><i class="fas fa-play"></i> Aktif</span>
                            @elseif($survey->status === 'pending')
                                <span class="badge badge-pending"><i class="fas fa-clock"></i> Pending</span>
                            @else
                                <span class="badge badge-archive"><i class="fas fa-archive"></i> Arsip</span>
                            @endif
                        </div>
                        @if($survey->description)
                            <div class="sw-card-desc">{{ Str::limit($survey->description, 100) }}</div>
                        @endif
                        <div class="sw-card-metas">
                            <div class="sw-card-meta"><i class="fas fa-user"></i> {{ $survey->user->name ?? 'Admin' }}</div>
                            <div class="sw-card-meta"><i class="fas fa-calendar"></i> {{ $survey->created_at->format('d M Y') }}</div>
                            @if($survey->survey_url)
                                <div class="sw-card-meta">
                                    <a href="{{ $survey->survey_url }}" target="_blank">
                                        <i class="fas fa-external-link-alt"></i> Buka Form
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="sw-card-qr">
                        @if($survey->qr_code)
                            <div class="sw-card-qr-left">
                                <img src="{{ asset('storage/' . $survey->qr_code) }}"
                                     onclick="openQr('{{ asset('storage/' . $survey->qr_code) }}', '{{ addslashes($survey->title) }}')"
                                     alt="QR">
                                <div>
                                    <div class="sw-card-qr-label">QR Code</div>
                                    <a href="{{ asset('storage/' . $survey->qr_code) }}" download class="sw-card-qr-dl">
                                        <i class="fas fa-download"></i> Download
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="sw-card-qr-none"><i class="fas fa-qrcode"></i> QR tidak tersedia</div>
                        @endif
                    </div>

                    <div class="sw-card-actions">
                        @if($isActive)
                            <span class="btn-act btn-off" style="flex:1;"><i class="fas fa-check-circle"></i> Sedang Aktif</span>
                        @elseif($survey->status === 'pending')
                            <form method="POST" action="{{ route('admin.surveys.approve', $survey) }}" style="flex:1;">
                                @csrf
                                <button class="btn-act btn-approve" style="width:100%;" onclick="return confirm('Setujui survey ini?')">
                                    <i class="fas fa-check"></i> Approve
                                </button>
                            </form>
                            <form method="POST" action="{{ route('admin.surveys.destroy', $survey) }}" style="flex:1;">
                                @csrf @method('DELETE')
                                <button class="btn-act btn-del" style="width:100%;" onclick="return confirm('Hapus survey ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('admin.surveys.activate', $survey) }}" style="flex:1;">
                                @csrf
                                <button class="btn-act btn-activate" style="width:100%;" onclick="return confirm('Aktifkan survey ini?')">
                                    <i class="fas fa-play"></i> Aktifkan
                                </button>
                            </form>
                            <form method="POST" action="{{ route('admin.surveys.destroy', $survey) }}" style="flex:1;">
                                @csrf @method('DELETE')
                                <button class="btn-act btn-del" style="width:100%;" onclick="return confirm('Hapus permanen?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

    @else
        <div class="empty-state">
            <div class="empty-ico"><i class="fas fa-poll"></i></div>
            <h3>Belum Ada Survey</h3>
            <p>Buat survey pertama Anda dan generate QR code otomatis.</p>
            <a href="{{ route('admin.surveys.create') }}" class="btn-new">
                <i class="fas fa-plus"></i> Buat Survey Baru
            </a>
        </div>
    @endif

</div>

{{-- QR MODAL --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    var m = document.createElement('div');
    m.id = 'qrModal';
    m.className = 'qr-modal-bd';
    m.innerHTML =
        '<div class="qr-modal-box">' +
            '<div class="qr-modal-hdr">' +
                '<h3 id="qrTitle">QR Code</h3>' +
                '<button class="qr-modal-close" onclick="closeQr()"><i class="fas fa-times"></i></button>' +
            '</div>' +
            '<div class="qr-modal-body">' +
                '<img id="qrImg" src="" alt="QR Code">' +
                '<a id="qrDl" href="#" download class="qr-modal-dl"><i class="fas fa-download"></i> Download QR</a>' +
            '</div>' +
        '</div>';
    document.body.appendChild(m);
    m.addEventListener('click', function(e){ if(e.target===m) closeQr(); });
});

function openQr(src, title) {
    document.getElementById('qrImg').src = src;
    document.getElementById('qrTitle').textContent = title;
    document.getElementById('qrDl').href = src;
    document.getElementById('qrModal').classList.add('open');
    document.body.style.overflow = 'hidden';
}
function closeQr() {
    document.getElementById('qrModal').classList.remove('open');
    document.body.style.overflow = '';
}
document.addEventListener('keydown', function(e){ if(e.key==='Escape') closeQr(); });

// Auto-hide alerts
document.addEventListener('DOMContentLoaded', function(){
    document.querySelectorAll('.alert').forEach(function(el){
        setTimeout(function(){
            el.style.transition='opacity 0.4s,transform 0.4s';
            el.style.opacity='0'; el.style.transform='translateY(-6px)';
            setTimeout(function(){ el.remove(); }, 400);
        }, 5000);
    });
});
</script>

@endsection
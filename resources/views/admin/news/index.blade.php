@extends('layouts.admin')

@section('page-title', 'Manajemen Berita - Admin')
@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=DM+Sans:wght@400;500;600&display=swap');

:root {
    --ink: #0f1117;
    --ink-2: #2d3142;
    --ink-3: #5a607a;
    --ink-4: #8b92ab;
    --surface: #ffffff;
    --surface-2: #f7f8fc;
    --surface-3: #eef0f8;
    --border: rgba(45, 49, 66, 0.1);
    --border-strong: rgba(45, 49, 66, 0.18);

    --blue: #2a6ef5;
    --blue-bg: #eef3ff;
    --blue-text: #1a4db8;

    --amber: #f59e0b;
    --amber-bg: #fffbeb;
    --amber-text: #92400e;

    --green: #10b981;
    --green-bg: #ecfdf5;
    --green-text: #065f46;

    --red: #ef4444;
    --red-bg: #fff1f1;
    --red-text: #991b1b;

    --r-sm: 8px;
    --r-md: 12px;
    --r-lg: 16px;
    --r-xl: 20px;
    --r-2xl: 28px;
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

body {
    font-family: 'DM Sans', sans-serif;
    background: var(--surface-2);
    color: var(--ink-2);
    min-height: 100vh;
}

/* ── LAYOUT ── */
.wrap {
    max-width: 1480px;
    margin: 0 auto;
    padding: 28px 20px 60px;
}
@media (min-width: 768px)  { .wrap { padding: 36px 32px 60px; } }
@media (min-width: 1280px) { .wrap { padding: 44px 48px 60px; } }

/* ── HEADER ── */
.hdr {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 16px;
    margin-bottom: 36px;
    padding-bottom: 28px;
    border-bottom: 1px solid var(--border);
}

.hdr-left h1 {
    font-family: 'Sora', sans-serif;
    font-size: clamp(1.4rem, 3vw, 2rem);
    font-weight: 800;
    color: var(--ink);
    letter-spacing: -0.03em;
    line-height: 1.2;
    margin-bottom: 6px;
}

.hdr-left p {
    font-size: 0.875rem;
    color: var(--ink-3);
    max-width: 480px;
    line-height: 1.6;
}

.hdr-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 14px;
    background: var(--blue-bg);
    color: var(--blue-text);
    border-radius: 99px;
    font-size: 0.75rem;
    font-weight: 600;
    border: 1px solid rgba(42, 110, 245, 0.2);
    white-space: nowrap;
    align-self: flex-start;
    margin-top: 4px;
}

/* ── ALERTS ── */
.alert {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px 18px;
    border-radius: var(--r-md);
    margin-bottom: 24px;
    font-size: 0.875rem;
    font-weight: 500;
    animation: slideDown 0.35s ease;
}

@keyframes slideDown {
    from { opacity: 0; transform: translateY(-12px); }
    to   { opacity: 1; transform: translateY(0); }
}

.alert-success { background: var(--green-bg); color: var(--green-text); border: 1px solid rgba(16, 185, 129, 0.25); }
.alert-error   { background: var(--red-bg);   color: var(--red-text);   border: 1px solid rgba(239, 68, 68, 0.25); }
.alert i:first-child { font-size: 1rem; flex-shrink: 0; }
.alert-close { margin-left: auto; cursor: pointer; opacity: 0.6; transition: opacity 0.2s; }
.alert-close:hover { opacity: 1; }

/* ── STATS ── */
.stats-row {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 14px;
    margin-bottom: 32px;
}
@media (min-width: 520px)  { .stats-row { grid-template-columns: repeat(4, 1fr); } }
@media (min-width: 1024px) { .stats-row { gap: 20px; } }

.stat-card {
    background: var(--surface);
    border-radius: var(--r-xl);
    border: 1.5px solid var(--border);
    padding: 18px 16px 16px;
    cursor: pointer;
    transition: border-color 0.2s, box-shadow 0.2s, transform 0.2s;
    position: relative;
    overflow: hidden;
}

.stat-card::after {
    content: '';
    position: absolute;
    inset: 0;
    border-radius: inherit;
    opacity: 0;
    transition: opacity 0.2s;
}

.stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 32px rgba(42, 110, 245, 0.12);
    border-color: var(--blue);
}

.stat-card.active {
    border-color: var(--blue);
    background: var(--blue-bg);
    box-shadow: 0 4px 20px rgba(42, 110, 245, 0.15);
}
.stat-card.active-amber  { border-color: var(--amber); background: var(--amber-bg); }
.stat-card.active-green  { border-color: var(--green); background: var(--green-bg); }
.stat-card.active-red    { border-color: var(--red);   background: var(--red-bg);   }

.stat-ico {
    width: 40px; height: 40px;
    border-radius: var(--r-md);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.1rem;
    margin-bottom: 14px;
}
.ico-blue   { background: rgba(42, 110, 245, 0.12); color: var(--blue); }
.ico-amber  { background: rgba(245, 158, 11, 0.12); color: var(--amber); }
.ico-green  { background: rgba(16, 185, 129, 0.12); color: var(--green); }
.ico-red    { background: rgba(239, 68, 68, 0.12);  color: var(--red); }

.stat-lbl {
    font-size: 0.68rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.07em;
    color: var(--ink-4);
    margin-bottom: 4px;
}
.stat-val {
    font-family: 'Sora', sans-serif;
    font-size: clamp(1.6rem, 3.5vw, 2.1rem);
    font-weight: 800;
    color: var(--ink);
    letter-spacing: -0.03em;
    line-height: 1;
}

/* ── TOOLBAR (filter label) ── */
.toolbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 24px;
}
.toolbar-title {
    font-family: 'Sora', sans-serif;
    font-size: 1rem;
    font-weight: 700;
    color: var(--ink);
}
.toolbar-count {
    font-size: 0.8rem;
    color: var(--ink-3);
    background: var(--surface-3);
    padding: 4px 12px;
    border-radius: 99px;
    border: 1px solid var(--border);
}
@media (max-width: 520px) {
    .toolbar-title { font-size: 0.9rem; }
}

/* ── GRID ── */
.news-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 20px;
    margin-bottom: 40px;
}
@media (min-width: 580px)  { .news-grid { grid-template-columns: repeat(2, 1fr); gap: 18px; } }
@media (min-width: 1024px) { .news-grid { grid-template-columns: repeat(3, 1fr); gap: 22px; } }
@media (min-width: 1400px) { .news-grid { grid-template-columns: repeat(4, 1fr); gap: 24px; } }

/* ── NEWS CARD ── */
.news-card {
    background: var(--surface);
    border-radius: var(--r-xl);
    border: 1.5px solid var(--border);
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
    animation: cardIn 0.45s ease both;
    display: flex;
    flex-direction: column;
}

@keyframes cardIn {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
}

.news-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 16px 48px rgba(15, 17, 23, 0.1);
    border-color: var(--border-strong);
}

/* Thumb */
.card-thumb {
    position: relative;
    width: 100%;
    padding-top: 56.25%;
    background: var(--surface-3);
    overflow: hidden;
    flex-shrink: 0;
}
.card-thumb img {
    position: absolute;
    inset: 0;
    width: 100%; height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}
.news-card:hover .card-thumb img { transform: scale(1.06); }

/* Status pill */
.status-pill {
    position: absolute;
    top: 12px; right: 12px;
    display: inline-flex; align-items: center; gap: 5px;
    padding: 4px 11px;
    border-radius: 99px;
    font-size: 0.68rem;
    font-weight: 700;
    letter-spacing: 0.03em;
    backdrop-filter: blur(8px);
    z-index: 2;
}
.pill-pending  { background: rgba(245, 158, 11, 0.92);  color: #fff; }
.pill-approved { background: rgba(16, 185, 129, 0.92);  color: #fff; }
.pill-rejected { background: rgba(239, 68, 68, 0.92);   color: #fff; }
.pill-draft    { background: rgba(90, 96, 122, 0.82);   color: #fff; }
.status-pill i { font-size: 0.6rem; }

/* Card body */
.card-body {
    padding: 18px 18px 16px;
    display: flex;
    flex-direction: column;
    flex: 1;
}

.card-cat {
    display: inline-flex; align-items: center; gap: 5px;
    font-size: 0.68rem; font-weight: 700;
    text-transform: uppercase; letter-spacing: 0.05em;
    color: var(--blue-text);
    background: var(--blue-bg);
    padding: 3px 10px; border-radius: 99px;
    margin-bottom: 12px;
    width: fit-content;
}

.card-title {
    font-family: 'Sora', sans-serif;
    font-size: 0.95rem;
    font-weight: 700;
    color: var(--ink);
    line-height: 1.4;
    margin-bottom: 10px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    letter-spacing: -0.01em;
}

.card-excerpt {
    font-size: 0.8rem;
    color: var(--ink-3);
    line-height: 1.6;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    margin-bottom: 16px;
    flex: 1;
}

/* Meta */
.card-meta {
    display: flex;
    align-items: center;
    gap: 14px;
    flex-wrap: wrap;
    padding-top: 14px;
    border-top: 1px solid var(--border);
    margin-bottom: 12px;
}
.meta-chip {
    display: flex; align-items: center; gap: 5px;
    font-size: 0.7rem; color: var(--ink-4); font-weight: 500;
}
.meta-chip i { font-size: 0.65rem; color: var(--blue); }

/* Card actions */
.card-actions {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 8px;
}

.btn-icon {
    width: 34px; height: 34px;
    border-radius: var(--r-sm);
    display: flex; align-items: center; justify-content: center;
    border: 1.5px solid var(--border);
    background: transparent;
    color: var(--ink-4);
    cursor: pointer;
    transition: all 0.2s;
    text-decoration: none;
    font-size: 0.8rem;
}
.btn-icon:hover { border-color: var(--border-strong); color: var(--ink-2); background: var(--surface-2); }
.btn-del:hover  { border-color: var(--red);  color: var(--red);  background: var(--red-bg);  }

.btn-sm {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 7px 14px;
    border-radius: var(--r-sm);
    font-size: 0.75rem; font-weight: 600;
    border: 1.5px solid transparent;
    cursor: pointer;
    transition: all 0.2s;
    flex: 1; justify-content: center;
    text-decoration: none;
}
.btn-approve {
    background: var(--green-bg); color: var(--green-text);
    border-color: rgba(16, 185, 129, 0.3);
}
.btn-approve:hover { background: var(--green); color: #fff; border-color: var(--green); }

.btn-reject {
    background: var(--red-bg); color: var(--red-text);
    border-color: rgba(239, 68, 68, 0.3);
}
.btn-reject:hover { background: var(--red); color: #fff; border-color: var(--red); }

.approve-row {
    display: flex; gap: 8px;
    padding-top: 12px;
    border-top: 1px solid var(--border);
    margin-top: 10px;
}

/* ── EMPTY STATE ── */
.empty-state {
    grid-column: 1 / -1;
    text-align: center;
    padding: 80px 24px;
    background: var(--surface);
    border-radius: var(--r-2xl);
    border: 2px dashed var(--border-strong);
}
.empty-ico {
    width: 72px; height: 72px;
    border-radius: 50%;
    background: var(--blue-bg);
    display: flex; align-items: center; justify-content: center;
    font-size: 2rem; color: var(--blue);
    margin: 0 auto 20px;
}
.empty-state h3 {
    font-family: 'Sora', sans-serif;
    font-size: 1.2rem; font-weight: 700;
    color: var(--ink); margin-bottom: 8px;
}
.empty-state p { font-size: 0.875rem; color: var(--ink-3); margin-bottom: 24px; }
.btn-outline-sm {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 10px 20px; border-radius: var(--r-md);
    font-size: 0.875rem; font-weight: 600;
    border: 1.5px solid var(--border-strong);
    background: var(--surface);
    color: var(--ink-2);
    cursor: pointer; text-decoration: none;
    transition: all 0.2s;
}
.btn-outline-sm:hover { border-color: var(--blue); color: var(--blue); background: var(--blue-bg); }

/* ── PAGINATION ── */
.pagi-wrap {
    display: flex; align-items: center; justify-content: center;
    gap: 6px; flex-wrap: wrap;
    padding-top: 32px;
    border-top: 1px solid var(--border);
}
.page-btn {
    min-width: 38px; height: 38px;
    display: flex; align-items: center; justify-content: center;
    padding: 0 10px;
    border-radius: var(--r-md);
    border: 1.5px solid var(--border);
    background: var(--surface);
    font-size: 0.875rem; color: var(--ink-2); font-weight: 500;
    text-decoration: none;
    transition: all 0.2s;
    cursor: pointer;
}
.page-btn:hover        { border-color: var(--blue); color: var(--blue); background: var(--blue-bg); }
.page-btn.cur          { background: var(--blue); color: #fff; border-color: var(--blue); font-weight: 700; }
.page-btn.disabled     { opacity: 0.4; pointer-events: none; }

/* ── DELETE MODAL ── */
.modal-backdrop {
    position: fixed;
    top: 0; left: 0;
    width: 100vw; height: 100vh;
    background: rgba(15, 17, 23, 0.65);
    backdrop-filter: blur(5px);
    z-index: 99999;
    padding: 20px;
    opacity: 0; visibility: hidden;
    transition: opacity 0.25s, visibility 0.25s;
    /* center the box */
    display: flex;
    align-items: center;
    justify-content: center;
    /* isolate from any parent transform */
    transform: none !important;
    will-change: opacity;
}
.modal-backdrop.open { opacity: 1; visibility: visible; }

.modal-box {
    background: var(--surface);
    border-radius: var(--r-2xl);
    width: 100%; max-width: 460px;
    overflow: hidden;
    /* animation uses scale only — no translateY so vertical centering stays pure */
    transform: scale(0.93);
    transition: transform 0.3s cubic-bezier(.34,1.56,.64,1);
    box-shadow: 0 32px 80px rgba(15, 17, 23, 0.25);
    border: 1.5px solid var(--border-strong);
    position: relative;
}
.modal-backdrop.open .modal-box { transform: scale(1); }

.modal-head {
    padding: 28px 28px 20px;
    display: flex; align-items: flex-start; gap: 14px;
    border-bottom: 1px solid var(--border);
}
.modal-ico {
    width: 48px; height: 48px;
    border-radius: var(--r-lg);
    background: var(--red-bg);
    color: var(--red);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.25rem; flex-shrink: 0;
}
.modal-head-text h2 {
    font-family: 'Sora', sans-serif;
    font-size: 1.05rem; font-weight: 700;
    color: var(--ink); margin-bottom: 4px;
}
.modal-head-text p { font-size: 0.8rem; color: var(--ink-3); line-height: 1.5; }

.modal-body {
    padding: 20px 28px 24px;
}
.modal-news-title {
    background: var(--surface-2);
    border: 1px solid var(--border-strong);
    border-radius: var(--r-md);
    padding: 12px 14px;
    font-size: 0.875rem; font-weight: 600;
    color: var(--ink);
    margin-bottom: 16px;
    display: flex; align-items: flex-start; gap: 10px;
    line-height: 1.4;
}
.modal-news-title i { color: var(--blue); margin-top: 2px; flex-shrink: 0; }

.modal-warn {
    background: var(--red-bg);
    border: 1px solid rgba(239, 68, 68, 0.2);
    border-radius: var(--r-md);
    padding: 12px 14px;
    font-size: 0.8rem; color: var(--red-text);
    display: flex; align-items: flex-start; gap: 8px;
    line-height: 1.5;
}
.modal-warn i { flex-shrink: 0; margin-top: 2px; }

.modal-foot {
    padding: 16px 28px 24px;
    display: flex; gap: 10px; justify-content: flex-end;
}
.btn-cancel {
    display: inline-flex; align-items: center; gap: 7px;
    padding: 10px 20px; border-radius: var(--r-md);
    font-size: 0.875rem; font-weight: 600;
    border: 1.5px solid var(--border-strong);
    background: var(--surface); color: var(--ink-2);
    cursor: pointer; transition: all 0.2s;
}
.btn-cancel:hover { border-color: var(--blue); color: var(--blue); background: var(--blue-bg); }

.btn-del-confirm {
    display: inline-flex; align-items: center; gap: 7px;
    padding: 10px 22px; border-radius: var(--r-md);
    font-size: 0.875rem; font-weight: 700;
    border: none;
    background: var(--red); color: #fff;
    cursor: pointer; transition: all 0.2s;
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.35);
}
.btn-del-confirm:hover { background: #dc2626; box-shadow: 0 6px 20px rgba(239, 68, 68, 0.45); transform: translateY(-1px); }

/* ── RESPONSIVE TOUCH ── */
@media (hover: none) and (pointer: coarse) {
    .stat-card, .btn-icon, .btn-sm, .page-btn { min-height: 44px; }
    .btn-icon { min-width: 44px; }
    .news-card:hover { transform: none; box-shadow: none; }
    .stat-card:hover { transform: none; box-shadow: none; }
}

@media (max-width: 480px) {
    .card-body { padding: 14px 14px 12px; }
    .modal-head, .modal-body, .modal-foot { padding-left: 18px; padding-right: 18px; }
    .modal-foot { flex-direction: column-reverse; }
    .btn-cancel, .btn-del-confirm { width: 100%; justify-content: center; }
}
</style>

<div class="wrap">

    {{-- ── HEADER ── --}}
    <div class="hdr">
        <div class="hdr-left">
            <h1>Manajemen Berita</h1>
            <p>Kelola semua berita dari seluruh pengguna. Setujui, tolak, atau hapus konten dengan mudah.</p>
        </div>
        <div class="hdr-badge">
            <i class="fas fa-shield-alt"></i> Panel Admin
        </div>
    </div>

    {{-- ── ALERTS ── --}}
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
            <i class="fas fa-times alert-close" onclick="this.closest('.alert').remove()"></i>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i>
            <span>{{ session('error') }}</span>
            <i class="fas fa-times alert-close" onclick="this.closest('.alert').remove()"></i>
        </div>
    @endif

    {{-- ── STATS ── --}}
    @php
        $totalNews    = $news->total();
        $pendingCount = $news->where('status', 'pending')->count();
        $approvedCount= $news->where('status', 'approved')->count();
        $rejectedCount= $news->where('status', 'rejected')->count();
        $currentStatus= request('status');
    @endphp

    <div class="stats-row">
        <div class="stat-card {{ !$currentStatus ? 'active' : '' }}" onclick="filterByStatus('')">
            <div class="stat-ico ico-blue"><i class="fas fa-newspaper"></i></div>
            <div class="stat-lbl">Total Berita</div>
            <div class="stat-val">{{ number_format($totalNews) }}</div>
        </div>
        <div class="stat-card {{ $currentStatus == 'pending' ? 'active-amber' : '' }}" onclick="filterByStatus('pending')">
            <div class="stat-ico ico-amber"><i class="fas fa-clock"></i></div>
            <div class="stat-lbl">Menunggu</div>
            <div class="stat-val">{{ number_format($pendingCount) }}</div>
        </div>
        <div class="stat-card {{ $currentStatus == 'approved' ? 'active-green' : '' }}" onclick="filterByStatus('approved')">
            <div class="stat-ico ico-green"><i class="fas fa-check-circle"></i></div>
            <div class="stat-lbl">Disetujui</div>
            <div class="stat-val">{{ number_format($approvedCount) }}</div>
        </div>
        <div class="stat-card {{ $currentStatus == 'rejected' ? 'active-red' : '' }}" onclick="filterByStatus('rejected')">
            <div class="stat-ico ico-red"><i class="fas fa-times-circle"></i></div>
            <div class="stat-lbl">Ditolak</div>
            <div class="stat-val">{{ number_format($rejectedCount) }}</div>
        </div>
    </div>

    {{-- ── TOOLBAR ── --}}
    <div class="toolbar">
        <span class="toolbar-title">
            @if($currentStatus == 'pending')  Berita Menunggu Persetujuan
            @elseif($currentStatus == 'approved') Berita Disetujui
            @elseif($currentStatus == 'rejected') Berita Ditolak
            @else Semua Berita
            @endif
        </span>
        <span class="toolbar-count">{{ number_format($news->total()) }} berita</span>
    </div>

    {{-- ── NEWS GRID ── --}}
    <div class="news-grid">
        @forelse($news as $index => $n)
            <div class="news-card" style="animation-delay: {{ min($index * 0.04, 0.4) }}s">

                {{-- Thumb --}}
                <div class="card-thumb">
                    <img
                        src="{{ $n->image ? asset('storage/'.$n->image) : 'https://placehold.co/800x450/eef0f8/8b92ab?text=No+Image' }}"
                        alt="{{ $n->title }}"
                        loading="lazy"
                        onerror="this.src='https://placehold.co/800x450/eef0f8/8b92ab?text=No+Image'"
                    >
                    <span class="status-pill
                        @if($n->status === 'pending')  pill-pending
                        @elseif($n->status === 'approved') pill-approved
                        @elseif($n->status === 'rejected') pill-rejected
                        @else pill-draft
                        @endif">
                        @if($n->status === 'pending')  <i class="fas fa-clock"></i> Menunggu
                        @elseif($n->status === 'approved') <i class="fas fa-check-circle"></i> Disetujui
                        @elseif($n->status === 'rejected') <i class="fas fa-times-circle"></i> Ditolak
                        @else <i class="fas fa-file"></i> Draft
                        @endif
                    </span>
                </div>

                {{-- Body --}}
                <div class="card-body">
                    @if($n->category)
                        <span class="card-cat">
                            <i class="fas fa-folder"></i>
                            {{ $n->category->name ?? 'Uncategorized' }}
                        </span>
                    @endif

                    <h3 class="card-title">{{ Str::limit($n->title, 70) }}</h3>
                    <p class="card-excerpt">{{ Str::limit(strip_tags($n->content), 120) }}</p>

                    {{-- Meta --}}
                    <div class="card-meta">
                        <span class="meta-chip">
                            <i class="fas fa-user"></i>
                            {{ $n->user->name ?? 'Unknown' }}
                        </span>
                        <span class="meta-chip">
                            <i class="fas fa-calendar"></i>
                            {{ $n->created_at->translatedFormat('d M Y') }}
                        </span>
                        @if($n->views)
                            <span class="meta-chip">
                                <i class="fas fa-eye"></i>
                                {{ number_format($n->views) }}
                            </span>
                        @endif
                    </div>

                    {{-- Actions --}}
                    <div class="card-actions">
                        <span style="font-size: 0.7rem; color: var(--ink-4); font-weight: 500;">#{{ $n->id }}</span>
                        <div style="display:flex; gap:8px;">
                            <button
                                type="button"
                                class="btn-icon btn-del"
                                title="Hapus Berita"
                                onclick="showDeleteModal({{ $n->id }}, '{{ addslashes($n->title) }}')"
                            ><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>

                    {{-- Approve / Reject row --}}
                    @if($n->status === 'pending')
                        <div class="approve-row">
                            <form method="POST" action="{{ route('admin.news.approve', $n) }}" style="flex:1;">
                                @csrf
                                <button type="submit" class="btn-sm btn-approve"
                                    onclick="return confirm('Setujui berita ini dan publikasikan?')">
                                    <i class="fas fa-check"></i> Setujui
                                </button>
                            </form>
                            <form method="POST" action="{{ route('admin.news.reject', $n) }}" style="flex:1;">
                                @csrf
                                <button type="submit" class="btn-sm btn-reject"
                                    onclick="return confirm('Tolak berita ini?')">
                                    <i class="fas fa-times"></i> Tolak
                                </button>
                            </form>
                        </div>
                    @endif
                </div>

                {{-- Hidden delete form --}}
                <form id="del-form-{{ $n->id }}" method="POST"
                      action="{{ route('admin.news.destroy', $n) }}" style="display:none;">
                    @csrf
                    @method('DELETE')
                </form>

            </div>
        @empty
            <div class="empty-state">
                <div class="empty-ico"><i class="fas fa-newspaper"></i></div>
                <h3>
                    @if(request()->has('status'))
                        Tidak ada berita dengan status "{{ ucfirst(request('status')) }}"
                    @else
                        Belum ada berita
                    @endif
                </h3>
                <p>
                    @if(request()->has('status'))
                        Coba pilih filter lain untuk melihat berita yang tersedia.
                    @else
                        Belum ada berita yang dibuat oleh pengguna.
                    @endif
                </p>
                @if(request()->has('status'))
                    <a href="{{ route('admin.news.index') }}" class="btn-outline-sm">
                        <i class="fas fa-times"></i> Reset Filter
                    </a>
                @endif
            </div>
        @endforelse
    </div>

    {{-- ── PAGINATION ── --}}
    @if($news->hasPages())
        <div class="pagi-wrap">
            @if($news->onFirstPage())
                <span class="page-btn disabled"><i class="fas fa-chevron-left"></i></span>
            @else
                <a href="{{ $news->previousPageUrl() }}" class="page-btn"><i class="fas fa-chevron-left"></i></a>
            @endif

            @foreach($news->getUrlRange(1, $news->lastPage()) as $page => $url)
                @if($page == $news->currentPage())
                    <span class="page-btn cur">{{ $page }}</span>
                @elseif(abs($page - $news->currentPage()) <= 2 || $page == 1 || $page == $news->lastPage())
                    <a href="{{ $url }}" class="page-btn">{{ $page }}</a>
                @elseif(abs($page - $news->currentPage()) == 3)
                    <span class="page-btn disabled">…</span>
                @endif
            @endforeach

            @if($news->hasMorePages())
                <a href="{{ $news->nextPageUrl() }}" class="page-btn"><i class="fas fa-chevron-right"></i></a>
            @else
                <span class="page-btn disabled"><i class="fas fa-chevron-right"></i></span>
            @endif
        </div>
    @endif

</div>

<script>
// ── MODAL: di-append ke <body> langsung agar bebas dari parent stacking/transform ──
var pendingDelId = null;

document.addEventListener('DOMContentLoaded', function() {
    // Buat elemen modal dan append ke body
    var modal = document.createElement('div');
    modal.id = 'deleteModal';
    modal.style.cssText = 'display:none;position:fixed;top:0;left:0;width:100%;height:100%;' +
        'background:rgba(15,17,23,0.65);backdrop-filter:blur(5px);-webkit-backdrop-filter:blur(5px);' +
        'z-index:999999;align-items:center;justify-content:center;padding:20px;box-sizing:border-box;';

    modal.innerHTML =
        '<div id="delBox" style="background:#fff;border-radius:28px;width:100%;max-width:460px;overflow:hidden;' +
        'box-shadow:0 32px 80px rgba(15,17,23,0.25);border:1.5px solid rgba(45,49,66,0.18);' +
        'transition:transform 0.3s cubic-bezier(.34,1.56,.64,1),opacity 0.25s;transform:scale(0.93);opacity:0;">' +

            '<div style="padding:28px 28px 20px;display:flex;align-items:flex-start;gap:14px;border-bottom:1px solid rgba(45,49,66,0.1);">' +
                '<div style="width:48px;height:48px;border-radius:16px;background:#fff1f1;color:#ef4444;' +
                'display:flex;align-items:center;justify-content:center;font-size:1.25rem;flex-shrink:0;">' +
                    '<i class="fas fa-trash-alt"></i>' +
                '</div>' +
                '<div>' +
                    '<h2 style="font-family:Sora,sans-serif;font-size:1.05rem;font-weight:700;color:#0f1117;margin:0 0 4px;">Hapus Berita Permanen</h2>' +
                    '<p style="font-size:0.8rem;color:#5a607a;line-height:1.5;margin:0;">Tindakan ini tidak dapat dibatalkan. Semua data akan hilang selamanya.</p>' +
                '</div>' +
            '</div>' +

            '<div style="padding:20px 28px 24px;">' +
                '<div style="background:#f7f8fc;border:1px solid rgba(45,49,66,0.18);border-radius:12px;' +
                'padding:12px 14px;font-size:0.875rem;font-weight:600;color:#0f1117;margin-bottom:16px;' +
                'display:flex;align-items:flex-start;gap:10px;line-height:1.4;">' +
                    '<i class="fas fa-newspaper" style="color:#2a6ef5;margin-top:2px;flex-shrink:0;"></i>' +
                    '<span id="modalNewsTitle">—</span>' +
                '</div>' +
                '<div style="background:#fff1f1;border:1px solid rgba(239,68,68,0.2);border-radius:12px;' +
                'padding:12px 14px;font-size:0.8rem;color:#991b1b;display:flex;align-items:flex-start;gap:8px;line-height:1.5;">' +
                    '<i class="fas fa-exclamation-triangle" style="flex-shrink:0;margin-top:2px;"></i>' +
                    '<span>Konten, gambar, dan seluruh data terkait berita ini akan <strong>dihapus secara permanen</strong> dan tidak dapat dikembalikan.</span>' +
                '</div>' +
            '</div>' +

            '<div style="padding:16px 28px 24px;display:flex;gap:10px;justify-content:flex-end;">' +
                '<button id="delBtnCancel" style="display:inline-flex;align-items:center;gap:7px;padding:10px 20px;border-radius:12px;' +
                'font-size:0.875rem;font-weight:600;border:1.5px solid rgba(45,49,66,0.18);background:#fff;color:#2d3142;cursor:pointer;font-family:inherit;">' +
                    '<i class="fas fa-arrow-left"></i> Batal' +
                '</button>' +
                '<button id="delBtnConfirm" style="display:inline-flex;align-items:center;gap:7px;padding:10px 22px;border-radius:12px;' +
                'font-size:0.875rem;font-weight:700;border:none;background:#ef4444;color:#fff;cursor:pointer;' +
                'box-shadow:0 4px 12px rgba(239,68,68,0.35);font-family:inherit;">' +
                    '<i class="fas fa-trash-alt"></i> Ya, Hapus' +
                '</button>' +
            '</div>' +
        '</div>';

    document.body.appendChild(modal);

    document.getElementById('delBtnCancel').addEventListener('click', closeDeleteModal);
    document.getElementById('delBtnConfirm').addEventListener('click', function() {
        if (pendingDelId) document.getElementById('del-form-' + pendingDelId).submit();
        closeDeleteModal();
    });
    modal.addEventListener('click', function(e) {
        if (e.target === modal) closeDeleteModal();
    });
});

function showDeleteModal(id, title) {
    pendingDelId = id;
    var modal = document.getElementById('deleteModal');
    var box   = document.getElementById('delBox');
    modal.style.display = 'flex';
    void box.offsetHeight; // force reflow
    box.style.transform = 'scale(1)';
    box.style.opacity   = '1';
    document.getElementById('modalNewsTitle').textContent = title;
    document.body.style.overflow = 'hidden';
}

function closeDeleteModal() {
    var modal = document.getElementById('deleteModal');
    var box   = document.getElementById('delBox');
    if (!modal) return;
    box.style.transform = 'scale(0.93)';
    box.style.opacity   = '0';
    setTimeout(function() {
        modal.style.display = 'none';
        pendingDelId = null;
    }, 260);
    document.body.style.overflow = '';
}

function filterByStatus(status) {
    var url = new URL(window.location.href);
    status ? url.searchParams.set('status', status) : url.searchParams.delete('status');
    url.searchParams.delete('page');
    window.location.href = url.toString();
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeDeleteModal();
});

// Auto-hide alerts
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.alert').forEach(function(el) {
        setTimeout(function() {
            el.style.transition = 'opacity 0.3s, transform 0.3s';
            el.style.opacity = '0';
            el.style.transform = 'translateY(-8px)';
            setTimeout(function() { el.remove(); }, 300);
        }, 5000);
    });
});
</script>

@endsection
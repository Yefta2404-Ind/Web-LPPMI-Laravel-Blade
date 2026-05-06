@extends('layouts.admin')

@section('content')
<style>
@import url('https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600;9..40,700;9..40,800&display=swap');

/* ── RESET & BASE ───────────────────────────── */
.dash-wrap, .dash-wrap * { box-sizing: border-box; font-family: 'DM Sans', sans-serif; }

.dash-wrap {
    padding: 28px 32px 56px;
    background: #f5f6f8;
    min-height: 100vh;
}

/* ── TOPBAR ─────────────────────────────────── */
.dw-topbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    flex-wrap: wrap;
    gap: 12px;
    opacity: 0;
    animation: dw-up .4s .0s ease forwards;
}

.dw-topbar h1 {
    font-size: 20px;
    font-weight: 700;
    color: #111827;
    letter-spacing: -.3px;
    margin: 0 0 2px;
}

.dw-topbar p {
    font-size: 13px;
    color: #9ca3af;
    margin: 0;
}

.dw-datepill {
    display: flex;
    align-items: center;
    gap: 7px;
    padding: 8px 16px;
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 999px;
    font-size: 12.5px;
    font-weight: 500;
    color: #6b7280;
    box-shadow: 0 1px 4px rgba(0,0,0,.06);
    white-space: nowrap;
}

.dw-datepill svg { width: 14px; height: 14px; color: #3b82f6; flex-shrink: 0; }

/* ── CAPABILITY CHIPS ───────────────────────── */
.dw-caps {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 18px;
    opacity: 0;
    animation: dw-up .4s .05s ease forwards;
}

.dw-cap {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 6px 13px;
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 500;
    color: #374151;
    box-shadow: 0 1px 3px rgba(0,0,0,.05);
    transition: border-color .2s, transform .2s, box-shadow .2s;
    cursor: default;
}

.dw-cap:hover {
    border-color: #93c5fd;
    box-shadow: 0 2px 8px rgba(59,130,246,.12);
    transform: translateY(-1px);
}

/* ── MAINTENANCE ────────────────────────────── */
.dw-maint {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    padding: 18px 22px;
    margin-bottom: 18px;
    box-shadow: 0 1px 4px rgba(0,0,0,.05);
    opacity: 0;
    animation: dw-up .4s .08s ease forwards;
    transition: box-shadow .25s;
}

.dw-maint:hover { box-shadow: 0 4px 16px rgba(0,0,0,.08); }

.dw-maint-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 16px;
    flex-wrap: wrap;
}

.dw-maint-left { display: flex; align-items: center; gap: 14px; }

.dw-maint-icon {
    width: 44px;
    height: 44px;
    border-radius: 11px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    flex-shrink: 0;
}

.dw-maint-icon.off { background: #f9fafb; border: 1px solid #e5e7eb; }
.dw-maint-icon.on  { background: #fef2f2; border: 1px solid #fecaca; }

.dw-maint-title {
    font-size: 14px;
    font-weight: 700;
    color: #111827;
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
    margin-bottom: 3px;
}

.dw-maint-desc { font-size: 12px; color: #9ca3af; }

.dw-pill {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 3px 9px;
    border-radius: 999px;
    font-size: 10.5px;
    font-weight: 700;
    letter-spacing: .3px;
    text-transform: uppercase;
}

.dw-pill::before {
    content: '';
    width: 5px;
    height: 5px;
    border-radius: 50%;
    background: currentColor;
    display: block;
}

.dw-pill.on  { background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }
.dw-pill.off { background: #f0fdf4; color: #059669; border: 1px solid #bbf7d0; }

.dw-btn {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 9px 18px;
    border-radius: 9px;
    border: 1px solid transparent;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    font-family: 'DM Sans', sans-serif;
    white-space: nowrap;
    transition: all .2s ease;
}

.dw-btn:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(0,0,0,.1); }
.dw-btn.red   { background: #fef2f2; color: #dc2626; border-color: #fecaca; }
.dw-btn.green { background: #f0fdf4; color: #059669; border-color: #bbf7d0; }

/* bypass */
.dw-bypass {
    display: flex;
    gap: 10px;
    align-items: flex-start;
    margin-top: 14px;
    padding: 12px 14px;
    background: #fffbeb;
    border: 1px solid #fde68a;
    border-radius: 9px;
    animation: dw-up .3s ease both;
}

.dw-bypass-ico { font-size: 14px; flex-shrink: 0; margin-top: 1px; }

.dw-bypass-body {
    font-size: 12px;
    color: #92400e;
    font-weight: 500;
    line-height: 1.6;
}

.dw-bypass-body strong { font-weight: 700; }

.dw-bypass-row { display: flex; align-items: center; gap: 7px; margin-top: 6px; flex-wrap: wrap; }

.dw-bypass-link {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 4px 10px;
    background: #fef3c7;
    border: 1px solid #fcd34d;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
    color: #92400e;
    text-decoration: none;
    transition: background .15s;
    word-break: break-all;
}

.dw-bypass-link:hover { background: #fde68a; }

.dw-copy {
    background: none;
    border: none;
    cursor: pointer;
    font-size: 14px;
    padding: 2px 5px;
    border-radius: 5px;
    transition: background .15s;
    font-family: 'DM Sans', sans-serif;
    color: #d97706;
}

.dw-copy:hover { background: #fde68a; }

/* ── SECTION LABEL ──────────────────────────── */
.dw-section {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 11px;
    font-weight: 700;
    color: #9ca3af;
    text-transform: uppercase;
    letter-spacing: .7px;
    margin: 22px 0 12px;
}

.dw-section::after {
    content: '';
    flex: 1;
    height: 1px;
    background: #e5e7eb;
}

/* ── STATS ──────────────────────────────────── */
.dw-stats {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 14px;
    margin-bottom: 4px;
}

.dw-stat {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    padding: 20px 22px;
    box-shadow: 0 1px 4px rgba(0,0,0,.05);
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 12px;
    transition: box-shadow .25s, transform .25s;
    opacity: 0;
    animation: dw-up .4s ease forwards;
    position: relative;
    overflow: hidden;
}

.dw-stat::before {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 3px;
    background: var(--ac);
    transform: scaleX(0);
    transform-origin: left;
    transition: transform .3s ease;
    border-radius: 0;
}

.dw-stat:hover { box-shadow: 0 6px 20px rgba(0,0,0,.09); transform: translateY(-3px); }
.dw-stat:hover::before { transform: scaleX(1); }

.dw-stat:nth-child(1) { --ac: #3b82f6; animation-delay: .1s; }
.dw-stat:nth-child(2) { --ac: #10b981; animation-delay: .15s; }
.dw-stat:nth-child(3) { --ac: #059669; animation-delay: .2s; }
.dw-stat:nth-child(4) { --ac: #ef4444; animation-delay: .25s; }

.dw-stat-left {}

.dw-stat-label {
    font-size: 11px;
    font-weight: 600;
    color: #9ca3af;
    text-transform: uppercase;
    letter-spacing: .5px;
    margin-bottom: 8px;
}

.dw-stat-num {
    font-size: 38px;
    font-weight: 800;
    color: #111827;
    letter-spacing: -2px;
    line-height: 1;
    margin-bottom: 8px;
}

.dw-stat-sub { font-size: 12px; color: #9ca3af; font-weight: 500; }

.dw-stat-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    flex-shrink: 0;
    transition: transform .25s;
}

.dw-stat:hover .dw-stat-icon { transform: scale(1.1) rotate(5deg); }

.si-blue  { background: #eff6ff; }
.si-green { background: #ecfdf5; }
.si-red   { background: #fef2f2; }

/* ── CHARTS ─────────────────────────────────── */
.dw-charts {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
    margin-bottom: 4px;
}

.dw-card {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 1px 4px rgba(0,0,0,.05);
    opacity: 0;
    animation: dw-up .4s .28s ease forwards;
    transition: box-shadow .25s;
}

.dw-card:hover { box-shadow: 0 6px 20px rgba(0,0,0,.08); }

.dw-card-head {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 20px;
    border-bottom: 1px solid #f3f4f6;
}

.dw-card-head h3 {
    font-size: 13.5px;
    font-weight: 700;
    color: #111827;
    display: flex;
    align-items: center;
    gap: 8px;
    margin: 0;
}

.dw-card-head h3 svg { width: 15px; height: 15px; color: #3b82f6; flex-shrink: 0; }

.dw-card-meta { font-size: 11.5px; color: #9ca3af; font-weight: 500; }

.dw-chart-body { padding: 16px 20px; height: 230px; }

.dw-legend {
    display: flex;
    flex-wrap: wrap;
    gap: 14px;
    padding: 10px 20px 14px;
    border-top: 1px solid #f3f4f6;
    background: #fafafa;
}

.dw-leg {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 11.5px;
    font-weight: 500;
    color: #6b7280;
}

.dw-leg-dot { width: 8px; height: 8px; border-radius: 2px; flex-shrink: 0; }

/* ── LISTS ──────────────────────────────────── */
.dw-lists {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
}

.dw-lcard {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 1px 4px rgba(0,0,0,.05);
    display: flex;
    flex-direction: column;
    opacity: 0;
    animation: dw-up .4s .34s ease forwards;
    transition: box-shadow .25s;
}

.dw-lcard:hover { box-shadow: 0 6px 20px rgba(0,0,0,.08); }

.dw-lcard-head {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 14px 20px;
    border-bottom: 1px solid #f3f4f6;
    background: #fafafa;
}

.dw-lcard-head h3 {
    font-size: 13.5px;
    font-weight: 700;
    color: #111827;
    display: flex;
    align-items: center;
    gap: 8px;
    margin: 0;
}

.dw-lcard-head h3 svg { width: 15px; height: 15px; color: #3b82f6; flex-shrink: 0; }

.dw-badge {
    padding: 3px 10px;
    border-radius: 999px;
    font-size: 11.5px;
    font-weight: 700;
}

.dw-badge.blue  { background: #eff6ff; color: #2563eb; border: 1px solid #bfdbfe; }
.dw-badge.green { background: #ecfdf5; color: #059669; border: 1px solid #a7f3d0; }

.dw-lbody { overflow-y: auto; }
.dw-lbody::-webkit-scrollbar { width: 3px; }
.dw-lbody::-webkit-scrollbar-thumb { background: #e5e7eb; border-radius: 4px; }
.dw-lbody::-webkit-scrollbar-thumb:hover { background: #9ca3af; }

.dw-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    padding: 13px 20px;
    border-bottom: 1px solid #f9fafb;
    transition: background .18s;
    opacity: 0;
    animation: dw-fadein .3s ease forwards;
    animation-delay: calc(var(--i, 0) * 45ms + .4s);
}

.dw-row:last-child { border-bottom: none; }
.dw-row:hover { background: #fafbfc; }

.dw-row-info { flex: 1; min-width: 0; }

.dw-row-title {
    font-size: 13px;
    font-weight: 600;
    color: #111827;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    margin-bottom: 5px;
    transition: color .15s;
}

.dw-row:hover .dw-row-title { color: #2563eb; }

.dw-row-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    font-size: 11.5px;
    color: #9ca3af;
    font-weight: 500;
}

.dw-row-meta span { display: flex; align-items: center; gap: 4px; }
.dw-row-meta svg  { width: 11px; height: 11px; flex-shrink: 0; }

.dw-row-right { display: flex; align-items: center; gap: 6px; flex-shrink: 0; }

.dw-tag {
    padding: 3px 9px;
    border-radius: 999px;
    font-size: 10.5px;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 3px;
}

.dw-tag.news   { background: #eff6ff; color: #2563eb; border: 1px solid #bfdbfe; }
.dw-tag.agenda { background: #ecfdf5; color: #059669; border: 1px solid #a7f3d0; }

.dw-act {
    width: 30px;
    height: 30px;
    border-radius: 8px;
    border: 1px solid #e5e7eb;
    background: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 14px;
    transition: all .18s ease;
    font-family: 'DM Sans', sans-serif;
}

.dw-act:hover { transform: scale(1.1); }
.dw-act.ok:hover { background: #f0fdf4; border-color: #bbf7d0; }
.dw-act.no:hover { background: #fef2f2; border-color: #fecaca; }

/* ── EMPTY ──────────────────────────────────── */
.dw-empty {
    text-align: center;
    padding: 48px 20px;
    color: #9ca3af;
}

.dw-empty-icon { font-size: 36px; margin-bottom: 10px; }
.dw-empty p    { font-size: 13px; font-weight: 500; }

/* ── KEYFRAMES ──────────────────────────────── */
@keyframes dw-up {
    from { opacity: 0; transform: translateY(16px); }
    to   { opacity: 1; transform: translateY(0); }
}

@keyframes dw-fadein {
    from { opacity: 0; }
    to   { opacity: 1; }
}

/* ── RESPONSIVE ─────────────────────────────── */
@media (max-width: 1080px) {
    .dw-stats  { grid-template-columns: repeat(2, 1fr); }
    .dw-charts { grid-template-columns: 1fr; }
    .dw-lists  { grid-template-columns: 1fr; }
}

@media (max-width: 768px) {
    .dash-wrap { padding: 20px 18px 40px; }
    .dw-stats  { gap: 10px; }
    .dw-maint-row { flex-direction: column; align-items: flex-start; }
}

@media (max-width: 560px) {
    .dash-wrap   { padding: 16px 12px 36px; }
    .dw-stats    { grid-template-columns: repeat(2, 1fr); gap: 10px; }
    .dw-stat-num { font-size: 30px; }
    .dw-topbar h1{ font-size: 17px; }
    .dw-row      { flex-wrap: wrap; }
    .dw-row-right{ width: 100%; }
}
</style>

@php
    $totalApproved = $approvedCount ?? 0;
    $totalRejected = $rejectedCount ?? 0;
    $totalKonten   = $totalApproved + $pendingNews->count() + $pendingAgenda->count() + $totalRejected;
    $cA  = $totalKonten == 0 ? 1 : $totalApproved;
    $cN  = $totalKonten == 0 ? 1 : $pendingNews->count();
    $cAg = $totalKonten == 0 ? 1 : $pendingAgenda->count();
    $cR  = $totalKonten == 0 ? 1 : $totalRejected;
@endphp

<div class="dash-wrap">

    {{-- TOPBAR --}}
    <div class="dw-topbar">
        <div>
            <h1>Selamat datang, {{ auth()->user()->name ?? 'Admin' }} 👋</h1>
            <p>Panel moderasi & manajemen konten</p>
        </div>
        <div class="dw-datepill">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="4" width="18" height="18" rx="2"/>
                <line x1="3" y1="10" x2="21" y2="10"/>
                <line x1="8" y1="2" x2="8" y2="6"/>
                <line x1="16" y1="2" x2="16" y2="6"/>
            </svg>
            {{ now()->translatedFormat('l, d F Y') }}
        </div>
    </div>

    {{-- CAPS --}}
    <div class="dw-caps">
        <div class="dw-cap">📰 Review Berita</div>
        <div class="dw-cap">📅 Review Agenda</div>
        <div class="dw-cap">🛠 Maintenance Mode</div>
        <div class="dw-cap">📊 Statistik Konten</div>
        <div class="dw-cap">👥 Kelola Pengguna</div>
    </div>

    {{-- MAINTENANCE --}}
    <div class="dw-maint">
        <div class="dw-maint-row">
            <div class="dw-maint-left">
                @if(app()->isDownForMaintenance())
                    <div class="dw-maint-icon on">🚨</div>
                @else
                    <div class="dw-maint-icon off">🛠</div>
                @endif
                <div>
                    <div class="dw-maint-title">
                        Maintenance Mode
                        @if(app()->isDownForMaintenance())
                            <span class="dw-pill on">Aktif</span>
                        @else
                            <span class="dw-pill off">Non-aktif</span>
                        @endif
                    </div>
                    <div class="dw-maint-desc">
                        @if(app()->isDownForMaintenance())
                            Website sedang dalam maintenance — akses publik dinonaktifkan.
                        @else
                            Aktifkan untuk menonaktifkan akses publik sementara.
                        @endif
                    </div>
                </div>
            </div>

            @if(app()->isDownForMaintenance())
                <form action="{{ route('admin.maintenance.up') }}" method="POST">
                    @csrf
                    <button type="submit" class="dw-btn green">✅ Matikan Maintenance</button>
                </form>
            @else
                <form action="{{ route('admin.maintenance.down') }}" method="POST">
                    @csrf
                    <button type="submit" class="dw-btn red"
                        onclick="return confirm('Aktifkan maintenance mode? Website publik tidak bisa diakses.')">
                        🚨 Aktifkan Maintenance
                    </button>
                </form>
            @endif
        </div>

        @if(app()->isDownForMaintenance())
        <div class="dw-bypass">
            <div class="dw-bypass-ico">💡</div>
            <div class="dw-bypass-body">
                <strong>Login saat Maintenance</strong> — Admin & Staff tetap bisa masuk melalui halaman bypass:
                <div class="dw-bypass-row">
                    <a href="{{ url('/admin-bypass') }}" target="_blank" class="dw-bypass-link">
                        🔗 {{ url('/admin-bypass') }}
                    </a>
                    <button class="dw-copy" type="button"
                        onclick="navigator.clipboard.writeText('{{ url('/admin-bypass') }}').then(()=>{this.textContent='✅';setTimeout(()=>this.textContent='📋',1500)})">
                        📋
                    </button>
                </div>
            </div>
        </div>
        @endif
    </div>

    {{-- STATS --}}
    <div class="dw-section">Ringkasan</div>
    <div class="dw-stats">
        <div class="dw-stat">
            <div class="dw-stat-left">
                <div class="dw-stat-label">Berita Pending</div>
                <div class="dw-stat-num">{{ $pendingNews->count() }}</div>
                <div class="dw-stat-sub">Menunggu review</div>
            </div>
            <div class="dw-stat-icon si-blue">📰</div>
        </div>
        <div class="dw-stat">
            <div class="dw-stat-left">
                <div class="dw-stat-label">Agenda Pending</div>
                <div class="dw-stat-num">{{ $pendingAgenda->count() }}</div>
                <div class="dw-stat-sub">Menunggu review</div>
            </div>
            <div class="dw-stat-icon si-green">📅</div>
        </div>
        <div class="dw-stat">
            <div class="dw-stat-left">
                <div class="dw-stat-label">Disetujui</div>
                <div class="dw-stat-num">{{ $totalApproved }}</div>
                <div class="dw-stat-sub">Sudah tayang</div>
            </div>
            <div class="dw-stat-icon si-green">✅</div>
        </div>
        <div class="dw-stat">
            <div class="dw-stat-left">
                <div class="dw-stat-label">Ditolak</div>
                <div class="dw-stat-num">{{ $totalRejected }}</div>
                <div class="dw-stat-sub">Tidak disetujui</div>
            </div>
            <div class="dw-stat-icon si-red">❌</div>
        </div>
    </div>

    {{-- CHARTS --}}
    <div class="dw-section">Analitik</div>
    <div class="dw-charts">

        <div class="dw-card">
            <div class="dw-card-head">
                <h3>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21.21 15.89A10 10 0 1 1 8 2.83"/><path d="M22 12A10 10 0 0 0 12 2v10z"/>
                    </svg>
                    Status Seluruh Konten
                </h3>
                <span class="dw-card-meta">Total: {{ $totalKonten }}</span>
            </div>
            <div class="dw-chart-body"><canvas id="chartDonut"></canvas></div>
            <div class="dw-legend">
                <div class="dw-leg"><div class="dw-leg-dot" style="background:#059669"></div>Disetujui ({{ $cA }})</div>
                <div class="dw-leg"><div class="dw-leg-dot" style="background:#3b82f6"></div>Berita ({{ $cN }})</div>
                <div class="dw-leg"><div class="dw-leg-dot" style="background:#10b981"></div>Agenda ({{ $cAg }})</div>
                <div class="dw-leg"><div class="dw-leg-dot" style="background:#ef4444"></div>Ditolak ({{ $cR }})</div>
            </div>
        </div>

        <div class="dw-card">
            <div class="dw-card-head">
                <h3>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="20" x2="18" y2="10"/>
                        <line x1="12" y1="20" x2="12" y2="4"/>
                        <line x1="6" y1="20" x2="6" y2="14"/>
                        <line x1="2" y1="20" x2="22" y2="20"/>
                    </svg>
                    Konten Pending
                </h3>
                <span class="dw-card-meta">Menunggu review</span>
            </div>
            <div class="dw-chart-body"><canvas id="chartBar"></canvas></div>
            <div class="dw-legend">
                <div class="dw-leg"><div class="dw-leg-dot" style="background:#3b82f6"></div>Berita: {{ $pendingNews->count() }}</div>
                <div class="dw-leg"><div class="dw-leg-dot" style="background:#10b981"></div>Agenda: {{ $pendingAgenda->count() }}</div>
            </div>
        </div>

    </div>

    {{-- LISTS --}}
    <div class="dw-section">Antrian Review</div>
    <div class="dw-lists">

        {{-- Berita --}}
        <div class="dw-lcard">
            <div class="dw-lcard-head">
                <h3>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2Zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2"/>
                        <path d="M18 14h-8M15 18h-5M10 6h8v4h-8z"/>
                    </svg>
                    Berita Menunggu Review
                </h3>
                <span class="dw-badge blue">{{ $pendingNews->count() }}</span>
            </div>
            <div class="dw-lbody">
                @forelse($pendingNews as $i => $berita)
                    <div class="dw-row" style="--i:{{ $i }}">
                        <div class="dw-row-info">
                            <div class="dw-row-title">{{ Str::limit($berita->title, 55) }}</div>
                            <div class="dw-row-meta">
                                <span>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                                    {{ $berita->user->name ?? 'Unknown' }}
                                </span>
                                <span>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                                    {{ $berita->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                        <div class="dw-row-right">
                            <span class="dw-tag news">📰 Berita</span>
                            <form method="POST" action="{{ route('admin.news.approve', $berita->id) }}" style="display:inline">
                                @csrf
                                <button class="dw-act ok" title="Setujui" onclick="return confirm('Setujui berita ini?')">✅</button>
                            </form>
                            <form method="POST" action="{{ route('admin.news.reject', $berita->id) }}" style="display:inline">
                                @csrf
                                <button class="dw-act no" title="Tolak" onclick="return confirm('Tolak berita ini?')">✕</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="dw-empty">
                        <div class="dw-empty-icon">✅</div>
                        <p>Tidak ada berita yang menunggu review</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Agenda --}}
        <div class="dw-lcard">
            <div class="dw-lcard-head">
                <h3>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="4" width="18" height="18" rx="2"/>
                        <line x1="3" y1="10" x2="21" y2="10"/>
                        <line x1="8" y1="2" x2="8" y2="6"/>
                        <line x1="16" y1="2" x2="16" y2="6"/>
                    </svg>
                    Agenda Menunggu Review
                </h3>
                <span class="dw-badge green">{{ $pendingAgenda->count() }}</span>
            </div>
            <div class="dw-lbody">
                @forelse($pendingAgenda as $i => $agenda)
                    <div class="dw-row" style="--i:{{ $i }}">
                        <div class="dw-row-info">
                            <div class="dw-row-title">{{ Str::limit($agenda->title, 55) }}</div>
                            <div class="dw-row-meta">
                                <span>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                                    {{ $agenda->user->name ?? 'Unknown' }}
                                </span>
                                <span>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                    {{ \Carbon\Carbon::parse($agenda->date)->format('d M Y') }}
                                </span>
                                @if($agenda->location)
                                <span>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                    {{ Str::limit($agenda->location, 24) }}
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="dw-row-right">
                            <span class="dw-tag agenda">📅 Agenda</span>
                            <form method="POST" action="{{ route('admin.agenda.approve', $agenda->id) }}" style="display:inline">
                                @csrf
                                <button class="dw-act ok" title="Setujui" onclick="return confirm('Setujui agenda ini?')">✅</button>
                            </form>
                            <form method="POST" action="{{ route('admin.agenda.reject', $agenda->id) }}" style="display:inline">
                                @csrf
                                <button class="dw-act no" title="Tolak" onclick="return confirm('Tolak agenda ini?')">✕</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="dw-empty">
                        <div class="dw-empty-icon">✅</div>
                        <p>Tidak ada agenda yang menunggu review</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
const _f  = { family: "'DM Sans', sans-serif", size: 11.5 };
const _tt = { backgroundColor: '#0f172a', padding: 11, cornerRadius: 9,
              titleFont: _f, bodyFont: _f, titleColor: '#f1f5f9', bodyColor: '#cbd5e1' };

document.addEventListener('DOMContentLoaded', () => {

    new Chart(document.getElementById('chartDonut'), {
        type: 'doughnut',
        data: {
            labels: ['Disetujui', 'Berita Pending', 'Agenda Pending', 'Ditolak'],
            datasets: [{
                data: [{{ $cA }}, {{ $cN }}, {{ $cAg }}, {{ $cR }}],
                backgroundColor: ['#059669', '#3b82f6', '#10b981', '#ef4444'],
                borderWidth: 0,
                hoverOffset: 12,
                hoverBorderWidth: 3,
                hoverBorderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%',
            plugins: {
                legend: { display: false },
                tooltip: { ..._tt, callbacks: {
                    label: c => {
                        const t = Math.max({{ $totalKonten }}, 1);
                        return `  ${c.label}: ${c.raw} (${Math.round(c.raw / t * 100)}%)`;
                    }
                }}
            },
            animation: { duration: 900, easing: 'easeInOutQuart' }
        }
    });

    new Chart(document.getElementById('chartBar'), {
        type: 'bar',
        data: {
            labels: ['Berita', 'Agenda'],
            datasets: [{
                data: [{{ $pendingNews->count() }}, {{ $pendingAgenda->count() }}],
                backgroundColor: ['rgba(59,130,246,.85)', 'rgba(16,185,129,.85)'],
                hoverBackgroundColor: ['#2563eb', '#059669'],
                borderRadius: 8,
                borderSkipped: false,
                barPercentage: 0.45
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false }, tooltip: _tt },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: '#f3f4f6', drawBorder: false },
                    ticks: { stepSize: 1, precision: 0, font: _f, color: '#9ca3af' },
                    border: { display: false }
                },
                x: {
                    grid: { display: false },
                    ticks: { font: { ..._f, weight: '600' }, color: '#6b7280' },
                    border: { display: false }
                }
            },
            animation: { duration: 800, easing: 'easeInOutQuart', delay: 150 }
        }
    });

});
</script>
@endsection
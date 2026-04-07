@extends('layouts.admin')

@section('content')
<style>
    /* ========================================
       MODERN ADMIN DASHBOARD - FULL RESPONSIVE
       Support: 320px - 2560px+ (segala device)
    ======================================== */
    
    /* Reset & Base */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Root variables dengan responsive font */
    :root {
        --biru-tua: #0f2a44;
        --biru-terang: #3b82f6;
        --hijau: #10b981;
        --kuning: #f59e0b;
        --merah: #ef4444;
        --ungu: #8b5cf6;
        --abu-sangat-muda: #f9fafb;
        --abu-muda: #f3f4f6;
        --abu: #e5e7eb;
        --abu-tua: #6b7280;
        --hitam-muda: #374151;
        --hitam: #1f2937;
        
        /* Responsive font sizes */
        --fs-base: clamp(14px, 4vw, 16px);
        --fs-h1: clamp(20px, 6vw, 32px);
        --fs-h3: clamp(14px, 4.5vw, 18px);
        --fs-angka: clamp(24px, 7vw, 36px);
    }

    body {
        font-family: system-ui, -apple-system, 'Inter', 'Segoe UI', sans-serif;
        background: #f8fafc;
        overflow-x: hidden;
        width: 100%;
        font-size: var(--fs-base);
    }

    /* Container utama - fluid width */
    .dashboard-admin {
        width: 100%;
        max-width: 1400px;
        margin: 0 auto;
        padding: clamp(12px, 3vw, 24px);
        overflow-x: hidden;
    }

    /* ========== KARTU SAMBUTAN ========== */
    .kartu-sambutan {
        background: linear-gradient(135deg, var(--biru-tua), #1e3a8a);
        border-radius: clamp(16px, 5vw, 24px);
        padding: clamp(20px, 5vw, 32px);
        margin-bottom: clamp(20px, 4vw, 32px);
        color: white;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    
    .kartu-sambutan h1 {
        font-size: var(--fs-h1);
        margin-bottom: 8px;
        font-weight: 600;
        word-break: break-word;
    }
    
    .kartu-sambutan p {
        font-size: clamp(13px, 3.5vw, 15px);
        opacity: 0.9;
        margin-bottom: 16px;
        line-height: 1.4;
    }
    
    .tanggal-hari-ini {
        background: rgba(255,255,255,0.2);
        padding: 6px 14px;
        border-radius: 40px;
        font-size: clamp(11px, 3vw, 13px);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        backdrop-filter: blur(4px);
        flex-wrap: wrap;
    }

    /* ========== KARTU STATISTIK - GRID RESPONSIF ========== */
    .kartu-statistik {
        display: grid;
        gap: clamp(12px, 3vw, 20px);
        margin-bottom: clamp(20px, 4vw, 32px);
    }
    
    /* Breakpoints untuk grid statistik */
    @media (min-width: 1200px) {
        .kartu-statistik {
            grid-template-columns: repeat(4, 1fr);
        }
    }
    
    @media (min-width: 768px) and (max-width: 1199px) {
        .kartu-statistik {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (max-width: 767px) {
        .kartu-statistik {
            grid-template-columns: 1fr;
        }
    }
    
    .stat-item {
        background: white;
        border-radius: clamp(14px, 4vw, 20px);
        padding: clamp(16px, 4vw, 22px);
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        border: 1px solid var(--abu);
        transition: all 0.3s ease;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
    }
    
    .stat-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 28px rgba(0,0,0,0.1);
    }
    
    .stat-info {
        flex: 1;
        min-width: 0;
    }
    
    .stat-info h4 {
        font-size: clamp(10px, 3vw, 12px);
        color: var(--abu-tua);
        margin-bottom: 6px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
        word-break: keep-all;
    }
    
    .stat-angka {
        font-size: var(--fs-angka);
        font-weight: 700;
        color: var(--hitam);
        line-height: 1.2;
        word-break: break-word;
    }
    
    .stat-icon {
        width: clamp(44px, 12vw, 56px);
        height: clamp(44px, 12vw, 56px);
        border-radius: clamp(12px, 3vw, 16px);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: clamp(20px, 5vw, 26px);
        flex-shrink: 0;
    }
    
    .icon-berita { background: #fef3c7; color: #d97706; }
    .icon-agenda { background: #ede9fe; color: #7c3aed; }
    .icon-setuju { background: #d1fae5; color: #059669; }
    .icon-tolak { background: #fee2e2; color: #dc2626; }

    /* ========== KARTU GRAFIK ========== */
    .kartu-grafik {
        display: grid;
        gap: clamp(12px, 3vw, 20px);
        margin-bottom: clamp(20px, 4vw, 32px);
    }
    
    @media (min-width: 992px) {
        .kartu-grafik {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (max-width: 991px) {
        .kartu-grafik {
            grid-template-columns: 1fr;
        }
    }
    
    .grafik-card {
        background: white;
        border-radius: clamp(14px, 4vw, 20px);
        border: 1px solid var(--abu);
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .grafik-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.08);
    }
    
    .grafik-header {
        padding: clamp(12px, 3.5vw, 18px) clamp(16px, 4vw, 24px);
        background: var(--abu-sangat-muda);
        border-bottom: 1px solid var(--abu);
    }
    
    .grafik-header h3 {
        font-size: var(--fs-h3);
        font-weight: 600;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }
    
    .grafik-body {
        padding: clamp(16px, 4vw, 24px);
    }
    
    canvas {
        max-height: 280px;
        width: 100% !important;
        height: auto !important;
    }
    
    /* Legenda responsif */
    .legenda {
        display: flex;
        justify-content: center;
        gap: clamp(8px, 3vw, 16px);
        margin-top: clamp(12px, 3vw, 20px);
        flex-wrap: wrap;
    }
    
    .legenda-item {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: clamp(10px, 3vw, 12px);
        background: var(--abu-muda);
        padding: 4px clamp(8px, 3vw, 12px);
        border-radius: 30px;
        font-weight: 500;
        white-space: nowrap;
    }
    
    @media (max-width: 480px) {
        .legenda-item {
            white-space: normal;
            font-size: 9px;
        }
    }
    
    .warna-legenda {
        width: 10px;
        height: 10px;
        border-radius: 3px;
        flex-shrink: 0;
    }

    /* ========== KARTU KONTEN ========== */
    .kartu-konten {
        display: grid;
        gap: clamp(12px, 3vw, 20px);
        margin-bottom: 20px;
    }
    
    @media (min-width: 992px) {
        .kartu-konten {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (max-width: 991px) {
        .kartu-konten {
            grid-template-columns: 1fr;
        }
    }
    
    .konten-card {
        background: white;
        border-radius: clamp(14px, 4vw, 20px);
        border: 1px solid var(--abu);
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }
    
    .konten-header {
        padding: clamp(12px, 3.5vw, 18px) clamp(16px, 4vw, 24px);
        background: var(--abu-sangat-muda);
        border-bottom: 1px solid var(--abu);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }
    
    .konten-header h3 {
        font-size: var(--fs-h3);
        font-weight: 600;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }
    
    .badge-jumlah {
        background: linear-gradient(135deg, var(--kuning), #f97316);
        color: white;
        padding: 4px 12px;
        border-radius: 30px;
        font-size: clamp(11px, 3vw, 13px);
        font-weight: 600;
        white-space: nowrap;
    }
    
    .badge-agenda {
        background: linear-gradient(135deg, var(--ungu), #a78bfa);
    }
    
    .daftar-konten {
        padding: clamp(12px, 3.5vw, 20px);
        max-height: 560px;
        overflow-y: auto;
        scrollbar-width: thin;
    }
    
    /* Item konten - full responsive */
    .item-konten {
        border: 1px solid var(--abu);
        border-radius: clamp(12px, 3.5vw, 16px);
        padding: clamp(12px, 3.5vw, 18px);
        margin-bottom: 12px;
        transition: all 0.2s;
        background: white;
    }
    
    .item-konten:hover {
        border-color: var(--biru-terang);
        transform: translateX(4px);
        box-shadow: 0 4px 12px rgba(59,130,246,0.1);
    }
    
    .judul-konten {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 10px;
        gap: 10px;
        flex-wrap: wrap;
    }
    
    .judul-konten h4 {
        font-weight: 600;
        font-size: clamp(13px, 4vw, 15px);
        margin: 0;
        color: var(--hitam);
        line-height: 1.4;
        flex: 1;
        min-width: 0;
        word-break: break-word;
    }
    
    .label-jenis {
        padding: 3px 10px;
        border-radius: 30px;
        font-size: clamp(9px, 2.5vw, 11px);
        font-weight: 700;
        white-space: nowrap;
        flex-shrink: 0;
    }
    
    .label-berita {
        background: #fef3c7;
        color: #92400e;
    }
    
    .label-agenda {
        background: #ede9fe;
        color: #5b21b6;
    }
    
    .info-konten {
        display: flex;
        gap: clamp(10px, 3vw, 16px);
        font-size: clamp(10px, 3vw, 12px);
        color: var(--abu-tua);
        margin-bottom: 12px;
        flex-wrap: wrap;
    }
    
    .info-konten i {
        width: 14px;
        font-size: 11px;
    }
    
    .tombol-aksi {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        margin-top: 4px;
    }
    
    /* Tombol responsif */
    .btn {
        padding: 6px clamp(10px, 3vw, 14px);
        border-radius: 8px;
        font-size: clamp(10px, 3vw, 12px);
        font-weight: 600;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s;
        font-family: inherit;
        white-space: nowrap;
    }
    
    @media (max-width: 480px) {
        .btn {
            white-space: normal;
            text-align: center;
            justify-content: center;
            flex: 1;
        }
        .tombol-aksi {
            flex-direction: column;
        }
        .tombol-aksi .btn {
            width: 100%;
        }
    }
    
    .btn-hijau {
        background: var(--hijau);
        color: white;
    }
    
    .btn-hijau:hover {
        background: #059669;
        transform: translateY(-2px);
    }
    
    .btn-merah {
        background: var(--merah);
        color: white;
    }
    
    .btn-merah:hover {
        background: #dc2626;
        transform: translateY(-2px);
    }
    
    .btn-abu {
        background: var(--abu-muda);
        color: var(--hitam);
        border: 1px solid var(--abu);
        text-decoration: none;
    }
    
    .btn-abu:hover {
        background: var(--abu);
        transform: translateY(-2px);
    }
    
    /* Kondisi kosong */
    .kosong {
        text-align: center;
        padding: clamp(30px, 10vw, 60px) 20px;
    }
    
    .kosong i {
        font-size: clamp(40px, 12vw, 56px);
        color: var(--abu);
        margin-bottom: 12px;
        display: block;
    }
    
    .kosong p {
        color: var(--abu-tua);
        font-size: clamp(12px, 3.5vw, 14px);
        margin: 0;
    }
    
    /* Scrollbar tetap rapi */
    .daftar-konten::-webkit-scrollbar {
        width: 4px;
    }
    .daftar-konten::-webkit-scrollbar-track {
        background: var(--abu-muda);
        border-radius: 10px;
    }
    .daftar-konten::-webkit-scrollbar-thumb {
        background: var(--abu-tua);
        border-radius: 10px;
    }
    
    /* Touch-friendly untuk mobile */
    @media (max-width: 768px) {
        .btn {
            min-height: 40px;
        }
        .stat-item {
            cursor: pointer;
        }
        .item-konten {
            cursor: pointer;
        }
    }
    
    /* Landscape mode untuk mobile */
    @media (max-width: 768px) and (orientation: landscape) {
        .dashboard-admin {
            padding: 12px;
        }
        .daftar-konten {
            max-height: 400px;
        }
        canvas {
            max-height: 200px;
        }
    }
    
    /* Device sangat kecil (320px ke bawah) */
    @media (max-width: 360px) {
        .stat-icon {
            width: 40px;
            height: 40px;
            font-size: 18px;
        }
        .info-konten {
            gap: 8px;
        }
        .konten-header h3 i {
            font-size: 12px;
        }
    }
    
    /* Tablet landscape */
    @media (min-width: 768px) and (max-width: 1024px) and (orientation: landscape) {
        .kartu-statistik {
            grid-template-columns: repeat(4, 1fr);
        }
    }
    
    /* Desktop besar (4K) */
    @media (min-width: 1920px) {
        .dashboard-admin {
            max-width: 1800px;
        }
        .stat-angka {
            font-size: 44px;
        }
        .btn {
            font-size: 14px;
            padding: 8px 18px;
        }
        .judul-konten h4 {
            font-size: 16px;
        }
    }
    
    /* Animasi & transisi halus */
    .stat-item, .grafik-card, .konten-card, .btn {
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    form {
        display: inline-block;
    }
</style>

<div class="dashboard-admin">
    
    {{-- KARTU SAMBUTAN --}}
    <div class="kartu-sambutan">
        <h1>Halo, {{ auth()->user()->name ?? 'Admin' }}! 👋</h1>
        <p>Selamat datang di panel admin. Kelola persetujuan konten dengan mudah.</p>
        <div class="tanggal-hari-ini">
            <i class="far fa-calendar-alt"></i> {{ now()->translatedFormat('l, d F Y') }}
        </div>
    </div>

    {{-- STATISTIK --}}
    @php
        $jumlahBerita = $pendingNews->count();
        $jumlahAgenda = $pendingAgenda->count();
        $jumlahSetuju = $approvedCount ?? 0;
        $jumlahTolak = $rejectedCount ?? 0;
    @endphp

    <div class="kartu-statistik">
        <div class="stat-item">
            <div class="stat-info">
                <h4>📰 BERITA MENUNGGU</h4>
                <div class="stat-angka">{{ $jumlahBerita }}</div>
            </div>
            <div class="stat-icon icon-berita">
                <i class="fas fa-newspaper"></i>
            </div>
        </div>

        <div class="stat-item">
            <div class="stat-info">
                <h4>📅 AGENDA MENUNGGU</h4>
                <div class="stat-angka">{{ $jumlahAgenda }}</div>
            </div>
            <div class="stat-icon icon-agenda">
                <i class="fas fa-calendar-alt"></i>
            </div>
        </div>

        <div class="stat-item">
            <div class="stat-info">
                <h4>✅ SUDAH DISETUJUI</h4>
                <div class="stat-angka">{{ $jumlahSetuju }}</div>
            </div>
            <div class="stat-icon icon-setuju">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>

        <div class="stat-item">
            <div class="stat-info">
                <h4>❌ SUDAH DITOLAK</h4>
                <div class="stat-angka">{{ $jumlahTolak }}</div>
            </div>
            <div class="stat-icon icon-tolak">
                <i class="fas fa-times-circle"></i>
            </div>
        </div>
    </div>

    {{-- GRAFIK --}}
    @php
        $totalKonten = $jumlahSetuju + $jumlahBerita + $jumlahAgenda + $jumlahTolak;
        if ($totalKonten == 0) {
            $jumlahSetuju = 1;
            $jumlahBerita = 1;
            $jumlahAgenda = 1;
            $jumlahTolak = 1;
        }
    @endphp

    <div class="kartu-grafik">
        <div class="grafik-card">
            <div class="grafik-header">
                <h3><i class="fas fa-chart-pie"></i> 📊 Status Seluruh Konten</h3>
            </div>
            <div class="grafik-body">
                <canvas id="grafikStatus"></canvas>
                <div class="legenda">
                    <div class="legenda-item">
                        <div class="warna-legenda" style="background: #10b981;"></div>
                        <span>✅ Disetujui ({{ $jumlahSetuju }})</span>
                    </div>
                    <div class="legenda-item">
                        <div class="warna-legenda" style="background: #f59e0b;"></div>
                        <span>⏳ Berita ({{ $jumlahBerita }})</span>
                    </div>
                    <div class="legenda-item">
                        <div class="warna-legenda" style="background: #8b5cf6;"></div>
                        <span>⏳ Agenda ({{ $jumlahAgenda }})</span>
                    </div>
                    <div class="legenda-item">
                        <div class="warna-legenda" style="background: #ef4444;"></div>
                        <span>❌ Ditolak ({{ $jumlahTolak }})</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="grafik-card">
            <div class="grafik-header">
                <h3><i class="fas fa-chart-bar"></i> 📊 Perbandingan Konten Pending</h3>
            </div>
            <div class="grafik-body">
                <canvas id="grafikPerbandingan"></canvas>
                <div class="legenda">
                    <div class="legenda-item">
                        <div class="warna-legenda" style="background: #f59e0b;"></div>
                        <span>📰 Berita: {{ $jumlahBerita }}</span>
                    </div>
                    <div class="legenda-item">
                        <div class="warna-legenda" style="background: #8b5cf6;"></div>
                        <span>📅 Agenda: {{ $jumlahAgenda }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- DAFTAR KONTEN MENUNGGU --}}
    <div class="kartu-konten">
        <div class="konten-card">
            <div class="konten-header">
                <h3><i class="fas fa-newspaper"></i> 📰 Berita Menunggu</h3>
                <span class="badge-jumlah">{{ $jumlahBerita }} Berita</span>
            </div>
            <div class="daftar-konten">
                @if($pendingNews->count() > 0)
                    @foreach($pendingNews as $berita)
                        <div class="item-konten">
                            <div class="judul-konten">
                                <h4>{{ Str::limit($berita->title, 55) }}</h4>
                                <span class="label-jenis label-berita">BERITA</span>
                            </div>
                            <div class="info-konten">
                                <span><i class="fas fa-user"></i> {{ $berita->user->name ?? 'Unknown' }}</span>
                                <span><i class="far fa-clock"></i> {{ $berita->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="tombol-aksi">
                                <form method="POST" action="{{ route('admin.news.approve', $berita->id) }}">
                                    @csrf
                                    <button class="btn btn-hijau" onclick="return confirm('Setujui berita ini?')">
                                        <i class="fas fa-check"></i> Setujui
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('admin.news.reject', $berita->id) }}">
                                    @csrf
                                    <button class="btn btn-merah" onclick="return confirm('Tolak berita ini?')">
                                        <i class="fas fa-times"></i> Tolak
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="kosong">
                        <i class="fas fa-newspaper"></i>
                        <p>✨ Tidak ada berita yang menunggu</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="konten-card">
            <div class="konten-header">
                <h3><i class="fas fa-calendar-alt"></i> 📅 Agenda Menunggu</h3>
                <span class="badge-jumlah badge-agenda">{{ $jumlahAgenda }} Agenda</span>
            </div>
            <div class="daftar-konten">
                @if($pendingAgenda->count() > 0)
                    @foreach($pendingAgenda as $agenda)
                        <div class="item-konten">
                            <div class="judul-konten">
                                <h4>{{ Str::limit($agenda->title, 55) }}</h4>
                                <span class="label-jenis label-agenda">AGENDA</span>
                            </div>
                            <div class="info-konten">
                                <span><i class="fas fa-user"></i> {{ $agenda->user->name ?? 'Unknown' }}</span>
                                <span><i class="fas fa-calendar-day"></i> {{ \Carbon\Carbon::parse($agenda->date)->format('d M Y') }}</span>
                                @if($agenda->location)
                                <span><i class="fas fa-map-marker-alt"></i> {{ Str::limit($agenda->location, 20) }}</span>
                                @endif
                            </div>
                            <div class="tombol-aksi">
                                <a href="{{ route('agenda.show', $agenda->id) }}" class="btn btn-abu" target="_blank">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                                <form method="POST" action="{{ route('admin.agenda.approve', $agenda->id) }}">
                                    @csrf
                                    <button class="btn btn-hijau" onclick="return confirm('Setujui agenda ini?')">
                                        <i class="fas fa-check"></i> Setujui
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('admin.agenda.reject', $agenda->id) }}">
                                    @csrf
                                    <button class="btn btn-merah" onclick="return confirm('Tolak agenda ini?')">
                                        <i class="fas fa-times"></i> Tolak
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="kosong">
                        <i class="fas fa-calendar-alt"></i>
                        <p>✨ Tidak ada agenda yang menunggu</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Grafik Status (Donut Chart)
    const ctx1 = document.getElementById('grafikStatus').getContext('2d');
    new Chart(ctx1, {
        type: 'doughnut',
        data: {
            labels: ['Disetujui', 'Berita Pending', 'Agenda Pending', 'Ditolak'],
            datasets: [{
                data: [{{ $jumlahSetuju }}, {{ $jumlahBerita }}, {{ $jumlahAgenda }}, {{ $jumlahTolak }}],
                backgroundColor: ['#10b981', '#f59e0b', '#8b5cf6', '#ef4444'],
                borderWidth: 0,
                hoverOffset: 15
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `${context.label}: ${context.raw} konten`;
                        }
                    }
                }
            },
            cutout: '60%'
        }
    });

    // Grafik Perbandingan (Bar Chart)
    const ctx2 = document.getElementById('grafikPerbandingan').getContext('2d');
    new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: ['Berita', 'Agenda'],
            datasets: [{
                label: 'Menunggu Persetujuan',
                data: [{{ $jumlahBerita }}, {{ $jumlahAgenda }}],
                backgroundColor: ['#f59e0b', '#8b5cf6'],
                borderRadius: 10,
                barPercentage: 0.6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `Menunggu: ${context.raw} konten`;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1, precision: 0 }
                }
            }
        }
    });
});
</script>
@endsection
@extends('layouts.admin')

@section('content')
<style>
    /* ========================================
       MODERN ADMIN DASHBOARD - SIMPLE & CLEAN
       ======================================== */
    
    /* Warna yang mudah dipahami */
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
    }

    /* Container utama */
    .dashboard-admin {
        max-width: 1400px;
        margin: 0 auto;
        padding: 20px;
    }

    /* ========== KARTU SAMBUTAN ========== */
    .kartu-sambutan {
        background: linear-gradient(135deg, var(--biru-tua), #1e3a8a);
        border-radius: 20px;
        padding: 30px;
        margin-bottom: 30px;
        color: white;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    
    .kartu-sambutan h1 {
        font-size: 28px;
        margin-bottom: 10px;
    }
    
    .kartu-sambutan p {
        font-size: 15px;
        opacity: 0.9;
        margin-bottom: 20px;
    }
    
    .tanggal-hari-ini {
        background: rgba(255,255,255,0.2);
        padding: 8px 16px;
        border-radius: 30px;
        font-size: 13px;
        display: inline-block;
    }

    /* ========== KARTU STATISTIK ========== */
    .kartu-statistik {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 30px;
    }
    
    @media (max-width: 1000px) {
        .kartu-statistik {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (max-width: 600px) {
        .kartu-statistik {
            grid-template-columns: 1fr;
        }
    }
    
    .stat-item {
        background: white;
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        border: 1px solid var(--abu);
        transition: all 0.3s ease;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .stat-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    
    .stat-info h4 {
        font-size: 12px;
        color: var(--abu-tua);
        margin-bottom: 8px;
        text-transform: uppercase;
    }
    
    .stat-angka {
        font-size: 32px;
        font-weight: bold;
        color: var(--hitam);
    }
    
    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }
    
    .icon-berita { background: #fef3c7; color: #d97706; }
    .icon-agenda { background: #ede9fe; color: #7c3aed; }
    .icon-setuju { background: #d1fae5; color: #059669; }
    .icon-tolak { background: #fee2e2; color: #dc2626; }

    /* ========== KARTU GRAFIK ========== */
    .kartu-grafik {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        margin-bottom: 30px;
    }
    
    @media (max-width: 900px) {
        .kartu-grafik {
            grid-template-columns: 1fr;
        }
    }
    
    .grafik-card {
        background: white;
        border-radius: 16px;
        border: 1px solid var(--abu);
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .grafik-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    }
    
    .grafik-header {
        padding: 15px 20px;
        background: var(--abu-sangat-muda);
        border-bottom: 1px solid var(--abu);
    }
    
    .grafik-header h3 {
        font-size: 16px;
        font-weight: 600;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .grafik-body {
        padding: 20px;
    }
    
    canvas {
        max-height: 280px;
        width: 100% !important;
    }
    
    /* Legenda warna */
    .legenda {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-top: 15px;
        flex-wrap: wrap;
    }
    
    .legenda-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 12px;
        background: var(--abu-muda);
        padding: 5px 12px;
        border-radius: 20px;
    }
    
    .warna-legenda {
        width: 12px;
        height: 12px;
        border-radius: 3px;
    }

    /* ========== KARTU KONTEN ========== */
    .kartu-konten {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        margin-bottom: 30px;
    }
    
    @media (max-width: 900px) {
        .kartu-konten {
            grid-template-columns: 1fr;
        }
    }
    
    .konten-card {
        background: white;
        border-radius: 16px;
        border: 1px solid var(--abu);
        overflow: hidden;
    }
    
    .konten-header {
        padding: 15px 20px;
        background: var(--abu-sangat-muda);
        border-bottom: 1px solid var(--abu);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .konten-header h3 {
        font-size: 16px;
        font-weight: 600;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .badge-jumlah {
        background: linear-gradient(135deg, var(--kuning), #f97316);
        color: white;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: bold;
    }
    
    .badge-agenda {
        background: linear-gradient(135deg, var(--ungu), #a78bfa);
    }
    
    .daftar-konten {
        padding: 20px;
        max-height: 500px;
        overflow-y: auto;
    }
    
    /* Item konten */
    .item-konten {
        border: 1px solid var(--abu);
        border-radius: 12px;
        padding: 15px;
        margin-bottom: 12px;
        transition: all 0.2s;
    }
    
    .item-konten:hover {
        border-color: var(--biru-terang);
        transform: translateX(5px);
        box-shadow: 0 2px 8px rgba(59,130,246,0.1);
    }
    
    .judul-konten {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 10px;
    }
    
    .judul-konten h4 {
        font-weight: 600;
        font-size: 14px;
        margin: 0;
        color: var(--hitam);
    }
    
    .label-jenis {
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 10px;
        font-weight: bold;
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
        gap: 15px;
        font-size: 11px;
        color: var(--abu-tua);
        margin-bottom: 12px;
        flex-wrap: wrap;
    }
    
    .tombol-aksi {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }
    
    /* Tombol */
    .btn {
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 11px;
        font-weight: 500;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s;
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
        padding: 50px 20px;
    }
    
    .kosong i {
        font-size: 48px;
        color: var(--abu);
        margin-bottom: 15px;
        display: block;
    }
    
    .kosong p {
        color: var(--abu-tua);
        font-size: 13px;
        margin: 0;
    }
    
    /* Responsif */
    @media (max-width: 768px) {
        .dashboard-admin { padding: 15px; }
        .kartu-sambutan { padding: 20px; }
        .kartu-sambutan h1 { font-size: 22px; }
        .tombol-aksi { flex-direction: column; }
        .tombol-aksi .btn { width: 100%; justify-content: center; }
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
        <!-- Grafik Status -->
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
                        <span>⏳ Berita Pending ({{ $jumlahBerita }})</span>
                    </div>
                    <div class="legenda-item">
                        <div class="warna-legenda" style="background: #8b5cf6;"></div>
                        <span>⏳ Agenda Pending ({{ $jumlahAgenda }})</span>
                    </div>
                    <div class="legenda-item">
                        <div class="warna-legenda" style="background: #ef4444;"></div>
                        <span>❌ Ditolak ({{ $jumlahTolak }})</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grafik Perbandingan -->
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
        <!-- Berita -->
        <div class="konten-card">
            <div class="konten-header">
                <h3><i class="fas fa-newspaper"></i> 📰 Berita Menunggu Persetujuan</h3>
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
                                <form method="POST" action="{{ route('admin.news.approve', $berita->id) }}" style="display: inline;">
                                    @csrf
                                    <button class="btn btn-hijau" onclick="return confirm('Setujui berita ini?')">
                                        <i class="fas fa-check"></i> Setujui
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('admin.news.reject', $berita->id) }}" style="display: inline;">
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

        <!-- Agenda -->
        <div class="konten-card">
            <div class="konten-header">
                <h3><i class="fas fa-calendar-alt"></i> 📅 Agenda Menunggu Persetujuan</h3>
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
                                <span><i class="fas fa-map-marker-alt"></i> {{ Str::limit($agenda->location, 25) }}</span>
                                @endif
                            </div>
                            <div class="tombol-aksi">
                                <a href="{{ route('agenda.show', $agenda->id) }}" class="btn btn-abu" target="_blank">
                                    <i class="fas fa-eye"></i> Lihat Detail
                                </a>
                                <form method="POST" action="{{ route('admin.agenda.approve', $agenda->id) }}" style="display: inline;">
                                    @csrf
                                    <button class="btn btn-hijau" onclick="return confirm('Setujui agenda ini?')">
                                        <i class="fas fa-check"></i> Setujui
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('admin.agenda.reject', $agenda->id) }}" style="display: inline;">
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
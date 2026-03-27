@extends('layouts.admin')

@section('content')
<style>
    :root {
        --primary: #0f2a44;
        --secondary: #3b82f6;
        --success: #10b981;
        --warning: #f59e0b;
        --danger: #ef4444;
        --purple: #8b5cf6;
        --pink: #ec489a;
        --indigo: #6366f1;
        --cyan: #06b6d4;
        --orange: #f97316;
        --gray-50: #f9fafb;
        --gray-100: #f3f4f6;
        --gray-200: #e5e7eb;
        --gray-300: #d1d5db;
        --gray-600: #4b5563;
        --gray-700: #374151;
        --gray-800: #1f2937;
        --gray-900: #111827;
    }

    .admin-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 24px;
    }

    /* Welcome Section */
    .welcome-card {
        background: linear-gradient(135deg, var(--primary) 0%, #1e3a8a 100%);
        border-radius: 16px;
        padding: 28px 32px;
        margin-bottom: 28px;
        color: white;
        position: relative;
        overflow: hidden;
    }
    
    .welcome-card::before {
        content: "👑";
        position: absolute;
        right: 20px;
        top: 20px;
        font-size: 60px;
        opacity: 0.1;
        pointer-events: none;
    }
    
    .welcome-card h1 {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 8px;
    }
    
    .welcome-card p {
        font-size: 14px;
        opacity: 0.9;
        margin-bottom: 20px;
    }
    
    .date-badge {
        display: inline-block;
        background: rgba(255,255,255,0.2);
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        backdrop-filter: blur(10px);
    }

    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 32px;
    }
    
    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        transition: all 0.2s;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border: 1px solid var(--gray-200);
    }
    
    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }
    
    .stat-info h3 {
        font-size: 12px;
        font-weight: 500;
        color: var(--gray-600);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }
    
    .stat-number {
        font-size: 32px;
        font-weight: 800;
        color: var(--gray-800);
        margin-bottom: 4px;
    }
    
    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }
    
    .stat-icon.news { background: linear-gradient(135deg, #fef3c7, #fde68a); color: #d97706; }
    .stat-icon.agenda { background: linear-gradient(135deg, #ede9fe, #ddd6fe); color: #7c3aed; }
    .stat-icon.approved { background: linear-gradient(135deg, #d1fae5, #a7f3d0); color: #059669; }
    .stat-icon.rejected { background: linear-gradient(135deg, #fee2e2, #fecaca); color: #dc2626; }

    /* Chart Section */
    .chart-section {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 24px;
        margin-bottom: 32px;
    }
    
    .chart-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        border: 1px solid var(--gray-200);
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .chart-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(0,0,0,0.1);
    }
    
    .chart-header {
        padding: 18px 20px;
        border-bottom: 1px solid var(--gray-200);
        background: linear-gradient(135deg, var(--gray-50), #ffffff);
    }
    
    .chart-header h3 {
        font-size: 16px;
        font-weight: 600;
        color: var(--gray-800);
        display: flex;
        align-items: center;
        gap: 8px;
        margin: 0;
    }
    
    .chart-body {
        padding: 20px;
        background: linear-gradient(135deg, #ffffff, var(--gray-50));
    }
    
    canvas {
        max-height: 300px;
        width: 100% !important;
        filter: drop-shadow(0 2px 4px rgba(0,0,0,0.05));
    }
    
    .chart-legend {
        display: flex;
        justify-content: center;
        gap: 24px;
        margin-top: 20px;
        flex-wrap: wrap;
    }
    
    .legend-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 12px;
        font-weight: 500;
        color: var(--gray-700);
        padding: 4px 12px;
        background: var(--gray-50);
        border-radius: 20px;
        transition: all 0.2s;
    }
    
    .legend-item:hover {
        transform: scale(1.05);
        background: white;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    .legend-color {
        width: 12px;
        height: 12px;
        border-radius: 4px;
    }

    /* Content Grid */
    .content-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(360px, 1fr));
        gap: 24px;
        margin-bottom: 32px;
    }
    
    .card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        border: 1px solid var(--gray-200);
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }
    
    .card-header {
        padding: 18px 20px;
        border-bottom: 1px solid var(--gray-200);
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: linear-gradient(135deg, var(--gray-50), #ffffff);
    }
    
    .card-header h3 {
        font-size: 16px;
        font-weight: 600;
        color: var(--gray-800);
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .card-content {
        padding: 20px;
        max-height: 500px;
        overflow-y: auto;
    }
    
    /* Item List */
    .item {
        padding: 14px;
        border: 1px solid var(--gray-200);
        border-radius: 12px;
        margin-bottom: 12px;
        transition: all 0.2s;
        background: white;
    }
    
    .item:hover {
        border-color: var(--secondary);
        box-shadow: 0 2px 8px rgba(59,130,246,0.1);
        transform: translateX(4px);
    }
    
    .item-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 10px;
        gap: 10px;
    }
    
    .item-title {
        font-weight: 600;
        color: var(--gray-800);
        font-size: 14px;
        flex: 1;
    }
    
    .badge {
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 10px;
        font-weight: 600;
        text-transform: uppercase;
        white-space: nowrap;
    }
    
    .badge-news { background: linear-gradient(135deg, #fef3c7, #fde68a); color: #92400e; }
    .badge-agenda { background: linear-gradient(135deg, #ede9fe, #ddd6fe); color: #5b21b6; }
    
    .item-meta {
        display: flex;
        gap: 12px;
        font-size: 11px;
        color: var(--gray-600);
        margin-bottom: 12px;
        flex-wrap: wrap;
    }
    
    .item-actions {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }
    
    .btn {
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        border: none;
        cursor: pointer;
    }
    
    .btn-approve {
        background: linear-gradient(135deg, var(--success), #059669);
        color: white;
    }
    
    .btn-approve:hover {
        background: linear-gradient(135deg, #059669, var(--success));
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(16,185,129,0.3);
    }
    
    .btn-reject {
        background: linear-gradient(135deg, var(--danger), #dc2626);
        color: white;
    }
    
    .btn-reject:hover {
        background: linear-gradient(135deg, #dc2626, var(--danger));
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(239,68,68,0.3);
    }
    
    .btn-view {
        background: linear-gradient(135deg, var(--gray-100), #ffffff);
        color: var(--gray-700);
        border: 1px solid var(--gray-300);
    }
    
    .btn-view:hover {
        background: linear-gradient(135deg, var(--gray-200), var(--gray-100));
        transform: translateY(-1px);
    }
    
    .empty-state {
        text-align: center;
        padding: 40px 20px;
    }
    
    .empty-state i {
        font-size: 48px;
        color: var(--gray-300);
        margin-bottom: 12px;
    }
    
    .empty-state p {
        color: var(--gray-600);
        font-size: 13px;
    }
    
    @media (max-width: 768px) {
        .admin-container { padding: 16px; }
        .welcome-card { padding: 20px; }
        .stats-grid { gap: 12px; }
        .chart-section { gap: 16px; }
        .content-grid { gap: 16px; }
        .item-actions { flex-direction: column; }
        .item-actions .btn { width: 100%; justify-content: center; }
    }
</style>

<div class="admin-container">
    {{-- Welcome Section --}}
    <div class="welcome-card">
        <h1>Halo, Admin {{ auth()->user()->name ?? 'Admin' }}! 👋</h1>
        <p>Kelola persetujuan konten berita dan agenda yang diajukan oleh staff.</p>
        <span class="date-badge">
            <i class="far fa-calendar-alt"></i> {{ now()->translatedFormat('l, d F Y') }}
        </span>
    </div>

    {{-- Statistics --}}
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-info">
                <h3>Berita Pending</h3>
                <div class="stat-number">{{ $pendingNews->count() }}</div>
            </div>
            <div class="stat-icon news">
                <i class="fas fa-newspaper"></i>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-info">
                <h3>Agenda Pending</h3>
                <div class="stat-number">{{ $pendingAgenda->count() }}</div>
            </div>
            <div class="stat-icon agenda">
                <i class="fas fa-calendar-alt"></i>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-info">
                <h3>Total Disetujui</h3>
                <div class="stat-number">{{ $approvedCount ?? 0 }}</div>
            </div>
            <div class="stat-icon approved">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-info">
                <h3>Total Ditolak</h3>
                <div class="stat-number">{{ $rejectedCount ?? 0 }}</div>
            </div>
            <div class="stat-icon rejected">
                <i class="fas fa-times-circle"></i>
            </div>
        </div>
    </div>

    {{-- Chart Section --}}
    @php
        // Menghitung data untuk chart
        $newsPending = $pendingNews->count();
        $agendaPending = $pendingAgenda->count();
        
        $totalApproved = $approvedCount ?? 0;
        $totalPending = $newsPending + $agendaPending;
        $totalRejected = $rejectedCount ?? 0;
        $totalAll = $totalApproved + $totalPending + $totalRejected;
        
        if ($totalAll == 0) {
            $totalApproved = 1;
            $totalPending = 1;
            $totalRejected = 1;
        }
    @endphp

    <div class="chart-section">
        {{-- Status Overview Chart --}}
        <div class="chart-card">
            <div class="chart-header">
                <h3><i class="fas fa-chart-pie"></i> Overview Status Konten</h3>
            </div>
            <div class="chart-body">
                <canvas id="statusChart"></canvas>
                <div class="chart-legend">
                    <div class="legend-item">
                        <div class="legend-color" style="background: linear-gradient(135deg, #10b981, #34d399);"></div>
                        <span>Disetujui ({{ $totalApproved }})</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color" style="background: linear-gradient(135deg, #f59e0b, #fbbf24);"></div>
                        <span>Pending ({{ $totalPending }})</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color" style="background: linear-gradient(135deg, #ef4444, #f87171);"></div>
                        <span>Ditolak ({{ $totalRejected }})</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Content Distribution Chart --}}
        <div class="chart-card">
            <div class="chart-header">
                <h3><i class="fas fa-chart-bar"></i> Konten Menunggu Persetujuan</h3>
            </div>
            <div class="chart-body">
                <canvas id="distributionChart"></canvas>
                <div class="chart-legend">
                    <div class="legend-item">
                        <div class="legend-color" style="background: linear-gradient(135deg, #f59e0b, #f97316);"></div>
                        <span>Berita ({{ $newsPending }})</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color" style="background: linear-gradient(135deg, #8b5cf6, #a78bfa);"></div>
                        <span>Agenda ({{ $agendaPending }})</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Content Grid --}}
    <div class="content-grid">
        {{-- Pending News Card --}}
        <div class="card">
            <div class="card-header">
                <h3><i class="fas fa-newspaper" style="color: #f59e0b;"></i> Berita Menunggu Persetujuan</h3>
                <span class="badge badge-news">{{ $pendingNews->count() }} Menunggu</span>
            </div>
            <div class="card-content">
                @if($pendingNews->count() > 0)
                    @foreach($pendingNews as $news)
                        <div class="item">
                            <div class="item-header">
                                <div class="item-title">{{ Str::limit($news->title, 60) }}</div>
                                <span class="badge badge-news">Berita</span>
                            </div>
                            <div class="item-meta">
                                <span><i class="fas fa-user"></i> {{ $news->user->name ?? 'Unknown' }}</span>
                                <span><i class="far fa-clock"></i> {{ $news->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="item-actions">
                                <form method="POST" action="{{ route('admin.news.approve', $news->id) }}" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-approve" onclick="return confirm('Setujui berita ini?')">
                                        <i class="fas fa-check"></i> Setujui
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('admin.news.reject', $news->id) }}" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-reject" onclick="return confirm('Tolak berita ini?')">
                                        <i class="fas fa-times"></i> Tolak
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-state">
                        <i class="fas fa-newspaper"></i>
                        <p>Tidak ada berita yang menunggu persetujuan</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Pending Agenda Card --}}
        <div class="card">
            <div class="card-header">
                <h3><i class="fas fa-calendar-alt" style="color: #8b5cf6;"></i> Agenda Menunggu Persetujuan</h3>
                <span class="badge badge-agenda">{{ $pendingAgenda->count() }} Menunggu</span>
            </div>
            <div class="card-content">
                @if($pendingAgenda->count() > 0)
                    @foreach($pendingAgenda as $agenda)
                        <div class="item">
                            <div class="item-header">
                                <div class="item-title">{{ Str::limit($agenda->title, 60) }}</div>
                                <span class="badge badge-agenda">Agenda</span>
                            </div>
                            <div class="item-meta">
                                <span><i class="fas fa-user"></i> {{ $agenda->user->name ?? 'Unknown' }}</span>
                                <span><i class="fas fa-calendar-day"></i> {{ \Carbon\Carbon::parse($agenda->date)->format('d M Y') }}</span>
                                @if($agenda->location)
                                <span><i class="fas fa-map-marker-alt"></i> {{ Str::limit($agenda->location, 30) }}</span>
                                @endif
                            </div>
                            <div class="item-actions">
                                <a href="{{ route('agenda.show', $agenda->id) }}" class="btn btn-view" target="_blank">
                                    <i class="fas fa-eye"></i> Lihat
                                </a>
                                <form method="POST" action="{{ route('admin.agenda.approve', $agenda->id) }}" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-approve" onclick="return confirm('Setujui agenda ini?')">
                                        <i class="fas fa-check"></i> Setujui
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('admin.agenda.reject', $agenda->id) }}" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-reject" onclick="return confirm('Tolak agenda ini?')">
                                        <i class="fas fa-times"></i> Tolak
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-state">
                        <i class="fas fa-calendar-alt"></i>
                        <p>Tidak ada agenda yang menunggu persetujuan</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Status Chart dengan warna gradasi
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    const totalApproved = {{ $totalApproved }};
    const totalPending = {{ $totalPending }};
    const totalRejected = {{ $totalRejected }};
    const totalAll = {{ $totalAll }};
    
    new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Disetujui', 'Pending', 'Ditolak'],
            datasets: [{
                data: [totalApproved, totalPending, totalRejected],
                backgroundColor: [
                    'rgba(16, 185, 129, 0.9)',
                    'rgba(245, 158, 11, 0.9)',
                    'rgba(239, 68, 68, 0.9)'
                ],
                borderWidth: 0,
                hoverOffset: 10,
                hoverBorderWidth: 2,
                hoverBorderColor: '#ffffff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleColor: '#ffffff',
                    bodyColor: '#f3f4f6',
                    padding: 10,
                    cornerRadius: 8,
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.raw || 0;
                            const percentage = totalAll > 0 ? ((value / totalAll) * 100).toFixed(1) : 0;
                            return `${label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            },
            cutout: '65%',
            animation: {
                animateRotate: true,
                animateScale: true,
                duration: 1500,
                easing: 'easeInOutQuart'
            }
        }
    });

    // Distribution Chart dengan gradasi dan animasi
    const distCtx = document.getElementById('distributionChart').getContext('2d');
    const newsPending = {{ $newsPending }};
    const agendaPending = {{ $agendaPending }};
    
    new Chart(distCtx, {
        type: 'bar',
        data: {
            labels: ['Berita', 'Agenda'],
            datasets: [{
                label: 'Menunggu Persetujuan',
                data: [newsPending, agendaPending],
                backgroundColor: [
                    'rgba(245, 158, 11, 0.8)',
                    'rgba(139, 92, 246, 0.8)'
                ],
                borderRadius: 12,
                barPercentage: 0.65,
                categoryPercentage: 0.8,
                hoverBackgroundColor: [
                    'rgba(245, 158, 11, 1)',
                    'rgba(139, 92, 246, 1)'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleColor: '#ffffff',
                    bodyColor: '#f3f4f6',
                    padding: 10,
                    cornerRadius: 8,
                    callbacks: {
                        label: function(context) {
                            const value = context.raw || 0;
                            return `Menunggu: ${value} konten`;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)',
                        drawBorder: false
                    },
                    ticks: {
                        stepSize: 1,
                        precision: 0,
                        color: '#6b7280',
                        font: {
                            size: 11
                        }
                    },
                    title: {
                        display: true,
                        text: 'Jumlah Konten',
                        color: '#6b7280',
                        font: {
                            size: 11,
                            weight: '500'
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#374151',
                        font: {
                            size: 12,
                            weight: '600'
                        }
                    }
                }
            },
            animation: {
                duration: 1500,
                easing: 'easeInOutQuart',
                delay: (context) => {
                    return context.dataIndex * 100;
                }
            }
        }
    });
});
</script>
@endsection
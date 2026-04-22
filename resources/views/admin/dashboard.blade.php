@extends('layouts.admin')

@section('content')
<style>
    /* ========== GOOGLE FONTS ========== */
    @import url('https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', sans-serif;
        background: linear-gradient(135deg, #f5f7fb 0%, #f0f2f5 100%);
        min-height: 100vh;
    }

    /* ========== CSS VARIABLES ========== */
    :root {
        --primary: #1e3a5f;
        --primary-dark: #0f2a44;
        --primary-light: #2d4a6e;
        --secondary: #2563eb;
        --secondary-dark: #1d4ed8;
        --secondary-light: #3b82f6;
        --success: #059669;
        --success-light: #10b981;
        --success-bg: #ecfdf5;
        --warning: #dc2626;
        --warning-bg: #fee2e2;
        --danger: #dc2626;
        --danger-bg: #fee2e2;
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
        --radius-xs: 6px;
        --radius-sm: 8px;
        --radius-md: 12px;
        --radius-lg: 16px;
        --radius-xl: 20px;
        --shadow-xs: 0 1px 2px rgba(0, 0, 0, 0.02);
        --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.04);
        --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.08);
        --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        --transition-super-slow: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        --transition-slow: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        --transition-base: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        --transition-fast: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        --transition-bounce: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        --transition-smooth: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    /* ========== SMOOTH ANIMATIONS ========== */
    @keyframes fadeInScale {
        0% {
            opacity: 0;
            transform: scale(0.95);
        }
        100% {
            opacity: 1;
            transform: scale(1);
        }
    }

    @keyframes slideUpSmooth {
        0% {
            opacity: 0;
            transform: translateY(40px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideDownSmooth {
        0% {
            opacity: 0;
            transform: translateY(-40px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideLeftSmooth {
        0% {
            opacity: 0;
            transform: translateX(-40px);
        }
        100% {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slideRightSmooth {
        0% {
            opacity: 0;
            transform: translateX(40px);
        }
        100% {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes rotateIn {
        0% {
            opacity: 0;
            transform: rotate(-5deg) scale(0.9);
        }
        100% {
            opacity: 1;
            transform: rotate(0) scale(1);
        }
    }

    @keyframes floatSmooth {
        0%, 100% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-8px);
        }
    }

    @keyframes pulseSmooth {
        0%, 100% {
            opacity: 1;
            transform: scale(1);
        }
        50% {
            opacity: 0.8;
            transform: scale(1.02);
        }
    }

    @keyframes shimmerSmooth {
        0% {
            background-position: -1000px 0;
        }
        100% {
            background-position: 1000px 0;
        }
    }

    @keyframes glowPulse {
        0%, 100% {
            box-shadow: 0 0 0 0 rgba(37, 99, 235, 0.3);
        }
        50% {
            box-shadow: 0 0 0 12px rgba(37, 99, 235, 0);
        }
    }

    @keyframes borderGlow {
        0%, 100% {
            border-color: rgba(37, 99, 235, 0.2);
        }
        50% {
            border-color: rgba(37, 99, 235, 0.6);
        }
    }

    /* Animation Classes */
    .animate-fade-scale {
        animation: fadeInScale 0.5s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        opacity: 0;
    }

    .animate-slide-up {
        animation: slideUpSmooth 0.5s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        opacity: 0;
    }

    .animate-slide-down {
        animation: slideDownSmooth 0.5s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        opacity: 0;
    }

    .animate-slide-left {
        animation: slideLeftSmooth 0.5s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        opacity: 0;
    }

    .animate-slide-right {
        animation: slideRightSmooth 0.5s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        opacity: 0;
    }

    .animate-rotate {
        animation: rotateIn 0.5s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        opacity: 0;
    }

    .animate-float {
        animation: floatSmooth 4s ease-in-out infinite;
    }

    .animate-pulse {
        animation: pulseSmooth 2s ease-in-out infinite;
    }

    .animate-glow {
        animation: glowPulse 2s ease-in-out infinite;
    }

    /* Stagger delays with smooth timing */
    .delay-1 { animation-delay: 0s; }
    .delay-2 { animation-delay: 0.1s; }
    .delay-3 { animation-delay: 0.2s; }
    .delay-4 { animation-delay: 0.3s; }
    .delay-5 { animation-delay: 0.4s; }
    .delay-6 { animation-delay: 0.5s; }
    .delay-7 { animation-delay: 0.6s; }
    .delay-8 { animation-delay: 0.7s; }

    /* Hover Effects - Super Smooth */
    .hover-lift {
        transition: var(--transition-slow);
    }
    .hover-lift:hover {
        transform: translateY(-6px);
        transition: var(--transition-slow);
    }

    .hover-scale {
        transition: var(--transition-slow);
    }
    .hover-scale:hover {
        transform: scale(1.05);
        transition: var(--transition-slow);
    }

    .hover-scale-icon {
        transition: var(--transition-smooth);
    }
    .hover-scale-icon:hover {
        transform: scale(1.15) rotate(3deg);
        transition: var(--transition-smooth);
    }

    .hover-glow {
        transition: var(--transition-slow);
    }
    .hover-glow:hover {
        box-shadow: 0 0 0 6px rgba(37, 99, 235, 0.15);
        transition: var(--transition-slow);
    }

    .hover-border-glow {
        transition: var(--transition-slow);
    }
    .hover-border-glow:hover {
        border-color: var(--secondary);
        box-shadow: var(--shadow-lg);
        transition: var(--transition-slow);
    }

    /* ========== LAYOUT ========== */
    .dashboard-admin {
        max-width: 1440px;
        margin: 0 auto;
        padding: 28px 32px;
    }

    /* ========== WELCOME SECTION ========== */
    .welcome-card {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        border-radius: var(--radius-xl);
        padding: 28px 32px;
        margin-bottom: 28px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
        box-shadow: var(--shadow-lg);
        position: relative;
        overflow: hidden;
        transition: var(--transition-slow);
    }

    .welcome-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-xl);
        transition: var(--transition-slow);
    }

    .welcome-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(255,255,255,0.08) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
        transition: var(--transition-slow);
    }

    .welcome-card:hover::before {
        transform: scale(1.2);
        transition: var(--transition-slow);
    }

    .welcome-card::after {
        content: '👑';
        position: absolute;
        bottom: -20px;
        right: 20px;
        font-size: 100px;
        opacity: 0.04;
        pointer-events: none;
        transition: var(--transition-slow);
    }

    .welcome-card:hover::after {
        transform: scale(1.1) rotate(5deg);
        opacity: 0.08;
        transition: var(--transition-slow);
    }

    .welcome-title h1 {
        font-size: 24px;
        font-weight: 700;
        color: white;
        margin-bottom: 6px;
        letter-spacing: -0.3px;
    }

    .welcome-title p {
        font-size: 13px;
        color: rgba(255,255,255,0.75);
    }

    .date-chip {
        display: flex;
        align-items: center;
        gap: 8px;
        background: rgba(255,255,255,0.1);
        backdrop-filter: blur(8px);
        padding: 8px 18px;
        border-radius: 40px;
        font-size: 13px;
        font-weight: 500;
        color: white;
        border: 1px solid rgba(255,255,255,0.15);
        transition: var(--transition-slow);
    }

    .date-chip:hover {
        background: rgba(255,255,255,0.2);
        transform: translateY(-2px) scale(1.02);
        transition: var(--transition-slow);
    }

    /* ========== STATS GRID ========== */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 28px;
    }

    .stat-card {
        background: white;
        border-radius: var(--radius-lg);
        padding: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: var(--transition-slow);
        border: 1px solid var(--gray-100);
        box-shadow: var(--shadow-xs);
        position: relative;
        overflow: hidden;
        cursor: pointer;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--secondary), var(--secondary-light));
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .stat-card:hover {
        transform: translateY(-6px);
        box-shadow: var(--shadow-xl);
        border-color: var(--gray-200);
        transition: var(--transition-slow);
    }

    .stat-card:hover::before {
        transform: scaleX(1);
        transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .stat-card:hover .stat-icon {
        transform: scale(1.1) rotate(5deg);
        transition: var(--transition-smooth);
    }

    .stat-card:hover .stat-number {
        transform: scale(1.02);
        transition: var(--transition-smooth);
    }

    .stat-info h4 {
        font-size: 11px;
        font-weight: 600;
        color: var(--gray-500);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
        transition: var(--transition-fast);
    }

    .stat-card:hover .stat-info h4 {
        color: var(--secondary);
        transition: var(--transition-fast);
    }

    .stat-number {
        font-size: 34px;
        font-weight: 800;
        color: var(--gray-800);
        line-height: 1.2;
        margin-bottom: 6px;
        letter-spacing: -1px;
        transition: var(--transition-smooth);
    }

    .stat-trend {
        font-size: 11px;
        color: var(--success);
        display: flex;
        align-items: center;
        gap: 4px;
        font-weight: 500;
    }

    .stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        transition: var(--transition-smooth);
    }

    .stat-icon.news { background: #eff6ff; color: var(--secondary); }
    .stat-icon.agenda { background: #ecfdf5; color: var(--success); }
    .stat-icon.approved { background: #f0fdf4; color: var(--success); }
    .stat-icon.rejected { background: #fee2e2; color: var(--danger); }

    /* ========== TWO COLUMN ========== */
    .two-columns {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
        margin-bottom: 28px;
    }

    /* ========== CARD BASE ========== */
    .card {
        background: white;
        border-radius: var(--radius-lg);
        border: 1px solid var(--gray-100);
        overflow: hidden;
        transition: var(--transition-slow);
        box-shadow: var(--shadow-xs);
    }

    .card:hover {
        box-shadow: var(--shadow-xl);
        transform: translateY(-4px);
        transition: var(--transition-slow);
    }

    .card-header {
        padding: 16px 20px;
        border-bottom: 1px solid var(--gray-100);
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: var(--gray-50);
        transition: var(--transition-slow);
    }

    .card:hover .card-header {
        background: white;
        transition: var(--transition-slow);
    }

    .card-header h3 {
        font-size: 14px;
        font-weight: 600;
        color: var(--gray-800);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .card-header h3 i {
        color: var(--secondary);
        font-size: 16px;
        transition: var(--transition-smooth);
    }

    .card:hover .card-header h3 i {
        transform: rotate(5deg) scale(1.1);
        transition: var(--transition-smooth);
    }

    /* ========== CHART ========== */
    .chart-wrapper {
        padding: 20px;
        height: 280px;
        position: relative;
        transition: var(--transition-slow);
    }

    .card:hover .chart-wrapper {
        padding: 22px;
        transition: var(--transition-slow);
    }

    .chart-legend {
        display: flex;
        justify-content: center;
        gap: 20px;
        padding: 12px 20px 20px;
        border-top: 1px solid var(--gray-100);
        background: var(--gray-50);
        flex-wrap: wrap;
        transition: var(--transition-slow);
    }

    .card:hover .chart-legend {
        background: white;
        transition: var(--transition-slow);
    }

    .legend-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 11px;
        font-weight: 500;
        color: var(--gray-600);
        transition: var(--transition-smooth);
        cursor: pointer;
    }

    .legend-item:hover {
        transform: translateX(3px);
        color: var(--secondary);
        transition: var(--transition-smooth);
    }

    .legend-dot {
        width: 10px;
        height: 10px;
        border-radius: 3px;
        transition: var(--transition-smooth);
    }

    .legend-item:hover .legend-dot {
        transform: scale(1.3);
        transition: var(--transition-smooth);
    }

    /* ========== CONTENT LISTS ========== */
    .content-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
    }

    .list-card {
        background: white;
        border-radius: var(--radius-lg);
        border: 1px solid var(--gray-100);
        overflow: hidden;
        transition: var(--transition-slow);
        box-shadow: var(--shadow-xs);
        display: flex;
        flex-direction: column;
    }

    .list-card:hover {
        box-shadow: var(--shadow-xl);
        transform: translateY(-4px);
        transition: var(--transition-slow);
    }

    .list-header {
        padding: 16px 20px;
        border-bottom: 1px solid var(--gray-100);
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: var(--gray-50);
        transition: var(--transition-slow);
    }

    .list-card:hover .list-header {
        background: white;
        transition: var(--transition-slow);
    }

    .list-header h3 {
        font-size: 14px;
        font-weight: 600;
        color: var(--gray-800);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .badge-count {
        background: var(--secondary);
        color: white;
        padding: 2px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        transition: var(--transition-smooth);
    }

    .list-card:hover .badge-count {
        transform: scale(1.05);
        transition: var(--transition-smooth);
    }

    .badge-count.agenda {
        background: var(--success);
    }

    .list-content {
        padding: 8px 0;
        max-height: 500px;
        overflow-y: auto;
    }

    .list-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 14px 20px;
        border-bottom: 1px solid var(--gray-50);
        transition: var(--transition-slow);
        animation: slideRightSmooth 0.4s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        animation-delay: calc(var(--item-order) * 0.05s);
        opacity: 0;
    }

    .list-item:nth-child(1) { --item-order: 1; }
    .list-item:nth-child(2) { --item-order: 2; }
    .list-item:nth-child(3) { --item-order: 3; }
    .list-item:nth-child(4) { --item-order: 4; }
    .list-item:nth-child(5) { --item-order: 5; }

    .list-item:hover {
        background: linear-gradient(135deg, var(--gray-50), white);
        padding-left: 24px;
        padding-right: 24px;
        transition: var(--transition-slow);
    }

    .item-info {
        flex: 1;
        min-width: 0;
    }

    .item-title {
        font-size: 13px;
        font-weight: 600;
        color: var(--gray-800);
        margin-bottom: 6px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        transition: var(--transition-smooth);
    }

    .list-item:hover .item-title {
        color: var(--secondary);
        transition: var(--transition-smooth);
    }

    .item-meta {
        display: flex;
        gap: 14px;
        font-size: 11px;
        color: var(--gray-400);
        flex-wrap: wrap;
    }

    .item-meta i {
        width: 12px;
        font-size: 10px;
        transition: var(--transition-smooth);
    }

    .list-item:hover .item-meta i {
        color: var(--secondary);
        transition: var(--transition-smooth);
    }

    .item-actions {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .type-badge {
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 10px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 4px;
        transition: var(--transition-smooth);
    }

    .type-badge.news {
        background: #eff6ff;
        color: var(--secondary);
    }

    .type-badge.agenda {
        background: #ecfdf5;
        color: var(--success);
    }

    .list-item:hover .type-badge {
        transform: scale(1.02);
        transition: var(--transition-smooth);
    }

    .btn-icon {
        width: 30px;
        height: 30px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--gray-500);
        text-decoration: none;
        transition: var(--transition-smooth);
        background: transparent;
        border: none;
        cursor: pointer;
    }

    .btn-icon:hover {
        background: var(--gray-100);
        transform: scale(1.1) rotate(3deg);
        transition: var(--transition-smooth);
    }

    .btn-icon.approve:hover {
        background: var(--success-bg);
        color: var(--success);
        transform: scale(1.15);
        transition: var(--transition-smooth);
    }

    .btn-icon.reject:hover {
        background: var(--danger-bg);
        color: var(--danger);
        transform: scale(1.15);
        transition: var(--transition-smooth);
    }

    /* ========== EMPTY STATE ========== */
    .empty-state {
        text-align: center;
        padding: 48px 20px;
        transition: var(--transition-slow);
    }

    .empty-state i {
        font-size: 48px;
        color: var(--gray-300);
        margin-bottom: 12px;
        display: block;
        transition: var(--transition-smooth);
    }

    .empty-state:hover i {
        transform: scale(1.1);
        color: var(--secondary);
        transition: var(--transition-smooth);
    }

    .empty-state p {
        font-size: 13px;
        color: var(--gray-500);
    }

    /* ========== CUSTOM SCROLLBAR ========== */
    .list-content::-webkit-scrollbar {
        width: 4px;
    }

    .list-content::-webkit-scrollbar-track {
        background: var(--gray-100);
        border-radius: 10px;
    }

    .list-content::-webkit-scrollbar-thumb {
        background: var(--gray-400);
        border-radius: 10px;
        transition: var(--transition-slow);
    }

    .list-content::-webkit-scrollbar-thumb:hover {
        background: var(--secondary);
        transition: var(--transition-slow);
    }

    /* ========== RESPONSIVE ========== */
    @media (max-width: 1024px) {
        .stats-grid { grid-template-columns: repeat(2, 1fr); }
        .two-columns { grid-template-columns: 1fr; }
        .content-grid { grid-template-columns: 1fr; }
        .dashboard-admin { padding: 20px; }
    }

    @media (max-width: 640px) {
        .dashboard-admin { padding: 16px; }
        .stats-grid { gap: 12px; }
        .stat-number { font-size: 28px; }
        .stat-icon { width: 44px; height: 44px; font-size: 20px; }
        .welcome-card { padding: 20px; flex-direction: column; align-items: flex-start; }
        .welcome-title h1 { font-size: 20px; }
        .list-item { flex-direction: column; align-items: flex-start; gap: 10px; }
        .item-actions { width: 100%; justify-content: flex-start; gap: 12px; }
    }
</style>

<div class="dashboard-admin">
    {{-- Welcome Section --}}
    <div class="welcome-card animate-slide-down delay-1">
        <div class="welcome-title">
            <h1>Selamat datang, {{ auth()->user()->name ?? 'Admin' }}! 👋</h1>
            <p>Kelola dan moderasi semua konten dengan mudah</p>
        </div>
        <div class="date-chip animate-glow">
            <i class="fas fa-calendar-alt"></i>
            {{ now()->translatedFormat('l, d F Y') }}
        </div>
    </div>

    {{-- Stats Grid --}}
    @php
        $totalPending = $pendingNews->count() + $pendingAgenda->count();
        $totalApproved = $approvedCount ?? 0;
        $totalRejected = $rejectedCount ?? 0;
    @endphp

    <div class="stats-grid">
        <div class="stat-card animate-slide-left delay-2 hover-lift">
            <div class="stat-info">
                <h4>📰 Berita Menunggu</h4>
                <div class="stat-number">{{ $pendingNews->count() }}</div>
                <div class="stat-trend">
                    <i class="fas fa-clock"></i> Perlu review
                </div>
            </div>
            <div class="stat-icon news hover-scale-icon">
                <i class="fas fa-newspaper"></i>
            </div>
        </div>

        <div class="stat-card animate-slide-left delay-3 hover-lift">
            <div class="stat-info">
                <h4>📅 Agenda Menunggu</h4>
                <div class="stat-number">{{ $pendingAgenda->count() }}</div>
                <div class="stat-trend">
                    <i class="fas fa-clock"></i> Perlu review
                </div>
            </div>
            <div class="stat-icon agenda hover-scale-icon">
                <i class="fas fa-calendar-alt"></i>
            </div>
        </div>

        <div class="stat-card animate-slide-left delay-4 hover-lift">
            <div class="stat-info">
                <h4>✅ Sudah Disetujui</h4>
                <div class="stat-number">{{ $totalApproved }}</div>
                <div class="stat-trend">
                    <i class="fas fa-check-circle"></i> Telah tayang
                </div>
            </div>
            <div class="stat-icon approved hover-scale-icon">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>

        <div class="stat-card animate-slide-left delay-5 hover-lift">
            <div class="stat-info">
                <h4>❌ Ditolak</h4>
                <div class="stat-number">{{ $totalRejected }}</div>
                <div class="stat-trend">
                    <i class="fas fa-times-circle"></i> Tidak disetujui
                </div>
            </div>
            <div class="stat-icon rejected hover-scale-icon">
                <i class="fas fa-times-circle"></i>
            </div>
        </div>
    </div>

    {{-- Charts Section --}}
    @php
        $totalKonten = $totalApproved + $pendingNews->count() + $pendingAgenda->count() + $totalRejected;
        if ($totalKonten == 0) {
            $chartApproved = 1;
            $chartNews = 1;
            $chartAgenda = 1;
            $chartRejected = 1;
        } else {
            $chartApproved = $totalApproved;
            $chartNews = $pendingNews->count();
            $chartAgenda = $pendingAgenda->count();
            $chartRejected = $totalRejected;
        }
    @endphp

    <div class="two-columns">
        {{-- Donut Chart Card --}}
        <div class="card animate-fade-scale delay-6">
            <div class="card-header">
                <h3>
                    <i class="fas fa-chart-pie"></i>
                    Status Seluruh Konten
                </h3>
                <span style="font-size: 11px; color: var(--gray-400);">Total: {{ $totalKonten }}</span>
            </div>
            <div class="chart-wrapper">
                <canvas id="statusChart" style="width:100%; height:220px;"></canvas>
            </div>
            <div class="chart-legend">
                <div class="legend-item">
                    <span class="legend-dot" style="background: #059669;"></span>
                    <span>✅ Disetujui ({{ $chartApproved }})</span>
                </div>
                <div class="legend-item">
                    <span class="legend-dot" style="background: #2563eb;"></span>
                    <span>📰 Berita ({{ $chartNews }})</span>
                </div>
                <div class="legend-item">
                    <span class="legend-dot" style="background: #10b981;"></span>
                    <span>📅 Agenda ({{ $chartAgenda }})</span>
                </div>
                <div class="legend-item">
                    <span class="legend-dot" style="background: #dc2626;"></span>
                    <span>❌ Ditolak ({{ $chartRejected }})</span>
                </div>
            </div>
        </div>

        {{-- Bar Chart Card --}}
        <div class="card animate-fade-scale delay-7">
            <div class="card-header">
                <h3>
                    <i class="fas fa-chart-bar"></i>
                    Perbandingan Konten Pending
                </h3>
                <span style="font-size: 11px; color: var(--gray-400);">Menunggu review</span>
            </div>
            <div class="chart-wrapper">
                <canvas id="pendingChart" style="width:100%; height:220px;"></canvas>
            </div>
            <div class="chart-legend">
                <div class="legend-item">
                    <span class="legend-dot" style="background: #2563eb;"></span>
                    <span>📰 Berita: {{ $pendingNews->count() }}</span>
                </div>
                <div class="legend-item">
                    <span class="legend-dot" style="background: #10b981;"></span>
                    <span>📅 Agenda: {{ $pendingAgenda->count() }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Content Lists --}}
    <div class="content-grid">
        {{-- Berita List --}}
        <div class="list-card animate-slide-up delay-8">
            <div class="list-header">
                <h3>
                    <i class="fas fa-newspaper"></i>
                    Berita Menunggu Review
                </h3>
                <span class="badge-count">{{ $pendingNews->count() }}</span>
            </div>
            <div class="list-content">
                @if($pendingNews->count() > 0)
                    @foreach($pendingNews as $index => $berita)
                        <div class="list-item" style="--item-order: {{ $index + 1 }}">
                            <div class="item-info">
                                <div class="item-title">{{ Str::limit($berita->title, 50) }}</div>
                                <div class="item-meta">
                                    <span><i class="fas fa-user"></i> {{ $berita->user->name ?? 'Unknown' }}</span>
                                    <span><i class="far fa-clock"></i> {{ $berita->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            <div class="item-actions">
                                <span class="type-badge news">
                                    <i class="fas fa-newspaper"></i> Berita
                                </span>
                                <form method="POST" action="{{ route('admin.news.approve', $berita->id) }}" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn-icon approve" title="Setujui" onclick="return confirm('Setujui berita ini?')">
                                        <i class="fas fa-check-circle"></i>
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('admin.news.reject', $berita->id) }}" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn-icon reject" title="Tolak" onclick="return confirm('Tolak berita ini?')">
                                        <i class="fas fa-times-circle"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-state">
                        <i class="fas fa-check-circle" style="color: var(--success);"></i>
                        <p>Tidak ada berita yang menunggu review</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Agenda List --}}
        <div class="list-card animate-slide-up delay-8">
            <div class="list-header">
                <h3>
                    <i class="fas fa-calendar-alt"></i>
                    Agenda Menunggu Review
                </h3>
                <span class="badge-count agenda">{{ $pendingAgenda->count() }}</span>
            </div>
            <div class="list-content">
                @if($pendingAgenda->count() > 0)
                    @foreach($pendingAgenda as $index => $agenda)
                        <div class="list-item" style="--item-order: {{ $index + 1 }}">
                            <div class="item-info">
                                <div class="item-title">{{ Str::limit($agenda->title, 50) }}</div>
                                <div class="item-meta">
                                    <span><i class="fas fa-user"></i> {{ $agenda->user->name ?? 'Unknown' }}</span>
                                    <span><i class="fas fa-calendar-day"></i> {{ \Carbon\Carbon::parse($agenda->date)->format('d M Y') }}</span>
                                    @if($agenda->location)
                                    <span><i class="fas fa-map-marker-alt"></i> {{ Str::limit($agenda->location, 20) }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="item-actions">
                                <span class="type-badge agenda">
                                    <i class="fas fa-calendar-alt"></i> Agenda
                                </span>
                                <form method="POST" action="{{ route('admin.agenda.approve', $agenda->id) }}" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn-icon approve" title="Setujui" onclick="return confirm('Setujui agenda ini?')">
                                        <i class="fas fa-check-circle"></i>
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('admin.agenda.reject', $agenda->id) }}" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn-icon reject" title="Tolak" onclick="return confirm('Tolak agenda ini?')">
                                        <i class="fas fa-times-circle"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-state">
                        <i class="fas fa-check-circle" style="color: var(--success);"></i>
                        <p>Tidak ada agenda yang menunggu review</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Chart.js CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Donut Chart - Status Seluruh Konten
        const ctx1 = document.getElementById('statusChart').getContext('2d');
        new Chart(ctx1, {
            type: 'doughnut',
            data: {
                labels: ['Disetujui', 'Berita Pending', 'Agenda Pending', 'Ditolak'],
                datasets: [{
                    data: [{{ $chartApproved }}, {{ $chartNews }}, {{ $chartAgenda }}, {{ $chartRejected }}],
                    backgroundColor: ['#059669', '#2563eb', '#10b981', '#dc2626'],
                    borderWidth: 0,
                    hoverOffset: 15,
                    hoverBorderWidth: 2,
                    hoverBorderColor: 'white'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#1e293b',
                        titleColor: '#f1f5f9',
                        bodyColor: '#cbd5e1',
                        padding: 10,
                        cornerRadius: 8,
                        callbacks: {
                            label: function(context) {
                                const total = {{ $totalKonten }};
                                const value = context.raw;
                                const percentage = Math.round((value / total) * 100);
                                return `${context.label}: ${value} konten (${percentage}%)`;
                            }
                        }
                    }
                },
                cutout: '65%',
                animation: {
                    duration: 1500,
                    easing: 'easeInOutQuart',
                    animateRotate: true,
                    animateScale: true
                },
                hover: {
                    mode: 'index',
                    intersect: false,
                    animationDuration: 400
                }
            }
        });

        // Bar Chart - Perbandingan Konten Pending
        const ctx2 = document.getElementById('pendingChart').getContext('2d');
        new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: ['Berita', 'Agenda'],
                datasets: [{
                    label: 'Menunggu Persetujuan',
                    data: [{{ $pendingNews->count() }}, {{ $pendingAgenda->count() }}],
                    backgroundColor: ['#2563eb', '#10b981'],
                    borderRadius: 8,
                    barPercentage: 0.6,
                    categoryPercentage: 0.8,
                    hoverBackgroundColor: ['#1d4ed8', '#059669']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#1e293b',
                        titleColor: '#f1f5f9',
                        bodyColor: '#cbd5e1',
                        padding: 10,
                        cornerRadius: 8,
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
                        grid: { color: '#f1f5f9', drawBorder: false },
                        ticks: { 
                            stepSize: 1, 
                            precision: 0,
                            font: { size: 11, family: "'Inter', sans-serif" }
                        },
                        animation: {
                            duration: 1000,
                            easing: 'easeInOutQuart'
                        }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { 
                            font: { size: 12, weight: '600', family: "'Inter', sans-serif" }
                        },
                        animation: {
                            duration: 1000,
                            easing: 'easeInOutQuart'
                        }
                    }
                },
                animation: {
                    duration: 1200,
                    easing: 'easeInOutQuart',
                    delay: 300
                },
                hover: {
                    mode: 'index',
                    intersect: false,
                    animationDuration: 400
                }
            }
        });
    });
</script>
@endsection
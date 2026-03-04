<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'LPM CMS - Admin Panel')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* CSS TERISOLASI - Prefix: lpm-staff- untuk menghindari konflik */
        :root {
            --lpm-primary: #0f2a44;
            --lpm-primary-light: #1e3a5c;
            --lpm-secondary: #2563eb;
            --lpm-accent: #059669;
            --lpm-light: #f8fafc;
            --lpm-dark: #1e293b;
            --lpm-gray: #64748b;
            --lpm-gray-light: #e2e8f0;
            --lpm-gray-border: #cbd5e1;
            --lpm-danger: #dc2626;
            --lpm-warning: #d97706;
            --lpm-info: #0ea5e9;
            --lpm-sidebar-width: 280px;
            --lpm-topbar-height: 64px;
            --lpm-border-radius: 8px;
            --lpm-border-radius-sm: 6px;
            --lpm-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            --lpm-shadow-lg: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
            --lpm-shadow-xl: 0 20px 40px -10px rgba(0, 0, 0, 0.15);
            --lpm-transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            --lpm-transition-slow: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Reset khusus untuk layout staff */
        .lpm-body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background-color: var(--lpm-light);
            color: var(--lpm-dark);
            line-height: 1.6;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            overflow-x: hidden;
        }

        /* Layout Container */
        .lpm-layout {
            display: flex;
            min-height: 100vh;
            position: relative;
        }

        /* SIDEBAR */
        .lpm-sidebar {
            width: var(--lpm-sidebar-width);
            background: linear-gradient(180deg, var(--lpm-primary) 0%, #0c2238 100%);
            color: white;
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            z-index: 1100;
            border-right: 1px solid rgba(255, 255, 255, 0.08);
            transition: var(--lpm-transition-slow);
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        .lpm-sidebar-header {
            padding: 24px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            height: var(--lpm-topbar-height);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .lpm-sidebar-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: white;
        }

        .lpm-sidebar-logo-icon {
            font-size: 1.5rem;
            color: var(--lpm-accent);
            background: rgba(5, 150, 105, 0.15);
            width: 40px;
            height: 40px;
            border-radius: var(--lpm-border-radius);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .lpm-sidebar-logo-text {
            font-size: 1.25rem;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .lpm-sidebar-nav {
            flex: 1;
            padding: 24px 16px;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: rgba(255, 255, 255, 0.2) transparent;
        }

        .lpm-sidebar-nav::-webkit-scrollbar {
            width: 4px;
        }

        .lpm-sidebar-nav::-webkit-scrollbar-track {
            background: transparent;
        }

        .lpm-sidebar-nav::-webkit-scrollbar-thumb {
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 4px;
        }

        .lpm-nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 16px;
            color: rgba(255, 255, 255, 0.75);
            text-decoration: none;
            border-radius: var(--lpm-border-radius-sm);
            margin-bottom: 6px;
            transition: var(--lpm-transition);
            font-weight: 500;
            font-size: 0.9375rem;
            position: relative;
            overflow: hidden;
        }

        .lpm-nav-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            transform: translateX(2px);
        }

        .lpm-nav-item.active {
            background: linear-gradient(90deg, rgba(37, 99, 235, 0.25) 0%, rgba(37, 99, 235, 0.15) 100%);
            color: white;
            border-left: 3px solid var(--lpm-secondary);
        }

        .lpm-nav-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 3px;
            background: var(--lpm-secondary);
        }

        .lpm-nav-item i {
            width: 20px;
            text-align: center;
            font-size: 1.125rem;
        }

        .lpm-nav-item.logout {
            color: #fca5a5;
            margin-top: 16px;
            background: rgba(220, 38, 38, 0.1);
        }

        .lpm-nav-item.logout:hover {
            background: rgba(220, 38, 38, 0.2);
            color: #f87171;
        }

        .lpm-sidebar-footer {
            padding: 20px 24px;
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.5);
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            line-height: 1.4;
        }

        .lpm-sidebar-footer a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: var(--lpm-transition);
        }

        .lpm-sidebar-footer a:hover {
            color: white;
        }

        /* MAIN CONTENT */
        .lpm-main {
            flex: 1;
            margin-left: var(--lpm-sidebar-width);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            transition: var(--lpm-transition);
        }

        /* TOPBAR */
        .lpm-topbar {
            background: white;
            height: var(--lpm-topbar-height);
            border-bottom: 1px solid var(--lpm-gray-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: var(--lpm-shadow);
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.95);
        }

        .lpm-page-title-container {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .lpm-menu-toggle {
            display: none;
            background: none;
            border: none;
            color: var(--lpm-gray);
            font-size: 1.25rem;
            cursor: pointer;
            padding: 8px;
            border-radius: var(--lpm-border-radius-sm);
            transition: var(--lpm-transition);
            width: 40px;
            height: 40px;
            align-items: center;
            justify-content: center;
        }

        .lpm-menu-toggle:hover {
            background-color: var(--lpm-gray-light);
            color: var(--lpm-dark);
        }

        .lpm-page-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--lpm-dark);
            letter-spacing: -0.3px;
        }

        /* USER INFO */
        .lpm-user-info {
            display: flex;
            align-items: center;
            gap: 12px;
            position: relative;
        }

        .lpm-user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--lpm-secondary), var(--lpm-accent));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.9375rem;
            border: 2px solid white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: var(--lpm-transition);
            cursor: pointer;
        }

        .lpm-user-avatar:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .lpm-user-details {
            display: flex;
            flex-direction: column;
        }

        .lpm-user-name {
            font-weight: 600;
            color: var(--lpm-dark);
            font-size: 0.875rem;
            line-height: 1.3;
        }

        .lpm-user-role {
            font-size: 0.75rem;
            color: var(--lpm-gray);
            line-height: 1.3;
        }

        /* CONTENT AREA */
        .lpm-content {
            padding: 32px;
            flex: 1;
            animation: lpmFadeIn 0.4s ease-out;
        }

        .lpm-content-header {
            margin-bottom: 32px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap;
            gap: 16px;
        }

        .lpm-content-title-group {
            flex: 1;
            min-width: 300px;
        }

        .lpm-content-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--lpm-dark);
            margin-bottom: 8px;
            letter-spacing: -0.5px;
            line-height: 1.2;
        }

        .lpm-content-subtitle {
            color: var(--lpm-gray);
            font-size: 0.9375rem;
            line-height: 1.5;
            max-width: 600px;
        }

        .lpm-content-actions {
            display: flex;
            gap: 12px;
            align-items: center;
            flex-wrap: wrap;
        }

        /* CARDS */
        .lpm-card {
            background: white;
            border-radius: var(--lpm-border-radius);
            padding: 28px;
            box-shadow: var(--lpm-shadow);
            margin-bottom: 24px;
            border: 1px solid var(--lpm-gray-border);
            transition: var(--lpm-transition);
            position: relative;
            overflow: hidden;
        }

        .lpm-card:hover {
            box-shadow: var(--lpm-shadow-lg);
            transform: translateY(-2px);
        }

        .lpm-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--lpm-gray-light);
        }

        .lpm-card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--lpm-dark);
            line-height: 1.3;
        }

        /* STATS CARDS */
        .lpm-stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
            margin-top: 32px;
        }

        .lpm-stat-card {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 24px;
            position: relative;
        }

        .lpm-stat-icon {
            width: 60px;
            height: 60px;
            border-radius: var(--lpm-border-radius);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            flex-shrink: 0;
        }

        .lpm-stat-content {
            flex: 1;
        }

        .lpm-stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--lpm-dark);
            margin-bottom: 4px;
            line-height: 1;
        }

        .lpm-stat-label {
            color: var(--lpm-gray);
            font-size: 0.875rem;
            font-weight: 500;
        }

        .lpm-stat-trend {
            font-size: 0.75rem;
            padding: 2px 8px;
            border-radius: 12px;
            font-weight: 500;
            margin-top: 8px;
            display: inline-block;
        }

        .lpm-stat-trend.up {
            background-color: #d1fae5;
            color: #065f46;
        }

        .lpm-stat-trend.down {
            background-color: #fee2e2;
            color: #991b1b;
        }

        /* BUTTONS */
        .lpm-btn {
            padding: 10px 20px;
            border-radius: var(--lpm-border-radius-sm);
            border: 1px solid transparent;
            font-weight: 600;
            font-size: 0.875rem;
            cursor: pointer;
            transition: var(--lpm-transition);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-family: inherit;
            text-decoration: none;
            text-align: center;
            line-height: 1.5;
            white-space: nowrap;
        }

        .lpm-btn-primary {
            background-color: var(--lpm-secondary);
            color: white;
            border-color: var(--lpm-secondary);
        }

        .lpm-btn-primary:hover {
            background-color: #1d4ed8;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
        }

        .lpm-btn-success {
            background-color: var(--lpm-accent);
            color: white;
            border-color: var(--lpm-accent);
        }

        .lpm-btn-success:hover {
            background-color: #047857;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(5, 150, 105, 0.2);
        }

        .lpm-btn-outline {
            background-color: transparent;
            border-color: var(--lpm-gray-border);
            color: var(--lpm-dark);
        }

        .lpm-btn-outline:hover {
            background-color: var(--lpm-gray-light);
            border-color: var(--lpm-gray);
            transform: translateY(-1px);
        }

        /* BADGES */
        .lpm-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.3px;
        }

        .lpm-badge-success {
            background-color: #d1fae5;
            color: #065f46;
        }

        .lpm-badge-warning {
            background-color: #fef3c7;
            color: #92400e;
        }

        .lpm-badge-danger {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .lpm-badge-info {
            background-color: #e0f2fe;
            color: #0c4a6e;
        }

        /* MODAL STYLES */
        .lpm-modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            backdrop-filter: blur(4px);
            animation: lpmFadeIn 0.3s ease-out;
        }

        .lpm-modal-overlay.active {
            display: flex;
        }

        .lpm-modal {
            background: white;
            border-radius: var(--lpm-border-radius);
            box-shadow: var(--lpm-shadow-xl);
            max-width: 480px;
            width: 90%;
            animation: lpmModalSlideIn 0.3s ease-out;
            overflow: hidden;
        }

        @keyframes lpmModalSlideIn {
            from {
                opacity: 0;
                transform: translateY(-20px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .lpm-modal-header {
            padding: 24px;
            background: var(--lpm-light);
            border-bottom: 1px solid var(--lpm-gray-border);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .lpm-modal-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            flex-shrink: 0;
        }

        .lpm-modal-icon.warning {
            background-color: #fef3c7;
            color: var(--lpm-warning);
        }

        .lpm-modal-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--lpm-dark);
            line-height: 1.3;
        }

        .lpm-modal-body {
            padding: 24px;
        }

        .lpm-modal-message {
            color: var(--lpm-gray);
            font-size: 0.9375rem;
            line-height: 1.6;
            margin-bottom: 24px;
        }

        .lpm-modal-actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            padding: 16px 24px 24px;
            border-top: 1px solid var(--lpm-gray-border);
        }

        .lpm-modal-btn {
            padding: 10px 24px;
            border-radius: var(--lpm-border-radius-sm);
            font-weight: 600;
            font-size: 0.875rem;
            cursor: pointer;
            transition: var(--lpm-transition);
            border: 1px solid transparent;
            min-width: 100px;
        }

        .lpm-modal-btn-cancel {
            background-color: var(--lpm-gray-light);
            color: var(--lpm-dark);
            border-color: var(--lpm-gray-border);
        }

        .lpm-modal-btn-cancel:hover {
            background-color: var(--lpm-gray);
            color: white;
        }

        .lpm-modal-btn-confirm {
            background-color: var(--lpm-danger);
            color: white;
            border-color: var(--lpm-danger);
        }

        .lpm-modal-btn-confirm:hover {
            background-color: #b91c1c;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.2);
        }

        /* OVERLAY */
        .lpm-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1050;
            backdrop-filter: blur(3px);
            animation: lpmFadeIn 0.3s ease-out;
        }

        .lpm-overlay.active {
            display: block;
        }

        /* RESPONSIVE DESIGN */
        @media (max-width: 1200px) {
            .lpm-content {
                padding: 28px;
            }
            
            .lpm-stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 992px) {
            .lpm-sidebar {
                transform: translateX(-100%);
                box-shadow: var(--lpm-shadow-xl);
            }

            .lpm-sidebar.active {
                transform: translateX(0);
            }

            .lpm-main {
                margin-left: 0;
            }

            .lpm-menu-toggle {
                display: flex;
            }
        }

        @media (max-width: 768px) {
            .lpm-content {
                padding: 24px;
            }
            
            .lpm-topbar {
                padding: 0 24px;
            }
            
            .lpm-content-header {
                flex-direction: column;
                align-items: stretch;
                gap: 20px;
            }
            
            .lpm-content-title-group {
                min-width: 100%;
            }
            
            .lpm-content-actions {
                width: 100%;
            }
            
            .lpm-btn {
                flex: 1;
                justify-content: center;
                min-width: 120px;
            }
            
            .lpm-stats-grid {
                grid-template-columns: 1fr;
            }
            
            .lpm-modal {
                width: 95%;
                margin: 0 16px;
            }
        }

        @media (max-width: 640px) {
            .lpm-user-details {
                display: none;
            }
            
            .lpm-content {
                padding: 20px;
            }
            
            .lpm-card {
                padding: 20px;
            }
            
            .lpm-content-title {
                font-size: 1.5rem;
            }
            
            .lpm-modal-header {
                padding: 20px;
            }
            
            .lpm-modal-body {
                padding: 20px;
            }
            
            .lpm-modal-actions {
                flex-direction: column;
                gap: 10px;
            }
            
            .lpm-modal-btn {
                width: 100%;
                min-width: auto;
            }
        }

        @media (max-width: 480px) {
            .lpm-topbar {
                padding: 0 16px;
            }
            
            .lpm-sidebar {
                width: 260px;
            }
            
            .lpm-content {
                padding: 16px;
            }
            
            .lpm-card {
                padding: 16px;
            }
            
            .lpm-stat-card {
                flex-direction: column;
                text-align: center;
                gap: 16px;
            }
            
            .lpm-stat-icon {
                width: 50px;
                height: 50px;
                font-size: 1.5rem;
            }
        }

        /* ANIMATIONS */
        @keyframes lpmFadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes lpmSlideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .lpm-fade-in {
            animation: lpmFadeIn 0.4s ease-out;
        }

        .lpm-slide-in {
            animation: lpmSlideIn 0.3s ease-out;
        }

        /* UTILITY CLASSES */
        .lpm-text-muted {
            color: var(--lpm-gray);
        }

        .lpm-text-center {
            text-align: center;
        }

        .lpm-flex {
            display: flex;
        }

        .lpm-flex-col {
            flex-direction: column;
        }

        .lpm-items-center {
            align-items: center;
        }

        .lpm-justify-between {
            justify-content: space-between;
        }

        .lpm-gap-4 {
            gap: 16px;
        }

        .lpm-mt-4 {
            margin-top: 16px;
        }

        .lpm-mb-4 {
            margin-bottom: 16px;
        }

        .lpm-p-4 {
            padding: 16px;
        }

        .lpm-w-full {
            width: 100%;
        }
    </style>
</head>
<body class="lpm-body">

<div class="lpm-layout">
    <div class="lpm-overlay" id="lpmOverlay"></div>

    <!-- Logout Confirmation Modal -->
    <div class="lpm-modal-overlay" id="logoutModal">
        <div class="lpm-modal">
            <div class="lpm-modal-header">
                <div class="lpm-modal-icon warning">
                    <i class="fas fa-sign-out-alt"></i>
                </div>
                <div class="lpm-modal-title">Konfirmasi Logout</div>
            </div>
            
            <div class="lpm-modal-body">
                <p class="lpm-modal-message">
                    <strong>Yakin mau keluar?</strong><br>
                    Anda akan keluar dari sistem dan diarahkan ke halaman login.
                </p>
            </div>
            
            <div class="lpm-modal-actions">
                <button type="button" class="lpm-modal-btn lpm-modal-btn-cancel" id="logoutCancelBtn">
                    Batal
                </button>
                <form method="POST" action="{{ route('logout') }}" id="logoutForm">
                    @csrf
                    <button type="submit" class="lpm-modal-btn lpm-modal-btn-confirm">
                        Ya, Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- SIDEBAR -->
    <div class="lpm-sidebar" id="lpmSidebar">
        <div class="lpm-sidebar-header">
            <a href="{{ route('dashboard') }}" class="lpm-sidebar-logo">
                <div class="lpm-sidebar-logo-icon">
                    <i class="fas fa-newspaper"></i>
                </div>
                <div class="lpm-sidebar-logo-text">LPM CMS</div>
            </a>
        </div>
        
        <div class="lpm-sidebar-nav">
            <a href="{{ route('dashboard') }}" class="lpm-nav-item">
                <i class="fas fa-chart-bar"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('staff.news.create') }}" class="lpm-nav-item">
                <i class="fas fa-plus-circle"></i>
                <span>Buat Berita</span>
            </a>

            <a href="{{ route('staff.news.index') }}" class="lpm-nav-item">
                <i class="fas fa-newspaper"></i>
                <span>Data Berita</span>
            </a>

            <a href="{{ route('staff.agenda.index') }}" class="lpm-nav-item">
                <i class="fas fa-calendar-alt"></i>
                <span>Agenda</span>
            </a>

            <a href="{{ route('staff.hero-banners.create') }}" class="lpm-nav-item">
                <i class="fas fa-images"></i>
                <span>Hero Banner</span>
            </a>

            <a href="{{ route('staff.organization-structure.index') }}" class="lpm-nav-item">
                <i class="fas fa-sitemap"></i>
                <span>Struktur Organisasi</span>
            </a>

            <a href="{{ route('staff.password.edit') }}" class="lpm-nav-item">
                <i class="fas fa-sitemap"></i>
                <span>Reset Password</span>
            </a>

            <a href="{{ route('staff.spmi.create') }}" class="lpm-nav-item">
                <i class="fas fa-sitemap"></i>
                <span>Input Dokumen (Halaman Dokumen)</span>
            </a>

            <a href="{{ route('staff.mutu-eksternal.create') }}" class="lpm-nav-item">
                <i class="fas fa-sitemap"></i>
                <span>Input Mutu Eksternal </span>
            </a>

            <a href="{{ route('staff.mutu-internal.index') }}" class="lpm-nav-item">
                <i class="fas fa-sitemap"></i>
                <span>Input Mutu Internal </span>
            </a>
            
            <!-- Logout Button - Tidak menggunakan form langsung -->
            <a href="#" class="lpm-nav-item logout" id="logoutTrigger">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </div>
        
        <div class="lpm-sidebar-footer">
            <div style="margin-bottom: 8px;">
                <strong>LPM CMS v2.1</strong>
            </div>
            <div>© 2024 Lembaga Pers Mahasiswa</div>
            <div style="margin-top: 8px;">
                <a href="#" style="font-size: 0.7rem;">Privacy Policy</a> • 
                <a href="#" style="font-size: 0.7rem;">Terms of Service</a>
            </div>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="lpm-main">
        <div class="lpm-topbar">
            <div class="lpm-page-title-container">
                <button class="lpm-menu-toggle" id="lpmMenuToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="lpm-page-title">@yield('page-title', 'Dashboard')</div>
            </div>
            
            <div class="lpm-user-info">
                <div class="lpm-user-details">
                    <div class="lpm-user-name">{{ auth()->user()->name ?? 'Administrator' }}</div>
                    <div class="lpm-user-role">Admin Sistem</div>
                </div>
                <div class="lpm-user-avatar">
                    {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                </div>
            </div>
        </div>

        <div class="lpm-content">
            <!-- Content Header -->
            <div class="lpm-content-header">
                <div class="lpm-content-title-group">
                </div>
                
                <div class="lpm-content-actions">
                    @hasSection('action-button')
                        @yield('action-button')
                    @endif
                </div>
            </div>
            
            <!-- Main Content -->
            @yield('content')
            
            <!-- Default Content (jika tidak ada content) -->
            @hasSection('content')
            @else
            <div class="lpm-card lpm-fade-in">
                <div class="lpm-card-header">
                    <h3 class="lpm-card-title">Ringkasan Sistem</h3>
                    <span class="lpm-badge lpm-badge-success">Sistem Aktif</span>
                </div>
                <div class="lpm-text-muted lpm-mb-4">
                    Sistem manajemen konten LPM sedang berjalan dengan optimal. Anda dapat menggunakan menu navigasi di sidebar untuk mengelola berbagai konten dan fitur.
                </div>
                
                <div class="lpm-stats-grid">
                    <div class="lpm-card lpm-stat-card lpm-slide-in" style="animation-delay: 0.1s;">
                        <div class="lpm-stat-icon" style="background-color: #eff6ff; color: #1d4ed8;">
                            <i class="fas fa-newspaper"></i>
                        </div>
                        <div class="lpm-stat-content">
                            <div class="lpm-stat-value">24</div>
                            <div class="lpm-stat-label">Total Berita</div>
                            <span class="lpm-stat-trend up">+5 minggu ini</span>
                        </div>
                    </div>
                    
                    <div class="lpm-card lpm-stat-card lpm-slide-in" style="animation-delay: 0.2s;">
                        <div class="lpm-stat-icon" style="background-color: #f0f9ff; color: #0c4a6e;">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="lpm-stat-content">
                            <div class="lpm-stat-value">8</div>
                            <div class="lpm-stat-label">Agenda Aktif</div>
                            <span class="lpm-stat-trend up">+2 hari ini</span>
                        </div>
                    </div>
                    
                    <div class="lpm-card lpm-stat-card lpm-slide-in" style="animation-delay: 0.3s;">
                        <div class="lpm-stat-icon" style="background-color: #fefce8; color: #854d0e;">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="lpm-stat-content">
                            <div class="lpm-stat-value">1.2K</div>
                            <div class="lpm-stat-label">Pengunjung Hari Ini</div>
                            <span class="lpm-stat-trend up">+12% dari kemarin</span>
                        </div>
                    </div>
                    
                    <div class="lpm-card lpm-stat-card lpm-slide-in" style="animation-delay: 0.4s;">
                        <div class="lpm-stat-icon" style="background-color: #f5f3ff; color: #6d28d9;">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="lpm-stat-content">
                            <div class="lpm-stat-value">156</div>
                            <div class="lpm-stat-label">Pengguna Aktif</div>
                            <span class="lpm-stat-trend down">-3 dari minggu lalu</span>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<script>
    // JavaScript untuk LPM Staff Layout dengan Konfirmasi Logout
    document.addEventListener('DOMContentLoaded', function() {
        const menuToggle = document.getElementById('lpmMenuToggle');
        const sidebar = document.getElementById('lpmSidebar');
        const overlay = document.getElementById('lpmOverlay');
        const logoutModal = document.getElementById('logoutModal');
        const logoutTrigger = document.getElementById('logoutTrigger');
        const logoutCancelBtn = document.getElementById('logoutCancelBtn');
        const logoutForm = document.getElementById('logoutForm');
        
        // Mobile menu toggle
        if (menuToggle && sidebar && overlay) {
            menuToggle.addEventListener('click', function() {
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
                document.body.style.overflow = sidebar.classList.contains('active') ? 'hidden' : '';
            });
            
            overlay.addEventListener('click', function() {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
                document.body.style.overflow = '';
            });
            
            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                const isClickInsideSidebar = sidebar.contains(event.target);
                const isClickOnMenuToggle = menuToggle.contains(event.target);
                
                if (window.innerWidth <= 992 && 
                    !isClickInsideSidebar && 
                    !isClickOnMenuToggle && 
                    sidebar.classList.contains('active')) {
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                    document.body.style.overflow = '';
                }
            });
        }
        
        // Set active nav item based on current URL
        const currentPath = window.location.pathname;
        document.querySelectorAll('.lpm-nav-item').forEach(item => {
            const href = item.getAttribute('href');
            if (href && (currentPath === href || currentPath.startsWith(href + '/'))) {
                item.classList.add('active');
            }
        });
        
        // LOGOUT CONFIRMATION SYSTEM
        if (logoutTrigger && logoutModal && logoutCancelBtn) {
            // Show logout confirmation modal
            logoutTrigger.addEventListener('click', function(e) {
                e.preventDefault();
                logoutModal.classList.add('active');
                document.body.style.overflow = 'hidden';
            });
            
            // Close modal when cancel button is clicked
            logoutCancelBtn.addEventListener('click', function() {
                logoutModal.classList.remove('active');
                document.body.style.overflow = '';
            });
            
            // Close modal when clicking outside the modal
            logoutModal.addEventListener('click', function(e) {
                if (e.target === logoutModal) {
                    logoutModal.classList.remove('active');
                    document.body.style.overflow = '';
                }
            });
            
            // Handle logout form submission
            if (logoutForm) {
                logoutForm.addEventListener('submit', function(e) {
                    // Add loading state to the confirm button
                    const confirmBtn = logoutForm.querySelector('button[type="submit"]');
                    const originalText = confirmBtn.textContent;
                    
                    confirmBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Keluar...';
                    confirmBtn.disabled = true;
                    
                    // Add a small delay to show the loading state
                    setTimeout(() => {
                        confirmBtn.textContent = originalText;
                        confirmBtn.disabled = false;
                        // Form will submit normally after this
                    }, 100);
                });
            }
            
            // Close modal with Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && logoutModal.classList.contains('active')) {
                    logoutModal.classList.remove('active');
                    document.body.style.overflow = '';
                }
            });
        }
        
        // Handle responsive behavior
        function handleResponsive() {
            const isMobile = window.innerWidth <= 992;
            
            if (menuToggle) {
                menuToggle.style.display = isMobile ? 'flex' : 'none';
            }
            
            // Auto-close sidebar when resizing to desktop
            if (!isMobile && sidebar && sidebar.classList.contains('active')) {
                sidebar.classList.remove('active');
                if (overlay) overlay.classList.remove('active');
                document.body.style.overflow = '';
            }
            
            // Update sidebar width on small screens
            if (sidebar) {
                if (window.innerWidth <= 480) {
                    sidebar.style.width = '260px';
                } else {
                    sidebar.style.width = '280px';
                }
            }
        }
        
        // Initial responsive setup
        handleResponsive();
        
        // Listen for resize events
        window.addEventListener('resize', handleResponsive);
        
        // Add smooth transitions after page load
        setTimeout(() => {
            document.body.style.transition = 'opacity 0.3s ease';
        }, 100);
        
        // Handle keyboard navigation for sidebar
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && sidebar && sidebar.classList.contains('active')) {
                sidebar.classList.remove('active');
                if (overlay) overlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
        
        // Add animation to cards on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);
        
        // Observe all cards for animation
        document.querySelectorAll('.lpm-card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
            observer.observe(card);
        });
        
        // Prevent form resubmission on page refresh
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
        
        // Add a nice page load animation
        document.body.style.opacity = '0';
        setTimeout(() => {
            document.body.style.transition = 'opacity 0.3s ease';
            document.body.style.opacity = '1';
        }, 50);
    });
</script>

</body>
</html>
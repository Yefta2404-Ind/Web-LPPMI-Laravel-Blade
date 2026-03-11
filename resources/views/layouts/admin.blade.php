<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - @yield('title', 'LPMI')</title>

@vite(['resources/css/app.css', 'resources/js/app.js'])

<script src="https://cdn.tailwindcss.com"></script>
    <style>
/* Fix supaya TinyMCE tidak rusak karena Tailwind */
.tox-tinymce {
    border: 1px solid #ccc !important;
    border-radius: 6px !important;
}

.tox .tox-toolbar,
.tox .tox-toolbar__primary {
    background-color: #fff !important;
}

.tox button {
    all: unset;
}
</style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
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

        /* Reset */
        body {
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

        /* Layout */
        .lpm-layout {
            display: flex;
            min-height: 100vh;
            position: relative;
        }

        /* SIDEBAR - SPACING DIPERBAIKI */
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
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        .lpm-sidebar-header {
            padding: 24px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            height: var(--lpm-topbar-height);
            display: flex;
            align-items: center;
            gap: 16px; /* SPACING DIPERLEBAR */
        }

        .lpm-sidebar-logo {
            display: flex;
            align-items: center;
            gap: 16px; /* SPACING DIPERLEBAR */
            text-decoration: none;
            color: white;
        }

        .lpm-sidebar-logo-icon {
            font-size: 1.5rem;
            color: var(--lpm-accent);
            background: rgba(5, 150, 105, 0.15);
            width: 44px; /* DIPERBESAR SEDIKIT */
            height: 44px; /* DIPERBESAR SEDIKIT */
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

        /* Navigation Items - SPACING DIPERBAIKI */
        .lpm-nav-title {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255, 255, 255, 0.6);
            padding: 0 20px 12px; /* SPACING DIPERLEBAR */
            margin-bottom: 8px;
            font-weight: 600;
        }

        .lpm-nav-item {
            display: flex;
            align-items: center;
            padding: 16px 20px; /* SPACING DIPERLEBAR (16px vertical, 20px horizontal) */
            color: rgba(255, 255, 255, 0.75);
            text-decoration: none;
            border-radius: var(--lpm-border-radius-sm);
            margin-bottom: 6px;
            font-weight: 500;
            font-size: 0.9375rem;
            position: relative;
            overflow: hidden;
            cursor: pointer;
            transition: var(--lpm-transition);
            gap: 16px; /* SPACING ICON DAN TEKS DIPERLEBAR */
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
            width: 24px; /* ICON LEBAR DIPERBESAR */
            text-align: center;
            font-size: 1.25rem; /* ICON SIZE DIPERBESAR */
            flex-shrink: 0; /* AGAR ICON TIDAK SHRINK */
        }

        /* Nested Menu Fix */
        .lpm-nav-item.has-submenu {
            justify-content: space-between;
            padding-right: 16px; /* SPACING UNTUK CHEVRON */
        }

        .lpm-nav-item.has-submenu::after {
            content: '\f078';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            font-size: 12px;
            transition: transform 0.3s;
            opacity: 0.7;
            margin-left: 4px; /* SPACING DARI TEKS */
        }

        .lpm-nav-item.has-submenu.expanded::after {
            transform: rotate(180deg);
        }

        .lpm-submenu {
            background-color: rgba(0, 0, 0, 0.2);
            border-radius: var(--lpm-border-radius-sm);
            margin: 4px 0 8px 0;
            overflow: hidden;
            max-height: 0;
            transition: max-height 0.3s ease-out;
        }

        .lpm-submenu.expanded {
            max-height: 500px;
        }

        .lpm-submenu-item {
            display: flex;
            align-items: center;
            padding: 14px 20px 14px 64px; /* SPACING DIPERLEBAR (20px left, 64px total left) */
            color: rgba(255, 255, 255, 0.6);
            text-decoration: none;
            font-size: 0.875rem;
            transition: var(--lpm-transition);
            position: relative;
            gap: 12px; /* SPACING ICON DAN TEKS */
        }

        .lpm-submenu-item:hover {
            background-color: rgba(255, 255, 255, 0.05);
            color: white;
        }

        .lpm-submenu-item.active {
            color: white;
            background-color: rgba(37, 99, 235, 0.2);
        }

        .lpm-submenu-item i {
            font-size: 0.875rem; /* ICON SIZE DIPERBESAR */
            width: 16px; /* ICON WIDTH */
            text-align: center;
        }

        /* Badge */
        .lpm-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background-color: var(--lpm-danger);
            color: white;
            font-size: 0.75rem;
            font-weight: 600;
            border-radius: 10px;
            min-width: 22px; /* DIPERBESAR SEDIKIT */
            height: 22px; /* DIPERBESAR SEDIKIT */
            padding: 0 6px;
            margin-left: 12px; /* SPACING DARI TEKS */
        }

        .lpm-sidebar-footer {
            padding: 20px;
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.5);
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            line-height: 1.4;
        }

        /* MAIN CONTENT */
        .lpm-main {
            flex: 1;
            margin-left: var(--lpm-sidebar-width);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
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
            gap: 20px; /* SPACING DIPERLEBAR */
        }

        .lpm-menu-toggle {
            display: none;
            background: none;
            border: none;
            color: var(--lpm-gray);
            font-size: 1.25rem;
            cursor: pointer;
            padding: 10px; /* SPACING DIPERLEBAR */
            border-radius: var(--lpm-border-radius-sm);
            transition: var(--lpm-transition);
            width: 44px; /* DIPERBESAR */
            height: 44px; /* DIPERBESAR */
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
            gap: 16px; /* SPACING DIPERLEBAR */
            position: relative;
        }

        .lpm-user-avatar {
            width: 44px; /* DIPERBESAR */
            height: 44px; /* DIPERBESAR */
            border-radius: 50%;
            background: linear-gradient(135deg, var(--lpm-secondary), var(--lpm-accent));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 1rem; /* DIPERBESAR */
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
            gap: 4px; /* SPACING DIPERLEBAR */
        }

        .lpm-user-name {
            font-weight: 600;
            color: var(--lpm-dark);
            font-size: 0.9375rem; /* DIPERBESAR SEDIKIT */
            line-height: 1.3;
        }

        .lpm-user-role {
            font-size: 0.8125rem; /* DIPERBESAR SEDIKIT */
            color: var(--lpm-gray);
            line-height: 1.3;
        }

        /* Stats Badge */
        .lpm-stats-badge {
            background: linear-gradient(135deg, var(--lpm-secondary), var(--lpm-accent));
            color: white;
            padding: 10px 18px; /* SPACING DIPERLEBAR */
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px; /* SPACING DIPERLEBAR */
            margin-right: 20px; /* SPACING DIPERLEBAR */
        }

        .lpm-stats-badge i {
            font-size: 0.875rem;
        }

        /* CONTENT AREA */
        .lpm-content {
            padding: 32px;
            flex: 1;
        }

        /* Breadcrumb */
        .lpm-breadcrumb {
            display: flex;
            align-items: center;
            color: var(--lpm-gray);
            font-size: 0.875rem;
            margin-bottom: 28px; /* SPACING DIPERLEBAR */
            gap: 12px; /* SPACING DIPERLEBAR */
        }

        .lpm-breadcrumb a {
            color: var(--lpm-secondary);
            text-decoration: none;
        }

        .lpm-breadcrumb a:hover {
            text-decoration: underline;
        }

        .lpm-breadcrumb-separator {
            color: var(--lpm-gray-light);
        }

        /* Content Header */
        .lpm-content-header {
            margin-bottom: 32px;
        }

        .lpm-content-title {
            font-size: 1.875rem; /* DIPERBESAR SEDIKIT */
            font-weight: 700;
            color: var(--lpm-dark);
            margin-bottom: 12px; /* SPACING DIPERLEBAR */
            letter-spacing: -0.5px;
            line-height: 1.2;
        }

        .lpm-content-subtitle {
            color: var(--lpm-gray);
            font-size: 1rem; /* DIPERBESAR SEDIKIT */
            line-height: 1.6; /* SPACING DIPERLEBAR */
            max-width: 600px;
        }

        /* Alerts */
        .lpm-alert {
            padding: 20px; /* SPACING DIPERLEBAR */
            border-radius: var(--lpm-border-radius);
            margin-bottom: 24px;
            display: flex;
            align-items: flex-start;
            gap: 16px; /* SPACING DIPERLEBAR */
            animation: lpmFadeIn 0.3s ease-out;
        }

        .lpm-alert-success {
            background-color: #d1fae5;
            border-left: 4px solid #059669;
            color: #065f46;
        }

        .lpm-alert-error {
            background-color: #fee2e2;
            border-left: 4px solid var(--lpm-danger);
            color: #991b1b;
        }

        .lpm-alert-warning {
            background-color: #fef3c7;
            border-left: 4px solid var(--lpm-warning);
            color: #92400e;
        }

        .lpm-alert-info {
            background-color: #e0f2fe;
            border-left: 4px solid var(--lpm-info);
            color: #0c4a6e;
        }

        .lpm-alert-icon {
            font-size: 1.5rem; /* DIPERBESAR */
            flex-shrink: 0;
            margin-top: 2px; /* ALIGNMENT DIPERBAIKI */
        }

        /* MODAL */
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
        }

        .lpm-modal-overlay.active {
            display: flex;
        }

        .lpm-modal {
            background: white;
            border-radius: var(--lpm-border-radius);
            box-shadow: var(--lpm-shadow-xl);
            max-width: 500px; /* DIPERLEBAR SEDIKIT */
            width: 90%;
            overflow: hidden;
            animation: lpmModalSlideIn 0.3s ease-out;
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
            padding: 28px; /* SPACING DIPERLEBAR */
            background: var(--lpm-light);
            border-bottom: 1px solid var(--lpm-gray-border);
            display: flex;
            align-items: center;
            gap: 16px; /* SPACING DIPERLEBAR */
        }

        .lpm-modal-icon {
            width: 48px; /* DIPERBESAR */
            height: 48px; /* DIPERBESAR */
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem; /* DIPERBESAR */
            flex-shrink: 0;
        }

        .lpm-modal-icon.warning {
            background-color: #fef3c7;
            color: var(--lpm-warning);
        }

        .lpm-modal-title {
            font-size: 1.5rem; /* DIPERBESAR */
            font-weight: 600;
            color: var(--lpm-dark);
            line-height: 1.3;
        }

        .lpm-modal-body {
            padding: 28px; /* SPACING DIPERLEBAR */
        }

        .lpm-modal-message {
            color: var(--lpm-gray);
            font-size: 1rem; /* DIPERBESAR */
            line-height: 1.6;
            margin-bottom: 24px;
        }

        .lpm-modal-actions {
            display: flex;
            gap: 16px; /* SPACING DIPERLEBAR */
            justify-content: flex-end;
            padding: 20px 28px 28px; /* SPACING DIPERLEBAR */
            border-top: 1px solid var(--lpm-gray-border);
        }

        .lpm-modal-btn {
            padding: 12px 28px; /* SPACING DIPERLEBAR */
            border-radius: var(--lpm-border-radius-sm);
            font-weight: 600;
            font-size: 0.9375rem; /* DIPERBESAR */
            cursor: pointer;
            transition: var(--lpm-transition);
            border: 1px solid transparent;
            min-width: 120px; /* DIPERLEBAR */
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
            background-color: var(--lpm-secondary);
            color: white;
            border-color: var(--lpm-secondary);
        }

        .lpm-modal-btn-confirm:hover {
            background-color: #1d4ed8;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
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
        }

        .lpm-overlay.active {
            display: block;
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

        .lpm-fade-in {
            animation: lpmFadeIn 0.4s ease-out;
        }

        /* RESPONSIVE DESIGN */
        @media (max-width: 1200px) {
            .lpm-content {
                padding: 28px;
            }
        }

        @media (max-width: 992px) {
            .lpm-sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
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
            
            .lpm-modal {
                width: 95%;
                margin: 0 16px;
            }
            
            .lpm-modal-actions {
                flex-direction: column;
                gap: 12px;
            }
            
            .lpm-modal-btn {
                width: 100%;
                min-width: auto;
            }
            
            .lpm-stats-badge {
                margin-right: 12px;
                padding: 8px 14px;
            }
        }

        @media (max-width: 640px) {
            .lpm-user-details {
                display: none;
            }
            
            .lpm-content {
                padding: 20px;
            }
            
            .lpm-content-title {
                font-size: 1.5rem;
            }
            
            .lpm-modal-header {
                padding: 24px;
            }
            
            .lpm-modal-body {
                padding: 24px;
            }
            
            .lpm-stats-badge {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .lpm-topbar {
                padding: 0 20px;
            }
            
            .lpm-sidebar {
                width: 280px; /* TETAP LEBAR UNTUK READABILITY */
            }
            
            .lpm-content {
                padding: 16px;
            }
            
            .lpm-nav-item {
                padding: 16px;
                gap: 14px;
            }
            
            .lpm-submenu-item {
                padding: 14px 20px 14px 60px;
            }
        }
    </style>
</head>
<body>
    <!-- Overlay -->
    <div class="lpm-overlay" id="lpmOverlay"></div>
    
    <!-- Logout Modal -->
    <div class="lpm-modal-overlay" id="logoutModal">
        <div class="lpm-modal">
            <div class="lpm-modal-header">
                <div class="lpm-modal-icon warning">
                    <i class="fas fa-sign-out-alt"></i>
                </div>
                <div class="lpm-modal-title">Confirm Logout</div>
            </div>
            
            <div class="lpm-modal-body">
                <p class="lpm-modal-message">
                    Are you sure you want to logout from your account?
                </p>
            </div>
            
            <div class="lpm-modal-actions">
                <button type="button" class="lpm-modal-btn lpm-modal-btn-cancel" id="logoutCancelBtn">
                    Cancel
                </button>
                <form method="POST" action="{{ route('logout') }}" id="logoutForm">
                    @csrf
                    <button type="submit" class="lpm-modal-btn lpm-modal-btn-confirm">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="lpm-layout">
        <!-- SIDEBAR DENGAN SPACING YANG DIPERBAIKI -->
        <div class="lpm-sidebar" id="lpmSidebar">
            <div class="lpm-sidebar-header">
                <a href="{{ route('admin.dashboard') }}" class="lpm-sidebar-logo">
                    <div class="lpm-sidebar-logo-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div>
                        <div class="lpm-sidebar-logo-text">LPMI Admin</div>
                        <div style="font-size: 0.75rem; opacity: 0.8;">Control Panel</div>
                    </div>
                </a>
            </div>
            
            <div class="lpm-sidebar-nav">
                <!-- Main Menu -->
                <div class="lpm-nav-title">Main Menu</div>
                <a href="{{ route('admin.dashboard') }}" 
                   class="lpm-nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                
                <!-- Content Management -->
                <div class="lpm-nav-title" style="margin-top: 24px;">Content Management</div>
                
                <!-- Agenda -->
                <div class="lpm-nav-item has-submenu" data-submenu="agenda-menu">
                    <div style="display: flex; align-items: center; flex: 1; gap: 16px;">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Agenda</span>
                    </div>
                </div>
                <div class="lpm-submenu" id="agenda-menu">
                    <a href="{{ route('admin.agenda.index') }}" 
                       class="lpm-submenu-item {{ request()->routeIs('admin.agenda.index') ? 'active' : '' }}">
                        <i class="fas fa-list"></i>
                        <span>All Agenda</span>
                    </a>
                </div>
                

                
                <!-- Hero Banner -->
                <div class="lpm-nav-item has-submenu" data-submenu="banner-menu">
                    <div style="display: flex; align-items: center; flex: 1; gap: 16px;">
                        <i class="fas fa-images"></i>
                        <span>Hero Banner</span>
                    </div>
                    @if(isset($pendingBannerCount) && $pendingBannerCount > 0)
                    <span class="lpm-badge">{{ $pendingBannerCount }}</span>
                    @endif
                </div>
                <div class="lpm-submenu" id="banner-menu">
                    <a href="{{ route('admin.hero-banners.pending') }}" 
                       class="lpm-submenu-item {{ request()->routeIs('admin.hero-banners.pending') ? 'active' : '' }}">
                        <i class="fas fa-clock"></i>
                        <span>Pending Banners</span>
                        @if(isset($pendingBannerCount) && $pendingBannerCount > 0)
                        <span class="lpm-badge" style="margin-left: auto;">{{ $pendingBannerCount }}</span>
                        @endif
                    </a>
                    <a href="{{ route('admin.hero-banners.index') }}" 
                       class="lpm-submenu-item {{ request()->routeIs('admin.hero-banners.index') ? 'active' : '' }}">
                        <i class="fas fa-list"></i>
                        <span>Active Banners</span>
                    </a>
                </div>
                
                <!-- Organization -->
                <div class="lpm-nav-item has-submenu" data-submenu="org-menu">
                    <div style="display: flex; align-items: center; flex: 1; gap: 16px;">
                        <i class="fas fa-sitemap"></i>
                        <span>Organization</span>
                    </div>
                    @if(isset($pendingOrgCount) && $pendingOrgCount > 0)
                    <span class="lpm-badge">{{ $pendingOrgCount }}</span>
                    @endif
                </div>
                <div class="lpm-submenu" id="org-menu">
                    <a href="{{ route('admin.organization-structure.pending') }}" 
                       class="lpm-submenu-item {{ request()->routeIs('admin.organization-structure.pending') ? 'active' : '' }}">
                        <i class="fas fa-clock"></i>
                        <span>Pending Structures</span>
                        @if(isset($pendingOrgCount) && $pendingOrgCount > 0)
                        <span class="lpm-badge" style="margin-left: auto;">{{ $pendingOrgCount }}</span>
                        @endif
                    </a>
                    <a href="{{ route('admin.organization-structure.index') }}" 
                       class="lpm-submenu-item {{ request()->routeIs('admin.organization-structure.index') ? 'active' : '' }}">
                        <i class="fas fa-list"></i>
                        <span>All Structures</span>
                    </a>
                </div>
                
                <!-- Surveys -->
                <div class="lpm-nav-item has-submenu" data-submenu="survey-menu">
                    <div style="display: flex; align-items: center; flex: 1; gap: 16px;">
                        <i class="fas fa-poll"></i>
                        <span>Surveys</span>
                    </div>
                </div>
                <div class="lpm-submenu" id="survey-menu">
                    <a href="{{ route('admin.surveys.index') }}" 
                       class="lpm-submenu-item {{ request()->routeIs('admin.surveys.index') ? 'active' : '' }}">
                        <i class="fas fa-list"></i>
                        <span>All Surveys</span>
                    </a>
                </div>
                <!-- Mutu Internal -->
<div class="lpm-nav-item has-submenu" data-submenu="internal-mutu-menu">
    <div style="display: flex; align-items: center; flex: 1; gap: 16px;">
        <i class="fas fa-clipboard-check"></i>
        <span>Mutu Internal</span>
    </div>
</div>

<div class="lpm-submenu" id="internal-mutu-menu">

    <a href="{{ route('admin.internal_categories.index') }}" 
       class="lpm-submenu-item {{ request()->routeIs('admin.internal_categories.*') ? 'active' : '' }}">
        <i class="fas fa-tags"></i>
        <span>Kategori</span>
    </a>

    <a href="{{ route('admin.internal_qualities.index') }}" 
       class="lpm-submenu-item {{ !request()->query('category') && request()->routeIs('admin.internal_qualities.*') ? 'active' : '' }}">
        <i class="fas fa-file-alt"></i>
        <span>Semua Laporan RTM</span>
    </a>

    {{-- Tambahkan submenu kategori dinamis --}}
    @foreach($internalCategories as $cat)
        <a href="{{ route('admin.internal_qualities.index', ['category' => $cat->id]) }}"
           class="lpm-submenu-item {{ request()->query('category') == $cat->id ? 'active' : '' }}">
           <i class="fas fa-tag"></i>
           <span>{{ $cat->name }}</span>
        </a>
    @endforeach

</div>



                <div class="lpm-nav-item has-submenu" data-submenu="dokumen-menu">
    <div style="display: flex; align-items: center; flex: 1; gap: 16px;">
        <i class="fas fa-folder-open"></i>
        <span>Halaman Dokumen</span>
    </div>
</div>

<div class="lpm-submenu" id="dokumen-menu">
    <a href="{{ route('admin.spmi_categories.index') }}" 
       class="lpm-submenu-item {{ request()->routeIs('admin.spmi_categories.*') ? 'active' : '' }}">
        <i class="fas fa-tags"></i>
        <span>Pengaturan Kategori</span>
    </a>

    <a href="{{ route('admin.spmi.index') }}" 
       class="lpm-submenu-item {{ request()->routeIs('admin.spmi.*') ? 'active' : '' }}">
        <i class="fas fa-file-alt"></i>
        <span>Kelola Dokumen</span>
    </a>

    
</div>

<a href="{{ route('admin.staff.index') }}" 
                   class="lpm-nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home"></i>
                    <span>Staff Settings</span>
                </a>

<!-- Menu & Pages -->
<div class="lpm-nav-item has-submenu" data-submenu="menu-pages-menu">
    <div style="display: flex; align-items: center; flex: 1; gap: 16px;">
        <i class="fas fa-layer-group"></i>
        <span>Menu & Halaman</span>
    </div>
</div>

<div class="lpm-submenu" id="menu-pages-menu">

    <a href="{{ route('admin.menus.index') }}" 
       class="lpm-submenu-item {{ request()->routeIs('admin.menus.*') ? 'active' : '' }}">
        <i class="fas fa-bars"></i>
        <span>Kelola Menu</span>
    </a>

    <a href="{{ route('admin.pages.index') }}" 
       class="lpm-submenu-item {{ request()->routeIs('admin.pages.*') ? 'active' : '' }}">
        <i class="fas fa-file-alt"></i>
        <span>Kelola Halaman</span>
    </a>

</div>
<a href="{{ route('admin.settings.edit') }}" 
   class="lpm-nav-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
    <i class="fas fa-cog"></i>
    <span>Pengaturan Situs</span>
</a>
                
                <!-- Logout Button -->
                <div class="lpm-nav-item logout" id="logoutTrigger" style="margin-top: 24px;">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </div>
            </div>
            
            <div class="lpm-sidebar-footer">
                <div style="margin-bottom: 8px;">
                    <strong>LPMI Admin v1.0</strong>
                </div>
                <div>© {{ date('Y') }} Lembaga Pers Mahasiswa Indonesia</div>
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
                    @php
                        $totalPending = 
                            ($pendingAgendaCount ?? 0) + 
                            ($pendingVideosCount ?? 0) + 
                            ($pendingBannerCount ?? 0) + 
                            ($pendingOrgCount ?? 0) + 
                            ($pendingSurveysCount ?? 0);
                    @endphp
                    @if($totalPending > 0)
                    <div class="lpm-stats-badge">
                        <i class="fas fa-bell"></i>
                        {{ $totalPending }} Pending
                    </div>
                    @endif
                    
                    <div class="lpm-user-details">
                        <div class="lpm-user-name">{{ Auth::user()->name ?? 'Admin User' }}</div>
                        <div class="lpm-user-role">Administrator</div>
                    </div>
                    <div class="lpm-user-avatar">
                        {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                    </div>
                </div>
            </div>

            <div class="lpm-content">
                <!-- Breadcrumb -->
                
                
                
                
                <!-- Alerts -->
                <div class="lpm-alerts-container">
                    @if(session('success'))
                    <div class="lpm-alert lpm-alert-success lpm-fade-in">
                        <i class="fas fa-check-circle lpm-alert-icon"></i>
                        <div>
                            <strong>Success!</strong> {{ session('success') }}
                        </div>
                    </div>
                    @endif
                    
                    @if(session('error'))
                    <div class="lpm-alert lpm-alert-error lpm-fade-in">
                        <i class="fas fa-exclamation-circle lpm-alert-icon"></i>
                        <div>
                            <strong>Error!</strong> {{ session('error') }}
                        </div>
                    </div>
                    @endif
                    
                    @if(session('warning'))
                    <div class="lpm-alert lpm-alert-warning lpm-fade-in">
                        <i class="fas fa-exclamation-triangle lpm-alert-icon"></i>
                        <div>
                            <strong>Warning!</strong> {{ session('warning') }}
                        </div>
                    </div>
                    @endif
                    
                    @if(session('info'))
                    <div class="lpm-alert lpm-alert-info lpm-fade-in">
                        <i class="fas fa-info-circle lpm-alert-icon"></i>
                        <div>
                            <strong>Info!</strong> {{ session('info') }}
                        </div>
                    </div>
                    @endif
                    
                    @if($errors->any())
                    <div class="lpm-alert lpm-alert-error lpm-fade-in">
                        <i class="fas fa-exclamation-circle lpm-alert-icon"></i>
                        <div>
                            <strong>Validation Errors:</strong>
                            <ul style="margin-top: 12px; padding-left: 20px; list-style-type: disc;">
                                @foreach($errors->all() as $error)
                                <li style="margin-bottom: 4px;">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif
                </div>
                
                <!-- Main Content -->
                <div class="lpm-fade-in">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <script>
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
            
            // Nested menu functionality - FIXED
            document.querySelectorAll('.lpm-nav-item.has-submenu').forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    const submenuId = this.getAttribute('data-submenu');
                    const submenu = document.getElementById(submenuId);
                    
                    // Toggle current submenu
                    this.classList.toggle('expanded');
                    submenu.classList.toggle('expanded');
                    
                    // Close other submenus
                    document.querySelectorAll('.lpm-nav-item.has-submenu').forEach(otherItem => {
                        if (otherItem !== this) {
                            const otherSubmenuId = otherItem.getAttribute('data-submenu');
                            const otherSubmenu = document.getElementById(otherSubmenuId);
                            otherItem.classList.remove('expanded');
                            if (otherSubmenu) otherSubmenu.classList.remove('expanded');
                        }
                    });
                });
            });
            
            // Close submenus when clicking outside
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.lpm-nav-item.has-submenu') && !e.target.closest('.lpm-submenu')) {
                    document.querySelectorAll('.lpm-nav-item.has-submenu').forEach(item => {
                        const submenuId = item.getAttribute('data-submenu');
                        const submenu = document.getElementById(submenuId);
                        item.classList.remove('expanded');
                        if (submenu) submenu.classList.remove('expanded');
                    });
                }
            });
            
            // Set active nav items based on current URL
            function setActiveMenu() {
                const currentPath = window.location.pathname;
                
                // Check regular nav items
                document.querySelectorAll('.lpm-nav-item[href]').forEach(item => {
                    const href = item.getAttribute('href');
                    if (href && (currentPath === href || currentPath.startsWith(href + '/'))) {
                        item.classList.add('active');
                    } else {
                        item.classList.remove('active');
                    }
                });
                
                // Check submenu items
                document.querySelectorAll('.lpm-submenu-item').forEach(item => {
                    const href = item.getAttribute('href');
                    if (href && (currentPath === href || currentPath.startsWith(href + '/'))) {
                        item.classList.add('active');
                        
                        // Expand parent submenu
                        const parentMenu = item.closest('.lpm-submenu');
                        if (parentMenu) {
                            const parentTrigger = document.querySelector(`[data-submenu="${parentMenu.id}"]`);
                            if (parentTrigger) {
                                parentTrigger.classList.add('expanded');
                                parentMenu.classList.add('expanded');
                            }
                        }
                    } else {
                        item.classList.remove('active');
                    }
                });
            }
            
            // Initial active state setup
            setActiveMenu();
            
            // Logout confirmation
            if (logoutTrigger && logoutModal && logoutCancelBtn) {
                logoutTrigger.addEventListener('click', function(e) {
                    e.preventDefault();
                    logoutModal.classList.add('active');
                    document.body.style.overflow = 'hidden';
                });
                
                logoutCancelBtn.addEventListener('click', function() {
                    logoutModal.classList.remove('active');
                    document.body.style.overflow = '';
                });
                
                logoutModal.addEventListener('click', function(e) {
                    if (e.target === logoutModal) {
                        logoutModal.classList.remove('active');
                        document.body.style.overflow = '';
                    }
                });
                
                // Handle logout form submission
                if (logoutForm) {
                    logoutForm.addEventListener('submit', function(e) {
                        const confirmBtn = logoutForm.querySelector('button[type="submit"]');
                        const originalText = confirmBtn.textContent;
                        
                        confirmBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Logging out...';
                        confirmBtn.disabled = true;
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
            function handleResize() {
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
                        sidebar.style.width = '280px';
                    } else {
                        sidebar.style.width = '280px';
                    }
                }
            }
            
            // Initial responsive setup
            handleResize();
            
            // Listen for resize events
            window.addEventListener('resize', handleResize);
            
            // Auto-hide alerts after 5 seconds
            setTimeout(function() {
                document.querySelectorAll('.lpm-alert').forEach(alert => {
                    alert.style.opacity = '0';
                    alert.style.transition = 'opacity 0.3s ease';
                    setTimeout(() => alert.remove(), 300);
                });
            }, 5000);
        });
    </script>
    
    @stack('scripts')
</body>
</html>
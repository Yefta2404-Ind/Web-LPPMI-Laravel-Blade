<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>@yield('title', 'LPPMI - Universitas Gunung Kidul')</title>
    <meta name="description" content="Lembaga Pengendalian dan Penjaminan Mutu Internal Universitas Gunung Kidul. Meningkatkan kualitas pendidikan melalui sistem penjaminan mutu berkelanjutan.">
    
    <!-- ========== EXTERNAL DEPENDENCIES ========== -->
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Google Fonts - Roboto Regular dan Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Roboto:wght@400;500;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Page-specific styles -->
    @yield('styles')
    
    <!-- ========== CUSTOM GLOBAL STYLES ========== -->
    <style>
        :root {
            --primary: #0a2a44; /* Biru solid gelap */
            --primary-light: #1e3a5f; /* Biru solid sedikit lebih terang */
            --primary-dark: #051a2b; /* Biru solid sangat gelap */
            --secondary: #f8f9fa;
            --accent: #eef2f6;
            --dark: #1e2a3a;
            --text-dark: #1a2634;
            --text-light: #55657b;
            --white: #ffffff;
            --gray-light: #f9fbfd;
            --border: #dee6f0;
            --shadow-sm: 0 4px 12px rgba(0,0,0,0.02);
            --shadow-md: 0 8px 24px rgba(0,20,50,0.06);
            --shadow-lg: 0 16px 40px rgba(0,20,50,0.08);
            --font-primary: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            --font-roboto: 'Roboto', 'Plus Jakarta Sans', sans-serif;
            --font-heading: 'Space Grotesk', 'Plus Jakarta Sans', sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: var(--font-primary);
            line-height: 1.6;
            color: var(--text-dark);
            background: var(--white);
            overflow-x: hidden;
            font-weight: 400;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: var(--font-heading);
            font-weight: 600;
            letter-spacing: -0.02em;
            color: var(--primary);
        }

        .site-container {
            width: 100%;
            max-width: 1440px;
            margin: 0 auto;
            padding: 0 24px;
        }

        /* ================= TOP BAR ================= */
        .top-bar {
            background: var(--primary-dark);
            color: var(--white);
            padding: 8px 0;
            font-size: 0.85rem;
            font-weight: 400;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            letter-spacing: 0.02em;
        }

        .top-bar-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
        }

        .top-bar-left {
            display: flex;
            align-items: center;
            gap: 28px;
            flex-wrap: wrap;
        }

        .top-bar-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--white);
            opacity: 0.9;
        }

        .top-bar-item i {
            color: var(--white);
            font-size: 0.9rem;
            opacity: 0.8;
        }

        .top-bar-item span,
        .top-bar-item a {
            color: var(--white);
            text-decoration: none;
            transition: opacity 0.2s;
        }

        .top-bar-item a:hover {
            opacity: 1;
            color: var(--white);
        }

        .top-bar-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .social-link {
            color: var(--white);
            font-size: 1rem;
            transition: opacity 0.2s;
            text-decoration: none;
            opacity: 0.9;
        }

        .social-link:hover {
            opacity: 1;
            color: var(--white);
        }

        .language-selector {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-left: 8px;
            padding-left: 16px;
            border-left: 1px solid rgba(255,255,255,0.2);
        }

        .language-selector a {
            color: var(--white);
            text-decoration: none;
            font-size: 0.8rem;
            font-weight: 500;
            padding: 4px 8px;
            border-radius: 4px;
            transition: all 0.2s;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            opacity: 0.8;
        }

        .language-selector a:hover,
        .language-selector a.active {
            opacity: 1;
            background: rgba(255,255,255,0.15);
            color: var(--white);
        }

        /* ================= HEADER ================= */
        .site-header {
            background: var(--primary);
            position: sticky;
            top: 0;
            z-index: 1000;
            width: 100%;
        }
        
        .header-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: 80px;
            padding: 10px 0;
            gap: 20px;
            width: 100%;
        }

        .logo-title-group {
            display: flex;
            align-items: center;
            gap: 16px;
            flex-shrink: 0;
            max-width: 70%;
        }

        .logo {
            width: 55px;
            height: 55px;
            flex-shrink: 0;
        }

        .logo svg {
            width: 100%;
            height: 100%;
            display: block;
        }

        .header-title {
            border-left: 1px solid rgba(255,255,255,0.2);
            padding-left: 16px;
        }

        .header-title h1 {
            color: var(--white);
            font-family: var(--font-roboto);
            font-weight: 400;
            font-size: 1rem;
            line-height: 1.3;
            margin: 0 0 3px 0;
            text-transform: uppercase;
            letter-spacing: 0.02em;
            white-space: nowrap;
        }

        .header-title span {
            color: var(--white);
            font-family: var(--font-roboto);
            font-weight: 400;
            font-size: 0.75rem;
            display: block;
            letter-spacing: 0.03em;
            opacity: 0.9;
            white-space: nowrap;
        }

        .menu-toggle {
            display: none;
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.2);
            color: var(--white);
            font-size: 1.3rem;
            cursor: pointer;
            padding: 8px;
            width: 42px;
            height: 42px;
            border-radius: 8px;
            transition: all 0.2s;
            flex-shrink: 0;
            align-items: center;
            justify-content: center;
        }

        .menu-toggle:hover {
            background: rgba(255,255,255,0.2);
            border-color: rgba(255,255,255,0.3);
        }

        /* ================= NAVIGATION ================= */
        .main-nav {
            flex: 1;
            display: flex;
            justify-content: flex-end;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
            gap: 2px;
            align-items: center;
        }

        .nav-link {
            color: var(--white);
            text-decoration: none;
            padding: 8px 14px;
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 500;
            font-size: 0.85rem;
            transition: background-color 0.2s, opacity 0.2s;
            border-radius: 6px;
            white-space: nowrap;
            letter-spacing: 0.02em;
            background: transparent;
            border: none;
            opacity: 0.9;
        }

        .nav-link:hover,
        .nav-link:active,
        .nav-link:focus,
        .nav-link.active {
            opacity: 1;
            color: var(--white) !important;
            background: rgba(255,255,255,0.1);
            outline: none;
        }

        /* Dropdown container */
        .dropdown {
            position: relative;
        }

        .dropdown-menu {
            position: absolute;
            top: calc(100% + 8px);
            left: 0;
            background: var(--primary-light);
            min-width: 220px;
            display: none;
            list-style: none;
            padding: 6px 0;
            box-shadow: var(--shadow-lg);
            border-radius: 10px;
            z-index: 1000;
            margin: 0;
            border: 1px solid rgba(255,255,255,0.1);
        }

        .dropdown-menu li a {
            display: block;
            padding: 10px 18px;
            color: var(--white);
            text-decoration: none;
            white-space: nowrap;
            transition: background-color 0.2s, opacity 0.2s;
            font-size: 0.85rem;
            font-weight: 400;
            background: transparent;
            border: none;
            opacity: 0.9;
        }

        .dropdown-menu li a:hover,
        .dropdown-menu li a:active,
        .dropdown-menu li a:focus {
            opacity: 1;
            color: var(--white) !important;
            background: rgba(255,255,255,0.15);
            outline: none;
        }

        @media (min-width: 1025px) {
            .dropdown:hover .dropdown-menu {
                display: block;
            }
        }

        /* ================= RESPONSIVE HEADER ================= */
        
        /* Large Desktop */
        @media (min-width: 1400px) {
            .header-title h1 { font-size: 1.1rem; }
            .header-title span { font-size: 0.8rem; }
            .nav-link { font-size: 0.9rem; padding: 10px 18px; }
        }

        /* Desktop */
        @media (max-width: 1199px) {
            .header-title h1 { font-size: 0.95rem; }
            .header-title span { font-size: 0.7rem; }
            .nav-link { font-size: 0.8rem; padding: 8px 12px; }
            
            .logo { width: 50px; height: 50px; }
        }

        /* Tablet Landscape */
        @media (max-width: 991px) {
            .top-bar-container { 
                flex-direction: column; 
                text-align: center; 
                gap: 8px;
            }
            .top-bar-left { 
                justify-content: center; 
                gap: 20px;
            }
            .top-bar-right { 
                justify-content: center; 
            }
            
            .header-container { 
                min-height: 70px; 
                padding: 8px 0; 
            }
            
            .logo-title-group { 
                gap: 12px; 
                max-width: 65%;
            }
            
            .logo { 
                width: 45px; 
                height: 45px; 
            }
            
            .header-title { 
                padding-left: 12px; 
            }
            
            .header-title h1 { 
                font-size: 0.9rem; 
                margin-bottom: 2px;
            }
            
            .header-title span { 
                font-size: 0.65rem; 
            }
            
            .nav-link { 
                padding: 6px 10px; 
                font-size: 0.75rem; 
            }
        }

        /* Tablet Portrait & Mobile */
        @media (max-width: 767px) {
            .site-container {
                padding: 0 16px;
            }
            
            .top-bar-left { 
                flex-direction: column; 
                gap: 6px; 
                width: 100%;
            }
            
            .top-bar-item { 
                font-size: 0.75rem;
                justify-content: center;
                width: 100%;
            }
            
            .top-bar-right {
                width: 100%;
                justify-content: center;
                flex-wrap: wrap;
            }
            
            /* Header Mobile */
            .header-container { 
                flex-wrap: wrap; 
                min-height: auto; 
                padding: 10px 0;
                gap: 10px;
                position: relative;
            }
            
            .logo-title-group { 
                flex: 1;
                min-width: 0;
                max-width: calc(100% - 55px);
                gap: 10px; 
            }
            
            .logo { 
                width: 42px; 
                height: 42px; 
                flex-shrink: 0;
            }
            
            .header-title { 
                padding-left: 10px; 
                min-width: 0;
                overflow: hidden;
            }
            
            .header-title h1 { 
                font-size: 0.85rem; 
                white-space: normal;
                line-height: 1.2;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
                text-overflow: ellipsis;
                word-break: break-word;
                margin-bottom: 2px;
            }
            
            .header-title span { 
                font-size: 0.6rem; 
                white-space: normal;
                line-height: 1.2;
                display: -webkit-box;
                -webkit-line-clamp: 1;
                -webkit-box-orient: vertical;
                overflow: hidden;
                text-overflow: ellipsis;
                word-break: break-word;
            }
            
            .menu-toggle { 
                display: flex; 
                align-items: center;
                justify-content: center;
                order: 1;
                flex-shrink: 0;
                width: 42px;
                height: 42px;
                padding: 0;
                font-size: 1.2rem;
            }
            
            /* Mobile Navigation Menu */
            .main-nav {
                position: fixed;
                top: 0;
                right: -100%;
                width: 85%;
                max-width: 300px;
                height: 100vh;
                background: var(--primary-light);
                transition: right 0.3s ease;
                z-index: 1001;
                box-shadow: -5px 0 25px rgba(0,0,0,0.2);
                display: block;
                overflow-y: auto;
            }
            
            .main-nav.active { 
                right: 0; 
            }
            
            .nav-menu {
                flex-direction: column;
                padding: 70px 0 20px;
                overflow-y: auto;
                height: auto;
                min-height: 100%;
                gap: 0;
                width: 100%;
                align-items: stretch;
            }
            
            .nav-link {
                padding: 14px 20px;
                border-bottom: 1px solid rgba(255,255,255,0.1);
                font-size: 0.9rem;
                white-space: normal;
                border-radius: 0;
                color: var(--white);
                opacity: 1;
                justify-content: space-between;
                width: 100%;
            }
            
            .nav-link i {
                font-size: 0.75rem;
                transition: transform 0.2s;
            }
            
            .dropdown.active .nav-link i {
                transform: rotate(180deg);
            }
            
            .dropdown-menu {
                position: static;
                display: none;
                width: 100%;
                background: rgba(0,0,0,0.2);
                box-shadow: none;
                border-radius: 0;
                margin: 0;
                padding: 0;
                border: none;
            }
            
            .dropdown.active .dropdown-menu { 
                display: block; 
            }
            
            .dropdown-menu li a {
                padding: 12px 30px;
                font-size: 0.85rem;
                color: var(--white);
                border-bottom: 1px solid rgba(255,255,255,0.05);
                opacity: 0.9;
                white-space: normal;
                word-break: break-word;
            }
            
            .menu-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0,0,0,0.5);
                z-index: 1000;
                opacity: 0;
                transition: opacity 0.3s ease;
                backdrop-filter: blur(3px);
            }
            
            .menu-overlay.active {
                display: block;
                opacity: 1;
            }
            
            body.menu-open {
                overflow: hidden;
            }
        }

        /* Small Mobile */
        @media (max-width: 480px) {
            .logo-title-group { 
                gap: 8px; 
            }
            
            .logo { 
                width: 38px; 
                height: 38px; 
            }
            
            .header-title { 
                padding-left: 8px; 
            }
            
            .header-title h1 { 
                font-size: 0.8rem; 
                -webkit-line-clamp: 2;
            }
            
            .header-title span { 
                font-size: 0.55rem; 
            }
            
            .menu-toggle { 
                width: 40px; 
                height: 40px; 
                font-size: 1.1rem;
            }
        }

        /* Very Small Mobile */
        @media (max-width: 360px) {
            .logo { 
                width: 35px; 
                height: 35px; 
            }
            
            .header-title h1 { 
                font-size: 0.75rem; 
            }
            
            .header-title span { 
                font-size: 0.5rem; 
            }
        }

        /* ================= HERO ================= */
        .hero-section {
            position: relative;
            overflow: hidden;
            color: var(--white);
            min-height: 60vh;
            display: flex;
            align-items: center;
            margin-bottom: 0;
        }

        .hero-slider {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
        }

        .hero-slide {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0;
            transition: opacity 1s ease;
        }

        .hero-slide.active {
            opacity: 1;
        }

        .hero-overlay {
            position: relative;
            z-index: 2;
            width: 100%;
            padding: 60px 24px;
            min-height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-content {
            max-width: 900px;
            margin: 0 auto;
            padding: 24px;
            width: 100%;
            text-align: center;
        }

        .hero-title {
            font-size: 2.8rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 0;
            text-shadow: 0 4px 12px rgba(0,0,0,0.2);
            color: var(--white);
            letter-spacing: -0.02em;
        }

        /* ================= AGENDA ================= */
        .agenda-section {
            background: var(--white);
            padding: 80px 0;
            border-bottom: 1px solid var(--border);
        }

        .agenda-slider-container {
            position: relative;
            display: flex;
            align-items: center;
            gap: 16px;
            margin: 32px 0;
        }

        .slider-arrow {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: var(--white);
            border: 1px solid var(--border);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            flex-shrink: 0;
            box-shadow: var(--shadow-sm);
            z-index: 2;
        }

        .slider-arrow:hover {
            background: var(--accent);
            border-color: var(--primary);
            color: var(--primary);
            transform: scale(1.05);
        }

        .slider-arrow:disabled {
            opacity: 0.4;
            cursor: not-allowed;
            pointer-events: none;
        }

        .agenda-horizontal-container {
            flex: 1;
            overflow: hidden;
            position: relative;
            border-radius: 20px;
        }

        .agenda-horizontal-wrapper {
            display: flex;
            gap: 24px;
            transition: transform 0.4s cubic-bezier(0.2, 0, 0, 1);
            will-change: transform;
        }

        .agenda-card-small {
            flex: 0 0 calc((100% - 48px) / 3);
            background: var(--white);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border);
            transition: all 0.25s;
            cursor: pointer;
            display: flex;
            height: 170px;
        }

        .agenda-card-small:hover {
            box-shadow: var(--shadow-md);
            border-color: var(--primary);
            transform: translateY(-4px);
        }

        .agenda-date-small {
            background: var(--primary);
            color: var(--white);
            padding: 16px 12px;
            min-width: 90px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .date-day-small {
            font-size: 2rem;
            font-weight: 700;
            line-height: 1;
            margin-bottom: 4px;
            font-family: var(--font-heading);
        }

        .date-month-small {
            font-size: 0.8rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            opacity: 0.9;
        }

        .date-year-small {
            font-size: 0.7rem;
            opacity: 0.7;
            margin-top: 2px;
        }

        .agenda-content-small {
            padding: 16px;
            flex: 1;
            display: flex;
            flex-direction: column;
            background: var(--white);
        }

        .agenda-title-small {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-dark);
            line-height: 1.4;
            margin-bottom: 12px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 44px;
        }

        .agenda-meta-small {
            margin-bottom: 8px;
        }

        .meta-item-small {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.8rem;
            color: var(--text-light);
            margin-bottom: 4px;
        }

        .meta-item-small i {
            color: var(--primary);
            font-size: 0.7rem;
            width: 14px;
        }

        .agenda-status-small {
            display: inline-flex;
            align-items: center;
            padding: 4px 12px;
            border-radius: 30px;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            align-self: flex-start;
            background: var(--accent);
            color: var(--text-light);
        }

        .status-upcoming { background: #e8f0fe; color: var(--primary); }
        .status-ongoing { background: #fff4e5; color: #b85e00; }
        .status-completed { background: #edf2f7; color: var(--text-light); }

        .slider-indicators {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-top: 24px;
        }

        .slider-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--border);
            cursor: pointer;
            transition: all 0.2s;
        }

        .slider-dot.active {
            background: var(--primary);
            width: 24px;
            border-radius: 12px;
        }

        .agenda-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }

        .agenda-title {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary);
            margin: 0;
        }

        .agenda-title i {
            font-size: 1.6rem;
            color: var(--primary);
            opacity: 0.8;
        }

        .view-all-btn {
            background: none;
            border: 1px solid var(--border);
            color: var(--primary);
            font-size: 0.9rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            padding: 10px 20px;
            border-radius: 40px;
            transition: all 0.2s;
        }

        .view-all-btn:hover {
            background: var(--accent);
            border-color: var(--primary);
        }

        /* ================= AGENDA MODAL ================= */
        .agenda-modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            backdrop-filter: blur(8px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1100;
            padding: 20px;
            opacity: 0;
            transition: opacity 0.25s;
        }

        .agenda-modal-overlay.active {
            display: flex;
            opacity: 1;
        }

        .agenda-modal-content {
            background: var(--white);
            border-radius: 32px;
            max-width: 560px;
            width: 100%;
            max-height: 80vh;
            overflow-y: auto;
            box-shadow: var(--shadow-lg);
            position: relative;
            transform: scale(0.98);
            transition: transform 0.25s;
        }

        .agenda-modal-overlay.active .agenda-modal-content {
            transform: scale(1);
        }

        .modal-close {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--accent);
            border: none;
            font-size: 1.5rem;
            color: var(--text-light);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
            z-index: 2;
        }

        .modal-close:hover {
            background: var(--primary);
            color: var(--white);
        }

        .modal-header {
            background: var(--primary);
            color: var(--white);
            padding: 32px 28px 28px;
            position: relative;
        }

        .modal-date-box {
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(10px);
            padding: 16px 20px;
            border-radius: 20px;
            display: inline-flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
        }

        .modal-day {
            font-size: 3rem;
            font-weight: 700;
            line-height: 1;
            font-family: var(--font-heading);
        }

        .modal-month-year {
            font-size: 0.9rem;
            opacity: 0.9;
            margin-top: 4px;
        }

        .modal-title {
            font-size: 1.6rem;
            font-weight: 600;
            line-height: 1.3;
            margin: 0;
            color: var(--white);
        }

        .modal-body {
            padding: 28px;
        }

        .modal-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 24px;
            padding: 16px;
            background: var(--accent);
            border-radius: 20px;
        }

        .modal-info-item {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--text-dark);
            font-size: 0.95rem;
        }

        .modal-info-item i {
            color: var(--primary);
            font-size: 1rem;
            width: 20px;
        }

        .modal-description {
            line-height: 1.7;
            color: var(--text-dark);
            font-size: 0.95rem;
        }

        .modal-description p {
            margin-bottom: 12px;
        }

        .modal-footer {
            padding: 20px 28px;
            background: var(--accent);
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: flex-end;
        }

        .modal-status {
            padding: 8px 20px;
            border-radius: 40px;
            font-size: 0.8rem;
            font-weight: 600;
            background: var(--white);
        }

        /* ================= SURVEY ================= */
        .survey-section {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            padding: 80px 0;
            margin: 0;
            overflow: hidden;
            color: var(--white);
        }

        .survey-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 24px;
        }

        .survey-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }

        .survey-left {
            color: var(--white);
        }

        .survey-title {
            font-size: 2.8rem;
            font-weight: 700;
            margin-bottom: 24px;
            line-height: 1.2;
            color: var(--white);
        }

        .survey-description {
            font-size: 1.2rem;
            line-height: 1.6;
            margin-bottom: 40px;
            opacity: 0.9;
            font-weight: 300;
        }

        .survey-btn {
            background: var(--white);
            color: var(--primary);
            padding: 16px 40px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            display: inline-block;
            transition: all 0.2s;
            border: none;
            cursor: pointer;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }

        .survey-btn:hover {
            background: var(--accent);
            color: var(--primary);
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(0,0,0,0.15);
        }

        .survey-right {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .survey-qr {
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            padding: 24px;
            border: 1px solid rgba(255,255,255,0.2);
            box-shadow: 0 16px 40px rgba(0,0,0,0.2);
        }

        .qr-box {
            background: var(--white);
            padding: 16px;
            border-radius: 16px;
            margin-bottom: 16px;
        }

        .qr-image {
            width: 200px;
            height: 200px;
            display: block;
            margin: 0 auto;
        }

        .qr-caption {
            color: var(--white);
            font-size: 1rem;
            text-align: center;
            font-weight: 400;
            opacity: 0.9;
        }

        /* ================= FOOTER ================= */
        .main-footer {
            background: var(--primary);
            color: var(--white);
            padding: 60px 0 30px;
            margin-top: 0;
            font-family: var(--font-primary);
        }

        .footer-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 24px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 48px;
            margin-bottom: 48px;
        }

        .footer-col h3 {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 24px;
            padding-bottom: 12px;
            position: relative;
            color: var(--white);
        }

        .footer-col h3::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 32px;
            height: 2px;
            background: rgba(255,255,255,0.3);
        }

        .footer-col p {
            margin-bottom: 12px;
            opacity: 0.9;
            line-height: 1.7;
            font-size: 0.95rem;
            color: var(--white);
        }

        .footer-link {
            display: block;
            color: var(--white);
            text-decoration: none;
            margin-bottom: 10px;
            transition: opacity 0.2s;
            font-size: 0.95rem;
            opacity: 0.9;
        }

        .footer-link:hover {
            opacity: 1;
            color: var(--white);
        }

        .copyright {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid rgba(255,255,255,0.2);
            font-size: 0.9rem;
            opacity: 0.8;
            color: var(--white);
        }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: var(--accent); }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 8px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body>
    <!-- TOP BAR -->
    <div class="top-bar">
        <div class="site-container">
            <div class="top-bar-container">
                <div class="top-bar-left">
                    <div class="top-bar-item">
                        <i class="fas fa-phone-alt"></i>
                        <span>{{ $settings->phone }}</span>
                    </div>
                    <div class="top-bar-item">
                        <i class="fas fa-envelope"></i>
                        <a href="mailto:{{ $settings->email }}">{{ $settings->email }}</a>
                    </div>
                    <div class="top-bar-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>{{ $settings->address }}</span>
                    </div>
                </div>
                <div class="top-bar-right">
                    <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
                    <div class="language-selector">
                        <a href="#" class="active">ID</a>
                        <a href="#">EN</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- HEADER -->
    <header class="site-header">
        <div class="site-container">
            <div class="header-container">
                <!-- Logo and Title Group -->
                <div class="logo-title-group">
                    <div class="logo">
                        <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="50" cy="50" r="45" fill="rgba(255,255,255,0.1)"/>
                            <image href="{{ asset('images/logo ugk.png') }}" x="15" y="15" width="70" height="70" preserveAspectRatio="xMidYMid meet"/>
                            <text x="50" y="95" text-anchor="middle" font-size="12" font-weight="400" fill="white" font-family="Roboto, sans-serif">LPPMI</text>
                        </svg>
                    </div>
                    
                    <div class="header-title">
                        <h1>{{ strtoupper($settings->site_name) }}</h1>
<span>{{ strtoupper($settings->site_subtitle) }}</span>
                    </div>
                </div>
                
                <!-- Mobile Menu Toggle -->
                <button class="menu-toggle" id="menuToggle" aria-label="Toggle navigation menu">
                    <i class="fas fa-bars"></i>
                </button>
                
                <!-- Navigation Menu -->
                <nav class="main-nav" id="mainNav">
                    <ul class="nav-menu" id="navMenu">
                        @foreach($menus as $menu)
                            @if($menu->children->count() > 0)
                                <li class="dropdown">
                                    <a href="#" class="nav-link dropdown-toggle">
                                        {{ strtoupper($menu->title) }} <i class="fas fa-chevron-down ms-1" style="font-size: 0.75rem;"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        @foreach($menu->children as $child)
                                            <li><a href="{{ menu_url($child) }}">{{ $child->title }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                <li><a href="{{ menu_url($menu) }}" class="nav-link">{{ strtoupper($menu->title) }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- Mobile Menu Overlay -->
    <div class="menu-overlay" id="menuOverlay"></div>

    @php use Illuminate\Support\Facades\Storage; @endphp
    
    @isset($heroBanners)
    <section class="hero-section" id="heroSection">
        <div class="hero-slider" id="heroSlider">
            @foreach ($heroBanners as $index => $banner)
                <div class="hero-slide {{ $index === 0 ? 'active' : '' }}" style="background: linear-gradient(135deg, rgba(10,42,68,0.3) 0%, rgba(5,26,43,0.4) 100%), url('{{ Storage::url($banner->image) }}'); background-size: cover; background-position: center;"></div>
            @endforeach
        </div>
        <div class="hero-overlay">
            <div class="hero-content">
                <h1 class="hero-title">LEMBAGA PENJAMINAN MUTU</h1>
            </div>
        </div>
    </section>
    @endisset

    <main class="main-container">
        @yield('content')
    </main>

    <!-- AGENDA -->
    @if(isset($agendas) && count($agendas) > 0)
    <section class="agenda-section">
        <div class="site-container">
            <div class="agenda-header">
                <h2 class="agenda-title"><i class="fas fa-calendar-alt"></i> Agenda Terbaru</h2>
                <button class="view-all-btn">Lihat Semua <i class="fas fa-arrow-right"></i></button>
            </div>

            <div class="agenda-slider-container">
                <button class="slider-arrow slider-arrow-left" id="agendaPrev" aria-label="Previous agenda"><i class="fas fa-chevron-left"></i></button>
                <div class="agenda-horizontal-container">
                    <div class="agenda-horizontal-wrapper" id="agendaWrapper">
                        @foreach($agendas as $agenda)
                        @php
                            $agendaDate = \Carbon\Carbon::parse($agenda->date);
                            $now = \Carbon\Carbon::now();
                            if ($agendaDate->isToday()) { $status = 'ongoing'; $statusText = 'Berlangsung'; }
                            elseif ($agendaDate->isPast()) { $status = 'completed'; $statusText = 'Selesai'; }
                            else { $status = 'upcoming'; $statusText = 'Akan Datang'; }
                        @endphp
                        
                        <div class="agenda-card-small" data-agenda-id="{{ $agenda->id }}">
                            <div class="agenda-date-small">
                                <span class="date-day-small">{{ $agendaDate->format('d') }}</span>
                                <span class="date-month-small">{{ $agendaDate->translatedFormat('M') }}</span>
                                <span class="date-year-small">{{ $agendaDate->format('Y') }}</span>
                            </div>
                            
                            <div class="agenda-content-small">
                                <h3 class="agenda-title-small">{{ $agenda->title }}</h3>
                                <div class="agenda-meta-small">
                                    <div class="meta-item-small"><i class="fas fa-clock"></i><span>{{ $agenda->time }}</span></div>
                                    <div class="meta-item-small"><i class="fas fa-map-marker-alt"></i><span>{{ Str::limit($agenda->location, 25) }}</span></div>
                                </div>
                                <span class="agenda-status-small status-{{ $status }}">{{ $statusText }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <button class="slider-arrow slider-arrow-right" id="agendaNext" aria-label="Next agenda"><i class="fas fa-chevron-right"></i></button>
            </div>
            <div class="slider-indicators" id="sliderIndicators"></div>
        </div>
    </section>
    @endif

    <!-- MODAL AGENDA -->
    <div class="agenda-modal-overlay" id="agendaModal">
        <div class="agenda-modal-content">
            <button class="modal-close" id="modalClose" aria-label="Close modal">&times;</button>
            <div class="modal-header">
                <div class="modal-date-box">
                    <span class="modal-day" id="modalDay"></span>
                    <span class="modal-month-year" id="modalMonthYear"></span>
                </div>
                <h3 class="modal-title" id="modalTitle"></h3>
            </div>
            <div class="modal-body">
                <div class="modal-info">
                    <div class="modal-info-item"><i class="fas fa-clock"></i><span id="modalTime"></span></div>
                    <div class="modal-info-item"><i class="fas fa-map-marker-alt"></i><span id="modalLocation"></span></div>
                </div>
                <div class="modal-description" id="modalDescription"></div>
            </div>
            <div class="modal-footer">
                <span class="modal-status" id="modalStatus"></span>
            </div>
        </div>
    </div>

    <!-- SURVEY -->
    @if(isset($activeSurvey) && $activeSurvey)
    <section class="survey-section">
        <div class="survey-container">
            <div class="survey-content">
                <div class="survey-left">
                    <h2 class="survey-title">SURVEY KEPUASAN LAYANAN</h2>
                    <p class="survey-description">Untuk meningkatkan kualitas layanan, kami mohon Bapak/Ibu/Sdr. mengisi Survey Kepuasan Layanan.</p>
                    <a href="#" class="survey-btn">Isi Survey <i class="fas fa-arrow-right ms-2"></i></a>
                </div>
                <div class="survey-right">
                    <div class="survey-qr">
                        <div class="qr-box">
                            @if($activeSurvey->qr_code)
                                <img src="{{ asset('storage/' . $activeSurvey->qr_code) }}" alt="QR Code Survey" class="qr-image">
                            @else
                                <div style="width: 200px; height: 200px; background: #f0f0f0; display: flex; align-items: center; justify-content: center; border-radius: 12px;"><i class="fas fa-qrcode" style="font-size: 3rem; color: var(--primary);"></i></div>
                            @endif
                        </div>
                        <p class="qr-caption">Scan untuk mengisi survey</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- FOOTER -->
    <footer class="main-footer">
        <div class="footer-container">
            <div class="footer-grid">
                <div class="footer-col">
                    <h3>{{ $settings->site_name }}</h3>
                    <p>{{ $settings->footer_description }}</p>
                </div>
                <div class="footer-col">
                    <h3>Kontak</h3>
                    <p><i class="fas fa-map-marker-alt me-2"></i> {{ $settings->footer_address }}</p>
<p><i class="fas fa-phone-alt me-2"></i> {{ $settings->footer_phone }}</p>
<p><i class="fas fa-envelope me-2"></i> {{ $settings->footer_email }}</p>
<p><i class="fas fa-globe me-2"></i> {{ $settings->footer_website }}</p>
                </div>
                <div class="footer-col">
                    <h3>Tautan Cepat</h3>
                    <a href="/" class="footer-link"><i class="fas fa-chevron-right me-2"></i>Beranda</a>
                    <a href="#" class="footer-link"><i class="fas fa-chevron-right me-2"></i>Dokumen Mutu</a>
                    <a href="#" class="footer-link"><i class="fas fa-chevron-right me-2"></i>Profil Lembaga</a>
                    <a href="#" class="footer-link"><i class="fas fa-chevron-right me-2"></i>Kontak</a>
                </div>
            </div>
            <div class="copyright">
                <small>© {{ date('Y') }} Lembaga Penjaminan Mutu - Universitas Gunung Kidul. All rights reserved.</small>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Hero Slider
            const slides = document.querySelectorAll('.hero-slide');
            if (slides.length > 1) {
                let current = 0;
                setInterval(() => {
                    slides[current].classList.remove('active');
                    current = (current + 1) % slides.length;
                    slides[current].classList.add('active');
                }, 5000);
            }

            // Mobile Navigation
            const menuToggle = document.getElementById('menuToggle');
            const mainNav = document.getElementById('mainNav');
            const menuOverlay = document.getElementById('menuOverlay');
            const body = document.body;
            const dropdowns = document.querySelectorAll('.dropdown');
            
            function toggleMobileMenu(force) {
                const isActive = mainNav.classList.contains('active');
                
                if (force !== undefined) {
                    if (force === isActive) return;
                }
                
                mainNav.classList.toggle('active');
                menuOverlay.classList.toggle('active');
                body.classList.toggle('menu-open');
                
                // Update toggle icon
                const icon = menuToggle.querySelector('i');
                if (icon) {
                    icon.className = isActive ? 'fas fa-bars' : 'fas fa-times';
                }
                
                menuToggle.setAttribute('aria-expanded', !isActive);
            }
            
            if (menuToggle) {
                menuToggle.addEventListener('click', (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    toggleMobileMenu();
                });
            }
            
            if (menuOverlay) {
                menuOverlay.addEventListener('click', () => {
                    toggleMobileMenu(false);
                });
            }
            
            // Dropdown mobile
            dropdowns.forEach(dropdown => {
                const toggle = dropdown.querySelector('.dropdown-toggle');
                if (toggle) {
                    toggle.addEventListener('click', function(e) {
                        if (window.innerWidth <= 767) {
                            e.preventDefault();
                            e.stopPropagation();
                            
                            // Close other dropdowns
                            dropdowns.forEach(d => {
                                if (d !== dropdown && d.classList.contains('active')) {
                                    d.classList.remove('active');
                                }
                            });
                            
                            dropdown.classList.toggle('active');
                        }
                    });
                }
            });
            
            // Close menu when clicking a link (except dropdown toggles)
            document.querySelectorAll('.nav-menu a:not(.dropdown-toggle)').forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth <= 767 && mainNav.classList.contains('active')) {
                        setTimeout(() => {
                            toggleMobileMenu(false);
                        }, 300);
                    }
                });
            });
            
            // Close dropdowns when clicking outside
            document.addEventListener('click', function(e) {
                if (window.innerWidth <= 767 && !e.target.closest('.dropdown')) {
                    dropdowns.forEach(dropdown => {
                        dropdown.classList.remove('active');
                    });
                }
            });

            // Agenda Modal
            const agendaModal = document.getElementById('agendaModal');
            const modalClose = document.getElementById('modalClose');
            const agendaCards = document.querySelectorAll('.agenda-card-small');
            const agendaData = @json($agendas ?? []);

            function formatModalDate(dateString) {
                const date = new Date(dateString);
                return {
                    day: date.getDate(),
                    month: date.toLocaleDateString('id-ID', { month: 'long' }),
                    year: date.getFullYear()
                };
            }

            agendaCards.forEach(card => {
                card.addEventListener('click', function() {
                    const agendaId = this.getAttribute('data-agenda-id');
                    const agenda = agendaData.find(a => a.id == agendaId);
                    if (agenda) {
                        const date = formatModalDate(agenda.date);
                        const agendaDate = new Date(agenda.date);
                        const now = new Date();
                        let statusText = 'Selesai', statusClass = 'status-completed';
                        if (agendaDate.toDateString() === now.toDateString()) {
                            statusText = 'Berlangsung';
                            statusClass = 'status-ongoing';
                        } else if (agendaDate > now) {
                            statusText = 'Akan Datang';
                            statusClass = 'status-upcoming';
                        }

                        document.getElementById('modalDay').textContent = date.day;
                        document.getElementById('modalMonthYear').textContent = `${date.month} ${date.year}`;
                        document.getElementById('modalTitle').textContent = agenda.title;
                        document.getElementById('modalTime').textContent = agenda.time;
                        document.getElementById('modalLocation').textContent = agenda.location;
                        document.getElementById('modalDescription').innerHTML = agenda.description?.replace(/\n/g, '<br>') || '<p style="color: var(--text-light); font-style: italic;">Tidak ada deskripsi tersedia.</p>';
                        
                        const modalStatus = document.getElementById('modalStatus');
                        modalStatus.textContent = statusText;
                        modalStatus.className = `modal-status ${statusClass}`;

                        agendaModal.classList.add('active');
                        body.style.overflow = 'hidden';
                    }
                });
            });

            if (modalClose) {
                modalClose.addEventListener('click', closeModal);
            }
            
            agendaModal.addEventListener('click', function(e) {
                if (e.target === agendaModal) closeModal();
            });
            
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && agendaModal.classList.contains('active')) closeModal();
            });

            function closeModal() {
                agendaModal.classList.remove('active');
                body.style.overflow = '';
            }

            // View all button
            const viewAllBtn = document.querySelector('.view-all-btn');
            if (viewAllBtn) {
                viewAllBtn.addEventListener('click', function() {
                    window.location.href = '/agenda';
                });
            }

            // Horizontal Slider
            const wrapper = document.querySelector(".agenda-horizontal-wrapper");
            const cards = document.querySelectorAll(".agenda-card-small");
            const prev = document.getElementById("agendaPrev");
            const next = document.getElementById("agendaNext");
            let index = 0;

            function getVisibleCount() {
                if (window.innerWidth <= 767) return 1;
                if (window.innerWidth <= 991) return 2;
                return 3;
            }

            function updateSlide() {
                const visible = getVisibleCount();
                if (cards.length && visible) {
                    const cardWidth = cards[0].offsetWidth + 24; // including gap
                    const maxIndex = Math.max(0, cards.length - visible);
                    if (index > maxIndex) index = maxIndex;
                    wrapper.style.transform = `translateX(-${index * cardWidth}px)`;
                }
            }

            function nextSlide() {
                const visible = getVisibleCount();
                const maxIndex = cards.length - visible;
                index = index < maxIndex ? index + 1 : 0;
                updateSlide();
            }

            function prevSlide() {
                const visible = getVisibleCount();
                const maxIndex = cards.length - visible;
                index = index > 0 ? index - 1 : maxIndex;
                updateSlide();
            }

            if (next && prev && cards.length) {
                next.addEventListener("click", nextSlide);
                prev.addEventListener("click", prevSlide);
                
                // Auto slide every 5 seconds
                let autoSlide = setInterval(nextSlide, 5000);
                
                // Pause auto slide on hover
                const sliderContainer = document.querySelector('.agenda-slider-container');
                if (sliderContainer) {
                    sliderContainer.addEventListener('mouseenter', () => {
                        clearInterval(autoSlide);
                    });
                    sliderContainer.addEventListener('mouseleave', () => {
                        autoSlide = setInterval(nextSlide, 5000);
                    });
                }
                
                window.addEventListener("resize", () => {
                    updateSlide();
                });
                
                // Initial update
                updateSlide();
            }

            // Indicators
            const indicators = document.getElementById('sliderIndicators');
            if (indicators && cards.length) {
                function updateIndicators() {
                    const visible = getVisibleCount();
                    const totalDots = Math.ceil(cards.length / visible);
                    let dots = '';
                    const currentPage = Math.floor(index / visible);
                    
                    for (let i = 0; i < totalDots; i++) {
                        dots += `<span class="slider-dot ${i === currentPage ? 'active' : ''}" data-page="${i}"></span>`;
                    }
                    indicators.innerHTML = dots;
                    
                    // Add click handlers to dots
                    document.querySelectorAll('.slider-dot').forEach(dot => {
                        dot.addEventListener('click', function() {
                            const page = parseInt(this.getAttribute('data-page'));
                            const visible = getVisibleCount();
                            index = page * visible;
                            updateSlide();
                        });
                    });
                }
                
                updateIndicators();
                
                // Update indicators on slide change
                const originalUpdateSlide = updateSlide;
                updateSlide = function() {
                    originalUpdateSlide();
                    updateIndicators();
                };
                
                window.addEventListener('resize', updateIndicators);
            }

            // Window resize cleanup
            window.addEventListener('resize', function() {
                if (window.innerWidth > 767) {
                    // Close mobile menu if open
                    if (mainNav.classList.contains('active')) {
                        mainNav.classList.remove('active');
                        menuOverlay.classList.remove('active');
                        body.classList.remove('menu-open');
                        const icon = menuToggle?.querySelector('i');
                        if (icon) icon.className = 'fas fa-bars';
                    }
                    
                    // Close all dropdowns
                    dropdowns.forEach(d => d.classList.remove('active'));
                }
            });
        });
    </script>
</body>
</html>
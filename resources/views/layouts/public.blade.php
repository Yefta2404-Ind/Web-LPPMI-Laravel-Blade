<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>@yield('title', 'LPPMI - Universitas Gunung Kidul')</title>
    <meta name="description" content="Lembaga Pengendalian dan Penjaminan Mutu Internal Universitas Gunung Kidul. Meningkatkan kualitas pendidikan melalui sistem penjaminan mutu berkelanjutan.">
    <link rel="icon" type="image/png" href="{{ asset('images/logo-v2.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Roboto+Slab:wght@400;500;600;700&display=swap" rel="stylesheet">

    @yield('styles')

    <style>
        /* ================= ROOT & RESET ================= */
        :root {
            --primary:        #0a2a44;
            --primary-light:  #1e3a5f;
            --primary-dark:   #051a2b;
            --primary-mid:    #123456;
            --gold:           #c9a84c;
            --gold-light:     #e8c97a;
            --gold-dark:      #a07830;
            --secondary:      #f8f9fa;
            --accent:         #eef2f6;
            --accent2:        #e3ecf5;
            --text-dark:      #1a2634;
            --text-mid:       #3a4f65;
            --text-light:     #55657b;
            --white:          #ffffff;
            --border:         #d8e4f0;
            --shadow-sm:  0 2px 8px rgba(0,20,50,0.06);
            --shadow-md:  0 8px 28px rgba(0,20,50,0.10);
            --shadow-lg:  0 20px 50px rgba(0,20,50,0.13);
            --shadow-xl:  0 32px 70px rgba(0,20,50,0.16);
            --font-primary: 'Roboto', sans-serif;
            --font-roboto:  'Roboto', sans-serif;
            --font-heading: 'Roboto Slab', serif;
            --container-max: 1400px;
            --container-pad: 40px;
            --radius-sm:  8px;
            --radius-md:  14px;
            --radius-lg:  22px;
            --radius-xl:  32px;
            --transition: 0.25s cubic-bezier(0.4,0,0.2,1);
        }

        /* ===== Z-INDEX SYSTEM ===== */
        body {
            position: relative;
            z-index: 1;
        }

        .site-header {
            z-index: 9500;
        }

        .main-nav {
            z-index: 10000;
        }

        .main-nav a:visited {
    color: rgba(255, 255, 255, 0.88) !important;
}
        .menu-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(5, 26, 43, 0.7);
    z-index: 8999; /* turunkan, biar di bawah header */
    transition: opacity 0.3s ease;
}

        .menu-overlay.active {
            display: block;
        }

        .agenda-modal-overlay {
            z-index: 20000;
        }

        #popup-overlay {
            z-index: 999999 !important;
        }

        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }

        body {
            font-family: var(--font-primary);
            line-height: 1.65;
            color: var(--text-dark);
            background: var(--white);
            overflow-x: hidden;
            font-weight: 400;
            -webkit-font-smoothing: antialiased;
        }

        body.menu-open {
            overflow: hidden;
        }

        h1,h2,h3,h4,h5,h6 {
            font-family: var(--font-heading);
            font-weight: 700;
            letter-spacing: -0.02em;
            color: var(--primary);
            line-height: 1.2;
        }

        /* ================= CONTAINERS ================= */
        .site-container,
        .survey-container,
        .footer-container,
        .lpm-container {
            width: 100%;
            max-width: var(--container-max);
            margin: 0 auto;
            padding: 0 var(--container-pad);
        }

        /* ================= TOP BAR ================= */
        .top-bar {
            background: var(--primary-dark);
            color: rgba(255,255,255,0.85);
            padding: 8px 0;
            font-size: 0.8rem;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            letter-spacing: 0.015em;
        }

        .top-bar-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 6px;
        }

        .top-bar-left {
            display: flex;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .top-bar-item {
            display: flex;
            align-items: center;
            gap: 6px;
            color: rgba(255,255,255,0.8);
            font-size: 0.78rem;
        }

        .top-bar-item i { color: var(--gold-light); font-size: 0.7rem; flex-shrink: 0; }

        .top-bar-item span,
        .top-bar-item a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: color var(--transition);
        }

        .top-bar-item a:hover { color: var(--gold-light); }

        .top-bar-right {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .social-link {
            color: rgba(255,255,255,0.7);
            font-size: 0.82rem;
            width: 26px; height: 26px;
            display: flex; align-items: center; justify-content: center;
            border-radius: 6px;
            text-decoration: none;
            transition: all var(--transition);
        }

        .social-link:hover { color: var(--white); background: rgba(255,255,255,0.12); }

        /* ================= HEADER ================= */
        .site-header {
            background: var(--primary);
            position: sticky;
            top: 0;
            width: 100%;
            box-shadow: 0 2px 20px rgba(0,0,0,0.25);
            overflow: visible;
        }

        .site-header::before {
            content: '';
            display: block;
            height: 3px;
            background: linear-gradient(90deg, var(--gold-dark), var(--gold-light), var(--gold-dark));
        }

        .header-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: 72px;
            padding: 10px 0;
            gap: 16px;
            width: 100%;
            overflow: visible;
        }

        .logo-title-group {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
            min-width: 0;
        }

        .logo {
            width: 50px; height: 50px;
            flex-shrink: 0;
            filter: drop-shadow(0 2px 6px rgba(0,0,0,0.3));
        }
        .logo svg, .logo img { width: 100%; height: 100%; display: block; }

        .header-title {
            border-left: 1px solid rgba(255,255,255,0.18);
            padding-left: 12px;
            min-width: 0;
        }

        .header-title h1 {
            color: var(--white);
            font-family: var(--font-roboto);
            font-weight: 800;
            font-size: 1.1rem;
            line-height: 1.2;
            margin: 0 0 2px 0;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .header-title span {
            color: rgba(255,255,255,0.7);
            font-family: var(--font-roboto);
            font-weight: 500;
            font-size: 0.75rem;
            display: block;
            letter-spacing: 0.03em;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .menu-toggle {
            display: none;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.2);
            color: var(--white);
            font-size: 1.1rem;
            cursor: pointer;
            width: 40px; height: 40px;
            border-radius: var(--radius-sm);
            transition: background var(--transition);
            flex-shrink: 0;
            align-items: center;
            justify-content: center;
        }

        .menu-toggle:hover { background: rgba(255,255,255,0.18); }

        /* ================= NAVIGATION ================= */
        .main-nav {
            display: flex;
            justify-content: flex-end;
            align-items: stretch;
            overflow: visible;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
            gap: 2px;
            align-items: stretch;
            overflow: visible;
        }

        .nav-menu > li {
            position: relative;
            display: block;
            align-items: stretch;
            justify-content: flex-end;
            overflow: visible;
        }

        .nav-link {
            color: rgba(255,255,255,0.88);
            text-decoration: none;
            padding: 0 clamp(10px, 1.5vw, 18px);
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 700;
            font-size: clamp(0.7rem, 1vw, 0.9rem);
            height: clamp(45px, 6vw, 60px);
            transition: all 0.2s ease;
            white-space: nowrap;
            letter-spacing: 0.03em;
            background: transparent;
            border: none;
            border-bottom: 3px solid transparent;
            cursor: pointer;
            border-radius: 0;
        }

        .nav-link:hover {
            color: var(--gold-light) !important;
            background: transparent !important;
            border-bottom-color: var(--gold) !important;
        }

        .nav-link.active {
            color: var(--gold-light) !important;
            border-bottom-color: var(--gold) !important;
        }

        .nav-link i {
            font-size: 0.65rem;
            transition: transform 0.25s ease;
            margin-left: 4px;
            opacity: 0.7;
        }

        .nav-link:hover i { opacity: 1; color: var(--gold-light); }

        .nav-dropdown {
            position: relative;
            display: block;
            align-items: stretch;
            overflow: visible;
        }

        .nav-submenu {
            position: absolute;
            top: 100%;
            left: 0;
            background: var(--primary-dark);
            min-width: 220px;
            max-width: calc(100vw - 16px);
            list-style: none;
            padding: 8px 0;
            margin: 0;
            border-radius: 0 0 8px 8px;
            border-top: 3px solid var(--gold);
            box-shadow: var(--shadow-lg);
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.2s ease, visibility 0.2s ease;
            pointer-events: none;
            z-index: 10000;
            margin-top: -2px;
        }

        .nav-submenu.flip-left { left: auto; right: 0; }

        .nav-dropdown:hover > .nav-submenu {
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
        }

        .nav-submenu li {
            border-bottom: 1px solid rgba(255,255,255,0.08);
            position: relative;
            overflow: visible;
        }

        .nav-submenu li:last-child { border-bottom: none; }

        .nav-submenu li a {
            display: block;
            padding: 12px 20px;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all var(--transition);
            border-left: 3px solid transparent;
            white-space: nowrap;
        }

        .nav-submenu li a:hover {
            color: var(--gold-light);
            background: rgba(201,168,76,0.1);
            padding-left: 26px;
            border-left-color: var(--gold);
        }

        .has-child > a {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .has-child > a::after {
            content: '\f054';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            font-size: 0.7rem;
            margin-left: 12px;
            opacity: 0.6;
            transition: transform var(--transition);
        }

        .has-child:hover > a::after {
            transform: translateX(3px);
            opacity: 1;
            color: var(--gold-light);
        }

        .child-menu {
            position: absolute;
            top: 0;
            left: 100%;
            background: var(--primary-dark);
            min-width: 220px;
            max-width: calc(100vw - 16px);
            list-style: none;
            padding: 8px 0;
            margin: 0;
            margin-left: -2px;
            border-radius: 8px;
            border-left: 3px solid var(--gold);
            box-shadow: var(--shadow-lg);
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.2s ease, visibility 0.2s ease, transform 0.2s ease;
            pointer-events: none;
            z-index: 10100;
            transform: translateY(10px);
        }

        .child-menu.flip-left {
            left: auto;
            right: 100%;
            margin-left: 0;
            margin-right: -2px;
            border-left: none;
            border-right: 3px solid var(--gold);
        }

        .has-child:hover > .child-menu {
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
            transform: translateY(0);
        }

        .child-menu li { border-bottom: 1px solid rgba(255,255,255,0.08); }
        .child-menu li:last-child { border-bottom: none; }

        .child-menu li a {
            display: block;
            padding: 10px 20px;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            font-size: 0.8rem;
            white-space: nowrap;
            transition: all var(--transition);
        }

        .child-menu li a:hover {
            color: var(--gold-light);
            background: rgba(201,168,76,0.1);
            padding-left: 26px;
        }

        @media (min-width: 769px) and (max-width: 991px) {
            .nav-submenu { left: auto; right: 0; min-width: 200px; }
            .child-menu {
                left: auto; right: 100%;
                margin-left: 0; margin-right: -2px;
                border-left: none; border-right: 3px solid var(--gold);
            }
        }

        /* ================= HERO SECTION ================= */
        .hero-section {
            position: relative;
            overflow: hidden;
            color: var(--white);
            min-height: 82vh;
            display: flex;
            align-items: center;
        }

        .hero-slider { position: absolute; inset: 0; width: 100%; height: 100%; }

        .hero-slide {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0;
            transition: opacity 1.2s ease;
        }

        .hero-slide.active { opacity: 1; }

        .hero-section::after {
            content: '';
            position: absolute;
            inset: 0;
            background:
                linear-gradient(135deg, rgba(5,26,43,0.78) 0%, rgba(10,42,68,0.52) 60%, transparent 100%),
                linear-gradient(to top, rgba(5,26,43,0.65) 0%, transparent 55%);
            z-index: 1;
            pointer-events: none;
        }

        .hero-overlay {
            position: relative;
            z-index: 2;
            width: 100%;
            padding: 120px 0 100px;
            display: flex;
            align-items: center;
        }

        .hero-content { max-width: 780px; }

        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: rgba(201,168,76,0.18);
            border: 1px solid rgba(201,168,76,0.4);
            color: var(--gold-light);
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 6px 14px;
            border-radius: 100px;
            margin-bottom: 24px;
        }

        .hero-eyebrow::before {
            content: '';
            width: 6px; height: 6px;
            border-radius: 50%;
            background: var(--gold-light);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%,100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(0.8); }
        }

        .hero-title {
            font-size: 3.8rem;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 20px;
            color: var(--white);
            letter-spacing: -0.03em;
        }

        .hero-title span {
            background: linear-gradient(135deg, var(--gold-light), var(--gold));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* ================= SECTION SHARED ================= */
        .section-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--gold-dark);
            margin-bottom: 10px;
        }

        .section-label::before {
            content: '';
            width: 24px; height: 2px;
            background: var(--gold);
            border-radius: 2px;
        }

        /* ================= AGENDA ================= */
        .agenda-section {
            background: var(--white);
            padding: 96px 0;
            border-bottom: 1px solid var(--border);
            position: relative;
            overflow: hidden;
        }

        .agenda-section::before {
            content: '';
            position: absolute;
            top: -100px; right: -100px;
            width: 450px; height: 450px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(10,42,68,0.04) 0%, transparent 70%);
            pointer-events: none;
        }

        .agenda-header {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 52px;
            gap: 20px;
            flex-wrap: wrap;
        }

        .agenda-header-left { text-align: center; }

        .agenda-title {
            font-size: 2.4rem;
            font-weight: 700;
            color: var(--primary);
            margin: 0;
            letter-spacing: -0.02em;
        }

        .agenda-subtitle {
            font-size: 0.95rem;
            color: var(--text-light);
            margin-top: 6px;
        }

        .agenda-horizontal-wrapper {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 28px;
        }

        .agenda-card-small {
            border-radius: var(--radius-lg);
            overflow: hidden;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            height: 340px;
            position: relative;
            background: linear-gradient(160deg, var(--primary) 0%, var(--primary-light) 100%);
            box-shadow: var(--shadow-md);
            transition: transform 0.35s cubic-bezier(0.34,1.56,0.64,1), box-shadow 0.35s ease;
        }

        .agenda-card-small:hover {
            transform: translateY(-8px) scale(1.01);
            box-shadow: var(--shadow-xl);
        }

        .agenda-card-bg {
            position: absolute;
            inset: 0;
            width: 100%; height: 100%;
            object-fit: cover;
            display: block;
            z-index: 0;
            transition: transform 0.5s ease;
        }

        .agenda-card-small:hover .agenda-card-bg { transform: scale(1.06); }

        .agenda-card-small::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, rgba(5,26,43,0.15) 0%, rgba(5,26,43,0.35) 40%, rgba(5,26,43,0.88) 100%);
            z-index: 1;
        }

        .agenda-card-small::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--gold-dark), var(--gold-light), var(--gold-dark));
            z-index: 3;
            transform: scaleX(0);
            transition: transform var(--transition);
        }

        .agenda-card-small:hover::after { transform: scaleX(1); }

        .agenda-date-small {
            position: absolute;
            top: 18px; left: 18px;
            z-index: 2;
            background: rgba(255,255,255,0.13);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,0.2);
            padding: 10px 14px;
            border-radius: var(--radius-md);
            display: flex;
            flex-direction: column;
            align-items: center;
            min-width: 52px;
        }

        .date-day-small {
            font-size: 1.6rem;
            font-weight: 700;
            line-height: 1;
            color: var(--white);
            font-family: var(--font-heading);
        }

        .date-month-small {
            font-size: 0.6rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--gold-light);
            margin-top: 3px;
        }

        .agenda-content-small {
            position: relative;
            z-index: 2;
            padding: 20px 22px 24px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .agenda-title-small {
            font-size: 1rem;
            font-weight: 700;
            color: var(--white);
            line-height: 1.35;
            margin: 0;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .agenda-meta-small { display: flex; gap: 14px; flex-wrap: wrap; }

        .meta-item-small {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 0.73rem;
            color: rgba(255,255,255,0.72);
        }

        .meta-item-small i { color: var(--gold-light); font-size: 0.65rem; }

        .agenda-empty {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 64px 24px;
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent2) 100%);
            border-radius: var(--radius-xl);
            border: 2px dashed var(--border);
            text-align: center;
            position: relative;
            overflow: hidden;
            animation: fadeInUp 0.5s ease both;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .agenda-empty::before {
            content: '';
            position: absolute;
            top: -60px; right: -60px;
            width: 200px; height: 200px;
            border-radius: 50%;
            background: rgba(10,42,68,0.04);
            pointer-events: none;
        }

        .agenda-empty::after {
            content: '';
            position: absolute;
            bottom: -40px; left: -40px;
            width: 150px; height: 150px;
            border-radius: 50%;
            background: rgba(201,168,76,0.06);
            pointer-events: none;
        }

        .agenda-empty-icon {
            width: 80px; height: 80px;
            background: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
            box-shadow: var(--shadow-md);
            position: relative;
            z-index: 1;
        }

        .agenda-empty-icon i {
            font-size: 2rem;
            color: var(--primary);
            opacity: 0.35;
        }

        .agenda-empty-title {
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 10px;
            position: relative;
            z-index: 1;
        }

        .agenda-empty-desc {
            font-size: 0.9rem;
            color: var(--text-light);
            line-height: 1.65;
            max-width: 380px;
            margin: 0 auto 24px;
            position: relative;
            z-index: 1;
        }

        .agenda-empty-badge {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: rgba(201,168,76,0.12);
            border: 1px solid rgba(201,168,76,0.3);
            color: var(--gold-dark);
            font-size: 0.75rem;
            font-weight: 600;
            padding: 6px 16px;
            border-radius: 100px;
            letter-spacing: 0.03em;
            position: relative;
            z-index: 1;
        }

        .agenda-empty-badge i { font-size: 0.7rem; }

        .view-all-btn,
        .view-all {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 44px;
            background: var(--primary);
            border: none;
            color: var(--white);
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            padding: 13px 30px;
            border-radius: 100px;
            transition: all var(--transition);
            letter-spacing: 0.03em;
            text-decoration: none;
        }

        .view-all-btn:hover,
        .view-all:hover {
            background: var(--primary-light);
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            text-decoration: none;
        }

        .agenda-footer { display: flex; justify-content: center; }

        .agenda-modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(5,26,43,0.62);
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
            display: none;
            align-items: center;
            justify-content: center;
            pointer-events: none;
            padding: 16px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .agenda-modal-overlay.active { display: flex; opacity: 1; pointer-events: auto; }

        .agenda-modal-content {
            background: var(--white);
            border-radius: 20px;
            max-width: 600px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: var(--shadow-xl);
            position: relative;
        }

        .modal-close {
            position: absolute;
            top: 14px; right: 14px;
            width: 36px; height: 36px;
            border-radius: 50%;
            background: rgba(0,0,0,0.3);
            border: 1px solid rgba(255,255,255,0.3);
            font-size: 1.3rem;
            color: var(--white);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
            transition: all 0.2s ease;
        }

        .modal-close:hover { background: rgba(0,0,0,0.5); transform: scale(1.1); }

        .modal-image-wrap {
            width: 100%;
            height: 220px;
            overflow: hidden;
            border-radius: 20px 20px 0 0;
            position: relative;
        }

        .modal-image-wrap img { width: 100%; height: 100%; object-fit: cover; display: block; }

        .modal-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: var(--white);
            padding: 36px 32px 30px;
            position: relative;
            border-radius: 20px 20px 0 0;
            overflow: hidden;
        }

        .modal-image-wrap + .modal-header { border-radius: 0; }

        .modal-header::before {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--gold-dark), var(--gold-light), var(--gold-dark));
        }

        .modal-date-box {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.2);
            padding: 12px 18px;
            border-radius: var(--radius-md);
            margin-bottom: 18px;
            position: relative; z-index: 1;
        }

        .modal-day { font-size: 2rem; font-weight: 700; line-height: 1; font-family: var(--font-heading); color: var(--white); }
        .modal-month-year { font-size: 0.85rem; opacity: 0.85; line-height: 1.4; color: var(--gold-light); }
        .modal-title { font-size: 1.2rem; font-weight: 700; line-height: 1.3; margin: 0; color: var(--white); position: relative; z-index: 1; }

        .modal-body { padding: 28px 32px; }

        .modal-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-bottom: 24px;
            padding: 14px;
            background: var(--accent);
            border-radius: var(--radius-md);
            border: 1px solid var(--border);
        }

        .modal-info-item { display: flex; align-items: center; gap: 10px; color: var(--text-dark); font-size: 0.9rem; }
        .modal-info-item i { color: var(--primary); font-size: 0.85rem; width: 18px; flex-shrink: 0; }

        .modal-description { line-height: 1.75; color: var(--text-mid); font-size: 0.92rem; }
        .modal-description p { margin-bottom: 12px; }

        .modal-footer {
            padding: 18px 32px;
            background: var(--accent);
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: flex-end;
            border-radius: 0 0 20px 20px;
        }

        .modal-status { padding: 6px 18px; border-radius: 100px; font-size: 0.75rem; font-weight: 600; letter-spacing: 0.04em; }
        .status-upcoming  { background: rgba(201,168,76,0.15); color: var(--gold-dark); border: 1px solid rgba(201,168,76,0.3); }
        .status-ongoing   { background: rgba(34,197,94,0.12); color: #16a34a; border: 1px solid rgba(34,197,94,0.25); }
        .status-completed { background: var(--accent); color: var(--text-light); border: 1px solid var(--border); }

        .survey-section {
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('/images/qr.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            padding: 96px 0;
            color: white;
        }

        .survey-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px;
            align-items: center;
            position: relative;
            z-index: 1;
        }

        .survey-left { color: var(--white); }

        .survey-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--gold-light);
            margin-bottom: 16px;
        }

        .survey-label::before {
            content: '';
            width: 20px; height: 2px;
            background: var(--gold-light);
            border-radius: 2px;
        }

        .survey-title { font-size: 2.6rem; font-weight: 700; margin-bottom: 18px; line-height: 1.15; color: var(--white); letter-spacing: -0.02em; }
        .survey-description { font-size: 1.05rem; line-height: 1.7; margin-bottom: 36px; color: rgba(255,255,255,0.72); }

        .survey-right { display: flex; justify-content: center; align-items: center; }

        .survey-qr {
            background: rgba(255,255,255,0.07);
            border-radius: var(--radius-xl);
            padding: 28px;
            border: 1px solid rgba(255,255,255,0.12);
            box-shadow: 0 20px 50px rgba(0,0,0,0.3);
            text-align: center;
        }

        .qr-box { background: var(--white); padding: 18px; border-radius: var(--radius-lg); margin-bottom: 16px; box-shadow: var(--shadow-md); }
        .qr-image { width: 190px; height: 190px; display: block; margin: 0 auto; }

        .main-footer {
            background: var(--primary);
            color: rgba(255,255,255,0.85);
            padding: 60px 0 20px;
            font-size: 14px;
            position: relative;
        }

        .main-footer::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--gold-dark), var(--gold-light), var(--gold-dark));
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-col h3 { color: var(--white); margin-bottom: 15px; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.06em; }

        .footer-brand { display: flex; align-items: center; gap: 12px; margin-bottom: 10px; }

        .footer-logo img { width: 55px; height: 55px; object-fit: contain; background: #fff; border-radius: 50%; padding: 4px; }

        .footer-desc { margin-top: 10px; line-height: 1.6; color: rgba(255,255,255,0.7); }

        .footer-links { list-style: none; padding: 0; }
        .footer-links li { margin-bottom: 8px; }
        .footer-links a { color: rgba(255,255,255,0.75); text-decoration: none; transition: 0.3s; }
        .footer-links a:hover { color: var(--gold-light); }

        .footer-col p { margin: 8px 0; display: flex; align-items: flex-start; gap: 8px; color: rgba(255,255,255,0.7); font-size: 0.88rem; line-height: 1.6; }
        .footer-col i { color: var(--gold-light); flex-shrink: 0; margin-top: 3px; }

        .footer-social a {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            width: 35px; height: 35px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            color: #fff;
            margin-right: 8px;
            transition: 0.3s;
            text-decoration: none;
        }

        .footer-social a:hover { background: var(--gold); color: #000; }

        .footer-bottom {
            text-align: center;
            margin-top: 20px;
            border-top: 1px solid rgba(255,255,255,0.15);
            padding-top: 15px;
            font-size: 13px;
            color: rgba(255,255,255,0.6);
        }

        .main-container { margin: 0; padding: 0; }
        .main-container section, section { margin-bottom: 0 !important; }

        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: var(--accent); }
        ::-webkit-scrollbar-thumb { background: #b0c4d8; border-radius: 8px; }
        ::-webkit-scrollbar-thumb:hover { background: #7a98b4; }

        .page-content { max-width: 100%; overflow-x: hidden; word-wrap: break-word; }
        .page-content * { max-width: 100%; }
        .page-content pre, .page-content code { white-space: normal; word-wrap: break-word; overflow-x: auto; }

        .page-content table { width: 100% !important; border-collapse: collapse !important; margin: 24px 0 !important; }
        .page-content table td, .page-content table th { border: 1px solid #dee2e6 !important; padding: 10px 14px !important; vertical-align: top !important; }
        .page-content table tbody tr:first-child td { background-color: #0a2a44 !important; color: #ffffff !important; font-weight: 600 !important; }
        .page-content table tbody tr:nth-child(even) td { background-color: #f8f9fa !important; }
        .page-content table tbody tr:first-child:hover td { background-color: #0a2a44 !important; }
        .page-content table tbody tr:not(:first-child):hover td { background-color: #eef2f6 !important; }

        .page-content img, .page-content table, .page-content iframe, .page-content video { max-width: 100% !important; height: auto !important; }
        .page-content .table-responsive { width: 100%; overflow-x: auto; -webkit-overflow-scrolling: touch; margin: 20px 0; border-radius: 8px; }

        .page-content h1 { font-size: clamp(1.5rem, 5vw, 2.2rem); }
        .page-content h2 { font-size: clamp(1.3rem, 4vw, 1.8rem); }
        .page-content h3 { font-size: clamp(1.1rem, 3.5vw, 1.4rem); }
        .page-content h4 { font-size: clamp(1rem, 3vw, 1.2rem); }
        .page-content p  { font-size: clamp(0.9rem, 2.5vw, 1rem); line-height: 1.6; }
        .page-content ul, .page-content ol { padding-left: clamp(20px, 4vw, 30px); }
        .page-content li { font-size: clamp(0.9rem, 2.5vw, 1rem); margin-bottom: 5px; }
        .page-content blockquote { padding: clamp(15px,3vw,25px) clamp(20px,4vw,30px); font-size: clamp(0.9rem,2.5vw,1rem); margin: 20px 0; }
        .page-content img { border-radius: clamp(8px,2vw,12px); margin: clamp(15px,3vw,25px) 0; }

        .sidebar-news { padding: clamp(15px,3vw,24px); }
        .sidebar-title { font-size: clamp(1.1rem,3vw,1.25rem); padding-bottom: clamp(8px,1.5vw,12px); margin-bottom: clamp(15px,2.5vw,20px); }
        .sidebar-news-list a { font-size: clamp(0.85rem,2.5vw,0.95rem); }
        .sidebar-news-list li { padding: clamp(8px,1.5vw,12px) 0; }
        .page-layout { gap: clamp(20px,4vw,40px); }

        .page-hero { min-height: clamp(200px,40vh,350px); padding: clamp(60px,10vh,100px) 0 clamp(30px,5vh,50px); }
        .page-hero-title { font-size: clamp(1.2rem,5vw,2rem); }
        .page-hero-title-wrap::before { min-height: clamp(24px,5vw,36px); width: clamp(3px,1vw,4px); }
        .page-hero-breadcrumb { font-size: clamp(0.65rem,2vw,0.85rem); gap: clamp(4px,1vw,8px); margin-bottom: clamp(8px,1.5vh,15px); }

        .py-5 { padding-top: clamp(1.5rem,5vh,3rem); padding-bottom: clamp(1.5rem,5vh,3rem); }

        #popup-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.7);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: clamp(12px, 4vw, 32px);
            opacity: 0;
            animation: popupFadeIn 0.4s ease 0.3s forwards;
        }

        @keyframes popupFadeIn { 
            from { opacity: 0; background: transparent; }
            to { opacity: 1; background: rgba(0,0,0,0.7); }
        }
        @keyframes popupSlideUp {
            from { opacity: 0; transform: translateY(30px) scale(0.96); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }

        #popup-box {
            position: relative;
            width: min(600px, 90vw);
            max-height: min(90vh, 90dvh);
            animation: popupSlideUp 0.45s cubic-bezier(0.34,1.56,0.64,1) 0.4s both;
        }

        #popup-close-btn {
            position: absolute;
            top: -16px;
            right: -16px;
            width: 36px;
            height: 36px;
            background: var(--gold);
            color: var(--white);
            border: none;
            border-radius: 50%;
            font-size: 20px;
            font-weight: 700;
            line-height: 1;
            cursor: pointer;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.35);
            transition: background var(--transition), transform var(--transition);
        }

        #popup-close-btn:hover { 
            background: var(--gold-dark); 
            transform: scale(1.12) rotate(90deg);
        }

        #popup-img {
            width: 100%;
            height: auto;
            max-height: min(85vh, 85dvh);
            display: block;
            object-fit: contain;
            border-radius: var(--radius-lg);
            box-shadow: 0 24px 60px rgba(0,0,0,0.45);
        }

        @media (min-width: 1400px) {
            .header-title h1 { font-size: 1.15rem; }
            .nav-link { font-size: 0.9rem; padding: 0 18px; }
            .hero-title { font-size: 4.4rem; }
        }

        @media (max-width: 1399px) { :root { --container-pad: 32px; } }

        @media (max-width: 1199px) {
            :root { --container-pad: 24px; }
            .header-title h1 { font-size: 0.9rem; }
            .header-title span { font-size: 0.68rem; }
            .nav-link { font-size: 0.78rem; padding: 0 12px; }
            .logo { width: 44px; height: 44px; }
            .hero-title { font-size: 3.2rem; }
            .survey-title { font-size: 2.2rem; }
            .footer-grid { gap: 28px; }
        }

        @media (max-width: 991px) {
            :root { --container-pad: 20px; }
            .header-title h1 { font-size: 0.85rem; }
            .header-title span { font-size: 0.64rem; }
            .logo { width: 42px; height: 42px; }
            .logo-title-group { gap: 10px; }
            .header-container { min-height: 64px; padding: 8px 0; }
            .nav-link { font-size: 0.72rem; padding: 0 10px; height: 50px; }
            .top-bar-container { flex-direction: column; gap: 6px; }
            .top-bar-left { justify-content: center; gap: 14px; }
            .top-bar-right { justify-content: center; }
            .hero-section { min-height: 64vh; }
            .hero-title { font-size: 2.6rem; }
            .agenda-horizontal-wrapper { grid-template-columns: repeat(2, 1fr); gap: 18px; }
            .agenda-card-small { height: 280px; }
            .survey-content { grid-template-columns: 1fr; gap: 40px; text-align: center; }
            .survey-right { justify-content: center; }
            .survey-title { font-size: 2rem; }
            .survey-label { justify-content: center; }
            .page-layout { grid-template-columns: 1fr !important; }
            .page-sidebar { margin-top: 20px; }
        }

        @media (max-width: 768px) {
            :root { --container-pad: 16px; }

            .top-bar { padding: 6px 0; }
            .top-bar-container { flex-direction: column; gap: 4px; }
            .top-bar-left { flex-direction: column; gap: 3px; width: 100%; }
            .top-bar-item { justify-content: center; font-size: 0.7rem; width: 100%; }
            .top-bar-item span { white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 260px; }
            .top-bar-right { width: 100%; justify-content: center; }

            .header-container { min-height: auto; padding: 8px 0; gap: 0; justify-content: space-between; }
            .logo-title-group { flex: 1; min-width: 0; gap: 8px; overflow: hidden; }
            .logo { width: 38px; height: 38px; flex-shrink: 0; }
            .header-title { padding-left: 10px; min-width: 0; flex: 1; overflow: hidden; }
            .header-title h1 { font-size: 0.78rem; }
            .header-title span { font-size: 0.6rem; }

            .menu-toggle {
                display: flex;
                flex-shrink: 0;
                width: 38px; height: 38px;
                margin-left: 8px;
                font-size: 1rem;
            }

            .main-nav {
                position: fixed;
                top: 0; right: -100%;
                width: 85%; max-width: 320px;
                height: 100vh;
                background: linear-gradient(180deg, var(--primary) 0%, var(--primary-dark) 100%);
                transition: right 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                display: block;
                overflow-y: auto;
                overflow-x: hidden;
            }

            .main-nav.active { right: 0; }

            .nav-menu {
                flex-direction: column;
                padding: 20px 0;
                gap: 0;
                width: 100%;
                align-items: stretch;
            }

            .nav-menu > li { display: block; width: 100%; }

            .nav-link {
                padding: 14px 20px;
                border-bottom: 1px solid rgba(255,255,255,0.07) !important;
                border-left: none; border-right: none; border-top: none;
                border-radius: 0;
                font-size: 0.9rem;
                height: auto;
                white-space: normal;
                justify-content: space-between;
                width: 100%;
                display: flex;
            }

            .nav-link:hover {
                background: rgba(201,168,76,0.08) !important;
                padding-left: 26px;
                color: var(--gold-light) !important;
            }

            .nav-link.active {
                color: var(--gold) !important;
                background: rgba(201,168,76,0.15) !important;
                border-left: 3px solid var(--gold) !important;
                border-bottom: none !important;
            }

            .nav-submenu, .child-menu {
                position: static !important;
                opacity: 1 !important;
                visibility: visible !important;
                display: none !important;
                box-shadow: none;
                border: none;
                border-left: 2px solid var(--gold);
                margin-left: 15px;
                background: rgba(0,0,0,0.3);
                pointer-events: auto;
                width: auto;
                min-width: unset;
                transform: none !important;
            }

            .nav-submenu.flip-left, .child-menu.flip-left {
                left: auto !important; right: auto !important;
                margin-left: 15px !important; margin-right: 0 !important;
                border-left: 2px solid var(--gold) !important;
                border-right: none !important;
            }

            .nav-dropdown.open > .nav-submenu,
            .has-child.open > .child-menu { display: block !important; }

            .has-child > a::after { content: '\f078'; }
            .child-menu { margin-left: 0; }

            .hero-section { min-height: 50vh; }
            .hero-overlay { padding: 70px 0 60px; }
            .hero-title { font-size: 1.9rem; }
            .hero-eyebrow { font-size: 0.65rem; padding: 5px 12px; }

            .agenda-section { padding: 56px 0; }
            .agenda-header { flex-direction: column; align-items: center; gap: 10px; margin-bottom: 24px; }
            .agenda-title { font-size: 1.7rem; }
            .agenda-horizontal-wrapper { grid-template-columns: 1fr; gap: 16px; }
            .agenda-card-small { height: 240px; }
            .agenda-empty { padding: 44px 20px; }
            .agenda-empty-icon { width: 64px; height: 64px; }
            .agenda-empty-icon i { font-size: 1.6rem; }
            .agenda-empty-title { font-size: 1rem; }

            .survey-section { padding: 52px 0; }
            .survey-title { font-size: 1.6rem; }
            .survey-description { font-size: 0.9rem; }
            .survey-content { gap: 28px; }
            .qr-image { width: 150px; height: 150px; }

            .main-footer { padding: 44px 0 0; }
            .footer-grid { grid-template-columns: 1fr; gap: 22px; }
            .footer-bottom { flex-direction: column; text-align: center; gap: 8px; }
        }

        @media (max-width: 480px) {
            .logo { width: 34px; height: 34px; }
            .header-title { padding-left: 8px; }
            .header-title h1 { font-size: 0.72rem; }
            .header-title span { font-size: 0.56rem; }
            .menu-toggle { width: 36px; height: 36px; font-size: 0.95rem; }
            .hero-title { font-size: 1.6rem; }
            .agenda-title { font-size: 1.5rem; }
            .agenda-card-small { height: 210px; }
            .survey-title { font-size: 1.4rem; }
            .qr-image { width: 130px; height: 130px; }
            .view-all-btn, .view-all { font-size: 0.8rem; padding: 11px 22px; }
            .top-bar-item span { max-width: 220px; }
            #popup-box { max-width: 90%; }
            #popup-close-btn { top: -12px; right: -10px; width: 30px; height: 30px; font-size: 16px; }
            .main-nav { width: 85%; max-width: 280px; }
            .nav-link { font-size: 0.85rem; padding: 12px 16px; }
        }

        @media (prefers-reduced-motion: reduce) {
            * { animation-duration: 0.01ms !important; animation-iteration-count: 1 !important; transition-duration: 0.01ms !important; }
        }
    </style>
</head>
<body>

@php
    $popupBanner = \App\Models\PopupBanner::where('is_active', true)->latest()->first();
@endphp

@if(request()->is('/') && $popupBanner && $popupBanner->image_path)
<div id="popup-overlay">
    <div id="popup-box">
        <button id="popup-close-btn" aria-label="Tutup">×</button>
        <img id="popup-img"
             src="{{ Storage::url($popupBanner->image_path) }}"
             alt="Informasi LPPMI">
    </div>
</div>
@endif

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
                    @if($settings->facebook)
                        <a href="{{ $settings->facebook }}" class="social-link" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    @endif
                    @if($settings->twitter)
                        <a href="{{ $settings->twitter }}" class="social-link" target="_blank"><i class="fab fa-twitter"></i></a>
                    @endif
                    @if($settings->instagram)
                        <a href="{{ $settings->instagram }}" class="social-link" target="_blank"><i class="fab fa-instagram"></i></a>
                    @endif
                    @if($settings->youtube)
                        <a href="{{ $settings->youtube }}" class="social-link" target="_blank"><i class="fab fa-youtube"></i></a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- HEADER -->
    <header class="site-header">
        <div class="site-container">
            <div class="header-container">
                <div class="logo-title-group">
                    <a href="{{ url('/') }}" class="logo">
                        @if(!empty($settings->logo))
                            <img src="{{ asset('storage/' . $settings->logo) }}"
                                 alt="Logo"
                                 style="width:100%;height:100%;object-fit:contain;filter:drop-shadow(0 2px 6px rgba(0,0,0,0.3));background:#ffffff;border-radius:50%;padding:3px;">
                        @else
                            <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="50" cy="50" r="45" fill="white" stroke="rgba(255,255,255,0.3)" stroke-width="1.5"/>
                                <image href="{{ asset('images/logo ugk.png') }}" x="15" y="15" width="70" height="70" preserveAspectRatio="xMidYMid meet"/>
                            </svg>
                        @endif
                    </a>
                    <div class="header-title">
                        <h1>{{ strtoupper($settings->site_name) }}</h1>
                        <span>{{ strtoupper($settings->site_subtitle) }}</span>
                    </div>
                </div>

                <button class="menu-toggle" id="menuToggle" aria-label="Toggle menu" aria-expanded="false">
                    <i class="fas fa-bars"></i>
                </button>

                <nav class="main-nav" id="mainNav" aria-label="Menu utama">
                    <ul class="nav-menu" id="navMenu">
                        @foreach($menus as $menu)
                            @if($menu->children && $menu->children->count())
                                <li class="nav-dropdown">
                                    <a href="#" class="nav-link" onclick="return false;">
                                        {{ $menu->title }}
                                        <i class="fas fa-chevron-down"></i>
                                    </a>
                                    <ul class="nav-submenu">
                                        @foreach($menu->children as $child)
                                            @if($child->children && $child->children->count())
                                                <li class="has-child">
                                                    <a href="{{ menu_url($child) }}">{{ $child->title }}</a>
                                                    <ul class="child-menu">
                                                        @foreach($child->children as $grandchild)
                                                            <li><a href="{{ menu_url($grandchild) }}">{{ $grandchild->title }}</a></li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @else
                                                <li><a href="{{ menu_url($child) }}">{{ $child->title }}</a></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                <li>
                                    <a href="{{ menu_url($menu) }}"
                                       class="nav-link {{ request()->url() === menu_url($menu) ? 'active' : '' }}">
                                        {{ $menu->title }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <div class="menu-overlay" id="menuOverlay"></div>

    @php use Illuminate\Support\Facades\Storage; @endphp

    @if(request()->is('/') && isset($heroBanners) && $heroBanners->count())
    <section class="hero-section" id="heroSection">
        <div class="hero-slider" id="heroSlider">
            @foreach ($heroBanners as $index => $banner)
                <div class="hero-slide {{ $index === 0 ? 'active' : '' }}"
                     style="background: url('{{ Storage::url($banner->image) }}'); background-size: cover; background-position: center;">
                </div>
            @endforeach
        </div>
        <div class="hero-overlay">
            <div class="site-container">
                <div class="hero-content">
                    <div class="hero-eyebrow">Universitas Gunung Kidul</div>
                    <h1 class="hero-title">LEMBAGA <span>PENJAMINAN</span> MUTU</h1>
                </div>
            </div>
        </div>
    </section>
    @endisset

    <main class="main-container">
        @yield('content')
    </main>

    {{-- ================= AGENDA SECTION ================= --}}
    @if(request()->is('/'))
    <section class="agenda-section">
        <div class="lpm-container">
            <div class="agenda-header">
                <div class="agenda-header-left">
                    <div class="section-label">Kegiatan</div>
                    <h2 class="agenda-title">Agenda Terbaru</h2>
                    <p class="agenda-subtitle">Jadwal kegiatan dan agenda terbaru dari LPPMI</p>
                </div>
            </div>

            <div class="agenda-horizontal-container">
                @if(isset($agendas) && $agendas->count() > 0)
                    {{-- ADA AGENDA --}}
                    <div class="agenda-horizontal-wrapper" id="agendaWrapper">
                        @foreach($agendas->take(3) as $agenda)
                        @php
                            $agendaDate = \Carbon\Carbon::parse($agenda->date);
                            $now = \Carbon\Carbon::now();
                            if ($agendaDate->isToday())       { $status = 'ongoing';   $statusText = 'Berlangsung'; }
                            elseif ($agendaDate->isPast())    { $status = 'completed'; $statusText = 'Selesai'; }
                            else                              { $status = 'upcoming';  $statusText = 'Akan Datang'; }
                        @endphp
                        <div class="agenda-card-small"
                             data-agenda-id="{{ $agenda->id }}"
                             role="button" tabindex="0"
                             aria-label="Lihat detail: {{ $agenda->title }}">
                            @if(!empty($agenda->image))
                                <img class="agenda-card-bg"
                                     src="{{ Storage::url($agenda->image) }}"
                                     alt="{{ $agenda->title }}"
                                     loading="lazy"
                                     onerror="this.style.display='none'">
                            @endif
                            <div class="agenda-date-small">
                                <span class="date-day-small">{{ $agendaDate->format('d') }}</span>
                                <span class="date-month-small">{{ $agendaDate->translatedFormat('M') }}</span>
                            </div>
                            <div class="agenda-content-small">
                                <h3 class="agenda-title-small">{{ $agenda->title }}</h3>
                                <div class="agenda-meta-small">
                                    <div class="meta-item-small">
                                        <i class="fas fa-clock"></i>
                                        <span>{{ $agenda->time }}</span>
                                    </div>
                                    <div class="meta-item-small">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <span>{{ Str::limit($agenda->location, 25) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    {{-- TIDAK ADA AGENDA --}}
                    <div class="agenda-empty">
                        <div class="agenda-empty-icon">
                            <i class="fas fa-calendar-times"></i>
                        </div>
                        <h4 class="agenda-empty-title">Tidak Ada Agenda</h4>
                        <p class="agenda-empty-desc">
                            Belum ada kegiatan yang dijadwalkan untuk beberapa hari ke depan.
                            Pantau terus halaman ini untuk informasi agenda terbaru.
                        </p>
                        <span class="agenda-empty-badge">
                            <i class="fas fa-bell"></i>
                            Segera hadir
                        </span>
                    </div>
                @endif
            </div>
        </div>
    </section>
    @endif

    {{-- ================= AGENDA MODAL ================= --}}
    <div class="agenda-modal-overlay" id="agendaModal" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
        <div class="agenda-modal-content">
            <button class="modal-close" id="modalClose" aria-label="Tutup">&times;</button>
            <div class="modal-image-wrap" id="modalImageWrap" style="display:none;">
                <img id="modalImage" src="" alt="">
                <div class="modal-image-overlay"></div>
            </div>
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

    @if(request()->is('/') && isset($activeSurvey) && $activeSurvey)
    <section class="survey-section">
        <div class="survey-container">
            <div class="survey-content">
                <div class="survey-left">
                    <div class="survey-label">Partisipasi Anda</div>
                    <h2 class="survey-title">Survey Kepuasan Layanan</h2>
                    <p class="survey-description">Untuk meningkatkan kualitas layanan, kami mohon Bapak/Ibu/Sdr. mengisi Survey Kepuasan Layanan. Masukan Anda sangat berarti bagi kami.</p>
                </div>
                <div class="survey-right">
                    <div class="survey-qr">
                        <div class="qr-box">
                            @if($activeSurvey->qr_code)
                                <img src="{{ asset('storage/' . $activeSurvey->qr_code) }}" alt="QR Code Survey" class="qr-image">
                            @else
                                <div style="width:190px;height:190px;background:var(--accent);display:flex;align-items:center;justify-content:center;border-radius:var(--radius-md);">
                                    <i class="fas fa-qrcode" style="font-size:3rem;color:var(--primary);"></i>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <footer class="main-footer">
        <div class="footer-container">
            <div class="footer-grid">
                <div class="footer-col">
                    <div class="footer-brand">
                        <div class="footer-logo">
                            @if(!empty($settings->logo))
                                <img src="{{ asset('storage/' . $settings->logo) }}" alt="Logo">
                            @else
                                <img src="{{ asset('images/logo ugk.png') }}" alt="Logo">
                            @endif
                        </div>
                        <div>
                            <h3>{{ $settings->site_name }}</h3>
                        </div>
                    </div>
                    <p class="footer-desc">{{ $settings->footer_description }}</p>
                </div>

                <div class="footer-col">
                    <h3>Menu</h3>
                    <ul class="footer-links">
                        @foreach($menus as $menu)
                            <li><a href="{{ menu_url($menu) }}">{{ $menu->title }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <div class="footer-col">
                    <h3>Kontak</h3>
                    <p><i class="fas fa-map-marker-alt"></i>{{ $settings->footer_address }}</p>
                    <p><i class="fas fa-phone-alt"></i>{{ $settings->footer_phone }}</p>
                    <p><i class="fas fa-envelope"></i>{{ $settings->footer_email }}</p>
                    <p><i class="fas fa-globe"></i>{{ $settings->footer_website }}</p>
                </div>
            </div>

            <div class="footer-bottom">
                <p>© {{ date('Y') }} {{ $settings->site_name }}. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>window.__agendaData = @json($agendas ?? []);</script>

    @yield('scripts')

<script>
document.addEventListener('DOMContentLoaded', function () {

    /* ===== UTIL ===== */
    const isMobile = () => window.innerWidth <= 768;

    /* ===== POPUP ===== */
    const popupOverlay = document.getElementById('popup-overlay');
    if (popupOverlay) {
        const closePopup = () => {
            popupOverlay.style.opacity = '0';
            setTimeout(() => popupOverlay.remove(), 300);
        };
        document.getElementById('popup-close-btn')?.addEventListener('click', e => { e.stopPropagation(); closePopup(); });
        popupOverlay.addEventListener('click', e => { if (e.target === popupOverlay) closePopup(); });
        document.addEventListener('keydown', e => { if (e.key === 'Escape' && document.getElementById('popup-overlay')) closePopup(); });
    }

    /* ===== MOBILE MENU ===== */
    const menuToggle  = document.getElementById('menuToggle');
    const mainNav     = document.getElementById('mainNav');
    const menuOverlay = document.getElementById('menuOverlay');

    const openMenu = () => {
        mainNav.classList.add('active');
        menuOverlay?.classList.add('active');
        document.body.classList.add('menu-open');
        if (menuToggle) menuToggle.innerHTML = '<i class="fas fa-times"></i>';
    };

    const closeMenu = () => {
        mainNav.classList.remove('active');
        menuOverlay?.classList.remove('active');
        document.body.classList.remove('menu-open');
        if (menuToggle) menuToggle.innerHTML = '<i class="fas fa-bars"></i>';
    };

    menuToggle?.addEventListener('click', e => {
        e.stopPropagation();
        mainNav.classList.contains('active') ? closeMenu() : openMenu();
    });

    menuOverlay?.addEventListener('click', closeMenu);

    window.addEventListener('resize', () => {
        if (!isMobile()) {
            closeMenu();
            document.querySelectorAll('.nav-dropdown.open, .has-child.open')
                .forEach(el => el.classList.remove('open'));
        }
    });

    /* ===== DROPDOWN MOBILE ===== */
    // Level 1 - klik chevron/nav-link parent
    document.querySelectorAll('.nav-dropdown > .nav-link').forEach(link => {
        link.addEventListener('click', function(e) {
            if (!isMobile()) return;
            e.preventDefault();
            e.stopPropagation();

            const parent = this.closest('.nav-dropdown');
            const isOpen = parent.classList.contains('open');

            // Tutup semua dulu
            document.querySelectorAll('.nav-dropdown.open')
                .forEach(el => el.classList.remove('open'));

            // Buka yang diklik (jika sebelumnya tutup)
            if (!isOpen) parent.classList.add('open');
        });
    });

    // Level 2 - klik has-child
    document.querySelectorAll('.has-child > a').forEach(link => {
        link.addEventListener('click', function(e) {
            if (!isMobile()) return;
            e.preventDefault();
            e.stopPropagation();
            this.closest('.has-child').classList.toggle('open');
        });
    });

    // Link biasa di dalam submenu — tutup menu setelah navigasi
    document.querySelectorAll('.nav-submenu a:not(.has-child > a), .child-menu a').forEach(link => {
        link.addEventListener('click', function() {
            if (!isMobile()) return;
            const href = this.getAttribute('href');
            if (href && href !== '#') setTimeout(closeMenu, 150);
        });
    });

    // Link top-level (bukan dropdown)
    document.querySelectorAll('.nav-menu > li:not(.nav-dropdown) > .nav-link').forEach(link => {
        link.addEventListener('click', function() {
            if (!isMobile()) return;
            const href = this.getAttribute('href');
            if (href && href !== '#') setTimeout(closeMenu, 150);
        });
    });

    /* ===== AGENDA MODAL ===== */
    const agendaModal = document.getElementById('agendaModal');
    const agendaData  = window.__agendaData || [];

    const openAgendaModal = (agendaId) => {
        const agenda = agendaData.find(a => a.id == agendaId);
        if (!agenda) return;

        const date = new Date(agenda.date);
        const day  = date.getDate().toString().padStart(2, '0');
        const months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];

        document.getElementById('modalDay').textContent = day;
        document.getElementById('modalMonthYear').textContent = `${months[date.getMonth()]} ${date.getFullYear()}`;
        document.getElementById('modalTitle').textContent = agenda.title;
        document.getElementById('modalTime').textContent = agenda.time;
        document.getElementById('modalLocation').textContent = agenda.location;
        document.getElementById('modalDescription').innerHTML = agenda.description || '<p>Tidak ada deskripsi.</p>';

        const now = new Date();
        let cls = '', txt = '';
        if (date.toDateString() === now.toDateString()) { cls = 'status-ongoing';   txt = 'Berlangsung'; }
        else if (date < now)                            { cls = 'status-completed'; txt = 'Selesai'; }
        else                                            { cls = 'status-upcoming';  txt = 'Akan Datang'; }

        const statusEl = document.getElementById('modalStatus');
        statusEl.className = `modal-status ${cls}`;
        statusEl.textContent = txt;

        const imgWrap = document.getElementById('modalImageWrap');
        const imgEl   = document.getElementById('modalImage');
        if (agenda.image) { imgEl.src = '/storage/' + agenda.image; imgWrap.style.display = 'block'; }
        else              { imgWrap.style.display = 'none'; }

        agendaModal.classList.add('active');
        document.body.style.overflow = 'hidden';
    };

    const closeAgendaModal = () => {
        agendaModal?.classList.remove('active');
        document.body.style.overflow = '';
    };

    document.querySelectorAll('.agenda-card-small').forEach(card => {
        card.addEventListener('click', () => openAgendaModal(card.getAttribute('data-agenda-id')));
    });

    document.getElementById('modalClose')?.addEventListener('click', closeAgendaModal);
    agendaModal?.addEventListener('click', e => { if (e.target === agendaModal) closeAgendaModal(); });
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape' && agendaModal?.classList.contains('active')) closeAgendaModal();
    });

    /* ===== HERO SLIDER ===== */
    const slides = document.querySelectorAll('.hero-slide');
    if (slides.length > 1) {
        let cur = 0;
        setInterval(() => {
            slides[cur].classList.remove('active');
            cur = (cur + 1) % slides.length;
            slides[cur].classList.add('active');
        }, 5000);
    }
});
</script>
</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>@yield('title', 'LPPMI - Universitas Gunung Kidul')</title>
    <meta name="description" content="Lembaga Pengendalian dan Penjaminan Mutu Internal Universitas Gunung Kidul. Meningkatkan kualitas pendidikan melalui sistem penjaminan mutu berkelanjutan.">

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
        .footer-container {
            width: 100%;
            max-width: var(--container-max);
            margin: 0 auto;
            padding: 0 var(--container-pad);
        }

        .lpm-container {
    width: 100%;
    max-width: 1800px;
    margin: 0 auto;
    padding: 0 var(--container-pad);
}

        /* ================= TOP BAR ================= */
        .top-bar {
            background: var(--primary-dark);
            color: rgba(255,255,255,0.85);
            padding: 9px 0;
            font-size: 0.8rem;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            letter-spacing: 0.015em;
        }

        .top-bar-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 8px;
        }

        .top-bar-left {
            display: flex;
            align-items: center;
            gap: 24px;
            flex-wrap: wrap;
        }

        .top-bar-item {
            display: flex;
            align-items: center;
            gap: 7px;
            color: rgba(255,255,255,0.8);
        }

        .top-bar-item i { color: var(--gold-light); font-size: 0.75rem; }

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
            font-size: 0.85rem;
            width: 28px; height: 28px;
            display: flex; align-items: center; justify-content: center;
            border-radius: 6px;
            text-decoration: none;
            transition: all var(--transition);
        }

        .social-link:hover { color: var(--white); background: rgba(255,255,255,0.12); }

        .language-selector {
            display: flex;
            align-items: center;
            gap: 2px;
            margin-left: 10px;
            padding-left: 14px;
            border-left: 1px solid rgba(255,255,255,0.15);
        }

        .language-selector a {
            color: rgba(255,255,255,0.65);
            text-decoration: none;
            font-size: 0.72rem;
            font-weight: 600;
            padding: 3px 8px;
            border-radius: 5px;
            transition: all var(--transition);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .language-selector a:hover,
        .language-selector a.active {
            color: var(--white);
            background: rgba(255,255,255,0.15);
        }

        /* ================= HEADER ================= */
        .site-header {
            background: var(--primary);
            position: sticky;
            top: 0;
            z-index: 1000;
            width: 100%;
            box-shadow: 0 2px 20px rgba(0,0,0,0.25);
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
            min-height: 76px;
            padding: 10px 0;
            gap: 20px;
            width: 100%;
        }

        .logo-title-group {
            display: flex;
            align-items: center;
            gap: 14px;
            flex-shrink: 0;
            flex: 1;
            min-width: 0;
        }

        .logo { width: 52px; height: 52px; flex-shrink: 0; filter: drop-shadow(0 2px 6px rgba(0,0,0,0.3)); }
        .logo svg { width: 100%; height: 100%; display: block; }

        .header-title {
            border-left: 1px solid rgba(255,255,255,0.18);
            padding-left: 14px;
        }

        .header-title h1 {
            color: var(--white);
            font-family: var(--font-roboto);
            font-weight: 800;
            font-size: 1.2rem;
            line-height: 1.25;
            margin: 0 0 2px 0;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            white-space: nowrap;
        }

        .header-title span {
            color: rgba(255,255,255,0.7);
            font-family: var(--font-roboto);
            font-weight: 600;
            font-size: 0.82rem;
            display: block;
            letter-spacing: 0.04em;
            white-space: nowrap;
        }

        .menu-toggle {
            display: none;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.2);
            color: var(--white);
            font-size: 1.2rem;
            cursor: pointer;
            width: 42px; height: 42px;
            border-radius: var(--radius-sm);
            transition: all var(--transition);
            flex-shrink: 0;
            align-items: center;
            justify-content: center;
        }

        .menu-toggle:hover { background: rgba(255,255,255,0.18); }

        /* ================= NAVIGATION ================= */
        .main-nav { flex: 1; display: flex; justify-content: flex-end; }

        .nav-menu {
            display: flex;
            list-style: none;
            margin: 0; padding: 0;
            gap: 2px;
            align-items: center;
        }

        .nav-link {
            color: rgba(255,255,255,0.88);
            text-decoration: none;
            padding: 8px 13px;
            display: flex;
            align-items: center;
            gap: 5px;
            font-weight: 700;
            font-size: 0.92rem;
            transition: all var(--transition);
            border-radius: var(--radius-sm);
            white-space: nowrap;
            letter-spacing: 0.025em;
            background: transparent;
            border: none;
            cursor: pointer;
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 4px; left: 50%; right: 50%;
            height: 2px;
            background: var(--gold-light);
            transition: all var(--transition);
            border-radius: 2px;
        }

        .nav-link:hover::after, .nav-link.active::after { left: 12px; right: 12px; }
        .nav-link:hover, .nav-link.active { color: var(--white); background: rgba(255,255,255,0.08); }
        .nav-link i { font-size: 0.7rem; transition: transform var(--transition); }
        .nav-dropdown:hover > .nav-link i { transform: rotate(180deg); }

        .nav-dropdown { position: relative; }

        .nav-submenu {
            position: absolute;
            top: calc(100% + 6px);
            left: 0;
            background: var(--primary-light);
            min-width: 230px;
            display: none;
            list-style: none;
            padding: 8px 0;
            box-shadow: var(--shadow-xl);
            border-radius: var(--radius-md);
            z-index: 1000;
            margin: 0;
            border: 1px solid rgba(255,255,255,0.08);
            overflow: hidden;
        }

        .nav-submenu::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--gold-dark), var(--gold-light));
        }

        .nav-submenu li a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 18px;
            color: rgba(255,255,255,0.85);
            text-decoration: none;
            transition: all var(--transition);
            font-size: 0.82rem;
            font-weight: 400;
        }

        .nav-submenu li a:hover {
            color: var(--white);
            background: rgba(255,255,255,0.1);
            padding-left: 22px;
        }

        @media (min-width: 992px) {
            .nav-dropdown:hover .nav-submenu { display: block; }
        }

        /* ================= HERO ================= */
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

        .hero-subtitle {
            font-size: 1.05rem;
            color: rgba(255,255,255,0.72);
            max-width: 520px;
            line-height: 1.75;
        }

        .hero-scroll {
            position: absolute;
            bottom: 36px; left: 50%;
            transform: translateX(-50%);
            z-index: 2;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            opacity: 0.55;
        }

        .hero-scroll span { font-size: 0.62rem; letter-spacing: 0.14em; text-transform: uppercase; color: var(--white); }

        .scroll-line {
            width: 1px; height: 40px;
            background: linear-gradient(to bottom, var(--white), transparent);
            animation: scrollLine 1.8s ease-in-out infinite;
        }

        @keyframes scrollLine {
            0% { transform: scaleY(0); transform-origin: top; opacity: 0; }
            50% { transform: scaleY(1); transform-origin: top; opacity: 1; }
            100% { transform: scaleY(0); transform-origin: bottom; opacity: 0; }
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

.agenda-header-left {
    text-align: center;
}

        .agenda-title {
            font-size: 2.4rem;
            font-weight: 700;
            color: var(--primary);
            margin: 0;
            letter-spacing: -0.02em;
        }

        .agenda-title i { display: none; }

        .agenda-subtitle {
            font-size: 0.95rem;
            color: var(--text-light);
            margin-top: 6px;
        }

        .agenda-horizontal-container { width: 100%; }

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

        .agenda-card-small::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, rgba(0,0,0,0) 0%, rgba(0,0,0,0.1) 40%, rgba(5,26,43,0.88) 100%);
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

        .date-year-small { display: none; }

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

        .agenda-status-small { display: none; }

        .status-upcoming  { background: rgba(201,168,76,0.15); color: var(--gold-dark); border: 1px solid rgba(201,168,76,0.3); }
        .status-ongoing   { background: rgba(34,197,94,0.12); color: #16a34a; border: 1px solid rgba(34,197,94,0.25); }
        .status-completed { background: var(--accent); color: var(--text-light); border: 1px solid var(--border); }

        .slider-indicators { display: none; }
        .slider-arrow { display: none; }

        /* ================= SHARED BUTTON ================= */
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

        /* ================= AGENDA MODAL ================= */
        .agenda-modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(5,26,43,0.62);
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1100;
            padding: 20px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .agenda-modal-overlay.active { display: flex; opacity: 1; }

        .agenda-modal-content {
            background: var(--white);
            border-radius: var(--radius-xl);
            max-width: 560px;
            width: 100%;
            max-height: 85vh;
            overflow-y: auto;
            box-shadow: var(--shadow-xl);
            position: relative;
            transform: translateY(16px) scale(0.98);
            transition: transform 0.3s cubic-bezier(0.34,1.56,0.64,1);
        }

        .agenda-modal-overlay.active .agenda-modal-content { transform: translateY(0) scale(1); }

        .modal-close {
            position: absolute;
            top: 18px; right: 18px;
            width: 36px; height: 36px;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
            border: 1px solid rgba(255,255,255,0.3);
            font-size: 1.3rem;
            color: var(--white);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all var(--transition);
            z-index: 2;
        }

        .modal-close:hover { background: rgba(255,255,255,0.3); transform: rotate(90deg); }

        .modal-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: var(--white);
            padding: 36px 32px 30px;
            position: relative;
            border-radius: var(--radius-xl) var(--radius-xl) 0 0;
            overflow: hidden;
        }

        .modal-header::before {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--gold-dark), var(--gold-light), var(--gold-dark));
        }

        .modal-header::after {
            content: '';
            position: absolute;
            top: -60px; right: -60px;
            width: 180px; height: 180px;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
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

        .modal-day { font-size: 2.6rem; font-weight: 700; line-height: 1; font-family: var(--font-heading); color: var(--white); }
        .modal-month-year { font-size: 0.85rem; opacity: 0.85; line-height: 1.4; color: var(--gold-light); }
        .modal-title { font-size: 1.5rem; font-weight: 700; line-height: 1.3; margin: 0; color: var(--white); position: relative; z-index: 1; }

        .modal-body { padding: 28px 32px; }

        .modal-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
            margin-bottom: 24px;
            padding: 18px;
            background: var(--accent);
            border-radius: var(--radius-md);
            border: 1px solid var(--border);
        }

        .modal-info-item { display: flex; align-items: center; gap: 10px; color: var(--text-dark); font-size: 0.9rem; }
        .modal-info-item i { color: var(--primary); font-size: 0.95rem; width: 18px; flex-shrink: 0; }

        .modal-description { line-height: 1.75; color: var(--text-mid); font-size: 0.92rem; }
        .modal-description p { margin-bottom: 12px; }

        .modal-footer {
            padding: 18px 32px;
            background: var(--accent);
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: flex-end;
            border-radius: 0 0 var(--radius-xl) var(--radius-xl);
        }

        .modal-status { padding: 6px 18px; border-radius: 100px; font-size: 0.75rem; font-weight: 600; letter-spacing: 0.04em; }

        /* ================= SURVEY ================= */
        .survey-section {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            padding: 96px 0;
            overflow: hidden;
            color: var(--white);
            position: relative;
        }

        .survey-section::before {
            content: '';
            position: absolute;
            top: -100px; right: -100px;
            width: 500px; height: 500px;
            border-radius: 50%;
            border: 80px solid rgba(255,255,255,0.03);
            pointer-events: none;
        }

        .survey-section::after {
            content: '';
            position: absolute;
            bottom: -80px; left: -80px;
            width: 360px; height: 360px;
            border-radius: 50%;
            border: 60px solid rgba(255,255,255,0.025);
            pointer-events: none;
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

        .survey-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: var(--gold);
            color: var(--primary-dark);
            padding: 15px 36px;
            border-radius: 100px;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.9rem;
            letter-spacing: 0.02em;
            transition: all var(--transition);
            border: none;
            cursor: pointer;
            box-shadow: 0 8px 24px rgba(201,168,76,0.35);
        }

        .survey-btn:hover {
            background: var(--gold-light);
            color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(201,168,76,0.45);
        }

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
        .qr-caption { color: rgba(255,255,255,0.7); font-size: 0.85rem; font-weight: 500; }

        /* ================= FOOTER ================= */
        .main-footer {
            background: var(--primary-dark);
            color: var(--white);
            padding: 70px 0 0;
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
            grid-template-columns: 1.4fr 1fr 1fr;
            gap: 60px;
            margin-bottom: 56px;
        }

        .footer-col h3 {
            font-size: 0.78rem;
            font-weight: 700;
            margin-bottom: 22px;
            padding-bottom: 14px;
            position: relative;
            color: var(--white);
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        .footer-col h3::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0;
            width: 28px; height: 2px;
            background: var(--gold);
            border-radius: 2px;
        }

        .footer-col p { margin-bottom: 10px; color: rgba(255,255,255,0.58); line-height: 1.75; font-size: 0.88rem; }

        .footer-link {
            display: flex;
            align-items: center;
            gap: 8px;
            color: rgba(255,255,255,0.58);
            text-decoration: none;
            margin-bottom: 10px;
            font-size: 0.88rem;
            transition: all var(--transition);
        }

        .footer-link i { color: var(--gold); font-size: 0.62rem; flex-shrink: 0; transition: transform var(--transition); }
        .footer-link:hover { color: var(--white); }
        .footer-link:hover i { transform: translateX(3px); }

        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.08);
            padding: 22px 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
        }

        .copyright { font-size: 0.8rem; color: rgba(255,255,255,0.42); }

        .footer-bottom-links { display: flex; gap: 20px; }

        .footer-bottom-links a {
            font-size: 0.8rem;
            color: rgba(255,255,255,0.42);
            text-decoration: none;
            transition: color var(--transition);
        }

        .footer-bottom-links a:hover { color: rgba(255,255,255,0.75); }

        /* ================= MAIN CONTAINER ================= */
        .main-container { margin: 0; padding: 0; }
        .main-container section, section { margin-bottom: 0 !important; }

        /* ================= SCROLLBAR ================= */
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: var(--accent); }
        ::-webkit-scrollbar-thumb { background: #b0c4d8; border-radius: 8px; }
        ::-webkit-scrollbar-thumb:hover { background: #7a98b4; }

        /* ================================================
           RESPONSIVE
        ================================================ */

        @media (min-width: 1400px) {
            .header-title h1 { font-size: 1.05rem; }
            .nav-link { font-size: 0.85rem; padding: 9px 14px; }
            .hero-title { font-size: 4.4rem; }
        }

        @media (max-width: 1399px) { :root { --container-pad: 32px; } }

        @media (max-width: 1199px) {
            :root { --container-pad: 28px; }
            .header-title h1 { font-size: 0.92rem; }
            .header-title span { font-size: 0.68rem; }
            .nav-link { font-size: 0.78rem; padding: 8px 11px; }
            .logo { width: 46px; height: 46px; }
            .hero-title { font-size: 3.2rem; }
            .survey-title { font-size: 2.2rem; }
            .footer-grid { gap: 40px; }
        }
        @media (max-width: 1024px) {
            .header-title h1 { font-size: 1rem; }
            .header-title span { font-size: 0.72rem; }
            .nav-link { font-size: 0.8rem; padding: 8px 10px; }
        }
        @media (max-width: 991px) {
            :root { --container-pad: 24px; }
            .header-title h1 { font-size: 0.95rem; }
            .header-title span { font-size: 0.68rem; }
            .logo { width: 44px; height: 44px; }
            .logo-title-group { gap: 10px; }
            .top-bar-container { flex-direction: column; text-align: center; gap: 8px; }
            .top-bar-left { justify-content: center; gap: 18px; }
            .top-bar-right { justify-content: center; }
            .header-container { min-height: 68px; padding: 8px 0; }
            .nav-link { padding: 6px 10px; font-size: 0.74rem; }
            .hero-section { min-height: 64vh; }
            .hero-title { font-size: 2.6rem; }
            .agenda-horizontal-wrapper { grid-template-columns: repeat(2, 1fr); gap: 18px; }
            .agenda-card-small { height: 280px; }
            .survey-content { grid-template-columns: 1fr; gap: 40px; text-align: center; }
            .survey-right { justify-content: center; }
            .survey-title { font-size: 2rem; }
            .survey-label { justify-content: center; }
            .footer-grid { grid-template-columns: 1fr 1fr; gap: 32px; }
        }

        /* ================= MOBILE 767px ================= */
        @media (max-width: 767px) {
            :root { --container-pad: 16px; }

            .top-bar-left { flex-direction: column; gap: 5px; width: 100%; }
            .top-bar-item { font-size: 0.72rem; justify-content: center; width: 100%; }
            .top-bar-right { width: 100%; justify-content: center; flex-wrap: wrap; }

            .header-container { min-height: auto; padding: 10px 0; gap: 8px; }
            .logo-title-group { max-width: calc(100% - 52px); gap: 8px; }
            .logo { width: 40px; height: 40px; }
            .header-title { padding-left: 10px; }
            .header-title h1 {
                font-size: 0.8rem;
                white-space: normal;
                line-height: 1.2;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
                word-break: break-word;
                margin-bottom: 2px;
            }
            .header-title span {
                font-size: 0.58rem;
                white-space: normal;
                display: -webkit-box;
                -webkit-line-clamp: 1;
                -webkit-box-orient: vertical;
                overflow: hidden;
                word-break: break-word;
            }

            .menu-toggle {
                display: flex;
                align-items: center;
                justify-content: center;
                order: 1;
                flex-shrink: 0;
                width: 42px; height: 42px;
                padding: 0;
                font-size: 1.15rem;
            }

            /* Mobile nav — z-index 1001, LEBIH TINGGI dari overlay */
            .main-nav {
                position: fixed;
                top: 0; right: -100%;
                width: 82%;
                max-width: 300px;
                height: 100vh;
                background: var(--primary);
                transition: right 0.32s cubic-bezier(0.4,0,0.2,1);
                z-index: 1001;
                box-shadow: -8px 0 30px rgba(0,0,0,0.3);
                display: block;
                overflow-y: auto;
            }

            .main-nav::before {
                content: '';
                display: block;
                height: 3px;
                background: linear-gradient(90deg, var(--gold-dark), var(--gold-light), var(--gold-dark));
                position: sticky;
                top: 0;
                z-index: 2;
            }

            .main-nav.active { right: 0; }

            .nav-menu {
                flex-direction: column;
                padding: 8px 0 24px;
                height: auto;
                gap: 0;
                width: 100%;
                align-items: stretch;
            }

            .nav-link {
                padding: 14px 22px;
                border-bottom: 1px solid rgba(255,255,255,0.07);
                font-size: 0.88rem;
                white-space: normal;
                border-radius: 0;
                color: rgba(255,255,255,0.88);
                opacity: 1;
                justify-content: space-between;
                width: 100%;
                letter-spacing: 0.02em;
            }

            .nav-link::after { display: none; }
            .nav-link:hover { background: rgba(255,255,255,0.07); color: var(--white); padding-left: 26px; }
            .nav-link i { font-size: 0.72rem; transition: transform var(--transition); }

            /* Dropdown — z-index tidak perlu karena static */
            .nav-dropdown .nav-submenu {
                display: none;
                position: static;
                width: 100%;
                background: var(--primary-dark);
                box-shadow: none;
                border-radius: 0;
                margin: 0; padding: 0; border: none;
                min-width: unset;
            }

            .nav-dropdown .nav-submenu::before { display: none; }
            .nav-dropdown.active .nav-submenu { display: block !important; }
            .nav-dropdown.active .nav-link i { transform: rotate(180deg); }

            .nav-submenu li a {
                padding: 12px 22px 12px 36px;
                font-size: 0.83rem;
                color: rgba(255,255,255,0.7);
                border-bottom: 1px solid rgba(255,255,255,0.04);
            }

            .nav-submenu li a:hover { color: var(--white); background: rgba(255,255,255,0.06); padding-left: 40px; }

            /* Overlay — z-index 999, LEBIH RENDAH dari nav (1001) */
            .menu-overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(5,26,43,0.65);
                z-index: 999;
                opacity: 0;
                transition: opacity 0.3s ease;
                backdrop-filter: blur(3px);
                -webkit-backdrop-filter: blur(3px);
            }
            *, *::before, *::after {
                animation: none !important;
                transition: none !important;
            }
            .main-nav {
                transition: right 0.32s cubic-bezier(0.4,0,0.2,1) !important;
            }

            .menu-overlay.active { display: block; opacity: 1; }
            body.menu-open { overflow: hidden; }

            .hero-section { min-height: 50vh; }
            .hero-overlay { padding: 70px 0 60px; }
            .hero-title { font-size: 1.8rem; letter-spacing: -0.02em; }
            .hero-subtitle { font-size: 0.88rem; }
            .hero-eyebrow { font-size: 0.65rem; padding: 5px 12px; }
            .hero-scroll { display: none; }

            .agenda-section { padding: 60px 0; }
            .agenda-header { flex-direction: column; align-items: center; gap: 12px; margin-bottom: 28px; }
            .agenda-title { font-size: 1.8rem; }
            .agenda-horizontal-wrapper { grid-template-columns: 1fr; gap: 16px; }
            .agenda-card-small { height: 250px; }

            .top-bar-left { flex-direction: column; gap: 4px; width: 100%; }
            .top-bar-item { justify-content: center; font-size: 0.7rem; }
            .top-bar-right { width: 100%; justify-content: center; }

            .survey-section { padding: 52px 0; }
            .survey-title { font-size: 1.6rem; }
            .survey-description { font-size: 0.9rem; }
            .survey-content { gap: 32px; }
            .qr-image { width: 160px; height: 160px; }

            .agenda-modal-content { border-radius: var(--radius-lg); margin: 0 8px; }
            .modal-header { padding: 24px 20px; border-radius: var(--radius-lg) var(--radius-lg) 0 0; }
            .modal-body { padding: 20px; }
            .modal-footer { padding: 14px 20px; border-radius: 0 0 var(--radius-lg) var(--radius-lg); }
            .modal-info { grid-template-columns: 1fr; gap: 10px; }
            .modal-title { font-size: 1.15rem; }
            .modal-day { font-size: 2rem; }

            .main-footer { padding: 48px 0 0; }
            .footer-grid { grid-template-columns: 1fr; gap: 24px; }
            .footer-bottom { flex-direction: column; text-align: center; gap: 10px; }
        }

        @media (max-width: 480px) {
            .logo-title-group { gap: 8px; }
            .logo { width: 36px; height: 36px; }
            .header-title { padding-left: 8px; }
            .header-title h1 { font-size: 0.78rem; }
            .header-title span { font-size: 0.54rem; }
            .menu-toggle { width: 38px; height: 38px; font-size: 1rem; }
            .hero-title { font-size: 1.55rem; }
            .hero-subtitle { font-size: 0.82rem; }

            .agenda-title { font-size: 1.6rem; }
            .agenda-card-small { height: 220px; }
            .survey-title { font-size: 1.45rem; }
            .qr-image { width: 140px; height: 140px; }

            .view-all-btn, .view-all { font-size: 0.8rem; padding: 11px 24px; }
        }

        @media (max-width: 360px) {
            .logo { width: 34px; height: 34px; }
            .header-title h1 { font-size: 0.72rem; }
            .hero-title { font-size: 1.5rem; }
            .agenda-title { font-size: 1.4rem; }
            .survey-title { font-size: 1.3rem; }
        }

        /* ===== TABEL DI HALAMAN KONTEN ===== */
.page-content table {
    width: 100% !important;
    border-collapse: collapse !important;
    margin: 24px 0 !important;
}

.page-content table td,
.page-content table th {
    border: 1px solid #dee2e6 !important;
    padding: 10px 14px !important;
    vertical-align: top !important;
}

.page-content table tbody tr:first-child td {
    background-color: #0a2a44 !important;
    color: #ffffff !important;
    font-weight: 600 !important;
}

.page-content table tbody tr:nth-child(even) td {
    background-color: #f8f9fa !important;
}

.page-content table tbody tr:first-child:hover td {
    background-color: #0a2a44 !important;
}

.page-content table tbody tr:not(:first-child):hover td {
    background-color: #eef2f6 !important;
}

@media (max-width: 767px) {
    .page-content table {
        display: block;
        overflow-x: auto;
    }
}
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
                </div>
            </div>
        </div>
    </div>

    <!-- HEADER -->
    <header class="site-header">
        <div class="site-container">
            <div class="header-container">
                <div class="logo-title-group">
                    <div class="logo">
                        <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
    <circle cx="50" cy="50" r="45" fill="white" stroke="rgba(255,255,255,0.3)" stroke-width="1.5"/>
    <image href="{{ asset('images/logo ugk.png') }}" x="15" y="15" width="70" height="70" preserveAspectRatio="xMidYMid meet"/>
</svg>
                    </div>
                    <div class="header-title">
                        <h1>{{ strtoupper($settings->site_name) }}</h1>
                        <span>{{ strtoupper($settings->site_subtitle) }}</span>
                    </div>
                </div>

                <button class="menu-toggle" id="menuToggle" aria-label="Toggle navigation menu">
                    <i class="fas fa-bars"></i>
                </button>

                <nav class="main-nav" id="mainNav">
                    <ul class="nav-menu" id="navMenu">
                        @foreach($menus as $menu)
                            @if($menu->children->count() > 0)
                                <li class="nav-dropdown">
                                    <a href="#" class="nav-link nav-toggle">
                                        {{ strtoupper($menu->title) }}
                                        <i class="fas fa-chevron-down ms-1"></i>
                                    </a>
                                    <ul class="nav-submenu">
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

    <!-- HERO -->
    @isset($heroBanners)
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

    <!-- MAIN CONTENT -->
    <main class="main-container">
        @yield('content')
    </main>

    <!-- AGENDA -->
    @if(isset($agendas) && count($agendas) > 0)
    <section class="agenda-section">
        <div class="lpm-container">
            <div class="agenda-header">
                <div class="agenda-header-left">
                    <div class="section-label">Kegiatan</div>
                    <h2 class="agenda-title"><i class="fas fa-calendar-alt"></i> Agenda Terbaru</h2>
                    <p class="agenda-subtitle">Jadwal kegiatan dan agenda terbaru dari LPPMI</p>
                </div>
            </div>

            <div class="agenda-horizontal-container">
                <div class="agenda-horizontal-wrapper" id="agendaWrapper">
                    @foreach($agendas->take(3) as $agenda)
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
                        </div>
                        <div class="agenda-content-small">
                            <h3 class="agenda-title-small">{{ $agenda->title }}</h3>
                            <div class="agenda-meta-small">
                                <div class="meta-item-small"><i class="fas fa-clock"></i><span>{{ $agenda->time }}</span></div>
                                <div class="meta-item-small"><i class="fas fa-map-marker-alt"></i><span>{{ Str::limit($agenda->location, 25) }}</span></div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="agenda-footer">
                <button class="view-all-btn">Lihat Semua Agenda <i class="fas fa-arrow-right"></i></button>
            </div>
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
                    <p><i class="fas fa-map-marker-alt me-2" style="color:var(--gold);"></i> {{ $settings->footer_address }}</p>
                    <p><i class="fas fa-phone-alt me-2" style="color:var(--gold);"></i> {{ $settings->footer_phone }}</p>
                    <p><i class="fas fa-envelope me-2" style="color:var(--gold);"></i> {{ $settings->footer_email }}</p>
                    <p><i class="fas fa-globe me-2" style="color:var(--gold);"></i> {{ $settings->footer_website }}</p>
                </div>
                <div class="footer-col">
                    <h3>Tautan Cepat</h3>
                    <a href="/" class="footer-link"><i class="fas fa-chevron-right"></i>Beranda</a>
                    <a href="#" class="footer-link"><i class="fas fa-chevron-right"></i>Dokumen Mutu</a>
                    <a href="#" class="footer-link"><i class="fas fa-chevron-right"></i>Profil Lembaga</a>
                    <a href="#" class="footer-link"><i class="fas fa-chevron-right"></i>Kontak</a>
                </div>
            </div>
            <div class="footer-bottom">
                <p class="copyright">© {{ date('Y') }} Lembaga Penjaminan Mutu — Universitas Gunung Kidul. All rights reserved.</p>
                <div class="footer-bottom-links">
                    <a href="#">Kebijakan Privasi</a>
                    <a href="#">Syarat & Ketentuan</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')

    <script>
    document.addEventListener('DOMContentLoaded', function () {

        /* HERO SLIDER */
        const slides = document.querySelectorAll('.hero-slide');
        if (slides.length > 1) {
            let current = 0;
            setInterval(() => {
                slides[current].classList.remove('active');
                current = (current + 1) % slides.length;
                slides[current].classList.add('active');
            }, 5000);
        }

        /* MOBILE NAVIGATION */
        const menuToggle  = document.getElementById('menuToggle');
        const mainNav     = document.getElementById('mainNav');
        const menuOverlay = document.getElementById('menuOverlay');

        function openMobileMenu() {
            mainNav.classList.add('active');
            menuOverlay.classList.add('active');
            document.body.classList.add('menu-open');
            menuToggle.querySelector('i').className = 'fas fa-times';
        }

        function closeMobileMenu() {
            mainNav.classList.remove('active');
            menuOverlay.classList.remove('active');
            document.body.classList.remove('menu-open');
            menuToggle.querySelector('i').className = 'fas fa-bars';
            document.querySelectorAll('.nav-dropdown').forEach(d => d.classList.remove('active'));
        }

        menuToggle.onclick = function(e) {
            e.preventDefault();
            e.stopPropagation();
            mainNav.classList.contains('active') ? closeMobileMenu() : openMobileMenu();
        };

        menuOverlay.onclick = function() { closeMobileMenu(); };

        document.querySelectorAll('.nav-dropdown').forEach(function(dropdown) {
            const toggle = dropdown.querySelector('.nav-toggle');
            if (!toggle) return;
            toggle.onclick = function(e) {
                e.preventDefault();
                e.stopPropagation();
                const isActive = dropdown.classList.contains('active');
                document.querySelectorAll('.nav-dropdown').forEach(d => d.classList.remove('active'));
                if (!isActive) dropdown.classList.add('active');
            };
        });

        document.querySelectorAll('.nav-submenu a').forEach(function(link) {
            link.onclick = function() { setTimeout(closeMobileMenu, 200); };
        });

        window.addEventListener('resize', function() {
            if (window.innerWidth > 767) closeMobileMenu();
        });

        /* AGENDA MODAL */
        const agendaModal = document.getElementById('agendaModal');
        const modalClose  = document.getElementById('modalClose');
        const agendaCards = document.querySelectorAll('.agenda-card-small');
        const agendaData  = @json($agendas ?? []);

        function formatModalDate(dateString) {
            const date = new Date(dateString);
            return {
                day: date.getDate(),
                month: date.toLocaleDateString('id-ID', { month: 'long' }),
                year: date.getFullYear()
            };
        }

        function closeModal() {
            agendaModal?.classList.remove('active');
            document.body.style.overflow = '';
        }

        agendaCards.forEach(card => {
            card.addEventListener('click', function () {
                const agendaId = this.getAttribute('data-agenda-id');
                const agenda   = agendaData.find(a => a.id == agendaId);
                if (!agenda) return;

                const date       = formatModalDate(agenda.date);
                const agendaDate = new Date(agenda.date);
                const now        = new Date();

                let statusText  = 'Selesai';
                let statusClass = 'status-completed';
                if (agendaDate.toDateString() === now.toDateString()) {
                    statusText = 'Berlangsung'; statusClass = 'status-ongoing';
                } else if (agendaDate > now) {
                    statusText = 'Akan Datang'; statusClass = 'status-upcoming';
                }

                document.getElementById('modalDay').textContent       = date.day;
                document.getElementById('modalMonthYear').textContent = `${date.month} ${date.year}`;
                document.getElementById('modalTitle').textContent     = agenda.title;
                document.getElementById('modalTime').textContent      = agenda.time;
                document.getElementById('modalLocation').textContent  = agenda.location;
                document.getElementById('modalDescription').innerHTML =
                    agenda.description?.replace(/\n/g, '<br>') ||
                    '<p style="color:var(--text-light);font-style:italic;">Tidak ada deskripsi tersedia.</p>';

                const modalStatus     = document.getElementById('modalStatus');
                modalStatus.textContent = statusText;
                modalStatus.className   = `modal-status ${statusClass}`;

                agendaModal.classList.add('active');
                document.body.style.overflow = 'hidden';
            });
        });

        modalClose?.addEventListener('click', closeModal);
        agendaModal?.addEventListener('click', e => { if (e.target === agendaModal) closeModal(); });
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape' && agendaModal?.classList.contains('active')) closeModal();
        });

    });
    </script>
</body>
</html>
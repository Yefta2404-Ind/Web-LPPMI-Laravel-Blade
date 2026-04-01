<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>@yield('title', 'LPM CMS - Panel Staff')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=DM+Serif+Display:ital@0;1&display=swap" rel="stylesheet">

    <style>
        /* ========== DESIGN TOKENS ========== */
        :root {
            --navy:        #0d1f35;
            --navy-mid:    #152840;
            --navy-light:  #1e3a56;
            --blue:        #2563eb;
            --blue-light:  #3b82f6;
            --sky:         #0ea5e9;
            --sky-light:   #38bdf8;
            --surface:     #ffffff;
            --surface-2:   #f8fafc;
            --surface-3:   #f1f5f9;
            --border:      #e2e8f0;
            --border-mid:  #cbd5e1;
            --text-primary:#0f172a;
            --text-mid:    #334155;
            --text-muted:  #64748b;
            --text-faint:  #94a3b8;
            --success:     #10b981;
            --success-bg:  #ecfdf5;
            --warning:     #f59e0b;
            --warning-bg:  #fffbeb;
            --danger:      #ef4444;
            --danger-bg:   #fef2f2;
            --info:        #0ea5e9;
            --info-bg:     #f0f9ff;

            --sidebar-w:   260px;
            --topbar-h:    64px;
            --r-lg:        16px;
            --r-md:        12px;
            --r-sm:        8px;
            --r-xs:        6px;

            --shadow-xs:   0 1px 2px rgba(0,0,0,.06);
            --shadow-sm:   0 1px 3px rgba(0,0,0,.08), 0 1px 2px rgba(0,0,0,.04);
            --shadow-md:   0 4px 12px rgba(0,0,0,.08), 0 2px 4px rgba(0,0,0,.04);
            --shadow-lg:   0 10px 24px rgba(0,0,0,.10), 0 4px 8px rgba(0,0,0,.05);
            --shadow-blue: 0 4px 14px rgba(37,99,235,.25);

            --ease:        cubic-bezier(.4,0,.2,1);
            --t-fast:      150ms;
            --t-med:       250ms;
            --t-slow:      350ms;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
            background: var(--surface-3);
            color: var(--text-primary);
            line-height: 1.6;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ========== ROOT LAYOUT ========== */
        .layout {
            display: flex;
            min-height: 100vh;
        }

        /* ========== OVERLAY (mobile) ========== */
        .overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,.45);
            backdrop-filter: blur(4px);
            z-index: 1050;
        }
        .overlay.active { display: block; }

        /* ========== SIDEBAR ========== */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--navy);
            position: fixed;
            inset-block: 0;
            left: 0;
            z-index: 1100;
            display: flex;
            flex-direction: column;
            transition: transform var(--t-slow) var(--ease);
            /* subtle texture */
            background-image:
                radial-gradient(ellipse at 80% 20%, rgba(37,99,235,.15) 0%, transparent 60%),
                radial-gradient(ellipse at 20% 80%, rgba(14,165,233,.10) 0%, transparent 55%);
        }

        /* Brand */
        .sidebar-brand {
            padding: 24px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            border-bottom: 1px solid rgba(255,255,255,.07);
            flex-shrink: 0;
        }
        .brand-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--blue), var(--sky));
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.1rem;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(37,99,235,.35);
        }
        .brand-text { color: #fff; font-weight: 800; font-size: 1.1rem; letter-spacing: -.2px; }
        .brand-sub { color: rgba(255,255,255,.4); font-size: .65rem; font-weight: 500; letter-spacing: .5px; text-transform: uppercase; margin-top: 1px; }

        /* User card inside sidebar */
        .sidebar-user {
            margin: 16px 14px;
            padding: 12px 14px;
            background: rgba(255,255,255,.06);
            border: 1px solid rgba(255,255,255,.08);
            border-radius: var(--r-md);
            display: flex;
            align-items: center;
            gap: 10px;
            flex-shrink: 0;
        }
        .sidebar-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--blue-light), var(--sky));
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: .85rem;
            color: #fff;
            flex-shrink: 0;
        }
        .sidebar-user-name  { color: #fff;                  font-size: .82rem; font-weight: 600; }
        .sidebar-user-role  { color: rgba(255,255,255,.45); font-size: .7rem; }

        /* Nav */
        .sidebar-nav { flex: 1; padding: 8px 10px; overflow-y: auto; }

        .nav-section-label {
            color: rgba(255,255,255,.3);
            font-size: .62rem;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: 14px 10px 6px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            color: rgba(255,255,255,.65);
            text-decoration: none;
            border-radius: var(--r-sm);
            margin-bottom: 2px;
            font-size: .85rem;
            font-weight: 500;
            transition: all var(--t-fast) var(--ease);
            position: relative;
            overflow: hidden;
        }
        .nav-item-icon {
            width: 32px;
            height: 32px;
            border-radius: var(--r-xs);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .9rem;
            flex-shrink: 0;
            background: rgba(255,255,255,.06);
            transition: all var(--t-fast) var(--ease);
        }
        .nav-item:hover {
            color: #fff;
            background: rgba(255,255,255,.08);
        }
        .nav-item:hover .nav-item-icon { background: rgba(37,99,235,.35); }
        .nav-item.active {
            color: #fff;
            background: rgba(37,99,235,.25);
        }
        .nav-item.active .nav-item-icon {
            background: linear-gradient(135deg, var(--blue), var(--sky));
            box-shadow: 0 2px 8px rgba(37,99,235,.4);
            color: #fff;
        }
        .nav-item.active::before {
            content: '';
            position: absolute;
            left: 0; top: 25%; bottom: 25%;
            width: 3px;
            background: var(--sky-light);
            border-radius: 0 4px 4px 0;
        }

        /* Logout */
        .nav-divider { height: 1px; background: rgba(255,255,255,.07); margin: 10px; }
        .nav-item.logout:hover { background: rgba(239,68,68,.15); color: #fca5a5; }
        .nav-item.logout:hover .nav-item-icon { background: rgba(239,68,68,.25); color: #fca5a5; }

        /* Footer */
        .sidebar-footer {
            padding: 14px 20px;
            font-size: .65rem;
            color: rgba(255,255,255,.25);
            text-align: center;
            border-top: 1px solid rgba(255,255,255,.07);
            flex-shrink: 0;
        }

        /* ========== MAIN ========== */
        .main {
            flex: 1;
            margin-left: var(--sidebar-w);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            transition: margin-left var(--t-slow) var(--ease);
        }

        /* ========== TOPBAR ========== */
        .topbar {
            height: var(--topbar-h);
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            position: sticky;
            top: 0;
            z-index: 900;
            box-shadow: var(--shadow-xs);
        }

        .topbar-left { display: flex; align-items: center; gap: 14px; }

        .menu-toggle {
            display: none;
            width: 36px;
            height: 36px;
            border: none;
            background: var(--surface-2);
            border-radius: var(--r-sm);
            color: var(--text-mid);
            font-size: 1rem;
            cursor: pointer;
            align-items: center;
            justify-content: center;
            transition: all var(--t-fast) var(--ease);
        }
        .menu-toggle:hover { background: var(--surface-3); color: var(--blue); }

        /* Breadcrumb */
        .breadcrumb { display: flex; align-items: center; gap: 6px; }
        .breadcrumb-home {
            width: 28px;
            height: 28px;
            border-radius: var(--r-xs);
            background: linear-gradient(135deg, var(--navy), var(--navy-light));
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255,255,255,.7);
            font-size: .7rem;
        }
        .breadcrumb-sep { color: var(--text-faint); font-size: .75rem; }
        .breadcrumb-current { font-weight: 700; font-size: .9rem; color: var(--text-primary); }

        /* Topbar right */
        .topbar-right { display: flex; align-items: center; gap: 10px; }

        .topbar-action {
            width: 36px;
            height: 36px;
            border: 1px solid var(--border);
            border-radius: var(--r-sm);
            background: var(--surface);
            color: var(--text-muted);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            position: relative;
            transition: all var(--t-fast) var(--ease);
            font-size: .9rem;
        }
        .topbar-action:hover { background: var(--surface-2); color: var(--blue); border-color: var(--blue-light); }
        .topbar-badge {
            position: absolute;
            top: -3px; right: -3px;
            width: 16px; height: 16px;
            background: var(--danger);
            border-radius: 50%;
            border: 2px solid var(--surface);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .55rem;
            font-weight: 700;
            color: #fff;
        }

        .topbar-user {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 6px 10px 6px 6px;
            border: 1px solid var(--border);
            border-radius: 40px;
            cursor: pointer;
            background: var(--surface);
            transition: all var(--t-fast) var(--ease);
        }
        .topbar-user:hover { border-color: var(--blue-light); background: #eff6ff; }
        .topbar-avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--blue), var(--sky));
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: .75rem;
            color: #fff;
        }
        .topbar-name { font-size: .82rem; font-weight: 600; color: var(--text-mid); }

        /* ========== CONTENT AREA ========== */
        .content {
            flex: 1;
            padding: 28px 28px 40px;
            animation: fadeUp .35s var(--ease) both;
        }

        /* Page header */
        .page-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
            margin-bottom: 24px;
        }
        .page-header-title {
            font-family: 'DM Serif Display', Georgia, serif;
            font-size: 1.75rem;
            color: var(--text-primary);
            line-height: 1.2;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .page-header-title-icon {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--blue), var(--sky));
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1rem;
            flex-shrink: 0;
            box-shadow: var(--shadow-blue);
        }
        .page-header-sub { color: var(--text-muted); font-size: .85rem; margin-top: 4px; }

        /* ========== CARDS ========== */
        .card {
            background: var(--surface);
            border-radius: var(--r-lg);
            border: 1px solid var(--border);
            box-shadow: var(--shadow-sm);
            transition: box-shadow var(--t-med) var(--ease), border-color var(--t-med) var(--ease);
        }
        .card:hover { box-shadow: var(--shadow-md); border-color: var(--border-mid); }

        .card-pad { padding: 24px; }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 20px;
            border-bottom: 1px solid var(--border);
        }
        .card-title {
            font-size: .9rem;
            font-weight: 700;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .card-title-icon {
            width: 28px;
            height: 28px;
            border-radius: var(--r-xs);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .8rem;
        }

        /* ========== STAT CARDS ========== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 20px;
        }

        .stat-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--r-lg);
            padding: 20px;
            box-shadow: var(--shadow-sm);
            position: relative;
            overflow: hidden;
            transition: all var(--t-med) var(--ease);
        }
        .stat-card:hover { transform: translateY(-3px); box-shadow: var(--shadow-lg); }
        .stat-card::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 2px;
            border-radius: 0 0 var(--r-lg) var(--r-lg);
        }
        .stat-card.blue::after { background: linear-gradient(90deg, var(--blue), var(--sky)); }
        .stat-card.green::after { background: linear-gradient(90deg, #10b981, #34d399); }
        .stat-card.amber::after { background: linear-gradient(90deg, #f59e0b, #fbbf24); }

        .stat-header { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 14px; }
        .stat-label { font-size: .75rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: .5px; }
        .stat-icon-wrap {
            width: 36px;
            height: 36px;
            border-radius: var(--r-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .9rem;
        }
        .stat-card.blue .stat-icon-wrap   { background: #eff6ff; color: var(--blue); }
        .stat-card.green .stat-icon-wrap  { background: #ecfdf5; color: #059669; }
        .stat-card.amber .stat-icon-wrap  { background: #fffbeb; color: #d97706; }

        .stat-value { font-size: 2rem; font-weight: 800; color: var(--text-primary); line-height: 1.1; }
        .stat-trend { display: flex; align-items: center; gap: 4px; margin-top: 8px; font-size: .72rem; font-weight: 600; }
        .stat-trend.up   { color: #059669; }
        .stat-trend.down { color: var(--danger); }
        .stat-trend-dot  { width: 6px; height: 6px; border-radius: 50%; }
        .stat-trend.up   .stat-trend-dot { background: #10b981; }
        .stat-trend.down .stat-trend-dot { background: var(--danger); }

        /* ========== TWO-COLUMN GRID ========== */
        .two-col { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .two-col-wide { display: grid; grid-template-columns: 1.2fr 1fr; gap: 20px; }

        /* ========== NEWS LIST ========== */
        .news-item {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
            padding: 14px 20px;
            border-bottom: 1px solid var(--border);
            transition: background var(--t-fast) var(--ease);
        }
        .news-item:last-child { border-bottom: none; }
        .news-item:hover { background: var(--surface-2); }
        .news-item-left { flex: 1; min-width: 0; }
        .news-item-title {
            font-size: .85rem;
            font-weight: 600;
            color: var(--text-primary);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-bottom: 4px;
        }
        .news-item-meta { display: flex; align-items: center; gap: 8px; flex-wrap: wrap; }
        .news-item-date { font-size: .72rem; color: var(--text-faint); display: flex; align-items: center; gap: 4px; }
        .news-item-actions { display: flex; gap: 6px; flex-shrink: 0; margin-top: 2px; }

        /* ========== AGENDA ITEM ========== */
        .agenda-item {
            display: flex;
            gap: 14px;
            padding: 14px 20px;
            border-bottom: 1px solid var(--border);
            transition: background var(--t-fast) var(--ease);
        }
        .agenda-item:last-child { border-bottom: none; }
        .agenda-item:hover { background: var(--surface-2); }
        .agenda-date-box {
            width: 44px;
            height: 44px;
            border-radius: var(--r-sm);
            background: linear-gradient(135deg, var(--blue), var(--sky));
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: #fff;
            box-shadow: var(--shadow-blue);
        }
        .agenda-date-day  { font-size: .9rem; font-weight: 800; line-height: 1; }
        .agenda-date-mon  { font-size: .55rem; font-weight: 600; text-transform: uppercase; opacity: .8; }
        .agenda-title { font-size: .85rem; font-weight: 600; color: var(--text-primary); margin-bottom: 3px; }
        .agenda-time  { font-size: .72rem; color: var(--text-muted); display: flex; align-items: center; gap: 4px; }

        /* ========== ACTIVITY FEED ========== */
        .activity-item {
            display: flex;
            gap: 12px;
            padding: 12px 20px;
            border-bottom: 1px solid var(--border);
            align-items: flex-start;
        }
        .activity-item:last-child { border-bottom: none; }
        .activity-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            margin-top: 6px;
            flex-shrink: 0;
        }
        .activity-line {
            position: relative;
        }
        .activity-content { flex: 1; }
        .activity-title { font-size: .82rem; font-weight: 600; color: var(--text-primary); margin-bottom: 2px; }
        .activity-sub   { font-size: .72rem; color: var(--text-muted); display: flex; align-items: center; gap: 6px; flex-wrap: wrap; }
        .activity-time  { color: var(--text-faint); display: flex; align-items: center; gap: 3px; }

        /* ========== BADGES ========== */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 9px;
            border-radius: 20px;
            font-size: .67rem;
            font-weight: 700;
            letter-spacing: .2px;
            text-transform: uppercase;
        }
        .badge-dot { width: 5px; height: 5px; border-radius: 50%; }
        .badge-approved { background: #d1fae5; color: #065f46; }
        .badge-approved .badge-dot { background: #10b981; }
        .badge-rejected { background: #fee2e2; color: #991b1b; }
        .badge-rejected .badge-dot { background: #ef4444; }
        .badge-pending  { background: #fffbeb; color: #92400e; }
        .badge-pending  .badge-dot { background: #f59e0b; }
        .badge-info     { background: #eff6ff; color: #1e40af; }
        .badge-success  { background: #ecfdf5; color: #065f46; }
        .badge-warning  { background: #fffbeb; color: #92400e; }
        .badge-danger   { background: #fee2e2; color: #991b1b; }

        /* ========== BUTTONS ========== */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 14px;
            border-radius: 30px;
            font-size: .78rem;
            font-weight: 600;
            border: 1px solid transparent;
            cursor: pointer;
            text-decoration: none;
            transition: all var(--t-fast) var(--ease);
            font-family: inherit;
        }
        .btn-primary {
            background: linear-gradient(135deg, var(--blue), var(--blue-light));
            color: #fff;
            border-color: var(--blue);
            box-shadow: 0 2px 8px rgba(37,99,235,.3);
        }
        .btn-primary:hover { transform: translateY(-1px); box-shadow: 0 4px 14px rgba(37,99,235,.4); }
        .btn-sm { padding: 5px 12px; font-size: .72rem; }
        .btn-ghost { background: transparent; color: var(--text-muted); border-color: var(--border); }
        .btn-ghost:hover { background: var(--surface-2); color: var(--text-mid); border-color: var(--border-mid); }
        .btn-danger-ghost { background: transparent; color: var(--danger); border-color: #fecaca; }
        .btn-danger-ghost:hover { background: var(--danger-bg); border-color: #fca5a5; }
        .btn-link { padding: 0; border: none; background: none; color: var(--blue); font-size: .78rem; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 4px; }
        .btn-link:hover { color: var(--blue-light); }

        /* ========== HERO BANNER ========== */
        .hero-banner {
            background: linear-gradient(135deg, var(--navy) 0%, var(--navy-light) 50%, #1a3a6b 100%);
            border-radius: var(--r-lg);
            padding: 28px 32px;
            margin-bottom: 20px;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(37,99,235,.25);
        }
        .hero-banner::before {
            content: '';
            position: absolute;
            top: -40px; right: -40px;
            width: 220px; height: 220px;
            background: radial-gradient(circle, rgba(37,99,235,.25) 0%, transparent 70%);
        }
        .hero-banner::after {
            content: '';
            position: absolute;
            bottom: -60px; left: 40%;
            width: 180px; height: 180px;
            background: radial-gradient(circle, rgba(14,165,233,.15) 0%, transparent 70%);
        }
        .hero-content { position: relative; z-index: 1; }
        .hero-greeting { font-size: .8rem; color: rgba(255,255,255,.5); font-weight: 500; margin-bottom: 6px; display: flex; align-items: center; gap: 6px; }
        .hero-name { font-family: 'DM Serif Display', Georgia, serif; font-size: 1.8rem; color: #fff; line-height: 1.2; margin-bottom: 6px; }
        .hero-sub { font-size: .82rem; color: rgba(255,255,255,.55); margin-bottom: 20px; }
        .hero-date {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255,255,255,.1);
            border: 1px solid rgba(255,255,255,.12);
            border-radius: 30px;
            padding: 5px 14px;
            color: rgba(255,255,255,.75);
            font-size: .75rem;
            font-weight: 500;
        }
        .hero-actions { display: flex; gap: 10px; flex-wrap: wrap; margin-top: 20px; }
        .hero-btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 9px 18px;
            border-radius: 30px;
            font-size: .82rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: all var(--t-fast) var(--ease);
            font-family: inherit;
        }
        .hero-btn-primary { background: var(--blue); color: #fff; box-shadow: 0 4px 14px rgba(37,99,235,.4); }
        .hero-btn-primary:hover { background: #1d4ed8; transform: translateY(-1px); box-shadow: 0 6px 18px rgba(37,99,235,.5); }
        .hero-btn-secondary { background: rgba(255,255,255,.1); color: rgba(255,255,255,.85); border: 1px solid rgba(255,255,255,.15); }
        .hero-btn-secondary:hover { background: rgba(255,255,255,.18); }
        .hero-btn-outline { background: transparent; color: rgba(255,255,255,.7); border: 1px solid rgba(255,255,255,.2); }
        .hero-btn-outline:hover { background: rgba(255,255,255,.08); color: #fff; }

        /* ========== ALERTS ========== */
        .alert {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            border-radius: var(--r-md);
            margin-bottom: 16px;
            font-size: .82rem;
            font-weight: 500;
            animation: fadeUp .3s var(--ease) both;
        }
        .alert-success { background: var(--success-bg); color: #065f46; border: 1px solid #a7f3d0; }
        .alert-danger   { background: var(--danger-bg);  color: #991b1b; border: 1px solid #fecaca; }
        .alert-warning  { background: var(--warning-bg); color: #92400e; border: 1px solid #fed7aa; }
        .alert-info     { background: var(--info-bg);    color: #0c4a6e; border: 1px solid #bae6fd; }

        /* ========== TABLE ========== */
        .table-wrap { overflow-x: auto; }
        .table {
            width: 100%;
            border-collapse: collapse;
            font-size: .82rem;
        }
        .table thead tr { background: var(--surface-2); border-bottom: 2px solid var(--border); }
        .table th {
            padding: 10px 14px;
            text-align: left;
            font-size: .7rem;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: .5px;
            white-space: nowrap;
        }
        .table td { padding: 12px 14px; border-bottom: 1px solid var(--border); color: var(--text-mid); vertical-align: middle; }
        .table tbody tr { transition: background var(--t-fast) var(--ease); }
        .table tbody tr:hover { background: var(--surface-2); }
        .table tbody tr:last-child td { border-bottom: none; }

        /* ========== FORM ========== */
        .form-group { margin-bottom: 20px; }
        .form-label { display: block; margin-bottom: 6px; font-size: .8rem; font-weight: 600; color: var(--text-mid); }
        .form-input, .form-select, .form-textarea {
            width: 100%;
            padding: 9px 12px;
            border: 1.5px solid var(--border);
            border-radius: var(--r-sm);
            font-family: inherit;
            font-size: .85rem;
            color: var(--text-primary);
            background: var(--surface);
            transition: all var(--t-fast) var(--ease);
        }
        .form-input:focus, .form-select:focus, .form-textarea:focus {
            outline: none;
            border-color: var(--blue-light);
            box-shadow: 0 0 0 3px rgba(37,99,235,.1);
        }

        /* ========== MODAL ========== */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,.55);
            backdrop-filter: blur(6px);
            z-index: 9999;
            align-items: center;
            justify-content: center;
        }
        .modal-overlay.active { display: flex; }
        .modal {
            background: var(--surface);
            border-radius: 20px;
            max-width: 420px;
            width: 90%;
            box-shadow: var(--shadow-lg);
            animation: scaleIn .25s var(--ease) both;
        }
        .modal-header { padding: 22px 24px; border-bottom: 1px solid var(--border); display: flex; align-items: center; gap: 12px; }
        .modal-icon {
            width: 44px; height: 44px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }
        .modal-icon-danger { background: var(--danger-bg); color: var(--danger); }
        .modal-title { font-size: 1.05rem; font-weight: 700; color: var(--text-primary); }
        .modal-body  { padding: 20px 24px; font-size: .85rem; color: var(--text-muted); line-height: 1.6; }
        .modal-footer { padding: 0 24px 22px; display: flex; gap: 10px; justify-content: flex-end; }
        .modal-cancel  { padding: 8px 20px; border-radius: 30px; border: 1px solid var(--border); background: var(--surface-2); color: var(--text-mid); font-size: .82rem; font-weight: 600; cursor: pointer; font-family: inherit; }
        .modal-confirm { padding: 8px 20px; border-radius: 30px; border: none; background: var(--danger); color: #fff; font-size: .82rem; font-weight: 600; cursor: pointer; font-family: inherit; }

        /* ========== PAGINATION ========== */
        .pagination { display: flex; gap: 6px; justify-content: center; margin-top: 24px; }
        .pagination a, .pagination span {
            width: 34px; height: 34px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: var(--r-sm);
            border: 1px solid var(--border);
            color: var(--text-mid);
            text-decoration: none;
            font-size: .8rem;
            font-weight: 600;
            transition: all var(--t-fast) var(--ease);
            background: var(--surface);
        }
        .pagination a:hover { border-color: var(--blue-light); color: var(--blue); background: #eff6ff; }
        .pagination .active { background: var(--blue); color: #fff; border-color: var(--blue); }

        /* ========== "SEE ALL" FOOTER ========== */
        .card-see-all {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 12px 20px;
            border-top: 1px solid var(--border);
        }

        /* ========== QUICK ACTIONS ========== */
        .quick-actions { display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 20px; }
        .quick-action {
            display: flex;
            align-items: center;
            gap: 7px;
            padding: 9px 16px;
            border-radius: var(--r-sm);
            font-size: .8rem;
            font-weight: 600;
            text-decoration: none;
            transition: all var(--t-fast) var(--ease);
            border: 1.5px solid;
        }
        .qa-primary { background: var(--blue); color: #fff; border-color: var(--blue); box-shadow: var(--shadow-blue); }
        .qa-primary:hover { background: #1d4ed8; transform: translateY(-1px); }
        .qa-outline { background: var(--surface); color: var(--text-mid); border-color: var(--border); }
        .qa-outline:hover { border-color: var(--blue-light); color: var(--blue); background: #eff6ff; }

        /* ========== SECTION TITLE ========== */
        .section-title { font-size: .7rem; font-weight: 700; text-transform: uppercase; letter-spacing: .7px; color: var(--text-faint); margin-bottom: 12px; }

        /* ========== EMPTY STATE ========== */
        .empty-state { text-align: center; padding: 40px 20px; color: var(--text-faint); }
        .empty-state i { font-size: 2rem; margin-bottom: 10px; display: block; }
        .empty-state p { font-size: .85rem; }

        /* ========== ANIMATIONS ========== */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes scaleIn {
            from { opacity: 0; transform: scale(.96); }
            to   { opacity: 1; transform: scale(1); }
        }

        /* ========== RESPONSIVE ========== */
        @media (max-width: 1024px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.active { transform: translateX(0); box-shadow: var(--shadow-lg); }
            .main { margin-left: 0; }
            .menu-toggle { display: flex; }
            .two-col, .two-col-wide { grid-template-columns: 1fr; }
            .stats-grid { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 640px) {
            .content { padding: 16px 16px 32px; }
            .topbar { padding: 0 16px; }
            .stats-grid { grid-template-columns: 1fr; }
            .hero-banner { padding: 22px 20px; }
            .hero-name { font-size: 1.4rem; }
            .topbar-name { display: none; }
        }

        /* ========== SCROLLBAR ========== */
        .sidebar-nav::-webkit-scrollbar { width: 4px; }
        .sidebar-nav::-webkit-scrollbar-thumb { background: rgba(255,255,255,.1); border-radius: 4px; }

        /* ========== UTILITY ========== */
        .flex     { display: flex; }
        .items-center { align-items: center; }
        .justify-between { justify-content: space-between; }
        .gap-2    { gap: 8px; }
        .gap-3    { gap: 12px; }
        .mt-1     { margin-top: 4px; }
        .mt-4     { margin-top: 16px; }
        .mb-4     { margin-bottom: 16px; }
        .text-sm  { font-size: .82rem; }
        .text-muted { color: var(--text-muted); }
        .font-semibold { font-weight: 600; }
        .w-full   { width: 100%; }
        .truncate { white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    </style>
</head>
<body>
<div class="layout">

    <!-- OVERLAY -->
    <div class="overlay" id="overlay"></div>

    <!-- MODAL LOGOUT -->
    <div class="modal-overlay" id="logoutModal">
        <div class="modal">
            <div class="modal-header">
                <div class="modal-icon modal-icon-danger"><i class="fas fa-sign-out-alt"></i></div>
                <div>
                    <div class="modal-title">Konfirmasi Keluar</div>
                </div>
            </div>
            <div class="modal-body">
                Anda akan keluar dari sistem. Sesi aktif akan diakhiri dan Anda diarahkan ke halaman login.
            </div>
            <div class="modal-footer">
                <button class="modal-cancel" id="logoutCancelBtn">Batal</button>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="modal-confirm"><i class="fas fa-sign-out-alt"></i> Keluar</button>
                </form>
            </div>
        </div>
    </div>

    <!-- ========== SIDEBAR ========== -->
    <aside class="sidebar" id="sidebar">

        <!-- Brand -->
        <a href="{{ route('dashboard') }}" class="sidebar-brand">
            <div class="brand-icon"><i class="fas fa-landmark"></i></div>
            <div>
                <div class="brand-text">LPM CMS</div>
                <div class="brand-sub">Staff Panel</div>
            </div>
        </a>

        <!-- User info -->
        <div class="sidebar-user">
            <div class="sidebar-avatar">{{ substr(auth()->user()->name ?? 'A', 0, 1) }}</div>
            <div>
                <div class="sidebar-user-name">{{ auth()->user()->name ?? 'Administrator' }}</div>
            </div>
        </div>

        <!-- Nav -->
        <nav class="sidebar-nav">
            <div class="nav-section-label">Menu Utama</div>

            <a href="{{ route('dashboard') }}" class="nav-item">
                <div class="nav-item-icon"><i class="fas fa-chart-line"></i></div>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('staff.news.create') }}" class="nav-item">
                <div class="nav-item-icon"><i class="fas fa-pen-nib"></i></div>
                <span>Buat Berita</span>
            </a>
            <a href="{{ route('staff.news.index') }}" class="nav-item">
                <div class="nav-item-icon"><i class="fas fa-newspaper"></i></div>
                <span>Data Berita</span>
            </a>
            <a href="{{ route('staff.agenda.index') }}" class="nav-item">
                <div class="nav-item-icon"><i class="fas fa-calendar-alt"></i></div>
                <span>Kelola Agenda</span>
            </a>

            <div class="nav-section-label" style="margin-top:8px;">Akun</div>
            <a href="{{ route('staff.password.edit') }}" class="nav-item">
                <div class="nav-item-icon"><i class="fas fa-key"></i></div>
                <span>Reset Password</span>
            </a>

            <div class="nav-divider"></div>
            <a href="#" class="nav-item logout" id="logoutTrigger">
                <div class="nav-item-icon"><i class="fas fa-sign-out-alt"></i></div>
                <span>Keluar</span>
            </a>
        </nav>
  </aside>

    <!-- ========== MAIN ========== -->
    <div class="main">

        <!-- TOPBAR -->
        <header class="topbar">
            <div class="topbar-left">
                <button class="menu-toggle" id="menuToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <nav class="breadcrumb">
                    <div class="breadcrumb-home"><i class="fas fa-home"></i></div>
                    <span class="breadcrumb-sep"><i class="fas fa-chevron-right" style="font-size:.6rem;"></i></span>
                    <span class="breadcrumb-current">@yield('page-title', 'Panel Administrator')</span>
                </nav>
            </div>
            <div class="topbar-right">
                <div class="topbar-user">
                    <div class="topbar-avatar">{{ substr(auth()->user()->name ?? 'A', 0, 1) }}</div>
                    <span class="topbar-name">{{ auth()->user()->name ?? 'Administrator' }}</span>
                </div>
            </div>
        </header>

        <!-- CONTENT -->
        <main class="content">

            

            <!-- ALERTS -->
            @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
            @endif
            @if(session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                {{ session('error') }}
            </div>
            @endif

            <!-- MAIN YIELD -->
            @yield('content')

            <!-- DEFAULT DASHBOARD -->
            @hasSection('content')
            @else

            <!-- Hero Banner -->
            <div class="hero-banner">
                <div class="hero-content">
                    <div class="hero-greeting"><i class="fas fa-sun"></i> Selamat datang kembali</div>
                    <div class="hero-name">Halo, {{ auth()->user()->name ?? 'Administrator' }}! 👋</div>
                    <div class="hero-sub">Kelola konten dan pantau aktivitas Anda di sini.</div>
                    <div class="hero-date">
                        <i class="fas fa-calendar-day"></i>
                        {{ now()->translatedFormat('l, d F Y') }}
                    </div>
                    <div class="hero-actions">
                        <a href="{{ route('staff.news.create') }}" class="hero-btn hero-btn-primary">
                            <i class="fas fa-pen-nib"></i> Buat Berita
                        </a>
                        <a href="{{ route('staff.agenda.index') }}" class="hero-btn hero-btn-secondary">
                            <i class="fas fa-calendar-plus"></i> Tambah Agenda
                        </a>
                        <a href="{{ route('staff.password.edit') }}" class="hero-btn hero-btn-outline">
                            <i class="fas fa-key"></i> Ganti Password
                        </a>
                    </div>
                </div>
            </div>

            <!-- Stats -->
            <div class="stats-grid">
                <div class="stat-card blue">
                    <div class="stat-header">
                        <div class="stat-label">Total Berita</div>
                        <div class="stat-icon-wrap"><i class="fas fa-newspaper"></i></div>
                    </div>
                    <div class="stat-value">15</div>
                    <div class="stat-trend up">
                        <span class="stat-trend-dot"></span>
                        +1 minggu ini
                    </div>
                </div>
                <div class="stat-card green">
                    <div class="stat-header">
                        <div class="stat-label">Total Agenda</div>
                        <div class="stat-icon-wrap"><i class="fas fa-calendar-check"></i></div>
                    </div>
                    <div class="stat-value">5</div>
                    <div class="stat-trend up">
                        <span class="stat-trend-dot"></span>
                        +1 minggu ini
                    </div>
                </div>
                <div class="stat-card amber">
                    <div class="stat-header">
                        <div class="stat-label">Konten Aktif</div>
                        <div class="stat-icon-wrap"><i class="fas fa-circle-check"></i></div>
                    </div>
                    <div class="stat-value">18</div>
                    <div class="stat-trend up">
                        <span class="stat-trend-dot"></span>
                        Telah disetujui
                    </div>
                </div>
            </div>

            <!-- Two column: News + Agenda -->
            <div class="two-col-wide mb-4">

                <!-- Berita Terbaru -->
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <div class="card-title-icon" style="background:#eff6ff; color:var(--blue);">
                                <i class="fas fa-newspaper"></i>
                            </div>
                            Berita Terbaru
                        </div>
                        <a href="{{ route('staff.news.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Baru
                        </a>
                    </div>

                    <div class="news-item">
                        <div class="news-item-left">
                            <div class="news-item-title">Berita Bla Bla</div>
                            <div class="news-item-meta">
                                <span class="news-item-date"><i class="fas fa-calendar" style="font-size:.65rem;"></i> 27 Mar 2026</span>
                                <span class="badge badge-rejected"><span class="badge-dot"></span>Rejected</span>
                            </div>
                        </div>
                        <div class="news-item-actions">
                            <a href="#" class="btn btn-ghost btn-sm"><i class="fas fa-pen"></i> Edit</a>
                            <a href="#" class="btn btn-danger-ghost btn-sm"><i class="fas fa-trash"></i></a>
                        </div>
                    </div>
                    <div class="news-item">
                        <div class="news-item-left">
                            <div class="news-item-title">Beasiswa 2026 Terbaru</div>
                            <div class="news-item-meta">
                                <span class="news-item-date"><i class="fas fa-calendar" style="font-size:.65rem;"></i> 03 Mar 2026</span>
                                <span class="badge badge-approved"><span class="badge-dot"></span>Approved</span>
                            </div>
                        </div>
                        <div class="news-item-actions">
                            <a href="#" class="btn btn-ghost btn-sm"><i class="fas fa-pen"></i> Edit</a>
                            <a href="#" class="btn btn-danger-ghost btn-sm"><i class="fas fa-trash"></i></a>
                        </div>
                    </div>
                    <div class="news-item">
                        <div class="news-item-left">
                            <div class="news-item-title">Pendalaman AlQuran</div>
                            <div class="news-item-meta">
                                <span class="news-item-date"><i class="fas fa-calendar" style="font-size:.65rem;"></i> 09 Feb 2026</span>
                                <span class="badge badge-approved"><span class="badge-dot"></span>Approved</span>
                            </div>
                        </div>
                        <div class="news-item-actions">
                            <a href="#" class="btn btn-ghost btn-sm"><i class="fas fa-pen"></i> Edit</a>
                            <a href="#" class="btn btn-danger-ghost btn-sm"><i class="fas fa-trash"></i></a>
                        </div>
                    </div>

                    <div class="card-see-all">
                        <a href="{{ route('staff.news.index') }}" class="btn-link">Lihat semua berita <i class="fas fa-arrow-right" style="font-size:.7rem;"></i></a>
                    </div>
                </div>

                <!-- Agenda Mendatang -->
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <div class="card-title-icon" style="background:#ecfdf5; color:#059669;">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            Agenda Mendatang
                        </div>
                        <a href="{{ route('staff.agenda.index') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Baru
                        </a>
                    </div>

                    <div class="agenda-item">
                        <div class="agenda-date-box">
                            <div class="agenda-date-day">10</div>
                            <div class="agenda-date-mon">Mar</div>
                        </div>
                        <div style="flex:1; min-width:0;">
                            <div class="agenda-title">Penetapan Hari Raya 2026</div>
                            <div class="agenda-time"><i class="fas fa-clock" style="font-size:.65rem;"></i> 09:00</div>
                            <div style="margin-top:6px; display:flex; gap:6px;">
                                <span class="badge badge-approved"><span class="badge-dot"></span>Approved</span>
                            </div>
                        </div>
                        <div style="display:flex; gap:5px; flex-direction:column; align-items:flex-end;">
                            <a href="#" class="btn btn-ghost btn-sm"><i class="fas fa-pen"></i></a>
                            <a href="#" class="btn btn-danger-ghost btn-sm"><i class="fas fa-trash"></i></a>
                        </div>
                    </div>

                    <div class="agenda-item">
                        <div class="agenda-date-box" style="background: linear-gradient(135deg, #059669, #34d399);">
                            <div class="agenda-date-day">11</div>
                            <div class="agenda-date-mon">Feb</div>
                        </div>
                        <div style="flex:1; min-width:0;">
                            <div class="agenda-title">Rapat SEMHAS</div>
                            <div class="agenda-time"><i class="fas fa-clock" style="font-size:.65rem;"></i> 00:20</div>
                            <div style="margin-top:6px; display:flex; gap:6px;">
                                <span class="badge badge-approved"><span class="badge-dot"></span>Approved</span>
                            </div>
                        </div>
                        <div style="display:flex; gap:5px; flex-direction:column; align-items:flex-end;">
                            <a href="#" class="btn btn-ghost btn-sm"><i class="fas fa-pen"></i></a>
                            <a href="#" class="btn btn-danger-ghost btn-sm"><i class="fas fa-trash"></i></a>
                        </div>
                    </div>

                    <div class="agenda-item">
                        <div class="agenda-date-box" style="background: linear-gradient(135deg, #d97706, #fbbf24);">
                            <div class="agenda-date-day">05</div>
                            <div class="agenda-date-mon">Feb</div>
                        </div>
                        <div style="flex:1; min-width:0;">
                            <div class="agenda-title">Beasiswa Angkatan 1455</div>
                            <div class="agenda-time"><i class="fas fa-clock" style="font-size:.65rem;"></i> 10:41</div>
                            <div style="margin-top:6px; display:flex; gap:6px;">
                                <span class="badge badge-approved"><span class="badge-dot"></span>Approved</span>
                            </div>
                        </div>
                        <div style="display:flex; gap:5px; flex-direction:column; align-items:flex-end;">
                            <a href="#" class="btn btn-ghost btn-sm"><i class="fas fa-pen"></i></a>
                            <a href="#" class="btn btn-danger-ghost btn-sm"><i class="fas fa-trash"></i></a>
                        </div>
                    </div>

                    <div class="card-see-all">
                        <a href="{{ route('staff.agenda.index') }}" class="btn-link">Lihat semua agenda <i class="fas fa-arrow-right" style="font-size:.7rem;"></i></a>
                    </div>
                </div>
            </div>

            <!-- Aktivitas Terkini -->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="card-title-icon" style="background:#f8fafc; color:var(--text-muted);">
                            <i class="fas fa-clock-rotate-left"></i>
                        </div>
                        Aktivitas Terkini
                    </div>
                </div>

                <div class="activity-item">
                    <div class="activity-dot" style="background:var(--warning);"></div>
                    <div class="activity-content">
                        <div class="activity-title">Penetapan Libur 2026</div>
                        <div class="activity-sub">
                            <span class="badge badge-pending"><span class="badge-dot"></span>Pending</span>
                            <span class="badge badge-info">Agenda</span>
                            <span class="activity-time"><i class="fas fa-clock" style="font-size:.6rem;"></i> 2 days ago</span>
                        </div>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-dot" style="background:var(--danger);"></div>
                    <div class="activity-content">
                        <div class="activity-title">Berita Bla Bla</div>
                        <div class="activity-sub">
                            <span class="badge badge-rejected"><span class="badge-dot"></span>Rejected</span>
                            <span class="badge badge-info">Berita</span>
                            <span class="activity-time"><i class="fas fa-clock" style="font-size:.6rem;"></i> 2 days ago</span>
                        </div>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-dot" style="background:var(--success);"></div>
                    <div class="activity-content">
                        <div class="activity-title">Penetapan Hari Raya 2026</div>
                        <div class="activity-sub">
                            <span class="badge badge-approved"><span class="badge-dot"></span>Approved</span>
                            <span class="badge badge-info">Agenda</span>
                            <span class="activity-time"><i class="fas fa-clock" style="font-size:.6rem;"></i> 2 weeks ago</span>
                        </div>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-dot" style="background:var(--success);"></div>
                    <div class="activity-content">
                        <div class="activity-title">Beasiswa 2026 Terbaru</div>
                        <div class="activity-sub">
                            <span class="badge badge-approved"><span class="badge-dot"></span>Approved</span>
                            <span class="badge badge-info">Berita</span>
                            <span class="activity-time"><i class="fas fa-clock" style="font-size:.6rem;"></i> 3 weeks ago</span>
                        </div>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-dot" style="background:var(--success);"></div>
                    <div class="activity-content">
                        <div class="activity-title">Rapat SEMHAS</div>
                        <div class="activity-sub">
                            <span class="badge badge-approved"><span class="badge-dot"></span>Approved</span>
                            <span class="badge badge-info">Agenda</span>
                            <span class="activity-time"><i class="fas fa-clock" style="font-size:.6rem;"></i> 1 month ago</span>
                        </div>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-dot" style="background:var(--success);"></div>
                    <div class="activity-content">
                        <div class="activity-title">Pendalaman AlQuran</div>
                        <div class="activity-sub">
                            <span class="badge badge-approved"><span class="badge-dot"></span>Approved</span>
                            <span class="badge badge-info">Berita</span>
                            <span class="activity-time"><i class="fas fa-clock" style="font-size:.6rem;"></i> 1 month ago</span>
                        </div>
                    </div>
                </div>

            </div><!-- /card activity -->

            @endif <!-- end hasSection -->
        </main>
    </div><!-- /main -->
</div><!-- /layout -->

<script>
document.addEventListener('DOMContentLoaded', function () {

    // ---- Sidebar toggle (mobile) ----
    const menuBtn = document.getElementById('menuToggle');
    const sidebar  = document.getElementById('sidebar');
    const overlay  = document.getElementById('overlay');

    function openSidebar()  { sidebar.classList.add('active'); overlay.classList.add('active'); document.body.style.overflow = 'hidden'; }
    function closeSidebar() { sidebar.classList.remove('active'); overlay.classList.remove('active'); document.body.style.overflow = ''; }

    if (menuBtn) menuBtn.addEventListener('click', openSidebar);
    if (overlay) overlay.addEventListener('click', closeSidebar);

    window.addEventListener('resize', () => { if (window.innerWidth > 1024) closeSidebar(); });

    // ---- Active nav item ----
    const path = window.location.pathname;
    document.querySelectorAll('.nav-item').forEach(link => {
        const href = link.getAttribute('href');
        if (href && href !== '#' && (path === href || (href.length > 1 && path.startsWith(href)))) {
            link.classList.add('active');
        }
    });

    // ---- Logout modal ----
    const logoutTrigger = document.getElementById('logoutTrigger');
    const logoutModal   = document.getElementById('logoutModal');
    const logoutCancel  = document.getElementById('logoutCancelBtn');

    if (logoutTrigger && logoutModal) {
        logoutTrigger.addEventListener('click', e => { e.preventDefault(); logoutModal.classList.add('active'); document.body.style.overflow = 'hidden'; });
        logoutCancel && logoutCancel.addEventListener('click', () => { logoutModal.classList.remove('active'); document.body.style.overflow = ''; });
        logoutModal.addEventListener('click', e => { if (e.target === logoutModal) { logoutModal.classList.remove('active'); document.body.style.overflow = ''; } });
        document.addEventListener('keydown', e => { if (e.key === 'Escape' && logoutModal.classList.contains('active')) { logoutModal.classList.remove('active'); document.body.style.overflow = ''; } });
    }

    // ---- Auto dismiss alerts ----
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(el => {
            el.style.transition = 'opacity .3s, transform .3s';
            el.style.opacity = '0';
            el.style.transform = 'translateY(-8px)';
            setTimeout(() => el.remove(), 300);
        });
    }, 5000);
});
</script>

</body>
</html>
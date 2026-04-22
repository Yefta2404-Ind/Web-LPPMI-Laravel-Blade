<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin - @yield('title', 'LPMI')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-v2.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,400&display=swap" rel="stylesheet">

    <style>
        /* ============================================================
           VARIABEL DESAIN
        ============================================================ */
        :root {
            --warna-utama:          #1a3a5c;
            --warna-utama-gelap:    #0f2440;
            --warna-utama-cerah:    #2a5080;
            --warna-aksen:          #2d7dd2;
            --warna-aksen-hover:    #1e5fa8;
            --warna-sukses:         #0d9e6e;
            --warna-bahaya:         #e03e3e;
            --warna-peringatan:     #d68910;
            --warna-info:           #1a8fe0;

            --bg-halaman:           #f0f4f8;
            --bg-kartu:             #ffffff;
            --bg-sidebar-atas:      #1a3a5c;
            --bg-sidebar-bawah:     #102a44;

            --teks-utama:           #1a2535;
            --teks-kedua:           #4a5568;
            --teks-lemah:           #8898aa;
            --teks-sangat-lemah:    rgba(255,255,255,0.45);
            --teks-sidebar:         rgba(255,255,255,0.82);

            --garis:                #dde3ec;
            --garis-sidebar:        rgba(255,255,255,0.1);

            --lebar-sidebar:        272px;
            --tinggi-topbar:        68px;
            --radius-sm:            6px;
            --radius:               10px;
            --radius-lg:            14px;
            --bayangan:             0 1px 4px rgba(0,0,0,0.08), 0 4px 16px rgba(0,0,0,0.05);
            --bayangan-md:          0 4px 20px rgba(0,0,0,0.1);
            --bayangan-xl:          0 12px 40px rgba(0,0,0,0.14);
            --transisi:             all 0.22s cubic-bezier(0.4,0,0.2,1);
        }

        /* ============================================================
           RESET & DASAR
        ============================================================ */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'DM Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background-color: var(--bg-halaman);
            color: var(--teks-utama);
            line-height: 1.65;
            min-height: 100vh;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        a { text-decoration: none; color: inherit; }
        ul, ol { list-style: none; }

        /* ============================================================
           TATA LETAK UTAMA
        ============================================================ */
        .layout-utama {
            display: flex;
            min-height: 100vh;
        }

        /* ============================================================
           SIDEBAR
        ============================================================ */
        .sidebar {
            width: var(--lebar-sidebar);
            background: linear-gradient(175deg, var(--bg-sidebar-atas) 0%, var(--bg-sidebar-bawah) 100%);
            color: var(--teks-sidebar);
            display: flex;
            flex-direction: column;
            position: fixed;
            inset: 0 auto 0 0;
            height: 100vh;
            z-index: 1100;
            border-right: 1px solid var(--garis-sidebar);
            box-shadow: 3px 0 12px rgba(0,0,0,0.12);
            overflow: hidden;
        }

        /* Ornamen latar belakang sidebar */
        .sidebar::before {
            content: '';
            position: absolute;
            top: -60px;
            right: -60px;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(45,125,210,0.18) 0%, transparent 70%);
            pointer-events: none;
        }

        /* --- Header Sidebar --- */
        .sidebar-header {
            padding: 0 20px;
            height: var(--tinggi-topbar);
            display: flex;
            align-items: center;
            border-bottom: 1px solid var(--garis-sidebar);
            flex-shrink: 0;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 13px;
            color: white;
        }

        .sidebar-logo-ikon {
            width: 42px;
            height: 42px;
            background: linear-gradient(135deg, var(--warna-aksen), #3d9fe0);
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            color: white;
            flex-shrink: 0;
            box-shadow: 0 2px 8px rgba(45,125,210,0.4);
        }

        .sidebar-logo-nama {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 1.15rem;
            font-weight: 800;
            letter-spacing: -0.3px;
            color: white;
            line-height: 1.2;
        }

        .sidebar-logo-label {
            font-size: 0.72rem;
            color: rgba(255,255,255,0.5);
            font-weight: 400;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        /* --- Navigasi Sidebar --- */
        .sidebar-nav {
            flex: 1;
            padding: 20px 12px;
            overflow-y: auto;
            scrollbar-width: none;
        }
        .sidebar-nav::-webkit-scrollbar { display: none; }

        /* Judul kelompok menu */
        .nav-judul-kelompok {
            font-size: 0.68rem;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: rgba(255,255,255,0.38);
            padding: 0 12px 8px;
            margin-top: 20px;
            margin-bottom: 4px;
            font-weight: 600;
        }
        .nav-judul-kelompok:first-child { margin-top: 0; }

        /* Item navigasi */
        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 14px;
            color: var(--teks-sidebar);
            border-radius: var(--radius-sm);
            margin-bottom: 2px;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transisi);
            position: relative;
            overflow: hidden;
        }

        .nav-item:hover {
            background-color: rgba(255,255,255,0.09);
            color: white;
        }

        .nav-item.aktif {
            background: linear-gradient(90deg, rgba(45,125,210,0.3) 0%, rgba(45,125,210,0.12) 100%);
            color: white;
        }

        .nav-item.aktif::before {
            content: '';
            position: absolute;
            left: 0;
            top: 20%;
            height: 60%;
            width: 3px;
            background: var(--warna-aksen);
            border-radius: 0 3px 3px 0;
        }

        /* Ikon nav item */
        .nav-item .nav-ikon {
            width: 20px;
            text-align: center;
            font-size: 0.95rem;
            flex-shrink: 0;
            opacity: 0.85;
        }
        .nav-item.aktif .nav-ikon,
        .nav-item:hover .nav-ikon { opacity: 1; }

        /* Teks nav item */
        .nav-item .nav-teks { flex: 1; line-height: 1; }

        /* Item dengan submenu */
        .nav-item.ada-submenu::after {
            content: '\f078';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            font-size: 0.65rem;
            opacity: 0.5;
            transition: transform 0.25s ease, opacity 0.2s;
            margin-left: 2px;
        }
        .nav-item.ada-submenu.terbuka::after {
            transform: rotate(180deg);
            opacity: 0.8;
        }

        /* Submenu */
        .submenu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
            margin-bottom: 2px;
        }
        .submenu.terbuka { max-height: 400px; }

        .submenu-kontainer {
            background: rgba(0,0,0,0.18);
            border-radius: var(--radius-sm);
            padding: 4px 0;
            margin: 2px 0 4px;
        }

        .submenu-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 14px 9px 44px;
            color: rgba(255,255,255,0.6);
            font-size: 0.865rem;
            font-weight: 500;
            transition: var(--transisi);
            border-radius: 4px;
            margin: 0 4px;
        }

        .submenu-item:hover {
            background: rgba(255,255,255,0.06);
            color: white;
        }

        .submenu-item.aktif {
            color: white;
            background: rgba(45,125,210,0.22);
        }

        .submenu-item i {
            font-size: 0.78rem;
            width: 14px;
            text-align: center;
            opacity: 0.7;
        }
        .submenu-item.aktif i,
        .submenu-item:hover i { opacity: 1; }

        /* Pemisah */
        .nav-pemisah {
            height: 1px;
            background: var(--garis-sidebar);
            margin: 14px 12px;
        }

        /* Lencana angka */
        .lencana {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--warna-bahaya);
            color: white;
            font-size: 0.7rem;
            font-weight: 700;
            border-radius: 10px;
            min-width: 20px;
            height: 20px;
            padding: 0 5px;
            margin-left: auto;
        }

        /* --- Footer Sidebar --- */
        .sidebar-footer {
            padding: 14px 20px;
            border-top: 1px solid var(--garis-sidebar);
            flex-shrink: 0;
        }
        .sidebar-footer-teks {
            font-size: 0.72rem;
            color: rgba(255,255,255,0.32);
            line-height: 1.5;
        }
        .sidebar-footer-versi {
            font-weight: 600;
            color: rgba(255,255,255,0.45);
            margin-bottom: 2px;
        }

        /* ============================================================
           KONTEN UTAMA
        ============================================================ */
        .konten-utama {
            flex: 1;
            margin-left: var(--lebar-sidebar);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* ============================================================
           BILAH ATAS (TOPBAR)
        ============================================================ */
        .topbar {
            background: white;
            height: var(--tinggi-topbar);
            border-bottom: 1px solid var(--garis);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 1px 0 var(--garis), 0 2px 8px rgba(0,0,0,0.04);
        }

        .topbar-kiri {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        /* Tombol buka/tutup sidebar (mobile) */
        .tombol-menu {
            display: none;
            background: none;
            border: none;
            color: var(--teks-kedua);
            font-size: 1.1rem;
            cursor: pointer;
            padding: 8px;
            border-radius: var(--radius-sm);
            transition: var(--transisi);
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
        }
        .tombol-menu:hover {
            background: var(--bg-halaman);
            color: var(--teks-utama);
        }

        .judul-halaman {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--teks-utama);
            letter-spacing: -0.2px;
        }

        /* Kanan topbar: informasi pengguna */
        .topbar-kanan {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        /* Notifikasi pending */
        .notifikasi-pending {
            display: flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, #fff5e6, #fff0d6);
            border: 1px solid #f5c97a;
            color: #94650a;
            padding: 7px 14px;
            border-radius: 20px;
            font-size: 0.825rem;
            font-weight: 600;
        }
        .notifikasi-pending i { color: var(--warna-peringatan); }

        /* Informasi pengguna */
        .info-pengguna {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .detail-pengguna { text-align: right; }
        .nama-pengguna {
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--teks-utama);
            line-height: 1.3;
        }
        .jabatan-pengguna {
            font-size: 0.75rem;
            color: var(--teks-lemah);
            line-height: 1.3;
        }

        .avatar-pengguna {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--warna-aksen), #3d9fe0);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 700;
            font-size: 0.95rem;
            box-shadow: 0 2px 8px rgba(45,125,210,0.3);
            cursor: pointer;
            transition: var(--transisi);
            flex-shrink: 0;
        }
        .avatar-pengguna:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 14px rgba(45,125,210,0.4);
        }

        /* ============================================================
           AREA KONTEN
        ============================================================ */
        .area-konten {
            padding: 28px 32px;
            flex: 1;
        }

        /* ============================================================
           NOTIFIKASI / PESAN KILAT
        ============================================================ */
        .kontainer-notif { margin-bottom: 20px; }

        .notif {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding: 16px 20px;
            border-radius: var(--radius);
            margin-bottom: 12px;
            animation: masuk 0.35s ease-out;
            border: 1px solid transparent;
        }

        @keyframes masuk {
            from { opacity: 0; transform: translateY(-8px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .notif-sukses {
            background: #edfaf4;
            border-color: #b3e8d3;
            color: #145a3a;
        }
        .notif-error {
            background: #fef2f2;
            border-color: #fccaca;
            color: #8b1a1a;
        }
        .notif-peringatan {
            background: #fffbeb;
            border-color: #fde68a;
            color: #7c4b00;
        }
        .notif-info {
            background: #eff6ff;
            border-color: #bfdbfe;
            color: #1e3a8a;
        }

        .notif-ikon {
            font-size: 1.2rem;
            flex-shrink: 0;
            margin-top: 1px;
        }
        .notif-judul { font-weight: 700; margin-bottom: 2px; font-size: 0.9rem; }
        .notif-pesan { font-size: 0.875rem; line-height: 1.5; }

        .notif ul {
            margin-top: 8px;
            padding-left: 18px;
            list-style: disc;
        }
        .notif ul li { margin-bottom: 3px; font-size: 0.875rem; }

        /* ============================================================
           OVERLAY (mobile)
        ============================================================ */
        .overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.45);
            z-index: 1050;
            backdrop-filter: blur(2px);
        }
        .overlay.aktif { display: block; }

        /* ============================================================
           MODAL KONFIRMASI KELUAR
        ============================================================ */
        .lapisan-modal {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.45);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            backdrop-filter: blur(4px);
        }
        .lapisan-modal.aktif { display: flex; }

        .modal {
            background: white;
            border-radius: var(--radius-lg);
            box-shadow: var(--bayangan-xl);
            max-width: 440px;
            width: 90%;
            overflow: hidden;
            animation: modalMasuk 0.28s cubic-bezier(0.34,1.56,0.64,1);
        }

        @keyframes modalMasuk {
            from { opacity: 0; transform: scale(0.9) translateY(16px); }
            to   { opacity: 1; transform: scale(1) translateY(0); }
        }

        .modal-header {
            padding: 28px 28px 20px;
            display: flex;
            align-items: flex-start;
            gap: 16px;
        }

        .modal-ikon {
            width: 52px;
            height: 52px;
            border-radius: var(--radius);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            flex-shrink: 0;
        }
        .modal-ikon.peringatan {
            background: #fef3c7;
            color: var(--warna-peringatan);
        }

        .modal-info { flex: 1; }
        .modal-judul {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--teks-utama);
            margin-bottom: 6px;
        }
        .modal-deskripsi {
            font-size: 0.9rem;
            color: var(--teks-kedua);
            line-height: 1.6;
        }

        .modal-tindakan {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            padding: 20px 28px;
            border-top: 1px solid var(--garis);
            background: #fafbfc;
        }

        .tombol-modal {
            padding: 10px 24px;
            border-radius: var(--radius-sm);
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: var(--transisi);
            border: 1px solid transparent;
            min-width: 110px;
            font-family: inherit;
        }

        .tombol-batal {
            background: white;
            color: var(--teks-kedua);
            border-color: var(--garis);
        }
        .tombol-batal:hover {
            background: var(--bg-halaman);
            color: var(--teks-utama);
        }

        .tombol-konfirmasi {
            background: var(--warna-bahaya);
            color: white;
        }
        .tombol-konfirmasi:hover {
            background: #c0392b;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(224,62,62,0.3);
        }

        /* ============================================================
           RESPONSIF
        ============================================================ */
        @media (max-width: 1024px) {
            .area-konten { padding: 24px; }
        }

        @media (max-width: 991px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.28s ease;
            }
            .sidebar.aktif { transform: translateX(0); }
            .konten-utama { margin-left: 0; }
            .tombol-menu { display: flex; }
        }

        @media (max-width: 767px) {
            .area-konten { padding: 20px; }
            .topbar { padding: 0 20px; }
            .modal-tindakan { flex-direction: column; }
            .tombol-modal { width: 100%; min-width: auto; }
        }

        @media (max-width: 639px) {
            .detail-pengguna { display: none; }
            .notifikasi-pending span { display: none; }
            .notifikasi-pending { padding: 8px 10px; }
        }

        /* ============================================================
           UTILITAS UMUM
        ============================================================ */
        .animasi-masuk {
            animation: masuk 0.35s ease-out;
        }

        /* Fix TinyMCE */
        .tox-tinymce { border: 1px solid var(--garis) !important; border-radius: var(--radius-sm) !important; }
        .tox .tox-toolbar, .tox .tox-toolbar__primary { background-color: #fff !important; }
        .tox button { all: unset; }
    </style>
</head>
<body>
    <!-- Overlay (mobile) -->
    <div class="overlay" id="overlay"></div>

    <!-- Modal Konfirmasi Keluar -->
    <div class="lapisan-modal" id="modalKeluar">
        <div class="modal">
            <div class="modal-header">
                <div class="modal-ikon peringatan">
                    <i class="fas fa-sign-out-alt"></i>
                </div>
                <div class="modal-info">
                    <div class="modal-judul">Konfirmasi Keluar</div>
                    <div class="modal-deskripsi">
                        Apakah Anda yakin ingin keluar dari sesi ini? Pastikan semua perubahan sudah tersimpan sebelum keluar.
                    </div>
                </div>
            </div>
            <div class="modal-tindakan">
                <button type="button" class="tombol-modal tombol-batal" id="batalKeluar">
                    Batal
                </button>
                <form method="POST" action="{{ route('logout') }}" id="formKeluar">
                    @csrf
                    <button type="submit" class="tombol-modal tombol-konfirmasi">
                        <i class="fas fa-sign-out-alt" style="margin-right:6px;"></i>Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Tata letak utama -->
    <div class="layout-utama">

        <!-- ========================
             SIDEBAR
        ======================== -->
        <aside class="sidebar" id="sidebar">
            <!-- Header -->
            <div class="sidebar-header">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-logo">
                    <div class="sidebar-logo-ikon">
                        <i class="fas fa-layer-group"></i>
                    </div>
                    <div>
                        <div class="sidebar-logo-nama">LPMI Admin</div>
                        <div class="sidebar-logo-label">Panel Kontrol</div>
                    </div>
                </a>
            </div>

            <!-- Navigasi -->
            <nav class="sidebar-nav">

                <!-- MENU UTAMA -->
                <div class="nav-judul-kelompok">Menu Utama</div>

                <a href="{{ route('admin.dashboard') }}"
                   class="nav-item {{ request()->routeIs('admin.dashboard') ? 'aktif' : '' }}">
                    <i class="fas fa-gauge-high nav-ikon"></i>
                    <span class="nav-teks">Dasbor</span>
                </a>
                <a href="{{ route('admin.profile.edit') }}"
   class="nav-item {{ request()->routeIs('admin.profile.*') ? 'aktif' : '' }}">
    <i class="fas fa-user nav-ikon"></i>
    <span class="nav-teks">Profil Saya</span>
</a>

                <div class="nav-pemisah"></div>

                <!-- PENGELOLAAN KONTEN -->
                <div class="nav-judul-kelompok">Pengelolaan Konten</div>

                <!-- Agenda -->
                <div class="nav-item ada-submenu {{ request()->routeIs('admin.agenda.*') ? 'aktif terbuka' : '' }}"
                     data-submenu="submenu-agenda">
                    <i class="fas fa-calendar-days nav-ikon"></i>
                    <span class="nav-teks">Agenda</span>
                </div>
                <div class="submenu {{ request()->routeIs('admin.agenda.*') ? 'terbuka' : '' }}" id="submenu-agenda">
                    <div class="submenu-kontainer">
                        <a href="{{ route('admin.agenda.index') }}"
                           class="submenu-item {{ request()->routeIs('admin.agenda.index') ? 'aktif' : '' }}">
                            <i class="fas fa-list"></i>
                            <span>Semua Agenda</span>
                        </a>
                    </div>
                </div>
                <a href="{{ route('admin.news.index') }}"
   class="nav-item {{ request()->routeIs('admin.news.*') ? 'aktif' : '' }}">
    <i class="fas fa-newspaper nav-ikon"></i>
    <span class="nav-teks">Berita</span>
</a>

                <!-- Spanduk Utama -->
                <a href="{{ route('admin.hero-banners.index') }}"
                   class="nav-item {{ request()->routeIs('admin.hero-banners.*') ? 'aktif' : '' }}">
                    <i class="fas fa-image nav-ikon"></i>
                    <span class="nav-teks">Spanduk Utama</span>
                </a>

                <a href="{{ route('admin.popup.index') }}"
                   class="nav-item {{ request()->routeIs('admin.hero-banners.*') ? 'aktif' : '' }}">
                    <i class="fas fa-image nav-ikon"></i>
                    <span class="nav-teks">Menu Pop Up</span>
                </a>

                <!-- Struktur Organisasi -->
                <div class="nav-item ada-submenu {{ request()->routeIs('admin.organization-structure.*') ? 'aktif terbuka' : '' }}"
                     data-submenu="submenu-org">
                    <i class="fas fa-sitemap nav-ikon"></i>
                    <span class="nav-teks">Organisasi</span>
                </div>
                <div class="submenu {{ request()->routeIs('admin.organization-structure.*') ? 'terbuka' : '' }}" id="submenu-org">
                    <div class="submenu-kontainer">
                        <a href="{{ route('admin.organization-structure.index') }}"
                           class="submenu-item {{ request()->routeIs('admin.organization-structure.index') ? 'aktif' : '' }}">
                            <i class="fas fa-list"></i>
                            <span>Semua Struktur</span>
                        </a>
                    </div>
                </div>

                <!-- Survei -->
                <div class="nav-item ada-submenu {{ request()->routeIs('admin.surveys.*') ? 'aktif terbuka' : '' }}"
                     data-submenu="submenu-survei">
                    <i class="fas fa-chart-bar nav-ikon"></i>
                    <span class="nav-teks">Survei</span>
                </div>
                <div class="submenu {{ request()->routeIs('admin.surveys.*') ? 'terbuka' : '' }}" id="submenu-survei">
                    <div class="submenu-kontainer">
                        <a href="{{ route('admin.surveys.index') }}"
                           class="submenu-item {{ request()->routeIs('admin.surveys.index') ? 'aktif' : '' }}">
                            <i class="fas fa-list"></i>
                            <span>Semua Survei</span>
                        </a>
                    </div>
                </div>

                <div class="nav-pemisah"></div>

                <!-- PENGATURAN -->
                <div class="nav-judul-kelompok">Pengaturan</div>

                <!-- Pengaturan Staf -->
                <a href="{{ route('admin.staff.index') }}"
                   class="nav-item {{ request()->routeIs('admin.staff.*') ? 'aktif' : '' }}">
                    <i class="fas fa-users nav-ikon"></i>
                    <span class="nav-teks">Pengelolaan Staf</span>
                </a>

                <!-- Menu & Halaman -->
                <div class="nav-item ada-submenu {{ request()->routeIs('admin.menus.*') || request()->routeIs('admin.pages.*') ? 'aktif terbuka' : '' }}"
                     data-submenu="submenu-menu-halaman">
                    <i class="fas fa-th-large nav-ikon"></i>
                    <span class="nav-teks">Menu & Halaman</span>
                </div>
                <div class="submenu {{ request()->routeIs('admin.menus.*') || request()->routeIs('admin.pages.*') ? 'terbuka' : '' }}" id="submenu-menu-halaman">
                    <div class="submenu-kontainer">
                        <a href="{{ route('admin.menus.index') }}"
                           class="submenu-item {{ request()->routeIs('admin.menus.*') ? 'aktif' : '' }}">
                            <i class="fas fa-bars"></i>
                            <span>Kelola Menu</span>
                        </a>
                        <a href="{{ route('admin.pages.index') }}"
                           class="submenu-item {{ request()->routeIs('admin.pages.*') ? 'aktif' : '' }}">
                            <i class="fas fa-file-lines"></i>
                            <span>Kelola Halaman</span>
                        </a>
                    </div>
                </div>

                <!-- Pengaturan Situs -->
                <a href="{{ route('admin.settings.edit') }}"
                   class="nav-item {{ request()->routeIs('admin.settings.*') ? 'aktif' : '' }}">
                    <i class="fas fa-sliders nav-ikon"></i>
                    <span class="nav-teks">Pengaturan Situs</span>
                </a>

                <div class="nav-pemisah"></div>

                <!-- Tombol Keluar -->
                <div class="nav-item" id="picu-keluar" style="color: rgba(255,180,180,0.85);">
                    <i class="fas fa-right-from-bracket nav-ikon"></i>
                    <span class="nav-teks">Keluar</span>
                </div>

            </nav>

            <!-- Footer -->
            <div class="sidebar-footer">
                <div class="sidebar-footer-versi">LPMI Admin v1.0</div>
                <div class="sidebar-footer-teks">© {{ date('Y') }} Lembaga Pers Mahasiswa Indonesia</div>
            </div>
        </aside>

        <!-- ========================
             KONTEN UTAMA
        ======================== -->
        <div class="konten-utama">

            <!-- Bilah Atas -->
            <header class="topbar">
                <div class="topbar-kiri">
                    <button class="tombol-menu" id="tombol-menu" aria-label="Buka menu">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1 class="judul-halaman">@yield('judul-halaman', 'Dasbor')</h1>
                </div>

                <div class="topbar-kanan">
                    @php
                        $totalPending =
                            ($pendingAgendaCount ?? 0) +
                            ($pendingVideosCount ?? 0) +
                            ($pendingBannerCount ?? 0) +
                            ($pendingSurveysCount ?? 0);
                    @endphp

                    @if($totalPending > 0)
                    <div class="notifikasi-pending">
                        <i class="fas fa-bell"></i>
                        <span>{{ $totalPending }} Menunggu</span>
                    </div>
                    @endif

                    <div class="info-pengguna">
                        <div class="detail-pengguna">
                            <div class="nama-pengguna">{{ Auth::user()->name ?? 'Pengguna Admin' }}</div>
                            <div class="jabatan-pengguna">Administrator</div>
                        </div>
                        <div class="avatar-pengguna" title="{{ Auth::user()->name ?? 'Admin' }}">
                            {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                        </div>
                    </div>
                </div>
            </header>

            <!-- Area Konten -->
            <main class="area-konten">

                <!-- Notifikasi / Pesan Kilat -->
                <div class="kontainer-notif">
                    @if(session('success'))
                    <div class="notif notif-sukses animasi-masuk">
                        <i class="fas fa-circle-check notif-ikon"></i>
                        <div>
                            <div class="notif-judul">Berhasil!</div>
                            <div class="notif-pesan">{{ session('success') }}</div>
                        </div>
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="notif notif-error animasi-masuk">
                        <i class="fas fa-circle-xmark notif-ikon"></i>
                        <div>
                            <div class="notif-judul">Terjadi Kesalahan!</div>
                            <div class="notif-pesan">{{ session('error') }}</div>
                        </div>
                    </div>
                    @endif

                    @if(session('warning'))
                    <div class="notif notif-peringatan animasi-masuk">
                        <i class="fas fa-triangle-exclamation notif-ikon"></i>
                        <div>
                            <div class="notif-judul">Perhatian!</div>
                            <div class="notif-pesan">{{ session('warning') }}</div>
                        </div>
                    </div>
                    @endif

                    @if(session('info'))
                    <div class="notif notif-info animasi-masuk">
                        <i class="fas fa-circle-info notif-ikon"></i>
                        <div>
                            <div class="notif-judul">Informasi</div>
                            <div class="notif-pesan">{{ session('info') }}</div>
                        </div>
                    </div>
                    @endif

                    @if($errors->any())
                    <div class="notif notif-error animasi-masuk">
                        <i class="fas fa-circle-xmark notif-ikon"></i>
                        <div>
                            <div class="notif-judul">Validasi Gagal</div>
                            <div class="notif-pesan">Mohon perbaiki kesalahan berikut ini:</div>
                            <ul>
                                @foreach($errors->all() as $kesalahan)
                                <li>{{ $kesalahan }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Konten Halaman -->
                <div class="animasi-masuk">
                    @yield('content')
                </div>

            </main>
        </div><!-- /.konten-utama -->
    </div><!-- /.layout-utama -->

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            /* --- Elemen --- */
            const tombolMenu   = document.getElementById('tombol-menu');
            const sidebar      = document.getElementById('sidebar');
            const overlay      = document.getElementById('overlay');
            const modalKeluar  = document.getElementById('modalKeluar');
            const picuKeluar   = document.getElementById('picu-keluar');
            const batalKeluar  = document.getElementById('batalKeluar');
            const formKeluar   = document.getElementById('formKeluar');

            /* --- Fungsi buka/tutup sidebar (mobile) --- */
            function bukaSidebar() {
                sidebar.classList.add('aktif');
                overlay.classList.add('aktif');
                document.body.style.overflow = 'hidden';
            }

            function tutupSidebar() {
                sidebar.classList.remove('aktif');
                overlay.classList.remove('aktif');
                document.body.style.overflow = '';
            }

            if (tombolMenu) tombolMenu.addEventListener('click', function () {
                sidebar.classList.contains('aktif') ? tutupSidebar() : bukaSidebar();
            });

            if (overlay) overlay.addEventListener('click', tutupSidebar);

            /* --- Submenu (toggle buka/tutup) --- */
            document.querySelectorAll('.nav-item.ada-submenu').forEach(function (item) {
                item.addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();

                    const idSubmenu = this.getAttribute('data-submenu');
                    const submenu   = document.getElementById(idSubmenu);
                    const sedangTerbuka = this.classList.contains('terbuka');

                    /* Tutup semua submenu lain */
                    document.querySelectorAll('.nav-item.ada-submenu').forEach(function (lain) {
                        if (lain !== item) {
                            lain.classList.remove('terbuka');
                            const idLain = lain.getAttribute('data-submenu');
                            const submenuLain = document.getElementById(idLain);
                            if (submenuLain) submenuLain.classList.remove('terbuka');
                        }
                    });

                    /* Toggle submenu saat ini */
                    this.classList.toggle('terbuka', !sedangTerbuka);
                    if (submenu) submenu.classList.toggle('terbuka', !sedangTerbuka);
                });
            });

            /* --- Aktifkan menu/submenu sesuai URL saat ini --- */
            function tandaiMenuAktif() {
                const path = window.location.pathname;

                document.querySelectorAll('.submenu-item').forEach(function (item) {
                    const href = item.getAttribute('href');
                    if (href && (path === href || path.startsWith(href + '/'))) {
                        item.classList.add('aktif');
                        const kontainerSubmenu = item.closest('.submenu');
                        if (kontainerSubmenu) {
                            kontainerSubmenu.classList.add('terbuka');
                            const idSubmenu = kontainerSubmenu.getAttribute('id');
                            const picu = document.querySelector('[data-submenu="' + idSubmenu + '"]');
                            if (picu) picu.classList.add('aktif', 'terbuka');
                        }
                    }
                });
            }
            tandaiMenuAktif();

            /* --- Modal Keluar --- */
            if (picuKeluar) picuKeluar.addEventListener('click', function () {
                modalKeluar.classList.add('aktif');
                document.body.style.overflow = 'hidden';
            });

            function tutupModalKeluar() {
                modalKeluar.classList.remove('aktif');
                document.body.style.overflow = '';
            }

            if (batalKeluar) batalKeluar.addEventListener('click', tutupModalKeluar);

            if (modalKeluar) modalKeluar.addEventListener('click', function (e) {
                if (e.target === modalKeluar) tutupModalKeluar();
            });

            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape' && modalKeluar.classList.contains('aktif')) tutupModalKeluar();
            });

            /* Indikator loading saat submit form keluar */
            if (formKeluar) formKeluar.addEventListener('submit', function () {
                const tombol = this.querySelector('button[type="submit"]');
                if (tombol) {
                    tombol.innerHTML = '<i class="fas fa-spinner fa-spin" style="margin-right:6px;"></i>Sedang keluar…';
                    tombol.disabled = true;
                }
            });

            /* --- Responsif: tutup sidebar saat layar diperbesar --- */
            window.addEventListener('resize', function () {
                if (window.innerWidth > 991) tutupSidebar();
            });

            /* --- Sembunyikan notifikasi otomatis setelah 6 detik --- */
            setTimeout(function () {
                document.querySelectorAll('.notif').forEach(function (el) {
                    el.style.transition = 'opacity 0.4s ease, margin-bottom 0.4s ease, padding 0.4s ease, max-height 0.4s ease';
                    el.style.opacity   = '0';
                    el.style.overflow  = 'hidden';
                    setTimeout(function () { el.remove(); }, 420);
                });
            }, 6000);
        });
    </script>

    @stack('scripts')
</body>
</html>
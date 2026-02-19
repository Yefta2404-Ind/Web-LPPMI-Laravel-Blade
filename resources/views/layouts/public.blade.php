<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LPPMI - Universitas Gunung Kidul')</title>
    <meta name="description" content="Lembaga Pengendalian dan Penjaminan Mutu Internal Universitas Gunung Kidul. Meningkatkan kualitas pendidikan melalui sistem penjaminan mutu berkelanjutan.">
    
    <!-- ========== EXTERNAL DEPENDENCIES ========== -->
    <!-- Bootstrap 5 CSS (WAJIB) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome (WAJIB) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Page-specific styles -->
    @yield('styles')
    
    <!-- ========== CUSTOM GLOBAL STYLES ========== -->
    <style>
        :root {
            --primary: #003366;
            --secondary: #d4af37;
            --accent: #2563eb;
            --text-dark: #111827;
            --text-light: #6b7280;
            --white: #ffffff;
            --gray-light: #f8fafc;
            --border: #e5e7eb;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.08);
            --shadow-md: 0 3px 6px rgba(0,0,0,0.1);
            --shadow-lg: 0 8px 20px rgba(0,0,0,0.12);
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
            font-family: 'Segoe UI', 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
            background: var(--gray-light);
            overflow-x: hidden;
        }

        .site-container {
            width: 100%;
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* ================= FIXED SITE HEADER ================= */
        .site-header {
            background: var(--primary);
            border-bottom: 3px solid var(--secondary);
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: var(--shadow-md);
        }

        .header-container {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 12px 0;
            min-height: 80px;
        }

        .menu-toggle {
            display: none;
            background: none;
            border: none;
            color: var(--white);
            font-size: 24px;
            cursor: pointer;
            padding: 8px;
            width: 44px;
            height: 44px;
            border-radius: 4px;
            transition: background-color 0.3s;
            flex-shrink: 0;
            order: 1;
        }

        .menu-toggle:hover {
            background-color: rgba(255,255,255,0.1);
        }

        .logo {
            width: 60px;
            height: 60px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            order: 2;
        }

        .logo svg {
            width: 100%;
            height: 100%;
            display: block;
        }

        .header-title {
            flex: 1;
            min-width: 0;
            order: 3;
            padding-left: 16px;
            border-left: 2px solid var(--secondary);
        }

        .header-title h1 {
            color: var(--white);
            font-size: 16px;
            font-weight: 700;
            line-height: 1.3;
            margin: 0 0 4px 0;
            text-transform: uppercase;
        }

        .header-title span {
            color: rgba(255,255,255,0.9);
            font-size: 14px;
            font-weight: 500;
            display: block;
        }

        /* ================= NAVIGATION ================= */
        .main-nav {
            background: #002244;
            transition: all 0.3s ease;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            flex-wrap: wrap;
            margin-bottom: 0;
            padding-left: 0;
        }

        .nav-link {
            color: var(--white);
            text-decoration: none;
            padding: 16px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-weight: 600;
            font-size: 15px;
            transition: background 0.3s;
            border-right: 1px solid rgba(255,255,255,0.1);
            white-space: nowrap;
        }

        .nav-link:hover,
        .nav-link.active {
            background: rgba(255,255,255,0.1);
            color: var(--white) !important;
        }

        .dropdown {
            position: relative;
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            background: white;
            min-width: 220px;
            display: none;
            list-style: none;
            padding: 8px 0;
            box-shadow: var(--shadow-lg);
            border-radius: 6px;
            z-index: 1000;
            margin: 0;
            border: none;
        }

        .dropdown-menu li a {
            display: block;
            padding: 10px 20px;
            color: #333;
            text-decoration: none;
            white-space: nowrap;
            transition: background 0.3s;
        }

        .dropdown-menu li a:hover {
            background: #f1f5f9;
            color: #333;
        }

        .dropdown-toggle::after {
            content: '';
            font-size: 10px;
            margin-left: 8px;
            transition: transform 0.3s;
        }

        .dropdown.active .dropdown-toggle::after {
            transform: rotate(180deg);
        }

        @media (min-width: 769px) {
            .dropdown:hover .dropdown-menu {
                display: block;
            }
        }

        /* ================= HERO SECTION ================= */
        .hero-section {
            position: relative;
            overflow: hidden;
            color: #fff;
            min-height: 50vh;
            display: flex;
            align-items: center;
            margin-bottom: 0 !important;
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
            background-position: center center;
            background-repeat: no-repeat;
            opacity: 0;
            transition: opacity 1s ease-in-out;
            transform-origin: center center;
        }

        .hero-slide.active {
            opacity: 1;
        }

        .hero-overlay {
            position: relative;
            z-index: 2;
            width: 100%;
            padding: 40px 20px;
            background: linear-gradient(
                135deg,
                rgba(0, 51, 102, 0.75) 0%,
                rgba(0, 34, 68, 0.85) 100%
            );
            min-height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-content {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
            width: 100%;
            text-align: center;
        }

        .hero-title {
            font-size: 1.8rem;
            font-weight: 700;
            line-height: 1.3;
            margin-bottom: 0;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
        }

        /* ================= AGENDA 1 BARIS HORIZONTAL KECIL ================= */
        .agenda-section {
    background: linear-gradient(
        180deg,
        #f8fafc 0%,
        #ffffff 100%
    );
    padding: 60px 0;
    border-bottom: 1px solid var(--border);
}
/* ================= AGENDA SLIDER IMPROVED ================= */
.agenda-slider-container {
    position: relative;
    display: flex;
    align-items: center;
    gap: 15px;
    margin: 20px 0;
}

.slider-arrow {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: white;
    border: 1px solid var(--border);
    color: var(--primary);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    flex-shrink: 0;
    box-shadow: var(--shadow-sm);
    z-index: 2;
}

.slider-arrow:hover {
    background: var(--primary);
    color: white;
    border-color: var(--primary);
    transform: scale(1.1);
}

.slider-arrow:disabled {
    opacity: 0.5;
    cursor: not-allowed;
    pointer-events: none;
}

.agenda-horizontal-container {
    flex: 1;
    overflow: hidden;
    position: relative;
    border-radius: 12px;
}

.agenda-horizontal-wrapper {
    display: flex;
    gap: 20px;
    transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    will-change: transform;
}

.agenda-card-small {
    flex: 0 0 calc((100% - 40px) / 3);
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--border);
    transition: all 0.3s ease;
    cursor: pointer;
    display: flex;
    height: 160px;
}

.agenda-card-small:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-lg);
    border-color: var(--primary);
}

.agenda-date-small {
    background: var(--primary);
    color: white;
    padding: 15px 12px;
    min-width: 85px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
}

.date-day-small {
    font-size: 28px;
    font-weight: 700;
    line-height: 1;
    margin-bottom: 4px;
}

.date-month-small {
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    opacity: 0.9;
}

.date-year-small {
    font-size: 11px;
    opacity: 0.8;
    margin-top: 2px;
}

.agenda-content-small {
    padding: 15px;
    flex: 1;
    display: flex;
    flex-direction: column;
    background: white;
}

.agenda-title-small {
    font-size: 14px;
    font-weight: 600;
    color: var(--text-dark);
    line-height: 1.4;
    margin-bottom: 10px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    min-height: 40px;
}

.agenda-meta-small {
    margin-bottom: 8px;
}

.meta-item-small {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 12px;
    color: var(--text-light);
    margin-bottom: 4px;
}

.meta-item-small i {
    color: var(--primary);
    font-size: 10px;
    width: 14px;
}

.agenda-status-small {
    display: inline-flex;
    align-items: center;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 10px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    align-self: flex-start;
}

.status-upcoming {
    background: #e3f2fd;
    color: #1976d2;
}

.status-ongoing {
    background: #fff3e0;
    color: #f57c00;
}

.status-completed {
    background: #eeeeee;
    color: #616161;
}

/* Slider Indicators */
.slider-indicators {
    display: flex;
    justify-content: center;
    gap: 8px;
    margin-top: 20px;
}

.slider-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: var(--border);
    cursor: pointer;
    transition: all 0.3s ease;
}

.slider-dot.active {
    background: var(--primary);
    width: 24px;
    border-radius: 4px;
}

/* Modal Improved */
.agenda-modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(5px);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 1100;
    padding: 20px;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.agenda-modal-overlay.active {
    display: flex;
    opacity: 1;
}

.agenda-modal-content {
    background: white;
    border-radius: 24px;
    max-width: 500px;
    width: 100%;
    max-height: 80vh;
    overflow-y: auto;
    box-shadow: var(--shadow-lg);
    position: relative;
    transform: translateY(20px) scale(0.95);
    transition: all 0.3s ease;
}

.agenda-modal-overlay.active .agenda-modal-content {
    transform: translateY(0) scale(1);
}

.modal-close {
    position: absolute;
    top: 15px;
    right: 15px;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: var(--gray-light);
    border: none;
    font-size: 24px;
    color: var(--text-light);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    z-index: 2;
}

.modal-close:hover {
    background: var(--primary);
    color: white;
    transform: rotate(90deg);
}

.modal-header {
    background: linear-gradient(135deg, var(--primary), #001a33);
    color: white;
    padding: 30px 25px 25px;
    position: relative;
}

.modal-date-box {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    padding: 15px 20px;
    border-radius: 16px;
    display: inline-flex;
    flex-direction: column;
    align-items: center;
    margin-bottom: 15px;
}

.modal-day {
    font-size: 36px;
    font-weight: 700;
    line-height: 1;
}

.modal-month-year {
    font-size: 14px;
    opacity: 0.9;
    margin-top: 4px;
}

.modal-title {
    font-size: 22px;
    font-weight: 600;
    line-height: 1.3;
    margin: 0;
}

.modal-body {
    padding: 25px;
}

.modal-info {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
    margin-bottom: 20px;
    padding: 15px;
    background: var(--gray-light);
    border-radius: 16px;
}

.modal-info-item {
    display: flex;
    align-items: center;
    gap: 10px;
    color: var(--text-dark);
    font-size: 14px;
}

.modal-info-item i {
    color: var(--primary);
    font-size: 16px;
    width: 20px;
}

.modal-description {
    line-height: 1.6;
    color: var(--text-dark);
}

.modal-description p {
    margin-bottom: 10px;
}

.modal-footer {
    padding: 20px 25px;
    background: var(--gray-light);
    border-top: 1px solid var(--border);
    display: flex;
    justify-content: flex-end;
}

.modal-status {
    padding: 6px 16px;
    border-radius: 30px;
    font-size: 12px;
    font-weight: 600;
}

/* Responsive */
@media (max-width: 992px) {
    .agenda-card-small {
        flex: 0 0 calc((100% - 20px) / 2);
    }
}

@media (max-width: 768px) {
    .agenda-slider-container {
        gap: 10px;
    }
    
    .slider-arrow {
        width: 32px;
        height: 32px;
        font-size: 12px;
    }
    
    .agenda-card-small {
        flex: 0 0 100%;
        height: 140px;
    }
    
    .agenda-date-small {
        min-width: 70px;
        padding: 12px 8px;
    }
    
    .date-day-small {
        font-size: 22px;
    }
    
    .agenda-title-small {
        font-size: 13px;
        min-height: 36px;
    }
    
    .agenda-modal-content {
        margin: 10px;
    }
    
    .modal-header {
        padding: 25px 20px 20px;
    }
    
    .modal-day {
        font-size: 30px;
    }
    
    .modal-title {
        font-size: 18px;
    }
    
    .modal-info {
        grid-template-columns: 1fr;
        gap: 10px;
    }
}

@media (max-width: 480px) {
    .agenda-card-small {
        height: 130px;
    }
    
    .agenda-date-small {
        min-width: 60px;
        padding: 10px 5px;
    }
    
    .date-day-small {
        font-size: 20px;
    }
    
    .date-month-small {
        font-size: 10px;
    }
    
    .agenda-content-small {
        padding: 10px;
    }
    
    .agenda-title-small {
        font-size: 12px;
        margin-bottom: 6px;
    }
    
    .meta-item-small {
        font-size: 10px;
    }
}
        .agenda-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 35px;
}

        .agenda-title {
    display: flex;
    align-items: center;
    gap: 14px;
    font-size: 26px;
    font-weight: 700;
    color: var(--primary);
    margin: 0;
}

       .agenda-title i {
    font-size: 22px;
    color: var(--secondary);
}

        .view-all-btn {
            background: none;
            border: none;
            color: var(--primary);
            font-size: 13px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 5px;
            cursor: pointer;
            padding: 5px 10px;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .view-all-btn:hover {
            background: rgba(0, 51, 102, 0.05);
            color: var(--primary);
        }

        /* Container untuk 1 baris horizontal */
        .agenda-horizontal-container {
                    overflow: hidden;
    position: relative;
            
        }

        .agenda-horizontal-wrapper {
    display: flex;
    gap: 25px;
    transition: transform 0.5s ease;
}

        /* Agenda Card Kecil */
        .agenda-card-small {
    background: var(--white);
    border-radius: 14px;
    overflow: hidden;
    width: 100%;
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--border);
    transition: all 0.3s ease;
    cursor: pointer;
    height: 160px;
    display: flex;
    flex: 0 0 calc((100% - 50px) / 3);
}

        .agenda-card-small:hover {
    transform: translateY(-6px);
    box-shadow: var(--shadow-lg);
    border-color: var(--primary);
}

        .agenda-date-small {
    background: var(--primary);
    color: var(--white);
    padding: 18px;
    min-width: 90px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

        .date-day-small {
            font-size: 26px;
            font-weight: 700;
            text-transform: uppercase;
            line-height: 1;
            margin-bottom: 2px;
            letter-spacing: 1px;
        }

        .date-month-small {
            font-size: 11px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            opacity: 0.9;
        }

        .date-year-small {
            font-size: 11px;
            opacity: 0.8;
            margin-top: 1px;
        }

        .agenda-content-small {
            padding: 18px;
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .agenda-title-small {
            font-size: 15px;
            font-weight: 600;
            color: var(--text-dark);
            line-height: 1.4;
            margin-bottom: 12px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .agenda-meta-small {
            display: flex;
            flex-direction: column;
            gap: 4px;
            margin-top: auto;
        }

        .meta-item-small {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 14px;
            color: var(--text-light);
        }

        .meta-item-small i {
            color: var(--primary);
            font-size: 10px;
            width: 12px;
            flex-shrink: 0;
        }

        .agenda-status-small {
            display: inline-flex;
            align-items: center;
            padding: 4px 12px;
            border-radius: 14px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            margin-top: 5px;
            align-self: flex-start;
        }

        .status-upcoming {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .status-ongoing {
            background: #fff3e0;
            color: #f57c00;
        }

        .status-completed {
            background: #f5f5f5;
            color: #616161;
        }

        /* No Agenda State */
        .no-agenda-small {
            text-align: center;
            padding: 20px;
            color: var(--text-light);
            font-size: 13px;
            width: 100%;
        }

        /* Scrollbar Styling */
        .agenda-horizontal-container::-webkit-scrollbar {
            height: 4px;
        }

        .agenda-horizontal-container::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 2px;
        }

        .agenda-horizontal-container::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 2px;
        }

        .agenda-horizontal-container::-webkit-scrollbar-thumb:hover {
            background: #a1a1a1;
        }

        /* Style untuk arrow navigation */
        .agenda-nav-arrows {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 10px;
        }

        .nav-arrow {
            background: var(--white);
            border: 1px solid var(--border);
            color: var(--primary);
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 12px;
            transition: all 0.3s ease;
        }

        .nav-arrow:hover {
            background: var(--primary);
            color: var(--white);
            border-color: var(--primary);
        }

        /* Style kosong jika tidak ada agenda */
        .agenda-empty-state {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            color: var(--text-light);
            font-size: 14px;
            padding: 20px;
            background: var(--gray-light);
            border-radius: 8px;
            border: 1px dashed var(--border);
        }

        .agenda-empty-state i {
            font-size: 18px;
        }

        /* ================= AGENDA MODAL MINIMALIS ================= */
        .agenda-modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1100;
            padding: 20px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .agenda-modal-overlay.active {
            display: flex;
            opacity: 1;
        }

        .agenda-modal-minimal {
            background: var(--white);
            border-radius: 12px;
            max-width: 500px;
            width: 100%;
            max-height: 80vh;
            overflow-y: auto;
            box-shadow: var(--shadow-lg);
            position: relative;
            transform: translateY(20px);
            transition: transform 0.3s ease;
        }

        .agenda-modal-overlay.active .agenda-modal-minimal {
            transform: translateY(0);
        }

        .modal-close-minimal {
            position: absolute;
            top: 12px;
            right: 12px;
            background: none;
            border: none;
            font-size: 20px;
            color: var(--text-light);
            cursor: pointer;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            z-index: 2;
            transition: all 0.3s ease;
        }

        .modal-close-minimal:hover {
            background: var(--gray-light);
            color: var(--text-dark);
        }

        .modal-header-minimal {
            background: var(--primary);
            color: var(--white);
            padding: 20px;
            border-radius: 12px 12px 0 0;
            position: relative;
        }

        .modal-date-minimal {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 10px;
        }

        .modal-date-box-minimal {
            background: rgba(255, 255, 255, 0.15);
            padding: 10px 15px;
            border-radius: 8px;
            text-align: center;
            min-width: 80px;
        }

        .modal-day-minimal {
            font-size: 24px;
            font-weight: 700;
            line-height: 1;
        }

        .modal-month-year-minimal {
            font-size: 13px;
            font-weight: 500;
        }

        .modal-title-minimal {
            font-size: 18px;
            font-weight: 600;
            line-height: 1.3;
            margin-bottom: 5px;
        }

        .modal-meta-minimal {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }

        .modal-meta-item-minimal {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
        }

        .modal-meta-item-minimal i {
            font-size: 14px;
            width: 16px;
        }

        .modal-body-minimal {
            padding: 20px;
        }

        .modal-section-minimal {
            margin-bottom: 20px;
        }

        .modal-section-minimal h4 {
            font-size: 14px;
            color: var(--primary);
            margin-bottom: 8px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .modal-section-minimal h4 i {
            color: var(--secondary);
            font-size: 12px;
        }

        .modal-description-minimal {
            font-size: 14px;
            line-height: 1.6;
            color: var(--text-dark);
        }

        .modal-description-minimal p {
            margin-bottom: 10px;
        }

        .modal-footer-minimal {
            padding: 15px 20px;
            background: var(--gray-light);
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 0 0 12px 12px;
        }

        .modal-status-minimal {
            display: inline-flex;
            align-items: center;
            padding: 5px 12px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
        }

        .modal-actions-minimal {
            display: flex;
            gap: 8px;
        }

        .modal-action-btn-small {
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 5px;
            transition: all 0.3s ease;
            border: 1px solid var(--border);
            background: var(--white);
        }

        .modal-action-btn-small:hover {
            background: var(--primary);
            color: var(--white);
            border-color: var(--primary);
        }

        /* ================= SURVEY SECTION ================= */
        .survey-section {
            background: 
                linear-gradient(
                    rgba(0, 0, 0, 0.6), 
                    rgba(0, 0, 0, 0.7)
                ),
                url("{{ asset('images/qr.jpg') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            padding: 80px 0;
            margin: 0 !important;
            overflow: hidden;
            border-radius: 30px 30px 0 0;

        }

        .survey-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            position: relative;
            z-index: 2;
        }

        .survey-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            align-items: center;
        }

        .survey-left {
            color: white;
        }

        .survey-title {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 25px;
            line-height: 1.3;
            text-shadow: 0 2px 4px rgba(0,0,0,0.5);
        }

        .survey-description {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 35px;
            opacity: 0.95;
            font-weight: 300;
        }

        .survey-btn {
            background: white;
            color: #1b5e20;
            padding: 15px 40px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 18px;
            display: inline-block;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }

        .survey-btn:hover {
            background: #f0f0f0;
            transform: translateY(-3px);
            color: #1b5e20;
            box-shadow: 0 6px 20px rgba(0,0,0,0.3);
        }

        .survey-right {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .survey-qr {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            padding: 30px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }

        .qr-box {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .qr-image {
            width: 200px;
            height: 200px;
            display: block;
            margin: 0 auto;
        }

        .qr-caption {
            color: white;
            font-size: 16px;
            text-align: center;
            font-weight: 500;
            opacity: 0.95;
        }

        /* ================= FOOTER ================= */
        .main-footer {
            background: var(--primary);
            color: var(--white);
            padding: 40px 0 20px;
            margin-top: 0 !important;
        }
        .footer-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}


        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-bottom: 30px;
        }

        .footer-col h3 {
            font-size: 16px;
            margin-bottom: 15px;
            padding-bottom: 8px;
            position: relative;
        }

        .footer-col h3::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 30px;
            height: 2px;
            background: var(--secondary);
        }

        .footer-col p {
            margin-bottom: 10px;
            opacity: 0.9;
            line-height: 1.5;
            font-size: 14px;
        }

        .footer-link {
            display: block;
            color: var(--white);
            text-decoration: none;
            margin-bottom: 8px;
            opacity: 0.9;
            transition: opacity 0.3s;
            font-size: 14px;
        }

        .footer-link:hover {
            opacity: 1;
            color: var(--white);
        }

        .copyright {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid rgba(255,255,255,0.1);
            font-size: 12px;
            opacity: 0.7;
        }

        /* ================= OVERLAY FOR MOBILE MENU ================= */
        .menu-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 998;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .menu-overlay.active {
            display: block;
            opacity: 1;
        }

        /* ================= RESPONSIVE DESIGN ================= */
        @media (max-width: 992px) {
            .survey-content {
                grid-template-columns: 1fr;
                gap: 40px;
                text-align: center;
            }

             .agenda-card-small {
        flex: 0 0 calc((100% - 25px) / 2);
    }
               
            .survey-title {
                font-size: 28px;
            }
            
            .survey-description {
                font-size: 16px;
            }
            
            .survey-qr {
                max-width: 350px;
                margin: 0 auto;
            }
        }

        @media (max-width: 768px) {
            .hero-section {
                min-height: 40vh;
            }
            .agenda-card-small {
        flex: 0 0 100%;
        height: auto;
    }
            
            
            .hero-title {
                font-size: 1.5rem;
            }
            
            
            
            .agenda-date-small {
                min-width: 60px;
                padding: 10px;
            }
            
            .date-day-small {
                font-size: 18px;
            }
            
            .date-month-small {
                font-size: 10px;
            }
            
            .agenda-title-small {
                font-size: 12px;
                -webkit-line-clamp: 2;
            }
            
            .agenda-modal-minimal {
                max-width: 90%;
            }
            
            .modal-title-minimal {
                font-size: 16px;
            }
            
            .survey-section {
                padding: 60px 0;
                background-attachment: scroll;
            }
            
            .survey-title {
                font-size: 24px;
                margin-bottom: 20px;
            }
            
            .survey-description {
                font-size: 15px;
                margin-bottom: 25px;
            }
            
            .survey-btn {
                padding: 12px 30px;
                font-size: 16px;
            }
            
            .qr-image {
                width: 160px;
                height: 160px;
            }
            
            .survey-qr {
                padding: 20px;
            }
        }

        @media (max-width: 480px) {
            .hero-section {
                min-height: 35vh;
            }
            
            .hero-title {
                font-size: 1.3rem;
            }
            
            .agenda-card-small {
                flex: 0 0 100%;
                height: auto;
            }
            
            .agenda-date-small {
                min-width: 55px;
                padding: 8px;
            }
            
            .date-day-small {
                font-size: 16px;
            }
            
            .agenda-content-small {
                padding: 8px;
            }
            
            .agenda-title-small {
                font-size: 11px;
                -webkit-line-clamp: 2;
            }
            
            .meta-item-small {
                font-size: 10px;
            }
            
            .survey-section {
                padding: 50px 0;
            }
            
            .survey-title {
                font-size: 22px;
            }
            
            .survey-description {
                font-size: 14px;
            }
            
            .qr-image {
                width: 140px;
                height: 140px;
            }
            
            .qr-caption {
                font-size: 14px;
            }
            
            .main-footer {
                padding: 30px 0 15px;
            }
        }

        /* ================= MOBILE NAVIGATION ================= */
        @media (max-width: 767px) {
            .header-container {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 10px;
            }

            .menu-toggle {
                display: flex;
                align-items: center;
                justify-content: center;
                order: 1;
            }

            .logo {
                order: 2;
                width: 50px;
                height: 50px;
            }

            .header-title {
                order: 3;
                padding-left: 10px;
                border-left: 2px solid var(--secondary);
                text-align: left;
                flex: 1;
            }

            .header-title h1 {
                font-size: 14px;
                line-height: 1.2;
            }

            .header-title span {
                font-size: 12px;
            }

            .nav-menu {
                position: fixed;
                top: 0;
                right: -100%;
                width: 250px;
                height: 100vh;
                background: #002244;
                flex-direction: column;
                padding: 70px 0 20px;
                transition: right 0.3s ease;
                overflow-y: auto;
                z-index: 999;
            }

            .nav-menu.active {
                right: 0;
            }

            .nav-link {
                padding: 12px 20px;
                border-bottom: 1px solid rgba(255,255,255,0.15);
                font-size: 14px;
            }

            .dropdown-menu {
                position: static;
                display: none;
                width: 100%;
                background: rgba(0, 20, 45, 0.95);
                box-shadow: none;
                border-radius: 0;
                margin: 0;
                padding: 0;
            }

            .dropdown.active .dropdown-menu {
                display: block;
            }

            .dropdown-menu li a {
                padding: 12px 30px;
                font-size: 13px;
                color: #fff;
                border-bottom: 1px solid rgba(255,255,255,0.1);
            }
        }

        /* Scrollbar Styling */
        .agenda-horizontal-container::-webkit-scrollbar {
            height: 4px;
        }

        .agenda-horizontal-container::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 2px;
        }

        .agenda-horizontal-container::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 2px;
        }

        .agenda-horizontal-container::-webkit-scrollbar-thumb:hover {
            background: #a1a1a1;
        }

        .agenda-modal-minimal::-webkit-scrollbar {
            width: 6px;
        }

        .agenda-modal-minimal::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }

        .agenda-modal-minimal::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 3px;
        }

        .agenda-modal-minimal::-webkit-scrollbar-thumb:hover {
            background: #a1a1a1;
        }
    </style>
</head>
<body>
    <!-- ================= FIXED SITE HEADER ================= -->
    <header class="site-header">
        <div class="site-container">
            <div class="header-container">
                <button class="menu-toggle" id="menuToggle" aria-label="Toggle navigation menu">
                    ☰
                </button>
                
                <div class="logo">
                    <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="50" cy="50" r="45" fill="#ffffff" opacity="0.1"/>
                        <image
                            href="{{ asset('images/logo ugk.png') }}"
                            x="15"
                            y="15"
                            width="70"
                            height="70"
                            preserveAspectRatio="xMidYMid meet"
                        />
                        <text
                            x="50"
                            y="95"
                            text-anchor="middle"
                            font-size="12"
                            font-weight="bold"
                            fill="#ffffff"
                        >
                            LPPMI
                        </text>
                    </svg>
                </div>
                
                <div class="header-title">
                    <h1>UNIVERSITAS GUNUNG KIDUL</h1>
                    <span>LEMBAGA PENGENDALIAN DAN PENJAMINAN MUTU INTERNAL</span>
                </div>
            </div>
        </div>
    </header>

    <!-- ================= NAVIGATION ================= -->
    <nav class="main-nav">
        <div class="site-container">
            <ul class="nav-menu" id="navMenu">
                <li><a href="/" class="nav-link active">BERANDA</a></li>
                <li class="dropdown">
                    <a href="#" class="nav-link dropdown-toggle">DOKUMEN</a>
                    <ul class="dropdown-menu">
                        <li><a href="/sistem-penjamin">Sistem Penjamin Mutu Internal </a></li>
                        <li><a href="/dokumen-penjamin">Dokumen Sistem Penjamin Mutu </a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="nav-link dropdown-toggle">PROFIL</a>
                    <ul class="dropdown-menu">
                        <li><a href="/uraian-tugas">Uraian Tugas</a></li>
                        <li><a href="/visi-misi">Visi & Misi</a></li>
                        <li><a href="/struktur-organisasi">Struktur Organisasi</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="nav-link dropdown-toggle">MUTU</a>
                    <ul class="dropdown-menu">
                        <li><a href="/mutu-internal"> Mutu Internal </a></li>
                        <li><a href="/mutu-eksternal">Mutu Eksternal </a></li>
                    </ul>
                </li>
                <li><a href="{{ route('kontak') }}" class="nav-link">KONTAK</a></li>
            </ul>
        </div>
    </nav>

    <!-- Overlay for mobile menu -->
    <div class="menu-overlay" id="menuOverlay"></div>

    @php
        use Illuminate\Support\Facades\Storage;
    @endphp
    @isset($heroBanners)
    <section class="hero-section" id="heroSection">
        <div class="hero-slider" id="heroSlider">
            @foreach ($heroBanners as $index => $banner)
                <div
                    class="hero-slide {{ $index === 0 ? 'active' : '' }}"
                    style="
                        background:
                        linear-gradient(
                            135deg,
                            rgba(0, 51, 102, 0.45) 0%,
                            rgba(0, 34, 68, 0.55) 100%
                        ),
                        url('{{ Storage::url($banner->image) }}');
                        background-size: cover;
                        background-position: center center;
                        background-repeat: no-repeat;
                    "
                    data-bg-url="{{ Storage::url($banner->image) }}"
                ></div>
            @endforeach
        </div>

        <div class="hero-overlay">
            <div class="hero-content">
                <h1 class="hero-title">
                    LEMBAGA PENJAMIN MUTU 
                </h1>
            </div>
        </div>
    </section>
    @else
    
    @endisset

    <!-- Main Content -->
    <main class="main-container">
        @yield('content')
    </main>

<!-- ================= AGENDA SECTION - 1 BARIS HORIZONTAL KECIL ================= -->
@if(isset($agendas) && count($agendas) > 0)
<section class="agenda-section">
    <div class="site-container">
        <div class="agenda-header">
            <h2 class="agenda-title">
                <i class="fas fa-calendar-alt"></i> Agenda Terbaru
            </h2>
        </div>

        <!-- Container dengan tombol navigasi -->
        <div class="agenda-slider-container">
            <button class="slider-arrow slider-arrow-left" id="agendaPrev">
                <i class="fas fa-chevron-left"></i>
            </button>
            
            <div class="agenda-horizontal-container">
                <div class="agenda-horizontal-wrapper" id="agendaWrapper">
                    @foreach($agendas as $agenda)
                    @php
                        $agendaDate = \Carbon\Carbon::parse($agenda->date);
                        $now = \Carbon\Carbon::now();
                        
                        if ($agendaDate->isToday()) {
                            $status = 'ongoing';
                            $statusText = 'Berlangsung';
                        } elseif ($agendaDate->isPast()) {
                            $status = 'completed';
                            $statusText = 'Selesai';
                        } else {
                            $status = 'upcoming';
                            $statusText = 'Akan Datang';
                        }
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
                                <div class="meta-item-small">
                                    <i class="fas fa-clock"></i>
                                    <span>{{ $agenda->time }}</span>
                                </div>
                                <div class="meta-item-small">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>{{ Str::limit($agenda->location, 25) }}</span>
                                </div>
                            </div>
                            
                            <span class="agenda-status-small status-{{ $status }}">
                                {{ $statusText }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            
            <button class="slider-arrow slider-arrow-right" id="agendaNext">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>

        <!-- Indikator slide untuk mobile -->
        <div class="slider-indicators" id="sliderIndicators"></div>
    </div>
</section>
@else
<!-- Tampilan jika tidak ada agenda -->

@endif

<!-- ================= AGENDA MODAL ================= -->
<div class="agenda-modal-overlay" id="agendaModal">
    <div class="agenda-modal-content">
        <button class="modal-close" id="modalClose">&times;</button>
        
        <div class="modal-header">
            <div class="modal-date-box">
                <span class="modal-day" id="modalDay"></span>
                <span class="modal-month-year" id="modalMonthYear"></span>
            </div>
            <h3 class="modal-title" id="modalTitle"></h3>
        </div>
        
        <div class="modal-body">
            <div class="modal-info">
                <div class="modal-info-item">
                    <i class="fas fa-clock"></i>
                    <span id="modalTime"></span>
                </div>
                <div class="modal-info-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <span id="modalLocation"></span>
                </div>
            </div>
            
            <div class="modal-description" id="modalDescription"></div>
        </div>
        
        <div class="modal-footer">
            <span class="modal-status" id="modalStatus"></span>
        </div>
    </div>
</div>

    <!-- ================= SURVEY SECTION ================= -->
    @if(isset($activeSurvey) && $activeSurvey)
    <section class="survey-section">
        <div class="survey-container">
            <div class="survey-content">
                <div class="survey-left">
                    <h2 class="survey-title">SURVEY KEPUASAN LAYANAN</h2>
                    
                    <p class="survey-description">
                        Untuk meningkatkan kualitas layanan di lingkungan Universitas Gunung Kidul, 
                        kami mohon Bapak/Ibu/Sdr. mengisi Survey Kepuasan Layanan.
                    </p>
                    
                    
                </div>
                
                <div class="survey-right">
                    <div class="survey-qr">
                        <div class="qr-box">
                            @if($activeSurvey->qr_code)
                                <img src="{{ asset('storage/' . $activeSurvey->qr_code) }}" alt="QR Code Survey" class="qr-image">
                            @else
                                <div style="width: 200px; height: 200px; background: #f0f0f0; display: flex; align-items: center; justify-content: center; border-radius: 4px;">
                                    <i class="fas fa-qrcode" style="font-size: 50px; color: #666;"></i>
                                </div>
                            @endif
                        </div>
                        <p class="qr-caption">Scan untuk mengisi survey</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- ================= FOOTER ================= -->
    <footer class="main-footer">
        <div class="footer-container">
            <div class="footer-grid">
                <div class="footer-col">
                    <h3>LPPMI Universitas Gunung Kidul</h3>
                    <p>Lembaga strategis dalam menjamin dan meningkatkan mutu penyelenggaraan pendidikan tinggi.</p>
                </div>
                
                <div class="footer-col">
                    <h3>Kontak</h3>
                    <p>📍 Gedung Rektorat Lt. 3</p>
                    <p>📞 (0271) 1234-5678</p>
                    <p>📧 lppmi@ungkid.ac.id</p>
                </div>
                
                <div class="footer-col">
                    <h3>Tautan</h3>
                    <a href="/" class="footer-link">Beranda</a>
                    <a href="#" class="footer-link">Dokumen</a>
                    <a href="#" class="footer-link">Profil</a>
                    <a href="#" class="footer-link">Kontak</a>
                </div>
            </div>
            
            <div class="copyright">
                <small>© {{ date('Y') }} Lembaga Penjaminan Mutu - Universitas Gunung Kidul.</small>
            </div>
        </div>
    </footer>

    <!-- ========== EXTERNAL JAVASCRIPT DEPENDENCIES ========== -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    @yield('scripts')
    
    <!-- ========== GLOBAL SITE SCRIPT ========== -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Hero Slider
            const slides = document.querySelectorAll('.hero-slide');
            let current = 0;

            if (slides.length > 1) {
                setInterval(() => {
                    slides[current].classList.remove('active');
                    current = (current + 1) % slides.length;
                    slides[current].classList.add('active');
                }, 5000);
            }

            // Mobile Navigation
            const menuToggle = document.getElementById('menuToggle');
            const navMenu = document.getElementById('navMenu');
            const menuOverlay = document.getElementById('menuOverlay');
            const dropdowns = document.querySelectorAll('.dropdown');
            
            function toggleMobileMenu() {
                const isActive = navMenu.classList.contains('active');
                navMenu.classList.toggle('active');
                menuOverlay.classList.toggle('active');
                menuToggle.textContent = isActive ? '☰' : '✕';
                menuToggle.setAttribute('aria-expanded', !isActive);
                document.body.style.overflow = isActive ? '' : 'hidden';
            }
            
            if (menuToggle) {
                menuToggle.addEventListener('click', toggleMobileMenu);
            }
            
            if (menuOverlay) {
                menuOverlay.addEventListener('click', toggleMobileMenu);
            }
            
            // Dropdown handling
            dropdowns.forEach(dropdown => {
                const toggle = dropdown.querySelector('.dropdown-toggle');
                if (toggle) {
                    toggle.addEventListener('click', function(e) {
                        if (window.innerWidth <= 768) {
                            e.preventDefault();
                            e.stopPropagation();
                            
                            dropdowns.forEach(other => {
                                if (other !== dropdown && other.classList.contains('active')) {
                                    other.classList.remove('active');
                                }
                            });
                            
                            dropdown.classList.toggle('active');
                        }
                    });
                }
            });
            
            // Close dropdowns when clicking outside
            document.addEventListener('click', function(e) {
                if (window.innerWidth <= 768 && !e.target.closest('.dropdown')) {
                    dropdowns.forEach(dropdown => {
                        dropdown.classList.remove('active');
                    });
                }
            });
            
            // Close menu when clicking link
            const allNavLinks = document.querySelectorAll('.nav-menu a');
            allNavLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth <= 768 && !this.classList.contains('dropdown-toggle')) {
                        setTimeout(() => {
                            toggleMobileMenu();
                        }, 300);
                    }
                });
            });

            // Agenda Modal Functionality
            const agendaModal = document.getElementById('agendaModal');
            const modalClose = document.getElementById('modalClose');
            const agendaCards = document.querySelectorAll('.agenda-card-small');
            const agendaData = @json($agendas ?? []);

            // Format date for modal
            function formatModalDate(dateString) {
                const date = new Date(dateString);
                const day = date.getDate();
                const month = date.toLocaleDateString('id-ID', { month: 'long' });
                const year = date.getFullYear();
                return { day, month, year };
            }

            // Open modal when clicking agenda card
            agendaCards.forEach(card => {
                card.addEventListener('click', function() {
                    const agendaId = this.getAttribute('data-agenda-id');
                    const agenda = agendaData.find(a => a.id == agendaId);
                    
                    if (agenda) {
                        openAgendaModal(agenda);
                    }
                });
            });

            // Open modal with agenda data
            function openAgendaModal(agenda) {
                const date = formatModalDate(agenda.date);
                const agendaDate = new Date(agenda.date);
                const now = new Date();
                
                // Determine status
                let status = 'completed';
                let statusText = 'Selesai';
                let statusClass = 'status-completed';
                
                if (agendaDate.toDateString() === now.toDateString()) {
                    status = 'ongoing';
                    statusText = 'Berlangsung';
                    statusClass = 'status-ongoing';
                } else if (agendaDate > now) {
                    status = 'upcoming';
                    statusText = 'Akan Datang';
                    statusClass = 'status-upcoming';
                }

                // Set modal content
                document.getElementById('modalDay').textContent = date.day;
                document.getElementById('modalMonthYear').textContent = `${date.month} ${date.year}`;
                document.getElementById('modalTitle').textContent = agenda.title;
                document.getElementById('modalTime').textContent = agenda.time;
                document.getElementById('modalLocation').textContent = agenda.location;
                
                // Set description
                const descriptionElement = document.getElementById('modalDescription');
                if (agenda.description && agenda.description.trim() !== '') {
                    descriptionElement.innerHTML = agenda.description;
                } else {
                    descriptionElement.innerHTML = '<p style="color: var(--text-light); font-style: italic;">Tidak ada deskripsi tersedia.</p>';
                }
                
                // Set status
                const modalStatus = document.getElementById('modalStatus');
                modalStatus.textContent = statusText;
                modalStatus.className = `modal-status-minimal ${statusClass}`;

                // Show modal
                agendaModal.classList.add('active');
                document.body.style.overflow = 'hidden';
            }

            // Close modal
            modalClose.addEventListener('click', closeModal);
            agendaModal.addEventListener('click', function(e) {
                if (e.target === agendaModal) {
                    closeModal();
                }
            });

            // Close modal with ESC key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && agendaModal.classList.contains('active')) {
                    closeModal();
                }
            });

            function closeModal() {
                agendaModal.classList.remove('active');
                document.body.style.overflow = '';
            }

            // Share functionality
            document.getElementById('modalShare').addEventListener('click', function() {
                const modalTitle = document.getElementById('modalTitle').textContent;
                const modalDate = `${document.getElementById('modalDay').textContent} ${document.getElementById('modalMonthYear').textContent}`;
                const text = `Agenda LPPMI: ${modalTitle} (${modalDate} - ${document.getElementById('modalTime').textContent})`;
                
                if (navigator.share) {
                    navigator.share({
                        title: modalTitle,
                        text: text,
                        url: window.location.href,
                    });
                } else {
                    navigator.clipboard.writeText(text).then(() => {
                        alert('Informasi agenda telah disalin ke clipboard!');
                    });
                }
            });

            // Reminder functionality
            document.getElementById('modalReminder').addEventListener('click', function() {
                const agendaTitle = document.getElementById('modalTitle').textContent;
                const agendaTime = document.getElementById('modalTime').textContent;
                const agendaDate = `${document.getElementById('modalDay').textContent} ${document.getElementById('modalMonthYear').textContent}`;
                
                alert(`Pengingat untuk "${agendaTitle}" pada ${agendaDate} pukul ${agendaTime} telah disimpan.`);
            });

            // Horizontal scroll arrows
            const scrollLeftBtn = document.getElementById('scrollLeft');
            const scrollRightBtn = document.getElementById('scrollRight');
            const horizontalContainer = document.querySelector('.agenda-horizontal-container');

            if (scrollLeftBtn && scrollRightBtn && horizontalContainer) {
                scrollLeftBtn.addEventListener('click', () => {
                    horizontalContainer.scrollBy({
                        left: -200,
                        behavior: 'smooth'
                    });
                });

                scrollRightBtn.addEventListener('click', () => {
                    horizontalContainer.scrollBy({
                        left: 200,
                        behavior: 'smooth'
                    });
                });
            }

            // Keyboard navigation for agenda cards
            document.addEventListener('keydown', function(e) {
                const activeModal = agendaModal.classList.contains('active');
                if (!activeModal) return;

                if (e.key === 'ArrowLeft') {
                    // Previous agenda
                    const currentId = document.querySelector('.agenda-card-small[data-agenda-id]').getAttribute('data-agenda-id');
                    const currentIndex = agendaData.findIndex(a => a.id == currentId);
                    if (currentIndex > 0) {
                        openAgendaModal(agendaData[currentIndex - 1]);
                    }
                } else if (e.key === 'ArrowRight') {
                    // Next agenda
                    const currentId = document.querySelector('.agenda-card-small[data-agenda-id]').getAttribute('data-agenda-id');
                    const currentIndex = agendaData.findIndex(a => a.id == currentId);
                    if (currentIndex < agendaData.length - 1) {
                        openAgendaModal(agendaData[currentIndex + 1]);
                    }
                }
            });

            // View all button functionality
            const viewAllBtn = document.querySelector('.view-all-btn');
            if (viewAllBtn) {
                viewAllBtn.addEventListener('click', function() {
                    // Arahkan ke halaman agenda lengkap
                    window.location.href = '/agenda';
                });
            }

            // Smooth scrolling for horizontal agenda
            const horizontalScroll = document.querySelector('.agenda-horizontal-container');
            if (horizontalScroll) {
                let isDown = false;
                let startX;
                let scrollLeft;

                horizontalScroll.addEventListener('mousedown', (e) => {
                    isDown = true;
                    startX = e.pageX - horizontalScroll.offsetLeft;
                    scrollLeft = horizontalScroll.scrollLeft;
                });

                horizontalScroll.addEventListener('mouseleave', () => {
                    isDown = false;
                });

                horizontalScroll.addEventListener('mouseup', () => {
                    isDown = false;
                });

                horizontalScroll.addEventListener('mousemove', (e) => {
                    if (!isDown) return;
                    e.preventDefault();
                    const x = e.pageX - horizontalScroll.offsetLeft;
                    const walk = (x - startX) * 2;
                    horizontalScroll.scrollLeft = scrollLeft - walk;
                });
            }
        });
    </script>
    <script>
document.addEventListener("DOMContentLoaded", function () {
    const wrapper = document.querySelector(".agenda-horizontal-wrapper");
    const cards = document.querySelectorAll(".agenda-card-small");
    const prev = document.getElementById("agendaPrev");
    const next = document.getElementById("agendaNext");

    let visible = 3;
    let index = 0;

    function getVisibleCount() {
        if (window.innerWidth <= 768) return 1;
        if (window.innerWidth <= 992) return 2;
        return 3;
    }

    function updateSlide() {
        visible = getVisibleCount();
        const cardWidth = cards[0].offsetWidth + 25;
        wrapper.style.transform = `translateX(-${index * cardWidth}px)`;
    }

    function nextSlide() {
        visible = getVisibleCount();

        if (index < cards.length - visible) {
            index++;
        } else {
            index = 0; // loop kembali
        }
        updateSlide();
    }

    function prevSlide() {
        visible = getVisibleCount();

        if (index > 0) {
            index--;
        } else {
            index = cards.length - visible;
        }
        updateSlide();
    }

    next.addEventListener("click", nextSlide);
    prev.addEventListener("click", prevSlide);

    // AUTO SLIDE tiap 5 detik
    setInterval(nextSlide, 5000);

    window.addEventListener("resize", updateSlide);
});
</script>
</body>
</html>
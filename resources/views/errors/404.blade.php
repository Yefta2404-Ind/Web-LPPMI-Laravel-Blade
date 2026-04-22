@extends('layouts.public')

@section('content')
<div class="error-404-container">
    <div class="error-card">
        <!-- Badge Kampus -->
        

        <!-- Maskot Monster Biru -->
        <div class="mascot-wrapper">
            <svg class="monster-svg" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                <!-- Badan -->
                <ellipse cx="100" cy="122" rx="56" ry="48" fill="#DBEAFE" stroke="#3B82F6" stroke-width="2.2" />
                <ellipse cx="100" cy="130" rx="38" ry="30" fill="#F0F9FF" />
                
                <!-- Kepala -->
                <circle cx="100" cy="74" r="42" fill="#EFF6FF" stroke="#2563EB" stroke-width="2.2" />
                
                <!-- Tanduk -->
                <polygon points="65,48 58,28 72,43" fill="#1E40AF" stroke="#1E3A8A" stroke-width="1.5" />
                <polygon points="135,48 142,28 128,43" fill="#1E40AF" stroke="#1E3A8A" stroke-width="1.5" />
                
                <!-- Mata (animasi kedip) -->
                <circle class="monster-eye" cx="84" cy="68" r="7.5" fill="#0F172A" />
                <circle class="monster-eye" cx="116" cy="68" r="7.5" fill="#0F172A" />
                <circle cx="81" cy="65" r="2.8" fill="white" />
                <circle cx="113" cy="65" r="2.8" fill="white" />
                
                <!-- Alis -->
                <path d="M74 57 Q84 52 94 58" stroke="#1E3A8A" stroke-width="2.5" fill="none" stroke-linecap="round" />
                <path d="M106 58 Q116 52 126 57" stroke="#1E3A8A" stroke-width="2.5" fill="none" stroke-linecap="round" />
                
                <!-- Hidung -->
                <circle cx="100" cy="78" r="4.5" fill="#3B82F6" opacity="0.8" />
                
                <!-- Senyum -->
                <path d="M83 92 Q100 106 117 92" stroke="#2563EB" stroke-width="2.5" fill="none" stroke-linecap="round" />
                
                <!-- Blush -->
                <circle cx="70" cy="84" r="6" fill="#93C5FD" opacity="0.45" />
                <circle cx="130" cy="84" r="6" fill="#93C5FD" opacity="0.45" />
                
                <!-- Tangan kiri (melambai) -->
                <g>
                    <animateTransform attributeName="transform" type="rotate" values="-8 52 112; 8 52 112; -8 52 112" dur="2s" repeatCount="indefinite" />
                    <ellipse cx="52" cy="112" rx="14" ry="9" fill="#DBEAFE" stroke="#3B82F6" stroke-width="1.8" />
                    <circle cx="46" cy="103" r="3.5" fill="#EFF6FF" stroke="#3B82F6" stroke-width="1" />
                    <circle cx="57" cy="102" r="3.5" fill="#EFF6FF" stroke="#3B82F6" stroke-width="1" />
                </g>
                
                <!-- Tangan kanan -->
                <ellipse cx="148" cy="116" rx="14" ry="9" fill="#DBEAFE" stroke="#3B82F6" stroke-width="1.8" />
                <circle cx="154" cy="108" r="3.5" fill="#EFF6FF" stroke="#3B82F6" stroke-width="1" />
                <circle cx="143" cy="107" r="3.5" fill="#EFF6FF" stroke="#3B82F6" stroke-width="1" />
                
                <!-- Kaki -->
                <ellipse cx="78" cy="167" rx="15" ry="8" fill="#BFDBFE" stroke="#3B82F6" stroke-width="1.8" />
                <ellipse cx="122" cy="167" rx="15" ry="8" fill="#BFDBFE" stroke="#3B82F6" stroke-width="1.8" />
                
                <!-- Buku kecil (atribut kampus) -->
                <rect x="155" y="85" width="12" height="16" rx="2" fill="#F8FAFC" stroke="#2563EB" stroke-width="1.2" transform="rotate(15 155 85)" />
                <line x1="161" y1="85" x2="161" y2="101" stroke="#2563EB" stroke-width="1" transform="rotate(15 155 85)" />
            </svg>
        </div>

        <!-- Angka 404 -->
        <div class="error-code">404</div>
        <h1>Halaman Tidak Ditemukan</h1>
        <p class="description">
            Maaf, halaman yang Anda cari tidak tersedia.<br>
        </p>

        <!-- Tombol Kembali ke Beranda -->
        <a href="{{ url('/') }}" class="btn-home">
            <i class="fas fa-arrow-left"></i>
            Kembali ke Beranda
            <i class="fas fa-home"></i>
        </a>
    </div>
</div>

<style>
    /* Reset & Base */
    .error-404-container {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
        background: linear-gradient(145deg, #f0f4fa 0%, #e2e8f0 100%);
        position: relative;
    }

    .error-404-container::before {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        background-image: 
            linear-gradient(#3b82f610 1px, transparent 1px),
            linear-gradient(90deg, #3b82f610 1px, transparent 1px);
        background-size: 40px 40px;
        pointer-events: none;
    }

    /* Card Utama */
    .error-card {
        max-width: 560px;
        width: 100%;
        background: #ffffff;
        border-radius: 32px;
        padding: 2.5rem 2rem 2.5rem;
        text-align: center;
        box-shadow: 0 25px 45px -12px rgba(0, 0, 0, 0.15);
        position: relative;
        z-index: 2;
        animation: fadeInUp 0.5s ease-out;
        border: 1px solid rgba(59, 130, 246, 0.15);
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(25px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Badge Kampus */
    .campus-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #eff6ff;
        padding: 0.45rem 1.2rem;
        border-radius: 40px;
        margin-bottom: 1.5rem;
        font-size: 0.75rem;
        font-weight: 600;
        color: #1e40af;
        letter-spacing: 0.3px;
    }

    /* Maskot */
    .mascot-wrapper {
        display: inline-block;
        animation: gentleFloat 3s ease-in-out infinite;
        margin-bottom: 0.5rem;
    }

    @keyframes gentleFloat {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-8px); }
    }

    .monster-svg {
        width: 150px;
        height: auto;
        filter: drop-shadow(0 8px 16px rgba(37, 99, 235, 0.12));
    }

    .monster-eye {
        animation: subtleBlink 5s infinite;
        transform-origin: center;
    }

    @keyframes subtleBlink {
        0%, 94%, 100% { transform: scaleY(1); }
        97% { transform: scaleY(0.1); }
    }

    /* Angka 404 */
    .error-code {
        font-size: 5.5rem;
        font-weight: 800;
        background: linear-gradient(135deg, #1e3a8a, #2563eb, #3b82f6);
        background-clip: text;
        -webkit-background-clip: text;
        color: transparent;
        letter-spacing: 0.02em;
        margin: 0.25rem 0 0.5rem;
        line-height: 1.1;
    }

    h1 {
        font-size: 1.65rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 0.75rem;
    }

    .description {
        color: #475569;
        font-size: 0.95rem;
        line-height: 1.5;
        margin-bottom: 2rem;
        max-width: 400px;
        margin-left: auto;
        margin-right: auto;
    }

    /* Tombol Utama */
    .btn-home {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        background: #2563eb;
        padding: 0.85rem 2rem;
        border-radius: 60px;
        font-weight: 600;
        font-size: 0.95rem;
        color: white;
        text-decoration: none;
        transition: all 0.25s ease;
        box-shadow: 0 6px 14px rgba(37, 99, 235, 0.25);
        border: none;
        cursor: pointer;
    }

    .btn-home:hover {
        background: #1d4ed8;
        transform: translateY(-2px);
        box-shadow: 0 12px 22px -8px rgba(37, 99, 235, 0.4);
    }

    .btn-home:active {
        transform: translateY(1px);
    }

    .btn-home i {
        font-size: 0.9rem;
        transition: transform 0.2s;
    }

    .btn-home:hover i:first-child {
        transform: translateX(-4px);
    }

    /* Tautan Bantuan */
    .help-links {
        margin-top: 2rem;
        display: flex;
        justify-content: center;
        gap: 1.2rem;
        flex-wrap: wrap;
        border-top: 1px solid #e2e8f0;
        padding-top: 1.8rem;
    }

    .help-link {
        font-size: 0.85rem;
        font-weight: 500;
        color: #3b82f6;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
        padding: 0.35rem 0.75rem;
        border-radius: 30px;
    }

    .help-link:hover {
        background: #eff6ff;
        color: #1e40af;
        transform: translateY(-1px);
    }

    /* Footer Kontak */
    .contact-footer {
        margin-top: 1.5rem;
        font-size: 0.7rem;
        color: #94a3b8;
        display: flex;
        justify-content: center;
        gap: 1.2rem;
        flex-wrap: wrap;
    }

    .contact-footer span {
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    /* Responsive */
    @media (max-width: 550px) {
        .error-404-container {
            padding: 1rem;
        }
        .error-card {
            padding: 1.8rem 1.2rem;
            border-radius: 28px;
        }
        .monster-svg {
            width: 120px;
        }
        .error-code {
            font-size: 4rem;
        }
        h1 {
            font-size: 1.35rem;
        }
        .description {
            font-size: 0.85rem;
        }
        .btn-home {
            padding: 0.7rem 1.5rem;
            font-size: 0.85rem;
        }
        .help-link {
            font-size: 0.75rem;
        }
        .contact-footer {
            font-size: 0.65rem;
            gap: 0.8rem;
        }
        .campus-badge {
            font-size: 0.7rem;
            padding: 0.35rem 0.9rem;
        }
    }

    @media (max-width: 400px) {
        .error-code {
            font-size: 3rem;
        }
        .help-links {
            gap: 0.8rem;
        }
    }
</style>

<script>
    (function() {
        // Tombol Kembali
        const backBtn = document.getElementById('backButton');
        if (backBtn) {
            backBtn.addEventListener('click', function(e) {
                e.preventDefault();
                if (window.history.length > 1) {
                    window.history.back();
                } else {
                    window.location.href = "{{ url('/') }}";
                }
            });
        }

        // Tombol Refresh
        const refreshBtn = document.getElementById('refreshButton');
        if (refreshBtn) {
            refreshBtn.addEventListener('click', function(e) {
                e.preventDefault();
                window.location.reload();
            });
        }

        // Tombol Bantuan (Popup informasi kontak)
        const helpBtn = document.getElementById('helpButton');
        if (helpBtn) {
            helpBtn.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Buat modal popup sederhana
                const overlay = document.createElement('div');
                overlay.style.cssText = 'position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5);backdrop-filter:blur(3px);z-index:1000;';
                
                const modal = document.createElement('div');
                modal.style.cssText = 'position:fixed;top:50%;left:50%;transform:translate(-50%,-50%);background:white;padding:1.8rem;border-radius:24px;box-shadow:0 25px 40px rgba(0,0,0,0.2);z-index:1001;max-width:320px;width:90%;text-align:center;font-family:inherit;';
                
                modal.innerHTML = `
                    <i class="fas fa-headset" style="font-size:2.5rem;color:#2563eb;margin-bottom:1rem;"></i>
                    <h3 style="font-size:1.3rem;font-weight:700;margin-bottom:0.75rem;color:#0f172a;">Pusat Bantuan IT</h3>
                    <p style="color:#475569;font-size:0.85rem;margin-bottom:1.2rem;">Hubungi tim技术支持 kami untuk bantuan lebih lanjut.</p>
                    <div style="background:#f8fafc;padding:0.8rem;border-radius:16px;margin-bottom:1rem;">
                        <p style="font-size:0.8rem;margin:4px 0;"><i class="fas fa-envelope"></i> helpdesk@kampus.ac.id</p>
                        <p style="font-size:0.8rem;margin:4px 0;"><i class="fab fa-whatsapp"></i> +62 812 3456 7890</p>
                        <p style="font-size:0.8rem;margin:4px 0;"><i class="fas fa-globe"></i> support.kampus.ac.id</p>
                    </div>
                    <button id="closeHelpModal" style="background:#2563eb;border:none;padding:0.5rem 1.5rem;border-radius:40px;color:white;font-weight:600;cursor:pointer;">Tutup</button>
                `;
                
                document.body.appendChild(overlay);
                document.body.appendChild(modal);
                
                const closeModal = () => {
                    overlay.remove();
                    modal.remove();
                };
                
                document.getElementById('closeHelpModal').addEventListener('click', closeModal);
                overlay.addEventListener('click', closeModal);
            });
        }

        // Efek hover pada tombol utama membuat maskot lebih hidup
        const homeBtn = document.querySelector('.btn-home');
        const mascot = document.querySelector('.mascot-wrapper');
        if (homeBtn && mascot) {
            homeBtn.addEventListener('mouseenter', () => {
                mascot.style.animation = 'gentleFloat 0.6s ease-in-out';
                setTimeout(() => {
                    mascot.style.animation = 'gentleFloat 3s ease-in-out infinite';
                }, 600);
            });
        }
    })();
</script>
@endsection
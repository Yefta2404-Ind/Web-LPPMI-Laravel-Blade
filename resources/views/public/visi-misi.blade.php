@extends('layouts.public')

@section('title', 'Visi & Misi')

@section('content')
<div class="visimisi-page">
    <!-- Header Minimal -->
    <div class="header-minimal">
        <h1>Visi & Misi</h1>
        <p>Lembaga Pengendalian dan Penjaminan Mutu Internal Universitas Gunungkidul</p>
    </div>

    <!-- Visi Section -->
    <div class="visimisi-section">
        <!-- Visi -->
        <div class="visimisi-box">
            <div class="visimisi-title">
                <i class="fas fa-bullseye"></i>
                <h3>Visi</h3>
            </div>
            <div class="visimisi-content">
                <p>Menjadi lembaga penjaminan mutu yang berintegritas dalam mewujudkan universitas sebagai universitas unggul dalam pembangunan kawasan karst.</p>
            </div>
        </div>

        <!-- Misi -->
        <div class="visimisi-box">
            <div class="visimisi-title">
                <i class="fas fa-tasks"></i>
                <h3>Misi</h3>
            </div>
            <div class="visimisi-content">
                <div class="misi-item">
                    <span class="misi-number">1</span>
                    <div class="misi-text">
                        Melaksanakan sistem penjaminan mutu internal dengan metode PPEPP (Penetapan – Pelaksanaan – Evaluasi - Peningkatan – Pengendalian)
                    </div>
                </div>
                <div class="misi-item">
                    <span class="misi-number">2</span>
                    <div class="misi-text">
                        Menyelenggarakan pendampingan, konsultasi, training, serta kerjasama pada bidang penjaminan mutu internal
                    </div>
                </div>
                <div class="misi-item">
                    <span class="misi-number">3</span>
                    <div class="misi-text">
                        Melaksanakan monitoring, evaluasi, serta audit mutu internal di lingkungan Universitas Gunung Kidul
                    </div>
                </div>
                <div class="misi-item">
                    <span class="misi-number">4</span>
                    <div class="misi-text">
                        Melakukan pelaporan sistem penjaminan mutu internal pada laman pendidikan tinggi secara berkala
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Info -->
    <div class="additional-info">
        <div class="info-box">
            <div class="info-title">
                <i class="fas fa-info-circle"></i>
                <h3>Tentang PPEPP</h3>
            </div>
            <div class="info-content">
                <p>PPEPP merupakan metode siklus penjaminan mutu yang mencakup:</p>
                <ul>
                    <li><strong>Penetapan:</strong> Menetapkan standar mutu</li>
                    <li><strong>Pelaksanaan:</strong> Mengimplementasikan standar mutu</li>
                    <li><strong>Evaluasi:</strong> Menilai pencapaian standar</li>
                    <li><strong>Peningkatan:</strong> Melakukan perbaikan berkelanjutan</li>
                    <li><strong>Pengendalian:</strong> Memastikan konsistensi mutu</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- CSS Minimal -->
<style>
/* Base */
.visimisi-page {
    max-width: 1000px;
    margin: 0 auto;
    padding: 40px 20px;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', system-ui, sans-serif;
}

/* Header */
.header-minimal {
    text-align: center;
    margin-bottom: 50px;
    padding-bottom: 20px;
    border-bottom: 1px solid #ddd;
}

.header-minimal h1 {
    font-size: 32px;
    color: #333;
    margin: 0 0 10px 0;
    font-weight: 400;
}

.header-minimal p {
    color: #666;
    margin: 0;
    font-size: 16px;
}

/* Visi Misi Section */
.visimisi-section {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    margin-bottom: 40px;
}

/* Visi Misi Box */
.visimisi-box {
    background: #fff;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 30px;
}

.visimisi-title {
    display: flex;
    align-items: center;
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 1px solid #eee;
}

.visimisi-title i {
    font-size: 20px;
    color: #2c5282;
    margin-right: 12px;
}

.visimisi-title h3 {
    margin: 0;
    font-size: 20px;
    color: #333;
    font-weight: 500;
}

/* Visi Content */
.visimisi-content {
    line-height: 1.6;
}

.visimisi-content p {
    margin: 0;
    color: #444;
    font-size: 16px;
    text-align: justify;
}

/* Misi Items */
.misi-item {
    display: flex;
    margin-bottom: 20px;
    align-items: flex-start;
}

.misi-item:last-child {
    margin-bottom: 0;
}

.misi-number {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 28px;
    height: 28px;
    background: #2c5282;
    color: white;
    border-radius: 50%;
    font-size: 14px;
    font-weight: 500;
    margin-right: 15px;
    flex-shrink: 0;
    margin-top: 2px;
}

.misi-text {
    color: #444;
    font-size: 15px;
    line-height: 1.5;
}

/* Additional Info */
.additional-info {
    margin-top: 40px;
}

.info-box {
    background: #fff;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 30px;
}

.info-title {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 1px solid #eee;
}

.info-title i {
    font-size: 20px;
    color: #38a169;
    margin-right: 12px;
}

.info-title h3 {
    margin: 0;
    font-size: 20px;
    color: #333;
    font-weight: 500;
}

.info-content {
    line-height: 1.6;
}

.info-content p {
    margin: 0 0 15px 0;
    color: #444;
    font-size: 16px;
}

.info-content ul {
    margin: 0;
    padding-left: 20px;
    color: #444;
}

.info-content li {
    margin-bottom: 8px;
    line-height: 1.5;
}

.info-content li strong {
    color: #333;
}

/* Responsive */
@media (max-width: 768px) {
    .visimisi-page {
        padding: 30px 15px;
    }
    
    .visimisi-section {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .visimisi-box, .info-box {
        padding: 25px;
    }
    
    .header-minimal h1 {
        font-size: 28px;
    }
    
    .misi-item {
        align-items: flex-start;
    }
    
    .misi-number {
        margin-top: 0;
    }
}

/* Animation */
.visimisi-box {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.visimisi-box:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}
</style>
@endsection
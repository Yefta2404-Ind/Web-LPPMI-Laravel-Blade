@extends('layouts.public')

@section('title', 'Sistem Penjaminan Mutu Internal')

@section('content')
<div class="spmi-page">
    <!-- Header Minimal -->
    <div class="header-minimal">
        <h1>LPPMI UGK</h1>
        <p>Lembaga Pengandalian dan Penjaminan Mutu Internal</p>
    </div>

    <!-- Deskripsi Utama -->
    <div class="deskripsi-utama">
        <div class="deskripsi-box">
            <div class="deskripsi-title">
                <i class="fas fa-cogs"></i>
                <h3>Definisi SPMI UGK</h3>
            </div>
            <div class="deskripsi-content">
                <p>Sistem Penjaminan Mutu Internal Universitas Gunung Kidul (SPMI UGK) merupakan kegiatan sistemik yang dirancang untuk mengendalikan dan meningkatkan mutu penyelenggaraan pendidikan tinggi secara terencana, terukur, dan berkelanjutan.</p>
                <p>Pelaksanaan SPMI UGK mengacu pada siklus PPEPP yang merupakan pendekatan sistematis untuk mencapai standar mutu pendidikan tinggi yang optimal.</p>
            </div>
        </div>
    </div>

    <!-- Siklus PPEPP -->
    <div class="siklus-section">
        <div class="siklus-box">
            <div class="siklus-title">
                <i class="fas fa-sync-alt"></i>
                <h3>Siklus PPEPP SPMI</h3>
            </div>
            <div class="siklus-content">
                <p class="siklus-intro">Siklus PPEPP merupakan metode penjaminan mutu yang terdiri dari 5 tahap utama:</p>
                
                <div class="siklus-container">
                    <!-- Siklus Item 1 -->
                    <div class="siklus-item">
                        <div class="siklus-number">01</div>
                        <div class="siklus-icon">
                            <i class="fas fa-edit"></i>
                        </div>
                        <div class="siklus-detail">
                            <h4>Penetapan Standar</h4>
                            <p>Menetapkan standar mutu yang akan dicapai berdasarkan visi, misi, dan tujuan universitas serta standar nasional pendidikan tinggi.</p>
                            <ul class="siklus-sub">
                                <li>Analisis kebutuhan stakeholders</li>
                                <li>Penyusunan dokumen standar</li>
                                <li>Validasi standar mutu</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Siklus Item 2 -->
                    <div class="siklus-item">
                        <div class="siklus-number">02</div>
                        <div class="siklus-icon">
                            <i class="fas fa-play-circle"></i>
                        </div>
                        <div class="siklus-detail">
                            <h4>Pelaksanaan Standar</h4>
                            <p>Mengimplementasikan standar mutu yang telah ditetapkan dalam seluruh kegiatan akademik dan non-akademik universitas.</p>
                            <ul class="siklus-sub">
                                <li>Implementasi standar operasional</li>
                                <li>Sosialisasi dan internalisasi</li>
                                <li>Monitoring awal pelaksanaan</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Siklus Item 3 -->
                    <div class="siklus-item">
                        <div class="siklus-number">03</div>
                        <div class="siklus-icon">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <div class="siklus-detail">
                            <h4>Evaluasi Pelaksanaan Standar</h4>
                            <p>Melakukan penilaian terhadap tingkat pencapaian standar mutu melalui berbagai metode evaluasi.</p>
                            <ul class="siklus-sub">
                                <li>Audit mutu internal</li>
                                <li>Pengukuran indikator kinerja</li>
                                <li>Analisis gap (kesenjangan)</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Siklus Item 4 -->
                    <div class="siklus-item">
                        <div class="siklus-number">04</div>
                        <div class="siklus-icon">
                            <i class="fas fa-sliders-h"></i>
                        </div>
                        <div class="siklus-detail">
                            <h4>Pengendalian Standar</h4>
                            <p>Melakukan kontrol dan pengawasan untuk memastikan konsistensi penerapan standar mutu.</p>
                            <ul class="siklus-sub">
                                <li>Pengawasan berkelanjutan</li>
                                <li>Penerapan tindakan korektif</li>
                                <li>Pemantauan kepatuhan standar</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Siklus Item 5 -->
                    <div class="siklus-item">
                        <div class="siklus-number">05</div>
                        <div class="siklus-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="siklus-detail">
                            <h4>Peningkatan Standar</h4>
                            <p>Melakukan perbaikan dan penyempurnaan standar mutu berdasarkan hasil evaluasi untuk mencapai mutu yang lebih tinggi.</p>
                            <ul class="siklus-sub">
                                <li>Perencanaan peningkatan</li>
                                <li>Implementasi perbaikan</li>
                                <li>Benchmarking best practices</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<!-- CSS Minimal -->
<style>
/* Base */
.spmi-page {
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

/* Deskripsi Utama */
.deskripsi-utama {
    margin-bottom: 40px;
}

.deskripsi-box {
    background: #fff;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 30px;
}

.deskripsi-title {
    display: flex;
    align-items: center;
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 1px solid #eee;
}

.deskripsi-title i {
    font-size: 20px;
    color: #2c5282;
    margin-right: 12px;
}

.deskripsi-title h3 {
    margin: 0;
    font-size: 20px;
    color: #333;
    font-weight: 500;
}

.deskripsi-content p {
    margin: 0 0 15px 0;
    color: #444;
    font-size: 16px;
    line-height: 1.6;
    text-align: justify;
}

.deskripsi-content p:last-child {
    margin-bottom: 0;
}

/* Siklus Section */
.siklus-section {
    margin-bottom: 40px;
}

.siklus-box {
    background: #fff;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 30px;
}

.siklus-title {
    display: flex;
    align-items: center;
    margin-bottom: 30px;
    padding-bottom: 15px;
    border-bottom: 1px solid #eee;
}

.siklus-title i {
    font-size: 20px;
    color: #2c5282;
    margin-right: 12px;
}

.siklus-title h3 {
    margin: 0;
    font-size: 20px;
    color: #333;
    font-weight: 500;
}

.siklus-intro {
    color: #555;
    margin-bottom: 30px !important;
    font-size: 16px;
    line-height: 1.6;
}

/* Siklus Container */
.siklus-container {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.siklus-item {
    display: flex;
    align-items: flex-start;
    padding: 25px;
    background: #f8fafc;
    border-radius: 8px;
    border-left: 4px solid #2c5282;
    transition: all 0.3s ease;
}

.siklus-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}

.siklus-number {
    font-size: 24px;
    font-weight: 700;
    color: #2c5282;
    margin-right: 20px;
    opacity: 0.8;
    flex-shrink: 0;
}

.siklus-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 50px;
    height: 50px;
    background: white;
    border-radius: 8px;
    margin-right: 20px;
    flex-shrink: 0;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.siklus-icon i {
    font-size: 22px;
    color: #2c5282;
}

.siklus-detail {
    flex: 1;
}

.siklus-detail h4 {
    margin: 0 0 10px 0;
    color: #333;
    font-size: 18px;
    font-weight: 500;
}

.siklus-detail p {
    margin: 0 0 15px 0;
    color: #555;
    font-size: 15px;
    line-height: 1.5;
}

.siklus-sub {
    margin: 0;
    padding-left: 20px;
    color: #666;
}

.siklus-sub li {
    margin-bottom: 5px;
    font-size: 14px;
}

/* Diagram Section */
.diagram-section {
    margin-bottom: 40px;
}

.diagram-box {
    background: #fff;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 30px;
}

.diagram-title {
    display: flex;
    align-items: center;
    margin-bottom: 30px;
    padding-bottom: 15px;
    border-bottom: 1px solid #eee;
}

.diagram-title i {
    font-size: 20px;
    color: #2c5282;
    margin-right: 12px;
}

.diagram-title h3 {
    margin: 0;
    font-size: 20px;
    color: #333;
    font-weight: 500;
}

.diagram-visual {
    display: flex;
    justify-content: center;
    padding: 30px 0;
}

/* Cycle Circle */
.cycle-circle {
    position: relative;
    width: 400px;
    height: 400px;
}

.cycle-center {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 120px;
    height: 120px;
    background: #2c5282;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 500;
    text-align: center;
    padding: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.cycle-item {
    position: absolute;
    width: 100px;
    text-align: center;
    transform: translate(-50%, -50%);
}

.cycle-icon {
    width: 60px;
    height: 60px;
    background: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 10px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.cycle-icon i {
    font-size: 24px;
    color: #2c5282;
}

.cycle-label {
    font-weight: 500;
    color: #333;
    font-size: 14px;
}

/* Position cycle items */
.cycle-1 { top: 20%; left: 50%; }
.cycle-2 { top: 40%; left: 85%; }
.cycle-3 { top: 80%; left: 85%; }
.cycle-4 { top: 80%; left: 15%; }
.cycle-5 { top: 40%; left: 15%; }

.diagram-note {
    margin-top: 30px;
    padding: 20px;
    background: #f8fafc;
    border-radius: 8px;
    border-left: 4px solid #38a169;
}

.diagram-note p {
    margin: 0;
    color: #555;
    font-size: 15px;
    line-height: 1.5;
}

/* Manfaat Section */
.manfaat-section {
    margin-bottom: 20px;
}

.manfaat-box {
    background: #fff;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 30px;
}

.manfaat-title {
    display: flex;
    align-items: center;
    margin-bottom: 30px;
    padding-bottom: 15px;
    border-bottom: 1px solid #eee;
}

.manfaat-title i {
    font-size: 20px;
    color: #2c5282;
    margin-right: 12px;
}

.manfaat-title h3 {
    margin: 0;
    font-size: 20px;
    color: #333;
    font-weight: 500;
}

.manfaat-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 25px;
}

.manfaat-item {
    padding: 20px;
    background: #f8fafc;
    border-radius: 8px;
    text-align: center;
    transition: all 0.3s ease;
}

.manfaat-item:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 15px rgba(0,0,0,0.08);
}

.manfaat-icon {
    width: 60px;
    height: 60px;
    background: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.manfaat-icon i {
    font-size: 24px;
    color: #2c5282;
}

.manfaat-item h4 {
    margin: 0 0 10px 0;
    color: #333;
    font-size: 16px;
    font-weight: 500;
}

.manfaat-item p {
    margin: 0;
    color: #666;
    font-size: 14px;
    line-height: 1.5;
}

/* Responsive */
@media (max-width: 768px) {
    .spmi-page {
        padding: 30px 15px;
    }
    
    .deskripsi-box, .siklus-box, .diagram-box, .manfaat-box {
        padding: 25px;
    }
    
    .header-minimal h1 {
        font-size: 28px;
    }
    
    .siklus-item {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }
    
    .siklus-number, .siklus-icon {
        margin-right: 0;
        margin-bottom: 15px;
    }
    
    .cycle-circle {
        width: 300px;
        height: 300px;
    }
    
    .cycle-icon {
        width: 50px;
        height: 50px;
    }
    
    .cycle-icon i {
        font-size: 20px;
    }
    
    .cycle-label {
        font-size: 12px;
    }
    
    .cycle-center {
        width: 80px;
        height: 80px;
        font-size: 14px;
    }
    
    .manfaat-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 480px) {
    .cycle-circle {
        width: 250px;
        height: 250px;
    }
    
    .cycle-icon {
        width: 40px;
        height: 40px;
    }
    
    .cycle-icon i {
        font-size: 18px;
    }
    
    .cycle-center {
        width: 60px;
        height: 60px;
        font-size: 12px;
    }
}

/* Animation */
.deskripsi-box, .siklus-box, .diagram-box, .manfaat-box {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.deskripsi-box:hover, .siklus-box:hover, .diagram-box:hover, .manfaat-box:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}
</style>
@endsection
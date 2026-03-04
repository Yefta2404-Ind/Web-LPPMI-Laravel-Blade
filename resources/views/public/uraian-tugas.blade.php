@extends('layouts.public')

@section('title', 'Uraian Tugas')

@section('content')
<div class="tugas-page">
    <!-- Header Minimal -->
    <div class="header-minimal">
        <h1>Uraian Tugas</h1>
        <p>Lembaga Pengendalian dan Penjaminan Mutu Internal Universitas Gunungkidul</p>
    </div>

    <!-- Deskripsi Utama -->
    <div class="deskripsi-utama">
        <div class="deskripsi-box">
            <div class="deskripsi-title">
                <i class="fas fa-university"></i>
                <h3>Tentang LPPMI</h3>
            </div>
            <div class="deskripsi-content">
                <p>Lembaga Pengendalian dan Penjaminan Mutu Internal (LPPMI) merupakan unsur pelaksana yang membantu pimpinan Universitas dalam melakukan penetapan, pelaksanaan, evaluasi, pengendalian dan peningkatan mutu Universitas.</p>
            </div>
        </div>
    </div>

    <!-- Tugas Pokok -->
    <div class="tugas-section">
        <div class="tugas-box">
            <div class="tugas-title">
                <i class="fas fa-bullseye"></i>
                <h3>Tugas Pokok LPPMI</h3>
            </div>
            <div class="tugas-content">
                <div class="tugas-item">
                    <span class="tugas-icon">
                        <i class="fas fa-cog"></i>
                    </span>
                    <div class="tugas-text">
                        <h4>Pengembangan Sistem Penjaminan Mutu</h4>
                        <p>Mengembangkan dan menerapkan sistem penjaminan mutu internal (SPMI) yang terintegrasi dengan standar nasional pendidikan tinggi.</p>
                    </div>
                </div>
                <div class="tugas-item">
                    <span class="tugas-icon">
                        <i class="fas fa-chart-line"></i>
                    </span>
                    <div class="tugas-text">
                        <h4>Monitoring dan Evaluasi</h4>
                        <p>Melakukan pemantauan dan evaluasi secara berkala terhadap pelaksanaan standar mutu di seluruh unit kerja universitas.</p>
                    </div>
                </div>
                <div class="tugas-item">
                    <span class="tugas-icon">
                        <i class="fas fa-clipboard-check"></i>
                    </span>
                    <div class="tugas-text">
                        <h4>Audit Mutu Internal</h4>
                        <p>Melaksanakan audit mutu internal untuk memastikan kesesuaian dengan standar yang telah ditetapkan.</p>
                    </div>
                </div>
                <div class="tugas-item">
                    <span class="tugas-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </span>
                    <div class="tugas-text">
                        <h4>Pendampingan dan Konsultasi</h4>
                        <p>Memberikan pendampingan dan konsultasi kepada unit kerja dalam penyusunan dan implementasi dokumen mutu.</p>
                    </div>
                </div>
                <div class="tugas-item">
                    <span class="tugas-icon">
                        <i class="fas fa-file-contract"></i>
                    </span>
                    <div class="tugas-text">
                        <h4>Pelaporan Mutu</h4>
                        <p>Menyusun laporan periodik tentang pencapaian mutu universitas kepada pimpinan dan stakeholders terkait.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Fungsi Utama -->
    <div class="fungsi-section">
        <div class="fungsi-box">
            <div class="fungsi-title">
                <i class="fas fa-tasks"></i>
                <h3>Fungsi Utama</h3>
            </div>
            <div class="fungsi-content">
                <div class="fungsi-grid">
                    <div class="fungsi-item">
                        <div class="fungsi-number">01</div>
                        <div class="fungsi-detail">
                            <h4>Perencanaan Mutu</h4>
                            <p>Menyusun rencana strategis penjaminan mutu universitas</p>
                        </div>
                    </div>
                    <div class="fungsi-item">
                        <div class="fungsi-number">02</div>
                        <div class="fungsi-detail">
                            <h4>Implementasi SPMI</h4>
                            <p>Mengimplementasikan sistem penjaminan mutu internal di seluruh unit</p>
                        </div>
                    </div>
                    <div class="fungsi-item">
                        <div class="fungsi-number">03</div>
                        <div class="fungsi-detail">
                            <h4>Evaluasi Kinerja</h4>
                            <p>Melakukan evaluasi kinerja mutu akademik dan non-akademik</p>
                        </div>
                    </div>
                    <div class="fungsi-item">
                        <div class="fungsi-number">04</div>
                        <div class="fungsi-detail">
                            <h4>Pengendalian Mutu</h4>
                            <p>Melakukan pengendalian untuk memastikan standar mutu tercapai</p>
                        </div>
                    </div>
                    <div class="fungsi-item">
                        <div class="fungsi-number">05</div>
                        <div class="fungsi-detail">
                            <h4>Peningkatan Berkelanjutan</h4>
                            <p>Merancang program peningkatan mutu secara terus-menerus</p>
                        </div>
                    </div>
                    <div class="fungsi-item">
                        <div class="fungsi-number">06</div>
                        <div class="fungsi-detail">
                            <h4>Koordinasi dan Supervisi</h4>
                            <p>Mengoordinasikan dan mensupervisi pelaksanaan penjaminan mutu</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
</div>

<!-- CSS Minimal -->
<style>
/* Base */
.tugas-page {
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
    margin: 0;
    color: #444;
    font-size: 16px;
    line-height: 1.6;
    text-align: justify;
}

/* Tugas Section */
.tugas-section, .fungsi-section, .area-section {
    margin-bottom: 40px;
}

.tugas-box, .fungsi-box, .area-box {
    background: #fff;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 30px;
}

.tugas-title, .fungsi-title, .area-title {
    display: flex;
    align-items: center;
    margin-bottom: 30px;
    padding-bottom: 15px;
    border-bottom: 1px solid #eee;
}

.tugas-title i, .fungsi-title i, .area-title i {
    font-size: 20px;
    color: #2c5282;
    margin-right: 12px;
}

.tugas-title h3, .fungsi-title h3, .area-title h3 {
    margin: 0;
    font-size: 20px;
    color: #333;
    font-weight: 500;
}

/* Tugas Item */
.tugas-item {
    display: flex;
    align-items: flex-start;
    margin-bottom: 25px;
    padding-bottom: 25px;
    border-bottom: 1px solid #f5f5f5;
}

.tugas-item:last-child {
    margin-bottom: 0;
    padding-bottom: 0;
    border-bottom: none;
}

.tugas-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 50px;
    height: 50px;
    background: #f0f7ff;
    border-radius: 8px;
    margin-right: 20px;
    flex-shrink: 0;
}

.tugas-icon i {
    font-size: 20px;
    color: #2c5282;
}

.tugas-text h4 {
    margin: 0 0 8px 0;
    color: #333;
    font-size: 18px;
    font-weight: 500;
}

.tugas-text p {
    margin: 0;
    color: #555;
    font-size: 15px;
    line-height: 1.5;
}

/* Fungsi Grid */
.fungsi-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
}

.fungsi-item {
    display: flex;
    align-items: flex-start;
    padding: 20px;
    background: #f8fafc;
    border-radius: 8px;
    border-left: 4px solid #2c5282;
}

.fungsi-number {
    font-size: 24px;
    font-weight: 700;
    color: #2c5282;
    margin-right: 15px;
    opacity: 0.8;
}

.fungsi-detail h4 {
    margin: 0 0 5px 0;
    color: #333;
    font-size: 16px;
    font-weight: 500;
}

.fungsi-detail p {
    margin: 0;
    color: #666;
    font-size: 14px;
    line-height: 1.4;
}

/* Area Content */
.area-content {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
}

.area-item {
    display: flex;
    align-items: center;
    padding: 15px;
    background: #f8fafc;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.area-item:hover {
    background: #e6f2ff;
    transform: translateY(-2px);
}

.area-item i {
    font-size: 18px;
    color: #2c5282;
    margin-right: 12px;
}

.area-item span {
    color: #444;
    font-size: 14px;
    font-weight: 500;
}

/* Responsive */
@media (max-width: 768px) {
    .tugas-page {
        padding: 30px 15px;
    }
    
    .tugas-box, .fungsi-box, .area-box, .deskripsi-box {
        padding: 25px;
    }
    
    .header-minimal h1 {
        font-size: 28px;
    }
    
    .tugas-item {
        flex-direction: column;
    }
    
    .tugas-icon {
        margin-right: 0;
        margin-bottom: 15px;
    }
    
    .fungsi-grid {
        grid-template-columns: 1fr;
    }
    
    .area-content {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 480px) {
    .area-content {
        grid-template-columns: 1fr;
    }
}

/* Animation */
.tugas-box, .fungsi-box, .area-box, .deskripsi-box {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.tugas-box:hover, .fungsi-box:hover, .area-box:hover, .deskripsi-box:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}
</style>
@endsection
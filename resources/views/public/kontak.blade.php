@extends('layouts.public')

@section('title', 'Kontak')

@section('content')
<div class="kontak-page">
    <!-- Header Minimal -->
    <div class="header-minimal">
        <h1>Kontak</h1>
        <p>Lembaga Pengendalian dan Penjaminan Mutu Internal  Universitas Gunungkidul</p>
    </div>

    <!-- Kontak Section -->
    <div class="kontak-section">
        <!-- Alamat -->
        <div class="kontak-box">
            <div class="kontak-title">
                <i class="fas fa-map-marker-alt"></i>
                <h3>Alamat</h3>
            </div>
            <div class="kontak-content">
                <p><strong>Lembaga Penjaminan Mutu</strong></p>
                <p>Universitas Gunungkidul</p>
                <p>Jl. KH. Agus Salim No. 170</p>
                <p>Ledoksari, Wonosari</p>
                <p>Gunungkidul, DIY 55813</p>
            </div>
        </div>

        <!-- Kontak Info -->
        <div class="kontak-box">
            <div class="kontak-title">
                <i class="fas fa-phone"></i>
                <h3>Kontak</h3>
            </div>
            <div class="kontak-content">
                <div class="kontak-item">
                    <span class="label">Telepon:</span>
                    <a href="tel:085228499988">0852-2849-9988</a>
                </div>
                <div class="kontak-item">
                    <span class="label">Email:</span>
                    <a href="mailto:spmi@ugk.ac.id">spmi@ugk.ac.id</a>
                </div>
                <div class="kontak-item">
                    <span class="label">Jam Kerja:</span>
                    <div>
                        <p>Senin - Kamis: 08:00 - 16:00</p>
                        <p>Jumat: 08:00 - 16:30</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CSS Minimal -->
<style>
/* Base */
.kontak-page {
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

/* Kontak Section */
.kontak-section {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    margin-bottom: 40px;
}

/* Kontak Box */
.kontak-box {
    background: #fff;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 30px;
}

.kontak-title {
    display: flex;
    align-items: center;
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 1px solid #eee;
}

.kontak-title i {
    font-size: 20px;
    color: #2c5282;
    margin-right: 12px;
}

.kontak-title h3 {
    margin: 0;
    font-size: 20px;
    color: #333;
    font-weight: 500;
}

/* Kontak Content */
.kontak-content {
    line-height: 1.6;
}

.kontak-content p {
    margin: 8px 0;
    color: #444;
}

.kontak-item {
    margin-bottom: 20px;
}

.kontak-item:last-child {
    margin-bottom: 0;
}

.kontak-item .label {
    display: block;
    font-weight: 500;
    color: #333;
    margin-bottom: 5px;
    font-size: 15px;
}

.kontak-item a {
    color: #2c5282;
    text-decoration: none;
    font-size: 16px;
    display: inline-block;
}

.kontak-item a:hover {
    text-decoration: underline;
}

.kontak-item p {
    margin: 3px 0;
    color: #555;
    font-size: 15px;
}

/* Responsive */
@media (max-width: 768px) {
    .kontak-page {
        padding: 30px 15px;
    }
    
    .kontak-section {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .kontak-box {
        padding: 25px;
    }
    
    .header-minimal h1 {
        font-size: 28px;
    }
}
</style>
@endsection
@extends('layouts.cms')

@section('page-title', 'Data Berita')
@section('content')

<style>
/* ============================================
   MODERN NEWS MANAGEMENT - PROFESSIONAL DESIGN
   FULLY RESPONSIVE + SMOOTH ANIMATIONS
   ============================================ */
   
/* ----- CSS VARIABLES ----- */
:root {
    --primary: #2563eb;
    --primary-dark: #1d4ed8;
    --primary-light: #3b82f6;
    --primary-bg: #eff6ff;
    --success: #10b981;
    --success-dark: #059669;
    --success-bg: #ecfdf5;
    --warning: #f59e0b;
    --warning-dark: #d97706;
    --warning-bg: #fffbeb;
    --danger: #ef4444;
    --danger-dark: #dc2626;
    --danger-bg: #fef2f2;
    --gray-50: #f9fafb;
    --gray-100: #f3f4f6;
    --gray-200: #e5e7eb;
    --gray-300: #d1d5db;
    --gray-400: #9ca3af;
    --gray-500: #6b7280;
    --gray-600: #4b5563;
    --gray-700: #374151;
    --gray-800: #1f2937;
    --gray-900: #111827;
    --shadow-xs: 0 1px 2px rgba(0, 0, 0, 0.03);
    --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.05);
    --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.07);
    --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    --radius-sm: 8px;
    --radius-md: 12px;
    --radius-lg: 16px;
    --radius-xl: 20px;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    background: linear-gradient(135deg, #f5f7fa 0%, #f0f4f8 100%);
    min-height: 100vh;
}

/* ============================================
   MAIN CONTAINER - RESPONSIVE PADDING
   ============================================ */
.news-container {
    max-width: 1440px;
    margin: 0 auto;
    padding: 16px;
}

@media (min-width: 640px) {
    .news-container { padding: 20px 24px; }
}
@media (min-width: 1024px) {
    .news-container { padding: 24px 32px; }
}
@media (min-width: 1280px) {
    .news-container { padding: 32px 40px; }
}

/* ============================================
   HEADER SECTION
   ============================================ */
.page-header {
    margin-bottom: 28px;
    padding-bottom: 20px;
    border-bottom: 2px solid rgba(37, 99, 235, 0.12);
    position: relative;
}

.page-header::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 60px;
    height: 2px;
    background: linear-gradient(90deg, var(--primary), var(--primary-light));
    border-radius: 2px;
}

.page-title {
    font-size: 1.5rem;
    font-weight: 700;
    background: linear-gradient(135deg, var(--gray-800), var(--gray-600));
    background-clip: text;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.page-description {
    color: var(--gray-500);
    font-size: 0.875rem;
    line-height: 1.5;
}

@media (min-width: 768px) {
    .page-title { font-size: 1.75rem; }
    .page-description { font-size: 0.9375rem; }
}
@media (min-width: 1024px) {
    .page-title { font-size: 2rem; }
}

/* ============================================
   ALERT NOTIFICATIONS
   ============================================ */
.alert {
    padding: 14px 18px;
    border-radius: var(--radius-md);
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 0.875rem;
    animation: slideDown 0.4s cubic-bezier(0.2, 0.9, 0.4, 1.1);
    box-shadow: var(--shadow-sm);
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.alert-success {
    background: var(--success-bg);
    color: var(--success-dark);
    border-left: 4px solid var(--success);
}

.alert-error {
    background: var(--danger-bg);
    color: var(--danger-dark);
    border-left: 4px solid var(--danger);
}

.alert i {
    font-size: 1.1rem;
    flex-shrink: 0;
}

/* ============================================
   STATISTICS CARDS - MODERN METRICS
   ============================================ */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 14px;
    margin-bottom: 28px;
}

@media (min-width: 480px) {
    .stats-grid { grid-template-columns: repeat(4, 1fr); gap: 16px; }
}
@media (min-width: 1024px) {
    .stats-grid { gap: 20px; margin-bottom: 32px; }
}

.stat-card {
    background: white;
    border-radius: var(--radius-lg);
    padding: 16px 14px;
    transition: all 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1);
    border: 1px solid var(--gray-200);
    box-shadow: var(--shadow-xs);
    cursor: pointer;
    position: relative;
    overflow: hidden;
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--primary), var(--primary-light));
    transform: scaleX(0);
    transition: transform 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-lg);
    border-color: var(--primary-light);
}

.stat-card:hover::before {
    transform: scaleX(1);
}

.stat-card.active {
    border-color: var(--primary);
    background: linear-gradient(135deg, white, var(--primary-bg));
    box-shadow: var(--shadow-md);
}

.stat-card.active::before {
    transform: scaleX(1);
}

.stat-icon {
    width: 44px;
    height: 44px;
    border-radius: var(--radius-md);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 12px;
    font-size: 1.25rem;
}

@media (min-width: 640px) {
    .stat-icon { width: 48px; height: 48px; font-size: 1.35rem; }
}

.stat-icon.total {
    background: linear-gradient(135deg, var(--primary-bg), #dbeafe);
    color: var(--primary);
}
.stat-icon.draft {
    background: linear-gradient(135deg, #f3f4f6, #e5e7eb);
    color: var(--gray-600);
}
.stat-icon.pending {
    background: linear-gradient(135deg, var(--warning-bg), #fef3c7);
    color: var(--warning);
}
.stat-icon.approved {
    background: linear-gradient(135deg, var(--success-bg), #d1fae5);
    color: var(--success);
}

.stat-label {
    font-size: 0.7rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: var(--gray-500);
    margin-bottom: 6px;
}

.stat-value {
    font-size: 1.75rem;
    font-weight: 800;
    color: var(--gray-800);
    line-height: 1.2;
}

@media (min-width: 640px) {
    .stat-label { font-size: 0.75rem; }
    .stat-value { font-size: 2rem; }
}
@media (min-width: 1024px) {
    .stat-value { font-size: 2.25rem; }
}

/* ============================================
   NEWS GRID - FULLY RESPONSIVE
   ============================================ */
.news-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 20px;
    margin-bottom: 32px;
}

@media (min-width: 480px) {
    .news-grid { gap: 24px; }
}
@media (min-width: 640px) {
    .news-grid { grid-template-columns: repeat(2, 1fr); gap: 20px; }
}
@media (min-width: 1024px) {
    .news-grid { grid-template-columns: repeat(3, 1fr); gap: 24px; }
}
@media (min-width: 1280px) {
    .news-grid { grid-template-columns: repeat(3, 1fr); gap: 28px; }
}

/* ============================================
   NEWS CARD - ELEVATED DESIGN
   ============================================ */
.news-card {
    background: white;
    border-radius: var(--radius-xl);
    overflow: visible;
    transition: all 0.4s cubic-bezier(0.2, 0.9, 0.4, 1.1);
    border: 1px solid var(--gray-200);
    box-shadow: var(--shadow-sm);
    position: relative;
}

.news-card:hover {
    transform: translateY(-6px);
    box-shadow: var(--shadow-xl);
    border-color: var(--gray-300);
}

/* Image Container */
.news-image-wrapper {
    position: relative;
    width: 100%;
    height: 200px;
    overflow: hidden;
    background: linear-gradient(135deg, #e5e7eb, #d1d5db);
}

@media (min-width: 640px) {
    .news-image-wrapper { height: 210px; }
}
@media (min-width: 1024px) {
    .news-image-wrapper { height: 220px; }
}

.news-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s cubic-bezier(0.2, 0.9, 0.4, 1.1);
}

.news-card:hover .news-image {
    transform: scale(1.05);
}

/* Status Badge */
.status-badge {
    position: absolute;
    top: 14px;
    right: 14px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 5px 12px;
    border-radius: 30px;
    font-size: 0.7rem;
    font-weight: 600;
    backdrop-filter: blur(10px);
    background: rgba(0, 0, 0, 0.75);
    color: white;
    z-index: 2;
    box-shadow: var(--shadow-sm);
}

.status-badge i { font-size: 0.65rem; }

.status-badge.draft { background: rgba(0, 0, 0, 0.8); }
.status-badge.pending { background: rgba(245, 158, 11, 0.95); }
.status-badge.approved { background: rgba(16, 185, 129, 0.95); }
.status-badge.rejected { background: rgba(239, 68, 68, 0.95); }

/* Content Area */
.news-content {
    padding: 18px 16px 16px;
}

@media (min-width: 640px) {
    .news-content { padding: 20px 18px 18px; }
}
@media (min-width: 1024px) {
    .news-content { padding: 22px 20px 20px; }
}

/* Category */
.news-category {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 4px 12px;
    background: var(--primary-bg);
    color: var(--primary-dark);
    border-radius: 30px;
    font-size: 0.7rem;
    font-weight: 600;
    margin-bottom: 12px;
}

/* Title */
.news-title {
    font-size: 1rem;
    font-weight: 700;
    color: var(--gray-800);
    line-height: 1.4;
    margin-bottom: 10px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

@media (min-width: 640px) {
    .news-title { font-size: 1.1rem; margin-bottom: 12px; }
}
@media (min-width: 1024px) {
    .news-title { font-size: 1.125rem; }
}

/* Excerpt */
.news-excerpt {
    font-size: 0.8rem;
    color: var(--gray-600);
    line-height: 1.55;
    margin-bottom: 16px;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Meta Info */
.news-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 14px;
    border-top: 1px solid var(--gray-200);
    flex-wrap: wrap;
    gap: 10px;
}

.meta-info {
    display: flex;
    align-items: center;
    gap: 14px;
    flex-wrap: wrap;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 0.7rem;
    color: var(--gray-500);
}

.meta-item i {
    font-size: 0.65rem;
    color: var(--primary);
}

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 8px;
}

.btn-action {
    width: 34px;
    height: 34px;
    border-radius: var(--radius-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    background: white;
    border: 1px solid var(--gray-200);
    cursor: pointer;
    transition: all 0.2s ease;
    color: var(--gray-500);
    text-decoration: none;
}

.btn-action:hover {
    transform: translateY(-2px);
}

.btn-action.edit:hover {
    background: var(--primary-bg);
    border-color: var(--primary);
    color: var(--primary);
}

.btn-action.delete:hover {
    background: var(--danger-bg);
    border-color: var(--danger);
    color: var(--danger);
}

.btn-action.disabled {
    opacity: 0.4;
    cursor: not-allowed;
    pointer-events: none;
}

/* ============================================
   IMPROVED TOOLTIP - FULLY VISIBLE
   ============================================ */
.tooltip-wrapper {
    position: relative;
    display: inline-block;
}

/* Tooltip Container */
.tooltip-wrapper .tooltip-text {
    visibility: hidden;
    opacity: 0;
    position: absolute;
    bottom: 125%;
    right : 0 ;
    left: auto;
    transform: none;
    background: #1f2937;
    color: white;
    text-align: center;
    padding: 8px 14px;
    border-radius: 8px;
    font-size: 0.75rem;
    font-weight: 500;
    white-space: nowrap;
    z-index: 1000;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    transition: all 0.2s ease;
    pointer-events: none;
    line-height: 1.4;
}

/* Tooltip Arrow */
.tooltip-wrapper .tooltip-text::after {
    content: '';
    position: absolute;
    top: 100%;
    left: 50%;
    transform: translateX(-50%);
    border-width: 6px;
    border-style: solid;
    border-color: #1f2937 transparent transparent transparent;
}

/* Show tooltip on hover */
.tooltip-wrapper:hover .tooltip-text {
    visibility: visible;
    opacity: 1;
    transform: translateX(-50%) translateY(-5px);
}

/* Alternative position for mobile (top-right to avoid cutting off) */
@media (max-width: 640px) {
    .tooltip-wrapper .tooltip-text {
        bottom: auto;
        top: 125%;
        left: auto;
        right: 0;
        transform: translateX(0);
        white-space: normal;
        max-width: 220px;
        min-width: 180px;
        word-wrap: break-word;
        text-align: left;
    }
    
    .tooltip-wrapper .tooltip-text::after {
        top: auto;
        bottom: 100%;
        left: auto;
        right: 10px;
        transform: translateX(0);
        border-color: transparent transparent #1f2937 transparent;
    }
    
    .tooltip-wrapper:hover .tooltip-text {
        transform: translateY(-5px);
    }
}

/* For very small screens, position differently */
@media (max-width: 480px) {
    .tooltip-wrapper .tooltip-text {
        max-width: 200px;
        min-width: 160px;
        font-size: 0.7rem;
        padding: 6px 10px;
    }
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 60px 24px;
    background: white;
    border-radius: var(--radius-xl);
    border: 1px solid var(--gray-200);
    box-shadow: var(--shadow-sm);
}

.empty-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, var(--primary-bg), #dbeafe);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    font-size: 2rem;
    color: var(--primary);
}

.empty-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--gray-700);
    margin-bottom: 8px;
}

.empty-description {
    font-size: 0.875rem;
    color: var(--gray-500);
    margin-bottom: 24px;
    max-width: 400px;
    margin-left: auto;
    margin-right: auto;
}

.btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    color: white;
    border: none;
    border-radius: var(--radius-md);
    font-size: 0.875rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    box-shadow: var(--shadow-sm);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.btn-outline {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    background: white;
    color: var(--primary);
    border: 1px solid var(--gray-300);
    border-radius: var(--radius-md);
    font-size: 0.875rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
}

.btn-outline:hover {
    border-color: var(--primary);
    background: var(--primary-bg);
    transform: translateY(-2px);
}

/* ============================================
   PAGINATION
   ============================================ */
.pagination-wrapper {
    margin-top: 32px;
    padding-top: 24px;
    border-top: 1px solid var(--gray-200);
}

.pagination {
    display: flex;
    justify-content: center;
    gap: 6px;
    flex-wrap: wrap;
}

.pagination-item {
    min-width: 38px;
    height: 38px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0 10px;
    border: 1px solid var(--gray-200);
    border-radius: var(--radius-sm);
    font-size: 0.875rem;
    color: var(--gray-600);
    text-decoration: none;
    transition: all 0.2s ease;
    background: white;
}

.pagination-item:hover {
    border-color: var(--primary);
    color: var(--primary);
    transform: translateY(-2px);
}

.pagination-item.active {
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    border-color: var(--primary);
    color: white;
}

.pagination-item.disabled {
    opacity: 0.5;
    cursor: not-allowed;
    pointer-events: none;
}

/* ============================================
   RESPONSIVE TOUCH OPTIMIZATIONS
   ============================================ */
@media (hover: none) and (pointer: coarse) {
    .stat-card,
    .btn-action,
    .pagination-item,
    .btn-primary,
    .btn-outline {
        min-height: 48px;
    }
    
    .btn-action {
        min-width: 48px;
    }
    
    .stat-card:active {
        transform: scale(0.97);
    }
    
    .btn-action:active {
        transform: scale(0.95);
    }
    
    /* For touch devices, show tooltip on tap */
    .tooltip-wrapper .tooltip-text {
        visibility: hidden;
    }
    
    .tooltip-wrapper:active .tooltip-text {
        visibility: visible;
        opacity: 1;
    }
}

/* ============================================
   PRINT STYLES
   ============================================ */
@media print {
    body {
        background: white;
    }
    
    .stats-grid,
    .action-buttons,
    .pagination-wrapper,
    .alert {
        display: none;
    }
    
    .news-card {
        break-inside: avoid;
        border: 1px solid #ddd;
        box-shadow: none;
        margin-bottom: 20px;
    }
    
    .news-card:hover {
        transform: none;
    }
}

/* ============================================
   ANIMATIONS
   ============================================ */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes scaleIn {
    from {
        opacity: 0;
        transform: scale(0.95);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

.animate-fade-up {
    animation: fadeInUp 0.5s cubic-bezier(0.2, 0.9, 0.4, 1.1) forwards;
}

.animate-scale {
    animation: scaleIn 0.4s cubic-bezier(0.2, 0.9, 0.4, 1) forwards;
}

.delay-100 { animation-delay: 0.1s; }
.delay-200 { animation-delay: 0.2s; }
.delay-300 { animation-delay: 0.3s; }

@media (prefers-reduced-motion: reduce) {
    .animate-fade-up,
    .animate-scale {
        animation: none;
        opacity: 1;
        transform: none;
    }
}
</style>

<div class="news-container">
    <!-- Header -->
    <div class="page-header animate-fade-up">
        <h1 class="page-title">
            📰 Manajemen Berita
        </h1>
        <p class="page-description">
            Kelola semua berita yang telah Anda buat. Pantau status, edit konten, atau hapus berita yang tidak diperlukan.
        </p>
    </div>

    <!-- Alerts -->
    @if(session('success'))
        <div class="alert alert-success animate-fade-up">
            <i class="fas fa-check-circle"></i>
            <span style="flex: 1;">{{ session('success') }}</span>
            <i class="fas fa-times" style="cursor: pointer; opacity: 0.6;" onclick="this.closest('.alert').remove()"></i>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error animate-fade-up">
            <i class="fas fa-exclamation-circle"></i>
            <span style="flex: 1;">{{ session('error') }}</span>
            <i class="fas fa-times" style="cursor: pointer; opacity: 0.6;" onclick="this.closest('.alert').remove()"></i>
        </div>
    @endif

    <!-- Statistics -->
    @php
        $totalNews = $news->total();
        $pendingCount = $news->where('status', 'pending')->count();
        $approvedCount = $news->where('status', 'approved')->count();
        $rejectedCount = $news->where('status', 'rejected')->count();
        $draftCount = $news->where('status', 'draft')->count();
        $currentStatus = request('status');
    @endphp

    <div class="stats-grid animate-fade-up delay-100">
        <div class="stat-card {{ !$currentStatus ? 'active' : '' }}" onclick="filterByStatus('')">
            <div class="stat-icon total">
                <i class="fas fa-newspaper"></i>
            </div>
            <div class="stat-label">Total Berita</div>
            <div class="stat-value">{{ number_format($totalNews) }}</div>
        </div>

        <div class="stat-card {{ $currentStatus == 'draft' ? 'active' : '' }}" onclick="filterByStatus('draft')">
            <div class="stat-icon draft">
                <i class="fas fa-pen-fancy"></i>
            </div>
            <div class="stat-label">Draft</div>
            <div class="stat-value">{{ number_format($draftCount) }}</div>
        </div>

        <div class="stat-card {{ $currentStatus == 'pending' ? 'active' : '' }}" onclick="filterByStatus('pending')">
            <div class="stat-icon pending">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-label">Menunggu</div>
            <div class="stat-value">{{ number_format($pendingCount) }}</div>
        </div>

        <div class="stat-card {{ $currentStatus == 'approved' ? 'active' : '' }}" onclick="filterByStatus('approved')">
            <div class="stat-icon approved">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-label">Disetujui</div>
            <div class="stat-value">{{ number_format($approvedCount) }}</div>
        </div>
    </div>

    <!-- News Grid -->
    <div class="news-grid">
        @forelse($news as $index => $n)
            <div class="news-card animate-scale" style="animation-delay: {{ $index * 0.05 }}s">
                <!-- Image -->
                <div class="news-image-wrapper">
                    <img 
                        src="{{ $n->image ? asset('storage/'.$n->image) : 'https://placehold.co/800x600/e5e7eb/9ca3af?text=No+Image' }}" 
                        alt="{{ $n->title }}"
                        class="news-image"
                        loading="lazy"
                        onerror="this.src='https://placehold.co/800x600/e5e7eb/9ca3af?text=No+Image'"
                    >
                    
                    <!-- Status Badge -->
                    <div class="status-badge {{ $n->status }}">
                        @if($n->status === 'draft')
                            <i class="fas fa-pen-fancy"></i> Draft
                        @elseif($n->status === 'pending')
                            <i class="fas fa-clock"></i> Menunggu
                        @elseif($n->status === 'approved')
                            <i class="fas fa-check-circle"></i> Disetujui
                        @elseif($n->status === 'rejected')
                            <i class="fas fa-times-circle"></i> Ditolak
                        @endif
                    </div>
                </div>
                
                <!-- Content -->
                <div class="news-content">
                    @if($n->category)
                        <div class="news-category">
                            <i class="fas fa-folder-open"></i>
                            {{ $n->category->name ?? 'Uncategorized' }}
                        </div>
                    @endif
                    
                    <h3 class="news-title">
                        {{ Str::limit($n->title, 65) }}
                    </h3>
                    
                    <div class="news-excerpt">
                        {{ Str::limit(strip_tags($n->content), 110) }}
                    </div>
                    
                    <div class="news-meta">
                        <div class="meta-info">
                            <div class="meta-item">
                                <i class="fas fa-calendar-alt"></i>
                                <span>{{ $n->created_at->translatedFormat('d M Y') }}</span>
                            </div>
                            @if($n->views)
                                <div class="meta-item">
                                    <i class="fas fa-eye"></i>
                                    <span>{{ number_format($n->views) }}</span>
                                </div>
                            @endif
                        </div>
                        
                        <div class="action-buttons">
                            <!-- Edit Button -->
                            @if(in_array($n->status, ['draft', 'pending', 'rejected']))
                                <a href="{{ route('staff.news.edit', $n) }}" 
                                   class="btn-action edit"
                                   title="Edit Berita">
                                    <i class="fas fa-edit"></i>
                                </a>
                            @endif
                            
                            <!-- Delete Button - ONLY FOR PENDING STATUS -->
                            @if($n->status === 'pending')
                                <form method="POST" 
                                      action="{{ route('staff.news.destroy', $n) }}" 
                                      style="display: inline;"
                                      onsubmit="return confirm('⚠️ Peringatan!\n\nAnda akan menghapus berita ini secara permanen.\nTindakan ini tidak dapat dibatalkan.\n\nApakah Anda yakin ingin melanjutkan?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action delete" title="Hapus Berita">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            @else
                                <!-- IMPROVED TOOLTIP - FULLY VISIBLE -->
                                <div class="tooltip-wrapper">
                                    <button type="button" class="btn-action delete disabled" disabled>
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                    <span class="tooltip-text">
                                        @if($n->status === 'approved')
                                            <i class="fas fa-info-circle" style="margin-right: 4px;"></i>
                                            Berita yang sudah disetujui tidak dapat dihapus
                                        @elseif($n->status === 'rejected')
                                            <i class="fas fa-exclamation-triangle" style="margin-right: 4px;"></i>
                                            Berita ditolak, hubungi administrator
                                        @else
                                            <i class="fas fa-ban" style="margin-right: 4px;"></i>
                                            Tidak dapat dihapus
                                        @endif
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="empty-state animate-scale">
                <div class="empty-icon">
                    <i class="fas fa-newspaper"></i>
                </div>
                <h3 class="empty-title">
                    @if(request()->hasAny(['status', 'category', 'search']))
                        Tidak Ada Berita Ditemukan
                    @else
                        Belum Ada Berita
                    @endif
                </h3>
                <p class="empty-description">
                    @if(request()->hasAny(['status', 'category', 'search']))
                        Coba ubah filter pencarian Anda atau reset filter untuk melihat semua berita.
                    @else
                        Mulai buat berita pertama Anda sekarang. Berita akan tampil setelah disetujui oleh admin.
                    @endif
                </p>
                @if(request()->hasAny(['status', 'category', 'search']))
                    <a href="{{ route('staff.news.index') }}" class="btn-outline">
                        <i class="fas fa-times"></i> Reset Filter
                    </a>
                @else
                    <a href="{{ route('staff.news.create') }}" class="btn-primary">
                        <i class="fas fa-plus"></i> Buat Berita Baru
                    </a>
                @endif
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($news->hasPages())
        <div class="pagination-wrapper animate-fade-up delay-200">
            <div class="pagination">
                {{-- Previous --}}
                @if($news->onFirstPage())
                    <span class="pagination-item disabled">
                        <i class="fas fa-chevron-left"></i>
                    </span>
                @else
                    <a href="{{ $news->previousPageUrl() }}" class="pagination-item">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                @endif

                {{-- Page Numbers --}}
                @foreach($news->getUrlRange(1, $news->lastPage()) as $page => $url)
                    @if($page == $news->currentPage())
                        <span class="pagination-item active">{{ $page }}</span>
                    @elseif(abs($page - $news->currentPage()) <= 2 || $page == 1 || $page == $news->lastPage())
                        <a href="{{ $url }}" class="pagination-item">{{ $page }}</a>
                    @elseif(abs($page - $news->currentPage()) == 3)
                        <span class="pagination-item disabled">...</span>
                    @endif
                @endforeach

                {{-- Next --}}
                @if($news->hasMorePages())
                    <a href="{{ $news->nextPageUrl() }}" class="pagination-item">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                @else
                    <span class="pagination-item disabled">
                        <i class="fas fa-chevron-right"></i>
                    </span>
                @endif
            </div>
        </div>
    @endif
</div>

<script>
// Filter by status
function filterByStatus(status) {
    const url = new URL(window.location.href);
    if (status) {
        url.searchParams.set('status', status);
    } else {
        url.searchParams.delete('status');
    }
    url.searchParams.delete('page');
    window.location.href = url.toString();
}

// Auto-hide alerts after 5 seconds
document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-10px)';
            setTimeout(() => {
                if (alert && alert.remove) alert.remove();
            }, 300);
        }, 5000);
    });
    
    // Touch feedback for mobile
    const touchElements = document.querySelectorAll('.stat-card, .btn-action, .pagination-item, .btn-primary, .btn-outline');
    touchElements.forEach(el => {
        el.addEventListener('touchstart', function() {
            this.style.transform = 'scale(0.97)';
        }, { passive: true });
        el.addEventListener('touchend', function() {
            this.style.transform = '';
        });
        el.addEventListener('touchcancel', function() {
            this.style.transform = '';
        });
    });
});
</script>

@endsection
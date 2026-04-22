@extends('layouts.public')
@section('title', 'Struktur Organisasi')
@section('content')

<style>
/* ============================================
   PROFESSIONAL ORGANIZATION STRUCTURE STYLES
   WITH SOLID COLORS & SMOOTH ANIMATIONS
   ============================================ */
   
/* ----- RESET & BASE ----- */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    background: #f0f4f8;
    color: #1a1f36;
    line-height: 1.5;
}

/* ----- ANIMATIONS ----- */
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

@keyframes fadeInLeft {
    from {
        opacity: 0;
        transform: translateX(-20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes fadeInRight {
    from {
        opacity: 0;
        transform: translateX(20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes scaleIn {
    from {
        opacity: 0;
        transform: scale(0.9);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

@keyframes slideInDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes pulse {
    0%, 100% {
        transform: scale(1);
        opacity: 0.6;
    }
    50% {
        transform: scale(1.1);
        opacity: 1;
    }
}

@keyframes shimmer {
    0% {
        background-position: -200% 0;
    }
    100% {
        background-position: 200% 0;
    }
}

/* Animation Classes */
.animate-fade-up {
    animation: fadeInUp 0.6s cubic-bezier(0.2, 0.9, 0.4, 1.1) forwards;
}

.animate-fade-left {
    animation: fadeInLeft 0.5s ease forwards;
}

.animate-fade-right {
    animation: fadeInRight 0.5s ease forwards;
}

.animate-scale {
    animation: scaleIn 0.5s cubic-bezier(0.2, 0.9, 0.4, 1) forwards;
}

.animate-slide-down {
    animation: slideInDown 0.5s ease forwards;
}

/* Animation Delays */
.delay-100 { animation-delay: 0.1s; }
.delay-200 { animation-delay: 0.2s; }
.delay-300 { animation-delay: 0.3s; }
.delay-400 { animation-delay: 0.4s; }
.delay-500 { animation-delay: 0.5s; }

/* Reduced Motion Support */
@media (prefers-reduced-motion: reduce) {
    .animate-fade-up, .animate-fade-left, .animate-fade-right,
    .animate-scale, .animate-slide-down {
        animation: none;
        opacity: 1;
        transform: none;
    }
}

/* ----- LAYOUT ----- */
.org-wrapper {
    max-width: 1400px;
    margin: 0 auto;
    padding: 2rem 1rem;
}

@media (min-width: 768px) {
    .org-wrapper {
        padding: 2.5rem 1.5rem;
    }
}

@media (min-width: 1200px) {
    .org-wrapper {
        padding: 3rem 2rem;
    }
}

/* ----- HEADER SECTION ----- */
.org-header {
    margin-bottom: 2.5rem;
    padding-bottom: 1.5rem;
    border-bottom: 3px solid #2563eb;
    position: relative;
}

.org-header::after {
    content: '';
    position: absolute;
    bottom: -3px;
    left: 0;
    width: 80px;
    height: 3px;
    background: #4f46e5;
    animation: fadeInRight 0.6s ease forwards;
}

@media (min-width: 768px) {
    .org-header {
        margin-bottom: 3rem;
        padding-bottom: 2rem;
    }
}

.org-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #0f172a;
    letter-spacing: -0.3px;
    margin-bottom: 0.5rem;
    background: linear-gradient(135deg, #1e293b 0%, #2563eb 100%);
    background-clip: text;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

@media (min-width: 768px) {
    .org-title {
        font-size: 1.75rem;
    }
}

@media (min-width: 1024px) {
    .org-title {
        font-size: 2rem;
    }
}

.org-subtitle {
    font-size: 0.875rem;
    color: #64748b;
    margin-top: 0.25rem;
}

@media (min-width: 768px) {
    .org-subtitle {
        font-size: 1rem;
    }
}

/* ----- STRUCTURE CARD ----- */
.structure-card {
    background: #ffffff;
    border-radius: 16px;
    border: 1px solid #e2e8f0;
    margin-bottom: 2rem;
    overflow: hidden;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    transition: all 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1);
}

@media (min-width: 768px) {
    .structure-card {
        margin-bottom: 2.5rem;
        border-radius: 20px;
    }
}

.structure-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 20px 25px -12px rgba(0, 0, 0, 0.1);
}

/* Card Header - Solid Colors */
.card-header {
    padding: 1rem 1.25rem;
    border-bottom: 1px solid #eef2f6;
    display: flex;
    flex-wrap: wrap;
    align-items: baseline;
    justify-content: space-between;
    gap: 0.75rem;
    background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);
}

@media (min-width: 640px) {
    .card-header {
        padding: 1.25rem 1.5rem;
    }
}

@media (min-width: 1024px) {
    .card-header {
        padding: 1.5rem 2rem;
    }
}

.card-title {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    flex-wrap: wrap;
}

.card-badge {
    background: #2563eb;
    color: #ffffff;
    font-size: 0.75rem;
    font-weight: 700;
    padding: 0.25rem 0.875rem;
    border-radius: 30px;
    letter-spacing: 0.5px;
    box-shadow: 0 2px 4px rgba(37, 99, 235, 0.2);
}

@media (min-width: 640px) {
    .card-badge {
        font-size: 0.8125rem;
        padding: 0.3125rem 1rem;
    }
}

.card-name {
    font-size: 1rem;
    font-weight: 700;
    color: #0f172a;
}

@media (min-width: 640px) {
    .card-name {
        font-size: 1.125rem;
    }
}

@media (min-width: 1024px) {
    .card-name {
        font-size: 1.25rem;
    }
}

.card-stats {
    font-size: 0.75rem;
    color: #475569;
    background: #f1f5f9;
    padding: 0.25rem 0.875rem;
    border-radius: 30px;
    font-weight: 500;
}

@media (min-width: 640px) {
    .card-stats {
        font-size: 0.8125rem;
        padding: 0.3125rem 1rem;
    }
}

/* Card Body */
.card-body {
    padding: 1.25rem;
}

@media (min-width: 640px) {
    .card-body {
        padding: 1.5rem;
    }
}

@media (min-width: 1024px) {
    .card-body {
        padding: 2rem;
    }
}

/* ----- LEVEL SECTION ----- */
.level-section {
    margin-bottom: 1.75rem;
}

@media (min-width: 768px) {
    .level-section {
        margin-bottom: 2rem;
    }
}

.level-section:last-child {
    margin-bottom: 0;
}

.level-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1rem;
}

@media (min-width: 768px) {
    .level-header {
        margin-bottom: 1.25rem;
        gap: 1rem;
    }
}

.level-line {
    flex: 1;
    height: 2px;
    background: linear-gradient(90deg, transparent, #cbd5e1, transparent);
}

/* Level Label - Solid Colors */
.level-label {
    font-size: 0.6875rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    padding: 0.375rem 1rem;
    border-radius: 30px;
    color: #ffffff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

@media (min-width: 640px) {
    .level-label {
        font-size: 0.75rem;
        padding: 0.4375rem 1.25rem;
    }
}

/* Level Color Variants - Solid Colors */
.level-label.lv0 { background: #2563eb; }
.level-label.lv1 { background: #059669; }
.level-label.lv2 { background: #d97706; }
.level-label.lv3 { background: #7c3aed; }
.level-label.lv4 { background: #db2777; }
.level-label.lv5 { background: #475569; }

/* ----- MEMBER GRID (Fully Responsive) ----- */
.member-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 0.75rem;
}

@media (min-width: 480px) {
    .member-grid {
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
    }
}

@media (min-width: 640px) {
    .member-grid {
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
    }
}

@media (min-width: 768px) {
    .member-grid {
        grid-template-columns: repeat(3, 1fr);
        gap: 1.25rem;
    }
}

@media (min-width: 1024px) {
    .member-grid {
        grid-template-columns: repeat(4, 1fr);
        gap: 1.5rem;
    }
}

@media (min-width: 1280px) {
    .member-grid {
        grid-template-columns: repeat(5, 1fr);
        gap: 1.5rem;
    }
}

/* Single item grid */
.member-grid.single {
    grid-template-columns: 1fr;
    max-width: 280px;
    margin: 0 auto;
}

@media (min-width: 640px) {
    .member-grid.single {
        max-width: 300px;
    }
}

/* Two items grid */
.member-grid.double {
    grid-template-columns: repeat(2, 1fr);
    max-width: 500px;
    margin: 0 auto;
}

@media (min-width: 640px) {
    .member-grid.double {
        max-width: 560px;
    }
}

/* Three items grid */
.member-grid.triple {
    grid-template-columns: repeat(2, 1fr);
}

@media (min-width: 640px) {
    .member-grid.triple {
        grid-template-columns: repeat(3, 1fr);
    }
}

/* ----- MEMBER CARD ----- */
.member-card {
    background: #ffffff;
    border: 1px solid #eef2f6;
    border-radius: 14px;
    padding: 1rem 0.5rem 0.875rem;
    text-align: center;
    transition: all 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1);
    position: relative;
    overflow: hidden;
}

.member-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #2563eb, #4f46e5);
    transform: scaleX(0);
    transition: transform 0.3s ease;
}

@media (min-width: 640px) {
    .member-card {
        padding: 1.25rem 0.75rem 1rem;
        border-radius: 16px;
    }
}

@media (min-width: 1024px) {
    .member-card {
        padding: 1.5rem 1rem 1.25rem;
        border-radius: 18px;
    }
}

.member-card:hover {
    transform: translateY(-6px);
    border-color: #cbd5e1;
    box-shadow: 0 12px 20px -12px rgba(0, 0, 0, 0.15);
}

.member-card:hover::before {
    transform: scaleX(1);
}

/* Avatar - Solid Colors */
.member-avatar {
    width: 56px;
    height: 56px;
    margin: 0 auto 0.75rem;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1rem;
    overflow: hidden;
    transition: all 0.3s ease;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.08);
}

.member-card:hover .member-avatar {
    transform: scale(1.05);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.12);
}

@media (min-width: 640px) {
    .member-avatar {
        width: 64px;
        height: 64px;
        margin-bottom: 0.875rem;
        font-size: 1.125rem;
    }
}

@media (min-width: 1024px) {
    .member-avatar {
        width: 80px;
        height: 80px;
        margin-bottom: 1rem;
        font-size: 1.25rem;
    }
}

.member-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Avatar Colors - Solid */
.avatar-0 { background: #2563eb; color: #ffffff; }
.avatar-1 { background: #059669; color: #ffffff; }
.avatar-2 { background: #d97706; color: #ffffff; }
.avatar-3 { background: #7c3aed; color: #ffffff; }
.avatar-4 { background: #db2777; color: #ffffff; }
.avatar-5 { background: #475569; color: #ffffff; }

/* Member Info */
.member-name {
    font-size: 0.8125rem;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 0.25rem;
    line-height: 1.3;
}

@media (min-width: 640px) {
    .member-name {
        font-size: 0.875rem;
    }
}

@media (min-width: 1024px) {
    .member-name {
        font-size: 0.9375rem;
    }
}

.member-position {
    font-size: 0.6875rem;
    color: #64748b;
    line-height: 1.3;
    font-weight: 500;
}

@media (min-width: 640px) {
    .member-position {
        font-size: 0.75rem;
    }
}

/* ----- HIERARCHY CONNECTOR with Animation ----- */
.hierarchy-line {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin: 0.5rem 0 1rem;
    animation: fadeInUp 0.4s ease backwards;
}

.line-vertical {
    width: 2px;
    height: 28px;
    background: linear-gradient(180deg, #94a3b8, #cbd5e1);
    border-radius: 1px;
}

.line-dot {
    width: 8px;
    height: 8px;
    background: #2563eb;
    border-radius: 50%;
    margin-top: 4px;
    box-shadow: 0 0 0 0 rgba(37, 99, 235, 0.4);
    animation: pulse 2s ease-in-out infinite;
}

/* Separator between structures */
.struct-separator {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin: 1.5rem 0;
    animation: fadeInUp 0.5s ease backwards;
}

@media (min-width: 768px) {
    .struct-separator {
        margin: 2rem 0;
        gap: 1rem;
    }
}

.sep-line {
    flex: 1;
    height: 1px;
    background: linear-gradient(90deg, transparent, #cbd5e1, transparent);
}

.sep-icon {
    display: flex;
    gap: 6px;
}

.sep-dot {
    width: 5px;
    height: 5px;
    background: #2563eb;
    border-radius: 50%;
    transition: all 0.3s ease;
}

.struct-separator:hover .sep-dot {
    transform: scale(1.5);
}

.sep-dot:nth-child(1) { transition-delay: 0s; }
.sep-dot:nth-child(2) { transition-delay: 0.05s; }
.sep-dot:nth-child(3) { transition-delay: 0.1s; }

/* ----- EMPTY STATES ----- */
.empty-message {
    text-align: center;
    padding: 2rem;
    background: linear-gradient(135deg, #f8fafc, #f1f5f9);
    border-radius: 14px;
    color: #64748b;
    font-size: 0.875rem;
    animation: fadeInUp 0.5s ease;
}

@media (min-width: 768px) {
    .empty-message {
        padding: 3rem;
        font-size: 0.9375rem;
        border-radius: 18px;
    }
}

.empty-global {
    text-align: center;
    padding: 3rem 1.5rem;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 20px;
    animation: scaleIn 0.5s ease;
}

@media (min-width: 768px) {
    .empty-global {
        padding: 4rem 2rem;
        border-radius: 24px;
    }
}

.empty-icon {
    width: 64px;
    height: 64px;
    margin: 0 auto 1rem;
    background: linear-gradient(135deg, #e0e7ff, #c7d2fe);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    animation: pulse 2s ease-in-out infinite;
}

@media (min-width: 768px) {
    .empty-icon {
        width: 80px;
        height: 80px;
        margin-bottom: 1.25rem;
    }
}

.empty-title {
    font-weight: 700;
    font-size: 1rem;
    color: #1e293b;
    margin-bottom: 0.5rem;
}

@media (min-width: 768px) {
    .empty-title {
        font-size: 1.125rem;
    }
}

.empty-desc {
    font-size: 0.8125rem;
    color: #64748b;
}

@media (min-width: 768px) {
    .empty-desc {
        font-size: 0.875rem;
    }
}

/* ----- FOOTER ----- */
.org-footer {
    margin-top: 2.5rem;
    padding-top: 1.5rem;
    border-top: 1px solid #e2e8f0;
    text-align: center;
    animation: fadeInUp 0.6s ease backwards;
    animation-delay: 0.3s;
}

@media (min-width: 768px) {
    .org-footer {
        margin-top: 3rem;
        padding-top: 2rem;
    }
}

.footer-line {
    width: 50px;
    height: 3px;
    background: linear-gradient(90deg, #2563eb, #4f46e5);
    margin: 0 auto 0.75rem;
    border-radius: 3px;
}

.footer-text {
    font-size: 0.6875rem;
    color: #94a3b8;
    letter-spacing: 1px;
    text-transform: uppercase;
    font-weight: 600;
}

@media (min-width: 768px) {
    .footer-text {
        font-size: 0.75rem;
    }
}

/* ----- PRINT STYLES ----- */
@media print {
    .org-wrapper {
        padding: 0.5rem;
        max-width: 100%;
    }
    
    .structure-card {
        break-inside: avoid;
        box-shadow: none;
        border: 1px solid #ccc;
        transform: none;
    }
    
    .member-card {
        break-inside: avoid;
    }
    
    .member-card:hover {
        transform: none;
    }
    
    .member-card::before {
        display: none;
    }
    
    .line-dot {
        animation: none;
    }
}
</style>

@php
    function getInitials($name) {
        $words = explode(' ', trim($name));
        if (count($words) >= 2) {
            return strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1));
        }
        return strtoupper(substr($name, 0, 2));
    }
    
    $levelLabels = [
        0 => '',
        1 => '',
        2 => '',
        3 => '',
        4 => '',
        5 => ''
    ];
    
    $levelColors = ['lv0', 'lv1', 'lv2', 'lv3', 'lv4', 'lv5'];
    $avatarColors = ['avatar-0', 'avatar-1', 'avatar-2', 'avatar-3', 'avatar-4', 'avatar-5'];
@endphp

<div class="org-wrapper">
    <!-- Header -->
    <div class="org-header animate-fade-up">
        <h1 class="org-title">Struktur Organisasi</h1>
        
    </div>
    
    @if($structures && $structures->count() > 0)
        
        @foreach($structures as $structIndex => $structure)
            @if($structIndex > 0)
                <div class="struct-separator">
                    <div class="sep-line"></div>
                    <div class="sep-icon">
                        <div class="sep-dot"></div>
                        <div class="sep-dot"></div>
                        <div class="sep-dot"></div>
                    </div>
                    <div class="sep-line"></div>
                </div>
            @endif
            
            <div class="structure-card animate-scale" style="animation-delay: {{ $structIndex * 0.1 }}s">
                <div class="card-header">
                    <div class="card-title">
                        <span class="card-badge">{{ str_pad($structIndex + 1, 2, '0', STR_PAD_LEFT) }}</span>
                        <span class="card-name">{{ $structure->name }}</span>
                    </div>
                    <div class="card-stats">
                        {{ $structure->members->count() }} Anggota
                    </div>
                </div>
                
                <div class="card-body">
                    @if($structure->members->count() > 0)
                        @php
                            $grouped = $structure->members->sortBy('order')->groupBy('level')->sortKeys();
                            $memberCounter = 0;
                        @endphp
                        
                        @foreach($grouped as $level => $levelMembers)
                            @php
                                $levelIdx = min($level, 5);
                                $memberCount = $levelMembers->count();
                                
                                $gridClass = '';
                                if ($memberCount == 1) {
                                    $gridClass = 'single';
                                } elseif ($memberCount == 2) {
                                    $gridClass = 'double';
                                } elseif ($memberCount == 3) {
                                    $gridClass = 'triple';
                                }
                            @endphp
                            
                            @if(!$loop->first)
                                <div class="hierarchy-line">
                                    <div class="line-vertical"></div>
                                    <div class="line-dot"></div>
                                </div>
                            @endif
                            
                            <div class="level-section">
                                <div class="level-header animate-fade-left" style="animation-delay: {{ $memberCounter * 0.05 }}s">
                                    <div class="level-line"></div>
                                    <span class="level-label {{ $levelColors[$levelIdx] }}">{{ $levelLabels[$levelIdx] }}</span>
                                    <div class="level-line"></div>
                                </div>
                                
                                <div class="member-grid {{ $gridClass }}">
                                    @foreach($levelMembers as $member)
                                        <div class="member-card animate-scale" style="animation-delay: {{ $memberCounter * 0.03 }}s">
                                            <div class="member-avatar {{ $avatarColors[$levelIdx] }}">
                                                @if($member->photo && Storage::disk('public')->exists($member->photo))
                                                    <img src="{{ asset('storage/' . $member->photo) }}" alt="{{ $member->name }}" loading="lazy">
                                                @else
                                                    {{ getInitials($member->name) }}
                                                @endif
                                            </div>
                                            <div class="member-name">{{ $member->name }}</div>
                                            <div class="member-position">{{ $member->position }}</div>
                                        </div>
                                        @php $memberCounter++; @endphp
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="empty-message">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="margin-bottom: 0.5rem;">
                                <circle cx="12" cy="12" r="10"/>
                                <line x1="12" y1="8" x2="12" y2="12"/>
                                <line x1="12" y1="16" x2="12.01" y2="16"/>
                            </svg>
                            <div>Belum ada data anggota</div>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
        
        <!-- Footer -->
        <div class="org-footer">
            <div class="footer-line"></div>
            <div class="footer-text">STRUKTUR ORGANISASI</div>
        </div>
        
    @else
        <!-- Empty State -->
        <div class="empty-global">
            <div class="empty-icon">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#4f46e5" stroke-width="1.5">
                    <rect x="2" y="7" width="20" height="14" rx="2" ry="2"/>
                    <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>
                </svg>
            </div>
            <div class="empty-title">Data Struktur Organisasi Belum Tersedia</div>
            <div class="empty-desc">Silakan hubungi administrator untuk mengisi data struktur organisasi.</div>
        </div>
    @endif
</div>

@endsection
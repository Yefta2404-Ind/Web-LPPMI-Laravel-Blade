@extends('layouts.cms')

@section('title', 'Dashboard Staff')
@section('content-subtitle', 'Kelola konten dan aktivitas Anda')

@section('content')
<style>
/* ========== GOOGLE FONTS ========== */
@import url('https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,400&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'DM Sans', sans-serif;
    background: #f5f7fb;
}

/* ========== CSS VARIABLES ========== */
:root {
    --ink: #0c0e14;
    --ink-2: #1e2130;
    --ink-3: #4a5068;
    --ink-4: #8891aa;
    --surface: #ffffff;
    --surface-2: #f6f7fb;
    --surface-3: #eef0f8;
    --border: rgba(30, 33, 48, 0.09);
    --border-md: rgba(30, 33, 48, 0.15);
    
    --blue: #2563eb;
    --blue-2: #1d4ed8;
    --blue-bg: #eff4ff;
    --blue-text: #1a3ea8;
    --blue-ring: rgba(37, 99, 235, 0.2);
    
    --green: #059669;
    --green-bg: #ecfdf5;
    --green-ring: rgba(5, 150, 105, 0.2);
    
    --red: #dc2626;
    --red-bg: #fff1f2;
    --red-ring: rgba(220, 38, 38, 0.2);
    
    --amber: #d97706;
    --amber-bg: #fffbeb;
    
    --r-sm: 8px;
    --r-md: 12px;
    --r-lg: 16px;
    --r-xl: 20px;
    --r-2xl: 28px;
    
    --shadow-xs: 0 1px 2px rgba(0, 0, 0, 0.02);
    --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.04);
    --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.08);
    --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
}

/* ========== ENHANCED ANIMATIONS ========== */
@keyframes fadeIn {
    0% { opacity: 0; }
    100% { opacity: 1; }
}

@keyframes slideUp {
    0% { opacity: 0; transform: translateY(30px); }
    100% { opacity: 1; transform: translateY(0); }
}

@keyframes slideDown {
    0% { opacity: 0; transform: translateY(-30px); }
    100% { opacity: 1; transform: translateY(0); }
}

@keyframes slideInLeft {
    0% { opacity: 0; transform: translateX(-30px); }
    100% { opacity: 1; transform: translateX(0); }
}

@keyframes slideInRight {
    0% { opacity: 0; transform: translateX(30px); }
    100% { opacity: 1; transform: translateX(0); }
}

@keyframes scaleIn {
    0% { opacity: 0; transform: scale(0.95); }
    100% { opacity: 1; transform: scale(1); }
}

@keyframes rotateIn {
    0% { opacity: 0; transform: rotate(-5deg) scale(0.95); }
    100% { opacity: 1; transform: rotate(0) scale(1); }
}

@keyframes bounceIn {
    0% { opacity: 0; transform: scale(0.3); }
    50% { opacity: 1; transform: scale(1.05); }
    70% { transform: scale(0.9); }
    100% { transform: scale(1); }
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-8px); }
}

@keyframes pulse {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.85; transform: scale(1.02); }
}

@keyframes shimmer {
    0% { background-position: -1000px 0; }
    100% { background-position: 1000px 0; }
}

@keyframes glowPulse {
    0%, 100% { box-shadow: 0 0 0 0 rgba(37, 99, 235, 0.3); }
    50% { box-shadow: 0 0 0 12px rgba(37, 99, 235, 0); }
}

@keyframes borderGlow {
    0%, 100% { border-color: rgba(37, 99, 235, 0.2); }
    50% { border-color: rgba(37, 99, 235, 0.6); }
}

@keyframes wiggle {
    0%, 100% { transform: rotate(0deg); }
    25% { transform: rotate(-3deg); }
    75% { transform: rotate(3deg); }
}

@keyframes spinSlow {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Animation Classes */
.animate-fade { animation: fadeIn 0.5s ease forwards; }
.animate-slide-up { animation: slideUp 0.5s cubic-bezier(0.4, 0, 0.2, 1) forwards; }
.animate-slide-down { animation: slideDown 0.5s cubic-bezier(0.4, 0, 0.2, 1) forwards; }
.animate-slide-left { animation: slideInLeft 0.5s cubic-bezier(0.4, 0, 0.2, 1) forwards; }
.animate-slide-right { animation: slideInRight 0.5s cubic-bezier(0.4, 0, 0.2, 1) forwards; }
.animate-scale { animation: scaleIn 0.4s cubic-bezier(0.4, 0, 0.2, 1) forwards; }
.animate-rotate { animation: rotateIn 0.5s cubic-bezier(0.4, 0, 0.2, 1) forwards; }
.animate-bounce { animation: bounceIn 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55) forwards; }
.animate-float { animation: float 4s ease-in-out infinite; }
.animate-pulse { animation: pulse 2s ease-in-out infinite; }
.animate-glow { animation: glowPulse 2s ease-in-out infinite; }
.animate-border-glow { animation: borderGlow 2s ease-in-out infinite; }
.animate-wiggle:hover { animation: wiggle 0.3s ease-in-out; }
.animate-spin-slow { animation: spinSlow 8s linear infinite; }

/* Stagger delays */
.delay-1 { animation-delay: 0s; }
.delay-2 { animation-delay: 0.08s; }
.delay-3 { animation-delay: 0.16s; }
.delay-4 { animation-delay: 0.24s; }
.delay-5 { animation-delay: 0.32s; }
.delay-6 { animation-delay: 0.40s; }
.delay-7 { animation-delay: 0.48s; }
.delay-8 { animation-delay: 0.56s; }
.delay-9 { animation-delay: 0.64s; }
.delay-10 { animation-delay: 0.72s; }

/* Hover Effects */
.hover-lift { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
.hover-lift:hover { transform: translateY(-6px); transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }

.hover-scale { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
.hover-scale:hover { transform: scale(1.05); transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }

.hover-scale-icon { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
.hover-scale-icon:hover { transform: scale(1.15) rotate(3deg); transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }

.hover-glow { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
.hover-glow:hover { box-shadow: 0 0 0 6px rgba(37, 99, 235, 0.15); transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }

.hover-border-glow { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
.hover-border-glow:hover { border-color: var(--blue); box-shadow: var(--shadow-lg); transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }

.hover-slide-right { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
.hover-slide-right:hover { transform: translateX(6px); transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }

/* ========== LAYOUT ========== */
.dashboard-container {
    max-width: 1440px;
    margin: 0 auto;
    padding: 20px 16px 48px;
}
@media (min-width: 640px) { .dashboard-container { padding: 24px 24px 64px; } }
@media (min-width: 1024px) { .dashboard-container { padding: 28px 32px; } }

/* ========== BREADCRUMB ========== */
.sc-crumb {
    width: 100%;
    display: flex; align-items: center; gap: 8px;
    font-size: 0.75rem; color: var(--ink-4);
    margin-bottom: 20px;
    flex-wrap: wrap;
}
@media (min-width: 640px) { .sc-crumb { font-size: 0.78rem; margin-bottom: 24px; } }
.sc-crumb a { color: var(--blue); text-decoration: none; font-weight: 500; }
.sc-crumb a:hover { text-decoration: underline; }
.sc-crumb i { font-size: 0.6rem; opacity: 0.6; }

/* ========== WELCOME SECTION ========== */
.welcome-card {
    background: linear-gradient(135deg, var(--blue), var(--blue-2));
    border-radius: var(--r-xl);
    padding: 20px 24px;
    margin-bottom: 24px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 16px;
    position: relative;
    overflow: hidden;
}
@media (min-width: 640px) {
    .welcome-card { padding: 24px 32px; border-radius: var(--r-2xl); margin-bottom: 28px; }
}
.welcome-card::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -10%;
    width: 300px;
    height: 300px;
    background: radial-gradient(circle, rgba(255,255,255,0.08) 0%, transparent 70%);
    border-radius: 50%;
    pointer-events: none;
}
.welcome-card::after {
    content: '📊';
    position: absolute;
    bottom: -20px;
    right: 20px;
    font-size: 100px;
    opacity: 0.04;
    pointer-events: none;
    transition: all 0.3s;
}
.welcome-card:hover::after {
    transform: scale(1.1) rotate(5deg);
    opacity: 0.08;
}

.welcome-title h1 {
    font-family: 'Sora', sans-serif;
    font-size: 1.25rem; font-weight: 800;
    color: white;
    margin-bottom: 6px;
    letter-spacing: -0.02em;
}
@media (min-width: 640px) { .welcome-title h1 { font-size: 1.5rem; } }
.welcome-title p {
    font-size: 0.8rem;
    color: rgba(255,255,255,0.8);
}

.date-chip {
    display: flex;
    align-items: center;
    gap: 8px;
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(8px);
    padding: 8px 16px;
    border-radius: 99px;
    font-size: 0.75rem;
    font-weight: 500;
    color: white;
    border: 1px solid rgba(255,255,255,0.2);
    transition: all 0.2s;
}
@media (min-width: 640px) { .date-chip { padding: 10px 20px; font-size: 0.8rem; } }
.date-chip:hover {
    background: rgba(255,255,255,0.25);
    transform: translateY(-2px);
}

/* ========== STATS GRID ========== */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
    margin-bottom: 24px;
}
@media (min-width: 640px) { .stats-grid { gap: 20px; margin-bottom: 28px; } }
@media (min-width: 768px) { .stats-grid { grid-template-columns: repeat(4, 1fr); gap: 24px; } }

.stat-card {
    background: var(--surface);
    border: 1.5px solid var(--border);
    border-radius: var(--r-lg);
    padding: 16px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}
@media (min-width: 640px) { .stat-card { padding: 20px; border-radius: var(--r-xl); } }
.stat-card::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--blue), var(--blue-2));
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
.stat-card:hover {
    transform: translateY(-6px);
    border-color: var(--border-md);
    box-shadow: var(--shadow-xl);
}
.stat-card:hover::after { transform: scaleX(1); }

.stat-info h4 {
    font-size: 0.7rem; font-weight: 600;
    color: var(--ink-4);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 6px;
}
@media (min-width: 640px) { .stat-info h4 { font-size: 0.75rem; margin-bottom: 8px; } }
.stat-number {
    font-family: 'Sora', sans-serif;
    font-size: 1.5rem; font-weight: 800;
    color: var(--ink);
    line-height: 1.2;
    margin-bottom: 4px;
    letter-spacing: -0.02em;
}
@media (min-width: 640px) { .stat-number { font-size: 1.75rem; } }
.stat-trend {
    font-size: 0.65rem;
    color: var(--green);
    display: flex;
    align-items: center;
    gap: 4px;
}

.stat-icon {
    width: 44px; height: 44px;
    border-radius: var(--r-md);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
@media (min-width: 640px) { .stat-icon { width: 52px; height: 52px; font-size: 1.25rem; } }
.stat-card:hover .stat-icon { transform: scale(1.1) rotate(3deg); }
.stat-icon.news { background: var(--blue-bg); color: var(--blue); }
.stat-icon.agenda { background: var(--green-bg); color: var(--green); }
.stat-icon.pending { background: var(--amber-bg); color: var(--amber); }
.stat-icon.approved { background: var(--green-bg); color: var(--green); }

/* ========== QUICK ACTIONS ========== */
.actions-bar {
    display: flex;
    gap: 12px;
    margin-bottom: 24px;
    flex-wrap: wrap;
}
@media (min-width: 640px) { .actions-bar { gap: 16px; margin-bottom: 28px; } }

.btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    border-radius: var(--r-lg);
    font-size: 0.8rem; font-weight: 600;
    text-decoration: none;
    transition: all 0.2s;
    cursor: pointer;
    border: 1.5px solid transparent;
    font-family: 'DM Sans', sans-serif;
}
@media (min-width: 640px) { .btn { padding: 12px 24px; font-size: 0.875rem; } }
.btn-outline {
    background: var(--surface);
    border-color: var(--border-md);
    color: var(--ink-2);
}
.btn-outline:hover {
    border-color: var(--blue);
    color: var(--blue);
    transform: translateY(-2px);
    box-shadow: var(--shadow-sm);
}
.btn-primary {
    background: var(--blue);
    color: white;
    box-shadow: 0 2px 8px rgba(37,99,235,0.3);
}
.btn-primary:hover {
    background: var(--blue-2);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(37,99,235,0.4);
}

/* ========== CARD BASE ========== */
.card {
    background: var(--surface);
    border: 1.5px solid var(--border);
    border-radius: var(--r-xl);
    overflow: hidden;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
@media (min-width: 640px) { .card { border-radius: var(--r-2xl); } }
.card:hover {
    transform: translateY(-4px);
    border-color: var(--border-md);
    box-shadow: var(--shadow-xl);
}

.card-header {
    padding: 14px 18px;
    border-bottom: 1px solid var(--border);
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: var(--surface-2);
}
@media (min-width: 640px) { .card-header { padding: 16px 24px; } }
.card-header h3 {
    font-family: 'Sora', sans-serif;
    font-size: 0.9rem; font-weight: 700;
    color: var(--ink);
    display: flex;
    align-items: center;
    gap: 8px;
}
@media (min-width: 640px) { .card-header h3 { font-size: 1rem; } }
.card-header h3 i { color: var(--blue); transition: all 0.2s; }
.card:hover .card-header h3 i { transform: rotate(5deg) scale(1.1); }

.badge-count {
    background: var(--blue);
    color: white;
    padding: 2px 8px;
    border-radius: 99px;
    font-size: 0.65rem; font-weight: 600;
    margin-left: 8px;
}

/* ========== TWO COLUMN ========== */
.two-columns {
    display: grid;
    grid-template-columns: 1fr;
    gap: 20px;
    margin-bottom: 24px;
}
@media (min-width: 768px) { .two-columns { grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 28px; } }

/* ========== CHART ========== */
.chart-wrapper {
    padding: 16px;
    height: 260px;
    position: relative;
}
@media (min-width: 640px) { .chart-wrapper { padding: 20px; height: 280px; } }

.chart-legend {
    display: flex;
    justify-content: center;
    gap: 20px;
    padding: 10px 16px 16px;
    border-top: 1px solid var(--border);
    background: var(--surface-2);
    flex-wrap: wrap;
}
@media (min-width: 640px) { .chart-legend { gap: 28px; padding: 12px 20px 20px; } }

.legend-item {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.65rem;
    font-weight: 500;
    color: var(--ink-3);
    transition: all 0.2s;
    cursor: pointer;
}
@media (min-width: 640px) { .legend-item { font-size: 0.7rem; } }
.legend-item:hover { color: var(--blue); transform: translateX(3px); }

.legend-dot {
    width: 10px; height: 10px;
    border-radius: 3px;
    transition: all 0.2s;
}
.legend-item:hover .legend-dot { transform: scale(1.3); }
.legend-dot.pending { background: var(--amber); }
.legend-dot.approved { background: var(--green); }

/* ========== RULES ========== */
.rules-list {
    padding: 12px 16px;
}
@media (min-width: 640px) { .rules-list { padding: 16px 20px; } }

.rule-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 14px 0;
    border-bottom: 1px solid var(--border);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
@media (min-width: 640px) { .rule-row { padding: 16px 0; } }
.rule-row:hover {
    transform: translateX(6px);
}
.rule-row:last-child { border-bottom: none; }

.rule-left {
    display: flex;
    align-items: center;
    gap: 12px;
}
@media (min-width: 640px) { .rule-left { gap: 14px; } }
.rule-icon {
    width: 40px; height: 40px;
    border-radius: var(--r-md);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    transition: all 0.3s;
}
@media (min-width: 640px) { .rule-icon { width: 44px; height: 44px; font-size: 1.1rem; } }
.rule-row:hover .rule-icon { transform: scale(1.05); }
.rule-icon.pending { background: var(--amber-bg); color: var(--amber); }
.rule-icon.approved { background: var(--green-bg); color: var(--green); }

.rule-text h4 {
    font-size: 0.8rem; font-weight: 600;
    color: var(--ink-2);
    margin-bottom: 2px;
}
.rule-text p {
    font-size: 0.65rem;
    color: var(--ink-4);
}

.rule-badge {
    font-size: 0.65rem;
    padding: 4px 12px;
    border-radius: 99px;
    font-weight: 600;
    transition: all 0.2s;
}
.rule-row:hover .rule-badge { transform: scale(1.02); }
.rule-badge.active {
    background: var(--amber-bg);
    color: var(--amber);
}
.rule-badge.inactive {
    background: var(--surface-3);
    color: var(--ink-4);
}

.rule-footer {
    margin: 12px 16px 16px;
    padding: 12px 14px;
    background: var(--blue-bg);
    border-radius: var(--r-md);
    font-size: 0.7rem;
    color: var(--ink-3);
    display: flex;
    align-items: center;
    gap: 10px;
    border-left: 3px solid var(--blue);
    transition: all 0.3s;
}
@media (min-width: 640px) {
    .rule-footer { margin: 12px 20px 20px; padding: 12px 16px; }
}
.card:hover .rule-footer { background: #e8f0fe; }

/* ========== CONTENT LISTS ========== */
.content-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 20px;
}
@media (min-width: 768px) { .content-grid { grid-template-columns: 1fr 1fr; gap: 24px; } }

.list-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 12px 16px;
    border-bottom: 1px solid var(--border);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
@media (min-width: 640px) { .list-item { padding: 14px 20px; } }
.list-item:hover {
    background: var(--surface-2);
    padding-left: 20px;
    padding-right: 20px;
}
@media (min-width: 640px) { .list-item:hover { padding-left: 24px; padding-right: 24px; } }

.item-info {
    flex: 1;
    min-width: 0;
}
.item-title {
    font-size: 0.8rem; font-weight: 600;
    color: var(--ink-2);
    margin-bottom: 6px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
@media (min-width: 640px) { .item-title { font-size: 0.85rem; } }
.list-item:hover .item-title { color: var(--blue); }

.item-meta {
    display: flex;
    gap: 12px;
    font-size: 0.6rem;
    color: var(--ink-4);
    flex-wrap: wrap;
}
@media (min-width: 640px) { .item-meta { gap: 14px; font-size: 0.65rem; } }
.item-meta i { width: 12px; font-size: 0.55rem; }

.item-actions {
    display: flex;
    align-items: center;
    gap: 6px;
}
.status-chip {
    padding: 4px 10px;
    border-radius: 99px;
    font-size: 0.6rem; font-weight: 600;
    display: flex;
    align-items: center;
    gap: 4px;
}
.status-chip.pending { background: var(--amber-bg); color: var(--amber); }
.status-chip.approved { background: var(--green-bg); color: var(--green); }

.icon-btn {
    width: 28px; height: 28px;
    border-radius: var(--r-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--ink-4);
    text-decoration: none;
    transition: all 0.2s;
    background: transparent;
    border: none;
    cursor: pointer;
}
@media (min-width: 640px) { .icon-btn { width: 32px; height: 32px; } }
.icon-btn:hover {
    background: var(--surface-3);
    transform: scale(1.05);
}
.icon-btn.danger:hover {
    background: var(--red-bg);
    color: var(--red);
}

.locked-badge {
    width: 28px; height: 28px;
    border-radius: var(--r-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--ink-4);
    background: var(--surface-3);
    cursor: help;
}
@media (min-width: 640px) { .locked-badge { width: 32px; height: 32px; } }

.view-all {
    padding: 10px 16px;
    text-align: center;
    border-top: 1px solid var(--border);
    background: var(--surface-2);
}
@media (min-width: 640px) { .view-all { padding: 12px 20px; } }
.view-all a {
    font-size: 0.7rem;
    color: var(--blue);
    text-decoration: none;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all 0.3s;
}
.view-all a:hover { gap: 10px; }

/* ========== EMPTY STATE ========== */
.empty-state {
    text-align: center;
    padding: 40px 20px;
}
.empty-state i {
    font-size: 2.5rem;
    color: var(--ink-4);
    margin-bottom: 12px;
    display: block;
}
.empty-state p {
    font-size: 0.75rem;
    color: var(--ink-4);
    margin-bottom: 16px;
}

/* ========== RESPONSIVE ========== */
@media (max-width: 640px) {
    .stats-grid { gap: 12px; }
    .stat-number { font-size: 1.25rem; }
    .stat-icon { width: 40px; height: 40px; font-size: 1rem; }
    .actions-bar { flex-direction: column; }
    .btn { width: 100%; justify-content: center; }
    .list-item { flex-direction: column; align-items: flex-start; gap: 10px; }
    .item-actions { width: 100%; justify-content: space-between; }
}
</style>

<div class="dashboard-container">
    


    {{-- Welcome Section --}}
    <div class="welcome-card animate-slide-down delay-2">
        <div class="welcome-title">
            <h1>Selamat datang, {{ auth()->user()->name ?? 'Staff' }}! 👋</h1>
            <p>Kelola dan pantau semua konten Anda dalam satu dashboard</p>
        </div>
        <div class="date-chip animate-glow">
            <i class="fas fa-calendar-alt"></i>
            {{ now()->translatedFormat('l, d F Y') }}
        </div>
    </div>

    {{-- Stats Grid --}}
    <div class="stats-grid">
        <div class="stat-card animate-slide-left delay-3 hover-lift">
            <div class="stat-info">
                <h4><i class="fas fa-newspaper"></i> Total Berita</h4>
                <div class="stat-number">{{ $myNews->count() }}</div>
                <div class="stat-trend">
                    <i class="fas fa-arrow-up"></i> +{{ $myNews->where('created_at', '>=', now()->subDays(7))->count() }} minggu ini
                </div>
            </div>
            <div class="stat-icon news hover-scale-icon">
                <i class="fas fa-newspaper"></i>
            </div>
        </div>
        
        <div class="stat-card animate-slide-left delay-4 hover-lift">
            <div class="stat-info">
                <h4><i class="fas fa-calendar-alt"></i> Total Agenda</h4>
                <div class="stat-number">{{ $myAgenda->count() }}</div>
                <div class="stat-trend">
                    <i class="fas fa-arrow-up"></i> +{{ $myAgenda->where('created_at', '>=', now()->subDays(7))->count() }} minggu ini
                </div>
            </div>
            <div class="stat-icon agenda hover-scale-icon">
                <i class="fas fa-calendar-alt"></i>
            </div>
        </div>
        
        <div class="stat-card animate-slide-left delay-5 hover-lift">
            <div class="stat-info">
                <h4><i class="fas fa-hourglass-half"></i> Menunggu Review</h4>
                <div class="stat-number">
                    {{ $myNews->where('status','pending')->count() + $myAgenda->where('status','pending')->count() }}
                </div>
                <div class="stat-trend">
                    <i class="fas fa-clock"></i> Belum disetujui
                </div>
            </div>
            <div class="stat-icon pending hover-scale-icon">
                <i class="fas fa-hourglass-half"></i>
            </div>
        </div>
        
        <div class="stat-card animate-slide-left delay-6 hover-lift">
            <div class="stat-info">
                <h4><i class="fas fa-check-circle"></i> Sudah Tayang</h4>
                <div class="stat-number">
                    {{ $myNews->where('status','approved')->count() + $myAgenda->where('status','approved')->count() }}
                </div>
                <div class="stat-trend">
                    <i class="fas fa-check-circle"></i> Disetujui
                </div>
            </div>
            <div class="stat-icon approved hover-scale-icon">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="actions-bar animate-slide-right delay-7">
        <a href="{{ route('staff.news.create') }}" class="btn btn-primary hover-lift">
            <i class="fas fa-plus-circle"></i> Buat Berita Baru
        </a>
        <a href="{{ route('staff.agenda.create') }}" class="btn btn-outline hover-lift">
            <i class="fas fa-calendar-plus"></i> Tambah Agenda
        </a>
        <a href="{{ route('staff.password.edit') }}" class="btn btn-outline hover-lift">
            <i class="fas fa-key"></i> Ganti Password
        </a>
    </div>

    {{-- Two Columns Layout --}}
    <div class="two-columns">
        {{-- Chart Card --}}
        <div class="card animate-scale delay-8">
            <div class="card-header">
                <h3>
                    <i class="fas fa-chart-line"></i>
                    Statistik Konten
                    <span class="badge-count">30 hari</span>
                </h3>
                <i class="fas fa-chart-simple animate-float" style="color: var(--ink-4); font-size: 0.9rem;"></i>
            </div>
            <div class="chart-wrapper">
                <canvas id="contentChart" style="width:100%; height:100%;"></canvas>
            </div>
            <div class="chart-legend">
                <div class="legend-item hover-slide-right">
                    <span class="legend-dot pending"></span>
                    <span>Pending (Menunggu)</span>
                </div>
                <div class="legend-item hover-slide-right">
                    <span class="legend-dot approved"></span>
                    <span>Approved (Tayang)</span>
                </div>
            </div>
        </div>

        {{-- Rules Card --}}
        <div class="card animate-scale delay-9">
            <div class="card-header">
                <h3>
                    <i class="fas fa-gavel"></i>
                    Aturan Edit Konten
                </h3>
                <i class="fas fa-info-circle animate-pulse" style="color: var(--ink-4); font-size: 0.85rem; cursor: help;" title="Pahami aturan ini untuk menghindari error"></i>
            </div>
            <div class="rules-list">
                <div class="rule-row">
                    <div class="rule-left">
                        <div class="rule-icon pending">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="rule-text">
                            <h4>Status: Pending</h4>
                            <p>Menunggu review dari admin</p>
                        </div>
                    </div>
                    <div class="rule-badge active animate-wiggle">
                        <i class="fas fa-edit"></i> Bisa Edit
                    </div>
                </div>
                <div class="rule-row">
                    <div class="rule-left">
                        <div class="rule-icon approved">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="rule-text">
                            <h4>Status: Approved</h4>
                            <p>Sudah tayang di publik</p>
                        </div>
                    </div>
                    <div class="rule-badge inactive">
                        <i class="fas fa-lock"></i> Tidak bisa edit
                    </div>
                </div>
            </div>
            <div class="rule-footer hover-slide-right">
                <i class="fas fa-lightbulb animate-float"></i>
                <span><strong>Tips:</strong> Konten yang sudah <strong>Approved</strong> otomatis terkunci. Hubungi admin jika perlu perubahan.</span>
            </div>
        </div>
    </div>

    {{-- Content Lists --}}
    <div class="content-grid">
        {{-- Berita List --}}
        <div class="card animate-slide-up delay-10">
            <div class="card-header">
                <h3>
                    <i class="fas fa-newspaper"></i>
                    Berita Terbaru
                    <span class="badge-count">{{ $myNews->count() }}</span>
                </h3>
                <a href="{{ route('staff.news.create') }}" class="hover-slide-right" style="font-size: 0.7rem; color: var(--blue); text-decoration: none; font-weight: 500;">
                    <i class="fas fa-plus-circle"></i> Baru
                </a>
            </div>
            <div>
                @if($myNews->count())
                    @foreach($myNews->take(4) as $index => $news)
                        <div class="list-item" style="animation: slideInRight 0.4s ease forwards; animation-delay: {{ 0.1 * $index }}s; opacity: 0;">
                            <div class="item-info">
                                <div class="item-title">{{ Str::limit($news->title, 45) }}</div>
                                <div class="item-meta">
                                    <span><i class="far fa-calendar-alt"></i> {{ $news->created_at->format('d M Y') }}</span>
                                    @if($news->views)
                                    <span><i class="far fa-eye"></i> {{ number_format($news->views) }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="item-actions">
                                <span class="status-chip {{ $news->status }}">
                                    @if($news->status == 'pending') 
                                        <i class="fas fa-clock"></i> Pending
                                    @else
                                        <i class="fas fa-check-circle"></i> Approved
                                    @endif
                                </span>
                                @if($news->status == 'pending')
                                    <a href="{{ route('staff.news.edit', $news->id) }}" class="icon-btn" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('staff.news.destroy', $news->id) }}" method="POST" style="display: inline;">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="icon-btn danger" title="Hapus" onclick="return confirm('Yakin ingin menghapus berita ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @else
                                    <span class="locked-badge" title="Konten sudah disetujui, tidak bisa diedit">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-state">
                        <i class="fas fa-newspaper animate-float"></i>
                        <p>Belum ada berita</p>
                        <a href="{{ route('staff.news.create') }}" class="btn btn-primary" style="padding: 8px 18px; font-size: 0.7rem;">Buat Berita</a>
                    </div>
                @endif
            </div>
            @if($myNews->count() > 4)
            <div class="view-all">
                <a href="{{ route('staff.news.index') }}" class="hover-slide-right">Lihat semua berita <i class="fas fa-arrow-right"></i></a>
            </div>
            @endif
        </div>

        {{-- Agenda List --}}
        <div class="card animate-slide-up delay-10">
            <div class="card-header">
                <h3>
                    <i class="fas fa-calendar-alt"></i>
                    Agenda Mendatang
                    <span class="badge-count">{{ $myAgenda->count() }}</span>
                </h3>
                <a href="{{ route('staff.agenda.create') }}" class="hover-slide-right" style="font-size: 0.7rem; color: var(--blue); text-decoration: none; font-weight: 500;">
                    <i class="fas fa-plus-circle"></i> Baru
                </a>
            </div>
            <div>
                @if($myAgenda->count())
                    @foreach($myAgenda->take(4) as $index => $agenda)
                        <div class="list-item" style="animation: slideInRight 0.4s ease forwards; animation-delay: {{ 0.1 * $index }}s; opacity: 0;">
                            <div class="item-info">
                                <div class="item-title">{{ Str::limit($agenda->title, 45) }}</div>
                                <div class="item-meta">
                                    <span><i class="fas fa-calendar-day"></i> {{ \Carbon\Carbon::parse($agenda->date)->translatedFormat('d M Y') }}</span>
                                    @if($agenda->time)
                                    <span><i class="fas fa-clock"></i> {{ \Carbon\Carbon::parse($agenda->time)->format('H:i') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="item-actions">
                                <span class="status-chip {{ $agenda->status }}">
                                    @if($agenda->status == 'pending') 
                                        <i class="fas fa-clock"></i> Pending
                                    @else
                                        <i class="fas fa-check-circle"></i> Approved
                                    @endif
                                </span>
                                @if($agenda->status == 'pending')
                                    <a href="{{ route('staff.agenda.edit', $agenda->id) }}" class="icon-btn" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('staff.agenda.destroy', $agenda->id) }}" method="POST" style="display: inline;">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="icon-btn danger" title="Hapus" onclick="return confirm('Yakin ingin menghapus agenda ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @else
                                    <span class="locked-badge" title="Konten sudah disetujui, tidak bisa diedit">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-state">
                        <i class="fas fa-calendar-alt animate-float"></i>
                        <p>Belum ada agenda</p>
                        <a href="{{ route('staff.agenda.create') }}" class="btn btn-primary" style="padding: 8px 18px; font-size: 0.7rem;">Tambah Agenda</a>
                    </div>
                @endif
            </div>
            @if($myAgenda->count() > 4)
            <div class="view-all">
                <a href="{{ route('staff.agenda.index') }}" class="hover-slide-right">Lihat semua agenda <i class="fas fa-arrow-right"></i></a>
            </div>
            @endif
        </div>
    </div>
</div>

{{-- Chart.js CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Generate labels untuk 30 hari terakhir
        const last30Days = [];
        for (let i = 29; i >= 0; i--) {
            const date = new Date();
            date.setDate(date.getDate() - i);
            last30Days.push(date.toLocaleDateString('id-ID', { day: 'numeric', month: 'short' }));
        }

        const pendingChartData = @json($pendingData ?? []);
        const approvedChartData = @json($approvedData ?? []);

        const ctx = document.getElementById('contentChart').getContext('2d');
        
        if (window.myChart) {
            window.myChart.destroy();
        }
        
        window.myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: last30Days,
                datasets: [
                    {
                        label: 'Pending',
                        data: pendingChartData.length ? pendingChartData : Array(30).fill(0),
                        borderColor: '#d97706',
                        backgroundColor: 'rgba(217, 119, 6, 0.04)',
                        borderWidth: 2,
                        pointRadius: 3,
                        pointHoverRadius: 6,
                        pointBackgroundColor: '#d97706',
                        pointBorderColor: 'white',
                        pointBorderWidth: 2,
                        tension: 0.3,
                        fill: true
                    },
                    {
                        label: 'Approved',
                        data: approvedChartData.length ? approvedChartData : Array(30).fill(0),
                        borderColor: '#059669',
                        backgroundColor: 'rgba(5, 150, 105, 0.04)',
                        borderWidth: 2,
                        pointRadius: 3,
                        pointHoverRadius: 6,
                        pointBackgroundColor: '#059669',
                        pointBorderColor: 'white',
                        pointBorderWidth: 2,
                        tension: 0.3,
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#1e2130',
                        titleColor: '#f6f7fb',
                        bodyColor: '#8891aa',
                        padding: 10,
                        cornerRadius: 8,
                        displayColors: true,
                        callbacks: {
                            label: function(context) {
                                return `${context.dataset.label}: ${context.raw} konten`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(30, 33, 48, 0.06)', drawBorder: false, lineWidth: 1 },
                        ticks: { stepSize: 1, font: { size: 10, family: "'DM Sans', sans-serif" } }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { maxRotation: 45, minRotation: 45, font: { size: 9, family: "'DM Sans', sans-serif" }, autoSkip: true, maxTicksLimit: 10 }
                    }
                },
                elements: { line: { borderJoin: 'round' } },
                animation: { duration: 1000, easing: 'easeInOutQuart' },
                hover: { mode: 'index', intersect: false }
            }
        });
    });
</script>
@endsection
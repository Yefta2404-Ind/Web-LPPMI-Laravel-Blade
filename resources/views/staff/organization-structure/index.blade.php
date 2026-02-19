@extends('layouts.cms')

@section('content')
<style>
    :root {
        --primary: #0f2a44;
        --secondary: #2563eb;
        --success: #10b981;
        --warning: #f59e0b;
        --danger: #ef4444;
        --gray-50: #f9fafb;
        --gray-100: #f3f4f6;
        --gray-200: #e5e7eb;
        --gray-300: #d1d5db;
        --gray-400: #9ca3af;
        --gray-500: #6b7280;
        --gray-600: #4b5563;
        --gray-700: #374151;
        --gray-800: #1f2937;
        --border-radius: 8px;
        --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        --shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
        --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', -apple-system, sans-serif;
        background: var(--gray-50);
        font-size: 14px;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 16px;
    }

    /* Header */
    .page-header {
        margin-bottom: 24px;
    }

    .header-content {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    @media (min-width: 640px) {
        .header-content {
            flex-direction: row;
            justify-content: space-between;
            align-items: flex-end;
        }
    }

    .page-title {
        font-size: 20px;
        font-weight: 700;
        color: var(--gray-800);
        margin-bottom: 4px;
        line-height: 1.3;
    }

    .page-description {
        color: var(--gray-500);
        font-size: 13px;
        line-height: 1.5;
    }

    /* Button */
    .btn {
        padding: 10px 16px;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 500;
        text-decoration: none;
        cursor: pointer;
        border: 1px solid transparent;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        font-family: 'Inter', -apple-system, sans-serif;
        white-space: nowrap;
        width: 100%;
    }

    @media (min-width: 640px) {
        .btn {
            width: auto;
            padding: 10px 20px;
            font-size: 14px;
        }
    }

    .btn-primary {
        background: var(--secondary);
        color: white;
        border-color: var(--secondary);
    }

    .btn-primary:hover {
        background: #1d4ed8;
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
    }

    /* Content Card */
    .content-card {
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow);
        border: 1px solid var(--gray-200);
        overflow: hidden;
        margin-bottom: 20px;
    }

    /* Mobile List View */
    .mobile-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
        padding: 16px;
    }

    @media (min-width: 768px) {
        .mobile-list {
            display: none;
        }
    }

    .mobile-item {
        background: var(--gray-50);
        border: 1px solid var(--gray-200);
        border-radius: 8px;
        padding: 16px;
        transition: all 0.2s ease;
    }

    .mobile-item:hover {
        background: white;
        border-color: var(--gray-300);
        box-shadow: var(--shadow-sm);
    }

    .mobile-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 12px;
        gap: 12px;
    }

    .mobile-title {
        font-weight: 600;
        color: var(--gray-800);
        font-size: 14px;
        line-height: 1.4;
        flex: 1;
    }

    .mobile-status {
        display: inline-flex;
        align-items: center;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        white-space: nowrap;
    }

    .status-active {
        background: rgba(16, 185, 129, 0.1);
        color: var(--success);
    }

    .status-draft {
        background: rgba(245, 158, 11, 0.1);
        color: var(--warning);
    }

    .status-inactive {
        background: rgba(239, 68, 68, 0.1);
        color: var(--danger);
    }

    .mobile-details {
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin-bottom: 16px;
    }

    .mobile-detail-row {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 12px;
        color: var(--gray-600);
    }

    .mobile-detail-row i {
        width: 16px;
        color: var(--gray-500);
    }

    .mobile-actions {
        display: flex;
        gap: 8px;
        padding-top: 16px;
        border-top: 1px solid var(--gray-200);
    }

    .mobile-btn {
        flex: 1;
        padding: 8px 12px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 500;
        border: 1px solid var(--gray-300);
        background: white;
        color: var(--gray-700);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .mobile-btn:hover {
        background: var(--gray-100);
        border-color: var(--gray-400);
    }

    .mobile-btn-view:hover {
        color: var(--secondary);
        border-color: var(--secondary);
        background: rgba(37, 99, 235, 0.1);
    }

    .mobile-btn-edit:hover {
        color: var(--warning);
        border-color: var(--warning);
        background: rgba(245, 158, 11, 0.1);
    }

    .mobile-btn-delete:hover {
        color: var(--danger);
        border-color: var(--danger);
        background: rgba(239, 68, 68, 0.1);
    }

    /* Table (Desktop) */
    .table-container {
        overflow-x: auto;
        display: none;
    }

    @media (min-width: 768px) {
        .table-container {
            display: block;
        }
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 600px;
    }

    .data-table thead {
        background: var(--gray-50);
        border-bottom: 2px solid var(--gray-200);
    }

    .data-table th {
        padding: 14px 16px;
        text-align: left;
        font-size: 12px;
        font-weight: 600;
        color: var(--gray-600);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        white-space: nowrap;
    }

    .data-table tbody tr {
        border-bottom: 1px solid var(--gray-200);
        transition: background-color 0.2s ease;
    }

    .data-table tbody tr:hover {
        background: var(--gray-50);
    }

    .data-table tbody tr:last-child {
        border-bottom: none;
    }

    .data-table td {
        padding: 14px 16px;
        font-size: 14px;
        color: var(--gray-700);
        vertical-align: middle;
    }

    /* Desktop View Components */
    .desktop-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .desktop-icon {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        background: rgba(37, 99, 235, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--secondary);
        font-size: 14px;
        flex-shrink: 0;
    }

    .desktop-details h4 {
        font-weight: 500;
        color: var(--gray-800);
        font-size: 14px;
        margin-bottom: 2px;
        line-height: 1.4;
    }

    .desktop-details .id {
        font-size: 12px;
        color: var(--gray-500);
    }

    /* Status Badge */
    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        white-space: nowrap;
    }

    /* Date Info */
    .date-info {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .date {
        font-size: 14px;
        color: var(--gray-700);
        font-weight: 500;
    }

    .time {
        font-size: 12px;
        color: var(--gray-500);
    }

    /* Action Buttons (Desktop) */
    .action-buttons {
        display: flex;
        gap: 8px;
        justify-content: flex-end;
    }

    .btn-icon {
        width: 32px;
        height: 32px;
        padding: 0;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: transparent;
        border: 1px solid var(--gray-300);
        color: var(--gray-600);
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .btn-icon:hover {
        background: var(--gray-100);
        border-color: var(--gray-400);
        transform: translateY(-1px);
    }

    .btn-view:hover {
        color: var(--secondary);
        border-color: var(--secondary);
        background: rgba(37, 99, 235, 0.1);
    }

    .btn-edit:hover {
        color: var(--warning);
        border-color: var(--warning);
        background: rgba(245, 158, 11, 0.1);
    }

    .btn-delete:hover {
        color: var(--danger);
        border-color: var(--danger);
        background: rgba(239, 68, 68, 0.1);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 48px 20px;
    }

    @media (min-width: 768px) {
        .empty-state {
            padding: 64px 24px;
        }
    }

    .empty-icon {
        font-size: 48px;
        color: var(--gray-300);
        margin-bottom: 16px;
        opacity: 0.5;
    }

    .empty-title {
        font-size: 18px;
        font-weight: 600;
        color: var(--gray-700);
        margin-bottom: 8px;
    }

    .empty-description {
        color: var(--gray-500);
        font-size: 14px;
        line-height: 1.5;
        max-width: 400px;
        margin: 0 auto 24px;
    }

    /* Footer */
    .table-footer {
        padding: 14px 16px;
        border-top: 1px solid var(--gray-200);
        display: flex;
        flex-direction: column;
        gap: 12px;
        align-items: center;
        background: var(--gray-50);
    }

    @media (min-width: 640px) {
        .table-footer {
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
        }
    }

    .total-count {
        font-size: 13px;
        color: var(--gray-600);
        text-align: center;
    }

    @media (min-width: 640px) {
        .total-count {
            text-align: left;
        }
    }

    /* Loading State */
    .loading {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 200px;
        color: var(--gray-500);
    }
</style>

<div class="container">
    <!-- Header -->
    <div class="page-header">
        <div class="header-content">
            <div>
                <h1 class="page-title">Struktur Organisasi</h1>
                <p class="page-description">Kelola dan pantau struktur organisasi Anda</p>
            </div>
            
            <a href="{{ route('staff.organization-structure.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Buat Struktur Baru
            </a>
        </div>
    </div>

    <!-- Data Content -->
    @if(count($data) > 0)
    <div class="content-card">
        <!-- Mobile View -->
        <div class="mobile-list">
            @foreach($data as $item)
            <div class="mobile-item">
                <div class="mobile-header">
                    <div class="mobile-title">{{ $item->title }}</div>
                    @php
                        $statusClass = 'secondary';
                        if($item->status === 'Aktif' || $item->status === 'active') {
                            $statusClass = 'status-active';
                        } elseif($item->status === 'Draft' || $item->status === 'draft') {
                            $statusClass = 'status-draft';
                        } elseif(in_array($item->status, ['Nonaktif', 'Tidak Aktif', 'inactive'])) {
                            $statusClass = 'status-inactive';
                        }
                    @endphp
                    <span class="mobile-status {{ $statusClass }}">
                        {{ $item->status }}
                    </span>
                </div>
                
                <div class="mobile-details">
                    <div class="mobile-detail-row">
                        <i class="fas fa-hashtag"></i>
                        <span>ID: {{ $item->id }}</span>
                    </div>
                    <div class="mobile-detail-row">
                        <i class="fas fa-calendar"></i>
                        <span>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</span>
                    </div>
                    <div class="mobile-detail-row">
                        <i class="fas fa-clock"></i>
                        <span>{{ \Carbon\Carbon::parse($item->created_at)->format('H:i') }}</span>
                    </div>
                </div>
                
                <div class="mobile-actions">
                    <button class="mobile-btn mobile-btn-view" onclick="viewItem('{{ $item->id }}')">
                        <i class="fas fa-eye"></i> Lihat
                    </button>
                    <button class="mobile-btn mobile-btn-edit" onclick="editItem('{{ $item->id }}')">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                    <button class="mobile-btn mobile-btn-delete" onclick="deleteItem('{{ $item->id }}', '{{ $item->title }}')">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- Desktop Table -->
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Judul Struktur</th>
                        <th>Status</th>
                        <th>Tanggal Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $item)
                    <tr>
                        <td>
                            <div class="desktop-info">
                                <div class="desktop-icon">
                                    <i class="fas fa-sitemap"></i>
                                </div>
                                <div class="desktop-details">
                                    <h4>{{ $item->title }}</h4>
                                    <div class="id">ID: {{ $item->id }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            @php
                                $statusClass = 'secondary';
                                if($item->status === 'Aktif' || $item->status === 'active') {
                                    $statusClass = 'status-active';
                                } elseif($item->status === 'Draft' || $item->status === 'draft') {
                                    $statusClass = 'status-draft';
                                } elseif(in_array($item->status, ['Nonaktif', 'Tidak Aktif', 'inactive'])) {
                                    $statusClass = 'status-inactive';
                                }
                            @endphp
                            <span class="status-badge {{ $statusClass }}">
                                {{ $item->status }}
                            </span>
                        </td>
                        <td>
                            <div class="date-info">
                                <span class="date">{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</span>
                                <span class="time">{{ \Carbon\Carbon::parse($item->created_at)->format('H:i') }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-icon btn-view" onclick="viewItem('{{ $item->id }}')" title="Lihat">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn-icon btn-edit" onclick="editItem('{{ $item->id }}')" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn-icon btn-delete" onclick="deleteItem('{{ $item->id }}', '{{ $item->title }}')" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Footer -->
        <div class="table-footer">
            <div class="total-count">
                Total: {{ count($data) }} struktur organisasi
            </div>
            
            <!-- Pagination (uncomment jika menggunakan pagination) -->
            <!--
            @if(method_exists($data, 'hasPages') && $data->hasPages())
            <div class="pagination">
                {{ $data->links() }}
            </div>
            @endif
            -->
        </div>
    </div>
    @else
    <!-- Empty State -->
    <div class="content-card">
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fas fa-sitemap"></i>
            </div>
            <h3 class="empty-title">Belum ada struktur organisasi</h3>
            <p class="empty-description">
                Mulai dengan membuat struktur organisasi pertama Anda
            </p>
            <a href="{{ route('staff.organization-structure.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Buat Struktur Baru
            </a>
        </div>
    </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Touch optimizations for mobile
    if ('ontouchstart' in window) {
        // Add touch feedback
        const touchElements = document.querySelectorAll('.mobile-btn, .mobile-item, .btn-icon');
        touchElements.forEach(el => {
            el.addEventListener('touchstart', function() {
                this.style.opacity = '0.8';
            });
            
            el.addEventListener('touchend', function() {
                this.style.opacity = '1';
            });
        });
        
        // Prevent zoom on double tap for buttons
        const buttons = document.querySelectorAll('button, .btn');
        buttons.forEach(btn => {
            btn.addEventListener('touchstart', function(e) {
                if (e.touches.length > 1) {
                    e.preventDefault();
                }
            }, { passive: false });
        });
    }
    
    // Optimize for slower mobile devices
    if (navigator.userAgent.match(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i)) {
        // Reduce animations
        document.documentElement.style.setProperty('--transition', 'all 0.1s ease');
    }
});

// Action functions
function viewItem(id) {
    alert(`Lihat struktur ID: ${id}`);
    // Implementasi: window.location.href = '/view/' + id;
}

function editItem(id) {
    alert(`Edit struktur ID: ${id}`);
    // Implementasi: window.location.href = '/edit/' + id;
}

function deleteItem(id, title) {
    if (confirm(`Hapus struktur "${title}"?`)) {
        alert(`Struktur "${title}" akan dihapus`);
        // Implementasi: AJAX delete request
        // fetch('/delete/' + id, { method: 'DELETE' })
        //   .then(response => response.json())
        //   .then(data => {
        //       if (data.success) {
        //           location.reload();
        //       }
        //   });
    }
}

// Handle orientation change
window.addEventListener('orientationchange', function() {
    // Refresh setelah orientation change untuk memastikan layout benar
    setTimeout(() => {
        window.dispatchEvent(new Event('resize'));
    }, 100);
});

// Handle keyboard for accessibility
document.addEventListener('keydown', function(e) {
    if (e.key === 'Enter' || e.key === ' ') {
        const focused = document.activeElement;
        if (focused.classList.contains('mobile-btn') || focused.classList.contains('btn-icon')) {
            focused.click();
        }
    }
});
</script>
@endsection
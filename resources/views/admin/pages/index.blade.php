@extends('layouts.admin')

@section('content')
<style>
/* Custom CSS untuk Halaman Management - Warna Biru Kebiruan */
:root {
    --primary-color: #2563eb; /* Biru lebih modern */
    --primary-light: #3b82f6; /* Biru terang */
    --primary-dark: #1d4ed8; /* Biru gelap */
    --primary-soft: #dbeafe; /* Biru sangat soft untuk background */
    --success-color: #059669; /* Hijau */
    --danger-color: #dc2626; /* Merah */
    --warning-color: #d97706; /* Kuning */
    --secondary-color: #64748b; /* Abu-abu biru */
    --light-bg: #f8fafc; /* Putih kebiruan */
    --border-color: #e2e8f0; /* Border kebiruan */
    --text-muted: #64748b;
    --text-primary: #0f172a;
    --hover-bg: #eff6ff; /* Hover background biru soft */
}

/* Container utama */
.container-fluid {
    max-width: 1400px;
    margin: 0 auto;
    padding: 1.5rem 1rem;
}

/* Header section */
.header-wrapper {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
    gap: 1rem;
}

.header-title h1 {
    font-size: calc(1.3rem + 0.6vw);
    font-weight: 600;
    margin-bottom: 0.25rem;
    color: var(--text-primary);
    line-height: 1.2;
}

.header-title h1 i {
    color: var(--primary-color);
    background: var(--primary-soft);
    padding: 0.5rem;
    border-radius: 0.75rem;
    font-size: 1.2rem;
}

.header-title p {
    font-size: 0.875rem;
    color: var(--text-muted);
    margin-bottom: 0;
}

.header-title p i {
    color: var(--primary-light);
}

/* Button styling */
.btn-primary {
    background: var(--primary-color);
    border: none;
    padding: 0.6rem 1.2rem;
    font-size: 0.875rem;
    font-weight: 500;
    border-radius: 0.5rem;
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    color: white;
}

.btn-primary:hover {
    background: var(--primary-dark);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
}

.btn-primary:active {
    transform: translateY(0);
    background: var(--primary-dark);
}

/* Alert styling */
.alert {
    border-radius: 0.75rem;
    border: none;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    margin-bottom: 1.5rem;
    padding: 1rem 1.25rem;
    font-size: 0.95rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.alert-success {
    background: #ecfdf5;
    color: #065f46;
    border-left: 4px solid var(--success-color);
}

.alert-success i {
    color: var(--success-color);
}

/* Card styling */
.card {
    border-radius: 1rem;
    overflow: hidden;
    background: white;
    box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
    transition: all 0.3s ease;
    border: 1px solid var(--border-color);
}

.card:hover {
    box-shadow: 0 0.5rem 1.5rem rgba(37, 99, 235, 0.1);
    border-color: var(--primary-light);
}

/* Table styling */
.table-responsive {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    border-radius: 1rem;
}

.table {
    margin: 0;
    min-width: 900px;
    width: 100%;
}

.table thead th {
    background: var(--light-bg);
    font-weight: 600;
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: var(--primary-dark);
    border-bottom: 2px solid var(--border-color);
    padding: 1rem 1rem;
    white-space: nowrap;
}

.table thead th:first-child {
    border-top-left-radius: 1rem;
}

.table thead th:last-child {
    border-top-right-radius: 1rem;
}

.table tbody td {
    padding: 1.25rem 1rem;
    vertical-align: middle;
    border-bottom: 1px solid var(--border-color);
    font-size: 0.95rem;
}

.table tbody tr:last-child td {
    border-bottom: none;
}

.table tbody tr {
    transition: all 0.2s ease;
}

.table tbody tr:hover {
    background-color: var(--hover-bg);
}

.table tbody tr:hover td:first-child {
    border-left: 3px solid var(--primary-color);
}

/* Nomor urut styling */
.row-number {
    color: var(--primary-color);
    font-weight: 600;
    font-size: 0.9rem;
    background: var(--primary-soft);
    width: 28px;
    height: 28px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 0.5rem;
}

/* Judul dan deskripsi */
.page-title {
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 0.25rem;
    font-size: 1rem;
}

.page-title:hover {
    color: var(--primary-color);
}

.page-description {
    font-size: 0.8rem;
    color: var(--text-muted);
    display: block;
    line-height: 1.4;
    max-width: 250px;
}

.page-description i {
    color: var(--primary-light);
}

/* Slug styling */
.slug-container {
    background: var(--primary-soft);
    padding: 0.4rem 0.75rem;
    border-radius: 0.5rem;
    display: inline-block;
    font-size: 0.85rem;
    border: 1px solid var(--border-color);
}

.slug-container code {
    color: var(--primary-dark);
    background: transparent;
    padding: 0;
    font-size: 0.85rem;
    font-weight: 500;
}

/* Status badge styling */
.status-badge {
    padding: 0.5rem 1rem;
    font-weight: 500;
    font-size: 0.75rem;
    border-radius: 2rem;
    border: none;
    cursor: pointer;
    transition: all 0.2s ease;
    min-width: 90px;
    text-transform: capitalize;
    letter-spacing: 0.3px;
}

.status-badge.bg-success {
    background: var(--success-color) !important;
    color: white;
}

.status-badge.bg-secondary {
    background: var(--secondary-color) !important;
    color: white;
}

.status-badge.bg-success i,
.status-badge.bg-secondary i {
    color: white;
}

.status-badge:hover {
    transform: translateY(-1px);
    filter: brightness(110%);
    box-shadow: 0 2px 8px rgba(37, 99, 235, 0.2);
}

.status-badge:active {
    transform: translateY(0);
}

/* Tanggal styling */
.date-text {
    color: var(--text-primary);
    font-size: 0.85rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 500;
}

.date-text i {
    color: var(--primary-color);
    font-size: 0.8rem;
}

/* Action buttons */
.action-buttons {
    display: flex;
    gap: 0.5rem;
    justify-content: flex-end;
    flex-wrap: wrap;
}

.btn-sm {
    padding: 0.5rem 0.9rem;
    font-size: 0.8rem;
    border-radius: 0.5rem;
    transition: all 0.2s ease;
    border-width: 1px;
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
}

.btn-outline-secondary {
    border-color: var(--secondary-color);
    color: var(--secondary-color);
}

.btn-outline-secondary:hover {
    background: var(--secondary-color);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 2px 8px rgba(100, 116, 139, 0.3);
    border-color: var(--secondary-color);
}

.btn-outline-primary {
    border-color: var(--primary-color);
    color: var(--primary-color);
    background: white;
}

.btn-outline-primary:hover {
    background: var(--primary-color);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 2px 8px rgba(37, 99, 235, 0.3);
    border-color: var(--primary-color);
}

.btn-outline-danger {
    border-color: var(--danger-color);
    color: var(--danger-color);
}

.btn-outline-danger:hover {
    background: var(--danger-color);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 2px 8px rgba(220, 38, 38, 0.3);
    border-color: var(--danger-color);
}

/* Empty state styling */
.empty-state {
    text-align: center;
    padding: 4rem 2rem;
    color: var(--text-muted);
}

.empty-state i {
    font-size: 3.5rem;
    margin-bottom: 1.5rem;
    color: var(--primary-soft);
    background: var(--primary-soft);
    padding: 1rem;
    border-radius: 2rem;
}

.empty-state p {
    font-size: 1.1rem;
    margin-bottom: 1rem;
    color: var(--text-primary);
}

.empty-state a {
    color: white;
    text-decoration: none;
    font-weight: 500;
    padding: 0.75rem 1.5rem;
    border-radius: 0.5rem;
    background: var(--primary-color);
    transition: all 0.2s ease;
    display: inline-block;
}

.empty-state a:hover {
    background: var(--primary-dark);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
}

/* Pagination styling */
.card-footer {
    background: var(--light-bg);
    border-top: 1px solid var(--border-color);
    padding: 1rem 1.5rem;
}

.card-footer small {
    color: var(--text-muted);
}

/* Custom pagination colors */
.pagination .page-link {
    color: var(--primary-color);
    border-color: var(--border-color);
}

.pagination .page-link:hover {
    background: var(--primary-soft);
    color: var(--primary-dark);
    border-color: var(--primary-light);
}

.pagination .active .page-link {
    background: var(--primary-color);
    border-color: var(--primary-color);
    color: white;
}

/* Responsive breakpoints */
@media (max-width: 992px) {
    .container-fluid {
        padding: 1.25rem 1rem;
    }
    
    .table {
        min-width: 800px;
    }
}

@media (max-width: 768px) {
    .container-fluid {
        padding: 1rem 0.75rem;
    }
    
    .header-wrapper {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .header-title h1 {
        font-size: 1.5rem;
    }
    
    .btn-primary {
        width: 100%;
        justify-content: center;
    }
    
    .table tbody td {
        padding: 1rem 0.75rem;
    }
    
    .page-description {
        max-width: 200px;
    }
    
    .action-buttons {
        gap: 0.3rem;
    }
    
    .btn-sm {
        padding: 0.4rem 0.7rem;
    }
}

@media (max-width: 576px) {
    .container-fluid {
        padding: 0.75rem 0.5rem;
    }
    
    .header-title h1 {
        font-size: 1.3rem;
    }
    
    .card {
        border-radius: 0.75rem;
    }
    
    .table thead th {
        padding: 0.75rem 0.5rem;
        font-size: 0.7rem;
    }
    
    .table tbody td {
        padding: 0.75rem 0.5rem;
        font-size: 0.85rem;
    }
    
    .status-badge {
        padding: 0.4rem 0.75rem;
        font-size: 0.7rem;
        min-width: 70px;
    }
    
    .btn-sm {
        padding: 0.35rem 0.6rem;
        font-size: 0.75rem;
    }
    
    .slug-container {
        padding: 0.25rem 0.5rem;
    }
    
    .slug-container code {
        font-size: 0.75rem;
    }
    
    .empty-state {
        padding: 3rem 1rem;
    }
    
    .empty-state i {
        font-size: 3rem;
    }
    
    .row-number {
        width: 24px;
        height: 24px;
        font-size: 0.8rem;
    }
}

/* Animations */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.table tbody tr {
    animation: fadeIn 0.3s ease forwards;
}

/* Blue shimmer effect untuk hover */
@keyframes blueShimmer {
    0% {
        background-position: -1000px;
    }
    100% {
        background-position: 1000px;
    }
}

.table tbody tr:hover .page-title {
    color: var(--primary-color);
}

/* Loading state */
.loading {
    opacity: 0.6;
    pointer-events: none;
}

/* Print styles */
@media print {
    .btn-primary,
    .action-buttons,
    .alert {
        display: none;
    }
    
    .card {
        box-shadow: none;
        border: 1px solid var(--border-color);
    }
}
</style>

<div class="container-fluid">
    <!-- Header dengan judul dan tombol tambah -->
    <div class="header-wrapper">
        <div class="header-title">
            <h1>
                <i class="fas fa-file-alt me-2"></i>
                Halaman
            </h1>
            <p>
                <i class="fas fa-info-circle me-1"></i>
                Kelola semua halaman website
            </p>
        </div>
        <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> 
            Tambah Halaman Baru
        </a>
    </div>

    <!-- Alert notifikasi -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Card daftar halaman -->
    <div class="card">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="ps-4">No</th>
                        <th>Judul Halaman</th>
                        <th>URL / Slug</th>
                        <th>Status</th>
                        <th>Tanggal Dibuat</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pages as $page)
                    <tr>
                        <td class="ps-4">
                            <span class="row-number">{{ $loop->iteration }}</span>
                        </td>
                        <td>
                            <div class="page-title">{{ $page->title }}</div>
                            @if($page->meta_description)
                                <small class="page-description">
                                    <i class="fas fa-align-left me-1"></i>
                                    {{ Str::limit($page->meta_description, 60) }}
                                </small>
                            @endif
                        </td>
                        <td>
                            <div class="slug-container">
                                <code>/{{ $page->slug }}</code>
                            </div>
                        </td>
                        <td>
                            <form action="{{ route('admin.pages.toggle-status', $page) }}" 
                                  method="POST" 
                                  class="d-inline"
                                  onsubmit="return confirm('Ubah status halaman ini?')">
                                @csrf
                                <button type="submit" 
                                        class="status-badge {{ $page->status === 'published' ? 'bg-success' : 'bg-secondary' }}"
                                        title="Klik untuk mengubah status">
                                    <i class="fas {{ $page->status === 'published' ? 'fa-eye' : 'fa-eye-slash' }} me-1"></i>
                                    {{ $page->status === 'published' ? 'Published' : 'Draft' }}
                                </button>
                            </form>
                        </td>
                        <td>
                            <div class="date-text">
                                <i class="far fa-calendar-alt"></i>
                                {{ $page->created_at->format('d M Y') }}
                            </div>
                            <small class="text-muted d-block mt-1">
                                <i class="far fa-clock"></i>
                                {{ $page->created_at->format('H:i') }}
                            </small>
                        </td>
                        <td class="text-end pe-4">
                            <div class="action-buttons">
                                <!-- Preview button -->
                                <a href="{{ url('/' . $page->slug) }}" 
                                   target="_blank"
                                   class="btn btn-sm btn-outline-secondary" 
                                   title="Lihat halaman">
                                    <i class="fas fa-eye"></i>
                                    <span class="d-none d-lg-inline ms-1">Preview</span>
                                </a>
                                
                                <!-- Edit button -->
                                <a href="{{ route('admin.pages.edit', $page) }}"
                                   class="btn btn-sm btn-outline-primary" 
                                   title="Edit halaman">
                                    <i class="fas fa-edit"></i>
                                    <span class="d-none d-lg-inline ms-1">Edit</span>
                                </a>
                                
                                <!-- Delete button -->
                                <form action="{{ route('admin.pages.destroy', $page) }}" 
                                      method="POST" 
                                      class="d-inline"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus halaman \"{{ $page->title }}\"? Tindakan ini tidak dapat dibatalkan.')">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-sm btn-outline-danger"
                                            title="Hapus halaman">
                                        <i class="fas fa-trash"></i>
                                        <span class="d-none d-lg-inline ms-1">Hapus</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <i class="fas fa-file-alt"></i>
                                <p>Belum ada halaman yang dibuat.</p>
                                <a href="{{ route('admin.pages.create') }}">
                                    <i class="fas fa-plus me-1"></i>
                                    Buat halaman pertama
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Optional: Pagination jika ada -->
        @if(method_exists($pages, 'links') && $pages->hasPages())
        <div class="card-footer bg-white border-top py-3">
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">
                    <i class="fas fa-file me-1"></i>
                    Menampilkan {{ $pages->firstItem() ?? 0 }} - {{ $pages->lastItem() ?? 0 }} 
                    dari {{ $pages->total() }} halaman
                </small>
                {{ $pages->links() }}
            </div>
        </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-hide alert setelah 5 detik
    const alert = document.querySelector('.alert');
    if (alert) {
        setTimeout(() => {
            alert.classList.remove('show');
            setTimeout(() => {
                alert.remove();
            }, 150);
        }, 5000);
    }
    
    // Konfirmasi sebelum toggle status
    const statusForms = document.querySelectorAll('form[action*="toggle-status"]');
    statusForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!confirm('Apakah Anda yakin ingin mengubah status halaman ini?')) {
                e.preventDefault();
            }
        });
    });
    
    // Tooltip initialization (jika menggunakan Bootstrap 5)
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>
@endpush
@endsection
{{-- resources/views/admin/popup/index.blade.php --}}
@extends('layouts.admin')

@section('content')
<style>
    /* Custom CSS untuk halaman Kelola Pop-up Banner - Putih Solid */
    .popup-container {
        padding: 20px;
        background: #ffffff;
        min-height: calc(100vh - 200px);
    }

    .popup-header {
        background: #ffffff;
        border-radius: 12px;
        padding: 25px;
        margin-bottom: 30px;
        border: 1px solid #e5e7eb;
        border-left: 5px solid #3b82f6;
    }

    .popup-header h2 {
        margin: 0;
        color: #1f2937;
        font-weight: 600;
        font-size: 28px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .popup-header h2:before {
        content: "🎯";
        font-size: 32px;
    }

    .popup-card {
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        overflow: hidden;
        transition: box-shadow 0.3s ease;
        background: #ffffff;
    }

    .popup-card:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }

    .popup-card .card-header {
        background: #f8fafc;
        color: #1f2937;
        font-weight: 600;
        font-size: 18px;
        padding: 15px 25px;
        border-bottom: 1px solid #e5e7eb;
    }

    .popup-card .card-body {
        padding: 30px;
        background: #ffffff;
    }

    .form-label {
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
    }

    .form-control {
        border-radius: 8px;
        border: 1px solid #d1d5db;
        padding: 10px 15px;
        transition: all 0.2s ease;
        background: #ffffff;
    }

    .form-control:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        outline: none;
    }

    .form-check-input {
        width: 18px;
        height: 18px;
        margin-top: 0;
    }

    .form-check-input:checked {
        background-color: #3b82f6;
        border-color: #3b82f6;
    }

    .btn-primary {
        background: #3b82f6;
        border: none;
        border-radius: 8px;
        padding: 12px 30px;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .btn-primary:hover {
        background: #2563eb;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }

    .preview-image {
        max-width: 100%;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
        transition: transform 0.3s ease;
    }

    .preview-image:hover {
        transform: scale(1.02);
    }

    .alert {
        border-radius: 8px;
        border-left: 4px solid;
        padding: 15px 20px;
    }

    .alert-success {
        background: #f0fdf4;
        border-left-color: #22c55e;
        color: #166534;
    }

    .alert-info {
        background: #eff6ff;
        border-left-color: #3b82f6;
        color: #1e40af;
    }

    .alert-warning {
        background: #fefce8;
        border-left-color: #eab308;
        color: #854d0e;
    }

    @keyframes slideIn {
        from {
            transform: translateX(-100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    .badge {
        padding: 6px 12px;
        font-size: 13px;
        font-weight: 600;
        border-radius: 20px;
    }

    .badge.bg-success {
        background: #dcfce7;
        color: #166534;
    }

    .badge.bg-secondary {
        background: #f1f5f9;
        color: #475569;
    }

    .info-text {
        color: #6b7280;
        font-size: 12px;
        margin-top: 5px;
    }

    .text-muted {
        color: #6b7280 !important;
    }

    @media (max-width: 768px) {
        .popup-header h2 {
            font-size: 24px;
        }
        
        .popup-card .card-body {
            padding: 20px;
        }
        
        .btn-primary {
            width: 100%;
        }
    }
</style>

<div class="popup-container">
    <div class="container">
        <div class="popup-header">
            <h2>Kelola Pop-up Banner</h2>
            <p class="text-muted mt-2 mb-0">Atur tampilan pop-up banner untuk promosi atau pengumuman penting</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card popup-card">
            <div class="card-header">
                <i class="fas fa-upload me-2"></i> Upload Pop-up Banner Baru
            </div>
            <div class="card-body">
                <form action="{{ route('admin.popup.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="form-label">
                            <i class="fas fa-image me-2"></i>Upload Gambar Pop-up
                        </label>
                        <input type="file" name="image" class="form-control" accept="image/*" required>
                        <div class="info-text">
                            <i class="fas fa-info-circle me-1"></i>
                            Format yang didukung: JPG, PNG, WEBP. Maksimal ukuran file: 2MB.
                            <br>Rekomendasi ukuran: 800px x 600px untuk hasil terbaik.
                        </div>
                    </div>

                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active"
                            {{ optional($popup)->is_active ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">
                            <i class="fas fa-toggle-on me-1"></i>
                            Aktifkan Pop-up
                        </label>
                        <div class="info-text ms-4">
                            Jika diaktifkan, pop-up akan muncul saat pengguna membuka halaman website.
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>

        {{-- Preview gambar aktif --}}
        @if($popup && $popup->image_path)
        <div class="card popup-card mt-4">
            <div class="card-header">
                <i class="fas fa-eye me-2"></i> Preview Pop-up Aktif
            </div>
            <div class="card-body text-center">
                <img src="{{ Storage::url($popup->image_path) }}"
                     class="preview-image"
                     alt="Preview Pop-up Banner"
                     style="max-width: 500px; width: 100%;">
                
                <div class="mt-3">
                    <p class="mb-2">
                        <strong>Status:</strong>
                        <span class="badge {{ $popup->is_active ? 'bg-success' : 'bg-secondary' }}">
                            <i class="fas {{ $popup->is_active ? 'fa-check-circle' : 'fa-times-circle' }} me-1"></i>
                            {{ $popup->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </p>
                    @if($popup->is_active)
                        <div class="alert alert-info mt-3">
                            <i class="fas fa-info-circle me-2"></i>
                            Pop-up banner ini akan muncul saat pengguna membuka halaman website Anda.
                        </div>
                    @else
                        <div class="alert alert-warning mt-3">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Pop-up banner sedang nonaktif. Aktifkan untuk menampilkannya di website.
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

{{-- Optional: Tambahkan Font Awesome jika belum ada --}}
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endpush
@endsection
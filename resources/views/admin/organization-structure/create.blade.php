@extends('layouts.admin')

@section('page-title', 'Tambah Struktur Organisasi')

@section('content')
<div class="org-form-container">
    <div class="org-form-header">
        <h2><i class="fas fa-sitemap"></i> Tambah Struktur Organisasi</h2>
        <a href="{{ route('admin.organization-structure.index') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i>
        <strong>Terjadi kesalahan:</strong>
        <ul class="mt-2 mb-0">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <form id="orgForm" action="{{ route('admin.organization-structure.store') }}"
          method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-card">
            <div class="section-header">
                <i class="fas fa-info-circle"></i>
                <h4>Informasi Struktur</h4>
            </div>
            <div class="form-group">
                <label class="form-label">
                    Judul Struktur <span class="required">*</span>
                </label>
                <input type="text" name="title" class="form-control"
                       placeholder="Contoh: Struktur Organisasi 2025"
                       value="{{ old('title') }}" required>
            </div>
        </div>

        <div class="form-card">
            <div class="section-header">
                <i class="fas fa-users"></i>
                <h4>Anggota Organisasi</h4>
                <span class="members-count" id="membersCount">1 Anggota</span>
            </div>

            <div id="membersContainer">
                <div class="member-card" data-index="0">
                    <div class="member-header">
                        <span class="member-number">1</span>
                        <button type="button" class="btn-remove-member" onclick="removeMember(this)">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="member-fields">
                        <div class="form-group">
                            <label class="form-label">Nama Lengkap <span class="required">*</span></label>
                            <input type="text" name="members[0][name]" class="form-control"
                                   placeholder="Nama lengkap" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Jabatan <span class="required">*</span></label>
                            <input type="text" name="members[0][position]" class="form-control"
                                   placeholder="Contoh: Ketua, Sekretaris" required>
                        </div>
                        <div class="form-group full-width">
                            <label class="form-label">Foto <span class="optional">(Opsional)</span></label>
                            <div class="file-upload-area" onclick="this.querySelector('input').click()">
                                <input type="file" name="members[0][photo]" accept="image/*"
                                       class="file-input" onchange="previewPhoto(this)">
                                <div class="upload-placeholder">
                                    <i class="fas fa-camera"></i>
                                    <span>Klik untuk upload foto</span>
                                    <small>JPG, PNG | Maks 2MB</small>
                                </div>
                            </div>
                            <div class="photo-preview" style="display:none;">
                                <img class="preview-img" alt="Preview">
                                <button type="button" class="btn-remove-photo" onclick="removePhoto(this)">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="button" class="btn-add-member" onclick="addMember()">
                <i class="fas fa-user-plus"></i> Tambah Anggota
            </button>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-submit">
                <i class="fas fa-save"></i> Simpan Struktur
            </button>
            <a href="{{ route('admin.organization-structure.index') }}" class="btn-cancel">
                Batal
            </a>
        </div>
    </form>
</div>

@include('admin.organization-structure._styles')
@include('admin.organization-structure._scripts')
@endsection
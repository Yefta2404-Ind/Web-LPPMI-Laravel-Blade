@extends('layouts.admin')

@section('page-title', 'Edit Struktur Organisasi')

@section('content')
<div class="org-form-container">
    <div class="org-form-header">
        <h2><i class="fas fa-sitemap"></i> Edit Struktur Organisasi</h2>
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

    <form id="orgForm" action="{{ route('admin.organization-structure.update', $structure->id) }}"
          method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

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
                       value="{{ old('title', $structure->name) }}" required>
            </div>
        </div>

        <div class="form-card">
            <div class="section-header">
                <i class="fas fa-users"></i>
                <h4>Anggota Organisasi</h4>
                <span class="members-count" id="membersCount">{{ $structure->members->count() }} Anggota</span>
            </div>

            <div id="membersContainer">
                @foreach($structure->members->sortBy('order') as $i => $member)
                <div class="member-card" data-index="{{ $i }}">
                    <div class="member-header">
                        <span class="member-number">{{ $i + 1 }}</span>
                        <button type="button" class="btn-remove-member" onclick="removeMember(this)">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="member-fields">
                        <div class="form-group">
                            <label class="form-label">Nama Lengkap <span class="required">*</span></label>
                            <input type="text" name="members[{{ $i }}][name]" class="form-control"
                                   value="{{ old('members.'.$i.'.name', $member->name) }}"
                                   placeholder="Nama lengkap" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Jabatan <span class="required">*</span></label>
                            <input type="text" name="members[{{ $i }}][position]" class="form-control"
                                   value="{{ old('members.'.$i.'.position', $member->position) }}"
                                   placeholder="Contoh: Ketua, Sekretaris" required>
                        </div>
                        <div class="form-group full-width">
                            <label class="form-label">Foto <span class="optional">(Opsional — kosongkan jika tidak ingin mengubah)</span></label>
                            @if($member->photo)
                            <div class="photo-preview" style="display:flex;">
                                <img class="preview-img" src="{{ asset('storage/'.$member->photo) }}" alt="{{ $member->name }}">
                                <button type="button" class="btn-remove-photo" onclick="removePhoto(this)">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            @endif
                            <div class="file-upload-area mt-2" onclick="this.querySelector('input').click()">
                                <input type="file" name="members[{{ $i }}][photo]" accept="image/*"
                                       class="file-input" onchange="previewPhoto(this)">
                                <div class="upload-placeholder">
                                    <i class="fas fa-camera"></i>
                                    <span>Klik untuk ganti foto</span>
                                    <small>JPG, PNG | Maks 2MB</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <button type="button" class="btn-add-member" onclick="addMember()">
                <i class="fas fa-user-plus"></i> Tambah Anggota
            </button>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-submit">
                <i class="fas fa-save"></i> Simpan Perubahan
            </button>
            <a href="{{ route('admin.organization-structure.index') }}" class="btn-cancel">
                Batal
            </a>
        </div>
    </form>
</div>

@include('admin.organization-structure._styles')

<script>
let memberIndex = {{ $structure->members->count() }};

function addMember() {
    const container = document.getElementById('membersContainer');
    const card = document.createElement('div');
    card.className = 'member-card';
    card.setAttribute('data-index', memberIndex);
    card.innerHTML = `
        <div class="member-header">
            <span class="member-number">${memberIndex + 1}</span>
            <button type="button" class="btn-remove-member" onclick="removeMember(this)">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="member-fields">
            <div class="form-group">
                <label class="form-label">Nama Lengkap <span class="required">*</span></label>
                <input type="text" name="members[${memberIndex}][name]" class="form-control"
                       placeholder="Nama lengkap" required>
            </div>
            <div class="form-group">
                <label class="form-label">Jabatan <span class="required">*</span></label>
                <input type="text" name="members[${memberIndex}][position]" class="form-control"
                       placeholder="Contoh: Ketua, Sekretaris" required>
            </div>
            <div class="form-group full-width">
                <label class="form-label">Foto <span class="optional">(Opsional)</span></label>
                <div class="file-upload-area" onclick="this.querySelector('input').click()">
                    <input type="file" name="members[${memberIndex}][photo]" accept="image/*"
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
        </div>`;
    container.appendChild(card);
    memberIndex++;
    updateCount();
}

function removeMember(btn) {
    const cards = document.querySelectorAll('.member-card');
    if (cards.length <= 1) { alert('Minimal harus ada 1 anggota'); return; }
    if (confirm('Hapus anggota ini?')) {
        btn.closest('.member-card').remove();
        updateCount();
        renumber();
    }
}

function renumber() {
    document.querySelectorAll('.member-card').forEach((card, i) => {
        card.querySelector('.member-number').textContent = i + 1;
    });
}

function updateCount() {
    const count = document.querySelectorAll('.member-card').length;
    document.getElementById('membersCount').textContent = `${count} Anggota`;
}

function previewPhoto(input) {
    const file = input.files[0];
    if (!file) return;
    if (file.size > 2 * 1024 * 1024) { alert('Maks 2MB'); input.value = ''; return; }
    const card = input.closest('.member-card');
    const preview = card.querySelector('.photo-preview');
    const img = card.querySelector('.preview-img');
    const reader = new FileReader();
    reader.onload = e => { img.src = e.target.result; preview.style.display = 'flex'; };
    reader.readAsDataURL(file);
}

function removePhoto(btn) {
    const card = btn.closest('.member-card');
    const preview = card.querySelector('.photo-preview');
    const fileInput = card.querySelector('.file-input');
    preview.style.display = 'none';
    if (fileInput) fileInput.value = '';
}
</script>
@endsection
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

            {{-- PREVIEW HIERARKI LIVE --}}
            <div id="hierarchyPreview" class="hierarchy-preview" style="display:none;">
                <div class="preview-header">
                    <i class="fas fa-diagram-project"></i>
                    <span>Preview Hierarki</span>
                </div>
                <div id="previewTree" class="preview-tree"></div>
            </div>

            <div id="membersContainer">
                <div class="member-card" data-index="0">
                    <div class="member-header">
                        <span class="member-number">1</span>
                        <div class="member-header-right">
                            <span class="level-badge" id="levelBadge-0">Level 1</span>
                            <button type="button" class="btn-remove-member" onclick="removeMember(this)">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="member-fields">
                        <div class="form-group">
                            <label class="form-label">Nama Lengkap <span class="required">*</span></label>
                            <input type="text" name="members[0][name]" class="form-control member-name"
                                   placeholder="Nama lengkap" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Jabatan <span class="required">*</span></label>
                            <input type="text" name="members[0][position]" class="form-control member-position"
                                   placeholder="Contoh: Ketua, Sekretaris" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Atasan (Opsional)</label>
                            <select name="members[0][parent_index]" class="form-control parent-select" onchange="onParentChange(this)">
                                <option value="">-- Tidak ada (Paling atas) --</option>
                            </select>
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
            <button type="submit" class="btn-submit" onclick="return validateBeforeSubmit()">
                <i class="fas fa-save"></i> Simpan Struktur
            </button>
            <a href="{{ route('admin.organization-structure.index') }}" class="btn-cancel">
                Batal
            </a>
        </div>
    </form>
</div>

<style>
.org-form-container {
    max-width: 900px;
    margin: 0 auto;
    padding: 20px;
}

.org-form-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    padding-bottom: 15px;
    border-bottom: 2px solid #e9ecef;
}

.org-form-header h2 {
    margin: 0;
    color: #2c3e50;
    font-size: 1.5rem;
}

.org-form-header h2 i {
    margin-right: 10px;
    color: #3498db;
}

.btn-back {
    background: #6c757d;
    color: white;
    padding: 8px 16px;
    border-radius: 6px;
    text-decoration: none;
    transition: all 0.3s;
}

.btn-back:hover {
    background: #5a6268;
    color: white;
}

.form-card {
    background: white;
    border-radius: 12px;
    padding: 25px;
    margin-bottom: 25px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
}

.section-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 25px;
    padding-bottom: 12px;
    border-bottom: 2px solid #f0f0f0;
}

.section-header i {
    font-size: 1.3rem;
    color: #3498db;
}

.section-header h4 {
    margin: 0;
    color: #2c3e50;
}

.members-count {
    margin-left: auto;
    font-size: 0.85rem;
    color: #6c757d;
    background: #f8f9fa;
    padding: 4px 10px;
    border-radius: 20px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group.full-width {
    grid-column: 1 / -1;
}

.form-label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: #2c3e50;
    font-size: 0.9rem;
}

.required { color: #e74c3c; }
.optional { color: #6c757d; font-weight: normal; font-size: 0.8rem; }

.form-control {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 0.9rem;
    transition: all 0.3s;
}

.form-control:focus {
    outline: none;
    border-color: #3498db;
    box-shadow: 0 0 0 3px rgba(52,152,219,0.1);
}

.member-card {
    background: #f8f9fa;
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 20px;
    position: relative;
    border: 1px solid #e9ecef;
    transition: border-color 0.2s;
}

.member-card.has-parent {
    border-left: 4px solid #3498db;
}

.member-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

.member-header-right {
    display: flex;
    align-items: center;
    gap: 8px;
}

.member-number {
    background: #3498db;
    color: white;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    font-size: 0.9rem;
    font-weight: bold;
}

/* Level badge warna per level */
.level-badge {
    font-size: 0.75rem;
    font-weight: 700;
    padding: 3px 10px;
    border-radius: 20px;
    background: #ecf0f1;
    color: #7f8c8d;
    transition: all 0.3s;
}
.level-badge.level-1 { background: #fef9e7; color: #d97706; border: 1px solid #f59e0b; }
.level-badge.level-2 { background: #eafaf1; color: #059669; border: 1px solid #10b981; }
.level-badge.level-3 { background: #eaf3fb; color: #2563eb; border: 1px solid #3b82f6; }
.level-badge.level-4 { background: #f5eef8; color: #7c3aed; border: 1px solid #8b5cf6; }
.level-badge.level-5 { background: #fef2f2; color: #dc2626; border: 1px solid #ef4444; }

.btn-remove-member {
    background: #e74c3c;
    color: white;
    border: none;
    width: 30px;
    height: 30px;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.3s;
}

.btn-remove-member:hover { background: #c0392b; }

.member-fields {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
}

.btn-add-member {
    width: 100%;
    padding: 12px;
    background: #ecf0f1;
    border: 2px dashed #bdc3c7;
    border-radius: 8px;
    color: #7f8c8d;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
    margin-top: 10px;
}

.btn-add-member:hover {
    background: #e0e4e8;
    border-color: #95a5a6;
    color: #2c3e50;
}

.file-upload-area {
    border: 2px dashed #bdc3c7;
    border-radius: 8px;
    padding: 20px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s;
    background: #f8f9fa;
}

.file-upload-area:hover {
    border-color: #3498db;
    background: #e8f4fd;
}

.upload-placeholder {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
}

.upload-placeholder i { font-size: 2rem; color: #bdc3c7; }
.upload-placeholder span { font-size: 0.9rem; color: #7f8c8d; }
.upload-placeholder small { font-size: 0.75rem; color: #95a5a6; }
.file-input { display: none; }

.photo-preview {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 8px;
}

.preview-img {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 8px;
}

.btn-remove-photo {
    background: #e74c3c;
    color: white;
    border: none;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    cursor: pointer;
}

.form-actions {
    display: flex;
    gap: 15px;
    justify-content: flex-end;
    margin-top: 30px;
}

.btn-submit {
    background: #27ae60;
    color: white;
    padding: 12px 24px;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
}

.btn-submit:hover { background: #229954; }

.btn-cancel {
    background: #95a5a6;
    color: white;
    padding: 12px 24px;
    border-radius: 8px;
    text-decoration: none;
    transition: all 0.3s;
}

.btn-cancel:hover { background: #7f8c8d; color: white; }

.alert {
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 20px;
}

.alert-danger {
    background: #fdecea;
    border: 1px solid #f5c6cb;
    color: #721c24;
}

/* Hierarchy Preview */
.hierarchy-preview {
    background: #f0f7ff;
    border: 1px solid #bee3f8;
    border-radius: 10px;
    padding: 16px;
    margin-bottom: 20px;
}

.preview-header {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.85rem;
    font-weight: 700;
    color: #2563eb;
    margin-bottom: 12px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.preview-tree {
    font-size: 0.85rem;
    line-height: 1.8;
}

.preview-node {
    display: flex;
    align-items: center;
    gap: 6px;
    color: #374151;
    padding: 2px 0;
}

.preview-node .dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    flex-shrink: 0;
}

.dot-l1 { background: #f59e0b; }
.dot-l2 { background: #10b981; }
.dot-l3 { background: #3b82f6; }
.dot-l4 { background: #8b5cf6; }
.dot-l5 { background: #ef4444; }
</style>

<script>
// ============================================================
// CORE: Hitung level tiap member berdasarkan parent_index
// Ini adalah fungsi UTAMA yang menentukan level hierarki
// ============================================================
function computeLevels() {
    const members = document.querySelectorAll('.member-card');
    const levelMap = {}; // index -> level (0-based)

    members.forEach((member, index) => {
        const select = member.querySelector('.parent-select');
        const parentVal = select ? select.value : '';

        if (parentVal === '' || parentVal === null) {
            levelMap[index] = 0; // root = level 0
        } else {
            const parentIndex = parseInt(parentVal);
            // Level parent + 1, dengan fallback ke 0 jika parent belum dihitung
            levelMap[index] = (levelMap[parentIndex] !== undefined ? levelMap[parentIndex] : 0) + 1;
        }
    });

    return levelMap;
}

// ============================================================
// UPDATE LEVEL BADGES di setiap member card
// ============================================================
function updateLevelBadges() {
    const levelMap = computeLevels();
    const members = document.querySelectorAll('.member-card');

    members.forEach((member, index) => {
        const level = (levelMap[index] ?? 0) + 1; // tampilkan 1-based
        const badge = member.querySelector('.level-badge');
        const select = member.querySelector('.parent-select');

        if (badge) {
            badge.textContent = `Level ${level}`;
            badge.className = `level-badge level-${Math.min(level, 5)}`;
        }

        // Visual: tambahkan class has-parent jika bukan root
        if (select && select.value !== '') {
            member.classList.add('has-parent');
        } else {
            member.classList.remove('has-parent');
        }
    });
}

// ============================================================
// UPDATE PARENT DROPDOWN - dengan preserve selected value
// dan cegah circular reference
// ============================================================
function updateParentOptions() {
    const members = document.querySelectorAll('.member-card');

    members.forEach((member, currentIndex) => {
        const select = member.querySelector('.parent-select');
        if (!select) return;

        // Simpan nilai yang sedang dipilih sebelum di-reset
        const savedValue = select.value;

        // Reset options
        select.innerHTML = '<option value="">-- Tidak ada (Paling atas) --</option>';

        members.forEach((m, i) => {
            if (i === currentIndex) return; // Tidak bisa pilih diri sendiri

            // Cegah circular: cek apakah i adalah descendant dari currentIndex
            if (isDescendant(currentIndex, i, members)) return;

            const nameInput = m.querySelector('input[name*="[name]"]');
            const positionInput = m.querySelector('input[name*="[position]"]');

            const name = nameInput?.value?.trim() || `Anggota ${i + 1}`;
            const position = positionInput?.value?.trim() || '';

            const option = document.createElement('option');
            option.value = i;
            option.textContent = position ? `${name} (${position})` : name;

            select.appendChild(option);
        });

        // Restore nilai yang dipilih sebelumnya jika masih valid
        if (savedValue !== '' && select.querySelector(`option[value="${savedValue}"]`)) {
            select.value = savedValue;
        } else {
            select.value = '';
        }
    });

    // Update level badges setelah semua dropdown diupdate
    updateLevelBadges();
    updatePreviewTree();
}

// ============================================================
// CEK APAKAH targetIndex adalah descendant dari sourceIndex
// Untuk mencegah circular reference
// ============================================================
function isDescendant(sourceIndex, targetIndex, members) {
    // Telusuri ke atas dari targetIndex
    // Jika suatu saat sampai ke sourceIndex, berarti circular
    const visited = new Set();
    let current = targetIndex;

    while (current !== '' && current !== null && current !== undefined) {
        if (visited.has(current)) break; // infinite loop protection
        visited.add(current);

        const targetMember = members[current];
        if (!targetMember) break;

        const select = targetMember.querySelector('.parent-select');
        if (!select || select.value === '') break;

        const parentVal = parseInt(select.value);
        if (parentVal === sourceIndex) return true; // circular ditemukan
        current = parentVal;
    }

    return false;
}

// ============================================================
// UPDATE PREVIEW HIERARKI LIVE
// ============================================================
function updatePreviewTree() {
    const members = document.querySelectorAll('.member-card');
    const preview = document.getElementById('hierarchyPreview');
    const previewTree = document.getElementById('previewTree');

    if (members.length <= 1) {
        preview.style.display = 'none';
        return;
    }

    preview.style.display = 'block';
    const levelMap = computeLevels();

    // Build parent-children map
    const children = {};
    const roots = [];

    members.forEach((member, index) => {
        const select = member.querySelector('.parent-select');
        const parentVal = select?.value;
        const name = member.querySelector('input[name*="[name]"]')?.value?.trim() || `Anggota ${index + 1}`;
        const position = member.querySelector('input[name*="[position]"]')?.value?.trim() || '';

        if (parentVal === '' || parentVal === null || parentVal === undefined) {
            roots.push({ index, name, position, level: 0 });
        } else {
            const pid = parseInt(parentVal);
            if (!children[pid]) children[pid] = [];
            children[pid].push({ index, name, position, level: levelMap[index] });
        }
    });

    function renderNode(node, indent) {
        const level = node.level + 1;
        const dotClass = `dot-l${Math.min(level, 5)}`;
        const prefix = '&nbsp;'.repeat(indent * 4);
        const connector = indent > 0 ? '└─ ' : '';
        let html = `<div class="preview-node">${prefix}${connector}<span class="dot ${dotClass}"></span> <strong>${node.name || `Anggota ${node.index + 1}`}</strong>${node.position ? ` <span style="color:#9ca3af">· ${node.position}</span>` : ''} <span style="color:#9ca3af;font-size:0.75rem">(Level ${level})</span></div>`;

        if (children[node.index]) {
            children[node.index].forEach(child => {
                html += renderNode(child, indent + 1);
            });
        }
        return html;
    }

    let html = '';
    roots.forEach(root => { html += renderNode(root, 0); });
    previewTree.innerHTML = html || '<span style="color:#9ca3af">Belum ada data</span>';
}

// ============================================================
// TAMBAH MEMBER BARU
// ============================================================
function addMember() {
    const container = document.getElementById('membersContainer');
    const memberCount = container.children.length;
    const newIndex = memberCount;

    const newMember = document.createElement('div');
    newMember.className = 'member-card';
    newMember.setAttribute('data-index', newIndex);

    newMember.innerHTML = `
        <div class="member-header">
            <span class="member-number">${newIndex + 1}</span>
            <div class="member-header-right">
                <span class="level-badge" id="levelBadge-${newIndex}">Level 1</span>
                <button type="button" class="btn-remove-member" onclick="removeMember(this)">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="member-fields">
            <div class="form-group">
                <label class="form-label">Nama Lengkap <span class="required">*</span></label>
                <input type="text" name="members[${newIndex}][name]" class="form-control member-name"
                       placeholder="Nama lengkap" required>
            </div>
            <div class="form-group">
                <label class="form-label">Jabatan <span class="required">*</span></label>
                <input type="text" name="members[${newIndex}][position]" class="form-control member-position"
                       placeholder="Contoh: Ketua, Sekretaris" required>
            </div>
            <div class="form-group">
                <label class="form-label">Atasan (Opsional)</label>
                <select name="members[${newIndex}][parent_index]" class="form-control parent-select" onchange="onParentChange(this)">
                    <option value="">-- Tidak ada (Paling atas) --</option>
                </select>
            </div>
            <div class="form-group full-width">
                <label class="form-label">Foto <span class="optional">(Opsional)</span></label>
                <div class="file-upload-area" onclick="this.querySelector('input').click()">
                    <input type="file" name="members[${newIndex}][photo]" accept="image/*"
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
    `;

    container.appendChild(newMember);
    updateParentOptions();
    updateMembersCount();
}

// ============================================================
// HAPUS MEMBER
// ============================================================
function removeMember(btn) {
    const memberCard = btn.closest('.member-card');
    const container = document.getElementById('membersContainer');

    if (container.children.length === 1) {
        alert('Minimal harus ada 1 anggota');
        return;
    }

    // Dapatkan index member yang dihapus
    const removedIndex = parseInt(memberCard.getAttribute('data-index'));

    memberCard.remove();

    // Reindex dan perbaiki parent_index yang mengacu ke index lama
    reindexMembers(removedIndex);
    updateParentOptions();
}

// ============================================================
// REINDEX MEMBER - FIX: update parent_index yang ikut bergeser
// ============================================================
function reindexMembers(removedIndex) {
    const members = document.querySelectorAll('.member-card');

    members.forEach((member, newIndex) => {
        const oldIndex = parseInt(member.getAttribute('data-index'));

        // Update nomor tampilan
        member.querySelector('.member-number').textContent = newIndex + 1;

        // Update data-index
        member.setAttribute('data-index', newIndex);

        // Update semua input name
        member.querySelectorAll('input, select').forEach(el => {
            const name = el.getAttribute('name');
            if (name && name.includes('members[')) {
                el.name = name.replace(/members\[\d+\]/, `members[${newIndex}]`);
            }
        });

        // FIX UTAMA: Update nilai parent_index yang mengacu ke index lama
        const select = member.querySelector('.parent-select');
        if (select && select.value !== '') {
            const parentVal = parseInt(select.value);

            if (parentVal === removedIndex) {
                // Parent-nya adalah member yang dihapus → reset ke root
                select.value = '';
            } else if (parentVal > removedIndex) {
                // Parent-nya bergeser ke bawah → kurangi 1
                select.value = parentVal - 1;
            }
            // parentVal < removedIndex → tidak berubah
        }
    });

    updateMembersCount();
}

// ============================================================
// EVENT: Saat parent dipilih
// ============================================================
function onParentChange(select) {
    updateParentOptions(); // akan preserve nilai lain dan update badges
}

// ============================================================
// UPDATE COUNTER
// ============================================================
function updateMembersCount() {
    const members = document.querySelectorAll('.member-card');
    document.getElementById('membersCount').textContent = `${members.length} Anggota`;
}

// ============================================================
// PREVIEW FOTO
// ============================================================
function previewPhoto(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        const fileUploadArea = input.closest('.file-upload-area');
        const photoPreview = fileUploadArea.nextElementSibling;
        const previewImg = photoPreview.querySelector('.preview-img');

        reader.onload = function(e) {
            previewImg.src = e.target.result;
            fileUploadArea.style.display = 'none';
            photoPreview.style.display = 'flex';
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function removePhoto(btn) {
    const photoPreview = btn.closest('.photo-preview');
    const fileUploadArea = photoPreview.previousElementSibling;
    const fileInput = fileUploadArea.querySelector('.file-input');

    fileInput.value = '';
    fileUploadArea.style.display = 'flex';
    photoPreview.style.display = 'none';
}

// ============================================================
// VALIDASI SEBELUM SUBMIT
// ============================================================
function validateBeforeSubmit() {
    const members = document.querySelectorAll('.member-card');
    let valid = true;

    members.forEach((member, index) => {
        const select = member.querySelector('.parent-select');
        if (!select || select.value === '') return;

        const parentVal = parseInt(select.value);
        if (isDescendant(index, parentVal, members)) {
            alert(`Anggota ${index + 1} memiliki referensi parent yang melingkar (circular). Silakan perbaiki.`);
            valid = false;
        }
    });

    return valid;
}

// ============================================================
// EVENT LISTENER: Update dropdown saat nama/jabatan diketik
// ============================================================
document.addEventListener('input', function(e) {
    if (e.target.classList.contains('member-name') || e.target.classList.contains('member-position')) {
        updateParentOptions();
    }
});

// ============================================================
// INIT
// ============================================================
document.addEventListener('DOMContentLoaded', function() {
    updateParentOptions();
    updateMembersCount();
});
</script>

@endsection
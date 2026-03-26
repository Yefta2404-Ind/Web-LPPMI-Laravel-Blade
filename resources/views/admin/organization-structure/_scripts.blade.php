{{-- resources/views/admin/organization-structure/_scripts.blade.php --}}
<script>
let memberIndex = 1;

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
    card.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
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
    if (file.size > 2 * 1024 * 1024) { alert('Ukuran file maksimal 2MB'); input.value = ''; return; }
    const card = input.closest('.member-card');
    const preview = card.querySelector('.photo-preview');
    const img = card.querySelector('.preview-img');
    const reader = new FileReader();
    reader.onload = e => { img.src = e.target.result; preview.style.display = 'flex'; };
    reader.readAsDataURL(file);
}

function removePhoto(btn) {
    const card = btn.closest('.member-card');
    card.querySelector('.photo-preview').style.display = 'none';
    const fileInput = card.querySelector('.file-input');
    if (fileInput) fileInput.value = '';
}
</script>
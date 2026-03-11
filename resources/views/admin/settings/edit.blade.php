@extends('layouts.admin')

@section('title', 'Pengaturan Situs')

@section('content')
<div class="settings-wrapper">

    {{-- Page Header --}}
    <div class="page-header">
        <div class="header-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="3"/>
                <path d="M19.07 4.93a10 10 0 0 1 0 14.14M4.93 4.93a10 10 0 0 0 0 14.14"/>
            </svg>
        </div>
        <div>
            <h1 class="page-title">Pengaturan Situs</h1>
            <p class="page-subtitle">Kelola informasi umum, kontak, sosial media, dan footer website</p>
        </div>
    </div>

    {{-- Alert Success --}}
    @if(session('success'))
        <div class="alert-success" id="successAlert">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="cards-grid">

            {{-- ==================== 01 IDENTITAS SITUS ==================== --}}
            <div class="card card-full">
                <div class="card-header">
                    <span class="card-badge badge-blue">01</span>
                    <div>
                        <h2 class="card-title">Identitas Situs</h2>
                        <p class="card-desc">Nama, subjudul, dan kontak utama website</p>
                    </div>
                </div>
                <div class="card-body">

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="site_name">
                                Nama Situs <span class="required">*</span>
                            </label>
                            <input type="text" id="site_name" name="site_name"
                                class="form-input @error('site_name') is-error @enderror"
                                value="{{ old('site_name', $settings->site_name ?? '') }}"
                                placeholder="Contoh: LPPMI">
                            @error('site_name')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="site_subtitle">Subjudul Situs</label>
                            <input type="text" id="site_subtitle" name="site_subtitle"
                                class="form-input"
                                value="{{ old('site_subtitle', $settings->site_subtitle ?? '') }}"
                                placeholder="Contoh: Universitas Gunung Kidul">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="phone">Nomor Telepon</label>
                            <div class="input-with-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.77 1h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 8.91a16 16 0 0 0 5.91 5.91l.91-.91a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>
                                </svg>
                                <input type="text" id="phone" name="phone"
                                    class="form-input has-icon"
                                    value="{{ old('phone', $settings->phone ?? '') }}"
                                    placeholder="+62 xxx-xxxx-xxxx">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="email">Email</label>
                            <div class="input-with-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                    <polyline points="22,6 12,13 2,6"/>
                                </svg>
                                <input type="email" id="email" name="email"
                                    class="form-input has-icon @error('email') is-error @enderror"
                                    value="{{ old('email', $settings->email ?? '') }}"
                                    placeholder="admin@example.com">
                            </div>
                            @error('email')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="address">Alamat</label>
                        <div class="input-with-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                <circle cx="12" cy="10" r="3"/>
                            </svg>
                            <input type="text" id="address" name="address"
                                class="form-input has-icon"
                                value="{{ old('address', $settings->address ?? '') }}"
                                placeholder="Jl. Contoh No. 1, Kota">
                        </div>
                    </div>

                </div>
            </div>

            {{-- ==================== 02 LOGO ==================== --}}
            <div class="card card-full">
                <div class="card-header">
                    <span class="card-badge badge-purple">02</span>
                    <div>
                        <h2 class="card-title">Logo Situs</h2>
                        <p class="card-desc">Logo yang tampil di header website</p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">Logo</label>
                        <div class="upload-zone" onclick="document.getElementById('logo').click()">
                            @if(!empty($settings->logo))
                                <img src="{{ asset('storage/' . $settings->logo) }}"
                                     alt="Logo" class="preview-img" id="logoPreview">
                            @else
                                <div class="upload-placeholder" id="logoPlaceholder">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="3" width="18" height="18" rx="2"/>
                                        <circle cx="8.5" cy="8.5" r="1.5"/>
                                        <polyline points="21 15 16 10 5 21"/>
                                    </svg>
                                    <span>Klik untuk upload logo</span>
                                    <small>PNG, JPG, SVG (maks. 2MB)</small>
                                </div>
                                <img src="" alt="Logo Preview" class="preview-img d-none" id="logoPreview">
                            @endif
                        </div>
                        <input type="file" id="logo" name="logo" accept="image/*" class="d-none"
                               onchange="previewImage(this, 'logoPreview', 'logoPlaceholder')">
                        <p class="field-hint">Kosongkan jika tidak ingin mengganti logo.</p>
                    </div>
                </div>
            </div>

            {{-- ==================== 03 SOSIAL MEDIA ==================== --}}
            <div class="card card-full">
                <div class="card-header">
                    <span class="card-badge badge-teal">03</span>
                    <div>
                        <h2 class="card-title">Sosial Media</h2>
                        <p class="card-desc">Link akun sosial media yang ditampilkan di header & footer</p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="social-grid">

                        <div class="social-item">
                            <div class="social-icon social-fb">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
                                </svg>
                            </div>
                            <div class="form-group flex-1">
                                <label class="form-label" for="facebook">Facebook</label>
                                <input type="url" id="facebook" name="facebook"
                                    class="form-input"
                                    value="{{ old('facebook', $settings->facebook ?? '') }}"
                                    placeholder="https://facebook.com/...">
                            </div>
                        </div>

                        <div class="social-item">
                            <div class="social-icon social-ig">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                                    <circle cx="12" cy="12" r="4"/>
                                    <circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/>
                                </svg>
                            </div>
                            <div class="form-group flex-1">
                                <label class="form-label" for="instagram">Instagram</label>
                                <input type="url" id="instagram" name="instagram"
                                    class="form-input"
                                    value="{{ old('instagram', $settings->instagram ?? '') }}"
                                    placeholder="https://instagram.com/...">
                            </div>
                        </div>

                        <div class="social-item">
                            <div class="social-icon social-tw">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"/>
                                </svg>
                            </div>
                            <div class="form-group flex-1">
                                <label class="form-label" for="twitter">Twitter / X</label>
                                <input type="url" id="twitter" name="twitter"
                                    class="form-input"
                                    value="{{ old('twitter', $settings->twitter ?? '') }}"
                                    placeholder="https://twitter.com/...">
                            </div>
                        </div>

                        <div class="social-item">
                            <div class="social-icon social-yt">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22.54 6.42a2.78 2.78 0 0 0-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46a2.78 2.78 0 0 0-1.95 1.96A29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58A2.78 2.78 0 0 0 3.41 19.6C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 0 0 1.95-1.95A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58z"/>
                                    <polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02" fill="currentColor" stroke="none"/>
                                </svg>
                            </div>
                            <div class="form-group flex-1">
                                <label class="form-label" for="youtube">YouTube</label>
                                <input type="url" id="youtube" name="youtube"
                                    class="form-input"
                                    value="{{ old('youtube', $settings->youtube ?? '') }}"
                                    placeholder="https://youtube.com/...">
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            {{-- ==================== 04 FOOTER ==================== --}}
            <div class="card card-full">
                <div class="card-header">
                    <span class="card-badge badge-amber">04</span>
                    <div>
                        <h2 class="card-title">Pengaturan Footer</h2>
                        <p class="card-desc">Deskripsi, kontak, dan informasi di bagian bawah halaman</p>
                    </div>
                </div>
                <div class="card-body">

                    <div class="form-group">
                        <label class="form-label" for="footer_description">Deskripsi Footer</label>
                        <textarea id="footer_description" name="footer_description"
                            class="form-textarea" rows="3"
                            placeholder="Deskripsi singkat lembaga yang tampil di footer...">{{ old('footer_description', $settings->footer_description ?? '') }}</textarea>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="footer_address">Alamat Footer</label>
                            <input type="text" id="footer_address" name="footer_address"
                                class="form-input"
                                value="{{ old('footer_address', $settings->footer_address ?? '') }}"
                                placeholder="Alamat lengkap di footer">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="footer_phone">Telepon Footer</label>
                            <input type="text" id="footer_phone" name="footer_phone"
                                class="form-input"
                                value="{{ old('footer_phone', $settings->footer_phone ?? '') }}"
                                placeholder="+62 xxx-xxxx-xxxx">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="footer_email">Email Footer</label>
                            <input type="email" id="footer_email" name="footer_email"
                                class="form-input"
                                value="{{ old('footer_email', $settings->footer_email ?? '') }}"
                                placeholder="email@example.com">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="footer_website">Website</label>
                            <input type="url" id="footer_website" name="footer_website"
                                class="form-input"
                                value="{{ old('footer_website', $settings->footer_website ?? '') }}"
                                placeholder="https://example.ac.id">
                        </div>
                    </div>

                </div>
            </div>

        </div>{{-- end cards-grid --}}

        <div class="form-actions">
            <button type="submit" class="btn-save">
                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                    <polyline points="17 21 17 13 7 13 7 21"/>
                    <polyline points="7 3 7 8 15 8"/>
                </svg>
                Simpan Pengaturan
            </button>
        </div>

    </form>
</div>

<style>
:root {
    --acc:       #4361ee;
    --acc-light: #eef1fd;
    --acc-hover: #3451d1;
    --bdr:       #e8ecf4;
    --tp:        #1b1f2e;
    --ts:        #6b7491;
    --tm:        #9ba3bb;
    --r:         12px;
    --rsm:       8px;
    --sh:        0 2px 12px rgba(67,97,238,.07);
    --shm:       0 4px 24px rgba(67,97,238,.12);
}
.settings-wrapper {
    max-width: 960px; margin: 0 auto; padding: 0 0 60px;
    font-family: 'Segoe UI', system-ui, sans-serif;
}
.page-header { display: flex; align-items: center; gap: 16px; margin-bottom: 28px; }
.header-icon {
    width: 48px; height: 48px; background: var(--acc-light); color: var(--acc);
    border-radius: var(--rsm); display: flex; align-items: center; justify-content: center; flex-shrink: 0;
}
.page-title  { font-size: 22px; font-weight: 700; color: var(--tp); margin: 0 0 2px; letter-spacing: -.4px; }
.page-subtitle { font-size: 13.5px; color: var(--ts); margin: 0; }

.alert-success {
    display: flex; align-items: center; gap: 10px; padding: 13px 18px;
    background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: var(--rsm);
    color: #15803d; font-size: 14px; font-weight: 500; margin-bottom: 24px;
    animation: sd .3s ease;
}
@keyframes sd { from { opacity:0; transform:translateY(-8px); } to { opacity:1; transform:translateY(0); } }

.cards-grid { display: flex; flex-direction: column; gap: 20px; }
.card {
    background: #fff; border: 1px solid var(--bdr); border-radius: var(--r);
    box-shadow: var(--sh); overflow: hidden; transition: box-shadow .2s;
}
.card:hover { box-shadow: var(--shm); }
.card-header {
    display: flex; align-items: flex-start; gap: 14px;
    padding: 20px 24px; border-bottom: 1px solid var(--bdr); background: #fafbff;
}
.card-badge {
    width: 32px; height: 32px; border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    font-size: 12px; font-weight: 700; flex-shrink: 0;
}
.badge-blue   { background: #dbeafe; color: #1d4ed8; }
.badge-purple { background: #ede9fe; color: #7c3aed; }
.badge-teal   { background: #ccfbf1; color: #0f766e; }
.badge-amber  { background: #fef3c7; color: #b45309; }
.card-title { font-size: 15px; font-weight: 700; color: var(--tp); margin: 0 0 2px; }
.card-desc  { font-size: 12.5px; color: var(--ts); margin: 0; }
.card-body  { padding: 22px 24px; display: flex; flex-direction: column; gap: 16px; }

.form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
.form-group { display: flex; flex-direction: column; gap: 6px; }
.form-group.flex-1 { flex: 1; }
.form-label { font-size: 13px; font-weight: 600; color: var(--tp); }
.required   { color: #ef4444; margin-left: 2px; }
.field-hint { font-size: 12px; color: var(--tm); margin: 4px 0 0; }
.form-input, .form-textarea {
    width: 100%; padding: 9px 13px; background: #f9fafc;
    border: 1.5px solid var(--bdr); border-radius: var(--rsm);
    font-size: 13.5px; color: var(--tp); outline: none;
    transition: border-color .2s, box-shadow .2s; box-sizing: border-box;
}
.form-input:focus, .form-textarea:focus {
    border-color: var(--acc); box-shadow: 0 0 0 3px rgba(67,97,238,.12); background: #fff;
}
.form-input.is-error { border-color: #ef4444; }
.form-textarea { resize: vertical; min-height: 80px; }
.form-error { font-size: 12px; color: #ef4444; }

.input-with-icon { position: relative; }
.input-with-icon svg {
    position: absolute; left: 12px; top: 50%; transform: translateY(-50%);
    color: var(--tm); pointer-events: none;
}
.form-input.has-icon { padding-left: 36px; }

.upload-zone {
    border: 2px dashed var(--bdr); border-radius: var(--rsm);
    min-height: 110px; display: flex; align-items: center; justify-content: center;
    cursor: pointer; background: #f9fafc; transition: border-color .2s, background .2s; overflow: hidden;
}
.upload-zone:hover { border-color: var(--acc); background: var(--acc-light); }
.upload-placeholder {
    display: flex; flex-direction: column; align-items: center; gap: 6px;
    color: var(--tm); text-align: center; padding: 16px;
}
.upload-placeholder span  { font-size: 13px; font-weight: 500; color: var(--ts); }
.upload-placeholder small { font-size: 11.5px; }
.preview-img { max-width: 100%; max-height: 90px; object-fit: contain; border-radius: 6px; }
.d-none { display: none !important; }

.social-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
.social-item { display: flex; align-items: flex-end; gap: 12px; }
.social-icon {
    width: 38px; height: 38px; border-radius: var(--rsm);
    display: flex; align-items: center; justify-content: center; flex-shrink: 0;
}
.social-fb { background: #e7f0ff; color: #1877f2; }
.social-ig { background: #fde8f4; color: #e1306c; }
.social-tw { background: #e8f5fe; color: #1da1f2; }
.social-yt { background: #fee8e8; color: #ff0000; }

.form-actions { display: flex; justify-content: flex-end; margin-top: 24px; }
.btn-save {
    display: inline-flex; align-items: center; gap: 9px;
    padding: 11px 26px; background: var(--acc); color: #fff;
    border: none; border-radius: var(--rsm); font-size: 14px; font-weight: 600;
    cursor: pointer; transition: background .2s, transform .15s, box-shadow .2s;
    box-shadow: 0 4px 14px rgba(67,97,238,.3);
}
.btn-save:hover {
    background: var(--acc-hover); transform: translateY(-1px);
    box-shadow: 0 6px 20px rgba(67,97,238,.38);
}

@media (max-width: 640px) {
    .form-row    { grid-template-columns: 1fr; }
    .social-grid { grid-template-columns: 1fr; }
}
</style>

<script>
function previewImage(input, previewId, placeholderId) {
    const preview = document.getElementById(previewId);
    const ph      = document.getElementById(placeholderId);
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            preview.src = e.target.result;
            preview.classList.remove('d-none');
            if (ph) ph.classList.add('d-none');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
const alertEl = document.getElementById('successAlert');
if (alertEl) {
    setTimeout(() => {
        alertEl.style.transition = 'opacity .4s';
        alertEl.style.opacity = '0';
        setTimeout(() => alertEl.remove(), 400);
    }, 4000);
}
</script>
@endsection
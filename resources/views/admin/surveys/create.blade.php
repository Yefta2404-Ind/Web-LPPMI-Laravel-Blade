@extends('layouts.admin')

@section('page-title', 'Buat Survey Baru')

@section('content')
<style>
@import url('https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,400&display=swap');

:root {
    --ink:        #0c0e14;
    --ink-2:      #1e2130;
    --ink-3:      #4a5068;
    --ink-4:      #8891aa;
    --surface:    #ffffff;
    --surface-2:  #f6f7fb;
    --surface-3:  #eef0f8;
    --border:     rgba(30, 33, 48, 0.09);
    --border-md:  rgba(30, 33, 48, 0.15);

    --blue:       #2563eb;
    --blue-2:     #1d4ed8;
    --blue-bg:    #eff4ff;
    --blue-text:  #1a3ea8;
    --blue-ring:  rgba(37, 99, 235, 0.2);

    --green:      #059669;
    --green-bg:   #ecfdf5;
    --green-ring: rgba(5, 150, 105, 0.2);

    --red:        #dc2626;
    --red-bg:     #fff1f2;
    --red-ring:   rgba(220, 38, 38, 0.2);

    --amber:      #d97706;
    --amber-bg:   #fffbeb;

    --r-sm: 8px;
    --r-md: 12px;
    --r-lg: 16px;
    --r-xl: 20px;
    --r-2xl:28px;
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

body { font-family: 'DM Sans', sans-serif; background: var(--surface-2); color: var(--ink-2); }

/* ── OUTER WRAP ── */
.sc-outer {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px 16px 48px;
}
@media (min-width: 640px) { .sc-outer { padding: 32px 24px 64px; } }
@media (min-width: 1024px) { .sc-outer { padding: 44px 24px 80px; } }

/* ── BREADCRUMB ── */
.sc-crumb {
    width: 100%; max-width: 700px;
    display: flex; align-items: center; gap: 8px;
    font-size: 0.75rem; color: var(--ink-4);
    margin-bottom: 16px;
    flex-wrap: wrap;
}
@media (min-width: 640px) {
    .sc-crumb { font-size: 0.78rem; margin-bottom: 20px; }
}
.sc-crumb a { color: var(--blue); text-decoration: none; font-weight: 500; }
.sc-crumb a:hover { text-decoration: underline; }
.sc-crumb i { font-size: 0.6rem; opacity: 0.6; }

/* ── CARD ── */
.sc-card {
    width: 100%; max-width: 700px;
    background: var(--surface);
    border: 1.5px solid var(--border);
    border-radius: var(--r-xl);
    overflow: hidden;
    box-shadow: 0 4px 24px rgba(12, 14, 20, 0.06);
    animation: cardIn 0.4s ease;
}
@media (min-width: 640px) {
    .sc-card { border-radius: var(--r-2xl); }
}
@keyframes cardIn { from { opacity:0; transform:translateY(20px); } to { opacity:1; transform:translateY(0); } }

/* ── CARD HEADER ── */
.sc-head {
    padding: 20px 20px 18px;
    border-bottom: 1px solid var(--border);
    display: flex; align-items: flex-start; gap: 14px;
    background: linear-gradient(135deg, var(--surface) 0%, var(--blue-bg) 100%);
    position: relative;
    overflow: hidden;
}
@media (min-width: 640px) {
    .sc-head { padding: 28px 32px 24px; gap: 16px; }
}
.sc-head::after {
    content: '';
    position: absolute;
    right: -40px; top: -40px;
    width: 140px; height: 140px;
    border-radius: 50%;
    background: rgba(37, 99, 235, 0.06);
    pointer-events: none;
}
@media (min-width: 640px) {
    .sc-head::after { width: 160px; height: 160px; }
}
.sc-head-ico {
    width: 44px; height: 44px;
    border-radius: var(--r-md);
    background: var(--blue);
    display: flex; align-items: center; justify-content: center;
    color: #fff; font-size: 1.1rem;
    flex-shrink: 0;
    box-shadow: 0 4px 14px rgba(37,99,235,0.35);
}
@media (min-width: 640px) {
    .sc-head-ico { width: 52px; height: 52px; font-size: 1.25rem; border-radius: var(--r-lg); }
}
.sc-head-text h1 {
    font-family: 'Sora', sans-serif;
    font-size: 1.1rem; font-weight: 800;
    color: var(--ink); letter-spacing: -0.03em;
    line-height: 1.25; margin-bottom: 4px;
}
@media (min-width: 640px) {
    .sc-head-text h1 { font-size: 1.25rem; margin-bottom: 5px; }
}
.sc-head-text p { font-size: 0.8rem; color: var(--ink-3); line-height: 1.4; }
@media (min-width: 640px) {
    .sc-head-text p { font-size: 0.85rem; line-height: 1.5; }
}

/* ── STEP INDICATOR ── */
.sc-steps {
    display: flex; align-items: center; gap: 0;
    padding: 0 16px;
    background: var(--surface-2);
    border-bottom: 1px solid var(--border);
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    scrollbar-width: thin;
}
@media (min-width: 640px) {
    .sc-steps { padding: 0 24px; }
}
@media (min-width: 768px) {
    .sc-steps { padding: 0 32px; overflow-x: visible; }
}
.sc-step {
    display: flex; align-items: center; gap: 6px;
    padding: 12px 0;
    font-size: 0.7rem; font-weight: 600; color: var(--ink-4);
    white-space: nowrap;
    position: relative;
    transition: color 0.2s;
}
@media (min-width: 640px) {
    .sc-step { gap: 9px; font-size: 0.78rem; padding: 14px 0; }
}
.sc-step.active { color: var(--blue); }
.sc-step.done   { color: var(--green); }

.sc-step-num {
    width: 22px; height: 22px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.65rem; font-weight: 700;
    background: var(--border);
    color: var(--ink-4);
    flex-shrink: 0;
    transition: all 0.2s;
}
@media (min-width: 640px) {
    .sc-step-num { width: 24px; height: 24px; font-size: 0.7rem; }
}
.sc-step.active .sc-step-num { background: var(--blue); color: #fff; box-shadow: 0 2px 8px rgba(37,99,235,0.35); }
.sc-step.done   .sc-step-num { background: var(--green); color: #fff; }

.sc-step-divider {
    width: 20px; height: 1px;
    background: var(--border-md);
    flex-shrink: 0;
    margin: 0 2px;
}
@media (min-width: 640px) {
    .sc-step-divider { width: 28px; margin: 0 4px; }
}

/* ── BODY ── */
.sc-body { padding: 20px; }
@media (min-width: 640px) { .sc-body { padding: 32px; } }

/* ── ERROR ALERT ── */
.sc-err {
    display: flex; align-items: flex-start; gap: 10px;
    background: var(--red-bg);
    border: 1px solid rgba(220,38,38,0.2);
    border-radius: var(--r-md);
    padding: 12px 14px;
    margin-bottom: 20px;
    font-size: 0.8rem; color: var(--red);
}
@media (min-width: 640px) {
    .sc-err { padding: 14px 16px; margin-bottom: 28px; font-size: 0.85rem; }
}
.sc-err i { flex-shrink: 0; margin-top: 2px; }
.sc-err ul { margin: 0; padding-left: 16px; }
.sc-err li { margin-bottom: 2px; }

/* ── FORM GRID ── */
.sc-form { display: flex; flex-direction: column; gap: 20px; }
@media (min-width: 640px) { .sc-form { gap: 24px; } }

/* ── FORM GROUP ── */
.fg { display: flex; flex-direction: column; gap: 6px; }
@media (min-width: 640px) { .fg { gap: 7px; } }

.fg-label {
    font-size: 0.8rem; font-weight: 600;
    color: var(--ink-2); display: flex; align-items: center; gap: 5px;
    flex-wrap: wrap;
}
@media (min-width: 640px) { .fg-label { font-size: 0.84rem; } }
.fg-label .req { color: var(--red); font-size: 0.9em; }
.fg-label .opt {
    font-size: 0.65rem; font-weight: 500; color: var(--ink-4);
    background: var(--surface-3);
    border: 1px solid var(--border-md);
    padding: 1px 6px; border-radius: 99px;
}
@media (min-width: 640px) {
    .fg-label .opt { font-size: 0.68rem; padding: 1px 7px; }
}

.fg-hint {
    font-size: 0.74rem; color: var(--ink-4); line-height: 1.4;
    display: flex; align-items: flex-start; gap: 6px;
}
@media (min-width: 640px) {
    .fg-hint { font-size: 0.78rem; line-height: 1.5; }
}
.fg-hint i { margin-top: 2px; font-size: 0.7rem; flex-shrink: 0; color: var(--blue); }

/* ── INPUTS ── */
.fc {
    width: 100%;
    padding: 10px 12px;
    border: 1.5px solid var(--border-md);
    border-radius: var(--r-md);
    font-family: 'DM Sans', sans-serif;
    font-size: 0.85rem; color: var(--ink);
    background: var(--surface);
    transition: border-color 0.18s, box-shadow 0.18s, background 0.18s;
    outline: none;
}
@media (min-width: 640px) {
    .fc { padding: 11px 15px; font-size: 0.9rem; }
}
.fc::placeholder { color: var(--ink-4); }
.fc:hover  { border-color: rgba(37,99,235,0.35); }
.fc:focus  { border-color: var(--blue); box-shadow: 0 0 0 3px var(--blue-ring); }
.fc.valid  { border-color: var(--green); background: var(--green-bg); }
.fc.valid:focus { box-shadow: 0 0 0 3px var(--green-ring); }
.fc.error  { border-color: var(--red); background: var(--red-bg); }
.fc.error:focus { box-shadow: 0 0 0 3px var(--red-ring); }

textarea.fc { 
    resize: vertical; 
    min-height: 100px; 
    line-height: 1.5;
}
@media (min-width: 640px) {
    textarea.fc { min-height: 110px; line-height: 1.6; }
}

/* ── CHAR COUNTER ── */
.cc {
    display: flex; align-items: center; justify-content: flex-end;
    gap: 6px; font-size: 0.7rem; color: var(--ink-4);
}
@media (min-width: 640px) { .cc { font-size: 0.75rem; } }
.cc-bar {
    height: 3px; border-radius: 2px;
    background: var(--border-md);
    flex: 1; max-width: 100px;
    overflow: hidden;
}
.cc-fill {
    height: 100%; border-radius: 2px;
    background: var(--blue);
    width: 0%;
    transition: width 0.2s, background 0.2s;
}
.cc.warn .cc-fill { background: var(--amber); }
.cc.over .cc-fill { background: var(--red); }
.cc.over .cc-num  { color: var(--red); font-weight: 600; }

/* ── URL PREVIEW ── */
.url-preview {
    display: none;
    align-items: center; gap: 8px;
    padding: 9px 12px;
    background: var(--green-bg);
    border: 1px solid rgba(5,150,105,0.25);
    border-radius: var(--r-md);
    font-size: 0.75rem; color: var(--green);
    font-weight: 500;
}
@media (min-width: 640px) {
    .url-preview { gap: 10px; padding: 11px 15px; font-size: 0.8rem; }
}
.url-preview.show { display: flex; }
.url-preview i { flex-shrink: 0; }

/* ── DIVIDER ── */
.sc-divider {
    height: 1px; background: var(--border); margin: 2px 0;
}
@media (min-width: 640px) { .sc-divider { margin: 4px 0; } }

/* ── QR PREVIEW BLOCK ── */
.qr-info {
    display: flex; align-items: flex-start; gap: 12px;
    background: var(--surface-2);
    border: 1.5px solid var(--border);
    border-radius: var(--r-md);
    padding: 14px;
}
@media (min-width: 640px) {
    .qr-info { gap: 16px; border-radius: var(--r-lg); padding: 18px; }
}
.qr-info-ico {
    width: 52px; height: 52px;
    border-radius: var(--r-md);
    background: var(--surface-3);
    border: 1px dashed var(--border-md);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.6rem; color: var(--ink-4);
    flex-shrink: 0;
}
@media (min-width: 640px) {
    .qr-info-ico { width: 64px; height: 64px; font-size: 2rem; }
}
.qr-info-text h4 {
    font-family: 'Sora', sans-serif;
    font-size: 0.8rem; font-weight: 700; color: var(--ink);
    margin-bottom: 4px;
}
@media (min-width: 640px) {
    .qr-info-text h4 { font-size: 0.875rem; margin-bottom: 5px; }
}
.qr-info-text p { font-size: 0.72rem; color: var(--ink-3); line-height: 1.4; }
@media (min-width: 640px) {
    .qr-info-text p { font-size: 0.78rem; line-height: 1.5; }
}

/* ── FOOTER ── */
.sc-foot {
    display: flex; align-items: center; justify-content: space-between;
    flex-wrap: wrap; gap: 12px;
    padding: 16px 20px;
    background: var(--surface-2);
    border-top: 1px solid var(--border);
}
@media (min-width: 640px) {
    .sc-foot { padding: 22px 32px; gap: 16px; }
}
.sc-foot-hint { 
    font-size: 0.7rem; color: var(--ink-4); 
    display: flex; align-items: center; gap: 5px;
    order: 2;
}
@media (min-width: 640px) {
    .sc-foot-hint { font-size: 0.75rem; order: 1; }
}

.sc-foot-btns { 
    display: flex; 
    gap: 10px; 
    width: 100%;
    order: 1;
}
@media (min-width: 640px) {
    .sc-foot-btns { width: auto; order: 2; }
}

.btn {
    display: inline-flex; align-items: center; justify-content: center;
    gap: 8px;
    padding: 9px 16px; 
    border-radius: var(--r-md);
    font-family: 'DM Sans', sans-serif;
    font-size: 0.8rem; font-weight: 600;
    cursor: pointer; text-decoration: none;
    transition: all 0.2s; border: 1.5px solid transparent;
    white-space: nowrap;
    flex: 1;
}
@media (min-width: 640px) {
    .btn { 
        padding: 10px 20px; 
        border-radius: var(--r-lg);
        font-size: 0.875rem;
        flex: initial;
    }
}
.btn-cancel {
    background: var(--surface); color: var(--ink-2);
    border-color: var(--border-md);
}
.btn-cancel:hover { border-color: var(--ink-4); background: var(--surface-3); }

.btn-submit {
    background: var(--blue); color: #fff;
    border-color: var(--blue);
    box-shadow: 0 3px 12px rgba(37,99,235,0.3);
}
.btn-submit:hover { background: var(--blue-2); transform: translateY(-2px); box-shadow: 0 6px 20px rgba(37,99,235,0.4); }
.btn-submit:disabled { opacity: 0.65; cursor: not-allowed; transform: none; box-shadow: none; }

/* Better touch targets for mobile */
@media (max-width: 640px) {
    .btn, .fc, .sc-step {
        touch-action: manipulation;
    }
    .fc {
        font-size: 16px; /* Prevents zoom on iOS */
    }
}
</style>

<div class="sc-outer">

    {{-- BREADCRUMB --}}
    <div class="sc-crumb">
        <a href="{{ route('admin.surveys.index') }}"><i class="fas fa-poll"></i> Manajemen Survey</a>
        <i class="fas fa-chevron-right"></i>
        <span>Buat Survey Baru</span>
    </div>

    {{-- CARD --}}
    <div class="sc-card">

        {{-- HEAD --}}
        <div class="sc-head">
            <div class="sc-head-ico"><i class="fas fa-poll"></i></div>
            <div class="sc-head-text">
                <h1>Buat Survey Baru</h1>
                <p>Isi detail survey di bawah — QR code akan di-generate otomatis dari link yang Anda masukkan.</p>
            </div>
        </div>

        {{-- STEP INDICATOR --}}
        <div class="sc-steps">
            <div class="sc-step active">
                <div class="sc-step-num">1</div>
                Isi Detail
            </div>
            <div class="sc-step-divider"></div>
            <div class="sc-step">
                <div class="sc-step-num">2</div>
                Generate QR
            </div>
            <div class="sc-step-divider"></div>
            <div class="sc-step">
                <div class="sc-step-num">3</div>
                Aktifkan
            </div>
        </div>

        {{-- BODY --}}
        <div class="sc-body">

            @if($errors->any())
                <div class="sc-err">
                    <i class="fas fa-exclamation-circle"></i>
                    <ul>
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST"
                  action="{{ route('admin.surveys.store') }}"
                  class="sc-form"
                  id="scForm">
                @csrf

                {{-- JUDUL --}}
                <div class="fg">
                    <label for="scTitle" class="fg-label">
                        Judul Survey <span class="req">*</span>
                    </label>
                    <input
                        type="text"
                        id="scTitle"
                        name="title"
                        value="{{ old('title') }}"
                        class="fc {{ $errors->has('title') ? 'error' : '' }}"
                        placeholder="Contoh: Survey Kepuasan Mahasiswa 2025"
                        maxlength="255"
                        required
                        autofocus
                    >
                    <div class="cc" id="titleCc">
                        <div class="cc-bar"><div class="cc-fill" id="titleFill"></div></div>
                        <span class="cc-num" id="titleNum">0/255</span>
                    </div>
                </div>

                {{-- DESKRIPSI --}}
                <div class="fg">
                    <label for="scDesc" class="fg-label">
                        Deskripsi Survey <span class="opt">Opsional</span>
                    </label>
                    <textarea
                        id="scDesc"
                        name="description"
                        class="fc"
                        placeholder="Jelaskan tujuan dan detail survey ini secara singkat…"
                    >{{ old('description') }}</textarea>
                    <div class="fg-hint">
                        <i class="fas fa-info-circle"></i>
                        Deskripsi membantu pengguna memahami tujuan survey sebelum mengisinya.
                    </div>
                </div>

                <div class="sc-divider"></div>

                {{-- URL --}}
                <div class="fg">
                    <label for="scUrl" class="fg-label">
                        Link Google Form <span class="req">*</span>
                    </label>
                    <input
                        type="url"
                        id="scUrl"
                        name="survey_url"
                        value="{{ old('survey_url') }}"
                        class="fc {{ $errors->has('survey_url') ? 'error' : '' }}"
                        placeholder="https://forms.gle/..."
                        required
                    >
                    <div class="url-preview" id="urlPreview">
                        <i class="fas fa-check-circle"></i>
                        Link Google Form terdeteksi — QR code akan di-generate dari link ini.
                    </div>
                    <div class="fg-hint" id="urlHint">
                        <i class="fas fa-qrcode"></i>
                        QR code akan dibuat otomatis saat survey disimpan. Gunakan link Google Forms, Typeform, dll.
                    </div>
                </div>

                {{-- QR INFO BLOCK --}}
                <div class="qr-info">
                    <div class="qr-info-ico"><i class="fas fa-qrcode"></i></div>
                    <div class="qr-info-text">
                        <h4>QR Code Otomatis</h4>
                        <p>Setelah survey disimpan, QR code akan otomatis di-generate dari link form yang Anda masukkan. QR code ini bisa diunduh dan disebarkan ke peserta survey.</p>
                    </div>
                </div>

            </form>
        </div>

        {{-- FOOTER --}}
        <div class="sc-foot">
            <div class="sc-foot-hint">
                <i class="fas fa-shield-alt"></i>
                Form ini memerlukan koneksi internet untuk generate QR.
            </div>
            <div class="sc-foot-btns">
                <a href="{{ route('admin.surveys.index') }}" class="btn btn-cancel">
                    <i class="fas fa-arrow-left"></i> Batal
                </a>
                <button type="submit" form="scForm" class="btn btn-submit" id="scSubmit">
                    <i class="fas fa-qrcode"></i> Buat & Generate QR
                </button>
            </div>
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var titleInput = document.getElementById('scTitle');
    var urlInput   = document.getElementById('scUrl');
    var titleCc    = document.getElementById('titleCc');
    var titleFill  = document.getElementById('titleFill');
    var titleNum   = document.getElementById('titleNum');
    var urlPreview = document.getElementById('urlPreview');
    var urlHint    = document.getElementById('urlHint');
    var form       = document.getElementById('scForm');
    var submitBtn  = document.getElementById('scSubmit');
    var textarea   = document.getElementById('scDesc');

    // Char counter
    function updateCounter() {
        var len = titleInput.value.length;
        var pct = Math.min((len / 255) * 100, 100);
        titleNum.textContent = len + '/255';
        titleFill.style.width = pct + '%';
        titleCc.className = 'cc' + (len > 255 ? ' over' : len > 200 ? ' warn' : '');
    }
    titleInput.addEventListener('input', updateCounter);
    updateCounter();

    // Auto-resize textarea (fixed to also shrink)
    function autoResizeTextarea() {
        if (textarea) {
            textarea.style.height = 'auto';
            textarea.style.height = Math.min(textarea.scrollHeight, 300) + 'px';
        }
    }
    
    if (textarea) {
        textarea.addEventListener('input', autoResizeTextarea);
        // Initial resize
        autoResizeTextarea();
    }

    // URL validation + visual feedback
    function checkUrl() {
        var val = urlInput.value.trim();
        var isGoogle = val.includes('forms.gle') || val.includes('docs.google.com/forms') || val.includes('forms.office.com') || val.includes('typeform.com');
        var hasProtocol = val.startsWith('http://') || val.startsWith('https://');
        var isValid = val.length > 10 && hasProtocol;

        urlInput.classList.remove('valid', 'error');
        urlPreview.classList.remove('show');
        
        if (urlHint) urlHint.style.display = 'flex';

        if (isValid && val.length > 0) {
            urlInput.classList.add('valid');
            if (isGoogle) {
                urlPreview.classList.add('show');
                if (urlHint) urlHint.style.display = 'none';
            }
        } else if (val.length > 5 && !hasProtocol && val.length > 0) {
            urlInput.classList.add('error');
        }
    }
    
    if (urlInput) {
        urlInput.addEventListener('input', checkUrl);
        urlInput.addEventListener('blur', function() {
            var val = this.value.trim();
            if (val && !val.startsWith('http')) {
                this.value = 'https://' + val;
                checkUrl();
            }
        });
        checkUrl();
    }

    // Submit loading state
    if (form) {
        form.addEventListener('submit', function() {
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Membuat Survey…';
            }
        });
    }
    
    // Fix for iOS zoom on input focus
    var inputs = document.querySelectorAll('.fc');
    inputs.forEach(function(input) {
        input.addEventListener('focus', function() {
            if (window.innerWidth < 768) {
                setTimeout(function() {
                    input.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }, 300);
            }
        });
    });
});
</script>
@endsection
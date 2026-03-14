@extends('layouts.admin')

@section('content')
<div class="container-fluid px-2 px-md-4 py-3 py-md-4">

    {{-- Header dengan Breadcrumb --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.pages.index') }}" class="text-decoration-none">Halaman</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Halaman</li>
                </ol>
            </nav>
            <div class="d-flex align-items-center gap-2">
                <h1 class="h2 fw-bold mb-0">{{ $page->title }}</h1>
                <span class="badge bg-{{ $page->status === 'published' ? 'success' : 'warning' }} bg-opacity-10 text-{{ $page->status === 'published' ? 'success' : 'warning' }} px-3 py-2 rounded-pill">
                    <i class="fas fa-{{ $page->status === 'published' ? 'globe' : 'eye-slash' }} me-1"></i>
                    {{ $page->status === 'published' ? 'Published' : 'Draft' }}
                </span>
            </div>
            <p class="text-muted small mb-0">
                <i class="fas fa-clock me-1"></i> Terakhir diperbarui: {{ $page->updated_at->format('d M Y H:i') }}
            </p>
        </div>
        <div class="d-flex gap-2 w-100 w-md-auto">
            <a href="{{ url('/' . $page->slug) }}" target="_blank" class="btn btn-outline-primary flex-fill flex-md-grow-0">
                <i class="fas fa-eye me-1"></i> 
                <span class="d-none d-sm-inline">Preview</span>
            </a>
            <a href="{{ route('admin.pages.index') }}" class="btn btn-outline-secondary flex-fill flex-md-grow-0">
                <i class="fas fa-arrow-left me-1"></i>
                <span class="d-none d-sm-inline">Kembali</span>
            </a>
        </div>
    </div>

    <form action="{{ route('admin.pages.update', $page) }}" method="POST" enctype="multipart/form-data" id="pageForm">
        @csrf @method('PUT')
        
        {{-- Progress Bar untuk Mobile --}}
        <div class="d-block d-lg-none mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <small class="text-muted">Progress Pengisian</small>
                        <small class="text-muted" id="progressPercentage">0%</small>
                    </div>
                    <div class="progress" style="height: 6px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 0%;" id="formProgress"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3 g-lg-4">
            {{-- Konten Utama --}}
            <div class="col-lg-8">
                {{-- Judul dengan karakter counter --}}
                <div class="card border-0 shadow-sm mb-3 mb-lg-4 hover-shadow transition-all">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Judul Halaman <span class="text-danger">*</span>
                                <span class="text-muted small ms-2" id="titleCounter">0/100</span>
                            </label>
                            <input type="text" name="title" id="pageTitle"
                                   class="form-control form-control-lg @error('title') is-invalid @enderror"
                                   value="{{ old('title', $page->title) }}" 
                                   maxlength="100"
                                   required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        {{-- Slug dengan tombol copy --}}
                        <div class="bg-light p-3 rounded">
                            <label class="form-label fw-semibold small text-muted mb-2">
                                <i class="fas fa-link me-1"></i>URL Slug
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-white text-muted">/</span>
                                <input type="text" id="slugPreview" class="form-control bg-white text-muted"
                                       value="{{ $page->slug }}" readonly>
                                <button class="btn btn-outline-secondary" type="button" onclick="copySlug()" 
                                        data-bs-toggle="tooltip" title="Copy slug">
                                    <i class="fas fa-copy"></i>
                                </button>
                            </div>
                            <small class="text-muted d-block mt-2">
                                <i class="fas fa-info-circle me-1"></i>
                                Slug akan otomatis dibuat dari judul
                            </small>
                        </div>
                    </div>
                </div>

                {{-- Editor Konten dengan Tab --}}
                <div class="card border-0 shadow-sm mb-3 mb-lg-4">
                    <div class="card-header bg-white border-bottom p-0">
                        <ul class="nav nav-tabs card-header-tabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active py-3 px-4" id="editor-tab" data-bs-toggle="tab" 
                                        data-bs-target="#editor" type="button" role="tab">
                                    <i class="fas fa-edit me-2"></i>Editor Visual
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link py-3 px-4" id="preview-tab" data-bs-toggle="tab" 
                                        data-bs-target="#preview" type="button" role="tab">
                                    <i class="fas fa-eye me-2"></i>Preview
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body p-0">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="editor" role="tabpanel">
                                <textarea id="tiny-editor" name="content">{!! old('content', $page->content) !!}</textarea>
                            </div>
                            <div class="tab-pane fade p-4" id="preview" role="tabpanel">
                                <div id="content-preview" class="prose max-w-none">
                                    {!! $page->content !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">
                {{-- Floating Action Buttons untuk Mobile --}}
                <div class="d-block d-lg-none mb-3">
                    <div class="btn-group w-100 shadow-sm">
                        <button type="submit" class="btn btn-primary py-3">
                            <i class="fas fa-save me-2"></i> Simpan Perubahan
                        </button>
                        <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" 
                                data-bs-toggle="dropdown">
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="#" onclick="saveAsDraft()">
                                    <i class="fas fa-save me-2"></i> Simpan sebagai Draft
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item text-danger" href="#" onclick="deletePage()">
                                    <i class="fas fa-trash me-2"></i> Hapus Halaman
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- Publish Card --}}
                <div class="card border-0 shadow-sm mb-3 mb-lg-4 sticky-lg-top" style="top: 20px; z-index: 100;">
                    <div class="card-header bg-white border-bottom py-3">
                        <h6 class="fw-semibold mb-0">
                            <i class="fas fa-paper-plane me-2 text-primary"></i>Publikasi
                        </h6>
                    </div>
                    <div class="card-body">
                        {{-- Status Toggle dengan Visual Feedback --}}
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <span class="fw-semibold d-block">Status Halaman</span>
                                <small class="text-muted" id="statusText">
                                    {{ $page->status === 'published' ? 'Published (dapat dilihat publik)' : 'Draft (hanya admin)' }}
                                </small>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="status"
                                       id="statusToggle" role="switch"
                                       {{ $page->status === 'published' ? 'checked' : '' }}
                                       onchange="updateStatusText(this)">
                            </div>
                        </div>

                        {{-- Schedule Publish (Fitur tambahan) --}}
                        <div class="mb-3">
                            <button class="btn btn-link p-0 text-decoration-none" type="button" 
                                    data-bs-toggle="collapse" data-bs-target="#scheduleCollapse">
                                <i class="fas fa-calendar-alt me-1"></i> Jadwalkan Publikasi
                                <i class="fas fa-chevron-down ms-1 small"></i>
                            </button>
                            <div class="collapse mt-2" id="scheduleCollapse">
                                <input type="datetime-local" name="scheduled_at" class="form-control form-control-sm"
                                       value="{{ old('scheduled_at', $page->scheduled_at) }}">
                                <small class="text-muted d-block mt-1">
                                    Kosongkan jika ingin publikasi langsung
                                </small>
                            </div>
                        </div>

                        {{-- Quick Actions --}}
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary py-3 d-none d-lg-block">
                                <i class="fas fa-save me-2"></i> Update Halaman
                            </button>
                            <button type="button" class="btn btn-outline-primary" onclick="previewPage()">
                                <i class="fas fa-eye me-2"></i> Preview Live
                            </button>
                            <button type="button" class="btn btn-outline-secondary" onclick="window.history.back()">
                                <i class="fas fa-times me-2"></i> Batal
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Featured Image dengan Gallery Preview --}}
                <div class="card border-0 shadow-sm mb-3 mb-lg-4">
                    <div class="card-header bg-white border-bottom py-3">
                        <h6 class="fw-semibold mb-0">
                            <i class="fas fa-image me-2 text-primary"></i>Gambar Unggulan
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="featured-image-container">
                            @if($page->featured_image)
                            <div id="imagePreviewBox" class="mb-3 position-relative">
                                <img id="imagePreview" src="{{ asset('storage/'.$page->featured_image) }}"
                                     class="img-fluid rounded w-100" style="max-height:200px; object-fit:cover;">
                                <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-2 rounded-circle" 
                                        id="removeImage" data-bs-toggle="tooltip" title="Hapus gambar">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            @else
                            <div id="imagePreviewBox" class="mb-3 d-none position-relative">
                                <img id="imagePreview" src="#" class="img-fluid rounded w-100" 
                                     style="max-height:200px; object-fit:cover;">
                                <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-2 rounded-circle" 
                                        id="removeImage">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            @endif

                            {{-- Dropzone Area --}}
                            <div id="imageDropzone" 
                                 class="{{ $page->featured_image ? 'd-none' : '' }} dropzone-area rounded text-center p-4 mb-3">
                                <div class="dropzone-inner">
                                    <i class="fas fa-cloud-upload-alt fa-3x text-primary mb-3"></i>
                                    <p class="fw-semibold mb-1">Drag & drop gambar di sini</p>
                                    <p class="text-muted small mb-2">atau</p>
                                    <button type="button" class="btn btn-outline-primary btn-sm" 
                                            onclick="document.getElementById('featuredImage').click()">
                                        <i class="fas fa-folder-open me-1"></i> Pilih File
                                    </button>
                                    <p class="text-muted small mt-2 mb-0">PNG, JPG, GIF max 2MB</p>
                                </div>
                            </div>

                            <input type="file" name="featured_image" id="featuredImage" accept="image/*" class="d-none">

                            {{-- Image Recommendations --}}
                            <div class="bg-light rounded p-3">
                                <small class="text-muted d-block">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Rekomendasi ukuran: 1200 x 630 pixel untuk tampilan optimal
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SEO Meta Section (Fitur tambahan) --}}
                <div class="card border-0 shadow-sm mb-3 mb-lg-4">
                    <div class="card-header bg-white border-bottom py-3">
                        <h6 class="fw-semibold mb-0">
                            <i class="fas fa-chart-line me-2 text-primary"></i>SEO Settings
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Meta Title</label>
                            <input type="text" name="meta_title" class="form-control form-control-sm" 
                                   value="{{ old('meta_title', $page->meta_title ?? $page->title) }}"
                                   maxlength="60">
                            <small class="text-muted">Optimal 50-60 karakter</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Meta Description</label>
                            <textarea name="meta_description" class="form-control form-control-sm" 
                                      rows="3" maxlength="160">{{ old('meta_description', $page->meta_description) }}</textarea>
                            <small class="text-muted">Optimal 150-160 karakter</small>
                        </div>
                    </div>
                </div>

                {{-- Tips Panduan Interaktif --}}
                <div class="card border-0 shadow-sm bg-light">
                    <div class="card-body">
                        <h6 class="fw-semibold mb-3">
                            <i class="fas fa-lightbulb me-2 text-warning"></i>Panduan Cepat
                        </h6>
                        <div class="accordion" id="guideAccordion">
                            <div class="accordion-item border-0 bg-transparent">
                                <h2 class="accordion-header">
                                    <button class="accordion-button bg-transparent shadow-none p-0 py-2" 
                                            type="button" data-bs-toggle="collapse" data-bs-target="#editorGuide">
                                        <i class="fas fa-edit me-2 text-primary small"></i>
                                        Editor Konten
                                    </button>
                                </h2>
                                <div id="editorGuide" class="accordion-collapse collapse show" 
                                     data-bs-parent="#guideAccordion">
                                    <div class="accordion-body px-0 pt-0 pb-2">
                                        <ul class="small text-muted mb-0 ps-3">
                                            <li>Gunakan Heading untuk struktur konten</li>
                                            <li>Klik kanan tabel untuk merge cell</li>
                                            <li>Drag & drop gambar langsung ke editor</li>
                                            <li>Gunakan shortcut Ctrl+S untuk menyimpan</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border-0 bg-transparent">
                                <h2 class="accordion-header">
                                    <button class="accordion-button bg-transparent shadow-none p-0 py-2 collapsed" 
                                            type="button" data-bs-toggle="collapse" data-bs-target="#seoGuide">
                                        <i class="fas fa-chart-line me-2 text-primary small"></i>
                                        SEO Optimization
                                    </button>
                                </h2>
                                <div id="seoGuide" class="accordion-collapse collapse" 
                                     data-bs-parent="#guideAccordion">
                                    <div class="accordion-body px-0 pt-0 pb-2">
                                        <ul class="small text-muted mb-0 ps-3">
                                            <li>Isi meta title yang menarik</li>
                                            <li>Deskripsi mengandung kata kunci</li>
                                            <li>Gunakan gambar dengan alt text</li>
                                            <li>Struktur heading yang rapi (H1, H2, H3)</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

{{-- Modal Konfirmasi Hapus --}}
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus halaman <strong>{{ $page->title }}</strong>?</p>
                <p class="text-danger small mb-0"><i class="fas fa-exclamation-triangle me-1"></i> Tindakan ini tidak dapat dibatalkan!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form action="{{ route('admin.pages.destroy', $page) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Custom Animations */
    .transition-all {
        transition: all 0.3s ease;
    }
    
    .hover-shadow:hover {
        box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.08) !important;
        transform: translateY(-2px);
    }
    
    /* Dropzone Styling */
    .dropzone-area {
        border: 2px dashed #dee2e6;
        background: #f8f9fa;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .dropzone-area:hover {
        border-color: #0d6efd;
        background: #e7f1ff;
    }
    
    .dropzone-area.dragover {
        border-color: #0d6efd;
        background: #e7f1ff;
        transform: scale(1.02);
    }
    
    /* Mobile Optimizations */
    @media (max-width: 768px) {
        .sticky-lg-top {
            position: static !important;
        }
        
        .card {
            margin-bottom: 1rem !important;
        }
        
        .btn-group.w-100 .btn {
            padding: 0.75rem;
        }
        
        .breadcrumb {
            font-size: 0.875rem;
        }
        
        /* Better touch targets */
        .btn, .nav-link, .dropdown-item {
            min-height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }
    }
    
    /* Tablet Optimizations */
    @media (min-width: 768px) and (max-width: 991px) {
        .container-fluid {
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }
    }
    
    /* Loading state */
    .btn-loading {
        position: relative;
        pointer-events: none;
        opacity: 0.65;
    }
    
    .btn-loading:after {
        content: "";
        position: absolute;
        width: 1rem;
        height: 1rem;
        top: calc(50% - 0.5rem);
        right: 0.5rem;
        border: 2px solid transparent;
        border-top-color: currentColor;
        border-radius: 50%;
        animation: button-loading-spinner 0.6s linear infinite;
    }
    
    @keyframes button-loading-spinner {
        from { transform: rotate(0turn); }
        to { transform: rotate(1turn); }
    }
    
    /* Toast notification */
    .toast-notification {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 9999;
        min-width: 250px;
    }
    
    /* Print styles */
    @media print {
        .btn, .sidebar, .card-header {
            display: none !important;
        }
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js"></script>
<script>
// Initialize TinyMCE
tinymce.init({
    selector: '#tiny-editor',
    height: window.innerWidth < 768 ? 400 : 550,
    menubar: true,
    plugins: [
        'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
        'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
        'insertdatetime', 'media', 'table', 'help', 'wordcount',
        'emoticons', 'codesample', 'pagebreak', 'quickbars'
    ],
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | align numlist bullist | link image media table | removeformat | fullscreen code',
    quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quicktable',
    quickbars_insert_toolbar: 'quickimage quicktable',
    contextmenu: 'link image table',
    
    // Mobile optimization
    mobile: {
        menubar: false,
        toolbar: 'undo redo | bold italic | align bullist numlist | link image'
    },
    
    // Table settings
    table_toolbar: 'tableprops tabledelete | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol',
    table_appearance_options: true,
    table_default_attributes: {
        border: '1',
        cellspacing: '0',
        cellpadding: '8'
    },
    table_default_styles: {
        'border-collapse': 'collapse',
        'width': '100%'
    },
    
    // Image upload
    images_upload_url: '{{ route("admin.pages.upload-image") }}',
    automatic_uploads: true,
    images_reuse_filename: true,
    
    // Setup
    setup: function(editor) {
        editor.on('Change', function() {
            updatePreview();
        });
        
        // Keyboard shortcuts
        editor.addShortcut('Ctrl+S', 'Save', function() {
            saveForm();
        });
    }
});

// Form progress tracking
function updateFormProgress() {
    let progress = 0;
    const title = document.getElementById('pageTitle').value;
    const content = tinymce.get('tiny-editor')?.getContent() || '';
    const featuredImage = document.getElementById('featuredImage').files.length > 0 || 
                         document.getElementById('imagePreview').src !== '#';
    
    if (title) progress += 40;
    if (content && content.length > 50) progress += 40;
    if (featuredImage) progress += 20;
    
    document.getElementById('formProgress').style.width = progress + '%';
    document.getElementById('progressPercentage').textContent = progress + '%';
}

// Title counter
document.getElementById('pageTitle').addEventListener('input', function() {
    const length = this.value.length;
    document.getElementById('titleCounter').textContent = length + '/100';
    updateFormProgress();
    
    // Auto generate slug
    const slug = this.value.toLowerCase()
        .replace(/[^a-z0-9\s-]/g, '')
        .trim()
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-');
    document.getElementById('slugPreview').value = slug;
});

// Copy slug
function copySlug() {
    const slugInput = document.getElementById('slugPreview');
    slugInput.select();
    slugInput.setSelectionRange(0, 99999);
    document.execCommand('copy');
    
    showToast('Slug berhasil dicopy!', 'success');
}

// Update preview
function updatePreview() {
    const content = tinymce.get('tiny-editor')?.getContent() || '';
    document.getElementById('content-preview').innerHTML = content;
}

// Status toggle
function updateStatusText(checkbox) {
    const statusText = document.getElementById('statusText');
    if (checkbox.checked) {
        statusText.textContent = 'Published (dapat dilihat publik)';
        showToast('Halaman akan dipublikasikan', 'info');
    } else {
        statusText.textContent = 'Draft (hanya admin)';
        showToast('Halaman disimpan sebagai draft', 'info');
    }
}

// Save as draft
function saveAsDraft() {
    document.getElementById('statusToggle').checked = false;
    updateStatusText(document.getElementById('statusToggle'));
    document.getElementById('pageForm').submit();
}

// Delete page
function deletePage() {
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}

// Preview page
function previewPage() {
    const slug = document.getElementById('slugPreview').value;
    window.open('/' + slug, '_blank');
}

// Featured image handling
document.getElementById('featuredImage').addEventListener('change', function(e) {
    handleImageSelect(this);
});

function handleImageSelect(input) {
    const file = input.files[0];
    if (file) {
        if (file.size > 2 * 1024 * 1024) {
            showToast('Ukuran file maksimal 2MB!', 'error');
            input.value = '';
            return;
        }
        
        if (!file.type.startsWith('image/')) {
            showToast('File harus berupa gambar!', 'error');
            input.value = '';
            return;
        }
        
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('imagePreview').src = e.target.result;
            document.getElementById('imagePreviewBox').classList.remove('d-none');
            document.getElementById('imageDropzone').classList.add('d-none');
            updateFormProgress();
            showToast('Gambar berhasil diupload!', 'success');
        };
        reader.readAsDataURL(file);
    }
}

// Remove image
document.getElementById('removeImage').addEventListener('click', function() {
    document.getElementById('featuredImage').value = '';
    document.getElementById('imagePreviewBox').classList.add('d-none');
    document.getElementById('imageDropzone').classList.remove('d-none');
    updateFormProgress();
    showToast('Gambar dihapus', 'info');
});

// Drag & drop
const dropzone = document.getElementById('imageDropzone');
if (dropzone) {
    dropzone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropzone.classList.add('dragover');
    });
    
    dropzone.addEventListener('dragleave', () => {
        dropzone.classList.remove('dragover');
    });
    
    dropzone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropzone.classList.remove('dragover');
        
        const file = e.dataTransfer.files[0];
        if (file && file.type.startsWith('image/')) {
            document.getElementById('featuredImage').files = e.dataTransfer.files;
            handleImageSelect(document.getElementById('featuredImage'));
        } else {
            showToast('File harus berupa gambar!', 'error');
        }
    });
}

// Save form with loading state
function saveForm() {
    const form = document.getElementById('pageForm');
    const submitBtn = form.querySelector('button[type="submit"]');
    
    submitBtn.classList.add('btn-loading');
    form.submit();
}

// Toast notification
function showToast(message, type = 'info') {
    const toast = document.createElement('div');
    toast.className = `toast-notification alert alert-${type} alert-dismissible fade show`;
    toast.role = 'alert';
    toast.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.remove();
    }, 3000);
}

// Auto-save every 30 seconds
let autoSaveTimer;
document.addEventListener('DOMContentLoaded', function() {
    autoSaveTimer = setInterval(function() {
        if (tinymce.get('tiny-editor')?.getContent()) {
            localStorage.setItem('page-draft-' + {{ $page->id }}, 
                JSON.stringify({
                    title: document.getElementById('pageTitle').value,
                    content: tinymce.get('tiny-editor').getContent(),
                    timestamp: new Date().toISOString()
                })
            );
            showToast('Draft otomatis tersimpan', 'info');
        }
    }, 30000);
});

// Clean up on unload
window.addEventListener('beforeunload', function() {
    clearInterval(autoSaveTimer);
});

// Initialize tooltips
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
});

// Form submit handler
document.getElementById('pageForm').addEventListener('submit', function(e) {
    const title = document.getElementById('pageTitle').value;
    if (!title.trim()) {
        e.preventDefault();
        showToast('Judul halaman harus diisi!', 'error');
        document.getElementById('pageTitle').focus();
    }
});

// Responsive iframe handling
window.addEventListener('resize', function() {
    if (window.innerWidth < 768 && tinymce.get('tiny-editor')) {
        tinymce.get('tiny-editor').settings.height = 400;
    }
});

// Initialize progress
updateFormProgress();
</script>
@endpush
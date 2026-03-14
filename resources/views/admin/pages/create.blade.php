@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold mb-0">Tambah Halaman</h1>
            <p class="text-muted small mb-0">Buat halaman baru untuk website</p>
        </div>
        <a href="{{ route('admin.pages.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <form action="{{ route('admin.pages.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-4">

            {{-- Konten Utama --}}
            <div class="col-lg-8">

                {{-- Judul --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Judul Halaman <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="pageTitle"
                                   class="form-control form-control-lg @error('title') is-invalid @enderror"
                                   value="{{ old('title') }}" placeholder="Masukkan judul halaman..." required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label class="form-label fw-semibold small text-muted">URL Slug</label>
                            <div class="input-group">
                                <span class="input-group-text text-muted small">/</span>
                                <input type="text" id="slugPreview" class="form-control form-control-sm text-muted"
                                       readonly placeholder="otomatis dari judul">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Editor Konten --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom py-3">
                        <h6 class="fw-semibold mb-0">
                            <i class="fas fa-edit me-2 text-primary"></i>Isi Konten
                        </h6>
                    </div>
                    <div class="card-body p-0">
                        <textarea id="editor" name="content">{{ old('content') }}</textarea>
                    </div>
                </div>

                {{-- SEO Meta --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom py-3">
                        <h6 class="fw-semibold mb-0">
                            <i class="fas fa-search me-2 text-primary"></i>SEO & Meta
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">Meta Title</label>
                            <input type="text" name="meta_title"
                                   class="form-control @error('meta_title') is-invalid @enderror"
                                   value="{{ old('meta_title') }}" placeholder="Judul untuk mesin pencari...">
                            @error('meta_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label class="form-label fw-semibold small">Meta Description</label>
                            <textarea name="meta_description" rows="3"
                                      class="form-control @error('meta_description') is-invalid @enderror"
                                      placeholder="Deskripsi singkat untuk mesin pencari (maks. 160 karakter)...">{{ old('meta_description') }}</textarea>
                            @error('meta_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

            </div>
            {{-- Tutup col-lg-8 --}}

            {{-- Sidebar --}}
            <div class="col-lg-4">

                {{-- Publish --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom py-3">
                        <h6 class="fw-semibold mb-0">
                            <i class="fas fa-paper-plane me-2 text-primary"></i>Publikasi
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" name="status"
                                   id="statusToggle" {{ old('status') ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="statusToggle">
                                Publish Sekarang
                            </label>
                        </div>
                        <p class="text-muted small mb-3">
                            Jika tidak diaktifkan, halaman akan disimpan sebagai <strong>Draft</strong>.
                        </p>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Simpan Halaman
                            </button>
                            <a href="{{ route('admin.pages.index') }}" class="btn btn-outline-secondary">
                                Batal
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Featured Image --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom py-3">
                        <h6 class="fw-semibold mb-0">
                            <i class="fas fa-image me-2 text-primary"></i>Gambar Unggulan
                        </h6>
                    </div>
                    <div class="card-body">
                        <div id="imagePreviewBox" class="mb-3 d-none">
                            <img id="imagePreview" src="#" alt="Preview"
                                 class="img-fluid rounded" style="max-height:200px; width:100%; object-fit:cover;">
                            <button type="button" class="btn btn-sm btn-outline-danger mt-2 w-100" id="removeImage">
                                <i class="fas fa-times me-1"></i> Hapus Gambar
                            </button>
                        </div>
                        <div id="imageDropzone"
                             class="rounded text-center p-4"
                             style="border: 2px dashed #dee2e6; cursor:pointer; transition: all 0.2s;">
                            <i class="fas fa-image fa-2x text-muted mb-2"></i>
                            <p class="text-muted small mb-1">Klik atau drag & drop gambar</p>
                            <p class="text-muted" style="font-size:0.75rem;">PNG, JPG, max 2MB</p>
                        </div>
                        <input type="file" name="featured_image" id="featuredImage"
                               accept="image/*" class="d-none">
                        <button type="button" class="btn btn-outline-secondary btn-sm w-100 mt-2"
                                onclick="document.getElementById('featuredImage').click()">
                            <i class="fas fa-upload me-1"></i> Pilih Gambar
                        </button>
                    </div>
                </div>

                {{-- Tips Panduan --}}
                <div class="card border-0 shadow-sm bg-light">
                    <div class="card-body">
                        <h6 class="fw-semibold mb-3">
                            <i class="fas fa-lightbulb me-2 text-warning"></i>Tips Editor
                        </h6>
                        <ul class="small text-muted mb-0 ps-3">
                            <li class="mb-1">Gunakan <strong>Heading</strong> untuk struktur konten (H1–H4)</li>
                            <li class="mb-1">Klik ikon <strong>Table</strong> untuk menyisipkan & mengatur tabel</li>
                            <li class="mb-1">Klik kanan tabel untuk opsi <strong>merge cell, align, warna</strong></li>
                            <li class="mb-1">Gunakan tombol <strong>Source Code</strong> untuk edit HTML langsung</li>
                            <li>Gambar bisa di-<strong>drag & drop</strong> langsung ke editor</li>
                        </ul>
                    </div>
                </div>

            </div>
            {{-- Tutup col-lg-4 --}}

        </div>
        {{-- Tutup row --}}

    </form>
</div>
@endsection

@push('scripts')
{{-- TinyMCE 6 via CDN --}}
<script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
tinymce.init({
    selector: '#editor',
    height: 550,
    menubar: true,

    // ===== PLUGINS LENGKAP =====
    plugins: [
        'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
        'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
        'insertdatetime', 'media', 'table', 'help', 'wordcount',
        'emoticons', 'codesample', 'pagebreak'
    ],

    // ===== TOOLBAR LENGKAP (3 baris) =====
    toolbar_mode: 'wrap',
    toolbar: [
        // Baris 1 - Heading & Format Teks
        'undo redo | blocks fontsize | bold italic underline strikethrough | forecolor backcolor | removeformat',
        // Baris 2 - Alignment, List, Link, Table
        'alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media table | charmap emoticons',
        // Baris 3 - Tools
        'anchor codesample pagebreak | visualblocks searchreplace | preview fullscreen | code help'
    ].join(' | '),

    // ===== BLOCKS / HEADING FORMAT =====
    // Opsi yang muncul di dropdown "Blocks"
    block_formats: 'Paragraph=p; Heading 1=h1; Heading 2=h2; Heading 3=h3; Heading 4=h4; Preformatted=pre',

    // ===== FONT SIZE OPTIONS =====
    fontsize_formats: '10px 12px 14px 16px 18px 20px 24px 28px 32px 36px 48px',

    // ===== TABLE SETTINGS =====
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
    table_resize_bars: true,
    table_column_resizing: 'resizetable',

    // ===== IMAGE SETTINGS =====
    image_advtab: true,
    image_caption: true,
    images_upload_url: '{{ route("admin.pages.upload-image") }}',
    automatic_uploads: true,
    images_reuse_filename: true,
    images_upload_handler: function (blobInfo) {
        return new Promise((resolve, reject) => {
            let formData = new FormData();
            formData.append('upload', blobInfo.blob(), blobInfo.filename());

            fetch('{{ route("admin.pages.upload-image") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.location) resolve(data.location);
                else if (data.url) resolve(data.url);
                else reject('Tidak ada URL yang ditemukan');
            })
            .catch(err => {
                console.error('Upload error:', err);
                reject('Upload gambar gagal');
            });
        });
    },

    // ===== LINK SETTINGS =====
    link_default_target: '_blank',
    link_title: true,
    link_assume_external_targets: true,

    // ===== CONTENT STYLE (tampilan dalam editor) =====
    content_style: `
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            font-size: 14px;
            line-height: 1.7;
            color: #333;
            padding: 16px;
            max-width: 100%;
        }
        h1 { font-size: 2em; font-weight: 700; margin: 0.8em 0 0.4em; color: #0f172a; }
        h2 { font-size: 1.6em; font-weight: 600; margin: 0.8em 0 0.4em; color: #1e293b; }
        h3 { font-size: 1.3em; font-weight: 600; margin: 0.7em 0 0.3em; color: #334155; }
        h4 { font-size: 1.1em; font-weight: 600; margin: 0.6em 0 0.3em; color: #475569; }
        p  { margin: 0 0 1em; }

        /* Tabel */
        table {
            border-collapse: collapse;
            width: 100%;
            margin: 1em 0;
        }
        table th, table td {
            border: 1px solid #cbd5e1 !important;
            padding: 10px 14px;
            text-align: left;
        }
        table th {
            background-color: #1e40af;
            color: white;
            font-weight: 600;
        }
        table tr:nth-child(even) td {
            background-color: #f1f5f9;
        }
        table tr:hover td {
            background-color: #dbeafe;
        }

        /* Blockquote */
        blockquote {
            border-left: 4px solid #2563eb;
            margin: 1em 0;
            padding: 0.5em 1em;
            background: #eff6ff;
            color: #1e40af;
            border-radius: 0 0.5em 0.5em 0;
        }

        /* Code */
        code {
            background: #f1f5f9;
            padding: 2px 6px;
            border-radius: 4px;
            font-family: 'Courier New', monospace;
            font-size: 0.9em;
            color: #e11d48;
        }
        pre {
            background: #1e293b;
            color: #e2e8f0;
            padding: 1em;
            border-radius: 8px;
            overflow-x: auto;
        }

        /* List */
        ul, ol { padding-left: 1.5em; margin: 0 0 1em; }
        li { margin-bottom: 0.3em; }

        /* Image */
        img { max-width: 100%; height: auto; border-radius: 4px; }
        figure { margin: 1em 0; text-align: center; }
        figcaption { font-size: 0.85em; color: #64748b; margin-top: 0.4em; }
    `,

    // ===== MISC =====
    resize: true,
    branding: false,
    promotion: false,
    paste_data_images: true,
    extended_valid_elements: 'span[*]',
    language_url: '/tinymce/langs/id.js', // opsional, jika ada file bahasa Indonesia
    // language: 'id',                    // aktifkan jika file bahasa sudah ada
});

// ===== AUTO SLUG =====
document.getElementById('pageTitle').addEventListener('input', function() {
    const slug = this.value.toLowerCase()
        .replace(/[^a-z0-9\s-]/g, '')
        .trim()
        .replace(/\s+/g, '-');
    document.getElementById('slugPreview').value = slug;
});

// ===== FEATURED IMAGE PREVIEW =====
document.getElementById('featuredImage').addEventListener('change', function() {
    const file = this.files[0];
    if (file) {
        if (file.size > 2 * 1024 * 1024) {
            alert('Ukuran file maksimal 2MB!');
            this.value = '';
            return;
        }
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('imagePreview').src = e.target.result;
            document.getElementById('imagePreviewBox').classList.remove('d-none');
            document.getElementById('imageDropzone').classList.add('d-none');
        };
        reader.readAsDataURL(file);
    }
});

// ===== REMOVE IMAGE =====
document.getElementById('removeImage').addEventListener('click', function() {
    document.getElementById('featuredImage').value = '';
    document.getElementById('imagePreviewBox').classList.add('d-none');
    document.getElementById('imageDropzone').classList.remove('d-none');
});

// ===== DRAG & DROP IMAGE =====
const dropzone = document.getElementById('imageDropzone');
dropzone.addEventListener('click', () => document.getElementById('featuredImage').click());
dropzone.addEventListener('dragover', e => {
    e.preventDefault();
    dropzone.style.borderColor = '#2563eb';
    dropzone.style.background = '#eff6ff';
});
dropzone.addEventListener('dragleave', () => {
    dropzone.style.borderColor = '#dee2e6';
    dropzone.style.background = '';
});
dropzone.addEventListener('drop', e => {
    e.preventDefault();
    dropzone.style.borderColor = '#dee2e6';
    dropzone.style.background = '';
    const file = e.dataTransfer.files[0];
    if (file && file.type.startsWith('image/')) {
        const dt = new DataTransfer();
        dt.items.add(file);
        document.getElementById('featuredImage').files = dt.files;
        document.getElementById('featuredImage').dispatchEvent(new Event('change'));
    }
});
</script>
@endpush
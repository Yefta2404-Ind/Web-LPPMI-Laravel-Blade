@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold mb-0">Edit Halaman</h1>
            <p class="text-muted small mb-0">{{ $page->title }}</p>
        </div>
        <a href="{{ route('admin.pages.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <form action="{{ route('admin.pages.update', $page) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
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
                                   value="{{ old('title', $page->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label class="form-label fw-semibold small text-muted">URL Slug</label>
                            <div class="input-group">
                                <span class="input-group-text text-muted small">/</span>
                                <input type="text" id="slugPreview" class="form-control form-control-sm text-muted"
                                       value="{{ $page->slug }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Editor Konten --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom py-3">
                        <h6 class="fw-semibold mb-0">Isi Konten</h6>
                    </div>
                    <div class="card-body">
                        <textarea id="editor" name="content">{!! old('content', $page->content) !!}</textarea>
                    </div>
                </div>

            </div>
            {{-- Tutup col-lg-8 --}}

            {{-- Sidebar --}}
            <div class="col-lg-4">

                {{-- Publish --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom py-3">
                        <h6 class="fw-semibold mb-0">Publikasi</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" name="status"
                                   id="statusToggle" {{ $page->status === 'published' ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="statusToggle">Published</label>
                        </div>
                        <p class="text-muted small mb-3">
                            Jika tidak diaktifkan, halaman akan disimpan sebagai <strong>Draft</strong>.
                        </p>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Update Halaman
                            </button>
                            <a href="{{ url('/' . $page->slug) }}" target="_blank"
                               class="btn btn-outline-secondary">
                                <i class="fas fa-eye me-1"></i> Preview
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Featured Image --}}
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom py-3">
                        <h6 class="fw-semibold mb-0">Gambar Unggulan</h6>
                    </div>
                    <div class="card-body">
                        @if($page->featured_image)
                        <div id="imagePreviewBox" class="mb-3">
                            <img id="imagePreview" src="{{ asset('storage/'.$page->featured_image) }}"
                                 class="img-fluid rounded" style="max-height:200px; width:100%; object-fit:cover;">
                        </div>
                        @else
                        <div id="imagePreviewBox" class="mb-3 d-none">
                            <img id="imagePreview" src="#" class="img-fluid rounded"
                                 style="max-height:200px; width:100%; object-fit:cover;">
                        </div>
                        @endif

                        <div id="imageDropzone"
                             class="{{ $page->featured_image ? 'd-none' : '' }} rounded text-center p-4"
                             style="border: 2px dashed #dee2e6; cursor:pointer;">
                            <i class="fas fa-image fa-2x text-muted mb-2"></i>
                            <p class="text-muted small mb-0">Klik atau drag gambar</p>
                        </div>
                        <input type="file" name="featured_image" id="featuredImage" accept="image/*" class="d-none">
                        <button type="button" class="btn btn-outline-secondary btn-sm w-100 mt-2"
                                onclick="document.getElementById('featuredImage').click()">
                            <i class="fas fa-upload me-1"></i> Ganti Gambar
                        </button>
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
<script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
tinymce.init({
    selector: '#editor',
    height: 450,
    menubar: true,
    plugins: 'lists link table code image media',
    toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image table | code',
    images_upload_url: '{{ route("admin.pages.upload-image") }}',
    automatic_uploads: true,
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
        .then(response => {
            console.log('Status:', response.status); // debug
            return response.json();
        })
        .then(data => {
            console.log('Response:', data); // debug
            if (data.location) {
                resolve(data.location);
            } else if (data.url) {
                resolve(data.url);
            } else {
                reject('Tidak ada URL');
            }
        })
        .catch(err => {
            console.log('Error:', err); // debug
            reject('Upload gagal');
        });
    });
},
    table_default_attributes: { border: '1' },
    table_default_styles: {
        'border-collapse': 'collapse',
        'width': '100%'
    },
    content_style: `
        body { font-family: Arial, sans-serif; font-size: 14px; line-height: 1.6; }
        table { border-collapse: collapse; width: 100%; margin: 10px 0; }
        table th, table td { border: 1px solid #dee2e6 !important; padding: 8px 12px; }
        table th { background-color: #0a2a44; color: white; font-weight: 600; }
        table tr:nth-child(even) td { background-color: #f8f9fa; }
    `
});

// Auto slug dari judul
document.getElementById('pageTitle').addEventListener('input', function() {
    const slug = this.value.toLowerCase()
        .replace(/[^a-z0-9\s-]/g, '')
        .trim()
        .replace(/\s+/g, '-');
    document.getElementById('slugPreview').value = slug;
});

// Featured image preview
document.getElementById('featuredImage').addEventListener('change', function() {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('imagePreview').src = e.target.result;
            document.getElementById('imagePreviewBox').classList.remove('d-none');
            document.getElementById('imageDropzone').classList.add('d-none');
        };
        reader.readAsDataURL(file);
    }
});

// Drag & drop image
const dropzone = document.getElementById('imageDropzone');
dropzone.addEventListener('click', () => document.getElementById('featuredImage').click());
dropzone.addEventListener('dragover', e => { e.preventDefault(); dropzone.style.borderColor = '#0d6efd'; });
dropzone.addEventListener('dragleave', () => { dropzone.style.borderColor = '#dee2e6'; });
dropzone.addEventListener('drop', e => {
    e.preventDefault();
    dropzone.style.borderColor = '#dee2e6';
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
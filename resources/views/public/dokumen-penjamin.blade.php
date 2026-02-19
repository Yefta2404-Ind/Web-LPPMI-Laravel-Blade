@extends('layouts.public')

@section('title', 'Dokumen SPMI')

@section('content')
<div class="dokumen-spmi">
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1 class="header-title">Dokumen SPMI</h1>
            <p class="header-desc">Dokumen Sistem Penjaminan Mutu Internal Universitas Gunungkidul</p>
        </div>

        <!-- Daftar Kategori -->
        <div class="kategori-list">
            @foreach($categories as $index => $category)
            <div class="kategori-item">
                <!-- Header Kategori -->
                <div class="kategori-head" onclick="toggleKategori({{ $index }})">
                    <div class="kategori-head-left">
                        <span class="kategori-icon">
                            <i class="fas {{ $index % 3 == 0 ? 'fa-folder' : ($index % 3 == 1 ? 'fa-folder-open' : 'fa-folder-plus') }}"></i>
                        </span>
                        <div>
                            <div class="kategori-nama">{{ $category->name }}</div>
                            <span class="kategori-count">{{ $category->documents->count() }} dokumen</span>
                        </div>
                    </div>
                    <span class="kategori-toggle" id="toggle-{{ $index }}">
                        <i class="fas fa-chevron-down"></i>
                    </span>
                </div>

                <!-- Daftar Dokumen -->
                <div class="kategori-docs" id="kategori-{{ $index }}">
                    @forelse($category->documents as $doc)
                    <div class="doc-item">
                        <div class="doc-icon">
                            @if($doc->file_path)
                                <i class="fas fa-file-pdf"></i>
                            @elseif($doc->external_link)
                                <i class="fas fa-link"></i>
                            @else
                                <i class="fas fa-file"></i>
                            @endif
                        </div>
                        
                        <div class="doc-content">
                            <div class="doc-title">{{ $doc->title }}</div>
                            @if($doc->description)
                            <div class="doc-desc">{{ $doc->description }}</div>
                            @endif
                            <div class="doc-meta">
                                <i class="far fa-calendar-alt"></i>
                                {{ $doc->created_at ? $doc->created_at->format('d/m/Y') : '-' }}
                            </div>
                        </div>

                        <div class="doc-actions">
                            @if($doc->file_path)
                            <a href="{{ asset('storage/'.$doc->file_path) }}" class="btn btn-primary" download>
                                <i class="fas fa-download"></i> Unduh
                            </a>
                            @endif

                            @if($doc->external_link)
                            <a href="{{ $doc->external_link }}" target="_blank" class="btn btn-secondary">
                                <i class="fas fa-external-link-alt"></i> Buka
                            </a>
                            @endif
                        </div>
                    </div>
                    @empty
                    <div class="empty-state">
                        <p>Belum ada dokumen</p>
                    </div>
                    @endforelse
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<style>
/* ===== RESET ===== */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.dokumen-spmi {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    background: #fff;
    color: #1e293b;
    padding: 1.5rem 1rem;
}

.container {
    max-width: 1000px;
    margin: 0 auto;
}

/* ===== HEADER ===== */
.header {
    margin-bottom: 1.5rem;
}

.header-title {
    font-size: 1.8rem;
    font-weight: 600;
    color: #0f172a;
    margin-bottom: 0.25rem;
}

.header-desc {
    font-size: 0.95rem;
    color: #475569;
}

/* ===== KATEGORI LIST ===== */
.kategori-list {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

/* ===== KATEGORI ITEM ===== */
.kategori-item {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    overflow: hidden;
}

/* Kategori Head */
.kategori-head {
    padding: 0.9rem 1.2rem;
    background: #fff;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 1px solid transparent;
}

.kategori-head:hover {
    background: #f8fafc;
}

.kategori-head-left {
    display: flex;
    align-items: center;
    gap: 0.8rem;
}

.kategori-icon {
    width: 2.2rem;
    height: 2.2rem;
    background: #eef2f6;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    color: #0f2b4b;
}

.kategori-nama {
    font-weight: 600;
    font-size: 1rem;
    color: #0f172a;
    margin-bottom: 0.15rem;
}

.kategori-count {
    font-size: 0.8rem;
    color: #64748b;
}

.kategori-toggle {
    width: 1.8rem;
    height: 1.8rem;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #64748b;
    font-size: 0.9rem;
    transition: transform 0.2s;
}

/* Kategori Docs */
.kategori-docs {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease;
    background: #f8fafc;
}

.kategori-docs.active {
    max-height: 2000px;
}

/* ===== DOC ITEM ===== */
.doc-item {
    padding: 0.9rem 1.2rem;
    border-bottom: 1px solid #e2e8f0;
    display: flex;
    align-items: center;
    gap: 0.8rem;
    background: #fff;
    margin: 0.5rem;
    border-radius: 6px;
}

.doc-item:last-child {
    border-bottom: none;
    margin-bottom: 0.5rem;
}

.doc-icon {
    width: 2rem;
    height: 2rem;
    background: #f1f5f9;
    border-radius: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.95rem;
    color: #0f2b4b;
    flex-shrink: 0;
}

.doc-content {
    flex: 1;
    min-width: 0;
}

.doc-title {
    font-weight: 600;
    font-size: 0.95rem;
    color: #0f172a;
    margin-bottom: 0.2rem;
}

.doc-desc {
    font-size: 0.85rem;
    color: #475569;
    margin-bottom: 0.3rem;
    line-height: 1.4;
}

.doc-meta {
    font-size: 0.75rem;
    color: #64748b;
    display: flex;
    align-items: center;
    gap: 0.3rem;
}

.doc-actions {
    display: flex;
    gap: 0.5rem;
    flex-shrink: 0;
}

/* ===== BUTTONS ===== */
.btn {
    display: inline-flex;
    align-items: center;
    gap: 0.3rem;
    padding: 0.35rem 0.8rem;
    font-size: 0.8rem;
    text-decoration: none;
    border-radius: 4px;
    border: 1px solid transparent;
    cursor: pointer;
    white-space: nowrap;
}

.btn-primary {
    background: #0f2b4b;
    color: white;
}

.btn-primary:hover {
    background: #1e3a5f;
}

.btn-secondary {
    background: #fff;
    color: #0f172a;
    border-color: #cbd5e1;
}

.btn-secondary:hover {
    background: #f8fafc;
}

/* ===== EMPTY STATE ===== */
.empty-state {
    text-align: center;
    padding: 1.5rem;
    color: #64748b;
    font-size: 0.9rem;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 640px) {
    .dokumen-spmi {
        padding: 1rem 0.75rem;
    }
    
    .header-title {
        font-size: 1.5rem;
    }
    
    .kategori-head {
        padding: 0.75rem 1rem;
    }
    
    .doc-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.6rem;
        padding: 0.75rem 1rem;
    }
    
    .doc-actions {
        width: 100%;
        flex-direction: column;
        gap: 0.4rem;
    }
    
    .btn {
        width: 100%;
        justify-content: center;
        padding: 0.5rem;
    }
}

@media (max-width: 480px) {
    .kategori-head-left {
        gap: 0.6rem;
    }
    
    .kategori-icon {
        width: 2rem;
        height: 2rem;
        font-size: 0.9rem;
    }
    
    .kategori-nama {
        font-size: 0.95rem;
    }
}
</style>

<script>
function toggleKategori(index) {
    const container = document.getElementById('kategori-' + index);
    const toggle = document.getElementById('toggle-' + index);
    const chevron = toggle.querySelector('i');
    
    // Tutup yang lain
    document.querySelectorAll('[id^="kategori-"]').forEach((el, i) => {
        if (i !== index && el.classList.contains('active')) {
            el.classList.remove('active');
            document.getElementById('toggle-' + i).querySelector('i').style.transform = 'rotate(0deg)';
        }
    });
    
    // Toggle saat ini
    container.classList.toggle('active');
    chevron.style.transform = container.classList.contains('active') ? 'rotate(180deg)' : 'rotate(0deg)';
}

// Buka kategori pertama
document.addEventListener('DOMContentLoaded', () => {
    if (document.querySelector('.kategori-item')) {
        toggleKategori(0);
    }
});
</script>
@endsection
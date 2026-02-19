@extends('layouts.admin')

@section('title', 'Edit Kategori SPMI')

@section('content')
<div class="kategori-edit">
    <!-- Header -->
    <div class="header">
        <h2>Edit Kategori SPMI</h2>
        <a href="{{ route('admin.spmi_categories.index') }}" class="btn-back">
            ← Kembali
        </a>
    </div>

    <!-- Error Alert -->
    @if ($errors->any())
        <div class="alert error">
            <strong>Terjadi kesalahan:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form -->
    <div class="form-wrapper">
        <form action="{{ route('admin.spmi-categories.update', $spmi_category->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nama Kategori <span class="required">*</span></label>
                <input type="text" 
                       name="name" 
                       id="name"
                       class="form-control @error('name') error @enderror" 
                       value="{{ old('name', $spmi_category->name) }}" 
                       placeholder="Masukkan nama kategori"
                       required
                       autofocus>
                @error('name')
                    <div class="error-text">{{ $message }}</div>
                @enderror
                <small>Nama kategori harus unik dan mudah dipahami</small>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-update">
                    Update
                </button>
                <a href="{{ route('admin.spmi_categories.index') }}" class="btn-batal">
                    Batal
                </a>
            </div>
        </form>
    </div>

    <!-- Info -->
    <div class="info">
        <strong>Informasi:</strong>
        <ul>
            <li>Slug akan dibuat otomatis dari nama kategori</li>
            <li>Perubahan akan mempengaruhi dokumen terkait</li>
        </ul>
    </div>
</div>

<style>
/* Simple CSS */
.kategori-edit {
    max-width: 700px;
    margin: 0 auto;
    padding: 20px;
    font-family: system-ui, -apple-system, sans-serif;
}

/* Header */
.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
}

.header h2 {
    margin: 0;
    font-size: 24px;
    color: #333;
}

/* Button Back */
.btn-back {
    background: #6c757d;
    color: white;
    padding: 8px 16px;
    text-decoration: none;
    border-radius: 4px;
    font-size: 14px;
}

.btn-back:hover {
    background: #5a6268;
}

/* Alert */
.alert {
    padding: 15px;
    border-radius: 4px;
    margin-bottom: 20px;
    border: 1px solid;
}

.alert.error {
    background: #f8d7da;
    border-color: #f5c6cb;
    color: #721c24;
}

.alert ul {
    margin: 10px 0 0 0;
    padding-left: 20px;
}

.alert li {
    margin-bottom: 3px;
}

/* Form Wrapper */
.form-wrapper {
    background: white;
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 20px;
    margin-bottom: 20px;
}

/* Form Group */
.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: #333;
}

.required {
    color: #dc3545;
    font-weight: normal;
}

/* Form Control */
.form-control {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
    box-sizing: border-box;
}

.form-control:focus {
    outline: none;
    border-color: #0056b3;
}

.form-control.error {
    border-color: #dc3545;
}

/* Error Text */
.error-text {
    color: #dc3545;
    font-size: 13px;
    margin-top: 5px;
}

/* Hint Text */
.form-group small {
    display: block;
    color: #666;
    font-size: 12px;
    margin-top: 5px;
}

/* Form Actions */
.form-actions {
    display: flex;
    gap: 10px;
    margin-top: 25px;
}

.btn-update, .btn-batal {
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    font-size: 14px;
    cursor: pointer;
    text-align: center;
    text-decoration: none;
}

.btn-update {
    background: #0056b3;
    color: white;
    flex: 1;
}

.btn-update:hover {
    background: #004494;
}

.btn-batal {
    background: #6c757d;
    color: white;
    min-width: 100px;
    display: inline-block;
}

.btn-batal:hover {
    background: #5a6268;
}

/* Info */
.info {
    background: #f8f9fa;
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 15px;
    font-size: 14px;
}

.info strong {
    display: block;
    margin-bottom: 10px;
    color: #333;
}

.info ul {
    margin: 0;
    padding-left: 20px;
    color: #666;
}

.info li {
    margin-bottom: 5px;
}

/* Mobile */
@media (max-width: 768px) {
    .kategori-edit {
        padding: 15px;
    }

    .header {
        flex-direction: column;
        gap: 10px;
        align-items: stretch;
    }

    .header h2 {
        text-align: center;
        font-size: 22px;
    }

    .btn-back {
        text-align: center;
    }

    .form-actions {
        flex-direction: column;
    }

    .btn-update, .btn-batal {
        width: 100%;
    }
}

@media (max-width: 480px) {
    .header h2 {
        font-size: 20px;
    }

    .form-wrapper {
        padding: 15px;
    }

    .info {
        padding: 12px;
    }
}
</style>
@endsection
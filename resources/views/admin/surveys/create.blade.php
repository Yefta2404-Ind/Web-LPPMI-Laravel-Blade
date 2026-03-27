@extends('layouts.admin')

@section('page-title', 'Buat Survey Baru')

@section('content')
<style>
    .survey-create-wrapper {
        max-width: 680px;
        margin: 0 auto;
        padding: 1rem;
    }

    .survey-create-card {
        background: #ffffff;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 1px 3px rgba(0,0,0,0.08);
        overflow: hidden;
    }

    .survey-create-header {
        padding: 24px 28px 20px;
        border-bottom: 1px solid #f3f4f6;
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .survey-create-header-icon {
        width: 44px;
        height: 44px;
        background: #dbeafe;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #2563eb;
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    .survey-create-header h1 {
        font-size: 1.25rem;
        font-weight: 700;
        color: #111827;
        margin: 0;
    }

    .survey-create-header p {
        font-size: 0.875rem;
        color: #6b7280;
        margin: 2px 0 0;
    }

    .survey-create-body {
        padding: 28px;
    }

    /* Alerts */
    .survey-alert {
        padding: 14px 16px;
        border-radius: 8px;
        margin-bottom: 24px;
        display: flex;
        align-items: flex-start;
        gap: 10px;
        font-size: 0.9rem;
    }

    .survey-alert-error {
        background: #fef2f2;
        border: 1px solid #fecaca;
        color: #dc2626;
    }

    .survey-alert ul {
        margin: 0;
        padding-left: 16px;
    }

    .survey-alert li { margin-bottom: 2px; }

    /* Form */
    .survey-form {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .form-label {
        font-size: 0.875rem;
        font-weight: 600;
        color: #374151;
    }

    .form-label .required {
        color: #ef4444;
        margin-left: 2px;
    }

    .form-control {
        width: 100%;
        padding: 10px 14px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 0.9375rem;
        color: #111827;
        background: #fff;
        transition: border-color 0.15s, box-shadow 0.15s;
        box-sizing: border-box;
        font-family: inherit;
    }

    .form-control:focus {
        outline: none;
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .form-control::placeholder { color: #9ca3af; }

    textarea.form-control {
        resize: vertical;
        min-height: 110px;
    }

    .form-hint {
        font-size: 0.8125rem;
        color: #6b7280;
    }

    /* URL feedback */
    .form-control.url-valid { border-color: #10b981; }
    .form-control.url-valid:focus { box-shadow: 0 0 0 3px rgba(16,185,129,0.1); }

    /* Footer */
    .survey-create-footer {
        padding: 20px 28px;
        background: #f9fafb;
        border-top: 1px solid #f3f4f6;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }

    .btn {
        padding: 9px 20px;
        border-radius: 8px;
        font-size: 0.9rem;
        font-weight: 500;
        cursor: pointer;
        border: 1px solid transparent;
        transition: all 0.15s;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        text-decoration: none;
        font-family: inherit;
    }

    .btn-cancel {
        background: #fff;
        color: #374151;
        border-color: #d1d5db;
    }
    .btn-cancel:hover { background: #f9fafb; border-color: #9ca3af; }

    .btn-submit {
        background: #2563eb;
        color: #fff;
        border-color: #2563eb;
    }
    .btn-submit:hover { background: #1d4ed8; }
    .btn-submit:disabled { opacity: 0.65; cursor: not-allowed; }

    /* Char counter */
    .char-counter {
        font-size: 0.8rem;
        text-align: right;
        color: #6b7280;
        transition: color 0.15s;
    }
    .char-counter.warn { color: #f59e0b; }
    .char-counter.over { color: #ef4444; }
</style>

<div class="survey-create-wrapper">
    <div class="survey-create-card">

        {{-- Header --}}
        <div class="survey-create-header">
            <div class="survey-create-header-icon">
                <i class="fas fa-poll"></i>
            </div>
            <div>
                <h1>Buat Survey Baru</h1>
                <p>Isi form di bawah untuk membuat survey dengan QR code otomatis</p>
            </div>
        </div>

        {{-- Body --}}
        <div class="survey-create-body">

            @if ($errors->any())
                <div class="survey-alert survey-alert-error">
                    <i class="fas fa-exclamation-circle" style="margin-top:2px;flex-shrink:0"></i>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST"
                  action="{{ route('admin.surveys.store') }}"
                  class="survey-form"
                  id="surveyCreateForm">
                @csrf

                {{-- Judul --}}
                <div class="form-group">
                    <label for="surveyTitle" class="form-label">
                        Judul Survey <span class="required">*</span>
                    </label>
                    <input type="text"
                           id="surveyTitle"
                           name="title"
                           value="{{ old('title') }}"
                           class="form-control"
                           placeholder="Contoh: Survey Kepuasan Mahasiswa 2025"
                           maxlength="255"
                           required
                           autofocus>
                    <span class="char-counter" id="titleCounter">0/255</span>
                </div>

                {{-- Deskripsi --}}
                <div class="form-group">
                    <label for="surveyDesc" class="form-label">Deskripsi Survey</label>
                    <textarea id="surveyDesc"
                              name="description"
                              class="form-control"
                              placeholder="Jelaskan tujuan dan detail survey ini (opsional)">{{ old('description') }}</textarea>
                    <span class="form-hint">Opsional. Deskripsi singkat tujuan survey.</span>
                </div>

                {{-- URL --}}
                <div class="form-group">
                    <label for="surveyUrl" class="form-label">
                        Link Google Form <span class="required">*</span>
                    </label>
                    <input type="url"
                           id="surveyUrl"
                           name="survey_url"
                           value="{{ old('survey_url') }}"
                           class="form-control"
                           placeholder="https://forms.gle/..."
                           required>
                    <span class="form-hint">QR code akan dibuat otomatis dari link ini.</span>
                </div>

            </form>
        </div>

        {{-- Footer --}}
        <div class="survey-create-footer">
            <a href="{{ route('admin.surveys.index') }}" class="btn btn-cancel">
                <i class="fas fa-arrow-left"></i> Batal
            </a>
            <button type="submit"
                    form="surveyCreateForm"
                    class="btn btn-submit"
                    id="submitBtn">
                <i class="fas fa-qrcode"></i> Buat Survey & Generate QR
            </button>
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form      = document.getElementById('surveyCreateForm');
    const submitBtn = document.getElementById('submitBtn');
    const titleInput = document.getElementById('surveyTitle');
    const urlInput   = document.getElementById('surveyUrl');
    const counter    = document.getElementById('titleCounter');

    // Char counter
    function updateCounter() {
        const len = titleInput.value.length;
        counter.textContent = len + '/255';
        counter.className = 'char-counter' + (len > 255 ? ' over' : len > 200 ? ' warn' : '');
    }
    titleInput.addEventListener('input', updateCounter);
    updateCounter();

    // Auto-resize textarea
    const textarea = document.getElementById('surveyDesc');
    textarea.addEventListener('input', function () {
        this.style.height = 'auto';
        this.style.height = this.scrollHeight + 'px';
    });

    // URL visual feedback
    urlInput.addEventListener('input', function () {
        const val = this.value;
        const isGoogle = val.includes('forms.gle') || val.includes('docs.google.com/forms');
        this.classList.toggle('url-valid', isGoogle && val.length > 0);
    });

    // Auto https prefix
    urlInput.addEventListener('blur', function () {
        if (this.value && !this.value.startsWith('http')) {
            this.value = 'https://' + this.value;
            this.dispatchEvent(new Event('input'));
        }
    });

    // Loading state on submit
    form.addEventListener('submit', function () {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Membuat...';
    });
});
</script>
@endsection
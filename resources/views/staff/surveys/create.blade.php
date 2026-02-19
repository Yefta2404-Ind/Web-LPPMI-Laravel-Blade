@extends('layouts.cms')
@section('content')
<style>
    /* CSS Khusus untuk Halaman Buat Survey - Prefix staff-survey- untuk menghindari konflik */
    .staff-survey-create-container {
        font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        line-height: 1.6;
        color: #333;
    }

    .staff-survey-wrapper {
        max-width: 48rem;
        margin: 0 auto;
        padding: 1rem;
    }

    .staff-survey-card {
        background-color: #ffffff;
        border-radius: 0.75rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        padding: 1.5rem;
        transition: all 0.3s ease;
    }

    .staff-survey-card:hover {
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    .staff-survey-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 1.5rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid #f3f4f6;
    }

    /* Error Messages */
    .staff-survey-error-container {
        background-color: #fef2f2;
        border: 1px solid #fecaca;
        border-radius: 0.5rem;
        padding: 1rem;
        margin-bottom: 1.5rem;
    }

    .staff-survey-error-list {
        color: #dc2626;
        list-style-type: disc;
        padding-left: 1.25rem;
    }

    .staff-survey-error-item {
        margin-bottom: 0.25rem;
    }

    /* Form Elements */
    .staff-survey-form {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .staff-survey-form-group {
        display: flex;
        flex-direction: column;
    }

    .staff-survey-form-label {
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
    }

    .staff-survey-form-input {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 0.5rem;
        font-size: 1rem;
        transition: all 0.2s ease;
        box-sizing: border-box;
    }

    .staff-survey-form-input:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .staff-survey-form-input:hover {
        border-color: #9ca3af;
    }

    .staff-survey-form-textarea {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 0.5rem;
        font-size: 1rem;
        font-family: inherit;
        resize: vertical;
        min-height: 120px;
        transition: all 0.2s ease;
        box-sizing: border-box;
    }

    .staff-survey-form-textarea:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    /* Button Container */
    .staff-survey-button-container {
        display: flex;
        justify-content: flex-end;
        gap: 0.75rem;
        margin-top: 1rem;
        padding-top: 1.5rem;
        border-top: 1px solid #f3f4f6;
        flex-wrap: wrap;
    }

    /* Buttons */
    .staff-survey-button {
        padding: 0.625rem 1.25rem;
        border-radius: 0.5rem;
        font-weight: 500;
        font-size: 0.95rem;
        cursor: pointer;
        transition: all 0.2s ease;
        border: none;
        text-align: center;
        display: inline-block;
        text-decoration: none;
    }

    .staff-survey-button-cancel {
        background-color: #e5e7eb;
        color: #374151;
    }

    .staff-survey-button-cancel:hover {
        background-color: #d1d5db;
        transform: translateY(-1px);
    }

    .staff-survey-button-submit {
        background-color: #2563eb;
        color: white;
    }

    .staff-survey-button-submit:hover {
        background-color: #1d4ed8;
        transform: translateY(-1px);
        box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.2);
    }

    /* Required Field Indicator */
    .staff-survey-required::after {
        content: " *";
        color: #dc2626;
    }

    /* Helper Text */
    .staff-survey-form-hint {
        font-size: 0.875rem;
        color: #6b7280;
        margin-top: 0.25rem;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .staff-survey-wrapper {
            padding: 0.75rem;
        }
        
        .staff-survey-card {
            padding: 1.25rem;
        }
        
        .staff-survey-title {
            font-size: 1.25rem;
        }
    }

    @media (max-width: 640px) {
        .staff-survey-button-container {
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .staff-survey-button {
            width: 100%;
        }
    }

    @media (max-width: 480px) {
        .staff-survey-card {
            padding: 1rem;
        }
        
        .staff-survey-form-input,
        .staff-survey-form-textarea {
            padding: 0.625rem;
        }
        
        .staff-survey-title {
            font-size: 1.125rem;
        }
    }

    /* Loading State */
    .staff-survey-button-loading {
        opacity: 0.7;
        cursor: not-allowed;
    }

    /* Success State */
    .staff-survey-success-message {
        background-color: #d1fae5;
        color: #065f46;
        padding: 1rem;
        border-radius: 0.5rem;
        margin-bottom: 1.5rem;
        border: 1px solid #a7f3d0;
    }

    /* Placeholder styling */
    .staff-survey-form-input::placeholder,
    .staff-survey-form-textarea::placeholder {
        color: #9ca3af;
        opacity: 0.8;
    }

    /* Focus state untuk a11y */
    .staff-survey-button:focus-visible {
        outline: 2px solid #3b82f6;
        outline-offset: 2px;
    }
</style>

<div class="staff-survey-wrapper">
    <div class="staff-survey-card">
        <h1 class="staff-survey-title">Buat Survey Baru</h1>

        {{-- Error Messages --}}
        @if ($errors->any())
            <div class="staff-survey-error-container">
                <ul class="staff-survey-error-list">
                    @foreach ($errors->all() as $error)
                        <li class="staff-survey-error-item">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Success Message --}}
        @if (session('success'))
            <div class="staff-survey-success-message">
                {{ session('success') }}
            </div>
        @endif
<form method="POST"
      action="{{ route('staff.surveys.store') }}"
      id="staffSurveyForm">
    @csrf



            {{-- Judul Survey --}}
            <div class="staff-survey-form-group">
                <label for="staffSurveyTitle" class="staff-survey-form-label staff-survey-required">Judul Survey</label>
                <input type="text"
                       id="staffSurveyTitle"
                       name="title"
                       value="{{ old('title') }}"
                       class="staff-survey-form-input"
                       placeholder="Masukkan judul survey"
                       required>
                <small class="staff-survey-form-hint">Judul yang jelas dan deskriptif</small>
            </div>

            {{-- Deskripsi Survey --}}
            <div class="staff-survey-form-group">
                <label for="staffSurveyDescription" class="staff-survey-form-label">Deskripsi Survey</label>
                <textarea id="staffSurveyDescription"
                          name="description"
                          rows="4"
                          class="staff-survey-form-textarea"
                          placeholder="Jelaskan tujuan dan detail survey ini">{{ old('description') }}</textarea>
                <small class="staff-survey-form-hint">Opsional. Jelaskan konteks dan tujuan survey</small>
            </div>

            {{-- Link Google Form --}}
            <div class="staff-survey-form-group">
                <label for="staffSurveyUrl" class="staff-survey-form-label staff-survey-required">Link Google Form</label>
                <input type="url"
                       id="staffSurveyUrl"
                       name="survey_url"
                       value="{{ old('survey_url') }}"
                       class="staff-survey-form-input"
                       placeholder="https://forms.gle/..."
                       required>
                <small class="staff-survey-form-hint">Pastikan link Google Form dapat diakses oleh responden</small>
            </div>

            {{-- Action Buttons --}}
            <div class="staff-survey-button-container">
                <a href="{{ route('dashboard') }}"
                   class="staff-survey-button staff-survey-button-cancel">
                    Batal
                </a>
                <button type="submit"
                        class="staff-survey-button staff-survey-button-submit"
                        id="staffSubmitButton">
                    Kirim Survey
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // JavaScript untuk meningkatkan UX (diletakkan di section jika menggunakan Laravel)
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('staffSurveyForm');
        const submitButton = document.getElementById('staffSubmitButton');
        const urlInput = document.getElementById('staffSurveyUrl');
        const textarea = document.getElementById('staffSurveyDescription');
        
        // Form submission handler
        if (form) {
            form.addEventListener('submit', function() {
                // Tampilkan loading state
                if (submitButton) {
                    submitButton.disabled = true;
                    submitButton.classList.add('staff-survey-button-loading');
                    submitButton.innerHTML = 'Mengirim...';
                }
            });
        }
        
        // Validasi real-time untuk input URL
        if (urlInput) {
            urlInput.addEventListener('blur', function() {
                if (this.value && !this.value.startsWith('http')) {
                    this.value = 'https://' + this.value;
                }
            });
            
            urlInput.addEventListener('input', function() {
                // Beri visual feedback untuk URL yang valid
                if (this.value && (this.value.includes('forms.gle') || this.value.includes('docs.google.com/forms'))) {
                    this.style.borderColor = '#10b981';
                } else {
                    this.style.borderColor = '#d1d5db';
                }
            });
        }
        
        // Auto-resize textarea
        if (textarea) {
            textarea.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = (this.scrollHeight) + 'px';
            });
            
            // Trigger resize awal jika ada konten
            if (textarea.value) {
                textarea.style.height = 'auto';
                textarea.style.height = (textarea.scrollHeight) + 'px';
            }
        }
        
        // Auto-fokus ke input judul
        const titleInput = document.getElementById('staffSurveyTitle');
        if (titleInput) {
            titleInput.focus();
            
            // Counter untuk judul
            const titleCounter = document.createElement('small');
            titleCounter.className = 'staff-survey-form-hint';
            titleCounter.style.textAlign = 'right';
            titleCounter.style.display = 'block';
            titleCounter.textContent = '0/100 karakter';
            
            titleInput.parentNode.appendChild(titleCounter);
            
            titleInput.addEventListener('input', function() {
                const count = this.value.length;
                titleCounter.textContent = `${count}/100 karakter`;
                
                if (count > 100) {
                    titleCounter.style.color = '#dc2626';
                } else if (count > 80) {
                    titleCounter.style.color = '#f59e0b';
                } else {
                    titleCounter.style.color = '#6b7280';
                }
            });
            
            // Trigger awal
            titleInput.dispatchEvent(new Event('input'));
        }
        
        // Validasi form sebelum submit
        if (form) {
            form.addEventListener('submit', function(e) {
                // Validasi judul minimal 5 karakter
                if (titleInput && titleInput.value.trim().length < 5) {
                    e.preventDefault();
                    alert('Judul survey harus minimal 5 karakter');
                    titleInput.focus();
                    return false;
                }
                
                // Validasi URL harus Google Forms
                if (urlInput && urlInput.value.trim() !== '') {
                    const url = urlInput.value.trim();
                    if (!url.includes('forms.gle') && !url.includes('docs.google.com/forms')) {
                        e.preventDefault();
                        alert('Harap masukkan link Google Form yang valid (forms.gle atau docs.google.com/forms)');
                        urlInput.focus();
                        return false;
                    }
                }
                
                return true;
            });
        }
    });
</script>
@endsection
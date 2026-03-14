@extends('layouts.cms')

@section('page-title', 'Tambah Agenda')
@section('content')

<style>
    /* ============================================
       AGENDA CREATE PAGE - MODERN & RESPONSIVE
    ============================================ */
    
    :root {
        --primary: #2563eb;
        --primary-dark: #1d4ed8;
        --primary-light: #dbeafe;
        --success: #10b981;
        --success-light: #d1fae5;
        --warning: #f59e0b;
        --warning-light: #fef3c7;
        --danger: #ef4444;
        --danger-light: #fee2e2;
        --gray-50: #f9fafb;
        --gray-100: #f3f4f6;
        --gray-200: #e5e7eb;
        --gray-300: #d1d5db;
        --gray-400: #9ca3af;
        --gray-500: #6b7280;
        --gray-600: #4b5563;
        --gray-700: #374151;
        --gray-800: #1f2937;
        --gray-900: #111827;
        --radius-lg: 12px;
        --radius-md: 8px;
        --radius-sm: 6px;
        --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.1);
        --shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        --shadow-md: 0 10px 15px rgba(0, 0, 0, 0.07);
        --transition: all 0.2s ease;
    }

    /* Base Reset */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Layout Container */
    .ac-layout {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        line-height: 1.5;
        color: var(--gray-700);
        background: var(--gray-50);
        min-height: 100vh;
        padding: 20px;
    }

    .ac-container {
        max-width: 800px;
        margin: 0 auto;
    }

    /* Header Section */
    .ac-header {
        margin-bottom: 32px;
    }

    .ac-header-title {
        font-size: 28px;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .ac-header-title i {
        color: var(--primary);
        font-size: 24px;
    }

    .ac-header-description {
        color: var(--gray-600);
        font-size: 15px;
        line-height: 1.6;
        max-width: 600px;
    }

    /* Back Button */
    .ac-back-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        background: white;
        border: 1px solid var(--gray-300);
        border-radius: var(--radius-md);
        color: var(--gray-700);
        text-decoration: none;
        font-weight: 500;
        font-size: 14px;
        transition: var(--transition);
        margin-bottom: 24px;
    }

    .ac-back-btn:hover {
        background: var(--gray-50);
        border-color: var(--gray-400);
        transform: translateY(-1px);
        box-shadow: var(--shadow);
    }

    /* Alert Cards */
    .ac-alert {
        padding: 16px 20px;
        border-radius: var(--radius-md);
        margin-bottom: 24px;
        display: flex;
        align-items: flex-start;
        gap: 12px;
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .ac-alert-success {
        background: var(--success-light);
        border: 1px solid var(--success);
    }

    .ac-alert-error {
        background: var(--danger-light);
        border: 1px solid var(--danger);
    }

    .ac-alert-info {
        background: var(--primary-light);
        border: 1px solid var(--primary);
    }

    .ac-alert-icon {
        font-size: 18px;
        margin-top: 2px;
    }

    .ac-alert-success .ac-alert-icon {
        color: var(--success);
    }

    .ac-alert-error .ac-alert-icon {
        color: var(--danger);
    }

    .ac-alert-info .ac-alert-icon {
        color: var(--primary);
    }

    .ac-alert-content {
        flex: 1;
    }

    .ac-alert-title {
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 4px;
    }

    .ac-alert-message {
        font-size: 13px;
        line-height: 1.5;
    }

    .ac-alert-error .ac-alert-message ul {
        padding-left: 20px;
        margin-top: 8px;
    }

    .ac-alert-error .ac-alert-message li {
        margin-bottom: 4px;
    }

    /* Form Container */
    .ac-form-card {
        background: white;
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow);
        overflow: hidden;
        margin-bottom: 32px;
    }

    .ac-form-header {
        padding: 24px;
        border-bottom: 1px solid var(--gray-200);
        background: var(--gray-50);
    }

    .ac-form-title {
        font-size: 18px;
        font-weight: 600;
        color: var(--gray-900);
        margin-bottom: 4px;
    }

    .ac-form-subtitle {
        color: var(--gray-600);
        font-size: 13px;
    }

    .ac-form-body {
        padding: 24px;
    }

    /* Form Groups */
    .ac-form-group {
        margin-bottom: 24px;
    }

    .ac-form-group:last-child {
        margin-bottom: 0;
    }

    .ac-form-label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: var(--gray-700);
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .ac-form-label i {
        color: var(--gray-500);
        font-size: 14px;
        width: 16px;
    }

    .ac-form-label.required::after {
        content: "*";
        color: var(--danger);
        margin-left: 2px;
    }

    .ac-form-input,
    .ac-form-select,
    .ac-form-textarea {
        width: 100%;
        padding: 10px 14px;
        border: 1px solid var(--gray-300);
        border-radius: var(--radius-sm);
        font-size: 14px;
        color: var(--gray-800);
        background: white;
        font-family: inherit;
        transition: var(--transition);
    }

    .ac-form-input:focus,
    .ac-form-select:focus,
    .ac-form-textarea:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .ac-form-input.error,
    .ac-form-select.error,
    .ac-form-textarea.error {
        border-color: var(--danger);
        background: var(--danger-light);
    }

    .ac-form-textarea {
        resize: vertical;
        min-height: 120px;
        line-height: 1.6;
    }

    .ac-form-select {
        cursor: pointer;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%236b7280' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
        background-size: 16px;
        padding-right: 36px;
        appearance: none;
    }

    /* Form Help & Error */
    .ac-form-help {
        font-size: 12px;
        color: var(--gray-500);
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 6px;
        line-height: 1.4;
    }

    .ac-form-help i {
        font-size: 12px;
    }

    .ac-form-error {
        font-size: 12px;
        color: var(--danger);
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 6px;
        font-weight: 500;
    }

    .ac-form-error i {
        font-size: 12px;
    }

    /* Form Row (Two Columns) */
    .ac-form-row {
        display: grid;
        grid-template-columns: 1fr;
        gap: 20px;
        margin-bottom: 24px;
    }

    @media (min-width: 640px) {
        .ac-form-row {
            grid-template-columns: 1fr 1fr;
        }
    }

    /* Duration Row */
    .ac-duration-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    /* Form Actions */
    .ac-form-actions {
        padding: 20px 24px;
        border-top: 1px solid var(--gray-200);
        background: var(--gray-50);
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        justify-content: space-between;
    }

    .ac-action-group {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    /* Buttons */
    .ac-btn {
        padding: 10px 20px;
        border-radius: var(--radius-sm);
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        cursor: pointer;
        border: 1px solid transparent;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-height: 40px;
    }

    .ac-btn-primary {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
    }

    .ac-btn-primary:hover {
        background: var(--primary-dark);
        transform: translateY(-1px);
        box-shadow: var(--shadow);
    }

    .ac-btn-success {
        background: var(--success);
        color: white;
        border-color: var(--success);
    }

    .ac-btn-success:hover {
        background: #059669;
        transform: translateY(-1px);
        box-shadow: var(--shadow);
    }

    .ac-btn-outline {
        background: white;
        color: var(--gray-700);
        border-color: var(--gray-300);
    }

    .ac-btn-outline:hover {
        background: var(--gray-50);
        border-color: var(--gray-400);
        transform: translateY(-1px);
        box-shadow: var(--shadow);
    }

    .ac-btn-secondary {
        background: var(--gray-200);
        color: var(--gray-700);
        border-color: var(--gray-300);
    }

    .ac-btn-secondary:hover {
        background: var(--gray-300);
        border-color: var(--gray-400);
        transform: translateY(-1px);
        box-shadow: var(--shadow);
    }

    /* Preview Section */
    .ac-preview-card {
        background: white;
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow);
        padding: 24px;
        margin-top: 24px;
    }

    .ac-preview-title {
        font-size: 16px;
        font-weight: 600;
        color: var(--gray-900);
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .ac-preview-title i {
        color: var(--primary);
    }

    .ac-preview-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 16px;
    }

    @media (min-width: 640px) {
        .ac-preview-grid {
            grid-template-columns: 1fr 1fr;
        }
    }

    .ac-preview-item {
        background: var(--gray-50);
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-md);
        padding: 16px;
        transition: var(--transition);
    }

    .ac-preview-item:hover {
        border-color: var(--gray-300);
        box-shadow: var(--shadow-sm);
    }

    .ac-preview-label {
        font-size: 12px;
        font-weight: 600;
        color: var(--gray-600);
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .ac-preview-label i {
        font-size: 12px;
        color: var(--gray-500);
    }

    .ac-preview-value {
        font-size: 14px;
        color: var(--gray-800);
        line-height: 1.6;
        min-height: 20px;
    }

    .ac-preview-empty {
        color: var(--gray-400);
        font-style: italic;
    }

    /* Character Counter */
    .ac-char-counter {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 8px;
        font-size: 12px;
    }

    .ac-char-count {
        color: var(--gray-500);
        font-weight: 500;
    }

    .ac-char-count.warning {
        color: var(--warning);
    }

    .ac-char-count.danger {
        color: var(--danger);
    }

    /* Notification Toast */
    .ac-notification-container {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        width: 100%;
        max-width: 320px;
    }

    .ac-notification {
        background: white;
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-md);
        padding: 16px;
        margin-bottom: 10px;
        border-left: 4px solid transparent;
        display: flex;
        align-items: flex-start;
        gap: 12px;
        transform: translateX(120%);
        opacity: 0;
        transition: transform 0.3s ease, opacity 0.3s ease;
    }

    .ac-notification.show {
        transform: translateX(0);
        opacity: 1;
    }

    .ac-notification.success {
        border-left-color: var(--success);
        background: var(--success-light);
    }

    .ac-notification.error {
        border-left-color: var(--danger);
        background: var(--danger-light);
    }

    .ac-notification.info {
        border-left-color: var(--primary);
        background: var(--primary-light);
    }

    .ac-notification-icon {
        font-size: 16px;
        margin-top: 2px;
    }

    .ac-notification-content {
        flex: 1;
    }

    .ac-notification-title {
        font-weight: 600;
        font-size: 13px;
        color: var(--gray-800);
        margin-bottom: 4px;
    }

    .ac-notification-message {
        font-size: 12px;
        color: var(--gray-600);
        line-height: 1.4;
    }

    .ac-notification-close {
        background: none;
        border: none;
        color: var(--gray-400);
        cursor: pointer;
        font-size: 12px;
        padding: 4px;
        margin-top: 2px;
        transition: color 0.2s ease;
    }

    .ac-notification-close:hover {
        color: var(--gray-600);
    }

    /* Loading State */
    .ac-btn.loading {
        position: relative;
        color: transparent;
    }

    .ac-btn.loading::after {
        content: "";
        position: absolute;
        width: 16px;
        height: 16px;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        border-top-color: white;
        animation: spin 0.8s linear infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    /* Responsive Adjustments */
    @media (max-width: 640px) {
        .ac-layout {
            padding: 16px;
        }
        
        .ac-header-title {
            font-size: 24px;
        }
        
        .ac-form-header,
        .ac-form-body {
            padding: 20px;
        }
        
        .ac-form-actions {
            flex-direction: column;
            padding: 20px;
        }
        
        .ac-action-group {
            width: 100%;
            flex-direction: column;
        }
        
        .ac-btn {
            width: 100%;
            justify-content: center;
        }
        
        .ac-duration-row {
            grid-template-columns: 1fr;
            gap: 16px;
        }
        
        .ac-preview-card {
            padding: 20px;
        }
        
        .ac-alert {
            flex-direction: column;
            text-align: center;
            gap: 10px;
        }
    }

    @media (max-width: 480px) {
        .ac-header-title {
            font-size: 20px;
        }
        
        .ac-form-header,
        .ac-form-body {
            padding: 16px;
        }
        
        .ac-preview-grid {
            grid-template-columns: 1fr;
        }
        
        .ac-notification-container {
            max-width: calc(100% - 32px);
            right: 16px;
            left: 16px;
        }
    }

    /* Date/Time Input Styling */
    .ac-datetime-wrapper {
        position: relative;
    }

    .ac-datetime-icon {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--gray-400);
        pointer-events: none;
        font-size: 14px;
    }

    /* Print Styles */
    @media print {
        .ac-notification-container,
        .ac-back-btn,
        .ac-form-actions {
            display: none !important;
        }
        
        .ac-form-card,
        .ac-preview-card {
            box-shadow: none;
            border: 1px solid #ddd;
        }
        
        .ac-layout {
            background: white;
            padding: 0;
        }
    }
</style>

<div class="ac-layout">
    <!-- Notification Toast Container -->
    <div class="ac-notification-container" id="acNotificationContainer"></div>
    
    <div class="ac-container">
        <!-- Back Button -->
        <a href="{{ route('staff.agenda.index') }}" class="ac-back-btn">
            <i class="fas fa-arrow-left"></i>
            Kembali ke Daftar Agenda
        </a>

        <!-- Page Header -->
        <div class="ac-header">
            <h1 class="ac-header-title">
                <i class="fas fa-calendar-plus"></i>
                Tambah Agenda Baru
            </h1>
            <p class="ac-header-description">
                Buat agenda baru yang akan diajukan untuk persetujuan admin. Pastikan informasi yang dimasukkan lengkap dan akurat.
            </p>
        </div>

        <!-- Session Success Alert -->
        @if(session('success'))
            <div class="ac-alert ac-alert-success" id="acSessionSuccessAlert">
                <i class="fas fa-check-circle ac-alert-icon"></i>
                <div class="ac-alert-content">
                    <div class="ac-alert-title">Berhasil!</div>
                    <p class="ac-alert-message">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <!-- Validation Errors -->
        @if($errors->any())
            <div class="ac-alert ac-alert-error" id="acValidationError">
                <i class="fas fa-exclamation-circle ac-alert-icon"></i>
                <div class="ac-alert-content">
                    <div class="ac-alert-title">Terjadi kesalahan dalam pengisian form:</div>
                    <div class="ac-alert-message">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <!-- Info Alert -->
        <div class="ac-alert ac-alert-info">
            <i class="fas fa-info-circle ac-alert-icon"></i>
            <div class="ac-alert-content">
                <div class="ac-alert-title">Informasi Status Pengajuan</div>
                <p class="ac-alert-message">
                    Agenda yang Anda buat akan berstatus <strong>"Pending"</strong> dan memerlukan persetujuan admin sebelum dapat dipublikasikan.
                </p>
            </div>
        </div>

        <!-- Form Container -->
        <div class="ac-form-card">
            <form action="{{ route('staff.agenda.store') }}" method="POST" enctype="multipart/form-data" id="acAgendaForm">
                @csrf
                
                <!-- Form Header -->
                <div class="ac-form-header">
                    <h2 class="ac-form-title">Form Pengisian Agenda</h2>
                    <p class="ac-form-subtitle">Field yang bertanda (*) wajib diisi.</p>
                </div>
                
                <!-- Form Body -->
                <div class="ac-form-body">
                    <!-- Judul Agenda -->
                    <div class="ac-form-group">
                        <label class="ac-form-label required">
                            <i class="fas fa-heading"></i>
                            Judul Agenda
                        </label>
                        <input 
                            type="text" 
                            name="title" 
                            id="acTitle"
                            value="{{ old('title') }}"
                            class="ac-form-input {{ $errors->has('title') ? 'error' : '' }}"
                            placeholder="Masukkan judul agenda"
                            required
                            maxlength="200"
                        >
                        @if($errors->has('title'))
                            <div class="ac-form-error">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $errors->first('title') }}
                            </div>
                        @else
                            <div class="ac-form-help">
                                <i class="fas fa-info-circle"></i>
                                Maksimal 200 karakter
                            </div>
                        @endif
                    </div>
                    
                    <!-- Gambar Agenda -->
<div class="ac-form-group">
    <label class="ac-form-label">
        <i class="fas fa-image"></i>
        Gambar Agenda
    </label>

    <input 
        type="file"
        name="image"
        accept="image/*"
        class="ac-form-input"
    >

    <div class="ac-form-help">
        <i class="fas fa-info-circle"></i>
        Upload gambar kegiatan (jpg, png, jpeg)
    </div>
</div>
                    <!-- Tanggal dan Waktu -->
                    <div class="ac-form-row">
                        <div class="ac-form-group">
                            <label class="ac-form-label required">
                                <i class="fas fa-calendar-alt"></i>
                                Tanggal Agenda
                            </label>
                            <div class="ac-datetime-wrapper">
                                <input 
                                    type="date" 
                                    name="date" 
                                    id="acDate"
                                    value="{{ old('date', date('Y-m-d')) }}"
                                    class="ac-form-input {{ $errors->has('date') ? 'error' : '' }}"
                                    required
                                >
                                <i class="fas fa-calendar ac-datetime-icon"></i>
                            </div>
                            @if($errors->has('date'))
                                <div class="ac-form-error">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $errors->first('date') }}
                                </div>
                            @endif
                        </div>
                        
                        <div class="ac-form-group">
                            <label class="ac-form-label required">
                                <i class="fas fa-clock"></i>
                                Waktu Agenda
                            </label>
                            <div class="ac-datetime-wrapper">
                                <input 
                                    type="time" 
                                    name="time" 
                                    id="acTime"
                                    value="{{ old('time', '09:00') }}"
                                    class="ac-form-input {{ $errors->has('time') ? 'error' : '' }}"
                                    required
                                >
                                <i class="fas fa-clock ac-datetime-icon"></i>
                            </div>
                            @if($errors->has('time'))
                                <div class="ac-form-error">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $errors->first('time') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Lokasi -->
                    <div class="ac-form-group">
                        <label class="ac-form-label">
                            <i class="fas fa-map-marker-alt"></i>
                            Lokasi
                        </label>
                        <input 
                            type="text" 
                            name="location" 
                            id="acLocation"
                            value="{{ old('location') }}"
                            class="ac-form-input {{ $errors->has('location') ? 'error' : '' }}"
                            placeholder="Kosongkan jika online/virtual"
                            maxlength="100"
                        >
                        @if($errors->has('location'))
                            <div class="ac-form-error">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $errors->first('location') }}
                            </div>
                        @endif
                    </div>
                    
                    <!-- Durasi -->
                    <div class="ac-form-group">
                        <label class="ac-form-label">
                            <i class="fas fa-hourglass-half"></i>
                            Perkiraan Durasi
                        </label>
                        <div class="ac-duration-row">
                            <div>
                                <input 
                                    type="number" 
                                    name="duration_value" 
                                    id="acDurationValue"
                                    value="{{ old('duration_value', 2) }}"
                                    class="ac-form-input"
                                    placeholder="Durasi"
                                    min="1"
                                    max="24"
                                >
                            </div>
                            <div>
                                <select 
                                    name="duration_unit" 
                                    id="acDurationUnit"
                                    class="ac-form-select"
                                >
                                    <option value="jam" {{ old('duration_unit', 'jam') == 'jam' ? 'selected' : '' }}>Jam</option>
                                    <option value="hari" {{ old('duration_unit') == 'hari' ? 'selected' : '' }}>Hari</option>
                                </select>
                            </div>
                        </div>
                        <div class="ac-form-help">
                            <i class="fas fa-info-circle"></i>
                            Contoh: 2 jam atau 1 hari
                        </div>
                    </div>
                    
                    <!-- Deskripsi -->
                    <div class="ac-form-group">
                        <label class="ac-form-label">
                            <i class="fas fa-align-left"></i>
                            Deskripsi Agenda
                        </label>
                        <textarea 
                            name="description" 
                            id="acDescription"
                            class="ac-form-textarea {{ $errors->has('description') ? 'error' : '' }}"
                            placeholder="Jelaskan detail agenda..."
                            rows="5"
                            maxlength="1000"
                        >{{ old('description') }}</textarea>
                        <div class="ac-char-counter">
                            <div class="ac-form-help">
                                <i class="fas fa-info-circle"></i>
                                Deskripsi akan membantu proses persetujuan
                            </div>
                            <div id="acCharCount" class="ac-char-count">0/1000</div>
                        </div>
                        @if($errors->has('description'))
                            <div class="ac-form-error">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $errors->first('description') }}
                            </div>
                        @endif
                    </div>
                    
                    <!-- Status -->
                    <div class="ac-form-group">
                        <label class="ac-form-label required">
                            <i class="fas fa-flag"></i>
                            Status Awal
                        </label>
                        <select 
                            name="status" 
                            id="acStatus"
                            class="ac-form-select {{ $errors->has('status') ? 'error' : '' }}"
                            required
                        >
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Ajukan untuk Disetujui</option>
                        </select>
                        <div class="ac-form-help">
                            <i class="fas fa-info-circle"></i>
                            Pilih "Ajukan untuk Disetujui" jika sudah siap ditinjau
                        </div>
                    </div>
                </div>
                
                <!-- Form Actions -->
                <div class="ac-form-actions">
                    <div class="ac-action-group">
                        <button type="submit" name="action" value="save" class="ac-btn ac-btn-success" id="acSaveBtn">
                            <i class="fas fa-save"></i>
                            Simpan Draft
                        </button>
                        
                        <button type="submit" name="action" value="submit" class="ac-btn ac-btn-primary" id="acSubmitBtn">
                            <i class="fas fa-paper-plane"></i>
                            Ajukan
                        </button>
                    </div>
                    
                    <div class="ac-action-group">
                        <button type="button" onclick="acClearForm()" class="ac-btn ac-btn-outline">
                            <i class="fas fa-eraser"></i>
                            Hapus
                        </button>
                        
                        <a href="{{ route('staff.agenda.index') }}" class="ac-btn ac-btn-secondary">
                            <i class="fas fa-times"></i>
                            Batal
                        </a>
                    </div>
                </div>
            </form>
        </div>
        
        <!-- Preview Section -->
        <div class="ac-preview-card">
            <h3 class="ac-preview-title">
                <i class="fas fa-eye"></i>
                Preview Agenda
            </h3>
            <div class="ac-preview-grid">
                <div class="ac-preview-item">
                    <div class="ac-preview-label">
                        <i class="fas fa-heading"></i>
                        Judul
                    </div>
                    <div id="acPreviewTitle" class="ac-preview-value ac-preview-empty">Belum diisi</div>
                </div>
                
                <div class="ac-preview-item">
                    <div class="ac-preview-label">
                        <i class="fas fa-calendar-alt"></i>
                        Tanggal & Waktu
                    </div>
                    <div id="acPreviewDateTime" class="ac-preview-value ac-preview-empty">Belum diisi</div>
                </div>
                
                <div class="ac-preview-item">
                    <div class="ac-preview-label">
                        <i class="fas fa-map-marker-alt"></i>
                        Lokasi
                    </div>
                    <div id="acPreviewLocation" class="ac-preview-value ac-preview-empty">Belum diisi</div>
                </div>
                
                <div class="ac-preview-item">
                    <div class="ac-preview-label">
                        <i class="fas fa-align-left"></i>
                        Deskripsi
                    </div>
                    <div id="acPreviewDescription" class="ac-preview-value ac-preview-empty">Belum diisi</div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Notification System
function acShowNotification(type, title, message, duration = 4000) {
    const container = document.getElementById('acNotificationContainer');
    if (!container) return;
    
    const notification = document.createElement('div');
    notification.className = `ac-notification ${type}`;
    
    let icon = '';
    if (type === 'success') {
        icon = '<i class="fas fa-check-circle"></i>';
    } else if (type === 'error') {
        icon = '<i class="fas fa-exclamation-circle"></i>';
    } else if (type === 'info') {
        icon = '<i class="fas fa-info-circle"></i>';
    }
    
    notification.innerHTML = `
        <div class="ac-notification-icon">${icon}</div>
        <div class="ac-notification-content">
            <div class="ac-notification-title">${title}</div>
            <div class="ac-notification-message">${message}</div>
        </div>
        <button class="ac-notification-close" onclick="acCloseNotification(this)">
            <i class="fas fa-times"></i>
        </button>
    `;
    
    container.appendChild(notification);
    
    setTimeout(() => {
        notification.classList.add('show');
    }, 10);
    
    if (duration > 0) {
        setTimeout(() => {
            acCloseNotification(notification.querySelector('.ac-notification-close'));
        }, duration);
    }
    
    return notification;
}

function acCloseNotification(closeBtn) {
    const notification = closeBtn.closest('.ac-notification');
    if (!notification) return;
    
    notification.classList.remove('show');
    setTimeout(() => {
        notification.remove();
    }, 300);
}

// Character Counter
const acDescriptionInput = document.getElementById('acDescription');
const acCharCount = document.getElementById('acCharCount');

function acUpdateCharCount() {
    const length = acDescriptionInput.value.length;
    acCharCount.textContent = `${length}/1000`;
    
    if (length > 1000) {
        acCharCount.className = 'ac-char-count danger';
    } else if (length > 900) {
        acCharCount.className = 'ac-char-count warning';
    } else {
        acCharCount.className = 'ac-char-count';
    }
}

acDescriptionInput.addEventListener('input', acUpdateCharCount);

// Update Preview
function acUpdatePreview() {
    // Title
    const title = document.getElementById('acTitle').value.trim();
    document.getElementById('acPreviewTitle').textContent = title || 'Belum diisi';
    document.getElementById('acPreviewTitle').className = title ? 'ac-preview-value' : 'ac-preview-value ac-preview-empty';
    
    // Date and Time
    const date = document.getElementById('acDate').value;
    const time = document.getElementById('acTime').value;
    if (date && time) {
        try {
            const dateObj = new Date(date + 'T' + time);
            const formattedDate = dateObj.toLocaleDateString('id-ID', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
            const formattedTime = dateObj.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit'
            });
            document.getElementById('acPreviewDateTime').textContent = `${formattedDate} - ${formattedTime}`;
            document.getElementById('acPreviewDateTime').className = 'ac-preview-value';
        } catch (e) {
            document.getElementById('acPreviewDateTime').textContent = 'Format tidak valid';
            document.getElementById('acPreviewDateTime').className = 'ac-preview-value ac-preview-empty';
        }
    } else {
        document.getElementById('acPreviewDateTime').textContent = 'Belum diisi';
        document.getElementById('acPreviewDateTime').className = 'ac-preview-value ac-preview-empty';
    }
    
    // Location
    const location = document.getElementById('acLocation').value.trim();
    document.getElementById('acPreviewLocation').textContent = location || 'Online/Virtual Meeting';
    document.getElementById('acPreviewLocation').className = location ? 'ac-preview-value' : 'ac-preview-value ac-preview-empty';
    
    // Description
    const description = document.getElementById('acDescription').value.trim();
    const truncated = description.length > 100 ? description.substring(0, 100) + '...' : description;
    document.getElementById('acPreviewDescription').textContent = truncated || 'Belum ada deskripsi';
    document.getElementById('acPreviewDescription').className = description ? 'ac-preview-value' : 'ac-preview-value ac-preview-empty';
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    // Show session success notification
    const sessionAlert = document.getElementById('acSessionSuccessAlert');
    if (sessionAlert) {
        const message = sessionAlert.querySelector('.ac-alert-message').textContent;
        acShowNotification('success', 'Berhasil!', message);
        
        setTimeout(() => {
            sessionAlert.style.opacity = '0';
            setTimeout(() => sessionAlert.remove(), 300);
        }, 5000);
    }
    
    // Set min date to today
    const dateInput = document.getElementById('acDate');
    const today = new Date().toISOString().split('T')[0];
    dateInput.min = today;
    
    // Initialize counters and preview
    acUpdateCharCount();
    acUpdatePreview();
    
    // Add event listeners for preview
    ['acTitle', 'acDate', 'acTime', 'acLocation', 'acDescription'].forEach(id => {
        const element = document.getElementById(id);
        if (element) {
            element.addEventListener('input', acUpdatePreview);
            element.addEventListener('change', acUpdatePreview);
        }
    });
    
    // Auto-remove error alert
    const errorAlert = document.getElementById('acValidationError');
    if (errorAlert) {
        setTimeout(() => {
            errorAlert.style.opacity = '0';
            setTimeout(() => errorAlert.remove(), 300);
        }, 8000);
    }
});

// Form Submission
document.getElementById('acAgendaForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const clickedButton = e.submitter || document.activeElement;
    const action = clickedButton.value;
    const statusSelect = document.getElementById('acStatus');
    
    // Set status based on button
    if (action === 'submit') {
        statusSelect.value = 'pending';
        if (!confirm('Ajukan agenda untuk disetujui?')) {
            return false;
        }
    } else if (action === 'save') {
        statusSelect.value = 'draft';
        if (!confirm('Simpan sebagai draft?')) {
            return false;
        }
    }
    
    // Validate required fields
    const requiredFields = [
        { id: 'acTitle', name: 'Judul agenda' },
        { id: 'acDate', name: 'Tanggal agenda' },
        { id: 'acTime', name: 'Waktu agenda' }
    ];
    
    let isValid = true;
    requiredFields.forEach(field => {
        const element = document.getElementById(field.id);
        if (!element.value.trim()) {
            element.classList.add('error');
            isValid = false;
            
            if (isValid) {
                element.focus();
            }
        } else {
            element.classList.remove('error');
        }
    });
    
    if (!isValid) {
        acShowNotification('error', 'Form Tidak Lengkap', 'Harap isi semua field yang wajib diisi.');
        return false;
    }
    
    // Show loading state
    const saveBtn = document.getElementById('acSaveBtn');
    const submitBtn = document.getElementById('acSubmitBtn');
    
    if (action === 'submit') {
        submitBtn.classList.add('loading');
        submitBtn.disabled = true;
    } else {
        saveBtn.classList.add('loading');
        saveBtn.disabled = true;
    }
    
    // Disable all buttons
    document.querySelectorAll('.ac-btn').forEach(btn => {
        btn.disabled = true;
    });
    
    // Show notification
    acShowNotification('info', 
        action === 'submit' ? 'Mengajukan...' : 'Menyimpan...',
        action === 'submit' ? 'Agenda sedang diajukan' : 'Agenda sedang disimpan',
        0
    );
    
    // Submit form after delay
    setTimeout(() => {
        e.target.submit();
    }, 500);
});

// Clear Form
function acClearForm() {
    if (confirm('Hapus semua input?')) {
        document.getElementById('acAgendaForm').reset();
        
        // Reset to defaults
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('acDate').value = today;
        document.getElementById('acTime').value = '09:00';
        document.getElementById('acStatus').value = 'draft';
        document.getElementById('acDurationValue').value = 2;
        document.getElementById('acDurationUnit').value = 'jam';
        
        // Remove error classes
        document.querySelectorAll('.error').forEach(el => {
            el.classList.remove('error');
        });
        
        // Update preview
        acUpdatePreview();
        acUpdateCharCount();
        
        // Show notification
        acShowNotification('info', 'Form Direset', 'Semua input telah dihapus.');
        
        // Focus on title
        document.getElementById('acTitle').focus();
    }
}
</script>
@endsection
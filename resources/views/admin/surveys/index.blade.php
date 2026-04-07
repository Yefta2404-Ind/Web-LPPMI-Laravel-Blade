@extends('layouts.admin')

@section('page-title', 'Manajemen Survey')

@section('content')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* ROOT VARIABLES - BIRU SOLID */
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
    }

    /* MAIN CONTAINER - FULL RESPONSIVE */
    .survey-manager {
        width: 100%;
        max-width: 100%;
        padding: 16px;
    }

    @media (min-width: 768px) {
        .survey-manager {
            padding: 24px;
        }
    }

    /* HEADER SECTION */
    .header-section {
        display: flex;
        flex-direction: column;
        gap: 16px;
        margin-bottom: 24px;
        padding-bottom: 16px;
        border-bottom: 1px solid var(--gray-200);
    }

    @media (min-width: 640px) {
        .header-section {
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
        }
    }

    .header-title h1 {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 4px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .header-title p {
        font-size: 0.875rem;
        color: var(--gray-500);
    }

    .btn-create {
        background: var(--primary);
        color: white;
        padding: 10px 18px;
        border-radius: 10px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-size: 0.875rem;
        font-weight: 500;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
        width: 100%;
    }

    @media (min-width: 640px) {
        .btn-create {
            width: auto;
        }
    }

    .btn-create:hover {
        background: var(--primary-dark);
        transform: translateY(-1px);
    }

    /* ALERT */
    .alert {
        padding: 12px 16px;
        border-radius: 10px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.875rem;
        border-left: 4px solid transparent;
    }
    .alert-success {
        background: var(--success-light);
        color: #065f46;
        border-color: var(--success);
    }
    .alert-error {
        background: var(--danger-light);
        color: #991b1b;
        border-color: var(--danger);
    }

    /* STATS GRID - MOBILE FIRST */
    .stats-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 12px;
        margin-bottom: 24px;
    }

    @media (min-width: 480px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (min-width: 1024px) {
        .stats-grid {
            grid-template-columns: repeat(4, 1fr);
        }
    }

    .stat-card {
        background: white;
        border: 1px solid var(--gray-200);
        border-radius: 12px;
        padding: 14px 16px;
        display: flex;
        align-items: center;
        gap: 12px;
        transition: all 0.2s;
    }

    .stat-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        flex-shrink: 0;
    }
    .stat-icon.blue { background: var(--primary-light); color: var(--primary); }
    .stat-icon.green { background: var(--success-light); color: var(--success); }
    .stat-icon.yellow { background: var(--warning-light); color: var(--warning); }
    .stat-icon.gray { background: var(--gray-100); color: var(--gray-500); }

    .stat-info {
        flex: 1;
    }
    .stat-label {
        font-size: 0.7rem;
        color: var(--gray-500);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .stat-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--gray-900);
        line-height: 1.2;
    }

    /* INFO BANNER */
    .info-banner {
        background: var(--primary-light);
        border: 1px solid var(--primary);
        border-radius: 10px;
        padding: 12px 16px;
        margin-bottom: 20px;
        display: flex;
        align-items: flex-start;
        gap: 10px;
        color: var(--primary-dark);
        font-size: 0.8rem;
    }
    .info-banner i {
        margin-top: 2px;
        flex-shrink: 0;
    }

    /* CARD UNTUK LIST SURVEY (MOBILE FRIENDLY) */
    .survey-list {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    /* SURVEY CARD - TAMPILAN CARD UNTUK HP */
    .survey-card {
        background: white;
        border: 1px solid var(--gray-200);
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.2s;
    }

    .survey-card.active {
        border-left: 4px solid var(--primary);
        background: linear-gradient(90deg, var(--primary-light) 0%, white 5%);
    }
    .survey-card.pending {
        border-left: 4px solid var(--warning);
    }
    .survey-card.archived {
        border-left: 4px solid var(--gray-400);
    }

    .survey-card-content {
        padding: 16px;
    }

    .survey-card-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 10px;
    }

    .survey-title {
        font-size: 1rem;
        font-weight: 700;
        color: var(--gray-900);
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
    }

    .badge-active-small {
        font-size: 0.6rem;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 20px;
        background: var(--primary-light);
        color: var(--primary);
        border: 1px solid var(--primary);
    }

    .survey-status {
        flex-shrink: 0;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 600;
    }
    .status-active {
        background: var(--primary-light);
        color: var(--primary);
        border: 1px solid var(--primary);
    }
    .status-pending {
        background: var(--warning-light);
        color: #92400e;
        border: 1px solid var(--warning);
    }
    .status-archived {
        background: var(--gray-100);
        color: var(--gray-600);
        border: 1px solid var(--gray-300);
    }

    .survey-desc {
        font-size: 0.8rem;
        color: var(--gray-600);
        margin-bottom: 10px;
        line-height: 1.4;
    }

    .survey-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 12px;
        font-size: 0.7rem;
        color: var(--gray-500);
    }
    .meta-item {
        display: flex;
        align-items: center;
        gap: 4px;
    }
    .meta-item a {
        color: var(--primary);
        text-decoration: none;
    }

    /* QR SECTION DALAM CARD */
    .survey-qr {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        padding: 12px 0;
        border-top: 1px solid var(--gray-100);
        border-bottom: 1px solid var(--gray-100);
        margin-bottom: 12px;
    }
    .qr-preview {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .qr-img-small {
        width: 50px;
        height: 50px;
        border: 1px solid var(--gray-200);
        border-radius: 8px;
        padding: 3px;
        cursor: pointer;
    }
    .qr-download {
        font-size: 0.7rem;
        color: var(--primary);
        text-decoration: none;
    }
    .qr-placeholder {
        font-size: 0.7rem;
        color: var(--gray-400);
    }

    /* ACTION BUTTONS */
    .survey-actions {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    @media (min-width: 480px) {
        .survey-actions {
            flex-direction: row;
        }
    }

    .btn-action {
        padding: 8px 12px;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: 500;
        cursor: pointer;
        border: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        transition: all 0.2s;
        text-decoration: none;
        flex: 1;
    }
    .btn-approve {
        background: var(--success);
        color: white;
    }
    .btn-activate {
        background: var(--primary);
        color: white;
    }
    .btn-danger {
        background: var(--danger);
        color: white;
    }
    .btn-disabled {
        background: var(--gray-200);
        color: var(--gray-600);
        cursor: default;
    }

    /* EMPTY STATE */
    .empty-state {
        text-align: center;
        padding: 50px 20px;
        background: white;
        border-radius: 12px;
        border: 1px solid var(--gray-200);
    }
    .empty-state i {
        font-size: 3rem;
        opacity: 0.4;
        margin-bottom: 12px;
    }

    /* MODAL */
    .modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.5);
        z-index: 1000;
        align-items: center;
        justify-content: center;
        padding: 16px;
    }
    .modal-container {
        background: white;
        border-radius: 16px;
        max-width: 350px;
        width: 100%;
        animation: fadeIn 0.2s ease;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }
    .modal-header {
        padding: 16px 20px;
        border-bottom: 1px solid var(--gray-200);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .modal-header h3 {
        font-size: 1rem;
        font-weight: 600;
    }
    .modal-close {
        background: none;
        border: none;
        font-size: 1.3rem;
        cursor: pointer;
        color: var(--gray-400);
    }
    .modal-body {
        padding: 20px;
        text-align: center;
    }
    .modal-body img {
        max-width: 100%;
        border-radius: 8px;
        border: 1px solid var(--gray-200);
    }
    .modal-download {
        margin-top: 16px;
        display: inline-flex;
        background: var(--primary);
        color: white;
        padding: 8px 16px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 0.8rem;
        gap: 6px;
    }

    /* TABLET & DESKTOP - TAMPILAN TABEL */
    @media (min-width: 768px) {
        .survey-list {
            display: none;
        }
        .survey-table-wrapper {
            display: block;
            background: white;
            border: 1px solid var(--gray-200);
            border-radius: 12px;
            overflow-x: auto;
        }
        .survey-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 700px;
        }
        .survey-table th {
            padding: 14px 16px;
            text-align: left;
            font-size: 0.7rem;
            font-weight: 600;
            color: var(--gray-500);
            background: var(--gray-50);
            border-bottom: 2px solid var(--gray-200);
        }
        .survey-table td {
            padding: 14px 16px;
            font-size: 0.8rem;
            border-bottom: 1px solid var(--gray-100);
        }
        .table-action-buttons {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }
        .table-btn {
            padding: 5px 10px;
            font-size: 0.7rem;
        }
        .qr-img-table {
            width: 55px;
            height: 55px;
        }
    }

    @media (max-width: 767px) {
        .survey-table-wrapper {
            display: none;
        }
        .survey-list {
            display: flex;
        }
    }

    form {
        display: contents;
    }
</style>

<div class="survey-manager">
    {{-- HEADER --}}
    <div class="header-section">
        <div class="header-title">
            <h1>
                <i class="fas fa-poll" style="color: var(--primary);"></i>
                Manajemen Survey
            </h1>
            <p>Kelola dan aktifkan survey publik</p>
        </div>
        <a href="{{ route('admin.surveys.create') }}" class="btn-create">
            <i class="fas fa-plus"></i> Buat Survey Baru
        </a>
    </div>

    {{-- ALERTS --}}
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif
    @if(session('error') || $errors->any())
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i>
            {{ session('error') ?? $errors->first() }}
        </div>
    @endif

    {{-- STATISTIK --}}
    @php
        $totalSurveys = $surveys->count();
        $activeSurveys = $surveys->where('status', 'approved')->count();
        $pendingSurveys = $surveys->where('status', 'pending')->count();
        $archivedSurveys = $surveys->where('status', 'archived')->count();
    @endphp

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon blue"><i class="fas fa-chart-simple"></i></div>
            <div class="stat-info">
                <div class="stat-label">Total Survey</div>
                <div class="stat-value">{{ $totalSurveys }}</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon green"><i class="fas fa-circle-check"></i></div>
            <div class="stat-info">
                <div class="stat-label">Aktif</div>
                <div class="stat-value">{{ $activeSurveys }}</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon yellow"><i class="fas fa-hourglass"></i></div>
            <div class="stat-info">
                <div class="stat-label">Pending</div>
                <div class="stat-value">{{ $pendingSurveys }}</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon gray"><i class="fas fa-box-archive"></i></div>
            <div class="stat-info">
                <div class="stat-label">Diarsipkan</div>
                <div class="stat-value">{{ $archivedSurveys }}</div>
            </div>
        </div>
    </div>

    {{-- INFO BANNER --}}
    <div class="info-banner">
        <i class="fas fa-lightbulb"></i>
        <div><strong>Tips:</strong> Klik "Aktifkan" untuk menampilkan survey ke publik. Hanya 1 survey aktif dalam satu waktu.</div>
    </div>

    @if($surveys->count() > 0)
        @php $activeSurvey = $surveys->where('status', 'approved')->first(); @endphp

        {{-- TAMPILAN TABEL (Desktop) --}}
        <div class="survey-table-wrapper">
            <table class="survey-table">
                <thead>
                    <tr>
                        <th>Informasi Survey</th>
                        <th>Status</th>
                        <th>QR Code</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($surveys as $survey)
                        @php
                            $isActive = $activeSurvey && $survey->id === $activeSurvey->id;
                        @endphp
                        <tr style="{{ $isActive ? 'background: var(--primary-light);' : '' }}">
                            <td>
                                <div style="font-weight: 600;">{{ $survey->title }}</div>
                                <div style="font-size: 0.7rem; color: var(--gray-500);">{{ Str::limit($survey->description, 60) }}</div>
                                <div style="font-size: 0.7rem; margin-top: 4px;">
                                    <i class="fas fa-user"></i> {{ $survey->user->name ?? 'Admin' }}
                                </div>
                            </td>
                            <td>
                                @if($isActive)
                                    <span class="status-badge status-active"><i class="fas fa-play"></i> Aktif</span>
                                @elseif($survey->status === 'pending')
                                    <span class="status-badge status-pending"><i class="fas fa-clock"></i> Pending</span>
                                @else
                                    <span class="status-badge status-archived"><i class="fas fa-archive"></i> Diarsipkan</span>
                                @endif
                            </td>
                            <td>
                                @if($survey->qr_code)
                                    <div style="display: flex; flex-direction: column; align-items: center; gap: 4px;">
                                        <img src="{{ asset('storage/' . $survey->qr_code) }}" width="50" height="50" style="border-radius: 6px; cursor: pointer;" onclick="openQrModal('{{ asset('storage/' . $survey->qr_code) }}', '{{ addslashes($survey->title) }}')">
                                        <a href="{{ asset('storage/' . $survey->qr_code) }}" download style="font-size: 0.65rem; color: var(--primary);">Download</a>
                                    </div>
                                @else
                                    <span style="font-size: 0.7rem; color: gray;">Tidak ada</span>
                                @endif
                            </td>
                            <td>
                                <div class="table-action-buttons">
                                    @if($isActive)
                                        <span class="btn-action btn-disabled"><i class="fas fa-check"></i> Aktif</span>
                                    @elseif($survey->status === 'pending')
                                        <form method="POST" action="{{ route('admin.surveys.approve', $survey) }}">
                                            @csrf
                                            <button class="btn-action btn-approve" onclick="return confirm('Setujui survey ini?')"><i class="fas fa-check"></i> Approve</button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.surveys.destroy', $survey) }}">
                                            @csrf @method('DELETE')
                                            <button class="btn-action btn-danger" onclick="return confirm('Hapus?')"><i class="fas fa-trash"></i> Hapus</button>
                                        </form>
                                    @else
                                        <form method="POST" action="{{ route('admin.surveys.activate', $survey) }}">
                                            @csrf
                                            <button class="btn-action btn-activate" onclick="return confirm('Aktifkan survey ini?')"><i class="fas fa-play"></i> Aktifkan</button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.surveys.destroy', $survey) }}">
                                            @csrf @method('DELETE')
                                            <button class="btn-action btn-danger" onclick="return confirm('Hapus permanen?')"><i class="fas fa-trash"></i> Hapus</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- TAMPILAN CARD (Mobile/HP) --}}
        <div class="survey-list">
            @foreach($surveys as $survey)
                @php
                    $isActive = $activeSurvey && $survey->id === $activeSurvey->id;
                    $cardClass = $isActive ? 'active' : ($survey->status === 'pending' ? 'pending' : ($survey->status === 'archived' ? 'archived' : ''));
                @endphp
                <div class="survey-card {{ $cardClass }}">
                    <div class="survey-card-content">
                        <div class="survey-card-header">
                            <div class="survey-title">
                                {{ $survey->title }}
                                @if($isActive)
                                    <span class="badge-active-small"><i class="fas fa-circle" style="font-size: 0.4rem;"></i> AKTIF</span>
                                @endif
                            </div>
                            <div class="survey-status">
                                @if($isActive)
                                    <span class="status-badge status-active"><i class="fas fa-play"></i> Aktif</span>
                                @elseif($survey->status === 'pending')
                                    <span class="status-badge status-pending"><i class="fas fa-clock"></i> Pending</span>
                                @else
                                    <span class="status-badge status-archived"><i class="fas fa-archive"></i> Arsip</span>
                                @endif
                            </div>
                        </div>

                        @if($survey->description)
                            <div class="survey-desc">{{ Str::limit($survey->description, 100) }}</div>
                        @endif

                        <div class="survey-meta">
                            <div class="meta-item"><i class="fas fa-user"></i> {{ $survey->user->name ?? 'Admin' }}</div>
                            <div class="meta-item"><i class="fas fa-calendar"></i> {{ $survey->created_at->format('d M Y') }}</div>
                            @if($survey->survey_url)
                                <div class="meta-item"><a href="{{ $survey->survey_url }}" target="_blank"><i class="fas fa-external-link"></i> Buka Form</a></div>
                            @endif
                        </div>

                        <div class="survey-qr">
                            @if($survey->qr_code)
                                <div class="qr-preview">
                                    <img src="{{ asset('storage/' . $survey->qr_code) }}" class="qr-img-small" onclick="openQrModal('{{ asset('storage/' . $survey->qr_code) }}', '{{ addslashes($survey->title) }}')">
                                    <a href="{{ asset('storage/' . $survey->qr_code) }}" download class="qr-download"><i class="fas fa-download"></i> Download QR</a>
                                </div>
                            @else
                                <div class="qr-placeholder"><i class="fas fa-qrcode"></i> QR tidak tersedia</div>
                            @endif
                        </div>

                        <div class="survey-actions">
                            @if($isActive)
                                <span class="btn-action btn-disabled"><i class="fas fa-check-circle"></i> Sedang Aktif</span>
                            @elseif($survey->status === 'pending')
                                <form method="POST" action="{{ route('admin.surveys.approve', $survey) }}">
                                    @csrf
                                    <button class="btn-action btn-approve" onclick="return confirm('Setujui dan aktifkan survey ini?')"><i class="fas fa-check"></i> Approve</button>
                                </form>
                                <form method="POST" action="{{ route('admin.surveys.destroy', $survey) }}">
                                    @csrf @method('DELETE')
                                    <button class="btn-action btn-danger" onclick="return confirm('Hapus survey ini?')"><i class="fas fa-trash"></i> Hapus</button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('admin.surveys.activate', $survey) }}">
                                    @csrf
                                    <button class="btn-action btn-activate" onclick="return confirm('Aktifkan survey ini?')"><i class="fas fa-play"></i> Aktifkan</button>
                                </form>
                                <form method="POST" action="{{ route('admin.surveys.destroy', $survey) }}">
                                    @csrf @method('DELETE')
                                    <button class="btn-action btn-danger" onclick="return confirm('Hapus permanen survey ini?')"><i class="fas fa-trash"></i> Hapus</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <i class="fas fa-folder-open"></i>
            <p>Belum ada survey</p>
            <small>Klik "Buat Survey Baru" untuk memulai</small>
        </div>
    @endif
</div>

{{-- MODAL QR --}}
<div class="modal-overlay" id="qrModal">
    <div class="modal-container">
        <div class="modal-header">
            <h3 id="qrModalTitle">QR Code</h3>
            <button class="modal-close" onclick="closeQrModal()">&times;</button>
        </div>
        <div class="modal-body">
            <img id="qrModalImg" src="" alt="QR Code">
            <a id="qrDownloadBtn" href="#" download class="modal-download"><i class="fas fa-download"></i> Download QR</a>
        </div>
    </div>
</div>

<script>
function openQrModal(src, title) {
    document.getElementById('qrModalImg').src = src;
    document.getElementById('qrModalTitle').innerHTML = 'QR: ' + title;
    document.getElementById('qrDownloadBtn').href = src;
    document.getElementById('qrModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}
function closeQrModal() {
    document.getElementById('qrModal').style.display = 'none';
    document.body.style.overflow = '';
}
document.getElementById('qrModal')?.addEventListener('click', function(e) {
    if (e.target === this) closeQrModal();
});
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeQrModal();
});
setTimeout(() => {
    document.querySelectorAll('.alert').forEach(el => {
        el.style.transition = 'opacity 0.4s';
        el.style.opacity = '0';
        setTimeout(() => el.remove(), 400);
    });
}, 5000);
</script>
@endsection
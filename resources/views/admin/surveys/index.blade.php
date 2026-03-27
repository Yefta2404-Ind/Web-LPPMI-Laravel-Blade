@extends('layouts.admin')

@section('page-title', 'Manajemen Survey')

@section('content')
<style>
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
        --purple: #8b5cf6;
        --purple-light: #ede9fe;
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

    .page-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 16px;
        margin-bottom: 28px;
        padding-bottom: 20px;
        border-bottom: 1px solid var(--gray-200);
    }

    .page-header-left h1 {
        font-size: 1.625rem;
        font-weight: 700;
        color: var(--gray-900);
        margin: 0 0 4px;
    }

    .page-header-left p {
        font-size: 0.9rem;
        color: var(--gray-500);
        margin: 0;
    }

    .btn-create {
        padding: 10px 18px;
        background: var(--primary);
        color: #fff;
        border-radius: 8px;
        font-size: 0.9rem;
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: none;
        cursor: pointer;
        transition: background 0.15s;
        white-space: nowrap;
    }
    .btn-create:hover { background: var(--primary-dark); color: #fff; }

    /* Alert */
    .alert {
        padding: 14px 18px;
        border-radius: 8px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.9rem;
        border-left: 4px solid transparent;
    }
    .alert-success { background: var(--success-light); color: #065f46; border-color: var(--success); }
    .alert-error   { background: var(--danger-light);  color: #991b1b; border-color: var(--danger); }

    /* Stats */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 14px;
        margin-bottom: 28px;
    }
    @media (max-width: 768px) { .stats-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 480px) { .stats-grid { grid-template-columns: repeat(1, 1fr); } }

    .stat-card {
        background: #fff;
        border: 1px solid var(--gray-200);
        border-radius: 10px;
        padding: 18px;
        display: flex;
        align-items: center;
        gap: 14px;
        transition: box-shadow 0.15s, transform 0.15s;
    }
    .stat-card:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.08); transform: translateY(-1px); }

    .stat-icon {
        width: 44px; height: 44px;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.1rem; flex-shrink: 0;
    }
    .stat-icon.blue   { background: var(--primary-light); color: var(--primary); }
    .stat-icon.green  { background: var(--success-light); color: var(--success); }
    .stat-icon.yellow { background: var(--warning-light); color: var(--warning); }
    .stat-icon.gray   { background: var(--gray-100);      color: var(--gray-500); }

    .stat-label { font-size: 0.775rem; color: var(--gray-500); font-weight: 500; text-transform: uppercase; letter-spacing: 0.04em; }
    .stat-value { font-size: 1.625rem; font-weight: 700; color: var(--gray-900); line-height: 1.2; }

    /* Info banner */
    .info-banner {
        background: linear-gradient(135deg, #eff6ff, #dbeafe);
        border: 1px solid #bfdbfe;
        border-radius: 10px;
        padding: 14px 20px;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 14px;
        color: var(--primary-dark);
        font-size: 0.9rem;
    }
    .info-banner i { font-size: 1.25rem; flex-shrink: 0; }

    /* Table */
    .table-card {
        background: #fff;
        border: 1px solid var(--gray-200);
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06);
    }

    .responsive-table { width: 100%; border-collapse: collapse; }

    .responsive-table thead {
        background: var(--gray-50);
        border-bottom: 2px solid var(--gray-200);
    }
    .responsive-table th {
        padding: 13px 18px;
        text-align: left;
        font-size: 0.775rem;
        font-weight: 600;
        color: var(--gray-500);
        text-transform: uppercase;
        letter-spacing: 0.05em;
        white-space: nowrap;
    }
    .responsive-table td {
        padding: 18px;
        font-size: 0.9rem;
        color: var(--gray-700);
        border-bottom: 1px solid var(--gray-100);
        vertical-align: middle;
    }
    .responsive-table tbody tr:last-child td { border-bottom: none; }
    .responsive-table tbody tr:hover { background: var(--gray-50); }

    .row-active   { border-left: 4px solid var(--purple); background: rgba(139,92,246,0.03); }
    .row-pending  { border-left: 4px solid var(--warning); background: rgba(245,158,11,0.03); }
    .row-archived { border-left: 4px solid var(--gray-300); background: rgba(107,114,128,0.03); }

    /* Survey info */
    .survey-name {
        font-weight: 600;
        color: var(--gray-900);
        margin-bottom: 4px;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
    }
    .survey-name.is-active { color: var(--purple); }

    .badge-active-inline {
        font-size: 0.65rem;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 20px;
        background: var(--purple-light);
        color: var(--purple);
        border: 1px solid var(--purple);
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }

    .survey-desc {
        font-size: 0.8125rem;
        color: var(--gray-500);
        margin-top: 4px;
        line-height: 1.5;
    }

    .survey-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 8px;
        font-size: 0.8rem;
        color: var(--gray-500);
    }
    .meta-item { display: flex; align-items: center; gap: 5px; }

    /* Status badge */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        border: 1px solid transparent;
        white-space: nowrap;
    }
    .badge-active   { background: var(--purple-light); color: var(--purple);   border-color: var(--purple); }
    .badge-pending  { background: var(--warning-light); color: #92400e;         border-color: var(--warning); }
    .badge-archived { background: var(--gray-100);      color: var(--gray-500); border-color: var(--gray-300); }

    /* QR */
    .qr-wrap { display: flex; flex-direction: column; align-items: center; gap: 6px; }
    .qr-img {
        width: 72px; height: 72px;
        border: 1px solid var(--gray-200);
        border-radius: 6px;
        padding: 3px;
        background: #fff;
        cursor: pointer;
        transition: transform 0.15s;
    }
    .qr-img:hover { transform: scale(1.08); }
    .qr-dl { font-size: 0.75rem; color: var(--primary); text-decoration: none; font-weight: 500; }
    .qr-dl:hover { text-decoration: underline; }

    /* Action buttons */
    .action-col { display: flex; flex-direction: column; gap: 7px; min-width: 130px; }

    .btn {
        padding: 7px 14px;
        border-radius: 7px;
        font-size: 0.8125rem;
        font-weight: 500;
        cursor: pointer;
        border: 1px solid transparent;
        transition: all 0.15s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        white-space: nowrap;
        text-decoration: none;
        font-family: inherit;
        width: 100%;
    }
    .btn-view     { background: #fff; color: var(--gray-700); border-color: var(--gray-300); }
    .btn-view:hover { background: var(--gray-50); }
    .btn-activate { background: var(--purple); color: #fff; border-color: var(--purple); }
    .btn-activate:hover { background: #7c3aed; }
    .btn-approve  { background: var(--success); color: #fff; border-color: var(--success); }
    .btn-approve:hover { background: #059669; }
    .btn-danger   { background: var(--danger); color: #fff; border-color: var(--danger); }
    .btn-danger:hover { background: #dc2626; }
    .btn-disabled { background: var(--purple-light); color: var(--purple); border-color: var(--purple); cursor: default; opacity: 0.8; }

    .form-inline { display: contents; }

    /* Empty state */
    .empty-state { text-align: center; padding: 60px 20px; color: var(--gray-500); }
    .empty-state i { font-size: 2.5rem; opacity: 0.35; margin-bottom: 14px; display: block; }
    .empty-state p { font-size: 0.95rem; margin: 0 0 6px; color: var(--gray-600); }
    .empty-state small { font-size: 0.85rem; color: var(--gray-400); }

    /* Modal */
    .modal-overlay {
        display: none;
        position: fixed; inset: 0;
        background: rgba(0,0,0,0.45);
        z-index: 1000;
        align-items: center;
        justify-content: center;
        padding: 16px;
    }
    .modal-box {
        background: #fff;
        border-radius: 12px;
        width: 100%;
        max-width: 420px;
        animation: modalIn 0.2s ease;
        overflow: hidden;
    }
    @keyframes modalIn {
        from { opacity: 0; transform: scale(0.95) translateY(-10px); }
        to   { opacity: 1; transform: scale(1) translateY(0); }
    }
    .modal-head {
        padding: 20px 24px 16px;
        border-bottom: 1px solid var(--gray-100);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .modal-head h3 { font-size: 1.1rem; font-weight: 600; color: var(--gray-900); margin: 0; }
    .modal-close-btn { background: none; border: none; font-size: 1.4rem; color: var(--gray-400); cursor: pointer; line-height: 1; padding: 2px; }
    .modal-close-btn:hover { color: var(--gray-700); }
    .modal-body-inner { padding: 24px; text-align: center; }

    @media (max-width: 768px) {
        .responsive-table { display: block; overflow-x: auto; }
        .action-col { flex-direction: row; flex-wrap: wrap; }
        .action-col .btn { width: auto; flex: 1; min-width: 100px; }
    }
</style>

<div>
    {{-- Page Header --}}
    <div class="page-header">
        <div class="page-header-left">
            <h1>Manajemen Survey</h1>
            <p>Kelola dan aktifkan survey yang akan ditampilkan ke publik</p>
        </div>
        <a href="{{ route('admin.surveys.create') }}" class="btn-create">
            <i class="fas fa-plus"></i> Buat Survey Baru
        </a>
    </div>

    {{-- Alerts --}}
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

    {{-- Stats --}}
    @php
        $totalSurveys    = $surveys->count();
        $activeSurveys   = $surveys->where('status', 'approved')->count();
        $pendingSurveys  = $surveys->where('status', 'pending')->count();
        $archivedSurveys = $surveys->where('status', 'archived')->count();
    @endphp

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon blue"><i class="fas fa-poll"></i></div>
            <div>
                <div class="stat-label">Total Survey</div>
                <div class="stat-value">{{ $totalSurveys }}</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon green"><i class="fas fa-play-circle"></i></div>
            <div>
                <div class="stat-label">Aktif</div>
                <div class="stat-value">{{ $activeSurveys }}</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon yellow"><i class="fas fa-clock"></i></div>
            <div>
                <div class="stat-label">Pending</div>
                <div class="stat-value">{{ $pendingSurveys }}</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon gray"><i class="fas fa-archive"></i></div>
            <div>
                <div class="stat-label">Diarsipkan</div>
                <div class="stat-value">{{ $archivedSurveys }}</div>
            </div>
        </div>
    </div>

    {{-- Info banner --}}
    <div class="info-banner">
        <i class="fas fa-info-circle"></i>
        <div>
            <strong>Cara kerja:</strong> Klik <strong>"Aktifkan"</strong> untuk menampilkan survey ke publik.
            Survey aktif sebelumnya akan otomatis diarsipkan. Hanya 1 survey yang bisa aktif pada satu waktu.
        </div>
    </div>

    {{-- Table --}}
    <div class="table-card">
        @if($surveys->count() > 0)
            @php
                $activeSurvey = $surveys->where('status', 'approved')->first();
            @endphp

            <table class="responsive-table">
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
                            $rowClass = $isActive ? 'row-active'
                                      : ($survey->status === 'pending' ? 'row-pending'
                                      : ($survey->status === 'archived' ? 'row-archived' : ''));
                        @endphp

                        <tr class="{{ $rowClass }}">
                            {{-- Info --}}
                            <td>
                                <div class="survey-name {{ $isActive ? 'is-active' : '' }}">
                                    {{ $survey->title }}
                                    @if($isActive)
                                        <span class="badge-active-inline">
                                            <i class="fas fa-circle" style="font-size:0.5rem"></i> AKTIF
                                        </span>
                                    @endif
                                </div>

                                @if($survey->description)
                                    <div class="survey-desc">{{ Str::limit($survey->description, 90) }}</div>
                                @endif

                                <div class="survey-meta">
                                    <div class="meta-item">
                                        <i class="fas fa-user"></i>
                                        {{ $survey->user->name ?? 'Admin' }}
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-calendar-alt"></i>
                                        {{ $survey->created_at->format('d M Y') }}
                                    </div>
                                    @if($survey->survey_url)
                                        <div class="meta-item">
                                            <a href="{{ $survey->survey_url }}" target="_blank" style="color: var(--primary); font-size:0.8rem;">
                                                <i class="fas fa-external-link-alt"></i> Buka Form
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </td>

                            {{-- Status --}}
                            <td>
                                @if($isActive)
                                    <span class="status-badge badge-active">
                                        <i class="fas fa-play-circle"></i> Aktif
                                    </span>
                                @elseif($survey->status === 'pending')
                                    <span class="status-badge badge-pending">
                                        <i class="fas fa-clock"></i> Pending
                                    </span>
                                @elseif($survey->status === 'archived')
                                    <span class="status-badge badge-archived">
                                        <i class="fas fa-archive"></i> Diarsipkan
                                    </span>
                                @else
                                    <span class="status-badge badge-archived">
                                        <i class="fas fa-minus-circle"></i> {{ ucfirst($survey->status) }}
                                    </span>
                                @endif
                            </td>

                            {{-- QR --}}
                            <td>
                                @if($survey->qr_code)
                                    <div class="qr-wrap">
                                        <img src="{{ asset('storage/' . $survey->qr_code) }}"
                                             alt="QR Code"
                                             class="qr-img"
                                             onclick="openQrModal('{{ asset('storage/' . $survey->qr_code) }}', '{{ addslashes($survey->title) }}')">
                                        <a href="{{ asset('storage/' . $survey->qr_code) }}"
                                           download="qr-{{ Str::slug($survey->title) }}.svg"
                                           class="qr-dl">
                                            <i class="fas fa-download"></i> Download
                                        </a>
                                    </div>
                                @else
                                    <span style="font-size:0.8rem; color: var(--gray-400);">
                                        <i class="fas fa-qrcode"></i> Tidak ada
                                    </span>
                                @endif
                            </td>

                            {{-- Aksi --}}
                            <td>
                                <div class="action-col">
                                    @if($isActive)
                                        {{-- Sedang aktif --}}
                                        <span class="btn btn-disabled">
                                            <i class="fas fa-check-circle"></i> Sedang Aktif
                                        </span>

                                    @elseif($survey->status === 'pending')
                                        {{-- Approve & aktifkan --}}
                                        <form method="POST" action="{{ route('admin.surveys.approve', $survey) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-approve"
                                                    onclick="return confirm('Setujui dan aktifkan survey ini?\nSurvey aktif saat ini akan diarsipkan.')">
                                                <i class="fas fa-check"></i> Approve & Aktifkan
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.surveys.destroy', $survey) }}">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Hapus survey ini?')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>

                                    @elseif($survey->status === 'archived')
                                        {{-- Aktifkan kembali --}}
                                        <form method="POST" action="{{ route('admin.surveys.activate', $survey) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-activate"
                                                    onclick="return confirm('Aktifkan survey ini?\nSurvey aktif saat ini akan diarsipkan.')">
                                                <i class="fas fa-play-circle"></i> Aktifkan
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.surveys.destroy', $survey) }}">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Hapus permanen survey ini? Tidak dapat dibatalkan.')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="empty-state">
                <i class="fas fa-poll-h"></i>
                <p>Belum ada survey</p>
                <small>Klik tombol "Buat Survey Baru" untuk membuat survey pertama</small>
            </div>
        @endif
    </div>
</div>

{{-- QR Modal --}}
<div class="modal-overlay" id="qrModal">
    <div class="modal-box">
        <div class="modal-head">
            <h3 id="qrModalTitle">QR Code</h3>
            <button class="modal-close-btn" onclick="closeQrModal()">&times;</button>
        </div>
        <div class="modal-body-inner">
            <img id="qrModalImg" src="" alt="QR Code" style="max-width:100%; border-radius:8px; border:1px solid #e5e7eb; padding:8px;">
            <div style="margin-top:16px;">
                <a id="qrDownloadBtn" href="#" download class="btn-create" style="justify-content:center; display:flex;">
                    <i class="fas fa-download"></i> Download QR Code
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function openQrModal(src, title) {
    document.getElementById('qrModalImg').src = src;
    document.getElementById('qrModalTitle').textContent = 'QR: ' + title;
    document.getElementById('qrDownloadBtn').href = src;
    document.getElementById('qrDownloadBtn').download = 'qr-' + title.replace(/\s+/g,'-').toLowerCase() + '.svg';
    document.getElementById('qrModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeQrModal() {
    document.getElementById('qrModal').style.display = 'none';
    document.body.style.overflow = '';
}

document.getElementById('qrModal').addEventListener('click', function(e) {
    if (e.target === this) closeQrModal();
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeQrModal();
});

// Auto-dismiss alerts
setTimeout(function() {
    document.querySelectorAll('.alert').forEach(function(el) {
        el.style.transition = 'opacity 0.4s';
        el.style.opacity = '0';
        setTimeout(function() { el.remove(); }, 400);
    });
}, 5000);
</script>
@endsection
@extends('layouts.admin')

@section('content')
<div class="admin-content">
    <div class="content-header">
        <h1 class="page-title">Struktur Organisasi Aktif</h1>
        <p class="page-subtitle">Daftar struktur organisasi yang telah disetujui</p>
    </div>

    <div class="content-card">
        @if($members->isEmpty())
            <div class="empty-state">
                <div class="empty-icon">📊</div>
                <h3>Belum Ada Struktur Organisasi</h3>
                <p>Tidak ada struktur organisasi yang aktif saat ini.</p>
            </div>
        @else
            <div class="table-container">
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th class="text-center">Foto</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th class="text-center">Urutan</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($members as $item)
                                <tr>
                                    <td class="photo-cell">
                                        @if($item->photo)
                                            <div class="avatar">
                                                <img src="{{ asset('storage/'.$item->photo) }}" alt="{{ $item->name }}">
                                            </div>
                                        @else
                                            <div class="avatar placeholder">{{ substr($item->name, 0, 2) }}</div>
                                        @endif
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->position }}</td>
                                    <td class="text-center">{{ $item->order }}</td>
                                    <td class="status-cell">
                                        <span class="status active">Aktif</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</div>




<style>
    /* Base Styles */
    .admin-content {
        padding: 2rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    .content-header {
        margin-bottom: 2rem;
    }

    .page-title {
        font-size: 1.75rem;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 0.5rem;
    }

    .page-subtitle {
        color: #666;
        font-size: 1rem;
    }

    /* Content Card */
    .content-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        overflow: hidden;
    }

    /* Empty State */
    .empty-state {
        padding: 4rem 2rem;
        text-align: center;
    }

    .empty-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    .empty-state h3 {
        color: #555;
        margin-bottom: 0.5rem;
        font-size: 1.25rem;
    }

    .empty-state p {
        color: #888;
        font-size: 0.95rem;
    }

    /* Table Container */
    .table-container {
        padding: 1.5rem;
    }

    .table-responsive {
        overflow-x: auto;
    }

    /* Data Table */
    .data-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 600px;
    }

    .data-table thead {
        background: #f8f9fa;
        border-bottom: 2px solid #e9ecef;
    }

    .data-table th {
        padding: 1rem 1.25rem;
        text-align: left;
        font-weight: 600;
        color: #495057;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        white-space: nowrap;
    }

    .data-table th.text-center {
        text-align: center;
    }

    .data-table tbody tr {
        border-bottom: 1px solid #f1f3f4;
        transition: background-color 0.2s ease;
    }

    .data-table tbody tr:hover {
        background-color: #f8f9fa;
    }

    .data-table td {
        padding: 1rem 1.25rem;
        vertical-align: middle;
    }

    /* Avatar Styles */
    .avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        overflow: hidden;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .avatar.placeholder {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        font-weight: 600;
        font-size: 0.875rem;
    }

    .photo-cell {
        width: 80px;
        text-align: center;
    }

    /* Name Cell */
    .name-cell {
        font-size: 1rem;
        color: #1a1a1a;
        min-width: 180px;
    }

    /* Position Cell */
    .position-cell {
        min-width: 200px;
    }

    .position {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        background: #e3f2fd;
        color: #1976d2;
        border-radius: 4px;
        font-size: 0.875rem;
        font-weight: 500;
    }

    /* Order Cell */
    .order-cell {
        text-align: center;
    }

    .order-badge {
        display: inline-block;
        width: 32px;
        height: 32px;
        line-height: 32px;
        text-align: center;
        background: #f0f0f0;
        color: #555;
        border-radius: 50%;
        font-size: 0.875rem;
        font-weight: 600;
    }

    /* Status Cell */
    .status-cell {
        text-align: center;
    }

    .status {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 0.3px;
    }

    .status.active {
        background: #d4edda;
        color: #155724;
    }

    /* Table Footer */
    .table-footer {
        padding: 1rem 1.25rem;
        border-top: 1px solid #e9ecef;
        background: #f8f9fa;
    }

    .footer-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        color: #666;
        font-size: 0.875rem;
    }

    .count {
        font-weight: 600;
        color: #495057;
    }

    .separator {
        opacity: 0.5;
    }

    .last-updated {
        font-style: italic;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .admin-content {
            padding: 1.5rem 1rem;
        }

        .page-title {
            font-size: 1.5rem;
        }

        .table-container {
            padding: 1rem;
        }

        .data-table th,
        .data-table td {
            padding: 0.875rem 1rem;
        }

        .name-cell,
        .position-cell {
            min-width: 150px;
        }
    }

    @media (max-width: 576px) {
        .admin-content {
            padding: 1rem 0.75rem;
        }

        .content-header {
            margin-bottom: 1.5rem;
        }

        .table-container {
            padding: 0.75rem;
        }

        .data-table th,
        .data-table td {
            padding: 0.75rem 0.875rem;
            font-size: 0.875rem;
        }

        .avatar {
            width: 40px;
            height: 40px;
        }

        .order-badge {
            width: 28px;
            height: 28px;
            line-height: 28px;
        }

        .footer-info {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }

        .separator {
            display: none;
        }
    }

    @media (max-width: 400px) {
        .data-table {
            min-width: 100%;
        }
        
        .data-table th,
        .data-table td {
            padding: 0.5rem;
        }
    }
</style>
@endsection
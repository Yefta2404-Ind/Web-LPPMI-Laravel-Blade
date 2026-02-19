@extends('layouts.admin')

@section('title', 'Manajemen Dokumen SPMI')

@section('content')
<div class="spmi-container">
    <div class="spmi-header">
        <h2>📄 Manajemen Dokumen SPMI</h2>
        
        @if(session('success'))
            <div class="spmi-alert success">
                <span>✅</span>
                <span>{{ session('success') }}</span>
            </div>
        @endif
    </div>

    <div class="spmi-filter">
        <a href="{{ route('admin.spmi.index') }}" class="filter-link {{ !request('status') ? 'active' : '' }}">Semua</a>
        <a href="?status=pending" class="filter-link {{ request('status') == 'pending' ? 'active' : '' }}">Pending</a>
        <a href="?status=approved" class="filter-link {{ request('status') == 'approved' ? 'active' : '' }}">Approved</a>
        <a href="?status=rejected" class="filter-link {{ request('status') == 'rejected' ? 'active' : '' }}">Rejected</a>
    </div>

    <div class="spmi-table-wrapper">
        <table class="spmi-table">
            <thead>
                <tr>
                    <th>Kategori</th>
                    <th>Judul</th>
                    <th>Uploader</th>
                    <th>Status</th>
                    <th>Aksi</th>
                    <th>Tanggal Upload</th>
                </tr>
            </thead>
            <tbody>
                @forelse($documents as $doc)
                <tr>
                    <td data-label="Kategori">{{ $doc->category->name }}</td>
                    <td data-label="Judul">{{ $doc->title }}</td>
                    <td data-label="Uploader">{{ $doc->creator->name }}</td>
                    <td data-label="Status">
                        @if($doc->status == 'approved')
                            <span class="spmi-badge approved">✅ Approved</span>
                        @elseif($doc->status == 'rejected')
                            <span class="spmi-badge rejected">❌ Rejected</span>
                        @else
                            <span class="spmi-badge pending">⏳ Pending</span>
                        @endif
                    </td>
                    <td data-label="Aksi" class="action-buttons">
                        @if($doc->status != 'approved')
                            <form action="{{ route('admin.spmi.approve', $doc->id) }}" method="POST" class="action-form">
                                @csrf
                                <button type="submit" class="spmi-btn approve" title="Approve">
                                    <span>✅</span>
                                    <span class="btn-text">Approve</span>
                                </button>
                            </form>
                        @endif

                        @if($doc->status != 'rejected')
                            <form action="{{ route('admin.spmi.reject', $doc->id) }}" method="POST" class="action-form">
                                @csrf
                                <button type="submit" class="spmi-btn reject" title="Reject">
                                    <span>❌</span>
                                    <span class="btn-text">Reject</span>
                                </button>
                            </form>
                        @endif
                    </td>
                    <td data-label="Tanggal Upload">{{ $doc->created_at->format('d M Y H:i') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="empty-state">
                        <div class="empty-message">
                            📭 Belum ada dokumen yang perlu direview
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<style>
/* CSS Khusus untuk halaman ini - Warna Solid */
.spmi-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 20px;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
}

/* Header */
.spmi-header {
    margin-bottom: 30px;
}

.spmi-header h2 {
    color: #2c3e50;
    font-size: 1.8rem;
    margin-bottom: 20px;
    font-weight: 600;
}

/* Alert */
.spmi-alert {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 15px 20px;
    border-radius: 8px;
    margin-bottom: 20px;
    animation: slideIn 0.3s ease;
    border: 1px solid #c3e6cb;
    background-color: #d4edda;
    color: #155724;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Filter */
.spmi-filter {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 25px;
    background-color: #ffffff;
    padding: 15px;
    border-radius: 8px;
    border: 1px solid #e0e0e0;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
}

.filter-link {
    padding: 8px 16px;
    border-radius: 20px;
    text-decoration: none;
    color: #666666;
    font-weight: 500;
    transition: all 0.3s ease;
    background-color: #f5f5f5;
    border: 1px solid #e0e0e0;
}

.filter-link:hover {
    background-color: #e0e0e0;
    color: #333333;
    transform: translateY(-2px);
}

.filter-link.active {
    background-color: #0056b3;
    color: #ffffff;
    border-color: #0056b3;
    box-shadow: 0 4px 8px rgba(0,86,179,0.2);
}

/* Table Wrapper - untuk responsive */
.spmi-table-wrapper {
    background-color: #ffffff;
    border-radius: 8px;
    border: 1px solid #e0e0e0;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    overflow: hidden;
    overflow-x: auto;
}

/* Table */
.spmi-table {
    width: 100%;
    border-collapse: collapse;
    min-width: 800px;
}

.spmi-table thead tr {
    background-color: #0056b3;
    color: #ffffff;
}

.spmi-table th {
    padding: 15px;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.85rem;
    letter-spacing: 0.5px;
}

.spmi-table td {
    padding: 15px;
    border-bottom: 1px solid #e9ecef;
    vertical-align: middle;
}

.spmi-table tbody tr {
    transition: all 0.3s ease;
}

.spmi-table tbody tr:hover {
    background-color: #f8f9fa;
}

/* Badge */
.spmi-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 500;
    white-space: nowrap;
}

.spmi-badge.approved {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.spmi-badge.rejected {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.spmi-badge.pending {
    background-color: #fff3cd;
    color: #856404;
    border: 1px solid #ffeeba;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

.action-form {
    display: inline;
}

.spmi-btn {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 8px 12px;
    border: none;
    border-radius: 6px;
    font-size: 0.85rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    color: #ffffff;
    border: 1px solid transparent;
}

.spmi-btn.approve {
    background-color: #28a745;
}

.spmi-btn.approve:hover {
    background-color: #218838;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(40,167,69,0.2);
}

.spmi-btn.reject {
    background-color: #dc3545;
}

.spmi-btn.reject:hover {
    background-color: #c82333;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(220,53,69,0.2);
}

.spmi-btn:active {
    transform: translateY(0);
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 40px !important;
}

.empty-message {
    font-size: 1.1rem;
    color: #666666;
    padding: 20px;
    background-color: #f8f9fa;
    border-radius: 8px;
    border: 1px dashed #cccccc;
}

/* Responsive Design */
@media (max-width: 768px) {
    .spmi-container {
        padding: 10px;
    }

    .spmi-header h2 {
        font-size: 1.5rem;
    }

    .spmi-filter {
        padding: 10px;
    }

    .filter-link {
        padding: 6px 12px;
        font-size: 0.9rem;
    }

    /* Ubah table menjadi card style */
    .spmi-table,
    .spmi-table thead,
    .spmi-table tbody,
    .spmi-table th,
    .spmi-table td,
    .spmi-table tr {
        display: block;
    }

    .spmi-table thead {
        display: none;
    }

    .spmi-table tr {
        margin-bottom: 15px;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        overflow: hidden;
        background-color: #ffffff;
    }

    .spmi-table td {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px;
        text-align: right;
        border-bottom: 1px solid #dee2e6;
    }

    .spmi-table td:last-child {
        border-bottom: none;
    }

    .spmi-table td::before {
        content: attr(data-label);
        font-weight: 600;
        color: #495057;
        text-align: left;
    }

    .action-buttons {
        justify-content: flex-end;
    }

    .spmi-btn {
        padding: 6px 10px;
    }

    .btn-text {
        display: none;
    }

    .spmi-badge {
        white-space: normal;
        word-break: break-word;
    }
}

/* Small Mobile */
@media (max-width: 480px) {
    .spmi-filter {
        flex-direction: column;
    }

    .filter-link {
        text-align: center;
    }

    .spmi-table td {
        flex-direction: column;
        align-items: flex-start;
        gap: 5px;
        text-align: left;
    }

    .spmi-table td::before {
        margin-bottom: 5px;
    }

    .action-buttons {
        width: 100%;
        justify-content: flex-start;
    }
}

/* Utility */
.spmi-table tbody tr:last-child td {
    border-bottom: none;
}
</style>
@endsection
@extends('layouts.admin')

@section('title', 'Daftar Kategori SPMI')

@section('content')
<div class="kategori-container">
    <!-- Header -->
    <div class="header">
        <h2>Daftar Kategori SPMI</h2>
        <a href="{{ route('admin.spmi-categories.create') }}" class="btn-tambah">
            + Tambah
        </a>
    </div>

    <!-- Alert -->
    @if(session('success'))
        <div class="alert success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Table -->
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Slug</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $index => $category)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $category->name }}</td>
                    <td><code>{{ $category->slug }}</code></td>
                    <td class="aksi">
                        <a href="{{ route('admin.spmi-categories.edit', $category->id) }}" 
                           class="btn-edit">Edit</a>
                        <form action="{{ route('admin.spmi-categories.destroy', $category->id) }}" 
                              method="POST" 
                              onsubmit="return confirm('Yakin hapus?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-hapus">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align: center; padding: 40px;">
                        Belum ada kategori
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<style>
/* Simple CSS */
.kategori-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
    font-family: system-ui, sans-serif;
}

/* Header */
.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.header h2 {
    margin: 0;
    font-size: 24px;
    color: #333;
}

/* Button */
.btn-tambah {
    background: #0056b3;
    color: white;
    padding: 8px 16px;
    text-decoration: none;
    border-radius: 4px;
    font-size: 14px;
}

.btn-tambah:hover {
    background: #004494;
}

/* Alert */
.alert {
    padding: 12px 16px;
    border-radius: 4px;
    margin-bottom: 20px;
}

.alert.success {
    background: #d4edda;
    border: 1px solid #c3e6cb;
    color: #155724;
}

/* Table Wrapper */
.table-wrapper {
    background: white;
    border: 1px solid #ddd;
    border-radius: 4px;
    overflow-x: auto;
}

/* Table */
table {
    width: 100%;
    border-collapse: collapse;
    min-width: 600px;
}

th {
    background: #f8f9fa;
    text-align: left;
    padding: 12px;
    font-weight: 600;
    font-size: 14px;
    border-bottom: 2px solid #dee2e6;
}

td {
    padding: 12px;
    border-bottom: 1px solid #dee2e6;
    font-size: 14px;
}

tr:last-child td {
    border-bottom: none;
}

/* Slug */
code {
    background: #f1f3f5;
    padding: 2px 6px;
    border-radius: 3px;
    font-size: 13px;
}

/* Action Buttons */
.aksi {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

.aksi form {
    display: inline;
}

.btn-edit, .btn-hapus {
    padding: 4px 12px;
    border-radius: 3px;
    font-size: 13px;
    text-decoration: none;
    border: none;
    cursor: pointer;
}

.btn-edit {
    background: #ffc107;
    color: #000;
}

.btn-edit:hover {
    background: #e0a800;
}

.btn-hapus {
    background: #dc3545;
    color: white;
}

.btn-hapus:hover {
    background: #c82333;
}

/* Mobile */
@media (max-width: 768px) {
    .kategori-container {
        padding: 10px;
    }

    .header {
        flex-direction: column;
        gap: 10px;
        align-items: stretch;
    }

    .header h2 {
        text-align: center;
    }

    .btn-tambah {
        text-align: center;
    }

    table {
        font-size: 13px;
    }

    th, td {
        padding: 8px;
    }

    .btn-edit, .btn-hapus {
        padding: 4px 8px;
        font-size: 12px;
    }
}

@media (max-width: 480px) {
    .aksi {
        flex-direction: column;
    }
    
    .btn-edit, .btn-hapus {
        text-align: center;
    }
}
</style>
@endsection
@extends('layouts.admin')

@section('content')
<div class="admin-container">
    <div class="header">
        <h1 class="page-title">Pilih Struktur Organisasi Aktif</h1>
        <p class="subtitle">Pilih salah satu struktur organisasi yang sudah disetujui untuk dijadikan aktif</p>
    </div>

    @if($data->isEmpty())
    <div class="empty-state">
        <div class="empty-icon">📋</div>
        <h3>Tidak Ada Struktur Disetujui</h3>
        <p>Belum ada struktur organisasi yang diapprove untuk dipilih menjadi aktif.</p>
    </div>
    @else
    <div class="structure-grid">
        @foreach($data as $structure)
        <div class="structure-card">
            <div class="card-header">
                <h3>{{ $structure->name }}</h3>
                @if($structure->is_active)
                <span class="badge active">Aktif</span>
                @else
                <span class="badge approved">Approved</span>
                @endif
            </div>

            <div class="member-grid">
                @foreach($structure->members as $member)
                <div class="member-card">
                    <div class="member-photo">
                        @if($member->photo)
                        <img src="{{ asset('storage/'.$member->photo) }}" alt="{{ $member->name }}" 
                             onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTIwIiBoZWlnaHQ9IjEyMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTIwIiBoZWlnaHQ9IjEyMCIgZmlsbD0iI2YwZjBmMCIvPjx0ZXh0IHg9IjYwIiB5PSI2MCIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjE0IiB0ZXh0LWFuY2hvcj0ibWlkZGxlIiBhbGlnbm1lbnQtYmFzZWxpbmU9Im1pZGRsZSIgZmlsbD0iIzk5OSI+R1VNQVI8L3RleHQ+PC9zdmc+'">
                        @else
                        <div class="avatar-placeholder">{{ substr($member->name,0,2) }}</div>
                        @endif
                    </div>
                    <div class="member-info">
                        <h4>{{ $member->name }}</h4>
                        <p>{{ $member->position }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            @if(!$structure->is_active)
            <form action="{{ route('admin.organization-structure.approve', $structure->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn-approve">
                    ✅ Jadikan Aktif
                </button>
            </form>
            @else
            <div class="active-label">Struktur ini sudah aktif</div>
            @endif
        </div>
        @endforeach
    </div>
    @endif
</div>

<style>
.admin-container { padding: 2rem; max-width: 1200px; margin: auto; }
.header { margin-bottom: 2rem; }
.page-title { font-size: 1.75rem; font-weight: 600; }
.subtitle { color: #666; }

.empty-state { text-align: center; padding: 4rem 2rem; color: #555; }

.structure-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px,1fr)); gap: 1rem; }
.structure-card { background: #fff; border-radius: 12px; padding: 1rem; box-shadow: 0 2px 8px rgba(0,0,0,0.08); display: flex; flex-direction: column; }
.card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; }
.badge { padding: 0.25rem 0.75rem; border-radius: 12px; font-size: 0.75rem; font-weight: 600; color: #fff; }
.badge.approved { background-color: #17a2b8; }
.badge.active { background-color: #28a745; }

.member-grid { display: flex; flex-wrap: wrap; gap: 0.5rem; margin-bottom: 1rem; }
.member-card { display: flex; align-items: center; gap: 0.5rem; background: #f8f9fa; padding: 0.5rem; border-radius: 8px; flex: 1 1 calc(50% - 0.5rem); }
.member-photo img { width: 50px; height: 50px; border-radius: 50%; object-fit: cover; }
.avatar-placeholder { width: 50px; height: 50px; border-radius: 50%; background: #667eea; color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 600; }
.member-info h4 { margin: 0; font-size: 0.9rem; }
.member-info p { margin: 0; font-size: 0.8rem; color: #555; }

.btn-approve { background-color: #28a745; color: #fff; padding: 0.5rem 1rem; border-radius: 8px; border: none; cursor: pointer; font-weight: 600; }
.active-label { color: #28a745; font-weight: 600; text-align: center; }
</style>
@endsection

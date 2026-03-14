@extends('layouts.cms')

@section('content')

<style>
    .form-wrapper {
        max-width: 600px;
        margin: auto;
        background: #ffffff;
        padding: 25px;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
    }

    .page-title {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 20px;
        color: #0f2a44;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        font-weight: 600;
        font-size: 14px;
        display: block;
        margin-bottom: 6px;
    }

    input, textarea {
        width: 100%;
        padding: 10px;
        border-radius: 6px;
        border: 1px solid #d1d5db;
        font-size: 14px;
    }

    textarea {
        resize: vertical;
    }

    .btn-group {
        display: flex;
        gap: 10px;
        margin-top: 20px;
    }

    .btn-primary {
        background: #0f2a44;
        color: white;
        padding: 10px 18px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        font-size: 14px;
    }

    .btn-secondary {
        background: #6b7280;
        color: white;
        padding: 10px 18px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 14px;
    }
</style>

<div class="form-wrapper">

    <h2 class="page-title">✏️ Edit Agenda</h2>

    <form action="{{ route('staff.agenda.update', $agenda->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    {{-- JUDUL --}}
    <div class="form-group">
        <label>Judul Agenda</label>
        <input type="text" name="title"
            value="{{ old('title', $agenda->title) }}" required>
    </div>

    {{-- TANGGAL --}}
    <div class="form-group">
        <label>Tanggal</label>
        <input type="date" name="date"
            value="{{ old('date', $agenda->date) }}" required>
    </div>

    {{-- WAKTU --}}
    <div class="form-group">
        <label>Waktu</label>
        
        <input type="time" name="time"
    value="{{ old('time', substr($agenda->time, 0, 5)) }}"
    required>


    </div>

    {{-- LOKASI --}}
    <div class="form-group">
        <label>Lokasi</label>
        <input type="text" name="location"
            value="{{ old('location', $agenda->location) }}">
    </div>

    {{-- GAMBAR AGENDA --}}
<div class="form-group">
    <label>Gambar Agenda</label>

    @if($agenda->image)
        <div style="margin-bottom:10px;">
            <img src="{{ asset('storage/'.$agenda->image) }}" 
                 style="width:200px;border-radius:6px;">
        </div>
    @endif

    <input type="file" name="image" accept="image/*">

    <small style="color:#6b7280">
        Upload gambar baru jika ingin mengganti gambar agenda.
    </small>
</div>

    {{-- DESKRIPSI --}}
    <div class="form-group">
        <label>Deskripsi</label>
        <textarea name="description" rows="4">{{ old('description', $agenda->description) }}</textarea>
    </div>

    {{-- BUTTON --}}
    <div class="btn-group">
        <button type="submit" class="btn-primary">💾 Update</button>
        <a href="{{ route('staff.agenda.index') }}" class="btn-secondary">❌ Batal</a>
    </div>
</form>


</div>
@endsection

@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-6 py-8">

    <h1 class="text-2xl font-bold mb-6">Tambah Menu</h1>

    <form action="{{ route('admin.menus.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label>Judul Menu</label>
            <input type="text" name="title" class="w-full border p-2" required>
        </div>

        <div>
            <label>Pilih Halaman</label>
            <select name="page_id" class="w-full border p-2" required>
                <option value="">-- Pilih Halaman --</option>
                @foreach($pages as $page)
                    <option value="{{ $page->id }}">
                        {{ $page->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Parent (opsional)</label>
            <select name="parent_id" class="w-full border p-2">
                <option value="">-- Menu Utama --</option>
                @foreach($parents as $parent)
                    <option value="{{ $parent->id }}">
                        {{ $parent->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Urutan</label>
            <input type="number" name="order" value="0" class="w-full border p-2">
        </div>

        <div>
            <label>
                <input type="checkbox" name="is_active" value="1" checked>
                Aktif
            </label>
        </div>

        <button class="bg-green-600 text-white px-4 py-2 rounded">
            Simpan
        </button>

    </form>

</div>
@endsection
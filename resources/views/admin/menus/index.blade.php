@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4">

    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-bold">Manajemen Menu</h1>
        <a href="{{ route('admin.menus.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded">
            Tambah Menu
        </a>
    </div>

    <table class="w-full border">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2 border">Judul</th>
                <th class="p-2 border">Tipe</th>
                <th class="p-2 border">Parent</th>
                <th class="p-2 border">Status</th>
                <th class="p-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($menus as $menu)
            <tr>
                <td class="p-2 border">{{ $menu->title }}</td>
                <td class="p-2 border">{{ $menu->type }}</td>
                <td class="p-2 border">
                    {{ $menu->parent?->title ?? '-' }}
                </td>
                <td class="p-2 border">
                    {{ $menu->is_active ? 'Aktif' : 'Nonaktif' }}
                </td>
                <td class="p-2 border flex gap-2">
                    <a href="{{ route('admin.menus.edit', $menu) }}"
                       class="text-blue-600">Edit</a>

                    <form action="{{ route('admin.menus.destroy', $menu) }}"
                          method="POST">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Hapus?')"
                                class="text-red-600">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
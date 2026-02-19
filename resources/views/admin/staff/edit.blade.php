@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Edit Staff</h1>

    {{-- Status notifikasi --}}
    @if(session('status'))
        <div 
            class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" 
            id="status-alert">
            {{ session('status') }}
        </div>
    @endif

    {{-- Validation Errors --}}
    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.staff.update', $staff) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block mb-1">Nama</label>
            <input type="text" name="name" 
    value="{{ old('name', $staff->name) }}" 
    class="border rounded p-2 w-full" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Email</label>
            <input type="email" name="email" 
    value="{{ old('email', $staff->email) }}" 
    class="border rounded p-2 w-full" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Password Baru (kosongkan jika tidak diubah)</label>
            <input type="password" name="password" class="border rounded p-2 w-full">
        </div>
        <div class="mb-4">
            <label class="block mb-1">Konfirmasi Password Baru</label>
            <input type="password" name="password_confirmation" class="border rounded p-2 w-full">
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
        <a href="{{ route('admin.staff.index') }}" class="ml-2 text-gray-600">Batal</a>
    </form>
</div>

{{-- Script auto fade & redirect --}}
<script>
    const statusAlert = document.getElementById('status-alert');
    if(statusAlert){
        // Auto fade
        setTimeout(() => {
            statusAlert.style.transition = "opacity 0.5s";
            statusAlert.style.opacity = 0;
            // Remove elemen setelah fade
            setTimeout(()=> statusAlert.remove(), 500);

            // Optional: redirect ke index staff setelah fade
            setTimeout(() => {
                window.location.href = "{{ route('admin.staff.index') }}";
            }, 1000); // delay 1 detik setelah fade
        }, 5000); // muncul 5 detik
    }
</script>
@endsection

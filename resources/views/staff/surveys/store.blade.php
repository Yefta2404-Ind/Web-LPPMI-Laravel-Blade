@extends('layouts.staff')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-xl font-bold mb-4">Survey berhasil diproses</h1>

    <p class="mb-4">
        Data survey sudah dikirim dan sedang menunggu persetujuan admin.
    </p>

    <a href="{{ route('staff.surveys.create') }}"
       class="text-blue-600 underline">
        Buat survey baru
    </a>
</div>
@endsection

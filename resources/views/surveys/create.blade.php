@extends('layouts.cms')

@section('content')
<div class="bg-white p-6 rounded shadow max-w-xl">
    <h1 class="text-2xl font-bold mb-4">Input Survey</h1>

    <form action="{{ route('staff.surveys.store') }}"
          method="POST"
          enctype="multipart/form-data"
          class="space-y-4">
        @csrf

        <div>
            <label class="block font-semibold">Judul Survey</label>
            <input type="text" name="title"
                   class="w-full border p-2 rounded"
                   required>
        </div>

        <div>
            <label class="block font-semibold">Deskripsi</label>
            <textarea name="description"
                      class="w-full border p-2 rounded"></textarea>
        </div>

        <div>
            <label class="block font-semibold">Link Survey</label>
            <input type="url" name="survey_url"
                   class="w-full border p-2 rounded">
        </div>

        <div>
            <label class="block font-semibold">QR Code</label>
            <input type="file" name="qr_code"
                   class="w-full border p-2 rounded">
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Kirim Survey
        </button>
    </form>
</div>
@endsection

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Staff CMS</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    <aside class="w-64 bg-blue-800 text-white p-4">
        <h2 class="text-xl font-bold mb-6">CMS Staff</h2>

        <nav class="space-y-2">
            <a href="{{ route('dashboard') }}" class="block hover:bg-blue-700 p-2 rounded">
    🏠 Dashboard
</a>
            <a href="{{ route('staff.news.create') }}" class="block hover:bg-blue-700 p-2 rounded">➕ Buat Berita</a>
            <a href="{{ route('staff.agenda.create') }}" class="block hover:bg-blue-700 p-2 rounded">➕ Buat Agenda</a>
            

            {{-- ✅ TAMBAH INI --}}
            <a href="{{ route('staff.surveys.create') }}"
               class="block hover:bg-blue-700 p-2 rounded">
               📝 Input Survey
            </a>
        </nav>
    </aside>

    {{-- CONTENT --}}
    <main class="flex-1 p-6">
        @yield('content')
    </main>

</div>

</body>
</html>

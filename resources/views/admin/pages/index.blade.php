@extends('layouts.admin')

@section('content')
<div class="container">

<h1>Daftar Page</h1>

<a href="{{ route('admin.pages.create') }}">
    Tambah Page
</a>

<table border="1" cellpadding="10">
    <tr>
        <th>Judul</th>
        <th>Slug</th>
        <th>Status</th>
    </tr>

    @foreach($pages as $page)
    <tr>
        <td>{{ $page->title }}</td>
        <td>{{ $page->slug }}</td>
        <td>
            {{ $page->is_active ? 'Aktif' : 'Nonaktif' }}
        </td>
    </tr>
    @endforeach

</table>

</div>
@endsection
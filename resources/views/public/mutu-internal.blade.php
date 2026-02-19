@extends('layouts.public')

@section('content')
<div class="container py-5">

    <h1 class="mb-4">Mutu Internal</h1>

    @forelse($categories as $category)

        <div class="mb-5">

            <h3 class="mb-3">{{ $category->name }}</h3>

            @if($category->qualities->count() > 0)

                <ul class="list-group">

                    @foreach($category->qualities as $item)
                        <li class="list-group-item d-flex 
                                   justify-content-between align-items-center">

                            <span>Tahun {{ $item->year }}</span>

                            <div>

                                @if($item->file_path)
                                    <a href="{{ asset('storage/'.$item->file_path) }}"
                                       target="_blank"
                                       class="btn btn-sm btn-primary">
                                       Lihat
                                    </a>
                                @elseif($item->external_url)
                                    <a href="{{ $item->external_url }}"
                                       target="_blank"
                                       class="btn btn-sm btn-outline-primary">
                                       Lihat
                                    </a>
                                @endif

                            </div>

                        </li>
                    @endforeach

                </ul>

            @else
                <div class="alert alert-light">
                    Belum ada data tersedia.
                </div>
            @endif

        </div>

    @empty

        <div class="alert alert-info">
            Belum ada kategori tersedia.
        </div>

    @endforelse

</div>
@endsection

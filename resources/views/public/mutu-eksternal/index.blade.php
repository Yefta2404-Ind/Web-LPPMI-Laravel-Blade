@extends('layouts.public')

@section('title', 'Mutu Eksternal')

@section('content')
<div class="mutu-eksternal">
    <!-- Header -->
    <div class="header">
        <h1>Mutu Eksternal</h1>
        <p>
            Lembaga Pengendalian dan Penjaminan Mutu Internal (LPPMI)
            memberikan layanan bagi Unit Pengelola Program Studi (UPPS)
            di UGK untuk melakukan akreditasi dan sertifikasi Program Studi.
        </p>
    </div>

    <hr>

    <!-- Content Sections -->
    @foreach($sections as $key => $label)
        <section class="section">
            <h2>{{ $label }}</h2>

            @if(isset($data[$key]) && $data[$key]->count())
                @foreach($data[$key] as $item)
                    <div class="card">
                        <div class="card-body">
                            <h3>{{ $item->title }}</h3>
                            
                            @if($item->description)
                                <div class="description">
                                    {!! $item->description !!}
                                </div>
                            @endif

                            <div class="actions">
                                @if($item->file_path)
                                    <a href="{{ asset('storage/'.$item->file_path) }}" 
                                       target="_blank" 
                                       class="btn btn-primary">
                                        Unduh
                                    </a>
                                @endif

                                @if($item->external_url)
                                    <a href="{{ $item->external_url }}" 
                                       target="_blank" 
                                       class="btn btn-outline">
                                        Kunjungi
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="empty">
                    Belum ada data pada kategori ini.
                </div>
            @endif
        </section>
    @endforeach
</div>

<style>
/* Simple CSS */
.mutu-eksternal {
    max-width: 1000px;
    margin: 0 auto;
    padding: 40px 20px;
    font-family: system-ui, -apple-system, sans-serif;
}

/* Header */
.header {
    margin-bottom: 40px;
}

.header h1 {
    font-size: 32px;
    margin: 0 0 15px 0;
    color: #333;
}

.header p {
    font-size: 16px;
    line-height: 1.6;
    color: #666;
    margin: 0;
}

hr {
    border: 0;
    border-top: 1px solid #ddd;
    margin: 30px 0;
}

/* Section */
.section {
    margin-bottom: 50px;
}

.section h2 {
    font-size: 24px;
    margin: 0 0 20px 0;
    color: #444;
    padding-bottom: 10px;
    border-bottom: 2px solid #0056b3;
}

/* Card */
.card {
    background: white;
    border: 1px solid #ddd;
    border-radius: 4px;
    margin-bottom: 15px;
}

.card-body {
    padding: 20px;
}

.card h3 {
    font-size: 18px;
    margin: 0 0 10px 0;
    color: #333;
}

/* Description */
.description {
    font-size: 14px;
    line-height: 1.6;
    color: #666;
    margin-bottom: 15px;
}

.description p {
    margin: 0 0 10px 0;
}

.description p:last-child {
    margin-bottom: 0;
}

/* Actions */
.actions {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.btn {
    display: inline-block;
    padding: 8px 16px;
    font-size: 14px;
    text-decoration: none;
    border-radius: 4px;
    border: 1px solid transparent;
    cursor: pointer;
}

.btn-primary {
    background: #0056b3;
    color: white;
    border-color: #004494;
}

.btn-primary:hover {
    background: #004494;
}

.btn-outline {
    background: white;
    color: #0056b3;
    border-color: #0056b3;
}

.btn-outline:hover {
    background: #f0f7ff;
}

/* Empty State */
.empty {
    background: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 20px;
    color: #666;
    font-size: 14px;
    text-align: center;
}

/* Responsive */
@media (max-width: 768px) {
    .mutu-eksternal {
        padding: 20px 15px;
    }

    .header h1 {
        font-size: 28px;
    }

    .section h2 {
        font-size: 22px;
    }

    .card-body {
        padding: 15px;
    }

    .actions {
        flex-direction: column;
    }

    .btn {
        text-align: center;
    }
}

@media (max-width: 480px) {
    .header h1 {
        font-size: 24px;
    }

    .header p {
        font-size: 14px;
    }

    .section h2 {
        font-size: 20px;
    }

    .card h3 {
        font-size: 16px;
    }

    .description {
        font-size: 13px;
    }
}
</style>
@endsection
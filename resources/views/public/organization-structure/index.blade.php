@extends('layouts.public')

@section('title', 'Struktur Organisasi')

@section('content')
<div class="container py-5">
    <!-- Header -->
    <div class="mb-5 text-center">
        <h1 class="fw-bold mb-3" style="color: #003366;">Struktur Organisasi LPPMI UGK</h1>
        <div style="height: 3px; width: 80px; background: #d4af37; margin: 0 auto;"></div>
    </div>

    <!-- Team Grid -->
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">
       @php
    $allMembers = $structure ? $structure->members : [];
@endphp


        
        @forelse($allMembers as $member)
        <div class="col">
            <div class="team-card text-center h-100">
                <!-- Avatar -->
                <div class="avatar-wrapper mb-3">
                    @if($member->photo)
                    <img src="{{ asset('storage/'.$member->photo) }}" 
                         class="avatar" 
                         alt="{{ $member->name }}">
                    @else
                    <div class="avatar avatar-placeholder">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    @endif
                </div>
                
                <!-- Info -->
                <div class="team-info">
                    <h6 class="mb-1 fw-bold">{{ $member->name }}</h6>
                    <p class="text-muted small mb-2">{{ $member->position }}</p>
                    
                    @if($member->education)
                    <p class="text-dark small mb-3">{{ $member->education }}</p>
                    @endif
                    
                    <!-- Contact -->
                    <div class="contact-links">
                        @if($member->email)
                        <a href="mailto:{{ $member->email }}" class="me-2">
                            <i class="fas fa-envelope text-primary"></i>
                        </a>
                        @endif
                        
                        @if($member->phone)
                        <a href="tel:{{ $member->phone }}">
                            <i class="fas fa-phone text-success"></i>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="text-center py-5">
                <i class="fas fa-users fa-3x text-muted mb-3"></i>
                <p class="text-muted">Data anggota belum tersedia</p>
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection

@section('styles')
<style>
    .team-card {
        padding: 1.5rem;
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
    }
    
    .team-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid white;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    
    .avatar-placeholder {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: linear-gradient(135deg, #003366, #004488);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        margin: 0 auto;
    }
    
    .contact-links a {
        font-size: 1.1rem;
        text-decoration: none;
        transition: transform 0.2s;
    }
    
    .contact-links a:hover {
        transform: scale(1.2);
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .row-cols-2 {
            --bs-columns: 2;
        }
        
        .avatar, .avatar-placeholder {
            width: 80px;
            height: 80px;
        }
    }
    
    @media (max-width: 576px) {
        .row-cols-2 {
            --bs-columns: 1;
        }
        
        .team-card {
            max-width: 280px;
            margin: 0 auto;
        }
    }
</style>
@endsection
@extends('layouts.public')

@section('title', 'Struktur Organisasi')

@section('content')
<div class="container py-5">
    <!-- Header -->
    <div class="mb-5 text-center">
        <h1 class="fw-bold mb-3" style="color: #003366;">Struktur Organisasi LPPMI</h1>
        <div style="height: 3px; width: 80px; background: #d4af37; margin: 0 auto;"></div>
    </div>

    <!-- Team Grid -->
    <div class="row g-4">
        @php
            $allMembers = $structure ? $structure->members : [];
        @endphp

        @forelse($allMembers as $member)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
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
                        <a href="mailto:{{ $member->email }}" class="me-2" title="Email">
                            <i class="fas fa-envelope text-primary"></i>
                        </a>
                        @endif
                        
                        @if($member->phone)
                        <a href="tel:{{ $member->phone }}" title="Telepon">
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
        padding: 1.5rem 1rem;
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
        display: inline-block;
    }
    
    .contact-links a:hover {
        transform: scale(1.2);
    }
    
    /* Responsive Breakpoints */
    
    /* Mobile (di bawah 576px) */
    @media (max-width: 575.98px) {
        .col-12 {
            width: 100%;
        }
        
        .team-card {
            max-width: 100%;
            margin: 0;
            padding: 1.2rem;
        }
        
        .avatar, .avatar-placeholder {
            width: 90px;
            height: 90px;
        }
        
        .team-info h6 {
            font-size: 1rem;
        }
        
        .team-info p {
            font-size: 0.9rem;
        }
    }
    
    /* Tablet (576px - 767px) */
    @media (min-width: 576px) and (max-width: 767.98px) {
        .col-sm-6 {
            width: 50%;
        }
        
        .team-card {
            padding: 1.2rem;
        }
        
        .avatar, .avatar-placeholder {
            width: 90px;
            height: 90px;
        }
    }
    
    /* Desktop kecil (768px - 991px) */
    @media (min-width: 768px) and (max-width: 991.98px) {
        .col-md-4 {
            width: 33.333%;
        }
        
        .avatar, .avatar-placeholder {
            width: 95px;
            height: 95px;
        }
    }
    
    /* Desktop besar (992px ke atas) */
    @media (min-width: 992px) {
        .col-lg-3 {
            width: 25%;
        }
    }
</style>
@endsection
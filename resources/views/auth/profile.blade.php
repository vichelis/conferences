@extends('layouts.app')

@section('title', 'Profilis')
@section('navbar-brand', 'Profilis')
@section('navbar-brand-url', url('/'))
@section('navbar-class', 'navbar-client')

@section('navbar-links')
<li class="nav-item">
    <a class="nav-link" href="{{ url('/') }}">Pradžia</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('conferences.index') }}">Konferencijos</a>
</li>
@endsection

@push('styles')
<style>
    .navbar-client {
        background: rgba(108, 123, 149, 0.9) !important;
    }
    .profile-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(10px);
    }
    .privilege-badge {
        padding: 8px 16px;
        border-radius: 20px;
        color: white;
        font-weight: 500;
        display: inline-block;
    }
    .privilege-user {
        background: linear-gradient(45deg, #6c7b95, #8e9aaf);
    }
    .privilege-admin {
        background: linear-gradient(45deg, #b5838d, #d4a574);
    }
    .privilege-employee {
        background: linear-gradient(45deg, #7d8471, #a8b5a0);
    }
    .stat-card {
        background: rgba(255, 255, 255, 0.8);
        border-radius: 15px;
        padding: 20px;
        text-align: center;
        margin-bottom: 20px;
        transition: transform 0.3s ease;
    }
    .stat-card:hover {
        transform: translateY(-5px);
    }
</style>
@endpush

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="profile-card p-5">
                <div class="text-center mb-4">
                    <div class="mb-3">
                        <i class="fas fa-user-circle fa-5x text-muted"></i>
                    </div>
                    <h2 class="mb-2">{{ Auth::user()->name }}</h2>
                    <p class="text-muted mb-3">{{ Auth::user()->email }}</p>

                    <div class="mb-4">
                        <span class="privilege-badge privilege-user">
                            <i class="fas fa-user me-2"></i>
                            Naudotojas
                        </span>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <h5 class="mb-3">Pagrindinė informacija</h5>
                        <div class="mb-2">
                            <strong>Vardas:</strong> {{ Auth::user()->name }}
                        </div>
                        <div class="mb-2">
                            <strong>El. paštas:</strong> {{ Auth::user()->email }}
                        </div>
                        @if(Auth::user()->phone)
                        <div class="mb-2">
                            <strong>Telefonas:</strong> {{ Auth::user()->phone }}
                        </div>
                        @endif
                        @if(Auth::user()->city)
                        <div class="mb-2">
                            <strong>Miestas:</strong> {{ Auth::user()->city }}
                        </div>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <h5 class="mb-3">Paskyros informacija</h5>
                        <div class="mb-2">
                            <strong>Registracijos data:</strong> {{ Auth::user()->created_at->format('Y-m-d') }}
                        </div>
                        <div class="mb-2">
                            <strong>Paskutinis atnaujinimas:</strong> {{ Auth::user()->updated_at->format('Y-m-d H:i') }}
                        </div>
                        <div class="mb-2">
                            <strong>Statusas:</strong>
                            @if(Auth::user()->is_active)
                            <span class="badge bg-success">Aktyvus</span>
                            @else
                            <span class="badge bg-danger">Neaktyvus</span>
                            @endif
                        </div>
                        @if(Auth::user()->birth_date)
                        <div class="mb-2">
                            <strong>Amžius:</strong> {{ Auth::user()->age }} metai
                        </div>
                        @endif
                    </div>
                </div>

                @if(Auth::user()->bio)
                <div class="mb-4">
                    <h5 class="mb-3">Apie mane</h5>
                    <p class="text-muted">{{ Auth::user()->bio }}</p>
                </div>
                @endif

                <div class="row">
                    <div class="col-md-4">
                        <div class="stat-card">
                            <i class="fas fa-calendar-check fa-2x text-primary mb-2"></i>
                            <h4>{{ $registrationCount ?? 0 }}</h4>
                            <p class="text-muted mb-0">Registracijos</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card">
                            <i class="fas fa-clock fa-2x text-success mb-2"></i>
                            <h4>{{ Auth::user()->created_at->diffInDays(now()) }}</h4>
                            <p class="text-muted mb-0">Dienų sistemoje</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card">
                            <i class="fas fa-star fa-2x text-warning mb-2"></i>
                            <h4>Naujokas</h4>
                            <p class="text-muted mb-0">Lygis</p>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <h5 class="mb-3">Greiti veiksmai</h5>
                    <div class="btn-group" role="group">
                        <a href="{{ route('conferences.index') }}" class="btn btn-primary">
                            <i class="fas fa-list me-2"></i>Konferencijos
                        </a>
                        <button class="btn btn-outline-secondary" disabled>
                            <i class="fas fa-edit me-2"></i>Redaguoti profilį
                        </button>
                        <button class="btn btn-outline-info" disabled>
                            <i class="fas fa-download me-2"></i>Atsisiųsti duomenis
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

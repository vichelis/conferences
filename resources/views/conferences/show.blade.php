@extends('layouts.app')

@section('title', $conference['title'])
@section('navbar-brand', 'Konferencijos')
@section('navbar-brand-url', url('/'))
@section('navbar-class', 'navbar-client')

@section('navbar-links')
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/') }}">Pradžia</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('conferences.index') }}">Konferencijų sąrašas</a>
    </li>
@endsection

@push('styles')
    <style>
        .navbar-client {
            background: rgba(108, 123, 149, 0.9) !important;
        }

        .breadcrumb {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 10px;
        }

        .breadcrumb-item a {
            color: white;
        }

        .breadcrumb-item.active {
            color: rgba(255, 255, 255, 0.8);
        }

        .btn-primary {
            background: linear-gradient(45deg, #6c7b95, #8e9aaf);
            border: none;
        }

        .btn-success {
            background: linear-gradient(45deg, #7d8471, #a8b5a0);
            border: none;
        }
    </style>
@endpush

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('conferences.index') }}">Konferencijos</a></li>
                        <li class="breadcrumb-item active">{{ $conference['title'] }}</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title">{{ $conference['title'] }}</h1>
                        <p class="card-text">{{ $conference['description'] }}</p>

                        <h5 class="mt-4">Pranešėjai</h5>
                        @if($conference->speakers->count() > 0)
                            <ul class="list-group list-group-flush">
                                @foreach($conference->speakers as $speaker)
                                    <li class="list-group-item">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h6 class="mb-1">{{ $speaker->name }}</h6>
                                                @if($speaker->title)
                                                    <p class="mb-1 text-muted">{{ $speaker->title }}</p>
                                                @endif
                                                @if($speaker->bio)
                                                    <small class="text-muted">{{ $speaker->bio }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted">Pranešėjų informacija bus paskelbta vėliau.</p>
                        @endif

                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Konferencijos informacija</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Data:</strong> {{ $conference['date'] }}</p>
                        <p><strong>Laikas:</strong> {{ $conference['time'] }}</p>
                        <p><strong>Vieta:</strong> {{ $conference['location'] }}</p>
                        <p><strong>Adresas:</strong> {{ $conference['address'] }}</p>
                        <p><strong>Kaina:</strong> {{ $conference['price'] }}</p>
                        <p><strong>Vietų skaičius:</strong> {{ $conference['capacity'] }}</p>

                        <div class="d-grid gap-2 mt-3">
                            <button class="btn btn-outline-secondary">Pridėti į kalendorių</button>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5>Registracija</h5>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('conferences.register', $conference['id']) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Vardas, pavardė</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">El. paštas</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                       id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-success w-100">Registruotis</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

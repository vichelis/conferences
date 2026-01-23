<!-- conferences/resources/views/auth/login.blade.php -->
@extends('layouts.app')

@section('title', 'Prisijungimas')
@section('navbar-brand', 'Prisijungimas')
@section('navbar-brand-url', url('/'))
@section('navbar-class', 'navbar-client')

@section('navbar-links')
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/') }}">Pradžia</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('conferences.index') }}">Konferencijos</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('register') }}">Registruotis</a>
    </li>
@endsection

@push('styles')
    <style>
        .navbar-client {
            background: rgba(108, 123, 149, 0.9) !important;
        }
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
        }
        .btn-primary {
            background: linear-gradient(45deg, #6c7b95, #8e9aaf);
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
        }
    </style>
@endpush

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="login-card p-5">
                    <div class="text-center mb-4">
                        <h2 class="mb-3">Prisijungimas</h2>
                        <p class="text-muted">Prisijunkite prie savo paskyros</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">El. pašto adresas</label>
                            <input type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   id="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   required
                                   autofocus
                                   placeholder="vardas@example.com">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Slaptažodis</label>
                            <input type="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   id="password"
                                   name="password"
                                   required>
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">
                                Prisiminti mane
                            </label>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-sign-in-alt me-2"></i> Prisijungti
                            </button>
                        </div>
                    </form>

                    <div class="text-center mt-4">
                        <p class="text-muted">
                            Neturite paskyros?
                            <a href="{{ route('register') }}" class="text-decoration-none">Registruokitės čia</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

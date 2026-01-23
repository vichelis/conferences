@extends('layouts.app')

@section('title', 'Sukurti konferenciją')
@section('navbar-brand', 'Administratoriaus Panelė')
@section('navbar-brand-url', route('admin.dashboard'))
@section('navbar-class', 'navbar-admin')

@section('navbar-extra')
    <a class="nav-link me-3" href="{{ route('admin.conferences') }}">Konferencijos</a>
    <a class="nav-link me-3" href="{{ route('admin.dashboard') }}">Skydelis</a>
    <a class="nav-link me-3" href="{{ url('/') }}">Atgal į svetainę</a>
@endsection

@push('styles')
    <style>
        .navbar-admin {
            background: rgba(181, 131, 141, 0.9) !important;
        }

        .btn-primary {
            background: linear-gradient(45deg, #b5838d, #d4a574);
            border: none;
        }

        .btn-secondary {
            background: linear-gradient(45deg, #6c7b95, #8e9aaf);
            border: none;
        }
    </style>
@endpush

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h1 class="mb-4">Sukurti konferenciją</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5>Konferencijos informacija</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.conferences.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="title" class="form-label">Pavadinimas</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                       id="title" name="title" value="{{ old('title') }}" required>
                                @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="date" class="form-label">Data</label>
                                <input type="date" class="form-control @error('date') is-invalid @enderror"
                                       id="date" name="date" value="{{ old('date') }}" required>
                                @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="location" class="form-label">Vieta</label>
                                <input type="text" class="form-control @error('location') is-invalid @enderror"
                                       id="location" name="location" value="{{ old('location') }}" required>
                                @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Aprašymas</label>
                                <textarea class="form-control @error('description') is-invalid @enderror"
                                          id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                                @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">Sukurti konferenciją</button>
                                <a href="{{ route('admin.conferences') }}" class="btn btn-secondary">Atšaukti</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

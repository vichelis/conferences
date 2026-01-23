@extends('layouts.app')

@section('title', 'Darbuotojo skydelis')
@section('navbar-brand', 'Darbuotojo skydelis')
@section('navbar-brand-url', route('employee.dashboard'))
@section('navbar-class', 'navbar-employee')

@section('navbar-links')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('employee.conferences') }}">Konferencijos</a>
    </li>
@endsection

@section('navbar-extra')
    <a class="nav-link me-3" href="{{ url('/') }}">Atgal į svetainę</a>
@endsection

@push('styles')
    <style>
        .navbar-employee {
            background: rgba(125, 132, 113, 0.9) !important;
        }

        .btn-primary {
            background: linear-gradient(45deg, #7d8471, #a8b5a0);
            border: none;
        }

        .btn-info {
            background: linear-gradient(45deg, #6c7b95, #8e9aaf);
            border: none;
        }

        .bg-info {
            background: linear-gradient(45deg, #6c7b95, #8e9aaf) !important;
        }

        .bg-success {
            background: linear-gradient(45deg, #7d8471, #a8b5a0) !important;
        }

        .bg-warning {
            background: linear-gradient(45deg, #b5838d, #d4a574) !important;
        }
    </style>
@endpush

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h1 class="mb-4">Darbuotojo skydelis</h1>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card bg-info text-white">
                    <div class="card-body text-center">
                        <h5 class="card-title">Visos konferencijos</h5>
                        <h2>{{ $totalConferences }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-success text-white">
                    <div class="card-body text-center">
                        <h5 class="card-title">Planuojamos</h5>
                        <h2>{{ $upcomingConferences }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-warning text-white">
                    <div class="card-body text-center">
                        <h5 class="card-title">Registracijos</h5>
                        <h2>{{ $totalRegistrations }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Greiti veiksmai</h5>
                    </div>
                    <div class="card-body text-center">
                        <a href="{{ route('employee.conferences') }}" class="btn btn-primary me-2">Peržiūrėti konferencijas</a>
                        <button class="btn btn-info">Eksportuoti ataskaitas</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('title', 'Konferencijų sąrašas')
@section('navbar-brand', 'Konferencijos')
@section('navbar-brand-url', url('/'))
@section('navbar-class', 'navbar-client')

@section('navbar-links')
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/') }}">Pradžia</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="{{ route('conferences.index') }}">Konferencijų sąrašas</a>
    </li>
@endsection

@push('styles')
    <style>
        .navbar-client {
            background: rgba(108, 123, 149, 0.9) !important;
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
                <h1 class="mb-4">Konferencijų sąrašas</h1>
            </div>
        </div>

        <div class="row">
            @foreach($conferences as $conference)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $conference['title'] }}</h5>
                            <p class="card-text">
                                <strong>Data:</strong> {{ $conference['date'] }}<br>
                                <strong>Vieta:</strong> {{ $conference['location'] }}<br>
                                <small class="text-muted">{{ $conference['description'] }}</small>
                            </p>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('conferences.show', $conference['id']) }}" class="btn btn-primary btn-sm">Peržiūrėti</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('title', 'Konferencijų valdymas')
@section('navbar-brand', 'Administratoriaus Panelė')
@section('navbar-brand-url', route('admin.dashboard'))
@section('navbar-class', 'navbar-admin')
@section('showTime', true)

@section('navbar-extra')
    <a class="nav-link me-3" href="{{ route('admin.dashboard') }}">Skydelis</a>
    <a class="nav-link me-3" href="{{ url('/') }}">Atgal į svetainę</a>
@endsection

@push('styles')
    <style>
        .navbar-admin {
            background: rgba(181, 131, 141, 0.9) !important;
        }

        .btn-success {
            background: linear-gradient(45deg, #7d8471, #a8b5a0);
            border: none;
        }

        .btn-warning {
            background: linear-gradient(45deg, #d4a574, #b5838d);
            border: none;
        }

        .btn-danger {
            background: linear-gradient(45deg, #b5838d, #d4a574);
            border: none;
        }

        .table {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
        }

        .alert-success {
            background: rgba(125, 132, 113, 0.1);
            border: 1px solid rgba(125, 132, 113, 0.3);
            color: #7d8471;
        }
    </style>
@endpush

@section('content')
    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-12 d-flex justify-content-between align-items-center mb-4">
                <h1>Konferencijų valdymas</h1>
                <a href="{{ route('admin.conferences.create') }}" class="btn btn-success">Sukurti konferenciją</a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Pavadinimas</th>
                                <th>Data</th>
                                <th>Vieta</th>
                                <th>Veiksmai</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($conferences as $conference)
                                <tr>
                                    <td>{{ $conference['id'] }}</td>
                                    <td>{{ $conference['title'] }}</td>
                                    <td>{{ $conference['date'] }}</td>
                                    <td>{{ $conference['location'] }}</td>
                                    <td>
                                        <a href="{{ route('admin.conferences.edit', $conference['id']) }}" class="btn btn-sm btn-warning">Redaguoti</a>
                                        <form action="{{ route('admin.conferences.destroy', $conference['id']) }}" method="POST" class="d-inline"
                                              onsubmit="return confirm('Ar tikrai norite ištrinti?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Ištrinti</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

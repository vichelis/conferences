@extends('layouts.app')

@section('title', 'Naudotojų valdymas')
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

        .btn-warning {
            background: linear-gradient(45deg, #d4a574, #b5838d);
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
            <div class="col-12">
                <h1 class="mb-4">Naudotojų valdymas</h1>
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
                                <th>Vardas</th>
                                <th>El. paštas</th>
                                <th>Registracijos data</th>
                                <th>Veiksmai</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-warning">Redaguoti</a>
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

@extends('layouts.app')

@section('title', 'System Administrator')
@section('navbar-brand', 'Administratoriaus Panelė')
@section('navbar-brand-url', route('admin.dashboard'))
@section('navbar-class', 'navbar-admin')

@section('navbar-extra')
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

        .btn-info {
            background: linear-gradient(45deg, #6c7b95, #8e9aaf);
            border: none;
        }

        .bg-primary {
            background: linear-gradient(45deg, #b5838d, #d4a574) !important;
        }

        .bg-success {
            background: linear-gradient(45deg, #7d8471, #a8b5a0) !important;
        }

        .bg-warning {
            background: linear-gradient(45deg, #d4a574, #b5838d) !important;
        }

        .bg-info {
            background: linear-gradient(45deg, #6c7b95, #8e9aaf) !important;
        }

        .table {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
        }
    </style>
@endpush

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h1 class="mb-4">Administratoriaus tvarkyklė</h1>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center">
                        <h5>Administravimo meniu</h5>
                        <div class="btn-group" role="group">
                            <a href="{{ route('admin.conferences') }}" class="btn btn-primary">Konferencijų valdymas</a>
                            <a href="{{ route('admin.users') }}" class="btn btn-info">Naudotojų valdymas</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body text-center">
                        <h5 class="card-title">Iš viso vartotojų</h5>
                        <h2>{{ $totalUsers }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body text-center">
                        <h5 class="card-title">Aktyvios sesijos</h5>
                        <h2>24</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-white">
                    <div class="card-body text-center">
                        <h5 class="card-title">Sistemos apkrova</h5>
                        <h2>45%</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info text-white">
                    <div class="card-body text-center">
                        <h5 class="card-title">Vietos užimtumas</h5>
                        <h2>2.1GB</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Paskutiniai vartotojai</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Vardas</th>
                                <th>Email</th>
                                <th>Sukurta</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($recentUsers as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at->format('M d, Y') }}</td>
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

@push('scripts')
    <script>
    </script>
@endpush

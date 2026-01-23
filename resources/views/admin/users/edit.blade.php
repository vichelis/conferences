@extends('layouts.app')

@section('title', 'Redaguoti naudotoją')
@section('navbar-brand', 'Administratoriaus panelė')
@section('navbar-brand-url', route('admin.dashboard'))
@section('navbar-class', 'navbar-admin')

@section('navbar-extra')
    <a class="nav-link me-3" href="{{ route('admin.users') }}">Naudotojai</a>
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

        .alert-success {
            background: rgba(125, 132, 113, 0.1);
            border: 1px solid rgba(125, 132, 113, 0.3);
            color: #7d8471;
        }
    </style>
@endpush

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h1 class="mb-4">Redaguoti naudotoją</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5>Naudotojo informacija</h5>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">Vardas ir pavardė</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">El. pašto adresas</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                       id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Registracijos data</label>
                                <input type="text" class="form-control" value="{{ $user->created_at->format('Y-m-d H:i:s') }}" readonly>
                                <div class="form-text">Šis laukas neredaguojamas</div>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">Atnaujinti naudotoją</button>
                                <a href="{{ route('admin.users') }}" class="btn btn-secondary">Atšaukti</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Naudotojo statistika</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <strong>Naudotojo ID:</strong><br>
                            <span class="text-muted">#{{ $user->id }}</span>
                        </div>

                        <div class="mb-3">
                            <strong>Paskutinis atnaujinimas:</strong><br>
                            <span class="text-muted">{{ $user->updated_at->format('Y-m-d H:i:s') }}</span>
                        </div>

                        <div class="mb-3">
                            <strong>Statusas:</strong><br>
                            <span class="badge bg-success">Aktyvus</span>
                        </div>

                        <hr>

                        <div class="d-grid">
                            <button class="btn btn-outline-secondary btn-sm" disabled>
                                Papildomi veiksmai
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

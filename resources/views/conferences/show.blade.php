<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $conference['title'] }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">Conferences</a>
        <div class="navbar-nav ms-auto">
            <a class="nav-link" href="{{ url('/') }}">Pradžia</a>
            <a class="nav-link" href="{{ route('conferences.index') }}">Konferencijų sąrašas</a>
        </div>
    </div>
</nav>

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
                    <ul class="list-group list-group-flush">
                        @foreach($conference['speakers'] as $speaker)
                            <li class="list-group-item">{{ $speaker }}</li>
                        @endforeach
                    </ul>
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
                        <button class="btn btn-primary">Registruotis</button>
                        <button class="btn btn-outline-secondary">Pridėti į kalendorių</button>
                    </div>
                </div>
            </div>
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


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

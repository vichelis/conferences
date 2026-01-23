<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Konferencijų sąrašas</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">Conferences</a>
        <div class="navbar-nav ms-auto">
            <a class="nav-link" href="{{ url('/') }}">Pradžia</a>
            <a class="nav-link active" href="{{ route('conferences.index') }}">Konferencijų sąrašas</a>
        </div>
    </div>
</nav>

<div class="row">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <h1 class="mb-4">Konferencijų sąrašas</h1>
        <a href="{{ route('conferences.create') }}" class="btn btn-success">Sukurti konferenciją</a>
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
                        <button class="btn btn-primary btn-sm">Registruotis</button>
                        <a href="{{ route('conferences.show', $conference['id']) }}" class="btn btn-outline-secondary btn-sm">Daugiau info</a>
                        <a href="{{ route('conferences.edit', $conference['id']) }}" class="btn btn-warning btn-sm">Redaguoti</a>
                        <form action="{{ route('conferences.destroy', $conference['id']) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Ar tikrai norite ištrinti šią konferenciją?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Ištrinti</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

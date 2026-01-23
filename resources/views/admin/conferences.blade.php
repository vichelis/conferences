<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Konferencijų valdymas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Admin Panel</a>
        <div class="navbar-nav ms-auto">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a class="nav-link" href="{{ url('/') }}">Atgal į svetainę</a>
        </div>
    </div>
</nav>

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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

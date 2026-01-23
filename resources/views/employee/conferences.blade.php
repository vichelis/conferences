<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Konferencijų sąrašas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="{{ route('employee.dashboard') }}">Darbuotojo skydelis</a>
        <div class="navbar-nav ms-auto">
            <a class="nav-link" href="{{ route('employee.dashboard') }}">Dashboard</a>
            <a class="nav-link" href="{{ url('/') }}">Atgal į svetainę</a>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Konferencijų sąrašas</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Pavadinimas</th>
                            <th>Data</th>
                            <th>Vieta</th>
                            <th>Statusas</th>
                            <th>Registracijos</th>
                            <th>Veiksmai</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($conferences as $conference)
                            <tr>
                                <td>{{ $conference['title'] }}</td>
                                <td>{{ $conference['date'] }}</td>
                                <td>{{ $conference['location'] }}</td>
                                <td>
                                    @if($conference['status'] == 'upcoming')
                                        <span class="badge bg-success">Planuojama</span>
                                    @else
                                        <span class="badge bg-secondary">Įvykusi</span>
                                    @endif
                                </td>
                                <td>{{ $conference['registrations_count'] }}</td>
                                <td>
                                    <a href="{{ route('employee.conferences.show', $conference['id']) }}" class="btn btn-sm btn-info">Peržiūrėti</a>
                                    <a href="{{ route('employee.conferences.registrations', $conference['id']) }}" class="btn btn-sm btn-primary">Registracijos</a>
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

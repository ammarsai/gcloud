@extends('layouts.app')
<!-- Add this in the <head> section of your layout (app.blade.php) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
@section('content')
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Keycloak User Information</h2>
        <table class="table table-bordered table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Key</th>
                    <th>Value</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($keycloakData as $key => $value)
                    <tr>
                        <td>{{ htmlspecialchars($key) }}</td>
                        <td>{{ htmlspecialchars($value) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

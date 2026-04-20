<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Libros - Biblioteca CIAF</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .container { margin-top: 50px; }
        .card { border: none; box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15); }
        .table thead { background-color: #2563eb; color: white; }
    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-primary mb-4">
    <div class="container-fluid">
        <span class="navbar-brand mb-0 h1">Gestión de Biblioteca</span>
        <form action="/logout" method="POST" class="d-flex">
            @csrf
            <button class="btn btn-outline-light btn-sm" type="submit">Cerrar Sesión</button>
        </form>
    </div>
</nav>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Inventario de Libros</h2>
        <div>
            <a href="{{ route('libros.create') }}" class="btn btn-success">+ Nuevo Libro</a>
            <a href="{{ route('prestamos.create') }}" class="btn btn-info text-white">Realizar Préstamo</a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Tabla de Inventario Mejorada --}}
    <div class="card p-4 mb-5">
        <table class="table table-hover text-center">
            <thead>
                <tr>
                    <th class="text-start">Título</th>
                    <th>Stock Total</th>
                    <th>Prestados</th>
                    <th>Disponibles</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($libros as $libro)
                    @php
                        // Cálculo matemático en tiempo real
                        $disponibles = $libro->cantidad - $libro->prestados;
                    @endphp
                    <tr>
                        <td class="text-start">
                            <strong>{{ $libro->titulo }}</strong><br>
                            <small class="text-muted">{{ $libro->autor }}</small>
                        </td>
                        <td><span class="badge bg-secondary">{{ $libro->cantidad }}</span></td>
                        <td><span class="badge bg-warning text-dark">{{ $libro->prestados }}</span></td>
                        <td>
                            <span class="badge {{ $disponibles > 0 ? 'bg-success' : 'bg-danger' }}">
                                {{ $disponibles }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('libros.edit', $libro->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('libros.destroy', $libro->id) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm">Borrar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">No hay libros registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Sección de Préstamos Activos --}}
    <div class="mt-5">
        <h3 class="text-primary mb-3"> Préstamos en Curso</h3>
        <div class="card p-4">
            <table class="table table-sm">
                <thead class="table-dark">
                    <tr>
                        <th>Libro</th>
                        <th>Usuario</th>
                        <th>Fecha</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($prestamosActivos as $p)
                        <tr>
                            <td>{{ $p->libro->titulo }}</td>
                            <td>{{ $p->user->name }}</td>
                            <td>{{ $p->created_at->format('d/m/Y') }}</td>
                            <td>
                                <form action="{{ route('prestamos.devolver', $p->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-sm">Devolver</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-3">No hay préstamos activos.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
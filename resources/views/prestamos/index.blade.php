<div class="card p-4 shadow">
    <h3>Préstamos Activos</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Libro</th>
                <th>Usuario</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            @foreach($prestamos as $prestamo)
                <tr>
                    <td>{{ $prestamo->libro->titulo }} ✅</td>
                    <td>{{ $prestamo->user->name }} 👤</td>
                    <td>
                        @if($prestamo->estado == 'prestado')
                            <form action="{{ route('prestamos.devolver', $prestamo->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Devolver Libro 🔄</button>
                            </form>
                        @else
                            <span class="badge bg-secondary">Devuelto ✔️</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
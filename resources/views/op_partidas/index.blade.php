<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Llista Partides</title>
</head>
<body>
    <h1>Partides</h1>

    <p><a href="{{ route('op_partides.create') }}">Crear Partida</a></p>

    @if(session('success'))
        <div style="color:green;">{{ session('success') }}</div>
    @endif

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Partida</th>
                <th>Descripció</th>
                <th>Responsable</th>
                <th>Accions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($partides as $partida)
            <tr>
                <td>{{ $partida->partida }}</td>
                <td>{{ $partida->descripcio }}</td>
                <td>{{ $partida->responsable->nom ?? '' }}</td>
                <td>
                    <a href="{{ route('op_partides.edit', $partida) }}">Editar</a>
                    <form action="{{ route('op_partides.destroy', $partida) }}" method="POST" style="display:inline;" onsubmit="return confirm('Segur?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background:none;border:none;color:red;cursor:pointer;">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top:10px;">
        {{ $partides->links() }}
    </div>

    <p><a href="{{ url('/') }}">Tornar a l'inici</a></p>
</body>
</html>

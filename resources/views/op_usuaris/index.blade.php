<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Llista Usuaris</title>
</head>
<body>
    <h1>Usuaris</h1>

    <p><a href="{{ route('op_usuaris.create') }}">Crear Usuari</a></p>

    @if(session('success'))
        <div style="color:green;">{{ session('success') }}</div>
    @endif

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Accions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuaris as $usuari)
            <tr>
                <td>{{ $usuari->id }}</td>
                <td>{{ $usuari->nom }}</td>
                <td>
                    <a href="{{ route('op_usuaris.edit', $usuari) }}">Editar</a>
                    <form action="{{ route('op_usuaris.destroy', $usuari) }}" method="POST" style="display:inline;" onsubmit="return confirm('Segur?');">
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
        {{ $usuaris->links() }}
    </div>

    <p><a href="{{ url('/') }}">Tornar a l'inici</a></p>
</body>
</html>

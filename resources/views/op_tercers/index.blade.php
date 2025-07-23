<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Llista Tercers</title>
</head>
<body>
    <h1>Tercers</h1>

    <p><a href="{{ route('op_tercers.create') }}">Crear Tercer</a></p>

    @if(session('success'))
        <div style="color:green;">{{ session('success') }}</div>
    @endif

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Document</th>
                <th>Nom</th>
                <th>Adreça</th>
                <th>Població</th>
                <th>Codi Postal</th>
                <th>Provincia</th>
                <th>Telèfon</th>
                <th>Fax</th>
                <th>DCE</th>
                <th>Accions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tercers as $tercer)
            <tr>
                <td>{{ $tercer->ter_doc }}</td>
                <td>{{ $tercer->ter_nom }}</td>
                <td>{{ $tercer->ter_dom }}</td>
                <td>{{ $tercer->ter_pob }}</td>
                <td>{{ $tercer->ter_cpo }}</td>
                <td>{{ $tercer->ter_pro }}</td>
                <td>{{ $tercer->ter_tlf }}</td>
                <td>{{ $tercer->ter_fax }}</td>
                <td>{{ $tercer->ter_dce }}</td>
                <td>
                    <a href="{{ route('op_tercers.edit', $tercer) }}">Editar</a>
                    <form action="{{ route('op_tercers.destroy', $tercer) }}" method="POST" style="display:inline;" onsubmit="return confirm('Segur?');">
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
        {{ $tercers->links() }}
    </div>

    <p><a href="{{ url('/') }}">Tornar a l'inici</a></p>
</body>
</html>

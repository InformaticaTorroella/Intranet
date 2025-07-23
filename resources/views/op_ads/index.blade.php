<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Registres AD</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        form { display: inline; }
        div.message { margin: 10px 0; padding: 10px; background: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 4px; }
    </style>
</head>
<body>
    <h1>Registres AD</h1>

    <p><a href="{{ route('ads.create') }}">Crear nou registre</a></p>

    @if(session('success'))
        <div class="message">{{ session('success') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Data</th>
                <th>Responsable</th>
                <th>Partida</th>
                <th>Descripció Partida</th>
                <th>Import Reserva</th>
                <th>Exp. Sedipualba</th>
                <th>Concepte Despesa</th>
                <th>CIF</th>
                <th>Proveïdor</th>
                <th>RC</th>
                <th>Accions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ads as $ad)
                <tr>
                    <td>{{ $ad->id }}</td>
                    <td>{{ $ad->data }}</td>
                    <td>{{ $ad->responsable->nom ?? '' }}</td>
                    <td>{{ $ad->partida }}</td>
                    <td>{{ $ad->partidaRel->descripcio ?? '' }}</td>
                    <td>{{ number_format($ad->import_reserva, 2, ',', '.') }}</td>
                    <td>{{ $ad->exp_sedipualba }}</td>
                    <td>{{ $ad->concepte_despesa }}</td>
                    <td>{{ $ad->cif }}</td>
                    <td>{{ $ad->tercer->ter_nom ?? '' }}</td>
                    <td>{{ $ad->rc }}</td>
                    <td>
                        <a href="{{ route('ads.edit', $ad) }}">Editar</a>
                        <form action="{{ route('ads.destroy', $ad) }}" method="POST" onsubmit="return confirm('Segur que vols eliminar?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background:none;border:none;color:#007BFF;cursor:pointer;padding:0;">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top:20px;">
        {{ $ads->links() }}
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Registres AD</title>
    <link rel="icon" href="{{ asset('images/Escut_Transparent.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/op.css') }}">
   
</head>
<body>
  <x-header />

  <div class="container">
    <h1 class="page-title">Registres AD</h1>

    <div class="actions mb-4">
      <a class="btn btn-primary" href="{{ route('op_ads.create') }}">+ Nou registre</a>
      <a class="btn btn-warning" href="{{ route('op_partides.index') }}">+ Veure Parides</a>
      <a class="btn btn-warning" href="{{ route('op_tercers.index') }}">+ Veure Tercer</a>
      <a class="btn btn-warning" href="{{ route('op_usuaris.index') }}">+ Veure Usuaris</a>
    </div>

    @if(session('success'))
      <div class="message">{{ session('success') }}</div>
    @endif

    <table class="table" aria-label="Taula de registres">
      <thead>
        <tr>
          <th class="table-header">ID</th>
          <th class="table-header">Data</th>
          <th class="table-header">Responsable</th>
          <th class="table-header">Partida</th>
          <th class="table-header">Descripció</th>
          <th class="table-header">Import</th>
          <th class="table-header">Sedipualba</th>
          <th class="table-header">Despesa</th>
          <th class="table-header">CIF</th>
          <th class="table-header">Proveïdor</th>
          <th class="table-header">RC</th>
          <th class="table-header">Accions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($ads as $ad)
        <tr>
          <td class="table-cell">{{ $ad->id }}</td>
          <td class="table-cell">{{ $ad->data }}</td>
          <td class="table-cell">{{ $ad->responsable->nom ?? '' }}</td>
          <td class="table-cell">{{ $ad->partida }}</td>
          <td class="table-cell">{{ $ad->partidaRel->descripcio ?? '' }}</td>
          <td class="table-cell">{{ number_format($ad->import_reserva, 2, ',', '.') }}</td>
          <td class="table-cell">{{ $ad->exp_sedipualba }}</td>
          <td class="table-cell">{{ $ad->concepte_despesa }}</td>
          <td class="table-cell">{{ $ad->cif }}</td>
          <td class="table-cell">{{ $ad->tercer->ter_nom ?? '' }}</td>
          <td class="table-cell">{{ $ad->rc }}</td>
          <td class="table-cell">
            <div class="btn-group">
              <a class="btn btn-warning" href="{{ route('op_ads.edit', $ad) }}">Editar</a>
              <form class="inline-form" action="{{ route('op_ads.destroy', $ad) }}" method="POST" onsubmit="return confirm('Segur que vols eliminar?');">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit">Eliminar</button>
              </form>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <div style="margin-top: 20px;">
      {{ $ads->links() }}
    </div>
  </div>
  <x-footer />
</body>
</html>
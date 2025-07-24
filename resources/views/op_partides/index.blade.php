<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Llista Partides</title>
    <link rel="icon" href="{{ asset('images/Escut_Transparent.png') }}" type="image/png">
  <link rel="stylesheet" href="{{ asset('css/pagination.css') }}">
    <link rel="stylesheet" href="{{ asset('css/op.css') }}">
</head>
<body>
  <x-header />
  @php
      $userGroups = session('user_groups', []);
      $hasAccess = session()->has('username') && (in_array('Intranet_Operacions', $userGroups) || in_array('Intranet_Administracio', $userGroups));
  @endphp
  <div class="container">
    <h1 class="page-title">Partides</h1>

    @if($hasAccess)
    <p><a href="{{ route('op_partides.create') }}" class="btn btn-primary">Crear Partida</a></p>
    @endif
    <table class="table" aria-label="Taula de partides">
      <thead>
        <tr>
          <th class="table-header">Partida</th>
          <th class="table-header">Descripció</th>
          <th class="table-header">Responsable</th>
          @if($hasAccess)
            <th class="table-header">Accions</th>
          @endif
        </tr>
      </thead>
      <tbody>
        @foreach($partides as $partida)
        <tr>
          <td class="table-cell">{{ $partida->partida }}</td>
          <td class="table-cell">{{ $partida->descripcio }}</td>
          <td class="table-cell">{{ $partida->responsable->nom ?? '' }}</td>
          <td class="table-cell">
            <div class="btn-group">
              @if($hasAccess)
                <a href="{{ route('op_partides.edit', $partida) }}" class="btn btn-warning">Editar</a>
                <form action="{{ route('op_partides.destroy', $partida) }}" method="POST" class="inline-form" onsubmit="return confirm('Segur?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
              @endif
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <div style="margin-top:10px;">
      {{ $partides->links() }}
    </div>

    <p><a href="{{ route('op_ads.index') }}" class="back-link">Tornar enrere</a></p>
  </div>
  <x-footer />
</body>
</html>

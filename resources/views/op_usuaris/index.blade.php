<!DOCTYPE html>
<html lang="ca">
<head>
  <meta charset="UTF-8">
  <title>Llista Usuaris</title>
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
    <h1 class="page-title">Usuaris</h1>
    @if($hasAccess)
      <a href="{{ route('op_usuaris.create') }}" class="btn btn-primary">Crear Usuari</a>
    @endif


    <table class="table">
      <thead>
        <tr>
          <th class="table-header">ID</th>
          <th class="table-header">Nom</th>
          @if($hasAccess)
            <th class="table-header">Accions</th>
          @endif
        </tr>
      </thead>
      <tbody>
        @foreach($usuaris as $usuari)
        <tr>
          <td class="table-cell">{{ $usuari->id }}</td>
          <td class="table-cell">{{ $usuari->nom }}</td>
          @if($hasAccess)
            <td class="table-cell">
              <div class="btn-group">
                <a href="{{ route('op_usuaris.edit', $usuari) }}" class="btn-warning">Editar</a>
                <form action="{{ route('op_usuaris.destroy', $usuari) }}" method="POST" class="inline-form" onsubmit="return confirm('Segur?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn-danger">Eliminar</button>
                </form>
              </div>
            </td>
          @endif
        </tr>
        @endforeach
      </tbody>
    </table>

    <div class="pagination">
      {{ $usuaris->links() }}
    </div>

    <a href="{{ route('op_ads.index') }}" class="back-link">Tornar enrere</a>
  </div>
  <x-footer />
</body>
</html>

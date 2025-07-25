<!DOCTYPE html>
<html lang="ca">
<head>
  <meta charset="UTF-8">
  <title>Llista Tercers</title>
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
    <h1 class="page-title">Tercers</h1>
    @if($hasAccess)
      <a href="{{ route('op_tercers.create') }}" class="btn btn-primary">Crear Tercer</a>
    @endif
    <table class="table">
      <thead>
        <tr>
          <th class="table-header">Document</th>
          <th class="table-header">Nom</th>
          <th class="table-header">Adreça</th>
          <th class="table-header">Població</th>
          <th class="table-header">Codi Postal</th>
          <th class="table-header">Provincia</th>
          <th class="table-header">Telèfon</th>
          <th class="table-header">Fax</th>
          <th class="table-header">DCE</th>
          @if($hasAccess)
            <th class="table-header">Accions</th>
          @endif
        </tr>
      </thead>
      <tbody>
        @foreach($tercers as $tercer)
        <tr>
          <td class="table-cell">{{ $tercer->ter_doc }}</td>
          <td class="table-cell">{{ $tercer->ter_nom }}</td>
          <td class="table-cell">{{ $tercer->ter_dom }}</td>
          <td class="table-cell">{{ $tercer->ter_pob }}</td>
          <td class="table-cell">{{ $tercer->ter_cpo }}</td>
          <td class="table-cell">{{ $tercer->ter_pro }}</td>
          <td class="table-cell">{{ $tercer->ter_tlf }}</td>
          <td class="table-cell">{{ $tercer->ter_fax }}</td>
          <td class="table-cell">{{ $tercer->ter_dce }}</td>
          @if($hasAccess)
            <td class="table-cell">
              <div class="btn-group">
                <a href="{{ route('op_tercers.edit', $tercer) }}" class="btn-warning">Editar</a>
                <form action="{{ route('op_tercers.destroy', $tercer) }}" method="POST" class="inline-form" onsubmit="return confirm('Segur?');">
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
      {{ $tercers->links() }}
    </div>

    <a href="{{ route('op_ads.index') }}" class="back-link">Tornar enrere</a>
  </div>
  <x-footer />
</body>
</html>

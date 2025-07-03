<!DOCTYPE html>
<html lang="ca">
<head>
  <meta charset="UTF-8" />
  <title>Seccions - Llista</title>
  <link rel="stylesheet" href="{{ asset('css/quadres.css') }}">
</head>
<body>
<x-header />

<div class="container">
  <h1 class="page-title">Llista de Seccions</h1>

  <a href="{{ route('seccions.create') }}" class="btn btn-primary">Nova Secció</a>

  <table class="table">
    <thead>
      <tr>
        <th class="table-header">ID</th>
        <th class="table-header">Secció</th>
        <th class="table-header">Accions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($seccions as $seccio)
      <tr>
        <td class="table-cell">{{ $seccio->id_seccio }}</td>
        <td class="table-cell">{{ $seccio->seccio }}</td>
        <td class="table-cell">
          <div class="btn-group">
            <a href="{{ route('seccions.edit', $seccio) }}" class="btn btn-warning">Editar</a>
            <form action="{{ route('seccions.destroy', $seccio) }}" method="POST" class="inline-form" onsubmit="return confirm('Segur que vols eliminar?')">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
          </div>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

</body>
</html>

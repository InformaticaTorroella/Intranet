<!DOCTYPE html>
<html lang="ca">
<head>
  <meta charset="UTF-8" />
  <title>Tipologies GIAL - Llista</title>
  <link rel="stylesheet" href="{{ asset('css/quadres.css') }}">
</head>
<body>
<x-header />

<div class="container">
  <h1 class="page-title">Llista de Tipologies GIAL</h1>

  <a href="{{ route('tipologies-gial.create') }}" class="btn btn-primary">Nova Tipologia</a>

  <table class="table">
    <thead>
      <tr>
        <th class="table-header">ID</th>
        <th class="table-header">Codi</th>
        <th class="table-header">Accions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($tipologies as $tipologia)
      <tr>
        <td class="table-cell">{{ $tipologia->id }}</td>
        <td class="table-cell">{{ $tipologia->codi }}</td>
        <td class="table-cell">
          <div class="btn-group">
            <a href="{{ route('tipologies-gial.edit', $tipologia) }}" class="btn btn-warning">Editar</a>
            <form action="{{ route('tipologies-gial.destroy', $tipologia) }}" method="POST" class="inline-form" onsubmit="return confirm('Segur que vols eliminar?')">
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

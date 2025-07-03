<!DOCTYPE html>
<html lang="ca">
<head>
  <meta charset="UTF-8" />
  <title>Series - Llista</title>
  <link rel="stylesheet" href="{{ asset('css/quadres.css') }}">
</head>
<body>
<x-header />

<div class="container">
  <h1 class="page-title">Llista de Series</h1>

  <a href="{{ route('series.create') }}" class="btn btn-primary">Nova Sèrie</a>

  <table class="table">
    <thead>
      <tr>
        <th class="table-header">ID</th>
        <th class="table-header">Sèrie</th>
        <th class="table-header">Subsecció</th>
        <th class="table-header">Accions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($series as $serie)
      <tr>
        <td class="table-cell">{{ $serie->id_serie }}</td>
        <td class="table-cell">{{ $serie->serie }}</td>
        <td class="table-cell">{{ $serie->subseccio->subseccio ?? '-' }}</td>
        <td class="table-cell">
          <div class="btn-group">
            <a href="{{ route('series.edit', $serie) }}" class="btn btn-warning">Editar</a>
            <form action="{{ route('series.destroy', $serie) }}" method="POST" class="inline-form" onsubmit="return confirm('Segur que vols eliminar?')">
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

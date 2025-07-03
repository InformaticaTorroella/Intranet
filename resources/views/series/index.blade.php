<!DOCTYPE html>
<html lang="ca">
<head>
  <meta charset="UTF-8" />
  <title>Series</title>
  <link rel="icon" href="{{ asset('images/Escut_Transparent.png') }}" type="image/png">
  <link rel="stylesheet" href="{{ asset('css/quadres.css') }}">
</head>
<body>
<x-header />

<div class="container">
  <h1 class="page-title">Llista de Series</h1>

  <a href="{{ route('series.create') }}" class="btn btn-primary">Nova Sèrie</a>
  <form id="filter-form" method="GET" action="{{ route('series.index') }}">
    <input 
      type="text" 
      name="serie" 
      id="serieInput" 
      placeholder="Filtrar per Sèrie" 
      value="{{ request('serie') }}" 
      class="search-input" 
      onkeydown="if(event.key === 'Enter') this.form.submit()"
    >

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
              <a href="{{ route('quadres.index') }}" class="btn btn-primary" style="margin-top: 10px;">Tornar</a>

</div>
<x-footer />
</body>
</html>

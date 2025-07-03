<!DOCTYPE html>
<html lang="ca">
<head>
  <meta charset="UTF-8" />
  <title>Quadre de Classificacions</title>
  <link rel="icon" href="{{ asset('images/Escut_Transparent.png') }}" type="image/png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/quadres.css') }}" />
</head>
<body>
<x-header />
<main>
  @php
      $userGroups = session('user_groups', []);
  @endphp
<div class="container">
  <h1 class="page-title">Quadres</h1>
  <a href="{{ route('quadres.create') }}" class="btn btn-primary mb-4">Crear Nou Quadre</a>
  <a href="{{ route('seccions.create') }}" class="btn btn-primary mb-4">Crear Nova Seccio</a>
  <a href="{{ route('subseccions.create') }}" class="btn btn-primary mb-4">Crear Nova Subseccio</a>
  <a href="{{ route('series.create') }}" class="btn btn-primary mb-4">Crear Nova Serie</a>
  <a href="{{ route('tipologies-gial.create') }}" class="btn btn-primary mb-4">Crear Nova Tipologia GIAL</a>

  <table class="table">
    <thead>
      <tr>
        <th class="table-header">Secció</th>
        <th class="table-header">Subsecció</th>
        <th class="table-header">Sèrie</th>
        <th class="table-header">Tipologies GIAL</th>
        <th class="table-header">Accions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($quadres as $quadre)
      <tr class="table-row">
        <td class="table-cell">{{ $quadre->seccio->seccio }}</td>
        <td class="table-cell">{{ $quadre->subseccio->subseccio }}</td>
        <td class="table-cell">{{ $quadre->serie->serie }}</td>
        <td class="table-cell">
          @foreach($quadre->tipologies as $tipologia)
          <span class="tag">{{ $tipologia->codi }}</span>
          @endforeach
        </td>
        <td class="table-cell">
          <a href="{{ route('quadres.edit', $quadre) }}" class="btn btn-sm btn-warning">Editar</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
</main>
<x-footer />

</body>
</html>

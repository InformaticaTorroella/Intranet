<!DOCTYPE html>
<html lang="ca">
<head>
  <meta charset="UTF-8" />
  <title>Editar Sèrie</title>
  <link rel="icon" href="{{ asset('images/Escut_Transparent.png') }}" type="image/png">
  <link rel="stylesheet" href="{{ asset('css/quadres.css') }}">
</head>
<body>
<x-header />

<div class="container">
  <h1 class="page-title">Editar Sèrie</h1>

  <form action="{{ route('series.update', $serie) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-4">
      <label for="serie">Nom de la Sèrie</label>
      <input type="text" name="serie" id="serie" class="form-select" value="{{ old('serie', $serie->serie) }}" required>
    </div>

    <div class="mb-4">
      <label for="fk_id_subseccio">Subsecció</label>
      <select name="fk_id_subseccio" id="fk_id_subseccio" class="form-select" required>
        @foreach($subseccions as $subseccio)
          <option value="{{ $subseccio->id_subseccio }}" {{ $serie->fk_id_subseccio == $subseccio->id_subseccio ? 'selected' : '' }}>{{ $subseccio->subseccio }}</option>
        @endforeach
      </select>
    </div>

    <button type="submit" class="btn btn-primary">Actualitzar</button>
    <a href="{{ route('series.index') }}" class="btn btn-warning" style="margin-left: 0.5rem;">Cancel·lar</a>
  </form>
</div>
<x-footer />
</body>
</html>

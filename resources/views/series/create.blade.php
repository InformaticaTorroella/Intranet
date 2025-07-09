<!DOCTYPE html>
<html lang="ca">
<head>
  <meta charset="UTF-8" />
  <title>Nova Sèrie</title>
  <link rel="icon" href="{{ asset('images/Escut_Transparent.png') }}" type="image/png">
  <link rel="stylesheet" href="{{ asset('css/quadres.css') }}">
</head>
<body>
<x-header />

<div class="container">
  <h1 class="page-title">Crear Nova Sèrie</h1>

  <form action="{{ route('series.store') }}" method="POST">
    @csrf
    <div class="mb-4">
      <label for="id_serie">Id Sèrie</label>
      <input type="text" name="id_serie" id="id_serie" class="form-select" required>
    </div>
    <div class="mb-4">
      <label for="serie">Nom de la Sèrie</label>
      <input type="text" name="serie" id="serie" class="form-select" required>
    </div>

    <div class="mb-4">
      <label for="fk_id_subseccio">Subsecció</label>
      <select name="fk_id_subseccio" id="fk_id_subseccio" class="form-select" required>
        <option value="" disabled selected>Selecciona una subsecció</option>
        @foreach($subseccions as $subseccio)
          <option value="{{ $subseccio->id_subseccio }}">{{ $subseccio->subseccio }}</option>
        @endforeach
      </select>
    </div>

    <button type="submit" class="btn btn-primary">Crear</button>
    <a href="{{ route('series.index') }}" class="btn btn-warning" style="margin-left: 0.5rem;">Cancel·lar</a>
  </form>
</div>
<x-footer />
</body>
</html>

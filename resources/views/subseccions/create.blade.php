<!DOCTYPE html>
<html lang="ca">
<head>
  <meta charset="UTF-8" />
  <title>Nova Subsecció</title>
  <link rel="stylesheet" href="{{ asset('css/quadres.css') }}">
</head>
<body>
<x-header />

<div class="container">
  <h1 class="page-title">Crear Nova Subsecció</h1>

  <form action="{{ route('subseccions.store') }}" method="POST">
    @csrf
    <div class="mb-4">
      <label for="subseccio">Nom de la Subsecció</label>
      <input type="text" name="subseccio" id="subseccio" class="form-select" required>
    </div>

    <div class="mb-4">
      <label for="fk_id_seccio">Secció</label>
      <select name="fk_id_seccio" id="fk_id_seccio" class="form-select" required>
        <option value="" disabled selected>Selecciona una secció</option>
        @foreach($seccions as $seccio)
          <option value="{{ $seccio->id_seccio }}">{{ $seccio->seccio }}</option>
        @endforeach
      </select>
    </div>

    <button type="submit" class="btn btn-primary">Crear</button>
    <a href="{{ route('subseccions.index') }}" class="btn btn-warning" style="margin-left: 0.5rem;">Cancel·lar</a>
  </form>
</div>

</body>
</html>

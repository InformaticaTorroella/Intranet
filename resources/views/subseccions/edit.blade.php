<!DOCTYPE html>
<html lang="ca">
<head>
  <meta charset="UTF-8" />
  <title>Editar Subsecció</title>
  <link rel="icon" href="{{ asset('images/Escut_Transparent.png') }}" type="image/png">
  <link rel="stylesheet" href="{{ asset('css/quadres.css') }}">
</head>
<body>
<x-header />

<div class="container">
  <h1 class="page-title">Editar Subsecció</h1>

  <form action="{{ route('subseccions.update', $subseccio) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-4">
      <label for="subseccio">Nom de la Subsecció</label>
      <input type="text" name="subseccio" id="subseccio" class="form-select" value="{{ old('subseccio', $subseccio->subseccio) }}" required>
    </div>

    <div class="mb-4">
      <label for="fk_id_seccio">Secció</label>
      <select name="fk_id_seccio" id="fk_id_seccio" class="form-select" required>
        @foreach($seccions as $seccio)
          <option value="{{ $seccio->id_seccio }}" {{ $subseccio->fk_id_seccio == $seccio->id_seccio ? 'selected' : '' }}>{{ $seccio->seccio }}</option>
        @endforeach
      </select>
    </div>

    <button type="submit" class="btn btn-primary">Actualitzar</button>
    <a href="{{ route('subseccions.index') }}" class="btn btn-warning" style="margin-left: 0.5rem;">Cancel·lar</a>
  </form>
</div>
<x-footer />
</body>
</html>

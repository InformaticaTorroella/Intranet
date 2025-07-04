<!DOCTYPE html>
<html lang="ca">
<head>
  <meta charset="UTF-8" />
  <title>Editar Secció</title>
  <link rel="icon" href="{{ asset('images/Escut_Transparent.png') }}" type="image/png">
  <link rel="stylesheet" href="{{ asset('css/quadres.css') }}">
</head>
<body>
<x-header />

<div class="container">
  <h1 class="page-title">Editar Secció</h1>

  <form action="{{ route('seccions.update', $seccio) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-4">
      <label for="seccio">Nom de la Secció</label>
      <input type="text" name="seccio" id="seccio" class="form-select" value="{{ old('seccio', $seccio->seccio) }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Actualitzar</button>
    <a href="{{ route('seccions.index') }}" class="btn btn-warning" style="margin-left: 0.5rem;">Cancel·lar</a>
  </form>
</div>
<x-footer />
</body>
</html>

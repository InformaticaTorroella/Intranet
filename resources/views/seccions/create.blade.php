<!DOCTYPE html>
<html lang="ca">
<head>
  <meta charset="UTF-8" />
  <title>Nova Secció</title>
  <link rel="icon" href="{{ asset('images/Escut_Transparent.png') }}" type="image/png">
  <link rel="stylesheet" href="{{ asset('css/quadres.css') }}">
</head>
<body>
<x-header />

<div class="container">
  <h1 class="page-title">Crear Nova Secció</h1>

  <form action="{{ route('seccions.store') }}" method="POST">
    @csrf
    <div class="mb-4">
      <label for="id_seccio">ID de la Secció</label>
      <input type="text" name="id_seccio" id="id_seccio" class="form-select" required>
    </div>
    <div class="mb-4">
      <label for="seccio">Nom de la Secció</label>
      <input type="text" name="seccio" id="seccio" class="form-select" required>
    </div>
    <button type="submit" class="btn btn-primary">Crear</button>
    <a href="{{ route('seccions.index') }}" class="btn btn-warning" style="margin-left: 0.5rem;">Cancel·lar</a>
  </form>
</div>
<x-footer />
</body>
</html>


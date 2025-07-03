<!DOCTYPE html>
<html lang="ca">
<head>
  <meta charset="UTF-8" />
  <title>Nova Tipologia GIAL</title>
  <link rel="stylesheet" href="{{ asset('css/quadres.css') }}">
</head>
<body>
<x-header />

<div class="container">
  <h1 class="page-title">Crear Nova Tipologia GIAL</h1>

  <form action="{{ route('tipologies-gial.store') }}" method="POST">
    @csrf
    <div class="mb-4">
      <label for="codi">Codi</label>
      <input type="text" name="codi" id="codi" class="form-select" required>
    </div>

    <button type="submit" class="btn btn-primary">Crear</button>
    <a href="{{ route('tipologies-gial.index') }}" class="btn btn-warning" style="margin-left: 0.5rem;">Cancel·lar</a>
  </form>
</div>

</body>
</html>

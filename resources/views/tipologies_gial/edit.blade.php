<!DOCTYPE html>
<html lang="ca">
<head>
  <meta charset="UTF-8" />
  <title>Editar Tipologia GIAL</title>
  <link rel="stylesheet" href="{{ asset('css/quadres.css') }}">
</head>
<body>
<x-header />

<div class="container">
  <h1 class="page-title">Editar Tipologia GIAL</h1>

  <form action="{{ route('tipologies-gial.update', $tipologia) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-4">
      <label for="codi">Codi</label>
      <input type="text" name="codi" id="codi" class="form-select" value="{{ old('codi', $tipologia->codi) }}" required>
    </div>

    <button type="submit" class="btn btn-primary">Actualitzar</button>
    <a href="{{ route('tipologies-gial.index') }}" class="btn btn-warning" style="margin-left: 0.5rem;">Cancel·lar</a>
  </form>
</div>

</body>
</html>

<!DOCTYPE html>
<html lang="ca">
<head>
  <meta charset="UTF-8" />
  <title>Nova Pregunta FAQ</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">    
</head>
<body>
<x-header />

<main class="container">
  <h1 class="page-title">Crear Nova Pregunta FAQ</h1>

  <form action="{{ route('faqs.store') }}" method="POST" novalidate>
    @csrf

    <label for="pregunta">Pregunta</label>
    <textarea name="pregunta" id="pregunta" rows="4" required placeholder="Escriu la teva pregunta aquí..."></textarea>

    <div class="btn-group">
      <button type="submit" class="btn-primary">Guardar</button>
      <a href="{{ route('faqs.index') }}" class="btn-secondary">Cancel·lar</a>
    </div>
  </form>
</main>

<x-footer />
</body>
</html>

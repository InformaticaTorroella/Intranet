<!DOCTYPE html>
<html lang="ca">
<head>
  <meta charset="UTF-8" />
  <title>FAQs</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>
<body>
<x-header />

<main class="container">
  <h1 class="page-title">Preguntes Freqüents</h1>

  <a href="{{ route('faqs.create') }}" class="btn btn-primary">Nova Pregunta</a>

  @foreach($faqs as $faq)
    <div class="faq-box" tabindex="0">
      <p><strong>Pregunta:</strong> {{ $faq->pregunta }}</p>
      <p class="author">Feta per: {{ $faq->usuari->name ?? 'Anònim' }}</p>

      @foreach($faq->respostes as $resposta)
        <div class="resposta">
          <p><strong>Resposta:</strong> {{ $resposta->resposta }}</p>
          <p class="author">Respon: {{ $resposta->usuari->name ?? 'Anònim' }}</p>

          @foreach($resposta->fills as $fill)
            <div class="resposta-nivell2">
              <p>↳ {{ $fill->resposta }}</p>
              <p class="author">Respon: {{ $fill->usuari->name ?? 'Anònim' }}</p>
            </div>
          @endforeach
        </div>
      @endforeach

      <form action="{{ route('respostes.store') }}" method="POST" class="form-resposta">
        @csrf
        <input type="hidden" name="faq_id" value="{{ $faq->id }}">
        <textarea name="resposta" rows="2" required placeholder="Escriu una resposta..."></textarea>
        <button type="submit" class="btn btn-success">Respondre</button>
      </form>
    </div>
  @endforeach
</main>

<x-footer />
</body>
</html>

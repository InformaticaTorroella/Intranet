<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="icon" href="{{ asset('images/Escut_Transparent.png') }}" type="image/png">
  <title>Intranet de Torroella de Montgrí</title>
  <link rel="stylesheet" href="{{ asset('css/home.css') }}">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body>
  <x-header />

  <div class="espacio-superior">
    <section class="panel-enlaces">
      <div class="enlaces-grid">
        <a href="{{ route('noticias.index') }}" class="enlace-panel">Notícies</a>
        <a href="{{ route('documents.index') }}" class="enlace-panel">Documents</a>
        <a href="{{ route('avis.index') }}" class="enlace-panel">Avisos</a>
        <a href="{{ route('telefons.index') }}" class="enlace-panel">Telèfons</a>
        <a href="{{ route('circulars.index') }}" class="enlace-panel">Circulars</a>
        <a href="{{ route('quadres.index') }}" class="enlace-panel">Quadre de Classificació</a>
      </div>
    </section>
  </div>

  <main>
    <div class="grid-home">
      <!-- 📰 Últimes Notícies -->
      <section class="home-box">
        <h2>📄 Últimes Circulars</h2>
        <a href="{{ route('circulars.index') }}" class="noticia-link">
          @forelse ($circulars as $circular)
            <article class="home-item">
              <h3>{{ $circular->nom_visual }}</h3>
              <p>{{ \Carbon\Carbon::parse($circular->data_creacio)->format('d/m/Y') }}</p>
            </article>
          @empty
            <p>No hi ha circulars.</p>
          @endforelse
        </a>
      </section>

      <!-- Últimes Notícies con enlace al index -->
      <section class="home-box">
        <h2>📰 Últimes Notícies</h2>
        <a href="{{ route('noticias.index') }}" class="noticia-link">
          @forelse ($noticias as $noticia)
            <div class="home-item">
              <h3>{{ $noticia->nom }}</h3>
              <p>{{ \Carbon\Carbon::parse($noticia->data_publicacio)->format('d/m/Y') }}</p>
            </div>
          @empty
            <p>No hi ha notícies disponibles.</p>
          @endforelse
        </a>
      </section>

      <section class="home-box">
        <h2>Espai extra</h2>
        <div class="home-item">
          <h3>S'accepten propostes</h3>
          <p>
            Contacteu a 
            <a href="mailto:informatica@torroella-estartit.cat" style="color: inherit; text-decoration: none;">
              informatica@torroella-estartit.cat
            </a><br>
            Es consideraran totes les propostes i es valoraran.
          </p>
        </div>
      </section>







    </div>
  </main>

  <x-footer />
</body>
</html>

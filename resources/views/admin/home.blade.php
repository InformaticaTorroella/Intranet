<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="{{ asset('images/Escut_Transparent.png') }}" type="image/png">
    <title>Intranet de Torroella de Montgrí</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/calendar.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <header>
        <div class="logo-title">
            <div class="logo">
              <img src="{{ asset('images/LogoAjTorroella.png') }}" alt="Logo">
            </div>
        </div>
        <nav class="links">
          <ul class="menu-list">
            <li class="menu-item">
              <a href="{{ route('admin.home') }}">Inici</a>
            </li>
            <li class="menu-item">
              <a href="https://torroellademontgri.sedipualba.es/">Seu Electronica</a>
            </li>
          </ul>
        </nav>
        <nav class="redes-header">
        <a href="https://www.facebook.com/ajuntamentorroellademontgri" target="_blank">
          <i class="fa-brands fa-square-facebook fa-3x"></i>
        </a>
        <a href="https://x.com/AjTorroella" target="_blank">
          <i class="fa-brands fa-square-x-twitter fa-3x"></i>
        </a>
        <a href="https://www.instagram.com/ajtorroella/#" target="_blank">
          <i class="fa-brands fa-square-instagram fa-3x"></i>
        </a>
        <a href="https://www.youtube.com/user/AjuntamentTorroella" target="_blank">
          <i class="fa-brands fa-youtube fa-3x"></i>
        </a>
      </nav>
    </header>

    
    <div class="espacio-superior">
      <h1 class="titulo-principal">Intranet de Torroella de Montgrí</h1>
    </div>
    <main>

      <section class="noticias-container">
        <h1>Noticies Recents</h1>
          @forelse ($noticias as $noticia)
              <article class="noticia">
                  <h2 class="noticia-titulo">{{ $noticia->nom }}</h2>
                  <p class="noticia-descripcio">{{ $noticia->descripcio }}</p>
                  <p class="noticia-data">Publicada: {{ \Carbon\Carbon::parse($noticia->data_publicacio)->format('d/m/Y') }}</p>
              </article>
          @empty
              <p>No hi ha notícies disponibles.</p>
          @endforelse
        </section> 
      <section class="espaico-extra">
        <x-calendari />
      </section>
    </main>

    <footer>
        <a class="redes" href="https://www.facebook.com/ajuntamentorroellademontgri" target="_blank">
          <i class="fa-brands fa-square-facebook fa-2x"></i>
        </a>
        <a class="redes" href="https://x.com/AjTorroella" target="_blank">
          <i class="fa-brands fa-square-x-twitter fa-2x"></i>
        </a>
        <a class="redes" href="https://www.instagram.com/ajtorroella/#" target="_blank">
          <i class="fa-brands fa-square-instagram fa-2x"></i>
        </a>
        <a class="redes" href="https://www.youtube.com/user/AjuntamentTorroella" target="_blank">
          <i class="fa-brands fa-youtube fa-2x"></i>
        </a>
        </nav>
    </footer>
</body>
</html>

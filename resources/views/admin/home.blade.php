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
    <header>
        <div class="logo-title">
            <div class="logo">
              <img src="{{ asset('images/LogoAjTorroella.png') }}" alt="Logo">
            </div>
        </div>
        <nav class="enlazes">
          <a href="https://torroellademontgri.sedipualba.es/" target="_blank">Seu Electronica</a>
        </nav>
        <nav class="redes">
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

    <main>
        <div class="noticias-container">
            @forelse ($noticias as $noticia)
                <article class="noticia">
                    <h2 class="noticia-titulo">{{ $noticia->nom }}</h2>
                    <p class="noticia-descripcio">{{ $noticia->descripcio }}</p>
                    <p class="noticia-data">Publicada: {{ \Carbon\Carbon::parse($noticia->data_publicacio)->format('d/m/Y') }}</p>
                </article>
            @empty
                <p>No hi ha notícies disponibles.</p>
            @endforelse
        </div>
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

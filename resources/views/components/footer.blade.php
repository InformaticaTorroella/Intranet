<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
</head>
<footer>
  <div class="footer-left">
    <p>
      Hola,
      @if(session()->has('username'))
        {{ session('username') }}
      @else
        <a href="login">Iniciar Sessió</a>
      @endif
    </p>
  </div>
  <div class="logo">
    <img src="{{ asset('images/LogoAjTorroella.png') }}" loading="lazy" alt="Logo">
  </div>
  <div class="footer-right">
    <a class="redes" href="https://www.facebook.com/ajuntamentorroellademontgri" target="_blank">
      <i class="fa-brands fa-square-facebook"></i>
    </a>
    <a class="redes" href="https://x.com/AjTorroella" target="_blank">
      <i class="fa-brands fa-square-x-twitter"></i>
    </a>
    <a class="redes" href="https://www.instagram.com/ajtorroella/#" target="_blank">
      <i class="fa-brands fa-square-instagram"></i>
    </a>
    <a class="redes" href="https://www.youtube.com/user/AjuntamentTorroella" target="_blank">
      <i class="fa-brands fa-youtube"></i>
    </a>
  </div>
</footer>
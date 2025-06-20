<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">

</head>
<header>
  <div class="logo">
    <img src="{{ asset('images/LogoAjTorroella.png') }}" loading="lazy" alt="Logo">
  </div>
  <nav class="links">
    <ul class="menu-list">
      <li class="menu-item">
        <a href="{{ route('admin.home') }}">Inici</a>
      </li>
      <li class="menu-item">
        <a href="https://torroellademontgri.sedipualba.es/">Seu Electronica</a>
      </li>
      <li class="menu-item">
        <a href="https://torroella-estartit.cat/">WEB Torroella</a>
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

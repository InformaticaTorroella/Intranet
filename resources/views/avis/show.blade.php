<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Avís: {{ $avis->titol }}</title>
    <link rel="icon" href="{{ asset('images/Escut_Transparent.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/avis.css') }}">
</head>
<body>
  <x-header />

  <div class="main-content">
    <div class="detalle-container
      {{ $avis->bool_avis_alert ? 'detalle-alerta' : ($avis->bool_avis_info ? 'detalle-informativo' : '') }}">

        <div><h1>Avís: {{ $avis->titol }}</h1></div>

        <div class="detalle-item">
            <strong>Contingut:</strong>
            <div class="detalle-caja">{!! nl2br(e($avis->contingut)) !!}</div>
        </div>

        <div class="detalle-item">
            <strong>Solucionat:</strong>
            <div class="detalle-caja">{{ $avis->solucionat ? 'Sí' : 'No' }}</div>
        </div>

        <div class="detalle-item">
            <strong>Data creació:</strong>
            <div class="detalle-caja">{{ $avis->data_creacio }}</div>
        </div>

        <div class="detalle-item">
            <strong>Data solucionat:</strong>
            <div class="detalle-caja">{{ $avis->data_solucionat }}</div>
        </div>

        @if($avis->solucionat)
        <div class="detalle-item">
            <strong>Títol solució:</strong>
            <div class="detalle-caja">{{ $avis->titol_solucionat }}</div>
        </div>

        <div class="detalle-item">
            <strong>Contingut solució:</strong>
            <div class="detalle-caja">{!! nl2br(e($avis->contingut_solucionat)) !!}</div>
        </div>
        @endif

        <div class="detalle-item">
            <strong>Enviar correu:</strong>
            <div class="detalle-caja">{{ $avis->bool_correu ? 'Sí' : 'No' }}</div>
        </div>

        <div class="detalle-item">
            <strong>Trial633:</strong>
            <div class="detalle-caja">{{ $avis->trial633 }}</div>
        </div>

        <a href="{{ route('avis.index') }}">Tornar</a> 
        @if(session()->has('username'))
        | <a href="{{ route('avis.edit', $avis->id) }}">Editar</a>
        @else

        @endif
        
    </div>
  </div>

  <x-footer />
</body>
</html>

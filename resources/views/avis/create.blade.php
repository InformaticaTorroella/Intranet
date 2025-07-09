<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Crear Avis</title>
    <link rel="icon" href="{{ asset('images/Escut_Transparent.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/avis.css') }}">
</head>
<body>
    <x-header />
    <h1>Crear Avís</h1>

    <form class="form" action="{{ route('avis.store') }}" method="POST">
        @csrf

        <label>Títol</label><br>
        <input type="text" name="titol" value="{{ old('titol') }}" required><br>
        @error('titol')<div>{{ $message }}</div>@enderror

        <label>Contingut</label><br>
        <textarea name="contingut" required>{{ old('contingut') }}</textarea><br>
        @error('contingut')<div>{{ $message }}</div>@enderror

        <label>
            <input type="radio" name="bool_avis" value="info" {{ (old('bool_avis') === 'info' || (isset($avis) && $avis->bool_avis_info)) ? 'checked' : '' }}>
               És informació?
        </label>
        <label>
            <input type="radio" name="bool_avis" value="alert" {{ (old('bool_avis') === 'alert' || (isset($avis) && $avis->bool_avis_alert)) ? 'checked' : '' }}>
                És alerta?
        </label>

        <label>Solucionat?</label>
        <input type="checkbox" name="solucionat" value="1" {{ old('solucionat') ? 'checked' : '' }}><br>

        <label>Data creació</label><br>
        <input type="datetime-local" name="data_creacio" value="{{ old('data_creacio') }}"><br>

        <label>Data solucionat</label><br>
        <input type="datetime-local" name="data_solucionat" value="{{ old('data_solucionat') }}"><br>

        <label>Contingut solucionat</label><br>
        <textarea name="contingut_solucionat">{{ old('contingut_solucionat') }}</textarea><br>

        <label>Títol solucionat</label><br>
        <input type="text" name="titol_solucionat" value="{{ old('titol_solucionat') }}"><br>


        <div class="btn-actions">
            <button type="submit" class="btn-primary">Guardar</button>
            <a href="{{ route('avis.index') }}" class="btn-go-back">Tornar</a>
        </div>
    </form>

    <x-footer />
</body>
</html>

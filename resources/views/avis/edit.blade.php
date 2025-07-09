<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Editar Avís</title>
    <link rel="icon" href="{{ asset('images/Escut_Transparent.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/avis.css') }}">
</head>
<body>
    <x-header />
    <h1>Editar Avís</h1>

    <form class="form" action="{{ route('avis.update', $avis->id) }}" method="POST" class="form-container">
        @csrf
        @method('PUT')

        <label class="form-label">Títol</label>
        <input type="text" name="titol" class="form-input" value="{{ old('titol', $avis->titol) }}" required>

        <label class="form-label">Contingut</label>
        <textarea name="contingut" class="form-textarea" required>{{ old('contingut', $avis->contingut) }}</textarea>

        <label>
            <input type="radio" name="bool_avis" value="info" {{ (old('bool_avis') === 'info' || (isset($avis) && $avis->bool_avis_info)) ? 'checked' : '' }}>
                És informació?
        </label>
        <label>
            <input type="radio" name="bool_avis" value="alert" {{ (old('bool_avis') === 'alert' || (isset($avis) && $avis->bool_avis_alert)) ? 'checked' : '' }}>
                És alerta?
        </label>


        <label class="form-label">Data creació</label>
        <input type="datetime-local" name="data_creacio" class="form-input" value="{{ old('data_creacio', $avis->data_creacio ? $avis->data_creacio->format('Y-m-d\TH:i') : '') }}">

        <label class="form-label">Data solucionat</label>
        <input type="datetime-local" name="data_solucionat" class="form-input" value="{{ old('data_solucionat', $avis->data_solucionat ? $avis->data_solucionat->format('Y-m-d\TH:i') : '') }}">

        <label class="form-label">Contingut solucionat</label>
        <textarea name="contingut_solucionat" class="form-textarea">{{ old('contingut_solucionat', $avis->contingut_solucionat) }}</textarea>

        <label class="form-label">Títol solucionat</label>
        <input type="text" name="titol_solucionat" class="form-input" value="{{ old('titol_solucionat', $avis->titol_solucionat) }}">

        <button type="submit" class="btn btn-primary">Actualitzar</button>
        <button type="button" class="btn-go-back" onclick="window.location.href='{{ route('avis.index') }}'">Tornar</button>
    </form>
    <form action="{{ route('avis.destroy', $avis->id) }}" method="POST" class="form-container">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Segur que vols eliminar aquest avís?')">Eliminar</button>
    </form>


    <x-footer />

    <script>
        document.querySelector('form').addEventListener('submit', function(event) {
            if (!confirm('¿Estás seguro de que quieres guardar los cambios?')) {
                event.preventDefault();
            }
        });
    </script>
</body>
</html>

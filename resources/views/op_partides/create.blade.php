<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Crear Partida</title>
    <link rel="icon" href="{{ asset('images/Escut_Transparent.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/op.css') }}">
</head>
<body>
    <x-header />

    <div class="container">
        <h1 class="page-title">Crear Partida</h1>

        <form action="{{ route('op_partides.store') }}" method="POST" class="form-grid">
            @csrf

            <div class="mb-4">
                <label for="partida">Partida (format xx-xxxxx-xxxxx):</label>
                <input type="text" name="partida" id="partida" class="form-select" value="{{ old('partida') }}" required maxlength="20">
                @error('partida') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label for="descripcio">Descripció:</label>
                <input type="text" name="descripcio" id="descripcio" class="form-select" value="{{ old('descripcio') }}" required maxlength="255">
                @error('descripcio') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label for="responsable_id">Responsable:</label>
                <select name="responsable_id" id="responsable_id" class="form-select">
                    <option value="">Selecciona responsable</option>
                    @foreach($usuaris as $usuari)
                        <option value="{{ $usuari->id }}" {{ old('responsable_id') == $usuari->id ? 'selected' : '' }}>
                            {{ $usuari->nom }}
                        </option>
                    @endforeach
                </select>
                @error('responsable_id') <div class="error">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn btn-primary">Crear</button>
        </form>

        <p><a href="{{ route('op_partides.index') }}" class="btn btn-secondary">Tornar enrere</a></p>
    </div>
    <x-footer />
</body>
</html>

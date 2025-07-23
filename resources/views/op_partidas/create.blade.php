<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Crear Partida</title>
</head>
<body>
    <h1>Crear Partida</h1>

    <form action="{{ route('op_partides.store') }}" method="POST">
        @csrf

        <label>Partida (format xx-xxxxx-xxxxx):</label><br>
        <input type="text" name="partida" value="{{ old('partida') }}" required maxlength="20">
        @error('partida') <div style="color:red;">{{ $message }}</div> @enderror
        <br><br>

        <label>Descripció:</label><br>
        <input type="text" name="descripcio" value="{{ old('descripcio') }}" required maxlength="255">
        @error('descripcio') <div style="color:red;">{{ $message }}</div> @enderror
        <br><br>

        <label>Responsable:</label><br>
        <select name="responsable_id">
            <option value="">Selecciona responsable</option>
            @foreach($usuaris as $usuari)
                <option value="{{ $usuari->id }}" {{ old('responsable_id') == $usuari->id ? 'selected' : '' }}>
                    {{ $usuari->nom }}
                </option>
            @endforeach
        </select>
        @error('responsable_id') <div style="color:red;">{{ $message }}</div> @enderror
        <br><br>

        <button type="submit">Crear</button>
    </form>

    <p><a href="{{ route('op_partides.index') }}">Tornar enrere</a></p>
</body>
</html>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Editar Partida {{ $op_partide->partida }}</title>
</head>
<body>
    <h1>Editar Partida {{ $op_partide->partida }}</h1>

    <form action="{{ route('op_partides.update', $op_partide) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Partida (format xx-xxxxx-xxxxx):</label><br>
        <input type="text" name="partida" value="{{ old('partida', $op_partide->partida) }}" required maxlength="20" readonly>
        @error('partida') <div style="color:red;">{{ $message }}</div> @enderror
        <br><br>

        <label>Descripció:</label><br>
        <input type="text" name="descripcio" value="{{ old('descripcio', $op_partide->descripcio) }}" required maxlength="255">
        @error('descripcio') <div style="color:red;">{{ $message }}</div> @enderror
        <br><br>

        <label>Responsable:</label><br>
        <select name="responsable_id">
            <option value="">Selecciona responsable</option>
            @foreach($usuaris as $usuari)
                <option value="{{ $usuari->id }}" {{ old('responsable_id', $op_partide->responsable_id) == $usuari->id ? 'selected' : '' }}>
                    {{ $usuari->nom }}
                </option>
            @endforeach
        </select>
        @error('responsable_id') <div style="color:red;">{{ $message }}</div> @enderror
        <br><br>

        <button type="submit">Actualitzar</button>
    </form>

    <p><a href="{{ route('op_partides.index') }}">Tornar enrere</a></p>
</body>
</html>

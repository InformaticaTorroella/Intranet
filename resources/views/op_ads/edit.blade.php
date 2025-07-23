<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Editar Registre AD #{{ $ad->id }}</title>
    <style>
        label { display:block; margin-top:10px; }
        input, select { width: 300px; padding: 5px; }
        .error { color: red; font-size: 0.9em; }
        button { margin-top: 15px; padding: 10px 20px; }
    </style>
</head>
<body>
    <h1>Editar Registre AD #{{ $ad->id }}</h1>

    <form method="POST" action="{{ route('op_ads.update', $ad->id) }}">
        @csrf
        @method('PUT')

        <label>Data:</label>
        <input type="date" name="data" value="{{ old('data', $ad->data) }}" required>
        @error('data')<div class="error">{{ $message }}</div>@enderror

        <label>Responsable:</label>
        <select name="responsable_id" required>
            <option value="">Selecciona responsable</option>
            @foreach($usuaris as $usuari)
                <option value="{{ $usuari->id }}" {{ old('responsable_id', $ad->responsable_id) == $usuari->id ? 'selected' : '' }}>
                    {{ $usuari->nom }}
                </option>
            @endforeach
        </select>
        @error('responsable_id')<div class="error">{{ $message }}</div>@enderror

        <label>Partida:</label>
        <select name="partida" required>
            <option value="">Selecciona partida</option>
            @foreach($partides as $partida)
                <option value="{{ $partida->partida }}" {{ old('partida', $ad->partida) == $partida->partida ? 'selected' : '' }}>
                    {{ $partida->descripcio }}
                </option>
            @endforeach
        </select>
        @error('partida')<div class="error">{{ $message }}</div>@enderror

        <label>Import Reserva (€):</label>
        <input type="number" step="0.01" name="import_reserva" value="{{ old('import_reserva', $ad->import_reserva) }}" required>
        @error('import_reserva')<div class="error">{{ $message }}</div>@enderror

        <label>Exp. Sedipualba:</label>
        <input type="text" name="exp_sedipualba" value="{{ old('exp_sedipualba', $ad->exp_sedipualba) }}">
        @error('exp_sedipualba')<div class="error">{{ $message }}</div>@enderror

        <label>Concepte Despesa:</label>
        <input type="text" name="concepte_despesa" value="{{ old('concepte_despesa', $ad->concepte_despesa) }}">
        @error('concepte_despesa')<div class="error">{{ $message }}</div>@enderror

        <label>CIF (Proveïdor):</label>
        <select name="cif">
            <option value="">Selecciona proveïdor</option>
            @foreach($tercers as $tercer)
                <option value="{{ $tercer->ter_doc }}" {{ old('cif', $ad->cif) == $tercer->ter_doc ? 'selected' : '' }}>
                    {{ $tercer->ter_nom }}
                </option>
            @endforeach
        </select>
        @error('cif')<div class="error">{{ $message }}</div>@enderror

        <label>RC (reservat per intervenció):</label>
        <input type="text" name="rc" value="{{ old('rc', $ad->rc) }}">
        @error('rc')<div class="error">{{ $message }}</div>@enderror

        <button type="submit">Actualitzar</button>
    </form>

    <p><a href="{{ route('op_ads.index') }}">Tornar enrere</a></p>
</body>
</html>

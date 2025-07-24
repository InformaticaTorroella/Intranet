<!DOCTYPE html>
<html lang="ca">
<head>
  <meta charset="UTF-8">
  <title>Editar Registre AD #{{ $ad->id }}</title>
    <link rel="icon" href="{{ asset('images/Escut_Transparent.png') }}" type="image/png">
  <link rel="stylesheet" href="{{ asset('css/op.css') }}">
</head>
<body>
  <x-header />

  <div class="container">
    <h1 class="page-title">Editar Registre AD #{{ $ad->id }}</h1>

    @if ($errors->any())
      <div class="error-box mb-4">
        <ul>
          @foreach ($errors->all() as $error)
            <li class="error">{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('op_ads.update', $ad->id) }}" method="POST" class="form-grid">
      @csrf
      @method('PUT')

      <div class="mb-4">
        <label for="data">Data:</label>
        <input type="date" name="data" value="{{ old('data', $ad->data) }}" required class="form-select">
        @error('data')<div class="error">{{ $message }}</div>@enderror
      </div>

      <div class="mb-4">
        <label for="responsable_id">Responsable:</label>
        <select name="responsable_id" class="form-select" required>
          <option value="">Selecciona responsable</option>
          @foreach($usuaris as $usuari)
            <option value="{{ $usuari->id }}" {{ old('responsable_id', $ad->responsable_id) == $usuari->id ? 'selected' : '' }}>
              {{ $usuari->nom }}
            </option>
          @endforeach
        </select>
        @error('responsable_id')<div class="error">{{ $message }}</div>@enderror
      </div>

      <div class="mb-4">
        <label for="partida">Partida:</label>
        <select name="partida" class="form-select" required>
          <option value="">Selecciona partida</option>
          @foreach($partides as $partida)
            <option value="{{ $partida->partida }}" {{ old('partida', $ad->partida) == $partida->partida ? 'selected' : '' }}>
              {{ $partida->descripcio }}
            </option>
          @endforeach
        </select>
        @error('partida')<div class="error">{{ $message }}</div>@enderror
      </div>

      <div class="mb-4">
        <label for="import_reserva">Import Reserva (€):</label>
        <input type="number" step="0.01" name="import_reserva" value="{{ old('import_reserva', $ad->import_reserva) }}" required class="form-select">
        @error('import_reserva')<div class="error">{{ $message }}</div>@enderror
      </div>

      <div class="mb-4">
        <label for="exp_sedipualba">Exp. Sedipualba:</label>
        <input type="text" name="exp_sedipualba" value="{{ old('exp_sedipualba', $ad->exp_sedipualba) }}" class="form-select">
        @error('exp_sedipualba')<div class="error">{{ $message }}</div>@enderror
      </div>

      <div class="mb-4">
        <label for="concepte_despesa">Concepte Despesa:</label>
        <input type="text" name="concepte_despesa" value="{{ old('concepte_despesa', $ad->concepte_despesa) }}" class="form-select">
        @error('concepte_despesa')<div class="error">{{ $message }}</div>@enderror
      </div>

      <div class="mb-4">
        <label for="cif">CIF (Proveïdor):</label>
        <select name="cif" class="form-select">
          <option value="">Selecciona proveïdor</option>
          @foreach($tercers as $tercer)
            <option value="{{ $tercer->ter_doc }}" {{ old('cif', $ad->cif) == $tercer->ter_doc ? 'selected' : '' }}>
              {{ $tercer->ter_nom }}
            </option>
          @endforeach
        </select>
        @error('cif')<div class="error">{{ $message }}</div>@enderror
      </div>

      <div class="mb-4">
        <label for="rc">RC (reservat per intervenció):</label>
        <input type="text" name="rc" value="{{ old('rc', $ad->rc) }}" class="form-select">
        @error('rc')<div class="error">{{ $message }}</div>@enderror
      </div>

      <button type="submit" class="btn btn-primary">Actualitzar</button>
    </form>

    <a href="{{ route('op_ads.index') }}" class="btn btn-secondary">Tornar enrere</a>
  </div>
  <x-footer />
</body>
</html>

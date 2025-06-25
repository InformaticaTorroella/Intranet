<!DOCTYPE html>
<html lang="ca">
<head>
  <meta charset="UTF-8">
  <title>Edita telèfon</title>
  <link rel="stylesheet" href="{{ asset('css/telefons.css') }}">
</head>
<body>
<x-header />
  <h2>Edita Telèfon</h2>
  <form class="edit-form" method="POST" action="{{ route('telefons.update', $telefon->id) }}">
    @csrf @method('PUT')

    <label class="form-label">Nom</label>
    <input type="text" name="nom_telefon" class="form-input" value="{{ $telefon->nom }}" required>

    <label class="form-label">Directe</label>
    <input type="text" name="num_directe" class="form-input" value="{{ $telefon->num_directe }}">

    <label class="form-label">Ext. VOIP</label>
    <input type="text" name="extensio_voip" class="form-input" value="{{ $telefon->extensio_voip }}">

    <label class="form-label">Mòbil</label>
    <input type="text" name="num_directe_mobil" class="form-input" value="{{ $telefon->num_directe_mobil }}">

    <label class="form-label">Ext. Mòbil</label>
    <input type="text" name="extensio_mobil" class="form-input" value="{{ $telefon->extensio_mobil }}">

    <label class="form-label">Àrea</label>
    <select name="area" class="form-select" required>
      <option value="">-- Selecciona Àrea --</option>
      @foreach ($arees as $area)
        <option value="{{ $area->IdArea }}" {{ $telefon->fk_id_area == $area->IdArea ? 'selected' : '' }}>
          {{ $area->Area }}
        </option>
      @endforeach
    </select>

    <label class="form-label">Edifici</label>
    <select name="edifici" class="form-select" required>
      <option value="">-- Selecciona Edifici --</option>
      @foreach ($equipaments as $equipament)
        <option value="{{ $equipament->id_equimanent }}" {{ $telefon->fk_id_equipament == $equipament->id_equimanent ? 'selected' : '' }}>
          {{ $equipament->Equipament }}
        </option>
      @endforeach
    </select>

    <label class="form-label">Tipus</label>
    <input type="number" name="fk_tipus_obj" class="form-input" value="{{ $telefon->fk_tipus_obj }}">

    <label class="form-label">Data Edició</label>
    <input type="date" name="data_edicio" class="form-input" value="{{ \Carbon\Carbon::parse($telefon->data_edicio)->format('Y-m-d') }}" required>

    <button type="submit" class="btn btn-success">Actualitza</button>
    <a href="{{ route('telefons.index') }}" class="btn btn-secondary">Cancel·la</a>
  </form>
<x-footer />
</body>
</html>

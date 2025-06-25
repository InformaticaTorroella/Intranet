<!DOCTYPE html>
<html lang="ca">
<head>
  <meta charset="UTF-8" />
  <title>Telèfons</title>
  <link rel="stylesheet" href="{{ asset('css/telefons.css') }}" />
</head>
<body>
<x-header />
<main>
  <h2>Telèfons</h2>


  <form method="GET" action="{{ route('telefons.index') }}">
  <select id="equipament-select" name="id_equipament" onchange="this.form.submit()">
    <option value="">-- Selecciona Edifici --</option>
    @foreach ($equipaments as $equipament)
      <option value="{{ $equipament->id_equimanent }}" {{ request('id_equipament') == $equipament->id_equimanent ? 'selected' : '' }}>
        {{ $equipament->Equipament }}
      </option>
    @endforeach
  </select>

  <select id="area-select" name="area_id" onchange="this.form.submit()">
    <option value="">-- Selecciona Àrea --</option>
    @foreach ($arees as $area)
      <option value="{{ $area->IdArea }}" {{ request('area_id') == $area->IdArea ? 'selected' : '' }}>
        {{ $area->Area }}
      </option>
    @endforeach
  </select>
</form>
  <a href="{{ route('telefons.create') }}" class="btn btn-primary">+ Nou telèfon</a>


  @if ($telefons->isEmpty())
    <p>No hi ha telèfons per a aquesta combinació d'equipament i àrea.</p>
  @else
    <table class="table">
      <thead>
        <tr>
          <th>Persona / Càrrec</th>
          <th>Número Tel</th>
          <th>Extensió VOIP</th>
          <th>Telèfon Mòbil</th>
          <th>Extensió Mòbil</th>
          <th>Àrea</th>
          <th>Edifici</th>
          <th>Accions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($telefons as $telefon)
          <tr>
            <td>{{ $telefon->nom }}</td>
            <td>{{ $telefon->num_directe ?? 'N/A' }}</td>
            <td>{{ $telefon->extensio_voip ?? 'N/A' }}</td>
            <td>{{ $telefon->num_directe_mobil ?? 'N/A' }}</td>
            <td>{{ $telefon->extensio_mobil ?? 'N/A' }}</td>
            <td>{{ $telefon->area->Area ?? 'N/A' }}</td>
            <td>{{ $telefon->equipament->Equipament ?? 'N/A' }}</td>
            <td class="actions">
              <a href="{{ route('telefons.edit', $telefon->id) }}" class="btn btn-warning">Editar</a>
              <form action="{{ route('telefons.destroy', $telefon->id) }}" method="POST" onsubmit="return confirm('Segur?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Eliminar</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>

    </table>
  @endif
</main>

<x-footer />
</body>
</html>

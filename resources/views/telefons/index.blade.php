<!DOCTYPE html>
<html lang="ca">
<head>
  <meta charset="UTF-8">
  <title>Telèfons</title>
  <link rel="stylesheet" href="{{ asset('css/telefons.css') }}">
</head>
<body>
<x-header />
<main>
  <h2>Telèfons</h2>
  <a href="{{ route('telefons.create') }}" class="btn btn-primary">+ Nou telèfon</a>

  <table class="table">
    <thead>
      <tr>
        <th>Nom</th>
        <th>Directe</th>
        <th>Ext. VOIP</th>
        <th>Mòbil</th>
        <th>Ext. Mòbil</th>
        <th>Accions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($telefons as $telefon)
      <tr>
        <td>{{ $telefon->nom }}</td>
        <td>{{ $telefon->num_directe }}</td>
        <td>{{ $telefon->extensio_voip }}</td>
        <td>{{ $telefon->num_directe_mobil }}</td>
        <td>{{ $telefon->extensio_mobil }}</td>
        <td class="actions">
          @if(session()->has('username'))
            <a href="{{ route('telefons.edit', $telefon->id) }}" class="btn btn-warning">Edita</a>
            <form action="{{ route('telefons.destroy', $telefon->id) }}" method="POST" onsubmit="return confirm('Estàs segur?')">
              @csrf @method('DELETE')
              <button type="submit" class="btn btn-danger">Esborra</button>
            </form>
          @else
            <span class="btn btn-secondary disabled">Inicia sessio per fer Accions.</span>
          @endif
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</main>
<x-footer />
</body>
</html>

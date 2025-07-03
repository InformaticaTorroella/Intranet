<!DOCTYPE html>
<html lang="ca">
<head>
  <meta charset="UTF-8" />
  <title>Quadre de Classificacions</title>
  <link rel="icon" href="{{ asset('images/Escut_Transparent.png') }}" type="image/png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/quadres.css') }}" />
</head>
<body>
<x-header />
<main>
  @php
      $userGroups = session('user_groups', []);
  @endphp
<div class="container">
    <h1 class="text-2xl font-bold mb-4">Quadres</h1>
    <a href="{{ route('quadres.create') }}" class="btn btn-primary mb-4">Crear Nou Quadre</a>

    <table class="table-auto w-full border">
        <thead>
            <tr>
                <th class="border px-4 py-2">Secció</th>
                <th class="border px-4 py-2">Subsecció</th>
                <th class="border px-4 py-2">Sèrie</th>
                <th class="border px-4 py-2">Tipologies GIAL</th>
                <th class="border px-4 py-2">Accions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($quadres as $quadre)
            <tr>
                <td class="border px-4 py-2">{{ $quadre->seccio->seccio }}</td>
                <td class="border px-4 py-2">{{ $quadre->subseccio->subseccio }}</td>
                <td class="border px-4 py-2">{{ $quadre->serie->serie }}</td>
                <td class="border px-4 py-2">
                    @foreach($quadre->tipologies as $tipologia)
                        <span class="inline-block bg-gray-200 px-2 py-1 mr-1">{{ $tipologia->codi }}</span>
                    @endforeach
                </td>
                <td class="border px-4 py-2">
                    <a href="{{ route('quadres.edit', $quadre) }}" class="btn btn-sm btn-warning">Editar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

</body>
</html>

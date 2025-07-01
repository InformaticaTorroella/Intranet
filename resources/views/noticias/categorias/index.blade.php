<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8" />
    <title>Llistat de Categories</title>
    <link rel="stylesheet" href="{{ asset('css/noticias.css') }}">
</head>
<body>
<x-header />

<main>
    <h1>Categories de Notícies</h1>

    @if(session('success'))
        <div class="form-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('categories.create') }}" class="btn btn-primary">+ Nova Categoria</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Accions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $cat)
                <tr>
                    <td>{{ $cat->id }}</td>
                    <td>{{ $cat->nom }}</td>
                    <td>
                        <a href="{{ route('categories.edit', $cat->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('categories.destroy', $cat->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Segur que vols eliminar aquesta categoria?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="3">No hi ha categories.</td></tr>
            @endforelse
        </tbody>
    </table>
</main>

<x-footer />
</body>
</html>
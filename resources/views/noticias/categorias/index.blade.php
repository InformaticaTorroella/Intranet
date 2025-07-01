<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8" />
    <title>Llistat de Categories</title>
    <link rel="stylesheet" href="{{ asset('css/categorias.css') }}">
</head>
<body>
<x-header />

<main class="categories-page-center">
    <div class="categories-container">
        <h1>Categories de Notícies</h1>

        @if(session('success'))
            <div class="category-success-message">{{ session('success') }}</div>
        @endif

        <a href="{{ route('categoria-noticias.create') }}" class="new-category-button">+ Nova Categoria</a>

        <table class="categories-table">
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
                            <div class="category-action-links">
                                <a href="{{ route('categoria-noticias.edit', $cat->id) }}" class="btn-editar">Editar</a>
                                <form action="{{ route('categoria-noticias.destroy', $cat->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-danger" onclick="return confirm('Segur que vols eliminar aquesta categoria?')">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="3">No hi ha categories.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</main>

<x-footer />
</body>
</html>

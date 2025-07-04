<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Categorias de Circulars</title>
    <link rel="icon" href="{{ asset('images/Escut_Transparent.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/categorias.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pagination.css') }}">
</head>
<body>
<x-header />
<main class="categories-page-center">
    <div class="categories-container">
        <h1>Categories de Circulars</h1>

        @if(session('success'))
            <div class="category-success-message">{{ session('success') }}</div>
        @endif

        <a href="{{ route('categoria-circulars.create') }}" class="new-category-button">Nova Categoria</a>

        <table class="categories-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Accions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $cat)
                    <tr>
                        <td>{{ $cat->id }}</td>
                        <td>{{ $cat->nom }}</td>
                        <td class="category-action-links">
                            <a href="{{ route('categoria-circulars.edit', $cat->id) }}" class="btn-editar">Editar</a>
                            <form action="{{ route('categoria-circulars.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Eliminar?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination">
            {{ $categories->links() }}
        </div>
    </div>
</main>
<x-footer />
</body>
</html>

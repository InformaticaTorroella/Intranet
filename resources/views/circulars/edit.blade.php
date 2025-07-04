<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Editar Circular</title>
    <link rel="icon" href="{{ asset('images/Escut_Transparent.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/circulars.css') }}">
    <!-- CKEditor 5 Classic Build -->
    <script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
</head>
<body>
    <x-header />
    
    <h1 class="form-title">Editar Circular</h1>

    @if ($errors->any())
        <div style="color: red; margin-bottom: 1rem;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('circulars.update', $circular->id) }}" method="POST" enctype="multipart/form-data" class="form">
        @csrf 
        @method('PUT')

        <label class="form-label" for="nom_visual">Nom Visual</label>
        <input type="text" name="nom_visual" id="nom_visual" class="form-control" value="{{ old('nom_visual', $circular->nom_visual) }}" required>

        <label class="form-label" for="descripcion">Descripció</label>
        <textarea name="descripcion" id="descripcion" class="form-control" required>{{ old('descripcion', $circular->descripcion) }}</textarea>

        <label class="form-label" for="fk_cat_circular">Categoria</label>
        <select name="fk_cat_circular" id="fk_cat_circular" class="form-control" required>
            @foreach($categories as $categoria)
                <option value="{{ $categoria->id }}" {{ $categoria->id == old('fk_cat_circular', $circular->fk_cat_circular) ? 'selected' : '' }}>
                    {{ $categoria->nom }}
                </option>
            @endforeach
        </select>

        <label class="form-label" for="arxius">Arxius (pots pujar més d'un)</label>
        <input type="file" name="arxius[]" id="arxius" class="form-control" multiple>

        @if($circular->files->count())
            <h3>Arxius actuals:</h3>
            <ul>
                @foreach($circular->files as $file)
                    <li>
                        <label>
                            <input type="checkbox" name="delete_files[]" value="{{ $file->id }}">
                            Eliminar
                        </label>
                        <a href="{{ asset('storage/' . $file->url) }}" target="_blank">{{ $file->nom_arxiu }}</a>
                    </li>
                @endforeach
            </ul>
        @endif

        <button type="submit" class="btn-primary">Desar</button>
    </form>

    <x-footer />

    <script>
        ClassicEditor
            .create(document.querySelector('#descripcion'))
            .catch(error => {
                console.error(error);
            });
    </script>
</body>
</html>

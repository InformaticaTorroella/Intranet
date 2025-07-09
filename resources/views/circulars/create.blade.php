<!-- resources/views/circulars/create.blade.php -->
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Crear Circular</title>
    <link rel="icon" href="{{ asset('images/Escut_Transparent.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/circulars.css') }}">
    <!-- CKEditor 5 Classic Build -->
    <script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>

    <style>
        /* Para que el editor tenga una altura mínima visible */
        .ck-editor__editable_inline {
            min-height: 300px !important;
        }
    </style>
</head>
<body>
    <x-header />

    <h1 class="form-title">Crear Circular</h1>

    <form action="{{ route('circulars.store') }}" method="POST" enctype="multipart/form-data" class="form">
        @csrf

        <label class="form-label" for="nom_visual">Nom Visual</label>
        <input type="text" name="nom_visual" id="nom_visual" class="form-control" required>

        <label class="form-label" for="descripcion">Descripció</label>
        <textarea name="descripcion" id="descripcion" class="form-control"></textarea>

        <label class="form-label" for="fk_cat_circular">Categoria</label>
        <select name="fk_cat_circular" id="fk_cat_circular" class="form-control">
            @foreach($categories as $categoria)
                <option value="{{ $categoria->id }}">{{ $categoria->nom }}</option>
            @endforeach
        </select>

        <label class="form-label" for="arxius">Arxius (pots pujar més d'un)</label>
        <input type="file" name="arxius[]" id="arxius" class="form-control" multiple required>

        <button type="submit" class="btn-primary">Guardar</button>
        <a href="{{ route('circulars.index') }}" class="btn-secondary">Cancelar</a>
    </form>

    <x-footer />

<script>
let editor;

ClassicEditor
    .create(document.querySelector('#descripcion'))
    .then(ed => {
        editor = ed;
    })
    .catch(error => {
        console.error(error);
    });

const form = document.querySelector('form');
form.addEventListener('submit', e => {
    form.descripcion.value = editor.getData().trim();

    if (!form.descripcion.value) {
        e.preventDefault();
        alert('La Descripció és obligatòria.');
        editor.editing.view.focus();
    }
});
</script>

</body>
</html>

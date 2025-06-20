<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Documento</title>
</head>
<body>
    <h1>Editar Documento</h1>

    <form method="POST" action="{{ route('documents.update', $document->id) }}">
        @csrf
        @method('PUT')

        <label>Nombre Visual</label><br>
        <input type="text" name="nom_document" value="{{ old('nom_document', $document->nom_visual) }}" required><br><br>

        <label>Nombre Archivo</label><br>
        <input type="text" name="nom_arxiu" value="{{ old('nom_arxiu', $document->nom_arxiu) }}"><br><br>

        <label>Fecha Entrada</label><br>
        <input type="datetime-local" name="data_entrada" value="{{ old('data_entrada', $document->data_entrada ? date('Y-m-d\TH:i', strtotime($document->data_entrada)) : '') }}"><br><br>

        <label>Extensión</label><br>
        <input type="text" name="extensio" maxlength="10" value="{{ old('extensio', $document->extensio) }}"><br><br>

        <label>Orden</label><br>
        <input type="number" name="ordre" value="{{ old('ordre', $document->ordre) }}"><br><br>

        <label>URL</label><br>
        <input type="text" name="url_document" value="{{ old('url_document', $document->url) }}"><br><br>

        <label>FK ID Obj</label><br>
        <input type="number" name="id_obj" value="{{ old('id_obj', $document->fk_id_obj) }}"><br><br>

        <label>FK ID Tipus Obj</label><br>
        <input type="number" name="tipus_obj" value="{{ old('tipus_obj', $document->fk_id_tipus_obj) }}"><br><br>

        <button type="submit">Guardar</button>
    </form>
</body>
</html>

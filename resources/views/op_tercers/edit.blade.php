<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Editar Tercer {{ $op_tercer->ter_doc }}</title>
</head>
<body>
    <h1>Editar Tercer {{ $op_tercer->ter_doc }}</h1>

    <form action="{{ route('op_tercers.update', $op_tercer) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Document (ter_doc):</label><br>
        <input type="text" name="ter_doc" value="{{ old('ter_doc', $op_tercer->ter_doc) }}" required maxlength="20" readonly>
        @error('ter_doc') <div style="color:red;">{{ $message }}</div> @enderror
        <br><br>

        <label>Nom (ter_nom):</label><br>
        <input type="text" name="ter_nom" value="{{ old('ter_nom', $op_tercer->ter_nom) }}" required maxlength="255">
        @error('ter_nom') <div style="color:red;">{{ $message }}</div> @enderror
        <br><br>

        <label>Adreça (ter_dom):</label><br>
        <input type="text" name="ter_dom" value="{{ old('ter_dom', $op_tercer->ter_dom) }}" maxlength="255">
        @error('ter_dom') <div style="color:red;">{{ $message }}</div> @enderror
        <br><br>

        <label>Població (ter_pob):</label><br>
        <input type="text" name="ter_pob" value="{{ old('ter_pob', $op_tercer->ter_pob) }}" maxlength="100">
        @error('ter_pob') <div style="color:red;">{{ $message }}</div> @enderror
        <br><br>

        <label>Codi Postal (ter_cpo):</label><br>
        <input type="number" name="ter_cpo" value="{{ old('ter_cpo', $op_tercer->ter_cpo) }}">
        @error('ter_cpo') <div style="color:red;">{{ $message }}</div> @enderror
        <br><br>

        <label>Provincia (ter_pro):</label><br>
        <input type="text" name="ter_pro" value="{{ old('ter_pro', $op_tercer->ter_pro) }}" maxlength="100">
        @error('ter_pro') <div style="color:red;">{{ $message }}</div> @enderror
        <br><br>

        <label>Telèfon (ter_tlf):</label><br>
        <input type="text" name="ter_tlf" value="{{ old('ter_tlf', $op_tercer->ter_tlf) }}" maxlength="50">
        @error('ter_tlf') <div style="color:red;">{{ $message }}</div> @enderror
        <br><br>

        <label>Fax (ter_fax):</label><br>
        <input type="text" name="ter_fax" value="{{ old('ter_fax', $op_tercer->ter_fax) }}" maxlength="50">
        @error('ter_fax') <div style="color:red;">{{ $message }}</div> @enderror
        <br><br>

        <label>DCE (ter_dce):</label><br>
        <input type="text" name="ter_dce" value="{{ old('ter_dce', $op_tercer->ter_dce) }}" maxlength="255">
        @error('ter_dce') <div style="color:red;">{{ $message }}</div> @enderror
        <br><br>

        <button type="submit">Actualitzar</button>
    </form>

    <p><a href="{{ route('op_tercers.index') }}">Tornar enrere</a></p>
</body>
</html>

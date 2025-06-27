<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use Illuminate\Http\Request;

class NoticiaController extends Controller
{
    public function index()
    {
        $noticias = Noticia::orderBy('data_publicacio', 'desc')->get();
        return view('noticias.index', compact('noticias'));
    }


    public function create()
    {
        return view('noticias.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_noticia' => 'required|string',
            'descripcio_noticia' => 'required|string',
            'data_pub' => 'required|date',
            'bool_pub' => 'required|boolean',
            'url_document' => 'nullable|string',
            'data_inicial' => 'required|date',
            'data_final' => 'required|date',
        ]);

        $noticia = new Noticia();
        $noticia->nom = $validated['nom_noticia'];
        $noticia->descripcio = $validated['descripcio_noticia'];
        $noticia->data_publicacio = $validated['data_pub'];
        $noticia->publicat = $validated['bool_pub'];
        $noticia->url = $validated['url_document'] ?? null;
        $noticia->data_inicial = $validated['data_inicial'];
        $noticia->data_final = $validated['data_final'];
        

        try {
            $noticia->save();
            $id = $noticia->id;
            logActivity('Crear Noticia', "ID: $id", "L'usuari ha Creat la noticia Nº $id.");
            return redirect()->route('noticias.index')->with('success', 'Notícia creada');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Error al guardar la notícia: ' . $e->getMessage()]);
        }
    }


    public function edit($id)
    {
        $noticia = Noticia::getNoticia($id)->first();
        if (!$noticia) abort(404);
        return view('noticias.edit', compact('noticia'));
    }

    public function show($id)
    {
        $noticia = Noticia::findOrFail($id);
        return view('noticias.show', compact('noticia'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'nom_noticia' => 'required|string|max:255',
            'descripcio_noticia' => 'required|string',
            'data_pub' => 'required|date',
            'bool_pub' => 'required|boolean',
            'tipus_obj' => 'nullable|integer',
            'url_document' => 'nullable|string',
            'data_inicial' => 'required|date',
            'data_final' => 'required|date|after_or_equal:data_inicial',
        ]);

        $data = $request->only([
            'nom_noticia', 'descripcio_noticia', 'data_pub', 'bool_pub',
            'tipus_obj', 'url_document', 'data_inicial', 'data_final'
        ]);

        $data['id'] = $id;

        Noticia::updateNoticia($data);

        logActivity('Edita Noticia', "ID: $id", "L'usuari ha editat la noticia Nº $id.");

        return redirect()->route('noticias.index')->with('success', 'Notícia actualitzada');
    }

    public function destroy($id)
    {
        $noticia = Noticia::findOrFail($id);
        $noticia->delete();

        logActivity('Eliminar Noticia', "ID: $id", "L'usuari ha eliminat la noticia Nº $id.");

        return redirect()->route('noticias.index')->with('success', 'Notícia eliminada');
    }
    
}

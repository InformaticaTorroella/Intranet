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
        
        // No asignes id ni fk_tipus_obj si no es necesario o si es nullable

        $noticia->save();

        return redirect()->route('noticias.index')->with('success', 'Notícia creada');
    }


    public function edit($id)
    {
        $noticia = Noticia::getNoticia($id)->first();
        if (!$noticia) abort(404);
        return view('noticias.edit', compact('noticia'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom_noticia' => 'required|string|max:255',
            'descripcio_noticia' => 'required|string',
            'data_pub' => 'required|date',
            'bool_pub' => 'required|boolean',
            'tipus_obj' => 'required|integer',
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

        return redirect()->route('noticias.index')->with('success', 'Notícia actualitzada');
    }

    public function destroy($id)
    {
        $noticia = Noticia::findOrFail($id);
        $noticia->delete();

        return redirect()->route('noticias.index')->with('success', 'Notícia eliminada');
    }
    
}

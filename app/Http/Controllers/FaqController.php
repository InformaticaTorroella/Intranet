<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\User;
use Carbon\Carbon;


class FaqController extends Controller
{
    public function index(Request $request)
    {
        if (session()->has('username')) {
            $username = session('username');

            // Crea o recupera el usuario usando `name`, no `username`
            $user = User::firstOrCreate(
                ['name' => $username]
            );
        }

        $faqs = Faq::with('respostes')->get();

        return view('faqs.index', compact('faqs'));
    }


    public function show($id)
    {
        $faq = Faq::findOrFail($id);

        // Convertir fecha para evitar errores (solo si hace falta)
        try {
            $faq->created_at = Carbon::parse($faq->created_at);
        } catch (\Exception $e) {
            $faq->created_at = now();
        }

        return view('faqs.show', compact('faq'));
    }

    public function create()
    {
        return view('faqs.create');
    }

    public function store(Request $request)
    {
        if (!session()->has('username')) {
            abort(403, 'No authenticated user.');
        }

        $username = session('username');

        $user = User::firstOrCreate(
            ['name' => $username]
        );

        Faq::create([
            'pregunta' => $request->input('pregunta'),
            'usuari_id' => $user->id,
        ]);

        return redirect()->route('faqs.index');
    }
}

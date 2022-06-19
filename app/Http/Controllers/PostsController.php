<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Postagem;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function novo()
    {
        return view('novo');
    }

    public function store(Request $request)
    {
        $postagem = Postagem::create([
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'imagem' => $request->imagem->store('images', 'public'),
            'ativa' => $request->ativa
        ]);
        return $postagem;
    }

    public function destroy(Postagem $postagem)
    {
        $postagem->delete();
    }

    public function publicar(Postagem $postagem)
    {
        $postagem->update([
            'ativa' => 'S'
        ]);
    }
}

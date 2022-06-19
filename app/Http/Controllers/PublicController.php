<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Postagem;

class PublicController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $postagens = Postagem::where('ativa', 'S')->get();
        return view('public', ['postagens' => $postagens]);
    }

    public function postagem(Postagem $postagem)
    {
        return view('public_post', ['postagem' => $postagem]);
    }
}

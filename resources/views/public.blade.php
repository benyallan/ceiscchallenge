@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Postagens</div>

                <div class="card-body">
                    <b>|| Adicione aqui as postagens ativas ||</b>
                    @foreach ($postagens as $postagem)
                        <div class="card" style="width: 18rem;">
                            <img src="{{ Storage::url($postagem->imagem) }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{ $postagem->titulo }}</h5>
                                <p class="card-text">{{ $postagem->descricao }}</p>
                                <a href="{{ route('posts.show', ['postagem' => $postagem]) }}" class="btn btn-primary">Abrir postagem</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Postagens</div>

                <button type="button" class="btn btn-labeled btn-success col-2 m-2" onclick="window.location='{{ URL::to('posts/novo') }}'">
                    + Nova
                </button>

                <div class="card-body">
                    <b>|| Adicione aqui uma listagem de postagens, com botão de publicar e remover ||</b>
                    @foreach ($postagens as $postagem)
                        <div 
                            class="card" 
                            style="width: 18rem;"
                            id="post-{{$postagem->id}}"
                        >
                            <a href="{{ route('posts.show', ['postagem' => $postagem]) }}">
                                <img src="{{ Storage::url($postagem->imagem) }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $postagem->titulo }}</h5>
                                    <p class="card-text">{{ $postagem->descricao }}</p>
                                </div>
                            </a>
                            @if ($postagem->ativa == "S")
                                <span id="visibilidade-{{$postagem->id}}">Postagem pública</span>
                            @else
                                <span id="visibilidade-{{$postagem->id}}">Postagem não publicada</span>
                            @endif
                            <div class="card-footer">
                                <a href="{{route('posts.edit', $postagem->id)}}"
                                class="btn btn-info"
                                >
                                    Editar
                                </a>
                                @if ($postagem->ativa == "N")
                                    <button 
                                        id="btnPublicar-{{$postagem->id}}"
                                        type="button" 
                                        class="btn btn-primary"
                                        onclick="publicar({{$postagem->id}})"
                                    >
                                        Publicar
                                    </button>
                                @endif
                                <button 
                                    type="button" 
                                    class="btn btn-danger"
                                    onclick="remover({{$postagem->id}})"
                                >
                                    Remover
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script type="text/javascript">
    function publicar(postagem) {
        var metas = document.getElementsByTagName('meta');
        let ajax = new XMLHttpRequest();
        ajax.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("visibilidade-" + postagem)
                    .innerHTML = 'Postagem pública';
                document.getElementById("btnPublicar-" + postagem)
                    .remove();
            }
        };
        let url = "{{url('/posts')}}"
        url += "/" + postagem + "/publicar";
        ajax.open('PUT', url);
        ajax.setRequestHeader("X-CSRF-Token", metas[2].getAttribute("content"));
        ajax.send(postagem);
    }

    function remover(postagem) {
        var metas = document.getElementsByTagName('meta');
        let ajax = new XMLHttpRequest();
        ajax.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("post-" + postagem).remove();
            }
        };
        let url = "{{url('/posts')}}"
        url += "/" + postagem;
        console.log(url);
        ajax.open('DELETE', url);
        ajax.setRequestHeader("X-CSRF-Token", metas[2].getAttribute("content"));
        ajax.send(postagem);
    }
</script>

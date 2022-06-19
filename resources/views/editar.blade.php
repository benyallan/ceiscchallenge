@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar postagem</div>

                <div class="card-body">
                    <form 
                        name="form-add-post" id="form-add-post" 
                        enctype="multipart/form-data"
                    >
                    @csrf
                    <div class="form-group">
                        <label for="titulo">Título: </label>
                        <input 
                            class="form-control" type="text" 
                            name="titulo" id="titulo"
                            value="{{$postagem->titulo}}"
                        >
                    </div>
                    <div class="form-group">
                        <label for="descricao">Descrição: </label>
                        <textarea 
                            class="form-control"
                            name="descricao" id="descricao" cols="30" rows="10"
                        >{{$postagem->descricao}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="imagem">Imagem: </label>
                        <img 
                            src="{{ Storage::url($postagem->imagem) }}" 
                            class="card-img-top" alt="imagem"
                        >
                        <input 
                            class="form-control-file" type="file" 
                            name="imagem" id="imagem"
                        >
                    </div>
                    <div class="form-group">
                        <label for="ativa">Pública: </label>
                        <select class="form-control" name="ativa" id="ativa">
                            @if ($postagem->ativa == "S")
                                <option value="S">Sim</option>
                                <option value="N">Não</option>
                            @else
                                <option value="N">Não</option>
                                <option value="S">Sim</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <button 
                            class="btn btn-primary"
                            name="btnAtualizar" id="btnAtualizar"
                            onclick="sendForm(event, {{$postagem->id}})"
                        >
                            Atualizar
                        </button>
                    </div>
                    </form>
                    <br>
                    <div id="result"></div>
                    <div class="bar" style="width: 100%; height:20px">
                        <div 
                            class="progress" 
                            style="background-color: blue; height: 20px; width: 0%"
                        >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script type="text/javascript">
        function sendForm(event, postagem) {
            event.preventDefault();
            var metas = document.getElementsByTagName('meta');
            let frmAddPost = document.querySelector('#form-add-post');
            let ajax = new XMLHttpRequest();
            let formData = new FormData(frmAddPost);
            let btnAtualizar = document.querySelector('#btnAtualizar');
            let result = document.querySelector('#result');
            let progress = document.querySelector('.progress');

            let url = "{{url('/posts')}}"
            url += "/" + postagem;
            console.log(formData);
            ajax.open('POST', url);
            ajax.setRequestHeader("X-CSRF-Token", metas[2].getAttribute("content"));
            ajax.upload.onprogress = function (event) {
                if (event.lengthComputable) {
                    progress.style.width = ((event.loaded * 100) / event.total) + "%";
                }
            }
            ajax.onloadend = function () {
                result.innerHTML = 'Postagem atualizada com sucesso';
            }
            ajax.send(formData);
        }
</script>


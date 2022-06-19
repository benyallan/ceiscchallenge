@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Nova postagem</div>

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
                        >
                    </div>
                    <div class="form-group">
                        <label for="descricao">Descrição: </label>
                        <textarea 
                            class="form-control"
                            name="descricao" id="descricao" cols="30" rows="10"
                        ></textarea>
                    </div>
                    <div class="form-group">
                        <label for="imagem">Imagem: </label>
                        <input 
                            class="form-control-file" type="file" 
                            name="imagem" id="imagem"
                        >
                    </div>
                    <div class="form-group">
                        <label for="ativa">Pública: </label>
                        <select class="form-control" name="ativa" id="ativa">
                            <option value="S">Sim</option>
                            <option value="N">Não</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button 
                            class="btn btn-primary"
                            name="btnPostar" id="btnPostar"
                            onclick="sendForm(event)"
                        >
                            Postar
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
        function sendForm(event) {
            event.preventDefault();
            let frmAddPost = document.querySelector('#form-add-post');
            let ajax = new XMLHttpRequest();
            let formData = new FormData(frmAddPost);
            let btnPostar = document.querySelector('#btnPostar');
            let result = document.querySelector('#result');
            let progress = document.querySelector('.progress');

            ajax.open('POST', "{{route('posts.store')}}");
            ajax.upload.onprogress = function (event) {
                if (event.lengthComputable) {
                    progress.style.width = ((event.loaded * 100) / event.total) + "%";
                }
            }
            ajax.onloadend = function () {
                result.innerHTML = 'Foto carregada com sucesso';
            }
            ajax.send(formData);
        }
</script>


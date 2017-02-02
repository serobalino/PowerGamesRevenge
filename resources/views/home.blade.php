@extends('layouts.main')
@section('c1')
    <div id="listajuegos"></div>
@endsection
@section('c2')
    <div class="card ">
        <div class="card-content">
            <div class="row">
                <div class="input-field">
                    <label for="textarea1">Que estas pensando</label>
                    <textarea class="materialize-textarea"></textarea>
                </div>
            </div>
        </div>
        <div class="card-action">
            <button class="publicar btn">Publicar</button>
        </div>
    </div>
    <div id="publicaciones"></div>
@endsection
@section('c3')
@endsection
@section('js')
    <script src="js/init.js"></script>
    <script src="js/publicaciones.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            var hash = window.location.hash;
            console.log(hash);
            if (hash == "#login")
                $('#modal1').openModal();
        });
    </script>
@endsection

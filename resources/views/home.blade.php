@extends('layouts.main')
@section('c1')
@endsection
@section('c2')
    <div class="card ">
        <div class="card-content">
            <div class="row">
                <div class="input-field">
                    <label for="textarea1">Que estas pensando</label>
                    <textarea id="textarea1" class="materialize-textarea"></textarea>
                </div>
            </div>

        </div>
        <div class="card-action">
            <a href="#">Publicar</a>
            <a href="#">Jugar</a>
        </div>
    </div>
@endsection
@section('c3')
@endsection
@section('js')
    <script src="js/init.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            var hash = window.location.hash;
            console.log(hash);
            if (hash == "#login")
                $('#modal1').openModal();
        });
    </script>
@endsection

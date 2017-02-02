$( document ).ready(function() {
    cargarPublicaciones();
    listarjuegos();
    $('.publicar').click(function(){
        nuevaPublicacione();
    });
    $('#b_juegos').click(function(){
        buscarjuego();
    });


});
function cargarPublicaciones(){
    const id_usr=$('#usr_id').val();
    const div='#publicaciones';
    const url_api="/api/publicaciones/";

    $(div).html('<div class="progress"><div class="indeterminate"></div></div>');
    $.ajax({
        type: "GET",
        url: url_api+id_usr,
        //data: "new=ciudad",
        success: function (data){
            var texto='<ul class="collapsible popout" data-collapsible="accordion">';
            $.each(data.mensaje, function (numero,valor) {
                var like='',retar='',eliminar='',nlike='';
                if(valor.megu)
                    like    ='<button class="waves-effect waves-teal btn-flat disabled" onclick="megusta('+valor.id_pub+')"><i class="material-icons left">thumb_up</i>Me gusta</button>';
                else
                    like    ='<button class="waves-effect waves-teal btn-flat" onclick="megusta('+valor.id_pub+')"><i class="material-icons left">thumb_up</i>Me gusta</button>';
                if(!valor.reta)
                    retar   ='<button class="waves-effect waves-teal btn-flat" onclick="retar('+valor.id_pub+')"><i class="material-icons left">thumbs_up_down</i>Retar</button>';
                titulo=valor.name;
                if(valor.owner){
                    eliminar='<button class="waves-effect waves-teal btn-floating grey" onclick="eliminar('+valor.id_pub+')"><i class="material-icons left">delete</i> </button>';
                    titulo="Tu";
                }
                if(valor.likesn>0)
                    nlike   ='<div class="right-align hide-on-small-only"><div class="chip">Likes '+valor.likesn+'</div></div>'
                botones=like+retar+eliminar+nlike;
                texto+='<li><div class="collapsible-header">'+titulo+'</div><div class="collapsible-body">  '+valor.detalle_pub+'<div class="card-action">'+botones+'</div></div></li>';
            });
            texto+='</ul>';
            $(div).html(texto);
            $('.collapsible').collapsible();
        },
        error: function (datos){
            Materialize.toast('Ooops! a ocurrído un error al cargar los datos',4000);
            console.log(datos);
        }
    });
}
function nuevaPublicacione(){
    const id_usr=$('#usr_id').val();
    const url_api="/api/publicaciones";
    var texto=$('textarea').val();
    if(texto!=''){
        $.ajax({
            type: "POST",
            url: url_api,
            data:{'id_usr':id_usr,'publicacion':texto},
            success: function (data){
                Materialize.toast(data.mensaje,4000);
                $('textarea').html('');
                if(data.return)
                    cargarPublicaciones();
            },
            error: function (datos){
                Materialize.toast('Ooops! a ocurrído un error',4000);
                console.log(datos);
            }
        });
    }else{
        Materialize.toast('🤔 Debes escribir algo para publicar!',4000);
    }

}
function megusta(idpublicacion){
    const id_usr=$('#usr_id').val();
    const url_api="/api/megusta";
    $.ajax({
        type: "POST",
        url: url_api,
        data:{'id_usr':id_usr,'id_pub':idpublicacion},
        success: function (data){
            Materialize.toast(data.mensaje,4000);
        },
        error: function (datos){
            Materialize.toast('Ooops! a ocurrído un error',4000);
            console.log(datos);
        }
    });
    cargarPublicaciones();
}
function eliminar(idpublicacion){
    const url_api="/api/publicaciones/";
    $.ajax({
        type: "DELETE",
        url: url_api+idpublicacion,
        success: function (data){
            Materialize.toast(data.mensaje,4000);
            cargarPublicaciones();
        },
        error: function (datos){
            Materialize.toast('Ooops! a ocurrído un error',4000);
            console.log(datos);
        }
    });
}
function retar(idpublicacion){
    const id_usr=$('#usr_id').val();
    const url_api="/api/retar";
    $.ajax({
        type: "POST",
        url: url_api,
        data:{'id_usr':id_usr,'id_pub':idpublicacion},
        success: function (data){
            Materialize.toast(data.mensaje,4000);
        },
        error: function (datos){
            Materialize.toast('Ooops! a ocurrído un error',4000);
            console.log(datos);
        }
    });
    cargarPublicaciones();
}
function listarjuegos(){
    const id_usr=$('#usr_id').val();
    const url_api="/api/juegos";
    $.ajax({
        type: "GET",
        url: url_api,
        data:{'id_usr':id_usr},
        success: function (data){
            var html='';
            $.each(data.mensaje, function (numero,valor) {
                imagen=valor.api[1];
                console.log(valor);
                etimg='<i class="material-icons circle">folder</i>';
                if(imagen!=undefined)
                    etimg='<img src="'+imagen.cover.url+'">';
                html+='<div class="row"><div class="card horizontal"><div class="card-image">'+etimg+'</div><div class="card-stacked"><div class="card-content"><p>'+valor.titulo_ju+'</p></div></div></div></div>'
            });
            $('#listajuegos').html(html);
        }
    });

}
function buscarjuego(){
    $('#cuerpo_juego').html('<div class="center-align"><div class="preloader-wrapper big active"><div class="spinner-layer spinner-red-only"> <div class="circle-clipper left"> <div class="circle"></div> </div><div class="gap-patch"> <div class="circle"></div> </div><div class="circle-clipper right"> <div class="circle"></div> </div> </div> </div></div>');
    $('#modal2').openModal();
    formulario=' <div class="row"> <form class="col s12"> <div class="row"> <div class="input-field col s10"> <i class="material-icons prefix">games</i> <input id="texto_juego" type="text" class="validate"> <label for="icon_prefix">Juego</label> </div> <button class="waves-effect waves-light btn black" type="button" id="juegos_query"><i class="material-icons right">search</i> Buscar</button></div> </form> </div><div id="lista_juegos_api"></div>';
    $('#cuerpo_juego').html(formulario);
    $('#juegos_query').click(function(){
        resultadobusqueda();
    });
}
function resultadobusqueda(){
    const id_usr=$('#usr_id').val();
    var query=$('#texto_juego').val();
    if(query!=''){
        var url_api='/api/juegos/'+query;
        $.ajax({
            type: "GET",
            url: url_api,
            data:{'id_usr':id_usr},
            success: function (data){
                console.log(data);
                var html='<ul class="collection">';
                $.each(data.mensaje, function (numero,valor) {
                    imagen='<i class="material-icons circle">folder</i>';
                    nombre='';
                    resumen='';
                    if(valor.cover!=undefined)
                        imagen='<img src="'+valor.cover.url+'" alt="" class="cicle"/>';
                    if(valor.name!=undefined)
                        nombre=valor.name;
                    if(valor.summary!=undefined)
                        resumen=valor.summary;
                    html+='<li class="collection-item avatar">'+imagen+'<span class="title">'+nombre+'</span><p>'+resumen+'</p><button class="secondary-content" onclick="guardarJuego('+valor.id+',\''+valor.name+'\')"><i class="material-icons">done</i></button></li>';
                });
                $('#lista_juegos_api').html(html+'</ul>');
            }
        });
    }else{
        Materialize.toast('🤔 Debes escribir algo para buscar!',4000);
    }

}
function guardarJuego(id_juego,titulo){
    const id_usr=$('#usr_id').val();
    var url_api='/api/juegos';
    $.ajax({
        type: "POST",
        url: url_api,
        data:{'id_usr':id_usr,'id_jue':id_juego,'titulo':titulo},
        success: function (data){
            Materialize.toast(data.mensaje,4000);
            listarjuegos();
            $('#lista_juegos_api').html('');
        }
    });
}
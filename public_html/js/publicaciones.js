$( document ).ready(function() {
    cargarPublicaciones();
    $('.publicar').click(function(){
        nuevaPublicacione();
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
                $('textarea').empty();
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
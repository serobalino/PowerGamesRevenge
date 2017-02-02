(function($){
  $(function(){
    $('.button-collapse').sideNav();
    $('.parallax').parallax();

    $('#textarea1').trigger('autoresize');
    $(".menuamigos").sideNav();
      const url_car="/api/carusel";
      $.ajax({
          type: "GET",
          url: url_car,
          success: function (data){
              var imagenes='';
              $.each(data, function (numero,valor) {
                  if(valor.image!=undefined)
                    imagenes+='<a class="carousel-item"><img src="'+valor.image+'"/></a>';
              });
              $('#images').html(imagenes);
              $('.carousel.carousel-slider').carousel({full_width: true});
          }
      });
  });
})(jQuery);
autoplay()
function autoplay() {
    $('.carousel').carousel('next');
    setTimeout(autoplay, 4500);
}
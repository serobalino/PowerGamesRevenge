(function($){
  $(function(){
    $('.button-collapse').sideNav();
    $('.parallax').parallax();
    $('.carousel.carousel-slider').carousel({full_width: true});
    $('#textarea1').trigger('autoresize');
    $(".menuamigos").sideNav();


  });
})(jQuery);
autoplay()
function autoplay() {
    $('.carousel').carousel('next');
    console.log('cambio de imagen');
    setTimeout(autoplay, 4500);
}

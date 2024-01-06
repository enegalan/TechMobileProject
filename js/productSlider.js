$(document).ready(function() {
    $('.autoWidth').lightSlider({
        autoWidth:true,
        onSliderLoad: function() {
            $('.autoWidth').removeClass('cS-hidden');
        } 
    });  
  });

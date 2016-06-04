jQuery(function($){
   $( '#menu-btn' ).click(function(){
      $('#mobile-nav').toggleClass('show');
      $('#menu-btn').text($('#menu-btn').text() == '☰' ? 'X' : '☰'); 
      return false;
   });
});

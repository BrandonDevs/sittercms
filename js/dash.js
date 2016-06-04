jQuery(function($){
   $( '#dash-new-btn' ).click(function(){
      $('#dash-new').toggleClass('dash-show');
      $('#dash-new-btn').text($('#dash-new-btn').text() == 'New' ? 'New:' : 'New'); 
      return false;
    });
});

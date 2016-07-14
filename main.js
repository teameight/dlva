jQuery(document).ready(function($){

	$.preloadImages = function() {
  for (var i = 0; i < arguments.length; i++) {
    $("<img />").attr("src", "/wp-content/themes/kidsplanet_child/infographics/" + arguments[i]);
  }
}

$.preloadImages("15643-anim.gif", "3200-anim.gif", "4mil-anim.gif", "60percent-anim.gif");

    // $('.infographic').hover( function(){

    // 	var original = $(this).find('img').attr('src');
    // 	var anim = original.replace('.png', '-anim.gif');

    // 	$(this).find('img').attr('src', anim);

    // }, function() {

    // 	var anim = $(this).find('img').attr('src');
    // 	var original = original.replace('-anim.gif', '.png');

    // 	$(this).find('img').attr('src', original);

    // });

    $('.infographic').on('mouseover', function() {
    	var original = $(this).find('img').attr('src');
    	var anim = original.replace('.png', '-anim.gif');

    	$(this).find('img').attr('src', anim);
    });

});
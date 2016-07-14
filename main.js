jQuery(document).ready(function($){

	console.log('jquery');

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
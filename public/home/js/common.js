$(function(){

	//导航下拉
	$('.nav > li').mouseenter(function() {
		$(this).children('.link,.sub').slideDown('400');
		$(this).children('a').addClass('active');
	}).mouseleave(function() {
		$(this).children('.link,.sub').hide();
		$(this).children('a').removeClass('active');
	});;


});



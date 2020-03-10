/*
 *  Nariya App 1.0 - by Amina
 *
 *  Copyright (c) 2015 Amina
 *  http://amina.co.kr
 *
 */

(function($) {
	$.fn.nariya_menu = function(option) {
        var cfg = { name: '.sub', show: '', hide: '' };

		if(typeof option == "object")
            cfg = $.extend(cfg, option);

		var subname = cfg.name;
		var submenu = $(this).find(subname).parent();

		submenu.each(function(i){
			$(this).hover(
				function(e){
					var targetmenu = $(this).children(subname + ":eq(0)");
					if (targetmenu.queue().length <= 1) {
						switch(cfg.show) {
							case 'show'  : targetmenu.show(); break;
							case 'fade'  : targetmenu.fadeIn(300, 'swing'); break;
							default		 : targetmenu.slideDown(300, 'swing'); break;
						}
					}
				},
				function(e){
					var targetmenu = $(this).children(subname + ":eq(0)");
					switch(cfg.hide) {
						case 'fade'		: targetmenu.fadeOut(100, 'swing'); break;
						case 'slide'	: targetmenu.slideUp(100, 'swing'); break;
						default			: targetmenu.hide(); break;
					}
				}
			) //end hover
			$(this).click(function(){
				$(this).children(subname + ":eq(0)").hide();
			})
		}); //end submenu.each()

		$(this).find(subname).css({display:"none", visibility:"visible"});
	}
}(jQuery));

$(document).ready(function() {
	$('#nt_menu .nav-slide').nariya_menu({name:'.sub-slide', show: 'slide', hide: 'hide'});
});

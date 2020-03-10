$(document).ready(function() {
	// Top & Bottom Button
	$(window).scroll(function(){
		if ($(this).scrollTop() > 250) {
			$('#nt_top').fadeIn();
		} else {
			$('#nt_top').fadeOut();
		}
	});

	$('#nt_top .go-top').on('click', function () {
		$('html, body').animate({ scrollTop: '0px' }, 500);
		return false;
	});

	$('#nt_top .go-bottom').on('click', function () {
		$('html, body').animate({ scrollTop: $(document).height() }, 500);
		return false;
	});

});


function tsearch_submit(f) {
	if (f.stx.value.length < 2) {
		alert("검색어는 두글자 이상 입력하십시오.");
		f.stx.select();
		f.stx.focus();
		return false;
	}
	return true;
}

$(document).ready(function() {

	// Tooltip
    $('body').tooltip({
		selector: "[data-toggle='tooltip']"
    });

	// Top & Bottom Button
	$(window).scroll(function(){
		if ($(this).scrollTop() > 250) {
			$('#go_btn').fadeIn();
		} else {
			$('#go_btn').fadeOut();
		}
	});

	$('.go-top').on('click', function () {
		$('html, body').animate({ scrollTop: '0px' }, 500);
		return false;
	});

	$('.go-bottom').on('click', function () {
		$('html, body').animate({ scrollTop: $(document).height() }, 500);
		return false;
	});

});

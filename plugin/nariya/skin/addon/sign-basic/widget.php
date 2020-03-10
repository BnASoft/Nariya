<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$widget_url.'/widget.css">', 0);

global $view, $signature;
?>

<!-- 회원서명 시작 { -->
<div class="bo_signature text-right">
	<h3 class="sound_only">회원서명</h3>
	<span class="bo_signature_title">SIGNATURE</span>
	<div class="bo_signature_content">
		<pre><p class="f-small"><?php echo $signature ?></p></pre>
	</div>
	<div class="bo_signature_expand f-small">
		<span class="bo_signature_open">서명 더보기 <span class="fa fa-caret-down"></span></span>
		<span class="bo_signature_close">서명 가리기 <span class="fa fa-caret-up"></span></span>
	</div>
</div>
<script>
	var bo_signature_expand = function() {
		var h = $('.bo_signature_content pre').outerHeight();
		if (h > 80) {
			$('.bo_signature_expand').show();
		} else {
			$('.bo_signature_expand').hide();
		}
	}

	$(function() {
		$('.bo_signature .bo_signature_expand').click(function(){
			$('.bo_signature').toggleClass('expanded');
		});

		bo_signature_expand();

		$(window).resize(function() {
			bo_signature_expand();
		});
	});
</script>
<!-- } 회원서명 끝 { -->
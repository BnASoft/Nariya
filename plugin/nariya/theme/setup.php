<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>
<!-- 셋업 모달 시작 { -->
<div class="modal fade" id="setupModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div id="setupBox" class="modal-dialog modal-lg">
		<div id="setupWin"></div>
	</div>
</div>
<script>
// iframe에서 모달창 닫기용
window.closeSetupModal = function() {
	$('#setupModal').modal('hide');
}
$(function(){
	$(document).on('click', '.widget-setup', function() {
		var wsetup = $('.btn-wset');
		if(wsetup.is(":visible")){
			wsetup.hide();
		} else {
			wsetup.show();
		}
		return false;
	});
	$(document).on('click', '.btn-setup', function() {
		<?php if($is_clip_modal) { ?>
			$("#setupWin").html('<iframe src="' + this.href + '"></iframe>');
			$('#setupModal').modal('show');
		<?php } else { ?>
			na_win('setup', this.href, 800, 800);
		<?php } ?>
		return false;
	});
});
</script>
<!-- 셋업 모달 끝 { -->

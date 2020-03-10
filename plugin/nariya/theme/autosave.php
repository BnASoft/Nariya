<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>
<!-- 임시 저장글 모달 { -->
<div class="modal fade" id="saveModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div id="autosave_wrapper">
			<script src="<?php echo NA_PLUGIN_URL; ?>/js/autosave.js"></script>
			<?php if($editor_content_js) echo $editor_content_js; ?>
			<div id="autosave_pop">
				<div class="bg-navy" style="padding:10px 15px;">
					<button type="button" class="close white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong><i class="fa fa-repeat" aria-hidden="true"></i> 임시 저장된 글 목록</strong>
				</div>
				<ul class="list-group no-margin"></ul>
			</div>
		</div>
	</div>
</div>
<!-- 임시 저장글 모달 끝 { -->
<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);

?>
<div id="scrap_do" class="win-cont">
    <h2 class="win-title">
		<button type="button" onclick="javascript:window.close();" class="btn btn_b01 pull-right" title="창닫기">
			<i class="fa fa-times" aria-hidden="true"></i>
			<span class="sound_only">창닫기</span>
		</button>

		<img src="<?php echo na_member_photo($member['mb_id']) ?>" alt="">
		스크랩하기
	</h2>

	<form class="form" role="form" name="f_scrap_popin" action="./scrap_popin_update.php" method="post">
	<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
	<input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
		<ul class="list-group">
			<li class="list-group-item bg-<?php echo NT_COLOR ?> ellipsis">
				<?php echo get_text(cut_str($write['wr_subject'], 255)) ?>
			</li>
			<li class="list-group-item" style="border-bottom:0">
				<textarea name="wr_content" id="wr_content" rows="5" class="form-control" placeholder="감사 혹은 격려의 댓글을 남겨 주세요."></textarea>

				<div class="h15"></div>

				<p class="text-center">
					<button type="button" onclick="window.close();" class="btn btn-sm btn-white">창닫기</button>
					<button type="submit" class="btn btn-<?php echo NT_COLOR ?> btn-sm">스크랩 확인</button>
				</p>
			</li>
		</ul>
	</form>

	<div class="h20"></div>
</div>
<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<!-- 쪽지 목록 시작 { -->
<div id="memo_list" class="win-cont">
    <h2 class="win-title">
		<button type="button" onclick="javascript:window.close();" class="btn btn_b01 pull-right" title="창닫기">
			<i class="fa fa-times" aria-hidden="true"></i>
			<span class="sound_only">창닫기</span>
		</button>

		<img src="<?php echo na_member_photo($member['mb_id']) ?>" alt="">
		<?php echo $g5['title'] ?>
	</h2>

	<style>
		#memo_list .btn-group .btn { border-radius:0 !important; }
	</style>
	<div class="btn-group btn-group-justified">
		<a href="./memo.php?kind=recv" class="btn btn-sm btn-<?php echo NT_COLOR ?><?php echo ($kind == "recv") ? ' active' : '';?>">받은쪽지</a>
		<a href="./memo.php?kind=send" class="btn btn-sm btn-<?php echo NT_COLOR ?><?php echo ($kind == "send") ? ' active' : '';?>">보낸쪽지</a>
		<a href="./memo_form.php" class="btn btn-sm btn-<?php echo NT_COLOR ?><?php echo ($kind == "") ? ' active' : '';?>">쪽지쓰기</a>
	</div>
	<div class="memo_list">
		<ul class="list-group f-small no-margin">
			<li class="list-group-item">
				전체 <?php echo $kind_title ?>쪽지 <b><?php echo $total_count ?></b>통 / <?php echo $page ?>페이지
			</li>
			<?php
			for ($i=0; $i<count($list); $i++) {
			$readed = (substr($list[$i]['me_read_datetime'],0,1) == 0) ? '' : 'read';
			$memo_preview = utf8_strcut(strip_tags($list[$i]['me_memo']), 30, '..');
			?>
			<li class="tr list-group-item">
				<div class="td icon">
					<a href="<?php echo $list[$i]['view_href']; ?>" class="bg-<?php echo ($readed) ? 'readed' : NT_COLOR ?>">
						<?php if($readed) { ?>
							<i class="fa fa-envelope-open-o" aria-hidden="true"></i>
							<span class="sound_only">읽은 쪽지</span>
						<?php } else { ?>
							<i class="fa fa-envelope-o" aria-hidden="true"></i>
							<span class="sound_only">안 읽은 쪽지</span>
						<?php } ?>
					</a>
				</div>
				<div class="td memo_cont">
					<a href="<?php echo $list[$i]['del_href']; ?>" onclick="del(this.href); return false;" class="pull-right win-del" title="삭제">
						<i class="fa fa-trash-o" aria-hidden="true"></i>
						<span class="sound_only">삭제</span>
					</a>

					<?php echo na_name_photo($list[$i]['mb_id'], $list[$i]['name']) ?>

					<span class="text-muted">
						&nbsp;
						<i class="fa fa-clock-o" aria-hidden="true"></i>
						<?php echo $list[$i]['send_datetime']; ?>
					</span>

					<p class="ellipsis">
						<a href="<?php echo $list[$i]['view_href']; ?>">
							<span class="text-muted"><?php echo $memo_preview; ?></span>
						</a>
					</p>
				</div>	
			</li>
			<?php } ?>
			<?php if ($i==0) { echo '<li class="empty_list">자료가 없습니다.</li>'; }  ?>
			<li class="list-group-item bg-light text-center">
				쪽지 보관일수는 최장 <strong><?php echo $config['cf_memo_del'] ?></strong>일 입니다.
			</li>
		</ul>
	</div>

	<div class="text-center na-page pg-<?php echo NT_COLOR ?>">
		<ul class="pagination pagination-sm en">
			<?php echo na_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "./memo.php?kind=$kind".$qstr."&amp;page=") ?>
		</ul>
	</div>

	<p class="text-center">
		<button type="button" onclick="window.close();" class="btn btn-sm btn-white">창닫기</button>
	</p>

	<div class="h30"></div>

</div>
<!-- } 쪽지 목록 끝 -->
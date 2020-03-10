<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$nick = na_name_photo($mb['mb_id'], get_sideview($mb['mb_id'], $mb['mb_nick'], $mb['mb_email'], $mb['mb_homepage']));

if($kind == "recv") {
    $kind_str = "보낸";
    $kind_date = "받은";
}
else {
    $kind_str = "받는";
    $kind_date = "보낸";
}

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);

?>

<div id="memo_view" class="win-cont">
    <h2 class="win-title">
		<button type="button" onclick="javascript:window.close();" class="btn btn_b01 pull-right" title="창닫기">
			<i class="fa fa-times" aria-hidden="true"></i>
			<span class="sound_only">창닫기</span>
		</button>

		<img src="<?php echo na_member_photo($member['mb_id']) ?>" alt="">
		<?php echo $g5['title'] ?>
	</h2>

	<style>
		#memo_view .btn-group .btn { border-radius:0 !important; }
	</style>
	<div class="btn-group btn-group-justified">
		<a href="./memo.php?kind=recv" class="btn btn-sm btn-<?php echo NT_COLOR ?><?php echo ($kind == "recv") ? ' active' : '';?>">받은쪽지</a>
		<a href="./memo.php?kind=send" class="btn btn-sm btn-<?php echo NT_COLOR ?><?php echo ($kind == "send") ? ' active' : '';?>">보낸쪽지</a>
		<a href="./memo_form.php" class="btn btn-sm btn-<?php echo NT_COLOR ?><?php echo ($kind == "") ? ' active' : '';?>">쪽지쓰기</a>
	</div>
	<ul class="list-group">
		<li class="list-group-item clearfix bg-light f-small">
		    <span class="pull-left">
				<?php echo $nick ?>
			</span>
			<span class="pull-right text-muted">
				<i class="fa fa-clock-o" aria-hidden="true"></i>
				<?php echo $memo['me_send_datetime'] ?>
			</span>
		</li>
		<li class="list-group-item">
			<?php echo na_content(conv_content($memo['me_memo'], 0)) ?>
		</li>
	</ul>

	<div class="text-center">
		<?php if($prev_link) {  ?>
			<a href="<?php echo $prev_link ?>" class="btn btn-<?php echo NT_COLOR ?> btn-sm">이전</a>
		<?php }  ?>
		<?php if($next_link) {  ?>
		<a href="<?php echo $next_link ?>" class="btn btn-<?php echo NT_COLOR ?> btn-sm">다음</a>
		<?php }  ?>
		<?php if ($kind == 'recv') {  ?>
			<a href="./memo_form.php?me_recv_mb_id=<?php echo $mb['mb_id'] ?>&amp;me_id=<?php echo $memo['me_id'] ?>"  class="btn btn-<?php echo NT_COLOR ?> btn-sm">답장</a>
		<?php }  ?>
		<a href="./memo.php?kind=<?php echo $kind ?><?php echo $qstr;?>" class="btn btn-<?php echo NT_COLOR ?> btn-sm">목록</a>
		<button type="button" onclick="window.close();" class="btn btn-white btn-sm">닫기</button>
	</div>

	<div class="h30"></div>
</div>
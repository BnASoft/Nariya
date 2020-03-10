<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);

?>

<div id="memo_write" class="win-cont">
    <h2 class="win-title">
		<button type="button" onclick="javascript:window.close();" class="btn btn_b01 pull-right" title="창닫기">
			<i class="fa fa-times" aria-hidden="true"></i>
			<span class="sound_only">창닫기</span>
		</button>

		<img src="<?php echo na_member_photo($member['mb_id']) ?>" alt="">
		<?php echo $g5['title'] ?>
	</h2>

	<style>
		#memo_write .btn-group .btn { border-radius:0 !important; }
	</style>
	<div class="btn-group btn-group-justified">
		<a href="./memo.php?kind=recv" class="btn btn-sm btn-<?php echo NT_COLOR ?><?php echo ($kind == "recv") ? ' active' : '';?>">받은쪽지</a>
		<a href="./memo.php?kind=send" class="btn btn-sm btn-<?php echo NT_COLOR ?><?php echo ($kind == "send") ? ' active' : '';?>">보낸쪽지</a>
		<a href="./memo_form.php" class="btn btn-sm btn-<?php echo NT_COLOR ?><?php echo ($kind == "") ? ' active' : '';?>">쪽지쓰기</a>
	</div>

	<form class="form-horizontal" role="form" name="fmemoform" action="<?php echo $memo_action_url; ?>" onsubmit="return fmemoform_submit(this);" method="post" autocomplete="off">

	<ul class="list-group">
		<?php if ($config['cf_memo_send_point']) { ?>
		<li class="list-group-item bg-light f-small">
			쪽지 보낼때 회원당 <b><?php echo number_format($config['cf_memo_send_point']); ?></b> 포인트를 차감합니다.
		</li>
		<?php } ?>
		<li class="list-group-item">

			<div class="form-group">
				<label class="col-sm-2 control-label" for="me_recv_mb_id">받는 회원<strong class="sound_only">필수</strong></label>
				<div class="col-sm-10">
					<input type="text" name="me_recv_mb_id" value="<?php echo $me_recv_mb_id ?>" id="me_recv_mb_id" required class="form-control" placeholder="여러 회원에게 보낼때는 회원아이디를 컴마(,)로 구분">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label" for="me_memo">쪽지 내용<strong class="sound_only">필수</strong></label>
				<div class="col-sm-10">
					<textarea name="me_memo" id="me_memo" rows="5" required class="form-control"><?php echo $content ?></textarea>
				</div>
			</div>

			<div class="text-center">
				<?php echo captcha_html(); ?>
			</div>
		</li>
	</ul>

	<p class="text-center">
		<button type="button" onclick="window.close();" class="btn btn-sm btn-white">창닫기</button>
		<button type="submit" id="btn_submit" class="btn btn-sm btn-<?php echo NT_COLOR ?>">보내기</button>
	</p>

	</form>

	<div class="h30"></div>

</div>

<script>
function fmemoform_submit(f) {

    <?php echo chk_captcha_js();  ?>

    return true;
}
</script>

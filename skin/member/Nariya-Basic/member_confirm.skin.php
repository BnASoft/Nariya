<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

@include_once(G5_THEME_PATH.'/head.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);

?>

<div id="mb_confirm" class="mbskin<?php echo ($tset['page_sub']) ? ' headsub' : ' no-headsub';?>">
	<form class="form" role="form" name="fmemberconfirm" action="<?php echo $url ?>" onsubmit="return fmemberconfirm_submit(this);" method="post">
	<input type="hidden" name="mb_id" value="<?php echo $member['mb_id'] ?>">
	<input type="hidden" name="w" value="u">

	<ul class="list-group">
		<li class="list-group-item bg-light">
			<b><?php echo $g5['title'] ?></b>
		</li>
		<li class="list-group-item">
			<p><strong>비밀번호를 한번 더 입력해주세요.</strong></p>
			<?php if ($url == 'member_leave.php') { ?>
				<p>비밀번호를 입력하시면 회원탈퇴가 완료됩니다.</p>
			<?php }else{ ?>
				<p>회원님의 정보를 안전하게 보호하기 위해 비밀번호를 한번 더 확인합니다.</p>
			<?php }  ?>
		</li>
		<li class="list-group-item">		
			<div class="form-group" style="margin-bottom:5px;">
				<label><b>회원아이디 : <span id="mb_confirm_id" class="text-primary"><?php echo $member['mb_id'] ?></span></b></label>
				<label class="sound_only" for="confirm_mb_password">비밀번호<strong class="sound_only">필수</strong></label>
				<input type="password" name="mb_password" id="confirm_mb_password" required class="form-control required" maxLength="20">
			</div>
		</li>
	</ul>
	<div class="row row-20">
		<div class="col-xs-6 col-20">
			<a href="<?php echo G5_URL ?>" class="btn btn-white btn-block">
				취소
			</a>
		</div>
		<div class="col-xs-6 col-20">
			<button type="submit" id="btn_sumbit" class="btn btn-<?php echo NT_COLOR ?> btn-block">
				확인
			</button>
		</div>
	</div>
	</form>
</div>

<script>
function fmemberconfirm_submit(f) {
    document.getElementById("btn_submit").disabled = true;

    return true;
}
</script>
<!-- } 회원 비밀번호 확인 끝 -->

<?php
// 헤더, 테일 사용설정
if(!$tset['page_sub'])
	include_once(G5_THEME_PATH.'/tail.php');
?>
<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);

?>

<div id="find_info" class="win-cont">
	<form class="form" role="form" name="fpasswordlost" action="<?php echo $action_url ?>" onsubmit="return fpasswordlost_submit(this);" method="post" autocomplete="off">
	
	<ul class="list-group">
		<li class="list-group-item bg-<?php echo NT_COLOR ?>">
			<strong><i class="fa fa-search fa-lg"></i> 회원정보찾기</strong>
		</li>
		<li class="list-group-item">
			<p class="help-block">
				회원가입 시 등록하신 이메일 주소를 입력해 주세요. 해당 이메일로 아이디와 비밀번호 정보를 보내드립니다.
			</p>

			<div class="form-group">
				<label class="sound_only" for="mb_email">이메일<strong class="sound_only">필수</strong></label>
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
					<input type="text" name="mb_email" id="mb_email" required class="form-control required email" maxlength="100">
				</div>
			</div>

			<div class="text-center">
				<?php echo captcha_html(); ?>
			</div>
		</li>
	</ul>

	<div class="text-center">
		<button type="submit" class="btn btn-<?php echo NT_COLOR ?> btn-sm">확인하기</button>
        <button type="button" class="btn btn-white btn-sm" onclick="window.close();">창닫기</button>
	</div>

	</form>
</div>

<div class="h20"></div>

<script>
function fpasswordlost_submit(f) {
    <?php echo chk_captcha_js();  ?>

    return true;
}

$(function() {
    var sw = screen.width;
    var sh = screen.height;
    var cw = document.body.clientWidth;
    var ch = document.body.clientHeight;
    var top  = sh / 2 - ch / 2 - 100;
    var left = sw / 2 - cw / 2;
    moveTo(left, top);
});
</script>
<!-- } 회원정보 찾기 끝 -->
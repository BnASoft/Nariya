<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 헤더, 테일 사용설정
@include_once(G5_THEME_PATH.'/head.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);

?>

<div id="mb_login" class="mbskin<?php echo ($tset['page_sub']) ? ' headsub' : ' no-headsub';?>">

	<div class="mbskin-cate bg-white">
		<span class="login"><span class="sound_only">회원</span>로그인</span>
		<a href="<?php echo G5_BBS_URL ?>/register.php" class="join">회원가입</a>
	</div>

	<div class="mbskin-box bg-white">
		<form class="form" role="form" name="flogin" action="<?php echo $login_action_url ?>" onsubmit="return flogin_submit(this);" method="post">
		<input type="hidden" name="url" value="<?php echo $login_url ?>">
			<div class="form-group">	
				<label for="login_id" class="sound_only">아이디<strong class="sound_only"> 필수</strong></label>
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-user lightgray" aria-hidden="true"></i></span>
					<input type="text" name="mb_id" id="login_id" required class="form-control required" placeholder="아이디">
				</div>
			</div>
			<div class="form-group">	
				<label for="login_pw" class="sound_only">비밀번호<strong class="sound_only"> 필수</strong></label>
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-lock lightgray" aria-hidden="true"></i></span>
					<input type="password" name="mb_password" id="login_pw" required class="form-control required" placeholder="비밀번호">
				</div>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-<?php echo NT_COLOR ?> btn-block en">
					<b>로그인</b>
				</button>    
			</div>	

			<div class="clearfix text-muted">
				<span class="pull-left">
					<label class="checkbox-inline">
						<input type="checkbox" name="auto_login" value="1" id="login_auto_login"> 자동로그인
					</label>
				</span>
				<span class="pull-right">
					<a href="<?php echo G5_BBS_URL ?>/password_lost.php" class="win_password_lost" id="login_password_lost"><span class="text-muted">회원정보찾기</span></a>
				</span>
			</div>
		</form>

		<?php @include (get_social_skin_path().'/social_login.skin.php'); // 소셜로그인 사용시 소셜로그인 버튼 ?>
	</div>

	<div class="h15"></div>

	<div class="text-center">
		<a href="<?php echo G5_URL ?>" class="btn btn_b01" title="홈으로">
			<i class="fa fa-home fa-2x" aria-hidden="true"></i>
			<span class="sound_only">홈으로</span>
		</a>
	</div>
</div>

<script>
$(function(){
    $("#login_auto_login").click(function(){
        if (this.checked) {
            this.checked = confirm("자동로그인을 사용하시면 다음부터 회원아이디와 비밀번호를 입력하실 필요가 없습니다.\n\n공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.\n\n자동로그인을 사용하시겠습니까?");
        }
    });
});

function flogin_submit(f) {

    if( $( document.body ).triggerHandler( 'login_sumit', [f, 'flogin'] ) !== false ){
        return true;
    }
    return false;
}
</script>
<!-- } 로그인 끝 -->

<?php
// 헤더, 테일 사용설정
if(!$tset['page_sub'])
	include_once(G5_THEME_PATH.'/tail.php');
?>
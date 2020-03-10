<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 

//필요한 전역변수 선언
global $config, $member, $is_member, $urlencode, $is_admin;

//add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$widget_url.'/widget.css">', 0);

?>

<div class="basic-outlogin">
	<?php if($is_member) { //Login ?>
		<div class="pull-right">
			<a href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=member_leave.php" class="leave-me" title="회원탈퇴" data-toggle="tooltip" data-placement="left">
				<span class="text-muted"><i class="fa fa-sign-out fa-lg"></i></span>
			</a>
		</div>
		<div class="profile">
			<div class="photo pull-left">
				<img src="<?php echo na_member_photo($member['mb_id']) ?>">
			</div>
			<div class="mb-name">
				<?php echo str_replace('sv_member', 'sv_member en', $member['sideview']); ?>
			</div>
			<div class="f-small">
				<?php if ($is_admin == 'super' || $member['is_auth']) { ?>
					<a href="<?php echo correct_goto_url(G5_ADMIN_URL); ?>">관리</a>
					<span class="light f-tiny">|</span>
				<?php } ?>
				<a href="<?php echo G5_BBS_URL ?>/memo.php" target="_blank" class="win_memo">
					쪽지<?php if ($member['mb_memo_cnt']) { ?> <span class="orangered"><?php echo number_format($member['mb_memo_cnt']);?></span><?php } ?>
				</a>
				<span class="light f-tiny">|</span>
				<a href="<?php echo G5_BBS_URL ?>/scrap.php" target="_blank" class="win_scrap">
					스크랩<?php if($member['mb_scrap_cnt']) { ?> <b><?php echo number_format($member['mb_scrap_cnt']) ?></b><?php } ?>
				</a>
			</div>
			<div class="clearfix"></div>
		</div>

		<?php 
		// 멤버쉽 플러그인	
		if(IS_NA_XP) { 
			$per = (int)(($member['as_exp'] / $member['as_max']) * 100);
		?>
			<div class="clearfix login-line no-margin f-small">
				<span class="pull-left">Level <?php echo $member['as_level'] ?></span>
				<span class="pull-right">
					<a href="<?php echo G5_BBS_URL ?>/exp.php" target="_blank" class="win_point">
						Exp <?php echo number_format($member['as_exp']) ?>(<?php echo $per ?>%)
					</a>				
				</span>
			</div>
			<div class="progress" style="margin:3px 0 10px;" title="레벨업까지 <?php echo number_format($member['as_max'] - $member['as_exp']);?> 경험치 필요" data-toggle="tooltip">
				<div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="<?php echo $per ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $per ?>%">
					<span class="sr-only"><?php echo $per ?>% Complete</span>
				</div>
			</div>
		<?php } ?>

		<div class="login-line f-small">
			<a href="<?php echo G5_BBS_URL ?>/point.php" target="_blank" class="win_point pull-left">
				포인트 <b class="red"><?php echo number_format($member['mb_point']);?></b>
			</a>
			<a href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=register_form.php" class="pull-right">
				정보수정
			</a>
			<div class="clearfix"></div>
		</div>

		<a href="<?php echo G5_BBS_URL ?>/logout.php" class="btn btn-<?php echo NT_COLOR ?> btn-block en">
			<i class="fa fa-power-off"></i>	Logout
		</a>

	<?php } else { //Logout ?>

		<form id="basic_outlogin" name="basic_outlogin" method="post" action="<?php echo G5_HTTPS_BBS_URL ?>/login_check.php" autocomplete="off" role="form" class="form">
		<input type="hidden" name="url" value="<?php echo $urlencode; ?>">
			<div class="form-group">	
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-user lightgray"></i></span>
					<input type="text" name="mb_id" id="outlogin_mb_id" class="form-control required" placeholder="아이디">
				</div>
			</div>
			<div class="form-group">	
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-lock lightgray"></i></span>
					<input type="password" name="mb_password" id="outlogin_mb_password" class="form-control required" placeholder="비밀번호">
				</div>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-<?php echo NT_COLOR ?> btn-block en">
					<b>로그인</b>
				</button>    
			</div>	

			<div class="f-small text-muted">
				<div class="pull-left">
					<label class="checkbox-inline">
						<input type="checkbox" name="auto_login" value="1" id="outlogin_remember_me" class="remember-me"> 자동로그인
					</label>
				</div>
				<div class="pull-right">
					<a href="<?php echo G5_BBS_URL ?>/register.php"><span class="text-muted">회원가입</span></a>
					<span class="light f-tiny">&nbsp;|&nbsp;</span>
					<a href="<?php echo G5_BBS_URL ?>/password_lost.php" class="win_password_lost"><span class="text-muted">정보찾기</span></a>
				</div>
				<div class="clearfix"></div>
			</div>
		</form>

        <?php
        // 소셜로그인 사용시 소셜로그인 버튼
        @include(get_social_skin_path().'/social_outlogin.skin.1.php');
        ?>

	<?php } //End ?>
</div>
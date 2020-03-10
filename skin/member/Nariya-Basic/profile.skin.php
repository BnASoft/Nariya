<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);

?>
<div id="profile" class="win-cont">
	<ul class="list-group">
		<li class="list-group-item mb_name bg-<?php echo NT_COLOR ?>">
			<b><?php echo na_name_photo($mb['mb_id'], $mb_nick) ?> 님의 프로필</b>
		</li>
		<li class="list-group-item my_profile_img text-center">
			<?php echo get_member_profile_img($mb['mb_id']) ?>
		</li>
		<li class="list-group-item clearfix">
			<b class="pull-left">회원권한</b>
			<span class="pull-right">
				<?php echo $mb['mb_level'] ?>등급
			</span>
		</li>

		<?php if(IS_NA_XP) { // 회원레벨 플러그인	?>
			<li class="list-group-item clearfix">
				<b class="pull-left">회원레벨</b>
				<span class="pull-right">
					<?php echo $mb['as_level'] ?>레벨
				</span>
			</li>
			<li class="list-group-item clearfix">
				<b class="pull-left">누적경험치</b>
				<span class="pull-right">
					Exp <?php echo $mb['as_exp'] ?>(<?php echo (int)(($member['as_exp'] / $member['as_max']) * 100) ?>%)
				</span>
			</li>
		<?php } ?>

		<li class="list-group-item clearfix">
			<b class="pull-left">보유포인트</b>
			<span class="pull-right">
				<?php echo number_format($mb['mb_point']) ?>점
			</span>
		</li>
		<?php if ($mb_homepage) {  ?>
			<li class="list-group-item clearfix">
				<b class="pull-left">홈페이지</b>
				<span class="pull-right">
					<a href="<?php echo $mb_homepage ?>" target="_blank"><?php echo $mb_homepage ?></a>
				</span>
			</li>
		<?php }  ?>
		<li class="list-group-item clearfix">
			<b class="pull-left">회원가입일</b>
			<span class="pull-right">
				<?php echo ($member['mb_level'] >= $mb['mb_level']) ?  substr($mb['mb_datetime'],0,10) ." (".number_format($mb_reg_after)."일)" : "비공개";  ?>
			</span>
		</li>
		<li class="list-group-item clearfix">
			<b class="pull-left">최종접속일</b>
			<span class="pull-right">
				<?php echo ($member['mb_level'] >= $mb['mb_level']) ? $mb['mb_today_login'] : "비공개"; ?>
			</span>
		</li>
		<li class="list-group-item">
			<h3 class="sound_only">인사말</h3>
			<?php echo $mb_profile ?>
		</li>
	</ul>

	<p class="text-center">
		<button type="button" onclick="window.close();" class="btn btn-white btn-sm">창닫기</button>
	</p>

	<div class="h30"></div>

	<script>
		window.resizeTo(320, 600);
	</script>
</div>
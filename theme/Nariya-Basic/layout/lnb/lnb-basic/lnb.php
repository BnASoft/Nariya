<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

add_stylesheet('<link rel="stylesheet" href="'.$nt_lnb_url.'/lnb.css">', 0);
add_javascript('<script src="'.$nt_lnb_url.'/lnb.js"></script>', 0);

$tweek = array("일", "월", "화", "수", "목", "금", "토");
?>

<aside id="nt_lnb" class="f-small">
	<div class="nt-container">
		<!-- LNB Left -->
		<div class="pull-left">
			<ul>
				<li><a href="javascript:;" id="favorite">즐겨찾기</a></li>
				<li><a href="<?php echo G5_BBS_URL ?>/new.php">새글</a></li>
				<li><a><?php echo date('m월 d일');?>(<?php echo $tweek[date("w")];?>)</a></li>
			</ul>
		</div>
		<!-- LNB Right -->
		<div class="pull-right">
			<ul>
			<?php if($is_member) { // 로그인 상태 ?>
				<li><?php echo $member['sideview'] ?></li>
				<?php if ($is_admin == 'super' || $member['is_auth']) { ?>
					<li><a href="<?php echo correct_goto_url(G5_ADMIN_URL); ?>">관리</a></li>
				<?php } ?>
				<li><a href="<?php echo G5_BBS_URL ?>/memo.php" target="_blank" class="win_memo">
					쪽지<?php if ($member['mb_memo_cnt']) { ?> <b class="orangered"><?php echo number_format($member['mb_memo_cnt']) ?></b><?php } ?>
					</a>
				</li>
				<li>
					<a href="<?php echo G5_BBS_URL ?>/scrap.php" target="_blank" class="win_scrap">
						스크랩<?php if($member['mb_scrap_cnt']) { ?> <b><?php echo number_format($member['mb_scrap_cnt']) ?></b><?php } ?>
					</a>
				</li>
				<li>
					<a href="<?php echo G5_BBS_URL ?>/point.php" target="_blank" class="win_point">
						포인트 <b class="red"><?php echo number_format($member['mb_point']) ?></b>
					</a>
				</li>
				<li>
					<a href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=register_form.php">
						정보수정
					</a>
				</li>
			<?php } else { // 로그아웃 상태 ?>
				<li><a href="<?php echo G5_BBS_URL ?>/login.php?url=<?php echo $urlencode ?>">로그인</a></li>
				<li><a href="<?php echo G5_BBS_URL ?>/register.php">회원가입</a></li>
				<li><a href="<?php echo G5_BBS_URL ?>/password_lost.php" class="win_password_lost">정보찾기</a></li>
			<?php } ?>
				<li><a href="<?php echo G5_BBS_URL ?>/faq.php">FAQ</a></li>
				<li><a href="<?php echo G5_BBS_URL ?>/qalist.php">1:1문의</a></li>
				<?php if(IS_NA_BBS) { // 게시판 플러그인 ?>
					<li><a href="<?php echo G5_BBS_URL ?>/shingo.php">신고</a></li>
				<?php } ?>
				<li>
				<?php if($stats['now_total']) { ?>
					<a href="<?php echo G5_BBS_URL ?>/current_connect.php">접속자 <?php echo number_format($stats['now_total']) ?><?php echo ($stats['now_mb']) ? ' (<b class="orangered">'.number_format($stats['now_mb']).'</b>)' : ''; ?></a>
				<?php } else { ?>
					<a href="<?php echo G5_BBS_URL ?>/current_connect.php">접속자</a>
				<?php } ?>
				</li>
			<?php if($is_member) { ?>
				<li><a href="<?php echo G5_BBS_URL ?>/logout.php">로그아웃</a></li>
			<?php } ?>
			</ul>
		</div>
		<div class="clearfix"></div>
	</div>
</aside>

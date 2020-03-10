<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$nt_sidebar_url.'/sidebar.css">', 0);
add_javascript('<script src="'.$nt_sidebar_url.'/sidebar.js"></script>', 0);

?>

<aside id="nt_sidebar">
	<!-- Top Line -->
	<div class="sidebar-head bg-<?php echo $tset['logo_color'] ?> en">
		<a href="<?php echo NT_HOME_URL ?>" class="pull-right visible-xs">
			<i class="fa fa-home fa-lg" aria-hidden="true"></i>
			<span class="sound_only">홈으로</span>
		</a>
		<a href="javascript:;" class="pull-left sidebar-close" title="닫기">
			<i class="fa fa-times-circle fa-lg" aria-hidden="true"></i>
			<span class="sound_only">닫기</span>
		</a>
		<a href="<?php echo NT_HOME_URL ?>">
			<?php echo get_text($tset['logo_text']) ?>
		</a>
		<div class="clearfix"></div>
	</div>

	<!-- sidebar-content : 스크롤바 생성을 위해서 -->
	<div class="sidebar-content">

		<!-- Login -->
		<div class="sidebar-member f-small visible-xs">
			<?php if($is_member) { ?>

				<a href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=register_form.php" class="pull-right">
					정보수정
				</a>

				<div class="profile">
					<div class="photo pull-left">
						<img src="<?php echo na_member_photo($member['mb_id']) ?>">
					</div>
					<div class="mb-name">
						<?php echo str_replace('sv_member', 'sv_member en', $member['sideview']); ?>
					</div>

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

				<div class="login-line">
					<a href="<?php echo G5_BBS_URL ?>/point.php" target="_blank" class="win_point pull-left">
						포인트 <b class="red"><?php echo number_format($member['mb_point']);?></b>
					</a>
					<a href="<?php echo G5_BBS_URL ?>/logout.php" class="pull-right">
						로그아웃
					</a>
					<div class="clearfix"></div>
				</div>

			<?php } else { ?>
				<div class="pull-left">
					<a href="<?php echo G5_BBS_URL ?>/login.php?url=<?php echo $urlencode ?>">
						<i class="fa fa-exclamation-circle" aria-hidden="true"></i>
						<b>로그인</b> 해주세요.
					</a>
				</div>
				<div class="pull-right">
					<a href="<?php echo G5_BBS_URL ?>/register.php">회원가입</a>
					<span class="lightgray f-tiny">&nbsp;|&nbsp;</span>
					<a href="<?php echo G5_BBS_URL ?>/password_lost.php" class="win_password_lost">정보찾기</a>
				</div>
			<?php } ?>
			<div class="clearfix"></div>
		</div>

		<!-- Icon -->
		<div class="sidebar-icon f-small">
			<div class="sidebar-icon-tbl">
				<div class="sidebar-icon-cell">
					<a href="<?php echo G5_BBS_URL;?>/new.php">
						<i class="fa fa-calendar-check-o circle light-circle normal" aria-hidden="true"></i>
						<span>새글</span>
					</a>
				</div>
				<div class="sidebar-icon-cell">
					<a href="<?php echo G5_BBS_URL;?>/current_connect.php">
						<i class="fa fa-users circle light-circle normal" aria-hidden="true"></i>
						<span>접속자</span>
					</a>
				</div>
				<div class="sidebar-icon-cell">
					<a href="<?php echo G5_BBS_URL;?>/faq.php">
						<i class="fa fa-exclamation circle light-circle normal" aria-hidden="true"></i>
						<span>FAQ</span>
					</a>
				</div>
				<div class="sidebar-icon-cell">
					<a href="<?php echo G5_BBS_URL;?>/qalist.php">
						<i class="fa fa-comments-o circle light-circle normal" aria-hidden="true"></i>
						<span>1:1 문의</span>
					</a>
				</div>
			</div>
		</div>

		<!-- Sidebar Search -->
		<div class="sidebar-search">

			<form name="sbsearch" method="get" action="<?php echo G5_BBS_URL ?>/search.php" onsubmit="return sbsearch_submit(this);" role="form" class="form">
				<input type="hidden" name="sfl" value="wr_subject||wr_content">
				<input type="hidden" name="sop" value="and">
				<div class="input-group">
					<input type="text" name="stx" class="form-control" value="<?php echo $stx ?>" placeholder="검색어">
					<span class="input-group-btn">
						<button type="submit" class="btn btn-<?php echo $tset['logo_color'] ?>"><i class="fa fa-search"></i></button>
					</span>
				</div>
			</form>
		</div>		

		<div id="nt_sidebar_menu">
			<ul class="me-ul">
			<?php for ($i=0; $i < $menu_cnt; $i++) { 
				$me = $menu[$i]; 
			?>
			<li class="me-li<?php echo ($me['on']) ? ' active' : ''; ?>">
				<?php if(isset($me['s'])) { //Is Sub Menu ?>
					<i class="fa fa-caret-down tree-toggle me-i"></i>
				<?php } ?>
				<a class="me-a" href="<?php echo $me['href'];?>" target="<?php echo $me['target'];?>">
					<i class="<?php echo $me['icon'] ?>" aria-hidden="true"></i>
					<?php echo $me['text'];?>
				</a>

				<?php if(isset($me['s'])) { //Is Sub Menu ?>
					<ul class="me-ul1 tree <?php echo ($me['on']) ? 'on' : 'off'; ?>">
					<?php for($j=0; $j < count($me['s']); $j++) { 
							$me1 = $me['s'][$j]; 
					?>
						<?php if($me1['line']) { //구분라인 ?>
							<li class="me-line1"><a class="me-a1"><?php echo $me1['line'];?></a></li>
						<?php } ?>

						<li class="me-li1<?php echo ($me1['on']) ? ' active' : ''; ?>">

							<?php if(isset($me1['s'])) { //Is Sub Menu ?>
								<i class="fa fa-caret-right tree-toggle me-i1"></i>
							<?php } ?>

							<a class="me-a1" href="<?php echo $me1['href'];?>" target="<?php echo $me1['target'];?>">
								<i class="<?php echo $me1['icon'] ?>" aria-hidden="true"></i>
								<?php echo $me1['text'];?>
							</a>
							<?php if(isset($me1['s'])) { // Is Sub Menu ?>
								<ul class="me-ul2 tree <?php echo ($me1['on']) ? 'on' : 'off'; ?>">
								<?php 
									for($k=0; $k < count($me1['s']); $k++) { 
										$me2 = $me1['s'][$k];
								?>
									<?php if($me2['line']) { //구분라인 ?>
										<li class="me-line2"><a class="me-a2"><?php echo $me2['line'];?></a></li>
									<?php } ?>
									<li class="me-li2<?php echo ($me2['on']) ? ' active' : ''; ?>">
										<a class="me-a2" href="<?php echo $me2['href'] ?>" target="<?php echo $me2['target'] ?>">
											<i class="<?php echo $me2['icon'] ?>" aria-hidden="true"></i>
											<?php echo $me2['text'];?>
										</a>
									</li>
								<?php } //for ?>
								</ul>
							<?php } //is_sub ?>
						</li>
					<?php } //for ?>
					</ul>
				<?php } //is_sub ?>
			</li>
			<?php } //for ?>
			<?php if(!$menu_cnt) { ?>
				<li class="me-li">
					<a class="me-a" href="javascript:;">메뉴를 등록해 주세요.</a>
				</li>
			<?php } ?>
			</ul>
		</div>

		<div class="sidebar-stats">
			<ul>
				<?php if($stats['now_total']) { ?>
				<li class="clearfix">
					<a href="<?php echo G5_BBS_URL ?>/current_connect.php">
						<span class="pull-left">현재 접속자</span>
						<span class="pull-right"><?php echo number_format($stats['now_total']); ?><?php echo ($stats['now_mb'] > 0) ? '(<b class="orangered">'.number_format($stats['now_mb']).'</b>)' : ''; ?> 명</span>
					</a>
				</li>
				<?php } ?>
				<li class="clearfix">
					<span class="pull-left">오늘 방문자</span>
					<span class="pull-right"><?php echo number_format($stats['visit_today']) ?> 명</span>
				</li>
				<li class="clearfix">
					<span class="pull-left">어제 방문자</span>
					<span class="pull-right"><?php echo number_format($stats['visit_yesterday']) ?> 명</span>
				</li>
				<li class="clearfix">
					<span class="pull-left">최대 방문자</span>	
					<span class="pull-right"><?php echo number_format($stats['visit_max']) ?> 명</span>
				</li>
				<li class="clearfix">
					<span class="pull-left">전체 방문자</span>	
					<span class="pull-right"><?php echo number_format($stats['visit_total']) ?> 명</span>
				</li>
				<?php if($stats['join_total']) { ?>
				<li class="clearfix">
					<span class="pull-left">오늘 가입자</span>
					<span class="pull-right"><?php echo number_format($stats['join_today']) ?> 명</span>
				</li>
				<li class="clearfix">
					<span class="pull-left">어제 가입자</span>
					<span class="pull-right"><?php echo number_format($stats['join_yesterday']) ?> 명</span>
				</li>
				<li class="clearfix">
					<span class="pull-left">전체 회원수</span>
					<span class="pull-right"><?php echo number_format($stats['join_total']) ?> 명</span>
				</li>
				<li class="clearfix">
					<span class="pull-left">전체 게시물</span>	
					<span class="pull-right"><?php echo number_format($stats['total_write']) ?> 개</span>
				</li>
				<li class="clearfix">
					<span class="pull-left">전체 댓글수</span>
					<span class="pull-right"><?php echo number_format($stats['total_comment']) ?> 개</span>
				</li>
				<?php } ?>
			</ul>
		</div>	

		<!-- 스크롤바 하단 여백용 -->
		<div class="h30 clearfix"></div>
	</div>
</aside>

<div id="nt_sidebar_mask" class="sidebar-close"></div>

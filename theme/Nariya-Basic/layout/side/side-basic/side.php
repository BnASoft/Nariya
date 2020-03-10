<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 
?>

<?php if($is_index) { // 인덱스에서만 출력 ?>
	<!-- 로그인 시작 -->
	<div class="hidden-xs">
		<?php echo na_widget('basic-outlogin'); // 외부로그인 위젯 ?>
	</div>
	<div class="h20"></div>
	<!-- 로그인 끝 -->
<?php } else { // 페이지에서는 메뉴 출력 ?>

	<?php 
	$mes = array();
	for ($i=0; $i < $menu_cnt; $i++) { 
		// 주메뉴 이하 사이트이고 서브메뉴가 있으면...
		if($menu[$i]['on']) {
			$mes = $menu[$i];
			break;
		}
	}

	// 선택메뉴가 있다면...
	if(!empty($mes)) {
		add_stylesheet('<link rel="stylesheet" href="'.$nt_side_url.'/side.css">', 0);
	?>
		<div id="nt_side_menu">
			<div class="side-menu-head bg-<?php echo NT_COLOR ?> en">
				<i class="<?php echo $mes['icon'] ?>" aria-hidden="true"></i>
				<?php echo $mes['text'];?>					
			</div>
			<?php if(isset($mes['s'])) { ?>
				<ul class="me-ul">
				<?php for ($i=0; $i < count($mes['s']); $i++) { 
					$me = $mes['s'][$i]; 
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
								<a class="me-a1" href="<?php echo $me1['href'];?>" target="<?php echo $me1['target'];?>">
									<i class="<?php echo $me1['icon'] ?>" aria-hidden="true"></i>
									<?php echo $me1['text'];?>
								</a>
							</li>
						<?php } //for ?>
						</ul>
					<?php } //is_sub ?>
				</li>
				<?php } //for ?>
				</ul>
			<?php } //is_sub ?>
		</div>
		<script>
		$(document).ready(function () {
			$(document).on('click', '#nt_side_menu .tree-toggle', function () {
				$(this).parent().children('ul.tree').toggle(200);
			});
		});
		</script>
		<div class="h20"></div>
	<?php } ?>
<?php } ?>

<!-- 위젯 시작 -->
<h3 class="h3 en">
	<a href="<?php echo get_pretty_url('notice'); ?>">
		<span class="pull-right lightgray more f-small">+</span>
		공지글
	</a>
</h3>
<hr class="hr line-<?php echo NT_COLOR ?>"/>
<?php echo na_widget('basic-wr-list', 'notice'); ?>
<div class="h20"></div>
<!-- 위젯 끝-->

<!-- 위젯 시작 -->
<h3 class="h3 en">
	<a href="<?php echo G5_BBS_URL ?>/new.php?view=w">
		<span class="pull-right lightgray more f-small">+</span>
		최근글
	</a>
</h3>
<hr class="hr line-<?php echo NT_COLOR ?>"/>
<?php echo na_widget('basic-wr-list', 'new-wr'); ?>
<div class="h20"></div>
<!-- 위젯 끝-->

<!-- 위젯 시작 -->
<h3 class="h3 en">
	<a href="<?php echo G5_BBS_URL ?>/new.php?view=c">
		<span class="pull-right lightgray more f-small">+</span>
		새댓글
	</a>
</h3>
<hr class="hr line-<?php echo NT_COLOR ?>"/>
<?php echo na_widget('basic-wr-comment-list', 'new-co'); ?>
<div class="h20"></div>
<!-- 위젯 끝-->

<!-- 위젯 시작 -->
<h3 class="h3 en">
	통계
</h3>
<hr class="hr line-<?php echo NT_COLOR ?>"/>
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
<div class="h20"></div>
<!-- 위젯 끝-->

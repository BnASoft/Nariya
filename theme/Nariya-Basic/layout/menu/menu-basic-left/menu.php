<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 

// 상단고정 문제로 모바일헤드도 메뉴에 포함시킴...ㅠㅠ

add_stylesheet('<link rel="stylesheet" href="'.$nt_menu_url.'/menu.css">', 0);
add_javascript('<script src="'.$nt_menu_url.'/menu.js"></script>', 0);

// 2차 서브메뉴 너비 : 메뉴나눔에서 사용
$is_sub_w = 170;

// 전체메뉴 줄나눔
$is_col_all = 6;

?>
<style>
#nt_menu .me-sw { 
	width:<?php echo $is_sub_w ?>px; 
}
</style>
<div id="nt_menu_wrap">

	<!-- Mobile Header -->
	<header id="header_mo" class="bg-<?php echo $tset['logo_color'] ?>">
		<div class="nt-container">
			<div class="header-wrap">
				<div class="header-icon">
					<a href="javascript:;" onclick="sidebar_open('sidebar-menu');">
						<i class="fa fa-bars"></i>
					</a>
				</div>
				<div class="header-logo en">
					<!-- Mobile Logo -->
					<a href="<?php echo NT_HOME_URL ?>">
						<b><?php echo $tset['logo_text'] ?></b>
					</a>
				</div>
				<div class="header-icon">
					<a data-toggle="collapse" href="#search_mo" aria-expanded="false" aria-controls="search_mo">
						<i class="fa fa-search"></i>
					</a>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</header>

	<!-- Mobile Search -->
	<div id="search_mo" class="collapse">
		<div class="well well-sm no-margin" style="border-radius:0;">
			<div class="nt-container">
				<form name="mosearch" method="get" action="<?php echo G5_BBS_URL ?>/search.php" onsubmit="return tsearch_submit(this);" role="form" class="form no-margin">
					<input type="hidden" name="sfl" value="wr_subject||wr_content">
					<input type="hidden" name="sop" value="and">
					<div class="input-group">
						<input id="mo_top_search" type="text" name="stx" class="form-control" value="<?php echo $stx ?>" placeholder="검색어">
						<span class="input-group-btn">
							<button type="submit" class="btn btn-<?php echo $tset['logo_color'] ?>"><i class="fa fa-search"></i></button>
						</span>
					</div>
				</form>
				<script>
				$(function(){
					$('#search_mo').on('shown.bs.collapse', function () {
						$('#mo_top_search').focus();
					});
				});
				</script>
			</div>
		</div>
	</div>

	<nav id="nt_menu">
		<div class="nt-container">
			<div class="me-wrap">
				<div class="me-cell me-head">
					<div class="me-li<?php echo ($is_index) ? ' on' : ''; ?>">
						<a href="javascript:;" data-toggle="collapse" data-target="#menu_all" class="me-a" title="전체메뉴">
							<i class="fa fa-bars" aria-hidden="true"></i>
						</a>
					</div>
				</div>
				<div class="me-cell me-list">
					<ul class="me-ul nav-slide">
					<?php for ($i=0; $i < $menu_cnt; $i++) { 
						$me = $menu[$i]; 
					?>
						<li class="me-li<?php echo ($me['on']) ? ' on' : ''; ?>">
							<a class="me-a" href="<?php echo $me['href'];?>" target="<?php echo $me['target'];?>">
								<i class="<?php echo $me['icon'] ?>" aria-hidden="true"></i>
								<?php echo $me['text'];?>
							</a>
							<?php if(isset($me['s'])) { //Is Sub Menu ?>
								<div class="sub-slide sub-1div">
									<ul class="sub-1dul me-sw pull-left">
									<?php 
									$me_sw1 = 0; //나눔 체크
									for($j=0; $j < count($me['s']); $j++) { 
											$me1 = $me['s'][$j]; 
									?>
										<?php if($me1['sp']) { //나눔 ?>
											</ul>
											<ul class="sub-dul me-sw pull-left">
										<?php $me_sw1++; } // 나눔 카운트 ?>

										<?php if($me1['line']) { //구분라인 ?>
											<li class="sub-1line"><a class="me-sh sub-1da"><?php echo $me1['line'];?></a></li>
										<?php } ?>

										<li class="sub-1dli<?php echo ($me1['on']) ? ' on' : ''; ?>">
											<a href="<?php echo $me1['href'];?>" class="me-sh sub-1da<?php echo (isset($me1['s'])) ? ' sub-icon' : '';?>" target="<?php echo $me1['target'];?>">
												<i class="<?php echo $me1['icon'] ?>" aria-hidden="true"></i>
												<?php echo $me1['text'];?>
											</a>
											<?php if(isset($me1['s'])) { // Is Sub Menu ?>
												<div class="sub-slide sub-2div">
													<ul class="sub-2dul me-sw pull-left">					
													<?php 
														$me_sw2 = 0; //나눔 체크
														for($k=0; $k < count($me1['s']); $k++) { 
															$me2 = $me1['s'][$k];
													?>
														<?php if($me2['sp']) { //나눔 ?>
															</ul>
															<ul class="sub-2dul me-sw pull-left">
														<?php $me_sw2++; } // 나눔 카운트 ?>

														<?php if($me2['line']) { //구분라인 ?>
															<li class="sub-2line"><a class="me-sh sub-2da"><?php echo $me2['line'];?></a></li>
														<?php } ?>

														<li class="sub-2dli<?php echo ($me2['on']) ? ' on' : ''; ?>">
															<a href="<?php echo $me2['href'] ?>" class="me-sh sub-2da" target="<?php echo $me2['target'] ?>">
																<i class="<?php echo $me2['icon'] ?>" aria-hidden="true"></i>
																<?php echo $me2['text'];?>
															</a>
														</li>
													<?php } ?>
													</ul>
													<?php $me_sw2 = ($me_sw2) ? ($is_sub_w * ($me_sw2 + 1)) : 0; //서브메뉴 너비 ?>
													<div class="clearfix"<?php echo ($me_sw2) ? ' style="width:'.$me_sw2.'px;"' : '';?>></div>
												</div>
											<?php } ?>
										</li>
									<?php } //for ?>
									</ul>
									<?php $me_sw1 = ($me_sw1) ? ($is_sub_w * ($me_sw1 + 1)) : 0; //서브메뉴 너비 ?>
									<div class="clearfix"<?php echo ($me_sw1) ? ' style="width:'.$me_sw1.'px;"' : '';?>></div>
								</div>
							<?php } ?>
						</li>
					<?php } //for ?>
					<?php if(!$menu_cnt) { ?>
						<li class="me-li">
							<a class="me-a" href="javascript:;">테마설정 > 메뉴설정에서 사용할 메뉴를 등록해 주세요.</a>
						</li>
					<?php } ?>
					</ul>							
				</div>
				<div class="me-cell me-tail">
					<div class="me-li<?php echo ($is_index) ? ' on' : ''; ?>">
						<a href="javascript:;" onclick="sidebar_open('sidebar-menu'); return false;" class="me-a" title="마이메뉴">
							<i class="fa fa-toggle-on" aria-hidden="true"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
	</nav>

	<!-- 전체 메뉴 -->
	<nav id="nt_menu_all" class="me-all">
		<div id="menu_all" class="collapse">
			<div class="nt-container table-responsive">
				<table class="table">
				<tr>
				<?php 
					$az = 0;
					for ($i=0; $i < $menu_cnt; $i++) {

						$me = $menu[$i]; 

						// 줄나눔
						if($az && $az%$is_col_all == 0) {
							echo '</tr><tr>'.PHP_EOL;
						}
				?>
					<td class="<?php echo $me['on'];?>">
						<a class="me-a" href="<?php echo $me['href'];?>" target="<?php echo $me['target'];?>">
							<i class="<?php echo $me['icon'] ?>" aria-hidden="true"></i>
							<?php echo $me['text'];?>
						</a>
						<?php if(isset($me['s'])) { //Is Sub Menu ?>
							<div class="sub-1div">
								<ul class="sub-1dul">
								<?php for($j=0; $j < count($me['s']); $j++) { 
										$me1 = $me['s'][$j]; 
								?>

									<?php if($me1['line']) { //구분라인 ?>
										<li class="sub-1line"><a class="me-sh"><?php echo $me1['line'];?></a></li>
									<?php } ?>

									<li class="sub-1dli<?php echo ($me1['on']) ? ' on' : ''; ?>">
										<a href="<?php echo $me1['href'];?>" class="me-sh sub-1da<?php echo (isset($me1['s'])) ? ' sub-icon' : '';?>" target="<?php echo $me1['target'];?>">
											<i class="<?php echo $me1['icon'] ?>" aria-hidden="true"></i>
											<?php echo $me1['text'];?>
										</a>
									</li>
								<?php } //for ?>
								</ul>
							</div>
						<?php } ?>
					</td>
				<?php $az++; } //for ?>
				</tr>
				</table>
				<div class="btn-me-all">
					<a href="javascript:;" class="btn btn-lightgray" data-toggle="collapse" data-target="#menu_all" title="닫기">
						<i class="fa fa-chevron-up fa-lg" aria-hidden="true"></i>
						<span class="sound_only">전체메뉴 닫기</span>	
					</a>
				</div>
			</div>
		</div>
	</nav><!-- #nt_menu_all -->
</div><!-- #nt_menu_wrap -->

<?php if($tset['sticky']) { //메뉴상단고정시 ?>
<script>
$(document).ready(function() {
	$(window).scroll(function(){
		if ($(this).scrollTop() > 200) {
			$("#nt_menu_wrap").addClass("me-sticky");
		} else {
			$("#nt_menu_wrap").removeClass("me-sticky");
		}
	});
});
</script>
<?php } ?>
<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 모바일 헤드는 메뉴에 들어가 있음. 상단고정문제 때문에...ㅠㅠ

add_stylesheet('<link rel="stylesheet" href="'.$nt_header_url.'/header.css">', 0);
?>

<!-- PC Header -->
<header id="header_pc">
	<div class="nt-container">
		<!-- PC Logo -->
		<div class="header-logo">
			<a href="<?php echo NT_HOME_URL ?>">
				<img id="logo_img" src="<?php echo $tset['logo_img'] ?>" alt="<?php echo get_text($config['cf_title']) ?>">
			</a>
		</div>
		<!-- PC Search -->
		<div class="header-search">
			<form name="tsearch" method="get" action="<?php echo G5_BBS_URL ?>/search.php" onsubmit="return tsearch_submit(this);" role="form" class="form">
				<input type="hidden" name="sfl" value="wr_subject||wr_content">
				<input type="hidden" name="sop" value="and">
				<div class="input-group input-group-lg">
					<input type="text" name="stx" class="form-control en" value="<?php echo $stx ?>">
					<span class="input-group-btn">
						<button type="submit" class="btn"><i class="fa fa-search fa-lg"></i></button>
					</span>
				</div>
			</form>
			<div class="header-keyword">
				<?php echo na_widget('basic-keyword', 'popular', 'q=아미나,나리야,플러그인,그누보드5.4,베이직테마,베이직스킨,위젯,애드온'); ?>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</header>

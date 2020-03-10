<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 사이드 위치 설정 - left, right
$side = 'right';

?>

<?php echo na_widget('basic-title', 'title-1', 'height=25%', 'auto=0'); //타이틀 ?>

<div class="nt-container">
	<div class="row nt-row">
		<!-- 메인 영역 -->
		<div class="col-md-9<?php echo ($side == "left") ? ' pull-right' : '';?> nt-col nt-main">
			<div class="row">
				<div class="col-sm-4">

					<!-- 위젯 시작 { -->
					<h3 class="h3 en">
						<a href="<?php echo get_pretty_url('free'); ?>">
							<span class="pull-right more f-small">+</span>
							게시판
						</a>
					</h3>
					<hr class="hr line-<?php echo NT_COLOR ?>"/>
					<?php echo na_widget('basic-wr-list', 'tlist-1'); ?>
					<div class="h20"></div>
					<!-- } 위젯 끝-->

				</div>
				<div class="col-sm-4">

					<!-- 위젯 시작 { -->
					<h3 class="h3 en">
						<a href="<?php echo get_pretty_url('free'); ?>">
							<span class="pull-right more f-small">+</span>
							게시판
						</a>
					</h3>
					<hr class="hr line-<?php echo NT_COLOR ?>"/>
					<?php echo na_widget('basic-wr-list', 'tlist-2'); ?>
					<div class="h20"></div>
					<!-- } 위젯 끝-->

				</div>
				<div class="col-sm-4">

					<!-- 위젯 시작 { -->
					<h3 class="h3 en">
						<a href="<?php echo get_pretty_url('free'); ?>">
							<span class="pull-right more f-small">+</span>
							게시판
						</a>
					</h3>
					<hr class="hr line-<?php echo NT_COLOR ?>"/>
					<?php echo na_widget('basic-wr-list', 'tlist-3'); ?>
					<div class="h20"></div>
					<!-- } 위젯 끝-->

				</div>
			</div>

			<!-- 위젯 시작 { -->
			<h3 class="h3 en">
				<a href="<?php echo get_pretty_url('free'); ?>">
					<span class="pull-right more f-small">+</span>
					갤러리
				</a>
			</h3>
			<hr class="hr line-<?php echo NT_COLOR ?>"/>
			<?php echo na_widget('basic-wr-gallery', 'gallery-1'); ?>
			<div class="h15"></div>
			<!-- } 위젯 끝-->


			<div class="row">
				<div class="col-sm-4">

					<!-- 위젯 시작 { -->
					<h3 class="h3 en">
						<a href="<?php echo get_pretty_url('free'); ?>">
							<span class="pull-right more f-small">+</span>
							게시판
						</a>
					</h3>
					<hr class="hr line-<?php echo NT_COLOR ?>"/>
					<?php echo na_widget('basic-wr-list', 'blist-1'); ?>
					<div class="h20"></div>
					<!-- } 위젯 끝-->

				</div>
				<div class="col-sm-4">

					<!-- 위젯 시작 { -->
					<h3 class="h3 en">
						<a href="<?php echo get_pretty_url('free'); ?>">
							<span class="pull-right more f-small">+</span>
							게시판
						</a>
					</h3>
					<hr class="hr line-<?php echo NT_COLOR ?>"/>
					<?php echo na_widget('basic-wr-list', 'blist-2'); ?>
					<div class="h20"></div>
					<!-- } 위젯 끝-->

				</div>
				<div class="col-sm-4">

					<!-- 위젯 시작 { -->
					<h3 class="h3 en">
						<a href="<?php echo get_pretty_url('free'); ?>">
							<span class="pull-right more f-small">+</span>
							게시판
						</a>
					</h3>
					<hr class="hr line-<?php echo NT_COLOR ?>"/>
					<?php echo na_widget('basic-wr-list', 'blist-3'); ?>
					<div class="h20"></div>
					<!-- } 위젯 끝-->

				</div>
			</div>

			<!-- 위젯 시작 { -->
			<h3 class="h3 en">
				<a href="<?php echo get_pretty_url('free'); ?>">
					<span class="pull-right more f-small">+</span>
					배너
				</a>
			</h3>
			<hr class="hr line-<?php echo NT_COLOR ?>"/>
			<?php echo na_widget('basic-banner', 'banner-1'); ?>
			<div class="h20"></div>
			<!-- } 위젯 끝-->

		</div>
		<!-- 사이드 영역 -->
		<div class="col-md-3<?php echo ($side == "left") ? ' pull-left' : '';?> nt-col nt-side">
			<?php 
				// layout/side에서 가져옴
				list($nt_side_url, $nt_side_path) = na_layout_content('side', 'side-basic'); // side-basic 폴더
				@include_once($nt_side_path.'/side.php') 
			?>
		</div>
	</div>
</div>

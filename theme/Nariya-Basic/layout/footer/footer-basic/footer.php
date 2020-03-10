<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

add_stylesheet('<link rel="stylesheet" href="'.$nt_footer_url.'/footer.css">', 0);
?>

<footer id="nt_footer">
	<nav class="nt-links">
		<div class="nt-container">
			<ul class="pull-left">
				<li><a href="<?php echo get_pretty_url('content', 'company'); ?>">사이트 소개</a></li> 
				<li><a href="<?php echo get_pretty_url('content', 'provision'); ?>">이용약관</a></li> 
				<li><a href="<?php echo get_pretty_url('content', 'privacy'); ?>">개인정보처리방침</a></li>
				<li><a href="<?php echo get_pretty_url('content', 'noemail'); ?>">이메일 무단수집거부</a></li>
				<li><a href="<?php echo get_pretty_url('content', 'disclaimer'); ?>">책임의 한계와 법적고지</a></li>
			</ul>
			<ul class="pull-right">
				<li><a href="<?php echo get_pretty_url('content', 'guide'); ?>">이용안내</a></li>
				<li><a href="<?php echo G5_BBS_URL ?>/qalist.php">문의하기</a></li>
				<li><a href="<?php echo get_device_change_url(); ?>"><?php echo (G5_IS_MOBILE) ? 'PC' : '모바일';?>버전</a></li>
			</ul>
			<div class="clearfix"></div>
		</div>
	</nav>
	<div class="nt-infos">
		<div class="nt-container">
			<div class="nt-copyright">
				<strong><?php echo get_text($config['cf_title']); ?> <i class="fa fa-copyright"></i></strong>
				All rights reserved.
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</footer>
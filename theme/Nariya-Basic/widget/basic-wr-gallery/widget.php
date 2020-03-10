<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

//add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
//add_stylesheet('<link rel="stylesheet" href="'.$widget_url.'/widget.css">', 0);

// 이미지 영역 및 썸네일 크기 설정
$wset['thumb_w'] = ($wset['thumb_w'] == "") ? 400 : (int)$wset['thumb_w'];
$wset['thumb_h'] = ($wset['thumb_h'] == "") ? 225 : (int)$wset['thumb_h'];

if($wset['thumb_w'] && $wset['thumb_h']) {
	$height = ($wset['thumb_w'] / $wset['thumb_h']) * 100;
} else {
	$height = ($wset['thumb_d']) ? $wset['thumb_d'] : '56.25';
}

// 마진(간격)
$margin_w = ($wset['margin_w'] == "") ? 15 : (int)$wset['margin_w'];
$margin_h = ($wset['margin_h'] == "") ? 20 : (int)$wset['margin_h'];

// 랜덤아이디
$id = 'img_'.na_rid(); 

?>
<style>
	#<?php echo $id;?> { margin-right:<?php echo $margin_w * (-1);?>px; margin-bottom:<?php echo $margin_h * (-1);?>px;}
	#<?php echo $id;?> li {float:left; padding-right:<?php echo $margin_w ?>px; padding-bottom:<?php echo $margin_h ?>px; <?php echo na_width($wset['item'], 4) ?>}
	#<?php echo $id;?> .img-wrap { padding-bottom:<?php echo $height ?>; }
	<?php if(_RESPONSIVE_) { // 반응형일 때만 작동 ?>
	@media (max-width:1199px) { 
		.responsive #<?php echo $id;?> li {<?php echo na_width($wset['lg'], 4) ?>}
	}
	@media (max-width:991px) { 
		.responsive #<?php echo $id;?> li {<?php echo na_width($wset['md'], 3) ?>}
	}
	@media (max-width:767px) { 
		.responsive #<?php echo $id;?> li {<?php echo na_width($wset['sm'], 2) ?>}
	}
	@media (max-width:480px) { 
		.responsive #<?php echo $id;?> li {<?php echo na_width($wset['xs'], 2) ?>}
	}
	<?php } ?>
</style>
<div id="<?php echo $id;?>" class="basic-wr-gallery">
	<ul>
	<?php 
	if($wset['cache']) {
		echo na_widget_cache($widget_path.'/widget.rows.php', $wset, $wcache);
	} else {
		include($widget_path.'/widget.rows.php');
	}
	?>
	</ul>
	<div class="clearfix"></div>
</div>
<div class="clearfix"></div>

<?php if($setup_href) { ?>
	<div class="btn-wset">
		<a href="<?php echo $setup_href;?>" class="btn-setup">
			<span class="text-muted f-small"><i class="fa fa-cog"></i> 위젯설정</span>
		</a>
	</div>
<?php } ?>
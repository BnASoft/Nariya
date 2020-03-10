<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

//add_stylesheet('<link rel="stylesheet" href="'.$widget_url.'/widget.css">', 0);

na_script('owl');

// 이미지 영역 및 썸네일 크기 설정
$wset['thumb_w'] = ($wset['thumb_w'] == "") ? 400 : (int)$wset['thumb_w'];
$wset['thumb_h'] = ($wset['thumb_h'] == "") ? 225 : (int)$wset['thumb_h'];

// 높이
$height = ($wset['thumb_w'] && $wset['thumb_h']) ? ($wset['thumb_w'] / $wset['thumb_h']) * 100 : '56.25';

// 마진(간격)
$margin_w = ($wset['margin_w'] == "") ? 15 : (int)$wset['margin_w'];

// 랜덤아이디
$id = 'banner_'.na_rid(); 

?>
<style>
	#<?php echo $id;?> .img-wrap { 
		padding-bottom:<?php echo $height; ?>;
	}
</style>
<div id="<?php echo $id;?>" class="basic-banner">
	<ul class="owl-carousel">
		<?php
		if($wset['cache']) {
			echo na_widget_cache($widget_path.'/widget.rows.php', $wset, $wcache);
		} else {
			include($widget_path.'/widget.rows.php');
		}
		?>
	</ul>
</div>

<script>
$(document).ready(function(){
	$('#<?php echo $id;?> .owl-carousel').owlCarousel({
		autoplay:<?php echo ($wset['auto']) ? 'false' : 'true'; ?>,
		autoplayHoverPause:true,
		loop:true,
		item:<?php echo ($wset['item']) ? $wset['item'] : 4; ?>,
		margin:<?php echo $margin_w;?>,
		nav:false,
		dots:false,
		responsive:{
			0:{ items:<?php echo ($wset['xs']) ? $wset['xs'] : 2; ?> },
			480:{ items:<?php echo ($wset['sm']) ? $wset['sm'] : 3; ?> },
			767:{ items:<?php echo ($wset['md']) ? $wset['md'] : 3; ?> },
			991:{ items:<?php echo ($wset['lg']) ? $wset['lg'] : 4; ?> },
			1199:{ items:<?php echo ($wset['item']) ? $wset['item'] : 4; ?> }
		}
	});
});
</script>

<?php if($setup_href) { ?>
	<div class="btn-wset">
		<a href="<?php echo $setup_href;?>" class="btn-setup">
			<span class="text-muted f-small"><i class="fa fa-cog"></i> 위젯설정</span>
		</a>
	</div>
<?php } ?>

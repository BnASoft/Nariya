<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

add_stylesheet('<link rel="stylesheet" href="'.$nt_title_url.'/title.css">', 0);

// 페이지 설명글 없으면 현재 위치 출력
if($tset['page_desc']) {
	$page_desc = $tset['page_desc'];
} else {
	$page_desc = (empty($tnav['nav'])) ?  $page_title : '<i class="fa fa-home"></i> > '.implode(' > ', $tnav['nav']);
}

?>

<!-- Page Title -->
<div id="nt_title">
	<div class="nt-container">
		<div class="page-title en">
		<?php if($tset['page_icon']) { ?>
			<i class="fa <?php echo $tset['page_icon'] ?>" aria-hidden="true"></i>
		<?php } ?>
		<strong><?php echo $page_title;?></strong>
		</div>
		<div class="page-desc hidden-xs">
			<?php echo $page_desc;?>
		</div>
		<div class="clearfix"></div>
	</div>
</div>

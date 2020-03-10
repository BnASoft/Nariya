<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

//add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
//add_stylesheet('<link rel="stylesheet" href="'.$widget_url.'/widget.css">', 0);

?>
<div class="basic-wr-list">
	<ul>
	<?php 
	if($wset['cache']) {
		echo na_widget_cache($widget_path.'/widget.rows.php', $wset, $wcache);
	} else {
		include($widget_path.'/widget.rows.php');
	}
	?>
	</ul>
</div>

<?php if($setup_href) { ?>
	<div class="btn-wset">
		<a href="<?php echo $setup_href;?>" class="btn-setup">
			<span class="text-muted f-small"><i class="fa fa-cog"></i> 위젯설정</span>
		</a>
	</div>
<?php } ?>
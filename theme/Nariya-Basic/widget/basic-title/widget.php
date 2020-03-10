<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

add_stylesheet('<link rel="stylesheet" href="'.$widget_url.'/widget.css">', 0);

// 자동실행
$interval = ($wset['auto']) ? 'false' : 5000;

// 랜덤아이디
$id = 'carousel_'.na_rid(); 

?>
<style>
	#<?php echo $id;?> .img-wrap { 
		padding-bottom:<?php echo ($wset['height']) ? $wset['height'] : '25%' ;?>; 
	}
	<?php if(_RESPONSIVE_) { //반응형일 때만 작동 ?>
		@media (max-width:1199px) { 
			.responsive #<?php echo $id;?> .img-wrap { 
				padding-bottom:<?php echo ($wset['hlg']) ? $wset['hlg'] : '25%' ;?> !important; 
			} 
		}
		@media (max-width:991px) { 
			.responsive #<?php echo $id;?> .img-wrap { 
				padding-bottom:<?php echo ($wset['hmd']) ? $wset['hmd'] : '25%' ;?> !important; 
			} 
		}
		@media (max-width:767px) { 
			.responsive #<?php echo $id;?> .img-wrap { 
				padding-bottom:<?php echo ($wset['hsm']) ? $wset['hsm'] : '30%' ;?> !important; 
			} 
		}
		@media (max-width:480px) { 
			.responsive #<?php echo $id;?> .img-wrap { 
				padding-bottom:<?php echo ($wset['hxs']) ? $wset['hxs'] : '25%' ;?> !important; 
			} 
		}
	<?php } ?>
</style>
<div class="basic-title">
	<div id="<?php echo $id;?>" class="carousel slide" data-ride="carousel" data-interval="<?php echo $interval;?>">
		<div class="carousel-inner">
			<?php
			if($wset['cache']) {
				echo na_widget_cache($widget_path.'/widget.rows.php', $wset, $wcache);
			} else {
				include($widget_path.'/widget.rows.php');
			}
			?>
		</div>
		<!-- Controls -->
		<a class="left carousel-control" href="#<?php echo $id;?>" role="button" data-slide="prev">
		   <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#<?php echo $id;?>" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
		<?php if(!$wset['nav']) { ?>
			 <!-- Indicators -->
			<ol class="carousel-indicators">
				<?php for ($i=0; $i < $list_cnt; $i++) { ?>
					<li data-target="#<?php echo $id;?>" data-slide-to="<?php echo $i;?>"<?php echo (!$i) ? ' class="active"' : '';?>></li>
				<?php } ?>
			</ol>
		<?php } ?>
	</div>
	<?php 
	//그림자 
	if($wset['shadow']) 
		echo na_shadow($wset['shadow']);
	?>
</div>

<?php if($setup_href) { ?>
	<div class="btn-wset">
		<a href="<?php echo $setup_href;?>" class="btn-setup">
			<span class="text-muted f-small"><i class="fa fa-cog"></i> 위젯설정</span>
		</a>
	</div>
<?php } ?>

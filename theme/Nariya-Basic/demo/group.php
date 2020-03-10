<?php
include_once('./_common.php');

if ($is_admin == 'super' || IS_DEMO) {
	;
} else {
    alert('접근권한이 없습니다.');
}

// 데모설정
$dset['layout'] = '';
$dset['background'] = '';
$dset['page'] = 9;
$dset['bg'] = '';
$dset['title'] = 'none';

$g5['title'] = '그룹메인';
include_once(G5_THEME_PATH.'/head.php');

//layout 내 경로지정
$group_skin_path = G5_THEME_PATH.'/group';
$group_skin_url = G5_THEME_URL.'/group';

?>

<?php echo na_widget('basic-title', 'demo-grt', 'height=25%', 'auto=0'); //타이틀 ?>

<div class="h20"></div>

<div class="row">
<?php 
for ($i=0; $i < 12; $i++) { ?>
	<?php if($i > 0 && $i%3 == 0) { ?>
			</div>
		<div class="row">
	<?php } ?>
	<div class="col-sm-4">
		<!-- 위젯 시작 { -->
		<h3 class="h3 en">
			<a href="<?php echo get_pretty_url('video'); ?>">
				<span class="pull-right more f-small">+</span>
				게시판
			</a>
		</h3>
		<hr class="hr line-<?php echo NT_COLOR ?>"/>

		<?php echo na_widget('basic-wr-list', 'demo-grl', 'bo_list=video ca_list=게임'); ?>

		<div class="h20"></div>

	</div>
<?php } ?>
</div>

<?php
include_once(G5_THEME_PATH.'/tail.php');
?>

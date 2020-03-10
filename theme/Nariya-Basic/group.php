<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(!$is_admin) {
	if (G5_IS_MOBILE) {
		if($group['gr_device'] == 'pc')
			alert($group['gr_subject'].' 그룹은 PC에서만 접근할 수 있습니다.');
	} else {
		if($group['gr_device'] == 'mobile')
		    alert($group['gr_subject'].' 그룹은 모바일에서만 접근할 수 있습니다.');
	}
}

$g5['title'] = $group['gr_subject'];
include_once(G5_THEME_PATH.'/head.sub.php');

// 설정값 변경
$tset['title'] = 'none'; //페이지 타이틀 출력안함

include_once(G5_THEME_PATH.'/head.php');

//layout 내 경로지정
$group_skin_path = G5_THEME_PATH.'/group';
$group_skin_url = G5_THEME_URL.'/group';
if(is_file($group_skin_path.'/'.$gr_id.'.php')) {
	include_once($group_skin_path.'/'.$gr_id.'.php');
	include_once(G5_THEME_PATH.'/tail.php');
	return;
}
?>

<?php echo na_widget('basic-title', 'grt-'.$gr_id, 'height=25%', 'auto=0'); //타이틀 ?>

<div class="h20"></div>

<div class="row">
<?php 
// 보드추출
$bo_device = (G5_IS_MOBILE) ? 'pc' : 'mobile';
$sql = " select bo_table, bo_subject
            from {$g5['board_table']}
            where gr_id = '{$gr_id}'
              and bo_list_level <= '{$member['mb_level']}'
              and bo_device <> '{$bo_device}' ";
if(!$is_admin)
    $sql .= " and bo_use_cert = '' ";
$sql .= " order by bo_order ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) { ?>
	<?php if($i > 0 && $i%3 == 0) { ?>
			</div>
		<div class="row">
	<?php } ?>
	<div class="col-sm-4">
		<!-- 위젯 시작 { -->
		<h3 class="h3 en">
			<a href="<?php echo get_pretty_url($row['bo_table']); ?>">
				<span class="pull-right more f-small">+</span>
				<?php echo get_text($row['bo_subject']) ?>
			</a>
		</h3>
		<hr class="hr line-<?php echo NT_COLOR ?>"/>

		<?php echo na_widget('basic-wr-list', 'gr-'.$row['bo_table'], 'bo_list='.$row['bo_table'].' cache=5'); ?>

		<div class="h20"></div>

	</div>
<?php } ?>
</div>

<?php
include_once(G5_THEME_PATH.'/tail.php');
?>

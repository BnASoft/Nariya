<?php
include_once('./_common.php');

if ($is_admin == 'super' || IS_DEMO) {
	;
} else {
    alert_close('접근권한이 없습니다.');
}

$pid = na_fid($pid);

if(!$pid)
    alert_close('값이 제대로 넘어오지 않았습니다.');

$g5['title'] = '페이지 설정';
include_once('../head.sub.php');

// PC 설정값
$pc = na_file_var_load(G5_THEME_PATH.'/storage/page/page-'.$pid.'-pc.php');

// 모바일 설정값
$mo = na_file_var_load(G5_THEME_PATH.'/storage/page/page-'.$pid.'-mo.php');

// 모달창이므로 창으로 열도록함
$is_clip_modal = false;

$mode = 'page';

$action_url = './page_update.php';
?>

<style>
body { 
	background:#fff; padding:0 0 50px; margin:0; 
}
#fsetup .table {
	min-width:600px;
}
.fsetup-head { 
	position:fixed; 
	z-index:10; 
	left:0; 
	top:0; 
	width:100%; 
	padding:10px 15px; 
	font-size:16px;
}
.fsetup-head .close { 
	font-size:28px !important;
}
</style>
<div class="fsetup-head bg-na-navy en">
	<button type="button" class="close white" onclick="closeClip();"><span aria-hidden="true" class="white">&times;</span>&nbsp;</button>
	<b>
		<i class="fa fa-cog fa-spin" aria-hidden="true"></i>
		$page_id = <?php echo $pid ?>
	</b>
</div>
<script>
function closeClip(){
	window.parent.closeSetupModal();
}
</script>
<form id="fsetup" name="fsetup" method="post" action="<?php echo $action_url ?>" class="form-horizontal na-fadin f-small">
<input type="hidden" name="pid" value="<?php echo $pid ?>"
<?php
include_once (NA_THEME_ADMIN_PATH.'/form/form.php');
?>
</form>
<?php
// Setup Modal
include_once (NA_PLUGIN_PATH.'/theme/setup.php');
include_once('../tail.sub.php');
?>
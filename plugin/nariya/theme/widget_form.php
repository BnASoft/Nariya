<?php
include_once('./_common.php');

if ($is_admin == 'super' || IS_DEMO) {
	;
} else {
    alert_close('접근권한이 없습니다.');
}

$wname = na_fid($wname);
$wid = na_fid($wid);

if(!$wname || !$wid)
    alert_close('값이 제대로 넘어오지 않았습니다.');

// 클립모달
$is_clip_modal = false;

// 경로
$widget_path = G5_THEME_PATH.'/widget/'.$wname;

if(!file_exists($widget_path.'/widget.setup.php'))
    alert_close('위젯설정을 할 수 없는 위젯입니다.');

include_once(NA_PLUGIN_PATH.'/lib/option.lib.php');

$widget_url = G5_THEME_URL.'/widget/'.$wname;

// 설정값아이디
$id = $wname.'-'.$wid;

// 기본 설정값
$wset = na_file_var_load(G5_THEME_PATH.'/storage/widget/widget-'.$id.'-pc.php');

// 모바일 설정값
$mo = na_file_var_load(G5_THEME_PATH.'/storage/widget/widget-'.$id.'-mo.php');

$g5['title'] = '위젯 설정';
include_once(G5_THEME_PATH.'/head.sub.php');

?>

<link rel="stylesheet" href="<?php echo NA_PLUGIN_URL ?>/css/setup.css">

<form id="fsetup" name="fsetup" class="form-horizontal na-fadein f-small" action="./widget_update.php" method="post" onsubmit="return fsetup_submit(this);">
<input type="hidden" name="wname" value="<?php echo urlencode($wname) ?>">
<input type="hidden" name="wid" value="<?php echo urlencode($wid) ?>">
<input type="hidden" name="opt" value="<?php echo urlencode($opt) ?>">
<input type="hidden" name="freset" value="">
<div class="fsetup-head bg-na-navy en">
	<button type="button" class="close white close-setup"><span aria-hidden="true" class="white">&times;</span></button>
	<i class="fa fa-cog fa-spin"></i>
	<b>ID : <?php echo $id;?></b>
</div>

<?php @include_once($widget_path.'/widget.setup.php'); ?>

<div id="fsetup_btn">
	<div class="btn-group btn-group-justified" role="group">
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-dark close-setup" onclick="window.close();">닫기</button>
		</div>
		<div class="btn-group" role="group">
			<button type="submit" class="btn btn-na-navy" onclick="document.pressed='reset'">초기화</button>
		</div>
		<div class="btn-group" role="group">
			<button type="submit" class="btn btn-na-red" onclick="document.pressed='save'">저장하기</button>
		</div>
	</div>
</div>

</form>
<script>
	function fsetup_submit(f) {
		if(document.pressed == "reset") {
			if (confirm("정말 초기화 하시겠습니까?\n\n초기화시 이전 설정값으로 복구할 수 없습니다.")) {
				f.freset.value = 1;
			} else {
				return false;
			}

		}
		return true;
	}
	$(document).ready(function() {
		$('.close-setup').click(function() {
			window.parent.closeSetupModal();
		});
	});
</script>
<?php 
include_once(NA_PLUGIN_PATH.'/theme/setup.php');
include_once(G5_THEME_PATH.'/tail.sub.php');
?>
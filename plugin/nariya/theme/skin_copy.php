<?php
include_once('./_common.php');

check_demo();

if ($is_admin != 'super')
    alert_close('접근권한이 없습니다.');

if(!$board['bo_table'])
   alert_close('값이 제대로 넘어오지 않았습니다.');

// 클립모달
$is_clip_modal = false;

$g5['title'] = $board['bo_subject'].' 게시판 스킨설정 복사해 주기';
include_once(G5_THEME_PATH.'/head.sub.php');

?>

<link rel="stylesheet" href="<?php echo NA_PLUGIN_URL ?>/css/setup.css">

<style>
body { padding:0 0 30px; }
#fsetup .list-group-item p { 
	width:33.333%; 
	padding:2px;
}
</style>
<form id="fsetup" name="fsetup" class="form-horizontal na-fadein f-small" action="./skin_copy_update.php" method="post" onsubmit="return fsetup_submit(this);">
<input type="hidden" name="bo_table" value="<?php echo urlencode($bo_table) ?>">

<ul class="list-group">
<li class="list-group-item bg-light f-small">
	※ 설정값을 복사해 줄 게시판을 한개 이상 선택해 주십시오.
	<?php if(isset($nariya['mobile_skin']) && $nariya['mobile_skin']) { ?>
		<br>
		<label class="checkbox-inline">
			<b><input type="checkbox" name="both" value="1"> PC/모바일 설정값 모두 복사해 주기</b>
		</label>
	<?php } else { ?>
		<input type="hidden" name="both" value="1">
	<?php } ?>
</li>
<?php
	$n = 0;
	$result = sql_query(" select gr_id, gr_subject from {$g5['group_table']} order by gr_id ");
	for ($i=0; $row=sql_fetch_array($result); $i++) {
?>
	<li class="list-group-item bg-na-navy">
		<b><?php echo get_text($row['gr_subject']) ?></b>
	</li>
	<li class="list-group-item">
	<?php
		$result1 = sql_query("select bo_table, bo_subject from {$g5['board_table']} where gr_id = '{$row['gr_id']}' order by bo_table ");
		for ($j=0; $row1=sql_fetch_array($result1); $j++) {
	?>
			<p class="pull-left">
				<span class="sound_only"><?php echo $row1['bo_table'] ?></span>
				<label for="chk<?php echo $n ?>" class="checkbox-inline">
					<input type="checkbox" value="<?php echo $row1['bo_table'] ?>" id="chk<?php echo $n ?>" name="chk_bo_table[]"<?php echo ($bo_table === $row1['bo_table']) ? ' disabled' : '';?>>
					<?php echo get_text($row1['bo_subject']) ?>
				</label>
			</p>
	<?php $n++; } ?>
		<div class="clearfix"></div>
	</li>
<?php } ?>
</ul>

<div id="fsetup_btn">
	<div class="btn-group btn-group-justified" role="group">
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-dark" onclick="window.close();">창닫기</button>
		</div>
		<div class="btn-group" role="group">
			<button type="submit" id="btn_submit" class="btn btn-na-red">복사해 주기</button>
		</div>
	</div>
</div>
</form>

<script>
function all_checked(sw) {
    var f = document.fboardmoveall;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_bo_table[]")
            f.elements[i].checked = sw;
    }
}

function fsetup_submit(f) {
    var check = false;

    if (typeof(f.elements['chk_bo_table[]']) == 'undefined')
        ;
    else {
        if (typeof(f.elements['chk_bo_table[]'].length) == 'undefined') {
            if (f.elements['chk_bo_table[]'].checked)
                check = true;
        } else {
            for (i=0; i<f.elements['chk_bo_table[]'].length; i++) {
                if (f.elements['chk_bo_table[]'][i].checked) {
                    check = true;
                    break;
                }
            }
        }
    }

    if (!check) {
        alert('설정값을 복사해 줄 게시판을 한개 이상 선택해 주십시오.');
        return false;
    }

	if (confirm("정말 스킨설정을 복사해 주시겠습니까?\n\n복사해 줄 경우 각 게시판은 이전 설정값으로 복구할 수 없습니다.")) {
	    document.getElementById('btn_submit').disabled = true;
		return true;
	} else {
		return false;
	}

    return false;
}
</script>

<?php 
include_once(G5_THEME_PATH.'/tail.sub.php');
?>

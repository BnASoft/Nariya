<?php
include_once('./_common.php');

$edir = na_file_path_check($edir);

// 클립모달
$is_clip_modal = false;

$emo = array();

if($edir && is_dir(NA_PLUGIN_PATH.'/skin/emo/'.$edir)) {
	$is_emo = true;
	$emo_path = NA_PLUGIN_PATH.'/skin/emo/'.$edir;
	$emo_skin = $edir.'/';
} else {
	$is_emo = false;
	$emo_path = NA_PLUGIN_PATH.'/skin/emo';
	$emo_skin = '';
}

$handle = opendir($emo_path);
while ($file = readdir($handle)) {
	if(preg_match("/\.(jpg|jpeg|gif|png)$/i", $file)) {
		$emo[] = $file;
	}
}
closedir($handle);
sort($emo);

$emoticon = array();
for($i=0; $i < count($emo); $i++) {
	$emoticon[$i]['name'] = $emo_skin.$emo[$i];
	$emoticon[$i]['url'] = NA_PLUGIN_URL.'/skin/emo/'.$emo_skin.$emo[$i];
}

// Emo Skin
$eskin = array();
$ehandle = opendir(NA_PLUGIN_PATH.'/skin/emo');
while ($efile = readdir($ehandle)) {

	if($efile == "." || $efile == ".." || preg_match("/\.(jpg|jpeg|gif|png)$/i", $efile)) continue;

	if (is_dir(NA_PLUGIN_PATH.'/skin/emo/'.$efile)) 
		$eskin[] = $efile;
}
closedir($ehandle);
sort($eskin);
$eskin_cnt = count($eskin);

// 클립보드
$is_clip = ($clip) ? true : false;

$g5['title'] = '이모티콘';

include_once(G5_THEME_PATH.'/head.sub.php');

?>

<link rel="stylesheet" href="<?php echo NA_PLUGIN_URL ?>/css/clip.css">

<?php if($is_clip) { ?>
<!-- 클립보드 복사 시작 { -->
<script src="<?php echo NA_PLUGIN_URL ?>/js/clipboard.min.js"></script>
<div class="modal fade" id="clipModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<ul class="list-group">
		<li class="list-group-item bg-na-navy no-border">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="white">&times;</span></button>
			<b>이모티콘 클립보드</b>
		</li>
		<li class="list-group-item no-border">
			<input type="text" id="txtClip" class="form-control">
			<div class="h10"></div>
			<button type="button" class="btn btn-red btn-clip btn-block" data-clipboard-target="#txtClip">
				<i class="fa fa-code" aria-hidden="true"></i>
				코드복사
			</button>
		</li>
		</ul>
	</div>
</div>
<!-- 클립보드 복사 끝 { -->
<?php } ?>

<form name="fclip" method="get" class="no-margin">
<div class="clip-head bg-na-navy en">
	<button type="button" class="close white clip-close"><span aria-hidden="true" class="white">&times;</span>&nbsp;</button>
	<b>
		<i class="fa fa-smile-o" aria-hidden="true"></i>
		EMOTICON
	</b>
	<?php if($eskin_cnt) { 
		$clip_change = ($is_clip) ? "+'&clip=1'" : "";	
	?>
		<select class="black" name="eskin" onchange="location='<?php echo NA_PLUGIN_URL ?>/clip_emo.php?edir='+encodeURIComponent(this.value)<?php echo $clip_change ?>;">
			<option value="">Basic</option>
			<?php for($i=0; $i < $eskin_cnt; $i++) { ?>
				<option value="<?php echo $eskin[$i] ?>"<?php echo get_selected($edir,$eskin[$i]) ?>><?php echo ucfirst($eskin[$i]) ?></option>
			<?php } ?>
		</select>
	<?php } ?>
</div>
</form>

<div class="clip-box">
	<?php for($i=0; $i < count($emoticon); $i++) { ?>
		<img src="<?php echo $emoticon[$i]['url'] ?>" onclick="clip_insert('<?php echo $emoticon[$i]['name'] ?>');" class="clip-img" alt="">
	<?php } ?>
</div>

<script>
<?php if($is_clip) { ?>
	function clip_insert(txt){
		var clip = "{emo:" + txt + ":50}";
		$("#txtClip").val(clip);
		$('#clipModal').modal('show');
	}
<?php } else { ?>
	function clip_insert(txt){
		var clip = "{emo:" + txt + ":50}";
		parent.document.getElementById("wr_content").value += clip;
		window.parent.closeClipModal();
	}
<?php } ?>
$(document).ready(function() {
	<?php if($is_clip) { ?>
		var clipboard = new ClipboardJS('.btn-clip');
		clipboard.on('success', function(e) {
			alert("복사가 되었으니 Ctrl + V 를 눌러 붙여넣기해 주세요.");
			$('#clipModal').modal('hide');
			window.parent.closeClipModal();
		});
		clipboard.on('error', function(e) {
			alert("복사가 안되었으니 Ctrl + C 를 눌러 복사해 주세요.");
		});
	<?php } ?>
	$('.clip-close').click(function() {
		window.parent.closeClipModal();
	});
});
</script>

<?php
include_once(G5_THEME_PATH.'/tail.sub.php');
?>
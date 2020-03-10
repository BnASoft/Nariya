<?php
include_once('./_common.php');

if ($is_admin == 'super' || IS_DEMO) {
	;
} else {
    alert_close('접근권한이 없습니다.');
}

$mode = na_fid($mode);
$fid = na_fid($fid);

if(!$mode || !$fid)
    alert_close('값이 제대로 넘어오지 않았습니다.');

$g5['title'] = '이미지 관리';
include_once(G5_THEME_PATH.'/head.sub.php');

// 이미지 리스트 정리
$arr = array();
$list = array();

$arr = na_file_list(G5_THEME_PATH.'/storage/image');

$arr_cnt = count($arr);

$i=0;
for($j=0; $j < $arr_cnt; $j++) {

	$img = $arr[$j];

	if (!preg_match("/(\.(jpg|jpeg|gif|png))$/i", $img))
		continue;

	list($head) = explode('-', $img);

	if($head != $mode)
		continue;

	$list[$i] = $img;
	$i++;
}

$list_cnt = count($list);

if($list_cnt) {
	na_script('imagesloaded');
	na_script('masonry');
}

?>

<link rel="stylesheet" href="<?php echo NA_PLUGIN_URL ?>/css/setup.css">
<style>
body { margin:0; padding:75px 0 50px; background:#fff; }
.btn, input { border-radius:0 !important; }
</style>
<form id="fsetup" name="fsetup" class="form f-small" action="./image_update.php" method="post" enctype="multipart/form-data">
	<input type="hidden" name="mode" value="<?php echo $mode ?>">
	<input type="hidden" name="fid" value="<?php echo $fid ?>">
	<div class="fsetup-head bg-na-navy">
		<div class="f-small">
			<i class="fa fa-bell"></i> 
			등록시 모드(mode)명이 자동으로 이미지의 접두어로 등록됩니다.
		</div>
		<div class="input-group">
			<input type="file" name="img_file" value="" class="form-control">
			<div class="input-group-btn">
				<button type="submit" class="btn btn-na-red">
					<i class="fa fa-upload fa-lg"></i>
					<span class="sound_only">등록하기</span>
				</button>
			</div>
		</div>
	</div>
</form>

<div id="img_list">
	<?php for($i=0; $i < count($list); $i++) { 
		$img_href = G5_THEME_URL."/storage/image/".$list[$i];
		$img_title = str_replace(G5_THEME_URL, "..", $img_href);
	?>
		<div class="item" id="<?php echo substr($list[$i], 0, strrpos($list[$i], '.')) ?>">
			<div class="well well-sm">
				<a href="./image_view.php?fn=<?php echo urlencode(G5_THEME_URL.'/storage/image/'.$list[$i]) ?>" class="item_image">
					<img src="<?php echo G5_THEME_URL?>/storage/image/<?php echo $list[$i] ?>" alt="<?php echo $list[$i] ?>" title="<?php echo $list[$i] ?>">
				</a>
				<p class="text-center">
					<a href="<?php echo $img_href ?>" class="btn btn-xs btn-na-red sel-img" title="<?php echo $img_title ?>">
						선택
					</a>
					<a href="./image_delete.php?mode=<?php echo urlencode($mode) ?>&amp;fid=<?php echo urlencode($fid);?>&amp;img=<?php echo urlencode($list[$i]) ?>" class="btn btn-xs btn-default img-del">
						삭제
					</a>
				</p>
			</div>
		</div>
	<?php } ?>
</div>
<div class="clearfix"></div>

<div id="fsetup_btn">
	<button type="button" class="btn btn-na-navy btn-block close-setup">닫기</button>
</div>

<script>
	$(document).ready(function() {
		<?php if($list_cnt) { ?>
		var $container = $('#img_list');

		$container.imagesLoaded(function(){
			$container.masonry({
				columnWidth : '.item',
				itemSelector : '.item',
				isAnimated: true
			});
		});
		<?php } ?>
		$('.img-del').click(function() {
			if(confirm("삭제하시겠습니까?")) {
				return true;
			}
			return false;
		});

		$('.sel-img').click(function() {
			$("#<?php echo $fid ?>", parent.document).val(this.title);
			window.parent.closeSetupModal();
			return false;
		});

		$('.close-setup').click(function() {
			window.parent.closeSetupModal();
		});
	});
</script>
<?php 
include_once(G5_THEME_PATH.'/tail.sub.php');
?>
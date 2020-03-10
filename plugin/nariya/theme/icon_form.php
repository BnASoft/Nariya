<?php
include_once('./_common.php');

$fid = na_fid($fid);

if(!$fid) {
    alert_close('값이 제대로 넘어오지 않았습니다.');
}

// 클립모달
$is_clip_modal = false;

// 클립보드
$is_clip = ($fid == 'clip') ? true : false;

// 아이콘 불러오기
@include_once(NA_PLUGIN_PATH.'/icon_list.php');

$g5['title'] = '아이콘 선택';
include_once(G5_THEME_PATH.'/head.sub.php');
?>

<?php if($is_clip) { //클립보드 ?>
<script src="<?php echo NA_PLUGIN_URL ?>/js/clipboard.min.js"></script>

<!-- 클립보드 복사 시작 { -->
<div class="modal fade" id="conModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<ul class="list-group">
		<li class="list-group-item bg-navy no-border">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="white">&times;</span></button>
			<b>FA아이콘 클립보드</b>
		</li>
		<li class="list-group-item no-border">
			<div class="input-group">
				<input type="text" id="conClip" class="form-control">
				<span class="input-group-btn">
					<button class="btn btn-crimson btn-clip" data-clipboard-target="#conClip">복사하기</button>
				</span>
			</div>
		</li>
		</ul>
	</div>
</div>
<!-- 클립보드 복사 끝 { -->
<?php } ?>
<style>
body { padding:20px; }
a { color:#333; margin:5px; padding:6px 0; text-align:center; width:52px; line-height:24px; display:inline-block; text-decoration:none;}
a:hover { color:#fff; text-decoration:none; background:rgb(50, 60, 70); border-radius:5px; }
.font-16 { font-size:16px; }
.font-14 { font-size:14px; }
</style>

<ul class="list-group en font-16">
	<li class="list-group-item bg-navy" id="web-application">
		<i class="fa fa-smile-o fa-lg"></i> <b>Font Awesome Icon</b>
	</li>
	<li class="list-group-item bg-light" id="web-application">
		<b>Web Application Icons</b>
	</li>
	<li class="list-group-item font-14">
		<?php for($i=0; $i < count($fas['web']); $i++) { ?>
			<a href="#" title="<?php echo $fas['web'][$i] ?>" class="sel-icon">
				<i class="fa fa-<?php echo $fas['web'][$i] ?> fa-2x"></i>
			</a>
		<?php } ?>
	</li>
	<li class="list-group-item bg-light" id="accessibility">
		<b>Accessibility Icons</b>
	</li>
	<li class="list-group-item font-14">
		<?php for($i=0; $i < count($fas['access']); $i++) { ?>
			<a href="#" title="<?php echo $fas['access'][$i] ?>" class="sel-icon">
				<i class="fa fa-<?php echo $fas['access'][$i] ?> fa-2x"></i>
			</a>
		<?php } ?>
	</li>
	<li class="list-group-item bg-light" id="hand">
		<b>Hand Icons</b>
	</li>
	<li class="list-group-item font-14">
		<?php for($i=0; $i < count($fas['hand']); $i++) { ?>
			<a href="#" title="<?php echo $fas['hand'][$i] ?>" class="sel-icon">
				<i class="fa fa-<?php echo $fas['hand'][$i] ?> fa-2x"></i>
			</a>
		<?php } ?>
	</li>
	<li class="list-group-item bg-light" id="transportation">
		<b>Transportation Icons</b>
	</li>
	<li class="list-group-item font-14">
		<?php for($i=0; $i < count($fas['trans']); $i++) { ?>
			<a href="#" title="<?php echo $fas['trans'][$i] ?>" class="sel-icon">
				<i class="fa fa-<?php echo $fas['trans'][$i] ?> fa-2x"></i>
			</a>
		<?php } ?>
	</li>
	<li class="list-group-item bg-light" id="gender">
		<b>Gender Icons</b>
	</li>
	<li class="list-group-item font-14">
		<?php for($i=0; $i < count($fas['gender']); $i++) { ?>
			<a href="#" title="<?php echo $fas['gender'][$i] ?>" class="sel-icon">
				<i class="fa fa-<?php echo $fas['gender'][$i] ?> fa-2x"></i>
			</a>
		<?php } ?>
	</li>
	<li class="list-group-item bg-light" id="filetype">
		<b>File Type Icons</b>
	</li>
	<li class="list-group-item font-14">
		<?php for($i=0; $i < count($fas['file']); $i++) { ?>
			<a href="#" title="<?php echo $fas['file'][$i] ?>" class="sel-icon">
				<i class="fa fa-<?php echo $fas['file'][$i] ?> fa-2x"></i>
			</a>
		<?php } ?>
	</li>
	<li class="list-group-item bg-light" id="spinner">
		<b>Spinner Icons</b>
	</li>
	<li class="list-group-item font-14">
		<?php for($i=0; $i < count($fas['spin']); $i++) { ?>
			<a href="#" title="<?php echo $fas['spin'][$i] ?>" class="sel-icon">
				<i class="fa fa-<?php echo $fas['spin'][$i] ?> fa-2x fa-spin"></i>
			</a>
		<?php } ?>
	</li>
	<li class="list-group-item bg-light" id="form-control">
		<b>Form Control Icons</b>
	</li>
	<li class="list-group-item font-14">
		<?php for($i=0; $i < count($fas['form']); $i++) { ?>
			<a href="#" title="<?php echo $fas['form'][$i] ?>" class="sel-icon">
				<i class="fa fa-<?php echo $fas['form'][$i] ?> fa-2x"></i>
			</a>
		<?php } ?>
	</li>
	<li class="list-group-item bg-light" id="payment">
		<b>Payment Icons</b>
	</li>
	<li class="list-group-item font-14">
		<?php for($i=0; $i < count($fas['pay']); $i++) { ?>
			<a href="#" title="<?php echo $fas['pay'][$i] ?>" class="sel-icon">
				<i class="fa fa-<?php echo $fas['pay'][$i] ?> fa-2x"></i>
			</a>
		<?php } ?>
	</li>
	<li class="list-group-item bg-light" id="chart">
		<b>Chart Icons</b>
	</li>
	<li class="list-group-item font-14">
		<?php for($i=0; $i < count($fas['chart']); $i++) { ?>
			<a href="#" title="<?php echo $fas['chart'][$i] ?>" class="sel-icon">
				<i class="fa fa-<?php echo $fas['chart'][$i] ?> fa-2x"></i>
			</a>
		<?php } ?>
	</li>
	<li class="list-group-item bg-light" id="currency">
		<b>Currency Icons</b>
	</li>
	<li class="list-group-item font-14">
		<?php for($i=0; $i < count($fas['cur']); $i++) { ?>
			<a href="#" title="<?php echo $fas['cur'][$i] ?>" class="sel-icon">
				<i class="fa fa-<?php echo $fas['cur'][$i] ?> fa-2x"></i>
			</a>
		<?php } ?>
	</li>
	<li class="list-group-item bg-light" id="editor">
		<b>Text Editor Icons</b>
	</li>
	<li class="list-group-item font-14">
		<?php for($i=0; $i < count($fas['edit']); $i++) { ?>
			<a href="#" title="<?php echo $fas['edit'][$i] ?>" class="sel-icon">
				<i class="fa fa-<?php echo $fas['edit'][$i] ?> fa-2x"></i>
			</a>
		<?php } ?>
	</li>
	<li class="list-group-item bg-light" id="directional">
		<b>Directional Icons</b>
	</li>
	<li class="list-group-item font-14">
		<?php for($i=0; $i < count($fas['direct']); $i++) { ?>
			<a href="#" title="<?php echo $fas['direct'][$i] ?>" class="sel-icon">
				<i class="fa fa-<?php echo $fas['direct'][$i] ?> fa-2x"></i>
			</a>
		<?php } ?>
	</li>
	<li class="list-group-item bg-light" id="video">
		<b>Video Player Icons</b>
	</li>
	<li class="list-group-item font-14">
		<?php for($i=0; $i < count($fas['video']); $i++) { ?>
			<a href="#" title="<?php echo $fas['video'][$i] ?>" class="sel-icon">
				<i class="fa fa-<?php echo $fas['video'][$i] ?> fa-2x"></i>
			</a>
		<?php } ?>
	</li>
	<li class="list-group-item bg-light" id="brand">
		<b>Brand Icons</b>
	</li>
	<li class="list-group-item font-14">
		<?php for($i=0; $i < count($fas['brand']); $i++) { ?>
			<a href="#" title="<?php echo $fas['brand'][$i] ?>" class="sel-icon">
				<i class="fa fa-<?php echo $fas['brand'][$i] ?> fa-2x"></i>
			</a>
		<?php } ?>
	</li>
	<li class="list-group-item bg-light" id="medical">
		<b>Medical Icons</b>
	</li>
	<li class="list-group-item font-14">
		<?php for($i=0; $i < count($fas['medical']); $i++) { ?>
			<a href="#" title="<?php echo $fas['medical'][$i] ?>" class="sel-icon">
				<i class="fa fa-<?php echo $fas['medical'][$i] ?> fa-2x"></i>
			</a>
		<?php } ?>
	</li>
</ul>

<p class="text-center">
	<button type="button" class="btn btn-white" onclick="window.close();">창닫기</button>
</p>

<script>
$(document).ready(function() {
	<?php if($is_clip) { ?>
		var clipboard = new ClipboardJS('.btn-clip');
		clipboard.on('success', function(e) {
			alert("복사가 되었으니 Ctrl + V 를 눌러 붙여넣기해 주세요.");
			self.close();
		});
		clipboard.on('error', function(e) {
			alert("복사가 안되었으니 Ctrl + C 를 눌러 복사해 주세요.");
		});
		$('.sel-icon').click(function() {
			var ficon = "{icon:" + this.title + " fa-4x}";
			$("#conClip").val(ficon);
			$('#conModal').modal('show');
			return false;
		});
	<?php } else { ?>
	$('.sel-icon').click(function() {
		$("#<?php echo $fid;?>",opener.document).val(this.title);
		self.close();
		return false;
	});
	<?php } ?>
});
</script>

<?php 
include_once(G5_THEME_PATH.'/tail.sub.php');
?>

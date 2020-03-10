<?php
include_once('./_common.php');

// 클립모달
$is_clip_modal = false;

// 클립보드
$is_clip = ($clip) ? true : false;

// 아이콘 불러오기
@include_once(NA_PLUGIN_PATH.'/icon.php');

$g5['title'] = '폰트어썸 아이콘';
include_once(G5_THEME_PATH.'/head.sub.php');

?>
<div style="height:45px;"></div>
<style>
body { margin:0; padding:0; background:#fff; }
a { color:#333; margin:5px; padding:5px 0; text-align:center; width:40px; line-height:24px; display:inline-block; text-decoration:none;}
a:hover { color:#fff; text-decoration:none; background:rgb(50, 60, 70); border-radius:3px; }
.clip-head { position:fixed; z-index:10; left:0; top:0; width:100%; padding:10px 15px; font-size:16px; }
.clip-head .close { font-size:28px !important; }
.font-16 { font-size:16px; }
.font-14 { font-size:14px; }
.list-group-item { border-left:0 !important; border-right:0 !important; }
</style>

<?php if($is_clip) { ?>
<!-- 클립보드 복사 시작 { -->
<script src="<?php echo NA_PLUGIN_URL ?>/js/clipboard.min.js"></script>
<div class="modal fade" id="clipModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<ul class="list-group">
		<li class="list-group-item bg-na-navy no-border">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="white">&times;</span></button>
			<b>FA아이콘 클립보드</b>
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

<div class="clip-head bg-na-navy en">
	<button type="button" class="close white clip-close"><span aria-hidden="true" class="white">&times;</span>&nbsp;</button>
	<b>
		<i class="fa fa-font-awesome" aria-hidden="true"></i>
		FONTAWESOME
	</b>
</div>
<ul class="list-group en font-16">
	<li class="list-group-item bg-light" id="web-application">
		<b>Web Application Icons</b>
	</li>
	<li class="list-group-item font-14">
		<?php for($i=0; $i < count($fas['web']); $i++) { ?>
			<a href="#" title="<?php echo $fas['web'][$i] ?>" class="clip-icon">
				<i class="fa fa-<?php echo $fas['web'][$i] ?> fa-2x"></i>
			</a>
		<?php } ?>
	</li>
	<li class="list-group-item bg-light" id="accessibility">
		<b>Accessibility Icons</b>
	</li>
	<li class="list-group-item font-14">
		<?php for($i=0; $i < count($fas['access']); $i++) { ?>
			<a href="#" title="<?php echo $fas['access'][$i] ?>" class="clip-icon">
				<i class="fa fa-<?php echo $fas['access'][$i] ?> fa-2x"></i>
			</a>
		<?php } ?>
	</li>
	<li class="list-group-item bg-light" id="hand">
		<b>Hand Icons</b>
	</li>
	<li class="list-group-item font-14">
		<?php for($i=0; $i < count($fas['hand']); $i++) { ?>
			<a href="#" title="<?php echo $fas['hand'][$i] ?>" class="clip-icon">
				<i class="fa fa-<?php echo $fas['hand'][$i] ?> fa-2x"></i>
			</a>
		<?php } ?>
	</li>
	<li class="list-group-item bg-light" id="transportation">
		<b>Transportation Icons</b>
	</li>
	<li class="list-group-item font-14">
		<?php for($i=0; $i < count($fas['trans']); $i++) { ?>
			<a href="#" title="<?php echo $fas['trans'][$i] ?>" class="clip-icon">
				<i class="fa fa-<?php echo $fas['trans'][$i] ?> fa-2x"></i>
			</a>
		<?php } ?>
	</li>
	<li class="list-group-item bg-light" id="gender">
		<b>Gender Icons</b>
	</li>
	<li class="list-group-item font-14">
		<?php for($i=0; $i < count($fas['gender']); $i++) { ?>
			<a href="#" title="<?php echo $fas['gender'][$i] ?>" class="clip-icon">
				<i class="fa fa-<?php echo $fas['gender'][$i] ?> fa-2x"></i>
			</a>
		<?php } ?>
	</li>
	<li class="list-group-item bg-light" id="filetype">
		<b>File Type Icons</b>
	</li>
	<li class="list-group-item font-14">
		<?php for($i=0; $i < count($fas['file']); $i++) { ?>
			<a href="#" title="<?php echo $fas['file'][$i] ?>" class="clip-icon">
				<i class="fa fa-<?php echo $fas['file'][$i] ?> fa-2x"></i>
			</a>
		<?php } ?>
	</li>
	<li class="list-group-item bg-light" id="spinner">
		<b>Spinner Icons</b>
	</li>
	<li class="list-group-item font-14">
		<?php for($i=0; $i < count($fas['spin']); $i++) { ?>
			<a href="#" title="<?php echo $fas['spin'][$i] ?>" class="clip-icon">
				<i class="fa fa-<?php echo $fas['spin'][$i] ?> fa-2x fa-spin"></i>
			</a>
		<?php } ?>
	</li>
	<li class="list-group-item bg-light" id="form-control">
		<b>Form Control Icons</b>
	</li>
	<li class="list-group-item font-14">
		<?php for($i=0; $i < count($fas['form']); $i++) { ?>
			<a href="#" title="<?php echo $fas['form'][$i] ?>" class="clip-icon">
				<i class="fa fa-<?php echo $fas['form'][$i] ?> fa-2x"></i>
			</a>
		<?php } ?>
	</li>
	<li class="list-group-item bg-light" id="payment">
		<b>Payment Icons</b>
	</li>
	<li class="list-group-item font-14">
		<?php for($i=0; $i < count($fas['pay']); $i++) { ?>
			<a href="#" title="<?php echo $fas['pay'][$i] ?>" class="clip-icon">
				<i class="fa fa-<?php echo $fas['pay'][$i] ?> fa-2x"></i>
			</a>
		<?php } ?>
	</li>
	<li class="list-group-item bg-light" id="chart">
		<b>Chart Icons</b>
	</li>
	<li class="list-group-item font-14">
		<?php for($i=0; $i < count($fas['chart']); $i++) { ?>
			<a href="#" title="<?php echo $fas['chart'][$i] ?>" class="clip-icon">
				<i class="fa fa-<?php echo $fas['chart'][$i] ?> fa-2x"></i>
			</a>
		<?php } ?>
	</li>
	<li class="list-group-item bg-light" id="currency">
		<b>Currency Icons</b>
	</li>
	<li class="list-group-item font-14">
		<?php for($i=0; $i < count($fas['cur']); $i++) { ?>
			<a href="#" title="<?php echo $fas['cur'][$i] ?>" class="clip-icon">
				<i class="fa fa-<?php echo $fas['cur'][$i] ?> fa-2x"></i>
			</a>
		<?php } ?>
	</li>
	<li class="list-group-item bg-light" id="editor">
		<b>Text Editor Icons</b>
	</li>
	<li class="list-group-item font-14">
		<?php for($i=0; $i < count($fas['edit']); $i++) { ?>
			<a href="#" title="<?php echo $fas['edit'][$i] ?>" class="clip-icon">
				<i class="fa fa-<?php echo $fas['edit'][$i] ?> fa-2x"></i>
			</a>
		<?php } ?>
	</li>
	<li class="list-group-item bg-light" id="directional">
		<b>Directional Icons</b>
	</li>
	<li class="list-group-item font-14">
		<?php for($i=0; $i < count($fas['direct']); $i++) { ?>
			<a href="#" title="<?php echo $fas['direct'][$i] ?>" class="clip-icon">
				<i class="fa fa-<?php echo $fas['direct'][$i] ?> fa-2x"></i>
			</a>
		<?php } ?>
	</li>
	<li class="list-group-item bg-light" id="video">
		<b>Video Player Icons</b>
	</li>
	<li class="list-group-item font-14">
		<?php for($i=0; $i < count($fas['video']); $i++) { ?>
			<a href="#" title="<?php echo $fas['video'][$i] ?>" class="clip-icon">
				<i class="fa fa-<?php echo $fas['video'][$i] ?> fa-2x"></i>
			</a>
		<?php } ?>
	</li>
	<li class="list-group-item bg-light" id="brand">
		<b>Brand Icons</b>
	</li>
	<li class="list-group-item font-14">
		<?php for($i=0; $i < count($fas['brand']); $i++) { ?>
			<a href="#" title="<?php echo $fas['brand'][$i] ?>" class="clip-icon">
				<i class="fa fa-<?php echo $fas['brand'][$i] ?> fa-2x"></i>
			</a>
		<?php } ?>
	</li>
	<li class="list-group-item bg-light" id="medical">
		<b>Medical Icons</b>
	</li>
	<li class="list-group-item font-14" style="border-bottom:0">
		<?php for($i=0; $i < count($fas['medical']); $i++) { ?>
			<a href="#" title="<?php echo $fas['medical'][$i] ?>" class="clip-icon">
				<i class="fa fa-<?php echo $fas['medical'][$i] ?> fa-2x"></i>
			</a>
		<?php } ?>
	</li>
</ul>

<script>
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
		$('.clip-icon').click(function() {
			var clip = "{icon:" + this.title + " fa-4x}";
			$("#txtClip").val(clip);
			$('#clipModal').modal('show');
		});
	<?php } else { ?>
		$('.clip-icon').click(function() {
			var clip = "{icon:" + this.title + " fa-4x}";
			parent.document.getElementById("wr_content").value += clip;
			window.parent.closeClipModal();
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

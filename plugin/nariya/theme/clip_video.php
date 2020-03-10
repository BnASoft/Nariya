<?php
include_once('./_common.php');

// 클립보드
$is_clip = ($clip) ? true : false;

// 클립모달
$is_clip_modal = false;

$g5['title'] = '동영상 코드';
include_once(G5_THEME_PATH.'/head.sub.php');

?>
<div style="height:45px;"></div>
<style>
body { margin:0; padding:; background:#fff; }
.clip-head { position:fixed; z-index:1; left:0; top:0; width:100%; padding:10px; font-size:16px; }
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
			<b>동영상 클립보드</b>
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
	<button type="button" class="close white clip-close"><span aria-hidden="true" class="white">&times;</span></button>
	<b>
		<i class="fa fa-youtube-play" aria-hidden="true"></i>
		SHARE VIDEO
	</b>
</div>
<ul class="list-group">
	<li class="list-group-item bg-light">
		<b>동영상 공유주소 입력</b>
	</li>
	<li class="list-group-item">
		<div class="input-group">
			<input type="text" id="txtCode" class="form-control" placeholder="http://...">
			<div class="input-group-btn">
				<button type="button" class="btn btn-na-red btn-block clip-txt">
					<i class="fa fa-code" aria-hidden="true"></i>
					코드생성
				</button>
			</div>
		</div>
	</li>
	<li class="list-group-item">
		공유주소 등록가능 사이트
	</li>
	<li class="list-group-item" style="border-bottom:0">
		<ol>
			<li><a href="https://youtu.be" target="_blank">youtu.be</a></li>
			<li><a href="https://vimeo.com" target="_blank">vimeo.com</a></li>
			<li><a href="https://ted.com" target="_blank">ted.com</a></li>
			<li><a href="https://tv.kakao.com" target="_blank">tv.kakao.com</a></li>
			<li><a href="https://pandora.tv" target="_blank">pandora.tv</a></li>
			<li><a href="https://pandora.tv" target="_blank">pandora.tv</a></li>
			<?php if($nariya['fb_key']) { ?>
			<li><a href="https://facebook.com" target="_blank">facebook.com</a></li>
			<?php } ?>
			<li><a href="https://tv.naver.com" target="_blank">tv.naver.com</a></li>
			<li><a href="https://slideshare.net" target="_blank">slideshare.net</a></li>
			<li><a href="https://vid.me" target="_blank">vid.me</a></li>
			<li><a href="https://sendvid.com" target="_blank">sendvid.com</a></li>
			<li><a href="https://vine.co" target="_blank">vine.co</a></li>
			<li><a href="https://yinyuetai.com" target="_blank">yinyuetai.com</a></li>
			<li><a href="https://vlive.tv" target="_blank">vlive.tv</a></li>
			<li><a href="https://srook.net" target="_blank">srook.net</a></li>
			<li><a href="https://twitch.tv" target="_blank">twitch.tv</a></li>
			<li><a href="https://openload.co" target="_blank">openload.co</a></li>
			<li><a href="https://soundcloud.com" target="_blank">soundcloud.com</a></li>
			<li>mp4 등 동영상파일 URL</li>
		</ol>
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

		$('.clip-txt').click(function() {
			var txt = $('#txtCode').val();
			if(!txt) {
				alert('동영상의 공유주소(url)을 입력해 주세요.');
				$('#txtCode').focus();
				return false;
			}
			var clip = "{video: " + txt + " }";
			$("#txtClip").val(clip);
			$('#clipModal').modal('show');
		});
	<?php } else { ?>
		$('.clip-txt').click(function() {
			var txt = $('#txtCode').val();
			if(!txt) {
				alert('동영상의 공유주소(url)을 입력해 주세요.');
				$('#txtCode').focus();
				return false;
			}
			var clip = "{video: " + txt + " }";
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

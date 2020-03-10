<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);

?>
<style>
#fmail .form-group {
	margin-bottom:0;
}
</style>
<div id="fmail" class="win-cont">
	<form class="form-horizontal" role="form" name="fformmail" action="./formmail_send.php" onsubmit="return fformmail_submit(this);" method="post" enctype="multipart/form-data">
    <input type="hidden" name="to" value="<?php echo $email ?>">
    <input type="hidden" name="attach" value="2">
	<?php if ($is_member) { // 회원이면  ?>
		<input type="hidden" name="fnick" value="<?php echo get_text($member['mb_nick']) ?>">
		<input type="hidden" name="fmail" value="<?php echo $member['mb_email'] ?>">
	<?php }  ?>

	<ul class="list-group">
		<li class="list-group-item bg-<?php echo NT_COLOR ?>">
			<b>
			<?php if($name) { ?>
				<?php echo $name ?> 님께 메일보내기
			<?php } else { ?>
				메일보내기
			<?php } ?>
			</b>
		</li>
		<?php if (!$is_member) {  ?>
			<li class="list-group-item">
				<div class="form-group">
					<label class="col-sm-2 control-label" for="fnick">이름<strong class="sound_only">필수</strong></label>
					<div class="col-sm-10">
						<input type="text" name="fnick" id="fnick" required class="form-control required">
					</div>
				</div>
			</li>
			<li class="list-group-item">
				<div class="form-group">
					<label class="col-sm-2 control-label" for="fmail">E-mail<strong class="sound_only">필수</strong></label>
					<div class="col-sm-10">
						<input type="text" name="fmail" id="fmain" required class="form-control required">
					</div>
				</div>
			</li>
		<?php }  ?>
		<li class="list-group-item">
			<div class="form-group">
				<label class="col-sm-2 control-label" for="subject">제목<strong class="sound_only">필수</strong></label>
				<div class="col-sm-10">
					<input type="text" name="subject" id="subject" required class="form-control required">
				</div>
			</div>
		</li>
		<li class="list-group-item">
			<div class="form-group">
				<label class="col-sm-2 control-label" for="content">내용<strong class="sound_only">필수</strong></label>
				<div class="col-sm-10">
					<textarea name="content" id="content" rows="8" required class="form-control required"></textarea>

					<p>
						<label class="radio-inline"><input type="radio" name="type" value="0" id="type_text" checked> TEXT</label>
						<label class="radio-inline"><input type="radio" name="type" value="1" id="type_html"> HTML</label>
						<label class="radio-inline"><input type="radio" name="type" value="2" id="type_both"> TEXT+HTML</label>
					</p>
				</div>
			</div>
		</li>
		<li class="list-group-item">
			<div class="form-group">
				<label class="col-sm-2 control-label">첨부파일</label>
				<div class="col-sm-10">
					<div class="row">
						<div class="col-xs-6">
							<input type="file" name="file1"  id="file1">
						</div>
						<div class="col-xs-6">
							<input type="file" name="file2"  id="file2">
						</div>
					</div>
				</div>
			</div>
			<p class="help-block f-small" style="margin-bottom:0">
				첨부파일은 누락될 수 있으므로 메일을 보낸 후 파일이 첨부 되었는지 반드시 확인해 주세요.
			</p>
		</li>
		<li class="list-group-item text-center">
			<?php echo captcha_html(); ?>
		</li>
	</ul>	

	<p class="text-center">
		<button type="button" onclick="window.close();" class="btn btn-sm btn-white">창닫기</button>
		<button type="submit" id="btn_submit" class="btn btn-sm btn-<?php echo NT_COLOR ?>">메일발송</button>
	</p>

	</form>
</div>

<div class="h20"></div>

<script>
with (document.fformmail) {
    if (typeof fname != "undefined")
        fname.focus();
    else if (typeof subject != "undefined")
        subject.focus();
}

function fformmail_submit(f) {

	<?php echo chk_captcha_js();  ?>

    if (f.file1.value || f.file2.value) {
        // 4.00.11
        if (!confirm("첨부파일의 용량이 큰경우 전송시간이 오래 걸립니다.\n\n메일보내기가 완료되기 전에 창을 닫거나 새로고침 하지 마십시오."))
            return false;
    }

    document.getElementById('btn_submit').disabled = true;

    return true;
}

</script>
<!-- } 폼메일 끝 -->
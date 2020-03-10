<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

@include_once(G5_THEME_PATH.'/head.php');

$delete_str = "";
if ($w == 'x') $delete_str = "댓";
if ($w == 'u') $g5['title'] = $delete_str."글 수정";
else if ($w == 'd' || $w == 'x') $g5['title'] = $delete_str."글 삭제";
else $g5['title'] = $g5['title'];

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);

?>

<div id="pw_confirm" class="mbskin<?php echo ($tset['page_sub']) ? ' headsub' : ' no-headsub';?>">
	<form class="form-horizontal" role="form" name="fboardpassword" action="<?php echo $action; ?>" method="post">
	<input type="hidden" name="w" value="<?php echo $w ?>">
	<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
	<input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
	<input type="hidden" name="comment_id" value="<?php echo $comment_id ?>">
	<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
	<input type="hidden" name="stx" value="<?php echo $stx ?>">
	<input type="hidden" name="page" value="<?php echo $page ?>">
	<ul class="list-group">
		<li class="list-group-item bg-light">
			<b><?php echo $g5['title'] ?></b>
		</li>
		<li class="list-group-item">
			<?php if ($w == 'u') { ?>
				<p><strong>작성자만 글을 수정할 수 있습니다.</strong></p>
				<p>작성자 본인이라면, 글 작성시 입력한 비밀번호를 입력하여 글을 수정할 수 있습니다.</p>
			<?php } else if ($w == 'd' || $w == 'x') {  ?>
				<p><strong>작성자만 글을 삭제할 수 있습니다.</strong></p>
				<p>작성자 본인이라면, 글 작성시 입력한 비밀번호를 입력하여 글을 삭제할 수 있습니다.</p>
			<?php } else {  ?>
				<p><strong>비밀글 기능으로 보호된 글입니다.</strong></p>
				<p>작성자와 관리자만 열람하실 수 있습니다. 본인이라면 비밀번호를 입력하세요.</p>
			<?php }  ?>
		</li>
		<li class="list-group-item">		
			<div class="form-group" style="margin-bottom:0;">
				<label class="col-sm-3 control-label" for="wr_password">비밀번호<strong class="sound_only">필수</strong></label>
				<div class="col-sm-9">
					<input type="password" name="wr_password" id="password_wr_password" required class="form-control required">
				</div>
			</div>
		</li>
	</ul>
	<div class="row row-20">
		<div class="col-xs-6 col-20">
			<a href="<?php echo G5_URL ?>" class="btn btn-white btn-block">
				취소
			</a>
		</div>
		<div class="col-xs-6 col-20">
			<button type="submit" id="btn_sumbit" class="btn btn-<?php echo NT_COLOR ?> btn-block">
				확인
			</button>
		</div>
	</div>
	</form>
</div>

<?php
// 헤더, 테일 사용설정
if(!$tset['page_sub'])
	include_once(G5_THEME_PATH.'/tail.php');
?>
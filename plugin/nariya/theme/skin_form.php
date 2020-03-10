<?php
include_once('./_common.php');

if ($is_admin == 'super' || IS_DEMO) {
	;
} else {
    alert_close('접근권한이 없습니다.');
}

$skin = na_fid($skin);

$is_board_skin = false;
if($skin == 'board' && $board['bo_table']) { //게시판
	$is_board_skin = true;
	$skin_path = $board_skin_path;
	$skin_url = $board_skin_url;
	$title = $board['bo_subject'].' 스킨설정';
} else if($skin == 'connect') { //현재접속자
	$skin_path = $connect_skin_path;
	$skin_url = $connect_skin_url;
	$title = '현재접속자 스킨설정';
} else if($skin == 'faq') { //faq
	$skin_path = $faq_skin_path;
	$skin_url = $faq_skin_url;
	$title = 'FAQ 스킨설정';
} else if($skin == 'member') { //회원스킨
	$skin_path = $member_skin_path;
	$skin_url = $member_skin_url;
	$title = '회원스킨 스킨설정';
} else if($skin == 'new') { //새글
	$skin_path = $new_skin_path;
	$skin_url = $new_skin_url;
	$title = '새글모음 스킨설정';
} else if($skin == 'search') { //게시물검색
	$skin_path = $search_skin_path;
	$skin_url = $search_skin_url;
	$title = '게시물검색 스킨설정';
} else if($skin == 'qa') { //1:1문의
	$qaconfig = get_qa_config();
	$skin_path = get_skin_path('qa', (G5_IS_MOBILE ? $qaconfig['qa_mobile_skin'] : $qaconfig['qa_skin']));
	$skin_url = get_skin_url('qa', (G5_IS_MOBILE ? $qaconfig['qa_mobile_skin'] : $qaconfig['qa_skin']));
	$title = '1:1문의 스킨설정';
} else if($skin == 'shingo') { //신고모음
	$skin_path = NA_PLUGIN_PATH.'/skin/shingo/'.$nariya['shingo_skin'];
	$skin_url = NA_PLUGIN_URL.'/skin/shingo/'.$nariya['shingo_skin'];
	$title = '신고모음 스킨설정';
} else if($skin == 'tag') { //태그모음
	$skin_path = NA_PLUGIN_PATH.'/skin/tag/'.$nariya['tag_skin'];
	$skin_url = NA_PLUGIN_URL.'/skin/tag/'.$nariya['tag_skin'];
	$title = '태그모음 스킨설정';
} else {
   alert_close('값이 제대로 넘어오지 않았습니다.');
}

if(!is_file($skin_path.'/setup.skin.php'))
    alert_close('스킨설정이 없는 스킨입니다.');

// 클립모달
$is_clip_modal = false;

include_once(NA_PLUGIN_PATH.'/lib/option.lib.php');

// 설정값
$type = (G5_IS_MOBILE) ? 'mo' : 'pc';
if($is_board_skin) {
	$boset = na_file_var_load(G5_THEME_PATH.'/storage/board/board-'.$bo_table.'-'.$type.'.php');
} else {
	$wset = na_file_var_load(G5_THEME_PATH.'/storage/skin/skin-'.$skin.'-'.$type.'.php');
}

$g5['title'] = $title;
include_once(G5_THEME_PATH.'/head.sub.php');

?>

<link rel="stylesheet" href="<?php echo NA_PLUGIN_URL ?>/css/setup.css">

<form id="fsetup" name="fsetup" class="form-horizontal na-fadein f-small" action="./skin_update.php" method="post" onsubmit="return fsetup_submit(this);">
<input type="hidden" name="skin" value="<?php echo urlencode($skin) ?>">
<input type="hidden" name="bo_table" value="<?php echo urlencode($bo_table) ?>">
<input type="hidden" name="both" value="">
<input type="hidden" name="freset" value="">
<div class="fsetup-head bg-na-navy en">
	<button type="button" class="close white close-setup"><span aria-hidden="true" class="white">&times;</span></button>
	<i class="fa fa-cog fa-spin"></i>
	<b><?php echo $g5['title'] ?></b>
</div>
<?php 
	@include_once($skin_path.'/setup.skin.php');

	if($skin == 'board') {
		@include_once(NA_PLUGIN_PATH.'/theme/skin_board.php');
	}
?>

<div id="fsetup_btn">
	<div class="btn-group btn-group-justified" role="group">
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-dark close-setup">닫기</button>
		</div>
		<div class="btn-group" role="group">
			<button type="submit" class="btn btn-na-navy" onclick="document.pressed='reset'">초기화</button>
		</div>
		<?php if($skin == 'board') { ?>
			<div class="btn-group" role="group">
				<a role="button" href="<?php echo NA_PLUGIN_URL ?>/theme/skin_copy.php?bo_table=<?php echo $bo_table ?>" class="btn btn-na-blue win_point">설정복사</a>
			</div>	
		<?php } ?>
		<div class="btn-group" role="group">
			<button type="submit" class="btn btn-na-red" onclick="document.pressed='save'">저장하기</button>
		</div>
	</div>
</div>

</form>

<script>
	function fsetup_submit(f) {

		if(document.pressed == "save") {
			<?php if((isset($nariya['mobile_skin']) && $nariya['mobile_skin']) || $skin == 'qa')  { ?>
			if (confirm("PC/모바일 동일 설정값을 적용하시겠습니까?\n\n취소시 현재 모드의 설정값만 저장됩니다.")) {
				f.both.value = 1;
			}
			<?php } else { ?>
			f.both.value = 1;
			<?php } ?>
		}
		if(document.pressed == "reset") {
			if (confirm("정말 초기화 하시겠습니까?\n\nPC/모바일 설정 모두 초기화 되며, 이전 설정값으로 복구할 수 없습니다.")) {
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
<?php
include_once('./_common.php');

if ($is_admin == 'super' || IS_DEMO) {
	;
} else {
    alert('접근권한이 없습니다.');
}

$g5['title'] = '사이트 설정';
include_once('../head.sub.php');

// 페이지 설정
$tset['page_title'] = '<i class="fa fa-desktop"></i> 사이트 설정';
$tset['page_desc'] = '사이트 기본 레이아웃 및 스타일을 설정합니다.';
$tset['page'] = 12;

include_once('../head.php');

// PC 설정값
$pc = na_file_var_load(G5_THEME_PATH.'/storage/theme-bbs-pc.php');

// 모바일 설정값
$mo = na_file_var_load(G5_THEME_PATH.'/storage/theme-bbs-mo.php');

$mode = 'site';
$action_url = './site_update.php';
?>
<form id="fsetup" name="fsetup" method="post" action="<?php echo $action_url ?>" class="form-horizontal na-fadin f-small">
<?php include_once(NA_THEME_ADMIN_PATH.'/form/form.php'); ?>
</form>
<?php
include_once('../tail.php');
?>
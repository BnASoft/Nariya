<?php
include_once('./_common.php');

if ($is_admin == 'super' || IS_DEMO) {
	;
} else {
    alert('접근권한이 없습니다.');
}

if( function_exists('social_check_login_before') ){
    $social_login_html = social_check_login_before();
}

// 데모설정
$dset['layout'] = '';
$dset['background'] = '';
$dset['page'] = 12;
$dset['bg'] = '';
$dset['page_sub'] = '';

switch($demo) {
	case '10' : 
		$dset['background'] = na_url('./DEMO/1.jpg');
		$dset['bg'] = 'bottom';
		$dset['page_sub'] = 1;
		break;

	case '11' : 
		break;
}

$g5['title'] = '헤더/테일 데모';
include_once('../head.php');

$url = '';
$login_url = '#';
$login_action_url = '';

// 로그인 스킨이 없는 경우 관리자 페이지 접속이 안되는 것을 막기 위하여 기본 스킨으로 대체
$login_file = $member_skin_path.'/login.skin.php';
if (!file_exists($login_file))
    $member_skin_path   = G5_SKIN_PATH.'/member/basic';

include_once($member_skin_path.'/login.skin.php');

run_event('member_login_tail', $login_url, $login_action_url, $member_skin_path, $url);

include_once('../tail.php');
?>
<?php
include_once('./_common.php');

if ($is_admin == 'super' || IS_DEMO) {
	;
} else {
    alert('접근권한이 없습니다.');
}

// 데모설정
$dset['index'] = 'basic';
$dset['layout'] = '';
$dset['background'] = '';
$dset['page'] = 13;
$dset['bg'] = '';
$dset['title'] = 'none';

switch($demo) {
	case '10' : 
		$dset['layout'] = 'boxed';
		break;

	case '11' : 
		$dset['index'] = 'basic-title-wide';
		$dset['layout'] = 'boxed';
		$dset['background'] = na_url('./DEMO/1.jpg');
		$dset['bg'] = 'center';
		break;

	case '12' : 
		$dset['index'] = 'basic-title-boxed';
		$dset['layout'] = 'wide';
		break;
}

$g5['title'] = '레이아웃 데모';

// Page Loader 때문에 먼저 실행함
include_once(G5_THEME_PATH.'/head.sub.php');

$is_wing = false;

include_once(G5_THEME_PATH.'/demo/_loader.php');
include_once('../head.php');

// 파일경로 체크
$is_index = true;
$nt_index_path = G5_THEME_PATH.'/index'; 
$nt_index_url = G5_THEME_URL.'/index';

include_once($nt_index_path.'/'.$tset['index'].'.php');
include_once('../tail.php');
?>
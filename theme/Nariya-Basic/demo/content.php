<?php
include_once('./_common.php');

if ($is_admin == 'super' || IS_DEMO) {
	;
} else {
    alert('접근권한이 없습니다.');
}

// 데모설정
$dset['layout'] = '';
$dset['background'] = '';
$dset['bg'] = '';
$dset['sticky'] = 1;
$dset['left_side'] = '';
$dset['page'] = '';
switch($demo) {
	case '10' : 
		$dset['page'] = 9; 
		$dset['left_side'] = 1; 
		break;

	case '11' : 
		$dset['page'] = 9; 
		break;

	case '12' : 
		$dset['page'] = 12; 
		break;

	case '13' : 
		$dset['page'] = 13; 
		break;

	case '20' : 
		$dset['page'] = 7; 
		break;

	case '21' : 
		$dset['page'] = 8; 
		break;

	case '22' : 
		$dset['page'] = 9; 
		break;
}

$g5['title'] = '이용안내';
include_once('../head.php');

include_once(G5_THEME_PATH.'/page/guide.php');

include_once('../tail.php');
?>
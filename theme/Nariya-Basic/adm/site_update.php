<?php
include_once('./_common.php');

check_demo();

if ($is_admin != 'super')
    alert('접근권한이 없습니다.');

// 공통설정
$co = (isset($_POST['co']) && is_array($_POST['co'])) ? $_POST['co'] : array();

// PC 설정
$pc = (isset($_POST['pc']) && is_array($_POST['pc'])) ? $_POST['pc'] : array();
na_file_var_save(G5_THEME_PATH.'/storage/theme-bbs-pc.php', array_merge($co, $pc), 1); //폴더 퍼미션 체크

// 모바일 설정
$mo = (isset($_POST['mo']) && is_array($_POST['mo'])) ? $_POST['mo'] : array();
na_file_var_save(G5_THEME_PATH.'/storage/theme-bbs-mo.php', array_merge($co, $mo));

goto_url('./site_setup.php');

?>
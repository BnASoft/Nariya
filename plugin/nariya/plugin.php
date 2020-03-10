<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 캐시 테이블
$g5['na_cache'] = G5_TABLE_PREFIX.'na_cache';

// YC
if(!defined('IS_YC')) {
	(defined('G5_USE_SHOP') && G5_USE_SHOP) ? define('IS_YC', true) : define('IS_YC', false);
}

// DEMO
if(!defined('IS_DEMO')) {
	(is_dir(G5_PATH.'/DEMO')) ? define('IS_DEMO', true) : define('IS_DEMO', false);
}

// Plugin
define('NA_DIR', 'nariya');
define('NA_PLUGIN_URL', G5_PLUGIN_URL.'/'.NA_DIR);
define('NA_PLUGIN_PATH', G5_PLUGIN_PATH.'/'.NA_DIR);

// Theme Admin
define('NA_THEME_ADMIN_URL', G5_THEME_URL.'/adm');
define('NA_THEME_ADMIN_PATH', G5_THEME_PATH.'/adm');

// 쿼리 확장 변수
$na_sql_where = '';
$na_sql_orderby = '';

// 클립용
$is_clip_modal = true;

// 기본 함수
include_once(NA_PLUGIN_PATH.'/lib/common.lib.php');

// 기본 설정
$nariya = array();
$nariya = na_config('nariya');

// 게시판 플러그인
define('IS_NA_BBS', $nariya['bbs']);
if(IS_NA_BBS) {
	$g5['na_tag_log'] = G5_TABLE_PREFIX.'na_tag_log';
	$g5['na_tag'] = G5_TABLE_PREFIX.'na_tag';
	$g5['na_shingo'] = G5_TABLE_PREFIX.'na_shingo';
}

// 멤버쉽 플러그인
define('IS_NA_XP', $nariya['xp']);
if(IS_NA_XP) {
	$g5['na_xp'] = G5_TABLE_PREFIX.'na_xp';
}

if($is_member)
	na_admin();

// 관리자페이지에서는 사용 안함
if(defined('G5_IS_ADMIN') && !defined('_THEME_PREVIEW_')){
	// 관리자 페이지용
	include_once(NA_PLUGIN_PATH.'/admin_hooks.php');
	return;
}

// 컨텐츠 함수
include_once(NA_PLUGIN_PATH.'/lib/content.lib.php');

// 테마 함수
include_once(NA_PLUGIN_PATH.'/lib/theme.lib.php');

// 게시판 스킨설정
$boset = array();
if(isset($board['bo_table']) && $board['bo_table']) {
	$boset = na_skin_config('board', $bo_table);
	if($is_member && !$is_admin && isset($boset['bo_admin']) && $boset['bo_admin'])
		na_admin($boset['bo_admin'], 1);
}

// 공통 후크
include_once(NA_PLUGIN_PATH.'/hooks.php');

// 게시판 개별 후크
if(isset($board['bo_table']) && $board['bo_table'])
	@include_once($board_skin_path.'/hooks.php');

?>
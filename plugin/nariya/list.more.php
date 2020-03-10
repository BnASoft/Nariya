<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 적합성 체크
if(!na_check_id($wname) || !na_check_id($wid))
	exit;

if($wdir) {
	$wdir = na_check_id(str_replace(G5_PATH, '', $wdir));
	$widget_path = $wdir.'/'.$wname;
	$widget_url = str_replace(G5_PATH, G5_URL, $wdir).'/'.$wname;
} else if($addon) {
	$widget_url = NA_PLUGIN_URL.'/skin/addon/'.$wname;
	$widget_path = NA_PLUGIN_PATH.'/skin/addon/'.$wname;
} else {
	$widget_url = G5_THEME_URL.'/widget/'.$wname;
	$widget_path = G5_THEME_PATH.'/widget/'.$wname;
}

if(!is_file($widget_path.'/widget.php')) 
	exit;

$wchk = ($addon) ? 'addon' : 'widget'; 
$wfile = (G5_IS_MOBILE) ? 'mo' : 'pc'; 
$widget_file = G5_THEME_PATH.'/storage/'.$wchk.'/'.$wchk.'-'.$wname.'-'.$wid.'-'.$wfile.'.php';
$cache_file = G5_THEME_PATH.'/storage/cache/'.$wchk.'-'.$wname.'-'.$wid.'-'.$wfile.'-cache.php';

$wset = array();

$is_opt = true;
if($wid && is_file($widget_file)) {
	$wset = na_file_var_load($widget_file);
	$is_opt = false;
}
	
if($is_opt && $opt) {
	$wset = na_query($opt);
	if(G5_IS_MOBILE && !empty($wset) && $mopt) {
		$wset = array_merge($wset, na_query($mopt));
	}
	// 옵션지정시 추가쿼리구문 작동안됨
	unset($wset['where']);
	unset($wset['orderby']);
}

// 초기값
$page = (int)$page;
$wset['page'] = ($page > 0) ? $page : '';
$wset['bo_new'] = ($wset['bo_new'] == "") ? 24 : $wset['bo_new'];

?>
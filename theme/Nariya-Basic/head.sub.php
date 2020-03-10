<?php
// 이 파일은 새로운 파일 생성시 반드시 포함되어야 함
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$g5_debug['php']['begin_time'] = $begin_time = get_microtime();

//------------------------------------------------------------------------------------
// 필수 : 게시판 플러그인
if(IS_NA_BBS && isset($g5['board_title']) && $g5['board_title'])
	@include_once($board_skin_path.'/_extend.php');
//------------------------------------------------------------------------------------

// 배열 선언
$pset = array();
$tset = array();
$tlayout = array();

// 페이지 세팅용
$phref = ($is_admin == 'super') ? $phref : ''; //관리자는 임의지정 가능
$pset = na_pid($phref);

// 페이지 아이디 부여
$page_id = $pset['pid'];

// 커뮤니티 테마 설정
$tset = na_theme('bbs', $page_id);

// 홈경로
define('NT_HOME_URL', G5_URL);

// 필수 : 기본컬러
define('NT_COLOR', 'navy');

// 반응형 설정
if(!G5_IS_MOBILE && $tset['no_res']) {
	define('_RESPONSIVE_', false);
	$bs3_css = 'bootstrap-no.min.css';
	$body_class = 'no-responsive is-pc';
} else {
	define('_RESPONSIVE_', true);
	$bs3_css = 'bootstrap.min.css';
	$body_class = (G5_IS_MOBILE) ? 'responsive is-mobile' : 'responsive is-pc';
}

// 배경옵션
$is_body_bg = false;
if($tset['layout'] && $tset['bg']) {
	$is_body_bg = true;
	$body_class .= ' bg-'.$tset['bg'];
}

if($tset['style']) {
	$body_class .= ' is-square';
}

// 기본 CSS
$default_stylesheet = '<link rel="stylesheet" href="'.NA_PLUGIN_URL.'/css/plugin.css" type="text/css">'.PHP_EOL;
$default_stylesheet .= '<link rel="stylesheet" href="'.G5_THEME_URL.'/css/theme.css" type="text/css">';
add_stylesheet($default_stylesheet, -100);
unset($default_stylesheet);

//------------------------------------------------------------------------------------

if (!isset($g5['title'])) {
    $g5['title'] = $config['cf_title'];
    $g5_head_title = $g5['title'];
}
else {
    $g5_head_title = $g5['title']; // 상태바에 표시될 제목
    $g5_head_title .= " | ".$config['cf_title'];
}

$g5['title'] = strip_tags($g5['title']);
$g5_head_title = strip_tags($g5_head_title);

// 현재 접속자
// 게시판 제목에 ' 포함되면 오류 발생
$g5['lo_location'] = addslashes($g5['title']);
if (!$g5['lo_location'])
    $g5['lo_location'] = addslashes(clean_xss_tags($_SERVER['REQUEST_URI']));
$g5['lo_url'] = addslashes(clean_xss_tags($_SERVER['REQUEST_URI']));
if (strstr($g5['lo_url'], '/'.G5_ADMIN_DIR.'/') || $is_admin == 'super') $g5['lo_url'] = '';

/*
// 만료된 페이지로 사용하시는 경우
header("Cache-Control: no-cache"); // HTTP/1.1
header("Expires: 0"); // rfc2616 - Section 14.21
header("Pragma: no-cache"); // HTTP/1.0
*/
?>
<!doctype html>
<html lang="ko">
<head>
<meta charset="utf-8">
<?php
if (G5_IS_MOBILE) {
    echo '<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=0,maximum-scale=10,user-scalable=yes">'.PHP_EOL;
    echo '<meta name="HandheldFriendly" content="true">'.PHP_EOL;
    echo '<meta name="format-detection" content="telephone=no">'.PHP_EOL;
} else {
    echo '<meta http-equiv="imagetoolbar" content="no">'.PHP_EOL;
    echo '<meta http-equiv="X-UA-Compatible" content="IE=edge">'.PHP_EOL;
}

if($config['cf_add_meta'])
    echo $config['cf_add_meta'].PHP_EOL;
?>
<title><?php echo $g5_head_title; ?></title>
<link rel="stylesheet" href="<?php echo NA_PLUGIN_URL ?>/app/bs3/css/<?php echo $bs3_css ?>" type="text/css">
<link rel="stylesheet" href="<?php echo G5_JS_URL ?>/font-awesome/css/font-awesome.min.css" type="text/css">
<!--[if lte IE 8]>
<script src="<?php echo G5_JS_URL ?>/html5.js"></script>
<![endif]-->
<!--[if lt IE 9]>
<script src="<?php echo NA_PLUGIN_URL ?>/js/respond.js"></script>
<![endif]-->
<script>
// 자바스크립트에서 사용하는 전역변수 선언
var g5_url       = "<?php echo G5_URL ?>";
var g5_bbs_url   = "<?php echo G5_BBS_URL ?>";
var g5_is_member = "<?php echo isset($is_member)?$is_member:''; ?>";
var g5_is_admin  = "<?php echo isset($is_admin)?$is_admin:''; ?>";
var g5_is_mobile = "<?php echo G5_IS_MOBILE ?>";
var g5_bo_table  = "<?php echo isset($bo_table)?$bo_table:''; ?>";
var g5_sca       = "<?php echo isset($sca)?$sca:''; ?>";
var g5_editor    = "<?php echo ($config['cf_editor'] && $board['bo_use_dhtml_editor'])?$config['cf_editor']:''; ?>";
var g5_plugin_url = "<?php echo G5_PLUGIN_URL ?>";
var g5_cookie_domain = "<?php echo G5_COOKIE_DOMAIN ?>";
</script>
<script src="<?php echo G5_JS_URL ?>/jquery-1.12.4.min.js"></script>
<script src="<?php echo G5_JS_URL ?>/jquery-migrate-1.4.1.min.js"></script>
<script src="<?php echo NA_PLUGIN_URL ?>/js/common.js?ver=<?php echo G5_JS_VER; ?>"></script>
<script src="<?php echo G5_JS_URL ?>/wrest.js?ver=<?php echo G5_JS_VER; ?>"></script>
<script src="<?php echo G5_JS_URL ?>/placeholders.min.js"></script>
<script src="<?php echo NA_PLUGIN_URL ?>/app/bs3/js/bootstrap.min.js"></script>
<script src="<?php echo NA_PLUGIN_URL ?>/js/plugin.js?ver=<?php echo G5_JS_VER; ?>"></script>
<script src="<?php echo G5_THEME_URL;?>/js/theme.js"></script>
<?php
if(G5_IS_MOBILE)
    add_javascript('<script src="'.G5_JS_URL.'/modernizr.custom.70111.js"></script>', 1); // overflow scroll 감지

if(!defined('G5_IS_ADMIN'))
    echo $config['cf_add_script'];
?>
</head>
<body<?php echo (isset($g5['body_script']) && $g5['body_script']) ? $g5['body_script'].' ' : ''; ?> class="<?php echo $body_class ?>">

<?php
if ($is_member) { // 회원이라면 로그인 중이라는 메세지를 출력해준다.
    $sr_admin_msg = '';
    if ($is_admin == 'super') $sr_admin_msg = "최고관리자 ";
    else if ($is_admin == 'group') $sr_admin_msg = "그룹관리자 ";
    else if ($is_admin == 'board') $sr_admin_msg = "게시판관리자 ";

    echo '<div class="sr-only"><div id="hd_login_msg">'.$sr_admin_msg.get_text($member['mb_nick']).'님 로그인 중 ';
    echo '<a href="'.G5_BBS_URL.'/logout.php">로그아웃</a></div></div>';
}

$is_index = false;
?>
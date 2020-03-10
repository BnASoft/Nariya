<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

function na_pack($set) {

	if(!is_array($set) || empty($set)) 
		return;

	$arr = addslashes(serialize($set));

	return $arr;
}

function na_unpack($set) {

	$arr = array();

	if(!$set) return $arr;

	$tmp = unserialize($set);
	if(!empty($tmp)) {
		foreach($tmp as $key=>$value) {
			$arr[$key] = str_replace("/r/n/","\r\n", stripslashes(str_replace("\\r\\n","/r/n/",$tmp[$key])));
		}
	}

	return $arr;
}

function na_repack($arr) {

	$rep = array();

	if(!is_array($arr)) return $rep;

	foreach($arr as $key=>$value) {
		if($arr[$key] == '')
			continue;

		$rep[$key] = $arr[$key];
	}

	return $rep;
}

function na_query($str) {

	$arr = array();

    if (function_exists('array_combine')) {
		$str = stripcslashes($str);

		preg_match_all('@(?P<attribute>[^\s\'\"]+)\s*=\s*(\'|\")?(?P<value>[^\s\'\"]+)(\'|\")?@i', $str, $match);

		$arr = @array_change_key_case(array_combine($match['attribute'], $match['value']));
	}

	return $arr;
}

// Sort Array
function na_sort($arr, $field, $rev=false) {

	if(!is_array($arr) || !count($arr)) return;

	foreach($arr as $res)
		$sort[] = $res[$field];

	($rev) ? array_multisort($sort, SORT_DESC, $arr) : array_multisort($sort, SORT_ASC, $arr);

	return $arr;
}

// Check ID
function na_check_id($id) {
    if (preg_match("/[^-A-Za-z0-9_]+/i", $id))
        return false;
    else
        return true;
}

// Random ID
function na_rid($h=''){

	$s = range('a','f');
	shuffle($s);

	$e = range('u','z');
	shuffle($e);

	$c = range($s[0], $e[0]);
	shuffle($c);

	$id = $h.implode('', $c);

	return $id;
}

// File ID 체크
function na_fid($file) {

    $file = preg_replace('/[^-A-Za-z0-9_]/i', '', trim($file));
    $file = substr($file, 0, 100);

	return $file;
}

// 링크 치환
function na_link($link, $shop='') {

	if($shop) {
		$link = str_replace(G5_SHOP_URL, NA_PLUGIN_URL.'/shop', $link);
	} else {
		$link = str_replace(G5_BBS_URL, NA_PLUGIN_URL, $link);
	}

	return $link;
}

// URL 치환
function na_url($url, $rev='') {

	if($rev) {
		$url = str_replace(G5_THEME_URL.'/', "../", $url);
		$url = str_replace(G5_URL.'/', "./", $url);
	} else {
		$url = str_replace("../", G5_THEME_URL.'/', $url);
		$url = str_replace("./", G5_URL.'/', $url);
	}

	return $url;
}

// & 치환
function na_url_amp($url, $rev='') {

	$url = ($rev) ? str_replace("&", "&amp;", $url) : str_replace("&amp;", "&", $url);

	return $url;
}

// URL Parameter 재구성
function na_url_qstr($query, $qstr, $fields) {

	foreach($query as $key=>$value) {
		if ($key && !in_array($key, $fields)) {
			$qstr .= "&$key=$value";
		}
	}

	return $qstr;
}

// 스킨경로를 얻는다
function na_dir_list($path, $len='') {

    $arr = array();

	$path = na_file_path_check($path);

	if(!is_dir($path)) return;

	$handle = opendir($path);
    while ($file = readdir($handle)) {
        if($file == "."||$file == "..") continue;

        if(is_dir($path.'/'.$file)) 
			$arr[] = $file;
    }
    closedir($handle);
    sort($arr);

    return $arr;
}

// 폴더내 파일을 얻는다
function na_file_list($path, $ext='') {

	$arr = array();
	$path = na_file_path_check($path);

	if(!is_dir($path)) return;

	$handle = opendir($path);
	while ($file = readdir($handle)) {

		if($file == "."||$file == "..")
			continue;

		if($ext) {
			$tmp = strtolower(substr(strrchr($file, "."), 1)); 
			if($tmp == $ext) {
				$arr[] = substr($file, 0, strrpos($file, "."));
			}
		} else {
			$arr[] = $file;
		}
	}
	closedir($handle);
	sort($arr);

	return $arr;
}

// 테마 내 저장소 파일 삭제
function na_file_delete($file, $opt='') {

	if($opt == 'nariya') {
		if($file && is_file($file)) {
			@chmod($file, G5_FILE_PERMISSION);
			@unlink($file);
		}
	} else {
		// 폴더 생성 및 권한 체크
		if($opt) {
			// 테마 폴더 권한 체크
			if(!is_writable(G5_THEME_PATH)) {
				@chmod(G5_THEME_PATH, G5_DIR_PERMISSION);
				if(!is_writable(G5_THEME_PATH)) {
					$msg = '/'.G5_THEME_DIR.' 디렉토리의 퍼미션을 755 또는 777 또는 707로 변경 후 다시 시도해 주세요.';
					alert($msg);
				}
			}

			// 폴더 생성 및 권한 체크
			$dir = array('', '/addon', '/board', '/cache', '/image', '/page', '/skin', '/widget');

			for($i=0; $i < count($dir); $i++) {

				$path = G5_THEME_PATH.'/storage'.$dir[$i];

				if(!is_dir($path)) {
					@mkdir($path, G5_DIR_PERMISSION);
					@chmod($path, G5_DIR_PERMISSION);
				}

				if(!is_writable($path)) {
					@chmod($path, G5_DIR_PERMISSION);
				}
			}
		}

		// 파일 삭제
		if($file && is_file($file)) {
			@chmod($file, G5_FILE_PERMISSION);
			@unlink($file);
		}
	}
}

// 파일에 저장된 변수 불러오기
function na_file_var_load($file) {

	$data = array();
	if($file && file_exists($file))
		@include($file);

	return array_map_deep('stripslashes', $data);
}

// 파일에 변수 저장하기
function na_file_var_save($file, $data, $opt='') {

	if(!$file) 
		return;

	na_file_delete($file, $opt);

	$handle = fopen($file, 'w');
	$content = "<?php\nif (!defined('_GNUBOARD_')) exit;\n\$data=".var_export($data, true).";\n?>";
	fwrite($handle, $content);
	fclose($handle);
}

// Skin Path
function na_skin_path($dir, $skin) {
    global $config;

    if(preg_match('#^theme/(.+)$#', $skin, $match)) { // 테마에 포함된 스킨이라면
        $theme_path = '';
        $cf_theme = trim($config['cf_theme']);

        $theme_path = G5_PATH.'/'.G5_THEME_DIR.'/'.$cf_theme;
        $skin_path = $theme_path.'/'.G5_SKIN_DIR.'/'.$dir.'/'.$match[1];
    } else {
        $skin_path = G5_SKIN_PATH.'/'.$dir.'/'.$skin;
    }

    return $skin_path;
}

// Skin url
function na_skin_url($dir, $skin) {
    $skin_path = na_skin_path($dir, $skin);

    return str_replace(G5_PATH, G5_URL, $skin_path);
}

// Config Load
function na_config($file) {

	$wset = array();
	$wset = na_file_var_load(G5_DATA_PATH.'/nariya/'.$file.'.php');

	return $wset;
}

// Skin Config Load
function na_skin_config($skin, $opt='') {

	$wset = array();
	if($skin) {
		$type = (G5_IS_MOBILE) ? 'mo' : 'pc';
		$file = ($opt) ? 'board/board-'.$opt : 'skin/skin-'.$skin;
		$wset = na_file_var_load(G5_THEME_PATH.'/storage/'.$file.'-'.$type.'.php');
	}

	return $wset;
}

// Admin
function na_admin($val='', $opt='') {
	global $is_admin, $member, $nariya;

	if(!$member['mb_id'])
		return;

	// 게시판 관리자
	if($opt) {
		if($val && in_array($member['mb_id'], array_map('trim', explode(",", $val))))
			$is_admin = 'board';
	} else {
		if($nariya['cf_admin'] && in_array($member['mb_id'], array_map('trim', explode(",", $nariya['cf_admin'])))) {
			$is_admin = 'super'; // 통합 최고관리자
		} else if($nariya['cf_group'] && in_array($member['mb_id'], array_map('trim', explode(",", $nariya['cf_group'])))) {
			$is_admin = 'group'; // 통합 그룹관리자
		}
	}
}

// Plugin Scripts
function na_script($id){

	if($id == 'clip') {
		include_once (NA_PLUGIN_PATH.'/theme/clip.php');
	} else if($id == 'autosave') {
		include_once (NA_PLUGIN_PATH.'/theme/autosave.php');
	} else if($id == 'sly') {
		if(!defined('NA_SLY')) {
			define('NA_SLY', true);
			add_javascript('<script src="'.NA_PLUGIN_URL.'/js/sly.min.js"></script>', 0);
		}
	} else if($id == 'owl') {
		if(!defined('NA_OWL')) {
			define('NA_OWL', true);
			add_stylesheet('<link rel="stylesheet" href="'.NA_PLUGIN_URL.'/app/owlcarousel/assets/owl.carousel.css">', -1);
			add_javascript('<script src="'.NA_PLUGIN_URL.'/app/owlcarousel/owl.carousel.min.js"></script>', 0);
		}
	} else if($id == 'bxslider') {
		if(!defined('NA_BXSLIDER')) {
			define('NA_BXSLIDER', true);
			add_stylesheet('<link rel="stylesheet" href="'.NA_PLUGIN_URL.'/app/bxSlider/jquery.bxslider.css">', -1);
			add_javascript('<script src="'.NA_PLUGIN_URL.'/app/bxSlider/jquery.bxslider.min.js"></script>', 0);
		}
	} else if($id == 'imagesloaded') {
		if(!defined('NA_IMGLOAD')) {
			define('NA_IMGLOAD', true);
			add_javascript('<script src="'.NA_PLUGIN_URL.'/js/imagesloaded.pkgd.min.js"></script>', 0);
		}
	} else if($id == 'masonry') {
		if(!defined('NA_MASONRY')) {
			define('NA_MASONRY', true);
			add_javascript('<script src="'.NA_PLUGIN_URL.'/js/masonry.pkgd.min.js"></script>', 0);
		}
	} else if($id == 'infinite') {
		if(!defined('NA_INFISCROLL')) {
			define('NA_INFISCROLL', true);
			add_javascript('<script src="'.NA_PLUGIN_URL.'/js/jquery.infinitescroll.min.js"></script>', 0);
		}
	} else if($id == 'code') {
		if(!defined('NA_CODE')) {
			define('NA_CODE', true);
			add_stylesheet('<link rel="stylesheet" href="'.NA_PLUGIN_URL.'/app/syntaxhighlighter/styles/shCoreDefault.css">', -1);
			$sh = '<script src="'.NA_PLUGIN_URL.'/app/syntaxhighlighter/scripts/shCore.js"></script>'.PHP_EOL;
			$sh .= '<script src="'.NA_PLUGIN_URL.'/app/syntaxhighlighter/scripts/shBrushJScript.js"></script>'.PHP_EOL;
			$sh .= '<script src="'.NA_PLUGIN_URL.'/app/syntaxhighlighter/scripts/shBrushPhp.js"></script>'.PHP_EOL;
			$sh .= '<script src="'.NA_PLUGIN_URL.'/app/syntaxhighlighter/scripts/shBrushCss.js"></script>'.PHP_EOL;
			$sh .= '<script src="'.NA_PLUGIN_URL.'/app/syntaxhighlighter/scripts/shBrushXml.js"></script>'.PHP_EOL;
			$sh .= '<script>var is_SyntaxHighlighter = true; SyntaxHighlighter.all(); </script>';
			add_javascript($sh, 99);
		}
	} else if($id == 'bgvideo') {
		if(!defined('NA_BGVIDEO')) {
			define('NA_BGVIDEO', true);
			add_stylesheet('<link rel="stylesheet" href="'.NA_PLUGIN_URL.'/app/YTPlayer/css/jquery.mb.YTPlayer.min.css">',0);
			add_javascript('<script src="'.NA_PLUGIN_URL.'/app/YTPlayer/jquery.mb.YTPlayer.min.js"></script>', 0);
			add_javascript('<script src="'.NA_PLUGIN_URL.'/app/YTPlayer/apikey.js"></script>', 0);
		}
	} else if($id == 'datepicker') {
		if(!defined('NA_DPICKER')) {
			define('NA_DPICKER', true);
			add_stylesheet('<link rel="stylesheet" href="'.NA_PLUGIN_URL.'/app/datepicker/css/bootstrap-datetimepicker.min.css">', -1);
			$datepicker = '<script src="'.NA_PLUGIN_URL.'/app/datepicker/js/moment-with-locales.min.js"></script>'.PHP_EOL;
			$datepicker .= '<script src="'.NA_PLUGIN_URL.'/app/datepicker/js/bootstrap-datetimepicker.js"></script>';
			add_javascript($datepicker, 0);
		}
	} else if($id == 'lightbox') {
		if(!defined('NA_LBOX')) {
			define('NA_LBOX', true);
			add_stylesheet('<link rel="stylesheet" href="'.NA_PLUGIN_URL.'/app/lightbox2/css/lightbox.css">', -1);
			add_javascript('<script src="'.NA_PLUGIN_URL.'/app/lightbox2/js/lightbox.min.js"></script>', 0);
		}
	} else if($id == 'timeline') {
		if(!defined('NA_TLINE')) {
			define('NA_TLINE', true);
			add_stylesheet('<link rel="stylesheet" href="'.NA_PLUGIN_URL.'/app/timeline/timeline.css">', -1);
			add_javascript('<script src="'.NA_PLUGIN_URL.'/app/timeline/timeline.js"></script>', 0);
		}
	} else if($id == 'iconpicker') {
		if(!defined('NA_IPICKER')) {
			define('NA_IPICKER', true);
			add_stylesheet('<link rel="stylesheet" href="'.NA_PLUGIN_URL.'/app/bs-iconpicker/css/bootstrap-iconpicker.min.css">', -1);
			add_javascript('<script src="'.NA_PLUGIN_URL.'/app/bs-iconpicker/js/iconset/iconset-fontawesome-4.7.0.min.js"></script>', 0);
			add_javascript('<script src="'.NA_PLUGIN_URL.'/app/bs-iconpicker/js/bootstrap-iconpicker.js"></script>', 0);
		}
	}

	return;
}

// 파일 확장자
function na_file_info($str) {

	$file = array();

	$str = basename($str);
	$f = explode(".", $str);
	$l = sizeof($f);
	if($l > 1) {
		$file['ext'] = strtolower($f[$l-1]);
		$file['name'] = str_replace($f[$l-1], "", $str);
	} else {
		$file['ext'] = '';
		$file['name'] = $str;
	}

	return $file;	
}

// 너비구하기
function na_width($w, $d){

	// 7.692, 7.142, 6.666, 6.25, 5.882, 5.555, 5.263, 5
	$a = array(0, 100, 50, 33.333, 25, 20, 16.667, 14.286, 12.5, 11.111, 10, 9.091, 8.333);

	$w = ($w) ? $a[$w] : $a[$d];

	return ($w) ? 'width:'.$w.'%;' : '';
}

// 이미지 저장
function na_save_image($url, $path) {

	if(!$url) 
		return;

	$file = na_file_info($path);
	if (!preg_match('/(jpg|jpeg|png|gif|bmp)$/i', $file['ext'])){
		return;
	}

	$ch = curl_init ($url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_BINARYTRANSFER,1); 
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	$err = curl_error($ch);
	if(!$err) $rawdata=curl_exec($ch);
	curl_close ($ch);
	if($rawdata) {
		$ym = date('ym', G5_SERVER_TIME);
		$data_dir = G5_DATA_PATH.'/editor/'.$ym;
		$data_url = G5_DATA_URL.'/editor/'.$ym;
		if(!is_dir($data_dir)) {
			@mkdir($data_dir, G5_DIR_PERMISSION);
			@chmod($data_dir, G5_DIR_PERMISSION);
		}
		$filename = basename($path);
		$chars_array = array_merge(range(0,9), range('a','z'), range('A','Z'));
        shuffle($chars_array);
        $shuffle = implode('', $chars_array);
        $file_name = abs(ip2long($_SERVER['REMOTE_ADDR'])).'_'.substr($shuffle,0,8).'_'.replace_filename($filename);
		$save_dir = sprintf('%s/%s', $data_dir, $file_name);
        $save_url = sprintf('%s/%s', $data_url, $file_name);

		$fp = fopen($save_dir,'w'); 
		fwrite($fp, $rawdata); 
		fclose($fp); 
		
		if(is_file($save_dir)) {
			@chmod($save_dir, G5_FILE_PERMISSION);
			return $save_url;
		}
	} 
	
	return;
}

// 컨텐츠 내 이미지 체크
function na_content_image($content) {

	if(!$content) 
		return;

	$content = stripslashes($content);
	$patten = "/<img[^>]*src=[\"']?([^>\"']+)[\"']?[^>]*>/i";

	preg_match_all($patten, $content, $match);

	$n = 0;
	if ($match[1]) {
		foreach ($match[1] as $link) {
			$url = @parse_url($link);
			if ($url['host'] && $url['host'] != $_SERVER['HTTP_HOST']) {
				$image = na_save_image($link, $url['path']);
				if ($image)	{
					$content = str_replace($link, $image, $content);
					$n++;
				}
			}
		}
	}

	return array($n, $content);
}
 
// 포인트 중복 부여
function na_insert_point($mb_id, $point, $content='', $rel_table='', $rel_id='', $rel_action='', $expire=0, $repeat=0) {
    global $config;
    global $g5;
    global $is_admin;

    // 포인트 사용을 하지 않는다면 return
    if (!$config['cf_use_point']) { return 0; }

    // 포인트가 없다면 업데이트 할 필요 없음
    if ($point == 0) { return 0; }

    // 회원아이디가 없다면 업데이트 할 필요 없음
    if ($mb_id == '') { return 0; }
    $mb = sql_fetch(" select mb_id from {$g5['member_table']} where mb_id = '$mb_id' ");
    if (!$mb['mb_id']) { return 0; }

    // 회원포인트
    $mb_point = get_point_sum($mb_id);

    // 이미 등록된 내역이라면 건너뜀
    if (!$repeat && ($rel_table || $rel_id || $rel_action)) {
        $sql = " select count(*) as cnt from {$g5['point_table']}
                  where mb_id = '$mb_id'
                    and po_rel_table = '$rel_table'
                    and po_rel_id = '$rel_id'
                    and po_rel_action = '$rel_action' ";
        $row = sql_fetch($sql);
        if ($row['cnt'])
            return -1;
    }

    // 포인트 건별 생성
    $po_expire_date = '9999-12-31';
    if($config['cf_point_term'] > 0) {
        if($expire > 0)
            $po_expire_date = date('Y-m-d', strtotime('+'.($expire - 1).' days', G5_SERVER_TIME));
        else
            $po_expire_date = date('Y-m-d', strtotime('+'.($config['cf_point_term'] - 1).' days', G5_SERVER_TIME));
    }

    $po_expired = 0;
    if($point < 0) {
        $po_expired = 1;
        $po_expire_date = G5_TIME_YMD;
    }
    $po_mb_point = $mb_point + $point;

    $sql = " insert into {$g5['point_table']}
                set mb_id = '$mb_id',
                    po_datetime = '".G5_TIME_YMDHIS."',
                    po_content = '".addslashes($content)."',
                    po_point = '$point',
                    po_use_point = '0',
                    po_mb_point = '$po_mb_point',
                    po_expired = '$po_expired',
                    po_expire_date = '$po_expire_date',
                    po_rel_table = '$rel_table',
                    po_rel_id = '$rel_id',
                    po_rel_action = '$rel_action' ";
    sql_query($sql);

    // 포인트를 사용한 경우 포인트 내역에 사용금액 기록
    if($point < 0) {
        insert_use_point($mb_id, $point);
    }

    // 포인트 UPDATE
    $sql = " update {$g5['member_table']} set mb_point = '$po_mb_point' where mb_id = '$mb_id' ";
    sql_query($sql);

    return 1;
}

// 레벨 체크
function na_chk_xp($old_grade, $old_level, $old_exp, $exp) {
	global $nariya;

	$info = array();

	$xp_rate = (isset($nariya['xp_rate']) && $nariya['xp_rate']) ? $nariya['xp_rate'] : 0;
	$xp_point = (isset($nariya['xp_point']) && (int)$nariya['xp_point'] > 0) ? (int)$nariya['xp_point'] : 0;
	$max_level = (isset($nariya['xp_max']) && (int)$nariya['xp_max'] > 0) ? (int)$nariya['xp_max'] : 0;
	$exp = ($exp > 0) ? $exp : 0;

	if($exp <= $xp_point) {
		$level = 1;
		$xp_max = $xp_point;
		$xp_min = 0;
	} else if($old_level == $max_level) {
		$level = $max_level;
		$xp_min = $exp;
		$xp_max = $exp;
	} else {
		$xp_min = $xp_point;
		for ($i=2; $i <= $max_level; $i++) {
			$xp_plus = $xp_point + $xp_point * ($i - 1) * $xp_rate;
			$xp_max = $xp_min + $xp_plus;
			if($exp <= $xp_max) {
				$level = $i;
				break;
			}
			$xp_min = $xp_max;
		}
	}

	$msg = 0;
	$old_level = ($old_level > 0) ? $old_level : 1;
	if($level > $old_level) { // 레벨업
		$msg = 1;
	} else if($level < $old_level) { // 레벨다운
		$msg = 2;
	}

	// 자동등업
	$grade = $old_grade;
	if(isset($nariya['xp_auto']) && $nariya['xp_auto']) {

		list($start, $tmp) = explode(":", $nariya['xp_auto']);

		$start = (int)$start;

		if($start && $tmp) {
			$gup = array();
			$lup = array();

			$arr = explode(",", $tmp.','.$max_level);
			$arr_cnt = count($arr);
			$n = 0;
			for($i=0; $i < $arr_cnt; $i++) {

				$lvl = (int)$arr[$i];

				if(!$lvl)
					continue;

				$gup[] = $start + $n; // 등급
				$lup[] = $lvl; // 레벨
				$n++;
			}

			if(!empty($gup) && in_array($old_grade, $gup)) {
				$lup_cnt = count($lup);
				for($i=0; $i < $lup_cnt; $i++) {
					if($level <= $lup[$i]) {
						$grade = $gup[$i];
						break;
					}
				}

				if($grade > $old_grade) { // 등업
					$msg = 3;
				} else if($grade < $old_grade) { // 등급 다운
					$msg = 4;
				}
			}
		}
	}

	return array($grade, $level, $exp, $xp_max, $msg);
}

// 경험치 정리
function na_sum_xp($mb) {
    global $g5;

	$mb_id = $mb['mb_id'];

	// 경험치 내역의 합을 구하고
	$row = sql_fetch(" select sum(xp_point) as sum_exp from {$g5['na_xp']} where mb_id = '$mb_id' ");

	// 레벨변동 체크
	list($grade, $level, $exp, $max, $msg) = na_chk_xp($mb['mb_level'], $mb['as_level'], $mb['as_exp'], $row['sum_exp']);

	// 회원정보 UPDATE
	if($msg) {
		sql_query(" update {$g5['member_table']} 
			set mb_level = '{$grade}',
				as_msg = '{$msg}',
				as_exp = '{$exp}', 
				as_level = '{$level}', 
				as_max = '{$max}' where mb_id = '$mb_id' ");
	} else {
		$sql = ($mb['as_max'] == $max) ? "" : ", as_max = '{$max}'";
		sql_query(" update {$g5['member_table']} set as_exp = '{$exp}' $sql where mb_id = '$mb_id' ");
	}
}

// 경험치 부여
function na_insert_xp($mb_id, $point, $content='', $rel_table='', $rel_id='', $rel_action='', $repeat=0) {
    global $config;
    global $g5;
    global $is_admin;

    // 회원 플러그인을 사용을 하지 않는다면 return
    if (!IS_NA_XP) { return 0; }

    // 경험치가 없다면 업데이트 할 필요 없음
    if ($point == 0) { return 0; }

    // 회원아이디가 없다면 업데이트 할 필요 없음
    if ($mb_id == "") {	return 0; }

    $mb = sql_fetch(" select mb_id, mb_level, as_level, as_exp from {$g5['member_table']} where mb_id = '$mb_id' ");
    if (!$mb['mb_id']) { return 0; }

    // 이미 등록된 내역이라면 건너뜀
    if (!$repeat && ($rel_table || $rel_id || $rel_action)) {
        $row = sql_fetch(" select count(*) as cnt from {$g5['na_xp']}
                  where mb_id = '$mb_id'
                    and xp_rel_table = '$rel_table'
                    and xp_rel_id = '$rel_id'
                    and xp_rel_action = '$rel_action' ");
        if ($row['cnt'])
            return -1;
    }

    // 경험치 건별 생성
    $result = sql_query(" insert into {$g5['na_xp']}
			      set mb_id = '$mb_id',
                    xp_datetime = '".G5_TIME_YMDHIS."',
                    xp_content = '".addslashes($content)."',
                    xp_point = '$point',
                    xp_rel_table = '$rel_table',
                    xp_rel_id = '$rel_id',
                    xp_rel_action = '$rel_action' ");

	// 회원정보 UPDATE
	na_sum_xp($mb);

	return 1;
}

// 경험치 삭제
function na_delete_xp($mb_id, $rel_table, $rel_id, $rel_action) {
    global $g5;

    // 회원 플러그인을 사용을 하지 않는다면 return
    if (!IS_NA_XP) { return 0; }

    // 회원아이디가 없다면 업데이트 할 필요 없음
    if ($mb_id == "") {	return 0; }

    $result = false;
    if ($rel_table || $rel_id || $rel_action) {

		$mb = sql_fetch(" select mb_id, mb_level, as_level, as_exp from {$g5['member_table']} where mb_id = '$mb_id' ");
	    if (!$mb['mb_id']) { return 0; }

        $result = sql_query(" delete from {$g5['na_xp']}
					where mb_id = '$mb_id'
						and xp_rel_table = '$rel_table'
				        and xp_rel_id = '$rel_id'
						and xp_rel_action = '$rel_action' ", false);

		// 회원정보 UPDATE
		if($result) {
			na_sum_xp($mb);
		}
	}

    return $result;
}

// 파일 경로 유효성 체크
function na_file_path_check($path='') {
    if($path){
		// 장태진 @jtjisgod <jtjisgod@gmail.com> 추가
		// 보안 목적 : rar wrapper 차단

		if( stripos($path, 'rar:') !== false || stripos($path, 'php:') !== false || stripos($path, 'zlib:') !== false || stripos($path, 'bzip2:') !== false || stripos($path, 'zip:') !== false || stripos($path, 'data:') !== false || stripos($path, 'phar:') !== false ){
			return false;
		}
		
		$replace_path = str_replace('\\', '/', $path);
		$slash_count = substr_count(str_replace('\\', '/', $_SERVER['SCRIPT_NAME']), '/');
		$peer_count = substr_count($replace_path, '../');

		if ( $peer_count && $peer_count > $slash_count ){
			return false;
		}

		try {
			// whether $path is unix or not
			$unipath = strlen($path)==0 || $path{0}!='/';
			$unc = substr($path,0,2)=='\\\\'?true:false;
			// attempts to detect if path is relative in which case, add cwd
			if(strpos($path,':') === false && $unipath && !$unc){
				$path=getcwd().DIRECTORY_SEPARATOR.$path;
				if($path{0}=='/'){
					$unipath = false;
				}
			}

			// resolve path parts (single dot, double dot and double delimiters)
			$path = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $path);
			$parts = array_filter(explode(DIRECTORY_SEPARATOR, $path), 'strlen');
			$absolutes = array();
			foreach ($parts as $part) {
				if ('.'  == $part){
					continue;
				}
				if ('..' == $part) {
					array_pop($absolutes);
				} else {
					$absolutes[] = $part;
				}
			}
			$path = implode(DIRECTORY_SEPARATOR, $absolutes);
			// resolve any symlinks
			// put initial separator that could have been lost
			$path = !$unipath ? '/'.$path : $path;
			$path = $unc ? '\\\\'.$path : $path;
		} catch (Exception $e) {
			//echo 'Caught exception: ',  $e->getMessage(), "\n";
			return false;
		}

		if( preg_match('/\/data\/(file|editor|qa|cache|member|member_image|session|tmp)\/[A-Za-z0-9_]{1,20}\//i', $replace_path) ){
			return false;
		}

		if( preg_match('/\.\.\//i', $replace_path) && preg_match('/plugin\//i', $replace_path) && preg_match('/okname\//i', $replace_path) ){
			return false;
		}
    }

    return $path;
}

// 데모 목록스킨
function na_list_demo($demo) {
	if(IS_DEMO) {
		global $board_skin_path, $boset;

		if($demo) {
			$demo = na_fid($demo);
			set_session('list_demo', $demo);
		}

		$list_demo = get_session('list_demo');

		if($list_demo && is_dir($board_skin_path.'/list/'.$list_demo)) {
			$boset['list_skin'] = $list_demo;
		}
	}
}

?>
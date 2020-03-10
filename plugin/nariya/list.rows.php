<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (!$board['bo_table']) {
   exit;
}

check_device($board['bo_device']);

if (isset($write['wr_is_comment']) && $write['wr_is_comment']) {
    exit;
}

if (!$bo_table) {
	exit;
}

// wr_id 값이 있으면 글읽기
if (isset($wr_id) && $wr_id) {
	exit;
}

if ($member['mb_level'] < $board['bo_list_level']) {
	exit;
}

// 본인확인을 사용한다면
if ($config['cf_cert_use'] && !$is_admin) {
	// 인증된 회원만 가능
	if ($board['bo_use_cert'] != '' && $is_guest) {
		exit;
	}

	if ($board['bo_use_cert'] == 'cert' && !$member['mb_certify']) {
		exit;
	}

	if ($board['bo_use_cert'] == 'adult' && !$member['mb_adult']) {
		exit;
	}

	if ($board['bo_use_cert'] == 'hp-cert' && $member['mb_certify'] != 'hp') {
		exit;
	}

	if ($board['bo_use_cert'] == 'hp-adult' && (!$member['mb_adult'] || $member['mb_certify'] != 'hp')) {
		exit;
	}
}

if ($member['mb_level'] >= $board['bo_list_level'] && $board['bo_use_list_view']) {
	;
} else {
	exit;
}

// 분류 사용
$is_category = false;
$category_name = '';
if ($board['bo_use_category']) {
    $is_category = true;
    if (array_key_exists('ca_name', $write)) {
        $category_name = $write['ca_name']; // 분류명
    }
}

// 추천 사용
$is_good = false;
if ($board['bo_use_good'])
    $is_good = true;

// 비추천 사용
$is_nogood = false;
if ($board['bo_use_nogood'])
    $is_nogood = true;

$sop = strtolower($sop);
if ($sop != 'and' && $sop != 'or')
    $sop = 'and';

// 분류 선택 또는 검색어가 있다면
$stx = trim($stx);
//검색인지 아닌지 구분하는 변수 초기화
$is_search_bbs = false;

if ($sca || $stx || $stx === '0') {     //검색이면
    $is_search_bbs = true;      //검색구분변수 true 지정
    $sql_search = get_sql_search($sca, $sfl, $stx, $sop);

    // 가장 작은 번호를 얻어서 변수에 저장 (하단의 페이징에서 사용)
    $sql = " select MIN(wr_num) as min_wr_num from {$write_table} ";
    $row = sql_fetch($sql);
    $min_spt = (int)$row['min_wr_num'];

    if (!$spt) $spt = $min_spt;

    $sql_search .= " and (wr_num between {$spt} and ({$spt} + {$config['cf_search_part']})) ";

	// 나리야
	if($na_sql_where) 
		$sql_search .= $na_sql_where;

    // 원글만 얻는다. (코멘트의 내용도 검색하기 위함)
    // 라엘님 제안 코드로 대체 http://sir.kr/g5_bug/2922
    $sql = " SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table} WHERE {$sql_search} ";
    $row = sql_fetch($sql);
    $total_count = $row['cnt'];
    /*
    $sql = " select distinct wr_parent from {$write_table} where {$sql_search} ";
    $result = sql_query($sql);
    $total_count = sql_num_rows($result);
    */
} else {
    $sql_search = "";
    $total_count = $board['bo_count_write'];
}

if(G5_IS_MOBILE) {
    $page_rows = $board['bo_mobile_page_rows'];
    $list_page_rows = $board['bo_mobile_page_rows'];
} else {
    $page_rows = $board['bo_page_rows'];
    $list_page_rows = $board['bo_page_rows'];
}

// 년도 2자리
$today2 = G5_TIME_YMD;

$list = array();

$total_page  = ceil($total_count / $page_rows);  // 전체 페이지 계산

$page = (int)$page;
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)

$npg = (int)$npg;
$page = $page + $npg;
$page = ($page > 1) ? $page : 2;

if($page > $total_page)
	exit;

if($qstr) 
	$qstr .= '&amp;page='.$page;

$from_record = ($page - 1) * $page_rows; // 시작 열을 구함

// 관리자라면 CheckBox 보임
$is_checkbox = false;
if ($is_member && ($is_admin == 'super' || $group['gr_admin'] == $member['mb_id'] || $board['bo_admin'] == $member['mb_id']))
    $is_checkbox = true;

// 정렬에 사용하는 QUERY_STRING
$qstr2 = 'bo_table='.$bo_table.'&amp;sop='.$sop;

// 0 으로 나눌시 오류를 방지하기 위하여 값이 없으면 1 로 설정
$bo_gallery_cols = $board['bo_gallery_cols'] ? $board['bo_gallery_cols'] : 1;
$td_width = (int)(100 / $bo_gallery_cols);

// 정렬
// 인덱스 필드가 아니면 정렬에 사용하지 않음
//if (!$sst || ($sst && !(strstr($sst, 'wr_id') || strstr($sst, "wr_datetime")))) {
if (!$sst) {
    if ($board['bo_sort_field']) {
        $sst = $board['bo_sort_field'];
    } else {
        $sst  = "wr_num, wr_reply";
        $sod = "";
    }
} else {
    $board_sort_fields = get_board_sort_fields($board, 1);
    if (!$sod && array_key_exists($sst, $board_sort_fields)) {
        $sst = $board_sort_fields[$sst];
    } else {
        // 게시물 리스트의 정렬 대상 필드가 아니라면 공백으로 (nasca 님 09.06.16)
        // 리스트에서 다른 필드로 정렬을 하려면 아래의 코드에 해당 필드를 추가하세요.
        // $sst = preg_match("/^(wr_subject|wr_datetime|wr_hit|wr_good|wr_nogood)$/i", $sst) ? $sst : "";
        $sst = preg_match("/^(wr_datetime|wr_hit|wr_good|wr_nogood)$/i", $sst) ? $sst : "";
    }
}

if(!$sst)
    $sst  = "wr_num, wr_reply";

if ($sst) {
    $sql_order = " order by {$na_sql_orderby} {$sst} {$sod} ";
}

if ($is_search_bbs) {
    $sql = " select distinct wr_parent from {$write_table} where {$sql_search} {$sql_order} limit {$from_record}, $page_rows ";
} else {
    $sql = " select * from {$write_table} where wr_is_comment = 0 {$na_sql_where} {$sql_order} limit {$from_record}, $page_rows ";
}

$k = 0;
$result = sql_query($sql);
while ($row = sql_fetch_array($result)) {
	// 검색일 경우 wr_id만 얻었으므로 다시 한행을 얻는다
	if ($is_search_bbs)
		$row = sql_fetch(" select * from {$write_table} where wr_id = '{$row['wr_parent']}' ");

	$list[$i] = get_list($row, $board, $board_skin_url, G5_IS_MOBILE ? $board['bo_mobile_subject_len'] : $board['bo_subject_len']);
	if (strstr($sfl, 'subject')) {
		$list[$i]['subject'] = search_font($stx, $list[$i]['subject']);
	}
	$list[$i]['is_notice'] = false;
	$list_num = $total_count - ($page - 1) * $list_page_rows;
	$list[$i]['num'] = $list_num - $k;

	$i++;
	$k++;
}

?>
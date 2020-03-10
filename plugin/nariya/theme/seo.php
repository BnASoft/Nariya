<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

global $config, $g5_head_title, $bo_table, $view, $it, $co, $pset, $tset;

// 대표이미지
$image = na_url($tset['seo_img']);

// 게시물
if(isset($view['wr_id']) && $view['wr_id']) {

	if(isset($view['wr_seo_title']) && $view['wr_seo_title']) {
		$g5_head_title = $view['wr_seo_title'];
	}
	$author = get_text($view['wr_name']);
	$desc = $view['wr_content'];

	if(isset($view['seo_img'])) {
		$image = $view['seo_img'];
	} else {
		$image = na_wr_img($bo_table, $view);
	}

// 내용관리
} else if(isset($co['co_id']) && $co['co_id']) {
	if(isset($co['co_seo_title']) && $co['co_seo_title']) {
		$g5_head_title = $co['co_seo_title'];
	}

	$author = get_text($config['cf_title']);

	if($tset['seo_desc']) {
		$desc = $tset['seo_desc'];
	} else if(isset($co['content']) && $co['content']) {
		$desc = ($co['co_content']) ? $co['co_content'] : $co['content'];
	} else {
		$desc = $co['co_content'];
	}

	$keys = $tset['seo_keys'];

// 상품
} else if(IS_YC && isset($it['it_id']) && $it['it_id']) {
	$author = na_get_text($config['cf_title']);
	$desc = $it['it_basic'].' '.$it['it_explan'];
} else {
	$desc = $tset['seo_desc'];
	$keys = $tset['seo_key'];
}

// 내용(description)이 없으면 SEO용 메타태그 생성안함
if($desc) {
	// 키워드가 없으면 내용 중 3~10글자 사이 한글을 잘라서 최대 20개 자동생성
	if(!$keys) {

		$arr = array();

		preg_match_all("|(?<keys>[가-힣]{3,10}+)|u", $desc, $matchs);

		// 중복제거
		$tmps = array_unique($matchs['keys']);

		for($i=0; $i < count($tmps); $i++) {

			if(!trim($tmps[$i]))
				continue;

			$arr[] = $tmps[$i];

			if($i > 20)
				break;
		}

		$keys = implode(', ', $arr);
	}

	$desc = na_cut_text($desc, 160);

} else {
	return;
}

?>
<meta http-equiv="content-language" content="kr">
<meta name="robots" content="index,follow">
<meta name="title" content="<?php echo $g5_head_title ?>">
<meta name="author" content="<?php echo $config['cf_title'];?>">
<meta name="description" content="<?php echo $desc ?>">
<meta name="keyowrds" content="<?php echo $keys ?>">
<meta property="og:locale" content="ko_KR">
<meta property="og:type" content="website">
<meta property="og:rich_attachment" content="true">
<meta property="og:site_name" content="<?php echo $config['cf_title'] ?>">
<meta property="og:title" content="<?php echo $g5_head_title ?>">
<meta property="og:description" content="<?php echo $desc ?>">
<meta property="og:keyowrds" content="<?php echo $keys ?>">
<meta property="og:image" content="<?php echo $image ?>">
<meta property="og:url" content="<?php echo $pset['href'] ?>">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="<?php echo $config['cf_title'] ?>">
<meta name="twitter:title" content="<?php echo $g5_head_title ?>">
<meta name="twitter:description" content="<?php echo $desc ?>">
<meta name="twitter:keyowrds" content="<?php echo $keys ?>">
<meta name="twitter:image" content="<?php echo $image ?>">
<meta name="twitter:creator" content="<?php echo $author ?>">
<meta itemprop="name" content="<?php echo $g5_head_title ?>">
<meta itemprop="description" content="<?php echo $desc ?>">
<meta itemprop="keyowrds" content="<?php echo $keys ?>">
<meta itemprop="image" content="<?php echo $image ?>">
<meta name="apple-mobile-web-app-title" content="<?php echo $config['cf_title'] ?>">
<link rel="canonical" href="<?php echo $pset['href'] ?>">
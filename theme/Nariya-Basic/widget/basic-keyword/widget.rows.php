<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$list = array();

$n = 0;
if(isset($wset['d']['pp_word']) && is_array($wset['d']['pp_word'])) {
	$data_cnt = count($wset['d']['pp_word']);
	for($i=0; $i < $data_cnt; $i++) {
		if($wset['d']['pp_word'][$i]) {
			$list[$n]['pp_word'] = $wset['d']['pp_word'][$i];
			$list[$n]['pp_link'] = $wset['d']['pp_link'][$i];
			$n++;
		}
	}
} else {
	if($wset['q']) {
		$tmp = explode(",", $wset['q']);
		for($i=0; $i < count($tmp); $i++) {
			if($tmp[$i]) {
				$list[$n]['pp_word'] = $tmp[$i];
				$list[$n]['pp_link'] = '';
				$n++;
			}
		}
	}
}

$list_cnt = $n;

if($list_cnt && $wset['rand']) 
	shuffle($list);

for ($i=0; $i < $list_cnt; $i++) { 
?>
	<li class="item">
		<?php if($list[$i]['pp_link']) { ?>
			<a href="<?php echo $list[$i]['pp_link'] ?>">
		<?php } else { ?>
			<a href="<?php echo G5_BBS_URL ?>/search.php?stx=<?php echo urlencode($list[$i]['pp_word']) ?>">
		<?php } ?>
		<?php echo get_text($list[$i]['pp_word']); ?>
		</a>
	</li>
<?php } ?>

<?php if(!$list_cnt) { ?>
	<li class="item"><a>위젯설정에서 검색어를 설정해 주세요.</a></li>
<?php } ?>

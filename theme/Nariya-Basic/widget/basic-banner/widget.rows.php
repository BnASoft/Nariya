<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

$list = array();

$n = 0;
if(isset($wset['d']['img']) && is_array($wset['d']['img'])) {
	$data_cnt = count($wset['d']['img']);
	for($i=0; $i < $data_cnt; $i++) {
		if($wset['d']['img'][$i]) {
			$list[$n]['img'] = na_url($wset['d']['img'][$i]);
			$list[$n]['link'] = na_url($wset['d']['link'][$i]);
			$list[$n]['alt'] = get_text($wset['d']['alt'][$i]);
			$list[$n]['target'] = $wset['d']['target'][$i];
			$n++;
		}
	}
}

$list_cnt = $n;

// 랜덤
if($wset['rand'] && $list_cnt) 
	shuffle($list);

for ($i=0; $i < $list_cnt; $i++) { 
?>
	<div class="item">
		<div class="img-wrap">
			<div class="img-item">
				<a href="<?php echo ($list[$i]['link']) ? $list[$i]['link'] : 'javascript:;';?>" target="<?php echo $list[$i]['target'] ?>">
					<img src="<?php echo $list[$i]['img'] ?>" alt="<?php echo $list[$i]['alt'] ?>">
				</a>
			</div>
		</div>
	</div>
<?php } ?>

<?php if(!$list_cnt) { ?>
	<div class="item">
		<div class="img-wrap bg-<?php echo NT_COLOR ?>">
			<div class="img-item text-center" style="padding-top:50px;">
				위젯설정에서 배너 등록
			</div>
		</div>
	</div>
<?php } ?>
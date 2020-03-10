<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

// 추출하기
$wset['comment'] = 1; //댓글
$list = na_board_rows($wset);
$list_cnt = count($list);

// 아이콘
$icon = ($wset['icon']) ? '<i class="fa '.$wset['icon'].'" aria-hidden="true"></i>' : '';

// 리스트
for ($i=0; $i < $list_cnt; $i++) { 

	// 아이콘 체크
	if ($list[$i]['icon_secret']) {
		$is_lock = true;
		$wr_icon = '<span class="na-icon na-secret"></span>';
	} else if ($wset['rank']) {
		$wr_icon = '<span class="rank-icon en bg-'.$wset['rank'].'">'.$rank.'</span>';	
		$rank++;
	} else if($list[$i]['icon_new']) {
		$wr_icon = '<span class="na-icon na-new"></span>';
	} else {
		$wr_icon = $icon;
	}

?>
	<li class="ellipsis">
		<span class="pull-right lightgray f-small">
			<?php echo $list[$i]['name'] ?>
			&nbsp;<?php echo na_date($list[$i]['wr_datetime'], 'orangered', 'H:i', 'm.d', 'm.d'); ?>
		</span>
		<a href="<?php echo $list[$i]['href'];?>">
			<?php echo $wr_icon;?>
			<?php echo $list[$i]['subject'];?>
		</a> 
	</li>
<?php } ?>

<?php if(!$list_cnt) { ?>
	<li class="no-data">
		댓글이 없습니다.
	</li>
<?php } ?>
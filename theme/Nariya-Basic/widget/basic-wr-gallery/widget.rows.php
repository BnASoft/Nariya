<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

// 추출하기
$wset['list_file'] = 1; // 첨부파일 가져오기
$wset['sideview'] = 1; // 이름 레이어 출력

$list = na_board_rows($wset);
$list_cnt = count($list);

// 랭킹
$rank = na_rank_start($wset['rows'], $wset['page']);

// 새글
$cap_new = ($wset['new']) ? $wset['new'] : NT_COLOR;

// 리스트
for ($i=0; $i < $list_cnt; $i++) { 

	// 아이콘 체크
	$wr_icon = $wr_tack = $wr_cap = '';
	if ($list[$i]['icon_secret']) {
		$is_lock = true;
		$wr_icon = '<span class="na-icon na-secret"></span>';
	}

	if ($wset['rank']) {
		$wr_tack = '<span class="label-tack rank-icon en bg-'.$wset['rank'].'">'.$rank.'</span>';
		$rank++;
	}

	if($list[$i]['icon_new']) {
		$wr_cap = '<span class="label-cap en bg-'.$cap_new.'">New</span>';
	}

	// 이미지 추출
	$img = na_wr_img($list[$i]['bo_table'], $list[$i]);

	// 썸네일 생성
	$thumb = ($wset['thumb_w']) ? na_thumb($img, $wset['thumb_w'], $wset['thumb_h']) : $img;

?>
	<li>
		<div class="img-wrap bg-light">
			<div class="img-item">
				<a href="<?php echo $list[$i]['href'] ?>">
					<?php echo $wr_tack ?>
					<?php echo $wr_cap ?>
					<?php if($thumb) { ?>
						<img src="<?php echo $thumb ?>" alt="<?php echo $list[$i]['subject'] ?>">
					<?php } else { ?>
						&nbsp;
					<?php } ?>
				</a>
			</div>
		</div>

		<div class="ellipsis" style="margin:10px 0 5px">
			<?php if($list[$i]['wr_comment']) { ?>
				<span class="pull-right f-small">
					<span class="count orangered">+<?php echo $list[$i]['wr_comment'] ?></span>
				</span>
			<?php } ?>
			<a href="<?php echo $list[$i]['href'] ?>">
				<?php echo $wr_icon;?>
				<?php echo $list[$i]['subject'] ?>
			</a> 
		</div>

		<span class="pull-right lightgray f-small">
			&nbsp;<?php echo na_date($list[$i]['wr_datetime'], 'orangered', 'H:i', 'm.d', 'm.d'); ?>
		</span>

		<?php echo $list[$i]['name'];?>

		<div class="clearfix"></div>
	</li>
<?php } ?>

<?php if(!$list_cnt) { ?>
	<li class="no-data">
		글이 없습니다.
	</li>
<?php } ?>
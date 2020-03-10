<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<div id="point" class="win-cont">
    <h2 class="win-title">
		<button type="button" onclick="javascript:window.close();" class="btn btn_b01 pull-right" title="창닫기">
			<i class="fa fa-times" aria-hidden="true"></i>
			<span class="sound_only">창닫기</span>
		</button>

		<img src="<?php echo na_member_photo($member['mb_id']) ?>" alt="">
		<?php echo $g5['title'] ?>
	</h2>
	<ul class="list-group no-margin">
		<li class="list-group-item clearfix bg-<?php echo NT_COLOR ?>">
			<span class="pull-left">
				보유포인트
			</span>
			<b class="pull-right en">
				<?php echo number_format($member['mb_point']); ?>
			</b>		
		</li>


		<?php
		$sum_point1 = $sum_point2 = $sum_point3 = 0;

		$sql = " select *
					{$sql_common}
					{$sql_order}
					limit {$from_record}, {$rows} ";
		$result = sql_query($sql);
		for ($i=0; $row=sql_fetch_array($result); $i++) {
			$point1 = $point2 = 0;
			$point_use_class = '';
			if ($row['po_point'] > 0) {
				$point1 = '+' .number_format($row['po_point']);
				$sum_point1 += $row['po_point'];
			} else {
				$point2 = number_format($row['po_point']);
				$sum_point2 += $row['po_point'];
				$point_use_class = ' bg-light';
			}

			$po_content = $row['po_content'];

			$expr = '';
			if($row['po_expired'] == 1)
				$expr = ' orangered';
		?>
		<li class="list-group-item clearfix<?php echo $point_use_class; ?>">
			<div class="clearfix ellipsis">
				<strong class="pull-left">
					<?php echo $po_content; ?>
				</strong>
				<b class="pull-right en">
					<?php echo ($point1) ? $point1 : '<span class="orangered">'.$point2.'</span>'; ?>
				</b>
			</div>
			<div class="clearfix ellipsis text-muted f-small">
				<span class="pull-left">
					<i class="fa fa-clock-o" aria-hidden="true"></i>
					<?php echo $row['po_datetime']; ?>
				</span>
				<span class="pull-right<?php echo $expr; ?>">
					<?php if ($row['po_expired'] == 1) { ?>
					만료 <?php echo substr(str_replace('-', '', $row['po_expire_date']), 2); ?>
					<?php } else echo $row['po_expire_date'] == '9999-12-31' ? '&nbsp;' : $row['po_expire_date']; ?>
				</span>
			</div>
		</li>
		<?php
		}

		if ($i == 0)
			echo '<li class="list-group-item empty_list">자료가 없습니다.</li>';
		else {
			if ($sum_point1 > 0)
				$sum_point1 = "+" . number_format($sum_point1);
			$sum_point2 = number_format($sum_point2);
		}
		?>
		<li class="clearfix list-group-item bg-light">
			<span class="pull-left">
				포인트 소계
			</span>
			<span class="pull-right">
				<?php if($sum_point1) { ?>
					<b class="en"><?php echo $sum_point1; ?></b>
				<?php } ?>
				<?php if($sum_point2) { ?>
					&nbsp;
					<b class="en orangered"><?php echo $sum_point2; ?></b>
				<?php } ?>
			</span>
		</li>
	</ul>

	<div class="text-center na-page pg-<?php echo NT_COLOR ?>">
		<ul class="pagination pagination-sm en">
			<?php echo na_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, $_SERVER['SCRIPT_NAME'].'?'.$qstr.'&amp;page='); ?>
		</ul>
	</div>

	<p class="text-center">
		<button type="button" onclick="window.close();" class="btn btn-sm btn-white">창닫기</button>
	</p>

	<div class="h30"></div>

</div>
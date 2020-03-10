<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$list_skin_url.'/list.css">', 0);

$border_color = ($boset['head_color']) ? $boset['head_color'] : 'navy';

// 목록헤드
if($boset['head_skin']) {
	add_stylesheet('<link rel="stylesheet" href="'.NA_PLUGIN_URL.'/skin/head/'.$boset['head_skin'].'.css">', 0);
	$head_class = 'list-head';
} else {
	$head_class = 'border-'.$border_color;
}

$list_cnt = count($list);

?>

<div class="div-head <?php echo $head_class;?> f-small hidden-xs">
	<span class="wr-num">번호</span>
	<span class="wr-subject">제목</span>
	<span class="wr-name">이름</span>
	<span class="wr-date"><?php echo subject_sort_link('wr_datetime', $qstr2, 1) ?>날짜</a></span>
	<span class="wr-hit"><?php echo subject_sort_link('wr_hit', $qstr2, 1) ?>조회</a></span>
	<?php if($is_good) { ?>
		<span class="wr-good"><?php echo subject_sort_link('wr_good', $qstr2, 1) ?>추천</a></span>
	<?php } ?>
	<?php if($is_nogood) { ?>
		<span class="wr-nogood"><?php echo subject_sort_link('wr_nogood', $qstr2, 1) ?>비추</a></span>
	<?php } ?>
	<?php if ($is_checkbox) { ?>
		<span class="wr-chk"><input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);" class="no-margin"></span>
	<?php } ?>
</div>

<ul class="bo_list border-<?php echo $border_color ?>">
<?php
for ($i=0; $i < $list_cnt; $i++) { 

	//아이콘 체크
	$wr_icon = '';
	$is_lock = false;
	if ($list[$i]['icon_secret']) {
		$wr_icon = '<span class="na-icon na-secret"></span>';
		$is_lock = true;
	} else if ($list[$i]['icon_hot']) {
		$wr_icon = '<span class="na-icon na-hot"></span>';
	} else if ($list[$i]['icon_new']) {
		$wr_icon = '<span class="na-icon na-new"></span>';
	}

	// 공지, 현재글 스타일 체크
	$li_css = '';
	if ($list[$i]['is_notice']) { // 공지사항
		$li_css = ' bg-light';
		$list[$i]['num'] = '<span class="na-notice"></span>';
		$list[$i]['ca_name'] = '공지';
		$list[$i]['subject'] = '<b>'.$list[$i]['subject'].'</b>';
	} else if ($wr_id == $list[$i]['wr_id']) {
		$li_css = ' bg-light';
		$list[$i]['num'] = '<span class="na-text orangered">열람중</span>';
		$list[$i]['subject'] = '<b class="red">'.$list[$i]['subject'].'</b>';
	}
?>
	<li class="tr<?php echo $li_css;?>">
		<div class="td wr-num f-small hidden-xs">
			<span class="sound_only">번호</span>
			<?php echo $list[$i]['num']; ?>
		</div>
		<div class="td wr-cont">
			<ul class="tr">
				<li class="td wr-subject">
					<a href="<?php echo $list[$i]['href'] ?>">
					<?php
						if($list[$i]['icon_reply']) {
						    $depth = strlen($list[$i]['wr_reply']);
							$depth = ($depth > 1) ? ' style="margin-left:'.(($depth - 1) * 12).'px;"' : '';
							echo '<span class="na-icon na-reply"'.$depth.'></span>'.PHP_EOL;
						}

						echo $wr_icon.PHP_EOL;

						echo $list[$i]['subject'];
					?>
					</a>
					<?php
						if(isset($list[$i]['icon_file']))
							echo '<span class="na-icon na-file"></span>'.PHP_EOL;

						if(isset($list[$i]['icon_link']) && $list[$i]['icon_link'])
							echo '<span class="na-icon na-link"></span>'.PHP_EOL;
					?>
					<?php if($list[$i]['wr_comment']) { ?>
						<a href="<?php echo $list[$i]['href'] ?>#bo_vc">
							<span class="sound_only">댓글</span>
							<span class="count orangered">+<?php echo $list[$i]['wr_comment']; ?></span>
						</a>
					<?php } ?>
				</li>
				<li class="td wr-name f-small">
					<span class="sound_only">이름</span>
					<?php echo na_name_photo($list[$i]['mb_id'], $list[$i]['name']); ?>
				</li>
				<li class="td wr-date f-small text-muted">
					<i class="fa fa-clock-o f-icon" aria-hidden="true"></i>
					<span class="sound_only">작성일</span>
					<?php echo na_date($list[$i]['wr_datetime'], 'orangered', 'H:i', 'm.d', 'Y.m.d'); ?>
				</li>
				<li class="td wr-hit f-small text-muted">
					<i class="fa fa-eye f-icon" aria-hidden="true"></i>
					<span class="sound_only">조회</span>
					<?php echo $list[$i]['wr_hit'] ?>
				</li>
				<?php if($is_good) { ?>
					<li class="td wr-good f-small text-muted">
						<i class="fa fa-thumbs-o-up f-icon" aria-hidden="true"></i>
						<span class="sound_only">추천</span>
						<?php echo $list[$i]['wr_good'] ?>
					</li>
				<?php } ?>
				<?php if($is_nogood) { ?>
					<li class="td wr-nogood f-small text-muted">
						<i class="fa fa-thumbs-o-down f-icon" aria-hidden="true"></i>
						<span class="sound_only">비추천</span>
						<?php echo $list[$i]['wr_nogood'] ?>
					</li>
				<?php } ?>
			</ul>
		</div>
		<?php if ($is_checkbox) { ?>
			<div class="td wr-chk hidden-xs">
				<input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>" class="no-margin">
			</div>
		<?php } ?>
	</li>
<?php } ?>
	<?php if (!$list_cnt) { ?>
		<li class="wr-none">게시물이 없습니다.</li>
	<?php } ?>
</ul>

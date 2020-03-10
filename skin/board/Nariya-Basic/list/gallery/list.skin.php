<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$list_skin_url.'/list.css">', 0);

// 이미지 영역 및 썸네일 크기 설정
$boset['thumb_w'] = ($boset['thumb_w'] == "") ? 320 : (int)$boset['thumb_w'];
$boset['thumb_h'] = ($boset['thumb_h'] == "") ? 180 : (int)$boset['thumb_h'];

if($boset['thumb_w'] && $boset['thumb_h']) {
	$height = ($boset['thumb_w'] / $boset['thumb_h']) * 100;
} else {
	$height = ($boset['thumb_d']) ? $boset['thumb_d'] : '56.25';
}

$border_color = ($boset['head_line']) ? $boset['head_line'] : 'navy';

$list_cnt = count($list);

?>

<style>
	#bo_gallery > ul > li {<?php echo na_width($boset['item'], 4) ?>}
	#bo_gallery .img-wrap { padding-bottom:<?php echo $height ?>; }
	<?php if(_RESPONSIVE_) { // 반응형일 때만 작동 ?>
	@media (max-width:1199px) { 
		.responsive #bo_gallery li {<?php echo na_width($boset['lg'], 4) ?>}
	}
	@media (max-width:991px) { 
		.responsive #bo_gallery li {<?php echo na_width($boset['md'], 3) ?>}
	}
	@media (max-width:767px) { 
		.responsive #bo_gallery li {<?php echo na_width($boset['sm'], 2) ?>}
	}
	@media (max-width:480px) { 
		.responsive #bo_gallery li {<?php echo na_width($boset['xs'], 2) ?>}
	}
	<?php } ?>
</style>

<ul class="bo_list border-<?php echo $border_color ?>">
<?php
// 공지
if($board['bo_notice']) {
	for ($i=0; $i < $list_cnt; $i++) { 

		if(!$list[$i]['is_notice'])
			continue;

		//아이콘 체크
		$wr_icon = '';
		$is_lock = false;
		if ($list[$i]['icon_new']) {
			$wr_icon = '<span class="na-icon na-new"></span>';
		}
?>
	<li class="tr">
		<div class="td wr-num f-small hidden-xs">
			<span class="na-notice"></span>
			<span class="sound_only">공지</span>
		</div>
		<div class="td wr-cont">
			<ul class="tr">
				<li class="td wr-subject">
					<a href="<?php echo $list[$i]['href'] ?>">
					<?php
						echo $wr_icon.PHP_EOL;
						echo $list[$i]['subject'];
					?>
					</a>
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
			</ul>
		</div>
		<?php if ($is_checkbox) { ?>
			<div class="td wr-chk hidden-xs">
				<input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>" class="no-margin">
			</div>
		<?php } ?>
	</li>
<?php 
	}
} // 공지 ?>
</ul>

<div id="bo_gallery">
	<ul class="clearfix">
	<?php
	// 리스트
	$n = 0;
	$cap_new = ($boset['new']) ? $boset['new'] : 'navy';
	for ($i=0; $i < $list_cnt; $i++) { 

		// 공지는 제외	
		if($list[$i]['is_notice'])
			continue;

		// 글수 체크
		$n++;

		// 아이콘 체크
		$wr_icon = $wr_tack = $wr_cap = '';
		if ($list[$i]['icon_secret']) {
			$is_lock = true;
			$wr_icon = '<span class="na-icon na-secret"></span>';
		}

		if($list[$i]['icon_new']) {
			$wr_cap = '<span class="label-cap en bg-'.$cap_new.'">New</span>';
		}

		// 이미지 추출
		$img = na_wr_img($list[$i]['bo_table'], $list[$i]);

		// 썸네일 생성
		$thumb = ($boset['thumb_w']) ? na_thumb($img, $boset['thumb_w'], $boset['thumb_h']) : $img;

	?>
		<li>
			<div class="img-wrap bg-light">
				<div class="img-item">
					<?php if ($is_checkbox) { ?>
						<span class="chk-box">
							<input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>" class="no-margin">
						</span>
					<?php } ?>

					<a href="<?php echo $list[$i]['href'] ?>">
						<?php echo $wr_tack ?>
						<?php echo $wr_cap ?>
						<?php if($thumb) { ?>
							<img src="<?php echo $thumb ?>" alt="<?php echo $list[$i]['subject'] ?>" class="wr-thumb">
						<?php } else { ?>
							&nbsp;
						<?php } ?>
					</a>
				</div>
			</div>

			<div class="ellipsis" style="margin:10px 0 5px">
				<?php if($list[$i]['wr_comment']) { ?>
					<a href="<?php echo $list[$i]['href'] ?>#bo_vc" class="pull-right f-small">
						<span class="sound_only">댓글</span>
						<span class="count orangered">+<?php echo $list[$i]['wr_comment'] ?></span>
					</a>
				<?php } ?>
				<a href="<?php echo $list[$i]['href'] ?>">
					<?php echo $wr_icon;?>
					<?php echo $list[$i]['subject'] ?>
				</a> 
			</div>

			<div class="clearfix f-small">
				<span class="pull-left">
					<?php echo na_name_photo($list[$i]['mb_id'], $list[$i]['name']); ?>
				</span>

				<span class="pull-right lightgray">
					&nbsp;<?php echo na_date($list[$i]['wr_datetime'], 'orangered', 'H:i', 'm.d', 'm.d') ?>
				</span>
			</div>
		</li>
	<?php } ?>
	</ul>
	<div class="clearfix"></div>
	<?php if(!$n) { ?>
		<div class="wr-none">
			게시물이 없습니다.
		</div>
	<?php } ?>
</div>
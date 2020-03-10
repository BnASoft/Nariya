<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<!-- 스크랩 목록 시작 { -->
<div id="scrap" class="win-cont">
    <h2 class="win-title">
		<button type="button" onclick="javascript:window.close();" class="btn btn_b01 pull-right" title="창닫기">
			<i class="fa fa-times" aria-hidden="true"></i>
			<span class="sound_only">창닫기</span>
		</button>

		<img src="<?php echo na_member_photo($member['mb_id']) ?>" alt="">
		<?php echo $g5['title'] ?>
	</h2>
	<ul class="list-group no-margin">
		<li class="list-group-item bg-<?php echo NT_COLOR ?>">
			전체 <b><?php echo number_format($total_count) ?></b>건 / <?php echo $page ?>페이지
		</li>
        <?php for ($i=0; $i<count($list); $i++) {  ?>
        <li class="list-group-item clearfix">
			<div class="clearfix ellipsis">
	            <a href="<?php echo $list[$i]['del_href'];  ?>" onclick="del(this.href); return false;" class="pull-right win-del" title="삭제">
					<i class="fa fa-trash-o" aria-hidden="true"></i>
					<span class="sound_only">삭제</span>
				</a>

				<a href="<?php echo $list[$i]['opener_href_wr_id'] ?>" target="_blank" onclick="opener.document.location.href='<?php echo $list[$i]['opener_href_wr_id'] ?>'; return false;">
					<b><?php echo $list[$i]['subject'] ?></b>
				</a>
			</div>
			<p class="text-muted f-small">
				<i class="fa fa-clock-o" aria-hidden="true"></i>
				<?php echo $list[$i]['ms_datetime'] ?>
				&nbsp;
				<a href="<?php echo $list[$i]['opener_href'] ?>" target="_blank" onclick="opener.document.location.href='<?php echo $list[$i]['opener_href'] ?>'; return false;">
					<span class="text-muted">
						<i class="fa fa-map-marker" aria-hidden="true"></i>
						<?php echo $list[$i]['bo_subject'] ?>
					</span>
				</a>
			</p>
        </li>
        <?php }  ?>

        <?php if ($i == 0) echo '<li class="list-group-item empty_list">자료가 없습니다.</li>';  ?>
    </ul>

	<div class="text-center na-page pg-<?php echo NT_COLOR ?>">
		<ul class="pagination pagination-sm en">
			<?php echo na_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "?$qstr&amp;page="); ?>
		</ul>
	</div>

	<p class="text-center">
		<button type="button" onclick="window.close();" class="btn btn-sm btn-white">창닫기</button>
	</p>

	<div class="h20"></div>

</div>
<!-- } 스크랩 목록 끝 -->
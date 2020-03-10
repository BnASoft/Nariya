<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$search_skin_url.'/style.css">', 0);

// 스킨 설정값
$wset = na_skin_config('search');

$color = (isset($wset['color']) && $wset['color']) ? $wset['color'] : NT_COLOR;

?>

<div id="sch_res_detail" class="well">
	<form class="form" role="form" name="fsearch" onsubmit="return fsearch_submit(this);" method="get">
	<input type="hidden" name="srows" value="<?php echo $srows ?>">
    <legend class="sound_only">상세검색</legend>
		<div class="row row-15">
			<div class="col-sm-3 col-xs-12 col-15">
				<label for="gr_id" class="sound_only">그룹</label>
				<?php echo $group_select ?>
				<script>
					$("#gr_id").addClass("form-control");
					document.getElementById("gr_id").value = "<?php echo $gr_id ?>";
				</script>
				<div class="h15 visible-xs"></div>
			</div>
			<div class="col-sm-2 col-xs-6 col-15">
				<label for="sfl" class="sound_only">검색조건</label>
				<select name="sfl" id="sfl" class="form-control">
					<option value="wr_subject||wr_content"<?php echo get_selected($_GET['sfl'], "wr_subject||wr_content") ?>>제목+내용</option>
					<option value="wr_subject"<?php echo get_selected($_GET['sfl'], "wr_subject") ?>>제목</option>
					<option value="wr_content"<?php echo get_selected($_GET['sfl'], "wr_content") ?>>내용</option>
					<option value="mb_id"<?php echo get_selected($_GET['sfl'], "mb_id") ?>>회원아이디</option>
					<option value="wr_name"<?php echo get_selected($_GET['sfl'], "wr_name") ?>>이름</option>
				</select>
			</div>
			<div class="col-sm-2 col-xs-6 col-15">
				<select name="sop" id="sop" class="form-control">
					<option value="or"<?php echo get_selected($sop, "or") ?>>또는</option>
					<option value="and"<?php echo get_selected($sop, "and") ?>>그리고</option>
				</select>	
			</div>
			<div class="col-sm-5 col-xs-12 col-15">
				<div class="h15 visible-xs"></div>
			    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
				<div class="input-group">
				    <input type="text" name="stx" value="<?php echo $text_stx ?>" id="stx" required class="form-control" maxlength="20" placeholder="검색어">
					<div class="input-group-btn">
						<button type="submit" class="btn btn-<?php echo $color ?>" title="검색하기">
							<i class="fa fa-search" aria-hidden="true"></i>
							<span class="sound_only">검색하기</span>
						</button>
						<a href="<?php echo G5_BBS_URL ?>/search.php" class="btn btn-white" title="검색 초기화">
							<i class="fa fa-bars" aria-hidden="true"></i>
							<span class="sound_only">검색 초기화</span>
						</a>
						<?php if($is_admin || IS_DEMO) { ?>
							<?php if(is_file($search_skin_path.'/setup.skin.php')) { ?>
								<a href="<?php echo na_setup_href('search') ?>" title="스킨설정" class="btn btn-white btn-setup">
									<i class="fa fa-cogs" aria-hidden="true"></i>
									<span class="sound_only">스킨설정</span>
								</a>
							<?php } ?>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</form>
    <script>
    function fsearch_submit(f) {

		if (f.stx.value.length < 2) {
            alert("검색어는 두글자 이상 입력하십시오.");
            f.stx.select();
            f.stx.focus();
            return false;
        }

        // 검색에 많은 부하가 걸리는 경우 이 주석을 제거하세요.
        var cnt = 0;
        for (var i=0; i<f.stx.value.length; i++) {
            if (f.stx.value.charAt(i) == ' ')
                cnt++;
        }

        if (cnt > 1) {
            alert("빠른 검색을 위하여 검색어에 공백은 한개만 입력할 수 있습니다.");
            f.stx.select();
            f.stx.focus();
            return false;
        }

        f.action = "";
        return true;
    }
    </script>
</div>

<?php
if ($stx) {
	if ($board_count) {
 ?>

<style>
	#sch_res_board li {<?php echo na_width($wset['cw'], 7) ?>}
	<?php if(_RESPONSIVE_) { // 반응형일 때만 작동 ?>
		@media (max-width:1199px) { 
			.responsive #sch_res_board li {<?php echo na_width($wset['cwlg'], 6) ?>}
		}
		@media (max-width:991px) { 
			.responsive #sch_res_board li {<?php echo na_width($wset['cwmd'], 5) ?>}
		}
		@media (max-width:767px) { 
			.responsive #sch_res_board li {<?php echo na_width($wset['cwsm'], 4) ?>}
		}
		@media (max-width:480px) { 
			.responsive #sch_res_board li {<?php echo na_width($wset['cwxs'], 3) ?>}
		}
	<?php } ?>
</style>
<div id="sch_res_board" class="na-category">
	<ul>
		<li><a href="?<?php echo $search_query ?>&amp;gr_id=<?php echo $gr_id ?>" <?php echo $sch_all ?>>전체게시판</a></li>
		<?php echo $str_board_list; ?>
	</ul>
	<hr/>
</div>

<section id="sch_res_ov">
	<strong>"<?php echo $stx ?>"</strong> 검색 결과 : 게시판 <b><?php echo $board_count ?></b>개 / 게시물 <b><?php echo number_format($total_count) ?></b>건 / <?php echo number_format($total_page) ?> 페이지
</section>

<?php
	} else {
 ?>
<div class="empty_list">검색된 자료가 하나도 없습니다.</div>
<?php } }  ?>

<?php if ($stx && $board_count) { ?><section id="sch_res_list"><?php }  ?>
<?php
$k=0;
for ($idx=$table_index, $k=0; $idx<count($search_table) && $k<$rows; $idx++) {
 ?>
	<a href="<?php echo get_pretty_url($search_table[$idx], '', $search_query); ?>">
		<span class="pull-right f-small text-muted">+더보기</span>
		<b><?php echo $bo_subject[$idx] ?></b> 게시판 내 결과
	</a>
	<ul>
	<?php
	for ($i=0; $i<count($list[$idx]) && $k<$rows; $i++, $k++) {
		if ($list[$idx][$i]['wr_is_comment']) {
			$comment_def = '댓글 | ';
			$comment_href = '#c_'.$list[$idx][$i]['wr_id'];
		} else {
			$comment_def = '';
			$comment_href = '';
		}
	 ?>

		<li>
			<a href="<?php echo $list[$idx][$i]['href'] ?><?php echo $comment_href ?>" target="_blank" class="pull-right" title="새창">
				<i class="fa fa-window-restore light fa-fw" aria-hidden="true"></i>
				<span class="sound_only">새창</span>
			</a>
			<a href="<?php echo $list[$idx][$i]['href'] ?><?php echo $comment_href ?>" class="pull-left">
				<strong>
				<?php echo $comment_def ?>
				<?php echo $list[$idx][$i]['subject'] ?>
				</strong>
			</a>

			<div class="clearfix"></div>

			<p class="f-small"><?php echo $list[$idx][$i]['content'] ?></p>

			<div class="clearfix text-muted f-small">
				<span class="pull-right">
					<?php echo na_name_photo($list[$idx][$i]['mb_id'], $list[$idx][$i]['name']) ?>
				</span>
				<span class="pull-left">
					<i class="fa fa-clock-o light fa-fw" aria-hidden="true"></i>
					<?php echo na_date($list[$idx][$i]['wr_datetime'], 'orangered', 'Y.m.d H:i', 'Y.m.d H:i', 'Y.m.d H:i') ?>
				</span>
			</div>
		</li>
	<?php }  ?>
	</ul>
<?php }  ?>
<?php if ($stx && $board_count) {  ?></section><?php }  ?>

<?php if($stx && $board_count) { ?>
	<div id="sch_res_page" class="na-page text-center pg-<?php echo $color ?>">
		<ul class="pagination pagination-sm en">
			<?php echo na_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, $_SERVER['SCRIPT_NAME'].'?'.$search_query.'&amp;gr_id='.$gr_id.'&amp;srows='.$srows.'&amp;onetable='.$onetable.'&amp;page='); ?>
		</ul>
	</div>
<?php } ?>

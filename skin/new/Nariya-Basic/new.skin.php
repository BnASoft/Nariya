<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$new_skin_url.'/style.css">', 0);

// 스킨 설정값
$wset = na_skin_config('new');

$color = (isset($wset['color']) && $wset['color']) ? $wset['color'] : NT_COLOR;

// 목록헤드
if(isset($wset['head_skin']) && $wset['head_skin']) {
	add_stylesheet('<link rel="stylesheet" href="'.NA_PLUGIN_URL.'/skin/head/'.$wset['head_skin'].'.css">', 0);
	$head_class = 'list-head';
} else {
	$head_class = (isset($wset['head_color']) && $wset['head_color']) ? 'border-'.$wset['head_color'] : 'border-dark';
}

?>

<!-- 전체게시물 검색 시작 { -->
<div id="new_search" class="collapse<?php echo ($gr_id || $view || $mb_id) ? ' in' : ''; ?>">
	<div class="new-search well">
		<form class="form" role="form" name="fnew" method="get">
			<div class="row row-15">
				<div class="col-sm-3 col-xs-6 col-15">
					<label for="sfl" class="sound_only">게시판그룹</label>
					<?php echo $group_select ?>
					<script>
						$("#gr_id").addClass("form-control");
					</script>
				</div>
				<div class="col-sm-3 col-xs-6 col-15">
					<label for="view" class="sound_only">검색대상</label>
					<select name="view" id="view" class="form-control">
						<option value="">전체게시물
						<option value="w">원글만
						<option value="c">코멘트만
					</select>
				</div>
				<div class="col-sm-6 col-xs-12 col-15">
					<div class="h15 visible-xs"></div>
					<div class="input-group">
						<span class="input-group-addon">
							<i class="fa fa-user" aria-hidden="true"></i>
							<span class="sound_only">회원아이디</span>
						</span>
						<label for="new_mb_id" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
						<input type="text" name="mb_id" value="<?php echo $mb_id ?>" id="new_mb_id" class="form-control" placeholder="회원아이디 검색만 가능">
						<div class="input-group-btn">
							<button type="submit" class="btn btn-<?php echo $color ?>" title="검색하기">
								<i class="fa fa-search" aria-hidden="true"></i>
								<span class="sound_only">검색하기</span>
							</button>
							<a href="<?php echo G5_BBS_URL ?>/new.php" class="btn btn-white" title="검색 초기화">
								<i class="fa fa-bars" aria-hidden="true"></i>
								<span class="sound_only">검색 초기화</span>
							</a>
						</div>
					</div>
				</div>
			</div>

		</form>
		<script>
		document.getElementById("gr_id").value = "<?php echo $gr_id ?>";
		document.getElementById("view").value = "<?php echo $view ?>";
		$(function(){
			$('#new_search').on('shown.bs.collapse', function () {
				$('#new_mb_id').focus();
			});
		});
		</script>
	</div>
</div>
<!-- } 전체게시물 검색 끝 -->

<!-- 전체게시물 목록 시작 { -->
<form class="form" role="form" name="fnewlist" method="post" action="#" onsubmit="return fnew_submit(this);">
<input type="hidden" name="sw"       value="move">
<input type="hidden" name="view"     value="<?php echo $view; ?>">
<input type="hidden" name="sfl"      value="<?php echo $sfl; ?>">
<input type="hidden" name="stx"      value="<?php echo $stx; ?>">
<input type="hidden" name="bo_table" value="<?php echo $bo_table; ?>">
<input type="hidden" name="page"     value="<?php echo $page; ?>">
<input type="hidden" name="pressed"  value="">

	<!-- 페이지 정보 및 버튼 시작 { -->
	<div id="new_btn_top" class="clearfix f-small">
		<div class="pull-right">
			<?php if($is_admin || IS_DEMO) { ?>
				<?php if($is_admin) { ?>
					<button type="submit" onclick="document.pressed=this.value" value="선택삭제" title="선택삭제" class="btn_b01 btn pull-right">
						<i class="fa fa-trash-o" aria-hidden="true"></i>				
						<span class="sound_only">선택삭제</span>
					</button>
				<?php } ?>
				<?php if(is_file($new_skin_path.'/setup.skin.php')) { ?>
					<a href="<?php echo na_setup_href('new') ?>" title="스킨설정" class="btn_b01 btn btn-setup pull-right">
						<i class="fa fa-cogs" aria-hidden="true"></i></a>
						<span class="sound_only">스킨설정</span>
					</a>
				<?php } ?>
			<?php } ?>
			<button type="button" class="btn_b01 btn pull-right" title="새글 검색" data-toggle="collapse" data-target="#new_search" aria-expanded="false" aria-controls="new_search">
				<i class="fa fa-search" aria-hidden="true"></i>
				<span class="sound_only">새글 검색</span>
			</button>
		</div>
		<div id="new_list_total" class="pull-left">
			전체 <b><?php echo number_format($total_count) ?></b>건 / <?php echo $page ?>페이지
		</div>
	</div>
	<!-- } 페이지 정보 및 버튼 끝 -->

	<!-- 전체게시물 목록 시작 { -->
	<div id="new_list">
		<div class="div-head <?php echo $head_class ?>">
			<span class="icon">구분</span>
			<span class="subj">제목</span>
			<span class="name hidden-xs">이름</span>
			<span class="date hidden-xs">날짜</span>
			<?php if ($is_admin) { ?>
			<span class="chk">
				<label for="all_chk" class="sound_only">목록 전체 선택</label>
				<input type="checkbox" id="all_chk">
			</span>
			<?php } ?>
		</div>
		<ul>
		<?php
			for ($i=0; $i<count($list); $i++) {
				$num = $total_count - ($page - 1) * $config['cf_page_rows'] - $i;

				if (strstr($list[$i]['wr_option'], 'secret')) {
					$wr_icon = '<span class="na-icon na-secret"></span>';
				} else if ((strtotime($list[$i]['wr_datetime']) + 86400) >= G5_SERVER_TIME) {
					$wr_icon = '<span class="na-icon na-new"></span>';
				} else {
					$wr_icon = '';
				}
			?>
			<li class="tr">
				<div class="td icon">
					<a href="<?php echo $list[$i]['href']; ?>" class="bg-light">
						<?php if($list[$i]['comment']) { ?>
							<i class="fa fa-commenting" aria-hidden="true"></i>
							<span class="sound_only">댓글</span>
						<?php } else { ?>
							<i class="fa fa-pencil" aria-hidden="true"></i>
							<span class="sound_only">게시물</span>
						<?php } ?>
					</a>
				</div>
				<div class="td subj">
					<div class="tr">
						<div class="td td-subj">
							<span class="cate f-small">
								<a href="<?php echo G5_BBS_URL ?>/new.php?gr_id=<?php echo $list[$i]['gr_id'] ?>"><?php echo na_cut_text($list[$i]['gr_subject'], 20) ?></a>
								>
								<a href="<?php echo get_pretty_url($list[$i]['bo_table']) ?>"><?php echo na_cut_text($list[$i]['bo_subject'], 20) ?></a>
							</span>

							<a href="<?php echo $list[$i]['href'] ?>" class="ellipsis">
								<?php echo $wr_icon ?>
								<?php echo na_get_text($list[$i]['wr_subject']) ?>
							</a>
						</div>
						<div class="td td-item name f-small">
							<?php echo na_name_photo($list[$i]['mb_id'], $list[$i]['name']) ?>
						</div>
						<div class="td td-item date f-small">
							<i class="fa fa-clock-o" aria-hidden="true"></i>
							<?php echo na_date($list[$i]['wr_datetime'], 'orangered', 'H:i', 'm.d', 'm.d') ?>
						</div>
					</div>
				</div>
				<?php if ($is_admin) { ?>
					<div class="td chk">
						<label for="chk_bn_id_<?php echo $i ?>" class="sound_only"><?php echo $num ?>번</label>
						<input type="checkbox" name="chk_bn_id[]" value="<?php echo $i ?>" id="chk_bn_id_<?php echo $i ?>">
						<input type="hidden" name="bo_table[<?php echo $i ?>]" value="<?php echo $list[$i]['bo_table'] ?>">
						<input type="hidden" name="wr_id[<?php echo $i ?>]" value="<?php echo $list[$i]['wr_id'] ?>">
					</div>
				<?php } ?>
			</li>
		<?php }  ?>
		<?php if ($i == 0) { ?>
			<li class="none">
				게시물이 없습니다.
			</li>
		<?php } ?>
		</ul>
	</div>
	<!-- } 전체게시물 목록 끝 -->
</form>

<!-- 전체게시물 페이지네이션 시작 { -->
<div id="new_page" class="clearfix na-page text-center pg-<?php echo $color ?>">
	<ul class="pagination pagination-sm en">
		<?php echo na_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "?gr_id=$gr_id&amp;view=$view&amp;mb_id=$mb_id&amp;page="); ?>
	</ul>
</div>
<!-- } 전체게시물 페이지네이션 끝 -->

<div class="h20"></div>

<?php if ($is_admin) { ?>
	<script>
	$(function(){
		$('#all_chk').click(function(){
			$('[name="chk_bn_id[]"]').attr('checked', this.checked);
		});
	});

	function fnew_submit(f)
	{
		f.pressed.value = document.pressed;

		var cnt = 0;
		for (var i=0; i<f.length; i++) {
			if (f.elements[i].name == "chk_bn_id[]" && f.elements[i].checked)
				cnt++;
		}

		if (!cnt) {
			alert(document.pressed+"할 게시물을 하나 이상 선택하세요.");
			return false;
		}

		if (!confirm("선택한 게시물을 정말 "+document.pressed+" 하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다")) {
			return false;
		}

		f.action = "./new_delete.php";

		return true;
	}
	</script>
<?php } ?>

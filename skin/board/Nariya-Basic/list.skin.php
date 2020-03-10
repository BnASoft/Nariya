<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 데모
na_list_demo($demo);

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);

$boset['list_skin'] = ($boset['list_skin']) ? $boset['list_skin'] : 'basic';
$list_skin_url = $board_skin_url.'/list/'.$boset['list_skin'];
$list_skin_path = $board_skin_path.'/list/'.$boset['list_skin'];

// 컬러
$bo_color = ($boset['color']) ? $boset['color'] : 'navy';

// 스킨설정
$is_skin_setup = (($is_admin == 'super' || IS_DEMO) && is_file($board_skin_path.'/setup.skin.php')) ? true : false;

// 리스트 헤드
@include_once($list_skin_path.'/list.head.skin.php');

?>

<!-- 게시판 목록 시작 { -->
<div id="bo_list">

	<!-- 검색창 시작 { -->
	<div id="bo_search" class="collapse<?php echo ($boset['search_open'] || $stx) ? ' in' : ''; ?>">
		<div class="bo_search well">
			<form id="fsearch" name="fsearch" method="get" role="form" class="form">
				<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
				<input type="hidden" name="sca" value="<?php echo $sca ?>">
				<div class="row row-15">
					<div class="col-sm-3 col-xs-6 col-15">
						<label for="sfl" class="sound_only">검색대상</label>
						<select name="sfl" class="form-control">
							<?php echo get_board_sfl_select_options($sfl); ?>
						</select>
					</div>
					<div class="col-sm-3 col-xs-6 col-15">
						<select name="sop" class="form-control">
							<option value="and"<?php echo get_selected($sop, "and") ?>>그리고</option>
							<option value="or"<?php echo get_selected($sop, "or") ?>>또는</option>
						</select>	
					</div>
					<div class="col-sm-6 col-xs-12 col-15">
						<div class="h10 visible-xs"></div>
						<label for="stx" class="sound_only">검색어</label>
						<div class="input-group">
							<input type="text" id="bo_stx" name="stx" value="<?php echo stripslashes($stx) ?>" required class="form-control" placeholder="검색어를 입력해 주세요.">
							<div class="input-group-btn">
								<button type="submit" class="btn btn-<?php echo $bo_color ?>" title="검색하기">
									<i class="fa fa-search" aria-hidden="true"></i>
									<span class="sound_only">검색하기</span>
								</button>
								<a href="<?php echo get_pretty_url($bo_table); ?>" class="btn btn-white" title="검색 초기화">
									<i class="fa fa-bars" aria-hidden="true"></i>
									<span class="sound_only">검색 초기화</span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</form>
			<script>
			$(function(){
				$('#bo_search').on('shown.bs.collapse', function () {
					$('#bo_stx').focus();
				});
			});
			</script>
		</div>
	</div>
	<!-- } 검색창 끝 -->

    <?php if ($is_category) { ?>
	    <!-- 게시판 카테고리 시작 { -->
		<style>
			#bo_cate li {<?php echo na_width($boset['cw'], 7) ?>}
			<?php if(_RESPONSIVE_) { // 반응형일 때만 작동 ?>
				@media (max-width:1199px) { 
					.responsive #bo_cate li {<?php echo na_width($boset['cwlg'], 6) ?>}
				}
				@media (max-width:991px) { 
					.responsive #bo_cate li {<?php echo na_width($boset['cwmd'], 5) ?>}
				}
				@media (max-width:767px) { 
					.responsive #bo_cate li {<?php echo na_width($boset['cwsm'], 4) ?>}
				}
				@media (max-width:480px) { 
					.responsive #bo_cate li {<?php echo na_width($boset['cwxs'], 3) ?>}
				}
			<?php } ?>
		</style>
		<nav id="bo_cate" class="na-category">
			<h3 class="sound_only"><?php echo $board['bo_subject'] ?> 카테고리</h3>
			<ul id="bo_cate_ul">
				<?php echo $category_option ?>
			</ul>
			<hr/>
		</nav>
		<!-- } 게시판 카테고리 끝 -->
	<?php } ?>

	<form name="fboardlist" id="fboardlist" action="./board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post" role="form" class="form">
		<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
		<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
		<input type="hidden" name="stx" value="<?php echo $stx ?>">
		<input type="hidden" name="spt" value="<?php echo $spt ?>">
		<input type="hidden" name="sca" value="<?php echo $sca ?>">
		<input type="hidden" name="sst" value="<?php echo $sst ?>">
		<input type="hidden" name="sod" value="<?php echo $sod ?>">
		<input type="hidden" name="page" value="<?php echo $page ?>">
		<input type="hidden" name="sw" value="">

		<!-- 게시판 페이지 정보 및 버튼 시작 { -->
		<div id="bo_btn_top" class="f-small clearfix">
			<ul class="btn_bo_user pull-right">
				<?php if ($admin_href) { ?><li><a href="<?php echo $admin_href ?>" class="btn_admin btn" title="관리자" role="button"><i class="fa fa-cog fa-spin fa-fw" aria-hidden="true"></i><span class="sound_only">관리자</span></a></li><?php } ?>
				<?php if ($rss_href) { ?><li><a href="<?php echo $rss_href ?>" class="btn_b01 btn" title="RSS"><i class="fa fa-rss" aria-hidden="true"></i><span class="sound_only">RSS</span></a></li><?php } ?>
				<li>
					<button type="button" class="btn_b01 btn" title="게시판 검색" data-toggle="collapse" data-target="#bo_search" aria-expanded="false" aria-controls="bo_search"><i class="fa fa-search" aria-hidden="true"></i><span class="sound_only">게시판 검색</span></button>
				</li>
				<?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b01 btn" title="글쓰기" role="button"><i class="fa fa-pencil" aria-hidden="true"></i><span class="sound_only">글쓰기</span></a></li><?php } ?>
				<?php if ($is_admin == 'super' || $is_auth || IS_DEMO) {  ?>
				<li>
					<button type="button" class="btn_more_opt is_list_btn btn_b01 btn" title="게시판 리스트 옵션"><i class="fa fa-ellipsis-v" aria-hidden="true"></i><span class="sound_only">게시판 리스트 옵션</span></button>
					<ul class="more_opt is_list_btn">
						<?php if($is_skin_setup) { ?>
							<li><a href="<?php echo na_setup_href('board', $bo_table) ?>" class="btn-setup"><i class="fa fa-cogs" aria-hidden="true"></i> 스킨설정</a>
						<?php } ?>
						<?php if ($is_checkbox) { ?>
							<li><label class="checkbox-inline"><input type="checkbox" onclick="if (this.checked) all_checked(true); else all_checked(false);">전체선택</label></li>
							<li><button type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value"><i class="fa fa-trash-o" aria-hidden="true"></i> 선택삭제</button></li>
							<li><button type="submit" name="btn_submit" value="선택복사" onclick="document.pressed=this.value"><i class="fa fa-files-o" aria-hidden="true"></i> 선택복사</button></li>
							<li><button type="submit" name="btn_submit" value="선택이동" onclick="document.pressed=this.value"><i class="fa fa-arrows" aria-hidden="true"></i> 선택이동</button></li>
						<?php } ?>
					</ul>
				</li>
				<?php }  ?>
			</ul>
			<div id="bo_list_total" class="pull-left">
				전체 <b><?php echo number_format($total_count) ?></b>건 / <?php echo $page ?>페이지
			</div>
		</div>
		<!-- } 게시판 페이지 정보 및 버튼 끝 -->

		<!-- 게시물 목록 시작 { -->
		<?php 
			// 목록스킨
			if(is_file($list_skin_path.'/list.skin.php')) {
				include_once($list_skin_path.'/list.skin.php');
			} else {
				echo '<div class="well text-center"><i class="fa fa-bell red"></i> 목록스킨('.$boset['list_skin'].')이 존재하지 않습니다.</div>';
			}
		?>
		<!-- } 게시물 목록 끝 -->

		<!-- 페이지 시작 { -->
		<div class="na-page pg-<?php echo $bo_color ?> text-center">
			<ul class="pagination pagination-sm en no-margin">
				<?php if($prev_part_href) { ?>
					<li><a href="<?php echo $prev_part_href;?>">이전검색</a></li>
				<?php } ?>
				<?php echo na_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, get_pretty_url($bo_table, '', $qstr.'&amp;page='));?>
				<?php if($next_part_href) { ?>
					<li><a href="<?php echo $next_part_href;?>">다음검색</a></li>
				<?php } ?>
			</ul>
		</div>
		<!-- } 페이지 끝 -->

		<div class="clearfix"></div>
	</form>

</div>

<?php if ($is_checkbox) { ?>
<noscript>
<p align="center">자바스크립트를 사용하지 않는 경우 별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>

<script>
function all_checked(sw) {
	var f = document.fboardlist;

	for (var i=0; i<f.length; i++) {
		if (f.elements[i].name == "chk_wr_id[]")
			f.elements[i].checked = sw;
	}
}
function fboardlist_submit(f) {
	var chk_count = 0;

	for (var i=0; i<f.length; i++) {
		if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
			chk_count++;
	}

	if (!chk_count) {
		alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
		return false;
	}

	if(document.pressed == "선택복사") {
		select_copy("copy");
		return;
	}

	if(document.pressed == "선택이동") {
		select_copy("move");
		return;
	}

	if(document.pressed == "선택삭제") {
		if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
			return false;

		f.removeAttribute("target");
        f.action = g5_bbs_url+"/board_list_update.php";
	}

	return true;
}

// 선택한 게시물 복사 및 이동
function select_copy(sw) {
	var f = document.fboardlist;

	if (sw == "copy")
		str = "복사";
	else
		str = "이동";

	var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

	f.sw.value = sw;
	f.target = "move";
    f.action = g5_bbs_url+"/move.php";
	f.submit();
}
</script>
<?php } ?>

<?php if ($is_checkbox || IS_DEMO) { ?>
<script>
// 게시판 리스트 관리자 옵션
jQuery(function($){
    $(".btn_more_opt.is_list_btn").on("click", function(e) {
        e.stopPropagation();
        $(".more_opt.is_list_btn").toggle();
    });
    $(document).on("click", function (e) {
        if(!$(e.target).closest('.is_list_btn').length) {
            $(".more_opt.is_list_btn").hide();
        }
    });
});
</script>
<?php } ?>
<!-- } 게시판 목록 끝 -->

<div class="h20"></div>

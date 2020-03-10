<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$qa_skin_url.'/style.css">', 0);

// 스킨 설정값
$wset = na_skin_config('qa');

$color = (isset($wset['color']) && $wset['color']) ? $wset['color'] : NT_COLOR;

// 목록헤드
if(isset($wset['head_skin']) && $wset['head_skin']) {
	add_stylesheet('<link rel="stylesheet" href="'.NA_PLUGIN_URL.'/skin/head/'.$wset['head_skin'].'.css">', 0);
	$head_class = 'list-head';
} else {
	$head_class = (isset($wset['head_color']) && $wset['head_color']) ? 'border-'.$wset['head_color'] : 'border-dark';
}

?>

<!-- 검색 시작 { -->
<div id="bo_search" class="collapse<?php echo ($stx) ? ' in' : ''; ?>">
	<div class="bo-search well">
		<form class="form" role="form" name="fsearch" method="get">
        <input type="hidden" name="sca" value="<?php echo $sca ?>">
	        <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
			<div class="input-group">
				<span class="input-group-addon">
					<i class="fa fa-tags" aria-hidden="true"></i>
				</span>
				<input type="text" name="stx" value="<?php echo stripslashes($stx); ?>" id="qa_stx" required class="form-control" maxlength="15" placeholder="검색어를 입력해주세요.">
				<div class="input-group-btn">
					<button type="submit" class="btn btn-<?php echo $color ?>" title="검색하기">
						<i class="fa fa-search" aria-hidden="true"></i>
						<span class="sound_only">검색하기</span>
					</button>
					<a href="<?php echo G5_BBS_URL ?>/qalist.php" class="btn btn-white" title="검색 초기화">
						<i class="fa fa-bars" aria-hidden="true"></i>
						<span class="sound_only">검색 초기화</span>
					</a>
				</div>
			</div>
		</form>
		<script>
		$(function(){
			$('#qa_search').on('shown.bs.collapse', function () {
				$('#qa_stx').focus();
			});
		});
		</script>
	</div>
</div>
<!-- } 검색 끝 -->

<?php if ($category_option) { ?>
<!-- 카테고리 시작 { -->
<style>
	#bo_cate li {<?php echo na_width($wset['cw'], 7) ?>}
	<?php if(_RESPONSIVE_) { // 반응형일 때만 작동 ?>
		@media (max-width:1199px) { 
			.responsive #bo_cate li {<?php echo na_width($wset['cwlg'], 6) ?>}
		}
		@media (max-width:991px) { 
			.responsive #bo_cate li {<?php echo na_width($wset['cwmd'], 5) ?>}
		}
		@media (max-width:767px) { 
			.responsive #bo_cate li {<?php echo na_width($wset['cwsm'], 4) ?>}
		}
		@media (max-width:480px) { 
			.responsive #bo_cate li {<?php echo na_width($wset['cwxs'], 3) ?>}
		}
	<?php } ?>
</style>
<nav id="bo_cate" class="na-category">
	<h3 class="sound_only"><?php echo $qaconfig['qa_title'] ?> 카테고리</h3>
	<ul id="bo_cate_ul">
		<?php echo $category_option ?>
	</ul>
	<hr/>
</nav>
<!-- } 카테고리 끝 -->
<?php } ?>

<div id="bo_list">

    <form name="fqalist" id="fqalist" action="./qadelete.php" onsubmit="return fqalist_submit(this);" method="post">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="sca" value="<?php echo $sca; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">

	<!-- 게시판 페이지 정보 및 버튼 시작 { -->
	<div id="bo_btn_top" class="f-small">
		<div class="clearfix">
			<ul class="btn_bo_user pull-right">
				<?php if ($is_checkbox) { ?>
				<li>
					<button type="submit" name="btn_submit" value="선택삭제" title="선택삭제" onclick="document.pressed=this.value" class="btn_b01 btn">
						<i class="fa fa-trash-o" aria-hidden="true"></i>
						<span class="sound_only">선택삭제</span>
					</button>
				</li>
				<?php } ?>
				<?php if($admin_href || IS_DEMO) { ?>
					<?php if ($admin_href) { ?>
					<li>
						<a href="<?php echo $admin_href ?>" class="btn_admin btn" title="관리자">
							<i class="fa fa-cog fa-spin fa-fw" aria-hidden="true"></i>
							<span class="sound_only">관리자</span>
						</a>
					</li>
					<?php } ?>
					<?php if(is_file($qa_skin_path.'/setup.skin.php')) { ?>
					<li>
						<a href="<?php echo na_setup_href('qa') ?>" title="스킨설정" class="btn_b01 btn btn-setup">
							<i class="fa fa-cogs" aria-hidden="true"></i></a>
							<span class="sound_only">스킨설정</span>
						</a>
					</li>
					<?php } ?>
				<?php } ?>
				<li>
					<button type="button" class="btn_b01 btn" title="검색" data-toggle="collapse" data-target="#bo_search" aria-expanded="false" aria-controls="bo_search">
						<i class="fa fa-search" aria-hidden="true"></i>
						<span class="sound_only">검색</span>
					</button>
				</li>
				<?php if ($write_href) { ?>
				<li>
					<a href="<?php echo $write_href ?>" class="btn_b01 btn" title="문의등록">
						<i class="fa fa-pencil" aria-hidden="true"></i>
						<span class="sound_only">문의등록</span>
					</a>
				</li>
				<?php } ?>
			</ul>
			<div id="bo_list_total" class="pull-left">
				전체 <b><?php echo number_format($total_count) ?></b>건 / <?php echo $page ?>페이지
			</div>
		</div>
	</div>
	<!-- } 게시판 페이지 정보 및 버튼 끝 -->
	
	<div class="div-head <?php echo $head_class ?> f-small">
		<span class="num hidden-xs">번호</span>
		<span class="status">상태</span>
		<span class="subj">제목</span>
		<span class="name hidden-xs">이름</span>
		<span class="date hidden-xs">날짜</span>
		<?php if ($is_checkbox) { ?>
		<span class="chk">
			<label for="all_chk" class="sound_only">목록 전체 선택</label>
			<input type="checkbox" id="all_chk">
		</span>
		<?php } ?>
	</div>
	<ul>
	<?php
	$list_cnt = count($list);
	for ($i=0; $i<$list_cnt; $i++) {
	?>
	<li class="tr">
		<div class="td num hidden-xs f-small">
			<?php echo $list[$i]['num']; ?>
		</div>
		<div class="td status text-muted f-small">
			<?php echo ($list[$i]['qa_status']) ? '<span class="orangered">완료</span>' : '대기'; ?>
		</div>
		<div class="td subj">
			<div class="tr">
				<div class="td td-subj">
					<a href="<?php echo $list[$i]['view_href'] ?>" class="ellipsis">
						<?php echo $list[$i]['subject'] ?>
					</a>
				</div>
				<div class="td td-item name f-small">
					<?php echo na_name_photo($list[$i]['mb_id'], get_sideview($list[$i]['mb_id'], $list[$i]['qa_name'], $list[$i]['qa_email'], '')) ?>
				</div>
				<div class="td td-item date f-small">
					<i class="fa fa-clock-o" aria-hidden="true"></i>
					<?php echo na_date($list[$i]['qa_datetime'], 'orangered', 'H:i', 'm.d', 'Y.m.d') ?>
				</div>
			</div>
		</div>
		<?php if ($is_checkbox) { ?>
		<div class="td chk">
			<input type="checkbox" name="chk_qa_id[]" value="<?php echo $list[$i]['qa_id'] ?>" id="chk_qa_id_<?php echo $i ?>">
		</div>
		<?php } ?>
	</li>
	<?php }	?>
	<?php if ($i == 0) { echo '<li class="tr"><div class="td empty_list">게시물이 없습니다.</div></li>'; } ?>
	</ul>

	<!-- 페이지 -->
	<div class="na-page text-center pg-<?php echo $color ?>">
		<ul class="pagination pagination-sm en">
			<?php echo preg_replace('/(\.php)(&amp;|&)/i', '$1?', na_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, './qalist.php'.$qstr.'&amp;page='));?>
		</ul>
	</div>
	<!-- 페이지 -->
	
    </form>
</div>

<div class="h30"></div>

<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<?php if ($is_checkbox) { ?>
<script>
$(function(){
	$('#all_chk').click(function(){
		$('[name="chk_qa_id[]"]').attr('checked', this.checked);
	});
});

function fqalist_submit(f) {
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_qa_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택삭제") {
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다"))
            return false;
    }

    return true;
}
</script>
<?php } ?>
<!-- } 게시판 목록 끝 -->
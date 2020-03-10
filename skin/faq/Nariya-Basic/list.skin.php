<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$faq_skin_url.'/style.css">', 0);

// 스킨 설정값
$wset = na_skin_config('faq');

$color = (isset($wset['color']) && $wset['color']) ? $wset['color'] : NT_COLOR;

?>

<!-- FAQ 시작 { -->
<?php
if ($himg_src)
    echo '<div id="faq_himg" class="faq_img"><img src="'.$himg_src.'" alt=""></div>';

// 상단 HTML
echo '<div id="faq_hhtml">'.conv_content($fm['fm_head_html'], 1).'</div>';
?>

<!-- FAQ 검색 시작 { -->
<div id="faq_search" class="collapse<?php echo ($stx) ? ' in' : ''; ?>">
	<div class="faq-search well">
	    <form class="form" role="form" name="faq_search_form" method="get">
	    <input type="hidden" name="fm_id" value="<?php echo $fm_id;?>">
			<div class="input-group">
				<span class="input-group-addon">
					<i class="fa fa-tags" aria-hidden="true"></i>
				</span>
				<label for="faq_stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
			    <input type="text" name="stx" value="<?php echo $stx; ?>" id="faq_stx" class="form-control" placeholder="검색어">
				<div class="input-group-btn">
					<button type="submit" class="btn btn-<?php echo $color ?>" title="검색하기">
						<i class="fa fa-search" aria-hidden="true"></i>
						<span class="sound_only">검색하기</span>
					</button>
					<a href="<?php echo G5_BBS_URL ?>/faq.php?fm_id=<?php echo $fm_id ?>" class="btn btn-white" title="검색 초기화">
						<i class="fa fa-bars" aria-hidden="true"></i>
						<span class="sound_only">검색 초기화</span>
					</a>
				</div>
			</div>
		</form>
		<script>
		$(function(){
			$('#faq_search').on('shown.bs.collapse', function () {
				$('#faq_stx').focus();
			});
		});
		</script>
	</div>
</div>
<!-- } FAQ 검색 끝 -->

<!-- FAQ 분류 시작 { -->
<style>
	#bo_cate li {<?php echo na_width($wset['cw'], 5) ?>}
	<?php if(_RESPONSIVE_) { // 반응형일 때만 작동 ?>
		@media (max-width:1199px) { 
			.responsive #bo_cate li {<?php echo na_width($wset['cwlg'], 5) ?>}
		}
		@media (max-width:991px) { 
			.responsive #bo_cate li {<?php echo na_width($wset['cwmd'], 4) ?>}
		}
		@media (max-width:767px) { 
			.responsive #bo_cate li {<?php echo na_width($wset['cwsm'], 3) ?>}
		}
		@media (max-width:480px) { 
			.responsive #bo_cate li {<?php echo na_width($wset['cwxs'], 2) ?>}
		}
	<?php } ?>
</style>
<nav id="bo_cate" class="na-category">
	<h2 class="sound_only">자주하시는질문 분류</h2>
	<ul id="bo_cate_ul">
		<?php
		foreach( $faq_master_list as $v ){
			$category_msg = '';
			$category_option = '';
			if($v['fm_id'] == $fm_id){ // 현재 선택된 카테고리라면
				$category_option = ' id="bo_cate_on"';
				$category_msg = '<span class="sound_only">열린 분류 </span>';
			}
		?>
		<li>
			<a href="<?php echo $category_href;?>?fm_id=<?php echo $v['fm_id'];?>" <?php echo $category_option;?>>
				<?php echo $category_msg.$v['fm_subject'];?>
			</a>
		</li>
		<?php } ?>
	</ul>
	<hr/>
</nav>
<!-- } FAQ 분류 끝 -->

<!-- 페이지 정보 및 버튼 시작 { -->
<div id="faq_btn_top" class="clearfix f-small">
	<div class="pull-right">
		<?php if($admin_href || IS_DEMO) { ?>
			<?php if($admin_href) { ?>
				<a href="<?php echo $admin_href ?>" title="FAQ 수정" class="btn_admin btn pull-right">
					<i class="fa fa-cog fa-spin fa-fw" aria-hidden="true"></i>
					<span class="sound_only">FAQ 수정</span>
				</a>
			<?php } ?>
			<?php if(is_file($faq_skin_path.'/setup.skin.php')) { ?>
				<a href="<?php echo na_setup_href('faq') ?>" title="스킨설정" class="btn_b01 btn btn-setup pull-right">
					<i class="fa fa-cogs" aria-hidden="true"></i>
					<span class="sound_only">스킨설정</span>
				</a>
			<?php } ?>
		<?php } ?>
		<button type="button" class="btn_b01 btn pull-right" title="FAQ 검색" data-toggle="collapse" data-target="#faq_search" aria-expanded="false" aria-controls="faq_search">
			<i class="fa fa-search" aria-hidden="true"></i>
			<span class="sound_only">FAQ 검색</span>
		</button>
	</div>
	<div id="faq_list_total" class="pull-left">
		전체 <b><?php echo number_format($total_count) ?></b>건 / <?php echo $page ?>페이지
	</div>
</div>
<!-- } 페이지 정보 및 버튼 끝 -->

<div id="faq_wrap" class="faq_<?php echo $fm_id; ?>">
    <?php // FAQ 내용
    if( count($faq_list) ){
    ?>
    <section id="faq_con">
        <h2 class="sound_only"><?php echo $g5['title']; ?> 목록</h2>
        <ol>
            <?php
            foreach($faq_list as $key=>$v){
                if(empty($v))
                    continue;
            ?>
            <li>
                <div class="tr faq-toggle cursor">
					<span class="td faq-head">
						<i class="fa fa-question-circle fa-lg" aria-hidden="true"></i>
					</span>
					<span class="td">
	                	<?php echo conv_content($v['fa_subject'], 1); ?>
					</span>
					<span class="td faq-tail">
						<i class="fa fa-chevron-down fa-fw" aria-hidden="true"></i>
					</span>
                </div>
                <div class="faq-content">
                    <?php echo conv_content($v['fa_content'], 1); ?>
                </div>
            </li>
            <?php
            }
            ?>
        </ol>
    </section>
    <?php

    } else {
        if($stx){
            echo '<p class="empty_list">검색된 게시물이 없습니다.</p>';
        } else {
            echo '<div class="empty_list">등록된 FAQ가 없습니다.';
            if($is_admin)
                echo '<br><a href="'.G5_ADMIN_URL.'/faqmasterlist.php">FAQ를 새로 등록하시려면 FAQ관리</a> 메뉴를 이용하십시오.';
            echo '</div>';
        }
    }
    ?>
</div>

<?php if($total_count) { ?>
	<div id="faq_page" class="clearfix na-page text-center pg-<?php echo $color ?>">
		<ul class="pagination pagination-sm en">
			<?php echo na_paging($page_rows, $page, $total_page, $_SERVER['SCRIPT_NAME'].'?'.$qstr.'&amp;page='); ?>
		</ul>
	</div>
<?php }?>

<?php 
	 // 하단 HTML
	echo '<div id="faq_thtml" class="faq-html">'.$faq_tail_html.'</div>';

	if ($timg_src) 
		echo '<div id="faq_timg" class="faq-img"><img src="'.$timg_src.'" alt=""></div>';

?>

<script>
$(document).ready(function () {
	$(document).on('click', '#faq_wrap .faq-toggle', function () {
		var $toggle = $(this).parent().children('.faq-content');
		var $css = $toggle.css("display");

		if($css == 'none') {
			$(this).addClass('on');
		} else {
			$(this).removeClass('on');
		}

		$toggle.toggle(200);
	});
});
</script>

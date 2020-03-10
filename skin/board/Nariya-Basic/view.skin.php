<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// SyntaxHighLighter
if(isset($boset['na_code']) && $boset['na_code'])
	na_script('code');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);

// 컬러
$bo_color = ($boset['color']) ? $boset['color'] : 'navy';

// SEO 이미지
$view['seo_img'] = na_wr_img($bo_table, $view);

// SEO 등과 공용사용
$view_subject = get_text($view['wr_subject']);

?>

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

<!-- 게시물 읽기 시작 { -->

<article id="bo_v">
    <header>
		<?php if ($category_name) { ?>
			<div class="bo_v_cate f-small">
				<span class="sound_only">분류</span>
				<?php echo $view['ca_name'] ?>
			</div>
		<?php } ?>
		<h2 id="bo_v_title" class="f-lg">
            <?php echo $view_subject; // 글제목 출력 ?>
        </h2>
    </header>
    <section id="bo_v_info">
        <h3 class="sound_only">페이지 정보</h3>
		<div class="profile-info f-small">
			<div class="pull-left">
				<span class="sound_only">작성자</span>
				<?php echo na_name_photo($view['mb_id'], $view['name']); ?>
				<?php if ($is_ip_view) { ?>
					<span class="space-fa">
						<span class="sound_only">아이피</span>
						<i class="fa fa-map-marker cursor" aria-hidden="true" title="<?php echo $ip ?>" data-toggle="tooltip" data-placement="top"></i> 						
					</span>
				<?php } ?>
			</div>
			<div class="pull-right text-muted">
				<span class="sound_only">작성일</span>
				<i class="fa fa-clock-o" aria-hidden="true"></i> 
				<time datetime="<?php echo date('Y-m-d\TH:i:s+09:00', strtotime($view['wr_datetime'])) ?>"><?php echo date("Y.m.d H:i", strtotime($view['wr_datetime'])) ?></time>
			</div>
			<div class="clearfix"></div>
		</div>

		<div class="content-info f-small">
        	<div class="pull-left">
				<span class="space-right">
					<span class="sound_only">조회</span>
					<i class="fa fa-eye" aria-hidden="true"></i>
					<?php echo number_format($view['wr_hit']) ?>
				</span>
				 <?php if($view['wr_comment']) { ?>
					<span class="space-right">
						<a href="#bo_vc">       		 	
							<span class="sound_only">댓글</span>
							 <i class="fa fa-commenting-o" aria-hidden="true"></i>
							 <b class="orangered"><?php echo number_format($view['wr_comment']) ?></b>
						 </a>
					</span>
				 <?php } ?>
			</div>
        	<div class="pull-right">
				<!-- 게시물 상단 버튼 시작 { -->
				<div id="bo_v_btn">
					<?php ob_start(); ?>

					<ul class="btn_bo_user bo_v_com">
						<li>
							<a href="<?php echo $list_href ?>" class="btn_b01 btn" title="목록" role="button">
								<i class="fa fa-list" aria-hidden="true"></i>
								<span class="sound_only">목록</span>
							</a>
						</li>
						<?php if ($reply_href) { ?>
							<li>
								<a href="<?php echo $reply_href ?>" class="btn_b01 btn" title="답변" role="button">
									<i class="fa fa-reply" aria-hidden="true"></i>
									<span class="sound_only">답변</span>
								</a>
							</li>
						<?php } ?>
						<?php if ($write_href) { ?>
							<li>
								<a href="<?php echo $write_href ?>" class="btn_b01 btn" title="글쓰기" role="button">
									<i class="fa fa-pencil" aria-hidden="true"></i>
									<span class="sound_only">글쓰기</span>
								</a>
							</li>
						<?php } ?>
						<?php if($update_href || $delete_href || $copy_href || $move_href || $search_href) { ?>
						<li>
							<button type="button" class="btn_more_opt is_view_btn btn_b01 btn"><i class="fa fa-ellipsis-v" aria-hidden="true"></i><span class="sound_only">게시판 리스트 옵션</span></button>
							<ul class="more_opt is_view_btn"> 
								<?php if ($update_href) { ?>
									<li>
										<a href="<?php echo $update_href ?>">
											<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
											글수정
										</a>
									</li>
								<?php } ?>
								<?php if ($delete_href) { ?>
									<li>
										<a href="<?php echo $delete_href ?>" onclick="del(this.href); return false;">
											<i class="fa fa-trash-o" aria-hidden="true"></i>
											글삭제
										</a>
									</li>
								<?php } ?>
								<?php if ($copy_href) { ?>
									<li>
										<a href="<?php echo $copy_href ?>" onclick="board_move(this.href); return false;">
											<i class="fa fa-files-o" aria-hidden="true"></i>
											글복사		
										</a>
									</li>
								<?php } ?>
								<?php if ($move_href) { ?>
									<li>
										<a href="<?php echo $move_href ?>" onclick="board_move(this.href); return false;">
											<i class="fa fa-arrows" aria-hidden="true"></i>
											글이동
										</a>
									</li>
								<?php } ?>
								<?php if ($search_href) { ?>
									<li>
										<a href="<?php echo $search_href ?>">
											<i class="fa fa-search" aria-hidden="true"></i>
											글검색
										</a>
									</li>
								<?php } ?>
							</ul> 
						</li>
						<?php } ?>
					</ul>
					<?php
					$link_buttons = ob_get_contents();
					ob_end_flush();
					?>
					<script>
					jQuery(function($){
						// 게시판 보기 버튼 옵션
						$(".btn_more_opt.is_view_btn").on("click", function(e) {
							e.stopPropagation();
							$(".more_opt.is_view_btn").toggle();
						})
		;
						$(document).on("click", function (e) {
							if(!$(e.target).closest('.is_view_btn').length) {
								$(".more_opt.is_view_btn").hide();
							}
						});
					});
					</script>
				</div>
				<!-- } 게시물 상단 버튼 끝 -->
			</div>
			<div class="clearfix"></div>
		</div>
    </section>

    <section id="bo_v_atc">
        <h3 class="sound_only">본문</h3>
        <!-- 본문 내용 시작 { -->
        <div id="bo_v_con" class="f-content">

			<?php if(IS_NA_BBS && $is_admin && $view['as_type'] == "-1") { // 신고처리 ?>
				<p class="shingo">신고처리된 게시물입니다.</p>
			<?php } ?>

			<?php
				// 첨부 동영상 출력 - 이미지출력보다 위에 있어야 함
				if($boset['na_video_attach'])
					echo na_video_attach();

				// 링크 동영상 출력
				if($boset['na_video_link'])
					echo na_video_link($view['link']);

				// 이미지 출력
				$v_img_count = count($view['file']);
				if($v_img_count) {
					echo "<div id=\"bo_v_img\">\n";
					for ($i=0; $i<=$v_img_count; $i++) {
						echo get_file_thumbnail($view['file'][$i]);
					}
					echo "</div>\n";
				}

				// 글내용 출력
				echo na_content(get_view_thumbnail($view['content']));
				//echo na_content($view['rich_content']); // {이미지:0} 과 같은 코드를 사용할 경우
			?>
		</div>
        <!-- } 본문 내용 끝 -->

		<?php if($board['bo_use_good'] || $board['bo_use_nogood'] || $scrap_href || $board['bo_use_sns']) { ?>
			<div id="bo_v_btn_group">
				<div class="btn-group btn-group-lg" role="group">
					<?php if ($board['bo_use_good']) { // 추천 ?>
						<button type="button" onclick="na_good('<?php echo $bo_table ?>', '<?php echo $wr_id ?>', 'good', 'wr_good');" class="btn btn-white" title="추천">
							<i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
							<span class="sound_only">추천</span>
							<b id="wr_good" class="orangered"><?php echo number_format($view['wr_good']) ?></b>
						</button>
					<?php } ?>

					<?php if ($board['bo_use_nogood']) { // 비추천 ?>
						<button type="button" onclick="na_good('<?php echo $bo_table ?>', '<?php echo $wr_id ?>', 'nogood', 'wr_nogood');" class="btn btn-white" title="비추천">
							<i class="fa fa-thumbs-o-down" aria-hidden="true"></i>
							<span class="sound_only">비추천</span>
							<b id="wr_nogood"><?php echo number_format($view['wr_nogood']) ?></b>
						</button>
					<?php } ?>
					<?php if ($scrap_href) { // 스크랩 ?>
						<button type="button" class="btn btn-white" onclick="win_scrap('<?php echo $scrap_href ?>');" title="스크랩">
							<i class="fa fa-bookmark" aria-hidden="true"></i>
							<span class="sound_only">스크랩</span>
						</button>
					<?php } ?>

					<?php if($board['bo_use_sns']) { // SNS 공유 ?>
						<button type="button" class="btn btn-white" data-toggle="modal" data-target="#bo_snsModal" title="SNS 공유">
							<i class="fa fa-share-alt" aria-hidden="true"></i>
							<span class="sound_only">SNS 공유</span>
						</button>
					<?php } ?>
					<?php if (IS_NA_BBS && $boset['na_shingo']) { // 신고 ?>
						<button type="button" class="btn btn-white" onclick="na_shingo('<?php echo $bo_table ?>', '<?php echo $wr_id ?>');" title="신고">
							<i class="fa fa-ban" aria-hidden="true"></i>
							<span class="sound_only">신고</span>
						</button>
					<?php } ?>
				</div>
			</div>
		<?php } ?>
		<?php if($view['as_tag']) { // 태그 ?>
			<p class="bo_v_tags">
				<i class="fa fa-tags light" aria-hidden="true"></i>
				<?php echo na_get_tag($view['as_tag']) ?>
			</p>
		<?php } ?>

		<?php 
			// 서명 애드온 : /plugin/nariya/skin/addon/sign-basic 폴더	
			if ($is_signature && $signature) 
				echo na_addon('sign-basic'); 
		?>

	</section>

    <section id="bo_v_data" class="f-small">
        <h3 class="sound_only">관련자료</h3>
		<ul>
		<?php if(isset($view['link'][1]) && $view['link'][1]) { ?>
	    <!-- 관련링크 시작 { -->
		<li class="tr">
			<div class="td td-th">
				링크
			</div>
			<div class="td">
				<?php
				// 링크
				$cnt = 0;
				for ($i=1; $i<=count($view['link']); $i++) {
					if ($view['link'][$i]) {
						$cnt++;
					?>
					<p>
						<a href="<?php echo $view['link_href'][$i] ?>" target="_blank">
							<i class="fa fa-link td-first light" aria-hidden="true"></i>
							<?php echo get_text($view['link'][$i]) ?>
							<?php if($view['link_hit'][$i]) { ?>
								<span class="sound_only">방문</span>
								<span class="count orangered">+<?php echo $view['link_hit'][$i] ?></span>
							<?php } ?>
						</a>
					</p>	
					<?php
					}
				}
				?>
			</div>
		</li>
	    <!-- } 관련링크 끝 -->
		<?php } ?>
    
		<?php
		$cnt = 0;
		if ($view['file']['count']) {
			for ($i=0; $i<count($view['file']); $i++) {
				if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view'])
					$cnt++;
			}
		}
		?>

		<?php if($cnt) { ?>
		<!-- 첨부파일 시작 { -->
		<li class="tr">
			<div class="td td-th">
				첨부
			</div>
			<div class="td">
				<?php
				// 가변 파일
				for ($i=0; $i<count($view['file']); $i++) {
					if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view']) {
				?>
				<p>
					<a href="<?php echo $view['file'][$i]['href'] ?>" class="view_file_download" title="<?php echo $view['file'][$i]['content'] ?>">
						<i class="fa fa-download td-first light" aria-hidden="true"></i>
						<?php echo $view['file'][$i]['source'] ?>
						<span class="sound_only">파일크기</span>
						(<?php echo $view['file'][$i]['size'] ?>)
						<span class="light">
							-
							<span class="sound_only">등록일</span>
							<?php echo date("Y.m.d H:i", strtotime($view['file'][$i]['datetime'])) ?>
						</span>
						<?php if($view['file'][$i]['download']) { ?>
							<span class="sound_only">다운로드</span>
							<span class="count orangered">+<?php echo $view['file'][$i]['download'] ?></span>
						<?php } ?>
					</a>
				</p>
				<?php
					}
				}
				?>
			</div>
		</li>
		<!-- } 첨부파일 끝 -->
		<?php } ?>

		<?php if ($prev_href) { ?>
		<!-- 이전글 시작 { -->
		<li class="tr">
			<div class="td td-th">
				이전
			</div>
			<div class="td">
				<a href="<?php echo $prev_href ?>">
					<i class="fa fa-chevron-up td-first light" aria-hidden="true"></i>
					<?php echo $prev_wr_subject;?>
					<span class="light">
						-
						<span class="sound_only">작성일</span>
						<?php echo date("Y.m.d H:i", strtotime($prev_wr_date)) ?>
					</span>
				</a>
			</div>
		</li>
		<!-- } 이전글 끝 -->
		<?php } ?>		

		<?php if ($next_href) { ?>
		<!-- 다음글 시작 { -->
		<li class="tr">
			<div class="td td-th">
				다음
			</div>
			<div class="td">
				<a href="<?php echo $next_href ?>">
					<i class="fa fa-chevron-down td-first light" aria-hidden="true"></i>
					<?php echo $next_wr_subject;?>
					<span class="light">
						-
						<span class="sound_only">작성일</span>
						<?php echo date("Y.m.d H:i", strtotime($next_wr_date)) ?>
					</span>
				</a>
			</div>
		</li>
		<!-- } 다음글 끝 -->
		<?php } ?>		
		</ul>
	</section>

    <?php
    // 코멘트 입출력
	$is_ajax_comment = false;
	if(isset($boset['na_crows']) && $boset['na_crows']) { // 페이징 댓글
	    include_once(NA_PLUGIN_PATH.'/comment_view.php');
	} else {
		include_once(G5_BBS_PATH.'/view_comment.php');
	}
	?>

	<?php echo $link_buttons; // 버튼 출력 ?>

	<div class="clearfix"></div>
</article>
<!-- } 게시판 읽기 끝 -->

<script>
function board_move(href) {
    window.open(href, "boardmove", "left=50, top=50, width=500, height=550, scrollbars=1");
}

$(function() {
	<?php if ($board['bo_download_point'] < 0) { ?>
	$("a.view_file_download").click(function() {
        if(!g5_is_member) {
            alert("다운로드 권한이 없습니다.\n회원이시라면 로그인 후 이용해 보십시오.");
            return false;
        }

        var msg = "파일을 다운로드 하시면 포인트가 차감(<?php echo number_format($board['bo_download_point']) ?>점)됩니다.\n\n포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.\n\n그래도 다운로드 하시겠습니까?";

        if(confirm(msg)) {
            var href = $(this).attr("href")+"&js=on";
            $(this).attr("href", href);

            return true;
        } else {
            return false;
        }
    });
	<?php } ?>
	$("a.view_image").click(function() {
        window.open(this.href, "large_image", "location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no");
        return false;
    });

    // 이미지 리사이즈
    $("#bo_v_con").viewimageresize();
});
</script>
<!-- } 게시글 읽기 끝 -->

<?php if($board['bo_use_sns']) { ?>
<!-- SNS 공유창 시작 { -->
<div class="modal fade" id="bo_snsModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<ul class="list-group">
		<li class="list-group-item bg-navy no-border">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="white">&times;</span></button>
			<b>SNS 공유</b>
		</li>
		<li class="list-group-item no-border">
			<div id="bo_v_sns_icon">
				<?php echo na_sns_share_icon('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], $view_subject, $view['seo_img']); ?>
			</div>
		</li>
		</ul>
	</div>
</div>
<!-- } SNS 공유창 끝 -->
<?php } ?>
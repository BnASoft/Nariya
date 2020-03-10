<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$qa_skin_url.'/style.css">', 0);

// 스킨 설정값
$wset = na_skin_config('qa');

$color = (isset($wset['color']) && $wset['color']) ? $wset['color'] : NT_COLOR;
?>

<!-- 게시물 읽기 시작 { -->

<article id="bo_v">
    <header>
		<h2 id="bo_v_title">
            <?php echo $view['subject']; // 글제목 출력 ?>
        </h2>
    </header>

    <section id="bo_v_info">
        <h3 class="sound_only">페이지 정보</h3>
		<div class="profile-info f-small">
			<div class="pull-left">
				<span class="sound_only">작성자</span>
				<?php echo na_name_photo($view['mb_id'], get_sideview($view['mb_id'], $view['qa_name'], $view['qa_email'], '')) ?>
			</div>
			<div class="pull-right text-muted">
				<span class="sound_only">작성일</span>
				<i class="fa fa-clock-o" aria-hidden="true"></i> 
				<time datetime="<?php echo date('Y-m-d\TH:i:s+09:00', strtotime($view['qa_datetime'])) ?>"><?php echo date("Y.m.d H:i", strtotime($view['qa_datetime'])) ?></time>
			</div>
			<div class="clearfix"></div>
		</div>

		<div class="content-info f-small">
		    <?php if($view['email'] || $view['hp']) { ?>
        	<div class="pull-left">
	            <?php if($view['email']) { ?>
				<span class="space-right">
		            <span class="sound_only">이메일</span>
					<i class="fa fa-envelope-o" aria-hidden="true"></i>
					<?php echo $view['email']; ?>
				</span>
				<?php } ?>
	            <?php if($view['hp']) { ?>
				<span class="space-right">
		            <span class="sound_only">휴대폰</span>
					<i class="fa fa-phone" aria-hidden="true"></i>
					<?php echo $view['hp']; ?>
				</span>
				<?php } ?>
			</div>
	        <?php } ?>
        	<div class="pull-right">
				<!-- 게시물 상단 버튼 시작 { -->
				<div id="bo_v_btn">
					<?php
					ob_start();
					?>
					<ul class="bo_v_com">
						<li><a href="<?php echo $list_href ?>" class="btn_b01 btn" title="목록"><i class="fa fa-list" aria-hidden="true"></i><span class="sound_only">목록</span></a></li>
						<?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b01 btn" title="글쓰기"><i class="fa fa-pencil" aria-hidden="true"></i><span class="sound_only">글쓰기</span></a></li><?php } ?>
						<?php if ($update_href || $delete_href) { ?>
						<li>
							<button type="button" class="btn_more_opt is_view_btn btn_b01 btn" title="게시판 읽기 옵션"><i class="fa fa-ellipsis-v" aria-hidden="true"></i><span class="sound_only">게시판 읽기 옵션</span></button>
							<ul class="more_opt is_view_btn">
								<?php if ($update_href) { ?>
								<li>
									<a href="<?php echo $update_href ?>" title="수정">
										글수정
									</a>
								</li>
								<?php } ?>
								<?php if ($delete_href) { ?>
								<li>
									<a href="<?php echo $delete_href ?>" onclick="del(this.href); return false;" title="삭제">
										글삭제
									</a>
								</li>
							<?php } ?>
							</ul>
						</li>
						<?php } ?>
					</ul>
					<script>
					$(function($){
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
					<?php
					$link_buttons = ob_get_contents();
					ob_end_flush();
					?>
				</div>
				<!-- } 게시물 상단 버튼 끝 -->
			</div>
			<div class="clearfix"></div>
		</div>
    </section>


    <section id="bo_v_atc">
        <h3 class="sound_only">본문</h3>

		<div id="bo_v_con" class="f-content">
			<?php
				// 파일 출력
				if($view['img_count']) {
					echo "<div id=\"bo_v_img\">\n";

					for ($i=0; $i<$view['img_count']; $i++) {
						echo get_view_thumbnail($view['img_file'][$i], $qaconfig['qa_image_width']);
					}

					echo "</div>\n";
				}
				echo na_content(get_view_thumbnail($view['content'], $qaconfig['qa_image_width']));
			?>
		</div>

		<?php if($view['download_count']) { ?>
		<!-- 첨부파일 시작 { -->
		<section id="bo_v_file" class="f-small">
			<h3 class="sound_only">첨부파일</h3>
			<?php
			// 가변 파일
			for ($i=0; $i<$view['download_count']; $i++) {
			?>
				<p class="ellipsis light">
					첨부파일 :	
					<a href="<?php echo $view['download_href'][$i];  ?>" class="view_file_download">
						<?php echo $view['download_source'][$i] ?>
					</a>
				</p>
			<?php } ?>
		</section>
		<!-- } 첨부파일 끝 -->
		<?php } ?>
	</section>
    
    <?php
    // 질문글에서 답변이 있으면 답변 출력, 답변이 없고 관리자이면 답변등록폼 출력
    if(!$view['qa_type']) {
        if($view['qa_status'] && $answer['qa_id'])
            include_once($qa_skin_path.'/view.answer.skin.php');
        else
            include_once($qa_skin_path.'/view.answerform.skin.php');
    }
    ?>

    <?php if($view['rel_count']) { ?>

	<div class="h20"></div>

	<section id="bo_v_rel">
		<ul class="list-group f-small">
			<li class="list-group-item bg-light">
		        <b>연관질문</b>
			</li>
			<li class="list-group-item" style="border:0">
				<ul class="bo_v_rel">
				<?php for($i=0; $i<$view['rel_count']; $i++) { ?>
				<li>
					<span class="pull-right light">&nbsp; <?php echo $rel_list[$i]['date']; ?></span>
					<a href="<?php echo $rel_list[$i]['view_href']; ?>">
						<span class="light"><?php echo ($rel_list[$i]['qa_status']) ? '<span class="orangered">완료</span>' : '대기'; ?> |</span>
						<?php echo $rel_list[$i]['subject']; ?>
					</a>
				</li>
				<?php } ?>
				</ul>
            </li>
        </ul>
    </section>
    <?php } ?>

</article>
<!-- } 게시판 읽기 끝 -->

<script>
$(function() {
    $("a.view_image").click(function() {
        window.open(this.href, "large_image", "location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no");
        return false;
    });
});
</script>
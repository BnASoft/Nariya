<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>

<section id="bo_v_ans">
    <h3 class="sound_only">답변</h3>
	<ul class="list-group">
		<li class="list-group-item bg-light">
			<b><?php echo get_text($answer['qa_subject']); ?></b>
		</li>
		<li class="list-group-item" style="border-top:0">
			<div class="clearfix f-small light">
				<div class="pull-left">
					<i class="fa fa-clock-o" aria-hidden="true"></i>
					<?php echo na_date($answer['qa_datetime'], 'orangered', 'H:i', 'm.d', 'Y.m.d') ?>
				</div>
				<?php if ( $answer_update_href || $answer_delete_href ){ ?>
				<div class="pull-right">
					<?php if($answer_update_href) { ?>
						<a href="<?php echo $answer_update_href; ?>"><span class="light">수정</span></a>
					<?php } ?>
					<?php if($answer_delete_href) { ?>
						&nbsp;
						<a href="<?php echo $answer_delete_href; ?>" onclick="del(this.href); return false;"><span class="light">삭제</span></a>
					<?php } ?>	
				</div>
				<?php } ?>
			</div>
			<div id="ans_con">
				<?php echo na_content(get_view_thumbnail(conv_content($answer['qa_content'], $answer['qa_html']), $qaconfig['qa_image_width'])); ?>
			</div>
		</li>
	</ul>
</section>

<div class="tr">
	<div class="td bo_prev_next text-left">
	<?php if ($prev_href) { ?>
		<a href="<?php echo $prev_href ?>" class="btn btn-sm btn-white">
			<i class="fa fa-chevron-left light" aria-hidden="true"></i>
			이전
		</a>
	<?php } ?>
	</div>
	<div class="td text-center">
		<a href="<?php echo $rewrite_href; ?>" class="btn btn-sm btn-<?php echo $color ?>">
			추가문의
		</a>  
	</div>
	<div class="td bo_prev_next text-right">
	<?php if ($next_href) { ?>
		<a href="<?php echo $next_href ?>" class="btn btn-sm btn-white">
			다음
			<i class="fa fa-chevron-right light" aria-hidden="true"></i>
		</a>
	<?php } ?>
	</div>
</div>

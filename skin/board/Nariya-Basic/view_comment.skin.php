<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 컬러
$bo_color = ($boset['color']) ? $boset['color'] : 'navy';

// 페이징 댓글 사용유무
$is_paging = ($boset['na_crows']) ? true : false;

// 댓글 추천 비추천 설정
$is_cgood = ($boset['na_cgood']) ? true : false;
$is_cnogood = ($boset['na_cnogood']) ? true : false;

?>

<?php if(!$is_ajax_comment) { // 1번만 출력 ?>
	<script>
	// 글자수 제한
	var char_min = parseInt(<?php echo $comment_min ?>); // 최소
	var char_max = parseInt(<?php echo $comment_max ?>); // 최대
	</script>

	<button type="button" class="cmt-btn<?php echo ($boset['hide_clist']) ? ' collapsed' : ''; ?>" data-toggle="collapse" href="#viewcomment" aria-expanded="false" title="댓글목록 열기/닫기">
		<i class="fa fa-commenting-o"></i>
		<span class="orangered"><?php echo $write['wr_comment'] ?></span> Comments
		<span class="cmt-more pull-right">
			<span class="cmt-open">
				<i class="fa fa-chevron-down" aria-hidden="true"></i>
			</span>
			<span class="cmt-close">
				<i class="fa fa-chevron-up" aria-hidden="true"></i>
			</span>
		</span>
	</button>

<!-- 댓글 시작 { -->
<div id="viewcomment" class="collapse<?php echo ($boset['hide_clist']) ? '' : ' in'; ?>">

<?php } ?>

	<section id="bo_vc" class="na-fadein">
		<?php
		// 댓글목록
		$cmt_amt = count($list);
		for ($i=0; $i<$cmt_amt; $i++) {
			$comment_id = $list[$i]['wr_id'];
			$cmt_depth = strlen($list[$i]['wr_comment_reply']) * 15;
			$comment = $list[$i]['content'];
			/*
			if (strstr($list[$i]['wr_option'], "secret")) {
				$str = $str;
			}
			*/
			$comment = preg_replace("/\[\<a\s.*href\=\"(http|https|ftp|mms)\:\/\/([^[:space:]]+)\.(mp3|wma|wmv|asf|asx|mpg|mpeg)\".*\<\/a\>\]/i", "<script>doc_write(obj_movie('$1://$2.$3'));</script>", $comment);
			$comment = na_content($comment);

			$cmt_sv = $cmt_amt - $i + 1; // 댓글 헤더 z-index 재설정 ie8 이하 사이드뷰 겹침 문제 해결
			$c_reply_href = $comment_common_url.'&amp;c_id='.$comment_id.'&amp;w=c#bo_vc_w';
			$c_edit_href = $comment_common_url.'&amp;c_id='.$comment_id.'&amp;w=cu#bo_vc_w';
		 ?>
		<article id="c_<?php echo $comment_id ?>" <?php if ($cmt_depth) { ?>style="margin-left:<?php echo $cmt_depth ?>px;"<?php } ?>>
			<div class="cm_wrap">
				<?php if ($cmt_depth) { ?>
					<span class="na-hicon na-reply"></span>
				<?php } ?>
				<header style="z-index:<?php echo $cmt_sv; ?>">
					<h2 class="sound_only"><?php echo get_text($list[$i]['wr_name']); ?>님의 <?php if ($cmt_depth) { ?><span class="sound_only">댓글의</span><?php } ?> 댓글</h2>
					<div class="cmt-info f-small<?php echo ($view['mb_id'] && $view['mb_id'] == $list[$i]['mb_id']) ? ' by-writer' : '';?>">
						<div class="pull-left">
							<?php echo na_name_photo($list[$i]['mb_id'], $list[$i]['name']); ?>

							<?php include(G5_SNS_PATH.'/view_comment_list.sns.skin.php'); // SNS ?>

							<?php if ($is_ip_view) { ?>
								<span class="space-fa">
									<span class="sound_only">아이피</span>
									<i class="fa fa-map-marker cursor" aria-hidden="true" title="<?php echo $list[$i]['ip'] ?>" data-toggle="tooltip" data-placement="top"></i> 		
								</span>		
							<?php } ?>
						</div>
						<div class="pull-right text-muted">
							<span class="sound_only">작성일</span>
							<i class="fa fa-clock-o" aria-hidden="true"></i> 
							<time datetime="<?php echo date('Y-m-d\TH:i:s+09:00', strtotime($list[$i]['wr_datetime'])) ?>"><?php echo na_date($list[$i]['wr_datetime'], 'orangered', 'H:i', 'm.d H:i', 'Y.m.d H:i'); ?></time>
							<?php if (IS_NA_BBS && $boset['na_shingo']) { // 신고 ?>
								<span class="light">|</span>
								<a href="javascript:;" onclick="na_shingo('<?php echo $bo_table ?>', '<?php echo $comment_id ?>', '<?php echo $wr_id ?>');" title="신고">
									<span class="text-muted">신고</span>
								</a>
							<?php } ?>
						</div>
						<div class="clearfix"></div>
					</div>
				</header>
		
				<!-- 댓글 출력 -->
				<div class="cmt-contents f-cmt">
					<?php if(IS_NA_BBS && $is_admin && $list[$i]['as_type'] == "-1") { // 신고처리 ?>
						<p class="shingo">신고처리된 댓글입니다.</p>
					<?php } ?>

					<?php 
					$is_lock = false;	
					if (strstr($list[$i]['wr_option'], "secret")) { 
						$is_lock = true;	
					?>
						<span class="na-hicon na-secret"></span>
					<?php } ?>
					
					<?php echo $comment ?>

					<?php if(!$is_lock && (int)$list[$i]['wr_10']) { // 럭키포인트 ?>
						<p class="cmt-lucky f-small text-muted">
							<i class="fa fa-gift" aria-hidden="true"></i> 
							<b class="orangered"><?php echo number_format($list[$i]['wr_10']) ?></b> 럭키포인트 당첨!
						</p>
					<?php } ?>
				</div>

				<?php if($list[$i]['is_reply'] || $list[$i]['is_edit'] || $list[$i]['is_del']) {
					if($w == 'cu') {
						$sql = " select wr_id, wr_content, mb_id from $write_table where wr_id = '$c_id' and wr_is_comment = '1' ";
						$cmt = sql_fetch($sql);
						if (!($is_admin || ($member['mb_id'] == $cmt['mb_id'] && $cmt['mb_id'])))
							$cmt['wr_content'] = '';
						$c_wr_content = $cmt['wr_content'];
					}
				?>
				<div class="na-cbtn pull-left f-small">
					<div class="btn-group" role="group">
						<?php if ($list[$i]['is_reply']) { ?>
							<button type="button" class="btn" onclick="comment_box('<?php echo $comment_id ?>', 'c');" title="답변">
								<span class="sound_only">답변</span>
								<i class="fa fa-comments-o" aria-hidden="true"></i>
							</button>
						<?php } ?>
						<?php if ($list[$i]['is_edit']) { ?>
							<button type="button" class="btn" onclick="comment_box('<?php echo $comment_id ?>', 'cu');" title="수정">
								<span class="sound_only">수정</span>
								<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
							</button>
						<?php } ?>
						<?php if ($list[$i]['is_del']) { ?>
							<a class="btn" role="button" href="<?php echo $list[$i]['del_link']; ?>" onclick="<?php echo ($list[$i]['del_back']) ? "na_delete('viewcomment', '".$list[$i]['del_href']."','".$list[$i]['del_back']."'); return false;" : "return comment_delete();";?>" title="삭제">
								<span class="sound_only">삭제</span>
								<i class="fa fa-trash-o" aria-hidden="true"></i>
							</a>
						<?php } ?>
					</div>
				</div>
				<?php } ?>

				<?php if($is_cgood || $is_cnogood) { ?>
					<div class="na-cgood-btn pull-right f-small">
						<?php if($is_cgood) { ?>
							<a href="javascript:;" class="na-cgood" onclick="na_good('<?php echo $bo_table ?>', '<?php echo $comment_id ?>', 'good', 'c_g<?php echo $comment_id ?>', 1);" title="추천">	<span class="sound_only">추천</span><b id="c_g<?php echo $comment_id ?>" class="orangered"><?php echo $list[$i]['wr_good'] ?></b></a><?php } ?><?php if($is_cnogood) { ?><a href="javascript:;" class="na-cnogood" onclick="na_good('<?php echo $bo_table ?>', '<?php echo $comment_id ?>', 'nogood', 'c_ng<?php echo $comment_id ?>', 1);" title="비추천"><span class="sound_only">비추천</span><b id="c_ng<?php echo $comment_id;?>"><?php echo $list[$i]['wr_nogood']; ?></b>
							</a>
						<?php } ?>
					</div>
				<?php } ?>

				<div class="clearfix"></div>

				<span id="edit_<?php echo $comment_id ?>" class="bo_vc_w"></span><!-- 수정 -->
				<span id="reply_<?php echo $comment_id ?>" class="bo_vc_re"></span><!-- 답변 -->
				<?php if($is_paging) { ?>
					<input type="hidden" value="<?php echo $comment_url.'&amp;page='.$page; ?>" id="comment_url_<?php echo $comment_id ?>">
					<input type="hidden" value="<?php echo $page; ?>" id="comment_page_<?php echo $comment_id ?>">
				<?php } ?>
				<input type="hidden" value="<?php echo strstr($list[$i]['wr_option'],"secret") ?>" id="secret_comment_<?php echo $comment_id ?>">
				<textarea id="save_comment_<?php echo $comment_id ?>" style="display:none"><?php echo get_text($list[$i]['content1'], 0) ?></textarea>
			</div>
		</article>
		<?php } ?>
		<?php if (!$cmt_amt) { //댓글이 없다면 : 숨김처리함 ?>
			<div id="bo_vc_empty">등록된 댓글이 없습니다.</div>
		<?php } ?>
		<?php if($is_paging) { //페이징 ?>
			<div class="cmt-page">
				<div class="row">
					<div class="col-sm-9">
						<div class="na-page pg-<?php echo $bo_color ?>">
							<ul class="pagination pagination-sm en no-margin">
								<?php echo na_ajax_paging('viewcomment', $write_pages, $page, $total_page, $comment_page); ?>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<button class="btn btn-<?php echo $bo_color; ?> btn-sm btn-block cursor" onclick="na_comment_new('viewcomment','<?php echo $comment_url ?>','<?php echo $total_count ?>');">
							새로운 댓글 확인
						</button>
					</div>
				</div>
			</div>
		<?php } ?>
	</section>

<?php if(!$is_ajax_comment) { // 1번만 출력 ?>

</div><!-- #viewcomment 닫기 -->
<!-- } 댓글 끝 -->

	<?php if ($is_comment_write) {
		if($w == '') 
			$w = 'c';
	?>
		<!-- 댓글 쓰기 시작 { -->
		<aside id="bo_vc_w">
			<h2 class="sound_only">댓글쓰기</h2>
			<form id="fviewcomment" name="fviewcomment" action="<?php echo $comment_action_url; ?>" onsubmit="return fviewcomment_submit(this);" method="post" autocomplete="off" class="form cmt-form" role="form">
			<input type="hidden" name="w" value="<?php echo $w ?>" id="w">
			<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
			<input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
			<input type="hidden" name="comment_id" value="<?php echo $c_id ?>" id="comment_id">
			<?php if($is_paging) { //페이징 ?>
				<input type="hidden" name="comment_url" value="" id="comment_url">
			<?php } ?>
			<input type="hidden" name="sca" value="<?php echo $sca ?>">
			<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
			<input type="hidden" name="stx" value="<?php echo $stx ?>">
			<input type="hidden" name="spt" value="<?php echo $spt ?>">
			<input type="hidden" name="page" value="<?php echo $page ?>" id="comment_page">
			<input type="hidden" name="is_good" value="">

			<div class="cmt-box">

				<?php if ($is_guest) { ?>
					<div class="row row-15">
						<div class="col-sm-6 col-15">
							<div class="form-group">
								<label for="wr_name" class="sound_only">이름<strong class="sound_only"> 필수</strong></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user lightgray"></i></span>
									<input type="text" name="wr_name" value="<?php echo get_cookie("ck_sns_name"); ?>" id="wr_name" class="form-control" maxLength="20" placeholder="이름">
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-15">
							<div class="form-group">
								<label for="wr_password" class="sound_only">비밀번호<strong class="sound_only"> 필수</strong></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock lightgray"></i></span>
									<input type="password" name="wr_password" id="wr_password" class="form-control" maxLength="20" placeholder="비밀번호">
								</div>
							</div>
						</div>
					</div>
				<?php } ?>

				<div class="cmt-opt f-small">
					<span class="cursor pull-left">
						<label class="checkbox-inline" style="padding-left:10px;">
							<input type="checkbox" name="wr_secret" value="secret" id="wr_secret"> 비밀글
						</label>
					</span>
					<div class="form-group pull-right">
						<span class="cursor" title="이모티콘" onclick="na_clip('emo');">
							<i class="fa fa-smile-o fa-lg" aria-hidden="true"></i><span class="sound_only">이모티콘</span>
						</span>
						<span class="cursor" title="폰트어썸 아이콘" onclick="na_clip('fa');">
							<i class="fa fa-font-awesome fa-lg" aria-hidden="true"></i><span class="sound_only">폰트어썸 아이콘</span>
						</span>
						<span class="cursor" title="동영상" onclick="na_clip('video');">
							<i class="fa fa-youtube-play fa-lg" aria-hidden="true"></i><span class="sound_only">동영상</span>
						</span>
						<span class="cursor" title="지도" onclick="na_clip('map');">
							<i class="fa fa-map-marker fa-lg" aria-hidden="true"></i><span class="sound_only">지도동영상</span>
						</span>
						<span class="cursor hidden-xs" title="늘이기" onclick="na_textarea('wr_content','down');">
							<i class="fa fa-plus-circle fa-lg" aria-hidden="true"></i><span class="sound_only">입력창 늘이기</span>
						</span>
						<span class="cursor hidden-xs" title="줄이기" onclick="na_textarea('wr_content','up');">
							<i class="fa fa-minus-circle fa-lg" aria-hidden="true"></i><span class="sound_only">입력창 줄이기</span>
						</span>
						<span class="cursor" title="새댓글" onclick="comment_box('','c');">
							<i class="fa fa-refresh fa-lg" aria-hidden="true"></i><span class="sound_only">새댓글 작성</span>
						</span>
					</div>	
					<div class="clearfix"></div>
				</div>
				<div class="form-group tr">
					<div class="td">
						<textarea id="wr_content" name="wr_content" maxlength="10000" rows=5 class="form-control" title="내용"
						<?php if ($comment_min || $comment_max) { ?>onkeyup="check_byte('wr_content', 'char_count');"<?php } ?>><?php echo $c_wr_content;  ?></textarea>
						<?php if ($comment_min || $comment_max) { ?><script> check_byte('wr_content', 'char_count'); </script><?php } ?>
					</div>
					<div class="td cmt-submit f-small hidden-xs" onclick="<?php echo ($is_paging) ? "na_comment('viewcomment');" : "na_comment_submit();";?>" onKeyDown="na_comment_onKeyDown(<?php echo $is_paging?>);" id="btn_submit">
						등록
					</div>
				</div>

				<?php if ($comment_min || $comment_max) { ?>
					<div class="pull-right help-block f-small" id="char_cnt">
						<i class="fa fa-commenting-o fa-lg"></i>
						현재 <b class="orangered"><span id="char_count">0</span></b>글자
						/
						<?php if($comment_min) { ?>
							<?php echo number_format($comment_min);?>글자 이상
						<?php } ?>
						<?php if($comment_max) { ?>
							<?php echo number_format($comment_max);?>글자 이하
						<?php } ?>
					</div>
				<?php } ?>

				<?php if($board['bo_use_sns'] && ($config['cf_facebook_appid'] || $config['cf_twitter_key'])) {	?>
					<div id="bo_vc_opt" class="form-group pull-left">
						<ol>
							<li id="bo_vc_send_sns"></li>
						</ol>
					</div>
					<div class="clearfix"></div>
				<?php } ?>

				<?php if ($is_guest) { ?>
					<div class="cmt-capcha f-small">
						<?php echo $captcha_html; ?>
					</div>
				<?php } ?>
				<div class="cmt-submit-xs visible-xs">
					<button <?php echo ($is_paging) ? 'type="button" onclick="na_comment(\'viewcomment\');"' : 'type="submit"';?> class="btn btn-block btn-<?php echo $bo_color; ?>" onKeyDown="na_comment_onKeyDown(<?php echo $is_paging?>);" id="btn_submit2">댓글등록</button>
				</div>
			</div>
			</form>
		</aside>
	<?php } else { ?>
		<div class="well text-center f-small">
			<?php if($is_guest) { 
				$comment_login_url = G5_BBS_URL.'/login.php?wr_id='.$wr_id.$qstr.'&amp;url='.urlencode(get_pretty_url($bo_table, $wr_id, $qstr).'#bo_vc_w');
			?>
				<a href="<?php echo $comment_login_url;?>">로그인한 회원만 댓글 등록이 가능합니다.</a>
			<?php } else { ?>
				댓글을 등록할 수 있는 권한이 없습니다.
			<?php } ?>
		</div>
	<?php } ?>

	<?php if ($is_comment_write) { ?>
		<script>
		var save_before = '';
		var save_html = document.getElementById('bo_vc_w').innerHTML;

		function good_and_write() {
			var f = document.fviewcomment;
			if (fviewcomment_submit(f)) {
				f.is_good.value = 1;
				f.submit();
			} else {
				f.is_good.value = 0;
			}
		}

		function fviewcomment_submit(f) {

			f.is_good.value = 0;

			var subject = "";
			var content = "";
			$.ajax({
				url: g5_bbs_url+"/ajax.filter.php",
				type: "POST",
				data: {
					"subject": "",
					"content": f.wr_content.value
				},
				dataType: "json",
				async: false,
				cache: false,
				success: function(data, textStatus) {
					subject = data.subject;
					content = data.content;
				}
			});

			if (content) {
				alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
				f.wr_content.focus();
				return false;
			}

			// 양쪽 공백 없애기
			var pattern = /(^\s*)|(\s*$)/g; // \s 공백 문자
			document.getElementById('wr_content').value = document.getElementById('wr_content').value.replace(pattern, "");
			if (char_min > 0 || char_max > 0)
			{
				check_byte('wr_content', 'char_count');
				var cnt = parseInt(document.getElementById('char_count').innerHTML);
				if (char_min > 0 && char_min > cnt)
				{
					alert("댓글은 "+char_min+"글자 이상 쓰셔야 합니다.");
					return false;
				} else if (char_max > 0 && char_max < cnt)
				{
					alert("댓글은 "+char_max+"글자 이하로 쓰셔야 합니다.");
					return false;
				}
			}
			else if (!document.getElementById('wr_content').value)
			{
				alert("댓글을 입력하여 주십시오.");
				return false;
			}

			if (typeof(f.wr_name) != 'undefined')
			{
				f.wr_name.value = f.wr_name.value.replace(pattern, "");
				if (f.wr_name.value == '')
				{
					alert('이름이 입력되지 않았습니다.');
					f.wr_name.focus();
					return false;
				}
			}

			if (typeof(f.wr_password) != 'undefined')
			{
				f.wr_password.value = f.wr_password.value.replace(pattern, "");
				if (f.wr_password.value == '')
				{
					alert('비밀번호가 입력되지 않았습니다.');
					f.wr_password.focus();
					return false;
				}
			}
			
			<?php if($is_guest) echo chk_captcha_js();  ?>

			set_comment_token(f);

			document.getElementById("btn_submit").disabled = "disabled";
			document.getElementById("btn_submit2").disabled = "disabled";

			return true;
		}

		function comment_box(comment_id, work) {
			var el_id,
				form_el = 'fviewcomment',
				respond = document.getElementById(form_el);

			// 댓글 아이디가 넘어오면 답변, 수정
			if (comment_id) {
				if (work == 'c')
					el_id = 'reply_' + comment_id;
				else
					el_id = 'edit_' + comment_id;
			} else
				el_id = 'bo_vc_w';

			if (save_before != el_id) {
				if (save_before) {
					document.getElementById(save_before).style.display = 'none';
				}

				document.getElementById(el_id).style.display = '';
				document.getElementById(el_id).appendChild(respond);
				//입력값 초기화
				document.getElementById('wr_content').value = '';
				
				// 댓글 수정
				if (work == 'cu') {
					document.getElementById('wr_content').value = document.getElementById('save_comment_' + comment_id).value;
					if (typeof char_count != 'undefined')
						check_byte('wr_content', 'char_count');
					if (document.getElementById('secret_comment_'+comment_id).value)
						document.getElementById('wr_secret').checked = true;
					else
						document.getElementById('wr_secret').checked = false;
				}

				document.getElementById('comment_id').value = comment_id;
				document.getElementById('w').value = work;

				<?php if($is_paging) { //페이징 ?>
				if (comment_id) {
					document.getElementById('comment_page').value = document.getElementById('comment_page_'+comment_id).value;
					document.getElementById('comment_url').value = document.getElementById('comment_url_'+comment_id).value;
				} else {
					document.getElementById('comment_page').value = '';
					document.getElementById('comment_url').value = '<?php echo NA_PLUGIN_URL ?>/comment_view.php?bo_table=<?php echo $bo_table;?>&wr_id=<?php echo $wr_id;?>';
				}
				<?php } ?>

				if(save_before)
					$("#captcha_reload").trigger("click");

				save_before = el_id;
			}
		}

		function comment_delete(){
			return confirm("이 댓글을 삭제하시겠습니까?");
		}

		comment_box('', 'c'); // 댓글 입력폼이 보이도록 처리하기위해서 추가 (root님)

		<?php if($board['bo_use_sns'] && ($config['cf_facebook_appid'] || $config['cf_twitter_key'])) { ?>
		// sns 등록
		$(function() {
			$("#bo_vc_send_sns").load(
				"<?php echo G5_SNS_URL; ?>/view_comment_write.sns.skin.php?bo_table=<?php echo $bo_table; ?>",
				function() {
					save_html = document.getElementById('bo_vc_w').innerHTML;
				}
			);
		});
		<?php } ?>
		</script>

		<?php na_script('clip'); // 아이콘 등 ?>
	<?php } ?>
<?php } ?>
<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$noti_skin_url.'/style.css">', 0);

// 스킨 설정값
$wset = na_skin_config('noti');

$color = (isset($wset['color']) && $wset['color']) ? $wset['color'] : NT_COLOR;

// 목록헤드
if(isset($wset['head_skin']) && $wset['head_skin']) {
	add_stylesheet('<link rel="stylesheet" href="'.NA_PLUGIN_URL.'/skin/head/'.$wset['head_skin'].'.css">', 0);
	$head_class = 'list-head';
} else {
	$head_class = (isset($wset['head_color']) && $wset['head_color']) ? 'border-'.$wset['head_color'] : 'border-dark';
}

?>

<nav id="bo_cate" class="na-category">
	<ul id="bo_cate_ul">
		<li><a href="<?php echo G5_BBS_URL ?>/noti.php"<?php echo ($is_read == "all") ? ' id="bo_cate_on"' : '';?>>전체보기</a></li>
		<li><a href="<?php echo G5_BBS_URL ?>/noti.php?read=y"<?php echo ($is_read == 'y') ? ' id="bo_cate_on"' : '';?>>읽은알림</a></li>
		<li><a href="<?php echo G5_BBS_URL ?>/noti.php?read=n"<?php echo ($is_read == 'n') ? ' id="bo_cate_on"' : '';?>>안읽은알림</a></li>
	</ul>
	<hr/>
</nav>

<form id="fnotilist" name="fnotilist" method="post" action="#" onsubmit="return fnoti_submit(this);" role="form" class="form">
<input type="hidden" name="read"    value="<?php echo $read; ?>">
<input type="hidden" name="page"    value="<?php echo (int)$page; ?>">
<input type="hidden" name="token"    value="<?php echo $token; ?>">
<input type="hidden" name="pressed" value="">
<input type="hidden" name="p_type"	value="" id="p_type">

	<div id="bo_btn_top" class="f-small clearfix">
		<ul class="btn_bo_user pull-right">
			<?php if(($is_admin || IS_DEMO) && is_file($new_skin_path.'/setup.skin.php')) { ?>
				<li>
					<a href="<?php echo na_setup_href('noti') ?>" title="스킨설정" class="btn_b01 btn btn-setup pull-right">
						<i class="fa fa-cogs" aria-hidden="true"></i></a>
						<span class="sound_only">스킨설정</span>
					</a>
				</li>
			<?php } ?>
			<li>
				<button type="button" class="btn_more_opt is_list_btn btn_b01 btn" title="알림 리스트 옵션"><i class="fa fa-ellipsis-v" aria-hidden="true"></i><span class="sound_only">알림 리스트 옵션</span></button>
				<ul class="more_opt is_list_btn">
					<li><label class="checkbox-inline"><input type="checkbox" onclick="if (this.checked) all_checked(true); else all_checked(false);">전체선택</label></li>
					<li><button type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value"><i class="fa fa-trash-o" aria-hidden="true"></i> 선택삭제</button></li>
					<li><button type="submit" name="btn_submit" value="읽음표시" onclick="document.pressed=this.value"><i class="fa fa-eye" aria-hidden="true"></i> 읽음표시</button></li>
					<li><button type="submit" name="btn_submit" value="모든알림삭제" onclick="document.pressed=this.value">모든알림삭제</button></li>
				</ul>
			</li>
		</ul>
		<div id="bo_list_total" class="pull-left">
			전체 <b><?php echo number_format($total_count) ?></b>건 / <?php echo $page ?>페이지
			<?php if($nariya['noti_days']){ ?>
				/ <b><?php echo $nariya['noti_days']; ?></b>일 보관
			<?php } ?>
		</div>
	</div>

	<div id="noti_list">
		<div class="div-head <?php echo $head_class ?>">
			<span class="state">구분</span>
			<span class="subj">알림 내역</span>
			<span class="date hidden-xs">날짜</span>
			<span class="chk">
				<label for="all_chk" class="sound_only">목록 전체 선택</label>
				<input type="checkbox" id="all_chk" onclick="if (this.checked) all_checked(true); else all_checked(false);">
			</span>
		</div>
		<ul>
		<?php for($i=0; $i < $list_cnt; $i++) { ?>
			<li class="tr">
				<div class="td state">
					<?php echo ($list[$i]['ph_readed'] == "Y") ? '<span class="text-muted">읽음</span>' : '<span class="orangered">읽기 전</span>';?>
				</div>
				<div class="td subj">
					<a href="<?php echo $list[$i]['href'] ?>">
						<?php echo $list[$i]['msg'] ?>
						<?php if($list[$i]['subject']) { ?>
							<span class="text-muted">
								<i class="fa fa-caret-right" aria-hidden="true"></i>
								<?php echo $list[$i]['parent_subject'] ?>
							</span>
						<?php } ?>
						<span class="text-muted noti-mo">
							<i class="fa fa-clock-o" aria-hidden="true"></i>
							<?php echo $list[$i]['wtime'] ?>
						</span>
					</a>
				</div>
				<div class="td date hidden-xs">
					<?php echo $list[$i]['wtime'] ?>
				</div>
				<div class="td chk">
					<label for="chk_bn_id_<?php echo $i ?>" class="sound_only"><?php echo $i ?>번</label>
					<input type="checkbox" name="chk_bn_id[]" value="<?php echo $i ?>" id="chk_bn_id_<?php echo $i ?>">
					<input type="hidden" name="chk_g_ids[<?php echo $i ?>]" value="<?php echo $list[$i]['g_ids'] ?>" >
					<input type="hidden" name="chk_read_yn[<?php echo $i ?>]" value="<?php echo $list[$i]['ph_readed'] ?>" >
				</div>
			</li>
	    <?php } ?>
		<?php if ($i == 0) { ?>
			<li class="none">
				알림이 없습니다.
			</li>
		<?php } ?>
		</ul>
	</div>

</form>

<div id="noti_page" class="clearfix na-page text-center pg-<?php echo $color ?>">
	<ul class="pagination pagination-sm en">
		<?php echo na_paging($page_rows, $page, $total_page,"{$_SERVER['PHP_SELF']}?$query_string&amp;page="); ?>
	</ul>
</div>

<div class="h20"></div>

<script>
function all_checked(sw) {
	var f = document.fnotilist;

	for (var i=0; i<f.length; i++) {
		if (f.elements[i].name == "chk_bn_id[]")
			f.elements[i].checked = sw;
	}
}

function fnoti_submit(f) {

	if(document.pressed == "모든알림삭제") {
		if (!confirm("모든 알림을 정말 삭제 하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다")) {
			return false;
		}

		$("#p_type").val("alldelete");
	} else {
		var chk_count = 0;

		for (var i=0; i<f.length; i++) {
			if (f.elements[i].name == "chk_bn_id[]" && f.elements[i].checked)
			chk_count++;
		}

		if (!chk_count) {
			alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
			return false;
		}

		if(document.pressed == "읽음표시") {
			$("#p_type").val("read");
		}

		if(document.pressed == "선택삭제") {
			if (!confirm("선택한 알림을 정말 삭제 하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다")) {
				return false;
			}

			$("#p_type").val("del");
		}
	}

    f.action = "./noti_delete.php";

    return true;
}

// 리스트 옵션
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
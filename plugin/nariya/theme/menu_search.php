<?php
include_once('./_common.php');

if ($is_admin == 'super' || IS_DEMO) {
	;
} else {
    alert_close('접근권한이 없습니다.');
}

$g5['title'] = '메뉴 추가';
include_once(G5_THEME_PATH.'/head.sub.php');
?>
<style>
body { 
	background:#fff; padding:20px; margin:0; 
}
#fmenuform .form-group,
#fmenuform .list-group { 
	margin-bottom:0; 
}
#fmenuform .list-group-item { 
	border-left:0; border-right:0; 
}
#fmenuform .list-group-item:last-child { 
	border-bottom:0; 
}
#fmenuform .table { 
	border-top:1px solid #ddd; border-bottom:0; margin-bottom:0px !important; 
}
#fmenuform .table thead th { 
	border-bottom:0px;
}
</style>

<form name="fmenuform" id="fmenuform" class="form-horizontal f-small">
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-bars"></i> <b>메뉴 선택</b>
		</div>
		<div class="panel-body">
			<div class="form-group">
				<label class="col-xs-2 control-label">대상</label>
				<div class="col-xs-10">
					<select name="me_type" id="me_type" class="form-control">
						<option value="">직접입력</option>
						<option value="group">게시판그룹</option>
						<option value="board">게시판</option>
						<option value="content">내용관리</option>
						<?php if (defined('G5_USE_SHOP') && G5_USE_SHOP) { ?>
							<option value="category">상품분류</option>
						<?php } ?>
						<option value="page">페이지</option>
					</select>
				</div>
			</div>
		</div>

		<div id="menu_result"></div>

	</div>

	<div class="text-center" style="margin:10px">
		<button type="button" class="btn btn-white" onclick="window.close();">창닫기</button>
	</div>

</form>

<script>
$(function() {
    $("#menu_result").load(
        "./menu_item.php"
    );

    $("#me_type").on("change", function() {
        var type = $(this).val();

		$("#menu_result").empty().load(
            "./menu_item.php",
            { type : type }
        );
    });

    $(document).on("click", "#add_manual", function() {
        var me_name = $.trim($("#me_name").val());
        var me_link = $.trim($("#me_link").val());

        add_menu_list(me_name, me_link);
    });

    $(document).on("click", ".add_select", function() {
        var me_name = $.trim($(this).siblings("input[name='subject[]']").val());
        var me_link = $.trim($(this).siblings("input[name='link[]']").val());

        add_menu_list(me_name, me_link);
    });
});

function add_menu_list(name, link) {

	$("#me_text", opener.document).val(name);
    $("#me_href", opener.document).val(link);

	window.close();
}
</script>

<?php
include_once(G5_THEME_PATH.'/tail.sub.php');
?>
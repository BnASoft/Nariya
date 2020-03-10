<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 저장버튼
$btn_submit = '<p class="btn-submit"><button type="submit" class="btn btn-block btn-na-red">Save</button></p>';
?>

<link rel="stylesheet" href="./css/spectrum.css">
<script src="./js/spectrum.js"></script>
<style>
#fsetup .table {
	min-width:600px;	
}
#fsetup .table th,
#fsetup .table td {
	vertical-align:middle;
}
#fsetup .btn-submit {
	max-width:200px;
	margin:15px auto 30px;
}
#fsetup ol {
	line-height:1.8;
	margin-bottom:0;
}
#fsetup .list-group-item {
	padding-top:20px;
	padding-bottom:20px;
	border-left:0;
	border-right:0;
}
#fsetup .list-group-item.list-head {
	padding-top:10px;
	padding-bottom:10px;
}
#fsetup .help-block {
	margin-bottom:0;
}
#fsetup .chk-margin {
	margin:10px 0 !important;
}
#fsetup .form-group {
	margin-bottom:0;
}
</style>

<?php
	// 저장폴더 권한 체크
	include_once(NA_PLUGIN_PATH.'/save.inc.php');

	@include_once (NA_THEME_ADMIN_PATH.'/form/common.php');

	@include_once (NA_THEME_ADMIN_PATH.'/form/layout.php');
?>

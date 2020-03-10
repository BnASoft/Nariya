<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

/*
if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}
*/

// Page Loader 때문에 먼저 실행함
include_once(G5_THEME_PATH.'/head.sub.php');

// 파일경로 체크
$nt_index_path = G5_THEME_PATH.'/index'; 
$nt_index_url = G5_THEME_URL.'/index';

// 인덱스 파일
if(!$tset['index'])
	$tset['index'] = 'basic';

$is_index = true;
$is_wing = false;

?>
<script>
// Page Loader
$(window).on('load', function () {
	$("#nt_loader").delay(100).fadeOut("slow");
});
$(document).ready(function() {
	$('#nt_loader').on('click', function () {
		$('#nt_loader').fadeOut();
	});
});
</script>
<div id="nt_loader">
	<div class="loader">
		<i class="fa fa-spinner fa-spin"></i>
	</div>
</div>

<?php
include_once(G5_THEME_PATH.'/head.php');

//인덱스
if(is_file($nt_index_path.'/'.$tset['index'].'.php')) {
	include_once($nt_index_path.'/'.$tset['index'].'.php');
} else {
?>
	<div class="text-muted text-center" style="padding:300px 0px;">
		<?php if($is_admin == 'super') { ?>
			<a href="<?php echo G5_THEME_ADMIN_URL ?>/site_form.php">
				테마 관리자 화면의 <b>"사이트 설정"</b>에서 사용할 메인을 설정해 주세요.
			</a>
		<?php } else { ?>
			메인 파일을 찾을 수 없습니다.
			<p>관리자에게 알려주시면 감사하겠습니다.</p>
		<?php } ?>
	</div>
<?php
}

include_once(G5_THEME_PATH.'/tail.php');
?>
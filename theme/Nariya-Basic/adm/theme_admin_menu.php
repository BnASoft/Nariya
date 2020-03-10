<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// Setup Modal
include_once (NA_PLUGIN_PATH.'/theme/setup.php');

?>
<style>
#theme-controller { 
	position:fixed; left: -206px; top: 0px; width: 205px; z-index: 3333; box-shadow: 3px 3px 6px rgba(0,0,0,0.08); background-color: rgb(255, 255, 255); 
}
#theme-controller .list-group,
#theme-controller .panel-group {
	margin:0 !important;
}
#theme-controller .list-group-item,
#theme-controller .panel {
	border-width: 1px 0 0 0 !important;
}
#theme-controller .controller-icon { 
	color:#fff; width: 40px; height: 35px; text-align: center; right:-40px; line-height:35px; font-size: 17px; text-decoration: none; display: block; position: absolute; 
}
#theme-controller .theme-setup-icon { 
	top: 40px; z-index:1; background:#222; border-radius:0px 3px 0px 0px; 
}
#theme-controller .widget-setup-icon { 
	top: 75px; z-index:1; background:#333;  border-radius:0px 0px 3px 0px; 
}
#theme-controller .page-setup-icon { 
	top: 130px; z-index:1; border-radius:0px 3px 3px 0px;
}
</style>

<aside id="theme-controller" class="hidden-xs f-small">
	<a href="javascript:;" class="controller-icon theme-setup-icon theme-setup" title="테마설정" data-toggle="tooltip" data-placement="right">
		<i class="fa fa-desktop"></i>
	</a>
	<a href="javascript:;" class="controller-icon widget-setup-icon widget-setup" title="위젯설정" data-toggle="tooltip" data-placement="right">
		<i class="fa fa-cogs"></i>
	</a>
	<?php if(!$tlayout['index']) { // 인덱스가 아닌 경우 ?>
		<a href="<?php echo NA_THEME_ADMIN_URL ?>/page_setup.php?pid=<?php echo urlencode($pset['pid']) ?>" class="controller-icon page-setup-icon bg-black btn-setup" title="페이지설정" data-toggle="tooltip" data-placement="right">
			<i class="fa fa-clone"></i>
		</a>
	<?php } ?>
	
	<ul class="list-group">
		<li class="list-group-item bg-na-navy">
			<b>테마 설정 메뉴</b>
		</li>
		<li class="list-group-item">
			<a href="<?php echo NA_THEME_ADMIN_URL;?>/site_setup.php">
				사이트 설정
			</a>
		</li>
		<li class="list-group-item">
			<a href="<?php echo NA_THEME_ADMIN_URL;?>/menu_form.php?mode=bbs">
				메뉴 설정
			</a>
		</li>
	</ul>

	<div class="panel-group" id="controller-page" role="tablist" aria-multiselectable="true">
		<div class="panel panel-default">
			<div class="panel-heading" role="tab" id="controller-page-head">
				<a data-toggle="collapse" data-parent="#accordion" href="#controller-page-item" aria-expanded="true" aria-controls="collapseOne">
					<b>비회원 페이지 설정</b>
				</a>
			</div>
			<div id="controller-page-item" class="panel-collapse collapse" role="tabpanel" aria-labelledby="controller-page-head">
				<div class="list-group">
					<?php
						$parr = array();
						$parr[] = array('login.php', '로그인');
						$parr[] = array('register.php', '회원약관');
						$parr[] = array('register_form.php', '회원가입');
						$parr[] = array('register_result.php', '회원가입완료');
						$parr[] = array('register_email.php', '인증메일변경');
						$parr[] = array('member_confirm.php', '회원비번확인');
						$parr[] = array('password.php', '비밀번호입력');

						for($i=0; $i < count($parr); $i++) {
					?>
						<a href="<?php echo NA_THEME_ADMIN_URL;?>/page_<?php echo $parr[$i][0] ?>" class="list-group-item">
							<?php echo $parr[$i][1] ?> 페이지
						</a>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</aside>

<script>
$(document).ready(function() {
	$(".theme-setup").click(function(){
		var controller = $("#theme-controller");
		if (controller.css("left") === "-206px") {
			controller.animate({
				left: "0px"
			}); 
		} else {
			controller.animate({
				left: "-206px"
			});
		}
	});
});
</script>
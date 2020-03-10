<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<form name="fnariya" id="fnariya" method="post" onsubmit="return fnariya_submit(this);">
	<input type="hidden" name="post_action" value="save" >
	<input type="hidden" name="token" value="" id="token">

	<section id="anc_na_basic">
		<h2 class="h2_frm">베이직 플러그인 설정</h2>

		<div class="tbl_frm01 tbl_wrap">
			<table>
			<colgroup>
				<col class="grid_4">
				<col>
				<col class="grid_4">
				<col>
			</colgroup>
			<tbody>
			<tr>
				<th scope="row">
					버전
				</th>
				<td colspan="3">
					<?php @include_once(NA_PLUGIN_PATH.'/version.php') ?>
				</td>
			</tr>
			<tr>
				<th scope="row">
					통합 최고관리자
				</th>
				<td colspan="3">
					<?php echo help('회원아이디를 콤마(,)로 구분하여 복수 회원 등록이 가능합니다.') ?>
					<input type="text" name="na[cf_admin]" value="<?php echo $nariya['cf_admin'] ?>" class="frm_input" size="80">
				</td>
			</tr>
			<tr>
				<th scope="row">
					통합 그룹관리자
				</th>
				<td colspan="3">
					<?php echo help('회원아이디를 콤마(,)로 구분하여 복수 회원 등록이 가능합니다.') ?>
					<input type="text" name="na[cf_group]" value="<?php echo $nariya['cf_group'] ?>" class="frm_input" size="80">
				</td>
			</tr>
			<tr>
				<th scope="row">
					모바일 스킨
				</th>
				<td colspan="3">
					<?php echo help('미사용시 PC/모바일 모두 반응형 PC 스킨을 사용합니다.') ?>
					<label>
						<input type="checkbox" name="na[mobile_skin]" value="1"<?php echo get_checked('1', $nariya['mobile_skin'])?>> 사용
					</label>
				</td>
			</tr>
			<tr>
				<th scope="row">
					공유 동영상 이미지
				</th>
				<td colspan="3">
					<?php echo help('유튜브, 비메오 등 동영상 썸네일용 대표이미지를 서버의 /data/'.NA_DIR.'/video 폴더 내에 저장합니다.') ?>
					<label>
						<input type="checkbox" name="na[save_video_img]" value="1"<?php echo get_checked('1', $nariya['save_video_img'])?>> 서버 저장
					</label>
				</td>
			</tr>
			<tr>
				<th scope="row">
					페이스북 토큰
				</th>
				<td colspan="3">
					<?php echo help('페북 동영상 썸네일을 가져오기 위해서는 페북 개발자센터에서 앱을 등록하고 Tools & Support > Graph API Explorer 메뉴에서 Get Token > Get App Token 실행 후 생성된 토큰을 등록해야 합니다.') ?>
					<input type="text" name="na[fb_key]" value="<?php echo $nariya['fb_key'] ?>" class="frm_input" size="80">
				</td>
			</tr>
			<tr>
				<th scope="row">
					JWPlayer 6 라이센스 키
				</th>
				<td colspan="3">
					<?php echo help('JWPlayer6 라이센스키를 입력하면 상업적 이용 및 로고 삭제가 가능합니다.') ?>
					<input type="text" name="na[jw6_key]" value="<?php echo $nariya['jw6_key'] ?>" class="frm_input" size="80">
				</td>
			</tr>
			<tr>
				<th scope="row">
					구글맵 API 키
				</th>
				<td colspan="3">
					<?php echo help('구글맵 사용을 위해서는 Google API Console에서 서버키(안되면 브라우저 API 키)를 발급받은 후 라이브러리에서 Google Maps JavaScript API를 사용설정해야 합니다.') ?>
					<input type="text" name="na[google_key]" value="<?php echo $nariya['google_key'] ?>" class="frm_input" size="80">
				</td>
			</tr>
			</tbody>
			</table>
		</div>
	</section>

	<?php
		// 게시판 플러그인
		@include_once(NA_PLUGIN_PATH.'/extend/bbs/admin.php');

		// 멤버십 플러그인
		@include_once(NA_PLUGIN_PATH.'/extend/xp/admin.php');
	?>

	<div class="btn_fixed_top btn_confirm">
		<input type="submit" value="저장" class="btn_submit btn" accesskey="s">
	</div>
</form>


<script>
function na_upgrade(url) {
	$.post(url, function(data) {
		alert(data);
		return false;
	});
}
function fnariya_submit(f) {

    return true;

}
</script>
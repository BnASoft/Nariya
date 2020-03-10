<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);

// $is_privacy = (is_file(G5_THEME_PATH.'/page/privacy.php')) ? true : false;
?>

<div id="#reg" class="register<?php echo ($tset['page_sub']) ? ' headsub' : ' no-headsub';?>">
	<?php 
		// 소셜로그인 사용시 소셜로그인 버튼
		@include_once(get_social_skin_path().'/social_register.skin.php');
	?>

	<form  name="fregister" id="fregister" action="<?php echo $register_action_url ?>" onsubmit="return fregister_submit(this);" method="POST" autocomplete="off" class="form-horizontal" role="form">
		<ul class="list-group">
			<li class="list-group-item bg-light f-small">
				<b>회원가입약관과 개인정보처리방침에 동의하셔야 회원가입 하실 수 있습니다.</b>
			</li>
			<li class="list-group-item" style="padding-bottom:0;">
				<div class="form-group">
					<label class="col-sm-3 control-label">회원가입약관</label>
					<div class="col-sm-9">
						<?php if(is_file(G5_THEME_PATH.'/page/provision.php')) { ?>
							<div class="register-term f-small">
								<?php include_once (G5_THEME_PATH.'/page/provision.php'); ?>
							</div>
						<?php } else { ?>
							<textarea class="form-control" rows="8" readonly style="background:#fff !important;"><?php echo get_text($config['cf_stipulation']) ?></textarea>
						<?php } ?>

						<div class="h10"></div>

						<label class="checkbox-inline f-small">
							<input type="checkbox" name="agree" value="1" id="agree11"> 
							<b>회원가입약관의 내용에 동의합니다.</b>
						</label>
					</div>
				</div>
			</li>
			<li class="list-group-item" style="padding-bottom:0;">
				<div class="form-group">
					<label class="col-sm-3 control-label">개인정보처리방침</label>
					<div class="col-sm-9">
						<table class="table table-bordered no-margin f-small">
						<tbody>
						<tr class="bg-light">
							<th class="col-xs-4 text-center">목적</th>
							<th class="col-xs-4 text-center">항목</th>
							<th class="text-center">보유기간</th>
						</tr>
						<tr>
							<td>이용자 식별 및 본인여부 확인</td>
							<td>아이디, 이름, 비밀번호</td>
							<td>회원 탈퇴 시까지</td>
						</tr>
						<tr>
							<td>서비스 이용에 관한 통지, CS대응을 위한 이용자 식별</td>
							<td>연락처 (이메일, 휴대전화번호)</td>
							<td>회원 탈퇴 시까지</td>
						</tr>
						</tbody>
						</table>

						<div class="h10"></div>

						<label class="checkbox-inline f-small">
							<input type="checkbox" name="agree2" value="1" id="agree21" > 
							<b>개인정보처리방침의 내용에 동의합니다.</b>
						</label>
					</div>
				</div>
			</li>
			<!--
			<li class="list-group-item" style="padding-bottom:0;">
				<div class="form-group">
					<label class="col-sm-3 control-label">모두 동의</label>
					<div class="col-sm-9">
						<label class="checkbox-inline">
							<input type="checkbox" name="chk_all" id="chk_all" class="selec_chk">
							회원가입약관과 개인정보처리방침에 모두 동의합니다.
						</label>
					</div>
				</div>
			</li>
			-->
		</ul>

		<div class="row row-20">
			<div class="col-xs-6 col-20">
				<a href="<?php echo G5_URL ?>" class="btn btn-white btn-block btn-lg">취소</a>
			</div>
			<div class="col-xs-6 col-20">
				<button type="submit" class="btn btn-<?php echo NT_COLOR ?> btn-block btn-lg">회원가입</button>
			</div>
		</div>
	</form>
</div>

<div class="h20"></div>

<script>
    function fregister_submit(f) {
        if (!f.agree.checked) {
            alert("회원가입약관의 내용에 동의하셔야 회원가입 하실 수 있습니다.");
            f.agree.focus();
            return false;
        }

        if (!f.agree2.checked) {
            alert("개인정보처리방침의 내용에 동의하셔야 회원가입 하실 수 있습니다.");
            f.agree2.focus();
            return false;
        }

        return true;
    }

    jQuery(function($){
        // 모두선택
        $("input[name=chk_all]").click(function() {
            if ($(this).prop('checked')) {
                $("input[name^=agree]").prop('checked', true);
            } else {
                $("input[name^=agree]").prop("checked", false);
            }
        });
    });
</script>

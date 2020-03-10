<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// input의 name을 boset[배열키] 형태로 등록

?>
<ul class="list-group" style="margin-top:-1px;">
	<li class="list-group-item bg-navy">
		<b>기능설정</b>
	</li>
	<li class="list-group-item">
		<div class="form-group">
			<label class="col-sm-2 control-label">추가 관리자</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="boset[bo_admin]" value="<?php echo $boset['bo_admin'] ?>">
				<p class="help-block">
					회원아이디를 콤마(,)로 구분하여 복수 회원 등록 가능
				</p>
			</div>
		</div>
	</li>
	<li class="list-group-item">
		<div class="form-group">
			<label class="col-sm-2 control-label">자동출력</label>
			<div class="col-sm-10">
				<div class="table-responsive">
					<table class="table table-bordered no-margin">
					<tbody>
					<tr class="active">
					<th class="text-center col-xs-3">구분</th>
					<th class="text-center col-xs-3">사용</th>
					<th class="text-center">비고</th>
					</tr>
					<tr>
					<th class="text-center">
						첨부 동영상
					</th>
					<td class="text-center">
						<input type="checkbox" name="boset[na_video_attach]" value="1"<?php echo get_checked('1', $boset['na_video_attach'])?> class="no-margin">
					</td>
					<td class="text-muted">
						동일 파일명의 이미지 첨부시 표지이미지 자동적용
					</td>
					</tr>
					<tr>
					<th class="text-center">
						관련링크 동영상
					</th>
					<td class="text-center">
						<input type="checkbox" name="boset[na_video_link]" value="1"<?php echo get_checked('1', $boset['na_video_link'])?> class="no-margin">
					</td>
					<td class="text-muted">
						관련링크에 등록된 유튜브, 비메오 등 공유주소
					</td>
					</tr>
					<tr>
					<th class="text-center">
						동영상 자동실행
					</th>
					<td class="text-center">
						<input type="checkbox" name="boset[na_autoplay]" value="1"<?php echo get_checked('1', $boset['na_autoplay'])?> class="no-margin">
					</td>
					<td class="text-muted">
						복수 출력시 문제되며, 유튜브의 경우 사이트 블럭 조치를 받을 수 있음
					</td>
					</tr>
					<tr>
						<th class="text-center">
							SyntaxHighLighter
						</th>
						<td class="text-center">
							<input type="checkbox" name="boset[na_code]" value="1"<?php echo get_checked('1', $boset['na_code'])?> class="chk-margin">
						</td>
						<td class="text-muted">
							[code]...[/code]를 이용한 HTML, PHP 등 소스코드 등록
						</td>
					</tr>
					<tr>
					<th class="text-center">
						외부 이미지
					</th>
					<td class="text-center">
						<input type="checkbox" name="boset[na_save_image]" value="1"<?php echo get_checked('1', $boset['na_save_image'])?> class="no-margin">
					</td>
					<td class="text-muted">
						외부 이미지를 자동으로 서버에 저장
					</td>
					</tr>
					</tbody>
					</table>
				</div>
				<p class="help-block f-small">
					글내용에 입력한 간단 영상코드, 지도코드 등은 자동 적용됨
				</p>
			</div>
		</div>
	</li>
	<li class="list-group-item">
		<div class="form-group">
			<label class="col-sm-2 control-label">댓글설정</label>
			<div class="col-sm-10">
				<div class="table-responsive">
					<table class="table table-bordered no-margin">
					<tbody>
					<tr class="active">
					<th class="text-center col-xs-3">페이징 댓글</th>
					<th class="text-center col-xs-3">럭키점수</th>
					<th class="text-center col-xs-2">럭키확률</th>
					<th class="text-center col-xs-2">추천사용</th>
					<th class="text-center">비추사용</th>
					</tr>
					<tr>	
					<td>
						<div class="input-group">
							<input type="text" class="form-control" name="boset[na_crows]" value="<?php echo $boset['na_crows'] ?>">
							<span class="input-group-addon">개</span>
						</div>
					</td>
					<td>
						<div class="input-group">
							<input type="text" class="form-control" name="boset[na_lucky_point]" value="<?php echo $boset['na_lucky_point'] ?>">
							<span class="input-group-addon">점</span>
						</div>
					</td>
					<td>
						<input type="text" class="form-control" name="boset[na_lucky_dice]" value="<?php echo $boset['na_lucky_dice'] ?>">
					</td>
					<td class="text-center">
						<input type="checkbox" name="boset[na_cgood]" value="1"<?php echo get_checked('1', $boset['na_cgood'])?> class="no-margin">
					</td>
					<td class="text-center">
						<input type="checkbox" name="boset[na_cnogood]" value="1"<?php echo get_checked('1', $boset['na_cnogood'])?> class="no-margin">
					</td>
					</tr>
					</tbody>
					</table>
				</div>
				<p class="help-block f-small">
					럭키점수와 확률 모두 설정해야 작동하며, 확률은 1/n의 n값
				</p>
			</div>
		</div>
	</li>
	<li class="list-group-item">
		<div class="form-group">
			<label class="col-sm-2 control-label">추천취소</label>
			<div class="col-sm-10">
				<div class="table-responsive">
					<table class="table table-bordered no-margin">
					<tbody>
					<tr class="active">
					<th class="text-center col-xs-3">시간</th>
					<th class="text-center col-xs-3">횟수</th>
					<th class="text-center">비고</th>
					</tr>
					<tr>	
					<td class="text-center">
						<div class="input-group">
							<input type="text" class="form-control" name="boset[na_gcancel]" value="<?php echo $boset['na_gcancel'] ?>">
							<span class="input-group-addon">초</span>
						</div>
					</td>
					<td class="text-center">
						<div class="input-group">
							<input type="text" class="form-control" name="boset[na_gtimes]" value="<?php echo $boset['na_gtimes'] ?>">
							<span class="input-group-addon">회</span>
						</div>
					</td>
					<td class="text-muted">
						시간내 횟수로 글/댓글 모두 동일하게 적용됨
					</td>
					</tr>
					</tbody>
					</table>
				</div>
			</div>
		</div>
	</li>
	<?php if(IS_NA_BBS) { // 게시판 플러그인 ?>
		<li class="list-group-item">
			<div class="form-group">
				<label class="col-sm-2 control-label">부가기능</label>
				<div class="col-sm-10">
					<div class="table-responsive">
						<table class="table table-bordered no-margin">
						<tbody>
						<tr class="active">
						<th class="text-center col-xs-3">신고</th>
						<th class="text-center col-xs-3">태그</th>
						<th class="text-center">비고</th>
						</tr>
						<tr>	
						<td class="text-center">
							<div class="input-group">
								<input type="text" class="form-control" name="boset[na_shingo]" value="<?php echo $boset['na_shingo'] ?>">
								<span class="input-group-addon">회</span>
							</div>
						</td>
						<td class="text-center">
							<input type="checkbox" name="boset[na_tag]" value="1"<?php echo get_checked('1', $boset['na_tag'])?> class="no-margin">
						</td>
						<td class="text-muted">
							신고 횟수 이상일 때 잠금처리(비밀글)
						</td>
						</tr>
						</tbody>
						</table>
					</div>
				</div>
			</div>
		</li>
	<?php } ?>
	<?php if(IS_NA_XP) { // 멤버십 플러그인 ?>
		<li class="list-group-item">
			<div class="form-group">
				<label class="col-sm-2 control-label">경험치설정</label>
				<div class="col-sm-10">
					<div class="table-responsive">
						<table class="table table-bordered no-margin">
						<tbody>
						<tr class="active">
						<th class="text-center col-xs-3">쓰기</th>
						<th class="text-center col-xs-3">댓글</th>
						<th class="text-center">비고</th>
						</tr>
						<tr>	
						<td class="text-center">
							<div class="input-group">
								<input type="text" class="form-control" name="boset[xp_write]" value="<?php echo $boset['xp_write'] ?>">
								<span class="input-group-addon">점</span>
							</div>
						</td>
						<td class="text-center">
							<div class="input-group">
								<input type="text" class="form-control" name="boset[xp_comment]" value="<?php echo $boset['xp_comment'] ?>">
								<span class="input-group-addon">점</span>
							</div>
						</td>
						<td class="text-muted">
							&nbsp;
						</td>
						</tr>
						</tbody>
						</table>
					</div>
				</div>
			</div>
		</li>
	<?php } ?>
</ul>
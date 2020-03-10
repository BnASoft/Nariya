<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// input의 name을 wset[배열키], mo[배열키] 형태로 등록
// 기본은 wset[배열키], 모바일 설정은 mo[배열키] 형식을 가짐

// 아이콘 선택기
na_script('iconpicker');

?>

<ul class="list-group">
	<li class="list-group-item">
		<div class="form-group">
			<label class="col-sm-2 control-label">출력 설정</label>
			<div class="col-sm-10">
				<div class="table-responsive">
					<table class="table table-bordered no-margin">
					<tbody>
					<tr class="active">
					<th class="text-center col-xs-3">캐시설정</th>
					<th class="text-center col-xs-3">글아이콘</th>
					<th class="text-center col-xs-3">새글표시</th>
					<th class="text-center">랭크표시</th>
					</tr>
					<tr>
					<td>
						<div class="input-group">
							<input type="text" name="wset[cache]" value="<?php echo $wset['cache'] ?>" class="form-control">
							<span class="input-group-addon">분</span>
						</div>
					</td>
					<td class="text-center">
						<button id="wr_icon" type="button" class="btn btn-default" data-icon="<?php echo $wset['icon'] ?>" data-iconset="fontawesome" name="wset[icon]"></button>
						<script>
						$('#wr_icon').iconpicker();
						</script>
					</td>
					<td>
						<div class="input-group">
							<input type="text" name="wset[bo_new]" value="<?php echo $wset['bo_new'] ?>" class="form-control">
							<span class="input-group-addon">시간 이내</span>
						</div>
					</td>
					<td>
						<select name="wset[rank]" class="form-control">
							<option value=""<?php echo get_selected('', $wset['rank']); ?>>표시안함</option>
							<?php echo na_color_options($wset['rank']);?>
						</select>
					</td>
					</tr>
					</tbody>
					</table>
				</div>
			</div>
		</div>
	</li>

	<li class="list-group-item">
		<div class="form-group">
			<label class="col-sm-2 control-label">추출 갯수</label>
			<div class="col-sm-10">
				<div class="table-responsive">
					<table class="table table-bordered no-margin">
					<tbody>
					<tr class="active">
					<th class="text-center col-xs-3">PC</th>
					<th class="text-center col-xs-3">모바일</th>
					<th class="text-center col-xs-3">페이지</th>
					<th class="text-center">비고</th>
					</tr>
					<tr>
					<td>
						<div class="input-group">
							<input type="text" name="wset[rows]" value="<?php echo $wset['rows'] ?>" class="form-control">
							<span class="input-group-addon">개</span>
						</div>
					</td>
					<td>
						<div class="input-group">
							<input type="text" name="mo[rows]" value="<?php echo $mo['rows'] ?>" class="form-control">
							<span class="input-group-addon">개</span>
						</div>

					</td>
					<td>
						<div class="input-group">
							<input type="text" name="wset[page]" value="<?php echo $wset['page'] ?>" class="form-control">
							<span class="input-group-addon">쪽</span>
						</div>
					</td>
					<td class="text-muted">
						추출 갯수기준 페이지임
					</td>
					</tr>
					</tbody>
					</table>
				</div>
			</div>
		</div>
	</li>

	<li class="list-group-item">
		<div class="form-group">
			<label class="col-sm-2 control-label">추출 방법</label>
			<div class="col-sm-10">
				<div class="table-responsive">
					<table class="table table-bordered no-margin">
					<tbody>
					<tr class="active">
					<th class="text-center col-xs-3">정렬</th>
					<th class="text-center col-xs-3">기간</th>
					<th class="text-center col-xs-3">일자지정</th>
					<th class="text-center">비고</th>
					</tr>
					<tr>
					<td>
						<select name="wset[sort]" class="form-control">
							<?php echo na_sort_options($wset['sort']);?>
						</select>
					</td>
					<td>
						<select name="wset[term]" class="form-control">
							<?php echo na_term_options($wset['term']);?>
						</select>
					</td>
					<td>
						<div class="input-group">
							<input type="text" name="wset[dayterm]" value="<?php echo $wset['dayterm'];?>" class="form-control">
							<span class="input-group-addon">일</span>
						</div>
					</td>
					<td class="text-center">
						&nbsp;
					</td>
					</tr>
					</tbody>
					</table>
				</div>
				<p class="help-block">
					복수 게시판 추출시 날짜 정렬만 작동함
				</p>
			</div>
		</div>
	</li>

	<li class="list-group-item" style="border-bottom:0px;">
		<div class="form-group">
			<label class="col-sm-2 control-label">추출 대상</label>
			<div class="col-sm-10">
				<div class="table-responsive">
					<table class="table table-bordered no-margin">
					<tbody>
					<tr class="active">
					<th class="text-center col-xs-3">구분</th>
					<th class="text-center col-xs-7">대상지정</th>
					<th class="text-center">제외</th>
					</tr>
					
					<tr>
					<th class="text-center">
						게시판 그룹
					</th>
					<td>
						<input type="text" name="wset[gr_list]" value="<?php echo $wset['gr_list'] ?>" class="form-control" placeholder="그룹아이디(gr_id)">
					</td>
					<td class="text-center">
						<input type="checkbox" name="wset[gr_except]" value="1"<?php echo get_checked('1', $wset['gr_except'])?> class="no-margin">
					</td>
					</tr>

					<tr>
					<th class="text-center">
						게시판
					</th>
					<td>
						<input type="text" name="wset[bo_list]" value="<?php echo $wset['bo_list'] ?>" class="form-control" placeholder="게시판아이디(bo_table)">
					</td>
					<td class="text-center">
						<input type="checkbox" name="wset[bo_except]" value="1"<?php echo get_checked('1', $wset['bo_except'])?> class="no-margin">
					</td>
					</tr>

					<tr>
					<th class="text-center">
						분류
					</th>
					<td>
						<input type="text" name="wset[ca_list]" value="<?php echo $wset['ca_list'] ?>" class="form-control" placeholder="분류명">
					</td>
					<td class="text-center">
						<input type="checkbox" name="wset[ca_except]" value="1"<?php echo get_checked('1', $wset['ca_except'])?> class="no-margin">
					</td>
					</tr>

					<tr>
					<th class="text-center">
						회원
					</th>
					<td>
						<input type="text" name="wset[mb_list]" value="<?php echo $wset['mb_list'] ?>" class="form-control" placeholder="회원아이디(mb_id)">
					</td>
					<td class="text-center">
						<input type="checkbox" name="wset[mb_except]" value="1"<?php echo get_checked('1', $wset['mb_except'])?> class="no-margin">
					</td>
					</tr>

					</tbody>
					</table>
				</div>
				<p class="help-block">
					콤마(,)로 구분해서 복수 등록 가능하며, 분류는 단일 게시판 추출만 됨
				</p>
			</div>
		</div>
	</li>

</ul>

<div class="h30"></div>

<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// input의 name을 boset[배열키] 형태로 등록
?>

<div class="form-group">
	<label class="col-sm-2 control-label">출력 설정</label>
	<div class="col-sm-10">
		<div class="table-responsive">
			<table class="table table-bordered no-margin">
			<tbody>
			<tr class="active">
			<th class="text-center col-xs-3">상단라인</th>
			<th class="text-center col-xs-3">새글색상</th>
			<th class="text-center">비고</th>
			</tr>
			<tr>
			<td>
				<select name="boset[head_line]" class="form-control">
					<option value="">선택해 주세요</option>
					<?php echo na_color_options($boset['head_line']);?>
				</select>
			</td>
			<td>
				<select name="boset[new]" class="form-control">
					<option value="">선택해 주세요</option>
					<?php echo na_color_options($boset['new']);?>
				</select>
			</td>
			<td>
				&nbsp;
			</td>
			</tr>
			</tbody>
			</table>
		</div>
	</div>
</div>

<div class="h15"></div>

<div class="form-group">
	<label class="col-sm-2 control-label">이미지 설정</label>
	<div class="col-sm-10">
		<div class="table-responsive">
			<table class="table table-bordered no-margin">
			<tbody>
			<tr class="active">
			<th class="text-center col-xs-3">썸네일 너비</th>
			<th class="text-center col-xs-3">썸네일 높이</th>
			<th class="text-center col-xs-3">기본높이</th>
			<th class="text-center">비고</th>
			</tr>
			<tr>
			<td>
				<div class="input-group">
					<input type="text" name="boset[thumb_w]" value="<?php echo $boset['thumb_w'] ?>" class="form-control">
					<span class="input-group-addon">px</span>
				</div>
			</td>
			<td class="text-center">
				<div class="input-group">
					<input type="text" name="boset[thumb_h]" value="<?php echo $boset['thumb_h'] ?>" class="form-control">
					<span class="input-group-addon">px</span>
				</div>
			</td>
			<td>
				<div class="input-group">
					<input type="text" name="boset[thumb_d]" value="<?php echo $boset['thumb_d'] ?>" class="form-control">
					<span class="input-group-addon">%</span>
				</div>
			</td>
			<td>
				&nbsp;
			</td>
			</tr>
			</tbody>
			</table>
		</div>
		<p class="help-block">
			기본 높이는 썸네일 높이를 0으로 설정시 적용되는 값을 말함
		</p>
	</div>
</div>

<div class="h15"></div>

<div class="form-group">
	<label class="col-sm-2 control-label">가로 갯수</label>
	<div class="col-sm-10">
		<div class="table-responsive">
			<table class="table table-bordered no-margin">
			<tbody>
			<tr class="active">
				<th class="text-center col-xs-3">기본</th>
				<th class="text-center col-xs-3">1200px 이하</th>
				<th class="text-center col-xs-2">992px 이하</th>
				<th class="text-center col-xs-2">768px 이하</th>
				<th class="text-center">480px 이하</th>
			</tr>
			<tr>
			<td>
				<div class="input-group">
					<input name="boset[item]" value="<?php echo ($boset['item']) ? $boset['item'] : '4'; ?>" class="form-control">
					<span class="input-group-addon">개</span>
				</div>
			</td>
			<td>
				<div class="input-group">
					<input name="boset[lg]" value="<?php echo ($boset['lg']) ? $boset['lg'] : '4'; ?>" class="form-control">
					<span class="input-group-addon">개</span>
				</div>
			</td>
			<td>
				<div class="input-group">
					<input name="boset[md]" value="<?php echo ($boset['md']) ? $boset['md'] : '3'; ?>" class="form-control">
					<span class="input-group-addon">개</span>
				</div>
			</td>
			<td>
				<div class="input-group">
					<input name="boset[sm]" value="<?php echo ($boset['sm']) ? $boset['sm'] : '3'; ?>" class="form-control">
					<span class="input-group-addon">개</span>
				</div>
			</td>
			<td>
				<div class="input-group">
					<input name="boset[xs]" value="<?php echo ($boset['xs']) ? $boset['xs'] : '2'; ?>" class="form-control">
					<span class="input-group-addon">개</span>
				</div>
			</td>
			</tr>
			</tbody>
			</table>
		</div>
	</div>
</div>

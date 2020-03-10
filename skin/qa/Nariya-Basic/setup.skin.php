<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// input의 name을 wset[배열키] 형태로 등록
?>
<ul class="list-group">
	<li class="list-group-item">

		<div class="form-group">
			<label class="col-sm-2 control-label">출력설정</label>
			<div class="col-sm-10">

				<div class="table-responsive">
					<table class="table table-bordered no-margin">
					<tbody>
					<tr class="active">
						<th class="text-center col-xs-3">구분</th>
						<th class="text-center col-xs-3">설정</th>
						<th class="text-center">비고</th>
					</tr>
					<tr>
						<th class="text-center">
							헤드스킨
						</th>
						<td class="text-center">
							<select name="wset[head_skin]" class="form-control">
								<option value="">기본헤드</option>
							<?php
								$skinlist = na_file_list(NA_PLUGIN_PATH.'/skin/head', 'css');
								for ($k=0; $k<count($skinlist); $k++) {
									echo "<option value=\"".$skinlist[$k]."\"".get_selected($wset['head_skin'], $skinlist[$k]).">".$skinlist[$k]."</option>\n";
								} 
							?>
							</select>
						</td>
						<td class="text-muted">
							&nbsp;
						</td>
					</tr>
					<tr>
						<th class="text-center">
							헤드컬러
						</th>
						<td class="text-center">
							<select name="wset[head_color]" class="form-control">
								<option value="">선택해 주세요</option>
								<?php echo na_color_options($wset['head_color']);?>
							</select>
						</td>
						<td class="text-muted">
							헤드스킨이 "기본헤드"일 경우에만 적용됨
						</td>
					</tr>
					<tr>
						<th class="text-center">
							기본컬러
						</th>
						<td class="text-center">
							<select name="wset[color]" class="form-control">
								<option value="">선택해 주세요</option>
								<?php echo na_color_options($wset['color']);?>
							</select>
						</td>
						<td class="text-muted">
							검색 아이콘, 페이지네이션 등
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
			<label class="col-sm-2 control-label">카테고리</label>
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
							<input name="wset[cw]" value="<?php echo ($wset['cw']) ? $wset['cw'] : 7; ?>" class="form-control">
							<span class="input-group-addon">개</span>
						</div>
					</td>
					<td>
						<div class="input-group">
							<input name="wset[cwlg]" value="<?php echo ($wset['cwlg']) ? $wset['cwlg'] : 6; ?>" class="form-control">
							<span class="input-group-addon">개</span>
						</div>
					</td>
					<td>
						<div class="input-group">
							<input name="wset[cwmd]" value="<?php echo ($wset['cwmd']) ? $wset['cwmd'] : 5; ?>" class="form-control">
							<span class="input-group-addon">개</span>
						</div>
					</td>
					<td>
						<div class="input-group">
							<input name="wset[cwsm]" value="<?php echo ($wset['cwsm']) ? $wset['cwsm'] : 4; ?>" class="form-control">
							<span class="input-group-addon">개</span>
						</div>
					</td>
					<td>
						<div class="input-group">
							<input name="wset[cwxs]" value="<?php echo ($wset['cwxs']) ? $wset['cwxs'] : 3; ?>" class="form-control">
							<span class="input-group-addon">개</span>
						</div>
					</td>
					</tr>
					</tbody>
					</table>
				</div>
				<p class="help-block">
					반응구간별 카테고리 가로갯수는 최대 12까지 입력가능
				</p>
			</div>
		</div>
	</li>

</ul>
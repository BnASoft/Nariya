<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// input의 name을 boset[배열키] 형태로 등록

$boset['list_skin'] = ($boset['list_skin']) ? $boset['list_skin'] : 'basic';

?>
<script>
function na_change_skin(id, type, skin) {
	var url = "<?php echo NA_PLUGIN_URL ?>/theme/skin_list.php?bo_table=<?php echo $bo_table ?>&type="+type+"&skin="+skin;
	$.get(url, function (data) {
		$("#"+id).html(data);
	});
}
</script>

<ul class="list-group">
	<li class="list-group-item bg-light">
		<div class="row row-15">
			<div class="col-sm-2 col-15">
				 <p class="form-control-static">
					<b>목록스킨</b>
				</p>
			</div>
			<div class="col-sm-4 col-15">
				<select name="boset[list_skin]" onchange="na_change_skin('list_skin', 'list', this.value);" class="form-control">
				<?php
					$skinlist = na_dir_list($board_skin_path.'/list');
					$boset['list_skin'] = (is_dir($board_skin_path.'/list/'.$boset['list_skin'])) ? $boset['list_skin'] : $skinlist[0];
					for ($k=0; $k<count($skinlist); $k++) {
						echo '<option value="'.$skinlist[$k].'"'.get_selected($skinlist[$k], $boset['list_skin']).'>'.$skinlist[$k].'</option>'.PHP_EOL;
					} 
				?>
				</select>
			</div>
			<div class="col-sm-6 col-15">
				 <p class="form-control-static">
					보드스킨 내 /list 폴더의 하위 폴더들
				</p>
			</div>
		</div>
	</li>
	<li class="list-group-item">
		<div id="list_skin">
			<?php @include_once($board_skin_path.'/list/'.$boset['list_skin'].'/setup.skin.php');?>
		</div>
	</li>
	<li class="list-group-item bg-light">
		<b>기본설정</b>
	</li>
	<li class="list-group-item">
		<div class="form-group">
			<label class="col-sm-2 control-label">출력설정</label>
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
							기본 컬러
						</th>
						<td class="text-center">
							<select name="boset[color]" class="form-control">
								<option value="">선택해 주세요</option>
								<?php echo na_color_options($boset['color']);?>
							</select>
						</td>
						<td class="text-muted">
							버튼, 페이지네이션 등 컬러
						</td>
					</tr>
					<tr>
						<th class="text-center">
							검색창 보이기
						</th>
						<td class="text-center">
							<input type="checkbox" name="boset[search_open]" value="1"<?php echo get_checked('1', $boset['search_open'])?> class="chk-margin">
						</td>
						<td class="text-muted">
							글목록 상단에 검색창이 보이도록 출력함
						</td>
					</tr>
					<tr>
						<th class="text-center">
							댓글목록 숨김
						</th>
						<td class="text-center">
							<input type="checkbox" name="boset[hide_clist]" value="1"<?php echo get_checked('1', $boset['hide_clist'])?> class="chk-margin">
						</td>
						<td class="text-muted">
							댓글목록을 숨김상태로 출력함
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
							<input name="boset[cw]" value="<?php echo ($boset['cw']) ? $boset['cw'] : 7; ?>" class="form-control">
							<span class="input-group-addon">개</span>
						</div>
					</td>
					<td>
						<div class="input-group">
							<input name="boset[cwlg]" value="<?php echo ($boset['cwlg']) ? $boset['cwlg'] : 6; ?>" class="form-control">
							<span class="input-group-addon">개</span>
						</div>
					</td>
					<td>
						<div class="input-group">
							<input name="boset[cwmd]" value="<?php echo ($boset['cwmd']) ? $boset['cwmd'] : 5; ?>" class="form-control">
							<span class="input-group-addon">개</span>
						</div>
					</td>
					<td>
						<div class="input-group">
							<input name="boset[cwsm]" value="<?php echo ($boset['cwsm']) ? $boset['cwsm'] : 4; ?>" class="form-control">
							<span class="input-group-addon">개</span>
						</div>
					</td>
					<td>
						<div class="input-group">
							<input name="boset[cwxs]" value="<?php echo ($boset['cwxs']) ? $boset['cwxs'] : 3; ?>" class="form-control">
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


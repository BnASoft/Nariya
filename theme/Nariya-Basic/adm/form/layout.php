<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// input의 name - co:공통, pc:PC용, mo:모바일용
// pc와 mo는 같은 배열키를 가져야 하고, co와는 같으면 안됨(같을 경우 덮어씀)

?>

<ul class="list-group">
	<li class="list-group-item list-head bg-na-navy">
		<b>레이아웃 설정</b>
	</li>

	<li class="list-group-item">
		<div class="form-group">
			<label class="col-sm-2 control-label">컨텐츠 설정</label>
			<div class="col-sm-10">

				<div class="table-responsive">
					<table class="table table-bordered no-margin">
					<tbody>
					<tr class="active">
					<th class="text-center col-xs-2">구분</th>
					<th class="text-center col-xs-3">PC 설정</th>
					<th class="text-center col-xs-3">모바일 설정</th>
					<th class="text-center">비고</th>
					</tr>

					<?php
					// 컨텐츠는 한 번에 처리...ㅠㅠ
					$area = array('top', 'lnb', 'header', 'menu', 'wing', 'footer', 'sidebar');
					$area_txt = array('상단 배너', '상단 네비', 'PC 헤더', '모바일 헤더, PC 메뉴', '좌우 배너', '하단 네비', '모바일 메뉴');
					for($z=0;$z<count($area);$z++) {
						$n = $area[$z];
					?>
						<tr>
						<th class="text-center">
							<?php echo strtoupper($n) ?>
						</th>
						<td>
							<select name="pc[<?php echo $n ?>]" class="form-control">
								<option value="">선택해 주세요</option>
								<?php 
								unset($skins);
								$skins = na_dir_list(G5_THEME_PATH.'/layout/'.$n);
								for ($i=0; $i<count($skins); $i++) { 
								?>
									<option value="<?php echo $skins[$i] ?>"<?php echo get_selected($pc[$n], $skins[$i]) ?>><?php echo $skins[$i] ?></option>
								<?php } ?>
							</select>
						</td>
						<td>
							<select name="mo[<?php echo $n ?>]" class="form-control">
								<option value="">선택해 주세요</option>
								<?php for ($i=0; $i<count($skins); $i++) { // $skins PC랑 같은 배열임 ?>
									<option value="<?php echo $skins[$i] ?>"<?php echo get_selected($mo[$n], $skins[$i]) ?>><?php echo $skins[$i] ?></option>
								<?php } ?>
							</select>
						</td>
						<td class="text-muted">
							/layout/<?php echo $n ?> 폴더
							→
							<?php echo $area_txt[$z] ?>
						</td>
						</tr>
					<?php } ?>

					</tbody>
					</table>
				</div>				

			</div>
		</div>
	</li>

	<li class="list-group-item">
		<div class="form-group">
			<label class="col-sm-2 control-label">레이아웃 설정</label>
			<div class="col-sm-10">

				<div class="table-responsive">
					<table class="table table-bordered no-margin">
					<tbody>
					<tr class="active">
					<th class="text-center col-xs-2">구분</th>
					<th class="text-center col-xs-3">PC 설정</th>
					<th class="text-center col-xs-3">모바일 설정</th>
					<th class="text-center">비고</th>
					</tr>
					<?php if($mode == 'page') { //페이지 설정용 ?>
					<tr>
					<th class="text-center">
						헤드/테일 숨김
					</th>
					<td class="text-center">
						<input type="checkbox" name="pc[page_sub]" value="1"<?php echo get_checked('1', $pc['page_sub'])?> class="chk-margin">
					</td>
					<td class="text-center">
						<input type="checkbox" name="mo[page_sub]" value="1"<?php echo get_checked('1', $mo['page_sub'])?> class="chk-margin">
					</td>
					<td class="text-muted">
						사이트의 헤드와 테일을 출력하지 않음
					</td>
					</tr>
					<?php } ?>
					<tr>
					<th class="text-center">
						타입
					</th>
					<td>
						<select name="pc[layout]" class="form-control">
							<option value="">선택해 주세요</option>
							<option value="wide"<?php echo get_selected('wide', $pc['layout']) ?>>와이드형</option>
							<option value="boxed"<?php echo get_selected('boxed', $pc['layout']) ?>>박스형</option>
						</select>
					</td>
					<td>
						<select name="mo[layout]" class="form-control">
							<option value="">선택해 주세요</option>
							<option value="wide"<?php echo get_selected('wide', $mo['layout']) ?>>와이드형</option>
							<option value="boxed"<?php echo get_selected('boxed', $mo['layout']) ?>>박스형</option>
						</select>
					</td>
					<td class="text-muted">
						&nbsp;
					</td>
					</tr>

					<tr>
					<th class="text-center">
						스타일
					</th>
					<td>
						<select name="pc[style]" class="form-control">
							<option value="">선택해 주세요</option>
							<option value="0"<?php echo get_selected('0', $pc['style']) ?>>둥근형</option>
							<option value="1"<?php echo get_selected('1', $pc['style']) ?>>사각형</option>
						</select>
					</td>
					<td>
						<select name="mo[style]" class="form-control">
							<option value="">선택해 주세요</option>
							<option value="0"<?php echo get_selected('0', $mo['style']) ?>>둥근형</option>
							<option value="1"<?php echo get_selected('1', $mo['style']) ?>>사각형</option>
						</select>
					</td>
					<td class="text-muted">
						입력폼, 버튼, 판넬 등 스타일
					</td>
					</tr>

					<tr>
					<th class="text-center">
						사이즈
					</th>
					<td>
						<div class="input-group">
							<input type="text" class="form-control" name="pc[size]" value="<?php echo $pc['size'] ?>">
							<span class="input-group-addon">px</span>
						</div>
					</td>
					<td>
						<div class="input-group">
							<input type="text" class="form-control" name="mo[size]" value="<?php echo $mo['size'] ?>">
							<span class="input-group-addon">px</span>
						</div>
					</td>
					<td class="text-muted">
						기본값 1100px
					</td>
					</tr>
					
					<tr>
					<th class="text-center">
						비반응형
					</th>
					<td class="text-center">
						<?php if($mode == 'site') { //사이트 설정용 ?>
							<input type="checkbox" name="pc[no_res]" value="1"<?php echo get_checked('1', $pc['no_res'])?> class="chk-margin">
						<?php } else { ?>
							<select name="pc[no_res]" class="form-control">
								<option value="">선택해 주세요.</option>
								<option value="0"<?php echo get_selected('0', $pc['no_res']) ?>>사용안함</option>
								<option value="1"<?php echo get_selected('1', $pc['no_res']) ?>>사용함</option>
							</select>
						<?php } ?>
					</td>
					<td class="text-center">
						<input type="checkbox" name="mo[no_res]" value="1" disabled class="chk-margin">
					</td>
					<td class="text-muted">
						모바일은 반응형 고정
					</td>
					</tr>

					<tr>
					<th class="text-center">
						메뉴고정
					</th>
					<td class="text-center">
						<?php if($mode == 'site') { //사이트 설정용 ?>
							<input type="checkbox" name="pc[sticky]" value="1"<?php echo get_checked('1', $pc['sticky'])?> class="chk-margin">
						<?php } else { ?>
							<select name="pc[sticky]" class="form-control">
								<option value="">선택해 주세요.</option>
								<option value="0"<?php echo get_selected('0', $pc['sticky']) ?>>사용안함</option>
								<option value="1"<?php echo get_selected('1', $pc['sticky']) ?>>사용함</option>
							</select>
						<?php } ?>
					</td>
					<td class="text-center">
						<?php if($mode == 'site') { //사이트 설정용 ?>
							<input type="checkbox" name="mo[sticky]" value="1"<?php echo get_checked('1', $mo['sticky'])?> class="chk-margin">
						<?php } else { ?>
							<select name="mo[sticky]" class="form-control">
								<option value="">선택해 주세요.</option>
								<option value="0"<?php echo get_selected('0', $mo['sticky']) ?>>사용안함</option>
								<option value="1"<?php echo get_selected('1', $mo['sticky']) ?>>사용함</option>
							</select>
						<?php } ?>
					</td>
					<td class="text-muted">
						페이지 상단 또는 하단에 메뉴고정
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
			<label class="col-sm-2 control-label">배경 설정</label>
			<div class="col-sm-10">

				<div class="table-responsive">
					<table class="table table-bordered no-margin">
					<tbody>
					<tr class="active">
					<th class="text-center col-xs-2">구분</th>
					<th class="text-center col-xs-3">PC 설정</th>
					<th class="text-center col-xs-3">모바일 설정</th>
					<th class="text-center">비고</th>
					</tr>

					<tr>
					<th class="text-center">
						배경화면
					</th>
					<td>
						<div class="input-group">
							<input type="text" id="body-bg-pc" class="form-control" name="pc[background]" value="<?php echo $pc['background'] ?>" placeholder="http://...">
							<a href="<?php echo na_theme_href('image', 'bg', 'body-bg-pc') ?>" class="btn btn-default input-group-addon btn-setup">
								<i class="fa fa-search"></i>
							</a>
						</div>
					</td>
					<td>
						<div class="input-group">
							<input type="text" id="body-bg-mo" class="form-control" name="mo[background]" value="<?php echo $mo['background'] ?>" placeholder="http://...">
							<a href="<?php echo na_theme_href('image', 'bg', 'body-bg-mo') ?>" class="btn btn-default input-group-addon btn-setup">
								<i class="fa fa-search"></i>
							</a>
						</div>
					</td>
					<td class="text-muted">
						&nbsp;
					</td>
					</tr>

					<tr>
					<th class="text-center">
						배경옵션
					</th>
					<td>
						<select name="pc[bg]" class="form-control">
							<option value="">선택해 주세요</option>
							<option value="0"<?php echo get_selected('0', $pc['bg']) ?>>사용안함</option>
							<option value="center"<?php echo get_selected('center', $pc['bg']) ?>>중앙고정</option>
							<option value="top"<?php echo get_selected('top', $pc['bg']) ?>>상단고정</option>
							<option value="bottom"<?php echo get_selected('bottom', $pc['bg']) ?>>하단고정</option>
							<option value="pattern"<?php echo get_selected('pattern', $pc['bg']) ?>>패턴배경</option>
						</select>
					</td>
					<td>
						<select name="mo[bg]" class="form-control">
							<option value="">선택해 주세요</option>
							<option value="0"<?php echo get_selected('', $mo['bg']) ?>>사용안함</option>
							<option value="center"<?php echo get_selected('center', $mo['bg']) ?>>중앙고정</option>
							<option value="top"<?php echo get_selected('top', $mo['bg']) ?>>상단고정</option>
							<option value="bottom"<?php echo get_selected('bottom', $mo['bg']) ?>>하단고정</option>
							<option value="pattern"<?php echo get_selected('pattern', $mo['bg']) ?>>패턴배경</option>
						</select>
					</td>
					<td class="text-muted">
						&nbsp;
					</td>
					</tr>

					</tbody>
					</table>
				</div>				
				<p class="help-block">
					배경은 박스형 레이아웃 스타일에서만 적용됩니다.
				</p>
			</div>
		</div>
	</li>

</ul>

<?php echo $btn_submit ?>
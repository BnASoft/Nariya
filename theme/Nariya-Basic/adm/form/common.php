<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// input의 name - co:공통, pc:PC용, mo:모바일용
// pc와 mo는 같은 배열키를 가져야 하고, co와는 같으면 안됨(같을 경우 덮어씀)

?>

<ul class="list-group">
	<li class="list-group-item list-head bg-na-navy">
		<b>기본 설정</b>
	</li>
	<?php if($mode == 'site') { //사이트 설정용 ?>
	<li class="list-group-item">
		<div class="form-group">
			<label class="col-sm-2 control-label">필독사항</label>
			<div class="col-sm-10">
				<p class="form-control-static">
					<a data-toggle="collapse" href="#pre_work" aria-expanded="false" aria-controls="pre_work">
						<span class="text-muted">테마 사용에 있어 반드시 알고 계셔야 하는 내용으로 클릭해 주세요.</span>
					</a>
				</p>
				<div class="collapse" id="pre_work">
					<div class="table-responsive">
						<table class="table table-bordered no-margin">
						<tbody>
						<tr class="active">
						<th class="text-center col-xs-2">구분</th>
						<th class="text-center">작업내용</th>
						</tr>
						<tr>
						<th class="text-center">
							스킨변경
						</th>
						<td>
							<ol>
								<li>스킨은 PC 스킨(1:1문의, 내용관리 제외)만 설정해 주면 됩니다.</li>
								<li>환경설정 > 기본환경설정에서 최근게시물, 검색, 접속자, FAQ, 회원스킨을 Nariya-Basic 으로 변경해 주세요.</li>
								<li>게시판관리 > 게시판관리에서 각 게시판 스킨을 Nariya-Basic 으로 변경해 주세요.</li>
								<li>게시판관리 > 내용관리에서 각 문서의 PC/모바일 스킨을 Nariya-Basic 으로 변경해 주세요.</li>
								<li>게시판관리 > 1:1문의설정에서 PC/모바일 스킨을 Nariya-Basic 으로 변경해 주세요.</li>
							</ol>
						</td>
						</tr>
						<tr>
						<th class="text-center">
							내용관리
						</th>
						<td>
							<ol>
								<li>등록 또는 신규 생성한 내용관리 문서의 PC/모바일 스킨을 Nariya-Basic 으로 적용해 주세요.</li>
								<li>게시판관리 > 내용관리에서 다음의 아이디(co_id)로 문서를 등록해 주세요.
									<table class="table table-bordered" style="margin:10px 0;">
									<tbody>
									<tr class="active">
										<th class="text-center">사이트 소개</th>
										<th class="text-center">이용약관</th>
										<th class="text-center">개인정보처리방침</th>
										<th class="text-center">이메일 무단수집거부</th>
										<th class="text-center">책임의 한계와 법적고지</th>
										<th class="text-center">이용안내</th>
									</tr>
									<tr>
										<td class="text-center">company</td>
										<td class="text-center">provision</td>
										<td class="text-center">privacy</td>
										<td class="text-center">noemail</td>
										<td class="text-center">disclaimer</td>
										<td class="text-center">guide</td>
									</tr>
									</tbody>
									</table>
								</li>
								<li><b>문서아이디(co_id)와 테마 내 /page 폴더의 php 파일명이 같으면 테마 내 /page 폴더의 php 파일이 출력</b>됩니다.</li>
							</ol>
						</td>
						</tr>
						<tr>
						<th class="text-center">
							그룹메인
						</th>
						<td>
							<ol>
								<li>기본은 테마 내 group.php 파일이 출력됩니다.</li>
								<li><b>그룹아이디(gr_id)와 테마 내 /group 폴더의 php 파일명이 같으면 테마 내 /group 폴더의 php 파일이 출력</b>됩니다.</li>
							</ol>
						</td>
						</tr>
						</tbody>
						</table>
					</div>
				</div>

			</div>
		</div>
	</li>
	<?php } //사이트 설정용 ?>

	<?php if($mode == 'page') { //페이지 설정용 ?>
	<li class="list-group-item" style="padding-top:10px; padding-bottom:5px;">
		<div class="form-group">
			<label class="col-sm-2 control-label">주의사항</label>
			<div class="col-sm-10">
				<p class="form-control-static">
					<b>사이트 기본설정과 다른 것만 설정해 주세요!</b> 같은데 설정하면 기본설정 변경시 페이지 설정도 다 변경해야 합니다.
				</p>
			</div>
		</div>
	</li>
	<?php } ?>

	<li class="list-group-item">
		<div class="form-group">
			<label class="col-sm-2 control-label">SEO 설정</label>
			<div class="col-sm-10">
				<div class="table-responsive">
					<table class="table table-bordered no-margin">
					<tbody>
					<tr class="active">
					<th class="text-center col-xs-2">구분</th>
					<th class="text-center col-xs-6">설정</th>
					<th class="text-center">비고</th>
					</tr>
					<?php if($mode == 'site') { //사이트 설정용 ?>
					<tr>
					<th class="text-center">
						SEO 사용
					</th>
					<td class="text-center">
						<input type="checkbox" name="co[seo]" value="1"<?php echo get_checked('1', $pc['seo'])?> class="chk-margin">
					</td>
					<td class="text-muted">
						미설정시 자동 SEO를 사용하지 않음
					</td>
					</tr>
					<?php } ?>
					<tr>
					<th class="text-center">
						설명글
					</th>
					<td>
						<textarea name="co[seo_desc]" rows="5" class="form-control"><?php echo $pc['seo_desc'] ?></textarea>		
					</td>
					<td class="text-muted">
						한글 기준 160자 이내 등록
					</td>
					</tr>
					<tr>
					<th class="text-center">
						키워드
					</th>
					<td>
						<textarea name="co[seo_keys]" rows="5" class="form-control" placeholder="콤마(,)로 키워드 구분"><?php echo $pc['seo_keys'] ?></textarea>		
					</td>
					<td class="text-muted">
						미설정시 내용에서 3글자 이상인<br> 한글로 최대 20개까지 키워드 자동생성
					</td>
					<tr>
					<th class="text-center">
						이미지
					</th>						
					<td>
						<div class="input-group">
							<input type="text" id="seo-img" class="form-control" name="co[seo_img]" value="<?php echo $pc['seo_img'] ?>" placeholder="http://...">
							<a href="<?php echo na_theme_href('image', 'seo', 'seo-img') ?>" class="btn btn-default input-group-addon btn-setup">
								<i class="fa fa-search"></i>
							</a>
						</div>
					</td>
					<td class="text-muted">
						내용에 이미지가 있으면 내용 이미지 자동 적용
					</td>
					</tr>
					</tbody>
					</table>
				</div>
				<p class="help-block">
					SEO에 출력되는 항목 수정은 /plugin/nariya/theme/seo.php 파일에서 할 수 있습니다.
				</p>
			</div>
		</div>
	</li>

	<?php if($mode == 'page') { //페이지 설정용 
			// 아이콘 선택기
			na_script('iconpicker');
	?>
	<li class="list-group-item">
		<div class="form-group">
			<label class="col-sm-2 control-label">타이틀 설정</label>
			<div class="col-sm-10">
				<div class="table-responsive">
					<table class="table table-bordered no-margin">
					<tbody>
					<tr class="active">
					<th class="text-center col-xs-2">구분</th>
					<th class="text-center">설정</th>
					</tr>
					<tr>
					<th class="text-center">
						타이틀 이름
					</th>
					<td>
						<div class="input-group">
							<span class="input-group-btn">
								<button id="page_icon" type="button" class="btn btn-default" data-icon="<?php echo $pc['page_icon'] ?>" data-iconset="fontawesome" name="co[page_icon]"></button>
							</span>
							<input type="text" name="co[page_title]" value="<?php echo $pc['page_title'] ?>" class="form-control">
						</div>
						<script>
						$('#page_icon').iconpicker();
						</script>
					</td>
					</tr>
					<tr>
					<th class="text-center">
						타이틀 설명
					</th>
					<td>
						<input type="text" name="co[page_desc]" value="<?php echo $pc['page_desc'] ?>" class="form-control">
					</td>
					</tr>
					</tbody>
					</table>
				</div>
				<p class="help-block">
					타이틀 스킨에서 사용되며, 출력하지 않을 경우 아래 타이틀 스킨을 none 으로 설정해 주세요.
				</p>
			</div>
		</div>
	</li>
	<?php } ?>

	<?php if($mode == 'site') { //사이트 설정용 ?>
	<li class="list-group-item">
		<div class="form-group">
			<label class="col-sm-2 control-label">로고 설정</label>
			<div class="col-sm-10">
				<div class="table-responsive">
					<table class="table table-bordered no-margin">
					<tbody>
					<tr class="active">
					<th class="text-center col-xs-2">구분</th>
					<th class="text-center col-xs-6">설정</th>
					<th class="text-center">비고</th>
					</tr>
					<tr>
					<th class="text-center">
						이미지 로고
					</th>
					<td class="text-center">
						<div class="input-group">
							<input type="text" id="theme-logo-img" class="form-control" name="co[logo_img]" value="<?php echo $pc['logo_img'] ?>" placeholder="http://...">
							<a href="<?php echo na_theme_href('image', 'logo', 'theme-logo-img') ?>" class="btn btn-default input-group-addon btn-setup">
								<i class="fa fa-search"></i>
							</a>
						</div>
					</td>
					<td class="text-muted">
						주로 PC 상단의 메인로고로 사용됨
					</td>
					</tr>
					<tr>
					<th class="text-center">
						텍스트 로고
					</th>
					<td>
						<textarea name="co[logo_text]" rows="5" class="form-control" placeholder="text..."><?php echo $pc['logo_text'] ?></textarea>		
					</td>
					<td class="text-muted">
						주로 모바일 상단의 메인로고로 사용됨
					</td>
					</tr>
					<tr>
					<th class="text-center">
						로고 배경색
					</th>
					<td>
						<select name="co[logo_color]" class="form-control">
							<option value="">선택해 주세요</option>
							<?php echo na_color_options($pc['logo_color']);?>
						</select>
					</td>
					<td class="text-muted">
						주로 모바일 상단 헤더 영역 컬러로 사용됨
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
			<label class="col-sm-2 control-label">캐시 설정</label>
			<div class="col-sm-10">
				<div class="table-responsive">
					<table class="table table-bordered no-margin">
					<tbody>
					<tr class="active">
					<th class="text-center col-xs-2">구분</th>
					<th class="text-center col-xs-3">설정</th>
					<th class="text-center">비고</th>
					</tr>
					<tr>
					<th class="text-center">
						통계 캐시
					</th>
					<td class="text-center">
						<div class="input-group">
							<input type="text" class="form-control" name="co[stats]" value="<?php echo $pc['stats'] ?>">
							<span class="input-group-addon">분 간격</span>
						</div>
					</td>
					<td class="text-muted">
						미설정시 방문자 통계만 출력됨
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
			<label class="col-sm-2 control-label">인덱스(메인) 설정</label>
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
						인덱스 파일
					</th>
					<td>
						<select name="pc[index]" class="form-control">
							<option value="">선택해 주세요</option>
							<?php 
							unset($skins);
							$skins = na_file_list(G5_THEME_PATH.'/index', 'php');
							for ($i=0; $i<count($skins); $i++) { 
							?>
								<option value="<?php echo $skins[$i] ?>"<?php echo get_selected($pc['index'], $skins[$i]) ?>><?php echo $skins[$i] ?></option>
							<?php } ?>
						</select>
					</td>
					<td>
						<select name="mo[index]" class="form-control">
							<option value="">선택해 주세요</option>
							<?php for ($i=0; $i<count($skins); $i++) { // $skins PC랑 같은 배열임 ?>
								<option value="<?php echo $skins[$i] ?>"<?php echo get_selected($mo['index'], $skins[$i]) ?>><?php echo $skins[$i] ?></option>
							<?php } ?>
						</select>
					</td>
					<td class="text-muted">
						/index 폴더 내 php 파일
					</td>
					</tr>

					</tbody>
					</table>
				</div>				

			</div>
		</div>
	</li>

	<?php } ?>

	<li class="list-group-item">
		<div class="form-group">
			<label class="col-sm-2 control-label">페이지 설정</label>
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
						타이틀 스킨
					</th>
					<td>
						<select name="pc[title]" class="form-control">
							<option value="">선택해 주세요</option>
							<?php 
							unset($skins);
							$skins = na_dir_list(G5_THEME_PATH.'/layout/title');
							for ($i=0; $i<count($skins); $i++) { 
							?>
								<option value="<?php echo $skins[$i] ?>"<?php echo get_selected($pc['title'], $skins[$i]) ?>><?php echo $skins[$i] ?></option>
							<?php } ?>
						</select>
					</td>
					<td>
						<select name="mo[title]" class="form-control">
							<option value="">선택해 주세요</option>
							<?php for ($i=0; $i<count($skins); $i++) { // $skins PC랑 같은 배열임 ?>
								<option value="<?php echo $skins[$i] ?>"<?php echo get_selected($mo['title'], $skins[$i]) ?>><?php echo $skins[$i] ?></option>
							<?php } ?>
						</select>
					</td>
					<td class="text-muted">
						/layout/title 폴더
					</td>
					</tr>

					<tr>
					<th class="text-center">
						타이틀 이미지
					</th>
					<td>
						<div class="input-group">
							<input type="text" id="page-img-pc" class="form-control" name="pc[page_img]" value="<?php echo $pc['page_img'] ?>" placeholder="http://...">
							<a href="<?php echo na_theme_href('image', 'page', 'page-img-pc') ?>" class="btn btn-default input-group-addon btn-setup">
								<i class="fa fa-search"></i>
							</a>
						</div>
					</td>
					<td>
						<div class="input-group">
							<input type="text" id="page-img-mo" class="form-control" name="mo[page_img]" value="<?php echo $mo['page_img'] ?>" placeholder="http://...">
							<a href="<?php echo na_theme_href('image', 'page', 'page-img-mo') ?>" class="btn btn-default input-group-addon btn-setup">
								<i class="fa fa-search"></i>
							</a>
						</div>
					</td>
					<td class="text-muted">
						타이틀 배경 등 다양하게 사용
					</td>
					</tr>

					<tr>
					<th class="text-center">
						칼럼(다단)
					</th>
					<td>
						<select name="pc[page]" class="form-control">
							<option value="">선택해 주세요.</option>
							<option value="9"<?php echo get_selected('9', $pc['page']) ?>>2단 - 기본 사이드</option>
							<option value="8"<?php echo get_selected('8', $pc['page']) ?>>2단 - 중간 사이드</option>
							<option value="7"<?php echo get_selected('7', $pc['page']) ?>>2단 - 대형 사이드</option>
							<option value="12"<?php echo get_selected('12', $pc['page']) ?>>1단 - 박스형</option>
							<option value="13"<?php echo get_selected('13', $pc['page']) ?>>1단 - 와이드</option>
						</select>
					</td>
					<td>
						<select name="mo[page]" class="form-control">
							<option value="">선택해 주세요.</option>
							<option value="9"<?php echo get_selected('9', $mo['page']) ?>>2단 - 기본 사이드</option>
							<option value="8"<?php echo get_selected('8', $mo['page']) ?>>2단 - 중간 사이드</option>
							<option value="7"<?php echo get_selected('7', $mo['page']) ?>>2단 - 대형 사이드</option>
							<option value="12"<?php echo get_selected('12', $mo['page']) ?>>1단 - 박스형</option>
							<option value="13"<?php echo get_selected('13', $mo['page']) ?>>1단 - 와이드</option>
						</select>
					</td>
					<td class="text-muted">
						&nbsp;
					</td>
					</tr>

					<tr>
					<th class="text-center">
						사이드 영역
					</th>
					<td>
						<select name="pc[page_side]" class="form-control">
							<option value="">선택해 주세요</option>
							<?php 
							unset($skins);
							$skins = na_dir_list(G5_THEME_PATH.'/layout/side');
							for ($i=0; $i<count($skins); $i++) { 
							?>
								<option value="<?php echo $skins[$i] ?>"<?php echo get_selected($pc['page_side'], $skins[$i]) ?>><?php echo $skins[$i] ?></option>
							<?php } ?>
						</select>
					</td>
					<td>
						<select name="mo[page_side]" class="form-control">
							<option value="">선택해 주세요</option>
							<?php for ($i=0; $i<count($skins); $i++) { // $skins PC랑 같은 배열임 ?>
								<option value="<?php echo $skins[$i] ?>"<?php echo get_selected($mo['page_side'], $skins[$i]) ?>><?php echo $skins[$i] ?></option>
							<?php } ?>
						</select>
					</td>
					<td class="text-muted">
						/layout/side 폴더
					</td>
					</tr>

					<tr>
					<th class="text-center">
						좌측 사이드
					</th>
					<td class="text-center">
						<?php if($mode == 'site') { //사이트 설정용 ?>
							<input type="checkbox" name="pc[left_side]" value="1"<?php echo get_checked('1', $pc['left_side'])?> class="chk-margin">
						<?php } else { ?>
							<select name="pc[left_side]" class="form-control">
								<option value="">선택해 주세요.</option>
								<option value="0"<?php echo get_selected('0', $pc['left_side']) ?>>사용안함</option>
								<option value="1"<?php echo get_selected('1', $pc['left_side']) ?>>사용함</option>
							</select>
						<?php } ?>
					</td>
					<td class="text-center">
						<?php if($mode == 'site') { //사이트 설정용 ?>
							<input type="checkbox" name="mo[left_side]" value="1"<?php echo get_checked('1', $mo['left_side'])?> class="chk-margin">
						<?php } else { ?>
							<select name="mo[left_side]" class="form-control">
								<option value="">선택해 주세요.</option>
								<option value="0"<?php echo get_selected('0', $mo['left_side']) ?>>사용안함</option>
								<option value="1"<?php echo get_selected('1', $mo['left_side']) ?>>사용함</option>
							</select>
						<?php } ?>
					</td>
					<td class="text-muted">
						&nbsp;
					</td>
					</tr>

					</tbody>
					</table>
				</div>				
				<p class="help-block">
					인덱스(메인)에 사이드 영역 적용여부는 인덱스 파일 구조에 따라 달라집니다.
				</p>

			</div>
		</div>
	</li>

</ul>

<?php echo $btn_submit ?>
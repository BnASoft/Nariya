<?php
include_once('./_common.php');

if ($is_admin == 'super' || IS_DEMO) {
	;
} else {
    alert('접근권한이 없습니다.');
}

$mode = na_fid($mode);

if(!$mode)
    alert('값이 넘어오지 않았습니다.');

$g5['title'] = '메뉴 설정';
include_once('../head.sub.php');

// 페이지설정
$tset['page_title'] = '<i class="fa fa-bars"></i> 메뉴 설정';
$tset['page_desc'] = '사이트에서 사용할 메뉴를 설정합니다.';
$tset['page'] = 12;

include_once('../head.php');

// 아이콘 선택기
na_script('iconpicker');

// 테마 메뉴 불러오기(string)
$menu_json = na_file_var_load(G5_THEME_PATH.'/storage/menu-'.$mode.'-raw.php');
$menu_json = ($menu_json) ? stripslashes($menu_json) : '""';

// 저장폴더 권한 체크
include_once(NA_PLUGIN_PATH.'/save.inc.php');
?>
<style>
#myEditor .btn-xs { padding:0 10px; line-height:28px; height:28px; }
#myEditor .list-group { line-height:28px; }
</style>
<div class="row f-small">
	<div class="col-md-6">
		<div class="panel panel-default">
			<ul class="list-group">
				<li class="list-group-item bg-na-navy">메뉴 작업 후 반드시 하단의 "<b>메뉴저장</b>"을 누르셔야 저장됩니다.</li>
				<li class="list-group-item">서브메뉴는 무한 생성이 가능하나 실제 출력은 <b>2차</b>까지만 됩니다.</li>
			</ul>
			<div class="panel-body" id="cont">
				<ul id="myEditor" class="sortableLists list-group">
				</ul>
			</div>
		</div>
		<div class="form-group text-center">
			<form id="fmenutree" name="fmenutree" method="post" action="./menu_update.php" class="form-horizontal">
			<input type="hidden" name="mode" value="<?php echo $mode ?>">
			<div style="display:none;">	
				<textarea id="out" name="menu_json" class="form-control" cols="50" rows="10"></textarea>
			</div>
			<button type="button" id="btnSave" class="btn btn-na-red"><i class="fa fa-check"></i> 메뉴저장</button>
			</form>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel panel-default">
			<ul class="list-group">
				<li class="list-group-item bg-na-navy">메뉴 수정 후 반드시 "<b>적용</b>"을 누르셔야 반영됩니다.</li>
				<li class="list-group-item">짧은 주소가 아닌 <b>기존 파라메타 형태의 주소</b>를 입력해야 합니다.</li>
			</ul>
			<div class="panel-body">
				<form id="frmEdit" class="form-horizontal">
					<div class="form-group">
						<label for="text" class="col-sm-2 control-label">메뉴</label>
						<div class="col-sm-10">
							<div class="input-group">
								<span class="input-group-btn">
									<button type="button" id="myEditor_icon" class="btn btn-default" data-iconset="fontawesome"></button>
								</span>
								<input type="text" id="me_text" name="text" class="form-control item-menu" placeholder="메뉴명 입력">
							</div>
							<input type="hidden" id="me_icon" name="icon" class="item-menu">
						</div>
					</div>
					<div class="form-group">
						<label for="href" class="col-sm-2 control-label">링크</label>
						<div class="col-sm-10">
							<input type="text" id="me_href" name="href" class="form-control item-menu" placeholder="http://...">
							<p class="help-block" style="margin:10px 0 0 0;">
								./로 시작하는 주소는 자동전환됨 ex) ./bbs/board.php?bo_table=
							</p>
						</div>
					</div>
					<div class="form-group">
						<label for="target" class="col-sm-2 control-label">타켓</label>
						<div class="col-sm-10">
							<select id="me_target" name="target" class="form-control item-menu">
								<option value="_self">Self</option>
								<option value="_blank">Blank</option>
								<option value="_top">Top</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="device" class="col-sm-2 control-label">기기</label>
						<div class="col-sm-10">
							<select id="me_device" name="device" class="form-control item-menu">
								<option value="">모두</option>
								<option value="pc">PC</option>
								<option value="mo">모바일</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="line" class="col-sm-2 control-label">구분</label>
						<div class="col-sm-10">
							<input type="text" id="me_line" name="line" class="form-control item-menu" placeholder="메뉴 항목 구분 라인명 입력">
						</div>
					</div>
					<div class="form-group">
						<label for="line" class="col-sm-2 control-label">나눔</label>
						<div class="col-sm-10">
							<select id="me_sp" name="sp" class="form-control item-menu">
								<option value="">미사용</option>
								<option value="1">사용</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="line" class="col-sm-2 col-xs-12 control-label">보임</label>
						<div class="col-sm-5 col-xs-6">
							<select id="me_limit" name="limit" class="form-control item-menu">
								<option value="">모두 보임</option>
								<option value="1">지정 등급 이상 회원만</option>
							</select>
						</div>
						<div class="col-sm-5 col-xs-6">
							<div class="input-group">
								<input type="text" id="me_grade" name="grade" class="form-control item-menu" value="0">
								<span class="input-group-addon">등급</span>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="panel-footer text-center">
				<button type="button" id="btnSearch" class="btn btn-primary"><i class="fa fa-search"></i> 검색</button>
				<button type="button" id="btnUpdate" class="btn btn-success" disabled><i class="fa fa-refresh"></i> 적용</button>
				<button type="button" id="btnAdd" class="btn btn-danger"><i class="fa fa-plus"></i> 추가</button>
			</div>
		</div>
	</div>
</div>

<script src="./js/jquery-menu-editor.min.js"></script>
<script>
	$(document).ready(function () {
		// menu items
		var strjson = <?php echo $menu_json;?>;

		//icon picker options
		var iconPickerOptions = {searchText: 'Buscar...', labelHeader: '{0} de {1} Pags.'};
		
		//sortable list options : cyan
		var sortableListOptions = {
			placeholderCss: {'background-color': 'cyan'}
		};

		var editor = new MenuEditor('myEditor', {listOptions: sortableListOptions, iconPicker: iconPickerOptions, labelEdit: 'Edit'});
		editor.setForm($('#frmEdit'));
		editor.setUpdateButton($('#btnUpdate'));
		
		$('#btnSave').on('click', function () {
			var str = editor.getString();
			$("#out").text(str);
			$("#fmenutree").submit();
		});

		$('#btnUpdate').on('click', function () {
			var reg = /^javascript/; 
			if(reg.test($('#href').val())){ 
				alert('링크에 자바스크립트문을 입력할 수 없습니다.');
				$('#href').focus();
			} else {
				editor.update();
			}
		});

		$('#btnSearch').on('click', function () {
		    window.open("<?php echo na_theme_href('menu') ?>", "search_menu", "left=100,top=100,width=550,height=650,scrollbars=yes,resizable=yes");
		});

		$('#btnAdd').on('click', function () {
			var reg = /^javascript/; 
			if(reg.test($('#href').val())){ 
				alert('링크에 자바스크립트문을 입력할 수 없습니다.');
				$('#href').focus();
			} else {
				editor.add();
			}
		});
		
		// Menu Load
		editor.setData(strjson);
	});
</script>

<?php
include_once('../tail.php');
?>
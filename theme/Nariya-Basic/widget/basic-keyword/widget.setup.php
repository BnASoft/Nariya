<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// input의 name을 wset[배열키], mo[배열키] 형태로 등록
// 기본은 wset[배열키], 모바일 설정은 mo[배열키] 형식을 가짐

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
					<th class="text-center col-xs-2">너비지정</th>
					<th class="text-center col-xs-2">캐시설정</th>
					<th class="text-center col-xs-2">자동실행</th>
					<th class="text-center col-xs-2">랜덤출력</th>
					</tr>
					<tr>
					<td>
						<div class="input-group">
							<input type="text" name="wset[width]" value="<?php echo $wset['width'] ?>" class="form-control" placeholder="435">
							<span class="input-group-addon">px</span>
						</div>
					</td>
					<td>
						<div class="input-group">
							<input type="text" name="wset[cache]" value="<?php echo $wset['cache'] ?>" class="form-control">
							<span class="input-group-addon">분</span>
						</div>
					</td>
					<td class="text-center">
						<input type="checkbox" name="wset[auto]" value="1"<?php echo get_checked('1', $wset['auto'])?> class="no-margin">
					</td>
					<td class="text-center">
						<input type="checkbox" name="wset[rand]" value="1"<?php echo get_checked('1', $wset['rand'])?> class="no-margin">
					</td>
					</tr>
					</tbody>
					</table>
				</div>
				<p class="help-block">
					캐시설정시 일정시간 랜덤출력 결과를 고정할 수 있음
				</p>
			</div>
		</div>
	</li>
	<li class="list-group-item" style="border-bottom:0">
		<div class="form-group">
			<label class="col-sm-2 control-label">키워드 설정</label>
			<div class="col-sm-10">
				<style>
					#widgetData thead th { border-bottom:0; }
					#widgetData th,
					#widgetData td { vertical-align:middle; border-left:0; border-right:0; }
				</style>

				<p class="help-block">
					<i class="fa fa-caret-right" aria-hidden="true"></i>
					링크 미등록시 전체검색으로 연결되며 마우스 드래그로 위치이동이 가능함
				</p>

				<div class="table-responsive">
					<table id="widgetData" class="table table-bordered order-list no-margin">
					<thead>
					<tr class="active">
						<th class="text-center col-xs-3">키워드</th>
						<th class="text-center">링크</th>
						<th class="text-center col-xs-1">삭제</th>
					</tr>
					</thead>
					<tbody id="sortable">
					<?php 

					// 직접등록 입력폼 
					$data = array();
					$data_cnt = (is_array($wset['d']['pp_word'])) ? count($wset['d']['pp_word']) : 1;

					for($i=0; $i < $data_cnt; $i++) { 
						$n = $i + 1;
					?>
						<tr class="bg-light<?php echo ($i%2 != 0) ? '' : '-1';?>">
						<td>
							<input type="text" id="word_<?php echo $n ?>" name="wset[d][pp_word][]" value="<?php echo $wset['d']['pp_word'][$i] ?>" class="form-control">
						</td>
						<td>
							<input type="text" id="link_<?php echo $n ?>" name="wset[d][pp_link][]" value="<?php echo $wset['d']['pp_link'][$i] ?>" class="form-control" placeholder="http://...">
						</td>
						<td class="text-center">
							<?php if($i > 0) { ?>
								<a href="javascript:;" class="ibtnDel"><i class="fa fa-times-circle fa-2x light"></i></a>
							<?php } ?>
						</td>
						</tr>
					<?php } ?>
					</tbody>
					</table>
				</div>

				<div class="h10"></div>

				<div class="text-center">
					<button type="button" class="btn bg-<?php echo NT_COLOR ?> btn-bg" id="addrow">
						<span class="white">Add Keyword</span>
					</button>
				</div>	
			</div>
		</div>
	</li>
</ul>

<div class="h30"></div>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$(document).ready(function () {
	var counter = <?php echo $data_cnt + 1 ?>;
	$("#addrow").on("click", function () {
		var trbg = (counter%2 === 1) ? 'bg-light-1' : 'bg-light';
		var newRow = $("<tr class=" + trbg + ">");
		var cols = "";

		cols += '<td>';
		cols += '	<input type="text" id="word_' + counter + '" name="wset[d][pp_word][]" class="form-control">';
		cols += '</td>';
		cols += '<td>';
		cols += '	<input type="text" id="link_' + counter + '" name="wset[d][pp_link][]" class="form-control" placeholder="http://...">';
		cols += '</td>';
		cols += '<td class="text-center">';
		cols += '	<a href="javascript:;" class="ibtnDel"><i class="fa fa-times-circle fa-2x lightgray"></i></a>';
		cols += '</td>';

		newRow.append(cols);
		$("table.order-list").append(newRow);
		counter++;
	});

	$("table.order-list").on("click", ".ibtnDel", function (event) {
		$(this).closest("tr").remove();
	});

	$("#sortable").sortable();
});
</script>

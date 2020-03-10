<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$connect_skin_url.'/style.css">', 0);

// 스킨 설정값
$wset = na_skin_config('connect');

// 목록헤드
if($wset['head_skin']) {
	add_stylesheet('<link rel="stylesheet" href="'.NA_PLUGIN_URL.'/skin/head/'.$wset['head_skin'].'.css">', 0);
	$head_class = 'list-head';
} else {
	$head_class = ($wset['head_color']) ? 'border-'.$wset['head_color'] : 'border-dark';
}

?>

<?php if($is_admin == 'super' || IS_DEMO) { ?>
	<?php if(is_file($connect_skin_path.'/setup.skin.php')) { ?>
		<div class="text-right">
			<a class="btn btn_b01 btn-setup" href="<?php echo na_setup_href('connect') ?>" title="스킨설정">
				<i class="fa fa-cogs" aria-hidden="true"></i>
				<span class="sound_only">스킨설정</span>
			</a>
		</div>
	<?php } ?>
<?php } ?>

<div id="connect_list">
	<div class="div-head <?php echo $head_class ?>">
		<span class="num">번호</span>
		<span>위치</span>
	</div>
	<ul>
    <?php
    for ($i=0; $i < count($list); $i++) {
        //$location = conv_content($list[$i]['lo_location'], 0);
        $location = $list[$i]['lo_location'];
        // 최고관리자에게만 허용
        // 이 조건문은 가능한 변경하지 마십시오.
        if ($list[$i]['lo_url'] && $is_admin == 'super') $display_location = "<a href=\"".$list[$i]['lo_url']."\">".$location."</a>";
        else $display_location = $location;
    ?>
		<li class="tr">
			<div class="td num">
				<?php echo $list[$i]['num'] ?>
			</div>
			<div class="td">
				<span class="pull-right"><?php echo na_name_photo($list[$i]['mb_id'], $list[$i]['name']) ?></span>
				<?php echo $display_location ?>
			</div>
        </li>
    <?php } ?>
    </ul>
</div>

<div class="h20"></div>

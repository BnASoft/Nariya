<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

// Owl Carousel
na_script('owl');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$widget_url.'/widget.css">', 0);

// 너비
$width = (int)$width;
$width = ($width > 0) ? $width : 448;

$id = 'popular_'.na_rid();
?>
<style>
#<?php echo $id ?> .popular_inner {
	width:<?php echo $width ?>px; 
}
</style>
<!-- 인기검색어 시작 { -->
<section id="<?php echo $id ?>" class="basic-keyword">
    <h3 class="sound_only">인기검색어</h3>
    <div class="popular_inner f-small">
	    <ul>
		<?php
		if($wset['cache']) {
			echo na_widget_cache($widget_path.'/widget.rows.php', $wset, $wcache);
		} else {
			include($widget_path.'/widget.rows.php');
		}
		?>
	    </ul>
        <span class="popular_btns">
            <a href="#" class="pp-next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
            <a href="#" class="pp-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
        </span>
    </div>
</section>
<script>
$(function(){

	var popular_el = "#<?php echo $id ?> .popular_inner ul",
        p_width = $(popular_el).width(),
        c_width = 0;

    $(popular_el).children().each(function() {
        c_width += $(this).outerWidth( true );
    });

    if( c_width > p_width ){
        var $popular_btns = $("#<?php echo $id ?> .popular_inner .popular_btns");
        $popular_btns.show();

		$("#<?php echo $id ?>").addClass('popular_btn_show');

        var p_carousel = $(popular_el).addClass("owl-carousel").owlCarousel({
            items:1,
            loop:true,
            nav:false,
            dots:false,
            autoWidth:true,
            mouseDrag:false,
			autoplay:<?php echo ($wset['auto']) ? 'true' : 'false'; ?>
        });

        $popular_btns.on("click", ".pp-next", function(e) {
            e.preventDefault();
            p_carousel.trigger('next.owl.carousel');
        })
        .on("click", ".pp-prev", function(e) {
            e.preventDefault();
            p_carousel.trigger('prev.owl.carousel');
        });
    } else {
		$("#<?php echo $id ?>").removeClass('popular_btn_show');
	}

});
</script>

<?php if($setup_href) { ?>
	<div class="btn-wset">
		<a href="<?php echo $setup_href;?>" class="btn-setup">
			<span class="text-muted f-small"><i class="fa fa-cog"></i> 위젯설정</span>
		</a>
	</div>
<?php } ?>

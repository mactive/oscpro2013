<?php
/**
 * Show a brands description when on a taxonomy page
 */
?>
<script type="text/javascript">
jQuery(document).ready(function ($) {
    $('ul.brand_wall').width('3000px');
    var marginLeft = $('ul.brand_wall li').css('marginLeft').replace("px", "");
    var width =  $('ul.brand_wall li').width()+ marginLeft*2;
    var count = <?php echo $count; ?>;
    $('a.brand_left_handle').click(function(){
        var offset = $('ul.brand_wall').offset();
        console.log(offset.left);

        if (offset.left > -width * 2) {
            $('ul.brand_wall').animate({
                left: '-='+width
                }, 500, function() {
                // Animation complete.
            });
        };
    });

    $('a.brand_right_handle').click(function(){
        var offset = $('ul.brand_wall').offset();
        console.log(offset.left);

        if (offset.left < width ){
            $('ul.brand_wall').animate({
                left: '+='+width
                }, 500, function() {
                // Animation complete.
            });
        };
    });




});
</script>

<?php global $woocommerce; ?>
<?php if ( $posts ) : ?>

<div id="brand_wall_div">
    <div class="brand_wall_title">
        <a class="black_block">推荐厂牌 Top Brand</a>
        <a href="brand-list/" class="gray_block">所有品牌 All Brand</a>
    </div>
    <section class="brand_container">
        <a class="brand_left_handle block"></a>
        <div class="brand_center">
        	<ul class="brand_wall">
            	<?php 
            		foreach($posts as $post){
                    $url = get_brand_thumbnail_url($post->term_id);
            	?>

            		<li style="width: <?php _e($width); ?>px !important;">

                        <a href="brand/<?php _e($post->slug)?>" 
                            title="<?php echo $post->name ?>" class="block radius_3px"
                            style="background-image:url(<?php echo $url; ?>);">
                        </a>
                        <span><?php echo $post->name;?></span>

                    </li>
            	<?php } ?>
        	</ul>
        </div>
        <a class="brand_right_handle block"></a>

    </section>

</div>


<?php endif; ?>
<?php echo wpautop( wptexturize( term_description() ) ); ?>

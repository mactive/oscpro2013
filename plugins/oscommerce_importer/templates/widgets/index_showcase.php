<?php
/**
 * Show a brands description when on a taxonomy page
 */
?>

<script src="<?php bloginfo( 'template_url' ); ?>/js/jquery-ui.js"></script>

<script type="text/javascript" charset="utf-8" async defer>
    jQuery(document).ready(function ($) {
        $(function() {
            $( "#show_case_div" ).tabs();
        });
    });
</script>

<?php global $woocommerce; ?>
<?php if ( $posts_first ) : ?>

<div id="show_case_div">
    <ul class="show_case_title">
        <li><a href="#ul_first" class="black_block">推荐产品 Recommend</a></li>
        <li><a href="#ul_second" class="gray_block">新上产品 New</a></li>
    </ul>

	<ul class="show_case" id="ul_first">
	<?php 
		foreach($posts_first as $post){
	?>
		<li style="width: <?php _e($width); ?>px !important;">

            <?php 
                $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium' );
                $url = $thumb['0'];
            ?>

            <a href="<?php echo get_permalink($post->ID)?>" style="background-image:url('<?php _e($url);?>');">
                <div class="show_hover">
                    <b>查看产品</b>
                </div>
            </a>
            <span>
                <?php
                    $short_title = get_post_meta($post->ID,'short_title');
                    if (empty($short_title[0])) {
                        echo $post->post_title;
                    }else{
                        echo $short_title[0];
                    }
                ?>
            </span>
        </li>
	<?php } ?>
	</ul>


    <ul class="show_case" id="ul_second">
    <?php 
        foreach($posts_second as $post){
    ?>
        <li style="width: <?php _e($width); ?>px !important;">

            <?php 
                $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium' );
                $url = $thumb['0'];
            ?>

            <a href="<?php echo get_permalink($post->ID)?>" style="background-image:url('<?php _e($url);?>');">
                <div class="show_hover">
                    <b>查看产品</b>
                </div>
            </a>
            <span><?php echo $post->post_title ?></span>
        </li>
    <?php } ?>
    </ul>

</div>


<?php endif; ?>




<?php echo wpautop( wptexturize( term_description() ) ); ?>

<?php
/**
 * Show a brands description when on a taxonomy page
 */
?>

<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
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
                $out = '<a href="'.get_permalink($post->ID).'" style="background-image:url('.$url.');"></a>';
                echo $out;
            ?>
            <span><?php echo $post->post_title ?></span>
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
                $out = '<a href="'.get_permalink($post->ID).'" style="background-image:url('.$url.');"></a>';
                echo $out;
            ?>
            <span><?php echo $post->post_title ?></span>
        </li>
    <?php } ?>
    </ul>


</div>


<?php endif; ?>
<?php echo wpautop( wptexturize( term_description() ) ); ?>

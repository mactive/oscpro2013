<?php
/**
 * Show a brands description when on a taxonomy page
 */
?>


<?php global $woocommerce; ?>
<?php if ( $posts ) : ?>

<div id="show_case_div">
    <div class="show_case_title">
        <a class="black_block">推荐产品 Recommend</a>
        <a href="brand-list/" class="gray_block">新上产品 New</a>
    </div>

	<ul class="show_case">
	<?php 
		foreach($posts as $post){
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

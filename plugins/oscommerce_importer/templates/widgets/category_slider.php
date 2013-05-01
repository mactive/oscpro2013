<?php
/**
 * Show a brands description when on a taxonomy page
 */
?>
<?php global $woocommerce; ?>
<?php if ( $posts ) : ?>
	<ul class="news_image_slider">
	<?php 
		foreach($posts as $post){
			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium' );
			$url = $thumb['0'];
	?>
		<li><a href="<?php get_permalink($post->ID)?>" style="background-image:url(<?php echo $url; ?>);"></a></li>
	<?php } ?>
	</ul>
<?php endif; ?>
<?php echo wpautop( wptexturize( term_description() ) ); ?>

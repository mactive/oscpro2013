<?php global $woocommerce; ?>
<div class="term-description brand-description">

	<?php if ( $thumbnail ) : ?>

		<img src="<?php echo $thumbnail; ?>" alt="Thumbnail" class="wp-post-image alignright fr" width="<?php echo $woocommerce->get_image_size('shop_thumbnail_image_width'); ?>" />
	<?php endif; ?>
	<h1>=========</h1>
	<div class="text">

		<?php echo wpautop( wptexturize( term_description() ) ); ?>
	
	</div>

</div>

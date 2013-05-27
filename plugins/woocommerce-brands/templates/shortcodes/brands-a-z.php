<?php
/**
 * Brand A-Z listing
 *
 * @usedby [product_brand_list]
 */
?>
<div id="brands_a_z" class="radius_3px white_section">
	
	<div class="cell_title mb_20px">快速查找</div>
	<ul class="brands_index">
		<?php		
		foreach ( $index as $i )
			if ( isset( $product_brands[ $i ] ) )
				echo '<li><a href="#brands-' . $i . '">' . strtoupper($i) . '</a></li>';
			elseif ( $show_empty )
				echo '<li><span>' . $i . '</span></li>';
		?>
	</ul>
					
	<?php foreach ( $index as $i ) if ( isset( $product_brands[ $i ] ) ) : ?>
		
		<span class="first_letter brand_letter_line" id="brands-<?php echo $i; ?>"><?php echo strtoupper($i); ?></span>
		<ul class="brands">
			<?php
			foreach ( $product_brands[ $i ] as $brand )
				echo '<li><a href="' . get_term_link( $brand->slug, 'product_brand' ) . '">' . $brand->name . '</a></li>';
			?>
		</ul>
		
		<?php if ( $show_top_links ) : ?>
			<a class="top" href="#brands_a_z"><?php _e( '&uarr; Top', 'wc_brands' ) ?></a>
		<?php endif; ?>

	<?php endif; ?>
		
</div>
<?php
/**
 * Single Product tabs
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) : ?>

	<div class="cell_title">产品说明</div>

	<div class="keyline"></div>

	<div class="product_description">
		<?php the_content(); ?>
	</div>

	<div class="cell_title">规格参数</div>
	<div class="keyline"></div>
	<div class="product_description">
		<?php the_excerpt(); ?>
	</div>


<?php endif; ?>
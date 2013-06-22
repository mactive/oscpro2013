<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header('shop'); ?>

<style type="text/css" media="screen">
	.woocommerce-breadcrumb{text-indent: 10px;margin-top: 20px !important;}
	.site-content{width: 670px !important;  width: 100% !important;}
	.entry-summary{
		width: 500px !important; 
		margin: 40px 0px 0px 30px; 
		padding-left: 30px;
	 	float: left !important; 
	 	border-left: 1px solid #eee;
	}
	p.price ins .amount{color: #000 !important; font-size: 30px;}
	del .amount{color: #ccc; font-size: 20px;}
	.product_meta{ width: 150px; float: left;}
	.product_service_note{ width: 150px; float: left; margin-left: 20px;}
</style>


<?php do_action('woocommerce_before_mac_single_breadcrumb'); ?>


	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action('woocommerce_before_mac_single_product');
	?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php woocommerce_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action('woocommerce_after_main_content');
	?>



<?php get_footer('shop'); ?>
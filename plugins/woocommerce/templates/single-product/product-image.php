<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.3
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $woocommerce;

?>
<div class="images">

	<?php
		if ( has_post_thumbnail() ) {

            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'shop_single' );
            $bg_url = $thumb['0'];
			$image       		= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
			$image_title 		= esc_attr( get_the_title( get_post_thumbnail_id() ) );
			$image_link  		= wp_get_attachment_url( get_post_thumbnail_id() );
			$attachment_count   = count( get_children( array( 'post_parent' => $post->ID, 'post_mime_type' => 'image', 'post_type' => 'attachment' ) ) );

			if ( $attachment_count != 1 ) {
				$gallery = '[product-gallery]';
			} else {
				$gallery = '';
			}

			echo apply_filters( 'woocommerce_single_product_image_html', 
				sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image radius_3px zoom" title="%s"  rel="prettyPhoto' . $gallery . '"'
					.'style="background-image:url(%s);"'.'></a>', $image_link, $image_title,$bg_url ), $post->ID );

		} else {

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', woocommerce_placeholder_img_src() ), $post->ID );

		}
	?>

	<?php do_action( 'woocommerce_product_thumbnails' ); ?>

</div>
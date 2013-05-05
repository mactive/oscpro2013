<?php 
/*
Plugin Name: OSCommerce Product Display
Plugin URI: http://www.orangecreative.net
Description: Plugin for displaying products from an OSCommerce shopping cart database
Author: C. Lupu
Version: 1.0
Author URI: http://www.orangecreative.net
*/
/*
function oscimp_getproducts($product_cnt=1) {
	//Connect to the OSCommerce database
	$oscommercedb = new wpdb(get_option('oscimp_dbuser'),get_option('oscimp_dbpwd'), get_option('oscimp_dbname'), get_option('oscimp_dbhost'));

	$retval = '';
	for ($i=0; $i<$product_cnt; $i++) {
		//Get a random product
		$product_count = 0;
		while ($product_count == 0) {
			$product_id = rand(0,30);
			$product_count = $oscommercedb->get_var("SELECT COUNT(*) FROM sm_brand WHERE brand_id > 0 ");
		}
		
		//Get product image, name and URL
		$product_image = $oscommercedb->get_var("SELECT products_image FROM sm_brand WHERE products_id=$product_id");
		$product_name = $oscommercedb->get_var("SELECT products_name FROM products_description WHERE products_id=$product_id");
		$store_url = get_option('oscimp_store_url');
		$image_folder = get_option('oscimp_prod_img_folder');

		//Build the HTML code
		$retval .= '<div class="oscimp_product">';
		$retval .= '<a href="'. $store_url . 'product_info.php?products_id=' . $product_id . '"><img src="' . $image_folder . $product_image . '" /></a><br />';
		$retval .= '<a href="'. $store_url . 'product_info.php?products_id=' . $product_id . '">' . $product_name . '</a>';
		$retval .= '</div>';
	}
	
	return $retval;
}
*/



//*************** Admin function ***************
function oscimp_admin() {
	// include('goods_transform/import_admin.php');
	// include('goods_transform/import_goods.php');
	// include('goods_transform/update_goods_image.php');	//指定image 然后刷新数量
	// include('goods_transform/update_goods_gallery.php');	//gallery 机制
	// include('download_parse.php');

}

function oscimp_admin_actions() {
    add_options_page("OSCommerce Product Display", "OSCommerce Product Display", 1, "oscommerce_importer.php", "oscimp_admin");
}

add_action('admin_menu', 'oscimp_admin_actions');

/*
 * Widget Foo_widget
 * new_slider
 */
require_once( 'classes/class-widget-news.php' );
add_action( 'widgets_init', create_function( '', 'register_widget( "News_Widget" );' ) );


/*
 * Widget top_brand
 * 首页的推荐品牌
 */
require_once( 'classes/class-widget-brandwall.php' );
add_action( 'widgets_init', create_function( '', 'register_widget( "Brandwall_Widget" );' ) );

/*
 * Widget top_brand
 * 首页的橱窗展示 后台指定一个产品分类 可以自己新建分类 比如推荐和新品
 */
require_once( 'classes/class-widget-showcase.php' );
add_action( 'widgets_init', create_function( '', 'register_widget( "Showcase_Widget" );' ) );

/*
 * Widget why oscpro
 * 首页的橱窗展示 橱窗旁边的为什么选择 osc
 */
require_once( 'classes/class-widget-whyosc.php' );
add_action( 'widgets_init', create_function( '', 'register_widget( "Whyosc_Widget" );' ) );




?>
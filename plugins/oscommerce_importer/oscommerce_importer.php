<?php 
/*
Plugin Name: OSCommerce Product Display
Plugin URI: http://mactive.github.com
Description: Plugin for import old echsop infos
Author: mactive
Version: 1.0
Author URI: http://mactive.github.com
*/


//*************** Admin function ***************
function oscimp_admin() {
	// include('goods_transform/import_admin.php');
	// include('goods_transform/import_goods.php');
	// include('goods_transform/update_goods_image.php');	//指定image 然后刷新数量
	// include('goods_transform/update_goods_gallery.php');	//gallery 机制
	// include('goods_transform/import_article.php');
	// include('goods_transform/update_article_image.php');
	// include('goods_transform/update_article_gallery.php');	//gallery 机制

	// include('download_parse.php');

}

function oscimp_admin_actions() {
    add_options_page("OSCommerce Product Display", "OSCommerce Product Display", 1, "oscommerce_importer.php", "oscimp_admin");
}


if ( ! function_exists ( 'oscpro_plugin_init' ) ) {
	function oscpro_plugin_init() {
	// Internationalization, first(!)
		load_plugin_textdomain( 'oscpro', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}
}

add_action( 'plugins_loaded', 'oscpro_plugin_init' );

// add_action('admin_menu', 'oscimp_admin_actions');

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


/*
 * Widget very big
 * 横贯全页面面 随机展示大图
 */
require_once( 'classes/class-widget-fullad.php' );
add_action( 'widgets_init', create_function( '', 'register_widget( "Fullad_Widget" );' ) );


//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
// themes page 

/*
 * Widget archive calc
 * 横贯全页面面 随机展示大图
 */
// require_once( 'classes/class-widget-postcale.php' );
// add_action( 'widgets_init', create_function( '', 'register_widget( "Postcale_Widget" );' ) );

/* 	
 *	新闻页面的当前分类下的文章 按照日期统计
 *	http://local.osc-pro.com/archives/category/news/
 */

require_once( 'classes/class-widget-catside.php' );
add_action( 'widgets_init', create_function('', 'register_widget("cb_archive_widget");') );

/* 	
 *	hooks 按照日期显示分类的
 *	http://local.osc-pro.com/archives/category/news/2013/05
 */

require_once( 'classes/date_archive_for_category.php' );


/* 	
 *	get custom fired
 *	http://local.osc-pro.com/archives/category/news/
 */

require_once( 'classes/class-widget-customfield.php' );
add_action( 'widgets_init', create_function('', 'register_widget("Customfield_widget");') );

/* 	
 *	新闻页面的当前分类下的文章 按照日期统计
 *	http://local.osc-pro.com/archives/category/news/
 */

require_once( 'classes/class-widget-otherpost.php' );
add_action( 'widgets_init', create_function('', 'register_widget("Otherpost_widget");') );


// require_once( 'classes/class-product-metabox.php' );
// require_once( 'classes/class-product-metatest.php' );


?>
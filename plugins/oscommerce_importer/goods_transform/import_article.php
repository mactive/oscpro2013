<div class="wrap">
<?php    echo "<h2>" . __( 'OSCommerce Product Display Options', 'oscimp_trdom' ) . "</h2>"; ?>

<?php 
		function insert_product($my_post,$cat_name='',$brand_name=''){
			// $parent_term = term_exists( $_parent, 'product_cat' ); // array is returned if taxonomy is given
			// $parent_term_id = $parent_term['term_id'] > 0 ? $parent_term_id : ''; // get numeric term id

			// Insert the post into the database
			$wp_error = '';
			$post_id = wp_insert_post( $my_post, $wp_error);
			echo "<br>=====".$post_id."=======<br>";
			
			// update_product_guid($post_id);
			// 232 news 233 cases
			wp_set_object_terms($post_id, 233, 'category');

			// insert_goods_relationship($post_id,$cat_name,'product_cat'); 	// refresh cat count
			// insert_goods_relationship($post_id,$brand_name,'product_brand');	// refresh brand count

			// insert_wp_postmeta($post_id); 	//ID 83
			
		}

		function insert_goods_relationship($post_id,$name,$taxonomy){


			$item = term_exists( $name, $taxonomy ); 
			if (!empty($item)) {
				# code...
				$term = get_term($item['term_id'], $taxonomy, ARRAY_A);

				wp_set_object_terms( $post_id, $term['slug'], $taxonomy);  // get numeric term id

				echo $post_id."-".$name."-".$term['term_taxonomy_id']."-".$taxonomy."<br><br>";

			}

			// update count
			// $tt_ids = wp_get_object_terms( $post_id, $taxonomy);
			// wp_update_term_count( $tt_ids, $taxonomy );
		}

		function update_product_guid($post_id){
			$my_post = array();
  			// $guid_string = "http://local.osc-pro.com/?post_type=product&#038;p=".$post_id;
  			$guid_string = "==============";
  			$my_post['ID'] = $post_id;
  			$my_post['guid'] = $guid_string;
			
			wp_update_post( $my_post );
		}

		function insert_wp_postmeta($post_id){
			add_post_meta($post_id, '_visibility', 'visible');

			/*
			INSERT INTO `wp_postmeta` VALUES(165, 85, '_edit_lock', '1366652317:1');
			INSERT INTO `wp_postmeta` VALUES(166, 85, '_edit_last', '1');
			INSERT INTO `wp_postmeta` VALUES(167, 85, '_visibility', 'visible');
			INSERT INTO `wp_postmeta` VALUES(168, 85, '_stock_status', 'instock');
			INSERT INTO `wp_postmeta` VALUES(169, 85, 'total_sales', '0');
			INSERT INTO `wp_postmeta` VALUES(170, 85, '_downloadable', 'no');
			INSERT INTO `wp_postmeta` VALUES(171, 85, '_virtual', 'no');
			INSERT INTO `wp_postmeta` VALUES(172, 85, '_product_image_gallery', '');
			INSERT INTO `wp_postmeta` VALUES(173, 85, '_regular_price', '1200');
			INSERT INTO `wp_postmeta` VALUES(174, 85, '_sale_price', '');
			INSERT INTO `wp_postmeta` VALUES(175, 85, '_tax_status', '');
			INSERT INTO `wp_postmeta` VALUES(176, 85, '_tax_class', '');
			INSERT INTO `wp_postmeta` VALUES(177, 85, '_purchase_note', '');
			INSERT INTO `wp_postmeta` VALUES(178, 85, '_featured', 'no');
			INSERT INTO `wp_postmeta` VALUES(179, 85, '_weight', '');
			INSERT INTO `wp_postmeta` VALUES(180, 85, '_length', '');
			INSERT INTO `wp_postmeta` VALUES(181, 85, '_width', '');
			INSERT INTO `wp_postmeta` VALUES(182, 85, '_height', '');
			INSERT INTO `wp_postmeta` VALUES(183, 85, '_sku', 'SKU00008');
			INSERT INTO `wp_postmeta` VALUES(184, 85, '_product_attributes', 'a:0:{}');
			INSERT INTO `wp_postmeta` VALUES(185, 85, '_sale_price_dates_from', '');
			INSERT INTO `wp_postmeta` VALUES(186, 85, '_sale_price_dates_to', '');
			INSERT INTO `wp_postmeta` VALUES(187, 85, '_price', '1200');
			INSERT INTO `wp_postmeta` VALUES(188, 85, '_sold_individually', '');
			INSERT INTO `wp_postmeta` VALUES(189, 85, '_stock', '');
			INSERT INTO `wp_postmeta` VALUES(190, 85, '_backorders', 'no');
			INSERT INTO `wp_postmeta` VALUES(191, 85, '_manage_stock', 'no');
			*/
		}
 ?>

<?php 

	echo "<h2>Goods list</h2>";

	global $wpdb;
	// goods_desc,goods_thumb,goods_img,original_img,add_time,goods_shortname,goods_target
	$result = $wpdb->get_results( 
		" SELECT g.article_id,g.title,g.logo,g.content,g.keywords,g.add_time FROM sm_article as g ".
		// " LEFT JOIN sm_brand as b on b.brand_id = g.brand_id ".
		// " LEFT JOIN sm_category as c on c.cat_id = g.cat_id ".
		" WHERE g.cat_id =12 "
		." AND g.article_id > 0 "
	 	,ARRAY_A);
	// print_r($result);
	if($_POST['oscimp_hidden'] == 'Y') {

	// print_r($sm_brand);

	   	foreach ($result as $key => $value) {
			echo $value['article_id']."-".$value['title'].'-'.$value['add_time']."<br>"; //

			$my_post = array(
				'post_title'    => $value['title'],
			  	'post_content'  => str_replace('/images/upload/Image/','/wp-content/uploads/oldarticle/',$value['content']),
			  	'post_name'    => $value['title'],
			  	'post_status'   => 'publish',
			  	'post_author'   => 1,
			  	'post_type'     => 'post',
			  	'menu_order'	=> $value['article_id'],
			  	'post_date'		=>  gmdate("Y-m-d H:i:s", $value['add_time'])
			);

			// print_r($my_post);
			// import handle
			insert_product($my_post);



			echo "<br>";
		}

	}
?>


<form name="oscimp_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
	<input type="hidden" name="oscimp_hidden" value="Y">

	<p class="submit">
	<input type="submit" name="Submit" value="<?php _e('Update Options', 'oscimp_trdom' ) ?>" />
	</p>
</form>

</div>
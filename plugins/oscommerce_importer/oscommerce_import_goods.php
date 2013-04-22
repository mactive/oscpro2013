<div class="wrap">
<?php    echo "<h2>" . __( 'OSCommerce Product Display Options', 'oscimp_trdom' ) . "</h2>"; ?>

<?php 
		function insert_product($my_post){
			// $parent_term = term_exists( $_parent, 'product_cat' ); // array is returned if taxonomy is given
			// $parent_term_id = $parent_term['term_id'] > 0 ? $parent_term_id : ''; // get numeric term id

			// Insert the post into the database
			$wp_error = '';
			$post_id = wp_insert_post( $my_post, $wp_error);
			update_product_guid($post_id);

			wp_set_object_terms($post_id,2,'product_type');

			insert_goods_relationship($post_id,$my_post['cat_name'],'product_cat'); 	// refresh cat count
			insert_goods_relationship($post_id,$my_post['brand_name'],'product_brand');	// refresh brand count
		} 

		function insert_goods_relationship($post_id,$cat_name,$taxonomy){
			$term = term_exists( $cat_name, $taxonomy ); 
			// wp_set_object_terms( $post_id, $term['term_id'], $type);  // get numeric term id

			$tt_ids = wp_get_object_terms( $post_id, $taxonomy);
			// wp_update_term_count( $tt_ids, $taxonomy );
		}

		function update_product_guid($post_id){
			$my_post = array();
  			$guid_string = "http://local.osc-pro.com/?post_type=product&#038;p=".$post_id;

  			$my_post['ID'] = $post_id;
  			$my_post['guid'] = $guid_string;
			
			 wp_update_post( $my_post );
		}
 ?>

<?php 

	echo "<h2>Goods list</h2>";

	global $wpdb;
	// goods_desc,goods_thumb,goods_img,original_img,add_time,goods_shortname,goods_target
	$result = $wpdb->get_results( 
		" SELECT g.goods_id,g.goods_name,g.cat_id,g.shop_price,g.goods_desc, b.brand_name,c.cat_name FROM sm_goods as g ".
		" LEFT JOIN sm_brand as b on b.brand_id = g.brand_id ".
		" LEFT JOIN sm_category as c on c.cat_id = g.cat_id "
	 	,ARRAY_A);
	// print_r($result);
	if($_POST['oscimp_hidden'] == 'Y') {

	// print_r($sm_brand);

	   	foreach ($result as $key => $value) {
			echo $value['goods_id']."-".$value['goods_name'].'-'.$value['brand_name'].'-'.$value['cat_name']; //

			$my_post = array(
				'post_title'    => $value['goods_name'],
			  	'post_content'  => $value['goods_desc'],
			  	'post_status'   => 'publish',
			  	'post_author'   => 1,
			  	'post_type'     => 'product',
			  	'menu_order'	=> $value['goods_id']
			);

			insert_product($my_post);


			if(empty($value['brand_name'])){
				echo "empty_brand<br>";
			}else{
				$term = term_exists( $value['brand_name'], 'product_brand' ); 
				echo ' brand_id:'.$term['term_id'];
			}


			if(empty($value['cat_name'])){
				echo "empty_category<br>";
			}else{
				$term = term_exists( $value['cat_name'], 'product_cat' ); 
				echo ' cat_id:'.$term['term_id'];
			}


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
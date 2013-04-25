<div class="wrap">
<?php    echo "<h2>" . __( 'OSCommerce Product Display Options', 'oscimp_trdom' ) . "</h2>"; ?>

<?php 
		function insert_productinsert_product($my_post,$cat_name,$brand_name){
			// $parent_term = term_exists( $_parent, 'product_cat' ); // array is returned if taxonomy is given
			// $parent_term_id = $parent_term['term_id'] > 0 ? $parent_term_id : ''; // get numeric term id

			// Insert the post into the database
			$wp_error = '';
			$post_id = wp_insert_post( $my_post, $wp_error);
			echo "<br>=====".$post_id."=======<br>";
			
			// update_product_guid($post_id);
			wp_set_object_terms($post_id, 2, 'product_type');

			insert_goods_relationship($post_id,$cat_name,'product_cat'); 	// refresh cat count
			insert_goods_relationship($post_id,$brand_name,'product_brand');	// refresh brand count

			insert_wp_postmeta($post_id); 	//ID 83
			
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

		function update_product_guid($post_id,$year,$month,$name){
			$my_post = array();
  			$guid_string = "http://local.osc-pro.com/wp-content/uploads/".$year."/".$month."/".strtolower($name); //古典吉他（6N03）.jpg

  			$my_post['ID'] = $post_id;
  			$my_post['guid'] = $guid_string;
			
			wp_update_post( $my_post );
		}

		function insert_wp_postmeta($post_id){
			add_post_meta($post_id, '_visibility', 'visible');
		}
 ?>

<?php 

	echo "<h2>Goods list</h2>";

	global $wpdb;
	// goods_desc,goods_thumb,goods_img,original_img,add_time,goods_shortname,goods_target
	$result = $wpdb->get_results( 
		" SELECT g.goods_id,g.goods_name,g.goods_thumb, g.goods_img, g.original_img,p.ID FROM sm_goods as g ".
		" LEFT JOIN wp_posts as p on p.menu_order = g.goods_id "
		." WHERE g.goods_id > 0 "
	 	,ARRAY_A);
	// print_r($result);
	if($_POST['oscimp_hidden'] == 'Y') {

	// print_r($sm_brand);

	   	foreach ($result as $key => $value) {
			echo "gid ".$value['goods_id']."- pid.".$value['ID']."-".$value['goods_name'].'-'.$value['original_img']."<br>"; //
			$_array = explode("/",$value['original_img']);

			$year = substr($_array[1], 0, 4);
			$month = substr($_array[1], 4, 2);
			$namex = $_array[2];

			$year = empty($year) ? '2008': $year ;
			$month = empty($month) ? '01': $month ;
			$namex = empty($namex) ? 'null.jpg': $namex ;

			$image_title = substr($namex, 0, strpos($namex,'.'));

			$_mime_type = substr($namex, strpos($namex,'.'), 3);
			$post_mine_type = 'image/jpeg';
			if ($_mime_type == "gif") {
				$post_mine_type = "image/gif";
			}else if($_mime_type == "jpg" || $_mime_type == "jpeg"){
				$post_mine_type = "image/jpeg";
			}else if($_mime_type == "png"){
				$post_mine_type = "image/png";
			}

			echo "year:".$year."-month:".$month."-name:".$namex."-title:".$image_title."-mine_type:".$post_mine_type;

			// update_product_guid($value['post_id'],$year, $month, $namex);

			$my_post = array(
				'post_title'    => $image_title,
			  	'post_name'    	=> $image_title,
			  	'post_parent'	=> $value['ID'], // from menu_order get post id
			  	'post_status'   => 'inherit',
			  	'post_author'   => 1,
			  	'post_type'     => 'attachment',
			  	'post_mime_type' => $post_mine_type
			);

			// import handle
			// insert_product($my_post,$value['cat_name'],$value['brand_name']);


			echo "<br><br>";
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
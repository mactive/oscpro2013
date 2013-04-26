<div class="wrap">
<?php    echo "<h2>" . __( 'OSCommerce Product Display Options', 'oscimp_trdom' ) . "</h2>"; ?>

<?php 
		function insert_product_image($my_post,$coname,$goods_sn,$shop_price){
			// $parent_term = term_exists( $_parent, 'product_cat' ); // array is returned if taxonomy is given
			// $parent_term_id = $parent_term['term_id'] > 0 ? $parent_term_id : ''; // get numeric term id

			// Insert the post into the database
			$wp_error = '';
			$post_id = wp_insert_post( $my_post, $wp_error);
			echo "<br>=====".$post_id."=======<br>";
			
			// update_product_guid($post_id);
			add_post_meta($post_id,'_wp_attached_file',$coname);
			add_post_meta($my_post['post_parent'], '_sku', $goods_sn);
			add_post_meta($my_post['post_parent'], '_thumbnail_id', $post_id);
			add_post_meta($my_post['post_parent'], '_product_image_gallery', '');
			add_post_meta($my_post['post_parent'], '_price', $shop_price);
			add_post_meta($my_post['post_parent'], '_sale_price', $shop_price);
			add_post_meta($my_post['post_parent'], '_regular_price', $shop_price);
			
		}


 ?>

<?php 

	echo "<h2>Goods list</h2>";

	global $wpdb;
	// goods_desc,goods_thumb,goods_img,original_img,add_time,goods_shortname,goods_target
	$result = $wpdb->get_results( 
		" SELECT g.goods_id,g.goods_name, g.goods_sn, g.shop_price, g.goods_thumb, g.goods_img, g.original_img,p.ID FROM sm_goods as g ".
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

			$goods_sn = empty($value['goods_sn']) ? 'osc'.$value['ID']: $value['goods_sn'];

			echo "price:".$value['shop_price']."-month:".$month."-name:".$namex."-title:".$image_title."-mine_type:".$post_mine_type;

			// update_product_guid($value['post_id'],$year, $month, $namex);
			$coname = $year."/".$month."/".strtolower($namex);
			$guid_string = "http://local.osc-pro.com/wp-content/uploads/".$coname; //古典吉他（6N03）.jpg

			$my_post = array(
				'post_title'    => $image_title,
			  	'post_name'    	=> $image_title,
			  	'post_parent'	=> $value['ID'], // from menu_order get post id
			  	'post_status'   => 'inherit',
			  	'post_author'   => 1,
			  	'post_type'     => 'attachment',
			  	'post_mime_type' => $post_mine_type,
			  	'guid'			=> $guid_string
			);

			// insert_product_image($my_post,$coname,$goods_sn,$value['shop_price']);



			// insert  wp_postmeta


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
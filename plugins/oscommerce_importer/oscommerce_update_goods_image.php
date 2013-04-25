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

	function movefile($target_path,$target, $source,$name)
	{
		echo "<br>".$target_path."<br>".$target."<br>".$source."<br>";

		if (!is_dir($target_path)) {
	    	mkdir($target_path,0777, true);
		}

		copy($source,$target);
		echo "<br>=========<br>";

		resize_save(100,100,$target,$target_path,$name,true);
		resize_save(200,150,$target,$target_path,$name,false);
		resize_save(400,300,$target,$target_path,$name,false);

	}

	function resize_save($width, $height,$target,$target_path, $name, $is_crop){
		$image = wp_get_image_editor( $target ); // Return an implementation that extends <tt>WP_Image_Editor</tt>
		$image_title = substr($name, 0, strpos($name,'.'));
		$_mime_type = substr($name, strpos($name,'.')+1, 3);
		print_r($image);


		if ( ! is_wp_error( $image ) ) {			
		    $image->resize( $width, $height, $is_crop );
		    $path = $target_path."/".$image_title."-".$width."x".$height.".".$_mime_type;
		    $image->save( $path);

		}
	}

 ?>

<?php 

	echo "<h2>Goods list</h2>";

	global $wpdb;
	// goods_desc,goods_thumb,goods_img,original_img,add_time,goods_shortname,goods_target
	$result = $wpdb->get_results( 
		" SELECT g.goods_id,g.goods_name, g.goods_sn, g.shop_price, g.goods_thumb, g.goods_img, g.original_img,p.ID FROM sm_goods as g ".
		" LEFT JOIN wp_posts as p on p.menu_order = g.goods_id "
		." WHERE g.goods_id = 106 "
	 	,ARRAY_A);
	// print_r($result);
	if($_POST['oscimp_hidden'] == 'Y') {

	// print_r($sm_brand);

	   	foreach ($result as $key => $value) {
			echo "gid ".$value['goods_id']."- pid.".$value['ID']."-".$value['goods_name'].'-'.$value['original_img']."<br>"; //
			$_array = explode("/",$value['original_img']);

			$year = substr($_array[1], 0, 4);
			$month = substr($_array[1], 4, 2);
			$name = $_array[2];

			$year = empty($year) ? '2008': $year ;
			$month = empty($month) ? '01': $month ;
			$name = empty($name) ? 'null.jpg': $name ;

			$image_title = substr($name, 0, strpos($name,'.'));

			$_mime_type = substr($name, strpos($name,'.'), 3);
			$post_mine_type = 'image/jpeg';
			if ($_mime_type == "gif") {
				$post_mine_type = "image/gif";
			}else if($_mime_type == "jpg" || $_mime_type == "jpeg"){
				$post_mine_type = "image/jpeg";
			}else if($_mime_type == "png"){
				$post_mine_type = "image/png";
			}

			$goods_sn = empty($value['goods_sn']) ? 'osc'.$value['ID']: $value['goods_sn'];

			echo "price:".$value['shop_price']."-month:".$month."-name:".$name."-title:".$image_title."-mine_type:".$post_mine_type;

			// update_product_guid($value['post_id'],$year, $month, $name);
			$coname = $year."/".$month."/".strtolower($name);
			$guid_string = "http://local.osc-pro.com/wp-content/uploads/".$coname; //古典吉他（6N03）.jpg

			// $my_post = array(
			// 	'post_title'    => $image_title,
			//   	'post_name'    	=> $image_title,
			//   	'post_parent'	=> $value['ID'], // from menu_order get post id
			//   	'post_status'   => 'inherit',
			//   	'post_author'   => 1,
			//   	'post_type'     => 'attachment',
			//   	'post_mime_type' => $post_mine_type,
			//   	'guid'			=> $guid_string
			// );
			$_prefix = $_SERVER["DOCUMENT_ROOT"]."/wp-content/uploads/";
			$_path 		= $_prefix.$year."/".$month;
			$_target 	= $_prefix.$coname;
			$_source 	= $_prefix.$value['original_img'];

			movefile($_path,$_target,$_source,$name);
			// insert_product_image($my_post,$coname,$goods_sn,$value['shop_price']);


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
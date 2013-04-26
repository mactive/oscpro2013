<div class="wrap">
<?php    echo "<h2>" . __( 'OSCommerce Product Display Options', 'oscimp_trdom' ) . "</h2>"; ?>

<?php 
	function insert_product_image($my_post,$coname){
		// $parent_term = term_exists( $_parent, 'product_cat' ); // array is returned if taxonomy is given
		// $parent_term_id = $parent_term['term_id'] > 0 ? $parent_term_id : ''; // get numeric term id

		// Insert the post into the database
		$wp_error = '';
		$post_id = wp_insert_post( $my_post, $wp_error);
		echo "<br>=====".$post_id."=======<br>";
		
		add_post_meta($post_id,'_wp_attached_file',$coname);

		$string = get_post_meta($my_post['post_parent'],'_product_image_gallery',true);
		if (empty($string)) {
			update_post_meta($my_post['post_parent'], '_product_image_gallery', $post_id);
		}else{
			update_post_meta($my_post['post_parent'], '_product_image_gallery', $string.",".$post_id);
		}
		return $post_id;
		
	}

	function movefile($target_path,$target, $source,$name,$year,$month,$gallery_id)
	{
		echo "<br>".$target_path."<br>".$target."<br>".$source."<br>";

		if (!is_dir($target_path)) {
	    	mkdir($target_path,0777, true);
		}

		copy($source,$target);
		echo "<br>=========<br>";



			$image = wp_get_image_editor( $target ); // Return an implementation that extends <tt>WP_Image_Editor</tt>
			$image_title = substr($name, 0, strpos($name,'.'));
			$_mime_type = substr($name, strpos($name,'.')+1, 3);

			$size_array = $image->get_size();

			$res = array();
			$res['width'] 	= $size_array['width'];
			$res['height'] 	= $size_array['height'];
			$res['file'] 	= $year."/".$month."/".$name;
			$res['sizes'] 	= array();
			$res['image_meta'] 	= array(
	            'aperture' => 0,
	            'title' => $image_title,
	            'credit' => 'osc_pro',
	            'camera' => 'trans',
	            'caption'=>'',
	            'created_timestamp'=>'',
	            'copyright'=>'',
	            'focal_length'=>'',
	            'iso'=>'',
	            'shutter_speed'=>''
	        );

	    	// $res['sizes']['thumbnail']		= resize_save(150,150,$target,$target_path,$name,true);	
	    	// $res['sizes']['medium']			= resize_save(300,300,$target,$target_path,$name,false);
	    	// $res['sizes']['large']			= resize_save(1024,1024,$target,$target_path,$name,false);
	    	// $res['sizes']['brand-thumb']	= resize_save(300,300,$target,$target_path,$name,false);
	    	// $res['sizes']['post-thumbnail'] = resize_save(624,624,$target,$target_path,$name,false);


			$res['sizes']['shop_thumbnail'] = resize_save(100,100,$target,$target_path,$name,true);	
			$res['sizes']['shop_catalog'] 	= resize_save(200,150,$target,$target_path,$name,false);
			$res['sizes']['shop_single'] 	= resize_save(360,270,$target,$target_path,$name,false);

			$string = serialize($res);
			// echo "<br>==".$string;
			// add_post_meta($thumbnail_id,'_wp_attachment_metadata',$string,false);




			global $wpdb;

			$wpdb->insert( 
				'wp_postmeta', 
				array( 
					'post_id' 		=> $gallery_id, 
					'meta_key' 		=> '_wp_attachment_metadata',
					'meta_value' 	=> $string
				), 
				array( 
					'%d', 
					'%s',
					'%s'
				) 
			);

	}

	function resize_save($max_width, $max_height,$target,$target_path, $name, $is_crop){
		$image = wp_get_image_editor( $target ); // Return an implementation that extends <tt>WP_Image_Editor</tt>
		$image_title = substr($name, 0, strpos($name,'.'));
		$_mime_type = substr($name, strpos($name,'.')+1, 3);

		$size_array = $image->get_size();
		print_r($size_array);


		// 等比例缩放
		$name_width = 0;
		$name_height = 0;

		if ($is_crop) {
			$name_width = $max_width;
			$name_height = $max_height;
		}else{
			if ($size_array['width'] >= $size_array['height'] ) {
			# code...
			$name_width = $max_width;
			$name_height = round($max_height * $size_array['height']/$size_array['width']);
			}else{
				$name_height = $max_height;
				$name_width = round($max_width * $size_array['width']/$size_array['height']);
			}
		}

		


		if ( ! is_wp_error( $image ) ) {			
		    $image->resize( $max_width, $max_height, $is_crop );
		    $path = $target_path."/".$image_title."-".$name_width."x".$name_height.".".$_mime_type;
		    $image->save( $path);
		}

		$res = array('file' => $image_title."-".$name_width."x".$name_height.".".$_mime_type,
					'width' => $name_width,
		            'height' => $name_height,
		            'mime-type' => 'image/jpeg');

		return $res;
	}

	function get_datea()
	{	
		echo "<pre>";
		$tt = get_post_meta(2205, '_wp_attachment_metadata',true);
		// print_r($tt);
		// $mydata = unserialize();
		// print_r($mydata);

		$image_attribute1 = wp_get_attachment_image_src(1121,'shop_single'); // returns an array
		$image_attribute2 = wp_get_attachment_image_src(2212,'shop_single'); // returns an array
		print_r($image_attribute1);
		print_r($image_attribute2);

		echo "</pre>";


	}

	// get_datea();


 ?>

<?php 

	echo "<h2>Goods list</h2>";
	global $wpdb;
	$result = $wpdb->get_results( 
		" SELECT g.img_id, g.goods_id,g.img_original, p.ID, p.post_title FROM sm_goods_gallery as g ".
		" LEFT JOIN wp_posts as p on p.menu_order = g.goods_id "
		// ." WHERE g.img_id < 200 "
		." WHERE g.img_id >= 200 "

	 	,ARRAY_A);
	// print_r($result);
	if($_POST['oscimp_hidden'] == 'Y') {

	// print_r($sm_brand);

	   	foreach ($result as $key => $value) {
			echo "gid ".$value['goods_id']."- pid.".$value['ID']."-".$value['post_title'].'-'.$value['img_original']."<br>"; //
			$_array = explode("/",$value['img_original']);

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


			echo "month:".$month."-name:".$name."-title:".$image_title."-mine_type:".$post_mine_type;

			// update_product_guid($value['post_id'],$year, $month, $name);
			$coname = $year."/".$month."/".strtolower($name);
			$guid_string = "http://local.osc-pro.com/wp-content/uploads/".$coname; //古典吉他（6N03）.jpg


			$_prefix = $_SERVER["DOCUMENT_ROOT"]."/wp-content/uploads/";
			$_path 		= $_prefix.$year."/".$month;
			$_target 	= $_prefix.$coname;
			$_source 	= $_prefix.$value['img_original'];

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

			if (!empty($value['img_original'])) {
				# code...

				
				$gallery_id = insert_product_image($my_post,$coname);

				movefile($_path,$_target,$_source,$name,$year,$month,$gallery_id);


			}


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
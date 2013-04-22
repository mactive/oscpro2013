<div class="wrap">
<?php    echo "<h2>" . __( 'OSCommerce Product Display Options', 'oscimp_trdom' ) . "</h2>"; ?>

<?php 

		function get_sm_parent_name($name){
			echo $name."<br>";
			global $wpdb;
			$t1 = $wpdb->get_row( "SELECT parent_id FROM sm_category where cat_name like '".$name."'" , ARRAY_A);
			$parent_id = $t1['parent_id'];
			$result = $wpdb->get_row( "SELECT cat_name FROM sm_category where cat_id = ".$parent_id , ARRAY_A);

			return $result['cat_name'];
		}

		function update_product_cat(){}

 ?>
<?php 

	echo "<h2>update list</h2>";
	echo '<pre>';
	global $wpdb;
	$result = get_terms("product_cat",array(
		 	'orderby'    => 'count',
		 	'hide_empty' => 0
		 ));
	// print_r($result);

	if($_POST['oscimp_hidden'] == 'Y') {

	   	foreach ($result as $key => $value) {
	   		// echo $value->parent.'<br>';

	   		if ($value->parent == 105) {
	   			# code...
	   			$p_name = get_sm_parent_name($value->name);

	   			$parent_term = term_exists( $p_name, 'product_cat' ); // array is returned if taxonomy is given
	   		
				echo $key."-".$value->term_id.'-'.$p_name.'-'.$parent_term['term_id']."<br><br><br><br>"; //


				// wp_update_term($value->term_id, 'product_cat', array(
				// 	  'parent' => $parent_term['term_id']
				// 	));
	   		}

	   		
		}



	}
?>


<?php 
	echo '</pre>';


?>


<form name="oscimp_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
	<input type="hidden" name="oscimp_hidden" value="Y">

	<p class="submit">
	<input type="submit" name="Submit" value="<?php _e('Update Options', 'oscimp_trdom' ) ?>" />
	</p>
</form>

</div>
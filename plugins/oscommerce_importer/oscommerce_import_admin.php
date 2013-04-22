<div class="wrap">
<?php    echo "<h2>" . __( 'OSCommerce Product Display Options', 'oscimp_trdom' ) . "</h2>"; ?>

<?php 
		function insert_category($_value,$_parent){
			// $parent_term = term_exists( $_parent, 'product_cat' ); // array is returned if taxonomy is given
			// $parent_term_id = $parent_term['term_id'] > 0 ? $parent_term_id : ''; // get numeric term id
			
			wp_insert_term(
			  	$_value, // the term 
			  	'product_cat', // the taxonomy
			  	array(
			    	'description'=> '',
			    	'slug' => $_value,
			    	'parent'=> $_parent
			  	)
			);
		} 

		function update_product_cat(){}

 ?>
<?php 

	echo "<h2>brand list</h2>";

	global $wpdb;
	$result = $wpdb->get_results( "SELECT cat_id,cat_name,parent_id FROM sm_category ",ARRAY_A);
	// print_r($result);
	if($_POST['oscimp_hidden'] == 'Y') {

	// print_r($sm_brand);

	   	foreach ($result as $key => $value) {

	   		if ($value['parent_id'] != 0) {
				 $tt= $wpdb->get_row("SELECT cat_name FROM sm_category WHERE cat_id = ".$value['parent_id'], ARRAY_A);
				 $parent_name = $tt['cat_name'];
				 // insert_category($value['cat_name'],2);

	   		}else{
	   			// insert_category($value['cat_name'],0);
	   			$parent_name = 'root';
	   		}

			echo $key."-".$value['cat_name'].'-'.$parent_name."<br>"; //
		}



	}
?>


<?php 
		function insert_brand($_value){
			wp_insert_term(
			  	$_value, // the term 
			  	'product_brand', // the taxonomy
			  	array(
			    	'description'=> '',
			    	'slug' => $_value,
			    	'parent'=> 0
			  	)
			);
		} 

?>


<form name="oscimp_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
	<input type="hidden" name="oscimp_hidden" value="Y">

	<p class="submit">
	<input type="submit" name="Submit" value="<?php _e('Update Options', 'oscimp_trdom' ) ?>" />
	</p>
</form>

</div>
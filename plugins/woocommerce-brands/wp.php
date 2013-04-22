<?php 

	$parent_term = term_exists( 'Apple', 'product_brand' ); // array is returned if taxonomy is given
	echo $parent_term;

	
	$parent_term_id = $parent_term['term_id']; // get numeric term id

	// wp_insert_term(
	//   'Apple', // the term 
	//   'product', // the taxonomy
	//   array(
	//     'description'=> 'A yummy apple.',
	//     'slug' => 'apple',
	//     'parent'=> $parent_term_id
	//   )
	// );

 ?>
<?php
function my_date_archive_for_category() {

        $request = $_SERVER['REQUEST_URI'];

	if(strpos($request, "/archives/category/") !== false) {

		$request_parts = explode('/', $request);

		print_r($request_parts);

        /* lets make sure yyyy and mm are integers */
		$request_parts["4"] = intval($request_parts["4"]);
		if($request_parts["4"] < 0) $request_parts["4"] = 0;

		$request_parts["5"] = intval($request_parts["5"]);
		if($request_parts["5"] < 0) $request_parts["5"] = 0;

		/*
		lets check if all parts are in place
		*/

		if(($request_parts[1] == 'archives') && ($request_parts[2] == 'category') && (!empty($request_parts["3"])) && (!empty($request_parts["4"])) && (!empty($request_parts["5"]))) {

			get_header();

			/* your theme stuff goes here */
			
			/* check if category exists */
			$category_array = get_term_by('slug', $request_parts["3"], "category", ARRAY_A);

			if(!empty($category_array)) {

				/* lets find posts by quering wordpress */
				query_posts(array(
								'cat' => $category_array["term_id"],
								'year'=> $request_parts["4"],
								'monthnum'=>$request_parts["5"],
								));

				if ( have_posts() ) :

					while ( have_posts() ) : the_post();
						/* your post stuff goes here */
						/* I'm using the_title function only to show post titles */
						// the_title();
						$cat = get_the_category() ;
						get_template_part( 'content', $cat[0]->slug );
					endwhile;
				else:
					$is404 = true;
				endif;
			}
			else {
				$is404 = true;
			}
		}
		else {
			// $is404 = true;
			$category_array = get_term_by('slug', $request_parts["3"], "category", ARRAY_A);
			if(!empty($category_array)) {
				query_posts(array(
					'cat' => $category_array["term_id"],
					));
			}
			include(TEMPLATEPATH . '/category-'.$category_array['slug'].'.php');

		}

		if($is404) {
			include(TEMPLATEPATH . '/404.php');
		}
		get_footer();
		exit;
	}
}

add_action('init','my_date_archive_for_category');
               


?>
<?php
function my_date_archive_for_category() {

        $request = $_SERVER['REQUEST_URI'];

	if(strpos($request, "/archives/category/") !== false) {

		$request_parts = explode('/', $request);

		// print_r($request_parts);

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
								'posts_per_page'=>100,
								));



				if ( have_posts() ) :

					include(TEMPLATEPATH . '/archive-catgory.php');


				else:
					$is404 = true;
				endif;
			}
			else {
				$is404 = true;
			}
		}
		else {

			/*
			 * 正常的分页数据
			 * /archives/category/cases/page/2
			 * 
			 */

			$category_array = get_term_by('slug', $request_parts["3"], "category", ARRAY_A);

			if(!empty($category_array)) {
				if ($request_parts["4"] == 'page' && !empty($request_parts["5"]) ) {
					# code...
					query_posts(array(
						'cat' => $category_array["term_id"],
						'paged' => $request_parts["5"]
					));
				}else{
					query_posts(array(
						'cat' => $category_array["term_id"],
					));
				}
				
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
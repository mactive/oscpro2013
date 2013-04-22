<?php 
		function wp_object_terms($post_id){

			global $wpdb;

			$wpdb->insert( 
				'wp_term_relationships', 
				array( 
					'object_id' 		=> $post_id, 
					'term_taxonomy_id' 	=> 2,
					'term_order' 		=> 0
				), 
				array( 
					'%d', 
					'%d',
					'%d'
				) 
			);
		}
?>
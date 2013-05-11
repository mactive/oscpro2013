<?php
/**
 * The template for displaying Category pages.
 *
 * Used to display archive-type pages for posts in a category.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

 ?>

	<section id="primary" class="site-content">
		<div id="content" role="main" class="ml_30px">
		<div class="list_title">
		<?php 
			echo $category_array['name']." ".$request_parts["4"]."-".$request_parts["5"];
		 ?>
		</div>

		<?php 
			while ( have_posts() ) : the_post();
				// print_r($cat);
				get_template_part( 'content', 'comm' );
			endwhile;


			twentytwelve_content_nav( 'nav-below' );

 		?>
		
		</div><!-- #content -->
	</section><!-- #primary -->


<?php get_sidebar(); ?>

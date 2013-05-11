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

get_header(); ?>


	<?php if ( is_active_sidebar( 'sidebar-4' ) ) : ?>
		<div id="secondary">
			<?php dynamic_sidebar( 'sidebar-4' ); ?>
		</div><!-- #secondary -->
	<?php endif; ?>


	<section id="primary" class="site-content category_content">
		<div id="content" role="main" >
		<div class="list_title mb_20px">
		<?php 
			$cat = get_the_category();
			echo "全部".$cat[0]->name;
		 ?>
		</div>
		<?php if ( have_posts() ) : ?>

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();
				$cat = get_the_category() ;
				get_template_part( 'content', $cat[0]->slug );

			endwhile;

			twentytwelve_content_nav( 'nav-below' );
			?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</section><!-- #primary -->


<?php get_footer(); ?>
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


	<?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
		<div id="secondary">
			<?php dynamic_sidebar( 'sidebar-3' ); ?>
		</div><!-- #secondary -->
	<?php endif; ?>


	<section id="primary" class="site-content">
		<div id="content" role="main">
		<div class="list_title">全部新闻</div>
		<?php if ( have_posts() ) : ?>

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();
				echo get_the_category();		
				get_template_part( 'content', get_post_format() );
			endwhile;

			twentytwelve_content_nav( 'nav-below' );
			?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_footer(); ?>
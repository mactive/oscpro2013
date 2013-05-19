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

	<section id="primary" class="site-content category_content ml_20px">
		<div id="content" role="main" >
		<?php
			$cat = get_category_by_slug('videoaudio');
			$args = array('child_of' => $cat->cat_ID, );
			$categories = get_categories( $args ); 
		?> 


		<?php foreach ( $categories as  $subcat ) : ?>

			<div class="<?php echo $subcat->slug ?>_title mb_20px f_left">
				全部<?php echo $subcat->name ?>
			</div>
			<div class="keyline"></div>

			<div class="subcat_area">
			<?php  query_posts('cat='.$subcat->cat_ID); ?>

			<?php if ( have_posts() ) : ?>
					<?php
					/* Start the Loop */
					while ( have_posts() ) : the_post();
						$cat = get_the_category() ;
						get_template_part( 'content', $subcat->slug );

					endwhile;
					?>

			<?php endif; ?>
			<?php  wp_reset_query(); ?>

			</div>
		<?php endforeach; ?>





		</div><!-- #content -->
	</section><!-- #primary -->


<?php get_footer(); ?>
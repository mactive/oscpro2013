<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<?php if ( is_active_sidebar( 'sidebar-4' ) ) : ?>
		<div id="secondary" class="lite_full_ad">
			<?php dynamic_sidebar( 'sidebar-4' ); ?>
		</div><!-- #secondary -->
	<?php endif; ?>


<div class="single_nav">
	<nav class="nav-single">
		<span class="nav-previous block">
			<?php previous_post_link( '%link',  '&larr;上一篇'); ?></span>
		<span class="nav-next block">
			<?php next_post_link( '%link', '下一篇&rarr;'  ); ?></span>

	</nav><!-- .nav-single -->
	<div class="single_nav_title f_left">
		<header class="entry-header">
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<b class="f_right"><?php echo get_the_date(); ?></b>
		</header>
	</div>

	<div class="keyline"></div>
</div>

	<?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
		<div id="left_side">
			<?php dynamic_sidebar( 'sidebar-3' ); ?>
		</div><!-- #secondary -->
	<?php endif; ?>


	<div id="primary" class="site-content f_left">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php 
					$format = get_post_format();
					if ( false === $format )
						$format = 'standard';

				?>
				<?php get_template_part( 'content', $format ); ?>

				<?php //comments_template( '', true ); ?>

			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>
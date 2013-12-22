<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
	<style type="text/css">
   		#wooslider-id-1{height: 200px !important;}
   	</style>

	<?php if ( is_active_sidebar( 'sidebar-4' ) ) : ?>
		<div id="secondary">
			<?php dynamic_sidebar( 'sidebar-4' ); ?>
		</div><!-- #secondary -->
	<?php endif; ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</header>

		<div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
		<footer class="entry-meta">
			<?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post -->


	<?php if ( is_active_sidebar( 'sidebar-6' ) ) : ?>
		<div id="secondary full-width">
			<?php dynamic_sidebar( 'sidebar-6' ); ?>
		</div><!-- #secondary -->
	<?php endif; ?>

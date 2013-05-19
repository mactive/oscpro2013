<?php
/**
 * The template for displaying posts in the Image post format
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
			<a class="block" href="<?php echo get_permalink($post->ID)?>" >
				<?php the_title() ?>
			</a>

	</article><!-- #post -->

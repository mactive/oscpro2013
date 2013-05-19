<?php
/**
 * The template for displaying posts in the Image post format
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="article_square_medium f_left">
			<?php 
                $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium' );
                $url = $thumb['0'];
            ?>

            <a class="radius_3px" href="<?php echo get_permalink($post->ID)?>" style="background-image:url('<?php echo $url;?>');">
            </a>


		</div>
		<div class="f_left">
			<a class="article_title" href="<?php echo get_permalink($post->ID)?>">
				<?php the_title() ?>
			</a>

		</div>

	</article><!-- #post -->

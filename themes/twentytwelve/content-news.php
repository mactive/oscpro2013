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
		<a href="<?php echo get_permalink($post->ID)?>" class="content_comm_a">

		<div class="article_thumbnail f_left">
			<?php 
                $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail' );
                $url = $thumb['0'];
            ?>

            <div class="radius_3px thumbnail_img" style="background-image:url('<?php _e($url);?>');">
            </div>


		</div>
		<div class="article_brief f_left">
			<span class="article_title">
				<?php 
					$title = get_the_title();
					echo mb_substr($title, 0, 35);

				?>
				<span class="time f_right"><?php echo get_post_time('Y-m-d'); ?></span>
			</span>
			<?php 
				$content = get_the_content();
      			$content = strip_tags($content);
				echo mb_substr($content, 0, 75);
			?>
		</div>

		</a>
	</article><!-- #post -->

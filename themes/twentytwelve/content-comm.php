<?php
/**
 * The template for displaying posts in the Image post format
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" class="format-standard">
		<div class="article_thumbnail f_left">
			<?php 
                $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail' );
                $url = $thumb['0'];
                if (empty($url)) {
                	# code...
                	$template_url = get_bloginfo('template_url');
                	$url = $template_url."/img/logo_150.png";
                }


            ?>

            <a class="radius_3px" href="<?php echo get_permalink($post->ID)?>" style="background-image:url('<?php echo $url;?>');">
            </a>


		</div>
		<div class="article_brief f_left">
			<a class="article_title">
				<?php the_title() ?>
				<span class="time f_right"><?php echo get_post_time('Y-m-d'); ?></span>
			</a>
			<?php 
				$content = get_the_content();
      			$content = strip_tags($content);
				echo mb_substr($content, 0, 75);
			?>
		</div>

	</article><!-- #post -->

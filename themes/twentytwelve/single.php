<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<?php 
		$categories = get_the_category(); 
		$post_cat = $categories[0];
		$post_cat_slug = $categories[0]->slug;
	?>

	<?php if ($post_cat_slug != "cases"): ?>

		<?php if ( is_active_sidebar( 'sidebar-4' ) ) : ?>
			<div id="secondary">
				<?php dynamic_sidebar( 'sidebar-4' ); ?>
			</div><!-- #secondary -->
		<?php endif; ?>

	<?php else: ?>

		<aside class="widget_fullad_widget" >
			<?php 
                $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
                $url = $thumb['0'];
            ?>
            <a style="background:url(<?php _e($url);?>) no-repeat center; width:100%; height:370px; display:block;"></a>
		</aside>

	<?php endif ?>

<div class="single_nav">
	<nav class="nav-single">
		<span class="nav-previous block">
			<?php previous_post_link( '%link',  '&larr;上一篇'); ?></span>
		<span class="nav-next block"><?php next_post_link( '%link', '下一篇&rarr;'  ); ?></span>

	</nav><!-- .nav-single -->
	<div class="single_nav_title f_left">
		<header class="entry-header">
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<b class="f_right"><?php echo get_the_date(); ?></b>
		</header>
	</div>

	<div class="keyline"></div>
</div>



	<?php if ($post_cat_slug != "cases"): ?>
		<?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
		<div id="left_side">
			<?php dynamic_sidebar( 'sidebar-3' ); ?>
		</div><!-- #secondary -->
		<?php endif; ?>

	<?php else: ?>
		
		<div id="left_side" class="grouped_custom_field">
			<div class="list_title mb_20px">设备列表</div>

			<?php
				$group =  get_group_custom_field_array(); 
				foreach ($group as $key => $title) {
					# code...
					echo '<span class="radius_3px">'.$title.'</span>';
					$items = $cfs->get($key);
					foreach ($items as $value) {
						# code...
						$_post = get_post($value);
						echo '<a href="'.get_permalink($_post->ID).'">'.$_post->post_title.'</a>';
					}
				}
	 		?>
 		</div>
	<?php endif ?>




	<div id="primary" class="site-content f_left <?php if ($post_cat_slug == "cases"): ?>single_narrow<?php endif ?>">
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


	<?php if ($post_cat_slug == "cases"): ?> 
		<?php if ( is_active_sidebar( 'sidebar-5' ) ) : ?>
		<div id="left_side">
			<?php dynamic_sidebar( 'sidebar-5' ); ?>
		</div><!-- #secondary -->
		<?php endif ?>

	<?php endif; ?>

<?php get_footer(); ?>
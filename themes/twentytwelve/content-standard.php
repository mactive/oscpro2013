<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>">
<!-- 		<header class="entry-header">
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</header>
 -->
		<div class="entry-content f_eft">
 
			<?php 
				if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
				  the_post_thumbnail();
				} 

				the_content();
			?>


		</div><!-- .entry-content -->

	</article><!-- #post -->

<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>


<?php  
/**
 * =================================================================================
 * =================================================================================
 */
?>


<div id="custom_index">
	<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
		<div id="secondary" class="index_theme" >
			<?php dynamic_sidebar( 'sidebar-2' ); ?>
		</div><!-- #secondary -->
	<?php endif; ?>
</div>











<?php 
// get_sidebar(); 
	get_footer(); 
?>
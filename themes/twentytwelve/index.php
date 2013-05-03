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
		<div id="secondary" class="index_roll_news" >
			<?php dynamic_sidebar( 'sidebar-2' ); ?>
		</div><!-- #secondary -->
	<?php endif; ?>

	<div class="pt_10px clear"> 
		<?php $upload_dir = wp_upload_dir("2013/05"); ?>
		<img src="<?php echo $upload_dir['url']."/index_1.jpg" ?>" alt="">
	</div>

</div>











<?php 
// get_sidebar(); 
	get_footer(); 
?>
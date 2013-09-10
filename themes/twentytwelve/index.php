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

$the_slug = 'special-index-info';
$page = get_page_by_path( $the_slug );

?>
<div class="overlay">

    <div id="media_area">
        <a class="overlay-close"></a>
        <?php echo $page->post_content; ?>

    </div>
</div>



<script type="text/javascript">

jQuery(document).ready(function ($) {
	$('div.overlay').children('#media_area').show();
    $('div.overlay').fadeIn();

    // close 
    $('a.overlay-close').click(function(){
        $('div.overlay').fadeOut();
    })
});


</script>







<?php 
// get_sidebar(); 
	get_footer(); 
?>
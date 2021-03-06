<?php
/**
 * The template for displaying posts in the Aside post format
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

<script type="text/javascript" charset="utf-8" async defer>
    jQuery(document).ready(function ($) {
        $(function() {
            $( ".category_list > li" ).each(function(index,element){
              if ($(this).children('ul').length) {
                console.log(index);
              }else{
                $(this).css('background','none');
              }
            });


            $( ".category_list > li" ).children('ul').hide();
            $( ".category_list > li" ).click(function(){
              console.log($(this));
              if ($(this).children('ul').is(":visible")) {
                $(this).children('ul').hide();
              }else{
                $(this).children('ul').show();
              }
            })
        });
    });
</script>

<?php
//list terms in a given taxonomy using wp_list_categories (also useful as a widget if using a PHP Code plugin)

$taxonomy     = 'product_cat';
$orderby      = 'count';
$show_count   = 1;      // 1 for yes, 0 for no
$pad_counts   = 0;      // 1 for yes, 0 for no
$hierarchical = 1;      // 1 for yes, 0 for no
$title        = '';

$args = array(
  'taxonomy'     => $taxonomy,
  'orderby'      => $orderby,
  'show_count'   => $show_count,
  'pad_counts'   => $pad_counts,
  'hierarchical' => $hierarchical,
  'title_li'     => $title,
  'exclude'      => '245,246'
);
?>
<div class="white_section radius_3px">
	<div class="list_title">全部分类</div>
	<div class="keyline"></div>
	<ul class="category_list">
	<?php wp_list_categories( $args ); ?>
	</ul>
</div>
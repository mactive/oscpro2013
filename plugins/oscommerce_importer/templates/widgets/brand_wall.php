<?php
/**
 * Show a brands description when on a taxonomy page
 */
?>


<?php global $woocommerce; ?>
<?php if ( $posts ) : ?>

<div id="brand_wall_div">
    <div class="brand_wall_title">
        <a class="black_block">推荐厂牌 Top Brand</a>
        <a href="brand-list/" class="gray_block">所有品牌 All Brand</a>
    </div>

	<ul class="brand_wall">
	<?php 
		foreach($posts as $post){
	?>
		<li style="width: <?php _e($width); ?>px !important;">
            <a href="brand/<?php _e($post->slug)?>" title="<?php echo $post->name ?>" class="block radius_3px">
                <?php echo $post->name ?>
            </a>
        </li>
	<?php } ?>
	</ul>
</div>


<?php endif; ?>
<?php echo wpautop( wptexturize( term_description() ) ); ?>

<?php
/**
 * Show a brands description when on a taxonomy page
 */
?>
<script type="text/javascript" charset="utf-8">

jQuery(document).ready(function ($) {
	$('ul.news_image_slider').simpleSpy(<?php _e($count); ?>,4000,1);
});

(function ($) {
$.fn.simpleSpy = function (limit, interval, sep_height) {
    limit = limit || 4;
    interval = interval || 4000;
    sep_height = sep_height || 1; // border-bottom 
    
    return this.each(function () {
        // 1. setup
            // capture a cache of all the list items
            // chomp the list down to limit li elements
        var $list = $(this),
            items = [], // uninitialised
            currentItem = limit,
            total = 0, // initialise later on
            height = $list.find('> li:first').height() + sep_height;

        // capture the cache
        $list.find('> li').each(function () {
            items.push('<li>' + $(this).html() + '</li>');
        });
        
        total = items.length;
        
        $list.wrap('<div class="spyWrapper" />').parent().css({ height : height * limit });
        
        $list.find('> li').filter(':gt(' + (limit - 1) + ')').remove();

        // 2. effect        
        function spy() {
            // insert a new item with opacity and height of zero
            // var $insert = $(items[currentItem]).css({
            //     height : 0,
            //     opacity : 0,
            //     display : 'none'
            // }).prependTo($list);

            // fix jquery 1.5
	        var $insert = $(items[currentItem]).css({
			    height : 0,
			    opacity : 1
			}).prependTo($list);

                        
            // fade the LAST item out
            $list.find('> li:last').animate({ opacity : 0}, 1000, function () {
                // increase the height of the NEW first item
                $insert.animate({ height : height }, 1000).animate({ opacity : 1 }, 1000);
                
                // AND at the same time - decrease the height of the LAST item
                // $(this).animate({ height : 0 }, 1000, function () {
                    // finally fade the first item in (and we can remove the last)
                    $(this).remove();
                // });
            });
            
            currentItem++;
            if (currentItem >= total) {
                currentItem = 0;
            }
            
            setTimeout(spy, interval)
        }
        
        spy();
    });
};
    
})(jQuery);

</script>

<?php global $woocommerce; ?>
<?php if ( $posts ) : ?>
<div id="sidebar" style="width: <?php _e($width); ?>px !important;">
	<ul class="news_image_slider">
	<?php 
		foreach($posts as $post){
			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium' );
			$url = $thumb['0'];
	?>
		<li>
            <a href="<?php echo get_permalink($post->ID); ?>" title="<?php echo $post->post_title ?>" style="background-image:url(<?php echo $url; ?>);">
                <b><?php echo $post->post_title ?></b>
            </a>
        </li>
	<?php } ?>
	</ul>
</div>


<?php endif; ?>
<?php echo wpautop( wptexturize( term_description() ) ); ?>

<?php
/**
 * Show a brands description when on a taxonomy page
 */
?>


<?php global $woocommerce; ?>
        
<div class="list_title">其他<?php _e($title) ?></div>

<ul class="calendar">
    <?php
        global $post;
        $myposts = get_posts( $args );
        foreach( $myposts as $post ) :  setup_postdata($post); ?>
            <li class="block"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>

        <?php endforeach; ?>
</ul>

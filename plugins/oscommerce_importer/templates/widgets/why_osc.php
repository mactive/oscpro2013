<?php
/**
 * Show a brands description when on a taxonomy page
 */
?>

<?php global $woocommerce; ?>

<div id="whyosc_div" style="width: <?php _e($width); ?>px !important;">
    <img src="<?php bloginfo( 'template_url' ); ?>/img/why_choose.png" alt="">
    <img src="<?php bloginfo( 'template_url' ); ?>/img/why_trust.png" alt="">
</div>


<?php echo wpautop( wptexturize( term_description() ) ); ?>

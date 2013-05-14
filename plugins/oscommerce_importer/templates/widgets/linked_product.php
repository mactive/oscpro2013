<?php
/**
 * Show a brands description when on a taxonomy page
 */
?>


<?php global $woocommerce; ?>
        
<div class="tag_title">相关产品</div>

<ul class="calendar">
    <?php
      	foreach ( $products as $key => $value ){?>

            <li class="block"><a href="<?php echo $value; ?>"><?php echo $key; ?></a></li>

        <?php } ?>
</ul>

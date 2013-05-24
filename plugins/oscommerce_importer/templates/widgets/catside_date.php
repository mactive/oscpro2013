<?php
/**
 * Show a brands description when on a taxonomy page
 */
?>

<script type="text/javascript" charset="utf-8" async defer>
    jQuery(document).ready(function ($) {
        $(function() {
            //
            $('.calendar a')
               .each(function()
               { 
                  this.href = this.href.replace('date', 
                     "category/<?php _e($slug) ?>");
               });
        });
    });
</script>

<?php global $woocommerce; ?>
        
        <div class="news_title"><?php _e($title) ?>日历</div>
        <ul class="calendar">
            <?php wp_get_archives($args) ?>
        </ul>

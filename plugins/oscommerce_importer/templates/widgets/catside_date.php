<?php
/**
 * Show a brands description when on a taxonomy page
 */
?>
<script type="text/javascript" charset="utf-8" async defer>
    jQuery(document).ready(function ($) {
        $(function() {
            var count = $("ul.calendar li").length;
            var default_count = 16;
            if (count > default_count) {
              $('a#more').show();
            }else{
              $('a#more').hide();
            }


            $("ul.calendar li").each(function(index,Element){
              if (index > default_count) {
                $(this).hide();
              };
            });

            $('a#more').click(function(){
              $("ul.calendar li").show();
              $(this).hide();
            });
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

        <a id="more" class="calendar_more">更多&darr;</a>

<?php
/* Define the custom box */

add_action( 'add_meta_boxes', 'macplugin_add_custom_box' );

// backwards compatible (before WP 3.0)
add_action( 'admin_init', 'macplugin_add_custom_box', 1 );

/* Do something with the data entered */
add_action( 'save_post', 'macplugin_save_postdata' );

/* Adds a box to the main column on the Post and Page edit screens */
function macplugin_add_custom_box() {
    add_meta_box( 'woocommerce-product-data', __( 'Product Data', 'woocommerce' ), 'macplugin_inner_custom_box', 'post', 'normal', 'high' );
}

/* Prints the box content */
function macplugin_inner_custom_box( $post ) {

  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'macplugin_noncename' );

  // The actual fields for data entry
  // Use get_post_meta to retrieve an existing value from the database and use the value for the form
  $value = get_post_meta( $post->ID, '_my_meta_value_key', true );
  echo '<label for="macplugin_new_field">';
       _e("Description for this field", 'macplugin_textdomain' );
  echo '</label> ';
  echo '<input type="text" id="macplugin_new_field" name="macplugin_new_field" value="'.esc_attr($value).'" size="25" />';
?>
        
        <div id="linked_product_data" class="panel woocommerce_options_panel">

            <div class="options_group">

            <p class="form-field"><label for="upsell_ids"><?php _e( 'Up-Sells', 'woocommerce' ); ?></label>
            <select id="upsell_ids" name="upsell_ids[]" class="ajax_chosen_select_products" multiple="multiple" data-placeholder="<?php _e( 'Search for a product&hellip;', 'woocommerce' ); ?>">
                <?php
                    $upsell_ids = get_post_meta( $post->ID, '_upsell_ids', true );
                    $product_ids = ! empty( $upsell_ids ) ? array_map( 'absint',  $upsell_ids ) : null;
                    if ( $product_ids ) {
                        foreach ( $product_ids as $product_id ) {

                            $product      = get_product( $product_id );
                            $product_name = woocommerce_get_formatted_product_name( $product );

                            echo '<option value="' . esc_attr( $product_id ) . '" selected="selected">' . esc_html( $product_name ) . '</option>';
                        }
                    }
                ?>
            </select> <img class="help_tip" data-tip='<?php _e( 'Up-sells are products which you recommend instead of the currently viewed product, for example, products that are more profitable or better quality or more expensive.', 'woocommerce' ) ?>' src="<?php echo $woocommerce->plugin_url(); ?>/assets/images/help.png" height="16" width="16" /></p>

            <p class="form-field"><label for="crosssell_ids"><?php _e( 'Cross-Sells', 'woocommerce' ); ?></label>
            <select id="crosssell_ids" name="crosssell_ids[]" class="ajax_chosen_select_products" multiple="multiple" data-placeholder="<?php _e( 'Search for a product&hellip;', 'woocommerce' ); ?>">
                <?php
                    $crosssell_ids = get_post_meta( $post->ID, '_crosssell_ids', true );
                    $product_ids = ! empty( $crosssell_ids ) ? array_map( 'absint',  $crosssell_ids ) : null;
                    if ( $product_ids ) {
                        foreach ( $product_ids as $product_id ) {

                            $product      = get_product( $product_id );
                            $product_name = woocommerce_get_formatted_product_name( $product );

                            echo '<option value="' . esc_attr( $product_id ) . '" selected="selected">' . esc_html( $product_name ) . '</option>';
                        }
                    }
                ?>
            </select> <img class="help_tip" data-tip='<?php _e( 'Cross-sells are products which you promote in the cart, based on the current product.', 'woocommerce' ) ?>' src="<?php echo $woocommerce->plugin_url(); ?>/assets/images/help.png" height="16" width="16" /></p>

            </div>

            <?php

            echo '<div class="options_group grouping show_if_simple show_if_external">';

                // List Grouped products
                $post_parents = array();
                $post_parents[''] = __( 'Choose a grouped product&hellip;', 'woocommerce' );

                $posts_in = array_unique( (array) get_objects_in_term( get_term_by( 'slug', 'grouped', 'product_type' )->term_id, 'product_type' ) );
                if ( sizeof( $posts_in ) > 0 ) {
                    $args = array(
                        'post_type'     => 'product',
                        'post_status'   => 'any',
                        'numberposts'   => -1,
                        'orderby'       => 'title',
                        'order'         => 'asc',
                        'post_parent'   => 0,
                        'include'       => $posts_in,
                    );
                    $grouped_products = get_posts( $args );

                    if ( $grouped_products ) {
                        foreach ( $grouped_products as $product ) {

                            if ( $product->ID == $post->ID )
                                continue;

                            $post_parents[ $product->ID ] = $product->post_title;
                        }
                    }
                }

                woocommerce_wp_select( array( 'id' => 'parent_id', 'label' => __( 'Grouping', 'woocommerce' ), 'value' => absint( $post->post_parent ), 'options' => $post_parents, 'desc_tip' => true, 'description' => __( 'Set this option to make this product part of a grouped product.', 'woocommerce' ) ) );

                woocommerce_wp_hidden_input( array( 'id' => 'previous_parent_id', 'value' => absint( $post->post_parent ) ) );

                do_action( 'woocommerce_product_options_grouping' );

            echo '</div>';
            ?>

            <?php do_action( 'woocommerce_product_options_related' ); ?>

        </div>

<?php 
}

/* When the post is saved, saves our custom data */
function macplugin_save_postdata( $post_id ) {

  // First we need to check if the current user is authorised to do this action. 
  if ( 'page' == $_POST['post_type'] ) {
    if ( ! current_user_can( 'edit_page', $post_id ) )
        return;
  } else {
    if ( ! current_user_can( 'edit_post', $post_id ) )
        return;
  }

  // Secondly we need to check if the user intended to change this value.
  if ( ! isset( $_POST['macplugin_noncename'] ) || ! wp_verify_nonce( $_POST['macplugin_noncename'], plugin_basename( __FILE__ ) ) )
      return;

  // Thirdly we can save the value to the database

  //if saving in a custom table, get post_ID
  $post_ID = $_POST['post_ID'];
  //sanitize user input
  $mydata = sanitize_text_field( $_POST['macplugin_new_field'] );

  // Do something with $mydata 
  // either using 
  add_post_meta($post_ID, '_my_meta_value_key', $mydata, true) or
    update_post_meta($post_ID, '_my_meta_value_key', $mydata);
  // or a custom table (see Further Reading section below)
}
?>
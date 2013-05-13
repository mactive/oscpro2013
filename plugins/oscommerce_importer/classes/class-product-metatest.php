<?php
/* Define the custom box */

add_action( 'add_meta_boxes', 'macplugin_add_custom_box' );

// backwards compatible (before WP 3.0)
add_action( 'admin_init', 'macplugin_add_custom_box', 1 );

/* Do something with the data entered */
add_action( 'save_post', 'macplugin_save_postdata' );

/* Adds a box to the main column on the Post and Page edit screens */
function macplugin_add_custom_box() {
    add_meta_box( 'woocommerce-product-data', __( 'Product Data', 'woocommerce' ), 'woocommerce_product_data_box', 'post', 'normal', 'high' );
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
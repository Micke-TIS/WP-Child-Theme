<?php

/**
 * Storefront automatically loads the core CSS even if using a child theme as it is more efficient
 * than @importing it in the child theme style.css file.
 *
 * Uncomment the line below if you'd like to disable the Storefront Core CSS.
 *
 * If you don't plan to dequeue the Storefront Core CSS you can remove the subsequent line and as well
 * as the sf_child_theme_dequeue_style() function declaration.
 */
//add_action( 'wp_enqueue_scripts', 'sf_child_theme_dequeue_style', 999 );

/**
 * Dequeue the Storefront Parent theme core CSS
 */
function sf_child_theme_dequeue_style() {
    wp_dequeue_style( 'storefront-style' );
    wp_dequeue_style( 'storefront-woocommerce-style' );
}

/**
 * Note: DO NOT! alter or remove the code above this text and only add your custom PHP functions below this text.
 */

 /**
 * Displays the custom text field input field in the WooCommerce product data meta box
 */
 function cfwc_create_custom_field() {
 $args = array(
 'id' => 'custom_text_field_title',
 'label' => __( 'Custom Text Field Title', 'cfwc' ),
 'class' => 'cfwc-custom-field',
 'desc_tip' => true,
 'description' => __( 'Enter the title of your custom text field.', 'ctwc' ),
 );
 woocommerce_wp_text_input( $args );
 }
 add_action( 'woocommerce_product_options_general_product_data', 'cfwc_create_custom_field' );
 /**
 * Saves the custom field data to product meta data
 */
 function cfwc_save_custom_field( $post_id ) {
 $product = wc_get_product( $post_id );
 $title = isset( $_POST['custom_text_field_title'] ) ? $_POST['custom_text_field_title'] : '';
 $product->update_meta_data( 'custom_text_field_title', sanitize_text_field( $title ) );
 $product->save();
 }
 add_action( 'woocommerce_process_product_meta', 'cfwc_save_custom_field' );

 /**
* Displays custom field data after the add to cart button
*/
function cfwc_display_custom_field() {
global $post;
// Check for the custom field value
$product = wc_get_product( $post->ID );
$title = $product->get_meta( 'custom_text_field_title' );
if( $title ) {
echo get_post_meta($post->ID, 'custom_text_field_title', true);
}
}
add_action( 'woocommerce_after_add_to_cart_button', 'cfwc_display_custom_field' );

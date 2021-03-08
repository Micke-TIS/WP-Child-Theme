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

// Declaring custom template functioning on woocommerce
 function mytheme_add_woocommerce_support() {
 add_theme_support( 'woocommerce' );
 }
 add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );

//Making of custom fields on woocommerce product in general tab
 // Display Fields
 add_action('woocommerce_product_options_general_product_data', 'woocommerce_product_custom_fields');
 // Save Fields
 add_action('woocommerce_process_product_meta', 'woocommerce_product_custom_fields_save');
 function woocommerce_product_custom_fields()
 {
     global $woocommerce, $post;
     echo '<div class="product_custom_field">';
     // Custom Product Text Field
     woocommerce_wp_text_input(
         array(
             'id' => '_custom_product_text_field',
             'placeholder' => 'Custom Product Text Field',
             'label' => __('Custom Product Text Field', 'woocommerce'),
             'desc_tip' => 'true'
         )
     );
     //Custom Product Number Field
     woocommerce_wp_text_input(
         array(
             'id' => '_custom_product_number_field',
             'placeholder' => 'Custom Product Number Field',
             'label' => __('Custom Product Number Field', 'woocommerce'),
             'type' => 'number',
             'custom_attributes' => array(
                 'step' => 'any',
                 'min' => '0'
             )
         )
     );
     //Custom Product  Textarea
     woocommerce_wp_textarea_input(
         array(
             'id' => '_custom_product_textarea',
             'placeholder' => 'Custom Product Textarea',
             'label' => __('Custom Product Textarea', 'woocommerce')
         )
     );
     echo '</div>';
 }
// Saving the custom fields in database
 function woocommerce_product_custom_fields_save($post_id)
 {
     // Custom Product Text Field
     $woocommerce_custom_product_text_field = $_POST['_custom_product_text_field'];
     if (!empty($woocommerce_custom_product_text_field))
         update_post_meta($post_id, '_custom_product_text_field', esc_attr($woocommerce_custom_product_text_field));
 // Custom Product Number Field
     $woocommerce_custom_product_number_field = $_POST['_custom_product_number_field'];
     if (!empty($woocommerce_custom_product_number_field))
         update_post_meta($post_id, '_custom_product_number_field', esc_attr($woocommerce_custom_product_number_field));
 // Custom Product Textarea Field
     $woocommerce_custom_procut_textarea = $_POST['_custom_product_textarea'];
     if (!empty($woocommerce_custom_procut_textarea))
         update_post_meta($post_id, '_custom_product_textarea', esc_html($woocommerce_custom_procut_textarea));
 }

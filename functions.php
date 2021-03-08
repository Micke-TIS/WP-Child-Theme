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

 function woocommerce_product_custom_fields()
 {
   $args = array(
       'id' => 'woocommerce_custom_fields',
       'label' => __('Add WooCommerce Custom Fields', 'cwoa'),
   );
   woocommerce_wp_text_input($args);
 }

 add_action('woocommerce_product_options_general_product_data', 'woocommerce_product_custom_fields');


 function save_woocommerce_product_custom_fields($post_id)
{
    $product = wc_get_product($post_id);
    $custom_fields_woocommerce_title = isset($_POST['woocommerce_custom_fields']) ? $_POST['woocommerce_custom_fields'] : '';
    $product->update_meta_data('woocommerce_custom_fields', sanitize_text_field($custom_fields_woocommerce_title));
    $product->save();
}
add_action('woocommerce_process_product_meta', 'save_woocommerce_product_custom_fields');

function woocommerce_custom_fields_display()
{
  global $post;
  $product = wc_get_product($post->ID);
    $custom_fields_woocommerce_title = $product->get_meta('woocommerce_custom_fields');
  if ($custom_fields_woocommerce_title) {
      printf(
            '<div><label>%s</label><input type="text" id="woocommerce_product_custom_fields_title" name="woocommerce_product_custom_fields_title" value=""></div>',
            esc_html($custom_fields_woocommerce_title)
      );
  }
}

add_action('woocommerce_before_add_to_cart_button', 'woocommerce_custom_fields_display');

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

 // Add a custom product setting tab to edit product pages options FOR SIMPLE PRODUCTS only
 add_filter( 'woocommerce_product_data_tabs', 'stuff_new_product_data_tab', 50, 1 );
 function stuff_new_product_data_tab( $tabs ) {
     $tabs['stuff'] = array(
         'label' => __( 'Special Stuff', 'woocommerce' ),
         'target' => 'stuff_product_data', // <== to be used in the <div> class of the content
         'class' => array('show_if_simple'), // or 'hide_if_simple' or 'show_if_variable'…
     );

     return $tabs;
 }

 // Add/display custom Fields in the custom product settings tab
 add_action( 'woocommerce_product_data_panels', 'add_custom_fields_product_options_stuff', 10 );
 function add_custom_fields_product_options_stuff() {
     global $post;

     echo '<div id="stuff_product_data" class="panel woocommerce_options_panel">'; // <== Here we use the target attribute
//Adding some stuff in our custom settings tab
}

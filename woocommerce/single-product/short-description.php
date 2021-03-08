<?php
/**
 * Single product short description
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/short-description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $post;

$short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );

if ( ! $short_description ) {
	return;
}

?>
<div class="woocommerce-product-details__short-description">
	<?php echo $short_description; // WPCS: XSS ok. ?>
</div>

<?php while (have_posts()) : the_post(); ?>
<?php wc_get_template_part('content', 'single-product'); ?>
<?php
// Display the value of custom product text field
    echo get_post_meta($post->ID, '_custom_product_text_field', true);
// Display the value of custom product number field
    echo get_post_meta(get_the_ID(), '_custom_product_number_field', true);
// Display the value of custom product text area
    echo get_post_meta(get_the_ID(), '_custom_product_textarea', true);
    ?>
<?php endwhile; // end of the loop. ?>

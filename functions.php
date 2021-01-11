<?php

/*
 |------------------------------------------------------------------
 | Bootstraping a Theme
 |------------------------------------------------------------------
 |
 | This file is responsible for bootstrapping your theme. Autoloads
 | composer packages, checks compatibility and loads theme files.
 | Most likely, you don't need to change anything in this file.
 | Your theme custom logic should be distributed across a
 | separated components in the `/app` directory.
 |
 */

// Require Composer's autoloading file
// if it's present in theme directory.
if (file_exists($composer = __DIR__ . '/vendor/autoload.php')) {
    require $composer;
}

// Before running we need to check if everything is in place.
// If something went wrong, we will display friendly alert.
$ok = require_once __DIR__ . '/bootstrap/compatibility.php';

if ($ok) {
    // Now, we can bootstrap our theme.
    $theme = require_once __DIR__ . '/bootstrap/theme.php';

    // Autoload theme. Uses localize_template() and
    // supports child theme overriding. However,
    // they must be under the same dir path.
    (new Tonik\Gin\Foundation\Autoloader($theme->get('config')))->register();
}

add_filter( 'fl_builder_render_assets_inline', '__return_true' );
function my_global_builder_posts( $post_ids ) {
    $post_ids = get_all_page_ids();
    return $post_ids;
}
add_filter( 'fl_builder_global_posts', 'my_global_builder_posts' );

add_filter('fl_builder_column_attributes', function ($attrs, $row) {
      $attrs['data-scroll-section'] = '';
    return $attrs;
  }, 10, 2);

function wpse33318_tiny_mce_before_init( $mce_init ) {

    $mce_init['cache_suffix'] = 'v=123';

    return $mce_init;    
}
add_filter( 'tiny_mce_before_init', 'wpse33318_tiny_mce_before_init' );


remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
/**
 * Add our own action to the woocommerce_before_shop_loop_item_title hook with the same priority that woocommerce used
 */
add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

/**
 * WooCommerce Loop Product Thumbs
 */
if (!function_exists('woocommerce_template_loop_product_thumbnail')) {
    /**
     * echo thumbnail HTML
     */
    function woocommerce_template_loop_product_thumbnail()
    {
        echo woocommerce_get_product_thumbnail();
    }
}

/**
 * WooCommerce Product Thumbnail
 */
if (!function_exists('woocommerce_get_product_thumbnail')) {

    /**
     * @param string $size
     * @param int $placeholder_width
     * @param int $placeholder_height
     * @return string
     */
    function woocommerce_get_product_thumbnail($size = 'shop_catalog', $placeholder_width = 0, $placeholder_height = 0)
    {
        global $post, $woocommerce;
        
        //NOTE: those are PHP 7 ternary operators. Change to classic if/else if you need PHP 5.x support.
        $placeholder_width = !$placeholder_width ?
            wc_get_image_size('shop_catalog_image_width')[ 'width' ] :
            $placeholder_width;

        $placeholder_height = !$placeholder_height ?
            wc_get_image_size('shop_catalog_image_height')[ 'height' ] :
            $placeholder_height;

        /**
         * EDITED HERE: here I added a div around the <img> that will be generated
         */
        $output = '<div class="my-3">';

        /**
         * This outputs the <img> or placeholder image. 
         * it's a lot better to use get_the_post_thumbnail() that hardcoding a text <img> tag
         * as wordpress wil add many classes, srcset and stuff.
         */
        $output .= has_post_thumbnail() ?
            get_the_post_thumbnail($post->ID, $size) :
            '<img class="w-full" src="' . wc_placeholder_img_src() . '" alt="Placeholder" width="' . $placeholder_width . '" height="' . $placeholder_height . '" />';

        /**
         * Close added div .my_new_wrapper
         */
        $output .= '</div>';

        return $output;
    }
}


<?php

/**
 * Storefront engine room
 *
 * @package storefront
 */

/**
 * Assign the Storefront version to a var
 */
$theme              = wp_get_theme('storefront');
$storefront_version = $theme['Version'];

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if (!isset($content_width)) {
	$content_width = 980; /* pixels */
}

$storefront = (object) array(
	'version'    => $storefront_version,

	/**
	 * Initialize all the things.
	 */
	'main'       => require 'inc/class-storefront.php',
	'customizer' => require 'inc/customizer/class-storefront-customizer.php',
);

require 'inc/storefront-functions.php';
require 'inc/storefront-template-hooks.php';
require 'inc/storefront-template-functions.php';
require 'inc/wordpress-shims.php';

if (class_exists('Jetpack')) {
	$storefront->jetpack = require 'inc/jetpack/class-storefront-jetpack.php';
}

if (storefront_is_woocommerce_activated()) {
	$storefront->woocommerce            = require 'inc/woocommerce/class-storefront-woocommerce.php';
	$storefront->woocommerce_customizer = require 'inc/woocommerce/class-storefront-woocommerce-customizer.php';

	require 'inc/woocommerce/class-storefront-woocommerce-adjacent-products.php';

	require 'inc/woocommerce/storefront-woocommerce-template-hooks.php';
	require 'inc/woocommerce/storefront-woocommerce-template-functions.php';
	require 'inc/woocommerce/storefront-woocommerce-functions.php';
}

if (is_admin()) {
	$storefront->admin = require 'inc/admin/class-storefront-admin.php';

	require 'inc/admin/class-storefront-plugin-install.php';
}

/**
 * NUX
 * Only load if wp version is 4.7.3 or above because of this issue;
 * https://core.trac.wordpress.org/ticket/39610?cversion=1&cnum_hist=2
 */
if (version_compare(get_bloginfo('version'), '4.7.3', '>=') && (is_admin() || is_customize_preview())) {
	require 'inc/nux/class-storefront-nux-admin.php';
	require 'inc/nux/class-storefront-nux-guided-tour.php';
	require 'inc/nux/class-storefront-nux-starter-content.php';
}

remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs');
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);

add_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 1);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 28);

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 10 );

add_action( 'woocommerce_after_shop_loop', 'woocommerce_catalog_ordering', 1 );
add_filter( 'woocommerce_get_availability', 'wcs_custom_get_availability', 1, 2);


//  Next and Prev links in product gallery
add_filter('woocommerce_single_product_carousel_options', 'custom_product_gallery_arrows');
function custom_product_gallery_arrows( $options ) {
	$options['directionNav'] = true;
  	return $options;
}

//Remove product zoom
add_action('after_setup_theme', 'remove_zoom_theme_support', 100);
function remove_zoom_theme_support() {
	remove_theme_support('wc-product-gallery-zoom');
}

// viewed products
add_action( 'template_redirect', 'custom_recently_viewed_product_cookie', 20 );
 
function custom_recently_viewed_product_cookie() {
 
	// setting cookie only on product page
	if ( ! is_product() ) {
		return;
	}
 
 
	if ( empty( $_COOKIE[ 'woocommerce_recently_viewed_2' ] ) ) {
		$viewed_products = array();
	} else {
		$viewed_products = (array) explode( '|', $_COOKIE[ 'woocommerce_recently_viewed_2' ] );
	}
 
	// add current product to array
	if ( ! in_array( get_the_ID(), $viewed_products ) ) {
		$viewed_products[] = get_the_ID();
	}
 
	// limit products to 4
	if ( sizeof( $viewed_products ) > 4 ) {
		array_shift( $viewed_products ); // drop first element
	}
 
 	// set in cookie
	wc_setcookie( 'woocommerce_recently_viewed_2', join( '|', $viewed_products ) );
 
}

add_shortcode( 'recently_viewed_products', 'custom_recently_viewed_products' );
 
function custom_recently_viewed_products() {
 
	if( empty( $_COOKIE[ 'woocommerce_recently_viewed_2' ] ) ) {
		$viewed_products = array();
	} else {
		$viewed_products = (array) explode( '|', $_COOKIE[ 'woocommerce_recently_viewed_2' ] );
	}
 
	if ( empty( $viewed_products ) ) {
		return;
	}
 
	// reverse to show last viewed product at first
	$viewed_products = array_reverse( array_map( 'absint', $viewed_products ) );
 
	$product_ids = join( ",", $viewed_products );
 
	return do_shortcode( "[products ids='$product_ids']" );
 
}

/**
 * 
 * Check if we're on the archive page for your custom post type
 * 
 * @param $query array
 * 
 * @return bool|null
 **/
function custom_archive_pagination( $query ) {


  $is_shop = is_shop();
  $is_cat = is_product_category();

  if ( ( $is_shop | $is_cat ) && $query->is_main_query() && !is_search() ) {

    $catsize_enabled = isset($_COOKIE['catsize']) && !isset($_GET['pa_razmer']);

    function setCatSizeinGET($enabled) {

      if ($enabled) {

        $sizeRange = explode('-', sanitize_text_field($_COOKIE['catsize']) );
        $_GET['pa_razmer'] = '';

        if ( count($sizeRange) === 2 ) {

          $maxCookieSize = intval($sizeRange[1]);
          $minCookieSize = intval($sizeRange[0]);
          $cookieSizes = array();

          for ($i = $minCookieSize; $i <= $maxCookieSize; $i++) {
            $cookieSizes[] = $i . 'RU';
            $cookieSizes[] = $i . '(обувь)';
          }

          $_GET['pa_razmer'] = implode(',', $cookieSizes);

        }

      }

    }

    if ( $is_cat ) {

      $category_id = get_queried_object()->term_id;
      $category = get_term($category_id, 'product_cat'); 
      $parent_cat = $category->parent;
      
      $out_of_filter = array(
        19,20,84,85,86,87,88,89,90,91,92,93,94
      );

      global $no_size;
      $no_size = in_array($parent_cat, $out_of_filter) || in_array($category_id, $out_of_filter);

      if ( $no_size ) {
        echo '<script>const noSizeItem = true;</script>';
      } else {
        setCatSizeinGET($catsize_enabled);
      }

    } else {
      // only shop page should get this code evaluated
      setCatSizeinGET($catsize_enabled);
    }

    


    if ( !empty( $_GET ) ) {

      global $custom_current;
      
      $custom_current = absint(
        max(
          1,
          get_query_var( 'paged' ) ? get_query_var( 'paged' ) : get_query_var( 'page' )
        )
      );

      $query->set( 'post_type', 'product' );
      $query->set( 'posts_per_page', 12 );
      $query->set( 'paged', $custom_current );

      $tax_query_array = array(
        'relation' => 'AND'
      );

      if ( $is_cat ) {
        $prod_cat = sanitize_text_field($query->query_vars['product_cat']);

        $tax_query_array[] = array(
          'taxonomy' => 'product_cat',
          'field' => 'slug',
          'terms' => $prod_cat
        );
      }

      if (!empty($_GET['minPrice'])) {
        $meta_query_array = array(
          'relation' => 'AND',
        );
      }

      foreach ($_GET as $key => $value) {

        $key = sanitize_text_field($key);
        $value = sanitize_text_field($value);

        $isPrice = in_array($key, array('minPrice', 'maxPrice'));
        $isWooAttr = str_contains($key, 'pa_');

        if ( $isWooAttr ) {
          $key = str_replace('gpa_', 'pa_', $key);
        }

        $multipleValues = explode(',', $value);

        if (count($multipleValues) > 1 && $isWooAttr) {
          /**
           * This code goes for multi-value $_GET parameters
           */
          // If the attribute value is a comma-separated list of values, use the 'IN' comparison operator

          $tax_query_array_multi = array(
            'relation' => 'OR',
          );

          if ( $key === 'pa_razmer' ) {
            $field = 'name';
          } else {
            $field = 'slug';
          }

          $tax_query_array_multi[] = array(
            'taxonomy' => $key,
            'field'    => $field,
            'terms'    => $multipleValues,
            'compare' => 'IN'
          );
          
          $tax_query_array[] = $tax_query_array_multi;
          
        } else {
          /**
           * This code proccesses single-value $_GET parameters
           */
          if ($isWooAttr) {

            if ( $key === 'pa_razmer' ) {
              $field = 'name';
            } else {
              $field = 'slug';
            }

            $tax_query_array[] = array(
              'taxonomy' => $key,
              'field'    => $field,
              'terms'    => $value
            );

          } elseif ($isPrice) {

		if ($key == 'minPrice') {
			$compare = '>=';
		} else {
			$compare = '<=';
		}
	
		$meta_query_array[] = array(
			'key' => '_price',
			'value' => $value,
			'type' => 'numeric',
			'compare' => $compare
		);

          }

        }

      }

      if (isset($_GET['orderby'])) {
        switch ($_GET['orderby']) {
          case 'price':
            $order_args = array(
              'orderby'        => 'meta_value_num',
              'order'          => 'asc',
              'meta_key'       => '_price'
            );
            break;
          case 'price-desc':
            $order_args = array(
              'orderby'        => 'meta_value_num',
              'order'          => 'desc',
              'meta_key'       => '_price'
            );
            break;
          case 'rating':
            $order_args = array(
              'orderby'        => 'meta_value_num',
              'order'          => 'desc',
              'meta_key'       => '_wc_average_rating'
            );
            break;
          case 'popularity':
            $order_args = array(
              'orderby'        => 'meta_value_num',
              'order'          => 'desc',
              'meta_key'       => 'total_sales'
            );
            break;
          case 'date':
            $order_args = array(
              'order'          => 'desc',
            );
            break;
          case 'menu_order':
            $order_args = null;
            break;
        }
      }

      $query->set( 'tax_query', $tax_query_array );

      if (isset($meta_query_array) && count($meta_query_array)) {
        $query->set( 'meta_query', $meta_query_array );
      }

      if ( isset($order_args) ) {

        foreach ($order_args as $order_key => $order_val) {
          $query->set( $order_key, $order_val);
        }

      }

    }

  }
}
add_action( 'pre_get_posts', 'custom_archive_pagination' );

add_action( 'pre_get_posts', 'custom_archive_pagination' );

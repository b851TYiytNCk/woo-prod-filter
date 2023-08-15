<?php
/**
 * Pagination - Show numbered pagination for catalog pages
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/pagination.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.3.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// global $custom_current;
// global $filtered_query;

// if ( !empty($custom_current) ) {
	
// 	$total_f = $filtered_query->max_num_pages;
// 	$current_f = $custom_current;

// }


// $total   = isset( $total_f ) && !empty( $total_f ) ? $total_f : wc_get_loop_prop( 'total_pages' );
// $current = isset( $current_f ) && !empty( $current_f ) ? $current_f : wc_get_loop_prop( 'current_page' );
// $base    = isset( $base ) ? $base : esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) );
// $format  = isset( $format ) ? $format : '';

$total   = wc_get_loop_prop( 'total_pages' );
$current = wc_get_loop_prop( 'current_page' );
$base    = isset( $base ) ? $base : esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) );
$format  = isset( $format ) ? $format : '';

if ( $total <= 1 ) {
	return;
}
?>
<nav class="woocommerce-pagination">
	<?php
	$result = paginate_links(
		apply_filters(
			'woocommerce_pagination_args',
			array( // WPCS: XSS ok.
				'base'      => $base,
				'format'    => $format,
				'add_args'  => false,
				'current'   => max(1, $current),
				'total'     => $total,
				'prev_text' => '&larr;',
				'next_text' => '&rarr;',
				'type'      => 'list',
				'end_size'  => 3,
				'mid_size'  => 3,
			)
		)
	);
	$rest = substr("/" . '\1', 0);    // возвращает "/"
	$result = preg_replace('~/page/1/?([\'"])~', $rest, $result); // убираем /page/1 из пагинации
	echo $result;
	?>
</nav>
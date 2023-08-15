<?php
/**
 * Displayed when no products are found matching the current query
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/no-products-found.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.0.0
 */

defined( 'ABSPATH' ) || exit;

$is_shop = is_shop();
$is_cat = is_product_category();

if ( $is_cat | $is_shop ) {

	$args = array(
		'orderby'   => 'meta_value_num',
		'meta_key'  => '_price',
		'order' 	=> 'asc',
		'posts_per_page' => -1,
		'tax_query' => array(
			'relation' => 'AND'			
		)
	);

	if ( $is_cat ) {

		$cat = get_queried_object()->term_id;

		$args['tax_query'][] = array(
			'taxonomy' => 'product_cat',
			'field'    => 'term_id',	
			'terms'    => $cat,
			'operator' => 'IN',
		);

	}

	global $no_size; // functions.php

	if ( isset($_COOKIE['catsize']) && !$no_size) {

		$sizeRange = explode('-', sanitize_text_field($_COOKIE['catsize']) );

		if ( count($sizeRange) === 2 ) {              

			$maxCookieSize = intval($sizeRange[1]);
			$minCookieSize = intval($sizeRange[0]);

			$cookieSizes = array();

			for ($i = $minCookieSize; $i <= $maxCookieSize; $i++) {
				
				$cookieSizes[] = $i . 'RU';
				$cookieSizes[] = $i . '(обувь)';

			}

			$tax_query_size_array = array(
				'taxonomy' => 'pa_razmer',
				'field'    => 'name',
				'terms'    => $cookieSizes,
				'compare' => 'IN'
			);

			$args['tax_query'][] = $tax_query_size_array;

		}

	}


	$products = wc_get_products( $args );
	
	$price_min = end($products)->get_price();
	$price_max = $products[0]->get_price();	
	
	if ( isset($_GET['minPrice']) ) {
		
		$filter_on = true;

	} else {
		
		$filter_on = false;
		
	}

}

?>

<div class="storefront-sorting">
    <div class="goods__filtering">
        <div class="goods__filtering-row goods__filtering-row--top">
            <div class="filter-show-btn">
                <div class="filter-show-text">Фильтры</div>
            </div>

            <form class="goods__ordering woocommerce-ordering" method="get">
                <div class="goods__ordering-text">
                    <span>Сортировать</span>
                </div>
                <select name="orderby" class="orderby" aria-label="Заказ в магазине">
                    <option value="menu_order" selected="selected">Исходная сортировка</option>
                    <option value="popularity">По популярности</option>
                    <option value="rating">По рейтингу</option>
                    <option value="date">По новизне</option>
                    <option value="price">Цены: по возрастанию</option>
                    <option value="price-desc">Цены: по убыванию</option>
                </select>
                <input type="hidden" name="paged" value="1" />
                <?php wc_query_string_form_fields( null, array( 'orderby', 'submit', 'paged', 'product-page' ) ); ?>
            </form>
        </div>

        <div class="goods__filtering-row filter-row">
            <div class="filter-section-wrap">
                <div class="filter-section">
                    <div class="filter-close">
                        <img src="/wp-content/uploads/2023/02/close.svg" alt="">
                    </div>
                    <div class="goods__filter" data-attr="price">
                        <h4>Цена</h4>
                        <div class="range-price" id="range-price" data-min="<?php echo $price_min; ?>" data-max="<?php echo $price_max; ?>"></div>
                    </div>
                    <?php

                        if ( $is_shop | $is_cat ) {

                            $attributes = array();

                            foreach ( $products as $product ) {

                                $product_attributes = $product->get_attributes();
                                $counted_terms = array(); // Initialize an array to keep track of counted terms for each attribute
                                
                                foreach ( $product_attributes as $attribute ) {

                                    $attr_id = $attribute->get_id();
                                
                                    if ( ! isset( $attributes[ $attr_id ] ) ) {
                                        $attributes[ $attr_id ] = array(
                                            'name'  => $attribute->get_name(),
                                            'label' => wc_attribute_label( $attribute->get_name() ),
                                            'terms' => array(),
                                        );
                                    }


                                    $terms = wp_get_post_terms( $product->get_id(), $attribute->get_name());

                                    if ( $terms ) {

                                        $products_ids = array();
                                        
                                        foreach ( $terms as $term ) {

                                            $term_id = $term->term_id;
                                            $term_slug = $term->slug;
                                            $term_name = $term->name;
                                                
                                            if ( ! isset( $attributes[ $attr_id ]['terms'][ $term_slug ] ) ) {

                                                $attributes[ $attr_id ]['terms'][ $term_slug ] = array(
                                                    'count'   => 0,
                                                    'id'      => $term_id,
                                                    'slug'    => $term_slug,
                                                    'name'    => $term_name,
                                                );

                                            }

                                            $attributes[ $attr_id ]['terms'][ $term_slug ]['count']++;

                                        }

                                    }
                                }

                            }

                            foreach ( $attributes as $attribute ) {


                                $attrs = ['pa_color', 'pa_razmer', 'pa_brand-marks'];

                                $term_taxonomy = $attribute['name'];

                                $label = $attribute['label'];

                                if ( in_array( $term_taxonomy, $attrs) ) {

                                    echo "<div class='goods__filter' data-attr='{$term_taxonomy}'>";
                                    echo '<h4>' . $label . '</h4>';
                                    echo '<ul class="goods__filter-scroll">';


                                    ksort($attribute['terms']);

                                    foreach ( $attribute['terms'] as $term => $term_data) {

                                        $count = $term_data['count'];
                                        $term_id_data = $term_data['id'];
                                        $term_slug_data = $term_data['slug'];
                                        $term_name_data = $term_data['name'];

                                        echo "<li class='filter__item' data-name='";
                                        echo htmlspecialchars($term_name_data, ENT_QUOTES);
                                        echo "' data-count='{$count}' data-id='{$term_id_data}' data-slug='{$term_slug_data}'>";
                                        echo "<div class='filter__item-right'>";
                                        echo "<span class='filter__count marking'></span><a href=''>{$term_name_data}</a>";
                                        echo "</div>";
                                        echo '<span class="filter__count">(' . $count . ')</span>';
                                        echo '</li>';
                            
                                    }

                                    echo '</ul>';
                                    echo '</div>';

                                }
                            }
                        }

                    ?>
                </div>
                <div class="goods__filtering-row goods__filtering-apply">
                    <button class="goods__filtering-apply-btn">Применить</button>
                    <button class="goods__filtering-reset-filter">Сбросить</button>
                </div>
            </div>
        </div>

        <?php if ($filter_on): ?>
            <script>
                if (window.innerWidth > 520) {
                    
                    const filterRow = document.querySelector('.filter-row');
                    
                    filterRow.classList.add('active');
                    filterRow.style.display = 'block';

                }
            </script>
        <?php endif; ?>
    </div>
</div>


<p class="woocommerce-info woocommerce-no-products-found"><?php esc_html_e( 'No products were found matching your selection.', 'woocommerce' ); ?></p>

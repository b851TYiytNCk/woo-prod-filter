<?php

/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action('woocommerce_before_single_product');

if (post_password_required()) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class('product_detail', $product); ?>>
	<h1 class="product__title"><?php the_title(); ?></h1>
	<?php
	/**
	 * Hook: woocommerce_before_single_product_summary.
	 *
	 * @hooked woocommerce_show_product_sale_flash - 10
	 * @hooked woocommerce_show_product_images - 20
	 */
	do_action('woocommerce_before_single_product_summary');
	?>

	<div class="summary entry-summary">
		<?php
		/**
		 * Hook: woocommerce_single_product_summary.
		 *
		 * @hooked woocommerce_template_single_title - 5
		 * @hooked woocommerce_template_single_rating - 10
		 * @hooked woocommerce_template_single_price - 10
		 * @hooked woocommerce_template_single_excerpt - 20
		 * @hooked woocommerce_template_single_add_to_cart - 30
		 * @hooked woocommerce_template_single_meta - 40
		 * @hooked woocommerce_template_single_sharing - 50
		 * @hooked WC_Structured_Data::generate_product_data() - 60
		 */
		do_action('woocommerce_single_product_summary');
		?>
		<div class="in-stock">
		<?php 
			if ( $product->is_in_stock() ) {
				echo '<span>Есть в наличии</span>';
			} else {
				echo '<span>Нет в наличии</span>';
			} 
		?>
			<!-- <span>Доставим завтра</span> -->
		</div>
		<div class="bonus">
			<p class="bonus__text--delivery">Доставка по Москве — от 1190 рублей</p>
			<p class="bonus__text--sklad">Можно забрать со склада завтра</p>
			<p class="bonus__text--payment">Оплата при получении</p>
		</div>
	</div>
	<?php
	the_content();
	?>
	<?php
	if ($product->get_attributes()) {
		echo "<h2>Характеристики:</h2>";
		if (get_field('izobrazhenie')) {
			echo "<img class='attrinutes__img' src=" . get_field('izobrazhenie') . ">";
		}
		echo "<ul class='attributes-list'>";
		if ($product->get_attribute('country')) {
			echo '<li><b>Страна </b>: ' . $product->get_attribute('country') . "</li>";
		}
		if ($product->get_attribute('collection')) {
			echo '<li><b>Коллекция </b>: ' . $product->get_attribute('collection') . "</li>";
		}
		if ($product->get_attribute('cover')) {
			echo '<li><b>Съемный чехол </b>: ' . $product->get_attribute('cover') . "</li>";
		}
		if ($product->get_attribute('cusion-pillows')) {
			echo '<li><b>Подушки декоративные </b>: ' . $product->get_attribute('cusion-pillows') . "</li>";
		}
		if ($product->get_attribute('delivery-option')) {
			echo '<li><b>Вариант доставки </b>: ' . $product->get_attribute('delivery-option') . "</li>";
		}
		if ($product->get_attribute('filling')) {
			echo '<li><b>Наполнение </b>: ' . $product->get_attribute('filling') . "</li>";
		}
		if ($product->get_attribute('frame')) {
			echo '<li><b>Каркас </b>: ' . $product->get_attribute('frame') . "</li>";
		}
		if ($product->get_attribute('legs-material')) {
			echo '<li><b>Материал ножен </b>: ' . $product->get_attribute('legs-material') . "</li>";
		}
		if ($product->get_attribute('linen-box')) {
			echo '<li><b>Бельевой ящик </b>: ' . $product->get_attribute('linen-box') . "</li>";
		}
		echo "</ul>";
		if (get_field('instrukcziya')) {
			echo "<a class='attrinutes__file' href=" . get_field('instrukcziya') . " download>Скачать инструкцию</a>";
		}
	}

	?>
	<?php
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	do_action('woocommerce_after_single_product_summary');
	?>
</div>


<?php if ( isset($_COOKIE['woocommerce_recently_viewed_2']) ): ?>
	<div class="recommend-wrap prod-wrap">
		<div class="recommend-title">
			<h2>Просмотренное</h2>
		</div>
		<div class="recommend-showcase">
			<div class="recommend-showcase__product">
				<?php
					echo do_shortcode( '[recently_viewed_products]' );
				?>
			</div>
		</div>
	</div>
<?php endif; ?>

<?php do_action('woocommerce_after_single_product'); ?>
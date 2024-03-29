<?php

/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it doesvvvvvvvvv
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined('ABSPATH') || exit;

?>
<?php
if (function_exists('yoast_breadcrumb')) {
  yoast_breadcrumb('<p id="breadcrumbs" class="cart_page_breadcrumbs">', '</p>');
}
the_title( '<h1 class="entry-title">', '</h1>' );
?>
<?php do_action('woocommerce_before_cart_table'); ?>
<?php do_action('woocommerce_before_cart_contents'); ?>

<div class="cart_main_wrapp">
<div class="cart_main_wrapp_item_product_wrapp">
  <?php
  foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
    $_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
    $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

    if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
      $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
  ?>
      <tr class="woocommerce-cart-form__cart-item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">

        <div class="cart_main_wrapp_item_product">
          <div class="cart_main_wrapp_item_img">
            <?php
            //Картинка товара
            $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);

            if (!$product_permalink) {
              echo $thumbnail; // PHPCS: XSS ok.
            } else {
              printf('<a href="%s">%s</a>', esc_url($product_permalink), $thumbnail); // PHPCS: XSS ok.
            }
            ?>
          </div>

          <div class="cart_main_wrapp_item_deskription">
            <div class="cart_main_wrapp_item_deskription_text">
              <td class="product-name" data-title="<?php esc_attr_e('Product', 'woocommerce'); ?>">
                <?php
                //Ссылка та товар
                if (!$product_permalink) {
                  echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key) . '&nbsp;');
                } else {
                  echo wp_kses_post(apply_filters('woocommerce_cart_item_name', sprintf('<a href="%s">%s</a>', esc_url($product_permalink), $_product->get_name()), $cart_item, $cart_item_key));
                }

                do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key);



                // Meta data.
                echo wc_get_formatted_cart_item_data($cart_item); // PHPCS: XSS ok.

                // Backorder notification.
                if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) {
                  echo wp_kses_post(apply_filters('woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__('Available on backorder', 'woocommerce') . '</p>', $product_id));
                }
                ?>
              </td>

              <td class="product-price" data-title="<?php //esc_attr_e( 'Price', 'woocommerce' ); 
                                                    ?>">
                <?php
                //Вторая Цена
                // echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key); // PHPCS: XSS ok.
                ?>
                
              </td>

              <td class="product-quantity" data-title="<?php esc_attr_e('Quantity', 'woocommerce'); ?>">
                <?php
                if ($_product->is_sold_individually()) {
                  $min_quantity = 1;
                  $max_quantity = 1;
                } else {
                  $min_quantity = 0;
                  $max_quantity = $_product->get_max_purchase_quantity();
                }


                $product_quantity = woocommerce_quantity_input(
                  array(
                    'input_name'   => "cart[{$cart_item_key}][qty]",
                    'input_value'  => $cart_item['quantity'],
                    'max_value'    => $max_quantity,
                    'min_value'    => $min_quantity,
                    'product_name' => $_product->get_name(),
                  ),
                  $_product,
                  false
                );

                echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item); // PHPCS: XSS ok.
                ?>
              </td>
        
           
            <span class="cart-subtotal__counter">
              <?php 
                  echo "Размер:&nbsp;&nbsp;" . $_product->get_attribute('razmer');
                ?>
            </span> 
                
              <td class="product-subtotal" data-title="<?php esc_attr_e('Subtotal', 'woocommerce'); ?>">
                <?php
                echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); // PHPCS: XSS ok.
                ?>
              </td>
      </tr>
</div>
<?php
      //Кнопка в корзину
      echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        'woocommerce_cart_item_remove_link',
        sprintf(
          '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
          esc_url(wc_get_cart_remove_url($cart_item_key)),
          esc_html__('Remove this item', 'woocommerce'),
          esc_attr($product_id),
          esc_attr($_product->get_sku())
        ),
        $cart_item_key
      );
?>

</div>
</div>
<?php
    }
  }
?>
</div>

<div class="cart_inform-wrapp">
  <div class="cart_inform_item">
    <?php
    /**
     * Cart collaterals hook.
     *
     * @hooked woocommerce_cross_sell_display
     * @hooked woocommerce_cart_totals - 10
     */
    do_action('woocommerce_cart_collaterals');
    ?>
  </div>
</div>


</div><!-- /cart_main_wrapp-->

</div>

<?php do_action('woocommerce_after_cart'); ?>
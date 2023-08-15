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

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>

	<?php
	/**
	 * Hook: woocommerce_before_single_product_summary.
	 *
	 * @hooked woocommerce_show_product_sale_flash - 10
	 * @hooked woocommerce_show_product_images - 20
	 */
	do_action( 'woocommerce_before_single_product_summary' );
	?>
<div class="content-description_images">
  <?php
    $post_thumbnail_id = $product->get_image_id();
    $attachment_ids = $product->get_gallery_image_ids();
    $all_attachment_ids = array_merge(array($post_thumbnail_id), $attachment_ids);
  ?>
  <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiper2">
    <div class="swiper-wrapper">
      <?php foreach ($all_attachment_ids as $attachment_id) { ?>  
        <div class="swiper-slide">
          <a href="<?php echo wp_get_attachment_url($attachment_id); ?>" data-fancybox="gallery">
            <img loading="lazy" src="<?php echo wp_get_attachment_url($attachment_id); ?>" alt="">
          </a>
        </div>
      <?php } ?>
    </div>
  </div>
  <div class="swiper-button-next"></div>
  <div class="swiper-button-prev"></div>
  <div thumbsSlider="" class="swiper mySwiper">
    <div class="swiper-wrapper">
      <?php foreach ($all_attachment_ids as $attachment_id) { ?>
          <div class="swiper-slide">
            <a data-src="<?php echo wp_get_attachment_url($attachment_id); ?>">
              <img loading="lazy" src="<?php echo wp_get_attachment_url($attachment_id); ?>" alt="">
            </a>
          </div>
      <?php } ?>
    </div>
  </div>
</div>
    
  </style>

  <script>
    var swiper = new Swiper(".mySwiper", {
      spaceBetween: 10,
      slidesPerView: 4,
      freeMode: true,
      watchSlidesProgress: true,
    });
    var swiper2 = new Swiper(".mySwiper2", {
      spaceBetween: 10,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      thumbs: {
        swiper: swiper,
      },
    });
  </script>
 
	
	<div class="summary entry-summary product">
		<?php
		/**
		 * Hook: woocommerce_single_product_summary.
		 *
		 * @hooked woocommerce_template_single_title - 5
		 * @hooked woocommerce_template_single_rating - 10
		 * @hooked woocommerce_template_single_price - 10
		 * @hooked woocommerce_template_single_excerpt - 20
		 * @hooked woocommerce_template_single_add_to_cart - 30w
		 * @hooked woocommerce_template_single_meta - 40
		 * @hooked woocommerce_template_single_sharing - 50
		 * @hooked WC_Structured_Data::generate_product_data() - 60
		 */
		do_action( 'woocommerce_single_product_summary' );
		?>

  </div>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
<div class="deskription_product_summary_wrapp">
  <div class="deskription_product_summary_item">
  <div class="deskription_item_tab">
    <div class="tab_wrap_title">
    <div class="item_tab_title active"><p>Описание</p></div>
    <div class="item_tab_title"><p>Состав</p></div>
    <div class="item_tab_title"><p>Уход</p></div>
    <div class="item_tab_title"><p>Размер производителя</p></div>
    </div>
    <div class="item_tab_desk">
      <span class="active">
      <?php echo $product->post->post_content;?>
    </span>
    <span>
    <?php the_field('item_tab_composition');?>
    </span>
    <span>
      <?php the_field('uhod');?>
    </span>
    <span>
      <?php the_field('razmer_proizvoditelya');?>
    </span>
  </div>
  </div>
</div>

  <div class="deskription_product_summary_item inform">
    <div class="item_tab_inform">
      <div class="item_tab_inform_delivery">
      <p>Контракты со службами доставки</p>
      </div>
      <div class="item_tab_inform_trying">
      <p>Сервис «Примерка перед покупкой»</p>
      </div>
    </div>
  </div>
</div>

<div class="maybe_like">
  <p>Outletmax рекомендует</p>
<?php if(!empty(woocommerce_upsell_display())) {woocommerce_upsell_display();} else { echo do_shortcode('[products limit="4" columns="4" rand]'); }?>
</div>


<?php

/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit;

get_header('shop');

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action('woocommerce_before_main_content');

?>
<div class="category-wrap">
  <div class="category-title">
    <header class="woocommerce-products-header">
      <?php if (apply_filters('woocommerce_show_page_title', true)) : ?>
        <h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
      <?php endif; ?>

      <?php
      /**
       * Hook: woocommerce_archive_description.
       *
       * @hooked woocommerce_taxonomy_archive_description - 10
       * @hooked woocommerce_product_archive_description - 10
       */
      //do_action('woocommerce_archive_description');
      ?>
    </header>
  </div>

  <?php 

    $cat = get_queried_object();
    $parent = $cat->parent;

    $shop = is_shop();
    
    if ( is_product_category() && $parent === 0): 
    
    ?>

    <div class="category-board">
      
      <div class="category-board__left__col left">

        <div class="board__left__item_wrap">
          <a>Все товары</a>
          <span>300 шт.</span>
        </div>

      </div>
    
      <?php

        if ( have_rows( 'category', $cat ) ) {

        ?>

        <div class="category-board__right__col right">

          <div class="board__right__item_wrap up">

        <?php
          while ( have_rows( 'category', $cat ) ) {
            
            the_row();

            $index = get_row_index();

            $title = get_sub_field( 'title' );
            $img = get_sub_field( 'img' );
            $color = get_sub_field( 'color' );

            $link = get_term_link( get_sub_field('link'), 'product_cat' );

            $otherStyle = '';

            switch ( $index ) {
              case 1:
                $otherStyle = 'background-position-x:100%; background-position-y:85%;';
                break;
              case 3:
                $otherStyle = 'background-position-x:100%; background-position-y:85%;';
                break;
              case 4:
                $otherStyle = 'width:100%; height:100%; background-position-x:85%; background-position-y:85%;';
                break;
              case 5:
                $otherStyle = 'width:100%; height:100%; background-position-x:85%; background-position-y:85%;';
                break;
            }

            if ( $index == 3 ): ?>

              <div class="board__right__item_wrap bottom">

            <?php endif; ?>

                
                  <a href="<?php echo $link; ?>" style="background: url(<?php echo $img . ');';
                    if ( $color ) { ?>;background-color:<?php echo $color . ';'; } 
                    echo $otherStyle;?>background-repeat: no-repeat;" class="board__right__item">

                    <p><?php echo $title;?></p>
                  </a>

            <?php if ( $index == 2 || $index == 5) {
              echo '</div>';
            }

          }

        }
        
      ?>
      </div>
    </div>

  <?php 

    elseif( !$shop ):

    echo '<style>.woocommerce-container-main{margin-top:0}</style>';  

    elseif ( $shop ): ?>

    <div class="main-categories catalog-cats">
      <?php
        echo do_shortcode('[product_categories ids="18,19,20,21,22,23," orderby="id" columns="3"]');
        echo do_shortcode('[product_categories ids="24,25,26,27" orderby="id" columns="4"]');
      ?>
    </div>
    
  <?php endif; ?>

</div>



<div class="woocommerce-container-main">

  <div class="woocommerce-container-main_product_wrapp">

    <div class="woocommerce-container-main_product_item filter-sidebar">
      
      <div class="filter-wrap-label filter-toggle">Фильтры</div>

      <div class="woocommerce-container-main_product_item filter-wrapper">
        
        <div class="filter-wrap-label inner-filter-label">Фильтры</div>

        <div class="woocommerce-container-main_product_item inner-filter-container">

          <div class="filter-item only-available">
            <span>Только в наличии</span>

            <?php 
              if ( isset( $_GET['onlyav'] ) && $_GET['onlyav'] == true ) {
                $onlyAV = ' active';
              } else {
                $onlyAV = false;
              }
            ?>

            <div class="only-av-toggle<?php echo $onlyAV;?>">
              <div class="only-av-circle"></div>
            </div>
          </div>

        
          <?php
            //Вывод категорий  и фильтра по цвету
            echo do_shortcode('[yith_wcan_filters slug="draft-preset"]');
          ?>

          <div class="price-range-wrap">
            <div class="price-range-label">Цена товара</div>

            <div class="price-range-block">

              <div class="range-labels">
                
                <div class="handle-wrap">
                  <span>От</span>
                  <input type="number" class="lower-handle-value handle-value" value="0">
                </div>

                <div class="handle-wrap">
                  <span>До</span>
                  <input type="number" class="upper-handle-value handle-value" value="100000">
                </div>

              </div>

              <div class="range-price" id="range-price"></div>

            </div>

          </div>

          <div class="filters-accept">Применить</div>
        </div>
      </div>
          
    </div>
    <!--Конец блока woocommerce-container-main_product_item -->

    <div class="woocommerce-container-main_product_item catalog-grid">

      <div class="woocommerce-container-main_sorting">

        <div class="filter-sorting">

          <?php

            $orderby = $_GET['orderby'];

            $price_desc = $orderby === 'price';

          ?>

          <div class="filter-st-label">Сортировать по:</div>
          <div class="filter-st-list">
            <div class="filter-st-item" data-order="price<?php if ($price_desc):?>-desc<?php endif; ?>">Цене</div>
            <div class="filter-st-item" data-order="popularity">Популярности</div>
            <div class="filter-st-item" data-order="date">Новизне</div>
          </div>
        </div>
      
        <div class="main_sorting_block_product">
          <img src="/wp-content/themes/mebel/assets/images/category/products_wrap_active.svg" alt="alt картинки__img">
          <img src="/wp-content/themes/mebel/assets/images/category/products_column.svg" alt="alt картинки__img">
        </div>

        <?php

          if (woocommerce_product_loop()) {

            /**
             * Hook: woocommerce_before_shop_loop.
             *
             * @hooked woocommerce_output_all_notices - 10
             * @hooked woocommerce_result_count - 20
             * @hooked woocommerce_catalog_ordering - 30
             */
            do_action('woocommerce_before_shop_loop');

          } else {
            /**
             * Hook: woocommerce_no_products_found.
             *
             * @hooked wc_no_products_found - 10
             */
            do_action('woocommerce_no_products_found');

          }

        ?>

      </div>

      <?php

        if (woocommerce_product_loop()) {

          /**
           * Hook: woocommerce_before_shop_loop.
           *
           * @hooked woocommerce_output_all_notices - 10
           * @hooked woocommerce_result_count - 20
           * @hooked woocommerce_catalog_ordering - 30
           */
          //do_action('woocommerce_before_shop_loop');

          woocommerce_product_loop_start();



          if (wc_get_loop_prop('total')) {

            global $filtered_query;

            if ( isset( $filtered_query ) && !empty( $filtered_query ) ) {

              while ( $filtered_query->have_posts() ) {

                $filtered_query->the_post();

                /**
                 * Hook: woocommerce_shop_loop.
                 */
                do_action('woocommerce_shop_loop');

                wc_get_template_part('content', 'product');

              }

            } else {

              while ( have_posts() ) {
                
                the_post();
  
                /**
                 * Hook: woocommerce_shop_loop.
                 */
                do_action('woocommerce_shop_loop');
  
                wc_get_template_part('content', 'product');
  
              }

            }
  

          } 

          woocommerce_product_loop_end();

        } else {
          /**
           * Hook: woocommerce_no_products_found.
           *
           * @hooked wc_no_products_found - 10
           */
          do_action('woocommerce_no_products_found');
        }

        do_action('woocommerce_after_shop_loop');

      ?>

    </div>
    <!--Конец блока woocommerce-container-main_product_item -->


  </div>
  <!--Конец блока woocommerce-container-main_product_wrapp -->


  <div class="recommend-wrap prod-wrap">
    <div class="recommend-title">
        <h2>Может заинтересовать</h2>
    </div>
    <div class="recommend-showcase">
        <div class="recommend-showcase__product">
            <?php
                echo do_shortcode('[products limit="4" orderby="rand" columns="4" ]');
            ?>
        </div>
    </div>
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
  <?php endif;

  
  /**
   * Hook: woocommerce_after_main_content.
   *
   * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
   */
  do_action('woocommerce_after_main_content');

  /**
   * Hook: woocommerce_sidebar.
   *
   * @hooked woocommerce_get_sidebar - 10
   */
  do_action('woocommerce_sidebar');
  ?>

</div>
<!--Конец блока woocommerce-container-main -->

<?php
get_footer(); ?>
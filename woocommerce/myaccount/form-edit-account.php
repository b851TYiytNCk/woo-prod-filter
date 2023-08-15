<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;

//do_action( 'woocommerce_before_edit_account_form' ); ?>

<style>
	.woocommerce-MyAccount-navigation {
    	display: none;
	}
</style>

<form class="woocommerce-EditAccountForm edit-account" action="" method="post" <?php do_action( 'woocommerce_edit_account_form_tag' ); ?> >
	<div class="woo-form-fields">
	<?php do_action( 'woocommerce_edit_account_form_start' ); ?>

	<p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
		<label for="account_first_name"><?php esc_html_e( 'First name', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
		<input disabled placeholder="Имя" type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_first_name" id="account_first_name" autocomplete="given-name" value="<?php echo esc_attr( $user->first_name ); ?>" />
	</p>
	<p class="woocommerce-form-row woocommerce-form-row--last form-row">
		<label for="account_last_name"><?php esc_html_e( 'Last name', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
		<input disabled placeholder="Фамилия" type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_last_name" id="account_last_name" autocomplete="family-name" value="<?php echo esc_attr( $user->last_name ); ?>" />
	</p>

	<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide select-row">
		<label for="billing_country"><?php esc_html_e( 'User country', 'woocommerce' ); ?>&nbsp;<span class="required">*</span>
		</label>
		
		<?php $countries = array (
			'Австралия' => 'Австралия',
			'Австрия' => 'Австрия',
			'Азербайджан' => 'Азербайджан',
			'Аландские о-ва' => 'Аландские о-ва',
			'Албания' => 'Албания',
			'Алжир' => 'Алжир',
			'Американское Самоа' => 'Американское Самоа',
			'Ангилья' => 'Ангилья',
			'Ангола' => 'Ангола',
			'Андорра' => 'Андорра',
			'Антарктида' => 'Антарктида',
			'Антигуа и Барбуда' => 'Антигуа и Барбуда',
			'Аргентина' => 'Аргентина',
			'Армения' => 'Армения',
			'Аруба' => 'Аруба',
			'Афганистан' => 'Афганистан',
			'Багамы' => 'Багамы',
			'Бангладеш' => 'Бангладеш',
			'Барбадос' => 'Барбадос',
			'Бахрейн' => 'Бахрейн',
			'Беларусь' => 'Беларусь',
			'Белиз' => 'Белиз',
			'Бельгия' => 'Бельгия',
			'Бенин' => 'Бенин',
			'Бермудские о-ва' => 'Бермудские о-ва',
			'Болгария' => 'Болгария',
			'Боливия' => 'Боливия',
			'Бонэйр, Синт-Эстатиус и Саба' => 'Бонэйр, Синт-Эстатиус и Саба',
			'Босния ' => 'Босния и Герцеговина',
			'Ботсвана' => 'Ботсвана',
			'Бразилия' => 'Бразилия',
			'Британская территория в Индийском океане' => 'Британская территория в Индийском океане',
			'Бруней-Даруссалам' => 'Бруней-Даруссалам',
			'Буркина-Фасо' => 'Буркина-Фасо',
			'Бурунди' => 'Бурунди',
			'Бутан' => 'Бутан',
			'Вануату' => 'Вануату',
			'Ватикан' => 'Ватикан',
			'Великобритания' => 'Великобритания',
			'Венгрия' => 'Венгрия',
			'Венесуэла' => 'Венесуэла',
			'Виргинские о-ва (Великобритания)' => 'Виргинские о-ва (Великобритания)',
			'Виргинские о-ва (США)' => 'Виргинские о-ва (США)',
			'Внешние о-ва (США)' => 'Внешние малые о-ва (США)',
			'Восточный Тимор' => 'Восточный Тимор',
			'Вьетнам' => 'Вьетнам',
			'Габон' => 'Габон',
			'Гаити' => 'Гаити',
			'Гайана' => 'Гайана',
			'Гамбия' => 'Гамбия',
			'Гана' => 'Гана',
			'Гваделупа' => 'Гваделупа',
			'Гватемала' => 'Гватемала',
			'Гвинея' => 'Гвинея',
			'Гвинея-Бисау' => 'Гвинея-Бисау',
			'Германия' => 'Германия',
			'Гернси' => 'Гернси',
			'Гибралтар' => 'Гибралтар',
			'Гондурас' => 'Гондурас',
			'Гонконг (САР)' => 'Гонконг (САР)',
			'Гренада' => 'Гренада',
			'Гренландия' => 'Гренландия',
			'Греция' => 'Греция',
			'Грузия' => 'Грузия',
			'Гуам' => 'Гуам',
			'Дания' => 'Дания',
			'Джерси' => 'Джерси',
			'Джибути' => 'Джибути',
			'Доминика' => 'Доминика',
			'Доминиканская Республика' => 'Доминиканская Республика',
			'Египет' => 'Египет',
			'Замбия' => 'Замбия',
			'Западная Сахара' => 'Западная Сахара',
			'Зимбабве' => 'Зимбабве',
			'Израиль' => 'Израиль',
			'Индия' => 'Индия',
			'Индонезия' => 'Индонезия',
			'Иордания' => 'Иордания',
			'Ирак' => 'Ирак',
			'Иран' => 'Иран',
			'Ирландия' => 'Ирландия',
			'Исландия' => 'Исландия',
			'Испания' => 'Испания',
			'Италия' => 'Италия',
			'Йемен' => 'Йемен',
			'Кабо-Верде' => 'Кабо-Верде',
			'Казахстан' => 'Казахстан',
			'Камбоджа' => 'Камбоджа',
			'Камерун' => 'Камерун',
			'Канада' => 'Канада',
			'Катар' => 'Катар',
			'Кения' => 'Кения',
			'Кипр' => 'Кипр',
			'Киргизия' => 'Киргизия',
			'Кирибати' => 'Кирибати',
			'Китай' => 'Китай',
			'КНДР' => 'КНДР',
			'Кокосовые о-ва' => 'Кокосовые о-ва',
			'Колумбия' => 'Колумбия',
			'Коморы' => 'Коморы',
			'Конго-Браззавиль' => 'Конго-Браззавиль',
			'Конго-Киншаса' => 'Конго-Киншаса',
			'Коста-Рика' => 'Коста-Рика',
			'Кот-д’Ивуар' => 'Кот-д’Ивуар',
			'Куба' => 'Куба',
			'Кувейт' => 'Кувейт',
			'Кюрасао' => 'Кюрасао',
			'Лаос' => 'Лаос',
			'Латвия' => 'Латвия',
			'Лесото' => 'Лесото',
			'Либерия' => 'Либерия',
			'Ливан' => 'Ливан',
			'Ливия' => 'Ливия',
			'Литва' => 'Литва',
			'Лихтенштейн' => 'Лихтенштейн',
			'Люксембург' => 'Люксембург',
			'Маврикий' => 'Маврикий',
			'Мавритания' => 'Мавритания',
			'Мадагаскар' => 'Мадагаскар',
			'Майотта' => 'Майотта',
			'Макао (САР)' => 'Макао (САР)',
			'Малави' => 'Малави',
			'Малайзия' => 'Малайзия',
			'Мали' => 'Мали',
			'Мальдивы' => 'Мальдивы',
			'Мальта' => 'Мальта',
			'Марокко' => 'Марокко',
			'Мартиника' => 'Мартиника',
			'Маршалловы Острова' => 'Маршалловы Острова',
			'Мексика' => 'Мексика',
			'Мозамбик' => 'Мозамбик',
			'Молдова' => 'Молдова',
			'Монако' => 'Монако',
			'Монголия' => 'Монголия',
			'Монтсеррат' => 'Монтсеррат',
			'Мьянма (Бирма)' => 'Мьянма (Бирма)',
			'Намибия' => 'Намибия',
			'Науру' => 'Науру',
			'Непал' => 'Непал',
			'Нигер' => 'Нигер',
			'Нигерия' => 'Нигерия',
			'Нидерланды' => 'Нидерланды',
			'Никарагуа' => 'Никарагуа',
			'Ниуэ' => 'Ниуэ',
			'Новая ' => 'Новая Зеландия',
			'Новая ' => 'Новая Каледония',
			'Норвегия' => 'Норвегия',
			'о-в Буве' => 'о-в Буве',
			'о-в Мэн' => 'о-в Мэн',
			'о-в Норфолк' => 'о-в Норфолк',
			'о-в Рождества' => 'о-в Рождества',
			'о-в Св. Елены' => 'о-в Св. Елены',
			'о-ва Питкэрн' => 'о-ва Питкэрн',
			'о-ва Тёркс и Кайкос' => 'о-ва Тёркс и Кайкос',
			'о-ва Херд и Макдональд' => 'о-ва Херд и Макдональд',
			'ОАЭ' => 'ОАЭ',
			'Оман' => 'Оман',
			'Острова Кайман' => 'Острова Кайман',
			'Острова Кука' => 'Острова Кука',
			'Пакистан' => 'Пакистан',
			'Палау' => 'Палау',
			'Палестинские территории' => 'Палестинские территории',
			'Панама' => 'Панама',
			'Папуа — Новая Гвинея' => 'Папуа — Новая Гвинея',
			'Парагвай' => 'Парагвай',
			'Перу' => 'Перу',
			'Польша' => 'Польша',
			'Португалия' => 'Португалия',
			'Пуэрто-Рико' => 'Пуэрто-Рико',
			'Республика Корея' => 'Республика Корея',
			'Реюньон' => 'Реюньон',
			'Россия' => 'Россия',
			'Руанда' => 'Руанда',
			'Румыния' => 'Румыния',
			'Сальвадор' => 'Сальвадор',
			'Самоа' => 'Самоа',
			'Сан-Марино' => 'Сан-Марино',
			'Сан-Томе и Принсипи' => 'Сан-Томе и Принсипи',
			'Саудовская Аравия' => 'Саудовская Аравия',
			'Северная Македония' => 'Северная Македония',
			'Северные Марианские о-ва' => 'Северные Марианские о-ва',
			'Сейшельские Острова' => 'Сейшельские Острова',
			'Сен-Бартелеми' => 'Сен-Бартелеми',
			'Сен-Мартен' => 'Сен-Мартен',
			'Сен-Пьер и Микелон' => 'Сен-Пьер и Микелон',
			'Сенегал' => 'Сенегал',
			'Сент-Винсент и Гренадины' => 'Сент-Винсент и Гренадины',
			'Сент-Китс и Невис' => 'Сент-Китс и Невис',
			'Сент-Люсия' => 'Сент-Люсия',
			'Сербия' => 'Сербия',
			'Сингапур' => 'Сингапур',
			'Синт-Мартен' => 'Синт-Мартен',
			'Сирия' => 'Сирия',
			'Словакия' => 'Словакия',
			'Словения' => 'Словения',
			'Соединенные ' => 'Соединенные Штаты',
			'Соломоновы ' => 'Соломоновы Острова',
			'Сомали' => 'Сомали',
			'Судан' => 'Судан',
			'Суринам' => 'Суринам',
			'Сьерра-' => 'Сьерра-Леоне',
			'Таджикистан' => 'Таджикистан',
			'Таиланд' => 'Таиланд',
			'Тайвань' => 'Тайвань',
			'Танзания' => 'Танзания',
			'Того' => 'Того',
			'Токелау' => 'Токелау',
			'Тонга' => 'Тонга',
			'Тринидад и Тобаго' => 'Тринидад и Тобаго',
			'Тувалу' => 'Тувалу',
			'Тунис' => 'Тунис',
			'Туркменистан' => 'Туркменистан',
			'Турция' => 'Турция',
			'Уганда' => 'Уганда',
			'Узбекистан' => 'Узбекистан',
			'Украина' => 'Украина',
			'Уоллис и Футуна' => 'Уоллис и Футуна',
			'Уругвай' => 'Уругвай',
			'Фарерские о-ва' => 'Фарерские о-ва',
			'Федеративные Штаты Микронезии' => 'Федеративные Штаты Микронезии',
			'Фиджи' => 'Фиджи',
			'Филиппины' => 'Филиппины',
			'Финляндия' => 'Финляндия',
			'Фолклендские о-ва' => 'Фолклендские о-ва',
			'Франция' => 'Франция',
			'Французская Гвиана' => 'Французская Гвиана',
			'Французская Полинезия' => 'Французская Полинезия',
			'Французские Южные территории' => 'Французские Южные территории',
			'Хорватия' => 'Хорватия',
			'Центрально-Африканская Республика' => 'Центрально-Африканская Республика',
			'Чад' => 'Чад',
			'Черногория' => 'Черногория',
			'Чехия' => 'Чехия',
			'Чили' => 'Чили',
			'Швейцария' => 'Швейцария',
			'Швеция' => 'Швеция',
			'Шпицберген и Ян-Майен' => 'Шпицберген и Ян-Майен',
			'Шри-Ланка' => 'Шри-Ланка',
			'Эквадор' => 'Эквадор',
			'Экваториальная Гвинея' => 'Экваториальная Гвинея',
			'Эритрея' => 'Эритрея',
			'Эсватини' => 'Эсватини',
			'Эстония' => 'Эстония',
			'Эфиопия' => 'Эфиопия',
			'Южная Георгия и Южные Сандвичевы о-ва' => 'Южная Георгия и Южные Сандвичевы о-ва',
			'Южно-Африканская Республика' => 'Южно-Африканская Республика',
			'Южный Судан' => 'Южный Судан',
			'Ямайка' => 'Ямайка',
			'Япония' => 'Япония',
		  );



		?>

		<select disabled class="woocommerce-Input woocommerce-Input--text input-text" name="billing_country" id="billing_country">
		  	<?php
				$i = 1;
				foreach ($countries as $key => $value) {

					if ( esc_attr( $user->billing_country ) == $value) {
						$selected = 'selected="true"';
					} else {
						$selected = '';
					}

					echo '<option ' . $selected . ' value="' . $value . '">' . $value . '</option>';

				}
			?>
		</select>
		<span class="arrow"></span>
	
		<!-- <span><em><?php esc_html_e( 'This will be how your name will be displayed in the account section and in reviews', 'woocommerce' ); ?></em></span> -->


	</p>

	<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label for="billing_city"><?php _e( 'Billing city', 'woocommerce' ); ?></label>
        <input disabled placeholder="Город" type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="billing_city" id="billing_city" value="<?php echo esc_attr( $user->billing_city ); ?>" />
    </p>

	<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
		<label for="billing_postcode"><?php esc_html_e( 'Index', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
		<input disabled placeholder="Индекс" type="text" class="woocommerce-Input input-text" name="billing_postcode" id="billing_postcode" autocomplete="" value="<?php echo esc_attr( $user->billing_postcode ); ?>" />
	</p>

	<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
		<label for="billing_address_1"><?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
		<input disabled placeholder="Адрес" type="text" class="woocommerce-Input input-text" name="billing_address_1" id="billing_address_1" autocomplete="" value="<?php echo esc_attr( $user->billing_address_1 ); ?>" />
	</p>

	<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
		<label for="billing_phone"><?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
		<input disabled placeholder="Телефон" type="text" class="woocommerce-Input input-text" name="billing_phone" id="billing_phone" autocomplete="" value="<?php echo esc_attr( $user->billing_phone ); ?>" />
	</p>

	<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
		<label for="account_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
		<input disabled placeholder="Электронная почта" type="email" class="woocommerce-Input woocommerce-Input--email input-text" name="account_email" id="account_email" autocomplete="email" value="<?php echo esc_attr( $user->user_email ); ?>" />
	</p>

	<!-- <fieldset>
		<legend><?php esc_html_e( 'Password change', 'woocommerce' ); ?></legend>

		<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
			<label for="password_current"><?php esc_html_e( 'Current password (leave blank to leave unchanged)', 'woocommerce' ); ?></label>
			<input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_current" id="password_current" autocomplete="off" />
		</p>
		<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
			<label for="password_1"><?php esc_html_e( 'New password (leave blank to leave unchanged)', 'woocommerce' ); ?></label>
			<input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_1" id="password_1" autocomplete="off" />
		</p>
		<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
			<label for="password_2"><?php esc_html_e( 'Confirm new password', 'woocommerce' ); ?></label>
			<input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_2" id="password_2" autocomplete="off" />
		</p>
	</fieldset> -->

	<?php do_action( 'woocommerce_edit_account_form' ); ?>
	</div>

	<p class="woo-btn-wrap">
		<?php wp_nonce_field( 'save_account_details', 'save-account-details-nonce' ); ?>
		<button type="submit" class="woocommerce-Button button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="save_account_details" value="<?php esc_attr_e( 'Save changes', 'woocommerce' ); ?>">Редактировать профиль</button>
		<input type="hidden" name="action" value="save_account_details" />
	</p>

	<?php do_action( 'woocommerce_edit_account_form_end' ); ?>
</form>

<?php do_action( 'woocommerce_after_edit_account_form' ); ?>
<div class="favourites-wrap category-wrapp shop">
	<div class="favourites-title">Избранное</div>
	<ul class="products columns-3 favourites">

	<?php
		global $wpdb;

		$current_user = wp_get_current_user();
		
		// Get wishlist items for the current user
		$results = $wpdb->get_results(
			$wpdb->prepare(
				"SELECT * FROM {$wpdb->prefix}yith_wcwl WHERE user_id = %d",
				$current_user->ID
			),
			ARRAY_A
		);
		
		// Check if the user has any wishlist items
		if (!empty($results)) {
		
			// Get product IDs from wishlist items
			$product_ids = array();
			foreach ($results as $result) {
				$product_ids[] = $result['prod_id'];
			}
		
			// Query the products
			$args = array(
				'post_type'      => 'product',
				'post_status'    => 'publish',
				'posts_per_page' => -1,
				'post__in'       => $product_ids
			);
			$products_query = new WP_Query($args);
		
			// Loop through the products and display them
			if ($products_query->have_posts()) {
				while ($products_query->have_posts()) {
					$products_query->the_post();
					// Do something with the product post object
					wc_get_template_part('content', 'product');
				}
				wp_reset_postdata();
			}
		}
	?>
	</ul>
	<div class="clear"></div>
	<a href="/wishlist/" class="woocommerce-Button">Перейти в избранное</a>
</div>

<div class="your-orders category-wrapp shop">
	<div class="your-orders-title">Ваши заказы</div>
		<ul class="products columns-3 orders">
			<?php 

				// Get orders by customer
				$argus = array(
					'customer_id' => get_current_user_id(),
				);
				$orders = wc_get_orders( $argus );

				foreach ($orders as $order) {
					$items = $order->get_items();

					foreach ($items as $item_id => $item) {
						
						
						$product_id = $item->get_product_id();
						$args = array(
							'post_type' => 'product',
							'p'         => $product_id
						);
						$products_query = new WP_Query($args);
						while ($products_query->have_posts()) {
							$products_query->the_post();
							// Do something with the product post object
							$template_args = array(
								'order' => $order,
							);
							wc_get_template( 'content-product.php', $template_args );
						}
						wp_reset_postdata();
					}

				}
			?>
		</ul>
		<div class="clear"></div>
		<a href="/my-account/orders/" class="woocommerce-Button">Все заказы</a>
</div>

<div class="pum pum-overlay pum-theme-190 pum-theme-lightbox popmake-overlay click_open pum-active popup-save-acc-overlay">
	<div class="interlayer">
	<div id="popup-save-acc" class="pum-container popmake theme-190 pum-responsive pum-responsive-medium responsive size-medium custom-position">
		<div id="pum_popup_title_204" class="pum-title popmake-title">Редактировать профиль</div>
		<div class="pum-content popmake-content">
			<form class="edit-account" action="" method="post" <?php do_action( 'woocommerce_edit_account_form_tag' ); ?> >
			<div class="woo-form-fields">
			<?php do_action( 'woocommerce_edit_account_form_start' ); ?>

			<p class="wpcf7-form-control-wrap woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
				<label for="account_first_name"><?php esc_html_e( 'First name', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
				<input placeholder="Имя" type="text" class="wpcf7-form-control woocommerce-Input woocommerce-Input--text input-text" name="account_first_name" id="account_first_name" autocomplete="given-name" value="<?php echo esc_attr( $user->first_name ); ?>" />
			</p>
			<p class="wpcf7-form-control-wrap woocommerce-form-row woocommerce-form-row--last form-row">
				<label for="account_last_name"><?php esc_html_e( 'Last name', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
				<input placeholder="Фамилия" type="text" class="wpcf7-form-control woocommerce-Input woocommerce-Input--text input-text" name="account_last_name" id="account_last_name" autocomplete="family-name" value="<?php echo esc_attr( $user->last_name ); ?>" />
			</p>

			<p class="wpcf7-form-control-wrap woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide select-row">
				<label for="billing_country"><?php esc_html_e( 'User country', 'woocommerce' ); ?>&nbsp;<span class="required">*</span>
				</label>
				
				<?php $countries = array (
					'Австралия' => 'Австралия',
					'Австрия' => 'Австрия',
					'Азербайджан' => 'Азербайджан',
					'Аландские о-ва' => 'Аландские о-ва',
					'Албания' => 'Албания',
					'Алжир' => 'Алжир',
					'Американское Самоа' => 'Американское Самоа',
					'Ангилья' => 'Ангилья',
					'Ангола' => 'Ангола',
					'Андорра' => 'Андорра',
					'Антарктида' => 'Антарктида',
					'Антигуа и Барбуда' => 'Антигуа и Барбуда',
					'Аргентина' => 'Аргентина',
					'Армения' => 'Армения',
					'Аруба' => 'Аруба',
					'Афганистан' => 'Афганистан',
					'Багамы' => 'Багамы',
					'Бангладеш' => 'Бангладеш',
					'Барбадос' => 'Барбадос',
					'Бахрейн' => 'Бахрейн',
					'Беларусь' => 'Беларусь',
					'Белиз' => 'Белиз',
					'Бельгия' => 'Бельгия',
					'Бенин' => 'Бенин',
					'Бермудские о-ва' => 'Бермудские о-ва',
					'Болгария' => 'Болгария',
					'Боливия' => 'Боливия',
					'Бонэйр, Синт-Эстатиус и Саба' => 'Бонэйр, Синт-Эстатиус и Саба',
					'Босния ' => 'Босния и Герцеговина',
					'Ботсвана' => 'Ботсвана',
					'Бразилия' => 'Бразилия',
					'Британская территория в Индийском океане' => 'Британская территория в Индийском океане',
					'Бруней-Даруссалам' => 'Бруней-Даруссалам',
					'Буркина-Фасо' => 'Буркина-Фасо',
					'Бурунди' => 'Бурунди',
					'Бутан' => 'Бутан',
					'Вануату' => 'Вануату',
					'Ватикан' => 'Ватикан',
					'Великобритания' => 'Великобритания',
					'Венгрия' => 'Венгрия',
					'Венесуэла' => 'Венесуэла',
					'Виргинские о-ва (Великобритания)' => 'Виргинские о-ва (Великобритания)',
					'Виргинские о-ва (США)' => 'Виргинские о-ва (США)',
					'Внешние о-ва (США)' => 'Внешние малые о-ва (США)',
					'Восточный Тимор' => 'Восточный Тимор',
					'Вьетнам' => 'Вьетнам',
					'Габон' => 'Габон',
					'Гаити' => 'Гаити',
					'Гайана' => 'Гайана',
					'Гамбия' => 'Гамбия',
					'Гана' => 'Гана',
					'Гваделупа' => 'Гваделупа',
					'Гватемала' => 'Гватемала',
					'Гвинея' => 'Гвинея',
					'Гвинея-Бисау' => 'Гвинея-Бисау',
					'Германия' => 'Германия',
					'Гернси' => 'Гернси',
					'Гибралтар' => 'Гибралтар',
					'Гондурас' => 'Гондурас',
					'Гонконг (САР)' => 'Гонконг (САР)',
					'Гренада' => 'Гренада',
					'Гренландия' => 'Гренландия',
					'Греция' => 'Греция',
					'Грузия' => 'Грузия',
					'Гуам' => 'Гуам',
					'Дания' => 'Дания',
					'Джерси' => 'Джерси',
					'Джибути' => 'Джибути',
					'Доминика' => 'Доминика',
					'Доминиканская Республика' => 'Доминиканская Республика',
					'Египет' => 'Египет',
					'Замбия' => 'Замбия',
					'Западная Сахара' => 'Западная Сахара',
					'Зимбабве' => 'Зимбабве',
					'Израиль' => 'Израиль',
					'Индия' => 'Индия',
					'Индонезия' => 'Индонезия',
					'Иордания' => 'Иордания',
					'Ирак' => 'Ирак',
					'Иран' => 'Иран',
					'Ирландия' => 'Ирландия',
					'Исландия' => 'Исландия',
					'Испания' => 'Испания',
					'Италия' => 'Италия',
					'Йемен' => 'Йемен',
					'Кабо-Верде' => 'Кабо-Верде',
					'Казахстан' => 'Казахстан',
					'Камбоджа' => 'Камбоджа',
					'Камерун' => 'Камерун',
					'Канада' => 'Канада',
					'Катар' => 'Катар',
					'Кения' => 'Кения',
					'Кипр' => 'Кипр',
					'Киргизия' => 'Киргизия',
					'Кирибати' => 'Кирибати',
					'Китай' => 'Китай',
					'КНДР' => 'КНДР',
					'Кокосовые о-ва' => 'Кокосовые о-ва',
					'Колумбия' => 'Колумбия',
					'Коморы' => 'Коморы',
					'Конго-Браззавиль' => 'Конго-Браззавиль',
					'Конго-Киншаса' => 'Конго-Киншаса',
					'Коста-Рика' => 'Коста-Рика',
					'Кот-д’Ивуар' => 'Кот-д’Ивуар',
					'Куба' => 'Куба',
					'Кувейт' => 'Кувейт',
					'Кюрасао' => 'Кюрасао',
					'Лаос' => 'Лаос',
					'Латвия' => 'Латвия',
					'Лесото' => 'Лесото',
					'Либерия' => 'Либерия',
					'Ливан' => 'Ливан',
					'Ливия' => 'Ливия',
					'Литва' => 'Литва',
					'Лихтенштейн' => 'Лихтенштейн',
					'Люксембург' => 'Люксембург',
					'Маврикий' => 'Маврикий',
					'Мавритания' => 'Мавритания',
					'Мадагаскар' => 'Мадагаскар',
					'Майотта' => 'Майотта',
					'Макао (САР)' => 'Макао (САР)',
					'Малави' => 'Малави',
					'Малайзия' => 'Малайзия',
					'Мали' => 'Мали',
					'Мальдивы' => 'Мальдивы',
					'Мальта' => 'Мальта',
					'Марокко' => 'Марокко',
					'Мартиника' => 'Мартиника',
					'Маршалловы Острова' => 'Маршалловы Острова',
					'Мексика' => 'Мексика',
					'Мозамбик' => 'Мозамбик',
					'Молдова' => 'Молдова',
					'Монако' => 'Монако',
					'Монголия' => 'Монголия',
					'Монтсеррат' => 'Монтсеррат',
					'Мьянма (Бирма)' => 'Мьянма (Бирма)',
					'Намибия' => 'Намибия',
					'Науру' => 'Науру',
					'Непал' => 'Непал',
					'Нигер' => 'Нигер',
					'Нигерия' => 'Нигерия',
					'Нидерланды' => 'Нидерланды',
					'Никарагуа' => 'Никарагуа',
					'Ниуэ' => 'Ниуэ',
					'Новая ' => 'Новая Зеландия',
					'Новая ' => 'Новая Каледония',
					'Норвегия' => 'Норвегия',
					'о-в Буве' => 'о-в Буве',
					'о-в Мэн' => 'о-в Мэн',
					'о-в Норфолк' => 'о-в Норфолк',
					'о-в Рождества' => 'о-в Рождества',
					'о-в Св. Елены' => 'о-в Св. Елены',
					'о-ва Питкэрн' => 'о-ва Питкэрн',
					'о-ва Тёркс и Кайкос' => 'о-ва Тёркс и Кайкос',
					'о-ва Херд и Макдональд' => 'о-ва Херд и Макдональд',
					'ОАЭ' => 'ОАЭ',
					'Оман' => 'Оман',
					'Острова Кайман' => 'Острова Кайман',
					'Острова Кука' => 'Острова Кука',
					'Пакистан' => 'Пакистан',
					'Палау' => 'Палау',
					'Палестинские территории' => 'Палестинские территории',
					'Панама' => 'Панама',
					'Папуа — Новая Гвинея' => 'Папуа — Новая Гвинея',
					'Парагвай' => 'Парагвай',
					'Перу' => 'Перу',
					'Польша' => 'Польша',
					'Португалия' => 'Португалия',
					'Пуэрто-Рико' => 'Пуэрто-Рико',
					'Республика Корея' => 'Республика Корея',
					'Реюньон' => 'Реюньон',
					'Россия' => 'Россия',
					'Руанда' => 'Руанда',
					'Румыния' => 'Румыния',
					'Сальвадор' => 'Сальвадор',
					'Самоа' => 'Самоа',
					'Сан-Марино' => 'Сан-Марино',
					'Сан-Томе и Принсипи' => 'Сан-Томе и Принсипи',
					'Саудовская Аравия' => 'Саудовская Аравия',
					'Северная Македония' => 'Северная Македония',
					'Северные Марианские о-ва' => 'Северные Марианские о-ва',
					'Сейшельские Острова' => 'Сейшельские Острова',
					'Сен-Бартелеми' => 'Сен-Бартелеми',
					'Сен-Мартен' => 'Сен-Мартен',
					'Сен-Пьер и Микелон' => 'Сен-Пьер и Микелон',
					'Сенегал' => 'Сенегал',
					'Сент-Винсент и Гренадины' => 'Сент-Винсент и Гренадины',
					'Сент-Китс и Невис' => 'Сент-Китс и Невис',
					'Сент-Люсия' => 'Сент-Люсия',
					'Сербия' => 'Сербия',
					'Сингапур' => 'Сингапур',
					'Синт-Мартен' => 'Синт-Мартен',
					'Сирия' => 'Сирия',
					'Словакия' => 'Словакия',
					'Словения' => 'Словения',
					'Соединенные ' => 'Соединенные Штаты',
					'Соломоновы ' => 'Соломоновы Острова',
					'Сомали' => 'Сомали',
					'Судан' => 'Судан',
					'Суринам' => 'Суринам',
					'Сьерра-' => 'Сьерра-Леоне',
					'Таджикистан' => 'Таджикистан',
					'Таиланд' => 'Таиланд',
					'Тайвань' => 'Тайвань',
					'Танзания' => 'Танзания',
					'Того' => 'Того',
					'Токелау' => 'Токелау',
					'Тонга' => 'Тонга',
					'Тринидад и Тобаго' => 'Тринидад и Тобаго',
					'Тувалу' => 'Тувалу',
					'Тунис' => 'Тунис',
					'Туркменистан' => 'Туркменистан',
					'Турция' => 'Турция',
					'Уганда' => 'Уганда',
					'Узбекистан' => 'Узбекистан',
					'Украина' => 'Украина',
					'Уоллис и Футуна' => 'Уоллис и Футуна',
					'Уругвай' => 'Уругвай',
					'Фарерские о-ва' => 'Фарерские о-ва',
					'Федеративные Штаты Микронезии' => 'Федеративные Штаты Микронезии',
					'Фиджи' => 'Фиджи',
					'Филиппины' => 'Филиппины',
					'Финляндия' => 'Финляндия',
					'Фолклендские о-ва' => 'Фолклендские о-ва',
					'Франция' => 'Франция',
					'Французская Гвиана' => 'Французская Гвиана',
					'Французская Полинезия' => 'Французская Полинезия',
					'Французские Южные территории' => 'Французские Южные территории',
					'Хорватия' => 'Хорватия',
					'Центрально-Африканская Республика' => 'Центрально-Африканская Республика',
					'Чад' => 'Чад',
					'Черногория' => 'Черногория',
					'Чехия' => 'Чехия',
					'Чили' => 'Чили',
					'Швейцария' => 'Швейцария',
					'Швеция' => 'Швеция',
					'Шпицберген и Ян-Майен' => 'Шпицберген и Ян-Майен',
					'Шри-Ланка' => 'Шри-Ланка',
					'Эквадор' => 'Эквадор',
					'Экваториальная Гвинея' => 'Экваториальная Гвинея',
					'Эритрея' => 'Эритрея',
					'Эсватини' => 'Эсватини',
					'Эстония' => 'Эстония',
					'Эфиопия' => 'Эфиопия',
					'Южная Георгия и Южные Сандвичевы о-ва' => 'Южная Георгия и Южные Сандвичевы о-ва',
					'Южно-Африканская Республика' => 'Южно-Африканская Республика',
					'Южный Судан' => 'Южный Судан',
					'Ямайка' => 'Ямайка',
					'Япония' => 'Япония',
				);



				?>

				<select class="wpcf7-form-control-wrap woocommerce-Input woocommerce-Input--text input-text wpcf7-form-control" name="billing_country" id="billing_country">
					<?php
						$i = 1;
						foreach ($countries as $key => $value) {

							if ( esc_attr( $user->billing_country ) == $value) {
								$selected = 'selected="true"';
							} else {
								$selected = '';
							}

							echo '<option ' . $selected . ' value="' . $value . '">' . $value . '</option>';

						}
					?>
				</select>
				<span class="arrow"></span>
			
				<!-- <span><em><?php esc_html_e( 'This will be how your name will be displayed in the account section and in reviews', 'woocommerce' ); ?></em></span> -->


			</p>

			<p class="wpcf7-form-control-wrap woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="billing_city"><?php _e( 'Billing city', 'woocommerce' ); ?></label>
				<input placeholder="Город" type="text" class="wpcf7-form-control woocommerce-Input woocommerce-Input--text input-text" name="billing_city" id="billing_city" value="<?php echo esc_attr( $user->billing_city ); ?>" />
			</p>

			<p class="wpcf7-form-control-wrap woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="billing_postcode"><?php esc_html_e( 'Index', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
				<input placeholder="Индекс" type="text" class="wpcf7-form-control woocommerce-Input input-text" name="billing_postcode" id="billing_postcode" autocomplete="" value="<?php echo esc_attr( $user->billing_postcode ); ?>" />
			</p>

			<p class="wpcf7-form-control-wrap woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="billing_address_1"><?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
				<input placeholder="Адрес" type="text" class="wpcf7-form-control woocommerce-Input input-text" name="billing_address_1" id="billing_address_1" autocomplete="" value="<?php echo esc_attr( $user->billing_address_1 ); ?>" />
			</p>

			<p class="wpcf7-form-control-wrap woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="billing_phone"><?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
				<input placeholder="Телефон" type="text" class="wpcf7-form-control woocommerce-Input input-text" name="billing_phone" id="billing_phone" autocomplete="" value="<?php echo esc_attr( $user->billing_phone ); ?>" />
			</p>

			<p class="wpcf7-form-control-wrap woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide last-popup-row">
				<label for="account_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
				<input placeholder="Электронная почта" type="email" class="wpcf7-form-control woocommerce-Input woocommerce-Input--email input-text" name="account_email" id="account_email" autocomplete="email" value="<?php echo esc_attr( $user->user_email ); ?>" />
			</p>

			<!-- <fieldset>
				<legend><?php esc_html_e( 'Password change', 'woocommerce' ); ?></legend>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="password_current"><?php esc_html_e( 'Current password (leave blank to leave unchanged)', 'woocommerce' ); ?></label>
					<input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_current" id="password_current" autocomplete="off" />
				</p>
				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="password_1"><?php esc_html_e( 'New password (leave blank to leave unchanged)', 'woocommerce' ); ?></label>
					<input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_1" id="password_1" autocomplete="off" />
				</p>
				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="password_2"><?php esc_html_e( 'Confirm new password', 'woocommerce' ); ?></label>
					<input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_2" id="password_2" autocomplete="off" />
				</p>
			</fieldset> -->

			<?php do_action( 'woocommerce_edit_account_form' ); ?>
			</div>

			<p class="woo-btn-wrap">
				<?php wp_nonce_field( 'save_account_details', 'save-account-details-nonce' ); ?>
				<button type="submit" class="woocommerce-Button button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="save_account_details" value="<?php esc_attr_e( 'Save changes', 'woocommerce' ); ?>">Сохранить</button>
				<input type="hidden" name="action" value="save_account_details" />
			</p>

			<?php do_action( 'woocommerce_edit_account_form_end' ); ?>
			</form>
		</div>
		<button type="button" class="pum-close popmake-close" aria-label="Закрыть">×</button>
	</div>
	</div>
</div>

<script>
	document.addEventListener('DOMContentLoaded', function() {

		const accBtn = document.querySelector('.woocommerce-EditAccountForm .woocommerce-Button');
		const popupOverlay = document.querySelector('.popup-save-acc-overlay');
		const html = document.querySelector('html');

		const popupClose = document.querySelector('#popup-save-acc .pum-close');

		accBtn.addEventListener('click', function(e){
			e.preventDefault();

			html.classList.add('pum-open', 'pum-open-overlay');

			popupOverlay.style.display = 'block';
		});

		popupClose.addEventListener('click', function(e){

			html.classList.remove('pum-open', 'pum-open-overlay');

			popupOverlay.style.display = 'none';
		});



	});
</script>
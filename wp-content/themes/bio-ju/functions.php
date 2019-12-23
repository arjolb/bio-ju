<?php

function bio_ju_files(){
    wp_enqueue_style('main_styles', get_stylesheet_uri());
    wp_enqueue_style('custom-google-fonts','//fonts.googleapis.com/css?family=Kaushan+Script|Roboto&display=swap');
    wp_enqueue_script('modernizr',get_theme_file_uri('./js/Vendor.js'),NULL,'1.0');
    wp_enqueue_script('app', get_theme_file_uri('/js/NavMenu.js'), NULL, '1.0', true);
    wp_enqueue_script('slider',get_theme_file_uri('/js/slider.js'),NULL,'1.0',true);
    wp_enqueue_script('mobile-menu', get_theme_file_uri('/js/MobileMenu.js'), NULL, '1.0', true);
    wp_enqueue_script('sticky-nav',get_theme_file_uri('/js/StickyNav.js'),NULL,'1.0',true);
    // wp_enqueue_script('shopping-cart',get_theme_file_uri('/js/ShoppingCart.js'),NULL,'1.0',true);
    // wp_enqueue_script('search',get_theme_file_uri('/js/Search.js'),array('jquery'),'1.0',true);
    wp_enqueue_script('google-map', '//maps.googleapis.com/maps/api/js?key=AIzaSyAaj0VNqqjYLvor2JoKYBvTMmH_t_nM610', NULL, '1.0', true);
    wp_enqueue_script('google-map-code', get_theme_file_uri('/js/GoogleMap.js'), 'NULL', '1.0', true);
    wp_enqueue_script('int-tel', get_theme_file_uri('/js/intlTelInput.js'), NULL, '1.0', true);
    wp_enqueue_script( 'int-tel-code', get_theme_file_uri('/js/TelInput.js'), array('jquery'), '1.0' , true );

    wp_localize_script('search','data',array(
        'root_url', get_site_url()
    ));
}

add_action('wp_enqueue_scripts', 'bio_ju_files');


function features(){
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('woocommerce');
}

add_action('after_setup_theme','features');


require get_theme_file_path('/includes/search-route.php');




// Redirect subscriber accounts out of admin and onto homepage
add_action('admin_init', 'redirectSubsToFrontend');

function redirectSubsToFrontend() {
  $ourCurrentUser = wp_get_current_user();

  if (count($ourCurrentUser->roles) == 1 AND $ourCurrentUser->roles[0] == 'subscriber') {
    wp_redirect(site_url('/'));
    exit;
  }
}

add_action('wp_loaded', 'noSubsAdminBar');

function noSubsAdminBar() {
  $ourCurrentUser = wp_get_current_user();

  if (count($ourCurrentUser->roles) == 1 AND $ourCurrentUser->roles[0] == 'subscriber') {
    show_admin_bar(false);
  }
}

// Customize Login Screen
add_filter('login_headerurl', 'ourHeaderUrl');

function ourHeaderUrl() {
  return esc_url(site_url('/'));
}

add_action('login_enqueue_scripts', 'ourLoginCSS');

function ourLoginCSS() {
  wp_enqueue_style('university_main_styles', get_stylesheet_uri());
  wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
}

add_filter('login_headertitle', 'ourLoginTitle');

function ourLoginTitle() {
  return get_bloginfo('name');
}




add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10, 3 );

function remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}


//Google map
add_filter('acf/fields/google_map/api','mapKey');
// 
function mapKey($api){
  $api['key'] = 'AIzaSyAaj0VNqqjYLvor2JoKYBvTMmH_t_nM610';
  return $api;
}











/*    WOOCOMMERCE   */


/* FRONT-PAGE LOOP/CONTENT-PRODUCT */


//Ndryshojme tekstin e butonit shot ne karte
add_filter('woocommerce_product_single_add_to_cart_text', 'woo_custom_cart_button_text');
 
function woo_custom_cart_button_text() {
return __('Shto në shportë', 'woocommerce');
}

add_filter('woocommerce_product_add_to_cart_text', 'woo_custom_cart_button');
 
function woo_custom_cart_button() {
return __('Shto në shportë', 'woocommerce');
}

//Ndryshojme rendin
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 15);




// remove_action('woocommerce_before_shop_loop_item','woocommerce_template_loop_product_link_open',10);


//Shtojme titullin ne front-page/Loop

function woocommerce_template_loop_product_title() {
  echo '<h2 class="produkte-oferte__produkte--title">' . get_the_title() . '</h2>';
}

/*REMOVE old loop-title action             */
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

/* ADD new loop-title action      */
add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );




//Heqim sale_flash from front-end
remove_action('woocommerce_before_shop_loop_item_title','woocommerce_show_product_loop_sale_flash',10);



//Shtojme imazhin ne front-page/loop
function woocommerce_template_loop_product_thumbnail(){
  the_post_thumbnail('full',array('class'=>'produkte-oferte__produkte--image'));
}

remove_action('woocommerce_before_shop_loop_item_title','woocommerce_template_loop_product_thumbnail',10);
add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);




//Shtojme cmimet: regular dhe sale
function woocommerce_template_loop_price(){ 
  global $product;

  $percentDecrease = ((int)$product->get_regular_price() - (int)$product->get_sale_price())/(int)$product->get_regular_price() * 100;


  if ($product->get_sale_price()) { ?>
  <div class="produkte-oferte__produkte--discount-image active">
    <span><?php if($percentDecrease) echo floor($percentDecrease); ?>%</span>
    <img src="<?php echo get_theme_file_uri('/images/discount.png') ?>" alt="Discount" class="produkte-oferte__produkte--discount-image active">
  </div>
        <?php }else{
          ?>
        <img src="<?php echo get_theme_file_uri('/images/discount.png') ?>" alt="Discount" class="produkte-oferte__produkte--discount-image">
        <?php }
        
        ?>
  <div class="produkte-oferte__produkte--priceinfo">
      <?php
        global $product;
        if ($product->get_sale_price()) {
      ?>
      
      <span class="produkte-oferte__produkte--priceinfo-discount-price active"><?php echo $product->get_sale_price(); ?> L</span>
      <span class="produkte-oferte__produkte--priceinfo-price active"><?php echo $product->get_regular_price(); ?> L</span>
    <?php }else{?>
        <span class="produkte-oferte__produkte--priceinfo-price"><?php echo $product->get_regular_price(); ?> L</span>
        <?php
          } ?>
  </div>       
        <?php 
} 

remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_price',10);
add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price');


/**
 * Show cart contents / total Ajax
 */
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );

function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start();

	?>

<a class="cart-customlocation" href="<?php echo wc_get_cart_url(); ?>">
    <div class="primary-nav__navigation2--shoppingcart">
        <div class="primary-nav__navigation2--shoppingcart--count">
            <img src="<?php echo get_theme_file_uri('./icons/header/shopping-cart.svg') ?>" alt="Shopping-Cart">
            <span><h6><?php echo  WC()->cart->get_cart_contents_count(); ?></h6></span>
        </div>

        <div class="primary-nav__navigation2--shoppingcart-text">
            <h5>Shporta</h5>
            <h6><?php echo WC()->cart->get_cart_total(); ?></h6>
        </div>

    </div>
</a>


  <?php
	$fragments['a.cart-customlocation'] = ob_get_clean();
	return $fragments;
}




add_filter( 'woocommerce_loop_add_to_cart_link', 'quantity_inputs_for_loop_ajax_add_to_cart', 10, 2 );
function quantity_inputs_for_loop_ajax_add_to_cart( $html, $product ) {
    if ( $product && $product->is_type( 'simple' ) && $product->is_purchasable() && $product->is_in_stock() && ! $product->is_sold_individually() ) {
        // Get the necessary classes
        $class = implode( ' ', array_filter( array(
            'button',
            'product_type_' . $product->get_type(),
            $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
            $product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
        ) ) );

        // Adding embeding <form> tag and the quantity field
        $html = sprintf( '%s%s<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s cart-front-page-btn">%s</a>%s',
            '<form class="cart cart-front-page">',
            woocommerce_quantity_input( array(), $product, false ),
            esc_url( $product->add_to_cart_url() ),
            esc_attr( isset( $quantity ) ? $quantity : 1 ),
            esc_attr( $product->get_id() ),
            esc_attr( $product->get_sku() ),
            esc_attr( isset( $class ) ? $class : 'button' ),
            esc_html( $product->add_to_cart_text() ),
            '</form>'
        );
    }
    return $html;
}

add_action( 'wp_footer' , 'archives_quantity_fields_script' );
function archives_quantity_fields_script(){ ?>
    <script type='text/javascript'>
        
        jQuery(function($){
            // Update quantity
            $(".add_to_cart_button.product_type_simple").on('click input', function() {
                $(this).data('quantity', $(this).parent().find('input.qty').val() ); 
            });        

            // On "adding_to_cart" delegated event, removes others "view cart" buttons 
            $(document.body).on("adding_to_cart", function() {
                $(".added_to_cart").remove();
            });
        });
    </script>
    <?php //endif;
}







/*END LOOP FRONT PAGE/CONTENT-PRODUCT */





















/*   SINGLE PRODUCT PAGE   */

function woocommerce_template_single_price(){
  global $product;

  if ($product->get_sale_price()) {
    echo '<h2 class="woocommerce-single-product--summary__price">' 
    . '<span>' . $product->get_regular_price() . '</span>' . '<span>' . $product->get_sale_price()
    . '</span></h2>';
  } else {
    echo '<h2 class="woocommerce-single-product--summary__price">' . $product->get_regular_price() . '</h2>';
  }
  
}

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 15);






// function short_description(){
//   global $product;
//   echo '<p class="woocommerce-single-product--summary__short-description">' . $product->get_short_description() .'</p>';
// }

// add_action('woocommerce_single_product_summary', 'short_description', 60);


/*  HEQIM META.PHP/ACTION:woocommerce_template_single_meta, PERGJEGJES PER KATEGORITE DHE SKU  */
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);


function my_wc_hide_in_stock_message( $html, $product ) {
	if ( $product->is_in_stock() ) {
		return '<p class="woocommerce-single-product--summary__disponueshem">&#10004; I disponueshem</p>';
	}

	return $html;
}

add_filter( 'woocommerce_get_stock_html', 'my_wc_hide_in_stock_message', 10, 2 );













//Heqim form kupon ne checkout
remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10);



/*  Ndryshojme label dhe placeholder-in ne billing  */
add_filter('woocommerce_checkout_fields','custom_checkout_fields');

function custom_checkout_fields($fields){
  unset($fields['billing']['billing_phone']);
  unset($fields['billing']['billing_company']);
  unset($fields['billing']['billing_address_2']);

  $fields['billing']['billing_first_name']=array(
    'label' => 'Emri',
    'required' => true
  );

  $fields['billing']['billing_last_name']=array(
    'label' => 'Mbiemri',
    'required' => true
  );

  $fields['billing']['billing_email']=array(
    'label' => 'Emaili juaj',
    'required' => true,
  );

  return $fields;
}

// Hook in
add_filter( 'woocommerce_default_address_fields' , 'custom_override_default_address_fields' );

// Our hooked in function - $address_fields is passed via the filter!
function custom_override_default_address_fields( $address_fields ) {
     $address_fields['address_1']['label'] = 'Adresa';
     $address_fields['address_1']['placeholder']='Emri i rruges dhe numri i shtepise';

    $address_fields['city']=array(
      'label' => 'Qyteti',
      'required' => true
    );

    $address_fields['state']=array(
      'label' => 'Shteti',
      'required' => true
    );

     return $address_fields;
}





//heqim sorting dhe totalin e produkteve ne archive page
// remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
// remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10);




function woocommerce_output_content_wrapper(){
  echo '<div class="wrapper">';
}

function woocommerce_output_content_wrapper_end(){
  echo '</div>';
}




// Change "Default Sorting" to "Our sorting" on shop page and in WC Product Settings
function defaultSorting( $catalog_orderby ) {
  $catalog_orderby = str_replace("Default sorting", "Renditja e parazgjedhur", $catalog_orderby);
  $catalog_orderby = str_replace("Sort by popularity", "Renditja nga popullariteti", $catalog_orderby);
  $catalog_orderby = str_replace("Sort by latest", "Renditja me më të fundit", $catalog_orderby);
  $catalog_orderby = str_replace("Sort by price: low to high", "Renditja nga cmimi me i ulët në më të lartë", $catalog_orderby);
  $catalog_orderby = str_replace("Sort by price: high to low", "Renditja nga cmimi me i lartë në më të ulët", $catalog_orderby);


  return $catalog_orderby;
}
add_filter( 'woocommerce_catalog_orderby', 'defaultSorting' );
add_filter( 'woocommerce_default_catalog_orderby_options', 'defaultSorting' );

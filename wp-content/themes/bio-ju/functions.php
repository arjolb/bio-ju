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
    wp_enqueue_script('search',get_theme_file_uri('/js/Search.js'),array('jquery'),'1.0',true);
    wp_enqueue_script('google-map', '//maps.googleapis.com/maps/api/js?key=AIzaSyAaj0VNqqjYLvor2JoKYBvTMmH_t_nM610', NULL, '1.0', true);
    wp_enqueue_script('google-map-code', get_theme_file_uri('/js/GoogleMap.js'), 'NULL', '1.0', true);

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





add_filter('woocommerce_product_single_add_to_cart_text', 'woo_custom_cart_button_text');
 
function woo_custom_cart_button_text() {
return __('Shto në shportë', 'woocommerce');
}

add_filter('woocommerce_product_add_to_cart_text', 'woo_custom_cart_button');
 
function woo_custom_cart_button() {
return __('Shto në shportë', 'woocommerce');
}



















/**
 * Opening div for our content wrapper
 */
add_action('woocommerce_before_main_content', 'iconic_open_div', 5);
 
function iconic_open_div() {
    echo '<div class="iconic-div">';
}
 
/**
 * Closing div for our content wrapper
 */
add_action('woocommerce_after_main_content', 'iconic_close_div', 50);
 
function iconic_close_div() {
    echo '</div>';
}

/**
 * Add coming soon text after a product title
 */
// add_action('woocommerce_shop_loop_item_title', 'iconic_after_title', 15);

// function iconic_after_title() {
//     echo 'Coming Soon';
// }





/**
 * Remove breadcrumbs
 */
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);


//Remove sidebar
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);




remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 15);














remove_action('woocommerce_before_shop_loop_item','woocommerce_template_loop_product_link_open',10);




//Remove sale_flash from front-end
remove_action('woocommerce_before_shop_loop_item_title','woocommerce_show_product_loop_sale_flash',10);







//Shtojme titullin ne front-page/Loop

/* CREATE the new function*/
function woocommerce_template_loop_product_title() {
  echo '<h2 class="produkte-oferte__produkte--title">' . get_the_title() . '</h2>';
}

/*REMOVE old loop-title action             */
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

/* ADD new loop-title action      */
add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );




//Shtojme imazhin ne front-page/loop
function woocommerce_template_loop_product_thumbnail(){
  the_post_thumbnail('full',array('class'=>'produkte-oferte__produkte--image'));
}

remove_action('woocommerce_before_shop_loop_item_title','woocommerce_template_loop_product_thumbnail',10);
add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);




//Shtojme cmimet: regular dhe sale
function woocommerce_template_loop_price(){
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
?>


<?php
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);




//Heqim mesazhin View Cart
// add_filter( 'wc_add_to_cart_message_html', '__return_null' );






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
            <h6><?php echo WC()->cart->get_cart_total(); ?> Lek</h6>
        </div>

    </div>
</a>


  <?php
	$fragments['a.cart-customlocation'] = ob_get_clean();
	return $fragments;
}



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




//Google map
add_filter('acf/fields/google_map/api','mapKey');
// 
function mapKey($api){
  $api['key'] = 'AIzaSyAaj0VNqqjYLvor2JoKYBvTMmH_t_nM610';
  return $api;
}










// function add_async_attribute($tag, $handle) {
  // if ( 'my-js-handle' !== $handle )
      // return $tag;
  // return str_replace( ' src', ' async="async" src', $tag );
// }
// 
// add_filter('script_loader_tag', 'add_async_attribute', 10, 2);
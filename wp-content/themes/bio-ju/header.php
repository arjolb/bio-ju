<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php wp_head(); ?>
</head>
<body>
    <header class="site-header">
        <img src="<?php echo get_theme_file_uri('/images/logo.png') ?>" alt="Logo" class="site-header__logo">
        <div class="primary-nav__navigation2--shoppingcart primary-nav__navigation2--shoppingcart__mobile">
            <div class="primary-nav__navigation2--shoppingcart--count">
                <img src="<?php echo get_theme_file_uri('./icons/header/shopping-cart.svg') ?>" alt="Shopping-Cart">
                <span><h6><?php echo  WC()->cart->get_cart_contents_count(); ?></h6></span>
            </div>

            <div class="primary-nav__navigation2--shoppingcart-text">
                <h5>Shporta</h5>
                <h6><?php echo WC()->cart->get_cart_total(); ?></h6>
            </div>

        </div>
        <div class="site-header__menu-icon">
            <div class="site-header__menu-icon--middle"></div>
        </div>
    </header><!-- </header> -->


    <div class="navs-container">
        <nav class="top-nav">
            <div class="wrapper">
                <ul class="top-nav__info">
                    <li>
                        <img class="top-nav__info--icon" src="<?php echo get_theme_file_uri('./icons/header/support.svg') ?>" alt="Support">
                        <span class="top-nav__info--text">Sherbimi ndaj klientit</span>
                    </li>
                    <li>
                        <img class="top-nav__info--icon" src="<?php echo get_theme_file_uri('./icons/header/heart.svg') ?>" alt="Support">
                        <span class="top-nav__info--text">Për më vonë</span>
                    </li>
                </ul><!-- /info -->

                <ul class="top-nav__social">
                    <li><img src="<?php echo get_theme_file_uri('./icons/header/instagram.svg') ?>" alt="Instagram"></li>
                    <li><img src="<?php echo get_theme_file_uri('./icons/header/facebook.svg') ?>" alt="Facebook"></li>
                    <li><img src="<?php echo get_theme_file_uri('./icons/header/youtube.svg') ?>" alt="Youtube"></li>
                    <li>
                        <img class="top-nav__info--icon" src="<?php echo get_theme_file_uri('./icons/header/user.svg') ?>" alt="Support">
                        <span class="top-nav__info--text">
                        <?php if(is_user_logged_in()) { ?>
                            <a href="<?php echo wp_logout_url();  ?>" >
                            <span>Dil</span>
                            </a>
                            <?php } else { ?>
                              <a href="<?php echo site_url('/my-account'); ?>">Hyr ose Regjistrohu</a>
                             <?php } ?>
                        </span>
                    </li>
                </ul><!-- /social -->
            </div><!-- /container -->
        </nav><!-- /top-nav -->


       <div class="primary-nav--container"> 
        <nav class="primary-nav">
            <div class="wrapper">
                <ul class="primary-nav__navigation">
                    <li>
                        <div class="primary-nav__navigation--logo">
                            <img src="<?php echo get_theme_file_uri('./images/logo.png') ?>" alt="Logo">
                        </div>
                    </li>
                    <li>
                        <div class="primary-nav__navigation--btn">
                            <div class="primary-nav__navigation--btn-bars">
                                <span class="primary-nav__navigation--btn-bars-1"></span>
                                <span class="primary-nav__navigation--btn-bars-2"></span>
                                <span class="primary-nav__navigation--btn-bars-3"></span>
                            </div>
                            <h3 class="primary-nav__navigation--btn-text">produktet</h3>

                            <div class="primary-nav__navigation--menu">
                                <div class="row">                                
                                   <div class="col col-md-8">
                                        <div class="row">
                                            <?php
                                               $args = array(
                                                   'number'     => $number,
                                                   'orderby'    => 'title',
                                                   'order'      => 'ASC',
                                                   'hide_empty' => $hide_empty,
                                                   'include'    => $ids
                                               );
                                               $product_categories = get_terms( 'product_cat', $args );
                                               $count = count($product_categories);
                                               $args = array(
                                                'posts_per_page' => -1,
                                                'tax_query' => array(
                                                    'relation' => 'AND',
                                                    array(
                                                        'taxonomy' => 'product_cat',
                                                        'field' => 'slug',
                                                        // 'terms' => 'white-wines'
                                                        'terms' => $product_category->slug
                                                        )
                                                    ),
                                                );

                                            if ( $count > 0 ){ 
                                                foreach ( $product_categories as $product_category ) {
                                                    echo '<h1><a href="' . get_term_link( $product_category ) . '">' . $product_category->name . '</a></h1>';
                                               
                                                }  } 
                                            ?>
                                        </div>
                                   </div>
                                   
                                   <div class="col col-md-4">
                                        &nbsp;
                                   </div> 
                                    
                                </div>


                                <!--Galeri-->                                

                                <div class="gallery">
                                    <div class="row">
                                    <?php
                                    $galeri = new WP_Query(array(
                                        'posts_per_page' => 3,
                                        'post_type' => 'receta'
                                    ));

                                    while ($galeri->have_posts()) {
                                        $galeri->the_post();
                                        ?>

                                        <div class="col col-m-small-screen col-sm-4">
                                            <?php 
                                                echo '<a href='.get_the_permalink().'>' .get_the_post_thumbnail() .'</a>';
                                            ?>
                                        </div>

                                    <?php } wp_reset_postdata();?>
                                        
                                    </div>
                                </div><!-- /gallery -->

                            </div>
                        </div>
                    </li>
                    <li>
                        <ul class="primary-nav__navigation--links">
                            <li><a href="<?php echo site_url('/home') ?>"class=" <?php if(is_page('home')) echo "active"; ?> ">Home</a></li>
                            <li><a href="<?php echo site_url('/rreth-nesh') ?>" class="<?php if(is_page('rreth-nesh')) echo "active"; ?>">Rreth Nesh</a></li>
                            <li><a href="<?php echo get_post_type_archive_link('receta'); ?>" class="<?php if(get_post_type() == 'receta') echo 'active'; ?>">Receta</a></li>
                            <!-- <li><a href="#">Karriera</a></li> -->
                            <li><a href="<?php echo site_url('/shop') ?>" class="<?php if(is_shop() || is_product_category() || is_product()) echo "active"; ?>">Produkte</a></li>
                            <li><a href="<?php echo site_url('/kontakt') ?>" class="<?php if(is_page('kontakt')) echo "active"; ?>">Kontakt</a></li>
                        </ul>
                    </li>
                </ul><!-- /navigation links -->

                <ul class="primary-nav__navigation2">
                    <li>
                        <!-- <div class="primary-nav__navigation2--search">
                            <input type="text" placeholder="Kerkoni" id="search-field">
                            <span class="primary-nav__navigation2--search-img">
                                <img src="<?php
                                //  echo get_theme_file_uri('./icons/header/a.svg') 
                                 ?>" alt="Search">
                            </span>
                            <div id="search-results" class="search-results"></div>
                        </div> -->
                        <?php get_product_search_form(); ?>
                    </li><!-- /Search -->
                    <li class="primary-nav__navigation2--shoppingcart--hover">
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

                        <!-- CART CONTENT -->
                        <!-- <table id="cart-content"> -->
                            <!-- <thead> -->
                                <!-- <tr> -->
                                    <!-- <th>Imazhi</th> -->
                                    <!-- <th>Emri</th> -->
                                    <!-- <th>Cmimi</th> -->
                                    <!-- <th></th> -->
                                <!-- </tr> -->
                            <!-- </thead> -->
                            <!-- <tbody></tbody> -->
                        <!-- </table> -->
                        <!-- /CART CONTENT -->

                    </li>
                </ul>
            </div>
        </nav>
       </div>      
    </div>
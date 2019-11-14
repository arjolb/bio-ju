<?php get_header(); ?>
    


<div class="wrapper">


<div class="hero">
    <div class="hero__container">
        <div class="hero__slider hero__slider-1 active">
            <h1 class="hero__slider--header">Bio Ju <span>Bio për të gjithë</span></h1>
            <p class="hero__slider--description">
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
            </p>
            <button class="hero__slider--btn">zbulo ofertat</button>
        </div><!-- /slider-1 -->

        <div class="hero__slider hero__slider-2">
            <h1 class="hero__slider--header">Lorem ipsum <span>dolor sit amet</span></h1>
            <p class="hero__slider--description">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada ligula velit, sed consequat libero posuere ac. Mauris sed lobortis tellus. In id dui porta, convallis dolor eget, ultricies ligula.
            </p>
            <button class="hero__slider--btn">recetat tona</button>
            
        </div><!-- /slider-2 -->

        <div class="hero__slider hero__slider-3">
            <h1 class="hero__slider--header">Etiam mauris lacus <span>bibendum id dolor</span></h1>
            <p class="hero__slider--description">
            Mauris ut gravida ex, vitae tincidunt mi. Maecenas suscipit diam ut egestas rhoncus. Praesent vitae leo et augue tristique vehicula vel sit amet risus.
            </p>
            <button class="hero__slider--btn">galeria jonë</button>
        </div><!-- /slider-3 -->
        <div class="hero__slider--dots">
            <span class="hero__slider--dots-1 active"><span class="hero__slider--dots-active"></span></span>
            <span class="hero__slider--dots-2"></span>
            <span class="hero__slider--dots-3"></span>
        </div>
        
    </div><!-- /container -->
    
</div><!-- /hero -->




<div class="info">
    <!-- <div class="row info__items"> -->
        <div>
            <img src="<?php echo get_theme_file_uri('./icons/info/desk-magazine.svg'); ?>">
            <h1 class="info__items--text">ofertat <span>e fundit</span></h1>
        </div>
        <div>
            <img src="<?php echo get_theme_file_uri('./icons/info/trattore.svg') ?>">
            <h1 class="info__items--text">produkte <span>fshati</span></h1>
        </div>
        <div>
            <img src="<?php echo get_theme_file_uri('./icons/info/artizanale.svg') ?>">
            <h1 class="info__items--text">produkte <span>artizanale</span></h1>
        </div>
        <div>
            <img src="<?php echo get_theme_file_uri('./icons/info/desk-event.svg') ?>">
            <h1 class="info__items--text">linja <span>eskluzive</span></h1>
        </div>
        <div>
            <img src="<?php echo get_theme_file_uri('./icons/info/vegetable.svg') ?>">
            <h1 class="info__items--text">perime <span>të freskëta</span></h1>
        </div>
    <!-- </div> -->
</div><!-- /info -->




<!--Galeri-->                                
<div class="gallery">
    <div class="row row-m">
    <?php
    $galeri = new WP_Query(array(
        'posts_per_page' => -1,
        'post_type' => 'galeri'
    ));

    while ($galeri->have_posts()) {
        $galeri->the_post();
        ?>

        <div class="col col-m-small-screen col-md-4">
            <?php 
                the_post_thumbnail();
            ?>
        </div>

    <?php } wp_reset_postdata();?>
        
    </div>
</div><!-- /gallery -->





<!-- PRODUKTE NË OFERTË  -->
<div class="produkte-oferte">
    <h1 class="produkte-oferte__header">produkte në ofertë</h1>
    <div class="produkte-oferte__produkte">
        <div class="produkte-oferte__produkte--container">
            <?php
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 4,
                    'meta_key' => '_sale_price',
                    'meta_value' => '0',
                    'meta_compare' => '>='
                );

                $loopProducts = new WP_Query($args);
                if ($loopProducts->have_posts()) {
                    while ($loopProducts->have_posts()) {
                        $loopProducts->the_post();
            ?>

            <div class=" produkte-oferte__produkte-col">
                <?php
                wc_get_template_part('content','product');
                ?>
            </div>     
            <?php }}wp_reset_postdata();?>
        </div>
    </div>
</div>
<!-- /PRODUKTE NË OFERTË -->






<!-- PRODUKTE TË ZGJEDHURA  -->

<!-- GRUPI I PARË I PRODUKTEVE -->
<div class="produkte-oferte produkte-oferte__zgjedhur">
    <h1 class="produkte-oferte__header">produkte të zgjedhura</h1>
    <div class="produkte-oferte__produkte">
        <div class="produkte-oferte__produkte__zgjedhur--container">
            <?php
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 4,
                    // 'meta_key' => '_sale_price',
                    // 'meta_value' => '0',
                    // 'meta_compare' => '>='
                );

                $produktePerjashtuara = array();

                $loopProducts = new WP_Query($args);
                if ($loopProducts->have_posts()) {
                    while ($loopProducts->have_posts()) {
                        $loopProducts->the_post();
                        $produktePerjashtuara[] = get_the_ID();
            ?>

            <div class="produkte-oferte__produkte__zgjedhur-col">
                <?php
                wc_get_template_part('content','product');
                ?>
            </div>     
            <?php }}wp_reset_postdata();?>
        </div>
<!-- /GRUPI I PARË I PRODUKTEVE -->

<!-- GRUPI I DYTË I PRODUKTEVE -->
        <div class="produkte-oferte__produkte__zgjedhur--container">
            <?php
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 4,
                    'post__not_in' => $produktePerjashtuara
                    // 'meta_key' => '_sale_price',
                    // 'meta_value' => '0',
                    // 'meta_compare' => '>='
                );


                $loopProducts = new WP_Query($args);
                if ($loopProducts->have_posts()) {
                    while ($loopProducts->have_posts()) {
                        $loopProducts->the_post();
            ?>

            <div class="produkte-oferte__produkte__zgjedhur-col">
                <?php
                wc_get_template_part('content','product');
                ?>
            </div>     
            <?php }}wp_reset_postdata();?>
        </div><!-- /GRUPI I DYTË I PRODUKTEVE -->

    </div>
</div>
<!-- PRODUKTE TË ZGJEDHURA -->

</div><!-- /wrapper -->


<div class="recetat recetat-front-page">
    <div class="wrapper">
        <div class="row">
            <div class="col col-md-4">
                <section class="recetat__description">
                    <h1 class="recetat-front-page--description--title">recetat</h1>
                    <p class="recetat-front-page--description--content">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
                    </p>
                    <button class="recetat-front-page--description--btn">
                        Zbulo më shumë
                    </button>
                </section>
            </div>

            <div class="col col-md-8">
                <div class="row">
                    <div class="col col-md-3">
                        <section class="recetat__photos">
                            <div class="recetat__photos--img">
                                <img src="<?php echo get_theme_file_uri('./images/gallery/gallery-1.png') ?>" alt="Receta">
                            </div>
                            <h1 class="recetat__photos--title">Lorem Ipsum</h1>
                            <span class="recetat__photos--description">Lorem Ipsum is simply dummy text of the printing.</span>
                        </section>
                    </div>

                    <div class="col col-md-3">
                        <section class="recetat__photos">
                            <div class="recetat__photos--img">
                                <img src="<?php echo get_theme_file_uri('./images/gallery/gallery-1.png') ?>" alt="Receta">
                            </div>
                            <h1 class="recetat__photos--title">Lorem Ipsum</h1>
                            <span class="recetat__photos--description">Lorem Ipsum is simply dummy text of the printing.</span>
                        </section>
                    </div>

                    <div class="col col-md-3">
                        <section class="recetat__photos">
                            <div class="recetat__photos--img">
                                <img src="<?php echo get_theme_file_uri('./images/gallery/gallery-1.png') ?>" alt="Receta">
                            </div>
                            <h1 class="recetat__photos--title">Lorem Ipsum</h1>
                            <span class="recetat__photos--description">Lorem Ipsum is simply dummy text of the printing.</span>
                        </section>
                    </div>

                    <div class="col col-md-3">
                        <section class="recetat__photos">
                            <div class="recetat__photos--img">
                                <img src="<?php echo get_theme_file_uri('./images/gallery/gallery-1.png') ?>" alt="Receta">
                            </div>
                            <h1 class="recetat__photos--title">Lorem Ipsum</h1>
                            <span class="recetat__photos--description">Lorem Ipsum is simply dummy text of the printing.</span>
                        </section>
                    </div>

                </div>
            </div>
        </div>
    </div><!-- /wrapper -->
</div><!-- /recetat -->





<?php get_footer(); ?>


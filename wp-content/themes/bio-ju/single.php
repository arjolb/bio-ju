<?php get_header(); ?>


<div class="wrapper">

<?php

    $productResult = new WP_Query(array(
        'post_type' => 'product'
    ));
    
    // echo '<pre>';
    // print_r($productResult);
    // echo '</pre>';

    while (have_posts()) {
        the_post();
        the_content();
    }

?>
</div>

<?php get_footer(); ?>
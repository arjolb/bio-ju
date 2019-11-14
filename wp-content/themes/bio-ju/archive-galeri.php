<?php  get_header();  ?>


<div class="wrapper">
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
</div>


<?php  get_footer();  ?>
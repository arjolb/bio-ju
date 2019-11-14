<?php get_header(); ?>

<div class="wrapper">
    <?php
        while (have_posts()) {
            the_post();
    ?>
    <h1 class="recetat--header"><?php the_title(); ?></h1>
    <?php }?>

    <div class="recetat recetat-pb">
        <?php the_post_thumbnail('full',array('class'=>'recetat--content--img__single')); ?>
        <div class="recetat--content--description__single"><?php the_content(); ?></div>
    </div>

</div>

<?php get_footer(); ?>
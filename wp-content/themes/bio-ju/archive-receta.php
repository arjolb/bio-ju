<?php  get_header();  ?>

<div class="wrapper">
    <h1 class="recetat--header">Receta</h1>

    <div class="recetat">
        <?php
        if (have_posts()) {
            while (have_posts()) {
                the_post();
        ?>
        <div class="recetat--content">
            <?php the_post_thumbnail('full',array('class'=>'recetat--content--img')); ?>
            <h1 class="recetat--content--title"><?php the_title(); ?></h1>
            <div class="recetat--content--description"><?php echo wp_trim_words(get_the_content(), 40) ?></div>
            <a href="<?php the_permalink(); ?>" class="recetat--content--permalink">Lexo më shumë</a>
        </div>
        <?php
        }
        }
        ?>
    </div>
    <div class="recetat--links">
    <?php echo paginate_links(); ?>
    </div>
</div>

<?php  get_footer();  ?>
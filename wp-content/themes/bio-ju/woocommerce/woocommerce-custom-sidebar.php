<div class="archives">
    <div class="sidebar">
        <div class="sidebar--title">
            <h3 class="sidebar--title__text">Kategorite e produkteve</h3>
        </div>

    
        <div class="sidebar--categories">
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
                        'terms' => $product_category->slug
                        )
                    ),
                );

                if ( $count > 0 ){ 
                    foreach ( $product_categories as $product_category ) {
                        echo '<a href="'.get_term_link($product_category).'" class="sidebar--categories__text">' . $product_category->name.' <span>('.$product_category->count.')</span></a>'; 
                    }  } 
            ?>
        </div>    
    </div>
<?php
    get_header();
?>


<div class="wrapper">
    <div class="rreth-nesh">
       <h1 class="rreth-nesh--header">
        <?php
            while (have_posts()) {
                the_post();
                the_title();
            }
        ?>
        </h1>

        <div class="rreth-nesh--top-info">
            <?php $top_info = get_field('top-info'); ?>
            <h2 class="rreth-nesh--top-info__title"><?php echo $top_info['top-info-title']; ?></h2>
            <h6 class="rreth-nesh--top-info__description"><?php echo $top_info['top-info-description'] ?></h6>
        </div>

        <div class="rreth-nesh--promo">
            <?php $rreth_nesh_vizioni_misioni = get_field('rreth_nesh_vizioni_&_misioni'); ?>

            <section class="rreth-nesh--promo-video">
                <iframe width="690" height="388" src="https://www.youtube.com/embed/MkzJkbuCcmY" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </section>

            <section class="rreth-nesh--promo-text-photo">
                <div class="rreth-nesh--promo-text-photo__text">
                    <div class="rreth-nesh--promo-text-photo__vizioni">
                        <?php $vizioni = $rreth_nesh_vizioni_misioni['rreth_nesh_vizioni']; ?>
                        <h2><?php echo $vizioni['rreth_nesh_vizioni_title']; ?></h2>
                        <p><?php echo $vizioni['rreth_nesh_vizioni_description']; ?></p>
                    </div>
                    <div class="rreth-nesh--promo-text-photo__misioni">
                        <?php $misioni = $rreth_nesh_vizioni_misioni['rreth_nesh_misioni'] ?>
                        <h2><?php echo $misioni['rreth_nesh_misioni_title']; ?></h2>
                        <p><?php echo $misioni['rreth_nesh_misioni_description']; ?></p>
                    </div>
                </div>
                <div class="rreth-nesh--promo-text-photo__image">
                    <?php echo '<img src='.$rreth_nesh_vizioni_misioni['rreth_nesh_imazhi']['url'].'>'; ?>
                </div>
            </section>

        </div>
        <img src="<?php echo get_theme_file_uri('/images/logo-map.png') ?>" alt="Logo Map" class="acf-map--img">

        <!-- GOOGLE MAPS -->
        <h1 class="rreth-nesh--maps__header">pikat tona</h1>

        <div class="rreth-nesh--maps">
            <?php
                $mapLocation1 = get_field('vendndodhja_ne_harte');
                $mapLocation2 = get_field('vendndodhja_ne_harte2');

                $latLng = array();
                array_push($latLng,array(
                    'lat' => $mapLocation1['lat'],
                    'lng' => $mapLocation1['lng']
                ));
                array_push($latLng,array(
                    'lat' => $mapLocation2['lat'],
                    'lng' => $mapLocation2['lng']
                ));
            ?>
            
            <div class="rreth-nesh--maps__info">
                <h2 class="rreth-nesh--maps__info-header"><?php echo $mapLocation1['address'] ?></h2>
                <h2 class="rreth-nesh--maps__info-header"><?php echo $mapLocation2['address'] ?></h2>
            </div>
            <div class="rreth-nesh--maps__map">
                <div class="acf-map">
                    <?php for($i=0;$i<2;$i++){ ?> 
                    <div class="marker" data-lat="<?php echo $latLng[$i]['lat'] ?>" data-lng="<?php echo $latLng[$i]['lng'] ?>"></div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    
</div>

<?php
    get_footer();
?>
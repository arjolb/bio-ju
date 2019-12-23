<?php get_header(); ?>

<div class="kontakt">
    <div class="wrapper">

<?php

    while (have_posts()) {
        the_post();
        echo '<h1 class="kontakt-header">'.get_the_title().'</h1>';
    }

?>

    <div class="kontakt-container">
        <div class="kontakt-container--info">
            <h3>Tel: +355 069 80 60 222</h3>
            <h3>Sms: +355 069 80 60 222</h3>
            <h3>Email: info@bioju.al</h3>

            <ul class="kontakt-container--info__social-icons">
                <li><a href="#"><img src="<?php echo get_theme_file_uri('icons/header/instagram.svg') ?>" alt="Instagram Logo"></a></li>
                <li><a href="#"><img src="<?php echo get_theme_file_uri('icons/header/facebook.svg') ?>" alt="Facebook Logo"></a></li>
                <li><a href="#"><img src="<?php echo get_theme_file_uri('icons/header/youtube.svg') ?>" alt="Youtube Logo"></a></li>
            </ul>
        </div>

        <div class="kontakt-container--form">
            <div class="kontakt-container--form__group-inputs">
                <div class="kontakt-container--form__group-inputs-1">
                    <label for="emri">Emri</label>
                    <input type="text" id="emri">
                </div>
                <div class="kontakt-container--form__group-inputs-2">
                    <label for="mbiemri">Mbiemri</label>
                    <input type="text" id="mbiemri">
                </div>
            </div>

            <div class="kontakt-container--form__group-inputs">
                <div class="kontakt-container--form__group-inputs-1">
                    <label for="email">Email <span>*</span></label>
                    <input type="text" id="email">
                </div>
                <div class="kontakt-container--form__group-inputs-2">
                    <label for="telefoni">Telefoni</label>
                    <input type="tel" id="telefoni">
                </div>
            </div>

            <div class="kontakt-container--form__group-inputs">
                <div class="kontakt-container--form__group-inputs-1">
                    <label for="qyteti">Qyteti</label>
                    <input type="text" id="qyteti">
                </div>
                <div class="kontakt-container--form__group-inputs-2">
                    <label for="adresa">Adresa</label>
                    <input type="input" id="adresa">
                </div>
            </div>

            <div class="kontakt-container--form__msg">
                <label for="msg">Mesazhi <span>*</span></label>
                <textarea id="msg" cols="30" rows="10"></textarea>
            </div>

                <button class="kontakt-container--form__send-btn">dërgo</button>
        </div>
    </div>


    </div>
</div>

<?php get_footer(); ?>
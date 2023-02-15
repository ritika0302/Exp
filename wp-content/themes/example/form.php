<!-- <?php
/**
 * Template Name: form
 */

if ( is_user_logged_in() ) {
    echo 'Welcome, registered user!';
} else {
    echo 'Welcome, visitor!';
}
$track = '?track='.uniqid();
?>
<a href="<?= get_home_url(). $track ?>"> </a>

<?php


get_header();

if ( is_user_logged_in() ) {

    echo do_shortcode('[lwCSForm]');
    echo do_shortcode('[showpost]');


    get_sidebar();

} else {
    
   echo do_shortcode('[loginform]');
}

get_footer();
?>  -->

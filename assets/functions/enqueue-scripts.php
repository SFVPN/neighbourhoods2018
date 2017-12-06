<?php
function site_scripts() {
  global $wp_styles; // Call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way

	// Removes WP version of jQuery
	wp_deregister_script('jquery');

	// Load jQuery files in header - load in header to avoid issues with plugins
	wp_enqueue_script( 'jquery', get_template_directory_uri() . '/vendor/jquery/dist/jquery.min.js', array(), '', false );

    // Load What-Input files in footer
    //wp_enqueue_script( 'what-input', get_template_directory_uri() . '/vendor/what-input/what-input.min.js', array(), '', true );

    // Adding Materialize scripts file in the footer
  wp_enqueue_script( 'materialize-js', 'https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js', array( 'jquery' ), '', true );

    // Adding Slick slider script
  if(is_single()){
  wp_enqueue_script( 'slick-js', 'https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js', array(), '', true );
  wp_enqueue_script( 'slick-init', get_template_directory_uri() . '/assets/js/slick_init.js', array( 'jquery' ), '', true );
}

//wp_enqueue_script( 'mixitup-js', 'https://cdn.jsdelivr.net/gh/patrickkunka/mixitup@3.2.1/dist/mixitup.js', array(), '', true );
//wp_enqueue_script( 'mixitup-init', get_template_directory_uri() . '/assets/js/mixitup_init.js', array( ), '', true );

    // Adding Cookie Consent scripts file in the footer

    wp_enqueue_script( 'cookie-js', 'https://cdnjs.cloudflare.com/ajax/libs/cookieconsent2/1.0.9/cookieconsent.min.js', array(), '', true );

    // Adding scripts file in the footer
    wp_enqueue_script( 'site-js', get_template_directory_uri() . '/assets/js/scripts.js', array( 'jquery' ), '', true );


    wp_enqueue_style( 'fonts', 'https://fonts.googleapis.com/css?family=Montserrat:600|Hind', array(), '', 'all' );

    wp_enqueue_style( 'icons-css', 'https://fonts.googleapis.com/icon?family=Material+Icons', array(), '', 'all' );

    wp_enqueue_style( 'flickity-css', 'https://unpkg.com/flickity@2/dist/flickity.min.css', array(), '', 'all' );



    // Register main stylesheet
    wp_enqueue_style( 'site-css', get_template_directory_uri() . '/assets/css/style.css', array(), '', 'all' );

    // Deregister admin stylesheet so that it doesn't load on the front-end form

    wp_deregister_style( 'wp-admin' );


    // Comment reply script for threaded comments
    if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
      wp_enqueue_script( 'comment-reply' );
    }
}
add_action('wp_enqueue_scripts', 'site_scripts', 999);

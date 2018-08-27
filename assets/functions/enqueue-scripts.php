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
  wp_enqueue_script( 'materialize-js', 'https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js', array( 'jquery' ), '', true );

  // Adding Cookie Consent scripts file in the footer
  $cookies = get_field('information_collected', 'option');


  $cookies_set = $cookies['cookies_set'];

  if($cookies_set) {
    wp_enqueue_script( 'cookie-js', '//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js', array(), '', true );
    wp_enqueue_script( 'cookie-init-js', get_template_directory_uri() . '/assets/js/cookieinit.js', array( 'jquery' ), '', true );

    wp_enqueue_style( 'slick-css', '//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css', array(), '', 'all' );
  }

    // Adding flickity slider script
  if(is_single()){
  wp_enqueue_script( 'flickity-js', 'https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js', array(), '', true );
  wp_enqueue_script( 'flickity-init', get_template_directory_uri() . '/assets/js/slick_init.js', array( 'jquery' ), '', true );
}

if(is_post_type_archive('audits')){
wp_enqueue_script( 'maps-js', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyB1ogka67k0TWwlmXEcsUqLEeSZTBkgJyA&libraries=places&callback=initMap', null, null, true ); // removed &callback=initMap
wp_enqueue_script( 'cluster-js', 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js', array( 'maps-js' ), '', true );
wp_enqueue_script( 'mapping-js', get_template_directory_uri() . '/assets/js/places_new.js', array( 'jquery', 'maps-js' ), '', true );
}

if(is_singular('audits')){
wp_enqueue_script( 'chart-js', 'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js', array(), '', true );
wp_enqueue_script( 'maps-js', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyB1ogka67k0TWwlmXEcsUqLEeSZTBkgJyA&libraries=places', null, null, true ); // removed &callback=initMap
wp_enqueue_script( 'map-js', get_template_directory_uri() . '/assets/js/map.js', array( 'jquery',  'maps-js' ), '', true );
}


function gioga_add_async_defer_attribute($tag, $handle) {
	if ( 'maps-js' !== $handle )
	return $tag;
	return str_replace( ' src', ' async defer src', $tag );
  // removed defer from function
}
add_filter('script_loader_tag', 'gioga_add_async_defer_attribute', 10, 2);
//wp_enqueue_script( 'mixitup-js', 'https://cdn.jsdelivr.net/gh/patrickkunka/mixitup@3.2.1/dist/mixitup.js', array(), '', true );
//wp_enqueue_script( 'mixitup-init', get_template_directory_uri() . '/assets/js/mixitup_init.js', array( ), '', true );

    // Adding Cookie Consent scripts file in the footer


    // Adding scripts file in the footer
    wp_enqueue_script( 'site-js', get_template_directory_uri() . '/assets/js/scripts.js', array( 'jquery' ), '', true );


    //wp_enqueue_style( 'fonts', 'https://fonts.googleapis.com/css?family=Montserrat:600', array(), '', 'all' );

    wp_enqueue_style( 'icons-css', 'https://fonts.googleapis.com/icon?family=Material+Icons', array(), '', 'all' );

    //wp_enqueue_style( 'flickity-css', 'https://unpkg.com/flickity@2/dist/flickity.min.css', array(), '', 'all' );



    // Register main stylesheet
    wp_enqueue_style( 'site-css', get_template_directory_uri() . '/assets/css/style.css', array(), '', 'all' );

    // Deregister admin stylesheet so that it doesn't load on the front-end form

    add_action( 'wp_print_styles', 'my_deregister_styles', 100 );

function my_deregister_styles() {
	wp_deregister_style( 'wp-admin' );
}



    // Comment reply script for threaded comments
    if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
      wp_enqueue_script( 'comment-reply' );
    }
}
add_action('wp_enqueue_scripts', 'site_scripts', 999);

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
  wp_enqueue_script( 'materialize-js', 'https://cdnjs.cloudflare.com/ajax/libs/materialize/0.99.0/js/materialize.min.js', array( 'jquery' ), '', true );

  // Adding Cookie Consent scripts file in the footer
  
  if(function_exists('get_field')):
  $cookies = get_field('information_collected', 'option');


  $cookies_set = $cookies['cookies_set'];

  if($cookies_set) {
    wp_enqueue_script( 'cookie-js', '//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js', array(), '', true );
    wp_enqueue_script( 'cookie-init-js', get_template_directory_uri() . '/assets/js/cookieinit.js', array( 'jquery' ), '', true );

    wp_enqueue_style( 'slick-css', '//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css', array(), '', 'all' );
  }
  
  endif;

    // Adding flickity slider script
  if(is_single()){
  wp_enqueue_script( 'flickity-js', 'https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js', array(), '', true );
  wp_enqueue_script( 'flickity-init', get_template_directory_uri() . '/assets/js/slick_init.js', array( 'jquery' ), '', true );
}

if(is_post_type_archive('audits')){
  if(function_exists('get_field')):
$api_key = get_field('api_key', 'option');
wp_enqueue_script( 'maps-js', 'https://maps.googleapis.com/maps/api/js?key=' . $api_key . '&libraries=places&callback=initMap', null, null, true ); // removed &callback=initMap
wp_enqueue_script( 'cluster-js', 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js', array( 'maps-js' ), '', true );
wp_enqueue_script( 'audit-map-js', get_template_directory_uri() . '/assets/js/places_new.js', array( 'jquery', 'maps-js' ), '', true );
  endif;
}


if(is_singular(array( 'audits' ))){
  if(function_exists('get_field')):
$api_key = get_field('api_key', 'option');
wp_enqueue_script( 'chart-js', 'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js', array(), '', true );
wp_enqueue_script( 'maps-js', 'https://maps.googleapis.com/maps/api/js?key=' . $api_key . '&libraries=places', null, null, true ); // removed &callback=initMap
wp_enqueue_script( 'map-js', get_template_directory_uri() . '/assets/js/map.js', array( 'jquery',  'maps-js' ), '', true );
  endif;
}

function ocn_acf_init() {
    if(is_admin()):
        return;
    endif;
    acf_update_setting('enqueue_google_maps', false);
}

add_action('acf/init', 'ocn_acf_init');

if(is_singular(array( 'resources' ))){
  wp_enqueue_script( 'addevent-js', 'https://addevent.com/libs/atc/1.6.1/atc.min.js', array(), '', true );
}

if(is_singular(array( 'pilots' ))){
  wp_register_script( 'ajax-js', get_template_directory_uri() . '/assets/js/ajax.js', array( 'jquery'), '', true );
  wp_localize_script( 'ajax-js', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));        

  wp_enqueue_script( 'ajax-js' );
   


}


if(is_page_template('page-form_survey.php')) {
  wp_enqueue_script( 'remember-js', get_template_directory_uri() . '/assets/js/remember_state.js', array( 'jquery' ), '', true );
  wp_enqueue_script( 'form-js', get_template_directory_uri() . '/assets/js/form.js', array( 'jquery', 'remember-js' ), '', true );
}



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

    wp_enqueue_style( 'old-ie', get_stylesheet_directory_uri() . "/assets/css/styleie.css", array( 'site-css' ) );
	  wp_style_add_data( 'old-ie', 'conditional', 'lt IE 9' );

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

function my_enqueue() {


    wp_enqueue_script( 'image-marker-js', get_template_directory_uri() . '/assets/js/image-marker.js', array('jquery' ), '', true );
}
add_action( 'admin_enqueue_scripts', 'my_enqueue');

function add_defer_attribute($tag, $handle) {
   // add script handles to the array below
   $scripts_to_defer = array('image-marker-js', 'maps-js');

   foreach($scripts_to_defer as $defer_script) {
      if ($defer_script === $handle) {
         return str_replace(' src', ' async="async" defer="defer" src', $tag);
      }
   }
   return $tag;
}
add_filter('script_loader_tag', 'add_defer_attribute', 10, 2);

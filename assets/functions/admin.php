<?php
// This file handles the admin area and functions - You can use this file to make changes to the dashboard.

/************* DASHBOARD WIDGETS *****************/
// Disable default dashboard widgets
function disable_default_dashboard_widgets() {
	// Remove_meta_box('dashboard_right_now', 'dashboard', 'core');    // Right Now Widget
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'core'); // Comments Widget
	remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');  // Incoming Links Widget
	//remove_meta_box('dashboard_plugins', 'dashboard', 'core');         // Plugins Widget

	// Remove_meta_box('dashboard_quick_press', 'dashboard', 'core');  // Quick Press Widget
	//remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');   // Recent Drafts Widget
	remove_meta_box('dashboard_primary', 'dashboard', 'core');         //
	remove_meta_box('dashboard_secondary', 'dashboard', 'core');       //
	remove_meta_box('dashboard_right_now', 'dashboard', 'core');


	// Removing plugin dashboard boxes
	remove_meta_box('yoast_db_widget', 'dashboard', 'normal');         // Yoast's SEO Plugin Widget

}

//remove_action( 'welcome_panel', 'wp_welcome_panel' );

/*
For more information on creating Dashboard Widgets, view:
http://digwp.com/2010/10/customize-wordpress-dashboard/
*/

/**
 * Add a widget to the dashboard.
 *
 * This function is hooked into the 'wp_dashboard_setup' action below.
 */


// Calling all custom dashboard widgets
function charly_custom_dashboard_widgets() {

	/*
	Be sure to drop any other created Dashboard Widgets
	in this function and they will all load.
	*/
}
// removing the dashboard widgets
add_action('admin_menu', 'disable_default_dashboard_widgets');
// adding any custom widgets
add_action('wp_dashboard_setup', 'charly_custom_dashboard_widgets');

/************* CUSTOMIZE ADMIN *******************/
// Custom Backend Footer
function charly_custom_admin_footer() {
	_e('<span id="footer-thankyou">Developed by <a href="http://alastaircox.com" target="_blank">Alastair Cox</a></span>.', 'charlywp');
}

// adding it to the admin area
add_filter('admin_footer_text', 'charly_custom_admin_footer');


/**
* Disable the emoji's
*/
function disable_emojis() {
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'disable_emojis' );

/**
* Filter function used to remove the tinymce emoji plugin.
*
* @param array $plugins
* @return array Difference betwen the two arrays
*/
function disable_emojis_tinymce( $plugins ) {
if ( is_array( $plugins ) ) {
return array_diff( $plugins, array( 'wpemoji' ) );
} else {
return array();
}
}

/**
* Remove emoji CDN hostname from DNS prefetching hints.
*
* @param array $urls URLs to print for resource hints.
* @param string $relation_type The relation type the URLs are printed for.
* @return array Difference betwen the two arrays.
*/
function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
if ( 'dns-prefetch' == $relation_type ) {
/** This filter is documented in wp-includes/formatting.php */
$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );

$urls = array_diff( $urls, array( $emoji_svg_url ) );
}

return $urls;
}





add_filter( 'manage_audits_posts_columns', 'sfvpn_audits_columns' );

function sfvpn_audits_columns( $columns ) {
	 $columns = array(
		 'cb' => $columns['cb'],
		 'title' => __( 'Title' ),
		 'df' => __( 'Dementia Friendly', 'sfvpn' ),
		 'taxonomy-audit_category' =>  __( 'Audit Type' ),
	   'address' => __( 'Address', 'sfvpn' ),
	   'rating' => __( 'Rating', 'sfvpn' ),
	 );


 return $columns;
}


add_action( 'manage_audits_posts_custom_column', 'sfvpn_audits_column', 10, 2);
function sfvpn_audits_column( $column, $post_id ) {
	if ( 'df' === $column ) {
		$df = get_post_meta($post_id, 'submission_details_dementia_friendly', true);
		$name = get_userdata($user[0]);

		if ( ! $df ) {
			_e( 'n/a' );
		} else {
			echo $df;
		}
	}

	if ( 'address' === $column ) {
		$address = get_post_meta($post_id, 'location_map', true);

		if ( ! $address ) {
			_e( 'n/a' );
		} else {
			echo $address['address'];
		}
	}

	if ( 'rating' === $column ) {
    $rating = get_post_meta( $post_id, 'location_rating_average', true );

    if ( ! $rating ) {
      _e( 'n/a' );
    } else {
      echo $rating . ' out of 7';
    }
  }
}

add_filter( 'manage_edit-audits_sortable_columns', 'sfvpn_audits_sortable_columns');
function sfvpn_audits_sortable_columns( $columns ) {
  $columns['rating'] = 'location_rating_average';
  return $columns;
}


add_action( 'pre_get_posts', 'sfvpn_posts_orderby' );
function sfvpn_posts_orderby( $query ) {
  if( ! is_admin() || ! $query->is_main_query() ) {
    return;
  }

  if ( 'location_rating_average' === $query->get( 'orderby') ) {
    $query->set( 'orderby', 'meta_value' );
    $query->set( 'meta_key', 'location_rating_average' );
    $query->set( 'meta_type', 'numeric' );
  }
}

add_filter('acf/settings/google_api_key', function () {
    return 'AIzaSyB1ogka67k0TWwlmXEcsUqLEeSZTBkgJyA';
});

if (function_exists('acf_add_options_page')) {

		acf_add_options_page(array(
		'page_title' 	=> 'Theme Settings',
		'menu_title'	=> 'Options',
		'menu_slug' 	=> 'theme-settings',
		'capability'	=> 'edit_posts',
		'icon_url'   => 'dashicons-admin-generic',
		'redirect'		=> false
	));

	acf_add_options_page(array(
    'page_title' => 'SEO Details',
    'menu_title' => 'SEO Details',
    'menu_slug'  => 'seo-details',
    'capability' => 'edit_posts',
		'icon_url'   => 'dashicons-megaphone',
    'redirect'   => false
  ));

	acf_add_options_page(array(
	'page_title' 	=> 'Privacy + Cookies Settings',
	'menu_title'	=> 'Privacy',
	'menu_slug' 	=> 'privacy-settings',
	'capability'	=> 'edit_posts',
	'icon_url'   => 'dashicons-admin-network',
	'redirect'		=> false
));

// acf_add_options_sub_page(array(
// 	'page_title' 	=> 'Privacy + Cookies Settings',
// 	'menu_title'	=> 'Privacy',
// 	'parent_slug'	=> 'theme-general-settings',
// ));

}

// add youtube-nocookie.com as a source for oembeds

wp_embed_register_handler( 'ytnocookie', '#https?://www\.youtube\-nocookie\.com/embed/([a-z0-9\-_]+)#i', 'wp_embed_handler_ytnocookie' );
 wp_embed_register_handler( 'ytnormal', '#https?://www\.youtube\.com/watch\?v=([a-z0-9\-_]+)#i', 'wp_embed_handler_ytnocookie' );
 wp_embed_register_handler( 'ytnormal2', '#https?://www\.youtube\.com/watch\?feature=player_embedded&amp;v=([a-z0-9\-_]+)#i', 'wp_embed_handler_ytnocookie' );

 function wp_embed_handler_ytnocookie( $matches, $attr, $url, $rawattr ) {
   global $defaultoptions;
   $defaultoptions['yt-content-width'] = '680';
   $defaultoptions['yt-content-height'] = '510';
   $defaultoptions['yt-norel'] = 1;
   $relvideo = '';
   if ($defaultoptions['yt-norel']==1) {
       $relvideo = '?rel=0';
   }
   $embed = sprintf(
     '<iframe src="https://www.youtube-nocookie.com/embed/%2$s%5$s" width="%3$spx" height="%4$spx" frameborder="0" scrolling="no" marginwidth="0" marginheight="0"></iframe><p><a href="https://www.youtube.com/watch?v=%2$s" title="View video on YouTube">View video on YouTube</a></p>',
      get_template_directory_uri(),
      esc_attr($matches[1]),
      $defaultoptions['yt-content-width'],
      $defaultoptions['yt-content-height'],
      $relvideo
   );
   return apply_filters( 'embed_ytnocookie', $embed, $matches, $attr, $url, $rawattr );
 }

add_action('wp_footer', function() {
  $schema = array(
    // Tell search engines that this is structured data
    '@context'  => "http://schema.org",
    // Tell search engines the content type it is looking at
    '@type'     => get_field('schema_type', 'options'),
    // Provide search engines with the site name and address
    'name'      => get_field('company_name', 'options'),
    'telephone' => '+44' . get_field('company_phone', 'options'), //needs country code
    'url'       => get_home_url(),
    'description' => get_bloginfo('description'),
		'priceRange' => "Not applicable",
    'image' => get_field('company_logo', 'options')
    // Provide the company address

  );
  $schema['address'] = array();
  $schema['openingHoursSpecification'] = array();
  if (have_rows('address_details', 'options')) { //parent repeater
  // Then set up the array



  // For each row...
  while (have_rows('address_details', 'options')) : the_row();
    // ...check if it's marked "Closed"...

    // ...then output the times
    $addresses = array(
      '@type'           => 'PostalAddress',
      'streetAddress'   => get_sub_field('address_street', 'options'),
      'postalCode'      => get_sub_field('address_postal', 'options'),
      'addressLocality' => get_sub_field('address_locality', 'options'),
      'addressRegion'   => get_sub_field('address_region', 'options'),
      'addressCountry'  => get_sub_field('address_country', 'options'),
      'name'  => get_sub_field('location_name', 'options')
    );
    if (have_rows('opening_times', 'options')) {
    // Then set up the array

    // For each row...
    while (have_rows('opening_times', 'options')) : the_row();
    // ...check if it's marked "Closed"...

    // ...then output the times
    $openings = array(
      '@type'     => 'openingHoursSpecification',
      'dayOfWeek' => get_sub_field('opening_days'),
      'opens'     => get_sub_field('start_time'),
      'closes'    => get_sub_field('finish_time')
    );
    // Finally, push this array to the schema array

    array_push($schema['openingHoursSpecification'], $openings);

    endwhile;
    }
// can you add openingHoursSpecification schema to each address?

// at the moment this is adding an OpeningHoursSpecification array within the address array

    // Finally, push this array to the schema array
    array_push($schema['address'], $addresses);



  endwhile;
}

if (have_rows('special_days', 'option')) {
  // For each row...
  while (have_rows('special_days', 'option')) : the_row();
    // ...check if it's marked "Closed"...

    // ...then output the times
    $special_days = array(
      '@type'        => 'OpeningHoursSpecification',
      'validFrom'    => get_sub_field('date_from'),
      'validThrough' => get_sub_field('date_to'),
      'opens'        => '00:00',
      'closes'       => '00:00'
    );
    // Finally, push this array to the schema array
    array_push($schema['openingHoursSpecification'], $special_days);

  endwhile;
}

if (have_rows('social_media', 'option')) {
  $schema['sameAs'] = array();
  // For each instance...
  while (have_rows('social_media', 'option')) : the_row();
    // ...add it to the schema array
    array_push($schema['sameAs'], get_sub_field('url'));
  endwhile;
}


echo '<script type="application/ld+json">' . json_encode($schema) . '</script>';
});


add_action('admin_head', 'my_admin_style');

function my_admin_style() {
  echo '<style>
    .business-details {
      background: whitesmoke;
      color: black;
    }
  </style>';
}

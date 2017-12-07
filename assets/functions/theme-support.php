<?php

// Adding WP Functions & Theme Support
function joints_theme_support() {

	// Add WP Thumbnail Support
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 200, 200 );

	// Default thumbnail size

	add_action('init', 'remove_plugin_image_sizes');

function remove_plugin_image_sizes() {
	remove_image_size('medium_large');
}

	// Add RSS Support
	add_theme_support( 'automatic-feed-links' );

	// Add Support for WP Controlled Title Tag
	add_theme_support( 'title-tag' );

	// Add HTML5 Support
	add_theme_support( 'html5',
	         array(
	         	'comment-list',
	         	'comment-form',
	         	'search-form',
	         )
	);

	/**
	 * Add SVG capabilities
	 */
	 add_filter( 'upload_mimes', 'maertens_svgs_upload_mimes' );

	function maertens_svgs_upload_mimes($mimes = array()) {
			$mimes['svg'] = 'image/svg+xml';
			$mimes['svgz'] = 'image/svg+xml';
			return $mimes;

	}

// simple function to churn out the featured image with role="presentation" if the alt attribute has not been set. This means the absence of alt text be ignored by screen readers - $size is a required argument and accepts one of the following 'thumbnail', 'medium', 'large', 'full'
	function accessible_thumbnail($size) {
		$thumb_id = get_post_thumbnail_id();

 $thumb_alt = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true );
 if($thumb_alt){?>
	 <img src="<?php the_post_thumbnail_url($size); ?>" alt="<?php echo $thumb_alt;?>">
<?php
 } else {?>
	 <img src="<?php the_post_thumbnail_url($size); ?>" role="presentation">
<?php }
}
	// Adding post format support
	/* add_theme_support( 'post-formats',
		array(
			'aside',             // title less blurb
			'gallery',           // gallery of images
			'link',              // quick link to other site
			'image',             // an image
			'quote',             // a quick quote
			'status',            // a Facebook like status update
			'video',             // video
			'audio',             // audio
			'chat'               // chat transcript
		)
	); */

} /* end theme support */

// adds excerpt support to pages

add_action( 'init', 'my_add_excerpts_to_pages' );
function my_add_excerpts_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
}


// limits search to locations custom post type

function searchfilter($query) {

    if ($query->is_search && !is_admin() ) {
        $query->set('post_type',array('locations'));
    }

return $query;
}

add_filter('pre_get_posts','searchfilter');

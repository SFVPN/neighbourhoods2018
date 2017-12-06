<?php
// Theme support options

require_once(get_template_directory().'/assets/functions/theme-support.php');

// Customizer options
require_once(get_template_directory().'/assets/functions/customizer.php');

// WP Head and other cleanup functions
require_once(get_template_directory().'/assets/functions/cleanup.php');

// Register scripts and stylesheets
require_once(get_template_directory().'/assets/functions/enqueue-scripts.php');

// Register custom menus and menu walkers
require_once(get_template_directory().'/assets/functions/menu.php');
require_once(get_template_directory().'/assets/functions/menu-walkers.php');

// Register sidebars/widget areas
require_once(get_template_directory().'/assets/functions/sidebar.php');

// Makes WordPress comments suck less
require_once(get_template_directory().'/assets/functions/comments.php');

// Replace 'older/newer' post links with numbered navigation
require_once(get_template_directory().'/assets/functions/page-navi.php');

// Setup initial pages and assign to main menu
require_once(get_template_directory().'/assets/functions/setup-pages.php');


// Adds support for multiple languages
require_once(get_template_directory().'/assets/translation/translation.php');

// Adds site styles to the WordPress editor
//require_once(get_template_directory().'/assets/functions/editor-styles.php');

// Related post function - no need to rely on plugins
// require_once(get_template_directory().'/assets/functions/related-posts.php');

// Use this as a template for custom post types
require_once(get_template_directory().'/assets/functions/custom-post-type.php');

// Customize the WordPress login menu
// require_once(get_template_directory().'/assets/functions/login.php');

// Customize the WordPress admin
require_once(get_template_directory().'/assets/functions/admin.php');

function my_acf_update_average_rating($post_id)
{
   if( have_rows('location_details') ):

 while( have_rows('location_details') ): the_row();

   // vars
   $rating1 = get_sub_field('location_rating_flooring');
   $rating2 = get_sub_field('location_rating_color');
   $average = ($rating1 + $rating2) / 2;
   $progress = $average * 10;



  endwhile;

 endif;
    $field_name = "location_rating_average";
    update_field($field_name, $average, $post_id);
}
add_action('acf/save_post', 'my_acf_update_average_rating');


add_action('acf/save_post', 'my_save_post');

function my_save_post( $post_id ) {

	// bail early if not a contact_form post
  if( is_admin() ) {
		return;
	}

  //if( current_user_can('editor') || current_user_can('administrator') ) {
    //return;
  //}


	// bail early if editing in admin


	// vars
	$post = get_post( $post_id );
  $current_user = get_current_user_id();
  $current_user = strval($current_user);
  $user = 'user_' . $current_user;
  $parentID = wp_get_post_parent_id( $post_ID );
  $args = array(
   'post_parent' => $parentID
 );
  $children = get_children( $args );
$uncompleted = [];
$completed = get_field('page_completed', $user);
//$completed = array_values($completed);

if(!$completed) {
  $completed = [];
  array_push($completed, $post);
  update_field('field_59fc70ecf090b', $completed, $user);
} elseif ($completed) {
  array_push($completed, $post);
  update_field('field_59fc70ecf090b', $completed, $user);
}

if(!$completed) {
  $completed = [];
  foreach($children as $child) {
     if (!in_array($child->ID , $completed) ) {
      $uncompleted[] = $child->ID;
   }
  }
} elseif ($completed) {
  foreach($children as $child) {
     if (!in_array($child->ID , $completed) ) {
      $uncompleted[] = $child->ID;
   }
}
}







if(count($uncompleted) == 1) {

  badgeos_award_achievement_to_user( $parentID, $user );
} else {
  //badgeos_award_achievement_to_user( $post_id, $user );
}

}

//pre_get_posts filter is called before WordPress gets posts
add_filter( 'pre_get_posts', 'lesson_get_posts' );

function lesson_get_posts( $query ) {
    //if page is an archive and post_parent is not set and post_type is the post type in question
    if ( is_archive() && false == $query->query_vars['post_parent'] &&  $query->query_vars['post_type'] == 'lesson')
        //set post_parent to 0, which is the default post_parent for top level posts
        $query->set( 'post_parent', 0 );
    return $query;
}

add_filter( 'register_post_type_args', 'wpse247328_register_post_type_args', 10, 2 );
function wpse247328_register_post_type_args( $args, $post_type ) {

    if ( 'lesson' === $post_type ) {
        $args['rewrite']['slug'] = 'digital/lessons';
    }

    return $args;
}

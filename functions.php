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

require_once(get_template_directory() . '/assets/functions/organisations-cpt.php');

require_once(get_template_directory() . '/assets/functions/contacts-cpt.php');

require_once(get_template_directory() . '/assets/functions/activities-cpt.php');

require_once(get_template_directory() . '/assets/functions/pathway-cpt.php');

// Customize the WordPress login menu
require_once(get_template_directory().'/assets/functions/login.php');

// Customize the WordPress admin
require_once(get_template_directory().'/assets/functions/admin.php');

require_once(get_template_directory().'/assets/functions/rss.php');

require_once(get_template_directory().'/assets/functions/components.php');

function gioga_add_async_defer_attribute($tag, $handle) {
	if ( 'maps-js' !== $handle )
	return $tag;
	return str_replace( ' src', ' async defer src', $tag );
  // removed defer from function
}
add_filter('script_loader_tag', 'gioga_add_async_defer_attribute', 10, 2);

function my_acf_update_average_rating($post_id)
{
   if( have_rows('location_details') ):

     $group_ID = 499;

     $superheroes = acf_get_fields('499');

     $sub_fields = $superheroes[0]['sub_fields'];

     $total = 0;
     $i = 0;

 while( have_rows('location_details') ): the_row();


   foreach ($sub_fields as $sub_field) {
     $i++;
     $value = get_sub_field($sub_field["name"]);
     $total += $value;
   }

   if($i != 0) {
     $average = $total / $i;
   }





  endwhile;

 endif;
    $field_name = "location_rating_average";
    update_field($field_name, round($average, 2), $post_id);
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

  //badgeos_award_achievement_to_user( $parentID, $user );
} else {
  //badgeos_award_achievement_to_user( $post_id, $user );
}

}

//pre_get_posts filter is called before WordPress gets posts
// add_filter( 'pre_get_posts', 'lesson_get_posts' );
//
// function lesson_get_posts( $query ) {
//     //if page is an archive and post_parent is not set and post_type is the post type in question
//     if ( is_archive() && false == $query->query_vars['post_parent'] &&  $query->query_vars['post_type'] == 'lesson')
//         //set post_parent to 0, which is the default post_parent for top level posts
//         $query->set( 'post_parent', 0 );
//     return $query;
// }


add_filter( 'register_post_type_args', 'wpse247328_register_post_type_args', 10, 2 );
function wpse247328_register_post_type_args( $args, $post_type ) {

    if ( 'lesson' === $post_type ) {
        $args['rewrite']['slug'] = 'digital/lessons';
    }

    return $args;
}

function svpn_audits_vars() {
  global $post;
  $ID = $post->ID;
  $dets = get_field('location_details', $ID);
	$array = array(
	    "Moving Around" => $dets['moving_around'],
	    "Public Transport" => $dets['public_transport'],
      "Traffic and Parking" => $dets['traffic_and_parking'],
      "Streets and Spaces" => $dets['streets_and_spaces'],
      "Natural Space" => $dets['natural_space'],
      "Play and Recreation" => $dets['play_and_recreation'],
      "Facilities and Amenities" => $dets['facilities_and_amenities'],
      "Housing and Community" => $dets['housing_and_community'],
      "Social Contact" => $dets['social_contact'],
      "Identity and Belonging" => $dets['identity_and_belonging'],
      "Feeling Safe" => $dets['feeling_safe'],
      "Care and Maintenance" => $dets['care_and_maintenance'],
      "Influence and Sense of Control" => $dets['influence_and_sense_of_control']
	  );

    wp_register_script( "scripts", get_template_directory_uri() . "/assets/js/audits.js", array( 'jquery' ), '', true );
    if(is_singular('audits')){
    wp_enqueue_script( "scripts" );
  }
    wp_localize_script( "scripts", "audit_vars", $array );
}
add_action( "wp_enqueue_scripts", "svpn_audits_vars" );


// function my_taxonomy_wp_list_categories( $args, $field ) {
//     // modify args
//     $args['orderby'] = 'count';
//     $args['order'] = 'ASC';
//     $args['include'] = '21, 25, 44, 45, 31, 32'; // list of terms to include
// 		$choices = $args['include'];
//     // return
//     return $args;
//
// }
// add_filter('acf/fields/taxonomy/wp_list_categories/key=field_5e4ad49949cbe', 'my_taxonomy_wp_list_categories', 10, 2);

function organisation_post_order( $query ) {
    if ( $query->is_post_type_archive('organisations') && $query->is_main_query() ) {
    $query->set( 'orderby', 'title' );
    $query->set( 'order', 'ASC' );
    }
}
add_action( 'pre_get_posts', 'organisation_post_order' );


function add_acf_sub_form() {
	global $post;
	$subs = get_field('allow_submission');
	$postType = get_field('post_type_add');

	if($postType) {


		// check if the repeater field has rows of data
if( have_rows('group_field') ):
 $fields = array();
 	// loop through the rows of data
    while ( have_rows('group_field') ) : the_row();

        // display a sub field value
        $fields[] = get_sub_field('number_field');

    endwhile;

else :

    // no rows found

endif;

if($postType['value'] == 'pathway') {
	acf_form(array(

			'post_id'       => 'new_post',
			'field_groups' => $fields,
			'new_post'      => array(
					'post_type'     => $postType['value'],
					'post_status'   => 'publish',
					'post_title' => time()
			),
			'return' => '%post_url%',
			'submit_value'  => 'Create new ' . $postType['label']
	));

	} else {
		acf_form(array(

				'post_title' => true,
        'post_id'       => 'new_post',
				'field_groups' => $fields,
        'new_post'      => array(
            'post_type'     => $postType['value'],
            'post_status'   => 'publish'
        ),
				'updated_message' => __("Thanks for submitting  your <span>" . $postType['label'] . "</span>. We will be in touch shortly once it has been published to the site." , 'acf'),
        'submit_value'  => 'Create new ' . $postType['label']
    ));
	}


	}

}

// Modify ACF Form Label for Post Title Field
function wd_post_title_acf_name( $field ) {
    $postType = get_field('post_type_add');

		$field['label'] = $postType['label'] . ' Name';

    return $field;
}

add_filter('acf/load_field/name=_post_title', 'wd_post_title_acf_name');

<?php

/**
 * Actvities CPT for listing local activities
 */

function pathway20_activities() {
  // creating (registering) the custom type
  register_post_type( 'activities', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
    // let's now add all the options for this post type
    array('labels' => array(
      'name' => __('Activities', 'pathway20'), /* This is the Title of the Group */
      'singular_name' => __('Activity', 'pathway20'), /* This is the individual type */
      'all_items' => __('All Activities', 'pathway20'), /* the all items menu item */
      'add_new' => __('Add New Activity', 'pathway20'), /* The add new menu item */
      'add_new_item' => __('Add New Activity', 'pathway20'), /* Add New Display Title */
      'edit' => __( 'Edit', 'pathway20' ), /* Edit Dialog */
      'edit_item' => __('Edit Activity', 'pathway20'), /* Edit Display Title */
      'new_item' => __('New Activity', 'pathway20'), /* New Display Title */
      'view_item' => __('View Activity', 'pathway20'), /* View Display Title */
      'search_items' => __('Search Activities', 'pathway20'), /* Search Custom Type Title */
      'not_found' =>  __('Nothing found in the Database.', 'pathway20'), /* This displays if there are no entries yet */
      'not_found_in_trash' => __('Nothing found in Trash', 'pathway20'), /* This displays if there is nothing in the trash */
      'parent_item_colon' => ''
      ), /* end of arrays */
      'public' => true,
      'publicly_queryable' => true,
      'exclude_from_search' => false,
      'show_ui' => true,
      'query_var' => true,
      'show_in_admin_bar' => true,
      'menu_position' => 4, /* this is what order you want it to appear in on the left hand side menu */
      'menu_icon' => 'dashicons-calendar-alt', /* the icon for the custom post type menu */
      'has_archive' => true, /* you can rename the slug here */
      'rewrite'     => ['slug' => 'activities'],
      'capability_type' => 'post',
      'hierarchical' => false,
      /* the next one is important, it tells what's enabled in the post editor */
      'supports' => array( 'title', 'thumbnail')
    ) /* end of options */
  ); /* end of register post type */

}

add_action( 'init', 'pathway20_activities');


register_taxonomy( 'activities_day',
    	array('activities'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
    	array('hierarchical' => false,    /* if this is false, it acts like tags */
    		'labels' => array(
    			'name' => __( 'Activity Days', 'neurovisiontheme' ), /* name of the custom taxonomy */
    			'singular_name' => __( 'Activity Day', 'neurovisiontheme' ), /* single taxonomy name */
    			'search_items' =>  __( 'Search Activity Days', 'neurovisiontheme' ), /* search title for taxomony */
    			'all_items' => __( 'All Activity Days', 'neurovisiontheme' ), /* all title for taxonomies */
    			'parent_item' => __( 'Activity Day', 'neurovisiontheme' ), /* parent title for taxonomy */
    			'parent_item_colon' => __( 'Activity Day:', 'neurovisiontheme' ), /* parent taxonomy title */
    			'edit_item' => __( 'Edit Activity Day', 'neurovisiontheme' ), /* edit custom taxonomy title */
    			'update_item' => __( 'Update Activity Day', 'neurovisiontheme' ), /* update title for taxonomy */
    			'add_new_item' => __( 'Add New Activity Day', 'neurovisiontheme' ), /* add new title for taxonomy */
    			'new_item_name' => __( 'New Activity Day Name', 'neurovisiontheme' ) /* name title for taxonomy */
    		),
        'public' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
    		'show_admin_column' => true,
    		'show_ui' => true,
    		'query_var' => true,
        'has_archive' => true,
        'rewrite'           => array( 'slug' => 'activities/day' ),
    	)
);

register_taxonomy( 'interests',
    	array('activities', 'organisations', 'pathway'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
    	array('hierarchical' => false,    /* if this is false, it acts like tags */
    		'labels' => array(
    			'name' => __( 'Interests', 'neurovisiontheme' ), /* name of the custom taxonomy */
    			'singular_name' => __( 'Interest', 'neurovisiontheme' ), /* single taxonomy name */
    			'search_items' =>  __( 'Search Interests', 'neurovisiontheme' ), /* search title for taxomony */
    			'all_items' => __( 'All Interests', 'neurovisiontheme' ), /* all title for taxonomies */
    			'parent_item' => __( 'Interest', 'neurovisiontheme' ), /* parent title for taxonomy */
    			'parent_item_colon' => __( 'Interest:', 'neurovisiontheme' ), /* parent taxonomy title */
    			'edit_item' => __( 'Edit Interest', 'neurovisiontheme' ), /* edit custom taxonomy title */
    			'update_item' => __( 'Update Interest', 'neurovisiontheme' ), /* update title for taxonomy */
    			'add_new_item' => __( 'Add New Interest', 'neurovisiontheme' ), /* add new title for taxonomy */
    			'new_item_name' => __( 'New Interest Name', 'neurovisiontheme' ) /* name title for taxonomy */
    		),
        'public' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
    		'show_admin_column' => true,
    		'show_ui' => true,
    		'query_var' => true,
        'has_archive' => true,
        'rewrite'           => array( 'slug' => 'activities/interests' ),
    	)
);

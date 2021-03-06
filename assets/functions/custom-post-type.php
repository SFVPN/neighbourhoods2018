<?php

function sfvpn_audits() {
  // creating (registering) the custom type
  register_post_type( 'audits', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
    // let's now add all the options for this post type
    array('labels' => array(
      'name' => __('Audits', 'sfvpntheme'), /* This is the Title of the Group */
      'singular_name' => __('Audit', 'sfvpntheme'), /* This is the individual type */
      'all_items' => __('All Audits', 'sfvpntheme'), /* the all items menu item */
      'add_new' => __('Add New Audit', 'sfvpntheme'), /* The add new menu item */
      'add_new_item' => __('Add New Audit', 'sfvpntheme'), /* Add New Display Title */
      'edit' => __( 'Edit', 'sfvpntheme' ), /* Edit Dialog */
      'edit_item' => __('Edit Audit', 'sfvpntheme'), /* Edit Display Title */
      'new_item' => __('New Audit', 'sfvpntheme'), /* New Display Title */
      'view_item' => __('View Audit', 'sfvpntheme'), /* View Display Title */
      'search_items' => __('Search Audits', 'sfvpntheme'), /* Search Custom Type Title */
      'not_found' =>  __('Nothing found in the Database.', 'sfvpntheme'), /* This displays if there are no entries yet */
      'not_found_in_trash' => __('Nothing found in Trash', 'sfvpntheme'), /* This displays if there is nothing in the trash */
      'parent_item_colon' => ''
      ), /* end of arrays */
      'public' => true,
      'publicly_queryable' => true,
      'exclude_from_search' => false,
      'show_ui' => true,
      'query_var' => true,
      'show_in_admin_bar' => true,
      'menu_position' => 6, /* this is what order you want it to appear in on the left hand side menu */
      'menu_icon' => 'dashicons-location-alt', /* the icon for the custom post type menu */
      'has_archive' => true, /* you can rename the slug here */
      'rewrite'     => ['slug' => 'audits'],
      'capability_type' => 'post',
      'hierarchical' => false,
      /* the next one is important, it tells what's enabled in the post editor */
      'supports' => array( 'title', 'comments')
    ) /* end of options */
  ); /* end of register post type */

}

add_action( 'init', 'sfvpn_audits');

register_taxonomy( 'audit_category',
    	array('audits'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
    	array('hierarchical' => true,    /* if this is false, it acts like tags */
    		'labels' => array(
    			'name' => __( 'Audit Types', 'neurovisiontheme' ), /* name of the custom taxonomy */
    			'singular_name' => __( 'Audit Type', 'neurovisiontheme' ), /* single taxonomy name */
    			'search_items' =>  __( 'Search Audit Types', 'neurovisiontheme' ), /* search title for taxomony */
    			'all_items' => __( 'All Audit Types', 'neurovisiontheme' ), /* all title for taxonomies */
    			'parent_item' => __( 'Parent Audit Type', 'neurovisiontheme' ), /* parent title for taxonomy */
    			'parent_item_colon' => __( 'Parent Audit Type:', 'neurovisiontheme' ), /* parent taxonomy title */
    			'edit_item' => __( 'Edit Audit Type', 'neurovisiontheme' ), /* edit custom taxonomy title */
    			'update_item' => __( 'Update Audit Type', 'neurovisiontheme' ), /* update title for taxonomy */
    			'add_new_item' => __( 'Add New Audit Type', 'neurovisiontheme' ), /* add new title for taxonomy */
    			'new_item_name' => __( 'New Audit Type Name', 'neurovisiontheme' ) /* name title for taxonomy */
    		),
    		'show_admin_column' => true,
    		'show_ui' => true,
    		'query_var' => true,
        'rewrite'           => array( 'slug' => 'audits-environmental/category' ),
    	)
    );

function sfvpn_resources() {
  // creating (registering) the custom type
  register_post_type( 'resources', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
    // let's now add all the options for this post type
    array('labels' => array(
      'name' => __('Resources', 'sfvpntheme'), /* This is the Title of the Group */
      'singular_name' => __('Resource', 'sfvpntheme'), /* This is the individual type */
      'all_items' => __('All Resources', 'sfvpntheme'), /* the all items menu item */
      'add_new' => __('Add New Resource', 'sfvpntheme'), /* The add new menu item */
      'add_new_item' => __('Add New Resource', 'sfvpntheme'), /* Add New Display Title */
      'edit' => __( 'Edit', 'sfvpntheme' ), /* Edit Dialog */
      'edit_item' => __('Edit Resource', 'sfvpntheme'), /* Edit Display Title */
      'new_item' => __('New Resource', 'sfvpntheme'), /* New Display Title */
      'view_item' => __('View Resource', 'sfvpntheme'), /* View Display Title */
      'search_items' => __('Search Resources', 'sfvpntheme'), /* Search Custom Type Title */
      'not_found' =>  __('Nothing found in the Database.', 'sfvpntheme'), /* This displays if there are no entries yet */
      'not_found_in_trash' => __('Nothing found in Trash', 'sfvpntheme'), /* This displays if there is nothing in the trash */
      'parent_item_colon' => ''
      ), /* end of arrays */
      'public' => true,
      'publicly_queryable' => true,
      'exclude_from_search' => false,
      'show_ui' => true,
      'query_var' => true,
      'show_in_admin_bar' => true,
      'menu_position' => 6, /* this is what order you want it to appear in on the left hand side menu */
      'menu_icon' => 'dashicons-clipboard', /* the icon for the custom post type menu */
      'has_archive' => true, /* you can rename the slug here */
      'rewrite'     => ['slug' => 'resources'],
      'capability_type' => 'page',
      'hierarchical' => true,
      /* the next one is important, it tells what's enabled in the post editor */
      'supports' => array( 'title', 'page-attributes', 'excerpt', 'comments', 'thumbnail' )
    ) /* end of options */
  ); /* end of register post type */

}

add_action( 'init', 'sfvpn_resources');

register_taxonomy( 'resources_category',
    	array('resources'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
    	array('hierarchical' => true,    /* if this is false, it acts like tags */
    		'labels' => array(
    			'name' => __( 'Resource Types', 'neurovisiontheme' ), /* name of the custom taxonomy */
    			'singular_name' => __( 'Resource Type', 'neurovisiontheme' ), /* single taxonomy name */
    			'search_items' =>  __( 'Search Resource Types', 'neurovisiontheme' ), /* search title for taxomony */
    			'all_items' => __( 'All Resource Types', 'neurovisiontheme' ), /* all title for taxonomies */
    			'parent_item' => __( 'Parent Resource Type', 'neurovisiontheme' ), /* parent title for taxonomy */
    			'parent_item_colon' => __( 'Parent Resource Type:', 'neurovisiontheme' ), /* parent taxonomy title */
    			'edit_item' => __( 'Edit Resource Type', 'neurovisiontheme' ), /* edit custom taxonomy title */
    			'update_item' => __( 'Update Resource Type', 'neurovisiontheme' ), /* update title for taxonomy */
    			'add_new_item' => __( 'Add New Resource Type', 'neurovisiontheme' ), /* add new title for taxonomy */
    			'new_item_name' => __( 'New Resource Type Name', 'neurovisiontheme' ) /* name title for taxonomy */
    		),
    		'show_admin_column' => true,
    		'show_ui' => true,
    		'query_var' => true,
        'has_archive' => true,
        'rewrite'           => array( 'slug' => 'resources/category' ),
    	)
    );

function ocn_survey() {
  // creating (registering) the custom type
  register_post_type( 'survey', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
    // let's now add all the options for this post type
    array('labels' => array(
      'name' => __('Surveys', 'sfvpntheme'), /* This is the Title of the Group */
      'singular_name' => __('Survey', 'sfvpntheme'), /* This is the individual type */
      'all_items' => __('All Surveys', 'sfvpntheme'), /* the all items menu item */
      'add_new' => __('Add New Survey', 'sfvpntheme'), /* The add new menu item */
      'add_new_item' => __('Add New Survey', 'sfvpntheme'), /* Add New Display Title */
      'edit' => __( 'Edit', 'sfvpntheme' ), /* Edit Dialog */
      'edit_item' => __('Edit Survey', 'sfvpntheme'), /* Edit Display Title */
      'new_item' => __('New Survey', 'sfvpntheme'), /* New Display Title */
      'view_item' => __('View Survey', 'sfvpntheme'), /* View Display Title */
      'search_items' => __('Search Surveys', 'sfvpntheme'), /* Search Custom Type Title */
      'not_found' =>  __('Nothing found in the Database.', 'sfvpntheme'), /* This displays if there are no entries yet */
      'not_found_in_trash' => __('Nothing found in Trash', 'sfvpntheme'), /* This displays if there is nothing in the trash */
      'parent_item_colon' => ''
      ), /* end of arrays */
      'public' => false,
      'publicly_queryable' => false,
      'exclude_from_search' => true,
      'show_ui' => true,
      'query_var' => true,
      'show_in_admin_bar' => true,
      'menu_position' => 6, /* this is what order you want it to appear in on the left hand side menu */
      'menu_icon' => 'dashicons-location-alt', /* the icon for the custom post type menu */
      'has_archive' => true, /* you can rename the slug here */
      'rewrite'     => ['slug' => 'survey-audits'],
      'capability_type' => 'post',
      'hierarchical' => false,
      /* the next one is important, it tells what's enabled in the post editor */
      'supports' => array( 'title')
    ) /* end of options */
  ); /* end of register post type */

}

add_action( 'init', 'ocn_survey');


register_taxonomy( 'resources_day',
    	array('resources'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
    	array('hierarchical' => false,    /* if this is false, it acts like tags */
    		'labels' => array(
    			'name' => __( 'Activity Days', 'neurovisiontheme' ), /* name of the custom taxonomy */
    			'singular_name' => __( 'Activity Day', 'neurovisiontheme' ), /* single taxonomy name */
    			'search_items' =>  __( 'Search Activity Days', 'neurovisiontheme' ), /* search title for taxomony */
    			'all_items' => __( 'All Activity Days', 'neurovisiontheme' ), /* all title for taxonomies */
    			'parent_item' => __( 'Parent Activity Day', 'neurovisiontheme' ), /* parent title for taxonomy */
    			'parent_item_colon' => __( 'Parent Activity Day:', 'neurovisiontheme' ), /* parent taxonomy title */
    			'edit_item' => __( 'Edit Activity Day', 'neurovisiontheme' ), /* edit custom taxonomy title */
    			'update_item' => __( 'Update Activity Day', 'neurovisiontheme' ), /* update title for taxonomy */
    			'add_new_item' => __( 'Add New Activity Day', 'neurovisiontheme' ), /* add new title for taxonomy */
    			'new_item_name' => __( 'New Activity Day Name', 'neurovisiontheme' ) /* name title for taxonomy */
    		),
    		'show_admin_column' => true,
    		'show_ui' => true,
    		'query_var' => true,
        'has_archive' => true,
        'rewrite'           => array( 'slug' => 'resources/activity_day' ),
    	)
    );

    register_taxonomy( 'resources_frequency',
        	array('resources'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
        	array('hierarchical' => false,    /* if this is false, it acts like tags */
        		'labels' => array(
        			'name' => __( 'Activity Frequency', 'neurovisiontheme' ), /* name of the custom taxonomy */
        			'singular_name' => __( 'Activity Frequency', 'neurovisiontheme' ), /* single taxonomy name */
        			'search_items' =>  __( 'Search Activity Frequency', 'neurovisiontheme' ), /* search title for taxomony */
        			'all_items' => __( 'All Activity Frequency', 'neurovisiontheme' ), /* all title for taxonomies */
        			'parent_item' => __( 'Parent Activity Frequency', 'neurovisiontheme' ), /* parent title for taxonomy */
        			'parent_item_colon' => __( 'Parent Activity Frequency:', 'neurovisiontheme' ), /* parent taxonomy title */
        			'edit_item' => __( 'Edit Activity Frequency', 'neurovisiontheme' ), /* edit custom taxonomy title */
        			'update_item' => __( 'Update Activity Frequency', 'neurovisiontheme' ), /* update title for taxonomy */
        			'add_new_item' => __( 'Add New Activity Frequency', 'neurovisiontheme' ), /* add new title for taxonomy */
        			'new_item_name' => __( 'New Activity Frequency Name', 'neurovisiontheme' ) /* name title for taxonomy */
        		),
        		'show_admin_column' => true,
        		'show_ui' => true,
        		'query_var' => true,
            'has_archive' => true,
            'rewrite'           => array( 'slug' => 'resources/activity_frequency' ),
        	)
        );
?>

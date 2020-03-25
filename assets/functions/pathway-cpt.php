<?php

/**
 * CPT for generating Pathway Reports from organisations / activities / resources
 */

 function sfvpn_pathway() {
   // creating (registering) the custom type
   register_post_type( 'pathway', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
     // let's now add all the options for this post type
     array('labels' => array(
       'name' => __('Pathway Reports', 'sfvpntheme'), /* This is the Title of the Group */
       'singular_name' => __('Pathway Report', 'sfvpntheme'), /* This is the individual type */
       'all_items' => __('All Pathway Reports', 'sfvpntheme'), /* the all items menu item */
       'add_new' => __('Add New Pathway Report', 'sfvpntheme'), /* The add new menu item */
       'add_new_item' => __('Add New Pathway Report', 'sfvpntheme'), /* Add New Display Title */
       'edit' => __( 'Edit', 'sfvpntheme' ), /* Edit Dialog */
       'edit_item' => __('Edit Pathway Report', 'sfvpntheme'), /* Edit Display Title */
       'new_item' => __('New Pathway Report', 'sfvpntheme'), /* New Display Title */
       'view_item' => __('View Pathway Report', 'sfvpntheme'), /* View Display Title */
       'search_items' => __('Search Pathway Reports', 'sfvpntheme'), /* Search Custom Type Title */
       'not_found' =>  __('Nothing found in the Database.', 'sfvpntheme'), /* This displays if there are no entries yet */
       'not_found_in_trash' => __('Nothing found in Trash', 'sfvpntheme'), /* This displays if there is nothing in the trash */
       'parent_item_colon' => ''
       ), /* end of arrays */
       'public' => true,
       'publicly_queryable' => true,
       'exclude_from_search' => true,
       'show_ui' => true,
       'query_var' => true,
       'show_in_admin_bar' => true,
       'menu_position' => 6, /* this is what order you want it to appear in on the left hand side menu */
       'menu_icon' => 'dashicons-analytics', /* the icon for the custom post type menu */
       'has_archive' => false, /* you can rename the slug here */
       'rewrite'     => ['slug' => 'pathway'],
       'capability_type' => 'post',
       'hierarchical' => false,
       /* the next one is important, it tells what's enabled in the post editor */
       'supports' => array( 'title', 'thumbnail')
     ) /* end of options */
   ); /* end of register post type */

 }

 add_action( 'init', 'sfvpn_pathway');

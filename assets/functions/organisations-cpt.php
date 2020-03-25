<?php

/**
 * Organisations CPT for list support organisations
 */

function pathway20_organisations() {
  // creating (registering) the custom type
  register_post_type( 'organisations', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
    // let's now add all the options for this post type
    array('labels' => array(
      'name' => __('Organisations', 'pathway20'), /* This is the Title of the Group */
      'singular_name' => __('Organisation', 'pathway20'), /* This is the individual type */
      'all_items' => __('All Organisations', 'pathway20'), /* the all items menu item */
      'add_new' => __('Add New Organisation', 'pathway20'), /* The add new menu item */
      'add_new_item' => __('Add New Organisation', 'pathway20'), /* Add New Display Title */
      'edit' => __( 'Edit', 'pathway20' ), /* Edit Dialog */
      'edit_item' => __('Edit Organisation', 'pathway20'), /* Edit Display Title */
      'new_item' => __('New Organisation', 'pathway20'), /* New Display Title */
      'view_item' => __('View Organisation', 'pathway20'), /* View Display Title */
      'search_items' => __('Search Organisations', 'pathway20'), /* Search Custom Type Title */
      'not_found' =>  __('Nothing found in the Database.', 'pathway20'), /* This displays if there are no entries yet */
      'not_found_in_trash' => __('Nothing found in Trash', 'pathway20'), /* This displays if there is nothing in the trash */
      'parent_item_colon' => ''
      ), /* end of arrays */
      'public' => true,
      'publicly_queryable' => true,
      'exclude_from_search' => false,
      'show_ui' => true,
      'query_var' => true,
      'show_in_rest' => true,
      'show_in_admin_bar' => true,
      'menu_position' => 4, /* this is what order you want it to appear in on the left hand side menu */
      'menu_icon' => 'dashicons-networking', /* the icon for the custom post type menu */
      'has_archive' => true, /* you can rename the slug here */
      'rewrite'     => ['slug' => 'organisations'],
      'capability_type' => 'post',
      'hierarchical' => false,
      /* the next one is important, it tells what's enabled in the post editor */
      'supports' => array( 'title', 'thumbnail')
    ) /* end of options */
  ); /* end of register post type */

}

add_action( 'init', 'pathway20_organisations');

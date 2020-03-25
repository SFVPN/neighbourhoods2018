<?php

/**
 * Non public CPT for handling contact details for directory
 */

 function pathway20_contacts() {
   // creating (registering) the custom type
   register_post_type( 'contacts', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
     // let's now add all the options for this post type
     array('labels' => array(
       'name' => __('Contacts', 'pathway20'), /* This is the Title of the Group */
       'singular_name' => __('Contact', 'pathway20'), /* This is the individual type */
       'all_items' => __('All Contacts', 'pathway20'), /* the all items menu item */
       'add_new' => __('Add New Contact', 'pathway20'), /* The add new menu item */
       'add_new_item' => __('Add New Contact', 'pathway20'), /* Add New Display Title */
       'edit' => __( 'Edit', 'pathway20' ), /* Edit Dialog */
       'edit_item' => __('Edit Contact', 'pathway20'), /* Edit Display Title */
       'new_item' => __('New Contact', 'pathway20'), /* New Display Title */
       'view_item' => __('View Contact', 'pathway20'), /* View Display Title */
       'search_items' => __('Search Contacts', 'pathway20'), /* Search Custom Type Title */
       'not_found' =>  __('Nothing found in the Database.', 'pathway20'), /* This displays if there are no entries yet */
       'not_found_in_trash' => __('Nothing found in Trash', 'pathway20'), /* This displays if there is nothing in the trash */
       'parent_item_colon' => ''
       ), /* end of arrays */
       'public' => true,
       'publicly_queryable' => false,
       'exclude_from_search' => true,
       'show_ui' => true,
       'query_var' => true,
       'show_in_admin_bar' => true,
       'menu_position' => 4, /* this is what order you want it to appear in on the left hand side menu */
       'menu_icon' => 'dashicons-id-alt', /* the icon for the custom post type menu */
       'has_archive' => false, /* you can rename the slug here */
       'capability_type' => 'post',
       'hierarchical' => false,
       /* the next one is important, it tells what's enabled in the post editor */
       'supports' => array( 'title', 'thumbnail')
     ) /* end of options */
   ); /* end of register post type */

 }

 add_action( 'init', 'pathway20_contacts');

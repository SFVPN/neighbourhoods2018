<?php

acf_form(array(
  'post_id'		=> 'new_post',
  'post_content' => false,
  'post_title' => false,
  'new_post'		=> array(
    'post_type'		=> 'survey',
    'post_title' => current_time('timestamp'),
    'post_status'		=> 'draft'),
  'return'		=> get_permalink( get_page_by_path( 'thanks' ) ),
  'field_groups' => array('1074'),
  'submit_value'		=> __("Submit your survey", 'acf')
));
?>

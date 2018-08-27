<?php

$group_ID = get_field('group_id', 'option');

acf_form(array(
  'id' => 'survey',
  'post_id'		=> 'new_post',
  'post_content' => false,
  'post_title' => false,
  'new_post'		=> array(
    'post_type'		=> 'survey',
    'post_title' => current_time('timestamp'),
    'post_status'		=> 'draft'),
  'return'		=> get_permalink( get_page_by_path( 'thanks' ) ),
  'field_groups' => array($group_ID),
  'submit_value'		=> __("Submit your survey", 'acf')
));
?>

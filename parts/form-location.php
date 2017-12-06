<?php

acf_form(array(
  'post_id'		=> 'new_post',
  'post_content' => false,
  'post_title' => true,
  'new_post'		=> array(
    'post_type'		=> 'audits',
    'post_status'		=> 'draft'),
  'return'		=> home_url(),
  'fields' => array('field_59f8aa752b9b9', 'field_59f8a8282855c'),
  'submit_value'		=> __("Submit", 'acf'),
));
?>

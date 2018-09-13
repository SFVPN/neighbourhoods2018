<?php

the_content();

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
  'submit_value'		=> __("Submit your survey", 'acf'),
  'html_submit_button'	=> '<input type="submit" id="survey_submit" class="acf-button button button-primary button-large" value="%s" /><div class="grey darken-3 center col s12 l3" style="position: fixed; left: 0; right: 0; bottom: 0px; padding: 5px 0;">
    <div class="col s6"><input onclick="Materialize.toast(\'Your form data has been cleared\', 4000)" id="clear" class="btn materialize-red" type="reset" value="Clear"></div><div class="col s6"><button class="btn green lighten-1" onclick="Materialize.toast(\'Your form data has been saved\', 4000)" id="save" type="button">Save</button></div></div>'
));
?>

<?php

add_action("wp_ajax_my_user_vote", "my_user_vote");
add_action("wp_ajax_nopriv_my_user_vote", "my_must_login");

function my_user_vote() {

   if ( !wp_verify_nonce( $_REQUEST['nonce'], "my_user_vote_nonce")) {
      exit("No naughty business please");
   }   

   // get array of of currently completed resources IDs using get_field('completed_resources', $_REQUEST["post_id"]) then array_push $_REQUEST["resource_id"] to this and then update_field('completed_resources', array(1,2,5), $_REQUEST["post_id"]);

   $completed = get_field('completed_resources', $_REQUEST["post_id"], false);
   $new_completed = array();
   foreach($completed as $complete) {
	array_push($new_completed, $complete);
   }

   if (in_array($_REQUEST["resource_id"], $new_completed)) {
	
} else {
	array_push($new_completed, $_REQUEST["resource_id"]);

}
   update_field('completed_resources', $new_completed, $_REQUEST["post_id"] );

   $vote_count = get_post_meta($_REQUEST["post_id"], "votes", true);
   //$vote_count = ($vote_count == ’) ? 0 : $vote_count;
   $new_vote_count = $vote_count + 1;

   $vote = update_post_meta($_REQUEST["post_id"], "votes", $new_vote_count);

   if($vote === false) {
      $result['type'] = "error";
      $result['vote_count'] = $vote_count;
   }
   else {
      $result['type'] = "success";
      $result['vote_count'] = $new_vote_count;
   }

   if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
      $result = json_encode($result);
      echo $result;
   }
   else {
      header("Location: ".$_SERVER["HTTP_REFERER"]);
   }

   die();

}

function my_must_login() {
   echo "You must log in to vote";
   die();
}

add_action("wp_ajax_remove_complete", "remove_complete");

function remove_complete() {

   if ( !wp_verify_nonce( $_REQUEST['nonce'], "remove_complete_nonce")) {
      exit("No naughty business please");
   }   

   // get array of of currently completed resources IDs using get_field('completed_resources', $_REQUEST["post_id"]) then array_push $_REQUEST["resource_id"] to this and then update_field('completed_resources', array(1,2,5), $_REQUEST["post_id"]);

   $completed = get_field('completed_resources', $_REQUEST["post_id"], false);
   $new_completed = array();
   foreach($completed as $complete) {
	array_push($new_completed, $complete);
   }

   if (in_array($_REQUEST["resource_id"], $new_completed)) {
	
	$unset = array_search($_REQUEST["resource_id"], $new_completed);
	unset($new_completed[$unset]);

}
   update_field('completed_resources', $new_completed, $_REQUEST["post_id"] );

   $vote_count = get_post_meta($_REQUEST["post_id"], "votes", true);
   //$vote_count = ($vote_count == ’) ? 0 : $vote_count;
   $new_vote_count = $vote_count - 1;

   $vote = update_post_meta($_REQUEST["post_id"], "votes", $new_vote_count);

   if($vote === false) {
      $result['type'] = "error";
      $result['vote_count'] = $vote_count;
   }
   else {
      $result['type'] = "success";
      $result['vote_count'] = $new_vote_count;
   }

   if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
      $result = json_encode($result);
      echo $result;
   }
   else {
      header("Location: ".$_SERVER["HTTP_REFERER"]);
   }

   die();

}
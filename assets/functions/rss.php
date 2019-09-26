<?php
/**
 * Add Advanced Custom Field to RSS Feed
 *
 */

 function myfeed_request($qv) {
    if (isset($qv['feed']) && !isset($qv['post_type']))
        $qv['post_type'] = array('post', 'resources');
    return $qv;
}
add_filter('request', 'myfeed_request');

 function fields_in_feed($content) {
 	// check for rows (parent repeater)
	// $post_id = get_the_ID();
	// $email;
	// $phone;


     if(is_feed()) {
        $post_id = get_the_ID();
        $organiser = get_post_meta($post_id, "organiser", true);
        if($organiser) {
        $organiser = get_the_title($organiser[0]);
       }



         $group_details = get_post_meta($post_id, 'section_0_blocks_0_group_details', true);
         $description = get_post_meta($post_id, 'section_0_blocks_0_activity_group_details_activity_description', true);
         $group_description = get_post_meta($post_id, 'section_0_blocks_0_group_details_group_description', true);
				 $contact = get_post_meta($post_id, 'section_0_blocks_0_activity_group_details_group_contact', true);
				 $email = get_post_meta($post_id, 'section_0_blocks_0_activity_group_details_group_email', true);
				 $phone = get_post_meta($post_id, 'section_0_blocks_0_activity_group_details_group_phone', true);
				 $address = get_post_meta($post_id, 'section_0_blocks_0_activity_group_details_activity_address_name', true);
         //$freq = get_post_meta($post_id, 'section_0_blocks_0_activity_group_details_activity_frequency_select', true);
         $pos = get_post_meta($post_id, 'section_0_blocks_0_activity_group_details_activity_frequency_month', true);

         $freq = get_the_terms( $post_id, 'resources_frequency' );
         $days = get_the_terms( $post_id, 'resources_day' );



         if($organiser) {
           $output .= '<p><strong>Organiser:</strong> ' . $organiser . ' </p>';
         }

         if($freq) {
           $output .= '<p><strong>Frequency:</strong> ' . $freq[0]->name . ' on ';
           $newpos = array();
           if(count($pos) > 1) {

             foreach($pos as $p) {
               if($p == 1) {
                 $newpos[] = $p . 'st';
               } elseif($p == 2) {
                 $newpos[] = $p . 'nd';
               } elseif($p == 3) {
                 $newpos[] = $po . 'rd';
               } else {
                 $newpos[] = $p . 'th';
               }
             }
             $output .= implode(" and ", $newpos);
           } elseif(count($pos) == 1) {
             $output .= $pos[0];
           }
           if($days) {
             $output .= ' ' . $days[0]->name . ' ';
           }
           $output .= '</p>';
         }

         if($contact) {
           $output .= '<p><strong>Contact:</strong> ' . $contact . ' </p>';
         }

         if($email) {
           $output .= '<p><strong>Email:</strong><a href="' . $email . '">' . $email . ' </a></p>';
         }

         if($phone) {
           $output .= '<p><strong>Phone:</strong> ' . $phone . ' </p>';
         }

         if($description) {
           $output .= '<p><strong>Description:</strong> ' . $description . '</p>';
         }

         if($group_description) {
           $output .= '<p> ' . $group_description . '</p>';
         }

         //$output .= '</div>';

         $content = $content.$output;
     }
     return $content;
 }
 add_filter('the_content','fields_in_feed');

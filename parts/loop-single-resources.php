<?php //$parent_id = wp_get_post_parent_id( $post_ID );
//$parent_title = get_the_title($parent_id);
$queried_object = get_queried_object();
$terms = get_the_terms( $queried_object->id, 'resources_category' );
//$days = get_the_terms( $queried_object->id, 'resources_day' );
if($queried_object->post_parent != 0 ) {
	//$terms = get_the_terms( $queried_object->id, 'resources_category' );
	$guide = get_the_title($queried_object->post_parent);
}

 // storing this so we have it available in the other loops
?>
<article id="post-<?php the_ID(); ?>" class="<?php echo $post->post_name;?>" role="article"
<?php if( has_term( 'support-organisations', 'resources_category' ) ) {
echo 'itemscope itemtype="http://schema.org/Organization"';
} else {
	echo 'itemscope itemtype="http://schema.org/WebPage"';
}?>
>
	<header class="article-header col s12 center">

		<h1 class="h2 resource-title"
		<?php if( has_term( 'support-organisations', 'resources_category' ) ) {
		echo 'itemprop="name"';
		} else {
			echo 'itemprop="headline"';
		}?>
		><?php the_title();?></h1>
		<?php

		if(is_user_logged_in()) {
			//get_template_part( 'parts/content', 'edit' );
		}
		?>
		<?php




		// echo '<span class="terms block" style="padding-bottom: 2rem;"><i class="mdi mdi-information"></i> This is part of the <em>' . $guide . '</em> guide';
		echo '<div class="resources-meta">';

		if($terms) {
			echo '<i class="mdi mdi-tag-multiple"></i> ';
			foreach ($terms as $term) {
				if ($term->parent === 0) {
						echo '<a href="' . get_term_link($term->term_id) . '" class="chip">' . $term->name . '</a>';
				} else {
					echo '<a href="' . get_term_link($term->term_id) . '" class="chip">' . $term->name . '</a>';
				}
			}
		}

		if($queried_object->post_parent === 0 ) {
				echo '<br /><i class="mdi mdi-information"></i>' . __( 'Last updated on ', 'ocn' ) . get_the_modified_time('F j, Y') . '</span></div>';
		} else {
				echo '<br /><i class="mdi mdi-information"></i>' . __( ' This page is part of the ', 'ocn' ) . '<strong>' . $guide . '</strong>' . __( ' guide and was last updated on ', 'ocn' ) . get_the_modified_time('F j, Y') . '</span></div>';
		}


		//get_template_part( 'parts/content', 'byline' );
		get_template_part( 'parts/content', 'share' );

		 ?>


	</header> <!-- end article header -->

<?php


if ( $post->post_parent === 0 ) {

	$args = array(
			'post_type'      => 'resources',
			'posts_per_page' => -1,
			'post_parent'    => $post->ID,
			'order'          => 'ASC',
			'orderby'        => 'menu_order'
	 );


	$parent = new WP_Query( $args );

	if ( $parent->have_posts() ) :
		//echo '<div class="col s12 m12 grey lighten-4 index-wrapper">';
	$pages = array($post->ID );
		?>

		<div class="col guide-wrapper grey lighten-4">

			<ol id="guide-contents">
				<li id="parent-<?php the_ID(); ?>" class="parent">

						<?php echo '<span class="active-page">' . get_the_title() . '</span>'; ?>

				</li>

			<?php while ( $parent->have_posts() ) : $parent->the_post();
$pages[] += get_the_ID();
			?>

					<li id="parent-<?php the_ID(); ?>">

							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>

					</li>


			<?php endwhile;

			 ?>
		 </ol>
</div>
	<?php endif; wp_reset_postdata();
//echo '</div>';
} else {
//echo '<div class="col s12 m12 grey lighten-4 parent-page">';
		$args = array(
				'post_type'      => 'resources',
				'posts_per_page' => -1,
				'post_parent'    => $post->post_parent,
				'order'          => 'ASC',
				'orderby'        => 'menu_order'
		 );


		$parent = new WP_Query( $args );

		if ( $parent->have_posts() ) :
		$queried_object = get_queried_object();
		$ID = $queried_object->ID;?>
				<details class="col">
					<summary>
						<?php echo __( 'Click to view full contents of the ', 'ocn' ) . get_the_title($post->post_parent) . __( ' guide', 'ocn' );?>
					</summary>

					<ol id="guide-contents">
				<li class="parent">
					<a href="<?php the_permalink($post->post_parent); ?>" title="<?php the_title(); ?>"><?php echo get_the_title($post->post_parent); ?></a>
				</li>

				<?php while ( $parent->have_posts() ) : $parent->the_post();

					if ($ID === get_the_ID()){?>
						<li id="parent-<?php the_ID(); ?>">

									<?php echo '<span class="active-page">' . get_the_title() . '</span>'; ?>

						</li>

				<?php	} else {?>
					<li id="parent-<?php the_ID(); ?>">

							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>

					</li>

				<?php }?>


				<?php endwhile; ?>
			</ol>
			</details>
		<?php endif; wp_reset_postdata();
		//echo '</div>';
}

		$show_toc = get_field('show_toc');
		if ($show_toc):
		//	echo '<div class="col s12 m12 grey lighten-4 index-wrapper">';
		//check if the repeater field has rows of data
		 if( have_rows('section') ):


			//  foreach($rows as $row)
			// {
			// 	echo '<h2 class="green">' . $row['heading'] . '</h2>';
			// }


		  	// loop through the rows of data
		     while ( have_rows('section') ) : the_row();

		         // display a sub field 'value'
						 if( have_rows('blocks') ):
						echo '<div class="col grey lighten-4 index-wrapper"><ol id="toc">
						<li class="block label black-text">' . __( 'What\'s on this page?', 'ocn' ) . '</li>';
	     // loop through the rows of data
	    while ( have_rows('blocks') ) : the_row();

	        if( get_row_layout() == 'heading_block' ):

	        	echo '<li><a class="toc-' . get_sub_field('heading_size') . '" href="#heading-' . get_row_index() . '">' . get_sub_field('heading') . '</a></li>';

	        endif;



	    endwhile;
			echo '</ol></div>';
	else :

	    // no layouts found

	endif;

		     endwhile;

		 else :

		     // no rows found

		 endif;
	//	 echo '</div>';
		endif;

		 ?>


<section class="entry-content col s12" itemprop="articleBody">

	<?php $featImage = get_the_post_thumbnail_url(get_the_ID(),'full');
				if($featImage) {
					echo '<img class="print-image hide" src="' . $featImage . '" />';
				}
	?>

	 <!-- flexible content -->
	 <?php

	 // check if the repeater field has rows of data
	 if( have_rows('section') ):


		//  foreach($rows as $row)
		// {
		// 	echo '<h2 class="green">' . $row['heading'] . '</h2>';
		// }


	  	// loop through the rows of data
	     while ( have_rows('section') ) : the_row();

	         // display a sub field value
					 if( have_rows('blocks') ):
						 $rows = get_field('heading_block');
						 //print_R($rows);
     // loop through the rows of data
    while ( have_rows('blocks') ) : the_row();
        if( get_row_layout() == 'heading_block' ):

							echo '<' . get_sub_field('heading_size') . ' id="heading-' . get_row_index() . '">' . get_sub_field('heading') . '</' . get_sub_field('heading_size') . '>';



        endif;


				if( get_row_layout() == 'text_block' ):

        	echo '<div class="content_block">' . get_sub_field('content') . '</div>';

        endif;

				if( get_row_layout() == 'video_block' ):

					echo '<div class="video-container">' . get_sub_field('video_url') . '</div>';

        	echo '<div class="content_block center grey lighten-4">' . get_sub_field('video_caption') . '</div>';

        endif;

				if( get_row_layout() == 'note_block' ):
					$note_type = get_sub_field('note_type');

							echo '<div class="row ' . $note_type['value'] . '"><div class="col s12 note-heading grey darken-3 white-text"><i class="material-icons left">' . $note_type['value'] . '</i><strong>' . get_sub_field('note_heading') . '</strong></div> <div  class="col s12 note-content grey lighten-4">' . get_sub_field('note');

							if( have_rows('note_upload') ):

							 	// loop through the rows of data
							    while ( have_rows('note_upload') ) : the_row();

							        $file_link = get_sub_field('file_source');
											$file_type = $file_link['mime_type'];

											echo '<a class="block" href="' . $file_link['url'] . '"><i class="material-icons left">folder</i>Download ' . $file_link['title'] . '</a>';


							    endwhile;

							else :

							    // no rows found

							endif;

							if( have_rows('note_link') ):

							 	// loop through the rows of data
							    while ( have_rows('note_link') ) : the_row();

											echo '<a class="block" href="' . get_sub_field('link_url') . '"><i class="material-icons left">arrow_forward</i>' . get_sub_field('link_text') . '</a>';


							    endwhile;

							else :

							    // no rows found

							endif;

							echo '</div></div>';






				endif;


				if( get_row_layout() == 'steps_block' ):

					$step_image = get_sub_field('steps_image');
					$step_image_title = sanitize_title($step_image['title']);

					if($step_image) {
						if( have_rows('step') ):

							echo '<div class="row steps_block blue lighten-4"><div class="col s12 l5">
							<figure class="card grey darken-4">
								<div class="image-wrapper">
									<img src="' . $step_image['url'] . '" alt="' . $step_image['alt'] . '"/>';

									while ( have_rows('step') ) : the_row();
										$leftPos = get_sub_field('left_pos');
										$topPos = get_sub_field('top_pos');

										if($leftPos) {
											$rowIndex = get_row_index();
											echo '<span class="block image-marker" style="position: absolute; top:' . $topPos . '%; left:' . $leftPos . '%" id="' . $step_image_title . '-marker' . $rowIndex . '"aria-describedby="' . $step_image_title . '-' . $rowIndex . '">' . $rowIndex .  '</span>';
										}

									endwhile;

								echo '</div>

							<figcaption class="white-text">
							<i class="material-icons left">info</i>' . $step_image['caption'] . '
							</figcaption>
							</figure>

							</div>
							<ol class="steps col s12 l7">';
							// loop through the rows of data
								while ( have_rows('step') ) : the_row();

									echo '<li id="' . $step_image_title . '-' . get_row_index() . '">' . get_sub_field('step_description') .  '</li>';



								endwhile;

								echo '</ol>';

						else :

								// no rows found

				endif; // end steps block

					} else {
				// check if the repeater field has rows of data
				if( have_rows('step') ):

					echo '<div class="row steps_block"><ol class="steps">';
				 	// loop through the rows of data
				    while ( have_rows('step') ) : the_row();

							echo '<li>' . get_sub_field('step_description') .  '</li>';



				    endwhile;

						echo '</ol>';

				else :

				    // no rows found

endif; // end steps block
}
echo '</div>';
endif;


if( get_row_layout() == 'recommendation_block' ):

	$block_title = get_sub_field('block_title');
// check if the repeater field has rows of data
if( have_rows('recommendation_add') ):

	echo '<div class="row recommendation"><div class="col s12 note-heading grey darken-3 white-text"><i class="material-icons left">done_all</i><strong>' . $block_title . '</strong></div> <div  class="col center s12 note-content grey lighten-4">';
 	// loop through the rows of data
    while ( have_rows('recommendation_add') ) : the_row();

        $rec_link = get_sub_field('recommended_product_guide');
				$rec_desc = get_sub_field('recommended_product_description');
				$rec_product_logo = get_sub_field('recommended_product_logo');
				$rec_name = get_sub_field('recommended_product_name');

				echo '<div class="col s12 l3">';
				if($rec_link) {
					echo '<div><a class="block product_link" href="' . $rec_link . '" data-note="View the guide to using ' . $rec_name . '">' . $rec_name . '</a></div>';
				} else {
						echo '<div><span class="block product_link">' . $rec_name . '</span></div>';
				}

				if($rec_product_logo) {
					echo '<img src="' . $rec_product_logo . '" />';
				}

				if($rec_desc) {
					echo '<p>' . $rec_desc . '</p>';
				}


				echo '</div>';

    endwhile;

else :

    // no rows found

endif;
echo '</div></div>';
endif;


if( get_row_layout() == 'available_platforms' ):

	$overview_title = get_sub_field('overview_title');
// check if the repeater field has rows of data


	echo '<div class="content_block">';
 	// loop through the rows of data


        $link = get_sub_field('platform_link');
				$link_text = get_sub_field('platform_link_text');
				$platforms = get_sub_field('product_platforms');
				$platform_text = get_sub_field('platform_text');

				if($platform_text) {
					echo '<p>' . __( $platform_text, 'ocn' ) . '</p>';
				}


				if($platforms)  {
						echo '<div class="grey lighten-4 platforms"><ul>';
						foreach ($platforms as $platform) {
							if($platform['value'] === 'web') {
								echo '<li>
								<span class="mdi mdi-web"></span> Web
								</li>';
							}
							if($platform['value'] === 'android') {
								echo '<li>
								<span class="mdi mdi-android"></span> Android
								</li>';
							}
							if($platform['value'] === 'ios') {
								echo '<li>
								<span class="mdi mdi-apple-ios"></span> iOS
								</li>';
							}
							if($platform['value'] === 'desktop') {
								echo '<li>
								<span class="mdi mdi-desktop-mac"></span> Desktop
								</li>';
							}
						}

						echo '</ul>';

						if($link) {
							echo '<a class="block center product_link" href="' . $link . '" data-note="This link takes you to an external website">' . $link_text . '</a>';
						}
				echo '</div>';
				}


echo '</div>';
endif;


				if( get_row_layout() == 'image_block' ):
					$markers_desc = [];
					$emptyArray = [[]];
					echo '<div class="row grey lighten-3 image_guide">';
					echo '<div class="pink col s6 image_wrapper" style="position: relative;">';
					echo '<figure class="card"><img src="' . get_sub_field('image') . '" />
					<figcaption class="grey lighten-4"><i class="material-icons left">camera_alt</i>' . get_sub_field('caption') . '</figcaption></figure>';

					if( have_rows('markers') ):
							echo '<button class="btn-flat info markers" style="position: absolute;" data-id="marker-intro"><i class="material-icons">error_outline</i></button>';

					 	// loop through the rows of data
					    while ( have_rows('markers') ) : the_row();
								$marker_ID = get_sub_field('left_position') * get_row_index();
								$marker_desc[] = '<li id="marker-' . $marker_ID . '"><span class="block h6">Step ' . get_row_index() . '</span>' . get_sub_field('marker_description') . '</li>';
								echo '<button class="btn-floating small markers" style="position: absolute; left: ' . get_sub_field('left_position') . '%; top:' . get_sub_field('top_position') . '%;" data-id="marker-' . $marker_ID . '"><i class="material-icons">add</i></button>';

					    endwhile;

							else :

					    // no rows found

					endif; // end markers
					echo '</div>';

					if($marker_desc) {
						echo '<ul class="marker-desc col s6"><li id="marker-intro" class="intro-desc active-desc"><span class="block h6">Guide</span>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in" voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
						</li>';
						foreach ($marker_desc as $key=>$value) {
								echo $value;
						}
						echo '</ul>';
					}

					echo '</div>';
				endif;

    endwhile;

else :

    // no layouts found

endif;

	     endwhile;

	 else :

	     // no rows found

	 endif;

	 ?>

	<?php

// New activities fields moved out from flexible content

// check if the group field has rows of data


	  $activity = get_field('activity');
		$activity_des = $activity['activity_description'];

		if($activity_des):
			$contacts = $activity['activity_contact'];
			$calendar = get_field('group_activities');

			echo $activity_des;

			if($contacts) {
				//$contact_details = get_field('group_details', $contacts[0]);
				//$title = get_the_title($contact[0]);
				echo '<div id="contact-box" class="grey lighten-3">';
				echo '<h2 class="h5">Contact</h2>';

				foreach($contacts as $contact) {
				$contact_details = get_field('group_details', $contact);
				$title = get_the_title($contact);

				echo '<div class="cb-grid"><span class="block contact-title">' . $title . '</span>';
				echo '<span class="block"><i class="material-icons tiny left">phone</i>' . $contact_details['group_phone'] . '</span>';
				echo '<span class="block"><i class="material-icons tiny left">mail</i><a href="mailto:' . $contact_details['group_email'] . '">Email ' . $title . '</a></span>';
				echo '<span class="block"><i class="material-icons tiny left">launch</i><a href="' . $contact_details['group_website'] . '">Visit Website</a></span>
				</div>';

				}
				//echo '<span class="block"><i class="material-icons left">info</i>' . $contact_details['map_address']['address'] . '</span>';
				//echo '<a href="' . get_the_permalink($contact[0]) . '" class="btn profile-link">View ' . $title . ' Profile</a>';
				echo '</div>';

			}

			if($calendar) {
				$title = get_the_title();
				echo '<div class="activity-calendar"><button onclick="openFullOcn()" class="btn purple darken-1" id="fullCalendar" data-organisation="' . implode(",",$calendar) . '">' . __( 'View The ', 'ocn' ) . implode(" + ",$calendar) . __( ' Activities Calendar', 'ocn' ) . '</button></div>';
			}

		endif;

		$details = get_field('group_details');

		$group_contact = $details['group_contact'];

		if($group_contact):

	 	echo '<div class="row activities">';
	  	// loop through the rows of data

			//	echo '<h2 class="h5">' . __( $details['label'], 'ocn' ) . '</h2>';


	    // while ( have_rows('group_details') ) : the_row();


	        $group_description = $details['group_description'];
					$group_activities = get_field('group_activities');
	 				$group_contact = $details['group_contact'];
	 				$group_email = $details['group_email'];
	 				$group_phone = $details['group_phone'];
	 				$formatted_phone = explode(" ", $group_phone);
	 				$formatted_phone = implode("-", $formatted_phone);
	 				$group_address_street = $details['group_address_street'];
	 				$group_address_second = $details['group_address_second'];
	 				$group_address_town = $details['group_address_town'];
	 				$group_address_zip = $details['group_address_postcode'];
	 				$group_website = $details['group_website'];
	 				$group_twitter = $details['group_twitter'];
	 				$group_facebook = $details['group_facebook'];
	 				$group_map = $details['map_address'];
	 				$map_key = get_field('api_key', 'option');
	 				$group_name = get_the_title();


	 				if($group_description) {
	 					echo '<p>' . __( $group_description, 'ocn' ) . '</p>';
	 				}



	 				echo '<div class="group-contact col s12 no-pad"><div class="note-heading grey darken-3 white-text"><i class="material-icons left">contact_phone</i><strong>' . __( 'Contact Information', 'ocn' ) .'</strong></div> <div class="note-content grey lighten-4"><span class="label-resources block">' . __( 'Main Contact', 'ocn' ) . '</span>';




	 				if($group_contact) {
	 					echo '<span class="block"><i aria-hidden="true" class="mdi mdi-account"></i>' . $group_contact . '</span>';
	 				}

	 				if($group_email) {
	 					echo '<a class="block" href="mailto:' . $group_email . '"><i aria-hidden="true" class="mdi mdi-email"></i>' . __( 'Email ', 'ocn' ) . $group_name . '</a>';
	 				}

	 				if($group_phone) {
	 					echo '<span class="block"><i aria-hidden="true" class="mdi mdi-phone"></i>' . __( 'Phone: ', 'ocn' ) . '<a class="phone" href="tel:' . $formatted_phone . '">' . $group_phone . '</a></span>';
	 				}

					if($group_website || $group_twitter || $group_facebook) {
					echo '<div class="social-media-links">
									<span class="label-resources block">' . __( 'Online Contact Options', 'ocn' ) . '</span>';
	 					if($group_website) {
	 						echo '<a class="block" href="' . $group_website . '"><i aria-hidden="true" class="mdi mdi-open-in-new"></i>' . $group_name . __( ' website', 'ocn' ) . '</a>';
	 					}

	 					if($group_twitter) {
	 						echo '<a class="block" href="' . $group_twitter . '"><i aria-hidden="true" class="mdi mdi-twitter"></i>' . $group_name . __( ' on Twitter', 'ocn' ) . '</a>';
	 					}

	 					if($group_facebook) {
	 						echo '<a class="block" href="' . $group_facebook . '"><i aria-hidden="true" class="mdi mdi-facebook"></i>' . $group_name . __( ' on Facebook', 'ocn' ) . '</a>';
	 					}
						echo '</div>';
					}

	 				if ($group_map):
						echo '<div class="address-box">';
	 					$group_map_image = 'https://maps.googleapis.com/maps/api/staticmap?center=' . $group_map['lat'] . ',' . $group_map['lng'] . '&zoom=16&size=640x385&maptype=terrain&format=png&visual_refresh=true
	 					&markers=color:0x01a89e%7Csize:mid%7C' . $group_map['lat'] . ',' . $group_map['lng'] . '&key=' . $map_key;
	 					echo '
	 					<span class="label-resources block">' . __( 'Address', 'ocn' ) . '</span><span class="block">' . $group_address_street . ', ';
	 					if($group_address_second) {
	 						echo $group_address_second . ', ';
	 					}
	 					echo  $group_address_town . ' ' . $group_address_zip . '</span>';
	 					echo '<img class="responsive-img map" src="' . $group_map_image . '">
						</div>';

						if($group_activities) {
							$title = get_the_title();
							echo '<div class="group-calendar"><button onclick="openFullOcn()" class="btn purple darken-1" id="fullCalendar" data-organisation="' . $group_activities[0] . '">' . __( 'View The ', 'ocn' ) . $title . __( ' Activities Calendar', 'ocn' ) . '</button></div>';
						}

	 				endif;
					echo '</div>';
	     //endwhile;

	 //else :

	     // no rows found

	// endif;


	 echo '</div></div>';?>

	 <script type="application/ld+json">
	 { "@context" : "http://schema.org",
	   "@type" : "Organization",
	 	"name": "<?php echo $group_name;?>",
	 	"address": {
	     "@type": "PostalAddress",
	     "addressLocality": "<?php echo $group_address_town;?>, UK",
	     "postalCode": "<?php echo $group_address_zip;?>",
	     "streetAddress": "<?php echo $group_address_street;?>"
	   },
	   "email": "<?php echo $group_email;?>",
	   "url" : "<?php echo $group_website;?>",
	   "contactPoint" : [
	     { "@type" : "ContactPoint",
	       "telephone" : "+44-<?php echo $formatted_phone;?>",
	       "contactType" : "office",
	       "areaServed" : "UK"
	     } ] }
	 </script>
<?php endif;?>


</div>
<?php
if (comments_open()){
	comments_template();
}
?>

<script>
function openFullOcn() {
let org = document.getElementById("fullCalendar").getAttribute('data-organisation');
document.getElementById("maincontent").classList.add('cal-print');

_tkf.openFullScreen({path:'/ocnstirling?tags=' +org});

}
</script>
</section>
<div class="print-footer hide">
	This resource is produced by <strong>Our Connected Neighbourhoods</strong><br />
	For more information please visit <a href="<?php echo get_home_url(); ?>"><?php echo get_home_url(); ?></a><br />
	Date printed: <?php echo date("d F, Y");?>
</div>
</article>

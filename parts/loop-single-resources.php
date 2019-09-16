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

		<h1 class="h2 resource-title center"
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


<div class="col s12 m12 grey lighten-4 index-wrapper">
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
//	echo '<div class="col s12 m12 grey lighten-4 index-wrapper">';
	$pages = array($post->ID );
		?>


			<ol id="guide-contents">
				<li class="block label black-text"><?php echo get_the_title() . __( ' guide contents', 'ocn' );?></li>
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
					<ol id="guide-contents">
				<li class="block label black-text"><?php echo get_the_title($post->post_parent) . __( ' guide contents', 'ocn' );?></li>
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

		<?php endif; wp_reset_postdata();
		//echo '</div>';
}

		$show_toc = get_field('show_toc');
		if ($show_toc):
			//echo '<div class="col s12 m12 grey lighten-4 index-wrapper">';
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
						echo '<ol id="toc">
						<li class="block label black-text">' . __( 'What\'s on this page?', 'ocn' ) . '</li>';
	     // loop through the rows of data
	    while ( have_rows('blocks') ) : the_row();

	        if( get_row_layout() == 'heading_block' ):

	        	echo '<li><a class="toc-' . get_sub_field('heading_size') . '" href="#heading-' . get_row_index() . '">' . get_sub_field('heading') . '</a></li>';

	        endif;



	    endwhile;
			echo '</ol>';
	else :

	    // no layouts found

	endif;

		     endwhile;

		 else :

		     // no rows found

		 endif;
		endif;

		 ?>


	</div>

<section class="entry-content col s12" itemprop="articleBody">

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
					$note_url = get_sub_field('note_url');

					if($note_type['value'] === 'tip') {
						echo '<div class="row ' . $note_type['value'] . '"><div class="col s12 note-heading blue darken-4 white-text"><i class="material-icons left">bookmark</i><strong>' . $note_type['label'] . '</strong></div> <div  class="col s12 note-content grey lighten-4">' . get_sub_field('note');
						if($note_url) {
							echo '<a class="block" href="' . $note_url . '"><i class="material-icons left">arrow_forward</i>Click on this link for more information</a>';
						}
						echo '</div></div>';
					}

					if($note_type['value'] === 'required') {
						echo '<div class="row ' . $note_type['value'] . '"><div class="col s12 note-heading blue darken-4 white-text"><i class="material-icons left">assignment_turned_in</i><strong>' . $note_type['label'] . '</strong></div> <div  class="col s12 note-content grey lighten-4">' . get_sub_field('note');
						if($note_url) {
							echo '<a class="block" href="' . $note_url . '"><i class="material-icons left">arrow_forward</i>Click on this link for more information</a>';
						}
						echo '</div></div>';
					}

					if($note_type['value'] === 'warning') {
						echo '<div class="row ' . $note_type['value'] . '"><div class="col s12 note-heading blue darken-4 white-text"><i class="material-icons left">thumb_down</i><strong>' . $note_type['label'] . '</strong></div> <div  class="col s12 note-content grey lighten-4">' . get_sub_field('note');
						if($note_url) {
							echo '<a class="block" href="' . $note_url . '"><i class="material-icons left">arrow_forward</i>Click on this link for more information</a>';
						}
						echo '</div></div>';
					}

					if($note_type['value'] === 'link') {
							echo '<div class="row ' . $note_type['value'] . '"><div class="col s12 note-heading blue darken-4 white-text"><i class="material-icons left">library_books</i><strong>' . $note_type['label'] . '</strong></div> <div  class="col s12 note-content grey lighten-4">' . get_sub_field('note');
							if($note_url) {
								echo '<a class="block" href="' . $note_url . '"><i class="material-icons left">arrow_forward</i>Click on this link for more information</a>';
							}
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

											echo '<a class="block" href="' . get_sub_field('link_url') . '"><i class="material-icons left">link	</i>' . get_sub_field('link_text') . '</a>';


							    endwhile;

							else :

							    // no rows found

							endif;

							echo '</div></div>';
					}

					if($note_type['value'] === 'info') {
							echo '<div class="row ' . $note_type['value'] . '"><div class="col s12 note-heading grey darken-4 white-text"><i class="material-icons left">info</i><strong>' . $note_type['label'] . '</strong></div> <div  class="col s12 note-content grey lighten-4">' . get_sub_field('note');
							if($note_url) {
								echo '<a class="block" href="' . $note_url . '"><i class="material-icons left">arrow_forward</i>Click on this link for more information</a>';
							}
							echo '</div></div>';
					}



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

	echo '<div class="row recommendation"><div class="col s12 note-heading blue darken-4 white-text"><i class="material-icons left">done_all</i><strong>' . $block_title . '</strong></div> <div  class="col center s12 note-content grey lighten-4">';
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


if( get_row_layout() == 'support_groups' ):

	$group_email = get_sub_field('group_email');
	$group_phone = get_sub_field('group_phone');
	$group_details = get_sub_field_object('group_details');

// check if the repeater field has rows of data
if( $group_details ):


	echo '<div class="row activities">';
 	// loop through the rows of data

    while ( have_rows('group_details') ) : the_row();


        $group_description = get_sub_field('group_description');

				$group_contact = get_sub_field('group_contact');
				$group_email = get_sub_field('group_email');
				$group_phone = get_sub_field('group_phone');
				$formatted_phone = explode(" ", $group_phone);
				$formatted_phone = implode("-", $formatted_phone);
				$group_address_street = get_sub_field('group_address_street');
				$group_address_second = get_sub_field('group_address_second');
				$group_address_town = get_sub_field('group_address_town');
				$group_address_zip = get_sub_field('group_address_postcode');
				$group_website = get_sub_field('group_website');
				$group_twitter = get_sub_field('group_twitter');
				$group_facebook = get_sub_field('group_facebook');
				$group_map = get_sub_field('map_address');
				$map_key = get_field('api_key', 'option');
				$group_name = get_the_title();

				echo '<h2 class="h5">' . __( $group_details['label'], 'ocn' ) . '</h2>';
				if($group_description) {
					echo '<p>' . __( $group_description, 'ocn' ) . '</p>';
				}

				echo '<div class="col s12 note-heading blue darken-4 white-text"><i class="material-icons left">info</i><strong>' . __( 'Contact Information', 'ocn' ) .'</strong></div> <div  class="col s12 note-content grey lighten-4">';

				echo '<div class="col s12 l6">';

				echo '<span class="label-resources white-text">' . __( 'Main Contact', 'ocn' ) . '</span>';

				if($group_contact) {
					echo '<span class="block"><i aria-hidden="true" class="mdi mdi-account"></i>' . $group_contact . '</span>';
				}

				if($group_email) {
					echo '<a class="block" href="mailto:' . $group_email . '"><i aria-hidden="true" class="mdi mdi-email"></i>' . __( 'Email ', 'ocn' ) . $group_name . '</a>';
				}

				if($group_phone) {
					echo '<span class="block"><i aria-hidden="true" class="mdi mdi-phone"></i>' . __( 'Phone: ', 'ocn' ) . $group_phone . '</span>';
				}


					if($group_website) {
						echo '<a class="block" href="' . $group_website . '"><i aria-hidden="true" class="mdi mdi-web"></i>' . $group_name . __( ' website', 'ocn' ) . '</a>';
					}

					if($group_twitter) {
						echo '<a class="block" href="' . $group_twitter . '"><i aria-hidden="true" class="mdi mdi-twitter"></i>' . $group_name . __( ' on Twitter', 'ocn' ) . '</a>';
					}

					if($group_facebook) {
						echo '<a class="block" href="' . $group_facebook . '"><i aria-hidden="true" class="mdi mdi-facebook"></i>' . $group_name . __( ' on Facebook', 'ocn' ) . '</a>';
					}


				echo '</div>';

				if ($group_map):
					$group_map_image = 'https://maps.googleapis.com/maps/api/staticmap?center=' . $group_map['lat'] . ',' . $group_map['lng'] . '&zoom=16&size=640x385&maptype=terrain&format=png&visual_refresh=true
					&markers=color:0x01a89e%7Csize:mid%7C' . $group_map['lat'] . ',' . $group_map['lng'] . '&key=' . $map_key;
					echo '<div class="col s12 l6">
					<span class="label-resources white-text">' . __( 'Address', 'ocn' ) . '</span><span class="block">' . $group_address_street . '<br />';
					if($group_address_second) {
						echo $group_address_second . '<br />';
					}
					echo  $group_address_town . ' ' . $group_address_zip . '</span>';
					echo '<span class="label-resources white-text">' . __( 'Map', 'ocn' ) . '</span><img class="responsive-img map" src="' . $group_map_image . '">';
					echo '</div>';
				endif;

    endwhile;

else :

    // no rows found

endif;


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

<?php endif;


if( get_row_layout() == 'local_group_activities' ):


	$group_details = get_sub_field_object('activity_group_details');

// check if the repeater field has rows of data
if( $group_details ):




	echo '<div class="row activities">';
 	// loop through the rows of data

    while ( have_rows('activity_group_details') ) : the_row();

				$activity_start = get_sub_field('activity_start');
				$time_start = get_sub_field('activity_start_time');
				$activity_end = get_sub_field('activity_end');
				$time_end = get_sub_field('activity_end_time');
        $activity_description = get_sub_field('activity_description');
				$activity_frequency = get_sub_field('activity_frequency_select');
				$activity_frequency_month = get_sub_field('activity_frequency_month');
				$activity_day = get_sub_field('activity_day_select');
				$activity_organiser = get_field('organiser');
				$activity_organised_by = get_sub_field('activity_organised_by');
				$activity_contact = get_sub_field('group_contact');
				$activity_email = get_sub_field('group_email');
				$activity_phone = get_sub_field('group_phone');
				$formatted_phone = explode(" ", $activity_phone);
				$formatted_phone = implode("-", $formatted_phone);
				$activity_address_street = get_sub_field('activity_address_street');
				$activity_address_name = get_sub_field('activity_address_name');
				$activity_address_town = get_sub_field('activity_address_town');
				$activity_address_zip = get_sub_field('activity_address_postcode');
				$contact_map = get_sub_field('map_address');
				$map_key = get_field('api_key', 'option');

				if($activity_description) {
					echo '<p>' . $activity_description . '</p>';
				}

				echo '<div class="col s12 note-heading blue darken-4 white-text"><i class="material-icons left">event_note</i><strong>' . __( $group_details['label'], 'ocn' )  . '</strong></div> <div  class="col s12 note-content grey lighten-4">';

				echo '<div class="col s12 l6">
								<span class="label-resources white-text">' . __( 'Days', 'ocn' ) . '</span><span class="block">';




				if($activity_frequency->slug == "monthly") {

					echo __( 'This is held on ', 'ocn' );
					if(count($activity_frequency_month) == 1) {
						echo __( 'the ', 'ocn' ) . __( $activity_frequency_month[0]['label'], 'ocn' ) . ' ';
						$oftValNew = $activity_frequency_month[0]['value'];
					} else {
						$oft = [];
						$oftVal = [];
						foreach($activity_frequency_month as $int) {
							$oft[] = $int['label'];
							$oftVal[] = $int['value'];
							$oftNew = implode(" and ", $oft);
							$oftValNew = implode(',', $oftVal);
						}
						echo __( 'the ', 'ocn' ) . __( $oftNew, 'ocn' ) . ' ';
					}

					if(count($activity_day) < 5) {
				//	echo __( 'This is held ', 'ocn' ) . __( $activity_frequency->slug, 'ocn' ) . __( ' on ', 'ocn' );

						foreach($activity_day as $day) {
							$intervalNew[] = $day->name;
							$interval[] = $day->slug;
						}
						echo implode(" and ", $intervalNew);
						$frequency_interval = implode(",", $interval);
						echo __( ' of the month', 'ocn' );
					}

				} elseif($activity_frequency->slug == "weekly") {
					$interval = [];
					$intervalNew = [];
					if(count($activity_day) < 5) {
					echo __( 'This is held ', 'ocn' ) . __( $activity_frequency->slug, 'ocn' ) . __( ' on ', 'ocn' );

						foreach($activity_day as $day) {
						//	echo __( $day->name, 'ocn' ) . ' ';
							$interval[] = $day->slug;
							$intervalNew[] = $day->name;
						}

						echo implode(", ", $intervalNew);

						$frequency_interval = implode(",", $interval);

					} else {
						echo __('This is held every weekday', 'ocn' );
						$frequency_interval = 'MO,TU,WE,TH,FR';
					}
				}





				echo '</span>';
				if($time_start) {
					echo '<span class="label-resources white-text">' . __( 'Time', 'ocn' ) . '</span><span class="block">' .  __( 'This activity runs from ', 'ocn' ) . $time_start;
					if($time_end) {
						echo __( ' to ', 'ocn' ) . $time_end ;
					}
					echo '</span>';
				}



				if($activity_organiser) {
					echo '<span class="label-resources white-text">' .  __( 'Organiser', 'ocn' ) . '</span><a class="block" href="' . get_permalink($activity_organiser[0]) . '">' . __( get_the_title($activity_organiser[0]), 'ocn' ) . '</a>';
				} elseif ($activity_organised_by) {
					echo '<span class="label-resources white-text">' .  __( 'Organiser', 'ocn' ) . '</span><span class="block">' . $activity_organised_by . '</span>';
				}



				echo '<span class="label-resources white-text">' . __( 'Contact', 'ocn' ) . '</span>';

				if($activity_contact) {
					echo '<span class="block">' . $activity_contact . '</span>';
				}

				if($activity_email) {
					echo '<span class="block">' .  __( 'Email: ', 'ocn' ) . '<a href="mailto:' . $activity_email . '">' . $activity_email . '</a></span>';
				}

				if($activity_phone) {
					echo '<span class="block">' .  __( 'Phone: ', 'ocn' ) . '<a href="tel:' . $formatted_phone . '">' . $activity_phone . '</a></span>';
				}





				echo '</div>';

				if ($contact_map):
					$address = explode(",", $contact_map['address']);
					$address_constructor = 'https://maps.google.com/?q=';

					foreach ($address as $value) {
						$value = $value . "%2C";
						$value = implode("%2C",$address);
						$newadd = explode(" ",$value);
					}

					$map_image = 'https://maps.googleapis.com/maps/api/staticmap?center=' . $contact_map['lat'] . ',' . $contact_map['lng'] . '&zoom=16&size=640x385&maptype=terrain&format=png&visual_refresh=true
					&markers=color:0x01a89e%7Csize:mid%7C' . $contact_map['lat'] . ',' . $contact_map['lng'] . '&key=' . $map_key;
					echo '<div class="col s12 l6"><span class="label-resources white-text">' .  __( 'Address', 'ocn' ) . '</span><span class="block">';
					echo $activity_address_name . '<br />';
					echo $activity_address_street . '<br />';
					echo $activity_address_town . ' ' . $activity_address_zip . '</span>';
					echo '<span class="label-resources white-text">' . __( 'Map', 'ocn' ) . '</span><span class="block">' . __( 'Click image to view on Google Maps', 'ocn' ) . '
					</span><a href="' . $address_constructor . implode("+",$newadd) . '" target="_blank"><img alt="Map showing location of ' . $activity_address_name . ' " class="responsive-img map" src="' . $map_image . '"></a>	';
					echo '</div>';
				endif;

				echo '<div id="atc" class="col s12 center"><div title="Add to Calendar" class="addeventatc white">
    Add to Calendar
    <span class="start">' . $activity_start . ' ' .  $time_start . '</span>
    <span class="end">' . $activity_end  . ' ' .  $time_end .  '</span>
    <span class="timezone">Europe/London</span>
    <span class="title">' . get_the_title() . '</span>
    <span class="description">' . $activity_name . '</span>
    <span class="location">' . $contact_map['address'] . '</span>
		<span class="organizer">' . $activity_contact . '</span>
		<span class="organizer_email">' . $activity_email . '</span>
		<span class="alarm_reminder">60</span>
		<span class="recurring">FREQ=' . strtoupper($activity_frequency->slug) . ';';
		if($oftValNew) {
			echo 'BYSETPOS=' . $oftValNew . ';';
		}
		echo 'BYDAY=' . strtoupper($frequency_interval) . strtoupper($activity_day->slug) . ';INTERVAL=1;</span>
		</div></div>';

    endwhile;

else :

    // no rows found

endif;
echo '</div></div>';?>



<?php endif;



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


</section>



<?php
if( has_term( 'support-organisations', 'resources_category' ) ):
$relatedActivities = get_posts(array(
							'post_type' => 'resources',
							'posts_per_page' => -1,
							'order'          => 'ASC',
							'orderby'        => 'title',
							'meta_query' => array(
								array(
									'key' => 'organiser', // name of custom field
									'value' => '"' . get_the_ID() . '"', // matches exactly "123", not just 123. This prevents a match for "1234"
									'compare' => 'LIKE'
								)
							)
));


 if( $relatedActivities ):?>



 <div class=" related-activities">

<h2 class="h5"><?php the_title();?> Activities</h2>

		 <ul class="row">
		 <?php foreach( $relatedActivities as $relatedActivity ): ?>
			 <?php



			 ?>
			 <li class="col s12 m6 center">

				 <div class="card-link">
					 <h3 class="h6"><?php echo get_the_title( $relatedActivity->ID ); ?></h3>
					 <a class="btn-large z-depth-0 waves-effect" href="<?php echo get_permalink( $relatedActivity->ID ); ?>">
						 View Details on this Activity
					 </a>
				 </div>

			 </li>


		 <?php endforeach; ?>
		 </ul>



	</div>
						<?php endif;

wp_reset_postdata();

endif;
?>

</div>
<?php
if (comments_open()){
	comments_template();
}
?>
</article>

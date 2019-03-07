<?php
//$parent_id = wp_get_post_parent_id( $post_ID );
//$parent_title = get_the_title($parent_id;
 // storing this so we have it available in the other loops
?>
<article id="post-<?php the_ID(); ?>" class="<?php echo $post->post_name;?>" role="article" itemscope itemtype="http://schema.org/WebPage">
	<header class="article-header col s12 center">
		<h1 class="resource-title h2" itemprop="headline"><?php the_title();?></h1>
		<?php

		if(is_user_logged_in()) {
			//get_template_part( 'parts/content', 'edit' );
		}
		?>
		<?php

		$parentID = wp_get_post_parent_id( get_the_ID() );
		$uncompleted = [];
		if(is_user_logged_in() && is_singular('lesson')) {
		if($parentID) {
			if (in_array($ID , $uncompleted)  ) {
				acf_form(array(
						 'id' => 'completed',
						 'post_id'	=> $ID,
						 'post_title'	=> false,
						 'fields' => array('0'),
						 'submit_value'	=> 'Mark it as complete'
					 ));
			} else {
				 echo '<div class="center" style="margin-bottom: 3rem;">
				 <div class="btn-flat disabled teal darken-3 white-text" role="alert"><i class="material-icons left" aria-hidden="true">done</i>
 			  Well done! You Have Completed This Task
 			 	</div>
				</div>';

			 }
		}
	}


		get_template_part( 'parts/content', 'byline' );
		get_template_part( 'parts/content', 'share' );

		 ?>
		 <nav role="navigation" aria-label="Navigate between lessons" id="lesson-nav" class="col s12 grey lighten-3">

		 	<?php

			$next_post = get_next_post();
		 	$prev_post = get_previous_post();
			if(is_singular('lesson')):
			if($parentID):?>
			<div class="col s6">
			<?php if($prev_post->ID === $parentID):?>
				<a class="btn-flat large teal-text text-darken-3" href="<?php echo $prev_post->guid ?>"><i class="material-icons left" aria-hidden="true">keyboard_arrow_left</i><?php echo 'View Lesson Page: ' . $prev_post->post_title; ?>
		 		</a>
			<?php endif;
		 	if ($prev_post->ID != $parentID):
		 		?>

		 	  <a class="btn-flat large teal-text text-darken-3" href="<?php echo $prev_post->guid ?>"><i class="material-icons left" aria-hidden="true">keyboard_arrow_left</i><?php echo 'Previous Class: ' . $prev_post->post_title; ?>
		 		</a>
		 	<?php endif;
		?>
		</div>
			<?php  endif;
			?>


		 	<?php

			if($parentID && !empty( $next_post )):?>
			 <div class="col s6">
			<?php if($next_post->ID === $parentID): ?>

				<a class="btn-flat large teal-text text-darken-3 right" href="<?php echo $next_post->guid ?>"><i class="material-icons right" aria-hidden="true">keyboard_arrow_right</i><?php echo 'Next Class: ' . $next_post->post_title; ?>
		 		</a>
			<?php endif;
			if ($next_post->ID != $parentID):
		 		?>

		 	  <a class="btn-flat large teal-text text-darken-3 right" href="<?php echo $next_post->guid ?>"><i class="material-icons right" aria-hidden="true">keyboard_arrow_right</i><?php echo 'Next Class: ' . $next_post->post_title; ?>
		 		</a>
		 	<?php endif; ?>
			 </div>
		<?php endif;

		if(!$parentID && !empty( $next_post )):?>
		 <div class="col s6 offset-s6">
		<?php if($next_post->ID === $parentID): ?>

			<a class="btn-flat large teal-text text-darken-3 right" href="<?php echo $next_post->guid ?>"><i class="material-icons right" aria-hidden="true">keyboard_arrow_right</i><?php echo 'Next Class: ' . $next_post->post_title; ?>
			</a>
		<?php endif;
		if ($next_post->ID != $parentID):
			?>

			<a class="btn-flat large teal-text text-darken-3 right" href="<?php echo $next_post->guid ?>"><i class="material-icons right" aria-hidden="true">keyboard_arrow_right</i><?php echo 'Next Class: ' . $next_post->post_title; ?>
			</a>
		<?php endif; ?>
		 </div>
	<?php endif;
endif;
		?>
		<?php if(is_singular('audits')):
			if(empty( $prev_post ) && !empty( $next_post )):?>

			<div class="col s6 offset-s6">


			 <a class="btn-flat large teal-text text-darken-3 right" href="<?php echo $next_post->guid ?>"><i class="material-icons right" aria-hidden="true">keyboard_arrow_right</i><?php echo 'Next Audit: ' . $next_post->post_title; ?>
			 </a>
			</div>

		<?php endif;
		if(!empty( $prev_post )):?>

		<div class="col s6">


		 <a class="btn-flat large teal-text text-darken-3" href="<?php echo $prev_post->guid ?>"><i class="material-icons right" aria-hidden="true">keyboard_arrow_right</i><?php echo 'Previous Audit: ' . $prev_post->post_title; ?>
		 </a>
		</div>

	<?php endif;

		if(!empty( $prev_post ) && !empty( $next_post )):?>

		<div class="col s6">


		 <a class="btn-flat large teal-text text-darken-3 right" href="<?php echo $next_post->guid ?>"><i class="material-icons right" aria-hidden="true">keyboard_arrow_right</i><?php echo 'Next Audit: ' . $next_post->post_title; ?>
		 </a>
		</div>

	<?php endif;

		endif;
				?>
	</nav>

	</header> <!-- end article header -->




<section class="entry-content white col s12" itemprop="articleBody">
 <div class="ainer">

	 <!-- flexible content -->

	 <?php

	 	$calendar_desc = get_field('calendar_info');
		if ($calendar_desc) {
			echo '<div>
			' . $calendar_desc . '
			</div>';
		}

// check if the flexible content field has rows of data
if( have_rows('content') ):

     // loop through the rows of data
    while ( have_rows('content') ) : the_row();

				if( get_row_layout() == 'sub_headings' ):

					echo '<h2 class="h4 col s12">'
					. get_sub_field("sub_heading") .
					'</h2>';
				endif;

        if( get_row_layout() == 'main_content' ):

        	echo '<div class="col content_block s12">'
					. get_sub_field("description") .
					'</div>';
				endif;

				if( get_row_layout() == 'links' ):
					$links_title = get_sub_field("links_title");
        	echo '<div class="grey lighten-3 col s12 key_link">';

					 	if($links_title) {
							echo '<span class="links_title">' . $links_title . '</span>';
						}

						if( have_rows('external_link') ):

					 	// loop through the rows of data
					    while ( have_rows('external_link') ) : the_row();

					        // display a sub field value
					        echo '<a class="block" href="' . get_sub_field('external_link_url') . '">' . get_sub_field('external_link_text') . '</a>';

					    endwhile;

						else :

						    // no rows found

						endif;

						if( have_rows('internal_link') ):

					 	// loop through the rows of data
					    while ( have_rows('internal_link') ) : the_row();

					        // display a sub field value
					         echo '<a class="block" href="' . get_sub_field('internal_link_url') . '">' . get_sub_field('internal_link_text') . '</a>';

					    endwhile;

						else :

						    // no rows found

						endif;

					echo '</div>';
				endif;

        if( get_row_layout() == 'single_image' ):

        	$file = get_sub_field('image');
					echo '<div class="col s12 center">
					<img class="responsive-img" src="' . $file['url']. '" alt="' . get_sub_field('caption') . '" />
					<label class="block">' . get_sub_field('caption') . '</label>
					</div>';

        endif;

				if( get_row_layout() == 'document' ):

					if( have_rows('document_upload') ):
						echo '<div class="documents col s12">';
					// loop through the rows of data
						while ( have_rows('document_upload') ) : the_row();
						$doc = get_sub_field('single_document');
								// display a sub field value
								echo '<a class="block" href="' . $doc['url']. '" /><i class="material-icons left" aria-hidden="true">cloud_download</i>Download - ' . get_sub_field('document_description') . '</a>';

						endwhile;
						echo '</div>';
					else :

							// no rows found

					endif;

				endif;

				if( get_row_layout() == 'video_embed' ):
					echo '<div class="col s12"><div class="video-container">';

        	$video = get_sub_field('video_url');
					echo $video;

							echo '</div></div>';

        endif;

    endwhile;

else :

    // no layouts found

endif;

?>

	 <?php the_content();
	if('is_user_logged_in' && is_singular('lesson')) {
	$ID = get_the_id();

	$children;
	echo '<ul class="collection with-header">';
	if($parentID) {
		echo '<li class="center collection-header">' . get_the_title() . ' is part of the <a href="' . get_the_permalink($parentID) . '">' . get_the_title($parentID) . '</a> course.
		The tasks in this course are listed below.</li>';
		$args = array(
		 'post_parent' => $parentID,
		 'orderby' => 'date',
    'order' => 'ASC'
	 );
		$children = get_children( $args );
	} else {
		echo '<li class="center collection-header">Tasks in the ' . get_the_title($ID) . ' course</li>';
		$args = array(
		 'post_parent' => $ID,
		 'orderby' => 'date',
    'order' => 'ASC'
	 );
		$children = get_children( $args );
	}



	$uncompleted = [];

	 if(is_user_logged_in) {
		 //$post = get_post( $post_id );
		$current_user = get_current_user_id();
		$current_user = strval($current_user);
		$user = 'user_' . $current_user;
	 $completed = get_field('page_completed', $user);
	 if($completed) {
		 foreach($children as $child) {
			if (!in_array($child->ID , $completed) ) {
				$uncompleted[] = $child->ID;
				echo '<li class="collection-item"><a href="' . get_the_permalink($child->ID) . '" aria-label="Not Completed"><i class="material-icons right" aria-hidden="true">check_box_outline_blank</i>' . get_the_title($child->ID) . '</a></li>';
	 	} else {
 		 echo '<li class="collection-item"><a href="' . get_the_permalink($child->ID) . '" aria-label="Completed"><i class="material-icons right" aria-hidden="true">check_box</i>' . get_the_title($child->ID) . '</a></li>';
 	 }
 	}
 } elseif(!$completed) {
	   foreach($children as $child) {
	       $uncompleted[] = $child->ID;
				 echo '<li class="collection-item"><a href="' . get_the_permalink($child->ID) . '" aria-label="Not Completed"><i class="material-icons right" aria-hidden="true">check_box_outline_blank</i>' . get_the_title($child->ID) . '</a></li>';
	   }
	 } else {
		 echo '<li class="collection-item"><a href="' . get_the_permalink($child->ID) . '" aria-label="Completed"><i class="material-icons right" aria-hidden="true">check_box</i>' . get_the_title($child->ID) . '</a></li>';
	 }

		 //$completed = array_values($completed);

 }

 echo '</ul>';


}







	  if( have_rows('location_details') ):

			$group_ID = 499;

			$superheroes = acf_get_fields('499');

			$sub_fields = $superheroes[0]['sub_fields'];
		//	$keys = array_keys($sub_fields);
//
// for($i = 0; $i < count($sub_fields); $i++) {
//     echo $keys[$i] . "{<br>";
//     foreach($sub_fields[$keys[$i]] as $key => $value) {
//         echo $key . " : " . $value . "<br>";
//     }
//     echo "}<br>";
// }




	while( have_rows('location_details') ): the_row();

		// vars

		$average = get_field('location_rating_average');
		//$average = ($rating1 + $rating2) / 2;
		$progress = $average * 10;



		?>


			<div class="content">
				<?php echo get_field('location_description'); ?>
				<ul class="collection with-header">
					<li class="collection-header center"><h2>Audit Results <i class="material-icons" aria-hidden="true">grade</i></h2></li>
		<?php
		foreach ($sub_fields as $sub_field) {

			echo '<li class="collection-item">  <span class="badge">' . get_sub_field($sub_field["name"]) . ' out of 7</span>' . $sub_field["label"] . '</li>';
		}?>
		<li id="average" class="collection-item teal darken-3 center white-text">  Average rating: <?php echo $average;?> out of 7</li>


		 <!-- <li class="collection-item">  <span class="badge"><?php the_sub_field('moving_around');?> out of 7 </span>Moving Around</li>
		  <li class="collection-item">  <span class="badge"><?php the_sub_field('public_transport');?> out of 7</span>Public Transport</li>
			<li class="collection-item">  <span class="badge"><?php the_sub_field('traffic_and_parking');?> out of 7</span>Traffic and Parking</li>
			<li class="collection-item">  <span class="badge"><?php the_sub_field('streets_and_spaces');?> out of 7</span>Streets and Spaces</li>
			<li class="collection-item">  <span class="badge"><?php the_sub_field('natural_space');?> out of 7</span>Natural Space</li>
			<li class="collection-item">  <span class="badge"><?php the_sub_field('play_and_recreation');?> out of 7</span>Play and Recreation</li>
			<li class="collection-item">  <span class="badge"><?php the_sub_field('facilities_and_amenities');?> out of 7</span>Facilities and Amenities</li>
			<li class="collection-item">  <span class="badge"><?php the_sub_field('work_and_local_economy');?> out of 7</span>Work and Local Economy</li>
			<li class="collection-item">  <span class="badge"><?php the_sub_field('housing_and_community');?> out of 7</span>Housing and Community</li>
			<li class="collection-item">  <span class="badge"><?php the_sub_field('social_contact');?> out of 7</span>Social Contact</li>
			<li class="collection-item">  <span class="badge"><?php the_sub_field('identity_and_belonging');?> out of 7</span>Identity and Belonging</li>
			<li class="collection-item">  <span class="badge"><?php the_sub_field('feeling_safe');?> out of 7</span>Feeling Safe</li>
			<li class="collection-item">  <span class="badge"><?php the_sub_field('care_and_maintenance');?> out of 7</span>Care and Maintenance</li>
			<li class="collection-item">  <span class="badge"><?php the_sub_field('influence_and_sense_of_control');?> out of 7</span>Influence and Sense of Control</li>
		 <li id="average" class="collection-item teal darken-3 center white-text">  Average rating: <?php echo $average;?> out of 7</li> -->
	 </ul>





			</div>

			<?php
			$images = get_field('audit_gallery');
			if( $images ):

				?>
				<h4 class="center">Photos</h4>
			<div class="main-carousel"  data-flickity-options='{ "contain": true }'>
			 <?php foreach( $images as $image ): ?>
			 <div class="carousel-cell" style="width: 100%;"><img class="responsive-img" src="<?php echo $image['url']; ?>"/>
				 <p><?php echo $image['caption']; ?></p>
			 </div>
			 <?php endforeach; ?>
			</div>
			<?php endif;?>

	<?php



endwhile; ?>



<?php endif;

get_template_part( 'parts/content', 'contact' );

 ?>


</section>
</article>

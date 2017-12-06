<div class="bg parallax-container grey lighten-3" style="height: auto;" >

	<header class="article-header">
		<h1 class="entry-title single-title center" itemprop="headline"><?php the_title();?></h1>
		<?php

		$parentID = wp_get_post_parent_id( $post_ID );
		$uncompleted = [];
		if(is_user_logged_in()) {
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
				 <div class="btn-flat disabled green lighten-2 white-text"><i class="material-icons left">done</i>
 			  Well done! You Have Completed This Task
 			 	</div>
				</div>';

			 }
		}
	}


		//get_template_part( 'parts/content', 'byline' );
		get_template_part( 'parts/content', 'share' );

		 ?>
		 <div id="lesson-nav" class="col s12 white">

		 	<?php


		 	$prev_post = get_previous_post();
			if($parentID):?>
			<div class="col s6">
			<?php if($prev_post->ID === $parentID):?>
				<a class="btn-flat large teal-text" href="<?php echo $prev_post->guid ?>"><i class="material-icons left">keyboard_arrow_left</i><?php echo 'View Lesson Page: ' . $prev_post->post_title; ?>
		 		</a>
			<?php endif;
		 	if ($prev_post->ID != $parentID):
		 		?>

		 	  <a class="btn-flat large teal-text" href="<?php echo $prev_post->guid ?>"><i class="material-icons left">keyboard_arrow_left</i><?php echo 'Previous Class: ' . $prev_post->post_title; ?>
		 		</a>
		 	<?php endif;
		?>
		</div>
			<?php  endif;
			?>


		 	<?php

		 	$next_post = get_next_post();
			if($parentID && !empty( $next_post )):?>
			 <div class="col s6">
			<?php if($next_post->ID === $parentID): ?>

				<a class="btn-flat large teal-text right" href="<?php echo $next_post->guid ?>"><i class="material-icons right">keyboard_arrow_right</i><?php echo 'Next Class: ' . $next_post->post_title; ?>
		 		</a>
			<?php endif;
			if ($next_post->ID != $parentID):
		 		?>

		 	  <a class="btn-flat large teal-text right" href="<?php echo $next_post->guid ?>"><i class="material-icons right">keyboard_arrow_right</i><?php echo 'Next Class: ' . $next_post->post_title; ?>
		 		</a>
		 	<?php endif; ?>
			 </div>
		<?php endif;

		if(!$parentID && !empty( $next_post )):?>
		 <div class="col s6 offset-s6">
		<?php if($next_post->ID === $parentID): ?>

			<a class="btn-flat large teal-text right" href="<?php echo $next_post->guid ?>"><i class="material-icons right">keyboard_arrow_right</i><?php echo 'Next Class: ' . $next_post->post_title; ?>
			</a>
		<?php endif;
		if ($next_post->ID != $parentID):
			?>

			<a class="btn-flat large teal-text right" href="<?php echo $next_post->guid ?>"><i class="material-icons right">keyboard_arrow_right</i><?php echo 'Next Class: ' . $next_post->post_title; ?>
			</a>
		<?php endif; ?>
		 </div>
	<?php endif;

		?>
		 </div>

	</header> <!-- end article header -->


</div>



<div class="section white">
 <div class="row container">
	 <?php the_content($post_ID);
	if(is_user_logged_in && is_singular('lesson')) {
	$ID = get_the_id();

	$children;
	echo '<ul class="collection with-header">';
	if($parentID) {
		echo '<li class="center collection-header"><h2>' . get_the_title() . ' is part of the <a href="' . get_the_permalink($parentID) . '">' . get_the_title($parentID) . '</a> course.
		The tasks in this course are listed below.</h2></li>';
		$args = array(
		 'post_parent' => $parentID,
		 'orderby' => 'date',
    'order' => 'ASC'
	 );
		$children = get_children( $args );
	} else {
		echo '<li class="center collection-header"><h2>Tasks in the ' . get_the_title($ID) . ' course</h2></li>';
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
				echo '<li class="collection-item"><a href="' . get_the_permalink($child->ID) . '"><i class="material-icons right">check_box_outline_blank</i>' . get_the_title($child->ID) . '</a></li>';
	 	} else {
 		 echo '<li class="collection-item"><a href="' . get_the_permalink($child->ID) . '"><i class="material-icons right">check_box</i>' . get_the_title($child->ID) . '</a></li>';
 	 }
 	}
 } elseif(!$completed) {
	   foreach($children as $child) {
	       $uncompleted[] = $child->ID;
				 echo '<li class="collection-item"><a href="' . get_the_permalink($child->ID) . '"><i class="material-icons right">check_box_outline_blank</i>' . get_the_title($child->ID) . '</a></li>';
	   }
	 } else {
		 echo '<li class="collection-item"><a href="' . get_the_permalink($child->ID) . '"><i class="material-icons right">check_box</i>' . get_the_title($child->ID) . '</a></li>';
	 }

		 //$completed = array_values($completed);

 }

 echo '</ul>';


}







	  if( have_rows('location_details') ):

	while( have_rows('location_details') ): the_row();

		// vars
		$rating1 = get_sub_field('location_rating_flooring');
		$rating2 = get_sub_field('location_rating_color');
		$average = get_field('location_rating_average');
		//$average = ($rating1 + $rating2) / 2;
		$progress = $average * 10;

		?>


			<div class="content">
				<?php echo get_sub_field('location_description'); ?>
				<ul class="collection with-header">
		 <li class="collection-header center"><h4>Location Ratings <i class="material-icons">grade</i></h4></li>
		 <li class="collection-item">  <span class="badge" data-badge-caption="custom caption"><?php echo $rating1;?> / 10 </span>Flooring </li>
		  <li class="collection-item">  <span class="badge" data-badge-caption="custom caption"><?php echo $rating2;?> / 10</span>Colour</li>
		 <li class="collection-item teal lighten-1 center white-text">  <h5>Average rating: <?php echo $average;?> / 10</h5></li>
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



 ?>


 </div>
</div>

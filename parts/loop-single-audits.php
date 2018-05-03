

	<header class="article-header">
		<h1 class="entry-title h2 single-title center" itemprop="headline"><?php the_title();?></h1>

		<?php

			get_template_part( 'parts/content', 'edit' );

		?>
	<?php

		get_template_part( 'parts/content', 'byline-audit' );
		get_template_part( 'parts/content', 'share' );

		 ?>
		 <nav role="navigation" aria-label="Navigate between lessons" id="lesson-nav" class="col s12 grey lighten-3">
			 <?php
			 $next_post = get_next_post();
 		 	$prev_post = get_previous_post();
 				if(empty( $prev_post ) && !empty( $next_post )):?>

 				<div class="col s6 offset-s6">


 				 <a class="btn-flat large teal-text text-darken-3 right" href="<?php echo $next_post->guid ?>"><i class="material-icons right" aria-hidden="true">keyboard_arrow_right</i><?php echo 'Next Audit: ' . $next_post->post_title; ?>
 				 </a>
 				</div>

 			<?php endif;
 			if(!empty( $prev_post )):?>

 			<div class="col s6">


 			 <a class="btn-flat large teal-text text-darken-3" href="<?php echo $prev_post->guid ?>"><i class="material-icons left" aria-hidden="true">keyboard_arrow_left</i><?php echo 'Previous Audit: ' . $prev_post->post_title; ?>
 			 </a>
 			</div>

 		<?php endif;

 			if(!empty( $prev_post ) && !empty( $next_post )):?>

 			<div class="col s6">


 			 <a class="btn-flat large teal-text text-darken-3 right" href="<?php echo $next_post->guid ?>"><i class="material-icons right" aria-hidden="true">keyboard_arrow_right</i><?php echo 'Next Audit: ' . $next_post->post_title; ?>
 			 </a>
 			</div>

 		<?php endif;


 					?>
		 </nav>

	</header> <!-- end article header -->

<div class="section white">
 <div class="row container">

	 <!-- flexible content -->


<?php

	  if( have_rows('location_details') ):

			$location_details = acf_get_fields('499');

			$sub_fields = $location_details[0]['sub_fields'];

	while( have_rows('location_details') ): the_row();

		// vars

		$average = get_field('location_rating_average');
		//$average = ($rating1 + $rating2) / 2;
		$progress = $average * 10;

		?>
			<div class="col s12">
				<p>
					<?php echo get_field('location_description'); ?>
				</p>
			</div>
		<div class="col s12 grey lighten-2">
			<h3 class="center">Audit Results</h3>

			<div class="content col s12 l6">

				<ul class="collection with-header">
					<li class="collection-header center"><h4>Section Ratings <i class="material-icons" aria-hidden="true">filter_7</i></h4></li>
		<?php
		foreach ($sub_fields as $sub_field) {

			echo '<li class="collection-item">  <span class="badge">' . get_sub_field($sub_field["name"]) . ' out of 7</span>' . $sub_field["label"] . '</li>';
		}?>


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
<div class="col s12 l6">
	<ul class="collection with-header">
		<li class="collection-header center"><h4>Radar Chart <i class="material-icons" aria-hidden="true">insert_chart</i></h4></li>
		<li class="collection-item">
			<canvas id="marksChart"></canvas>
		</li>
		<li id="average" class="collection-item teal darken-3 center white-text">  Average rating: <?php echo $average;?> out of 7</li>
	</ul>
</div>
<?php
$location = get_field('location_map');
if( !empty($location) ):
?>
<div class="col s12">
	<div class="acf-map" style="height: 400px; margin-bottom: 1rem;">

		<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>">


			</div>
	</div>
</div>
<?php endif;?>

</div>







 </div>
</div>

<?php
	 // if(is_user_logged_in()) {
	 // 	get_template_part( 'parts/content', 'edit' );
	 // }
?>

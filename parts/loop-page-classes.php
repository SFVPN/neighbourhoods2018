<div class="bg parallax-container" >
	<header class="article-header">
		<h1 class="entry-title single-title white-text center" itemprop="headline"><?php the_title();?></h1>
	</header> <!-- end article header -->
	 <div class="parallax"><img src="<?php the_post_thumbnail_url('large'); ?>"></div>
</div>

<div class="section white" itemscope itemtype="http://schema.org/WebPage">
 <div class="row container">

	 <?php the_content();

		if (have_rows('address_details', 'options')) { //parent repeater

		while (have_rows('address_details', 'options')) : the_row();

		$name = get_sub_field('location_name', 'options');
		$name_slug = sanitize_title($name);
		$street = get_sub_field('address_street', 'options');
		$locality = get_sub_field('address_locality', 'options');
		$zip = get_sub_field('address_postal', 'options');
		$map = get_sub_field('location_map', 'options');
		$place = $map['address'];
		$place = (explode(" ",$place));
		$place = (implode ('+', $place));
		echo '<div class="col s12 l6"><div class="card"><div class="card-image">';
		echo '<a href="https://www.google.co.uk/maps/place/' . $place . '/@' . $map['lat'] . ',' . $map['lng'] . ',17z" target="_blank" title="View on Google Maps"><img class="responsive-img" src="https://maps.googleapis.com/maps/api/staticmap?center=' . $map['lat'] . ',' . $map['lng'] . '&zoom=14&size=640x350&scale2
&markers=color:0x01a89e%7Csize:mid%7C' . $map['lat'] . ',' . $map['lng'] . '&key=AIzaSyB1ogka67k0TWwlmXEcsUqLEeSZTBkgJyA" ></a>';?>

			</div>
			<div class="card-content">
				<span class="card-title"><?php echo $name;?></span>
				<p>

		<?php
		echo $street . ', ' . $locality . ', ' . $zip;
		echo '</p></div></div></div>'; //end card-content

		endwhile; // end address_details loop
		}; // end address_details conditional ?>

	</div> <!-- end row container -->
</div> <!-- end section -->

 <?php
  if( have_rows('class_details') ):
 	while ( have_rows('class_details') ) : the_row();
	$photo = get_sub_field('photo_class');
	if($photo){?>

<div class="parallax-container">
	<div class="parallax"><img src="<?php the_sub_field('photo_class'); ?>"></div>
</div> <!-- end parallax-container -->

	<?php }?>

<div class="section white">
 	<div class="row container">
 		<h3 class="header"><?php the_sub_field('name_class'); ?></h3>

		 <?php
 		 $classes = get_sub_field('location_class');
		 $ages = get_sub_field('age_range');
		 $titles = array();

		 foreach ($classes as $class) {
			$titles[] = $class->post_title;
		 }
		 if($titles) {
			  echo '<span class="chip"><i class="mdi mdi-map-marker"></i>' . implode(' + ', $titles) . '</span>';
		 }
		 if($ages) {
			 echo '<span class="chip"><i class="mdi mdi-human-child"></i>' . $ages . '</span>';
		 }?>

 		 <p class="grey-text text-darken-3 lighten-3">
 		 	<?php the_sub_field('description_class'); ?>
		 </p>

	</div> <!-- end row container -->
 </div> <!-- end section -->


 	<?php
 	 endwhile;
 	 else :
 			 // no rows found
 	 endif;
  ?>

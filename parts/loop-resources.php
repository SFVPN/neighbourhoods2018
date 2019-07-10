
<article id="post-<?php the_ID(); ?>" class="col s12 m6 l4 resource-article" role="article">

	<section class="grey lighten-4 card">

		<div class="card-content">
			<h2 class="card-title"><a href="<?php the_permalink() ?>" class="center" rel="bookmark" ><?php the_title(); ?></a></h2>
		


		<?php
		if (is_tax( 'resources_category', array( 'local-groups' ) )) {


			$field = get_field('section', $post->ID);
			$activity_details = $field[0]['blocks'][0]['activity_group_details'];
			$frequency = $activity_details['activity_frequency']['label'];
			$address = $activity_details['map_address'];
			$address = explode(",", $address['address']);

			echo '<div class="schedule">';

			if ($frequency == "monthly") {
				echo $frequency . ' on the ' . $activity_details['activity_frequency_month']['label'] . ' '
			 . $activity_details['activity_day']['label'];
		 } else {
			 echo $frequency . ' every '
 		 . $activity_details['activity_day']['label'];

		 }
		 echo ' at ' . $address[0] . '</div></div>';


			echo '<div class="card-action"><i class="material-icons left">info</i>Organised by ' . $activity_details['activity_organiser'] . '</div>';
		} else {
		if ($post->post_parent != 0) {
			echo '</div><div class="card-action"><i class="material-icons left">library_books</i>Part of ' . get_the_title($post->post_parent) . ' guide</div>';
		} else {
			$args = array(
				'post_parent' => $post->ID,
				'post_type'   => 'resources',
				'numberposts' => -1,
				'post_status' => 'any'
			);
			$children = get_children( $args );
			$count = count($children);
			$total = $count + 1;


				echo '</div><div class="card-action"><i class="material-icons left">format_list_numbered</i>' . $total . '-page guide</div>';

		}
		}
		//print_R($post);

?>


	</section>
</article>

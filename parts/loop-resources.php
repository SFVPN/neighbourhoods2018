
<article id="post-<?php the_ID(); ?>" class="col s12 m6 l4 resource-article" role="article">





		<?php
		//if (is_tax( 'resources_category', array( 'local-groups', 'tech-support' ) ))

		if (has_term(array( 'local-groups', 'tech-support' ), 'resources_category', null) == 1) {?>

		<section class="resource-card grey lighten-4 z-depth-1">


				<h2><a href="<?php the_permalink() ?>" rel="bookmark" ><?php the_title(); ?></a></h2>

		<?php
			$field = get_field('section', $post->ID);
			$activity_details = $field[0]['blocks'][0]['activity_group_details'];
			$activity_organiser = get_field('organiser', $post->ID);
			$frequency = $activity_details['activity_frequency']['label'];
			$address = $activity_details['map_address'];
			$address = explode(",", $address['address']);

			echo '<p class="content">';

			if ($frequency == "monthly") {
				echo ucfirst($frequency) . ' on the ' . $activity_details['activity_frequency_month']['label'] . ' '
			 . $activity_details['activity_day']['label'];
		 } else {
			 echo ucfirst($frequency) . ' on '
 		 . $activity_details['activity_day']['label'];

		 }
		 echo ' at ' . $address[0] . '</p>';


			echo '<p class="footer-content purple darken-1"><i class="material-icons left">info</i>Organised by ';
			if($activity_organiser) {
				echo get_the_title($activity_organiser[0]);
			} else {
				echo $activity_details['activity_organised_by'];
			}
			echo '</p>';
		} else {?>

		<section class="resource-card grey lighten-4 z-depth-1">


				<h2><a href="<?php the_permalink() ?>" rel="bookmark" ><?php the_title(); ?></a></h2>

				<p class="content">
					Click on the title to view full details of this resource.
				</p>

		<?php
		if (has_term(array( 'support-organisations' ), 'resources_category', null) == 1) {
			echo '<p class="footer-content purple darken-1"><i class="material-icons left">contact_support</i>Support Organisation</p>';
		} else {
			if ($post->post_parent != 0) {
				echo '<p class="footer-content purple darken-1"><i class="material-icons left">library_books</i>Part of ' . get_the_title($post->post_parent) . ' guide</p>';
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


					echo '<p class="footer-content purple darken-1"><i class="material-icons left">format_list_numbered</i>' . $total . '-page guide</p>';

			}
		}

		}
		//print_R($post);

?>


	</section>
</article>

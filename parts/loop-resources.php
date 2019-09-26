
<article id="post-<?php the_ID(); ?>" class="col s12 search-article" role="article">

	<section class="col s12 grey lighten-3">
		<h2 class="h5 "><a href="<?php the_permalink() ?>" class="center" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>


		<?php // check for rows (parent repeater)
		if( have_rows('section', $post->ID) ): ?>

			<?php echo '<div class="search-content">';


			// loop through rows (parent repeater)
			while( have_rows('section', $post->ID) ): the_row(); ?>

					<?php

					// check for rows (sub repeater)
					if( have_rows('blocks') ): ?>

						<?php

					

						// loop through rows (sub repeater)
						while( have_rows('blocks') ): the_row();

							// display each item as a list - with a class of completed ( if completed )
							if( get_row_layout() == 'text_block' ):
								echo '<p>' .  wp_trim_words( get_sub_field('content'), 25, ' ... ') . '<em>' . __( 'Click on the title to view more details', 'ocn' ) . '</em></p>';
								break;

	        		endif;

							//echo wp_trim_words( $contents, 30, ' ... [ <em>Click on the title to view more details</em> ]' );

							if( get_row_layout() == 'support_groups' ):

								if( have_rows('group_details') ):

									while( have_rows('group_details') ): the_row();
									$email = get_sub_field('group_email');
									$activity_phone = get_sub_field('group_phone');
									$formatted_phone = explode(" ", $activity_phone);
									$formatted_phone = implode("-", $formatted_phone);

									echo '<span class="block"><strong>Location</strong> ' . get_sub_field('group_address_town') . '</span>';
									echo '<span class="block"><strong>Phone</strong> <a href="tel:' . $formatted_phone . '">' . $activity_phone . '</a></span>';
									if($email) {
										echo '<span class="block"><strong>Email</strong> <a href="mailto:' . $email . '">' . $email . '</a></span>';
									}

									endwhile;

								endif;

	        		endif;

							if( get_row_layout() == 'local_group_activities' ):


								if( have_rows('activity_group_details') ):

									while( have_rows('activity_group_details') ): the_row();
									$activity_details = $field[0]['blocks'][0]['activity_group_details'];
									$activity_organiser = get_field('organiser', $post->ID);
									$days = get_sub_field('activity_day_select');
									$email = get_sub_field('group_email');
									$activity_phone = get_sub_field('group_phone');
									$formatted_phone = explode(" ", $activity_phone);
									$formatted_phone = implode("-", $formatted_phone);
									if(count($days) > 1) {
										$dayList = [];
										foreach($days as $day) {
											$dayList[] = $day->name;
										}
										$days = implode(", ", $dayList);
									} else {
										$days = $days[0]->name;
									}
									$freq = get_sub_field('activity_frequency_select');
									$often = get_sub_field('activity_frequency_month');

									if($freq->name == "Weekly") {
										$freq->name = $freq->name . " on " . $days;

									} else {
										if(count($often) == 1) {
											$freq->name = $freq->name . " every " . $often[0]['label'] . " " . $days;
										} else {
											$oft = [];
											foreach($often as $int) {
												$oft[] = $int['label'];
												$oftNew = implode(" and ", $oft);
											}
											$freq->name = $freq->name . " every " . $oftNew . " " . $days;
										}

									};

									echo '<span class="block"><strong>When</strong> ' . $freq->name . '</span>';
									echo '<span class="block"><strong>Location</strong> ' . get_sub_field('activity_address_name') . ', ' .  get_sub_field('activity_address_town') . '</span>';
									echo '<span class="block"><strong>Organiser</strong> ';
									if($activity_organiser) {
										echo get_the_title($activity_organiser[0]);
									} else {
										echo $activity_details['activity_organised_by'];
									}
									echo '</span>';
									echo '<span class="block"><strong>Phone</strong> <a href="tel:' . $formatted_phone . '">' . $activity_phone . '</a></span>';
									if($email) {
										echo '<span class="block"><strong>Email</strong> <a href="mailto:' . $email . '">' . $email . '</a></span>';
									}

							 		endwhile;

						  	endif;

							endif;

						endwhile; ?>

					<?php endif; //if( get_sub_field('blocks') ): ?>


			<?php endwhile; // while( has_sub_field('to-do_lists') ):

				if ($post->post_parent != 0) {
					echo '<span class="footer-content"><i class="material-icons left">assignment</i>' . __( 'This is part of the ', 'ocn' ) . '<a href="' . get_the_permalink($post->post_parent) . '">' . get_the_title($post->post_parent) . '</a>' .  __( ' guide', 'ocn' ) . '</span>';
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
					if($children) {
						echo '<span class="footer-content"><i class="material-icons left">format_list_numbered</i>' . __( 'This guide is ', 'ocn' ) . $total . __( ' pages', 'ocn' ) . '</span>';
					}
				}


				echo '</div >';
				?>

		<?php endif; // if( get_field('to-do_lists') ): ?>

	<?php //endwhile; // end of the loop. ?>
 	<footer class="card-content">
		<?php

			$terms = wp_get_post_terms($post->ID, 'resources_category', array("fields" => "all"));
			if($terms):
						echo '<ul>';
						foreach ($terms as $term) {
							$icon = get_field('material_icon_code', 'term_' . $term->term_id);
							echo '<li><i class="material-icons left">' . $icon . '</i>' . $term->name . '</li>';
							// code...
						}

						echo '</ul>';
						 endif;
		?>
	</footer>
	</section>
</article>

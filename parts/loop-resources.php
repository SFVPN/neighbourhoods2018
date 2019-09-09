
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
							if( get_row_layout() == 'intro_block' ):

									echo wp_trim_words( get_sub_field('intro_content'), 30, ' ... [ <em>Click on the title to view more details</em> ]' );

	        		endif;

							if( get_row_layout() == 'support_groups' ):

								if( have_rows('group_details') ):

									while( have_rows('group_details') ): the_row();

													echo '<span class="block"><strong>Location</strong> ' . get_sub_field('group_address_town') . '</span>';
													echo '<span class="block"><strong>Telephone</strong> ' . get_sub_field('group_phone') . '</span>';
													echo '<span class="block"><strong>Email</strong> <a href="mailto:' . get_sub_field('group_email') . '">' . get_sub_field('group_email') . '</a></span>';

									endwhile;

								endif;

	        		endif;

							if( get_row_layout() == 'local_group_activities' ):


								if( have_rows('activity_group_details') ):

									while( have_rows('activity_group_details') ): the_row();
									$day = get_sub_field('activity_day_select');
									$freq = get_sub_field('activity_frequency_select');
									$often = get_sub_field('activity_frequency_month');

									if($freq->name == "Weekly") {
										$freq->name = $freq->name . " on " . $day->name;
									} else {
										$freq->name = $freq->name . " every " . $often['label'] . " " . $day->name;
									};

									echo '<span class="block"><strong>When</strong> ' . $freq->name . '</span>';
									echo '<span class="block"><strong>Location</strong> ' . get_sub_field('activity_address_name') . ', ' .  get_sub_field('activity_address_town') . '</span>';

									echo '<span class="block"><strong>Phone</strong> ' . get_sub_field('group_phone') . '</span>';
									echo '<span class="block"><strong>Email</strong> <a href="mailto:' . get_sub_field('group_email') . '">' . get_sub_field('group_email') . '</a></span>';

							 		endwhile;

						  	endif;

							endif;

						endwhile; ?>

					<?php endif; //if( get_sub_field('blocks') ): ?>


			<?php endwhile; // while( has_sub_field('to-do_lists') ):

				echo '</div >';
				?>

		<?php endif; // if( get_field('to-do_lists') ): ?>

	<?php //endwhile; // end of the loop. ?>
 	<footer class="card-content" style="position: relative; padding: .5rem 0;">
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

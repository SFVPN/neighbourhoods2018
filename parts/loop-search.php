
<article id="post-<?php the_ID(); ?>" class="col s12 search-article" role="article">

	<section class="col s12 l8 offset-l2 grey lighten-3">
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

							if( get_row_layout() == 'support_groups' ):

								if( have_rows('group_details') ):

									while( have_rows('group_details') ): the_row();

													echo '<span class="block"><strong>Location</strong> ' . get_sub_field('group_address_town') . '</span>';
													echo '<span class="block"><strong>Telephone</strong> ' . get_sub_field('group_phone') . '</span>';
													echo '<span class="block"><strong>Email</strong> ' . get_sub_field('group_email') . '</span>';

									endwhile;

								endif;

	        		endif;

							if( get_row_layout() == 'local_group_activities' ):


								if( have_rows('activity_group_details') ):

									while( have_rows('activity_group_details') ): the_row();

									echo '<span class="block"><strong>Location</strong> ' . get_sub_field('activity_address_name') . ', ' .  get_sub_field('activity_address_town') . '</span>';

									echo '<span class="block"><strong>Phone</strong> ' . get_sub_field('group_phone') . '</span>';
									echo '<span class="block"><strong>Email</strong> ' . get_sub_field('group_email') . '</span>';

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

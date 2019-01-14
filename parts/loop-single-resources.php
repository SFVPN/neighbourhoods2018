<?php //$parent_id = wp_get_post_parent_id( $post_ID );
//$parent_title = get_the_title($parent_id);
$queried_object = get_queried_object();
$terms = get_the_terms( $queried_object->id, 'resources_category' );
if($queried_object->post_parent != 0 ) {
	//$terms = get_the_terms( $queried_object->id, 'resources_category' );
	$guide = get_the_title($queried_object->post_parent);
}

 // storing this so we have it available in the other loops
?>
<article id="post-<?php the_ID(); ?>" class="<?php echo $post->post_name;?>" role="article" itemscope itemtype="http://schema.org/WebPage">
	<header class="article-header col s12 center">
		<h1 class="h2 resource-title center" itemprop="headline"><?php the_title();?></h1>
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
						echo '<a href="' . get_term_link($term->term_id) . '" class="chip yellow">' . $term->name . '</a>';
				} else {
					echo '<a href="' . get_term_link($term->term_id) . '" class="chip">' . $term->name . '</a>';
				}
			}
		}
		if($queried_object->post_parent === 0 ) {
				echo '<br /><i class="mdi mdi-information"></i> This page was last updated on ' . get_the_modified_time('F j, Y') . '</span></div>';
		} else {
				echo '<br /><i class="mdi mdi-information"></i> This page is part of the <strong>' . $guide . '</strong> guide and was last updated on ' . get_the_modified_time('F j, Y') . '</span></div>';
		}


		//get_template_part( 'parts/content', 'byline' );
		get_template_part( 'parts/content', 'share' );

		 ?>


	</header> <!-- end article header -->



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
	echo '<div class="col s12 m12 grey lighten-4 index-wrapper">';
	$pages = array($post->ID );
		?>


			<ol id="guide-contents">
				<label class="block black-text"><?php the_title(); ?> guide pages</label>
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
echo '</div>';
}

		$show_toc = get_field('show_toc');
		if ($show_toc):
			echo '<div class="col s12 m12 grey lighten-4 index-wrapper">';
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
						<label class="block black-text">What\'s on this page?</label>';
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

				if( get_row_layout() == 'note_block' ):
					$note_type = get_sub_field('note_type');
					$note_url = get_sub_field('note_url');

					if($note_type['value'] === 'tip') {
						echo '<div class="row ' . $note_type['value'] . '"><div class="col s12 note-heading yellow lighten-1"><i class="material-icons left">bookmark</i><strong>' . $note_type['label'] . '</strong></div> <div  class="col s12 note-content grey lighten-4">' . get_sub_field('note');
						if($note_url) {
							echo '<a class="block" href="' . $note_url . '"><i class="material-icons left">arrow_forward</i>Click on this link for more information</a>';
						}
						echo '</div></div>';
					}

					if($note_type['value'] === 'required') {
						echo '<div class="row ' . $note_type['value'] . '"><div class="col s12 note-heading green darken-1 white-text"><i class="material-icons left">assignment_turned_in</i><strong>' . $note_type['label'] . '</strong></div> <div  class="col s12 note-content grey lighten-4">' . get_sub_field('note');
						if($note_url) {
							echo '<a class="block" href="' . $note_url . '"><i class="material-icons left">arrow_forward</i>Click on this link for more information</a>';
						}
						echo '</div></div>';
					}

					if($note_type['value'] === 'warning') {
						echo '<div class="row ' . $note_type['value'] . '"><div class="col s12 note-heading materialize-red lighten-2 white-text"><i class="material-icons left">thumb_down</i><strong>' . $note_type['label'] . '</strong></div> <div  class="col s12 note-content grey lighten-4">' . get_sub_field('note');
						if($note_url) {
							echo '<a class="block" href="' . $note_url . '"><i class="material-icons left">arrow_forward</i>Click on this link for more information</a>';
						}
						echo '</div></div>';
					}

					if($note_type['value'] === 'link') {
							echo '<div class="row ' . $note_type['value'] . '"><div class="col s12 note-heading blue lighten-1 white-text"><i class="material-icons left">link</i><strong>' . $note_type['label'] . '</strong></div> <div  class="col s12 note-content grey lighten-4">' . get_sub_field('note');
							if($note_url) {
								echo '<a class="block" href="' . $note_url . '"><i class="material-icons left">arrow_forward</i>Click on this link for more information</a>';
							}
							echo '</div></div>';
					}

					if($note_type['value'] === 'info') {
							echo '<div class="row ' . $note_type['value'] . '"><div class="col s12 note-heading grey darken-2 white-text"><i class="material-icons left">info</i><strong>' . $note_type['label'] . '</strong></div> <div  class="col s12 note-content grey lighten-4">' . get_sub_field('note');
							if($note_url) {
								echo '<a class="block" href="' . $note_url . '"><i class="material-icons left">arrow_forward</i>Click on this link for more information</a>';
							}
							echo '</div></div>';
					}



				endif;


				if( get_row_layout() == 'steps_block' ):

					$step_title = get_sub_field('step_title');

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
echo '</div>';
endif;


if( get_row_layout() == 'recommendation_block' ):

	$block_title = get_sub_field('block_title');
// check if the repeater field has rows of data
if( have_rows('recommendation_add') ):

	echo '<div class="row recommendation"><div class="col s12 note-heading purple darken-1 white-text"><i class="material-icons left">done_all</i><strong>' . $block_title . '</strong></div> <div  class="col center s12 note-content grey lighten-4">';
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


if( get_row_layout() == 'product_overview_block' ):

	$overview_title = get_sub_field('overview_title');
// check if the repeater field has rows of data
if( have_rows('product_add') ):

	echo '<div class="row recommendation"><div class="col s12 note-heading purple darken-1 white-text"><i class="material-icons left">done_all</i><strong>' . $overview_title . '</strong></div> <div id="note-content" class="col center s12 note-content grey lighten-4">';
 	// loop through the rows of data
    while ( have_rows('product_add') ) : the_row();

        $link = get_sub_field('product_link');
				$desc = get_sub_field('product_description');
				$good = get_sub_field('product_good');
				$bad = get_sub_field('product_bad');
				$platforms = get_sub_field('product_platforms');


				if($link) {
					echo '<div><a class="block product_link" href="' . $link . '" data-note="This link takes you to an external website">' . get_sub_field('recommended_product') . '</a></div>';
				} else {
						echo '<div><span class="block product_link">' . get_sub_field('recommended_product') . '</span></div>';
				}

				if($desc) {
					echo '<p>' . $desc . '</p>';
				}

				if($good) {
					echo '<p><i class="material-icons left green-text lighten-1">thumb_up</i> Good - ' . $good . '</p>';
				}

				if($bad) {
					echo '<p><i class="material-icons left materialize-red-text lighten-2">thumb_down</i> Bad - ' . $bad . '</p>';
				}

				if($platforms)  {
						echo '<ul class="center platforms white"><li>
						Available on:
						</li>';
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

				}



    endwhile;

else :

    // no rows found

endif;
echo '</div></div>';
endif;



				if( get_row_layout() == 'image_block' ):

					echo '<figure class="card"><img src="' . get_sub_field('image') . '" />
					<figcaption class="grey lighten-4"><i class="material-icons left">camera_alt</i>' . get_sub_field('caption') . '</figcaption></figure>';

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


<?php

get_template_part( 'parts/content', 'contact' );

 ?>

</section>
<div class="col s12 m12 grey lighten-4 parent-page">


<?php



if ( $post->post_parent === 0 ) {



} else {

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
				<label class="block black-text"><?php echo get_the_title($post->post_parent); ?> guide pages</label>
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
}

?>
</div>
</article>

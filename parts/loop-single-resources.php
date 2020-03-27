<?php //$parent_id = wp_get_post_parent_id( $post_ID );
//$parent_title = get_the_title($parent_id);
$queried_object = get_queried_object();
$terms = get_the_terms( $queried_object->id, 'resources_category' );
//$days = get_the_terms( $queried_object->id, 'resources_day' );
if($queried_object->post_parent != 0 ) {
	//$terms = get_the_terms( $queried_object->id, 'resources_category' );
	$guide = get_the_title($queried_object->post_parent);
}

 // storing this so we have it available in the other loops
?>
<div class="print-header hide">
	<div class="print-logo center">
		<!-- <img

		src="<?php echo get_template_directory_uri(); ?>/assets/images/resources-cover.png" alt=""
		/> -->
		<h1>Tools for a Connected Neighbourhood</h1>
		<div class="print-logo center">

		</div>

	</div>
</div>

<?php if( has_term( 'support-pathways', 'resources_category' ) ) {
	echo '<article id="post-' . get_the_ID() . '" class="support-pathway" role="article" itemscope itemtype="http://schema.org/WebPage">';
} else {?>



	<article id="post-<?php echo get_the_ID();?>" class="container <?php foreach( $terms as $term ) echo ' ' . $term->slug; ?>" role="article" itemscope itemtype="http://schema.org/WebPage">
<?php }?>
	<header class="article-header col s12 center">

		<h1 class="h4 resource-title"
		<?php echo 'itemprop="headline"';?>>
		<?php the_title();?></h1>
		<?php

		if(is_user_logged_in()) {
			get_template_part( 'parts/content', 'edit' );
		}
		?>
		<?php

		echo '<div class="resources-meta">';

		if($terms) {
			echo '<i class="mdi mdi-tag-multiple"></i> ';
			foreach ($terms as $term) {
				if ($term->parent === 0) {
						echo '<a href="' . get_term_link($term->term_id) . '" class="chip">' . $term->name . '</a>';
				} else {
					echo '<a href="' . get_term_link($term->term_id) . '" class="chip">' . $term->name . '</a>';
				}
			}
		}

		if($queried_object->post_parent === 0 ) {
				echo '<br /><i class="mdi mdi-information"></i><span>' . __( 'Last updated on ', 'ocn' ) . get_the_modified_time('F j, Y') . '</span></div>';
		} else {
				echo '<br /><i class="mdi mdi-information"></i><span>' . __( ' This page is part of the ', 'ocn' ) . '<strong>' . $guide . '</strong>' . __( ' guide and was last updated on ', 'ocn' ) . get_the_modified_time('F j, Y') . '</span></div>';
		}

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
		//echo '<div class="col s12 m12 grey lighten-5 index-wrapper">';
	$pages = array($post->ID );
		?>

<div>
	<div class="guide-wrapper no-print">

			<ol id="guide-contents">
				<li class="block label black-text"><?php echo __( 'Guide Index', 'ocn' );?></li>
				<li id="parent-<?php the_ID(); ?>" data-read="ocn-<?php the_ID(); ?>" class="parent">

						<?php echo '<span class="active-page">' . __( 'Introduction', 'ocn' ) . '</span>'; ?>

				</li>

			<?php while ( $parent->have_posts() ) : $parent->the_post();
$pages[] += get_the_ID();
			?>

					<li id="parent-<?php the_ID(); ?>" data-read="ocn-<?php the_ID(); ?>">

							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>

					</li>


			<?php endwhile;

			 ?>
		 </ol>


	<div class="page-actions no-print">

	<?php if(($parent_ID === 0) && $children){
	echo	'<a href="' . get_field('print_page_url', 'option') . '" class="btn-flat purple darken-1"><i class="mdi mdi-printer left"></i>Print full guide</a>';
	} else {
	 echo '<button class="btn-flat purple darken-1 " onclick="printFunction()"><i class="mdi mdi-printer left"></i>Print this page</button>';
	};
	?>

		<!-- <a href="https://twitter.com/intent/tweet?url=<?php echo get_permalink(); ?>&via=<?php echo get_theme_mod( 'tcx_twitter_handle' );?>&text=<?php the_title(); ?>" aria-label="Share this content on Twitter"><i aria-hidden="true" class="mdi mdi-twitter left"></i><span class="hide-on-small-and-down">Share on Twitter </span></a>

	 <a  href="mailto:?subject=I wanted to share this post with you from <?php bloginfo('name'); ?>&body=<?php the_title('','',true); ?>&#32;&#32;<?php echo wp_get_shortlink() ?>" aria-label="Email this content to a friend or colleague"><i aria-hidden="true" class="mdi mdi-email left"></i><span class="hide-on-small-and-down">Share by email </span></a>

		<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo wp_get_shortlink() ?>" aria-label="Share this content on Facebook"><i aria-hidden="true" class="mdi mdi-facebook left"></i><span class="hide-on-small-and-down">Share on Facebook</span></a> -->

		</div>
	</div>
</div>
<?php endif; wp_reset_postdata();?>
<?php } else {
	echo '<div>
					<div class="guide-wrapper no-print">';
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
			<li class="block label black-text"><?php echo __( 'Guide Index', 'ocn' );?></li>
				<li class="parent" data-read="ocn-<?php echo $post->post_parent; ?>">
					<a href="<?php the_permalink($post->post_parent); ?>" title="<?php echo get_the_title($post->post_parent); ?> - Introduction"><?php echo __( 'Introduction', 'ocn' );?></a>
				</li>

				<?php while ( $parent->have_posts() ) : $parent->the_post();

					if ($ID === get_the_ID()){?>
						<li id="parent-<?php the_ID(); ?>" data-read="ocn-<?php the_ID(); ?>">

									<?php echo '<span class="active-page">' . get_the_title() . '</span>'; ?>

						</li>

				<?php	} else {?>
					<li id="parent-<?php the_ID(); ?>" data-read="ocn-<?php the_ID(); ?>">

							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>

					</li>

				<?php }?>


				<?php endwhile; ?>
			</ol>

		<?php endif; wp_reset_postdata();?>

		<div class="page-actions no-print">

		<?php if(($parent_ID === 0) && $children){
		echo	'<a href="' . get_field('print_page_url', 'option') . '" class="btn-flat purple darken-1 "><i class="mdi mdi-printer left"></i>Print full guide</a>';
		} else {
		 echo '<button class="btn-flat purple darken-1 " onclick="printFunction()"><i class="mdi mdi-printer left"></i>Print this page</button>';
		};
		?>

			</div>
		</div>
	</div>

<?php }


		 ?>


<section class="entry-content" itemprop="articleBody">

<?php


$featImage = get_the_post_thumbnail_url(get_the_ID(),'full');
	if($featImage) {
		echo '<img class="print-image hide" src="' . $featImage . '" />';
	}
?>

<?php

$show_toc = get_field('show_toc');
		if ($show_toc):
		//	echo '<div class="col s12 m12 grey lighten-4 index-wrapper">';
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
						echo '<div class="col s12 grey lighten-5 index-wrapper no-print"><ol id="toc">
						<li class="block label black-text">' . __( 'What\'s on this page?', 'ocn' ) . '</li>';
	     // loop through the rows of data
	    while ( have_rows('blocks') ) : the_row();

	        if( get_row_layout() == 'heading_block' ):

	        	echo '<li><a class="toc-' . get_sub_field('heading_size') . '" href="#heading-' . get_row_index() . '">' . get_sub_field('heading') . '</a></li>';

	        endif;



	    endwhile;
			echo '</ol></div>';
	else :

	    // no layouts found

	endif;

		     endwhile;

		 else :

		     // no rows found

		 endif;
	//	 echo '</div>';
		endif;
?>
	 <!-- flexible content -->
<?php
	 // check if the repeater field has rows of data
	 if( have_rows('section') ):
	  	// loop through the rows of data
	  while ( have_rows('section') ) : the_row();
	         // display a sub field value
			if( have_rows('blocks') ): // check if flexible content has rows of data
			$rows = get_field('heading_block');
     // loop through the rows of data
    		while ( have_rows('blocks') ) : the_row(); //starting looping through flexible content

        	if( get_row_layout() == 'heading_block' ):  // start heading block

						echo '<' . get_sub_field('heading_size') . ' id="heading-' . get_row_index() . '">' . get_sub_field('heading') . '</' . get_sub_field('heading_size') . '>';

        	endif; // end heading block


					if( get_row_layout() == 'text_block' ): // start text block

        		echo '<div class="content_block">' . get_sub_field('content') . '</div>';

        	endif; // end text block

					if( get_row_layout() == 'video_block' ): //start video block

					echo '<div class="video-container">' . get_sub_field('video_url') . '</div>
					<div class="content_block center grey lighten-5">' . get_sub_field('video_caption') . '</div>';

					endif; //end video block

					if( get_row_layout() == 'note_block' ): //start note block

						$note_heading = get_sub_field('note_heading');
						$note = get_sub_field('note', false, false);

						if($note_heading):
						echo '<div class="info note-content grey lighten-5"><span class="note-title"><i class="hide-on-small-and-down material-icons left red-text lighten-4">live_help</i>' . $note_heading . '</span>';
						endif;

						if($note):
						echo '<div class="note-intro">' . get_sub_field('note', false, false) . '</div>';
						endif;

						if( have_rows('note_upload') ):

							echo '<ul class="note_unordered">';
							 	// loop through the rows of data
							  while ( have_rows('note_upload') ) : the_row();

							    $file_link = get_sub_field('file_source');
									$file_type = $file_link['mime_type'];

									echo '<li><a href="' . $file_link['url'] . '"><i class="material-icons left">folder</i>Download ' . $file_link['title'] . '</a></li>';

							   endwhile;

							echo '</ul>';

							else :
							    // no rows found
							endif;

							if( have_rows('note_link') ):

								echo '<ul class="note_unordered">';
							 	// loop through the rows of data
							    while ( have_rows('note_link') ) : the_row();

										echo '<li><a href="' . get_sub_field('link_url') . '"><i class="material-icons left">check_circle_outline</i>' . get_sub_field('link_text') . '</a></li>';

							    endwhile;

							echo '</ul>';

							else :
							    // no rows found
							endif;

							echo '</div>';

					endif; // end note block

					if( get_row_layout() == 'steps_block' ): //start steps block

							if( have_rows('step') ): // check if the step repeater field has rows of data

								echo
								'<div class="steps_block">
									<ol class="steps">';
				 	// loop through the rows of data
							    while ( have_rows('step') ) : the_row();

										echo '<li>' . get_sub_field('step_description') .  '</li>';

							    endwhile;

									echo
										'</ol>
									</div>';

								else :

				    // no rows found

						endif; // end step repeater

						endif; // end steps block

						if( get_row_layout() == 'available_platforms' ): //start available_platforms block

								echo '<div class="available_platforms"><p>' . get_sub_field('platform_text') .  '</p>';

								if( have_rows('apps') ): // check if the apps repeater field has rows of data

									echo
									'<ul class="apps no-pad">';
						// loop through the rows of data
										while ( have_rows('apps') ) : the_row();
										$platforms = get_sub_field('app_name');

											if($platforms['value'] === 'ios'):
											echo '<li>
											<a href="' . get_sub_field('app_link') . '"><span class="mdi mdi-apple-ios"></span>' . $platforms['label'] . '</a>
											</li>';
											endif;

											if($platforms['value'] === 'android'):
												echo '<li>
												<a href="' . get_sub_field('app_link') . '"><span class="mdi mdi-android"></span>' . $platforms['label'] . '</a>
												</li>';

											endif;

											if($platforms['value'] === 'amazon'):
												echo '<li>
												<a href="' . get_sub_field('app_link') . '"><span class="mdi mdi-amazon"></span>' . $platforms['label'] . '</a>
												</li>';

											endif;

										endwhile;

										echo
											'</ul>';

									else :

							// no rows found

						endif; // end apps repeater
							echo '</div>';
						endif; // end available_platforms block


						if( get_row_layout() == 'recommendation_block' ): // start recommendation block

							$block_title = get_sub_field('block_title');

							if( have_rows('recommendation_add') ): // check if the recommendation_add repeater field has rows of data

								echo '<div class="info note-content grey lighten-5"><strong class="note-title">' . $block_title . '</strong>';
							 	// loop through the rows of data
							    while ( have_rows('recommendation_add') ) : the_row();

							        $rec_link = get_sub_field('recommended_product_guide');
											$rec_desc = get_sub_field('recommended_product_description');
											$rec_product_logo = get_sub_field('recommended_product_logo');
											$rec_name = get_sub_field('recommended_product_name');

											echo '<div class="flex product col s12">';

											if($rec_product_logo) {
												echo '<img src="' . $rec_product_logo . '" />';
											}

											if($rec_link) {
												echo '<a class="product_link" href="' . $rec_link . '" data-note="View the guide to using ' . $rec_name . '">' . $rec_name . '</a>';
											} else {
													echo '<span class="block product_link">' . $rec_name . '</span>';
											}

											if($rec_desc) {
												echo '<p>' . $rec_desc . '</p>';
											}

											echo '</div>';

							    endwhile;
									echo '</div>';
							else :
							    // no rows found
							endif; // end the recommendation_add repeater

						endif; // end recommendation block


				if( get_row_layout() == 'image_block' ): //start image_block
					$markers_desc = [];
					$emptyArray = [[]];
					echo '<div class="row grey lighten-3 image_guide">';
					echo '<div class="pink col s6 image_wrapper" style="position: relative;">';
					echo '<figure class="card"><img src="' . get_sub_field('image') . '" />
					<figcaption class="grey lighten-5"><i class="material-icons left">camera_alt</i>' . get_sub_field('caption') . '</figcaption></figure>';

					if( have_rows('markers') ):
							echo '<button class="btn-flat info markers" style="position: absolute;" data-id="marker-intro"><i class="material-icons">error_outline</i></button>';
					 	// loop through the rows of data
					    while ( have_rows('markers') ) : the_row();
								$marker_ID = get_sub_field('left_position') * get_row_index();
								$marker_desc[] = '<li id="marker-' . $marker_ID . '"><span class="block h6">Step ' . get_row_index() . '</span>' . get_sub_field('marker_description') . '</li>';
								echo '<button class="btn-floating small markers" style="position: absolute; left: ' . get_sub_field('left_position') . '%; top:' . get_sub_field('top_position') . '%;" data-id="marker-' . $marker_ID . '"><i class="material-icons">add</i></button>';

					    endwhile;

							else :

					    // no rows found

						endif; // end markers
					echo '</div>';

					if($marker_desc) {
						echo '<ul class="marker-desc col s6"><li id="marker-intro" class="intro-desc active-desc"><span class="block h6">Guide</span>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in" voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
						</li>';
						foreach ($marker_desc as $key=>$value) {
								echo $value;
						}
						echo '</ul>';
					}

					echo '</div>';

				endif; //end image_block

    endwhile; // end flexible content loop

		else :
    // no layouts found
	endif; // end flexible content

endwhile; // end section repeater loop

else :

	     // no rows found

endif; // end section repeater

?>

	<?php

// New activities fields moved out from flexible content

// check if the group field has rows of data




			if($calendar) {
				$title = get_the_title();
				$calLabel = array();
				$calValue = array();

				  foreach ($calendar as $cal) {
				 		$calLabel[] = $cal['label'];
						$calValue[] = $cal['value'];
				}

				echo '<div class="activity-calendar"><button onclick="openFullOcn()" class="btn purple darken-1" id="fullCalendar" data-organisation="' . implode(",",$calValue) . '">' . __( 'View The ', 'ocn' ) . implode(" + ",$calLabel) . __( ' Activities Calendar', 'ocn' ) . '</button></div>';
			}


	 ?>

<?php

resources_page_nav();
?>



</div>
<?php
if (comments_open()){
	comments_template();
}
?>

<script>
function openFullOcn() {
let org = document.getElementById("fullCalendar").getAttribute('data-organisation');
document.getElementById("maincontent").classList.add('cal-print');

_tkf.openFullScreen({path:'/ocnstirling?tags=' +org});

}
</script>
</section>
<div class="print-footer hide">
	<?php
	if($queried_object->post_parent === 0 ) {
			echo '<span>' . __( 'This resource was last updated on ', 'ocn' ) . get_the_modified_time('F j, Y') . '</span><br />';
	} else {
			echo '<span>' . __( 'This resource is part of the ', 'ocn' ) . '<strong>' . $guide . '</strong>' . __( ' guide and was last updated on ', 'ocn' ) . get_the_modified_time('F j, Y') . '</span><br />';
	}
	 ?>
	The online version is available at:<br /><?php echo get_the_permalink(); ?>
	<div class="print-logo center">
		<img width="100"
		<?php $logo_image = get_theme_mod( 'tcx_logo_image' );
		if ($logo_image){?>
		src="<?php echo $logo_image;?>" alt=""
		<?php
		} else {?>
		src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.svg" alt=""
		<?php }?>
		/>
	</div>
</div>
</article>

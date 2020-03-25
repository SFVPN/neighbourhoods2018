<?php

/*
Template Name: Resources Print Page
*/

//If we create a link on parent resources pages pointing to the full print page template then url_to_postid(wp_get_referer()) should extract the id from the referring page and let us build the full guide for printing
// should probably then check that referring ID does belong to a parent resource before running the code below maybe with a progress animation for fanciness
$parent_page = url_to_postid(wp_get_referer()); // and then use $parent_page to build the page
get_header();

?>
<main id="maincontent" class="container">
	<div class="row">

		<?php
		if($parent_page) {
		$print_page = get_post($parent_page);
		$args = array(
		'post_parent' => $parent_page,
		'post_type' => 'resources'
	);
		$children_array = array();
		$children = get_children($args);
		foreach ($children as $child) {
			$children_array[] = $child->ID;
		}?>

		<div class="grey lighten-3 no-print" style="margin-top: 3rem; padding: 1rem;">
			<p>
				This is an automatically generated printable version of the full <strong><?php echo get_the_title($parent_page);?></strong> guide. This page is only generated when you click on the "Print Full Guide" button that is found on the introduction page of a resources with multiple pages.</p>

			<p>
				Single-page guides and the individual pages of larger guides can be printed directly from their respective pages using the "Print Page" button.
			</p>

			<p>
				Print this page by clicking on the button at the bottom right of the screen. You can either print the page normally or create a PDF and save it to your computer. To create a PDF, you should have the option to 'Save as PDF' or 'Print to PDF' when the printing options box opens.
			</p>


		</div>


		<div class="fixed-action-btn no-print">
			<button class="btn-floating hide-on-large-only" onclick="printFunction()"><i class="material-icons">print</i></button>
			<button class="btn hide-on-med-and-down" onclick="printFunction()">Print page</button>
		</div>


		<script>
		function printFunction() {
				window.print();
		}
		</script>

<div id="print_logo" class="center row responsive-img">
	<?php echo get_the_post_thumbnail($parent_page, 'full');?>
</div>

<?php	echo '<h1 class="print">' . get_the_title($parent_page) . '</h1>';
	  // check if the repeater field has rows of data
	  if( have_rows('section', $parent_page) ):



	 	//  foreach($rows as $row)
	 	// {
	 	// 	echo '<h2 class="green">' . $row['heading'] . '</h2>';
	 	// }


	 		// loop through the rows of data
	 		 while ( have_rows('section', $parent_page) ) : the_row();

	 				 // display a sub field value
	 				 if( have_rows('blocks', $parent_page) ):
	 					 $rows = get_field('heading_block', $parent_page);

	 	 // loop through the rows of data
	 	while ( have_rows('blocks', $parent_page) ) : the_row();

	 			if( get_row_layout() == 'heading_block' ):

	 					echo '<' . get_sub_field('heading_size', $parent_page) . ' id="heading-' . get_row_index() . '" class="print">' . get_sub_field('heading', $parent_page) . '</' . get_sub_field('heading_size', $parent_page) . '>';

	 			endif;

	 			if( get_row_layout() == 'text_block' ):

	 				the_sub_field('content', $parent_page);

	 			endif;

	 			if( get_row_layout() == 'note_block' ):

	 				$note_url = get_sub_field('note_url', $parent_page);

					echo '<div class="row"><div class="col s12 note-heading grey lighten-3 black-text">' . get_sub_field('note_heading', $parent_page) . '</strong></div> <div  class="col s12 note-content grey lighten-4 black-text ">' . get_sub_field('note', $parent_page);
					if($note_url) {
						echo '<a class="block" href="' . $note_url . '"><i class="material-icons left">arrow_forward</i>Click on this link for more information</a>';
					}
					if( have_rows('note_upload') ):

						// loop through the rows of data
							while ( have_rows('note_upload') ) : the_row();

									$file_link = get_sub_field('file_source', $parent_page);
									$file_type = $file_link['mime_type'];

									echo '<a class="block" href="' . $file_link['url'] . '"><i class="material-icons left">folder</i>Download ' . $file_link['title'] . '</a>';


							endwhile;

					else :

							// no rows found

					endif;

					if( have_rows('note_link') ):

						// loop through the rows of data
							while ( have_rows('note_link') ) : the_row();

									echo '<a class="block" href="' . get_sub_field('link_url', $parent_page) . '"><i class="material-icons left">arrow_forward</i>' . get_sub_field('link_text', $parent_page) . '</a>';


							endwhile;

					else :

							// no rows found

					endif;

					echo '</div></div>';


	 			endif;

				if( get_row_layout() == 'recommendation_block' ):

					$block_title = get_sub_field('block_title', $parent_page);
				// check if the repeater field has rows of data
				if( have_rows('recommendation_add') ):

					echo '<div class="row recommendation"><div class="col s12 note-heading grey lighten-3"><i class="material-icons left">done_all</i><strong>' . $block_title . '</strong></div> <div  class="col center s12 note-content grey lighten-4">';
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

					echo '<div class="row recommendation"><div class="col s12 note-heading grey lighten-3"><i class="material-icons left">done_all</i><strong>' . $overview_title . '</strong></div> <div class="col center s12 note-content grey lighten-4">';
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

	 			if( get_row_layout() == 'image_block' ):

	 				echo '<figure class="card"><img src="' . get_sub_field('image', $parent_page) . '" />
	 				<figcaption class="grey lighten-4"><i class="material-icons left">camera_alt</i>' . get_sub_field('caption', $parent_page) . '</figcaption></figure>';

	 			endif;

	 	endwhile;

	 else :

	 	// no layouts found

	 endif;

	 echo '<div style=""></div>'; // adds a div after the intro page of the guide to create a page break when printing

	 		 endwhile;

	  else :

	 		 // no rows found

	  endif;

	  ?>
		
		<?php

		foreach($children_array as $child)
		{

			echo '<h1 class="print">' . get_the_title($child) . '</h1>';

		if( have_rows('section', $child) ):

			// loop through the rows of data
			 while ( have_rows('section', $child) ) : the_row();

					 // display a sub field value
					 if( have_rows('blocks', $child) ):
						 $rows = get_field('heading_block', $child);
						 //print_R($rows);
		 // loop through the rows of data
		while ( have_rows('blocks', $child) ) : the_row();

				if( get_row_layout() == 'heading_block' ):

						echo '<' . get_sub_field('heading_size', $child) . ' id="heading-' . get_row_index() . '" class="print">' . get_sub_field('heading', $child) . '</' . get_sub_field('heading_size', $child) . '>';

				endif;

				if( get_row_layout() == 'text_block' ):

					the_sub_field('content', $child);

				endif;

				if( get_row_layout() == 'note_block' ):

					$note_url = get_sub_field('note_url', $child);

					echo '<div class="row "><div class="col s12 note-heading grey lighten-3 black-text">' . get_sub_field('note_heading', $child) . '</strong></div> <div  class="col s12 note-content grey lighten-4 black-text ">' . get_sub_field('note', $child);
					if($note_url) {
						echo '<a class="block" href="' . $note_url . '"><i class="material-icons left">arrow_forward</i>Click on this link for more information</a>';
					}
					if( have_rows('note_upload') ):

						// loop through the rows of data
							while ( have_rows('note_upload') ) : the_row();

									$file_link = get_sub_field('file_source', $child);
									$file_type = $file_link['mime_type'];

									echo '<a class="block" href="' . $file_link['url'] . '"><i class="material-icons left">folder</i>Download ' . $file_link['title'] . '</a>';


							endwhile;

					else :

							// no rows found

					endif;

					if( have_rows('note_link') ):

						// loop through the rows of data
							while ( have_rows('note_link') ) : the_row();

									echo '<a class="block" href="' . get_sub_field('link_url', $child) . '"><i class="material-icons left">arrow_forward</i>' . get_sub_field('link_text', $child) . '</a>';


							endwhile;

					else :

							// no rows found

					endif;

					echo '</div></div>';


				endif;

				if( get_row_layout() == 'image_block' ):

					echo '<figure class="card"><img src="' . get_sub_field('image', $child) . '" />
					<figcaption class="grey lighten-4"><i class="material-icons left">camera_alt</i>' . get_sub_field('caption', $child) . '</figcaption></figure>';

				endif;

		endwhile;

		else :

		// no layouts found

		endif;

		echo '<div style=""></div>'; // adds a div after each page of the guide to create a page break when printing

			 endwhile;

		else :

			 // no rows found

		endif;
}

} else {
	echo '<div class="grey lighten-3 col s12 no-print">
		<p>
			This is the page used to automatically generate printable versions of full resource guides. These are generated on demand when you click on the "Print Full Guide" button that is found on the introduction page of a resources with multiple pages.  You can explore are resources at <a href="' . get_post_type_archive_link( 'resources' ) . '">this link</a></p>


	</div>';
}
		?>

		<footer class="grey lighten-4" style="text-align: center; padding: 1rem;">
			This resource is produced by <strong>Our Connected Neighbourhoods</strong><br />
			For more information please visit <a href="<?php echo get_home_url(); ?>"><?php echo get_home_url(); ?></a><br />
			Date printed: <?php echo date("d F, Y");?>
		</footer>


	</div>
	</main> <!-- end main -->


<?php get_footer(); ?>

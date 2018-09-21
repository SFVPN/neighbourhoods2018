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
	<div class="row" style="margin-top: 6rem;">


		<?php
		if($parent_page) {
		$print_page = get_post($parent_page);
		$children_array = array();
		$children = get_children($parent_page);
		foreach ($children as $child) {
			$children_array[] = $child->ID;
		}?>

		<div class="grey lighten-3 col s12 no-print">
			<p>
				This is an automatically generated printable version of the full <?php echo get_the_title($parent_page);?> guide. This page is only generated when you click on the "Print Full Guide" button that is found on the introduction page of a resources with multiple pages.</p>

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

<?php	echo '<h1 class="h2 grey-text text-darken-2">' . get_the_title($parent_page) . '</h1>';
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

	 					echo '<' . get_sub_field('heading_size', $parent_page) . ' id="heading-' . get_row_index() . '" class="h4">' . get_sub_field('heading', $parent_page) . '</' . get_sub_field('heading_size', $parent_page) . '>';

	 			endif;

	 			if( get_row_layout() == 'text_block' ):

	 				the_sub_field('content', $parent_page);

	 			endif;

	 			if( get_row_layout() == 'note_block' ):
	 				$note_type = get_sub_field('note_type', $parent_page);
	 				$note_url = get_sub_field('note_url', $parent_page);

	 				if($note_type[value] === 'tip') {
	 					echo '<div class="row ' . $note_type[value] . '"><div id="note-heading" class="col s12 yellow lighten-1"><i class="material-icons left">bookmark</i><strong>' . $note_type[label] . '</strong></div> <div id="note-content" class="col s12 grey lighten-4">' . get_sub_field('note');
	 					if($note_url) {
	 						echo '<a class="block" href="' . $note_url . '"><i class="material-icons left">arrow_forward</i>Click on this link for more information</a>';
	 					}
	 					echo '</div></div>';
	 				}

	 				if($note_type[value] === 'warning') {
	 					echo '<div class="row ' . $note_type[value] . '"><div id="note-heading" class="col s12 red lighten-1 white-text"><i class="material-icons left">warning</i><strong>' . $note_type[label] . '</strong></div> <div id="note-content" class="col s12 grey lighten-4">' . get_sub_field('note');
	 					if($note_url) {
	 						echo '<a class="block" href="' . $note_url . '"><i class="material-icons left">arrow_forward</i>Click on this link for more information</a>';
	 					}
	 					echo '</div></div>';
	 				}

	 				if($note_type[value] === 'recommendation') {
	 					echo '<div class="row ' . $note_type[value] . '"><div id="note-heading" class="col s12 green lighten-1 white-text"><i class="material-icons left">thumb_up</i><strong>' . $note_type[label] . '</strong></div> <div id="note-content" class="col s12 grey lighten-4">' . get_sub_field('note');
	 					if($note_url) {
	 						echo '<a class="block" href="' . $note_url . '"><i class="material-icons left">arrow_forward</i>Click on this link for more information</a>';
	 					}
	 					echo '</div></div>';
	 				}

	 				if($note_type[value] === 'link') {
	 						echo '<div class="row ' . $note_type[value] . '"><div id="note-heading" class="col s12 blue lighten-1 white-text"><i class="material-icons left">link</i><strong>' . $note_type[label] . '</strong></div> <div id="note-content" class="col s12 grey lighten-4">' . get_sub_field('note');
	 						if($note_url) {
	 							echo '<a class="block" href="' . $note_url . '"><i class="material-icons left">arrow_forward</i>Click on this link for more information</a>';
	 						}
	 						echo '</div></div>';
	 				}

	 				if($note_type[value] === 'info') {
	 						echo '<div class="row ' . $note_type[value] . '"><div id="note-heading" class="col s12 grey darken-2 white-text"><i class="material-icons left">info</i><strong>' . $note_type[label] . '</strong></div> <div id="note-content" class="col s12 grey lighten-4">' . get_sub_field('note');
	 						if($note_url) {
	 							echo '<a class="block" href="' . $note_url . '"><i class="material-icons left">arrow_forward</i>Click on this link for more information</a>';
	 						}
	 						echo '</div></div>';
	 				}



	 			endif;

	 			if( get_row_layout() == 'image_block' ):

	 				echo '<figure class="card"><img src="' . get_sub_field('image', $parent_page) . '" />
	 				<figcaption class="grey lighten-4"><i class="material-icons left">camera_alt</i>' . get_sub_field('caption', $parent_page) . '</figcaption></figure>';

	 			endif;

	 	endwhile;

	 else :

	 	// no layouts found

	 endif;

	 echo '<div style="page-break-after: always;"></div>'; // adds a div after the intro page of the guide to create a page break when printing

	 		 endwhile;

	  else :

	 		 // no rows found

	  endif;

	  ?>



		<?php

		foreach($children_array as $child)
		{

			echo '<h1 class="h2 grey-text text-darken-2">' . get_the_title($child) . '</h1>';

		if( have_rows('section', $child) ):


		//  foreach($rows as $row)
		// {
		// 	echo '<h2 class="green">' . $row['heading'] . '</h2>';
		// }


			// loop through the rows of data
			 while ( have_rows('section', $child) ) : the_row();

					 // display a sub field value
					 if( have_rows('blocks', $child) ):
						 $rows = get_field('heading_block', $child);
						 print_R($rows);
		 // loop through the rows of data
		while ( have_rows('blocks', $child) ) : the_row();

				if( get_row_layout() == 'heading_block' ):

						echo '<' . get_sub_field('heading_size', $child) . ' id="heading-' . get_row_index() . '" class="h4">' . get_sub_field('heading', $child) . '</' . get_sub_field('heading_size', $child) . '>';

				endif;

				if( get_row_layout() == 'text_block' ):

					the_sub_field('content', $child);

				endif;

				if( get_row_layout() == 'note_block' ):
					$note_type = get_sub_field('note_type', $child);
					$note_url = get_sub_field('note_url', $child);

					if($note_type[value] === 'tip') {
						echo '<div class="row ' . $note_type[value] . '"><div id="note-heading" class="col s12 yellow lighten-1"><i class="material-icons left">bookmark</i><strong>' . $note_type[label] . '</strong></div> <div id="note-content" class="col s12 grey lighten-4">' . get_sub_field('note');
						if($note_url) {
							echo '<a class="block" href="' . $note_url . '"><i class="material-icons left">arrow_forward</i>Click on this link for more information</a>';
						}
						echo '</div></div>';
					}

					if($note_type[value] === 'warning') {
						echo '<div class="row ' . $note_type[value] . '"><div id="note-heading" class="col s12 red lighten-1 white-text"><i class="material-icons left">warning</i><strong>' . $note_type[label] . '</strong></div> <div id="note-content" class="col s12 grey lighten-4">' . get_sub_field('note');
						if($note_url) {
							echo '<a class="block" href="' . $note_url . '"><i class="material-icons left">arrow_forward</i>Click on this link for more information</a>';
						}
						echo '</div></div>';
					}

					if($note_type[value] === 'recommendation') {
						echo '<div class="row ' . $note_type[value] . '"><div id="note-heading" class="col s12 green lighten-1 white-text"><i class="material-icons left">thumb_up</i><strong>' . $note_type[label] . '</strong></div> <div id="note-content" class="col s12 grey lighten-4">' . get_sub_field('note');
						if($note_url) {
							echo '<a class="block" href="' . $note_url . '"><i class="material-icons left">arrow_forward</i>Click on this link for more information</a>';
						}
						echo '</div></div>';
					}

					if($note_type[value] === 'link') {
							echo '<div class="row ' . $note_type[value] . '"><div id="note-heading" class="col s12 blue lighten-1 white-text"><i class="material-icons left">link</i><strong>' . $note_type[label] . '</strong></div> <div id="note-content" class="col s12 grey lighten-4">' . get_sub_field('note');
							if($note_url) {
								echo '<a class="block" href="' . $note_url . '"><i class="material-icons left">arrow_forward</i>Click on this link for more information</a>';
							}
							echo '</div></div>';
					}

					if($note_type[value] === 'info') {
							echo '<div class="row ' . $note_type[value] . '"><div id="note-heading" class="col s12 grey darken-2 white-text"><i class="material-icons left">info</i><strong>' . $note_type[label] . '</strong></div> <div id="note-content" class="col s12 grey lighten-4">' . get_sub_field('note');
							if($note_url) {
								echo '<a class="block" href="' . $note_url . '"><i class="material-icons left">arrow_forward</i>Click on this link for more information</a>';
							}
							echo '</div></div>';
					}



				endif;

				if( get_row_layout() == 'image_block' ):

					echo '<figure class="card"><img src="' . get_sub_field('image', $child) . '" />
					<figcaption class="grey lighten-4"><i class="material-icons left">camera_alt</i>' . get_sub_field('caption', $child) . '</figcaption></figure>';

				endif;

		endwhile;

		else :

		// no layouts found

		endif;

		echo '<div style="page-break-after: always;"></div>'; // adds a div after each page of the guide to create a page break when printing

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



	</div>
	</main> <!-- end main -->


<?php get_footer(); ?>

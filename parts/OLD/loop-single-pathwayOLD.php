<?php
//$parent_id = wp_get_post_parent_id( $post_ID );
//$parent_title = get_the_title($parent_id;
 // storing this so we have it available in the other loops
?>
<article id="post-<?php the_ID(); ?>" class="<?php echo $post->post_name;?>" role="article" itemscope itemtype="http://schema.org/WebPage">
	<header class="article-header col s12 center">
		<h1 class="resource-title h2" itemprop="headline"><?php the_title();?></h1>
	</header> <!-- end article header -->

<style>

.article-header {
	display: none;
}

#acf-form {
	width: 70%;
	margin-left: 15%;
}

form#acf-form .acf-field .acf-label {
    text-align: left;
}

.acf-checkbox-list.acf-hl li label {
  background: whitesmoke;
  padding: .75rem 1rem;
  display: inline-block;
  border: 1px solid black;
	border-radius: 3px;
	cursor: pointer;
}

#cover-color {
	position: absolute !important;
  height: 1px;
  width: 1px;
  overflow: hidden;
  clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
  clip: rect(1px, 1px, 1px, 1px);
  white-space: nowrap; /* added line */
}


.acf-checkbox-list.acf-hl {
  display: grid;
  grid-template-columns: 1fr;
	grid-gap: 1rem;
}


.acf-checkbox-list.acf-hl li label.selected {
  background: cyan;
}

.acf-hl::before, .acf-hl::after, .acf-bl::before, .acf-bl::after, .acf-cf::before, .acf-cf::after {
    content: "";
    display: none;
    line-height: 0;
}


.categorychecklist-holder input + span {
  background: cyan;
  margin: 1rem 0;
  padding: .75rem 1rem;
}


.categorychecklist-holder input:checked + span {
  background: tomato;
  margin: 1rem 0;
  padding: .75rem 1rem;
}

.acf-taxonomy-field .acf-checkbox-list ul.children {
    padding-left: 0px;
}

form#acf-form [type="checkbox"] + span::before { display: none; }

form#acf-form [type="checkbox"] + span {
    position: relative;
    cursor: pointer;
    display: inline-block;
    height: auto;
    line-height: auto;
		padding: 1rem;
		color: black;
		text-transform: uppercase;
}

.acf-taxonomy-field .categorychecklist-holder {
    max-height: 100%;
}

.acf-field-group {
	background: transparent;
}

body {
  /* Set "my-sec-counter" to 0 */
  counter-reset: my-sec-counter;
}

h2::before {
  /* Increment "my-sec-counter" by 1 */

  //content: "Section " counter(my-sec-counter) ". ";
}

.print-page footer {
	line-height: 1cm;
	padding: 0;
	font-size: 1rem;
}

.print-page header {
	line-height: 1cm;
	padding: 0;

}

.print-page header h2 {
	font-size: 2rem;
}

.print-page footer:after {
  counter-increment: my-sec-counter;
  content: counter(my-sec-counter);
  display: block;
	position: absolute;
	left: 0;
	right: 0;
	top: 0;
	bottom: 0;
	text-align: center;

}

span#back-page-footer {
	position: absolute;
	color: #ededed;
	bottom: 0;
	left: 0;
	right: 0;
	text-align: center;
	padding: .5rem;
	font-size: .8rem;
}

div#logo-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;

    text-align: center;
}

#logo-grid figcaption {
    line-height: 1.15;
}

#logo-grid figure {
    border: 1px solid #ededed;
    border-radius: 3px;
    padding: 1rem;

}

#logo-grid img {
    height: 100px;
    max-width: 100%;
}



.print-page {
  border: 1px solid whitesmoke;
  padding: 2.54cm;
  margin: 1rem auto;
  position: relative;
	width: 210mm;
  height: 297mm;
	box-shadow: 0 1px 1px rgba(0,0,0,0.12),
              0 2px 2px rgba(0,0,0,0.12),
              0 4px 4px rgba(0,0,0,0.12),
              0 8px 8px rgba(0,0,0,0.12),
              0 16px 16px rgba(0,0,0,0.12);
}

.print-page footer {
  position: absolute;
  bottom: 2.54cm;
  left: 2.54cm;
  right: 2.54cm;
}

.print-page h2 {
	margin: 0;
}

.activity, .organisation {
  height: 6.86cm;
  margin: .5cm 0;
	width: 100%;
	background: #f5f5f5;
	position: relative;
	padding: .5rem;
	font-size: 12pt !important;
  border: 1px solid transparent;
	border-radius: 3px;
}

.activity p, .organisation p {
	font-size: 12pt;
	line-height: 1.5;
}



.activity span.cat, .organisation span.cat {
	position: absolute;
	right: .5rem;
	top: .5rem;
	padding: .1rem .5rem;
	border-radius: 3px;
}

.activity span.cat {
	background: pink;
}

.contact span {
	display: block;
}

.digital span.cat {
	background: lightgray;
}

.music span.cat, .support_organisation span.cat {
	background: cyan;
}


.options {
	position: fixed;
	background: white;
	left: 1rem;
	bottom: 1rem;
  border: 1px solid lightgray;
	border-radius: 3px;
	z-index: 1000;
	padding: .5rem;
}

.options .btn-flat {
	margin: .5rem;
	padding: 0 2rem;
	display: block;
}

label#cover-color-label {position: relative;}

/* label#cover-color-label:after {
    content: '';
    padding-left: 5px;
    display: inline-block;
    width: 20px;
    background: var(--report-cover-background);
    height: 20px;
    position: absolute;
    top: 8px;
    right: 6px;
    border-radius: 50%;
} */

#cover-color-label i {
	color: var(--report-cover-background);
}


.arts span.cat {
	background: pink;
}

.contact {
  position: absolute;
	border-top: 1px solid #666;
	left: 0;
	right: 0;
	bottom: 0;
	padding: .5em;
	line-height: 1.25;
}

.contact strong, .person {
	font-weight: 600;
}


.contact strong:after {
    content: ' : ';
}

#cover {
	position: relative;
	background: var(--report-cover-background);
}

.move {
		position: absolute !important;
    height: 0px;
    width: 0px;
    overflow: hidden;
    clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
    clip: rect(1px, 1px, 1px, 1px);
    white-space: nowrap; /* added line */
	box-shadow: 0 1px 1px rgba(0,0,0,0.12),
              0 2px 2px rgba(0,0,0,0.12),
              0 4px 4px rgba(0,0,0,0.12),
              0 8px 8px rgba(0,0,0,0.12),
              0 16px 16px rgba(0,0,0,0.12);

}

#cover h1 {
	margin: 0;
	padding: 0;
}

.cover-title {
	position: absolute;
	bottom: 0;
	left: 0;
	right: 0;
	padding: 2rem;
}

.cover-title span {
	display:block;

	font-size: 1.25em;
}

#zoom {
}
.zoom {
	transform: scale(.4, .4) !important;
	transform-origin: top;
 display: grid;
	grid-template-columns: 1fr 1fr;
	grid-gap: 2rem;
}

#funder-logos {
	display: none;
}


@page {
  size: A4;
  margin: 0;
}


@media print {
  html, body {
    width: 210mm;
    height: 297mm;
    margin: 0;
  }

	.options, .move {
		display: none;
	}

	.zoom {
		transform: scale(1);
	}

	.row {
		margin-bottom:0 !important;
	}

	.single article {
		margin-top: 0 !important;
	}
  .print-page {
		margin: 0;
     border: initial;
     border-radius: initial;
     width: initial;
     box-shadow: none;
     background: initial;
		 max-height: 100vh;
  }


	.print-page footer {
		display: block !important;
	}

	a:after {
		content: "";
	}
}

</style>

<div class="options">
	<input id="cover-color" type="color" value="#E91E63" oninput="reportbgChange(this.value)" /><label id="cover-color-label" class="btn-flat grey lighten-4" for="cover-color" ><i class="material-icons left">album</i>Cover Colour</label>
	<button id="print_it" class="btn-flat grey lighten-4" onclick="printThis()"><i class="material-icons left">print</i>Print</button>

	<button id="hide_it" class="btn-flat grey lighten-4" onclick="hideThis()"><i class="material-icons left">visibility</i>Show Cover</button>

	<button id="zoom_it" class="btn-flat grey lighten-4" onclick="zoomThis()"><i class="material-icons left">zoom_out</i>Zoom to fit</button>
</div>


<section itemprop="articleBody">
 <div>


	 <?php
	 $date = date('F d, Y');
	 the_content();?>



   <div id="zoom" >


		 <script>
		 		function printThis() {
					window.print();
				}

				function hideThis() {
					let cover = document.getElementById('cover');
					let button = document.getElementById('hide_it');
					cover.classList.toggle("move");
					if(button.outerHTML === '<button id="hide_it" class="btn-flat grey lighten-4" onclick="hideThis()"><i class="material-icons left">visibility_off</i>Hide Cover</button>') {
						button.outerHTML = '<button id="hide_it" class="btn-flat grey lighten-4" onclick="hideThis()"><i class="material-icons left">visibility</i>Show Cover</button>';
					} else {
						button.outerHTML = '<button id="hide_it" class="btn-flat grey lighten-4" onclick="hideThis()"><i class="material-icons left">visibility_off</i>Hide Cover</button>';
					}
				}

				function zoomThis() {
					let zoom = document.getElementById('zoom');
					let button = document.getElementById('zoom_it');
					zoom.classList.toggle("zoom");

					if(button.outerHTML === '<button id="zoom_it" class="btn-flat grey lighten-4" onclick="zoomThis()"><i class="material-icons left">zoom_out</i>Zoom to fit</button>') {
						button.outerHTML = '<button id="zoom_it" class="btn-flat grey lighten-4" onclick="zoomThis()"><i class="material-icons left">zoom_in</i>Fit to screen</button>';
					} else {
						button.outerHTML = '<button id="zoom_it" class="btn-flat grey lighten-4" onclick="zoomThis()"><i class="material-icons left">zoom_out</i>Zoom to fit</button>';
					}

				}

				function reportbgChange(val) {

    document.documentElement.style.setProperty('--report-cover-background', val);

}

		 </script>
	<div id="cover" class="move print-page">
		<div class="cover-title white">
			<h1 class="h3" contenteditable="true">The Stirling Pathway</h1>
			<?php echo '<span>' . $date . '</span>';?>
		</div>


	</div>
<?php

$categories = get_field( 'interests' );
		 function wpshout_fetch_posts_in_category_taxonomy() {
		 	// Fetch posts that have a value for the 'category' taxonomy
$categories = get_field( 'interests' );

 		 $args = array (
 			 'posts_per_page' => -1,
 			 'post_type' => 'resources',
			 'orderby' => 'title',
			 'order' => 'ASC',

 			 'tax_query' => array (
 				 array(
 				 'taxonomy' => 'resources_category',
 					 'field' => 'term_id',
 					 'terms' => $categories,
 				 )
 			 )
 		 );

		 	// Return fetched posts
		 	return get_posts( $args );
		 }

		 // Customize each of the fetched WP_Post objects: each will have a
		 // 'category' property containing the WP_Term object of its first category
		 function wpshout_add_category_term_objects_to_posts( $posts ) {
		 	foreach( $posts as $post_index => $current_post ) :
		 		// Get array of WP_Term category terms for the current post
		 		$terms = get_the_terms( $current_post, 'resources_category' );
		 		// Save the first WP_Term object to the WP_Post object
		 		$current_post->category = $terms[0];
		 		// Update the $posts array with the modified WP_Post object
		 		$posts[$post_index] = $current_post;
		 	endforeach;

		 	// Return array of modified WP_Post objects
		 	return $posts;
		 }

		 // Define sorting function to sort by category name
		 function wpshout_sort_posts_by_category( $a, $b ) {
		 	return strcmp(
		 		wp_strip_all_tags( $a->category->name ),
		 		wp_strip_all_tags( $b->category->name )
		 	);
		 }

		 // Call just-registered functions to get sorted array of WP_Post objects,
		 // then output with foreach()
		 function wpshout_output_posts_sorted_by_category() {
		 	$posts = wpshout_fetch_posts_in_category_taxonomy();

		 	// Return if no results
		 	if( ! is_array( $posts ) ) :
		 		return false;
		 	endif;

		 	// Add category WP_Term object as a property to each WP_Post object
		 	$posts = wpshout_add_category_term_objects_to_posts( $posts );

		 	// Sort posts by category name
		 	usort( $posts, 'wpshout_sort_posts_by_category' );

		 	// Call global $post variable
		 	global $post;

		 	// Loop through sorted posts and display using template tags
			$i = 0;
		 	foreach( $posts as $current_post ) :
				$i++;
		 		// Set $post global variable to the current post object
		 		$post = $current_post;
		 		// Set up "environment" for template tags
		 		setup_postdata( $post );
				$info = get_field('activity');
				$contacts = ($info['activity_contact']);

				//print_R($post);
		 		// Use template tags normally


				if($i == 1) {

					echo '<div class="print-page"><header><h2 class="start">Activities</h2></header><div class="activity ' . $post->category->slug . '"><h3 class="h6"><a href="' . get_the_permalink() . '">';
			 			the_title();
			 		echo '</a></h3>';
					echo $info['activity_description'];
					if($contacts) {
						echo '<div class="contact">';
						foreach($contacts as $contact) {
							$details = get_field('group_details', $contact);

							echo '<span class="person">' . $details['group_contact'] . '</span>';
							echo '<span class="email"><strong>Email</strong> ' . $details['group_email'] . '</span>';
							echo '<span class="phone"><strong>Telephone</strong> ' . $details['group_phone'] . '</span>';
							echo '<span class="website"><strong>Website</strong> <a href="' . $details['group_website'] . '">' . $details['group_website'] . '</a></span>';

						}
						echo '</div>';
					}
					echo '<span class="cat">' . $post->category->name . '</span></div>';


				} else if(($i % 3 != 0) && count($posts) != $i) {
					echo '<div class="activity ' . $post->category->slug . '"><h3 class="h6"><a href="' . get_the_permalink() . '">';
			 			the_title();
			 		echo '</a></h3>';
					echo $info['activity_description'];
					if($contacts) {
						echo '<div class="contact">';
						foreach($contacts as $contact) {
							$details = get_field('group_details', $contact);

							echo '<span class="person">' . $details['group_contact'] . '</span>';
							echo '<span class="email"><strong>Email</strong> ' . $details['group_email'] . '</span>';
							echo '<span class="phone"><strong>Telephone</strong> ' . $details['group_phone'] . '</span>';
							echo '<span class="website"><strong>Website</strong> <a href="' . $details['group_website'] . '">' . $details['group_website'] . '</a></span>';

						}
						echo '</div>';
					}
					echo '<span class="cat">' . $post->category->name . '</span></div>';

				} else if(($i % 3 == 0) && count($posts) != $i) {
					echo '<div class="activity ' . $post->category->slug . '"><h3 class="h6"><a href="' . get_the_permalink() . '">';
			 			the_title();
			 		echo '</a></h3>';
					echo $info['activity_description'];
					if($contacts) {
						echo '<div class="contact">';
						foreach($contacts as $contact) {
							$details = get_field('group_details', $contact);

							echo '<span class="person">' . $details['group_contact'] . '</span>';
							echo '<span class="email"><strong>Email</strong> ' . $details['group_email'] . '</span>';
							echo '<span class="phone"><strong>Telephone</strong> ' . $details['group_phone'] . '</span>';
							echo '<span class="website"><strong>Website</strong> <a href="' . $details['group_website'] . '">' . $details['group_website'] . '</a></span>';

						}
						echo '</div>';
					}
					echo '<span class="cat">' . $post->category->name . '</span></div>
					<footer class="page-end"></footer></div>
					<div class="print-page"><header class="page-start"></header>';
				} else if(count($posts) == $i) {
					echo '<div class="activity ' . $post->category->slug . '"><h3 class="h6"><a href="' . get_the_permalink() . '">';
			 			the_title();
			 		echo '</a></h3>';

					echo $info['activity_description'];
					if($contacts) {
						echo '<div class="contact">';
						foreach($contacts as $contact) {
							$details = get_field('group_details', $contact);

							echo '<span class="person">' . $details['group_contact'] . '</span>';
							echo '<span class="email"><strong>Email</strong> ' . $details['group_email'] . '</span>';
							echo '<span class="phone"><strong>Telephone</strong> ' . $details['group_phone'] . '</span>';
							echo '<span class="website"><strong>Website</strong> <a href="' . $details['group_website'] . '">' . $details['group_website'] . '</a></span>';

						}
						echo '</div>';
					}

					echo '<span class="cat">' . $post->category->name . '</span></div>
					<footer class="end section-end-' . $i % 3 . '"></footer></div>';
				}

		 	endforeach;

		 	// Reset global $post variable
		 	wp_reset_postdata();
		 }

		 // Call the outputting function wherever you want in your template file
		 wpshout_output_posts_sorted_by_category();


		 function organisation_posts () {

			 $args = array (
   			 'posts_per_page' => -1,
   			 'post_type' => 'resources',
  			 'orderby' => 'title',
  			 'order' => 'ASC',

   			 'tax_query' => array (
   				 array(
   				 'taxonomy' => 'resources_category',
   					 'field' => 'term_id',
   					 'terms' => 46,
   				 )
   			 )
   		 );

  		 	// Return fetched posts
  		 	$posts = get_posts( $args );

			// Return if no results
			if( ! is_array( $posts ) ) :
				return false;
			endif;

			// Call global $post variable
			global $post;

			// Loop through sorted posts and display using template tags
			$i = 0;
			foreach( $posts as $current_post ) :
				$i++;
				// Set $post global variable to the current post object
				$post = $current_post;
				// Set up "environment" for template tags
				setup_postdata( $post );
				$info = get_field('group_details');

				//print_R($post);
				// Use template tags normally
				if($i == 1) {

					echo '<div class="print-page"><header><h2 class="start">Organisations</h2></header><div class="organisation support_organisation"><h3 class="h6"><a href="' . get_the_permalink() . '">';
						the_title();
					echo '</a></h3>';
					echo '<p>' . $info['group_description'] . '</p>';

					echo '<div class="contact">';

						if($info['group_contact']):
						echo '<span class="person">' . $info['group_contact'] . '</span>';
						endif;

						if($info['group_email']):
						echo '<span class="email"><strong>Email</strong>' . $info['group_email'] . '</span>';
						endif;

						if($info['group_phone']):
						echo '<span class="phone"><strong>Telephone</strong>' . $info['group_phone'] . '</span>';
						endif;

						if($info['group_website']):
						echo '<span class="website"><strong>Website</strong><a href="' . $info['group_website'] . '">' . $info['group_website'] . '</a></span>';
						endif;

					echo '</div>';

					echo '<span class="cat">Organisation</span></div>';

				} else if(($i % 3 != 0) && count($posts) != $i) {
					echo '<div class="organisation support_organisation"><h3 class="h6"><a href="' . get_the_permalink() . '">';
						the_title();
					echo '</a></h3>';
					echo '<p>' . $info['group_description'] . '</p>';

					echo '<div class="contact">';

						if($info['group_contact']):
						echo '<span class="person">' . $info['group_contact'] . '</span>';
						endif;

						if($info['group_email']):
						echo '<span class="email"><strong>Email</strong>' . $info['group_email'] . '</span>';
						endif;

						if($info['group_phone']):
						echo '<span class="phone"><strong>Telephone</strong>' . $info['group_phone'] . '</span>';
						endif;

						if($info['group_website']):
						echo '<span class="website"><strong>Website</strong><a href="' . $info['group_website'] . '">' . $info['group_website'] . '</a></span>';
						endif;

					echo '</div>';

					echo '<span class="cat">Organisation</span></div>';

				} else if(($i % 3 == 0) && count($posts) != $i) {
					echo '<div class="organisation support_organisation"><h3 class="h6"><a href="' . get_the_permalink() . '">';
						the_title();
					echo '</a></h3>';
					echo '<p>' . $info['group_description'] . '</p>';

					echo '<div class="contact">';

						if($info['group_contact']):
						echo '<span class="person">' . $info['group_contact'] . '</span>';
						endif;

						if($info['group_email']):
						echo '<span class="email"><strong>Email</strong>' . $info['group_email'] . '</span>';
						endif;

						if($info['group_phone']):
						echo '<span class="phone"><strong>Telephone</strong>' . $info['group_phone'] . '</span>';
						endif;

						if($info['group_website']):
						echo '<span class="website"><strong>Website</strong><a href="' . $info['group_website'] . '">' . $info['group_website'] . '</a></span>';
						endif;

					echo '</div>';

					echo '<span class="cat">Organisation</span></div>
					<footer class="page-end"></footer></div>
					<div class="print-page"><header class="page-start"></header>';
				} else if(count($posts) == $i) {
					echo '<div class="organisation support_organisation"><h3 class="h6"><a href="' . get_the_permalink() . '">';
						the_title();
					echo '</a></h3>';

					echo '<p>' . $info['group_description'] . '</p>';

					echo '<div class="contact">';

						if($info['group_contact']):
						echo '<span class="person">' . $info['group_contact'] . '</span>';
						endif;

						if($info['group_email']):
						echo '<span class="email"><strong>Email</strong>' . $info['group_email'] . '</span>';
						endif;

						if($info['group_phone']):
						echo '<span class="phone"><strong>Telephone</strong>' . $info['group_phone'] . '</span>';
						endif;

						if($info['group_website']):
						echo '<span class="website"><strong>Website</strong><a href="' . $info['group_website'] . '">' . $info['group_website'] . '</a></span>';
						endif;

					echo '</div>';

					echo '<span class="cat">Organisation</span></div>
					<footer class="end section-end-' . $i % 3 . '"></footer></div>';
				}

			endforeach;

			// Reset global $post variable
			wp_reset_postdata();
		 }

		 organisation_posts ();
			 ?>
			 <div class="print-page">
				 <p>
					 These pages have been genereated based on the interests you chose in the Pathway Form. These are listed below.
				 </p>
<?php
				 $field = get_field_object('field_5e4ad49949cbe', $wp_query->posts[0]->ID);
$choices = [21, 25, 44, 45, 31, 32];
$interest = get_field('interests');

$result=array_diff($choices,$interest);

$i = 0;
echo '<ul>';
foreach($choices as $choice) {
		$term = get_term( $choice , 'resources_category' );
	if($choice === $result[$i]) {
		echo '<li class="block btn-flat"><i class="material-icons left">clear</i>' . $term->name . '</li>';
	} else {
		echo '<li class="block btn-flat "><i class="material-icons left">done</i>' . $term->name . '</li>';
	}
	$i++;
}
echo '</ul>';
?>

<p>
	You can change your choices by editing the form and saving this page to refresh the relevant information.
</p>
</div>
<div class="print-page">
 				  <?php if( have_rows('partner_member', 'option') ): ?>

 				  <div id="partner_members" class="row">
 				      <h2 class="h6 center">The Stirling Pathway is a collaboration between</h2>
							<div id="logo-grid">
 				  <?php while( have_rows('partner_member', 'option') ): the_row();
 				  $image = get_sub_field('partner_logo');
 				  $name = get_sub_field('partner_name');
 				  ?>




 				        <div>
									<figure>
										<img class="responsive-img" alt="<?php echo $image['alt']; ?>" src="<?php echo $image['url']; ?>"/>
										<figcaption>
											<?php echo $name;?>
										</figcaption>
									</figure>

 				        </div>



 				  <?php endwhile; ?>
					</div>
 				</div>

 				<?php endif; ?>
				<span id="back-page-footer">EH10 Made</span>
			 </div>



   </div>


<?php

 if(is_user_logged_in()) {
	if( current_user_can('editor') || current_user_can('administrator') ) {
	 	get_template_part( 'parts/content', 'edit' );
	}
}
 ?>

</section>
</article>

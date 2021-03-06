<?php
//$parent_id = wp_get_post_parent_id( $post_ID );
//$parent_title = get_the_title($parent_id;
 // storing this so we have it available in the other loops
?>
<article id="post-<?php the_ID(); ?>" class="<?php echo $post->post_name;?>" role="article" itemscope itemtype="http://schema.org/WebPage">
	<header class="article-header col s12 center">
		<h1 id="pathway-report" class="resource-title h2" itemprop="headline">The Stirling Pathway</h1>
	</header> <!-- end article header -->
<style>

.article-header {

}

#acf-form {
	width: 100%;
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


h3.h6 {
	font-size: 1rem;
margin: .5rem 0 1.5rem 0;
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



.print-page footer {
	line-height: 1cm;
	height: 1cm;
	padding: 0;
	font-size: 1rem;
}

.print-page header {
	line-height: 1cm;
	height: 1cm;
	padding: 0;
	display: flex;
	align-items: center;

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

.print-page ul {
  list-style-type: none;
  margin-left: 0;
  display: grid;
  grid-template-columns: 1fr 1fr;
  grid-gap: 1rem;

}

.print-page ul li {
  display: inline-flex;
  padding: 1rem;
  margin-left: 0;

  border-radius: 3px;
}

.not-chosen {
  background: whitesmoke;
}

.chosen {
  background: lightgreen;
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
	background: white;
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
	line-height: 1.35;
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

.support_organisation span.cat {
	background: cyan;
}


.options {
	position: fixed;
	background: white;
	left: 0rem;
	bottom: 0rem;
	right: 0;
	display: grid;
	grid-template-columns: repeat(6, 1fr);
  border: 1px solid lightgray;
	border-radius: 3px;
	z-index: 1000;

	grid-gap: 2rem;
	text-align: center;
	padding: 1rem;
}


.options .btn-flat {

	border-radius: 3px;
	text-transform: uppercase;
	font-weight: 600;
	text-decoration: none;
	border: 2px solid transparent;
	padding: 0 0.5rem;
}

.options label.btn-flat {
	position: relative;
	text-transform: uppercase;
	border: 2px solid var(--report-cover-background);
	cursor: pointer;
}

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
	background: white;
}

.cover-title span {
	display:block;

	font-size: 1.25em;
}

#zoom {
	position: relative;
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

.acf-field-group, .acf-field-taxonomy {

  min-height: 100vh;
	margin: 4em 0;
}

.acf-form-submit {
	display: flex;
align-items: center;
justify-content: center;
}

section {
	padding: 0;
}


.acf-fields.-border {
	border-color: transparent;
	background: transparent;
}

.acf-fields > .acf-field {
	border-top: none;
}

.acf-taxonomy-field .categorychecklist-holder {
	border: none;
}


.acf-checkbox-list.acf-bl input {
  display: none;
}


#acf-form-wrapper {
	padding: 4em 15%;
}

#acf-form-intro {
	padding: 3em 0;
}


#demo1, #demo2 {
  margin: 0 0 1em 0;
	border: 1px solid #777;
	border-radius: 3px;
}


#demo1 {

}

#pathway-report {
	padding: 5rem 0 ;
	text-align: center;
}

#demo1 label, #demo2 label {
  font-size: 2.25rem;
  padding: 1em 0.25em;
  text-transform: uppercase
}

#demo1 .acf-input label, #demo2 .acf-input label {
  font-size: 1em;
  padding: 0;
  text-transform: none;
}

#demo2 span {
	font-size: 1.5em;
}

input[type="checkbox"] {
  display: none;
}


/* .acf-button {
  border-radius: 50%;
  width: 300px;
  height: 300px;
  font-size: 1.25em;
} */


#site-content {
	overflow: visible;
}


#site-content {

}

.scroll-buttons a {
  display: inline-block;
  width: 35px;
  height: 35px;
	line-height: 35px;
	text-align: center;
	text-decoration: none;
	color: white;
  border-radius: 50%;
  background: tomato;
}

.scroll-buttons li {
  display: flex;
  align-items: center;
}

.scroll-buttons {
  list-style-type: none;
}

.profile-buttons {
  margin: 0 auto;
  width: 48em;
  list-style-type: none;
	display: grid;
	grid-template-columns: 1fr 1fr;

}

.profile-buttons li {
background: white;
  border-radius: 3px;
  border: 1px solid #777;
  font-size: 3rem;
  padding: 3rem 0;
  text-align: center;
}

#profile-cover {
	display:flex;

	align-items: center;
	height: calc(100vh - 100px);
}

article#post-1 {
	padding: 0;
}

#message {
	position: fixed;
	bottom: 6em;
	right: 2em;
	background: lightgreen;
	padding: 1em 1em 0 1em;
	border-radius: 3px;
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
		font-family: 'Arial';
  }

	.options, .move, #pathway-report, #acf-form-wrapper, #site-footer {
		display: none;
	}

	.zoom {
		transform: scale(1) !important;
		display: block;
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
		content: ""!important;
	}
}

</style>




<section itemprop="articleBody">

<div>
	<?php
  $date = date('F d, Y');
  ?>

	<div class="options">

 	<input id="cover-color" type="color" value="#E91E63" oninput="reportbgChange(this.value)" /><label id="cover-color-label" class="btn-flat grey lighten-4" for="cover-color" >Cover Colour</label>
 	<button id="print_it" class="btn-flat grey lighten-4" onclick="printThis()">Print</button>

 	<button id="hide_it" class="btn-flat grey lighten-4" onclick="hideThis()">Show Cover</button>

 	<button id="zoom_it" class="btn-flat grey lighten-4" onclick="zoomThis()">Zoom to fit</button>
	<a id="settings" href="#your-settings" class="btn-flat grey lighten-4">Update Settings</a>
	<a id="to-top" href="#pathway-report" class="btn-flat grey lighten-4">Back to top</a>
 </div>


   <div id="zoom" >


		 <script>

				// var element = document.body.querySelector('[data-name="preferences"]');
				// var element2 = document.body.querySelector('[data-name="interests"]');
				// console.log(element);
				// element.setAttribute("id", "demo1");
				// element2.setAttribute("id", "demo2");


		 		function printThis() {
					window.print();
				}

				function hideThis() {
					let cover = document.getElementById('cover');
					let button = document.getElementById('hide_it');
					cover.classList.toggle("move");
					if(button.outerHTML === '<button id="hide_it" class="btn-flat grey lighten-4" onclick="hideThis()">Hide Cover</button>') {
						button.outerHTML = '<button id="hide_it" class="btn-flat grey lighten-4" onclick="hideThis()">Show Cover</button>';
					} else {
						button.outerHTML = '<button id="hide_it" class="btn-flat grey lighten-4" onclick="hideThis()">Hide Cover</button>';
					}
				}

				function zoomThis() {
					let zoom = document.getElementById('zoom');
					let button = document.getElementById('zoom_it');
					zoom.classList.toggle("zoom");

					if(button.outerHTML === '<button id="zoom_it" class="btn-flat grey lighten-4" onclick="zoomThis()">Zoom to fit</button>') {
						button.outerHTML = '<button id="zoom_it" class="btn-flat grey lighten-4" onclick="zoomThis()">Fit to screen</button>';
					} else {
						button.outerHTML = '<button id="zoom_it" class="btn-flat grey lighten-4" onclick="zoomThis()">Zoom to fit</button>';
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


//print_R($categories);
		 function wpshout_fetch_posts_in_category_taxonomy() {
		 	// Fetch posts that have a value for the 'category' taxonomy
$user = wp_get_current_user();
$categories = get_field( 'interests');
//print_R($user);
if(!$categories) {
	$args = array (
		'posts_per_page' => -1,
		'post_type' => 'activities',
		'orderby' => 'title',
		'order' => 'ASC'
	);
} else {
	$args = array (
		'posts_per_page' => -1,
		'post_type' => 'activities',
		'orderby' => 'title',
		'order' => 'ASC',

		'tax_query' => array (
			array(
			'taxonomy' => 'interests',
				'field' => 'term_id',
				'terms' => $categories,
			)
		)
	);
}
		 	// Return fetched posts
		 	return get_posts( $args );
		 }

		 // Customize each of the fetched WP_Post objects: each will have a
		 // 'category' property containing the WP_Term object of its first category
		 function wpshout_add_category_term_objects_to_posts( $posts ) {
		 	foreach( $posts as $post_index => $current_post ) :
		 		// Get array of WP_Term category terms for the current post
		 		$terms = get_the_terms( $current_post, 'interests' );
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
				$contacts = get_field('activity_contact');

				//print_R($post);
		 		// Use template tags normally


				if($i == 1) {

					echo '<div class="print-page"><header><h2 class="start">Activities</h2></header><div class="activity ' . $post->category->slug . '"><h3 class="h6"><a href="' . get_the_permalink() . '">';
			 			the_title();
			 		echo '</a></h3>';
					the_field('introduction');
					if($contacts) {
						echo '<div class="contact">';
						foreach($contacts as $contact) {
							$name = get_field('contact_name', $contact);
							$email = get_field('contact_email', $contact);
							$landline = get_field('contact_landline', $contact);
							$website = get_field('contact_website', $contact);
							//$details = get_field('group_details', $contact);

							if($name):
							echo '<span class="person">' . $name . '</span>';
							endif;

							if($email):
							echo '<span class="email"><strong>Email</strong> ' . $email . '</span>';
							endif;

							if($landline):
							echo '<span class="phone"><strong>Telephone</strong> ' . $landline . '</span>';
							endif;

							if($website):
							echo '<span class="website"><strong>Website</strong> <a href="' . $website . '">' . $website . '</a></span>';
							endif;
						}
						echo '</div>';
					}
					echo '<span class="cat">' . $post->category->name . '</span></div>';
					if(count($posts) == $i) {
					echo 	'<footer class="page-end"></footer></div>';
					}


				} else if(($i % 3 != 0) && count($posts) != $i) {
					echo '<div class="activity ' . $post->category->slug . '"><h3 class="h6"><a href="' . get_the_permalink() . '">';
			 			the_title();
			 		echo '</a></h3>';
					the_field('introduction');
					if($contacts) {
						echo '<div class="contact">';
						foreach($contacts as $contact) {
							$name = get_field('contact_name', $contact);
							$email = get_field('contact_email', $contact);
							$landline = get_field('contact_landline', $contact);
							$website = get_field('contact_website', $contact);
							//$details = get_field('group_details', $contact);

							if($name):
							echo '<span class="person">' . $name . '</span>';
							endif;

							if($email):
							echo '<span class="email"><strong>Email</strong> ' . $email . '</span>';
							endif;

							if($landline):
							echo '<span class="phone"><strong>Telephone</strong> ' . $landline . '</span>';
							endif;

							if($website):
							echo '<span class="website"><strong>Website</strong> <a href="' . $website . '">' . $website . '</a></span>';
							endif;
						}
						echo '</div>';
					}
					echo '<span class="cat">' . $post->category->name . '</span></div>';

				} else if(($i % 3 == 0) && count($posts) != $i) {
					echo '<div class="activity ' . $post->category->slug . '"><h3 class="h6"><a href="' . get_the_permalink() . '">';
			 			the_title();
			 		echo '</a></h3>';
					the_field('introduction');
					if($contacts) {
						echo '<div class="contact">';
						foreach($contacts as $contact) {
							$name = get_field('contact_name', $contact);
							$email = get_field('contact_email', $contact);
							$landline = get_field('contact_landline', $contact);
							$website = get_field('contact_website', $contact);
							//$details = get_field('group_details', $contact);

							if($name):
							echo '<span class="person">' . $name . '</span>';
							endif;

							if($email):
							echo '<span class="email"><strong>Email</strong> ' . $email . '</span>';
							endif;

							if($landline):
							echo '<span class="phone"><strong>Telephone</strong> ' . $landline . '</span>';
							endif;

							if($website):
							echo '<span class="website"><strong>Website</strong> <a href="' . $website . '">' . $website . '</a></span>';
							endif;
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

					the_field('introduction');
					if($contacts) {
						echo '<div class="contact">';
						foreach($contacts as $contact) {
							$name = get_field('contact_name', $contact);
							$email = get_field('contact_email', $contact);
							$landline = get_field('contact_landline', $contact);
							$website = get_field('contact_website', $contact);
							//$details = get_field('group_details', $contact);

							if($name):
							echo '<span class="person">' . $name . '</span>';
							endif;

							if($email):
							echo '<span class="email"><strong>Email</strong> ' . $email . '</span>';
							endif;

							if($landline):
							echo '<span class="phone"><strong>Telephone</strong> ' . $landline . '</span>';
							endif;

							if($website):
							echo '<span class="website"><strong>Website</strong> <a href="' . $website . '">' . $website . '</a></span>';
							endif;
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
   			 'post_type' => 'organisations',
  			 'orderby' => 'title',
  			 'order' => 'ASC',

   			 // 'tax_query' => array (
   				//  array(
   				//  'taxonomy' => 'interests',
   				// 	 'field' => 'term_id',
   				// 	 'terms' =>'',
   				//  )
   			 // )
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

				$name = get_field('contact_name');
				$email = get_field('contact_email');
				$landline = get_field('contact_landline');
				$website = get_field('contact_website');


				//print_R($post);
				// Use template tags normally
				if($i == 1) {

					echo '<div class="print-page"><header><h2 class="start">Organisations</h2></header><div class="organisation support_organisation"><h3 class="h6"><a href="' . get_the_permalink() . '">';
						the_title();
					echo '</a></h3>';

					echo '<p>' . 	get_field('introduction') . '</p>';

					echo '<div class="contact">';

						if($name):
						echo '<span class="person">' . $name . '</span>';
						endif;

						if($email):
						echo '<span class="email"><strong>Email</strong>' . $email . '</span>';
						endif;

						if($landline):
						echo '<span class="phone"><strong>Telephone</strong>' . $landline . '</span>';
						endif;

						if($website):
						echo '<span class="website"><strong>Website</strong><a href="' . $website . '">' . $website . '</a></span>';
						endif;

					echo '</div>';

					echo '<span class="cat">Organisation</span></div>';

				} else if(($i % 3 != 0) && count($posts) != $i) {
					echo '<div class="organisation support_organisation"><h3 class="h6"><a href="' . get_the_permalink() . '">';
						the_title();
					echo '</a></h3>';

					echo '<p>' . 	get_field('introduction') . '</p>';

					echo '<div class="contact">';

						if($name):
						echo '<span class="person">' . $name . '</span>';
						endif;

						if($email):
						echo '<span class="email"><strong>Email</strong>' . $email . '</span>';
						endif;

						if($landline):
						echo '<span class="phone"><strong>Telephone</strong>' . $landline . '</span>';
						endif;

						if($website):
						echo '<span class="website"><strong>Website</strong><a href="' . $website . '">' . $website . '</a></span>';
						endif;

					echo '</div>';

					echo '<span class="cat">Organisation</span></div>';

				} else if(($i % 3 == 0) && count($posts) != $i) {
					echo '<div class="organisation support_organisation"><h3 class="h6"><a href="' . get_the_permalink() . '">';
						the_title();
					echo '</a></h3>';

					echo '<p>' . 	get_field('introduction') . '</p>';

					echo '<div class="contact">';

						if($name):
						echo '<span class="person">' . $name . '</span>';
						endif;

						if($email):
						echo '<span class="email"><strong>Email</strong>' . $email . '</span>';
						endif;

						if($landline):
						echo '<span class="phone"><strong>Telephone</strong>' . $landline . '</span>';
						endif;

						if($website):
						echo '<span class="website"><strong>Website</strong><a href="' . $website . '">' . $website . '</a></span>';
						endif;

					echo '</div>';

					echo '<span class="cat">Organisation</span></div>
					<footer class="page-end"></footer></div>
					<div class="print-page"><header class="page-start"></header>';
				} else if(count($posts) == $i) {
					echo '<div class="organisation support_organisation"><h3 class="h6"><a href="' . get_the_permalink() . '">';
						the_title();
					echo '</a></h3>';

					echo '<p>' . 	get_field('introduction') . '</p>';

					echo '<div class="contact">';

						if($name):
						echo '<span class="person">' . $name . '</span>';
						endif;

						if($email):
						echo '<span class="email"><strong>Email</strong>' . $email . '</span>';
						endif;

						if($landline):
						echo '<span class="phone"><strong>Telephone</strong>' . $landline . '</span>';
						endif;

						if($website):
						echo '<span class="website"><strong>Website</strong><a href="' . $website . '">' . $website . '</a></span>';
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

<!-- <div class="print-page">
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
			 </div> -->



   </div>

	 <div id="acf-form-wrapper">

		 <h2 style="padding-top: 5rem; text-align: center;" id="your-settings">Your Settings</h2>
		 <p id="acf-form-intro">
			 This report have been generated based on the interests you chose in the Pathway Form. If you want to change your choices, simply untick or tick the relevant boxes in the form below and then click on the 'Update' button. This will create a new report for you.
		 </p>
		 <?php acf_form(array(
			'field_groups' => array('group_5e4aa58a0a884'),
			'updated_message' => __("Settings updated", 'acf'),
	)); ?>




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

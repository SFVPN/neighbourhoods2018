<?php

/*
Template Name: Contact Page
*/


get_header(); ?>

<main  id="maincontent">
	<div class="row" role="main">

		<?php if (have_posts()) : while (have_posts()) : the_post();

			get_template_part( 'parts/loop', 'page-contact' );



			endwhile; endif;

		?>

		</div> <!-- end row -->

</main> <!-- end main -->

<?php get_footer(); ?>

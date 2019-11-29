<?php

/*
Template Name: Timeline
*/
get_header(); ?>

<main  id="maincontent">
	<div class="row" role="main">

		<?php if (have_posts()) : while (have_posts()) : the_post();

		get_template_part( 'parts/loop', 'page-timeline' );

		endwhile; endif;

		?>

	</div> <!-- end #mainrow -->
</main> <!-- end main -->

<?php get_footer(); ?>

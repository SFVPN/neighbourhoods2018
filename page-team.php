<?php

/*
Template Name: About Page
*/

get_header(); ?>

<main  id="maincontent">
	<div class="row" role="main">

		<?php if (have_posts()) : while (have_posts()) : the_post();

			get_template_part( 'parts/loop', 'page' );



			endwhile; endif;

		?>

		</div> <!-- end row -->

		<?php get_template_part( 'parts/content', 'team' ); ?>

			<?php get_template_part( 'parts/content', 'partners' ); ?>

</main> <!-- end main -->

<?php get_footer(); ?>

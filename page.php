<?php
get_header(); ?>

<main  id="maincontent">
	<div class="row" role="main">
		

		<?php if (have_posts()) : while (have_posts()) : the_post();

			get_template_part( 'parts/loop', 'page' );

			endwhile; endif;
			terms_child_list_compass('resources_category', 'neighbourhood-compass');
		?>

		</div> <!-- end row -->

</main> <!-- end main -->

<?php get_footer(); ?>

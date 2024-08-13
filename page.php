<?php
get_header(); ?>

<main  id="maincontent">
	<div class="row" role="main">
		

		<?php if (have_posts()) : while (have_posts()) : the_post();

			get_template_part( 'parts/loop', 'page' );

			endwhile; endif;
			if(function_exists('get_field')):
			terms_child_list_compass('resources_category', 'neighbourhood-compass');
			endif;
		?>

		</div> <!-- end row -->

</main> <!-- end main -->

<?php get_footer(); ?>

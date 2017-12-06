<?php
acf_form_head();

get_header(); ?>

<main class="row">

		<?php if (have_posts()) : while (have_posts()) : the_post();

		get_template_part( 'parts/loop', 'single' );

		endwhile; endif;

		?>


</main> <!-- end main -->

<?php get_footer(); ?>

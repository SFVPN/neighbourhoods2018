<?php
acf_form_head();

get_header(); ?>
<main id="maincontent">
	<div class="row">

		<?php if (have_posts()) : while (have_posts()) : the_post();

 //get_template_part( 'parts/loop', 'single' );
 get_template_part( 'parts/loop', 'single-' . get_post_type() );



		endwhile; endif;

		?>
	</div>


</main> <!-- end main -->


<?php get_footer(); ?>

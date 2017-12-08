<?php

get_header(); ?>

<main  id="maincontent" class="container">

	<div class="row">

		<div class="col s12" role="main">

		    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		    	<?php get_template_part( 'parts/loop', 'single' ); ?>


		</div>

		<?php //get_sidebar(); ?>

	<?php endwhile; ?>

	<?php endif; ?>

</div> <!-- end row -->

</main> <!-- end main -->

<?php get_footer(); ?>

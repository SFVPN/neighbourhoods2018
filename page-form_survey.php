<?php
/*
Template Name: Form - Survey
*/

acf_form_head();

get_header();


global $current_user;
get_currentuserinfo();
$url = get_permalink();
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

?>

<main  id="maincontent" class="row container">


	<section class="row" itemscope itemtype="http://schema.org/WebPage">


			<header class="resources-article-header col s12 center">


				<h1 class="page-title"><?php the_title(); ?></h1>


			</header> <!-- end article header -->



				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


<div class="entry-content col s12">



		<?php

			get_template_part( 'parts/form', 'survey' );


		endwhile; endif;
		?>


</div>

		    <?php // get_sidebar(); ?>

</div>

	</section>
</main> <!-- end main -->


<?php get_footer(); ?>

<?php
/*
Template Name: Home Page
*/
get_header();
?>

<main id="gettingStarted">
	<div class="row ">
		<div id="strapline" class="col s12">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<?php get_template_part( 'parts/loop', 'page-home' ); ?>



		</div> <!-- end #strapline -->
	</div> <!-- end row center -->

	<?php if( have_rows('front_page_bylines') ):?>
	<div id="intro-text" class="row yellow">
		<?php while ( have_rows('front_page_bylines') ) : the_row();?>
	<p>
		<i class="medium material-icons left <?php the_sub_field('icon_color');?> yellow-text" aria-hidden="true">arrow_forward</i> <?php the_sub_field('byline_text');?>
	</p>

	<?php
	endwhile;?>
	</div> <!-- end #section_title -->
	<?php
	else :
	 // no rows found
	endif;
	?>
 <?php endwhile; endif;

	if( have_rows('front_page_sections') ):?>
<div id="sections" class="row center">
		<?php while ( have_rows('front_page_sections') ) : the_row();?>



		<section id="<?php the_sub_field('section_title'); ?>" class="col s12 l6">


			<div class="col s12 section-details" >
				<div class="triangle">

				</div>
				<h4><?php the_sub_field('section_title'); ?></h4>

				<?php the_sub_field('section_description'); ?>
									<img src="<?php get_the_post_thumbnail_url(); ?>">
									<div class="col s12">
										<a class="btn-large z-depth-0 waves-effect " href="<?php the_sub_field('page_link'); ?>"><i class="material-icons left" aria-hidden="true"><?php the_sub_field('button_icon'); ?></i><?php the_sub_field('button_text'); ?></a>
									</div>

			</div> <!-- end col s12 l4 -->


		</section> <!-- end section -->





	<?php
endwhile;?>
	</div> <!-- end #section_title -->
	<?php
	else :
	 // no rows found
	endif;
	?>

</main> <!-- end main -->

<?php get_footer(); ?>

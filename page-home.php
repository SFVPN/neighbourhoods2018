<?php
/*
Template Name: Home Page
*/
get_header();
?>

<main id="maincontent">
	<div class="row ">

		<div id="strapline" class="col s12">


		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<?php get_template_part( 'parts/loop', 'page-home' ); ?>



		</div> <!-- end #strapline -->
	</div> <!-- end row center -->

	<div id="social_media_contact" class="row center">
	<?php
	$facebook = get_field('facebook', 'option');
	$twitter = get_field('twitter', 'option');
	if($facebook):?>
		<div class="col s6">
			<a class="" href="<?php echo $facebook; ?>"><span class="block h3"><i aria-hidden="true" class="mdi mdi-facebook"></i></span>Find OCN on Facebook</a>
		</div>
	<?php endif;

	if($twitter):?>
		<div class="col s6">
				<a class="" href="<?php echo $twitter; ?>"><span class="block h3"><i aria-hidden="true" class="mdi mdi-twitter"></i></span>Follow OCN on Twitter</a>
		</div>
	<?php endif; ?>
	</div>
	<?php if( have_rows('front_page_bylines') ):?>
	<div id="intro-text" class="row yellow">
		<?php while ( have_rows('front_page_bylines') ) : the_row();?>
	<p>

		<svg viewBox="0 0 24 24" class="<?php the_sub_field('icon_color');?> medium left yellow-fill" svg-icon-name="chevron-right" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 24 24"><use href="<?php echo get_template_directory_uri();?>/svg/download.svg#ic_accessibility_24px"></use></svg> <?php the_sub_field('byline_text');?>
	</p>

	<?php
	endwhile;?>
	</div> <!-- end #section_title -->
	<?php
	else :
	 // no rows found
	endif;
	?>
<?php endwhile; endif;?>

<?php if( have_rows('front_page_callouts') ):?>
<div id="callouts" class="row">
	<?php while ( have_rows('front_page_callouts') ) : the_row();

	?>

		<div id="callout-<?php echo get_row_index();?>" class="col s12 callout-content">
			<div>
				<h2 class="center h4"><?php the_sub_field('callout_title');?></h2>
				<p class="col s12 callout-description">
					<?php the_sub_field('callout_description');?>
				</p>
			</div>
			<div class="col s12 center" >
				<a class="btn-large z-depth-0 waves-effect black-text"
				<?php
						echo 'href="' . get_sub_field('callout_link') . '">' . get_sub_field('callout_link_text') . '</a>' ;


				 ?>
			</div>

		</div>

<?php
endwhile;?>
</div>
<?php
else :
 // no rows found
endif;
?>



<?php if( have_rows('front_page_sections') ):?>
<div id="sections" class="row center">
 <div class="col s12" >
		<h2 class="center h4"><?php the_field('front_page_section_heading'); ?></h2>
	</div>
		<?php while ( have_rows('front_page_sections') ) : the_row();?>



		<section id="<?php the_sub_field('section_title'); ?>" class="col s12 l6">


			<div class="col s12 section-details" >

				<h3 class="h5"><?php the_sub_field('section_title'); ?></h3 class="h5">

				<?php the_sub_field('section_description'); ?>


									<div class="col s12">
										<a class="btn-large z-depth-0 waves-effect" href="<?php the_sub_field('page_link'); ?>">
											<!-- <svg class="small left white-fill" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 24 24" aria-hidden="true">
												<use href="<?php echo get_template_directory_uri();?>/svg/download.svg#ic_accessible_24px"></use>
											</svg> -->

											<?php the_sub_field('button_text'); ?></a>
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

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
		$class = get_sub_field('callout_class')
	?>

		<div id="callout-<?php echo get_row_index();?>" class=" <?php echo $class['value'];?> col s12 callout-content">
			<div class="container">
				<h2 class="center h4"><?php the_sub_field('callout_title');?></h2>
				<?php
				$image = get_sub_field('callout_image');
					if($image) {
						echo '<div class="col s12 center"><img alt="" src="' . $image['sizes']['thumbnail'] . '"/></div>';
			 	}?>
				<p class="col s12 callout-description">
					<?php the_sub_field('callout_description');?>
				</p>
			</div>
			<div class="col s12 center" >
				<a class="btn-large z-depth-0 waves-effect"
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

				<?php

				$image = get_sub_field('section_image');
					if($image) {
						echo '<div class="col s12"><img class="circle" src="' . $image['sizes']['thumbnail'] . '"/></div>';
			 	}
				?>

				<div class="col s12 no-pad">
					<a class="btn-large z-depth-0 waves-effect" href="<?php the_sub_field('page_link'); ?>">
						<?php the_sub_field('button_text'); ?>
					</a>
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

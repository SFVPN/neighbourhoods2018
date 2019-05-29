<?php

/*
Template Name: Offset Grid
*/

get_header(); ?>

<main  id="maincontent">
	<div class="row" role="main">

		<?php if (have_posts()) : while (have_posts()) : the_post();

			get_template_part( 'parts/loop', 'page' );



			endwhile; endif;

		?>

		</div> <!-- end row -->

		<?php if( have_rows('grid_layout_sections') ): ?>

	  <div id="themes" class="row">
	    <div class="container">

	  <?php while( have_rows('grid_layout_sections') ): the_row();

	  $image = get_sub_field('section_image');
	  $orientation = get_sub_field('layout_orientation');

		if($orientation == "left"):
	  ?>


	  <div class="col s12 grey lighten-3">
	    <div class="col m3 hide-on-small-only">
	       <img class="w200 circle" alt="<?php echo $image['alt']; ?>" src="<?php echo $image['url']; ?>"/>
	    </div>
	    <div class="col s12 m9">
	       <h3 class="h6"><?php the_sub_field('section_title');?></h3>
	         <p>
						<?php the_sub_field('section_description');?>
					 </p>
				<a class="btn-flat purple darken-1 white-text" href="<?php the_sub_field('section_link');?>"><?php the_sub_field('link_text');?></a>
	     </div>
		</div>
			<?php endif;

			if($orientation == "right"):?>
				<div class="col s12 grey lighten-4">
					<div class="col s12 m9">
			       <h3 class="h6"><?php the_sub_field('section_title');?></h3>
			         <p>
								<?php the_sub_field('section_description');?>
							 </p>
						<a class="btn-flat purple darken-1 white-text" href="<?php the_sub_field('section_link');?>"><?php the_sub_field('link_text');?></a>
			    </div>
			    <div class="col m3 hide-on-small-only">
			       <img class="w200 circle" alt="<?php echo $image['alt']; ?>" src="<?php echo $image['url']; ?>"/>
			    </div>
				</div>

			<?php endif; ?>

	  <?php endwhile; ?>
	  </div>
	</div>

	<?php endif; ?>

		<?php //get_template_part( 'parts/content', 'team' ); ?>

			<?php //get_template_part( 'parts/content', 'partners' ); ?>

</main> <!-- end main -->

<?php get_footer(); ?>

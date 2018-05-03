
<?php if( have_rows('teacher_details') ):?>

<div class="parallax-container">
  <header class="article-header">
     <h1 class="entry-title h2 single-title white-text center" itemprop="headline"><?php the_title();?></h1>
  </header> <!-- end article header -->
  <div class="parallax"><img src="<?php the_post_thumbnail_url('full'); ?>"></div>
</div> <!-- end parallax-container -->

<?php while ( have_rows('teacher_details') ) : the_row();?>

<div itemscope itemtype="http://schema.org/WebPage" class="teacher section white">
	<div class="row container">
    <div class="center">
      <h3 class="header"><?php the_sub_field('name'); ?></h3>
  	  <label><?php the_sub_field('qualifications'); ?></label>
   	  <div class="col s12">
        <img class="circle" src="<?php the_sub_field('photo'); ?>">
      </div>
     </div>
		 <p>
		 	<?php the_sub_field('description'); ?>
		 </p>
	 </div> <!-- end row container -->
 </div> <!-- end teacher section -->


<?php
	 endwhile;
	 else :
			 // no rows found
	 endif;
?>

 <?php if( have_rows('class_details') ):

   while ( have_rows('class_details') ) : the_row();?>
<div class="parallax-container">
  <div class="parallax"><img src="<?php the_sub_field('photo_class'); ?>"></div>
</div> <!-- end parallax-container -->

<div class="section white">
  <div class="row container">
 	  <h2 class="header"><?php the_sub_field('name_class'); ?></h2>
 		<label>For ages <?php the_sub_field('age_range'); ?></label>
 		<p class="grey-text text-darken-3 lighten-3">
 		 	<?php the_sub_field('description_class'); ?>
 		</p>
 	</div> <!-- end row container -->
</div> <!-- end section -->

 	<?php
 	 endwhile;
 	 else :
 			 // no rows found
 	 endif;
  ?>

<?php //get_template_part( 'parts/content', 'breadcrumbs' ); ?>

<article id="post-<?php the_ID(); ?>" class="<?php echo $post->post_name;?>" role="article" itemscope itemtype="http://schema.org/WebPage">


		<header class="article-header">
			<h1 class="entry-title single-title h2 center" itemprop="headline"><?php the_title();?></h1>
<?php // get_template_part( 'parts/content', 'share' );?>

		</header> <!-- end article header -->

    <section class="entry-content white container" itemprop="articleBody">
	    <?php the_content(); ?>
			<?php accessible_thumbnail('thumbnail', 'thumbnail');


			?>



	    <?php wp_link_pages(); ?>
	</section> <!-- end article section -->

<?php
if( have_rows('list') ):
?>

<div id="test-swipe-1" class="container">
	<ul id="<?php the_sub_field('list_title'); ?>" class="collection with-header">
	<?php while ( have_rows('list') ) : the_row();?>



		<li class="collection-header center" >

			<h2 class="h4"><?php the_sub_field('list_title'); ?></h2>

		</li> <!-- end col s12 l4 -->
		<?php
		if( have_rows('list_items') ):?>

			<?php

			while ( have_rows('list_items') ) : the_row();

?>

				<li class="collection-item avatar" >

					<?php

						echo '<i class="material-icons yellow darken-3 circle">star</i>';
					?>

<p>
	 <?php

	 the_sub_field('list_item_description'); ?>
</p>

</li> <!-- end col s12 l4 -->


		<?php
		endwhile;
?>

		<?php

		else :
		 // no rows found
		endif;
		?>

<?php
endwhile;?>
</ul>
</div>
<?php
else :
 // no rows found
endif;
?>
<?php
$contact = get_field('main_contact');
if($contact) {?>

	<div class="container">
		<ul class="collection">
		<li class="collection-item header center">
			<h3 class="h5">Contact</h3>
		</li>
    <li class="collection-item avatar">
      <img src="<?php the_field('profile_picture', 'user_' . $contact->ID);?>" alt="" class="circle">
      <h5 class="title"><?php echo $contact->display_name . ' - ' . get_field('position', 'user_' . $contact->ID) ;?></h5>
      <p>
				<i class="material-icons left">email</i>
				<?php echo 'Email: <a href="mailto:' . $contact->user_email . '">' . $contact->user_email . '</a>';?><p>
				<p>
					<i class="material-icons left">phone</i>
					<?php echo 'Landline: ' . get_field('landline_number', 'user_' . $contact->ID);?>
				</p>
				<p>
					<i class="material-icons left">phone_android</i>
					<?php echo 'Mobile: ' . get_field('mobile_number', 'user_' . $contact->ID);?>
				</p>


    </li>
	</ul>

	</div>

<?php } ?>

</article> <!-- end article -->

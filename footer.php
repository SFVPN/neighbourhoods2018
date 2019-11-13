<?php $toolbar_pos = get_field('access_bar_position', 'option');?>
<footer id="contact" class="page-footer white black-text center" role="contentinfo">

<?php if(is_user_logged_in()):?>
	<?php if( current_user_can('editor') || current_user_can('administrator') ) {  ?>
		<div class="fixed-action-btn left hide-on-med-and-down">
				<span>
					<a href="<?php echo get_permalink( get_page_by_path( 'add_post' ) );?>" class="btn-floating green darken-1"><i class="material-icons">add</i></a>
				</span>
				<span>
					 <a href="<?php echo admin_url();?>" class="btn-floating grey darken-3"><i class="material-icons">settings</i></a>
				</span>


		</div>
	<?php } ?>
<?php endif;?>

	<div id="inner-footer" class="padding-<?php echo $toolbar_pos;?>">

		<?php if( have_rows('logos', 'option') ): ?>

    <div id="funder-logos" class="row">

			<h2 class="h5">Our Funders</h3>
			<div class="flex">

    <?php while( have_rows('logos', 'option') ): the_row();
		$image = get_sub_field('image_file');
		?>

        <div class="col s4"><a href="<?php the_sub_field('link_to'); ?>"><img class="responsive-img" alt="<?php echo $image['alt']; ?>" src="<?php echo $image['url']; ?>"></a></div>

    <?php endwhile; ?>
			</div>
		</div>

<?php endif; ?>

		<div class="row purple darken-1">

				<nav id="home_contact_options" class=" col s12">
					<ul class="col s12">

			<?php
			$contact_page = get_field('contact_page', 'option');
			$facebook = get_field('facebook', 'option');
			$twitter = get_field('twitter', 'option');

			if($contact_page):?>
				<li>
					<a href="<?php echo $contact_page; ?>"><i aria-hidden="true" class="mdi mdi-email"></i>Contact OCN</a>
				</li>
			<?php endif;

			if($facebook):?>
				<li>
					<a href="<?php echo $facebook; ?>"><i aria-hidden="true" class="mdi mdi-facebook"></i>Find OCN on Facebook</a>
				</li>
			<?php endif;

			if($twitter):?>
				<li>
					<a href="<?php echo $twitter; ?>"><i aria-hidden="true" class="mdi mdi-twitter"></i>Follow OCN on Twitter</a>
				</li>
			<?php endif; ?>

		</ul>
	</nav>

	<p class="col s12 source-org copyright">
		<?php bloginfo('name'); ?> &copy; <?php echo date("Y");?><br />
	This website uses icons made by <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/"             title="Flaticon">www.flaticon.com</a></p>




			</div>
	</div> <!-- end #inner-footer -->


</footer> <!-- end .footer -->
<?php wp_footer(); ?>
</body>
</html> <!-- end page -->

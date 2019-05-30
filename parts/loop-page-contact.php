<?php //get_template_part( 'parts/content', 'breadcrumbs' ); ?>

<article id="post-<?php the_ID(); ?>" class="<?php echo $post->post_name;?>" role="article" itemscope itemtype="http://schema.org/WebPage">

		<header class="article-header">
			<h1 class="entry-title single-title h2 center" itemprop="headline"><?php the_title();?></h1>
<?php // get_template_part( 'parts/content', 'share' );?>

		</header> <!-- end article header -->

    <section class="entry-content white container" itemprop="articleBody">
	    <?php the_content(); ?>

			<div id="contact_options" class="col s12">

			<?php
			$show_contact = get_field('display_main_contact');

			if ($show_contact):

				$contact_address = get_field('contact_address', 'option');
				$contact_email = get_field('contact_email', 'option');
				$contact_phone = get_field('contact_phone', 'option');
				$facebook = get_field('facebook', 'option');
				$twitter = get_field('twitter', 'option');
				$contact_map = get_field('contact_map', 'option');
				$place = $contact_map['address'];
				$place = (explode(" ",$place));
				$place = (implode ('+', $place));
				$map_key = get_field('api_key', 'option');

				echo '<div class="col s12 m6 no-pad">';
				echo '<p><label class="block">Address</label>' . $contact_address . '<a class="block" href="https://www.google.co.uk/maps/place/' . $place . '/@' . $contact_map['lat'] . ',' . $contact_map['lng'] . ',17z" target="_blank" title="View on Google Maps">View on Google Maps</a></p>';
				echo '<p><label class="block">Phone</label>' . $contact_phone . '</p>';
				echo '<p><label class="block">Social Media</label>';

				if($facebook):?>

						<a class="block" href="<?php echo $facebook; ?>"><i aria-hidden="true" class="mdi mdi-facebook"></i>Find OCN on Facebook</a>

				<?php endif;

				if($twitter):?>

						<a class="block" href="<?php echo $twitter; ?>"><i aria-hidden="true" class="mdi mdi-twitter"></i>Follow OCN on Twitter</a>

				<?php endif;
				echo '</p></div>';
			endif;



			if ($contact_map):
				$map_image = 'https://maps.googleapis.com/maps/api/staticmap?center=' . $contact_map['lat'] . ',' . $contact_map['lng'] . '&zoom=12&size=800x385&scale2
				&markers=color:0x01a89e%7Csize:mid%7C' . $contact_map['lat'] . ',' . $contact_map['lng'] . '&key=' . $map_key;
				echo '<div class="col s12 m6 no-pad">';
				echo '<img class="responsive-img" src="' . $map_image . '">';
				echo '</div>';
			endif;
			echo '</div>';

			$form_shortcode = get_field('form_shortcode');

			if ($form_shortcode):
			echo '<div id="contact_form" class="col s12"><p>' . get_field('form_text') . '
			</p>';
			echo do_shortcode( '[wpforms id="'. $form_shortcode . '"]' );
			echo '</div>';
			endif;

			wp_link_pages(); ?>

		</section> <!-- end article section -->

</article> <!-- end article -->

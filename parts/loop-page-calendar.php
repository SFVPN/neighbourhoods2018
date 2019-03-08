<?php
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/WebPage">

	<div class="bg parallax-container" >
		<header class="article-header">
			<h1 id="top" class="entry-title single-title white-text center" itemprop="headline"><?php the_title();?></h1>
		</header> <!-- end article header -->
		 <div class="parallax"><img src="<?php the_post_thumbnail_url('large'); ?>"></div>
	</div>

	<div class="container">
		<?php

		if( have_rows('event_dates') ):
			echo '<ul id="events_list" class="collection">';
		     // loop through the rows of data
		    while ( have_rows('event_dates') ) : the_row();
				$start = get_sub_field("start", false, false);
				$end = get_sub_field("end", false, false);
				$start = new DateTime($start);
				$end = new DateTime($end);
				$now = new DateTime();
				$event_title = get_sub_field('event_title');
				$provisional = get_sub_field('provisional');
				$where = get_sub_field('event_location');
				$description = get_sub_field('event_description');
				$contact = get_sub_field('event_contact');
				$more_info = get_sub_field('moreinfo_link');
				$more_info_label = get_sub_field('moreinfo_label')
				?>


				 <?php
				 if ($start < $now) {
					 echo '<li class="ended collection-item mix white avatar">';
				 } else {
					 echo '<li class="collection-item mix white avatar">';
				 }
					if( $start ):

						echo '<span class="right day purple darken-2 white-text">' . $start->format('j') . '</br>' . $start->format('M') . '</span>';
					endif;
				?>

				    <h2 class="h6"><?php echo $event_title; ?></h2>

						<p class="date"><strong>Date </strong> <?php echo $start->format('l j F, Y');?>
							<?php if($provisional == '1') {
								echo '<span class="provisional white-text green lighten-1">Provisional</span>';
							}?>
				    </p>


						<?php

						 if($start) {
							if($start->format('G') < "12") {
							 echo '<p class="time"><strong>Time </strong>' . $start->format('g:i') . 'am';
						 } else {
							 echo '<p class="time"><strong>Time </strong>' . $start->format('g:i') . 'pm';
						 }
							 if($end->format('G') < "12") {
								 echo ' to ' . $end->format('g:i') . 'am' ;
							 } else {
								 echo ' to ' . $end->format('g:i') . 'pm' ;
							 }
							 echo '</p>';
						 }


						?>
						<?php if($where){
							echo '<p class="location"><strong>Venue </strong>' . $where['address'] . ' [';
							echo '<a href="https://www.google.co.uk/maps/place/' . $where['address'] . '/@' . $where['lat'] . ',' . $where['lng'] . ',17z" target="_blank">View on Google Maps</a>]</p>';
						}

						?>

						<?php if($description){
							echo '<p class="event_description">' . $description . '</p>';
						}

						?>

						<?php if($more_info){
							echo '<p class="event_ticket"><a class="btn z-depth-0 purple darken-2" href="' . $more_info . '">' . $more_info_label . '</a></p>';
						}

						?>

						<?php if($contact){
							echo '<p class="event_contact grey lighten-3">For more information about this event you can contact us via email at <a href="mailto:' . $contact . '">' . $contact . '</a> or by telephone on ' . get_field('company_phone', 'option') . '</p>';
						}


						?>

						<div class="center share-event">
						  <a class="chip" href="https://twitter.com/intent/tweet?url=<?php echo wp_get_shortlink(); ?>&via=<?php echo get_theme_mod( 'tcx_twitter_handle' );?>&text=<?php echo $event_title . '(' . $start->format('j M, Y') . '). ' . $description; ?>" aria-label="Share this content on Twitter">Share event on Twitter <i aria-hidden="true" class="mdi mdi-twitter"></i></a>

							<a class="chip" href="mailto:?subject=<?php echo $event_title . ' - ' . $start->format('j M, Y'); ?>&body=<?php echo $description; ?>&#32;&#32;<?php echo wp_get_shortlink() ?>" aria-label="Email this content to a friend or colleague">Share event by Email <i aria-hidden="true" class="mdi mdi-email"></i></a>

						  <a class="chip" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo wp_get_shortlink() ?>" aria-label="Share this content on Facebook">Share event on Facebook <i aria-hidden="true" class="mdi mdi-facebook"></i></a>
						</div>


				</li>



			<?php




		    endwhile;
				echo '</ul>';
		else :

		    // no layouts found

		endif;
	?>
	</div>

</article> <!-- end article -->


<article id="post-<?php the_ID(); ?>" class="col s12 m6 l3 activity-article" role="article">




		<?php
				$start = get_field("event_start", false, false);
				$end = get_field("event_end", false, false);
				$start = new DateTime($start);
				$end = new DateTime($end);
				$now = new DateTime();
				$today = new DateTime('Today');
				$event_title = get_field('event_name');
				$where = get_field('event_loc');
				$description = get_field('event_desc');

				if ($start < $now) {
					echo '<section class="grey finished lighten-3 center" style="opacity: .5;"><div class="purple darken-1 white-text" style="padding: .25rem;">';
				} elseif ($start->format('j') == $today->format('j') ) {
					echo '<section class="grey today lighten-3 center"><div class="purple darken-1 white-text today" style="padding: .25rem;">';
				}
				else {
					echo '<section class="grey lighten-3 center"><div class="purple darken-1 white-text" style="padding: .25rem;">';
				}

				if( $start ):
				echo '<i class="mdi mdi-calendar"></i> ' . $start->format('j') . ' ' . $start->format('F') . '</div>';
				endif;
				?>

				<h2 class="h5"><a href="<?php the_permalink() ?>" class="center" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

				<?php if($where){
					echo '<div class="" style="padding: .5rem;">'
					. $where['address'] .
					'</div>';
				}

				?>

				<footer class="card-content">
				<?php if($start) {
				 if($start->format('G') < "12") {
					echo '<label class="time"><strong><i class="mdi mdi-clock"></i></strong> ' . $start->format('g:i') . 'am';
				} else {
					echo '<label class="time"><strong><i class="mdi mdi-clock"></i></strong> ' . $start->format('g:i') . 'pm';
				}
					if($end->format('G') < "12") {
						echo ' to ' . $end->format('g:i') . 'am' ;
					} else {
						echo ' to ' . $end->format('g:i') . 'pm' ;
					}
					echo '</label>';
				}?>


				</footer>
</section>
				<?php ?>





</article>

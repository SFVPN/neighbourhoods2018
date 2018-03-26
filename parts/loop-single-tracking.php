<article id="post-<?php the_ID(); ?>" class="<?php echo $post->post_name;?>" role="article" itemscope itemtype="http://schema.org/WebPage">


		<header class="article-header center">
			<h1 class="entry-title single-title center" itemprop="headline"><?php the_title();?></h1>
<?php // get_template_part( 'parts/content', 'share' ); ?>

<?php
if(is_user_logged_in()) {
	get_template_part( 'parts/content', 'edit' );
}
?>

		</header> <!-- end article header -->


    <section class="entry-content container" itemprop="articleBody">




			<?php
			if( have_rows('milestone') ):

				?>

		<div id="test-swipe-1" class="row">
				<?php while ( have_rows('milestone') ) : the_row();?>


			<div class="col s9">
				<ul id="<?php the_sub_field('milestone_name'); ?>" class="collection with-header">


					<li class="collection-header" >
						<!-- <span class="badge yellow"><?php echo 'Due date: ' . get_sub_field('milestone_end'); ?></span> -->
						<h4><?php the_sub_field('milestone_name'); ?></h4>





					</li> <!-- end col s12 l4 -->
					<?php
					if( have_rows('task') ):?>

					  <?php
						$toStart = [];
						$started = [];
						$finished = [];
						$overdue = [];
						$count = 0;
						$total = 0;

						while ( have_rows('task') ) : the_row();

						$progress = get_sub_field('progress');
						$today = date("Y-m-d");
						$dueDate = new DateTime(get_sub_field('due_by', false, false));
						$date = $dueDate->format('Y-m-d');
						if (($today > $date) && ($progress != '100')) {
							array_push($overdue, $progress);
							$class = "red overdue white-text";
						} else {
							$class = "on-schedule";
						}
						$total += $progress;
						$rows = get_row_index();
						$count = $rows * 100;
						$users = get_sub_field('assignee');
// for testing




						?>

					    <li class="collection-item avatar" >

								<?php

								if ($progress === '100') {
									array_push($finished, $progress);
									echo '<i class="material-icons grey darken-3 circle">check</i>';
								} elseif ($progress === '0') {
									array_push($toStart, $progress);
									echo '<i class="material-icons circle orange">clear</i>';
									echo '<span class="secondary-content ' . $class . '"><strong>Due:</strong> ' . get_sub_field('due_by') . '</span>';
								} else {
									array_push($started, $progress);
									echo '<i class="material-icons circle green">autorenew</i>';
									echo '<span class="secondary-content ' . $class . '"><strong>Due:</strong> ' . get_sub_field('due_by') . '</span>';
								}?>

      <span class="title"><?php the_sub_field('task_name'); ?></span>
			<p>
				 <?php
				 if ($users) {
					 foreach ($users as $user) {
						 echo '<span class="chip" aria-label="Assigned to ' . $user['display_name'] . '">' . $user['display_name'] . '</span>';
						 //$profile_image = get_field('profile_image', 'user_'. $userID);
						 //$biography = get_field('biography', 'user_'. $userID);
						 // code for displaying values  here
					 }
				 }
				 echo '<br />';
				 the_sub_field('task_description'); ?>
			</p>




								<div class="progress">
      <div class="determinate" style="width: <?php the_sub_field('progress'); ?>%"></div>
  </div>





</li> <!-- end col s12 l4 -->


					<?php
					endwhile;
			?>
				</ul></div>
					<?php
					echo '<div class="col s3"><ul class="collection grey lighten-3" ><li class="collection-item">A total of ' . $rows . ' goals should be completed to achieve this milestone</li><li class="orange white-text collection-item"><i class="material-icons left">clear</i>Goals not started: ' . count($toStart) .'</li><li class="green white-text collection-item"><i class="material-icons left">autorenew</i>Goals Underway: ' . count($started) . '</li><li class="grey darken-3 white-text collection-item"><i class="material-icons left">check</i>Goals Completed: ' . count($finished) . '</li><li class="red white-text collection-item"><i class="material-icons left">access_alarm</i>Goals Overdue: ' . count($overdue) . '</li><li class="collection-item grey lighten-3 center" >' . get_sub_field('milestone_name') . ' is <strong>' . ($total / $count) * 100 . '%</strong> complete</li></ul></div>';
					else :
					 // no rows found
					endif;
					?>





			<?php
		endwhile;?>

			<?php
			else :
			 // no rows found
			endif;
			?>



</div>

</section>

</article> <!-- end article -->

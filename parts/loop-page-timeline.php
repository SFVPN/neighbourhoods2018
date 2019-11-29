<?php //get_template_part( 'parts/content', 'breadcrumbs' ); ?>

<article id="post-<?php the_ID(); ?>" class="<?php echo $post->post_name;?>" role="article" itemscope itemtype="http://schema.org/WebPage">

		<header class="article-header">
			<h1 class="entry-title single-title h2 center" itemprop="headline"><?php the_title();?></h1>
<?php // get_template_part( 'parts/content', 'share' );?>

		</header> <!-- end article header -->

    <section class="entry-content container" itemprop="articleBody">
	    <?php the_content(); ?>

			<ul class="key fixed-action-btn blue-grey darken-4">
			<li class="">Key</li>
			<li class=""><i class="red-text material-icons right">nature_people</i> Small Neighbourhoods</li>
			<li class=""><i class="red-text material-icons right">location_city</i> Big Neighbourhoods</li>
			</ul>


			<div id="timeline" class="">

				<?php
				$rows = get_field('output_details');
				$index = 0;
				if($rows)
						{?>



			<?php	foreach($rows as $row)
				{
				$next_row = $rows[$index+1];
				if($index == 0) {
					$class = 'active';
				} else {
					$class = "wrapper";
				}
				?>

					<div id="section-<?php echo $index; ?>" class="<?php echo $class;?>">

						<div class="collapsible-header">
							<?php if($row['output_neighbourhood'] == "Small") {
								echo '<i class="red-text material-icons">nature_people</i>';
							} elseif($row['output_neighbourhood'] == "Big") {
								echo '<i class="red-text material-icons">location_city</i>';
							}

								echo $row['output_name'];
								?>
						</div>

							<div class="collapsible-body">

								<?php echo $row['output_description'];


								$buttons = $row['output_resources'];

if($buttons)
{
	echo '<div class="actions">';

	foreach($buttons as $button) {
		if($button['output_resource_type'] == "Blog Post") {
			echo '<a href="' . $button['output_page_link']['url']  . '" class="btn-flat"><i class="material-icons left">description</i>Blog Post</a>';
		}

		if($button['output_resource_type'] == "Briefing") {
			if($button['output_page_link']) {
				echo '<a href="' . $button['output_page_link']['url']  . '" class="btn-flat"><i class="material-icons left">timeline</i>Briefing</a>';
			} else {
				echo '<a href="' . $button['output_file']['url']  . '" class="btn-flat"><i class="material-icons left">timeline</i>Briefing</a>';
			}
		}

		if($button['output_resource_type'] == "Resource") {
				if($button['output_page_link']) {
					echo '<a href="' . $button['output_page_link']['url']  . '" class="btn-flat"><i class="material-icons left">description</i>Related Resources</a>';
				} else {
					echo '<a href="' . $button['output_file']['url']  . '" class="btn-flat"><i class="material-icons left">description</i>Related Resources</a>';
				}

		}
	}

	echo '</div>';
}?>
								<?php if($next_row):?>
								<button id="btn-<?php echo $index; ?>" class="next btn-flat "><?php echo 'Up Next: ' . $next_row['output_name'];?></button>
							<?php endif;?>

					</div>

				</div>
					<?php
					$index++;
			 }
}

				// check if the repeater field has rows of data

 ?>


			<?php


			wp_link_pages(); ?>

		</section> <!-- end article section -->

</article> <!-- end article -->

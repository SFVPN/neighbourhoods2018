<article id="post-<?php the_ID(); ?>" class="container <?php echo $post->post_name;?>" role="article" itemscope itemtype="http://schema.org/Organization">


	<header class="article-header col s12 center">
		<h1 class="h4 single-title center" itemprop="headline"><?php the_title();?></h1>

		<?php
		if(is_user_logged_in()) {
			get_template_part( 'parts/content', 'edit' );
		}

		get_template_part( 'parts/content', 'byline' );
		get_template_part( 'parts/content', 'share' );
		?>

	</header> <!-- end article header -->


  <section class="entry-content" itemprop="articleBody">

	<?php

	

	the_content();
	
	$resource_cats = get_field('resource_categories');
	$completed = array();
	$completed = get_field('completed_resources');
	
	$args = array (
		'posts_per_page' => -1,
		'post_type' => 'resources',
	   'orderby' => 'menu_order',
	   'order' => 'ASC',
	   'tax_query' => array(
			array(
			'taxonomy' => 'resources_category',
			'field' => 'term_id',
			'terms' => $resource_cats,
	))
	);
	$nonce = wp_create_nonce("my_user_vote_nonce");
	$rc_nonce = wp_create_nonce("remove_complete_nonce");
	
	$resources = get_posts($args);

	$votes = get_post_meta($post->ID, "votes", true);
	$votes = ($votes == "") ? 0 : $votes;
?>
	<h2>Your neighbourhood pathway</h2>
	<div class="progress_counter">
		<p aria-live="polite">You have completed <span id="counter_label" ><?php echo $votes;?></span> out of <?php echo count($resources);?> steps</p>
	</div>

	<?php
	$i = 0;
	foreach($resources as $resource) {
		$i++;
		$link = admin_url('admin-ajax.php?action=my_user_vote&post_id='.$post->ID.'&nonce='.$nonce.'&resource_id='.$resource->ID);
		$remove_link = admin_url('admin-ajax.php?action=remove_complete&post_id='.$post->ID.'&nonce='.$rc_nonce.'&resource_id='.$resource->ID);
		
				if(!empty($completed)) {
					if (in_array($resource->ID, $completed)) {
						echo '<div class="pilot-card-wrapper"><div class="pilot card done z-depth-0">
						<div class="card-content">
						<span class="step block"><span aria-label="Step ' . $i . '">' . $i . '</span></span>
						<h3><a href="' . get_the_permalink($resource->ID) . '">' . $resource->post_title . '</a></h3><span class="completed">Step completed</span><p>' . get_the_excerpt($resource->ID) . '</p></div>';
						if(is_user_logged_in()) {
						// $files = get_field('resource_files', $resource->ID);
						// print_R($files);
						if( have_rows('resource_files', $resource->ID) ):
							echo '<div class="files">
									<span class="files-title block">Files</span>
									<ul>';
							// Loop through rows.
							while( have_rows('resource_files', $resource->ID) ) : the_row();
						
								// Load sub field value.
								$file = get_sub_field('select_file', $resource->ID);
								$file_type = $file['url'];    
								$file_type = substr($file_type, strrpos($file_type, ".") + 1);
								$file_type = strtoupper($file_type);
								$file_size = round(($file['filesize']/1000), 2);
								echo '<li class="file-link flex"><a href="' . $file['url'] . '">' . $file['title'] . '</a> (' . $file_type . ' / ' . $file_size . 'KB)</li>';
								
								//print_R($file);
								// Do something...
						
							// End loop.
							endwhile;

							echo '</ul></div>';
						
						// No value.
						else :
							// Do something...
						endif;
						echo '<div class="card-actions"><a class="user_vote chip hide green darken-3 white-text" href="' . $link . '" data-nonce="' . $nonce . '" data-resource_id="' . $resource->ID . '" data-post_id="' . $post->ID . '">Mark as done</a><a class="remove_complete chip grey darken-4 white-text" href="' . $remove_link . '" data-nonce="' . $rc_nonce . '" data-resource_id="' . $resource->ID . '" data-post_id="' . $post->ID . '">Mark incomplete</a></div>';
						}
						echo '</div></div>';
					} else {
						echo '<div class="pilot-card-wrapper"><div class="pilot card z-depth-0">
						<div class="card-content">
						<span class="step block"><span aria-label="Step ' . $i . '">' . $i . '</span></span>
						<h3><a href="' . get_the_permalink($resource->ID) . '">' . $resource->post_title . '</a></h3><span aria-hidden="true" class="completed">Step completed</span><p>' . get_the_excerpt($resource->ID) . '</p></div>';
						if(is_user_logged_in()) {
						echo '<div class="card-actions"><a class="user_vote chip green darken-3 white-text" href="' . $link . '" data-nonce="' . $nonce . '" data-resource_id="' . $resource->ID . '" data-post_id="' . $post->ID . '">Mark as done</a><a class="remove_complete chip hide grey darken-4 white-text" href="' . $remove_link . '" data-nonce="' . $rc_nonce . '" data-resource_id="' . $resource->ID . '" data-post_id="' . $post->ID . '">Mark incomplete</a></div>';
						}
						echo '</div></div>';
					}
				} else {
					echo '<div class="pilot-card-wrapper"><div class="pilot card z-depth-0">
						<div class="card-content">
						<span class="step block"><span aria-label="Step ' . $i . '">' . $i . '</span></span>
						<h3><a href="' . get_the_permalink($resource->ID) . '">' . $resource->post_title . '</a></h3><span aria-hidden="true" class="completed">Step completed</span><p>' . get_the_excerpt($resource->ID) . '</p></div>';
						if(is_user_logged_in()) {
						echo '<div class="card-actions"><a class="user_vote chip green darken-3 white-text" href="' . $link . '" data-nonce="' . $nonce . '" data-resource_id="' . $resource->ID . '" data-post_id="' . $post->ID . '">Mark as done</a><a class="remove_complete chip hide grey darken-4 white-text" href="' . $remove_link . '" data-nonce="' . $rc_nonce . '" data-resource_id="' . $resource->ID . '" data-post_id="' . $post->ID . '">Mark incomplete</a></div>';
						}
						echo '</div></div>';
				}
			
			 
	}


?>

	</section>

</article> <!-- end article -->

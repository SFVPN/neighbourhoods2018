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

	$intro = get_field('introduction');
	$description = get_field('optional_description');
	$addressObject = get_field_object('contact_address');

	if($intro) {
		echo '<p>' . $intro . '</p>';
	}

	if($description) {
		echo $description;
	}

	contact_card_OCN(2521, 'contact_address');
?>

	</section>

</article> <!-- end article -->

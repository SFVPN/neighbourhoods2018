<article id="post-<?php the_ID(); ?>" class="col s12 m6 l4">
	<div class="card">
		<?php the_post_thumbnail('medium',['class' => 'pilot-img']);?>
		<h2 class="pilot-title center h5"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
		
		<?php the_field('description'); ?>
	</div>
</article>

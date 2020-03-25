
<article id="post-<?php the_ID(); ?>" class="col s12 search-article" role="article">
	<div class="col s12 grey lighten-5">
		<h2 class="h5 "><a href="<?php the_permalink() ?>" class="center" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
		<div class="activities-content">
			<?php activities_archive_OCN();?>

		</div>
	</div>
</article>

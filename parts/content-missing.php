<div id="post-not-found" class="hentry">

	<?php if ( is_search() ) : ?>

		<header class="article-header">
			<h1 class="h3"><?php _e("Sorry, No Results.", "jointswp");?></h1>
		</header>

		<section class="entry-content">
			<p><?php _e("Try your search again.", "jointswp");?></p>
		</section>


	<?php else: ?>

		<header class="article-header">
			<h1 class="h3"><?php _e("We are regularly adding content, so please check back soon.", "jointstheme"); ?></h1>
		</header>



	<?php endif; ?>

</div>

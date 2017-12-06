<?php get_header(); ?>

	<div class="container">

		<div id="inner-content" class="row">

			<main id="main" class="col s12" role="main">

				<article id="content-not-found">

					<header class="article-header center">
						<h1><?php _e("Welcome to the " . get_bloginfo('name') . " website", "jointswp"); ?></h1>
					</header> <!-- end article header -->

					<section class="entry-content">
						<p><?php _e("We've recently updated the site and removed a few old pages, so you may have stumbled upon an outdated link. If so, please check out the main site content via the menu.", "jointswp"); ?></p>
					</section> <!-- end article section -->

				</article> <!-- end article -->

			</main> <!-- end #main -->

		</div> <!-- end #inner-content -->

	</div> <!-- end #content -->

<?php get_footer(); ?>

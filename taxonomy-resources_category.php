<?php get_header();
$queried_object = get_queried_object();
$icon = get_field('material_icon_code', $queried_object);
?>

<main id="maincontent">

	<div class="row">

		<header class="article-header">
			<h1 class="entry-title h3 single-title center" style="" itemprop="headline"><?php archive_title('Resources');?></h1>
		</header> <!-- end article header -->

		<section class="section">

			<div class="container">
				<?php
				if($queried_object->parent === 0 ) {
					archive_terms('resources_category', 'resources');
				} else {
					archive_terms_child('resources_category', 'resources');
				}
				?>

				<div class="row">

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<?php get_template_part( 'parts/loop', 'resources' ); ?>

				<?php endwhile; ?>

				<?php joints_page_navi(); ?>

				<?php else : ?>

				<?php get_template_part( 'parts/content', 'missing' ); ?>

				<?php endif; ?>

			</div>

			</div>

		</section>

	</div> <!-- end row -->

</main> <!-- end main -->

<?php get_footer(); ?>

<?php get_header();

?>

<main id="maincontent">

	<div class="row">

		<header class="article-header">
			<h1 class="entry-title h3 single-title center" style="" itemprop="headline"><?php archive_title('Audits');?></h1>
		</header> <!-- end article header -->

		<section class="section">

			<div class="container">

				<?php archive_terms('audit_category', 'audits', 'Filter Audits');?>

				<ul class="collection">

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<?php get_template_part( 'parts/loop', 'blog' ); ?>

				<?php endwhile; ?>

				<?php joints_page_navi(); ?>

				<?php else : ?>

				<?php get_template_part( 'parts/content', 'missing' ); ?>

				<?php endif; ?>

				</ul>

			</div>

		</section>

	</div> <!-- end row -->

</main> <!-- end main -->

<?php get_footer(); ?>

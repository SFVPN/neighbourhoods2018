<?php get_header();
?>

<main  id="maincontent">

	<div class="row">

		<header class="article-header">
			<h1 class="entry-title single-title center" itemprop="headline">
			<?php if(is_post_type_archive()) {
			 	archive_title(null);
			} else {
			  single_cat_title("Contributions by ", true);
			} ?>
			</h1>
		</header>

		 <section class="section">

			 <div class="container">

				<?php archive_terms('category', 'audits');?>

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

	</div> <!-- end #main -->

</main> <!-- end main -->

<?php get_footer(); ?>

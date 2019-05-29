<?php get_header();
?>

<main class="container" id="maincontent">

	<div class="row">

		<header class="article-header">
			<h1 class="archive-title h3 center" style="" itemprop="headline"><?php archive_title('');?></h1>
		<?php get_search_form();?>
		</header> <!-- end article header -->

		<section class="section">

			<div >


				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<?php get_template_part( 'parts/loop', 'activities' ); ?>

				<?php endwhile; ?>

				<?php joints_page_navi(); ?>

				<?php else : ?>

				<?php get_template_part( 'parts/content', 'missing' ); ?>

				<?php endif; ?>



			</div>

		</section>

	</div> <!-- end row -->

</main> <!-- end main -->

<?php get_footer(); ?>

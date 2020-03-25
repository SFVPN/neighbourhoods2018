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

				<?php terms_child_list('resources_category', 'covid-19');?>

				<?php terms_list('resources_category', 'support-pathways');?>

				<?php terms_child_list('resources_category', 'ocn-resources');?>

				<?php terms_child_list('resources_category', 'community-tools');?>



			</div>

		</section>

	</div> <!-- end row -->

</main> <!-- end main -->

<?php get_footer(); ?>

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

				<?php archive_terms_list('resources_category', 'resources');?>



			</div>

		</section>

	</div> <!-- end row -->

</main> <!-- end main -->

<?php get_footer(); ?>

<?php get_header();
$queried_object = get_queried_object();
$icon = get_field('material_icon_code', $queried_object);
$term_description = term_description( $queried_object, 'resources_category' );
$tax_image = get_field('taxonomy_image', $queried_object);
 ?>

<style>

</style>

<main id="maincontent">

	<div class="row">

		<header class="article-header center">
			<h1 class="resources-title h3 center" style="" itemprop="headline"><?php archive_title('');?></h1>
		
		</header> <!-- end article header -->

		<section class="section">

			<div class="container">
				<?php
				
				// if($queried_object->parent === 0 ) {
				//
				// 	archive_terms('resources_category', 'resources', 'Filter Resources');
				// } else {
				//
				// 	archive_terms_child('resources_category', 'resources', 'Filter Resources');
				// }

				if($tax_image) {
					
					echo '<div class="tax-image"><img src=" ' . $tax_image['sizes']['large'] . ' " class="responsive-img" alt="' . $tax_image['alt'] . '"/></div>';
				}

				if($term_description) {
					echo	$term_description;
				}
				?>


			<div class="col s12">

				<?php terms_child_list_compass('resources_category', $queried_object->slug);?>

			</div>

			</div>

		</section>

	</div> <!-- end row -->

</main> <!-- end main -->

<?php get_footer(); ?>

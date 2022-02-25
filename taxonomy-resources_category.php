<?php get_header();
$queried_object = get_queried_object();
$icon = get_field('material_icon_code', $queried_object);
$desc = get_field('full_description', $queried_object);
$term_description = term_description( $queried_object, 'resources_category' ) ?>

<main id="maincontent">

	<div class="row">

		<header class="article-header center">
			<h1 class="resources-title h3 center" style="" itemprop="headline"><?php archive_title('');?></h1>
			<!-- <?php if ($icon) {
				echo '<i id="cat-icon" class="medium purple darken-1 white-text material-icons">' . $icon . '</i>';
			} else {
				echo '<i id="cat-icon" class="medium purple darken-1 white-text material-icons">format_list_numbered</i>';
			}?> -->

		</header> <!-- end article header -->

		<section class="section">

			<div class="container">
				<?php

				if (str_contains($queried_object->slug, '-stage') || str_contains($queried_object->slug, 'key-')) {
					archive_terms_child('resources_category', 'resources', 'Compass Menu');
			}
				
			//	terms_child_list('resources_category', $queried_object->slug);

				if($desc) {
					echo $desc;
				}
				?>


				<div class="row">
					<div class="col s12 grid <?php echo $queried_object->slug;?>">

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


				<?php


				get_template_part( 'parts/loop', 'resources' );

				?>

				<?php endwhile; ?>

				<?php joints_page_navi(); ?>

				<?php else : ?>

				<?php get_template_part( 'parts/content', 'missing' ); ?>

				<?php endif; ?>
				</div>
			</div>

			</div>

		</section>

	</div> <!-- end row -->

</main> <!-- end main -->

<?php get_footer(); ?>

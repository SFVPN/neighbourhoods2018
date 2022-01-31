<?php get_header();
?>

<main class="container" id="maincontent">

	<div class="row">

		<header class="article-header">
			<h1 class="archive-title h3 center" style="" itemprop="headline"><?php archive_title('');?></h1>
		</header> <!-- end article header -->

		<section class="section">

			<div >

				<?php $pilot_desc = get_field('pilots_page_description', 'options');

				if($pilot_desc) {
					echo '<div class="col s12">' . $pilot_desc . '</div>';
				}

				?>

				<div class="search-wrapper col s12"><?php get_search_form();?></div>

				<?php if (have_posts()) : while (have_posts()) : the_post();

				get_template_part( 'parts/loop', get_post_type() );

				endwhile; ?>

				<?php joints_page_navi(); ?>

				<?php else : ?>

				<?php get_template_part( 'parts/content', 'missing' ); ?>

				<?php endif; ?>



			</div>

		</section>

	</div> <!-- end row -->

</main> <!-- end main -->

<?php get_footer(); ?>

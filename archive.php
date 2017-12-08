<?php get_header();
$title = single_cat_title("", false);
?>



<main  id="maincontent" class="container">

		<div class="row" role="main">

		    <div class="col s12">

					<header>
						<?php if(is_post_type_archive()) {?>
							<h1 class="page-title center"><?php post_type_archive_title();?></h1>
						<?php} else {?>
						<h1 class="page-title center"><?php single_cat_title("Contributions by ", true);?></h1>
					<?php } ?>
					</header>
					<ul class="collection">
			    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					<!-- To see additional archive styles, visit the /parts directory -->
					<?php get_template_part( 'parts/loop', 'blog' ); ?>

				<?php endwhile; ?>

					<?php joints_page_navi(); ?>

				<?php else : ?>

					<?php get_template_part( 'parts/content', 'missing' ); ?>

				<?php endif; ?>
			</ul>
			</div>


			</div> <!-- end #main -->

		</main> <!-- end main -->


<?php get_footer(); ?>

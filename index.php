<?php get_header();
global $wp_query;
$page_id = $wp_query->get_queried_object_id();
$post_thumbnail_id = get_post_thumbnail_id( $page_id );

$categories = get_categories();
//var_dump($categories);
?>



<main id="maincontent">

		<div class="row" role="main">

				<header class="article-header">
					<h1 class="entry-title single-title center" style="" itemprop="headline"><?php single_post_title();?></h1>
				</header> <!-- end article header -->

		</div>
		    <div class="section">



<div class="container">
	<div class="control btns">
		<button type="button" class="control waves-effect waves-light chip" data-filter="all"><i class="material-icons right">check</i>All</button>
		<?php foreach($categories as $category) {

			echo '<a href="' . get_category_link($category->term_id) . '" class="control waves-effect waves-light chip" data-filter=".' . $category->slug . '"><i class="material-icons right">check</i>' . $category->name . '</a>';
		}?>

</div>
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
</div>

			</div> <!-- end row -->

		</main> <!-- end main -->



<?php get_footer(); ?>

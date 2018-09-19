
<article id="post-<?php the_ID(); ?>" class="col s12 m6" role="article">
	<section class="col s12 grey lighten-3 center">
		<h2 class="h4 "><a href="<?php the_permalink() ?>" class="center" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

		<?php
		if ( is_search() ) {
			$terms = wp_get_post_terms($post->ID, 'resources_category', array("fields" => "all"));
						foreach ($terms as $term) {
							echo '<a href="' . get_term_link($term->term_id) . '" class="chip">' . $term->name . '</a>';
							// code...
						}
}
?>

	<footer class="card-content" style="position: relative; padding: .5rem 0;">
			<?php get_template_part( 'parts/content', 'byline' ); ?>

	</footer>
	</section>
</article>

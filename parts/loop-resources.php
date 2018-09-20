
<article id="post-<?php the_ID(); ?>" class="col s12 m6 resource-article" role="article">

	<section class="col s12 grey lighten-3 center">
		<h2 class="h5 "><a href="<?php the_permalink() ?>" class="center" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

		<?php
		if ($post->post_parent != 0) {
			echo '<div id="guide-name"><a class="btn-flat" href="' . get_the_permalink($post->post_parent) . '"><i class="material-icons left">library_books</i>Part of the ' . get_the_title($post->post_parent) . ' guide</a></div>';
		} else {
			$args = array(
				'post_parent' => $post->ID,
				'post_type'   => 'any',
				'numberposts' => -1,
				'post_status' => 'any'
			);
			$children = get_children( $args );
			$count = count($children);
			$total = $count + 1;


				echo '<div id="guide-name" class="btn-flat"><i class="material-icons left">format_list_numbered</i>' . $total . '-page guide</div>';

		}
		//print_R($post);
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

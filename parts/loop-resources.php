<?php
if ($post->post_parent != 0) {

	$children = null;

} else {

	$args = array(
		'post_parent' => $post->ID,
		'post_type'   => 'resources',
		'numberposts' => -1,
		'post_status' => 'any'
	);
	$children = get_children( $args );
	$count = count($children);
	$total = $count + 1;

}
 ?>
<article id="post-<?php the_ID(); ?>" class="col s12 search-article<?php if($children) {echo ' guide';}?>" role="article">

	<section class="col s12 grey lighten-5">
		<h2 class="h5 "><a href="<?php the_permalink() ?>" class="center" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
		<div class="search-content">
		<?php $type = get_field('type_of_tool');
		if($type) {
							echo '<span class="tool"><i class="material-icons">' . $type['value'] . '</i>' . $type['label'] . '</span>';
						}
		// check for rows (parent repeater)
		$excerpt = get_the_excerpt();
		if($excerpt) {
			echo '<p>' . $excerpt . '</p>';
		}
	
						 ?>


			<?php  // while( has_sub_field('to-do_lists') ):

				if ($post->post_parent != 0) {
					echo '<span class="footer-content"><i class="material-icons left">assignment</i>' . __( 'This is part of the ', 'ocn' ) . '<a href="' . get_the_permalink($post->post_parent) . '">' . get_the_title($post->post_parent) . '</a>' .  __( ' guide', 'ocn' ) . '</span>';
				} else {

					if($children) {
						echo '<span class="footer-content"><i class="material-icons left">assignment</i>' . __( 'This guide is ', 'ocn' ) . $total . __( ' chapters', 'ocn' ) . '</span>';
					}
				}


				echo '</div >';
				?>


	<?php //endwhile; // end of the loop. ?>
 	<footer class="card-content">
		<?php


				$terms = get_the_terms($post->ID, 'resources_category');
			
			// var_dump($all_terms);
			
			$allterms = wp_get_post_terms($post->ID, 'resources_category', array("fields" => "all"));
			if($terms):
						echo '<ul>';
						
						foreach ($terms as $term) {
							$icon = get_field('material_icon_code', 'term_' . $term->term_id);
							echo '<li><i class="material-icons left">' . $icon . '</i><span class="term">' . $term->name . '</span></li>';
							// code...
						}

						echo '</ul>';
						 endif;
		?>
	</footer>
	</section>
</article>

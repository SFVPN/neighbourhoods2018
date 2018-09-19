<?php $queried_object = get_queried_object();?>
<?php $icon = get_field('material_icon_code', $queried_object);
?>
<article id="post-<?php the_ID(); ?>" class="col s12 m6" role="article">
	<section class="col s12 grey lighten-3 center">
		<h2 class="h4 "><a href="<?php the_permalink() ?>" class="center" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
<i class="medium material-icons"><?php echo $icon;?></i>

		<?php
		if ( is_search() ) {
			$terms = wp_get_post_terms($post->ID, 'resources_category', array("fields" => "all"));
						foreach ($terms as $term) {
							echo '<span class="chip yellow">' . $term->name . '</span>';
							// code...
						}
}
?>

	<footer class="card-content" style="position: relative; padding: .5rem 0;">
			<?php get_template_part( 'parts/content', 'byline' ); ?>

	</footer>
	</section>
</article>

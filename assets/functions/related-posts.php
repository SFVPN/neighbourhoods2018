<?php
// Related Posts Function, matches posts by tags - call using joints_related_posts(); )
function joints_related_posts() {
	global $post;
	$cats = wp_get_post_categories( $post->ID );
	if($cats) {
		foreach( $cats as $cat ) {
			$cat_arr .= $cat->slug . ',';
		}
		$args = array(
			'category' => $cats,
			'numberposts' => 4, /* you can change this to show more */
			'post__not_in' => array($post->ID)
		);
		$related_posts = get_posts( $args );
		if($related_posts) {
		echo '<aside class="joints-related-posts">';
		echo '<h2 class="h5 col s12">Related Posts</h2>';
			foreach ( $related_posts as $post ) : setup_postdata( $post );
			?>
			<div class="col s12 m6 l3">
      <div class="card small">
        <div class="card-image">
          <img src="<?php the_post_thumbnail_url(array(150,150)); ?>">

        </div>
        <div class="card-content">
					<a class="block" href="<?php the_permalink() ?>"><?php the_title(); ?></a>
					<i class="mdi mdi-clock"></i> <?php the_time('F j, Y');?>
        </div>
      </div>
    </div>

			<?php endforeach; }
			}
	wp_reset_postdata();
	echo '</aside>';
} /* end joints related posts function */

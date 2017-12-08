<?php
/*
Template Name: Section Archive
*/

get_header();
$cat = get_field('category_to_show');
$post_type = get_field('post_type_to_show');
?>

<main  id="maincontent">
	<div class="row" role="main">
		<header class="article-header">
			<h1 class="entry-title single-title center" itemprop="headline"><?php the_title();?></h1>
		</header>

		<?php $args = array(
	'posts_per_page'   => 5,
	'offset'           => 0,
	'category'         => '',
	'category_name'    => '',
	'orderby'          => 'date',
	'order'            => 'DESC',
	'include'          => '',
	'exclude'          => '',
	'meta_key'         => '',
	'meta_value'       => '',
	'post_type'        => $post_type,
	'post_mime_type'   => '',
	'post_parent'      => '0',
	'author'	   => '',
	'author_name'	   => '',
	'post_status'      => 'publish',
	'suppress_filters' => true
);
$posts_array = get_posts( $args );
$myposts = get_posts( $args );?>
<ul class="col s10 offset-s1 collection">
<?php
foreach ( $myposts as $post ) : setup_postdata( $post );
	get_template_part( 'parts/loop', 'blog' );
endforeach;
wp_reset_postdata();?>
</ul>







		</div> <!-- end row -->

</main> <!-- end main -->

<?php get_footer(); ?>

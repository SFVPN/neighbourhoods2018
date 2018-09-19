<?php
acf_form_head();
get_header();

?>
<main id="maincontent" class="container">
	<div class="row">


		<?php if (have_posts()) : while (have_posts()) : the_post();

 get_template_part( 'parts/loop', 'single-resources' );


		endwhile; endif;

		?>

	</div>
	</main> <!-- end main -->

<nav id="page-nav" class="col s12 no-pad">
<?php $queried_object = get_queried_object();
$ID = $queried_object->ID;
$parent_ID = wp_get_post_parent_id( $ID );
$pages = array();
if ($parent_ID === 0 ) {
	$pages = array($ID);
	$args = array(
		'post_parent' => $ID,
		'post_type'   => 'any',
		'numberposts' => -1,
		'orderby'     => 'menu_order',
    'order'       => 'ASC'
	);
	$children = get_children( $args );


	foreach ($children as $child) {
		$pages[] += $child->ID;
	}

	$current = array_search($ID, $pages);
	$next = $pages[$current+1]; // returns previous element's key: 34
	$prev = $pages[$current-1]; // returns previous element's key: 34

	if($prev) {
			echo '<a class="left" title="Go to the previous page in this guide - ' . get_the_title($prev) . '" href="' . get_permalink( $prev ) . '"><i class="large material-icons left">chevron_left</i></a>';
	}

	if($next) {
		echo '<a class="right" title="Go to the next page in this guide - ' . get_the_title($next) . '" href="' . get_permalink( $next ) . '"><i class="large material-icons right">chevron_right</i></a>';
	}

	//print_R($pages);
} else {
	$pages = array($parent_ID);
	$args = array(
		'post_parent' => $parent_ID,
		'post_type'   => 'any',
		'numberposts' => -1,
		'orderby'     => 'menu_order',
    'order'       => 'ASC'
	);
	$children = get_children( $args );


	foreach ($children as $child) {
		$pages[] += $child->ID;
	}
	$current = array_search($ID, $pages);
	$next = $pages[$current+1]; // returns previous element's key: 34
	$prev = $pages[$current-1]; // returns previous element's key: 34
	//echo 'Previous page id is ' . $prev . ' and next page id is ' . $next;
	if($prev) {
			echo '<a class="left" title="Go to the previous page in this guide - ' . get_the_title($prev) . '" href="' . get_permalink( $prev ) . '"><i class="large material-icons left">chevron_left</i></a>';
	}

	if($next) {
		echo '<a class="right" title="Go to the next page in this guide - ' . get_the_title($next) . '" href="' . get_permalink( $next ) . '"><i class="large material-icons right">chevron_right</i></a>';
	}

}
echo '</nav>';?>


<?php get_footer(); ?>
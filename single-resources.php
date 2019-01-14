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
$next;
$prev;
if ($parent_ID === 0 ) {

	$pages = array($ID);
	$args = array(
		'post_parent' => $ID,
		'post_type'   => 'resources',
		'numberposts' => -1,
		'orderby'     => 'menu_order',
    'order'       => 'ASC'
	);
	$children = get_children( $args );


if($children) {
	foreach ($children as $child) {
		$pages[] += $child->ID;
	}
}


	$current = array_search($ID, $pages);

		$next = $pages[$current+1]; // returns previous element's key: 34
		$prev = $pages[$current-1]; // returns previous element's key: 34



	if($prev) {
			echo '<a class="left" data-title="Go to the previous page in this guide - ' . get_the_title($prev) . '" href="' . get_permalink( $prev ) . '"><i class="large material-icons left">chevron_left</i></a>';
	}

	if($next) {
		echo '<a class="right" data-title="Go to the next page in this guide - ' . get_the_title($next) . '" href="' . get_permalink( $next ) . '"><i class="large material-icons right">chevron_right</i></a>';
	}

	//print_R($pages);
} else {
	$pages = array($parent_ID);
	$args = array(
		'post_parent' => $parent_ID,
		'post_type'   => 'resources',
		'numberposts' => -1,
		'orderby'     => 'menu_order',
    'order'       => 'ASC'
	);
	$children = get_children( $args );

if($children) {
	foreach ($children as $child) {
		$pages[] += $child->ID;
	}
}
	$current = array_search($ID, $pages);
	$next = $pages[$current+1]; // returns previous element's key: 34
	$prev = $pages[$current-1]; // returns previous element's key: 34
	//echo 'Previous page id is ' . $prev . ' and next page id is ' . $next;
	if($prev) {
			echo '<a class="left" data-title="Go to the previous page in this guide - ' . get_the_title($prev) . '" href="' . get_permalink( $prev ) . '"><i class="large material-icons left">chevron_left</i></a>';
	}

	if($next) {
		echo '<a class="right" data-title="Go to the next page in this guide - ' . get_the_title($next) . '" href="' . get_permalink( $next ) . '"><i class="large material-icons right">chevron_right</i></a>';
	}

}
echo '</nav>';?>
<div class="fixed-action-btn no-print">
<?php if(($parent_ID === 0) && $children){
echo	'<a href="' . get_field('print_page_url', 'option') . '" class="btn-floating hide-on-large-only"><i class="material-icons">print</i></a>';
echo	'<a href="' . get_field('print_page_url', 'option') . '" class="btn hide-on-med-and-down">Print full guide</a>';
} else {
	echo '<button class="btn-floating hide-on-large-only" onclick="printFunction()"><i class="material-icons">print</i></button>';
	echo '<button class="btn hide-on-med-and-down" onclick="printFunction()">Print page</button>';
};?>
</div>
<script>
function printFunction() {
		window.print();
}
</script>

<?php get_footer(); ?>

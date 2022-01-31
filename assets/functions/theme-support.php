<?php

// Adding WP Functions & Theme Support
function joints_theme_support() {

	// Add WP Thumbnail Support
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 200, 200 );

	// Default thumbnail size

	add_action('init', 'remove_plugin_image_sizes');

function remove_plugin_image_sizes() {
	remove_image_size('medium_large');
}

	// Add RSS Support
	add_theme_support( 'automatic-feed-links' );

	// Add Support for WP Controlled Title Tag
	add_theme_support( 'title-tag' );

	// Add HTML5 Support
	add_theme_support( 'html5',
	         array(
	         	'comment-list',
	         	'comment-form',
	         	'search-form',
	         )
	);

	/**
	 * Add SVG capabilities
	 */
	 add_filter( 'upload_mimes', 'maertens_svgs_upload_mimes' );

	function maertens_svgs_upload_mimes($mimes = array()) {
			$mimes['svg'] = 'image/svg+xml';
			$mimes['svgz'] = 'image/svg+xml';
			return $mimes;

	}

// simple function to churn out the featured image with role="presentation" if the alt attribute has not been set. This means the absence of alt text be ignored by screen readers - $size is a required argument and accepts one of the following 'thumbnail', 'medium', 'large', 'full' or 'array(widthxheight)'.  $class is the class of the img being inserted and can take any string value eg: 'A class name here'
	function accessible_thumbnail($size, $class) {
		$thumb_id = get_post_thumbnail_id();

 $thumb_alt = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true );
 if($thumb_alt){?>
	 <img class="<?php echo $class;?>" src="<?php the_post_thumbnail_url($size); ?>" alt="<?php echo $thumb_alt;?>">
<?php
 } else {?>
	 <img class="<?php echo $class;?>" src="<?php the_post_thumbnail_url($size); ?>" role="presentation">
<?php }
}

function terms_list($taxonomy, $term) {
	//NOTE: $post_type be set to null in order to hide the link to the main post_type archive page. Useful if using taxonomies across more than one post_type

	$args = array(
		'post_type' => 'resources',
		'numberposts' => -1,
		'post_parent' => 0,
		'orderby' => 'title',
		'order' => 'ASC',
    'tax_query' => array(
        array(
            'taxonomy' => $taxonomy,
            'field'    => 'slug',
            'terms'    => $term
        )
    )
);
$resources = get_posts( $args );

$term_object = get_term_by('slug', $term, $taxonomy);
$icon = get_field('material_icon_code', 'resources_category_' . $term_object->term_id);
$desc = get_field('full_description', 'resources_category_' . $term_object->term_id);

	?>


<div class="terms-list">

		<h2 class="h4"><?php echo $term_object->name;?></h2>
		<?php echo $desc;?>
		<ul>
		<?php foreach($resources as $resource) {


			echo '<li>
			<a href="' . get_the_permalink($resource->ID) . '" class="control">' . $resource->post_title . '</a>
			</li>';

	}?>

</ul>
</div>
<?php }

function terms_child_list($taxonomy, $term) {
	$term_object = get_term_by('slug', $term, $taxonomy);
	$icon = get_field('material_icon_code', 'resources_category_' . $term_object->term_id);
	$desc = get_field('full_description', 'resources_category_' . $term_object->term_id);
	$terms = get_terms(array(
			'taxonomy' => $taxonomy,
			'hide_empty' => true,
			'parent' => $term_object->term_id
	) );

	?>
	<div class="terms-child-list">
		<h2 class="h4"><?php echo $term_object->name;?></h2>
		<?php echo $desc;?>
		<ul>
		<?php foreach($terms as $term) {
			$args = array(
			'post_parent' => 0,
			'posts_per_page' => -1,
			'post_type' => 'resources',
	    'tax_query' => array(
	        array(
	            'taxonomy' => 'resources_category',
	            'field'    => 'id',
	            'terms'    => $term->term_id
	        )
			   )
			);
	$postslist = get_posts( $args ); // this gets top level posts for each term so we can get the count

			if(count($postslist) === 0) { // we won't show terms that don't have top level posts

			} else {
				echo '<li>
				<a href="' . get_term_link($term->term_id) . '" class="control">' . $term->name . '<span class="block term-description">' . $term->description . '</span><span class="count">Number of Resources - ' . count($postslist) . '</span></a>
				</li>';
			}

	}?>

</ul>
</div>
	<?php
}
function terms_child_list_compass($taxonomy, $term) {
	$term_object = get_term_by('slug', $term, $taxonomy);
	$icon = get_field('material_icon_code', 'resources_category_' . $term_object->term_id);
	$desc = get_field('full_description', 'resources_category_' . $term_object->term_id);
	$terms = get_terms(array(
			'taxonomy' => $taxonomy,
			'hide_empty' => true,
			'parent' => $term_object->term_id,
			'orderby'  => 'id',
      'order'    => 'ASC'
	) );

	?>
	<div class="terms-child-list-compass">
		
		<?php echo $desc;?>
		<ul class="compass-card-wrapper">
		<?php foreach($terms as $term) {
			$args = array(
			'post_parent' => 0,
			'posts_per_page' => -1,
			'post_type' => 'resources',
	    'tax_query' => array(
	        array(
	            'taxonomy' => 'resources_category',
	            'field'    => 'id',
	            'terms'    => $term->term_id
	        )
			   )
			);
	$postslist = get_posts( $args ); // this gets top level posts for each term so we can get the count

			if(count($postslist) === 0) { // we won't show terms that don't have top level posts

			} elseif ($term->slug !== 'key-concepts') {

				echo 
				
				'<li class="compass-card ' . $term->slug . '">
					<a href="' . get_term_link($term->term_id) . '" class="control">
					<div class="card-content"><span class="title">' . $term->name . '</span></div>
					<div class="card-footer">
						<span><i class="material-icons left">explore</i></span><span class="count">' . count($postslist) . ' resources</span>
					</div>
					</a>
				</li>';
				
			} else {
				// var_dump($postslist[0]);
				echo '<li class="' . $term->slug . '">
				<span class="title h5">' . $postslist[0]->post_title . '</span>';

				if($postslist[0]->post_excerpt):
				echo '<p>' . $postslist[0]->post_excerpt .'</p>';
				endif;
				echo '<div><a class="btn-flat blue-grey darken-4 white-text" href="' . get_permalink($postslist[0]->ID) . '" class="control">
					Explore ' . $postslist[0]->post_title . '
				</a></div>
				</li>';
			}

	}?>

</ul>
</div>
	<?php
}

	function archive_terms($taxonomy, $post_type, $title) {
		//NOTE: $post_type be set to null in order to hide the link to the main post_type archive page. Useful if using taxonomies across more than one post_type
		$queried_object = get_queried_object();
		$terms = get_terms(array(
        'taxonomy' => $taxonomy,
				'hide_empty' => false,
        'parent' => 0
    ) );
		$archive = get_post_type_archive_link( $post_type );
		$obj = get_post_type_object( $post_type );
		?>
		<details>
			<summary><?php echo $title;?></summary>

		<nav class="control btns">

			<?php if((is_post_type_archive() || is_home()) && $archive) {?>
				<a href="<?php echo $archive;?>" class="current waves-effect waves-light chip"><?php echo 'All ' . $queried_object->name;?></a>
			<?php } elseif ($archive) {?>
				<a href="<?php echo $archive;?>" class="waves-effect waves-light chip"><?php echo 'All ' . $obj->labels->name;?></a>
			<?php }?>
			<?php foreach($terms as $term) {

				if ($queried_object->name === $term->name) {
					echo '<a href="' . get_term_link($term->term_id) . '" class="current waves-effect waves-light chip">' . $term->name . '</a>';
				} else {
				echo '<a href="' . get_term_link($term->term_id) . '" class="control waves-effect waves-light chip">' . $term->name . '</a>';
			}

		}?>

	</nav>
	</details>
	<?php }

	function archive_terms_child($taxonomy, $post_type, $title) {
		//NOTE: $post_type be set to null in order to hide the link to the main post_type archive page. Useful if using taxonomies across more than one post_type
		$queried_object = get_queried_object();
		$terms = get_terms(array(
				'taxonomy' => $taxonomy,
				'hide_empty' => false,
				'parent' => $queried_object->parent
		) );
		$archive = get_post_type_archive_link( $post_type );
		$obj = get_post_type_object( $post_type );
		?>
		<details>

		<summary><?php echo $title;?></summary>
		<nav class="control btns">
			<?php if((is_post_type_archive() || is_home()) && $archive) {?>
				<a href="<?php echo $archive;?>" class="current waves-effect waves-light chip"><?php echo 'All ' . $obj->labels->name;?></a>
			<?php } elseif ($archive) {
				$parent_term = get_term($queried_object->parent);
				?>
				<a href="<?php echo get_term_link($queried_object->parent);?>" class="waves-effect waves-light chip"><?php echo 'All ' . $parent_term->name . ' Resources';?></a>
			<?php }?>
			<?php foreach($terms as $term) {

				if ($queried_object->name === $term->name) {
					echo '<a href="' . get_term_link($term->term_id) . '" class="current waves-effect waves-light chip">' . $term->name . '</a>';
				} else {
				echo '<a href="' . get_term_link($term->term_id) . '" class="control waves-effect waves-light chip">' . $term->name . '</a>';
			}

		}?>

	</nav>
	</details>
	<?php }

	function archive_terms_cards($taxonomy, $post_type) {
		//NOTE: $post_type be set to null in order to hide the link to the main post_type archive page. Useful if using taxonomies across more than one post_type
		$terms = get_terms( $taxonomy );
		$archive = get_post_type_archive_link( $post_type );
		$obj = get_post_type_object( $post_type );
		$queried_object = get_queried_object();
		$icon = get_field('material_icon_code', $queried_object);
		?>
		<div id="resources_category" class="row center">

			<?php foreach($terms as $term) {

				$parent = ( isset( $term->parent ) ) ? get_term_by( 'id', $term->parent, 'types' ) : false;
				if ($term->parent === 0) {
				if ($queried_object->name === $term->name) {
					echo '<div class="col s12 m6 l4"><div class="col s12 grey lighten-3"><a href="' . get_term_link($term->term_id) . '" class="block"><h2 class="h6">' . $term->name . ' ' . $obj->labels->name . '</h2></a><i class="material-icons purple darken-1 white-text">' . get_field('material_icon_code', $term) . '</i></div></div>';
				} else {
				$cat_total[] = $term->count;
				echo '<div class="col s12 m6 l4"><div class="col s12 grey lighten-3"><a href="' . get_term_link($term->term_id) . '" class="block"><h2 class="h6">' . $term->name . ' ' . $obj->labels->name . '</h2></a><i class="material-icons purple darken-1 white-text">' . get_field('material_icon_code', $term) . '</i></div></div>';
			}
		}
	}?>

	</div>
	<?php }


	function archive_terms_list($taxonomy, $post_type) {
		//NOTE: $post_type be set to null in order to hide the link to the main post_type archive page. Useful if using taxonomies across more than one post_type
		$terms = get_terms( $taxonomy );
		$archive = get_post_type_archive_link( $post_type );
		$obj = get_post_type_object( $post_type );
		$queried_object = get_queried_object();
		$icon = get_field('material_icon_code', $queried_object);

		?>
		<div id="resources_category" class="col s12">

			<?php foreach($terms as $term) {
				$children = get_term_children( $term->term_id, $taxonomy );
				$parent = ( isset( $term->parent ) ) ? get_term_by( 'id', $term->parent, 'types' ) : false;
				if ($term->parent === 0) {
				$children = get_term_children( $term->term_id, $taxonomy );
				if ($queried_object->name === $term->name) {
					echo '<div class="col s12 green lighten-3"><h2 class="h4">' . $term->name . '</h2></div>';
				} else {
				$cat_total[] = $term->count;
				echo '<div class="term-parent col s12">

				<ul class="parent-item"><li><h2 class="h4">' . $term->name . '</h2>' . get_field('full_description', 'term_' . $term->term_id);;
				if($children) {
					$child_sorted = array(); //initialize empty array
					echo '<ul class="child-items">
									<li class="grey darken-3"><a class="parent-item" href="' . get_term_link($term->term_id) . '">View all ' . $term->name . ' resources</a><span aria-label="Number of items in this category is ' . $term->count . '" class="count">' . $term->count . '</span></li>';
					foreach($children as $child) {
						$child_meta = get_term($child); // get taxonomy meta from taxonomy id
						$child_sorted[$child] = $child_meta->name; // associate tax id with tax name (so we can sort alphabetically)
						//print_R($child_meta);

					}
					asort($child_sorted); // sort taxonomy children alphabetically

					// loop sorted associative array of taxonomy children
					foreach($child_sorted as $x => $x_value) {
							$term = get_term($x);
					    echo '<li class="purple darken-2">
							<a href="' . get_term_link($x) . '">' . $x_value . '</a><span aria-label="Number of items in this category is ' . $term->count . '" class="count">' . $term->count . '</span>
							</li>';
						}
				//	print_R($child_sorted);
					echo '</ul>';
				}

				echo '</li></ul></div>';
			}
		}
	}?>

	</div>
	<?php }

function archive_title($affix) {
	//NOTE: the archive_title comprises the queried object name - for example, the name of the category if on a category archive page - appended with the $affix argument. So, on the archive page for the category 'Arts', you may wish to add 'Resources' or 'Content' as the $affix argument to give you 'Arts Resources' as the archive page title. You can set $affix to null
	$queried_object = get_queried_object();
	$affix = $affix;
	if ($queried_object->name && $affix) {
		echo $queried_object->name . ' ' . $affix ;
	} elseif ($queried_object->name && !$affix) {
		echo $queried_object->name;
	} else {
			echo 'All ' . $affix;
		}
	}




// adds excerpt support to pages

add_action( 'init', 'my_add_excerpts_to_pages' );
function my_add_excerpts_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
}


// function searchfilter($query) {
//     if ($query->is_search && !is_admin() ) {
//       //  if(isset($_GET['post_type'])) {
//             $type = $_GET['post_type'];
//                 // if($type == 'resources') {
//                 //     $query->set('post_type',array('resources'));
//                 // }
// 							//	if($type == 'organisations') {
//                     $query->set('post_type',array('organisations'));
//               //  }
//     //    }
//     }
// return $query;
// }
// add_filter('pre_get_posts','searchfilter');

add_action( 'pre_get_posts', function ( $query ) {
    if ( is_tax('resources_category') && $query->is_main_query() ) {
        $query->set( 'orderby', 'title' );
        $query->set( 'order', 'ASC' );
    }
		if ( is_tax('resources_category', array('adapt-stage','nap-stage','map-stage','snap-stage')) && $query->is_main_query() ) {
			$query->set( 'orderby', 'date' );
			$query->set( 'order', 'ASC' );
	}
} );

function resources_page_nav() {

	echo '<nav id="page-nav" class="col s12 no-pad">';
	$queried_object = get_queried_object();
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
				echo '<a class="prev-page" data-title="Previous page - ' . get_the_title($prev) . '" href="' . get_permalink( $prev ) . '"><i class="material-icons lft">chevron_left</i>Previous chapter <span class="hide-on-small-only"> - ' . get_the_title($prev) . '</span></a>';
			} else {
				echo '<span></span>';
			}

		if($next) {
			echo '<a class="next-page" data-title="Next page - ' . get_the_title($next) . '" href="' . get_permalink( $next ) . '">Next chapter <span class="hide-on-small-only"> - ' . get_the_title($next) . '</span><i class="material-icons rght">chevron_right</i></a>';
		} else {
			echo '<span></span>';
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
				echo '<a class="prev-page" data-title="Previous page - ' . get_the_title($prev) . '" href="' . get_permalink( $prev ) . '"><i class="material-icons lft">chevron_left</i>Previous chapter <span class="hide-on-small-only"> - ' . get_the_title($prev) . '</span></a>';
		} else {
			echo '<span></span>';
		}

		if($next) {
			echo '<a class="next-page" data-title="Next page - ' . get_the_title($next) . '" href="' . get_permalink( $next ) . '">Next chapter <span class="hide-on-small-only"> - ' . get_the_title($next) . '</span><i class="material-icons right">chevron_right</i></a>';
		} else {
			echo '<span></span>';
		}

	}
	echo '</nav>';
}


}

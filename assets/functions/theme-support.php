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

	function archive_terms($taxonomy, $post_type) {
		//NOTE: $post_type be set to null in order to hide the link to the main post_type archive page. Useful if using taxonomies across more than one post_type
		$queried_object = get_queried_object();
		$terms = get_terms(array(
        'taxonomy' => $taxonomy,
				'hide_empty' => false,
        'parent' => $queried_object->term_id
    ) );
		$archive = get_post_type_archive_link( $post_type );
		$obj = get_post_type_object( $post_type );
		?>
		<nav class="control btns center">

				<span id="filter" class="current waves-effect grey darken-3 white-text chip">Filter Resources</span>
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
	<?php }

	function archive_terms_child($taxonomy, $post_type) {
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
		<nav class="control btns center">
				<span id="filter" class="current waves-effect grey darken-3 white-text chip">Filter Resources</span>
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
		<div id="resources_category" class="row center">

			<?php foreach($terms as $term) {
				$children = get_term_children( $term->term_id, $taxonomy );
				$parent = ( isset( $term->parent ) ) ? get_term_by( 'id', $term->parent, 'types' ) : false;
				if ($term->parent === 0) {
				$children = get_term_children( $term->term_id, $taxonomy );
				if ($queried_object->name === $term->name) {
					echo '<div class="col s12 m6 l4"><div class="col s12 green lighten-3"><a href="' . get_term_link($term->term_id) . '" class="block"><h2 class="h6">' . $term->name . ' ' . $obj->labels->name . '</h2></a><i class="material-icons purple darken-1 white-text">' . get_field('material_icon_code', $term) . '</i></div></div>';
				} else {
				$cat_total[] = $term->count;
				echo '<div class="col s12 m6 l4"><ul class="col s12"><i class="material-icons purple darken-1 white-text">' . get_field('material_icon_code', $term) . '</i><li><a href="' . get_term_link($term->term_id) . '" class="block"><h2 class="h6">' . $term->name . ' ' . $obj->labels->name . '</h2></a>';
				if($children) {
					$child_sorted = array(); //initialize empty array
					echo '<ul>';
					foreach($children as $child) {
						$child_meta = get_term($child); // get taxonomy meta from taxonomy id
						$child_sorted[$child] = $child_meta->name; // associate tax id with tax name (so we can sort alphabetically)
					}
					asort($child_sorted); // sort taxonomy children alphabetically

					// loop sorted associative array of taxonomy children
					foreach($child_sorted as $x => $x_value) {
					    echo '<li>
							<a href="' . get_term_link($x) . '" class="block">' . $x_value . '</a>
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



function searchfilter($query) {
    if ($query->is_search && !is_admin() ) {
        if(isset($_GET['post_type'])) {
            $type = $_GET['post_type'];
                if($type == 'resources') {
                    $query->set('post_type',array('resources'));
                }
        }
    }
return $query;
}
add_filter('pre_get_posts','searchfilter');
// limits search to locations custom post type
//
// function searchfilter($query) {
//
//     if ($query->is_search && !is_admin() ) {
//         $query->set('post_type',array('locations'));
//     }
//
// return $query;
// }
//
// add_filter('pre_get_posts','searchfilter');
//
}

<?php get_header();
?>

<main  id="maincontent">

	<div class="row">

		<header class="article-header">
			<h1 class="entry-title single-title center" itemprop="headline">
			<?php if(is_post_type_archive()) {
			 	archive_title(null);
			} else {
			  single_cat_title("Contributions by ", true);
			} ?>
			</h1>
		</header>

		 <section class="section">

			 <div class="container">

				 <form class="col s12">
	 			 <ul id="kml_layers" class="map-filters_kml">
	 				 <li class="chip">
	 					 Filter Layers
	 				 </li>
	 				 <li>
	 					 <input type="checkbox" value="stirling_north" id="stirling_north"/>
	 					 <label for="stirling_north">Stirling North</label>
	 				 </li>

	 			 </ul>


				 	<ul class="map-filters__wrap">
				 		<li class="chip">
				 			Filter Audits
				 		</li>
				 		<li>
				 			<input type="checkbox" name="filter" value="reminiscence" id="test5" checked="checked" />
				 			<label for="test5">Reminiscence</label>
				 		</li>
				 		<li>
				 			<input type="checkbox" name="filter" value="leisure" id="test6" checked="checked"  />
				 			<label for="test6">Leisure</label>
				 		</li>
						<li>
				 			<input type="checkbox" name="filter" value="dementiaFriendly" id="test7"   />
				 			<label for="test7">Dem Friendly</label>
				 		</li>

				 	</ul>

					<!-- <input style="background: white;" id="pac-input" class="controls" type="text" placeholder="Search Box"> -->

				 </form>

<hr />
				<?php //archive_terms('audit_category', 'audits');?>
				<ul class="collection" id="sidebar">

				</ul>
				<ul class="collapsible" data-collapsible="accordion">
<li class="col s12">
	<div class="collapsible-header active center"><button class="btn-flat grey lighten-3">Hide Audit List</button></div>
	<div class="collapsible-body">
				<ul class="collection col s12" style="border: none;">
<?php

if(is_post_type_archive('activities')) {

}

global $post;
$args = array( 'post_type' => 'activities' );

$myposts = get_posts( $args );
foreach ( $myposts as $post ) : setup_postdata( $post ); $i++;
$post_terms = get_the_terms($post->ID, 'activity_type');
if( have_rows('event_details') ):
		 // loop through the rows of data
		while ( have_rows('event_details') ) : the_row();
		$start = get_sub_field("event_start", false, false);
		$end = get_sub_field("event_end", false, false);
		$start = new DateTime($start);
		$end = new DateTime($end);
		$now = new DateTime();
		$event_title = get_sub_field('event_name');
		$loc = get_sub_field('event_loc');
		$description = get_sub_field('event_desc');

		endwhile;
else :
			// no layouts found
endif;

if( have_rows('contact') ):
		 // loop through the rows of data
		while ( have_rows('contact') ) : the_row();

		$contact = get_sub_field('event_cont');
		$contact_name = get_sub_field('contact_name');
		$more_info = get_sub_field('event_info_link');
		$more_info_label = get_sub_field('event_info_label');

		endwhile;
else :
			// no layouts found
endif;

?>
<li class="collection-item mix white <?php echo esc_html( $post_terms[0]->slug );?> avatar" data-cat="<?php echo esc_html( $post_terms[0]->slug );?>" data-key="<?php echo $post->post_id;?>" data-day="">

		 <i class="material-icons circle grey lighten-2" aria-hidden="true">star</i>


    <span class="title" aria-label="This content is categorized as <?php echo esc_html( $post_terms[0]->name );?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
    <p class="label">
			<i class="mdi mdi-clock"></i> Added <?php the_time('F j, Y');?><br />
			<span class="chip black white-text"><?php echo esc_html( $post_terms[0]->name );?></span>

      <a href="#map" class="chip grey lighten-2" id="m<?=$i?>" data-lat="<?php echo $loc['lat']; ?>" data-lng="<?php echo $loc['lng']; ?>"><i class="material-icons right">landscape</i>View on map</a>
    </p>



</li>

<?php endforeach;
wp_reset_postdata();?>

</ul>
</div>

</li>
</ul>

				<!-- <ul class="collection"> -->
<div id="map-wrapper">
					<div id="map" class="acf-map col s12" style="height: 500px; margin: 1rem 0; ">
			  <?php if (have_posts()) : while (have_posts()) : the_post();
				$post_terms = get_the_terms($post->ID, 'activity_type');
				if( have_rows('event_details') ):
						 // loop through the rows of data
						while ( have_rows('event_details') ) : the_row();

						$location = get_sub_field('event_loc');
						$desc = get_sub_field('event_desc');

						endwhile;
				else :
							// no layouts found
				endif;
				?>

						<div class="marker" data-day="" data-cat="<?php echo esc_html( $post_terms[0]->slug );?>" data-title="<?php echo the_title();?>" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>" data-placeid="<?php echo $post->ID;?>">
								<h3 id="place-name"  class="h6 title"><?php the_title();?> </h3>
								<span class="chip black white-text"><?php echo esc_html( $post_terms[0]->name );?></span>
								<p><?php echo $desc;?>
								</p>
								<a class="center btn-flat grey darken-3 white-text" href="<?php the_permalink();?>">Read the full audit</a>
							</div>
				<?php //get_template_part( 'parts/loop', 'blog' ); ?>

				<?php endwhile; ?>

				<?php joints_page_navi(); ?>

				<?php else : ?>

				<?php get_template_part( 'parts/content', 'missing' ); ?>

				<?php endif; ?>
			</div>
</div>
			<div id="infowindow-content">

		<h6 id="place-name"  class="title"></h6>
		<p id="place-address"></p>

	</div>

</ul>

			</div>

		</section>

	</div> <!-- end #main -->

</main> <!-- end main -->

<?php get_footer(); ?>

<?php

acf_form_head();
get_header();

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

			 <div class="row">

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
				 			<input type="checkbox" name="filter" value="retail" id="test5" checked="checked" />
				 			<label for="test5">Retail</label>
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

				 </form>

				 <?php get_search_form();?>

				<?php //archive_terms('audit_category', 'audits');?>
	<div class="col s12">

				<ul class="collection col s6">
<?php

if(is_post_type_archive('audits')) {

}

global $post;
$args = array( 'post_type' => 'audits' );

$myposts = get_posts( $args );
foreach ( $myposts as $post ) : setup_postdata( $post ); $i++;
$post_terms = get_the_terms($post->ID, 'audit_category');
$loc = get_field('location_map');
$dfAttr = get_field('submission_details');
?>
<li class="collection-item mix white <?php echo esc_html( $post_terms[0]->slug );?> avatar" data-cat="<?php echo esc_html( $post_terms[0]->slug );?>" data-key="<?php the_field('location_placeid');?>" data-df="<?php echo $dfAttr['dementia_friendly']; ?>">
    <?php

		if ( $dfAttr['dementia_friendly'] === "Yes"  ) {
			echo '<i class="material-icons circle grey lighten-2 purple-text" aria-hidden="true">star</i>';?>
	<?php } else {
		  echo '<i class="material-icons circle grey lighten-2" aria-hidden="true">star</i>';
	}?>

    <span class="title" aria-label="This content is categorized as <?php echo esc_html( $post_terms[0]->name );?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
    <p class="label">
			<i class="mdi mdi-clock"></i> Added <?php the_time('F j, Y');?><br />
			<span class="chip white-text"><?php echo esc_html( $post_terms[0]->name );?></span>
			<?php if ( $dfAttr['dementia_friendly'] === "Yes"  ) {
				echo '<span class="chip purple darken-1 white-text">Dementia Friendly</span>';?>
		<?php } ?>
      <a href="#map" class="chip grey lighten-2" id="m<?=$i?>" data-lat="<?php echo $loc['lat']; ?>" data-lng="<?php echo $loc['lng']; ?>"><i class="material-icons right">landscape</i>View on map</a>
    </p>



</li>

<?php endforeach;
wp_reset_postdata();?>

</ul>


				<!-- <ul class="collection"> -->
<div class="col s6" id="map-wrapper">
					<div id="map" class="acf-map col s12" style="height: 500px; margin: 1rem 0; ">
			  <?php if (have_posts()) : while (have_posts()) : the_post();
				$post_terms = get_the_terms($post->ID, 'audit_category');
				$location = get_field('location_map');
				$placeid = get_field('location_placeid');
				$df = get_field('submission_details');
				?>

						<div class="marker" data-df="<?php echo $df['dementia_friendly']; ?>" data-type="<?php echo esc_html( $post_terms[0]->slug );?>" data-title="<?php echo the_title();?>" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>" data-placeid="<?php echo $placeid; ?>">
								<h6 id="place-name"  class="title"><?php the_title();?> </h6>
								<p><?php echo "<strong>Rating: </strong> " . get_field('location_rating_average') . " out of 7";?>
								</p>
								<a class="center btn-flat grey darken-4 white-text" href="<?php the_permalink();?>">Read the full audit</a>
							</div>
				<?php //get_template_part( 'parts/loop', 'blog' ); ?>

				<?php endwhile; ?>

				<?php joints_page_navi(); ?>

				<?php else : ?>

				<?php get_template_part( 'parts/content', 'missing' ); ?>

				<?php endif; ?>
			</div>
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

  <!-- Modal Structure -->

  <div id="modal1" class="modal modal-fixed-footer">
    <div class="modal-content">
      <?php get_template_part( 'parts/form', 'location' ); ?>
    </div>
    <div class="modal-footer">
      <button class="btn-flat grey lighten-3 modal-close">Close</button>
    </div>
  </div>

</main> <!-- end main -->

<?php get_footer(); ?>

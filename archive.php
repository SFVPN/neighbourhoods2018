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

				 <form>
	 			 <ul id="kml_layers" class="map-filters_kml">
	 				 <li class="chip">
	 					 Filter Layers
	 				 </li>
	 				 <li>
	 					 <input type="checkbox" value="stirling_north" id="stirling_north" checked="checked" />
	 					 <label for="stirling_north">Stirling North</label>
	 				 </li>
	 				 <li>
	 					 <input type="checkbox"  value="leisure" id="layer_02" checked="checked"  />
	 					 <label for="layer_02">Optional Additional Layer</label>
	 				 </li>
	 			 </ul>

	 			</form>

				 <form>
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
				 	</ul>



				 </form>


				<?php //archive_terms('audit_category', 'audits');?>
				<ul class="collection">
<?php

if(is_post_type_archive('audits')) {

}

global $post;
$args = array( 'post_type' => 'audits' );

$myposts = get_posts( $args );
$loc = get_field('location_map');
foreach ( $myposts as $post ) : setup_postdata( $post ); $i++;
$post_terms = get_the_terms($post->ID, 'audit_category');
?>
<li class="collection-item mix white <?php echo esc_html( $post_terms[0]->slug );?> avatar" data-cat="<?php echo esc_html( $post_terms[0]->slug );?>">
    <?php

    if ( has_post_thumbnail() ) {
      accessible_thumbnail('thumbnail', 'circle');
    } else {
      echo '<i class="material-icons circle black-text" aria-hidden="true">filter_7</i>';
    }?>

    <span class="title" aria-label="This content is categorized as <?php echo esc_html( $post_terms[0]->name );?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
    <p class="label"><i class="mdi mdi-clock"></i> Posted on <?php the_time('F j, Y');?><br>
      <a href="#map-wrapper" class="btn-flat grey lighten-2" id="m<?=$i?>" data-lat="<?php echo $loc['lat']; ?>" data-lng="<?php echo $loc['lng']; ?>"><i class="material-icons left">map</i>View on map</a>
    </p>
    <?php if ( ! empty( $post_terms ) ) {?>
    <span class="secondary-content black-text" aria-hidden="true"><?php echo esc_html( $post_terms[0]->name );?></span>
    <?php }?>

</li>

<?php endforeach;
wp_reset_postdata();?>

</ul>
<div id="map-wrapper" class="col s12" style="border: 1px solid #dddddd";>


				<!-- <ul class="collection"> -->
					<div class="acf-map" style="height: 400px; margin: 1rem 0;">
			  <?php if (have_posts()) : while (have_posts()) : the_post();
				$post_terms = get_the_terms($post->ID, 'audit_category');
				$location = get_field('location_map');

				?>

						<div class="marker" data-type="<?php echo esc_html( $post_terms[0]->slug );?>" data-title="<?php echo the_title();?>" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>">

								<h6><?php the_title();?> </h6>

								<p><?php echo "<strong>Rating: </strong> " . get_field('location_rating_average') . " out of 7";?>
								</p>
								<span class="btn-flat grey lighten-2"><a href="<?php the_permalink();?>">Read the full audit</a></span>
							</div>
				<?php //get_template_part( 'parts/loop', 'blog' ); ?>

				<?php endwhile; ?>

				<?php joints_page_navi(); ?>

				<?php else : ?>

				<?php get_template_part( 'parts/content', 'missing' ); ?>

				<?php endif; ?>
			</div>
	</div>			<!-- </ul> -->


			</div>

		</section>

	</div> <!-- end #main -->

</main> <!-- end main -->

<?php get_footer(); ?>

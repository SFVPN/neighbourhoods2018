<?php get_header();
$type = $_GET['post_type'];
 ?>



	<main id="main" class="container" role="main">

		<div class="row">

				<header class="article-header">
					<h1 class="archive-title h5 center"><?php _e('Here are the ' . $type . ' that match your search of', 'jointstheme'); ?> <?php echo '<span class="search-query red-text lighten-2">' . esc_attr(get_search_query()) . '</span>'; ?></h1>
				</header>

				<section class="section">

					<div class="row">

				<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
    <?php if(isset($_GET['post_type'])) :
        $type = $_GET['post_type'];

// echo '<div class="col s12"><p>
// <a class="" href="' . get_post_type_archive_link( $type ) . '">To carry outClick on this link to go back to the main resources page.</a>
// </p></div>';
//get_template_part( 'parts/loop', 'resources-new' );


?>

           <?php
						get_template_part( 'parts/loop', $type );
            ?>
    <?php endif; ?>
<?php endwhile; else:

	echo '<div class="col s12 center"><p>Sorry! We can\'t find anything that matches your search term</p></div>';




	?>



<?php endif;?>
					</div>

<?php echo '<div id="search-again" class="col s12 center"><p>If you didn\'t find what you where looking for, try changing your search word.</p>';
get_search_form();
echo '</div>';?>

			</section>



		</div> <!-- end .row -->

	</main> <!-- end #main -->

		    <?php //get_sidebar(); ?>



<?php get_footer(); ?>

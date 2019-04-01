<?php //get_template_part( 'parts/content', 'breadcrumbs' ); ?>

<article id="post-<?php the_ID(); ?>" class="<?php echo $post->post_name;?>" role="article" itemscope itemtype="http://schema.org/WebPage">


		<header class="article-header">
			<h1 class="entry-title single-title h2 center" itemprop="headline"><?php the_title();?></h1>
<?php // get_template_part( 'parts/content', 'share' );?>

		</header> <!-- end article header -->

    <section class="entry-content white container" itemprop="articleBody">
	    <?php the_content(); ?>
			<?php accessible_thumbnail('thumbnail', 'thumbnail');


			?>





<?php
if( have_rows('list') ):
?>

<div id="test-swipe-1">
	<ul id="<?php the_sub_field('list_title'); ?>" class="collection with-header">
	<?php while ( have_rows('list') ) : the_row();?>



		<li class="collection-header center" >

			<h2 class="h4"><?php the_sub_field('list_title'); ?></h2>

		</li> <!-- end col s12 l4 -->
		<?php
		if( have_rows('list_items') ):?>

			<?php

			while ( have_rows('list_items') ) : the_row();

?>
		<li class="collection-item avatar" >

		<?php
			echo '<i class="material-icons yellow darken-3 circle">star</i>';
		?>
			<p>
	 			<?php the_sub_field('list_item_description'); ?>
			</p>

		</li> <!-- end col s12 l4 -->

		<?php
		endwhile;
		?>

		<?php

		else :
		 // no rows found
		endif;
		?>

		<?php
		endwhile;
		?>
		</ul>
	</div>
		<?php
		else :
		 // no rows found
		endif;
		?>

		<?php
		get_template_part( 'parts/content', 'contact' );
		wp_link_pages(); ?>

	</section> <!-- end article section -->

</article> <!-- end article -->

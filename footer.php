<?php $toolbar_pos = get_field('access_bar_position', 'option');?>
<footer id="contact" class="page-footer white black-text center" role="contentinfo">
	<div id="inner-footer" class="padding-<?php echo $toolbar_pos;?>">

		<?php if( have_rows('logos', 'option') ): ?>

    <div id="funder-logos" class="row">

    <?php while( have_rows('logos', 'option') ): the_row(); ?>

        <div class="col s6"><a href="<?php the_sub_field('link_to'); ?>"><img class="responsive-img" src="<?php the_sub_field('image_file'); ?>"></a></div>

    <?php endwhile; ?>

	</div>

<?php endif; ?>

		<div class="row grey lighten-4">
			<p class="col s12 source-org copyright">
				<a href="<?php bloginfo('url'); ?>" aria-label="Navigate to the home page"><?php bloginfo('name'); ?></a> &copy; <?php echo date("Y");?>
			</p>
		</div>

	</div> <!-- end #inner-footer -->


</footer> <!-- end .footer -->
<?php wp_footer(); ?>
</body>
</html> <!-- end page -->

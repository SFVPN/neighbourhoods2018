<?php $toolbar_pos = get_field('access_bar_position', 'option');?>
<footer id="contact" class="page-footer white black-text center" role="contentinfo">
	<div id="inner-footer" class="container padding-<?php echo $toolbar_pos;?>">

		<div class="col s12">
			<p class="source-org copyright">
				<a href="<?php bloginfo('url'); ?>" aria-label="Navigate to the home page"><?php bloginfo('name'); ?></a> &copy; <?php echo date("Y");?>
			</p>
		</div>

	</div> <!-- end #inner-footer -->

<?php
if ( !is_page_template( 'page-calendar.php' ) ) {
	if (have_rows('cancelled_classes', 'options')) { //parent repeater
		date_default_timezone_set('Europe/London');
		// Then call the date functions
		$now = date('F j, Y');
		$now = strtotime($now);
		// For each row...
		while (have_rows('cancelled_classes', 'options')) : the_row();

		$name = get_sub_field('class_name_x', 'options');
		$locale = get_sub_field('class_locale', 'options');
		$date = get_sub_field('class_date_x', 'options');
		$date = strtotime($date);

		if($date == $now ){
		echo '<div id="cancellation_alert" class="materialize-red center lighten-2 white-text">There is no ' . implode(' or ', $name) . ' ' . $locale . ' class today</div><br />';
		}
		endwhile;
	}

	if (have_rows('special_days', 'options')) { //parent repeater
		date_default_timezone_set('Europe/London');
		// Then call the date functions
		$today = date('F j, Y');
		$today = strtotime($today);
		// For each row...
		while (have_rows('special_days', 'options')) : the_row();
		$date_fr = get_sub_field('date_from', 'options');
		$date_t = get_sub_field('date_to', 'options');
		$date_from = strtotime($date_fr);
		$date_to = strtotime($date_t);

		if($date_from <= $today && $date_to >= $today ){
		echo '<div id="cancellation_alert" class="yellow center">We are on holiday from ' . $date_fr . ' to ' . $date_t . '</div><br />';
			}
			endwhile;
	}
}
?>
</footer> <!-- end .footer -->
<?php wp_footer(); ?>
</body>
</html> <!-- end page -->

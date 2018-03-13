<?php
if( have_rows('submission_details') ):


while( have_rows('submission_details') ): the_row();
$user = get_sub_field('submission_user');
?>

	<div class="center">
			<i class="mdi mdi-clock"></i> Submitted by <?php echo $user['display_name'];?> on <?php the_sub_field('submission_date');?>

	</div>

<?php
if(!is_single()){
	if( strtotime( $post->post_date ) > strtotime('-7 day') ) {
			echo '<span class="new badge"></span>';
	}
}
?>
<?php



endwhile; ?>



<?php endif;



?>

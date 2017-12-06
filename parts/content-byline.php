

	<div class="center">
			<i class="mdi mdi-clock"></i> Posted on <?php the_time('F j, Y');?>

	</div>

<?php
if(!is_single()){
	if( strtotime( $post->post_date ) > strtotime('-7 day') ) {
			echo '<span class="new badge"></span>';
	}
}
?>

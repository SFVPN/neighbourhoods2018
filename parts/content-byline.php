
<i class="mdi mdi-clock"></i><?php //the_time('F j, Y');?>
 Updated: <?php the_modified_time('F j, Y'); ?>
<?php
if(!is_single()){
	if( strtotime( $post->post_date ) > strtotime('-7 day') ) {
			echo '<span class="new badge"></span>';
	}
}
?>

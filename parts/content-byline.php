<div class="resources-meta">
<?php
$terms = get_the_terms( $post->post_id, 'category' );

if($terms) {
  echo '<i class="mdi mdi-tag-multiple"></i> ';
  foreach ($terms as $term) {

      echo '<a href="' . get_term_link($term->term_id) . '" class="chip">' . $term->name . '</a>';

  }
  echo '</br>';
}
?>

<i class="mdi mdi-clock"></i><?php //the_time('F j, Y');?>
 <?php echo __( 'Last updated on ', 'ocn' ) . get_the_modified_time('F j, Y');

 if(!is_single()){
 	if( strtotime( $post->post_date ) > strtotime('-7 day') ) {
 			echo '<span class="new badge hide-on-small-only"></span>';
 	}
}?>

</div>

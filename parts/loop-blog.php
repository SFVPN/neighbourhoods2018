
<?php
if(is_tax()) {
  $queried_object = get_queried_object();
  $post_terms = get_the_terms($post->ID, $queried_object->taxonomy);
} elseif(is_post_type_archive('audits')) {
  $post_terms = get_the_terms($post->ID, 'audit_category');
} elseif(is_home() || is_category()) {
  $post_terms = get_the_terms($post->ID, 'category');
}

?>
<li class="collection-item mix white <?php echo esc_html( $post_terms[0]->slug );?> avatar" id="m<?=$i?>" data-lat="<?php echo $loc['lat']; ?>" data-lng="<?php echo $loc['lng']; ?>">
    <?php

    if ( has_post_thumbnail() ) {
      accessible_thumbnail('thumbnail', 'circle');
    } else {
      echo '<i class="material-icons yellow circle black-text" aria-hidden="true">filter_7</i>';
    }?>

    <span class="title"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></span>
    <p class="label"><i class="mdi mdi-clock"></i> Posted on <?php the_time('F j, Y');?><br>
      <?php the_excerpt(); ?>
    </p>
    <?php if ( ! empty( $post_terms ) ) {?>
    <span class="chip grey darken-3 white-text" aria-label="This content is categorized as <?php echo esc_html( $post_terms[0]->name );?>"><?php echo esc_html( $post_terms[0]->name );?></span>
    <?php }?>

</li>

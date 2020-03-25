
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
<li class="collection-item col s12 white <?php echo esc_html( $post_terms[0]->slug );?>" id="m<?=$i?>" data-lat="<?php echo $loc['lat']; ?>" data-lng="<?php echo $loc['lng']; ?>">
  <div class="col hide-on-small-only m3">
    <?php

    if ( has_post_thumbnail() ) {
      accessible_thumbnail('thumbnail', 'circle');
    } else {
      echo '<img class="circle" height="150" width="150" src="' . get_template_directory_uri() . '/assets/images/OCN_News.jpg" />';
    }?>

  </div>
  <div class="col s12 m9">
    <div class="hide-on-med-and-up">
      <?php

      if ( has_post_thumbnail() ) {
        accessible_thumbnail('medium', 'mobile-responsive-img');
      } else {
        //echo '<i class="material-icons yellow circle black-text" aria-hidden="true">filter_7</i>';
      }?>

    </div>
    <span class="title"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></span>
    <p class="label"><i class="mdi mdi-clock"></i> Posted on <?php the_time('F j, Y');?><br>
      <?php the_excerpt(); ?>
    </p>
    <?php if ( ! empty( $post_terms ) ) {
        foreach ($post_terms as $term) {?>
          <span class="activity-chip" aria-label="This content is categorized as <?php echo esc_html( $term->name );?>"><?php echo esc_html( $term->name );?></span>
      <?php  }
      ?>
    <?php }?>
  </div>
</li>

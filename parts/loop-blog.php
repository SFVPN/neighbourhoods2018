
<?php $categories = get_the_category();

?>
<li class="collection-item mix white <?php echo esc_html( $categories[0]->slug );?> avatar">
    <?php
    if ( has_post_thumbnail() ) {
  the_post_thumbnail('post-thumbnail', ['class' => 'circle', 'title' => 'Feature image']);

    } else {
      echo '<img src="' . get_template_directory_uri() . '/assets/images/apple-icon-touch.png" alt="" class="circle">';
    }?>

    <span class="title"><?php the_title(); ?></span>
    <p><label><i class="mdi mdi-clock"></i> Posted on <?php the_time('F j, Y');?></label><br>
      <?php the_excerpt(); ?>
    </p>
    <?php if ( ! empty( $categories ) ) {?>
    <span class="secondary-content chip materialize-red lighten-2 white-text"><?php echo esc_html( $categories[0]->name );?></span>
<?php }?>

  </li>

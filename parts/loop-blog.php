
<?php $post_terms = get_the_terms($post->ID, 'category')

?>
<li class="collection-item mix white <?php echo esc_html( $post_terms[0]->slug );?> avatar">
    <?php
    if ( has_post_thumbnail() ) {
      accessible_thumbnail('thumbnail', 'circle');
    } else {
      echo '<img src="' . get_template_directory_uri() . '/assets/images/apple-icon-touch.png" class="circle" role="presentation">';
    }?>

    <span class="title" aria-label="This content is categorized as <?php echo esc_html( $post_terms[0]->name );?>"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></span>
    <p class="label"><i class="mdi mdi-clock"></i> Posted on <?php the_time('F j, Y');?><br>
      <?php the_excerpt(); ?>
    </p>
    <?php if ( ! empty( $post_terms ) ) {?>
    <span class="secondary-content grey darken-3 white-text" aria-hidden="true"><?php echo esc_html( $post_terms[0]->name );?></span>
    <?php }?>

</li>

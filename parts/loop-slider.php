
  <?php
  $images = get_sub_field('gallery');
  if( $images ): ?>

  <div class="slider">
    <?php foreach( $images as $image ): ?>
    <div style="background: url(<?php echo $image['url'];?>) no-repeat center center; background-size: cover;">
      <p><?php echo $image['caption']; ?></p>
    </div>
    <?php endforeach; ?>
  </div>
  <?php endif;?>

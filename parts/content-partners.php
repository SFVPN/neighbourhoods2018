
  <?php if( have_rows('partner_member', 'option') ): ?>

  <div id="partner_members" class="row">
    <div class="container">
      <h2 class="h4 center">Project Partners</h2>

  <?php while( have_rows('partner_member', 'option') ): the_row();

  $image = get_sub_field('partner_logo');
  $email = get_sub_field('partner_email');
  $phone = get_sub_field('partner_phone');
  $name = get_sub_field('partner_name');
  $partner_page = get_sub_field('partner_page');
  ?>


  <div class="col s12 m6 l4">
      <div class="card">
        <div class="card-image">
          <img class="responsive-img" alt="<?php echo $image['alt']; ?>" src="<?php echo $image['url']; ?>"/>
        </div>
        <div class="card-content">
          <h3 class="h6"><?php echo $name;?></h3>
          <p><?php the_sub_field('partner_description');?></p>
          <?php if($email):?>

    					<a class="block" href="<?php echo 'mailto:' . $email; ?>"> <i aria-hidden="true" class="mdi mdi-email"></i><?php echo $email;?></a>

    			<?php endif;?>
          <?php if($phone):?>

    					<a class="block hide-on-large-only" href="<?php echo 'tel:' . $phone; ?>"> <i aria-hidden="true" class="mdi mdi-phone"></i><?php echo $phone;?></a>

            <span class="block hide-on-med-and-down">
    					<i aria-hidden="true" class="mdi mdi-phone"></i><?php echo $phone;?>
    				</span>
    			<?php endif;?>
        </div>
        <div class="card-action">
          <a href="<?php the_permalink($partner_page);?>"><?php echo 'Visit partner website';?></a>
        </div>
      </div>
      </div>



  <?php endwhile; ?>
  </div>
</div>

<?php endif; ?>

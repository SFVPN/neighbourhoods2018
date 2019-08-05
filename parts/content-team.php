
  <?php if( have_rows('team_member', 'option') ): ?>

  <div id="team_members" class="row">
    <div class="container">
      <h2 class="h4 center">The Team</h2>
  <?php while( have_rows('team_member', 'option') ): the_row();

  $image = get_sub_field('team_image');
  $email = get_sub_field('member_email');
  $phone = get_sub_field('member_phone');
  $name = get_sub_field('team_name');
  $team_page = get_sub_field('team_page');
  ?>


  <div class="col s12 m6 l4">
      <div class="card team">
        <?php if($image):?>
        <div class="card-image">
          <img class="responsive-img" alt="<?php echo $image['alt']; ?>" src="<?php echo $image['url']; ?>"/>
        </div>
        <?php endif;?>
        <div class="card-content">
          <h3 class="h6"><?php echo $name;?></h3>
          <p><?php the_sub_field('team_position');?></p>
          <?php if($email):?>

    					<a class="block" href="<?php echo 'mailto:' . $email; ?>"> <i aria-hidden="true" class="mdi mdi-email"></i><?php echo $email;?></a>

    			<?php endif;?>
          <?php if($phone):?>

    					<a class="block hide-on-large-only" href="<?php echo 'tel:' . $phone; ?>"> <i aria-hidden="true" class="mdi mdi-phone"></i><?php echo $phone;?></a>

            <span class="block hide-on-med-and-down">
    					<i aria-hidden="true" class="mdi mdi-phone"></i><?php echo $phone;?>
    				</span>
    			<?php endif;
          if($team_page):
          ?>
          <a class="btn-flat yellow team-page center" href="<?php the_permalink($team_page);?>"><?php the_sub_field('team_page_link_text');?></a>
        <?php endif;?>
        </div>



      </div>
      </div>



  <?php endwhile; ?>
  </div>
</div>

<?php endif; ?>

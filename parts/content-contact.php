<?php
$contact = get_field('main_contact');
if($contact) {
$landline = get_field('landline_number', 'user_' . $contact->ID);
$mobile = get_field('mobile_number', 'user_' . $contact->ID);
	?>

	<div id="contact-details" class="">
		<ul class="collection">
		<li class="collection-item header grey lighten-3 center">
			<h3 class="h5">Contact</h3>
		</li>
    <li class="collection-item avatar">
      <img src="<?php the_field('profile_picture', 'user_' . $contact->ID);?>" alt="" class="circle">
      <h5 class="title"><?php echo $contact->display_name . ' - ' . get_field('position', 'user_' . $contact->ID) ;?></h5>
			<?php if($contact->user_email){?>
				<p>
					<i class="material-icons left">email</i>
					<?php echo 'Email: <a href="mailto:' . $contact->user_email . '">' . $contact->user_email . '</a>';?>
				</p>
			<?php }
      	if($landline){?>
					<p>
						<i class="material-icons left">phone</i>
						<?php echo 'Landline: ' . $landline;?>
					</p>
			<?php }
	      	if($mobile){?>

				<p>
					<i class="material-icons left">phone_android</i>
					<?php echo 'Mobile: ' . $mobile;?>
				</p>
			<?php }?>

    </li>
	</ul>
</div>



<?php } ?>

<?php
$page_id = get_queried_object_id();
if(function_exists('get_field')):
if( have_rows('team_member', 'option') ): ?>

<?php while( have_rows('team_member', 'option') ): the_row();

$image = get_sub_field('team_image');
$email = get_sub_field('member_email');
$phone = get_sub_field('member_phone');
$name = get_sub_field('team_name');
$team_page = get_sub_field('team_page');

if($page_id === $team_page): // loop through the team member list and check whose page link ID matches the current page ID
?>
<div id="contact-details">
 <ul class="collection">
 <li class="collection-item header grey lighten-3 center">
	 <h3 class="h5">Contact</h3>
 </li>
<li class="collection-item avatar">
	<img class="circle" alt="<?php echo $image['alt']; ?>" src="<?php echo $image['url']; ?>"/>
	<h5 class="title"><?php echo $name;?></h5>
	<?php if($email){?>
		<p>
			<i class="material-icons left">email</i>
			<?php echo 'Email: <a href="mailto:' . $email . '">' . $email . '</a>';?>
		</p>
	<?php }
			if($phone){?>

		<p>
			<i class="material-icons left">phone</i>
			<?php echo 'Phone: ' . $phone;?>
		</p>
	<?php }?>

</li>

</ul>
</div>
<?php endif;?>


<?php endwhile; ?>


<?php endif; 

			endif; ?>

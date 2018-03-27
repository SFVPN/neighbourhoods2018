<?php
/*
Template Name: User Profile
*/

acf_form_head();

get_header();

?>

<main  id="maincontent" class="row container">


	<section class="row" itemscope itemtype="http://schema.org/WebPage">


			<header class="resources-article-header col s12 center">


				<h1 class="page-title"><?php the_title(); ?></h1>


				<? //var_dump($post);?>
			</header> <!-- end article header -->


				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			    	<?php //get_template_part( 'parts/loop', 'page' ); ?>
<div class="entry-content col s12">

	<?php if ( $_GET['deleted'] == 'true' ) {
		echo '<p class="center profile-deleted">Your account has been successfully deleted. Thank you!</p>';

	}

	if( is_user_logged_in() ) {

		$admin_email = get_option( 'admin_email' );

		/* Get user info. */
	global $current_user, $wp_roles;

	/* Load the registration file. */
	//require_once( ABSPATH . WPINC . '/registration.php' ); //deprecated since 3.1
$error = array();
	/* If profile was saved, update profile. */
	if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'update-user' ) {

	    /* Update user password. */
	    if ( !empty($_POST['pass1'] ) && !empty( $_POST['pass2'] ) ) {
	        if ( $_POST['pass1'] == $_POST['pass2'] )
	            wp_update_user( array( 'ID' => $current_user->ID, 'user_pass' => esc_attr( $_POST['pass1'] ) ) );
	        // else
	           $error[] = __('The passwords you entered do not match.  Your profile was not updated.', 'profile');
	    }

	    /* Update user information. */

	    if ( !empty( $_POST['email'] ) ){
	        if (!is_email(esc_attr( $_POST['email'] )))
	            $error[] = __('The Email you entered is not valid.  please try again.', 'profile');
	        elseif(email_exists(esc_attr( $_POST['email'] )) != $current_user->id )
	            $error[] = __('This email is already used by another user.  try a different one.', 'profile');
	        else{
	            wp_update_user( array ('ID' => $current_user->ID, 'user_email' => esc_attr( $_POST['email'] )));
	        }
	    }

	    if ( !empty( $_POST['first-name'] ) )
	        update_user_meta( $current_user->ID, 'first_name', esc_attr( $_POST['first-name'] ) );
	    if ( !empty( $_POST['last-name'] ) )
	        update_user_meta($current_user->ID, 'last_name', esc_attr( $_POST['last-name'] ) );


	    /* Redirect so the page will show updated info.*/
	  /*I am not Author of this Code- i dont know why but it worked for me after changing below line to if ( count($error) == 0 ){ */
	    // if ( count($error) < 1 ) {
	    //     //action hook for plugins and extra fields saving
	    //     do_action('edit_user_profile_update', $current_user->ID);
	    //     echo 'Profile Updated';
	    // }


	}
?>

							 <?php
							 if ( $_GET['deleted'] == 'true' ) {
								 echo '<div class="grey lighten-2" style="padding: 2rem;"><p class="center btn-flat white block center">Your account has been successfully deleted. Thank you! <i class="material-icons right">done</i></p></div>';
							 } else {
							echo '<div class="card grey lighten-4"><div class="card-content"><span class="card-title">Profile Information</span>
							<p >
							You can update your profile using the form below and then clicking on the "Update" button.<br /> Your username is <b>'.$current_user->user_login.'</b> and cannot be changed.
							</p>';
							if ( count($error) > 0 ) {
								echo '<br /><p class="error center materialize-red lighten-1 white-text">' . implode("<br />", $error) . '</p>';
							} elseif ($_POST['action'] == 'update-user') {
								echo '<br /><p class="green center white-text"> You profile has been updated ' . $_POST["first-name"] . '</p>';
							} else {

							}

							 echo '</div>
							 <div class="card-action">

												 <a id="logout" class="btn-flat grey darken-4 white-text" href="' . home_url() . '/wp-login.php?action=logout">Log out</a>
												 <a id="delete-account" class="btn-flat orange white-text right" href="' . home_url() . '?action=prefix_delete_user&user_id=' . $current_user->ID . '">Delete Account</a>
											 </div>

							 </div>';
							}




							 //if ( count($error) > 0 ) echo '<p class="error">' . implode("<br />", $error) . '</p>'; ?>
							 <form method="post" id="adduser" action="<?php the_permalink(); ?>">
									 <p class="form-username">
											 <label for="first-name"><?php _e('First Name', 'profile'); ?></label>
											 <input class="text-input" name="first-name" type="text" id="first-name" value="<?php the_author_meta( 'first_name', $current_user->ID ); ?>" />
									 </p><!-- .form-username -->
									 <p class="form-username">
											 <label for="last-name"><?php _e('Last Name', 'profile'); ?></label>
											 <input class="text-input" name="last-name" type="text" id="last-name" value="<?php the_author_meta( 'last_name', $current_user->ID ); ?>" />
									 </p><!-- .form-username -->
									 <p class="form-email">
											 <label for="email"><?php _e('E-mail *', 'profile'); ?></label>
											 <input class="text-input" name="email" type="text" id="email" value="<?php the_author_meta( 'user_email', $current_user->ID ); ?>" />
									 </p><!-- .form-email -->

									 <p class="form-password">
											 <label for="pass1"><?php _e('Password *', 'profile'); ?> </label>
											 <input class="text-input" name="pass1" type="password" id="pass1" />
									 </p><!-- .form-password -->
									 <p class="form-password">
											 <label for="pass2"><?php _e('Repeat Password *', 'profile'); ?></label>
											 <input class="text-input" name="pass2" type="password" id="pass2" />
									 </p><!-- .form-password -->


									 <?php
											 //action hook for plugin and extra fields
											 //do_action('edit_user_profile',$current_user);
									 ?>
									 <p class="form-submit">
											 <?php echo $referer; ?>
											 <input name="updateuser" type="submit" id="updateuser" class="submit button" value="<?php _e('Update', 'profile'); ?>" />
											 <?php wp_nonce_field( 'update-user' ) ?>
											 <input name="action" type="hidden" id="action" value="update-user" />
									 </p><!-- .form-submit -->
							 </form><!-- #adduser -->
<?php
		$options = array(
'post_id' => 'user_'.$current_user->ID, // $user_profile,
//'field_groups' => array(9),
'submit_value' => 'Update Profile'
);



// acf_form(array(
// 	'post_id' => 'user_'.$current_user->ID, // $user_profile,
//   'post_content' => false,
//   'post_title' => false,
//   'return'		=> home_url(),
//   'fields' => array(),
//   'submit_value'		=> __("Update Profile", 'acf'),
// ));

	} else {
		echo '<div class="center"><p class="col s12">
		You must be logged in to manage your account
		</p>
		<p class="center col s12">
		<a class="btn materialize-red lighten-1" href="' . home_url( "/member-login/" ) . '">Login</a>
		</p></div>';
	}
		endwhile; endif;


		?>




		    <?php // get_sidebar(); ?>

</div>

	</section>
</main> <!-- end main -->


<?php get_footer(); ?>

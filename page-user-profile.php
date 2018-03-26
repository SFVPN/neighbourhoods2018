<?php
/*
Template Name: User Profile
*/

acf_form_head();

get_header();


global $current_user;
get_currentuserinfo();
$url = get_permalink();
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

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

	} elseif( is_user_logged_in() ) {

		$options = array(
'post_id' => 'user_'.$current_user->ID, // $user_profile,
//'field_groups' => array(9),
'submit_value' => 'Update Profile'
);

echo '<p>Your username is <b>'.$current_user->user_login.'</b>. This cannot be changed.</p>';

acf_form(array(
	'post_id' => 'user_'.$current_user->ID, // $user_profile,
  'post_content' => false,
  'post_title' => true,
  'return'		=> home_url(),
  'fields' => array('field_59f8aa752b9b9', 'field_59f8afc020642', 'field_59f8aff63c8e4', 'field_5aaa97f9057dd', 'field_59f8a8282855c'),
  'submit_value'		=> __("Update Profile", 'acf'),
));

echo '<a class="btn-flat blue" href="http://neighbourhoods.dev/?action=prefix_delete_user&user_id=' . $current_user->ID . '">Delete Account</a>';
		//get_template_part( 'parts/form', 'general' );

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

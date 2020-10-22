<?php //get_template_part( 'parts/content', 'breadcrumbs' ); ?>

<article id="post-<?php the_ID(); ?>" class="<?php echo $post->post_name;?>" role="article" itemscope itemtype="http://schema.org/WebPage">


		<header class="article-header">
			<h1 class="entry-title h2 single-title center" itemprop="headline">
				<?php
				if( !is_user_logged_in() ) {
					the_title();
				} else {
					echo 'Logged in';
				}
				?>
			</h1>
<?php // get_template_part( 'parts/content', 'share' );?>

		</header> <!-- end article header -->

    <section class="entry-content white container" itemprop="articleBody">
	    <?php the_content();
			?>
			<?php
$args = array(
//'redirect' => home_url(),
'id_username' => 'user',
'id_password' => 'pass',
)
;?>

<?php
if( !is_user_logged_in() ) {

	echo
	'<div class="fixed-action-btn">
		<div class="card grey lighten-4">


	<div class="card-content center">
              <span class="title">Forgot your password?</span>
              <div><a href="' . wp_lostpassword_url( get_permalink() ) . '" title="Lost Password">Click this link to reset it</a></div><br />
							<span class="title">Not yet registered?</span>
							<div><a href="' . home_url( "/member-register/" ) . '">Click this link to register</a></div>
            </div>
						</div>
	</div>';
	wp_login_form( $args );
	if(class_exists('NextendSocialLogin', false)){
	echo '<div class="row center"><div class="col s4">' . do_shortcode('[nextend_social_login provider="google"]') . '</div><div class="col s4">' . do_shortcode('[nextend_social_login provider="twitter"]') . '</div><div class="col s4">' . do_shortcode('[nextend_social_login provider="facebook"]') . '</div></div>';
}
} else {
	echo '<div class="center row"><p class="logged-in col s12">
	<a class="btn materialize-red lighten-1" href="' . home_url() . '/wp-login.php?action=logout">Logout</a>';
	if( current_user_can('edit_others_pages') ) {
	echo '<a class="btn grey darken-4" href="' . admin_url() . '">Visit Admin</a>';
	}
	echo '</p>';
}


?>

	</section> <!-- end article section -->



</article> <!-- end article -->

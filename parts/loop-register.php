<?php //get_template_part( 'parts/content', 'breadcrumbs' ); ?>

<article id="post-<?php the_ID(); ?>" class="<?php echo $post->post_name;?>" role="article" itemscope itemtype="http://schema.org/WebPage">


		<header class="article-header">
			<h1 class="entry-title h2 single-title center" itemprop="headline"><?php the_title();?></h1>
<?php // get_template_part( 'parts/content', 'share' );?>

		</header> <!-- end article header -->

    <section class="entry-content white container" itemprop="articleBody">
	    <?php the_content(); ?>
			<?php if( !is_user_logged_in() ) :
				echo
				'<div class="fixed-action-btn">
					<div class="card grey lighten-4">


				<div class="card-content center">

										<span class="title">Already registered?</span>
										<div><a href="' . home_url( "/member-login/" ) . '">Click this link to login</a></div>
									</div>
									</div>
				</div>';

				?>


				<form action="<?php echo site_url('wp-login.php?action=register', 'login_post') ?>" method="post">
					<label for="user_login">Username</label>
					<input type="text" name="user_login" placeholder="Username" id="user_login" class="input" />
					<label for="user_email">Email</label>
					<input type="text" name="user_email" placeholder="Email" id="user_email" class="input"  />

					<?php do_action('register_form'); ?>
					<input type="submit" value="Register" id="register" />
				</form>
			<?php
			echo '<div class="row center"><div class="col s4">' . do_shortcode('[nextend_social_login provider="google"]') . '</div><div class="col s4">' . do_shortcode('[nextend_social_login provider="twitter"]') . '</div><div class="col s4">' . do_shortcode('[nextend_social_login provider="facebook"]') . '</div></div>';

			else :
				echo '<div class="center"><p class="col s12">
				You have already registered and are logged in.
				</p>';
				echo '<p class="col s12">
				<a class="btn materialize-red lighten-1" href="' . home_url() . '/wp-login.php?action=logout">Logout</a>
				</p></div>';

			endif; ?>

	</section> <!-- end article section -->



</article> <!-- end article -->

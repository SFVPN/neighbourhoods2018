<?php //get_template_part( 'parts/content', 'breadcrumbs' ); ?>

<article id="post-<?php the_ID(); ?>" class="<?php echo $post->post_name;?>" role="article" itemscope itemtype="http://schema.org/WebPage">


		<header class="article-header">
			<h1 class="entry-title single-title center" itemprop="headline"><?php the_title();?></h1>
<?php // get_template_part( 'parts/content', 'share' );?>

		</header> <!-- end article header -->

    <section class="entry-content white container" itemprop="articleBody">
	    <?php the_content(); ?>
			<?php accessible_thumbnail('thumbnail', 'thumbnail');

			//wp_login_form( $args );
			?>

			<?php if( !is_user_logged_in() ) : ?>

				<form action="<?php echo site_url('wp-login.php?action=register', 'login_post') ?>" method="post">
					<label for="user_login">Username</label>
					<input type="text" name="user_login" placeholder="Username" id="user_login" class="input" />
					<label for="user_email">Email</label>
					<input type="text" name="user_email" id="user_email" class="input"  />

					<?php do_action('register_form'); ?>
					<input type="submit" value="Register" id="register" />
				</form>
			<?php else : echo 'You are already logged in.'; endif; ?>


	    <?php wp_link_pages(); ?>
	</section> <!-- end article section -->

	<footer class="article-footer">
	</footer> <!-- end article footer -->

</article> <!-- end article -->

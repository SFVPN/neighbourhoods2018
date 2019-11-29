<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!-->   <html class="no-js"  <?php language_attributes(); ?>> <!--<![endif]-->


	<head>
		<meta charset="utf-8">

		<!-- Force IE to use the latest rendering engine available -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Google site verification tag -->
    <meta name="google-site-verification" content="MDxDCoHq0DTBgwUXoywukVIYRXQBzyNIDqcNTY2uVy8" />

		<!-- Mobile Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta class="foundation-mq">

		<!-- If Site Icon isn't set in customizer -->
		<?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) { ?>
			<!-- Icons & Favicons -->
			<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
			<link rel="icon" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/favicon-32x32.png">
			<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
			<link href="<?php echo get_template_directory_uri(); ?>/apple-icon-touch.png" rel="apple-touch-icon" />
			<link rel="mask-icon" href="<?php echo get_template_directory_uri(); ?>/safari-pinned-tab.svg" color="#60b58c" />
			<!--[if IE]>
				<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
			<![endif]-->
			<meta name="msapplication-TileColor" content="#f01d4f">
			<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/assets/images/win8-tile-icon.png">
	    	<meta name="theme-color" content="#ffffff">
	    <?php } ?>

			<?php if(is_singular('post')):?>

			<meta name="twitter:card" content="summary_large_image" />
			<meta name="twitter:site" content="@<?php echo get_theme_mod( 'tcx_twitter_handle' );?>" />
			<meta name="twitter:creator" content="@<?php echo get_theme_mod( 'tcx_twitter_handle' );?>" />
			<meta property="og:url" content="<?php the_permalink();?>" />
			<meta property="og:title" content="<?php the_title();?>" />
			<meta property="og:description" content="<?php echo get_the_excerpt();?>" />
			<meta property="og:image" content="<?php the_post_thumbnail_url('full');?>" />

			<?php endif;?>

			<?php

			$path = get_page_by_path( 'events' );

			if(is_page($path)):?>

			<meta name="twitter:card" content="summary_large_image" />
			<meta name="twitter:site" content="@<?php echo get_theme_mod( 'tcx_twitter_handle' );?>" />
			<meta name="twitter:creator" content="@<?php echo get_theme_mod( 'tcx_twitter_handle' );?>" />
			<meta property="og:url" content="<?php the_permalink();?>" />
			<meta property="og:title" content="<?php the_title();?>" />
			<meta property="og:description" content="<?php //echo get_the_excerpt();?>" />
			<meta property="og:image" content="<?php the_post_thumbnail_url('full');?>" />

			<?php endif;?>

		  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

      <style id="inverter" media="none">
      html { background-color: #eee; filter: invert(100%); }
      .drag-target {background: transparent;}
      * { background-color: inherit; }
			#map div {background-color: transparent;}
      img:not([src*=".svg"]), [style*="url("] { filter: invert(100%);
			}
    </style>

    <!--[if lt IE 9]>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/assets/css/styleie.css" />
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.6.2/html5shiv.js"></script>
<script src="//s3.amazonaws.com/nwapi/nwmatcher/nwmatcher-1.2.5-min.js"></script>
<script src="//html5base.googlecode.com/svn-history/r38/trunk/js/selectivizr-1.0.3b.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.1.0/respond.min.js"></script>
<![endif]-->


		<?php wp_head(); ?>

		<!-- Drop Google Analytics here -->
		<!-- end analytics -->

	</head>

	<!-- Uncomment this line if using the Off-Canvas Menu -->

  <body <?php body_class('white'); ?>>
<a class="skip-link btn-large" href="#maincontent">Skip to main content</a>

  <header class="header navbar-fixed valign-wrapper" role="banner">

		<?php get_template_part( 'parts/nav', 'topbar' ); ?>



	</header> <!-- end .header -->

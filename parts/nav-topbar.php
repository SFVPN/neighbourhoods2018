<!-- By default, this menu will use off-canvas for small
	 and a topbar for medium-up -->

	 <?php
	 if(function_exists('get_field')):
	 $access = get_field('accessibility_plus', 'option');
	 if ($access){
	 $theme_switcher = get_field('theme_switcher', 'option');
	 $increase_text = get_field('increase_text', 'option');
	 $decrease_text = get_field('decrease_text', 'option');
	 $toolbar_pos = get_field('access_bar_position', 'option');
 }
endif;
	 ?>
	 <nav id="main-nav">
	 	<div class="nav-wrapper"><img id="logo" class="hide-on-med-and-down brand-logo left"
			<?php $logo_image = get_theme_mod( 'tcx_logo_image' );
			if ($logo_image){?>
			src="<?php echo $logo_image;?>" alt=""
			<?php
			} else {?>
			src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.svg" alt=""
			<?php }?>
			/>

			<a aria-label="<?php bloginfo('name'); ?> home page" href="<?php bloginfo('url'); ?>" class="hide-on-large-only">
			<img id="logo-mobile" class="brand-logo center"
				<?php $logo_image = get_theme_mod( 'tcx_logo_image' );
				if ($logo_image){?>
				src="<?php echo $logo_image;?>" alt=""
				<?php
				} else {?>
				src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.svg" alt=""
				<?php }?>
				/>
			</a>


			<a href="<?php bloginfo('url'); ?>" class="brand-logo left"><?php bloginfo('name'); ?></a>

			<span class="hide-on-med-and-down right">
				<?php joints_top_nav(); ?>
			</span>

			<div id="slide-out" class="side-nav hide-on-large-only">
	 			<div class="center">
	 				<img id="mobilelogo"
	 				<?php
	 				$logo_image = get_theme_mod( 'tcx_logo_image' );
	 				if ($logo_image){?>
	 				src="<?php echo $logo_image;?>" alt=""
	 				<?php
	 				} else {?>
	 				src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.svg" alt=""
	 				<?php }?>
	 				/>
	      </div>
				<?php

				if (isset($access)){

				?>
					<div id="access-mob" class="purple darken-1 col s12" aria-label="Accessibility Settings">

						<button id="themeContrast_mob" class="btn-flat waves-effect waves-light white-text" type="button" aria-pressed="false"><?php echo $theme_switcher;?></button>

						<button class="btn-flat waves-effect waves-light white-text" id="plustext_mob"><?php echo $increase_text;?></button>
					<button class="btn-flat waves-effect waves-light white-text" id="minustext_mob"><?php echo $decrease_text;?></button>
				</div>
				<?php }
				?>

				<?php if(is_front_page()){?>
				<div class="active">
					<a href="<?php bloginfo('url'); ?>">Home</a>
				</div>
				<?php } else {?>
				<div>
					<a href="<?php bloginfo('url'); ?>">Home</a>
				</div>
				<?php }?>

	 			<?php joints_top_nav(); ?>
	   </div>

	   <button aria-label="Open main menu" data-activates="slide-out" class="button-collapse right hide-on-large-only"><i class="mdi mdi-menu"></i></button>
	  </div>

	<?php

	if (isset($access)){

	?>
		<div id="access-<?php echo $toolbar_pos;?>" class="purple darken-1 col s12  hide-on-med-and-down" aria-label="Accessibility Settings">

			<button id="themeContrast" class="btn-flat waves-effect waves-light white-text" type="button" aria-pressed="false"><?php echo $theme_switcher;?></button>

			<button class="btn-flat waves-effect waves-light white-text" id="plustext"><?php echo $increase_text;?></button>
		<button class="btn-flat waves-effect waves-light white-text" id="minustext"><?php echo $decrease_text;?></button>
		</div>
	<?php }
	?>

	 </nav>

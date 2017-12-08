<!-- By default, this menu will use off-canvas for small
	 and a topbar for medium-up -->

	 <nav>
	 	<div class="nav-wrapper "><img id="logo" class="hide-on-med-and-down brand-logo center"
			<?php $logo_image = get_theme_mod( 'tcx_logo_image' );
			if ($logo_image){?>
			src="<?php echo $logo_image;?>"
			<?php
			} else {?>
			src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.svg"
			<?php }?>
			/>
			<img id="logo" class="hide brand-logo left"
 			<?php $logo_image = get_theme_mod( 'tcx_logo_image' );
 			if ($logo_image){?>
 			src="<?php echo $logo_image;?>"
 			<?php
 			} else {?>
 			src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.svg"
 			<?php }?>
 			/>
			<a href="<?php bloginfo('url'); ?>" class="brand-logo thin center hide-on-large-only"><?php bloginfo('name'); ?></a>
			<a href="<?php bloginfo('url'); ?>" class="brand-logo thin left hide-on-med-and-down"><?php bloginfo('name'); ?></a>

			<span class="hide-on-med-and-down right">
				<?php joints_top_nav(); ?>
			</span>

			<ul id="slide-out" class="side-nav hide-on-large-only">
	 			<li class="center">
	 				<img id="logo"
	 				<?php
	 				$logo_image = get_theme_mod( 'tcx_logo_image' );
	 				if ($logo_image){?>
	 				src="<?php echo $logo_image;?>" alt=""
	 				<?php
	 				} else {?>
	 				src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.svg" alt=""
	 				<?php }?>
	 				/>
	      </li>

				<?php if(is_front_page()){?>
				<li class="active">
					<a href="<?php bloginfo('url'); ?>">Home</a>
				</li>
				<?php } else {?>
				<li>
					<a href="<?php bloginfo('url'); ?>">Home</a>
				</li>
				<?php }?>

	 			<?php joints_top_nav(); ?>
	   </ul>

	   <a href="" data-activates="slide-out" class="button-collapse"><i class="mdi mdi-menu"></i></a>
	  </div>


		<div id="access-bar" class="center-align materialize-red lighten-2 col s12" aria-label="Accessibility Settings">
			<button id="themeContrast" class="btn-flat" type="button" aria-pressed="false">
	 High Contrast
	 </button>

			<button class="btn-flat waves-effect waves-light" id="plustext">Increase Text Size</button>
	 <button class="btn-flat waves-effect waves-light" id="minustext">Decrease Text Size</button></div>

	 </nav>

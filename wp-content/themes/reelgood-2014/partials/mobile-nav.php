<div class="mobile-only mobile-nav-container">

	<?php
		$mobile_nav_args = array(
			'theme_location'  => 'Mobile Nav',
			'menu'            => 'Mobile Nav',
			'container'       => 'div',
			'menu_class'      => 'menu',
		);

		wp_nav_menu( $mobile_nav_args );
	?>

</div>
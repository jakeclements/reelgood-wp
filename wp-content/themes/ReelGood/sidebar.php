<!-- Start sidebar.php -->

<?php if(REELGOOD_STAGE == true): ?>

	<?php //get_giveaway_buttons(); ?>
					
	<?php get_search_form(); ?>
	
	<?php // get_sidebar_posts('Popular Posts', 2); ?>
	
	<?php get_sidebar_posts('Awesome Videos', 57); ?>
	
	<?php // get_sidebar_calendar('Upcoming Events'); ?>

<?php else: ?>

	<?php // get_giveaway_buttons(); ?>
					
	<?php get_search_form(); ?>
	
	<?php //get_sidebar_posts('Popular Posts', 2); ?>
	
	<?php get_sidebar_posts('Awesome Videos', 57); ?>
	
	<?php // get_sidebar_calendar('Upcoming Events'); ?>

<?php endif; ?>
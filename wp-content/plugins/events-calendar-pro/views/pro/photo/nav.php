<?php
/**
 * Photo View Nav
 * This file contains the photo view navigation.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/photo/nav.php
 *
 * @package TribeEventsCalendar
 * @since  3.0
 * @author Modern Tribe Inc.
 *
 */

if ( !defined('ABSPATH') ) { die('-1'); } ?>

<?php

global $wp_query;

 ?>

<h3 class="tribe-events-visuallyhidden"><?php _e( 'Events List Navigation', 'tribe-events-calendar-pro' ) ?></h3>
<ul class="tribe-events-sub-nav">
	<!-- Display Previous Page Navigation -->
	<li class="tribe-events-nav-previous"><a href="#" class="tribe_paged"><?php _e( '<span>&laquo;</span> Previous Events', 'tribe-events-calendar-pro' ) ?></a></li>
	<!-- Display Next Page Navigation -->
	<li class="tribe-events-nav-next"
	<?php if ( $wp_query->max_num_pages === ( $wp_query->query_vars['paged'] ) ) : ?>
		 style="display:none;"
	<?php endif; ?>
	>
		<a href="#" class="tribe_paged"><?php _e( 'Next Events <span>&raquo;</span>', 'tribe-events-calendar-pro' ) ?></a>
	</li><!-- .tribe-events-nav-next -->
</ul>
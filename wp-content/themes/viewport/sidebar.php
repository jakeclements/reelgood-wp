		<?php zilla_sidebar_before(); ?>
		<!--BEGIN #sidebar .aside-->
		<div id="sidebar" class="aside">
			
		<?php 
		    zilla_sidebar_start();
			
            /* Widgetised Area */ 
			if( is_page() ) {
			    dynamic_sidebar( 'sidebar-page' );
			} elseif( is_single() ) {
			    dynamic_sidebar( 'sidebar-single' );
			} else {
    			dynamic_sidebar( 'sidebar-main' );
			}			
			
			zilla_sidebar_end();
		?>
		
		<!--END #sidebar .aside-->
		</div>
		<?php zilla_sidebar_after(); ?>
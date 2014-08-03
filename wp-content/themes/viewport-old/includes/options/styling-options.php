<?php

/**
 * Create the Styling Options section
 */
add_action('admin_init', 'zilla_styling_options');
function zilla_styling_options(){
	
	$styling_options['description'] = 'Configure the visual appearance of you theme by selecting a stylesheet if applicable, choosing your highlight color and inserting any custom CSS necessary.';
		
	$default_highlight = '#ffd62c';
	
	$styling_options[] = array('title' => 'Highlight Color',
                               'desc' => 'Change this colour to specify the "highlight" color for your site.',
                               'type' => 'color',
                               'id' => 'style_highlight_color',
                               'val' => $default_highlight);
                               
    $styling_options[] = array('title' => 'Custom CSS',
                               'desc' => 'Quickly add some CSS to your theme by adding it to this block.',
                               'type' => 'textarea',
                               'id' => 'style_custom_css');
                                
    zilla_add_framework_page( 'Styling Options', $styling_options, 10 );
}


/**
 * Output the custom CSS
 */
function zilla_custom_css($content) {
    $zilla_values = get_option( 'zilla_framework_values' );
    if( array_key_exists( 'style_custom_css', $zilla_values ) && $zilla_values['style_custom_css'] != '' ){
      $content .= '/* Custom CSS */' . "\n";
        $content .= stripslashes($zilla_values['style_custom_css']);
        $content .= "\n\n";
    }
    return $content;
    
}
add_filter( 'zilla_custom_styles', 'zilla_custom_css' );


/**
 * Highlight CSS
 */
function zilla_highlight_css($content){
    $zilla_values = get_option( 'zilla_framework_values' );
    global $default_highlight;
    
    if( array_key_exists( 'style_highlight_color', $zilla_values ) ) {
        $color = $zilla_values['style_highlight_color'];

        if( !empty($color) && ( $color != $default_highlight ) ) {
            
            $content .= "#footer a:hover,\n.feature-credit a:hover,\n.feature-content a:hover {\n\tcolor: $color !important;\n}";
            
            $content .= ".feature-navigation a:hover,\n.footer-widgets .zilla_flickr_widget a:hover img,\n#footer-feature-nav a:hover,\n.post-thumb a:hover,\n.comment.author-comment .avatar,\n#commentform .form-submit input:hover,\n.contactform li button:hover,\n.zilla-popular-widget-nav a:hover {\n\tbackground-color: $color !important;\n}";
        
        }
    }
    
    return $content;
}
add_action( 'zilla_custom_styles', 'zilla_highlight_css' );

?>
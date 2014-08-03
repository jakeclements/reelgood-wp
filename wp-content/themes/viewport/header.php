<!DOCTYPE html>

<!-- BEGIN html -->
<html <?php language_attributes(); ?>>
<!-- A ThemeZilla design (http://www.themezilla.com) - Proudly powered by WordPress (http://wordpress.org) -->

<!-- BEGIN head -->
<head>

	<!-- Meta Tags -->
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<?php zilla_meta_head(); ?>

	<!-- Title -->
	<title><?php wp_title(''); ?></title>

	<!-- Stylesheets -->
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />

	<!-- RSS & Pingbacks -->
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> RSS Feed" href="<?php if(zilla_get_option('general_feedburner_url')){ echo zilla_get_option('general_feedburner_url'); } else { bloginfo( 'rss2_url' ); } ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php wp_head(); ?>
    <?php zilla_head(); ?>

    <!--[if lt IE 9]>
	<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
	<![endif]-->

<!-- END head -->
</head>

<!-- BEGIN body -->
<body <?php body_class(); ?>>
    <?php zilla_body_start(); ?>

	<!-- BEGIN #container -->
	<div id="container">

	    <?php zilla_header_before(); ?>
		<!-- BEGIN #header -->
		<div id="header">
		<?php zilla_header_start(); ?>
			<div class="inner clearfix">

				<!-- BEGIN #logo -->
				<div id="logo">
					<?php /*
					If "plain text logo" is set in theme options then use text
					if a logo url has been set in theme options then use that
					if none of the above then use the default logo.png */
					if (zilla_get_option('general_text_logo') == 'on') { ?>
					<a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>
					<?php } elseif (zilla_get_option('general_custom_logo')) { ?>
					<a href="<?php echo home_url(); ?>"><img src="<?php echo zilla_get_option('general_custom_logo'); ?>" alt="<?php bloginfo( 'name' ); ?>"/></a>
					<?php } else { ?>
					<a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php bloginfo( 'name' ); ?>" width="109" height="17" /></a>
					<?php } ?>
				<!-- END #logo -->
				</div>

				<?php zilla_nav_before(); ?>
				<!-- BEGIN #primary-nav -->
	    		<div id="primary-nav">
	    			<?php wp_nav_menu( array(
	    				'theme_location' => 'primary-menu', 'container' => 'div', 'menu_id' => 'primary-menu', 'menu_class' => 'sf-menu', 'fallback_cb' => false ) ); ?>
	    		<!-- END #primary-nav -->
	    		</div>
	    		<?php zilla_nav_after(); ?>

    		</div>
    	<?php zilla_header_end(); ?>
		<!--END #header-->
		</div>
		<?php zilla_header_after(); ?>

		<?php
		/* Front Page Header ----------------------------------------*/
		if( is_front_page() || is_home() || is_page_template('template-home-blog.php') || is_page_template('template-home-fullwidth.php') ) {
			$count = zilla_get_option('home_feature_posts');
			$delay = zilla_get_option('home_feature_posts_delay');
			if( !is_numeric($count) ) $count = 0;
			if( $count ){
				$args = array(
			        'post_type' => 'post',
			        'posts_per_page' => $count,
			        'ignore_sticky_posts' => true,
			        'meta_query' => array(
			            array(
			                'key' => '_zilla_feature_feature',
			                'value' => 'on'
			            )
			        )
			    );
			    $the_query = new WP_Query( $args );
				if (have_posts()) : ?>
				<div id="feature-wrapper" <?php if($delay) echo ' data-delay="'. $delay .'"'; ?> class="zilla-image">
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
						<?php $background = get_post_meta($post->ID, '_zilla_feature_background', true); ?>
						<div class="feature <?php echo strtolower($background); ?>">
							<?php if ( has_post_thumbnail() ) the_post_thumbnail('full'); ?>
							<div class="feature-content">
								<h2><a href="<?php the_permalink(); ?>" title="<?php printf(__('Permanent Link to %s', 'zilla'), get_the_title()); ?>"><?php the_title(); ?></a></h2>
								<div class="feature-content-meta">
									<span class="author"><?php _e('By', 'zilla') ?> <?php the_field('author_name'); ?></span>
									<span class="meta-sep">/</span>
									<span class="published"><?php the_time( 'd M Y' ); ?></span>
								</div>
								<div class="feature-navigation"></div>
							</div>
							<?php
							if( has_post_thumbnail($post->ID) ) {
							    $thumbid = get_post_thumbnail_id( $post->ID );

							    $feature_image = get_post($thumbid);

							    if( $feature_image ) {
							        if( !empty($feature_image->post_excerpt) ) {
    							        echo '<div class="feature-credit">';
            							echo $feature_image->post_excerpt;
            							echo '</div>';
        							}
							    }
							}
							?>
						</div>
					<?php endwhile; ?>
				</div>
				<?php
				endif;
				wp_reset_postdata();
			}
		}

		/* Archive and Search Header -----------------------------*/
		if( is_archive() || is_search() || is_404() ) {
		    $image = zilla_get_option('post_default_header_image');
		    if( !empty($image) ) {
		        $height = zilla_get_option('post_default_header_height');
		        $width = zilla_get_option('post_default_header_width');
		        $caption = zilla_get_option('post_default_header_caption');
		        ?>
		        <div id="feature-wrapper" class="zilla-image">
		            <div class="feature dark">
		                <img src="<?php echo $image; ?>" height="<?php echo $height; ?>" width="<?php echo $width; ?>" alt="" />
		                <?php if( !empty($caption) ) { ?>
		                    <div class="feature-credit">
		                        <?php echo stripslashes(htmlspecialchars_decode($caption)); ?>
		                    </div>
		                <?php } ?>
		            </div>
		        </div>
		    <?php }
		}

		/* Single Page Header ------------------------------------*/
		if( is_page() ) {
		    setup_postdata($post);
			if( has_post_thumbnail($post->ID) ) { ?>
			<div id="feature-wrapper" class="zilla-image">
				<div class="feature dark">
					<?php the_post_thumbnail('full'); ?>
					<?php
					    $thumbid = get_post_thumbnail_id( $post->ID );
					    $feature_image = get_post($thumbid);

					    if( $feature_image ) {
					        echo '<div class="feature-credit">';
							echo $feature_image->post_excerpt;
							echo '</div>';
					    }
					?>
				</div>
			</div>
			<?php }
			wp_reset_postdata();
		}


		/* Single Post Header ------------------------------------*/
		if( is_single() ) {
		    setup_postdata($post);
			$format = get_post_format();
			if( $format == 'gallery' ){
				zilla_gallery($post->ID, 'full');
			}
			elseif( $format == 'video' ) { ?>
				<div id="feature-wrapper" class="zilla-video">
					<div class="feature dark">
						<div class="inner">
							<?php zilla_video($post->ID, 960); ?>
						</div>
					</div>
				</div>
			<?php }
			elseif( $format == 'audio' ) { ?>
				<div id="feature-wrapper" class="zilla-audio">
					<div class="feature dark">
						<div class="inner">
							<?php zilla_audio($post->ID, 960); ?>
						</div>
					</div>
				</div>
			<?php }
			elseif( has_post_thumbnail($post->ID) ) { ?>
			<div id="feature-wrapper" class="zilla-image">
				<?php $background = get_post_meta($post->ID, '_zilla_feature_background', true); ?>
				<div class="feature <?php echo strtolower($background); ?>">
					<?php the_post_thumbnail('full'); ?>
					<div class="feature-content">
						<h1><span><?php the_title(); ?></span></h1>
						<div class="feature-content-meta">

							<?php if(get_field('author_name')){

								echo '<span class="author">By ' . get_field('author_name') . ' </span><span class="meta-sep">/</span>';

							}; ?>

							<span class="published"><?php the_time( 'd M Y' ); ?></span>

						</div>
					</div>
                    <?php
					    $thumbid = get_post_thumbnail_id( $post->ID );
					    $feature_image = get_post($thumbid);

					    if( $feature_image ) {
					        echo '<div class="feature-credit">';
							echo $feature_image->post_excerpt;
							echo '</div>';
					    }
					?>
				</div>
			</div>
			<?php }
			wp_reset_postdata();
		} ?>

		<!--BEGIN #content -->
		<div id="content" class="clearfix">
		<?php zilla_content_start(); ?>
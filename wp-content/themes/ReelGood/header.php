<?php
/*
if (! is_user_logged_in() ) {
	$location = home_url().'/no-fly';
	wp_redirect( $location, 301 );
	exit;	
}
*/
?>

<!DOCTYPE html <?php language_attributes(); ?>>
<head>

<meta charset="<?php bloginfo( 'charset' ); ?>" />

<meta name="viewport" content="width=device-width" />

<title>
	<?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?>
</title>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<!-- typekit goodies -->
<script type="text/javascript" src="//use.typekit.net/sxh8xxk.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?> >

<header id="rg-head" class="rg-header">
	
	<div class="row">
		
		<h1 class="ir logo"><a href="<?php bloginfo('url'); ?>">Reel Good</a></h1>
		
		<div class="rg-nav">
			<nav role="navigation" class="site-navigation main-navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); // Display the user-defined menu in Appearance > Menus ?>
			</nav>
		</div>
		
		<!-- 
		<div class="rg-head__login">
			<a href="#">Login</a>
			<a href=""></a>
		</div>
		-->
		
	</div>

</header>
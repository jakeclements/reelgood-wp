<?php 
/**
 * 	Template Name: No-Fly, Secure Page
 *
 *	This page template has a sidebar built into it, 
 * 	and can be used as a home page, in which case the title will not show up.
 *
*/?>
<!DOCTYPE html <?php language_attributes(); ?>>

<head>

<meta charset="<?php bloginfo( 'charset' ); ?>" />

<meta name="viewport" content="width=device-width" />

<title>
	<?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?>
</title>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<script type="text/javascript" src="//use.typekit.net/sxh8xxk.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>

<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/styles/no-fly.css">

<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<!-- typekit goodies -->
<script type="text/javascript" src="//use.typekit.net/sxh8xxk.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>

</head>

<body>
	<div class="login-request">
		<h1>THIS PAGE IS RESTRICTED</h1>
		<p class="restrict">Please log in below to access Pilot.</p>
		<?php wp_login_form(array('remember' => false, 'redirect' => site_url())); ?> 
	</div>
</body>

</html>


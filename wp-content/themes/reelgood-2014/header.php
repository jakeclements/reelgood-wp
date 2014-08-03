<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7 oldie"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8 oldie"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9 oldie"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>

	<meta charset="utf-8">

	<title><?php bloginfo('name'); ?> | <?php is_home() ? bloginfo('description') : wp_title(''); ?></title>

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="author" content="Jake Clements">
  <meta name="copyright" content="Copyright (c) Jake Clements <?php echo date('Y'); ?>">

  <link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/favicon.png" type="image/x-icon">

  <!-- FACEBOOK COMMENTS -->
  <div id="fb-root"></div>
  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=404674779662147";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>

  <?php wp_head(); ?>

  <!--[if lt IE 9]>
    <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7/html5shiv.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.3.0/respond.js"></script>
  <![endif]-->

</head>
<body <?php body_class(); ?>>

<?php include(locate_template('partials/mobile-nav.php'));?>

<header class="rg-header">
  <div class="row">

    <a href="<?php bloginfo('url');?>" class="logo small-8 column medium-4">
      Reel Good | Classic and Contemporary Cinema Melbourne
    </a>
    <!-- /logo -->

    <a class="mobile-only mobile-nav-toggle small-1"></a>
    <?php include(locate_template('partials/top-nav.php')); ?>

  </div>
</header>
<!-- /rg-header -->

<div class="site-wrap">

<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" <?php language_attributes(); ?> > <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" <?php language_attributes(); ?> > <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" <?php language_attributes(); ?> "> <![endif]-->
<!-- Consider adding an manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?> > <!--<![endif]-->
<head>
	<?php if(!empty(constant("GOOGLE_TAG_ID"))){ ?>
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','<?php echo constant("GOOGLE_TAG_ID");?>');</script>
	<!-- End Google Tag Manager -->
	<?php } ?>
	<meta charset="<?php bloginfo('charset'); ?>">

	<title><?php wp_title(); ?></title>

	<!-- Mobile viewport optimized: j.mp/bplateviewport -->
	<meta name="viewport" content="width=device-width" />

	<!-- Favicon and Feed -->
	<link rel="shortcut icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/img/favicons/favicon.ico">
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> Feed" href="<?php echo home_url(); ?>/feed/">
	
	
	<link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?php echo get_template_directory_uri(); ?>/img/favicons/apple-touch-icon-57x57.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/img/favicons/apple-touch-icon-114x114.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/img/favicons/apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/img/favicons/apple-touch-icon-144x144.png" />
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="<?php echo get_template_directory_uri(); ?>/img/favicons/apple-touch-icon-60x60.png" />
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?php echo get_template_directory_uri(); ?>/img/favicons/apple-touch-icon-120x120.png" />
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="<?php echo get_template_directory_uri(); ?>/img/favicons/apple-touch-icon-76x76.png" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/img/favicons/apple-touch-icon-152x152.png" />
    <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/img/favicons/favicon-196x196.png" sizes="196x196" />
    <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/img/favicons/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/img/favicons/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/img/favicons/favicon-16x16.png" sizes="16x16" />
    <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/img/favicons/favicon-128.png" sizes="128x128" />
    <meta name="application-name" content="<?php bloginfo('name'); ?>"/>
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/img/favicons/mstile-144x144.png" />
    <meta name="msapplication-square70x70logo" content="<?php echo get_template_directory_uri(); ?>/img/favicons/mstile-70x70.png" />
    <meta name="msapplication-square150x150logo" content="<?php echo get_template_directory_uri(); ?>/img/favicons/mstile-150x150.png" />
    <meta name="msapplication-wide310x150logo" content="<?php echo get_template_directory_uri(); ?>/img/favicons/mstile-310x150.png" />
    <meta name="msapplication-square310x310logo" content="<?php echo get_template_directory_uri(); ?>/img/favicons/mstile-310x310.png" />
    <meta name="msapplication-notification" content="frequency=30;polling-uri=http://notifications.buildmypinnedsite.com/?feed=<?php echo home_url(); ?>/feed/&amp;id=1;polling-uri2=http://notifications.buildmypinnedsite.com/?feed=<?php echo home_url(); ?>/feed/&amp;id=2;polling-uri3=http://notifications.buildmypinnedsite.com/?feed=<?php echo home_url(); ?>/feed/&amp;id=3;polling-uri4=http://notifications.buildmypinnedsite.com/?feed=<?php echo home_url(); ?>/feed/&amp;id=4;polling-uri5=http://notifications.buildmypinnedsite.com/?feed=<?php echo home_url(); ?>/feed/&amp;id=5;cycle=1" />
	
	

	<!-- Enable Startup Image for iOS Home Screen Web App -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<link rel="apple-touch-startup-image" href="<?php echo get_template_directory_uri(); ?>/mobile-load.png" />

	<!-- Startup Image iPad Landscape (748x1024) -->
	<link rel="apple-touch-startup-image" href="<?php echo get_template_directory_uri(); ?>/img/devices/cerulean-load-ipad-landscape.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)" />
	<!-- Startup Image iPad Portrait (768x1004) -->
	<link rel="apple-touch-startup-image" href="<?php echo get_template_directory_uri(); ?>/img/devices/cerulean-load-ipad-portrait.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)" />
	<!-- Startup Image iPhone (320x460) -->
	<link rel="apple-touch-startup-image" href="<?php echo get_template_directory_uri(); ?>/img/devices/cerulean-load.png" media="screen and (max-device-width: 320px)" />
    <script>var homeUrl = '<?php global $wp;   echo home_url( $wp->request ); ?>' </script>
    
<?php wp_head(); ?>

</head>

<body id="main-body" <?php body_class('antialiased'); ?> data-toggler=".menu-expanded">
	<?php if(!empty(constant("GOOGLE_TAG_ID"))){ ?>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo constant("GOOGLE_TAG_ID");?>"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	<?php } ?>
    <div class="animsition">
	    <?php get_template_part( 'parts-nav/menu', 'centered-float-logo-float-search' ); ?>
        
        <?php /* abilitare per fullpage con footer incluso 
        <?php if( !is_home() && !is_page_template ( 'page.php' ) ){?>
        <div <?php echo ( is_home() || is_page_template ( 'page.php' ) ) ? 'id="fullpage"' : '';?> class="page-wrapper">
        <?php } ?>
        */ ?>
        
        <?php /* rimuovere per fullpage con footer incluso */ ?>
        <div class="page-wrapper">

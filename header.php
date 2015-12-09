<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" <?php language_attributes(); ?> > <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" <?php language_attributes(); ?> > <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" <?php language_attributes(); ?> "> <![endif]-->
<!-- Consider adding an manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?> > <!--<![endif]-->
<head>
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

<body <?php body_class('antialiased'); ?>>
    <div class="animsition">
        <header id="main-header">
            <div class="title-bar" id="main-menu-mobile-bar" data-responsive-toggle="main-menu" data-hide-for="large">
                <div class="title-bar-right">
                    <button class="menu-icon" type="button" data-toggle></button>
                </div>
                <div class="title-bar-left">
                    <div class="title-bar-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
                        <?php if(get_global_option_img('logo')){ ?>
                            <img src="<?php the_global_option_img('logo'); ?>">
                            <span><?php bloginfo( 'name' ); ?></span>
                        <?php } else if (get_global_option_img('logo_mobile')) { ?>
                            <img src="<?php the_global_option_img('logo_mobile'); ?>">
                            <span><?php bloginfo( 'name' ); ?></span>
                        <?php }else{
                            bloginfo( 'name' );
                        } ?>
                    </a></div>
                </div>
            </div>
            
            <div class="top-bar" id="main-menu">
                <div class="column row" >
                    <div class="top-bar-left" >
                        <ul class="menu">
                            <li class="menu-text name show-for-large" >
                                <h2><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home" >
                                    <?php if(get_global_option_img('logo')){ ?>
                                        <img src="<?php the_global_option_img('logo'); ?>">
                                        <span><?php bloginfo( 'name' ); ?></span>
                                    <?php } else {
                                        bloginfo( 'name' );
                                    } ?>
                                    </a>
                                </h2>
                            </li>
                        </ul>
                    </div>
                    <div class="top-bar-left" >
                        <ul class="menu vertical large-horizontal" data-dropdown-menu>
                            
                            <?php
                                wp_nav_menu( array(
                                    'theme_location' => 'primary',
                                    'container' => false,
                                    'depth' => 0,
                                    'items_wrap' => '%3$s',
                                    'fallback_cb' => 'cerulean_menu_fallback', // workaround to show a message to set up a menu
                                    'walker' => new cerulean_walker( array(
                                        'in_top_bar' => true,
                                        'item_type' => 'li',
                                        'menu_type' => 'main-menu'
                                    ) ),
                                ) );
                            ?>
                        </ul>
                    </div>
                    <div class="top-bar-right"  >
                        <ul class="menu vertical large-horizontal" data-responsive-menu="accordion large-dropdown">
                        <?php 
                            if( function_exists('icl_get_languages') ){
                                $languages = icl_get_languages('skip_missing=0&orderby=custom');
                                if(count($languages) == 2 ){ 
                                    ?>
                                    
                                    <?php 
                                    foreach($languages as $language){
                                        if($language['active'] != 1){ ?>
                                            <li>
                                                <a href="<?php echo $language['url'];?>">
                                                
                                                    <span class="hide-for-large" ><?php echo $language['native_name']; ?></span>
                                                    <span class="show-for-large uppercase" ><?php echo $language['language_code']; ?></span>
                                                </a>
                                            </li>
                                        <?php } 
                                    } 

                                } else {
                                    
                                    foreach($languages as $language){ 
                                        if($language['active'] == 1){
                                            //if($i != 0) echo ' | ';
                                            //var_dump($language);
                                            ?>
                                            <li class="has-submenu" >
                                                <a href="#">
                                                    
                                                    <?php echo $language['native_name']; ?>
                                                    <!--
                                                    <span class="hide-for-large" ><?php echo $language['native_name']; ?></span>
                                                    <span class="show-for-large uppercase" ><?php echo $language['language_code']; ?></span>
                                                    -->
                                                </a>
                                                <ul class="vertical submenu menu" data-submenu>
                                                    <?php 
                                                    foreach($languages as $language2){
                                                        if($language2['active'] != 1){ ?>
                                                            <li><a href="<?php echo $language2['url'];?>"><?php echo $language2['native_name']; ?></a></li>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </ul>
                                            </li>
                                            <?php 
                                        }
                                    }
                                }
                            } ?>
                        </ul>
                    </div>
                </div>
            </div>
            
           
            <!-- End of Top-Bar -->
        </header>
        <div class="page-wrapper">

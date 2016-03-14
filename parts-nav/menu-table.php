<?php /* un template per un menu con celle di uguale larghezza su desktop, con dropdown su desktop e drill down su mobile */ ?>

<header id="main-header">
    <?php get_template_part( 'parts-nav/mobile-bar', 'table' ); ?>
    
    
    <div class="top-bar" id="main-menu">
        <div class="column row " >
            
            <div class="top-bar-left menu-tbl" >
                
                <ul class="vertical large-horizontal menu main-menu menu-tbl-row" data-responsive-menu="drilldown large-dropdown">
                    <li class="menu-text name show-for-large menu-item" >
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
            
        </div>
    </div>
    
   
    <!-- End of Top-Bar -->
</header>
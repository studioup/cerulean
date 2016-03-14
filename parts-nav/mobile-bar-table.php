<div class="title-bar " id="main-menu-mobile-bar" data-responsive-toggle="main-menu" data-hide-for="large">
    <div class=" o-tbl__row">
        
        <div class="o-tbl__cell text-align-left">
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
        <div class="o-tbl__cell text-align-right">
            <button class="menu-icon" type="button" data-toggle="main-body">
            	<div class="menu-icon-inner"></div>
            </button>
        </div>
    </div>
</div>
        </div><!-- end .page-wrapper -->
        
        
        

        <footer id="main-footer" class="full-width" role="contentinfo">
            <!--
            <div class="full-width footer-widget">
                <div class="row">
                    <?php dynamic_sidebar("Footer"); ?>
                </div>
            </div>
            -->
            <!--
            <div class="row">
                <div class="large-12 columns">
                    <?php wp_nav_menu(array('theme_location' => 'utility', 'container' => false, 'menu_class' => 'inline-list')); ?>
                </div>
            </div>
            -->
            <div class="credits">
                <div class="row" data-equalizer data-equalize-on="medium">
                    <div class="large-7 small-12 medium-8 columns">
	                    <div class="o-tbl xlittle-bottom-padding"  data-equalizer-watch>
		                    <div class="o-tbl__row">
			                    <div class="o-tbl__cell vertical-align-bottom">
				                    <div class="text-center medium-text-left">
				                    <?php 
					                    $indirizzo = get_field('indirizzo','options');
					                    $indirizzo = explode( '<br />', $indirizzo);
					                    
					                    //var_dump($indirizzo);
				                    ?>
			                        <p class="uppercase">&copy; <?php echo date('Y'); ?> <?php foreach($indirizzo as $k => $v){
				                        echo trim($v);
				                        echo ' ';
				                        
			                        }?>| <?php _e('VAT ID','cerulean');?> <?php echo get_global_option('partita_iva'); ?><br>
			                        <?php _e("Tel.","wpv-views"); ?> <?php echo get_global_option('telefono');?> | 
			                        <?php _e("Fax.","wpv-views"); ?> <?php echo get_global_option('fax');?> | 
			                        <a href="mailto:<?php echo get_global_option('email');?>" class="no-animation"><?php echo get_global_option('email');?></a>
			                        </p>
			                        <div>
				                        <?php 
			                            if( function_exists('icl_get_languages') ){
			                                $languages = icl_get_languages('skip_missing=0&orderby=custom');
			                                if(count($languages) >  1 ){ 
			                                    ?>
			                                    
			                                    <?php 
				                                $k = 0 ;
			                                    foreach($languages as $language){
				                                    //echo $k;
				                                    if($k != 0 ) {
					                                    echo " | ";
					                                }
			                                        //if($language['active'] != 1){ ?>
			                                            
			                                            <a href="<?php echo $language['url'];?>">
			                                            
			                                                <span class="" ><?php echo $language['native_name']; ?></span>
			                                            </a>
			                                            
			                                        <?php //} 
				                                    $k++;
			                                    } 
			
			                                }
			                            } ?>
			                        </div>
									</div>
			                    </div>
			                </div>       
                        </div>
                    </div>
                    <div id="credits" class="large-2 small-12 hide-for-medium-only columns text-center">
	                    <div class="o-tbl xlittle-bottom-padding" data-equalizer-watch>
		                    <div class="o-tbl__row">
			                    <div class="o-tbl__cell ">
									<a href="http://www.studioup.it/" title="Studio Up - Agenzie Web Milano"><strong>Studio Up - Agenzia Web Milano</strong></a>
			                    </div>
		                    </div>
	                    </div>
                    </div>
                    <div class="large-3 medium-4 small-12 columns text-center medium-text-right">
	                    <div class="o-tbl xlittle-bottom-padding" data-equalizer-watch>
		                    <div class="o-tbl__row">
			                    <div class="o-tbl__cell text-align-right social-sharer-container-tbl-cell vertical-align-bottom">
				                    <div class="social-sharer-container text-left">
				                    	<div class="color-white like-h6"><?php _e('Follow us','cerulean'); ?></div>
										<?php echo get_social_links() ?>
				                    </div>
			                    </div>
		                    </div>
	                    </div>
                    </div>
                </div>
            </div>
        </footer>
        <div id="outdated">
             <h6><?php _e('Your browser is out-of-date!','cerulean'); ?></h6>
             <p><?php _e('Update your browser to view this website correctly.','cerulean'); ?>, <a id="btnUpdateBrowser" href="http://outdatedbrowser.com/"><?php _e('Update my browser now','cerulean'); ?> </a></p>
             <p class="last"><a href="#" id="btnCloseUpdateBrowser" title="<?php _e('Close','cerulean'); ?>">&times;</a></p>
        </div>

        <?php wp_footer(); ?>
        <!--
        <script>
            //$('body');
            (function($) {
                //$(document).foundation();
                //console.log('test')

            })(jQuery);
        </script>
        -->
    </div>
</body>
</html>

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
                <div class="row">
                    <div class="large-8 small-12 medium-8 columns">
                        <p>&copy; <?php echo date('Y'); ?> Business Name <small>- <?php _e('VAT ID','cerulean');?> xxxxxxxx.</small> </p>
                    </div>
                    <div id="credits" class="large-4 small-12 medium-4 columns">
                        <a href="http://www.studioup.it/" title="Studio Up - Agenzie Web Milano"><strong>Studio Up - Agenzia Web Milano</strong></a>
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

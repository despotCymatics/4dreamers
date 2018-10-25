<footer class="light-gray">
	<div class="container">
        <div class="row">
            <div class="col-sm-5">
            	<div class="footer-holder">
                	<div class="logo-holder">
                    	<a href="#">logo</a>
                    </div>
        			<?php wp_nav_menu(array('theme_location'=>'footer-menu','container' => false,'menu_class' =>'nav navbar-nav'));?>
                    <div class="soc">
                    	<a href="#"><i class="fa fa-facebook-square"></i></a>
                        <a href="#"><i class="fa fa-twitter-square"></i></a>
                    </div>
                    <p class="copyright">&copy; <?php echo date('Y'); ?> 4DREAMERS. <?php echo pll__('All rights reserved.'); ?></p>
                </div>
            </div>
            <div class="footer_logos">
                <div class="col-sm-5">
                    <a target="_blank" href="http://www.bancaintesabeograd.com"><img src="<?php echo get_template_directory_uri(); ?>/images/logos/intesa_logo.png"></a>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/logos/maestro.jpg">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/logos/mastercard.jpg">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/logos/visa.jpg">    
                </div>
                <div class="col-sm-2">
                    <a target="_blank" href="http://www.mastercardbusiness.com/mcbiz/index.jsp?template=/orphans&content=securecodepopup"><img src="<?php echo get_template_directory_uri(); ?>/images/logos/master_secure.jpg"></a>
                    <a target="_blank" href="http://www.visa.ca/verified/infopane/index.html"><img src="<?php echo get_template_directory_uri(); ?>/images/logos/verified_visa.jpg"></a>
                </div>
            </div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
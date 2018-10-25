<?php

get_header(); ?>


<section>
    <div class="container">
        <div class="row">
        	<div class="col-md-12">
        		<div class="form-holder inner">
        			<div style="text-align:center;">
	        			<img src="<?php echo get_template_directory_uri()."/images/404.jpg" ?>">
	        			<h3><?php echo pll__('Page Not Found'); ?></h3>
        			</div>
        		</div>
        	</div>
        </div>
    </div>    	 
</section>


<?php
get_footer();
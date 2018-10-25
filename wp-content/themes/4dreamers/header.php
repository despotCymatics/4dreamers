<?php 

//error_reporting(E_ALL);

//ini_set('display_errors', 1);
global $wp_query; 
$pageId = $wp_query->post->ID; 
?>

<!DOCTYPE html>

<html lang="sr" xml:lang="sr" xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/html">

<?php require "inc/result_seo_title.php" ?> 

<head>

	<title><?php 

	if(is_page_template( 'template_results.php' )) {

		echo get_seo_title_for_results();

	}

	wp_title( '|', true, 'right' ); ?>

	</title>
	<meta name="description" content="<?php bloginfo('description'); ?>" />

	<meta charset="<?php bloginfo( 'charset' ); ?>">

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

	<meta http-equiv="X-UA-Compatible" content="IE=edge" />

	<link rel="shortcut icon" type="image/png" href="/favicon.png"/>

	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>

</head>

<body>

<input id="ajax_url" type="hidden" value="<?php echo admin_url('admin-ajax.php'); ?>">

	<header> 

		<div class="logo-header">

	        <div class="container">

	            <div class="logo-holder">
	            	<a href="<?php echo home_url(); ?>" class="navbar-brand"><img src="<?php echo get_template_directory_uri(); ?>/images/logo_4dreamers.png"></a>
	            </div>

	            <!--<div class="baner-header">
					<div id="shuffle">
						<?php /*if(get_bloginfo('language') == 'sr-RS') $bannerLink = "/sr/letovi/";
						else $bannerLink = "/en/flights/";
						*/?>
						<a class="" href="<?/*=$bannerLink;*/?>"><img src="/wp-content/uploads/banners/ac.png"></a>
						<a class="" href="<?/*=$bannerLink;*/?>"><img src="/wp-content/uploads/banners/gb.jpg"></a>
						<a class="" href="<?/*=$bannerLink;*/?>"><img src="/wp-content/uploads/banners/os.jpg"></a>
						<a class="" href="<?/*=$bannerLink;*/?>"><img src="/wp-content/uploads/banners/lh.jpg"></a>

					</div>

	            	<?php /*if (get_field('header_banner_code') != "") {

						echo get_field('hader_banner_code');

					} elseif (get_field('header_banner_image') != "") {	*/?>

						<a target="_blank" href="<?php /*echo get_field('header_banner_link'); */?>"><img src="<?php /*echo get_field('header_banner_image'); */?>"></a>

					<?php /*} */?>

	            </div>-->

	        </div>

	    </div> 

	    <div class="nav-header">

	        <div class="container">

	            <nav class="navbar navbar-default" role="navigation">

	                <div class="navbar-header">

	                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>

	                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

	                        <?php wp_nav_menu( array( 'theme_location' => 'primary',  'menu_class' => 'nav navbar-nav', 'container' => false ) ); ?>

	                        <div class="lan-soc-holder">
	                        		<a class="reg-links <?= (pll_get_post(1455) === $pageId)? "active":""; ?>" href="<?php echo get_permalink(pll_get_post(1455)); ?>"><?php echo pll__('Login'); ?></a>
	                        		<a class="reg-links <?= (pll_get_post(1464) === $pageId)? "active":""; ?>" href="<?php echo get_permalink(pll_get_post(1464)); ?>"><?php echo pll__('Register'); ?></a>

	                        	<?php 

	                        		//pll_the_languages(array('show_names'=> 1,'show_flags'=> 0));

	                        		$langs = pll_the_languages(array('raw'=>1));

	                        		foreach ($langs as $lang) {

	                        			if($lang['slug'] == 'en') { ?>

											<a title="English" href="<?php echo $lang['url'];?>" class="lan <?php if($lang['current_lang']) {echo 'active';} ?>">En</a>	

	                        	<?php	}else { ?>

											<a title="Srpski" href="<?php echo $lang['url'];?>" class="lan <?php if($lang['current_lang']) {echo 'active';} ?>">Sr</a>  

	                        	<?php 	}

	                        		}

	                        	?>

	                        	<!--a href="#" class="soc fb"><i class="fa fa-facebook"></i></a>

	                        	<a href="#" class="soc tw"><i class="fa fa-twitter"></i></a-->

	                        </div>

	                    </div>

	                </div>

	            </nav>

	        </div>

	    </div>

    </header>






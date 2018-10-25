<?php 
/*

Template Name: Results Page 

*/
if($_SERVER['QUERY_STRING'] == "") {
	header('Location: '.get_bloginfo('url'));
	exit();
}

get_header(); 

$params = explode('params=', $_SERVER['QUERY_STRING']);

if(strrpos($params[1], "HotelSearch") !== false) {
	$loading_page = get_post(pll_get_post(960));
}else{
	$loading_page = get_post(pll_get_post(254));
}

?>
<div id="loading_layer" class="bigWrap" style="background: url('<?php echo wp_get_attachment_url(get_post_thumbnail_id($loading_page->ID));?>') no-repeat; background-size: cover; background-color: #2097FF;">
	<div class="loading-screen-content ">
		<img width="150px" src="<?php echo get_template_directory_uri();?>/images/logo_4dreamers.png">
		<h3><?php echo $loading_page->post_title; ?></h3>
		<div class="waiting_content"><?php echo $loading_page->post_content; ?></div>
	</div>
	<!--div class="animHolder"><img src="<?php echo get_template_directory_uri(); ?>/images/loading_anim.gif"></div-->
</div>

<iframe id="amadeusIframe" scrolling="no" frameborder="0" width="100%" height="995" style="margin: 0 0 -5px 0; padding-top:20px;" src="https://www.epower.amadeus.com/fordreamers/#<?php echo $params[1]; ?>"></iframe>

<script type="text/javascript">
	
	$('body').css('overflow', 'hidden');

	var count_loading = 0;

	function receiveMessage(event)
	{
		var new_height = event.data;
		var old_height = jQuery('#amadeusIframe').height();
		if(!isNaN(new_height) && (new_height != old_height)){
			jQuery('#amadeusIframe').height(new_height+100);
		}
		if(new_height == 'amadeus_loading_complete'){
			
			if( count_loading == 1){
				setTimeout(function(){
					jQuery("#loading_layer").fadeOut( "slow" );
					$('body').css('overflow', 'auto');
				},1000);
				
			}
			count_loading++;
			console.log(event);

		}
		
	}

	setTimeout(function(){
		jQuery("#loading_layer").fadeOut( "slow" );
		$('body').css('overflow', 'auto');
	},30000);
	

	window.addEventListener("message", receiveMessage, false);

</script>


<?php get_footer(); ?>
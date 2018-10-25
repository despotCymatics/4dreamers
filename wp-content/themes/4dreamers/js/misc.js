$( document ).ready(function() {
	$('#shuffle a').each(function(index, value){
		$(this).addClass('ad '+ 'num_'+index);
	});

	var maxdivs = 1;
	var currentIndex = Math.floor(Math.random() * (maxdivs - 0 + 1) + 0);
	$("#shuffle a.ad:not(:eq(" + currentIndex + "))").hide();

	var totalDiv = $("#shuffle .ad").length;

	setInterval(function () {
		currentIndex = (currentIndex + 1) % totalDiv;

		$("#shuffle .ad").hide();
		$("#shuffle .ad").eq(currentIndex).fadeIn(600);

	}, 10000);
});

jQuery(function ($) {
	var slider = jQuery('.bxslider.hotelItems').bxSlider({
			minSlides: 2,
			maxSlides: 5,
			slideWidth: 205,
			slideMargin: 20
	});
	register_categories_selection('hotel',slider);
	register_categories_selection('place',null);
});

function fourDreamersShowMorePosts(){
	//var $ = jQuery.noConflict();
	jQuery('.post-more-btn').slideUp(300,function(){
		jQuery('.post-more').slideDown(200);
		jQuery('.all-destinations').show('fast');
	});
}	

function fourDreamersShowMorePlaces(){
	//var $ = jQuery.noConflict();
	jQuery('.post-more-btn').slideUp(300,function(){
		jQuery('.post-more').slideDown(200);
	});
}	

function fourDreamersReadMore(){
	jQuery('.fullText').slideDown(200);
	jQuery('.readFullText').hide(200);
}		

function fourdreams_city_ajax_get_data( type, slug,slider ){

	jQuery('.'+type+' .loading-overlay').fadeIn('fast');
	
	jQuery(document).ajaxStop(function() {
		jQuery('.loading-overlay').fadeOut('fast');
	});

	 var ajax_url = jQuery('#ajax_url').val();
	 var city_code = jQuery('#city_code').val();
	 var data = { 
	 	action: 'fourdreams_ajax_get_'+type,
	 	slug: slug,
		city_code: city_code,
	};
	
	jQuery.post( ajax_url, data, function( data ) {
		jQuery( "#" + type + "-content" ).html( data );
		if(type == 'hotel'){
			slider.reloadSlider();
		}
	});

}

function register_categories_selection( type, slider ){
	jQuery('.' + type + '-categories > .choose-box > a').click(function(){
		jQuery('.' + type + '-categories > .choose-box > a').removeClass('active');

		var slug = jQuery(this).attr('class');
		slug.replace("active", "");
		slug.trim();
		fourdreams_city_ajax_get_data( type, slug,slider );

		jQuery(this).addClass('active');
		return false;
	});
}

function fourdreamers_ajax_load_dest_page(){
	var ajax_url = jQuery('#ajax_url').val();

	var page_number = parseInt( jQuery('#pagenumber').val() )+1;
	var no_items = jQuery('#no_items').val();
	var no_perppage = jQuery('#no_perppage').val();

	 var data = { 
	 	action: 'fourdreamers_ajax_load_dest_page',
	 	page_number: page_number,
		no_items: no_items,
		no_perppage: no_perppage,
	};
	
	jQuery.post( ajax_url, data, function( data ) {
		jQuery( '.destination-list' ).append( data );
		jQuery('#pagenumber').val( page_number );
		if(page_number >= Math.ceil(no_items/no_perppage)){
			jQuery( '.more-button' ).hide();
		}
	});
}
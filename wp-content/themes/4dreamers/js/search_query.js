//var $ = jQuery;

var result_page;

if(window.location.href.indexOf("/sr/") > -1) {
    result_page = '/sr/rezultati-pretrage';
}else {
   result_page = '/en/result-page'
}

/* FLIGHT SEARCH */
jQuery('#launch_flight_query').click(function() {
    if(validateFlightSearch()) {
    	var query_str="";

    	var calendar_search = false;

        var FlightType = jQuery('input:radio[name=FlightType]:checked').val();

        var airline0 = "";
        
        var Qfrom = "&QFrom=C";
       
        var Qto = "&QTo=C";

        if(jQuery("#From").val() != "" && jQuery("#To").val() != "") {
            var From = jQuery("#From").val().split("| ");
            From = From[1].trim(); 
            var To = jQuery("#To").val().split("| ");
            To = To[1].trim();
            
            if(jQuery("#From").val().indexOf(", Airport") != -1) {
                Qfrom = "&QFrom=A";
            }

            if(jQuery("#To").val().indexOf(", Airport") != -1) {
                Qto = "&QTo=A";
            }
        }else {
            var From = "BEG";
            var To = "LON";
        }

        var QfromQto = Qfrom+Qto;

        if(jQuery('#IsCalendarSearch').is(':checked')){
    		calendar_search = true;
    	}

        var additional = "";

        if(document.URL.indexOf("/sr/") != -1) {
            additional = "&Culture=sr-Latn-CS";
        } else {
            additional = "&Culture=en-GB";
        }

        if(jQuery("#airline0").val() != "") {
            airline0 = jQuery("#airline0").val().split("| ");
            airline0 = airline0[1].trim(); 
            additional += "&PrefAirline1="+airline0;
        } 


        if (FlightType == 'RoundTrip') {
     
            var parameters = "FlightType="+FlightType+"&From="+From+"&To="+To+"&DepartureDate="+jQuery("#DepartureDate").val()+"&ReturnDate="+jQuery("#ReturnDate").val()+"&AdtCount="+jQuery('#AdtCount').val()+"&ChdCount="+jQuery('#ChdCount').val()+"&InfCount="+jQuery('#InfCount').val()+"&CabinClass="+jQuery('#CabinClasses').val()+"&DepartureTime="+jQuery('#DepartureTime').val()+"&ReturnTime="+jQuery('#ReturnTime').val()+"&IsCalendarSearch="+calendar_search+QfromQto+additional+"&Method=Search&Page=Result";

        }else if(FlightType == 'OneWay') {
             var parameters = "FlightType="+FlightType+"&From="+From+"&To="+To+"&DepartureDate="+jQuery("#DepartureDate").val()+"&AdtCount="+jQuery('#AdtCount').val()+"&ChdCount="+jQuery('#ChdCount').val()+"&InfCount="+jQuery('#InfCount').val()+"&CabinClass="+jQuery('#CabinClasses').val()+"&DepartureTime="+jQuery('#DepartureTime').val()+"&IsCalendarSearch="+calendar_search+QfromQto+additional+"&Method=Search&Page=Result";
        }

    	//query_str="//"+env+".epower.amadeus.com/"+portal_code+parameters;  	
    	
    	//console.log(parameters);
       
        window.open ('//'+window.location.hostname+result_page+'/?params='+parameters,'_self');
     
    } else {
        return false;
    }

});

/* FLIGHT SEARCH Multileg */
jQuery('#launch_flight_multileg_query').click(function() {
    if(validateFlightMultilegSearch()) {

        var airline0 = "";
        
        /* Stop1 */
        var Qfrom = "&QFrom=C"; 
        var Qto = "&QTo=C";

        if(jQuery("#From1").val() != "" && jQuery("#To1").val() != "") {
            var From = jQuery("#From").val().split("| ");
            From = From[1].trim(); 
            var To = jQuery("#To1").val().split("| ");
            To = To[1].trim();
            
            if(jQuery("#From1").val().indexOf(", Airport") != -1) {
                Qfrom = "&QFrom=A";
            }

            if(jQuery("#To1").val().indexOf(", Airport") != -1) {
                Qto = "&QTo=A";
            }
        }else {
            var From = "BEG";
            var To = "LON";
        }

        /* Stop2 */
        var Qfrom1 = "&QFrom1=C";
        var Qto1 = "&QTo1=C";

        if(jQuery("#From2").val() != "" && jQuery("#To2").val() != "") {
            var From1 = jQuery("#From2").val().split("| ");
            From1 = From1[1].trim(); 
            var To1 = jQuery("#To2").val().split("| ");
            To1 = To1[1].trim();
            
            if(jQuery("#From2").val().indexOf(", Airport") != -1) {
                Qfrom1 = "&QFrom1=A";
            }

            if(jQuery("#To2").val().indexOf(", Airport") != -1) {
                Qto1 = "&QTo1=A";
            }
        }else {
            var From1 = "BEG";
            var To1 = "LON";
        }

        /* Stop3 - opciono */
        var Qfrom2 = "";
        var Qto2 = "";
        var third = "";

        if(jQuery("#From3").val() != "" && jQuery("#To3").val() != "") {
            var From2 = jQuery("#From3").val().split("| ");
            From2 = From2[1].trim(); 
            var To2 = jQuery("#To3").val().split("| ");
            To2 = To2[1].trim();
            
            if(jQuery("#From3").val().indexOf(", Airport") != -1) {
                Qfrom2 = "&QFrom2=A";
            }else {
                Qfrom2 = "&QFrom2=C";
            }

            if(jQuery("#To3").val().indexOf(", Airport") != -1) {
                Qto2 = "&QTo2=A";
            }else{
                Qto2 = "&QTo2=C";
            }

            third = "&From2="+From2+"&To2="+To2+Qfrom2+Qto2+"&DepartureDate2="+jQuery("#DepartureDate3").val();

        }

        var QfromQto = Qfrom+Qto+Qfrom1+Qto1;

        var additional = "";

        if(document.URL.indexOf("/sr/") != -1) {
            additional = "&Culture=sr-Latn-CS";
        } else {
            additional = "&Culture=en-GB";
        }

        if(jQuery("#airline0").val() != "") {
            airline0 = jQuery("#airline0").val().split("| ");
            airline0 = airline0[1].trim(); 
            additional += "&PrefAirline1="+airline0;
        } 
     
        var parameters = "FlightType=MultiLeg&From="+From+"&To="+To+"&DepartureDate="+jQuery("#DepartureDate1").val()+"&From1="+From1+"&To1="+To1+"&DepartureDate1="+jQuery("#DepartureDate2").val()+"&AdtCount="+jQuery('#AdtCountM').val()+"&ChdCount="+jQuery('#ChdCountM').val()+"&InfCount="+jQuery('#InfCountM').val()+QfromQto+third+additional+"&Method=Search&Page=Result";

        //query_str="//"+env+".epower.amadeus.com/"+portal_code+parameters;   
             
        window.open ('//'+window.location.hostname+result_page+'/?params='+parameters,'_self');
     
    } else {
        return false;
    }

});

/* HOTEL SEARCH */
jQuery('#launch_hotel_query').click(function() {
    if(validateHotelSearch()) {

        if(jQuery("#Destination").val() != "" ) {
            var city = jQuery("#Destination").val().split("| ");
            city = city[1].trim(); 
            
        }else {
            var city = "NYC";
        }

        var additional = "";

        if(document.URL.indexOf("/sr/") != -1) {
            additional = "&Culture=sr-Latn-CS";
        } else {
            additional = "&Culture=en-GB";
        }

        var parameters = "ProviderSelection=OnlyAmadeus&Method=HotelSearch"+additional+"&CityCode="+city+"&CheckInDate="+jQuery("#CheckIn").val()+"&CheckOutDate="+jQuery("#CheckOut").val()+"&RoomAdultChild=1";

        window.open ('//'+window.location.hostname+result_page+'/?params='+parameters,'_self');
    }
});

/* CAR SEARCH */
jQuery('#launch_car_query').click(function() {
    if(validateCarSearch()) {

        var airport1;
        var airport2;

        if(jQuery("#PickUp").val() != "" ) {
            airport1 = jQuery("#PickUp").val().split("| ");
            airport1 = airport1[1].trim()+"%3BA"; 
            
        }else {
            airport1 = "BEG%3BA";
        }

        if(jQuery("#DropOff").val() != "" && jQuery("#DropOff").val().indexOf("|") > 0) {
            airport2 = jQuery("#DropOff").val().split("| ");
            airport2 = airport2[1].trim()+"%3BA";    
        } else {
            airport2 = airport1;
        }

        var additional = "";

        if(document.URL.indexOf("/sr/") != -1) {
            additional = "&Culture=sr-Latn-CS";
        } else {
            additional = "&Culture=en-GB";
        }

        var parameters = "Method=CarSearch&Page=CarSearchResult&PickupLocationType=A&PickUpLocation="+airport1+"&PickUpDate="+jQuery("#PickUpDate").val()+"&PickUpTime="+jQuery("#PickUpTime").val()+"&DropOffDate="+jQuery("#DropOffDate").val()+"&DropOffTime="+jQuery("#DropOffTime").val()+"&DropOffLocation="+airport2+additional;

        //#Culture=sr-Latn-CS&DropOffDate=25/10/2014&DropOffLocation=BEG%3BA&DropOffTime=09%3A00&HasAirCondition=&Method=CarSearch&MileageChargeType=&Page=CarSearchResult&PickUpDate=24/10/2014&PickUpLocation=BEG%3BA&PickUpTime=09%3A00&PickupLocationType=A&TransmissionType=&VehicleClassType=&VehicleType=

        window.open ('//'+window.location.hostname+result_page+'/?params='+parameters,'_self');
    }
});

/* FLIGHT+HOTEL SEARCH */
jQuery('#launch_flight_hotel_query').click(function() {
    if(validateFlightHotelSearch()) {
        
        var query_str="";
      
        var Qfrom = "&QFrom=C";
       
        var Qto = "&QTo=C";
        var From;
        var To;
        var City;

        if(jQuery("#FromFH").val() != "" && jQuery("#ToFH").val() != "") {
            From = jQuery("#FromFH").val().split("| ");
            From = From[1].trim(); 
            To = jQuery("#ToFH").val().split("| ");
            To = To[1].trim();
            City = To;
            if(jQuery("#FromFH").val().indexOf(", Airport") != -1) {
                Qfrom = "&QFrom=A";
            }

            if(jQuery("#ToFH").val().indexOf(", Airport") != -1) {
                Qto = "&QTo=A";
                City = City+"%3BA";
            }
        }else {
            From = "BEG";
            To = "LON";
            City = To;
        }

        var roomCount = jQuery('#NumRooms').val();
        var adtCountFH = jQuery('#AdtCount1').val();
        var chdCountFH = jQuery('#ChdCount1').val();

        if (roomCount == "2") {
            adtCountFH = parseInt(adtCountFH) + parseInt(jQuery('#AdtCount2').val());
            chdCountFH = parseInt(chdCountFH) + parseInt(jQuery('#ChdCount2').val());
        }
        if (roomCount == "3") {
            adtCountFH = parseInt(adtCountFH) + parseInt(jQuery('#AdtCount2').val()) + parseInt(jQuery('#AdtCount3').val());
            chdCountFH = parseInt(chdCountFH) + parseInt(jQuery('#ChdCount2').val()) + parseInt(jQuery('#ChdCount3').val());
        }

        var QfromQto = Qfrom+Qto;

        var additional = "";

        if(document.URL.indexOf("/sr/") != -1) {
            additional = "&Culture=sr-Latn-CS";
        } else {
            additional = "&Culture=en-GB";
        }

     
        var parameters = "ActiveTab=PackageFlightResult&CabinClass=Y&CheckInDate="+jQuery("#DepartureDateFH").val()+"&CheckOutDate="+jQuery("#ReturnDateFH").val()+"&CityCode="+City+"&From="+From+"&To="+To+"&DepartureDate="+jQuery("#DepartureDateFH").val()+"&ReturnDate="+jQuery("#ReturnDateFH").val()+"&AdtCount="+adtCountFH+"&ChdCount="+chdCountFH+"&DepartureTime="+jQuery('#DepartureTime').val()+"&ReturnTime="+jQuery('#ReturnTime').val()+QfromQto+additional+"&RoomAdultChild="+jQuery('#NumRooms').val()+"&Method=PackageSearch&Page=Package";
       
        window.open ('//'+window.location.hostname+result_page+'/?params='+parameters,'_self');
     
    } else {
        return false;
    }

});

/* AUTOCOMPLETE */
var acdata = '//'+window.location.hostname+'/wp-content/themes/4dreamers/search_form/autocomplete_city-airport-country.php';
var airlinedata = '//'+window.location.hostname+'/wp-content/themes/4dreamers/search_form/autocomplete_airline.php';
var citydata = '//'+window.location.hostname+'/wp-content/themes/4dreamers/search_form/autocomplete_city.php';
var airdata = '//'+window.location.hostname+'/wp-content/themes/4dreamers/search_form/autocomplete_city-airport.php';

jQuery(function() {
	
    jQuery("#From").autocomplete({
        source: acdata,
        minLength: 2,
        /*select: function(event, ui) {
            var url = ui.item.id;
            if(url != '#') {
                location.href = '/blog/' + url;
            }
        },*/
        html: true, // optional (jquery.ui.autocomplete.html.js required)
      // optional (if other layers overlap autocomplete list)
        open: function(event, ui) {
            jQuery(".ui-autocomplete").css("z-index", 1000);
        }
    });

    jQuery("#To").autocomplete({
        source: acdata,
        minLength: 2,
        html: true, // optional (jquery.ui.autocomplete.html.js required)
      // optional (if other layers overlap autocomplete list)
        open: function(event, ui) {
            jQuery(".ui-autocomplete").css("z-index", 1000);
        }
    });

    /* Multileg */
    jQuery("#From1").autocomplete({
        source: acdata,
        minLength: 2, 
        html: true, // optional (jquery.ui.autocomplete.html.js required)
      // optional (if other layers overlap autocomplete list)
        open: function(event, ui) {
            jQuery(".ui-autocomplete").css("z-index", 1000);
        }
    });
    jQuery("#To1").autocomplete({
        source: acdata,
        minLength: 2,
        html: true, // optional (jquery.ui.autocomplete.html.js required)
      // optional (if other layers overlap autocomplete list)
        open: function(event, ui) {
            jQuery(".ui-autocomplete").css("z-index", 1000);
        }
    }); 
    jQuery("#From2").autocomplete({
        source: acdata,
        minLength: 2, 
        html: true, // optional (jquery.ui.autocomplete.html.js required)
      // optional (if other layers overlap autocomplete list)
        open: function(event, ui) {
            jQuery(".ui-autocomplete").css("z-index", 1000);
        }
    });
    jQuery("#To2").autocomplete({
        source: acdata,
        minLength: 2,
        html: true, // optional (jquery.ui.autocomplete.html.js required)
      // optional (if other layers overlap autocomplete list)
        open: function(event, ui) {
            jQuery(".ui-autocomplete").css("z-index", 1000);
        }
    });
    jQuery("#From3").autocomplete({
        source: acdata,
        minLength: 2, 
        html: true, // optional (jquery.ui.autocomplete.html.js required)
      // optional (if other layers overlap autocomplete list)
        open: function(event, ui) {
            jQuery(".ui-autocomplete").css("z-index", 1000);
        }
    });
    jQuery("#To3").autocomplete({
        source: acdata,
        minLength: 2,
        html: true, // optional (jquery.ui.autocomplete.html.js required)
      // optional (if other layers overlap autocomplete list)
        open: function(event, ui) {
            jQuery(".ui-autocomplete").css("z-index", 1000);
        }
    });

    /* Airline */
    jQuery("#airline0").autocomplete({
        source: airlinedata,
        minLength: 2,
        html: true, // optional (jquery.ui.autocomplete.html.js required)
      // optional (if other layers overlap autocomplete list)
        open: function(event, ui) {
            jQuery(".ui-autocomplete").css("z-index", 1000);
        }
    });

    /* Hotel */
    jQuery("#Destination").autocomplete({
        source: citydata,
        minLength: 2,
        html: true, // optional (jquery.ui.autocomplete.html.js required)
      // optional (if other layers overlap autocomplete list)
        open: function(event, ui) {
            jQuery(".ui-autocomplete").css("z-index", 1000);
        }
    });

    /* Car */
    jQuery("#PickUp").autocomplete({
        source: airdata,
        minLength: 2,
        html: true, // optional (jquery.ui.autocomplete.html.js required)
      // optional (if other layers overlap autocomplete list)
        open: function(event, ui) {
            jQuery(".ui-autocomplete").css("z-index", 1000);
        }
    });

    jQuery("#DropOff").autocomplete({
        source: airdata,
        minLength: 2,
        html: true, // optional (jquery.ui.autocomplete.html.js required)
      // optional (if other layers overlap autocomplete list)
        open: function(event, ui) {
            jQuery(".ui-autocomplete").css("z-index", 1000);
        }
    });

    jQuery("#FromFH").autocomplete({
        source: acdata,
        minLength: 2,
        html: true, // optional (jquery.ui.autocomplete.html.js required)
      // optional (if other layers overlap autocomplete list)
        open: function(event, ui) {
            jQuery(".ui-autocomplete").css("z-index", 1000);
        }
    });

    jQuery("#ToFH").autocomplete({
        source: acdata,
        minLength: 2,
        html: true, // optional (jquery.ui.autocomplete.html.js required)
      // optional (if other layers overlap autocomplete list)
        open: function(event, ui) {
            jQuery(".ui-autocomplete").css("z-index", 1000);
        }
    });
 
});

/* VALIDACIJA */    
    
    var gresponseFlight = "";
    var gresponseMulti = "";
    var gresponseHotel = "";
    var gresponseCar = "";
    var gresponseFlightHotel = "";
  

    var onloadCallbackFlight = function() {

        gresponseFlight = grecaptcha.render('g-recaptcha-flight', {
        'sitekey' : '6LcLcP8SAAAAAIdh3D-d2_kcHm7xWZ-i31V8M47S',
        'theme' : 'dark',
        'callback' : verifyCallbackFlight,
      }); 

        gresponseMulti = grecaptcha.render('g-recaptcha-multi', {
        'sitekey' : '6LcLcP8SAAAAAIdh3D-d2_kcHm7xWZ-i31V8M47S',
        'theme' : 'dark',
        'callback' : verifyCallbackMulti
      }); 

    };

    var onloadCallbackHotel = function() {

        gresponseHotel = grecaptcha.render('g-recaptcha-hotel', {
        'sitekey' : '6LcLcP8SAAAAAIdh3D-d2_kcHm7xWZ-i31V8M47S',
        'theme' : 'dark',
        'callback' : verifyCallbackHotel
      }); 

    };

    var onloadCallback = function() {

        gresponseFlight = grecaptcha.render('g-recaptcha-flight', {
        'sitekey' : '6LcLcP8SAAAAAIdh3D-d2_kcHm7xWZ-i31V8M47S',
        'theme' : 'dark',
        'callback' : verifyCallbackFlight,
      }); 

        gresponseMulti = grecaptcha.render('g-recaptcha-multi', {
        'sitekey' : '6LcLcP8SAAAAAIdh3D-d2_kcHm7xWZ-i31V8M47S',
        'theme' : 'dark',
        'callback' : verifyCallbackMulti
      }); 

        gresponseCar = grecaptcha.render('g-recaptcha-car', {
        'sitekey' : '6LcLcP8SAAAAAIdh3D-d2_kcHm7xWZ-i31V8M47S',
        'theme' : 'dark',
        'callback' : verifyCallbackCar
      });

        gresponseFlightHotel = grecaptcha.render('g-recaptcha-flight-hotel', {
        'sitekey' : '6LcLcP8SAAAAAIdh3D-d2_kcHm7xWZ-i31V8M47S',
        'theme' : 'dark',
        'callback' : verifyCallbackFlightHotel
      }); 

        gresponseHotel = grecaptcha.render('g-recaptcha-hotel', {
        'sitekey' : '6LcLcP8SAAAAAIdh3D-d2_kcHm7xWZ-i31V8M47S',
        'theme' : 'dark',
        'callback' : verifyCallbackHotel
      }); 
    };


    var verifyCallbackFlight = function(response) {
        //gresponseFlight = response;
        //setTimeout(function() {gresponseFlight = ""; console.log(gresponseFlight);}, 1000);
    };

    var verifyCallbackMulti = function(response) {
        //gresponseMulti = response;
       // setTimeout(function() {gresponseMulti = "";}, 1000);
    };

    var verifyCallbackHotel = function(response) {
        //gresponseHotel = response;
    };

    var verifyCallbackCar = function(response) {
        //gresponseCar = response;
    };

    var verifyCallbackCar = function(response) {
        //gresponseCar = response;
    };

    var verifyCallbackFlightHotel = function(response) {
        //gresponseFlightHotel = response;
    };



function validateFlightSearch() {

    var formFlightSearch = document.flight_search;
    var valid = true;

    if (formFlightSearch.From.value == ""){
        jQuery('.not_valid_from').show('fast');
        
        valid = false;
    }

    if(formFlightSearch.To.value == "") {
        jQuery('.not_valid_to').show('fast');
       
        valid = false;
    }

    /*if(grecaptcha.getResponse(gresponseFlight) == "" || grecaptcha.getResponse(gresponseFlight).lenght < 25) {
        jQuery('.not_valid_captcha').show('fast');
        valid = false;
    }*/

    return valid;
}

function validateFlightMultilegSearch() {

    var formFlightSearch = document.flight_search_multileg;
    var valid = true;

    if (formFlightSearch.From1.value == ""){
        jQuery('.not_valid_from1').show('fast');
        
        valid = false;
    }

    if(formFlightSearch.To1.value == "") {
        jQuery('.not_valid_to1').show('fast');
       
        valid = false;
    }

    if (formFlightSearch.From2.value == ""){
        jQuery('.not_valid_from2').show('fast');
        
        valid = false;
    }

    if(formFlightSearch.To2.value == "") {
        jQuery('.not_valid_to2').show('fast');
       
        valid = false;
    }

    if(formFlightSearch.From3.value != "" || formFlightSearch.To3.value != "") {
        if (formFlightSearch.From3.value == ""){
            jQuery('.not_valid_from3').show('fast');
            
            valid = false;
        }

        if(formFlightSearch.To3.value == "") {
            jQuery('.not_valid_to3').show('fast');
           
            valid = false;
        }
    }

    /*if(grecaptcha.getResponse(gresponseMulti) == "" || grecaptcha.getResponse(gresponseMulti).lenght < 25) {
        jQuery('.not_valid_captcha').show('fast');
        valid = false;
    }*/

    return valid;
}

function validateHotelSearch() {

    var formHotelSearch = document.hotel_search;
    var valid = true;

    if(formHotelSearch.Destination.value == "") {
        jQuery('.not_valid_dest').show('fast');    
        valid = false;
    }

    /*if(grecaptcha.getResponse(gresponseHotel) == "" || grecaptcha.getResponse(gresponseHotel).lenght < 25) {
        jQuery('.not_valid_captcha').show('fast');
        valid = false;
    }*/

    return valid;
}

function validateCarSearch() {

    var formCarSearch = document.car_search;
    var valid = true;

    if(formCarSearch.PickUp.value == "") {
        jQuery('.not_valid_pickup').show('fast');  
        valid = false;
    }

    /*if(grecaptcha.getResponse(gresponseCar) == "" || grecaptcha.getResponse(gresponseCar).lenght < 25) {
        jQuery('.not_valid_captcha').show('fast');
        valid = false;
    }*/

    return valid;
}

function validateFlightHotelSearch() {

    var formFlightHotelSearch = document.flight_hotel_search;
    var valid = true;

    if (formFlightHotelSearch.FromFH.value == ""){
        jQuery('.not_valid_fromFH').show('fast');
        
        valid = false;
    }

    if(formFlightHotelSearch.ToFH.value == "") {
        jQuery('.not_valid_toFH').show('fast');
       
        valid = false;
    }

   /* if(grecaptcha.getResponse(gresponseFlightHotel) == "" || grecaptcha.getResponse(gresponseFlightHotel).lenght < 25) {
        jQuery('.not_valid_captcha').show('fast');
        valid = false;
    }*/

    return valid;
}

/* RESET */

jQuery('#flight_search_multileg .resetBtn').click(function(event) {
    resetForm("flight_search_multileg");
});

jQuery('#flight_search .resetBtn').click(function(event) {
    resetForm("flight_search");
});

function resetForm(forma) {
    document.getElementById(forma).reset();
}

/* SELEKTORI */

jQuery(function() {

    jQuery("input[type='text']").click(function () {
        jQuery(this).select();
    });

    jQuery("#DepartureDate").datepicker({
        dateFormat: 'dd/mm/yy',
        numberOfMonths: 2,
        showButtonPanel: true,
        minDate: "+1d",
        onClose: function( selectedDate ) {
            jQuery( "#ReturnDate" ).datepicker( "option", "minDate", selectedDate );
        }
    });
    jQuery("#ReturnDate").datepicker({
        dateFormat: 'dd/mm/yy',
        numberOfMonths: 2,
        showButtonPanel: true,
        minDate: "+1d",
        onClose: function( selectedDate ) {
            jQuery( "#DepartureDate" ).datepicker( "option", "maxDate", selectedDate );
        }
    });

    jQuery("#DepartureDate1").datepicker({
        dateFormat: 'dd/mm/yy',
        numberOfMonths: 2,
        showButtonPanel: true,
        minDate: "+1d",
        onClose: function( selectedDate ) {
            jQuery( "#DepartureDate2" ).datepicker( "option", "minDate", selectedDate );
        }
    });
    jQuery("#DepartureDate2").datepicker({
        dateFormat: 'dd/mm/yy',
        numberOfMonths: 2,
        showButtonPanel: true,
        minDate: "+1d",
        onClose: function( selectedDate ) {
            jQuery( "#DepartureDate3" ).datepicker( "option", "minDate", selectedDate );
        }
    });
    jQuery("#DepartureDate3").datepicker({
        dateFormat: 'dd/mm/yy',
        numberOfMonths: 2,
        showButtonPanel: true,
        minDate: "+1d",
        onClose: function( selectedDate ) {
            jQuery( "#DepartureDate1" ).datepicker( "option", "maxDate", selectedDate );
            jQuery( "#DepartureDate2" ).datepicker( "option", "maxDate", selectedDate );
        }
    });

    jQuery("#DepartureDateFH").datepicker({
        dateFormat: 'dd/mm/yy',
        numberOfMonths: 2,
        showButtonPanel: true,
        minDate: "+1d",
        onClose: function( selectedDate ) {
            jQuery( "#ReturnDateFH" ).datepicker( "option", "minDate", selectedDate );
        }
    });
    jQuery("#ReturnDateFH").datepicker({
        dateFormat: 'dd/mm/yy',
        numberOfMonths: 2,
        showButtonPanel: true,
        minDate: "+1d",
        onClose: function( selectedDate ) {
            jQuery( "#DepartureDateFH" ).datepicker( "option", "maxDate", selectedDate );
        }
    });

    jQuery("#CheckIn").datepicker({
        dateFormat: 'dd/mm/yy',
        numberOfMonths: 2,
        showButtonPanel: true,
        minDate: "+1d",
        onClose: function( selectedDate ) {
            jQuery( "#CheckOut" ).datepicker( "option", "minDate", selectedDate );
        }
    });
    jQuery("#CheckOut").datepicker({
        dateFormat: 'dd/mm/yy',
        numberOfMonths: 2,
        showButtonPanel: true,
        minDate: "+1d",
        onClose: function( selectedDate ) {
            jQuery( "#CheckIn" ).datepicker( "option", "maxDate", selectedDate );
        }
    });
    jQuery("#PickUpDate").datepicker({
        dateFormat: 'dd/mm/yy',
        numberOfMonths: 2,
        showButtonPanel: true,
        minDate: "+2d"
    });
    jQuery("#DropOffDate").datepicker({
        dateFormat: 'dd/mm/yy',
        numberOfMonths: 2,
        showButtonPanel: true,
        minDate: "+2d"
    });

    jQuery('#show-advanced-flight').click(function(event) {
        jQuery('#advanced-flight').slideToggle('fast');
        jQuery('#show-advanced-flight').addClass('toggle');
        jQuery('#show-advanced-flight .fa.fa-angle-double-right').toggleClass('fa-angle-double-down');
    });

    jQuery('#flight_search input:radio[name=FlightType]').click(function(event) {
        if (jQuery(this).val() == "OneWay") {
            jQuery("#ReturnDate").prop('disabled', true).addClass('disabled');
            jQuery("#ReturnTime").prop('disabled', true).addClass('disabled');
        }
        else if(jQuery(this).val() == "RoundTrip"){
            jQuery("#ReturnDate").prop('disabled', false).removeClass('disabled');
            jQuery("#ReturnTime").prop('disabled', false).removeClass('disabled');
        }else{
            jQuery('#flight_search_multileg input:radio[value=Multileg]').prop("checked", true);
            jQuery('#flight_search').hide('fast');
            jQuery('#flight_search_multileg').show('fast');
        }  
    });

    jQuery('#flight_search_multileg input:radio[name=FlightType]').click(function(event) {
        if (jQuery(this).val() == "OneWay") {
            jQuery('#flight_search').show('fast');
            jQuery('#flight_search_multileg').hide('fast');
            jQuery("#ReturnDate").prop('disabled', true).addClass('disabled');
            jQuery("#ReturnTime").prop('disabled', true).addClass('disabled');
            jQuery('#flight_search input:radio[value=OneWay]').prop("checked", true);
        }
        else if(jQuery(this).val() == "RoundTrip"){
            jQuery('#flight_search').show('fast');
            jQuery('#flight_search_multileg').hide('fast');
            jQuery("#ReturnDate").prop('disabled', false).removeClass('disabled');
            jQuery("#ReturnTime").prop('disabled', false).removeClass('disabled');
            jQuery('#flight_search input:radio[value=RoundTrip]').prop("checked", true);
        }else{
            jQuery('#flight_search').hide('fast');
            jQuery('#flight_search_multileg').show('fast');
        }  
    });

    /* hide red msg*/

    jQuery('.form-holder input').click(function(event) {
        jQuery('.not_valid_captcha').hide('fast');
        jQuery('.not_valid_to').hide('fast');
        jQuery('.not_valid_to1').hide('fast');
        jQuery('.not_valid_to2').hide('fast');
        jQuery('.not_valid_to3').hide('fast');
        jQuery('.not_valid_from').hide('fast');
        jQuery('.not_valid_from1').hide('fast');
        jQuery('.not_valid_from2').hide('fast');
        jQuery('.not_valid_from3').hide('fast');
        jQuery('.not_valid_dest').hide('fast');
        jQuery('.not_valid_pickup').hide('fast');
        jQuery('.not_valid_toFH').hide('fast');
        jQuery('.not_valid_fromFH').hide('fast');
    });

    jQuery('.button-holder', '').click(function(event) {
        jQuery('.not_valid_captcha').hide('fast');
        jQuery('.not_valid_to').hide('fast');
        jQuery('.not_valid_to1').hide('fast');
        jQuery('.not_valid_to2').hide('fast');
        jQuery('.not_valid_to3').hide('fast');
        jQuery('.not_valid_from').hide('fast');
        jQuery('.not_valid_from1').hide('fast');
        jQuery('.not_valid_from2').hide('fast');
        jQuery('.not_valid_from3').hide('fast');
        jQuery('.not_valid_dest').hide('fast');
        jQuery('.not_valid_pickup').hide('fast');
        jQuery('.not_valid_toFH').hide('fast');
        jQuery('.not_valid_fromFH').hide('fast');
    });


    jQuery('#flight-toggle').click(function(event) {
        jQuery('#flight_search').show('fast');
        jQuery('#hotel_search').hide('fast');
        jQuery('#car_search').hide('fast');
        jQuery('#flight_hotel_search').hide('fast');
        jQuery('#flight_search_multileg').hide('fast');


        jQuery('#flight-toggle').addClass('active');
        jQuery('#hotel-toggle').removeClass('active');
        jQuery('#car-toggle').removeClass('active');
        jQuery('#flight_hotel-toggle').removeClass('active');
        jQuery('#flight_search input:radio[value=RoundTrip]').prop("checked", true);

    });

    jQuery('#hotel-toggle').click(function(event) {
        jQuery('#flight_search').hide('fast');
        jQuery('#hotel_search').show('fast');
        jQuery('#car_search').hide('fast');
        jQuery('#flight_hotel_search').hide('fast');
        jQuery('#flight_search_multileg').hide('fast');
        
        jQuery('#flight-toggle').removeClass('active');
        jQuery('#hotel-toggle').addClass('active');
        jQuery('#car-toggle').removeClass('active');
        jQuery('#flight_hotel-toggle').removeClass('active');

    });

    jQuery('#car-toggle').click(function(event) {
        jQuery('#flight_search').hide('fast');
        jQuery('#hotel_search').hide('fast');        
        jQuery('#car_search').show('fast');
        jQuery('#flight_hotel_search').hide('fast');
        jQuery('#flight_search_multileg').hide('fast');
        
        jQuery('#flight-toggle').removeClass('active');
        jQuery('#hotel-toggle').removeClass('active');
        jQuery('#car-toggle').addClass('active');
        jQuery('#flight_hotel-toggle').removeClass('active');

    });

    jQuery('#flight_hotel-toggle').click(function(event) {
        jQuery('#flight_search').hide('fast');
        jQuery('#hotel_search').hide('fast');
        jQuery('#car_search').hide('fast');
        jQuery('#flight_hotel_search').show('fast');
        jQuery('#flight_search_multileg').hide('fast');
        
        jQuery('#flight-toggle').removeClass('active');
        jQuery('#hotel-toggle').removeClass('active');
        jQuery('#car-toggle').removeClass('active');
        jQuery('#flight_hotel-toggle').addClass('active');
    });

    jQuery('.unselectable').on('selectstart dragstart', function(evt){ evt.preventDefault(); return false; });

    jQuery('.ui-autocomplete-input').keydown(function(e){
        
        if(jQuery('.unselectable').hasClass('ui-state-focus')) {
            jQuery('.unselectable').blur();
            jQuery('.unselectable').removeClass('ui-state-focus')
            e.stopPropagation();
            e.preventDefault();
        }
    });
    
    /* Adult Child Infant */ 
    jQuery('#AdtCount').on('change', function (e) {
        var AdtCount = this.value;
        switch (AdtCount) {
            case "0":
                jQuery('#ChdCount option:gt(0)').remove();
                jQuery('#InfCount option:gt(0)').remove();
            break;

            case "6":
                jQuery('#ChdCount option:gt(0)').remove();
                jQuery('#InfCount option:gt(0)').remove();
                for (var i = 1; i <= (9-parseInt(AdtCount)); i++) {
                    jQuery('#ChdCount').append(jQuery("<option></option>").text(i));
                };
                for (var i = 1; i <= parseInt(AdtCount); i++) {
                    jQuery('#InfCount').append(jQuery("<option></option>").text(i));
                };
            break;

            case "7":
                jQuery('#ChdCount option:gt(0)').remove();
                jQuery('#InfCount option:gt(0)').remove();
                for (var i = 1; i <= (9-parseInt(AdtCount)); i++) {
                    jQuery('#ChdCount').append(jQuery("<option></option>").text(i));
                };
                for (var i = 1; i <= parseInt(AdtCount)-1; i++) {
                    jQuery('#InfCount').append(jQuery("<option></option>").text(i));
                };
            break;

            case "8":
                jQuery('#ChdCount option:gt(0)').remove();
                jQuery('#InfCount option:gt(0)').remove();
                for (var i = 1; i <= (9-parseInt(AdtCount)); i++) {
                    jQuery('#ChdCount').append(jQuery("<option></option>").text(i));
                };
                for (var i = 1; i <= parseInt(AdtCount)-2; i++) {
                    jQuery('#InfCount').append(jQuery("<option></option>").text(i));
                };
            break;

            default:
                jQuery('#ChdCount option:gt(0)').remove();
                jQuery('#InfCount option:gt(0)').remove();
                for (var i = 1; i <= 4; i++) {
                    jQuery('#ChdCount').append(jQuery("<option></option>").text(i));
                };
                for (var i = 1; i <= parseInt(AdtCount); i++) {
                    jQuery('#InfCount').append(jQuery("<option></option>").text(i));
                };
            break;
        }
       
    });

    jQuery('#AdtCountM').on('change', function (e) {
        var AdtCount = this.value;
        switch (AdtCount) {
            case "0":
                jQuery('#ChdCountM option:gt(0)').remove();
                jQuery('#InfCountM option:gt(0)').remove();
            break;

            case "6":
                jQuery('#ChdCountM option:gt(0)').remove();
                jQuery('#InfCountM option:gt(0)').remove();
                for (var i = 1; i <= (9-parseInt(AdtCount)); i++) {
                    jQuery('#ChdCountM').append(jQuery("<option></option>").text(i));
                };
                for (var i = 1; i <= parseInt(AdtCount); i++) {
                    jQuery('#InfCountM').append(jQuery("<option></option>").text(i));
                };
            break;

            case "7":
                jQuery('#ChdCountM option:gt(0)').remove();
                jQuery('#InfCountM option:gt(0)').remove();
                for (var i = 1; i <= (9-parseInt(AdtCount)); i++) {
                    jQuery('#ChdCountM').append(jQuery("<option></option>").text(i));
                };
                for (var i = 1; i <= parseInt(AdtCount)-1; i++) {
                    jQuery('#InfCountM').append(jQuery("<option></option>").text(i));
                };
            break;

            case "8":
                jQuery('#ChdCountM option:gt(0)').remove();
                jQuery('#InfCountM option:gt(0)').remove();
                for (var i = 1; i <= (9-parseInt(AdtCount)); i++) {
                    jQuery('#ChdCountM').append(jQuery("<option></option>").text(i));
                };
                for (var i = 1; i <= parseInt(AdtCount)-2; i++) {
                    jQuery('#InfCountM').append(jQuery("<option></option>").text(i));
                };
            break;

            default:
                jQuery('#ChdCountM option:gt(0)').remove();
                jQuery('#InfCountM option:gt(0)').remove();
                for (var i = 1; i <= 4; i++) {
                    jQuery('#ChdCountM').append(jQuery("<option></option>").text(i));
                };
                for (var i = 1; i <= parseInt(AdtCount); i++) {
                    jQuery('#InfCountM').append(jQuery("<option></option>").text(i));
                };
            break;
        }
       
    });

    jQuery('#NumRooms').on('change', function (e) {
        
        var numRooms = this.value;

        if (numRooms == "1") {
            jQuery('.room2').hide('fast');
            jQuery('.room3').hide('fast');
        }

        if (numRooms == "2") {
            jQuery('.room2').show('fast');
            jQuery('.room3').hide('fast');
        }

        if (numRooms == "3") {
            jQuery('.room2').show('fast');
            jQuery('.room3').show('fast');
        }

    });

    jQuery('#AdtCount1').on('change', function (e) {
        var AdtCount1 = this.value;
        switch (AdtCount1) {
            case "0":
                jQuery('#ChdCount1 option:gt(0)').remove();        
            break;

            case "6":
                jQuery('#ChdCount1 option:gt(0)').remove();
                for (var i = 1; i <= (9-parseInt(AdtCount1)); i++) {
                    jQuery('#ChdCount1').append(jQuery("<option></option>").text(i));
                };
            break;

            case "7":
                jQuery('#ChdCount1 option:gt(0)').remove();
                for (var i = 1; i <= (9-parseInt(AdtCount1)); i++) {
                    jQuery('#ChdCount1').append(jQuery("<option></option>").text(i));
                };
            break;

            case "8":
                jQuery('#ChdCount1 option:gt(0)').remove();
                for (var i = 1; i <= (9-parseInt(AdtCount1)); i++) {
                    jQuery('#ChdCount1').append(jQuery("<option></option>").text(i));
                };
            break;

            default:
                jQuery('#ChdCount1 option:gt(0)').remove();
                for (var i = 1; i <= 4; i++) {
                    jQuery('#ChdCount1').append(jQuery("<option></option>").text(i));
                };
            break;
        }
    });   

    jQuery('#AdtCount2').on('change', function (e) {
        var AdtCount2 = this.value;
        switch (AdtCount2) {
            case "0":
                jQuery('#ChdCount2 option:gt(0)').remove();        
            break;

            case "6":
                jQuery('#ChdCount2 option:gt(0)').remove();
                for (var i = 1; i <= (9-parseInt(AdtCount2)); i++) {
                    jQuery('#ChdCount2').append(jQuery("<option></option>").text(i));
                };
            break;

            case "7":
                jQuery('#ChdCount2 option:gt(0)').remove();
                for (var i = 1; i <= (9-parseInt(AdtCount2)); i++) {
                    jQuery('#ChdCount2').append(jQuery("<option></option>").text(i));
                };
            break;

            case "8":
                jQuery('#ChdCount2 option:gt(0)').remove();
                for (var i = 1; i <= (9-parseInt(AdtCount2)); i++) {
                    jQuery('#ChdCount2').append(jQuery("<option></option>").text(i));
                };
            break;

            default:
                jQuery('#ChdCount2 option:gt(0)').remove();
                for (var i = 1; i <= 4; i++) {
                    jQuery('#ChdCount2').append(jQuery("<option></option>").text(i));
                };
            break;
        }
    });   

    jQuery('#AdtCount3').on('change', function (e) {
        var AdtCount3 = this.value;
        switch (AdtCount3) {
            case "0":
                jQuery('#ChdCount3 option:gt(0)').remove();        
            break;

            case "6":
                jQuery('#ChdCount3 option:gt(0)').remove();
                for (var i = 1; i <= (9-parseInt(AdtCount3)); i++) {
                    jQuery('#ChdCount3').append(jQuery("<option></option>").text(i));
                };
            break;

            case "7":
                jQuery('#ChdCount3 option:gt(0)').remove();
                for (var i = 1; i <= (9-parseInt(AdtCount3)); i++) {
                    jQuery('#ChdCount3').append(jQuery("<option></option>").text(i));
                };
            break;

            case "8":
                jQuery('#ChdCount3 option:gt(0)').remove();
                for (var i = 1; i <= (9-parseInt(AdtCount3)); i++) {
                    jQuery('#ChdCount3').append(jQuery("<option></option>").text(i));
                };
            break;

            default:
                jQuery('#ChdCount3 option:gt(0)').remove();
                for (var i = 1; i <= 4; i++) {
                    jQuery('#ChdCount3').append(jQuery("<option></option>").text(i));
                };
            break;
        }
    });   
});
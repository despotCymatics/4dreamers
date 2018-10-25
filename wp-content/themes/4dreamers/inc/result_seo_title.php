<?php 

require_once "model.php";

function get_seo_title_for_results() {
	if (isset($_GET['From']) && isset($_GET['To']) && isset($_GET['DepartureDate'])) { // pretraga letova

		$from = get_city_name($_GET['From']);
		$to = get_city_name($_GET['To']);
		$date = $_GET['DepartureDate'];
		if(get_bloginfo('language') == "sr-RS") {
			$return = "Letovi, ".$from. " - ". $to. " datum ". $date. " | ";
		}else {
			$return = "Flights from ".$from. " to ". $to. " on ". $date. " | ";
		}
		
		return $return;

	}else if (isset($_GET['CityCode']) && isset($_GET['CheckInDate']) && isset($_GET['CheckOutDate'])) { // pretraga hotela
		
		$city = get_city_name($_GET['CityCode']);
		
		$dateIn = $_GET['CheckInDate'];
		$dateOut = $_GET['CheckOutDate'];

		if(get_bloginfo('language') == "sr-RS") {
			$return = "Hoteli, ".$city." od ". $dateIn. " do ".$dateOut." | ";
		}else {
			$return = "Hotels in ".$city." from ". $dateIn. " to ".$dateOut." | ";
		}

		return $return;


	}else if (isset($_GET['PickUpLocation']) && isset($_GET['PickUpDate']) && isset($_GET['DropOffDate'])) { // pretraga hotela
		
		$city = get_city_name(str_replace(";A", "", $_GET['PickUpLocation'])); //skiadam ;A
		
		$dateIn = $_GET['PickUpDate'];
		$dateOut = $_GET['DropOffDate'];

		if(get_bloginfo('language') == "sr-RS") {
			$return = "Iznajmite Automobil ".$city." od ". $dateIn. " do ".$dateOut." | ";
		}else {
			$return = "Rent A Car in ".$city." from ". $dateIn. " to ".$dateOut." | ";
		}

		return $return;


	}else {
		return "";
	}

}




?>
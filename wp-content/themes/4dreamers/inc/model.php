<?php
function cp_get_popular_cities($cityCode)
{
    global $wpdb;

    $rs = $wpdb->get_results( "SELECT * FROM city WHERE CountryCode IN ( SELECT CountryCode FROM city WHERE CityCode='".$cityCode."')"  );
    return $rs;
    
}

function get_airports_for_city($cityCode)
{
    global $wpdb;
    $rs = $wpdb->get_results( 'SELECT * FROM airport WHERE CityCode="'.$cityCode.'"' );
    return $rs;
}

function get_city_name($code)
{
  global $wpdb;
  $rs = $wpdb->get_var( 'SELECT CityName FROM city WHERE CityCode="'.$code.'"' );
  if($rs == NULL){
    $cc = $wpdb->get_var( 'SELECT CityCode FROM airport WHERE AirportCode="'.$code.'"' );
    $rs = $wpdb->get_var( 'SELECT CityName FROM city WHERE CityCode="'.$cc.'"' );
  }

  if($rs != NULL) {
    return $rs;
  }
}

function get_best_deals() {
  global $wpdb;
  //$rs = $wpdb->get_results( 'SELECT * FROM offers WHERE DepartureDate >= CURDATE() AND DTo != "BEG" ORDER BY DepartureDate LIMIT 50');
  //$rs = $wpdb->get_results( 'SELECT *, MIN(PriceInt) as MinPrice FROM offers WHERE DepartureDate >= DATE_ADD(CURRENT_DATE(), INTERVAL 30 DAY) AND DTo != "BEG" GROUP BY DTo');
  //$rs = $wpdb->get_results( 'SELECT * FROM offers inner join (   SELECT DTo, MIN(PriceInt) as MinPrice FROM offers WHERE DepartureDate >= DATE_ADD(CURRENT_DATE(), INTERVAL 30 DAY) AND DTo != "BEG" GROUP BY DTo) mintable on offers.DTo = mintable.DTo and offers.PriceInt = mintable.MinPrice group by offers.DTo');

	$rs = $wpdb->get_results( 'SELECT * FROM offers WHERE DepartureDate >= CURRENT_DATE() AND DTo != "BEG" GROUP BY DTo' );

	return $rs;
}

function getOfferForCity($code) {
  global $wpdb;
  $rs = $wpdb->get_row( 'SELECT * FROM offers WHERE DTo = "'.$code.'" AND DepartureDate >= CURRENT_DATE() ORDER BY priceInt ASC LIMIT 1');
  return $rs;
}

?>
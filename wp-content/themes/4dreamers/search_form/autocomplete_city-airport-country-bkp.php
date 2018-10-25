<?php
 
// prevent direct access - ako nije ajax
$isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND
strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
if(!$isAjax) {
  $user_error = 'Access denied - not an AJAX request...';
  trigger_error($user_error, E_USER_ERROR);
}
 
// termin
$term = trim($_GET['term']);
 
$a_json = array();
$a_json_row = array();
$a_json_row_a = array();
$airportRows = array();

$a_json_row2 = array();
$airportRows2 = array();
 
$a_json_invalid = array(array("id" => "#", "value" => $term, "label" => "Only letters and digits are permitted..."));
$json_invalid = json_encode($a_json_invalid);
 
// replace multiple spaces with one
$term = preg_replace('/\s+/', ' ', $term);
 
// SECURITY HOLE ***************************************************************
// allow space, any unicode letter and digit, underscore and dash
if(preg_match("/[^\040\pL\pN_-]/u", $term)) {
  print $json_invalid;
  exit;
}

// db
require($_SERVER["DOCUMENT_ROOT"].'/wp-content/themes/4dreamers/db.php');
 
if($con->connect_error) {
  echo 'Database connection failed...' . 'Error: ' . $con->connect_errno . ' ' . $con->connect_error;
  exit;
} else {
  $con->set_charset('utf8');
}
 
/*$parts = explode(' ', $term);
$p = count($parts);*/
 
//SQL za City
$sql = 'SELECT CityName, CityCode, CountryCode, Rate FROM city WHERE Valid = 1';
$sql .= ' AND CityName LIKE "' . $con->real_escape_string($term) . '%" OR CityCode LIKE "' . $con->real_escape_string($term) . '%"';

$sqlComb = 'SELECT a.CityName, a.CityCode, a.CountryCode, a.Rate, b.CountryName FROM ('.$sql.') as a,';
$sqlComb .='(SELECT * FROM country) as b WHERE a.CountryCode = b.Code '; // zemlja trazenog grada

//SQL za Airport in City
$sqlAir = 'SELECT b.AirportName, b.CityCode, b.AirportCode FROM ('.$sql.') as a,';
$sqlAir .='(SELECT * FROM airport) as b WHERE a.CityCode = b.CityCode '; // svi aerodromi za taj grad

//SQL za Country
$sql2 = 'SELECT CountryName, Code FROM country WHERE Valid = 1 ';
$sql2 .= ' AND CountryName LIKE "' . $con->real_escape_string($term) . '%"';

$sqlComb2 = 'SELECT a.CityName, a.CityCode, a.CountryCode, a.Rate, b.CountryName FROM (SELECT * FROM city) as a,';
$sqlComb2 .='('.$sql2.') as b WHERE a.CountryCode = b.Code ';

//SQL samo za Airport
$sqlAirportOnly = 'SELECT AirportName, AirportCode, CityCode FROM airport WHERE Valid = 1';
$sqlAirportOnly .= ' AND AirportName LIKE "' . $con->real_escape_string($term) . '%" OR AirportCode LIKE "' . $con->real_escape_string($term) . '%"';

$sqlComb3 = 'SELECT a.CityName, a.CityCode, a.CountryCode, a.Rate, b.CityCode, b.AirportName, b.AirportCode FROM (SELECT * FROM city) as a,';
$sqlComb3 .='('.$sqlAirportOnly.') as b WHERE a.CityCode = b.CityCode ORDER BY Rate DESC LIMIT 5';

//Union
$sqlFinal = $sqlComb.' UNION '.$sqlComb2. ' ORDER BY Rate DESC LIMIT 10';

//$rs = $con->query($sqlFinal);
$rs = mysqli_query($con,$sqlFinal);
if($rs === false) {
  $user_error = 'Wrong SQL: ' . $sqlFinal . 'Error: ' . $con->errno . ' ' . $con->error;
  trigger_error($user_error, E_USER_ERROR);
}

//$rsAir = $con->query($sqlAir);
$rsAir = mysqli_query($con,$sqlAir);
if($rsAir === false) {
  $user_error = 'Wrong SQL: ' . $sqlAir . 'Error: ' . $con->errno . ' ' . $con->error;
  trigger_error($user_error, E_USER_ERROR);
}else{
  while($airportRow = mysqli_fetch_array($rsAir,MYSQLI_ASSOC)) {
    array_push($airportRows, $airportRow);
  }
}

//JSON
while($row = mysqli_fetch_array($rs,MYSQLI_ASSOC)) {
  $a_json_row["cssClass"] = "CityRow";
  $a_json_row["value"] = $row['CityName'].' | '.$row['CityCode'].' | '.$row['CountryName'];
  $a_json_row["label"] = $row['CityName'].' | '.$row['CityCode'].' | '.$row['CountryName'];
  array_push($a_json, $a_json_row);

  if($airportRows){
    foreach ($airportRows as $row2) {
      if($row['CityCode'] == $row2['CityCode']) {
        $a_json_row_a["value"] = $row2['AirportName'].', Airport | '.$row2['AirportCode'].' | '.$row['CityName'];
        $a_json_row_a["label"] = '#'.$row2['AirportName'].' | '.$row2['AirportCode'].' | '.$row['CityName'];
        array_push($a_json, $a_json_row_a);
      }
    }
  }
}

$rsAirportOnly = mysqli_query($con,$sqlComb3);
if($rsAirportOnly === false) {
  $user_error = 'Wrong SQL: ' . $sqlComb3 . 'Error: ' . $con->errno . ' ' . $con->error;
  trigger_error($user_error, E_USER_ERROR);
}

while($airportRow2 = mysqli_fetch_array($rsAirportOnly,MYSQLI_ASSOC)) {
  array_push($airportRows2, $airportRow2);
} 

//var_dump($airportRows2);

//samo aerodromi
foreach ($airportRows2 as $ar) {
  $a_json_row_a["value"] = $ar['AirportName'].', Airport | '.$ar['AirportCode'].' | '.$ar['CityName'];
  $a_json_row_a["label"] = $ar['AirportName'].', Airport | '.$ar['AirportCode'].' | '.$ar['CityName'];

    array_push($a_json, $a_json_row_a); 
    
}

// highlight search results
$a_json = apply_highlight($a_json, $term);
 
$json = json_encode($a_json);
print $json;

/*echo "<pre>";
var_dump($a_json);
echo "</pre>";*/


function apply_highlight($a_json, $term) {
 

  $rows = count($a_json);
  
  for($row = 0; $row < $rows; $row++) {

    $label = $a_json[$row]["label"];

    $a_label_match = array();
 
    $part_len = mb_strlen($term);
    
    $a_match_start = mb_stripos_all($label, $term);
    
    if($a_match_start){
      //var_dump(strrpos($label, "#"));
      foreach($a_match_start as $part_pos) {
        
        $overlap = false;
        foreach($a_label_match as $pos => $len) {

          if($part_pos - $pos >= 0 && $part_pos - $pos < $len) {
            $overlap = true;
            break;
          }
        }
        if(!$overlap) {
          $a_label_match[$part_pos] = $part_len;
        }

      }
    }
    if(count($a_label_match) > 0) {
      ksort($a_label_match);
 
      $label_highlight = '';
      $start = 0;
      $label_len = mb_strlen($label);
 
      foreach($a_label_match as $pos => $len) {
        if($pos - $start > 0) {
          $no_highlight = mb_substr($label, $start, $pos - $start);
          $label_highlight .= $no_highlight;


        }
        $highlight = '<span class="hl_results">' . mb_substr($label, $pos, $len) . '</span>';
        $label_highlight .= $highlight;
        $start = $pos + $len;
      }
 
      if($label_len - $start > 0) {
        $no_highlight = mb_substr($label, $start);
        $label_highlight .= $no_highlight;
      }
      
     
      if(strpos($label, "#") !== false) {
          $a_json[$row]["label"] = '<span class="inside"><i class="fa fa-plane"></i> '.str_replace("#", "", $label_highlight).'</span>';
      }else {
        $a_json[$row]["label"] = '<i class="fa fa-bank"></i> '.$label_highlight;
      }

      if (strpos($label, ", Airport") !== false) {
        $a_json[$row]["label"] = '<i class="fa fa-plane"></i> '.str_replace("#", "", $label_highlight);
      }

     
    }else {
      if(strpos($label, "#") !== false) {
          $a_json[$row]["label"] = '<span class="inside"><i class="fa fa-plane"></i> '.str_replace("#", "", $label).'</span>';
      }else {
        $a_json[$row]["label"] = '<i class="fa fa-bank"></i> '.$label;
      }

      if (strpos($label, ", Airport") !== false) {
        $a_json[$row]["label"] = '<i class="fa fa-plane"></i> '.str_replace("#", "", $label);
      }
    }
   
  }
 
  return $a_json;
 
}

function mb_stripos_all($haystack, $needle) {
 
  $s = 0;
  $i = 0;
 
  while(is_integer($i)) {
 
    $i = mb_stripos($haystack, $needle, $s);
 
    if(is_integer($i)) {
      $aStrPos[] = $i;
      $s = $i + mb_strlen($needle);
    }
  }
 
  if(isset($aStrPos)) {
    return $aStrPos;
  } else {
    return false;
  }
}



?>
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
$airportRows = array();
 
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
 
//SQL za Airline
$sql = 'SELECT AirlineName, AirlineCode FROM airline WHERE Valid = 1';
$sql .= ' AND AirlineName LIKE "' . $con->real_escape_string($term) . '%"';

$rs = mysqli_query($con,$sql);
if($rs === false) {
  $user_error = 'Wrong SQL: ' . $sql . 'Error: ' . $con->errno . ' ' . $con->error;
  trigger_error($user_error, E_USER_ERROR);
}

//JSON
while($row = mysqli_fetch_array($rs,MYSQLI_ASSOC)) {
  $a_json_row["value"] = $row['AirlineName'].' | '.$row['AirlineCode'];
  $a_json_row["label"] = $row['AirlineName'].' | '.$row['AirlineCode'];
  array_push($a_json, $a_json_row);

}
 
// highlight search results
$a_json = apply_highlight($a_json, $term);
 
$json = json_encode($a_json);
print $json;


function apply_highlight($a_json, $term) {
 
  $rows = count($a_json);
  
  for($row = 0; $row < $rows; $row++) {
 
    $label = $a_json[$row]["label"];
    $a_label_match = array();
 
    $part_len = mb_strlen($term);
    $a_match_start = mb_stripos_all($label, $term);
    if($a_match_start){
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
 
      $a_json[$row]["label"] = $label_highlight;
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
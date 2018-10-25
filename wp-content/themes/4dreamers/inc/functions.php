<?php
function places_template($nuber_of_places){
	$x = $nuber_of_places;
	switch ($nuber_of_places) {
		case 1:
			$template['new_row_array'] = array();
			$template['big_element_array'] = array(0);
			break;
		case 2:
			$template['new_row_array'] = array();
			$template['big_element_array'] = array(0,1);
			break;
		case 3:
			$template['new_row_array'] = array();
			$template['big_element_array'] = array(2);
			break;
		case 4:
			$template['new_row_array'] = array();
			$template['big_element_array'] = array();
			break;
		case 5:
			$template['new_row_array'] = array(2);
			$template['big_element_array'] = array(2,3,4);
			break;	
		case 6:
			$template['new_row_array'] = array(3);
			$template['big_element_array'] = array(4,5);
			break;
		case 7:
			$template['new_row_array'] = array(3,6,10);
			$template['big_element_array'] = array(4,11);
			break;
		case 8:
			$template['new_row_array'] = array(3,6,10);
			$template['big_element_array'] = array(4,7);
			break;	
		case 9:
			$template['new_row_array'] = array(3,6,10);
			$template['big_element_array'] = array(4,7,8);
			break;
		case 10:
			$template['new_row_array'] = array(3,6,10);
			$template['big_element_array'] = array(4,9);
			break;
		case 12:
			$template['new_row_array'] = array(3,6,9);
			$template['big_element_array'] = array(4,9,10,11);
			break;	
		case 12:
			$template['new_row_array'] = array(3,6,9);
			$template['big_element_array'] = array(4,9,10,11);
			break;
		case 13:
			$template['new_row_array'] = array(3,6,10);
			$template['big_element_array'] = array(4,11,12);
			break;
		case 14:
			$template['new_row_array'] = array(3,6,10);
			$template['big_element_array'] = array(4,11);
			break;
		case 15:
			$template['new_row_array'] = array(3,6,10);
			$template['big_element_array'] = array(4,11,14);
			break;	
		case 16:
			$template['new_row_array'] = array(3,6,10);
			$template['big_element_array'] = array(4,11,14,15);
			break;
		case 17:
			$template['new_row_array'] = array(3,6,10);
			$template['big_element_array'] = array(4,11,16);
			break;	
		case 18:
			$template['new_row_array'] = array(3,6,10);
			$template['big_element_array'] = array(4,11);
			break;	
		case 19:
			$template['new_row_array'] = array(3,6,10);
			$template['big_element_array'] = array(4,11,16,17,18);
			break;	
		case 20:
			$template['new_row_array'] = array(3,6,10);
			$template['big_element_array'] = array(4,11,18,19);
			break;
		case 21:
			$template['new_row_array'] = array(3,6,10);
			$template['big_element_array'] = array(4,11,18);
			break;					
		default:
			$template['new_row_array'] = array(3,6,10);
			$template['big_element_array'] = array(4,11,18,25,32,39,46);
			break;
	}
	return $template;
}
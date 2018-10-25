<?php 
//[general_info_column title=""]
function general_info_column( $atts, $content ){

	extract( shortcode_atts( array(
		'title'       => '',
	), $atts, 'general_info_column' ) );

	$result = '<div class="col-sm-2">
            	<h4>'.$title.'</h4>
                <ul class="box">'
                	. do_shortcode( $content ) .
                '</ul>
            </div>';

	return $result;

}
add_shortcode( 'general_info_column', 'general_info_column' );

//[general_info_item price="" text=""]
function general_info_item( $atts, $content ){

	extract( shortcode_atts( array(
		'price'     => '',
		'text'      => '',
	), $atts, 'general_info_column' ) );

	$result = '<li>
                    <h2>' . $price . '</h2>
                    <h5>' . $text . '</h5>
               </li>';

	return $result;

}
add_shortcode( 'general_info_item', 'general_info_item' );


//[button link="" text=""]
function call_to_action_button_shortcode( $atts, $content ){

	extract( shortcode_atts( array(
		'link'  => '#',
		'text'  => '',
		'name' => 'Button',
	), $atts, 'call_to_action_button' ) );



	$result = '<div class="call-to-action">
 					<div class="action-text">'.$text.'</div>
					<div class="button"><a href="'.$link.'">'.$name.'</a></div>
				</div>
				';

	return $result;

}
add_shortcode( 'call_to_action_button', 'call_to_action_button_shortcode' );

//COLUMN
function col_shortcode( $atts, $content ){

	extract( shortcode_atts( array(
		'width' => '12',
	), $atts, 'col' ) );

	$result = '<div class="col col-sm-'.$width.'">'.do_shortcode(wpautop($content)).'</div>';


	return $result;

}
add_shortcode( 'col', 'col_shortcode' );


//ROW
function row_shortcode( $atts, $content ){


	$result = '<div class="row">'.do_shortcode($content).'</div>';


	return $result;

}
add_shortcode( 'row', 'row_shortcode' );
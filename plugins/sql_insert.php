<?php
/**
 * @package Sql_Insert
 * @version 0.1
 */
/*
Plugin Name: SQL Insert
Plugin URI: http://wordpress.org/extend/plugins/sql-insert/
Description: insert tax from a sqldb.
Author: Mactive Meng
Version:0.1
Author URI: http://mac.thinktube.us/
*/

function hello_dolly_get_lyric() {
	/** These are the lyrics to Hello Dolly */
	$sm_brand = array(
	  array('brand_name'=>'ADAM Audio'),
	  array('brand_name'=>'AKG'),
	  array('brand_name'=>'Alesis'),
	  array('brand_name'=>'Antares'),
	  array('brand_name'=>'Apogee '),
	  array('brand_name'=>'Apple'),
	  array('brand_name'=>'Avalon'),
	  array('brand_name'=>'Blue'),
	  array('brand_name'=>'Brent Averill'),
	  array('brand_name'=>'Clavia'),
	  array('brand_name'=>'CME'),
	  array('brand_name'=>'AVID'),
	  array('brand_name'=>'Dynaudio '),
	  array('brand_name'=>'Focusrite'),
	  array('brand_name'=>'Fostex '),
	  array('brand_name'=>'GENELEC'),
	  array('brand_name'=>'Korg'),
	  array('brand_name'=>'LaCie'),
	  array('brand_name'=>'Lexicon'),
	  array('brand_name'=>'M-Audio'),
	  array('brand_name'=>'Mackie '),
	  array('brand_name'=>'Manley '),
	  array('brand_name'=>'Millennia '),
	  array('brand_name'=>'Neumann'),
	  array('brand_name'=>'Novation '),
	  array('brand_name'=>'Prism Sound'),
	  array('brand_name'=>'RME'),
	  array('brand_name'=>'RODE'),
	  array('brand_name'=>'Sennheiser'),
	  array('brand_name'=>'Solid State Logic'),
	  array('brand_name'=>'TC Electronic'),
	  array('brand_name'=>'TL Audio'),
	  array('brand_name'=>'Universal audio'),
	  array('brand_name'=>'Waves'),
	  array('brand_name'=>'Yamaha'),
	  array('brand_name'=>'SPL'),
	  array('brand_name'=>'JVC'),
	  array('brand_name'=>'Smart Research'),
	  array('brand_name'=>'Audio Technica '),
	  array('brand_name'=>'Euphonix'),
	  array('brand_name'=>'Retro Instruments'),
	  array('brand_name'=>'Telefunken'),
	  array('brand_name'=>'SM Pro Audio'),
	  array('brand_name'=>'Azden'),
	  array('brand_name'=>'Motu'),
	  array('brand_name'=>'EASTWEST'),
	  array('brand_name'=>'Native Instruments'),
	  array('brand_name'=>'Best Service'),
	  array('brand_name'=>'Synthogy'),
	  array('brand_name'=>'G-Technology'),
	  array('brand_name'=>'Brauner'),
	  array('brand_name'=>'DPA'),
	  array('brand_name'=>'Minimoog'),
	  array('brand_name'=>'AMS NEVE '),
	  array('brand_name'=>'SKB'),
	  array('brand_name'=>'LogicKeyboard'),
	  array('brand_name'=>'AKAI'),
	  array('brand_name'=>'PSI Audio'),
	  array('brand_name'=>'Royer'),
	  array('brand_name'=>'GML'),
	  array('brand_name'=>'Sony'),
	  array('brand_name'=>'AGUILAR'),
	  array('brand_name'=>'Kurzweil'),
	  array('brand_name'=>'Countryman'),
	  array('brand_name'=>'Ableton'),
	  array('brand_name'=>'Studio Projects'),
	  array('brand_name'=>'SE ELECTRONICS'),
	  array('brand_name'=>'kemper'),
	  array('brand_name'=>'JZ Microphones'),
	  array('brand_name'=>'vintage king audio'),
	  array('brand_name'=>'CRANE SONG'),
	  array('brand_name'=>'Mercury'),
	  array('brand_name'=>'Bricasti')
	);

	return $sm_brand;
}

// This just echoes the chosen line, we'll position it later
function sql_insert() {
	$brand_list = hello_dolly_get_lyric();

	$parent_term = term_exists( 'Apple', 'product_brand' ); // array is returned if taxonomy is given
	print_r($parent_term);

	
	$parent_term_id = $parent_term['term_id']; // get numeric term id

	foreach ($brand_list as $key => $value) {
		# code...
		// echo $value['brand_name']."<br>";
	}

	// wp_insert_term(
	//   'Apple', // the term 
	//   'product', // the taxonomy
	//   array(
	//     'description'=> 'A yummy apple.',
	//     'slug' => 'apple',
	//     'parent'=> $parent_term_id
	//   )
	// );
}

add_action( 'admin_notices', 'sql_insert' );


// Now we set that function up to execute when the admin_notices action is called



?>

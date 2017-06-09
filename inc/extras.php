<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package wccc
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function wccc_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'wccc_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function wccc_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'wccc_pingback_header' );


/**
 * GET XML / JSON / DATA
 */
function get_data($data_url)
{
    $curl = curl_init();
    $options = array(
        CURLOPT_URL => $data_url,
        CURLOPT_RETURNTRANSFER => 1,
    );
    curl_setopt_array($curl, $options);
    $string = curl_exec($curl);
    return $string;
}
function cached_and_valid($file) {
  $expired_time = time() - 1800; //0,5 hours
  return file_exists($file) && filemtime($file) > $expired_time;
}

function get_xml($xml_url)
{
	$curl = curl_init();
	$options = array(
		CURLOPT_URL => $xml_url,
		CURLOPT_RETURNTRANSFER => 1,
	);
	curl_setopt_array($curl, $options);
	$string = curl_exec($curl);
	return $string;
}


function fahrenheit_to_celsius($given_value)
{
	$celsius=5/9*($given_value-32);
	$celsius = floor($celsius);
	return $celsius ;
}

function celsius_to_fahrenheit($given_value)
{
	$fahrenheit=$given_value*9/5+32;
	return $fahrenheit ;
}

function kelvin_to_celsius($temp) 
{
	if ( !is_numeric($temp) ) { return false; }
	return round(($temp - 273.15));
}

function weather_icon($typeicon) {

	// 0	tornado
	// 1	tropical storm
	// 2	hurricane
	// 3	severe thunderstorms
	// 4	thunderstorms

	// 5	mixed rain and snow
	// 6	mixed rain and sleet
	// 7	mixed snow and sleet
	// 8	freezing drizzle
	// 9	drizzle
	// 10	freezing rain
	// 35	mixed rain and hail

	// 11	showers
	// 12	showers
	// 40	scattered showers

	// 13	snow flurries
	// 14	light snow showers
	// 15	blowing snow
	// 16	snow
	// 17	hail
	// 18	sleet
	// 25	cold
	// 41	heavy snow
	// 42	scattered snow showers
	// 43	heavy snow
	// 46	snow showers

	// 19	dust
	// 20	foggy
	// 21	haze
	// 22	smoky

	// 23	blustery
	// 24	windy

	// 26	cloudy
	// 44	partly cloudy

	// 27	mostly cloudy (night)
	// 28	mostly cloudy (day)
	// 29	partly cloudy (night)
	// 30	partly cloudy (day)

	// 31	clear (night)
	// 32	sunny
	// 33	fair (night)
	// 34	fair (day)

	// 36	hot

	// 37	isolated thunderstorms
	// 38	scattered thunderstorms
	// 39	scattered thunderstorms
	// 45	thundershowers
	// 47	isolated thundershowers

	// 3200	not available

	switch ($typeicon) {
		case '0':
		case '1':
		case '2':
		case '3':
		case '4':
			$weatherIcon = '<i class="wi wi-strong-wind"></i>';
			break;
		
		case '5':
		case '6':
		case '7':
		case '8':
		case '9':
		case '10':
		case '35': // mix hail n rail
			$weatherIcon = '<i class="wi wi-sleet"></i>';
			break;

		case '11':
		case '12':
		case '40':
			$weatherIcon = '<i class="wi wi-showers"></i>';
			break;

		case '13':
		case '14':
		case '15':
		case '16':
		case '17':
		case '18':
		case '25': // cold
		case '41': 
		case '42': 
		case '43': 
		case '46': 
			$weatherIcon = '<i class="wi wi-snow"></i>';
			break;

		case '19':
		case '20':
		case '21':
		case '22':
			$weatherIcon = '<i class="wi wi-dust"></i>';
			break;

		case '23':
		case '24':
			$weatherIcon = '<i class="wi wi-windy"></i>';
			break;

		case '26':
		case '44':
			$weatherIcon = '<i class="wi wi-cloudy"></i>';
			break;

		case '27':
		case '28':
		case '29':
		case '30':
			$weatherIcon = '<i class="wi wi-day-cloudy"></i>';
			break;

		case '31':
		case '32':
		case '33':
		case '34':
			$weatherIcon = '<i class="wi wi-day-day-sunny"></i>';
			break;

		case '36': 
			$weatherIcon = '<i class="wi wi-day-day-hot"></i>';
			break;

		case '37': 
		case '38': 
		case '39': 
		case '45':
		case '47':
			$weatherIcon = '<i class="wi wi-day-thunderstorm"></i>';
			break;

		case '41': 
		case '42': 
		case '43': 
			$weatherIcon = '<i class="wi wi-day-thunderstorm"></i>';
			break;		

		case '3200':
			$weatherIcon = '<i class="wi wi-alien"></i>';
			break;
		default:
			$weatherIcon = '<i class="wi wi-alien"></i>';
			break;
	}
	return $weatherIcon;
}

function weather_type($weathertype) {
	switch ($weathertype) {
		case "shower rain":
			$weather = "Rain Showers";
			break;
		default:
			$weather = $weathertype;
	}
	
	return $weather;
}

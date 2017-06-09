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

	if (
		$typeicon == 0 || 
		$typeicon == 1 || 
		$typeicon == 2 || 
		$typeicon == 3 || 
		$typeicon == 4
	) {
		$weatherIcon = '<i class="wi wi-strong-wind"></i>';
	} else if (
		$typeicon == 5 || 
		$typeicon == 6 || 
		$typeicon == 7 || 
		$typeicon == 8 || 
		$typeicon == 9 || 
		$typeicon == 10 || 
		$typeicon == 35
	) {
		$weatherIcon = '<i class="wi wi-sleet"></i>';
	} else if (
		$typeicon == 10 || 
		$typeicon == 12 || 
		$typeicon == 40
	) {
		$weatherIcon = '<i class="wi wi-showers"></i>';
	} else if (
		$typeicon == 13 || 
		$typeicon == 14 || 
		$typeicon == 15 || 
		$typeicon == 16 || 
		$typeicon == 17 || 
		$typeicon == 18 || 
		$typeicon == 25 || 
		$typeicon == 41 || 
		$typeicon == 42 || 
		$typeicon == 46
	) {
		$weatherIcon = '<i class="wi wi-snow"></i>';
	} else if (
		$typeicon == 19 || 
		$typeicon == 20 || 
		$typeicon == 21 || 
		$typeicon == 22
	) {
		$weatherIcon = '<i class="wi wi-dust"></i>';
	} else if (
		$typeicon == 23 || 
		$typeicon == 24
	) {
		$weatherIcon = '<i class="wi wi-windy"></i>';
	} else if (
		$typeicon == 26 || 
		$typeicon == 44
	) {
		$weatherIcon = '<i class="wi wi-cloudy"></i>';
	} else if (
		$typeicon == 27 || 
		$typeicon == 28 || 
		$typeicon == 29 || 
		$typeicon == 30
	) {
		$weatherIcon = '<i class="wi wi-day-cloudy"></i>';
	} else if (
		$typeicon == 31 || 
		$typeicon == 32 || 
		$typeicon == 33 || 
		$typeicon == 34
	) {
		$weatherIcon = '<i class="wi wi-day-day-sunny"></i>';
	} else if (
		$typeicon == 36
	) {
		$weatherIcon = '<i class="wi wi-day-hot"></i>';
	} else if (
		$typeicon == 37 || 
		$typeicon == 38 || 
		$typeicon == 39 || 
		$typeicon == 45 || 
		$typeicon == 47
	) {
		$weatherIcon = '<i class="wi wi-day-thunderstorm"></i>';
	} else if (
		$typeicon == 41 || 
		$typeicon == 42 || 
		$typeicon == 43
	) {
		$weatherIcon = '<i class="wi wi-day-thunderstorm"></i>';
	} else if (
		$typeicon == 3200
	) {
		$weatherIcon = '<i class="wi wi-alien"></i>';
	} else {
		$weatherIcon = '<i class="wi wi-alien"></i>';
	}

	// if ($typeicon == "01d"):
	// 	$weatherIcon = '<i class="wi wi-day-sunny"></i>';
	// elseif ($typeicon == "01n"):
	// 	$weatherIcon = '<i class="wi wi-night-clear"></i>';

	// elseif ($typeicon == "02d"):
	// 	$weatherIcon = '<i class="wi wi-day-cloudy"></i>';
	// elseif ($typeicon == "02n"):
	// 	$weatherIcon = '<i class="wi wi-night-partly-cloudy"></i>';
	// elseif ($typeicon == "03d" || $typeicon == "03n"):
	// 	$weatherIcon = '<i class="wi wi-cloud"></i>';
	// elseif ($typeicon == "04d" || $typeicon == "04n"):
	// 	$weatherIcon = '<i class="wi wi-cloudy"></i>';
	// elseif ($typeicon == "09d" || $typeicon == "09n"):
	// 	$weatherIcon = '<i class="wi wi-showers"></i>';
	// elseif ($typeicon == "10d"):
	// 	$weatherIcon = '<i class="wi wi-rain"></i>';
	// elseif ($typeicon == "10n"):
	// 	$weatherIcon = '<i class="wi wi-night-alt-rain"></i>';
	// elseif ($typeicon == "11d" || $typeicon == "11n"):
	// 	$weatherIcon = '<i class="wi wi-thunderstorm"></i>';
	// elseif ($typeicon == "13d" || $typeicon == "13n"):
	// 	$weatherIcon = '<i class="wi wi-day-fog"></i>';
	// elseif ($typeicon == "50d" || $typeicon == "50n"):
	// 	$weatherIcon = '<i class="wi wi-night-fog"></i>';
	// else:
	// 	$weatherIcon = '<i class="wi wi-alien"></i>';
	// endif;

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

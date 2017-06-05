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
  $expired_time = time() - 10800; //3 hours
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
	if ($typeicon == "01d"):
		$weatherIcon = '<i class="wi wi-day-sunny"></i>';
	elseif ($typeicon == "01n"):
		$weatherIcon = '<i class="wi wi-night-clear"></i>';
	
	elseif ($typeicon == "02d"):
		$weatherIcon = '<i class="wi wi-day-cloudy"></i>';
	elseif ($typeicon == "02n"):
		$weatherIcon = '<i class="wi wi-night-partly-cloudy"></i>';
	elseif ($typeicon == "03d" || $typeicon == "03n"):
		$weatherIcon = '<i class="wi wi-cloud"></i>';
	elseif ($typeicon == "04d" || $typeicon == "04n"):
		$weatherIcon = '<i class="wi wi-cloudy"></i>';
	elseif ($typeicon == "09d" || $typeicon == "09n"):
		$weatherIcon = '<i class="wi wi-showers"></i>';
	elseif ($typeicon == "10d"):
		$weatherIcon = '<i class="wi wi-rain"></i>';
	elseif ($typeicon == "10n"):
		$weatherIcon = '<i class="wi wi-night-alt-rain"></i>';
	elseif ($typeicon == "11d" || $typeicon == "11n"):
		$weatherIcon = '<i class="wi wi-thunderstorm"></i>';
	elseif ($typeicon == "13d" || $typeicon == "13n"):
		$weatherIcon = '<i class="wi wi-day-fog"></i>';
	elseif ($typeicon == "50d" || $typeicon == "50n"):
		$weatherIcon = '<i class="wi wi-night-fog"></i>';
	else:
		$weatherIcon = '<i class="wi wi-alien"></i>';
	endif;
	return $weatherIcon;
}

function weather_type($weathertype) {
	return $weathertype;
}


// add image to first para of single posts

add_filter( 'the_content', 'insert_featured_image', 20 );

function insert_featured_image( $content ) {

    $content = preg_replace( "/<\/p>/", "</p>" . get_the_post_thumbnail($post->ID, 'post-single'), $content, 1 );
    return $content;
}
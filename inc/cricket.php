<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package wccc
 */

function t20_name($teamname) {
	switch ($teamname) {
		case "Essex":
			$team_name = "Eagles";
			break;
		case "Yorkshire":
			$team_name = "Vikings";
			break;
		case "Lancashire":
			$team_name = "Lightning";
			break;
		case "Warwickshire":
			$team_name = "Bears";
			break;
		case "Hampshire":
			$team_name = "Hampshire";
			break;
		case "Middlesex":
			$team_name = "Middlesex";
			break;
		case "Surrey":
			$team_name = "Surrey";
			break;
		case "Somerset":
			$team_name = "Somerset";
			break;
		case "Sussex":
			$team_name = "Sussex";
			break;
		case "Northamptonshire":
			$team_name = "Steelbacks";
			break;
		case "Derbyshire":
			$team_name = "Falcons";
			break;
		case "Durham":
			$team_name = "Jets";
			break;
		case "Glamorgan":
			$team_name = "Glamorgan";
			break;
		case "Nottinghamshire":
			$team_name = "Outlaws";
			break;
		case "Gloucestershire":
			$team_name = "Gloucestershire";
			break;
		case "Leicestershire":
			$team_name = "Foxes";
			break;
		case "Worcestershire":
			$team_name = "Rapids";
			break;
		case "Kent":
			$team_name = "Spifires";
			break;
		default:
			$team_name = $teamname;

	}
	return $team_name;
}

function game_status($status_id) {
	switch ($status_id) {
		case 1:
			$status = "In Play";
			break;
		case 2:
			$status = "Having Tea";
			break;
		case 3:
			$status = "Having Lunch";
			break;
		case 4:
			$status = "Between Innings";
			break;
		case 5:
			$status = "Stumps";
			break;
		case 6:
			$status = "Rain Delay";
			break;
		case 7:
			$status = "Bad Light";
			break;
		case 8:
			$status = "Crowd Trouble";
			break;
		case 9:
			$status = "Pitch Conditions";
			break;
		case 10:
			$status = "Result";
			break;
		case 11:
			$status = "Abandoned";
			break;
		case 12:
			$status = "Floodlight Failure";
			break;
		case 13:
			$status = "Play Suspended";
			break;
		case 14:
			$status = "Start Delayed";
			break;
		case 15:
			$status = "Drinks Break";
			break;
		case 16:
			$status = "Super Over";
			break;
		case 17:
			$status = "Dinner";
			break;
		default:
			$status = "Pre Game";
	}
	return $status;
}

function team_name($team_id, $comp_id) {
	$xml = simplexml_load_file(FEED_DIR . "/rankings-".$comp_id.".xml");
	$json = json_encode($xml);
	$team_info = json_decode($json,TRUE);
	$teams = $team_info['Teams']['Team'];

	foreach ($teams as $team) {
		if ($team['@attributes']['id'] === $team_id) {
			$teamname = $team['@attributes']['name'];
		}
	}
	return $teamname;
}

function save_image($inPath,$outPath)
{ //Download images from remote server
	$in=    fopen($inPath, "rb");
	$out=   fopen($outPath, "wb");
	while ($chunk = fread($in,8192))
	{
		fwrite($out, $chunk, 8192);
	}
	fclose($in);
	fclose($out);
}

function team_image($teamname) {

	$teamname = strtolower(str_replace(" ","", $teamname));
	$teamname = strtolower(str_replace("2ndxi","", $teamname));
	$teamname = strtolower(str_replace("women","", $teamname));
	$image = get_template_directory_uri() . '/assets/images/badges/' . $teamname . '-logo.png';

	if (!file_exists(get_template_directory() . '/assets/images/badges/' . $teamname . '-logo.png')) {
		$image = get_template_directory_uri() . '/assets/images/badges/fallback-logo.png';
	}
	return $image;
}
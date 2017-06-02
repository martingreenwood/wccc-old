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
			$team_name = "Essex Eagles";
			break;
		case "Yorkshire":
			$team_name = "Yorkshire Vikings";
			break;
		case "Lancashire":
			$team_name = "Lancashire Lightning";
			break;
		case "Warwickshire":
			$team_name = "Birmingahm Bears";
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
			$team_name = "Northants Steelbacks";
			break;
		case "Derbyshire":
			$team_name = "Derbyshire Falcons";
			break;
		case "Durham":
			$team_name = "Durham Jets";
			break;
		case "Glamorgan":
			$team_name = "Glamorgan";
			break;
		case "Nottinghamshire":
			$team_name = "Notts Outlaws";
			break;
		case "Gloucestershire":
			$team_name = "Gloucestershire";
			break;
		case "Leicestershire":
			$team_name = "Leicestershire Foxes";
			break;
		case "Worcestershire":
			$team_name = "Worcestershire Rapids";
			break;
		case "Kent":
			$team_name = "Kent Spifires";
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
			$status = "Betwwen Innings";
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
	$xml = simplexml_load_file(FEED_DIR . '/rankings-'.$comp_id.'.xml');
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

function team_image($team_id) {
	//if (filesize(BADGE_DIR . $team_id . '.png') > 0) {
	//	$image = home_url() . '/wp-content/badges/' . $team_id . '.png';
	//} else {
		$image = 'http://omo.akamai.opta.net/image.php?h=omo.akamai.opta.net&sport=cricket&entity=team&description=badges&dimensions=150&id=' . $team_id;
	//}
	return $image;
}
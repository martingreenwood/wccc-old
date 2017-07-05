<?php

$today = date('Ymd', strtotime('now')); 
$dates = array();
$past_dates = array();
$matches = array();
$past_matches = array();

// latest fixture file
$fixture_files = preg_grep('~^EDC.fixtures.*\.(xml)$~', scandir(FEED_DIR));
$fixture_file = array_pop($fixture_files);

$results_files = preg_grep('~^EDC.results.*\.(xml)$~', scandir(FEED_DIR, SCANDIR_SORT_ASCENDING));
$results_file = array_pop($results_files);

if (file_exists(FEED_DIR .'/'. $results_file)):
	$results_xml = simplexml_load_file(FEED_DIR .'/'. $results_file);
	$results_json = json_encode($results_xml);
	$results_array = json_decode($results_json,TRUE);
	$results = $results_array['results'];
endif;
// $fixtures = array_reverse($fixtures);

// read fixtures file and assign to arrays
if (file_exists(FEED_DIR .'/'. $fixture_file)):
	$fixtures_xml = simplexml_load_file(FEED_DIR .'/'. $fixture_file);
	$fixtures_json = json_encode($fixtures_xml);
	$fixtures_array = json_decode($fixtures_json,TRUE);
	$fixtures = $fixtures_array['fixture'];
endif;


// loop through fixtures and create arrays of wccc only matches both past and present
foreach ($fixtures as $fixture):
	if ( $fixture['@attributes']['game_date'] > $today ) {
		if ($fixture['@attributes']['away_team'] == '56' || $fixture['@attributes']['home_team'] == '56' ) {
			$matches[] = $fixture;
			$dates[] = $fixture['@attributes']['game_date'] .'_'. $fixture['@attributes']['id'];
		}
	}
endforeach;

// loop through fixtures and create arrays of wccc only matches both past and present
foreach ($results as $result):
	if ($result['@attributes']['away_team'] == '56' || $result['@attributes']['home_team'] == '56' ) {
		$past_matches[] = $result;
		$past_dates[] = $result['@attributes']['game_date'] .'_'. $result['@attributes']['id'];
	}

endforeach;

// get the next matrchj
$next_match = current($matches);
// get the last match
$last_match = end($past_matches);

$last_match_alt = end($past_dates);
$last_match_id = explode('_', $last_match_alt);
$last_match_id = end($last_match_id);


if (file_exists(FEED_DIR .'/crml-'.$last_match_id.'.xml')):
	$fixture_xml = simplexml_load_file(FEED_DIR .'/crml-'. $last_match_id.'.xml');
	$fixture_json = json_encode($fixture_xml);
	$fixture_array = json_decode($fixture_json,TRUE);
	
	// live / trea / dinner
	$status_id = $fixture_array['MatchDetail']['@attributes']['status_id'];
	$game_id = $fixture_array['MatchDetail']['@attributes']['game_id'];
	$match_game_date = str_replace("-","",$fixture_array['MatchDetail']['@attributes']['game_date']); 
	$days_since_game = $today - $match_game_date;

	$MatchDetail = $fixture_array['MatchDetail'];
	$away_team = $fixture_array['MatchDetail']['@attributes']['away_team'];
	$away_team_id = $fixture_array['MatchDetail']['@attributes']['away_team_id'];
	$home_team = $fixture_array['MatchDetail']['@attributes']['home_team'];
	$home_team_id = $fixture_array['MatchDetail']['@attributes']['home_team_id'];

	$competition_id = $fixture_array['MatchDetail']['@attributes']['competition_id']; 
	$competition_name = $fixture_array['MatchDetail']['@attributes']['competition_name']; 

	$result = $fixture_array['MatchDetail']['@attributes']['result'];
	if (isset($fixture_array['MatchDetail']['@attributes']['number_days'])) {
		$number_days = $fixture_array['MatchDetail']['@attributes']['number_days'];
	}

	// $batting_team_id 
	if (array_key_exists('Innings', $fixture_array)) {
		$innings = $fixture_array['Innings'];
	} else {
		$innings = null;
	}
	if (array_key_exists('PlayerDetail', $fixture_array)) {
		$PlayerDetail = $fixture_array['PlayerDetail'];
	} else {
		$PlayerDetail = null;
	}

	if (array_key_exists('Innings', $fixture_array)):	
		// batting team	
		$bowling_team_id = $fixture_array['Innings']['@attributes']['bowling_team_id'];
		$batting_team_id = $fixture_array['Innings']['@attributes']['batting_team_id'];

		$runs_scored = $fixture_array['Innings']['Total']['@attributes']['runs_scored'];
		$wickets = $fixture_array['Innings']['Total']['@attributes']['wickets'];
		$overs = $fixture_array['Innings']['Total']['@attributes']['overs'];
	endif;

endif;

?>
	<section id="fixtures">

		<div class="container">

			<div class="result">
				<h2>LAST MATCH</h2>
				<div class="match-info">
					<p class="date-time">
						<span class="date">
							<?php echo date("d/m/Y", strtotime($last_match['@attributes']['game_date'])); ?>
						</span>
					</p>

					<p class="comp">
						<?php echo $last_match['@attributes']['comp_name']; ?>
					</p>

					<h2 class="match">
						<?php if (strpos($last_match['@attributes']['comp_name'], 'T20') !== false): ?>
						<?php echo t20_name($last_match['@attributes']['home_team_name']); ?>
						<?php else: ?>
						<?php echo $last_match['@attributes']['home_team_name']; ?>
						<?php endif; ?>

						<span>VS</span><br>

						<?php if (strpos($last_match['@attributes']['comp_name'], 'T20') !== false): ?>
						<?php echo t20_name($last_match['@attributes']['away_team_name']); ?>
						<?php else: ?>
						<?php echo $last_match['@attributes']['away_team_name']; ?>
						<?php endif; ?>
					</h2>

					<div class="links">
						<?php $args = array( 'post_type' => 'matches', 'meta_query' => array( array('key' => '_wcc_feed_id', 'value' => $last_match['@attributes']['id'], 'compare' => '=' )));
						$match_query = new WP_Query( $args );
						if ( $match_query->have_posts() ) : while ( $match_query->have_posts() ):
						$match_query->the_post();
						?>
						<p class="match-result"><?php echo $result; ?></p>
						<?php endwhile; wp_reset_postdata(); endif; ?>
					</div>
					
				</div>
				<a class="info" href="<?php echo the_permalink(); ?>">Match Report</a> <a href="<?php echo home_url('cricket/fixtures-results/results'); ?>">SEE ALL RESULTS</a>
			</div>
			<div class="fixture">
				<?php 
					$next_match_date = $next_match['@attributes']['game_date_time'];
					$match_date_time = strtotime($next_match_date) + 60*60;
					$match_date_countdown = date("Y/m/d H:i", $match_date_time);
				?>
				<h2>NEXT MATCH</h2>
				<div class="match-info">
					<p class="date-time">
						<span class="date">
							<?php echo date("d/m/Y", strtotime($next_match['@attributes']['game_date'])); ?>
						</span>
						<span class="time">
							<?php echo $next_match['@attributes']['time']; ?>
						</span>
						<span class="timetomatch"></span>
						<script type="text/javascript">
							jQuery('.timetomatch').countdown('<?php echo $match_date_countdown; ?>', function(event) {
								var $this = jQuery(this).html(event.strftime(''
									// + '<span>%w</span> weeks '
									+ '<span>%D</span> day%!D '
									+ '<span>%H</span> hr%!H '
									+ '<span>%M</span> min%!M '
								));
							});
						</script>
					</p>

					<p class="comp">
						<?php echo $next_match['@attributes']['comp_name']; ?>
					</p>

					<h2 class="match">

						<?php if (strpos($next_match['@attributes']['comp_name'], 'T20') !== false): ?>
						<?php echo t20_name($next_match['@attributes']['home_team_name']); ?>
						<?php else: ?>
						<?php echo $next_match['@attributes']['home_team_name']; ?>
						<?php endif; ?>

						<span>VS</span><br>

						<?php if (strpos($next_match['@attributes']['comp_name'], 'T20') !== false): ?>
						<?php echo t20_name($next_match['@attributes']['away_team_name']); ?>
						<?php else: ?>
						<?php echo $next_match['@attributes']['away_team_name']; ?>
						<?php endif; ?>

					</h2>

					<div class="links">
						<a class="tickets" href="#">Buy Tickets</a>
						<?php $args = array( 'post_type' => 'matches', 'meta_query' => array( array('key' => '_wcc_feed_id', 'value' => $next_match['@attributes']['id'], 'compare' => '=' )));
						$match_query = new WP_Query( $args );
						if ( $match_query->have_posts() ) : while ( $match_query->have_posts() ):
						$match_query->the_post();
						?>
						<a class="info" href="<?php echo the_permalink(); ?>">Match Info</a>
						<?php endwhile; wp_reset_postdata(); endif; ?>
					</div>
					
				</div>
				<a href="<?php echo home_url('cricket/fixtures-results'); ?>">SEE ALL UPCOMING FIXTURES</a>
			</div>

		</div>

	</section>
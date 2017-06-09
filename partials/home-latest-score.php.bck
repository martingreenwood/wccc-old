<?php

$today = date('Ymd', strtotime('now')); 
$dates = array();
$fm_dates = array();
$fm_matches = array();

$fixture_files = preg_grep('~^EDC.fixtures.*\.(xml)$~', scandir(FEED_DIR, SCANDIR_SORT_ASCENDING));
$fixture_file = array_pop($fixture_files);

if (file_exists(FEED_DIR .'/'. $fixture_file)):
	$fixtures_xml = simplexml_load_file(FEED_DIR .'/'. $fixture_file);
	$fixtures_json = json_encode($fixtures_xml);
	$fixtures_array = json_decode($fixtures_json,TRUE);
	$fixtures = $fixtures_array['fixture'];
endif;

foreach ($fixtures as $fixture):
	$match_id = $fixture['@attributes']['id']; 
	$match_game_date = $fixture['@attributes']['game_date']; 
	$match_game_date_string = $fixture['@attributes']['game_date_string'];
	$match_game_date_time = $fixture['@attributes']['game_date_time'];
	$match_away_team = $fixture['@attributes']['away_team']; 
	$match_home_team = $fixture['@attributes']['home_team'];
	$match_away_team_name = $fixture['@attributes']['away_team_name']; 
	$match_home_team_name = $fixture['@attributes']['home_team_name'];
	if (isset($fixture['@attributes']['number_days'])) {
		$number_days = $fixture['@attributes']['number_days'];
	}

	// previous game
	if ( $match_game_date <= $today ) {
		if ($match_away_team == '56' || $match_home_team == '56' ) {
			$dates[] = $match_game_date .'_'. $match_id;
		}
	}

	// next game
	if ( $match_game_date > $today ) {
		if ($match_away_team == '56' || $match_home_team == '56' ) {
			$fm_matches[] = $fixture;
			$fm_dates[] = $match_game_date .'_'. $match_id;
		}
	}

endforeach;

//last match that matches
$last_match = end($dates);
$last_match_id = explode('_', $last_match);
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

if ($days_since_game < $number_days ): ?>
<section id="vs" data-game-id="<?php echo $game_id; ?>">
	<div class="container">
		<div class="row">
			<div class="tab">LIVE SCORE</div>
			
			<div class="link">
			<span class="status"><?php echo game_status($status_id); ?></span>
				<?php $args = array( 'post_type' => 'matches', 'meta_query' => array( array('key' => '_wcc_feed_id', 'value' => $last_match_id, 'compare' => '=' )));
				$match_query = new WP_Query( $args );
				if ( $match_query->have_posts() ) : while ( $match_query->have_posts() ):
				$match_query->the_post();
				?>
				<a class="info" href="<?php echo the_permalink(); ?>">Match Report</a>
				<?php endwhile; wp_reset_postdata(); endif; ?>
			</div>

			<?php if (is_array($innings) && array_key_exists('0', $innings)): // multiple innings ?>

			<?php 
			$innings_count = 0;
			$innings_counter = 0;
			foreach ($innings as $inning):
				$batting_team_id = $inning['@attributes']['batting_team_id']; 
				if ($batting_team_id === $home_team_id) {
					$side = 'home';
				} else {
					$side = 'away';
				}
				
				++$innings_counter;
				if($innings_counter == 1) {  
					echo "<div class='row'>";
				}
        	?>
			<div class="team <?php echo $side; ?>">
				<?php if($innings_count <= 1): ?>
				<img src="<?php echo team_image($batting_team_id); ?>">
				<?php endif; ?>
				<div class="name">
					
					<?php if (strpos($competition_name, 'T20') !== false): ?>
					<h3><?php echo t20_name(team_name($batting_team_id, $competition_id)); ?></h3>
					<?php else: ?>
					<h3><?php echo team_name($batting_team_id, $competition_id); ?></h3>
					<?php endif; ?>

					<?php 
					if ($batting_team_id === $home_team_id) {
						$side = 'home';
					} else {
						$side = 'away';
					}
					?>
					<h4>
						<?php echo $inning['Total']['@attributes']['runs_scored']; ?>
						<?php 
						if ($inning['Total']['@attributes']['wickets'] < 10) {
							echo "/ " . $inning['Total']['@attributes']['wickets'];
						} else {
							echo "All Out";
						}
						?>
					</h4>
				</div>
			</div>
			
			<?php if ($innings_count == 1): ?>
			<div class="mid"><p>FIRST INNINGS</p></div>
			<?php endif; ?>
			<?php if ($innings_count == 2): ?>
			<div class="mid"><p>SECOND INNINGS</p></div>
			<?php endif; ?>

			<?php 
			if ($innings_counter == 2) {
				echo "</div>";
				$innings_counter = 0;
			}
			?>

			<?php $innings_count++; endforeach; ?>

			<?php else: // innings are not in array with [0] key ?>
			<div class="team one">
				<img src="<?php echo team_image($home_team_id); ?>">
				<div class="name">
					
					<?php if (strpos($competition_name, 'T20') !== false): ?>
					<h3><?php echo t20_name(team_name($home_team_id, $competition_id)); ?></h3>
					<?php else: ?>
					<h3><?php echo team_name($home_team_id, $competition_id); ?></h3>
					<?php endif; ?>

					<?php if (array_key_exists('Innings', $fixture_array)): ?>
					<?php if ($home_team_id == $batting_team_id): ?>
						<h4><?php echo $runs_scored; ?> 
							<?php 
							if ($wickets < 10) {
								echo "/ " . $wickets;
							} else {
								echo "All Out";
							}
							?>
							<br><small><?php echo $overs; ?> overs bowled</small>
						</h4>
					<?php else: ?>
						<h4>YET TO BAT</h4>
					<?php endif; ?>
					<?php endif; ?>
				</div>
			</div>
			<div class="mid"><p>VS</p></div>
			<div class="team two">
				<div class="name">

					<?php if (strpos($competition_name, 'T20') !== false): ?>
					<h3><?php echo t20_name(team_name($away_team_id, $competition_id)); ?></h3>
					<?php else: ?>
					<h3><?php echo team_name($away_team_id, $competition_id); ?></h3>
					<?php endif; ?>

					<?php if (array_key_exists('Innings', $fixture_array)): ?>
					<?php if ($away_team_id == $batting_team_id): ?>
						<h4><?php echo $runs_scored; ?>
							<?php 
							if ($wickets < 10) {
								echo "/ " . $wickets;
							} else {
								echo "All Out";
							}
							?>
							<br><small><?php echo $overs; ?> overs bowled</small>
						</h4>
					<?php else: ?>
						<h4>YET TO BAT</h4>
					<?php endif; ?>
					<?php endif; ?>
				</div>
				<img src="<?php echo team_image($away_team_id); ?>">
			</div>
			<?php endif; ?>

		</div>
	</div>
</section>

<?php endif; ?>
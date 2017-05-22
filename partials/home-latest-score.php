<?php

$today = date('Ymd', strtotime('now')); 
$dates = array();

$fixture_files = preg_grep('~^EDC.*\.(xml)$~', scandir(FEED_DIR));
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
	$number_days = $fixture['@attributes']['number_days'];

	if ( $match_game_date <= $today ) {
		if ($match_away_team == '56' || $match_home_team == '56' ) {
			$dates[] = $match_game_date .'_'. $match_id;
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
	// $fixture_SessionUpdates = $fixture_array['SessionUpdates']['session']['@attributes'];
	
	// live / trea / dinner
	$status_id = $fixture_array['MatchDetail']['@attributes']['status_id'];
	$match_game_date = str_replace("-","",$fixture_array['MatchDetail']['@attributes']['game_date']); 
	$days_since_game = $today - $match_game_date;

	$MatchDetail = $fixture_array['MatchDetail'];
	$away_team = $fixture_array['MatchDetail']['@attributes']['away_team'];
	$away_team_id = $fixture_array['MatchDetail']['@attributes']['away_team_id'];
	$home_team = $fixture_array['MatchDetail']['@attributes']['home_team'];
	$home_team_id = $fixture_array['MatchDetail']['@attributes']['home_team_id'];
	

	$result = $fixture_array['MatchDetail']['@attributes']['result'];
	$number_days = $fixture_array['MatchDetail']['@attributes']['number_days'];

	if (array_key_exists('Innings', $fixture_array)):
	
	// batting team	
	$bowling_team_id = $fixture_array['Innings']['@attributes']['bowling_team_id'];
	$batting_team_id = $fixture_array['Innings']['@attributes']['batting_team_id'];

	// if $home_team_id == $batting_team_id show a score
	// if $home_team_id == $bowling_team_id show yet to bat

	$runs_scored = $fixture_array['Innings']['Total']['@attributes']['runs_scored'];
	$wickets = $fixture_array['Innings']['Total']['@attributes']['wickets'];
	$overs = $fixture_array['Innings']['Total']['@attributes']['overs'];
	
	endif;

endif;

if ( !empty($fixture_array) ) {

	if ($days_since_game < $number_days ): ?>
	<section id="vs">
		<div class="container">
			<div class="row">
				<div class="tab">LIVE SCORE</div>
				<div class="mid"><p>VS</p></div>
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


				<div class="team one">
					<img src="<?php echo team_image($home_team_id); ?>">
					<div class="name">
						<h3><?php echo $home_team; ?></h3>
						<?php if (array_key_exists('Innings', $fixture_array)): ?>
						<?php if ($home_team_id == $batting_team_id): ?>
							<h4><?php echo $runs_scored; ?> / <?php echo $wickets; ?>
								<br><small><?php echo $overs; ?> overs bowled</small>
							</h4>
						<?php else: ?>
							<h4>YET TO BAT</h4>
						<?php endif; ?>
						<?php endif; ?>
					</div>
				</div>
				<div class="team two">
					<div class="name">
						<h3><?php echo $away_team; ?></h3>
						<?php if (array_key_exists('Innings', $fixture_array)): ?>
						<?php if ($away_team_id == $batting_team_id): ?>
							<h4><?php echo $runs_scored; ?> / <?php echo $wickets; ?>
								<br><small><?php echo $overs; ?> overs bowled</small>
							</h4>
						<?php else: ?>
							<h4>YET TO BAT</h4>
						<?php endif; ?>
						<?php endif; ?>
					</div>
					<img src="<?php echo team_image($away_team_id); ?>">
				</div>

			</div>
		</div>
	</section>

	<?php 
	endif; 
} else {
?>
	<section id="vs">
		<div class="container">
			<div class="row">
				<h1>SOMETHING HERE</h1>
			</div>
		</div>
</section>
<?php
}
?>
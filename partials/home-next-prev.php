<?php

$today = date('Ymd', strtotime('now')); 
$dates = array();
$past_dates = array();
$matches = array();
$past_matches = array();

// latest fixture file
$fixture_files = preg_grep('~^EDC.fixtures.*\.(xml)$~', scandir(FEED_DIR));
$fixture_file = array_pop($fixture_files);

// oldest fixture file
$past_fixture_files = preg_grep('~^EDC.*\.(xml)$~', scandir(FEED_DIR, SCANDIR_SORT_ASCENDING));
$past_fixture_file = current($fixture_files);

// read fixtures file and assign to arrays
if (file_exists(FEED_DIR .'/'. $fixture_file)):
	$fixtures_xml = simplexml_load_file(FEED_DIR .'/'. $fixture_file);
	$fixtures_json = json_encode($fixtures_xml);
	$fixtures_array = json_decode($fixtures_json,TRUE);
	$fixtures = $fixtures_array['fixture'];
endif;

// read fixtures file and assign to arrays
if (file_exists(FEED_DIR .'/'. $past_fixture_file)):
	$p_fixtures_xml = simplexml_load_file(FEED_DIR .'/'. $past_fixture_file);
	$p_fixtures_json = json_encode($p_fixtures_xml);
	$p_fixtures_array = json_decode($p_fixtures_json,TRUE);
	$p_fixtures = $p_fixtures_array['fixture'];
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
foreach ($p_fixtures as $p_fixture):

	if ( $p_fixture['@attributes']['game_date'] < $today ) {
		if ($p_fixture['@attributes']['away_team'] == '56' || $p_fixture['@attributes']['home_team'] == '56' ) {
			$past_matches[] = $p_fixture;
			$past_dates[] = $p_fixture['@attributes']['game_date'] .'_'. $p_fixture['@attributes']['id'];
		}
	}
endforeach;

// get the next matrchj
$next_match = current($matches);
// get the last match
$last_match = end($past_matches);

?>
	<section id="fixtures">

		<div class="container">

			<div class="span6 result">
				<h2>RESULTS</h2>
				<div class="match-info">
					<p class="date-time">
						<span class="date">
							<?php echo date("d/m/Y", strtotime($last_match['@attributes']['game_date'])); ?>
						</span>
						<span class="time">
							<?php echo $last_match['@attributes']['time']; ?>
						</span>
					</p>

					<p class="comp">
						<?php echo $last_match['@attributes']['comp_name']; ?>
					</p>

					<h2 class="match">
						<?php echo $last_match['@attributes']['home_team_name']; ?> <span>VS</span><br>
						<?php echo $last_match['@attributes']['away_team_name']; ?>
					</h2>

					<div class="links">
						<?php $args = array( 'post_type' => 'matches', 'meta_query' => array( array('key' => '_wcc_feed_id', 'value' => $last_match['@attributes']['id'], 'compare' => '=' )));
						$match_query = new WP_Query( $args );
						if ( $match_query->have_posts() ) : while ( $match_query->have_posts() ):
						$match_query->the_post();
						?>
						<a class="info" href="<?php echo the_permalink(); ?>">Match Report</a>
						<?php endwhile; wp_reset_postdata(); endif; ?>
					</div>
					
				</div>
				<a href="<?php echo home_url('cricket/fixtures-results/results'); ?>">SEE ALL RESULTS</a>
			</div>
			<div class="span6 fixture">
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
						<?php echo $next_match['@attributes']['home_team_name']; ?> <span>VS</span><br>
						<?php echo $next_match['@attributes']['away_team_name']; ?>
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
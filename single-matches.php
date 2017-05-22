<?php
/**
 * The template for displaying all single matches
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package wccc
 */

get_header(); ?>

	<?php 
	if (get_field( 'enable_t20_mode', 'option' )):
		$bannerimage = get_template_directory_uri() . "/assets/images/rapids-banner.png";
	else: 
		$bannerimage = get_template_directory_uri() ."/assets/images/banner.png";
	endif; 

	if (get_field( 'top_image' )) {
		$top_image = get_field( 'top_image' ); 
		$top_image = $top_image['url']; 
	} else {
		$top_image = get_template_directory_uri() ."/assets/images/player.png";
	}

	?>

	<?php 
	
	$feedID = get_post_meta($post->ID,'_wcc_feed_id',true);

	if (file_exists(FEED_DIR . '/crml-'.$feedID.'.xml')):
		$xml = simplexml_load_file(FEED_DIR . '/crml-'.$feedID.'.xml');
		$json = json_encode($xml);
		$matchinfo = json_decode($json,TRUE);
		
		$game_status = game_status($matchinfo['MatchDetail']['@attributes']['status_id']);
		$toss = $matchinfo['MatchDetail']['@attributes']['toss'];
		$game_date_time = $matchinfo['MatchDetail']['@attributes']['game_date'];
		$game_time = $matchinfo['MatchDetail']['@attributes']['game_time'];
		$game_date = date("d M Y", strtotime($game_date_time));
	
		$venue_name = $matchinfo['MatchDetail']['Venue']['@attributes']['venue_name'];
		$venue_city = $matchinfo['MatchDetail']['Venue']['@attributes']['venue_city'];
		
		$official_1_first_name = $matchinfo['MatchDetail']['Officials']['@attributes']['official_1_first_name'];
		$official_1_last_name = $matchinfo['MatchDetail']['Officials']['@attributes']['official_1_last_name'];
		$official_1_name = $official_1_first_name. ' ' .$official_1_last_name;

		$official_2_first_name = $matchinfo['MatchDetail']['Officials']['@attributes']['official_2_first_name'];
		$official_2_last_name = $matchinfo['MatchDetail']['Officials']['@attributes']['official_2_last_name'];
		$official_2_name = $official_2_first_name. ' ' .$official_2_last_name;

		$match_id = $matchinfo['MatchDetail']['@attributes']['game_id']; 
		$result = $matchinfo['MatchDetail']['@attributes']['result']; 
		$competition_id = $matchinfo['MatchDetail']['@attributes']['competition_id']; 
		$competition_name = $matchinfo['MatchDetail']['@attributes']['competition_name']; 
		
		$home_team = $matchinfo['MatchDetail']['@attributes']['home_team']; 
		$home_team_id = $matchinfo['MatchDetail']['@attributes']['home_team_id']; 

		$away_team = $matchinfo['MatchDetail']['@attributes']['away_team']; 
		$away_team_id = $matchinfo['MatchDetail']['@attributes']['away_team_id']; 

		// $batting_team_id 
		if (array_key_exists('Innings', $matchinfo)) {
			$innings = $matchinfo['Innings'];
		} else {
			$innings = null;
		}
		if (array_key_exists('PlayerDetail', $matchinfo)) {
			$PlayerDetail = $matchinfo['PlayerDetail'];
		} else {
			$PlayerDetail = null;
		}

	?>

	<?php endif; ?>

	<section id="jumbrotron">
		<div class="overlay" style="background-image: url(<?php echo $bannerimage; ?>)"></div>

		<div class="news" style="background-image: url(<?php echo $top_image; ?>)">
			<div class="table"><div class="cell middle">
				<div class="container">
					<div class="span6">&nbsp;
						<?php 
						$title = get_the_title( ); 
						$title = explode(" ", $title);
						?>
						<h1>
							<?php if ($home_team === "Worcestershire"): ?>
							<span>
							<?php endif; ?>
							<?php echo $home_team; ?>
							<?php if ($home_team === "Worcestershire"): ?>
							</span>
							<?php endif; ?>
							
							<small>VS</small><br>

							<?php if ($away_team === "Worcestershire"): ?>
							<span>
							<?php endif; ?>
							<?php echo $away_team; ?>
							<?php if ($away_team === "Worcestershire"): ?>
							</span>
							<?php endif; ?>
						</h1>
					</div>
					<div class="span6">
					</div>
				</div>
			</div></div>
		</div>
	</section>

	<section id="vs">
		<div class="container">
			<div class="row">
				<div class="tab"><?php echo $competition_name; ?></div>
				<div class="mid"><p>VS</p></div>
				<div class="link">
					<span class="status"><?php echo $game_status; ?></span>
					<?php echo $result; ?>
				</div>

				<?php if (is_array($innings) && array_key_exists('0', $innings)): ?>

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
						<h3>
							<?php echo team_name($batting_team_id, $competition_id); ?>
						</h3>
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

				<?php else: ?>
				<?php $batting_team_id = $innings['@attributes']['batting_team_id']; ?>
				
				<div class="team home">
					<img src="<?php echo team_image($home_team_id); ?>">
					<div class="name">
						<h3>
							<?php echo team_name($home_team_id, $competition_id); ?>
						</h3>
						<?php if (array_key_exists('Innings', $matchinfo)): ?>
						<?php if ($home_team_id == $batting_team_id): ?>
							<h4>
								<?php echo $innings['Total']['@attributes']['runs_scored']; ?>
								<?php 
								if ($inning['Total']['@attributes']['wickets'] < 10) {
									echo "/ " . $inning['Total']['@attributes']['wickets'];
								} else {
									echo "All Out";
								}
								?>
							</h4>
						<?php else: ?>
							<h4>YET TO BAT</h4>
						<?php endif; ?>
						<?php endif; ?>

					</div>
				</div>
				<div class="team away">
					<img src="<?php echo team_image($away_team_id); ?>">
					<div class="name">
						<h3>
							<?php echo team_name($away_team_id, $competition_id); ?>
						</h3>
						<?php if (array_key_exists('Innings', $matchinfo)): ?>
						<?php if ($away_team_id == $batting_team_id): ?>
							<h4>
								<?php echo $innings['Total']['@attributes']['runs_scored']; ?>
								<?php 
								if ($inning['Total']['@attributes']['wickets'] < 10) {
									echo "/ " . $inning['Total']['@attributes']['wickets'];
								} else {
									echo "All Out";
								}
								?>
							</h4>
						<?php else: ?>
							<h4>YET TO BAT</h4>
						<?php endif; ?>
						<?php endif; ?>
					</div>
				</div>
				<?php endif; ?>

			</div>
		</div>
	</section>


	<div id="primary" class="content-area container">
		<aside class="span3">
		 	<div id="nav-anchor"></div>
		 	<nav>
				<ul>
					<li>Quick Navigation</li>
					<?php if( have_rows('reports') ): ?>
					<li><a href="#reports">Reports</a></li>
					<?php endif; ?>
					<li><a href="#matchinfo">Match Information</a></li>
					<li><a href="#scorecard">Scorecard</a></li>
					<li><a href="#wagonwheel">Wagon Wheel</a></li>
					<li><a href="#manhattan">Manhattan</a></li>
				</ul>
	
				<div class="time">
					<div id="pause"><i class="fa fa-pause" aria-hidden="true"></i></div>
					<div id="resume"><i class="fa fa-play" aria-hidden="true"></i></div>
					<h3>This page will refresh in <span class="countdown"></span></h3>
					<div class="clear"></div>
					<div id="progressBar">
						<div></div>
					</div>


				</div>

				<div class="live" style="margin-top: 30px;">
					<a>LIVE VIEW</a>
				</div>

			</nav>
		</aside>
		<main id="main" class="site-main span9" role="main">
			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

			endwhile; // End of the loop.
			?>

			<?php if( have_rows('reports') ): ?>
			<div id="reports" class="reports">
				<div data-accordion-group>
				<?php
					$ac = 0;
				 	// loop through the rows of data
				    while ( have_rows('reports') ) : the_row(); 
					?>
					<div class="accordion <?php if($ac === 0): ?>open<?php endif; ?>" data-accordion>
						<div data-control><?php the_sub_field( 'title' ); ?></div>
						<div data-content>
							<div class="copy">
								<?php the_sub_field( 'report' ); ?>
							</div>
						</div>
					</div>
					<?php
					$ac++;
					endwhile;
				?>

				</div>
			</div>
			<?php endif; ?>

			<div class="data-feed" id="matchinfo">
				<h1>Match Information</h1>

				<div class="details">
					<dl class="details-date">
						<dt>Date:</dt>
						<dd><?php echo $game_date; ?></dd>
					</dl>
					<dl class="details-description">
						<dt>Match:</dt>
						<dd></dd>
					</dl>
					<dl class="details-venue">
						<dt>Venue:</dt>
						<dd><?php echo $venue_name; ?>, <?php echo $venue_city; ?></dd>
					</dl>
					<dl class="details-start">
						<dt>Start time:</dt>
						<dd><?php echo $game_time; ?></dd>
					</dl>
					<dl class="details-umpires">
						<dt>Umpires:</dt>
						<dd><?php echo $official_1_name; ?> / <?php echo $official_2_name; ?></dd>
					</dl>
					<dl class="details-toss">
						<dt>Toss:</dt>
						<dd><?php echo $toss; ?></dd>
					</dl>
					<div class="clear"></div>
				</div>

				<div class="summary">
				<?php if (is_array($innings) && array_key_exists('0', $innings)): ?>

					<?php foreach ($innings as $inning): ?>
					<dl>
						<dt><?php echo team_name($inning['@attributes']['batting_team_id'], $competition_id); ?></dt>
						<dd><?php echo $inning['Total']['@attributes']['runs_scored']; ?> 
							<?php 
							if ($inning['Total']['@attributes']['wickets'] < 10) {
								echo "/ " . $inning['Total']['@attributes']['wickets'];
							} else {
								echo "All Out";
							}
							?>
							(<?php echo $inning['Total']['@attributes']['overs']; ?> overs)</dd>
					</dl>
					<?php endforeach; ?>

				<?php else: ?>

					<dl>
						<dt><?php echo team_name($home_team_id, $competition_id); ?></dt>
						<dd>
						<?php if ($home_team_id == $batting_team_id): ?>
							<?php echo $innings['Total']['@attributes']['runs_scored']; ?>
							<?php 
							if ($innings['Total']['@attributes']['wickets'] < 10) {
								echo "/ " . $innings['Total']['@attributes']['wickets'];
							} else {
								echo "All Out";
							}
							?>
							(<?php echo $innings['Total']['@attributes']['overs']; ?> overs)
						<?php else: ?>
							<h4>YET TO BAT</h4>
						<?php endif; ?>
						</dd>
					</dl>
					<dl>
						<dt><?php echo team_name($away_team_id, $competition_id); ?></dt>
						<dd>
						<?php if ($away_team_id == $batting_team_id): ?>
							<?php echo $innings['Total']['@attributes']['runs_scored']; ?>
							<?php 
							if ($innings['Total']['@attributes']['wickets'] < 10) {
								echo "/ " . $innings['Total']['@attributes']['wickets'];
							} else {
								echo "All Out";
							}
							?>
							(<?php echo $innings['Total']['@attributes']['overs']; ?> overs)
						<?php else: ?>
							<h4>YET TO BAT</h4>
						<?php endif; ?>
						</dd>
					</dl>
				<?php endif; ?>

					<div class="clear"></div>
				</div>
				<?php 
				$teams = $PlayerDetail['Team'];
				?>
				<?php if ($teams): ?>
				<?php foreach ($teams as $team): ?>
				<div class="<?php echo $team['@attributes']['home_or_away']; ?>Side">
					<ul>
						<li class="teamName"><?php echo $team['@attributes']['team_name']; ?></li>
						<?php foreach ($team['Player'] as $player): ?>
						<li>
							<?php echo $player['@attributes']['player_name']; ?> 

							<?php if(array_key_exists('captain',$player['@attributes'])): ?>
							<span title="Captain"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/captain.svg"></span> 
							<?php endif; ?>
							<?php if(array_key_exists('keeper',$player['@attributes'])): ?>
							<span title="Wicketkeeper"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/wicket.svg"></span>
							<?php endif; ?>
						</li>
						<?php endforeach; ?>
					</ul>
					<div class="clear"></div>
				</div>
				<?php endforeach; ?>
				<?php endif; ?>

				<div class="clear"></div>

			</div>

			<div class="data-feed" id="scorecard">
				<h1>SCORECARD</h1>
				<opta-widget sport="cricket" widget="score_card" template="normal" live="true" competition="<?php echo $competition_id; ?>" season="1" match="<?php echo $feedID; ?>" show_match_header="false" show_crests="false" show_competition_name="true" show_match_description="true" show_date="true" date_format="dddd D MMMM YYYY HH:mm" show_venue="true" show_officials="on_field" show_toss="true" show_innings_breakdown="true" show_current_batting="true" show_best_batting="1" show_best_bowling="1" show_state_of_play="true" navigation="tabs" default_nav="1" show_batting="true" show_mins_batted="true" show_fours="false" show_sixes="false" show_strike_rate="false" show_bowling="true" show_economy="false" show_dot_balls="false" show_bowling_extras="false" show_fow="true" show_partnerships="true" show_unfinished_partnerships="true" team_naming="full" player_naming="last_name" show_logo="false" show_title="false" breakpoints="400, 700"></opta-widget>
			</div>

			<div class="data-feed" id="wagonwheel">
				<h1>WAGON WHEEL</h1>
				<opta-widget sport="cricket" widget="wagonwheel" template="normal" competition="<?php echo $competition_id; ?>" season="1" match="<?php echo $feedID; ?>" live="true" show_match_header="false" show_crests="true" show_state_of_play="true" show_team_sheets="true" show_innings="all" side="both" show_key="true" show_runs_summary="true" show_segments="true" show_tooltips="true" team_naming="full" player_naming="full" show_logo="true" show_live="true" show_title="false" breakpoints="400, 700"></opta-widget>
			</div>

			<div class="data-feed" id="manhattan">
				<h1>MANHATTAN</h1>
				<opta-widget sport="cricket" widget="manhattan" template="normal" competition="<?php echo $competition_id; ?>" season="0" match="<?php echo $feedID; ?>" live="true" show_match_header="false" show_crests="true" show_competition_name="true" show_state_of_play="true" show_graphs="all" side="both" show_key="true" show_innings="both" show_tooltips="true" show_officials="on_field" show_axis_labels="true" show_timecontrols="true" team_naming="full" player_naming="full" show_live="true" show_logo="true" show_title="false" breakpoints="400, 700"></opta-widget>
			</div>

		</main>

	</div>

	<section id="timer">
		
	</section>	

<script>

var CountDown = (function ($) {
    // Length ms 
    var TimeOut = 90000;
    // Interval ms
    var TimeGap = 1000;

    var CurrentTime = ( new Date() ).getTime();
    var EndTime = ( new Date() ).getTime() + TimeOut;

    var GuiTimer = $('.countdown');
    var GuiPause = $('#pause');
    var GuiResume = $('#resume').css('display', 'none');

    var Running = true;

    var UpdateTimer = function() {
        // Run till timeout
        if( CurrentTime + TimeGap < EndTime ) {
            setTimeout( UpdateTimer, TimeGap );
        }
        // Countdown if running
        if( Running ) {
            CurrentTime += TimeGap;
            if( CurrentTime >= EndTime ) {
                GuiTimer.css('color','red');
                location.reload(true);
            }
        }
        // Update Gui
        var Time = new Date();
        Time.setTime( EndTime - CurrentTime );
        var Minutes = Time.getMinutes();
        var Seconds = Time.getSeconds();

        GuiTimer.html( 
            (Minutes < 10 ? '0' : '') + Minutes 
            + ':' 
            + (Seconds < 10 ? '0' : '') + Seconds );
    };

    var Pause = function() {
        Running = false;
        GuiPause.css('display', 'none');
        GuiResume.css('display', 'inline-block');;
    };

    var Resume = function() {
        Running = true;
        GuiPause.css('display', 'inline-block');;
        GuiResume.css('display', 'none');;
    };

    var Start = function( Timeout ) {
        TimeOut = Timeout;
        CurrentTime = ( new Date() ).getTime();
        EndTime = ( new Date() ).getTime() + TimeOut;
        UpdateTimer();
    };

    return {
        Pause: Pause,
        Resume: Resume,
        Start: Start
    };

})(jQuery);

jQuery('#pause').on('click',CountDown.Pause);
jQuery('#resume').on('click',CountDown.Resume);

// ms
CountDown.Start(90000);

function progress(timeleft, timetotal, $element) {
    var progressBarWidth = timeleft * $element.width() / timetotal;
    $element.find('div').animate({ width: progressBarWidth }, timeleft == timetotal ? 0 : 1000, 'linear').html();
    if(timeleft > 0) {
        setTimeout(function() {
            progress(timeleft - 1, timetotal, $element);
        }, 1000);
    }
};

progress(90, 90, jQuery('#progressBar'));



</script>

<?php
get_footer();

<?php
/**
 * Template Name: Results
 *
 * The template for displaying the results page
 *
 * @package wccc
 */

// use latest fixtures file
$today = date('Ymd', strtotime('now')); 
$dates = array();
$matches = array();
$all_comp = array();
$prev = NULL;

$results_files = preg_grep('~^EDC.results.*\.(xml)$~', scandir(FEED_DIR, SCANDIR_SORT_ASCENDING));
$results_file = array_pop($results_files);

if (file_exists(FEED_DIR .'/'. $results_file)):
	$results_xml = simplexml_load_file(FEED_DIR .'/'. $results_file);
	$results_json = json_encode($results_xml);
	$results_array = json_decode($results_json,TRUE);
	$results = $results_array['results'];
endif;

// // NON OPTA
$args = array( 
	'post_type' 		=> 'matches',
	'posts_per_page' 	=> -1,
	'meta_key' 			=> 'start_date',
	'orderby' 			=> 'meta_value',
	'order'      		=> 'DESC',
	'meta_query' 		=> array(
		array(
			'key'     	=> 'start_date',
			'value'   	=> $today, // in da past
			'compare' 	=> '<',
		),
	),
);
$match_query = new WP_Query( $args );

get_header(); ?>

	<?php 
	if (get_field( 'enable_t20_mode', 'option' )):
		$bannerimage = get_template_directory_uri() . "/assets/images/rapids-banner.png";

		$top_image_array = array();
		$top_t20_images = get_field( 'header_images_t20', 'option' );

		foreach ($top_t20_images as $top_t20_image) {
			$top_image_array[] = $top_t20_image['url'];
		}
		$ri = array_rand($top_image_array);
		$top_image = $top_image_array[$ri];
	else: 
		$bannerimage = get_template_directory_uri() ."/assets/images/banner.png";

		$top_image_array = array();
		$top_images = get_field( 'header_images', 'option' );
		foreach ($top_images as $top_image) {
			$top_image_array[] = $top_image['url'];
		}
		$ri = array_rand($top_image_array);
		$top_image = $top_image_array[$ri];
	endif; 
	
	$start = 1;
	$target = 58;

	?>
	<section id="jumbrotron">
		<div class="overlay" style="background-image: url(<?php echo $bannerimage; ?>)"></div>

		<div class="news" style="background-image: url(<?php echo $top_image; ?>)">
			<div class="table"><div class="cell middle">
				<div class="container">
					<div class="span6">
						<?php if (get_field( 'has_custom_title' )): ?>
							<h1><?php the_field( 'custom_title' ); ?></h1>
						<?php else: ?>
							<h1><?php the_title(); ?></h1>
						<?php endif; ?>
					</div>
					<div class="span6">
					</div>
				</div>
			</div></div>
		</div>
	</section>

	<div id="topnavbar" class="pagenav">
		<div class="container">
		<?php get_sidebar('top'); ?>
		</div>
	</div>

	<div id="filter">
		<div class="container">
			<div class="row">
				<div class="choice">
					<h3>Filter by Team</h3>
					<form>
						<ul>
							<li>
								<input class="teamfilter" type="checkbox" name="team" value="firstxi">
								<label for="first">First XI</label>
							</li>
							<li>
								<input class="teamfilter" type="checkbox" name="team" value="secondxi">
								<label for="second">Second XI</label>
							</li>
						</ul>
					</form>
				</div>
				<div class="choice">
					<h3>By Competition</h3>
					<form>
						<ul>
							<li>
						 		<input class="compfilter" type="checkbox" name="comp-natwest_t20_blast_2017" value="comp-natwest_t20_blast_2017">
						 		<label for="comp-natwest_t20_blast_2017">Natwest T20 Blast 2017</label>
						 	</li>
						 	<li>
						 		<input class="compfilter" type="checkbox" name="comp-specsavers_county_championship_division_two_2017" value="comp-specsavers_county_championship_division_two_2017">
						 		<label for="comp-specsavers_county_championship_division_two_2017">specsavers county championship division two 2017</label>
						 	</li>
						 	<li>
						 		<input class="compfilter" type="checkbox" name="comp-royal_london_one-day_cup_2017" value="comp-royal_london_one-day_cup_2017">
						 		<label for="comp-royal_london_one-day_cup_2017">royal london one-day cup 2017</label>
						 	</li>
						 	<li>
						 		<input class="compfilter" type="checkbox" name="comp-second_xi_championship" value="comp-second_xi_championship">
						 		<label for="comp-second_xi_championship">second xi championship 2017</label>
						 	</li>
						 	<li>
						 		<input class="compfilter" type="checkbox" name="comp-second_xi_t20_2017" value="comp-second_xi_t20_2017">
						 		<label for="comp-second_xi_t20_2017">comp second xi t20 2017</label>
						 	</li>
						</ul>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div id="primary" class="content-area container">
		<main id="main" class="site-main span12" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

			endwhile; // End of the loop.
			?>

			<div id="fixres">

				<div class="tabs">
					<ul class="tab-links">
						<li><a href="<?php echo home_url( 'cricket/fixtures' ); ?>">Fixtures</a></li>
						<li class="active"><a href="<?php echo home_url( 'cricket/results' ); ?>">Results</a></li>
					</ul>

					<div class="tab-content">

						<div class="active tab">
							
						<?php 
						if ( $match_query->have_posts() ) : 
							while ( $match_query->have_posts() ): $match_query->the_post();
							
							if (isset($match['@attributes']['id'])) {
								$match_id = $match['@attributes']['id']; 
							} else {
								$match_id = get_the_id();
							}

							$fixture_title = explode(" ", get_the_title( $match_id ));

							if (isset($match['@attributes']['away_team'])) {
								$match_away_team = $match['@attributes']['away_team']; 
							} else {
								$match_away_team = get_field('away_team');
							}
							
							if (isset($match['@attributes']['away_team_name'])) {
								$match_away_team_name = trim($match['@attributes']['away_team_name']); 
							} else {
								$match_away_team_name = get_field( 'away_team' );;
							}

							if (isset($match['@attributes']['result_text'])) {
								$result_text = $match['@attributes']['result_text'];
							} else {
								$result_text = ucwords(strtolower(get_field( 'result' ) ));
							}

							if (empty(trim($match_away_team_name))) {
								$match_away_team_name = "TBC";
							}

							if (isset($match['@attributes']['home_team'])) {
								$match_home_team = $match['@attributes']['home_team'];
							} else {
								$match_home_team = get_field( 'home_team' );
							}

							if (isset($match['@attributes']['home_team_name'])) {
								$match_home_team_name = trim($match['@attributes']['home_team_name']);
							} else {
								$match_home_team_name = get_field( 'home_team' );
							}

							if (empty(trim($match_home_team_name))) {
								$match_home_team_name = "TBC";
							}

							if (isset($match['@attributes']['comp_name'])) {
								$match_comp_name = $match['@attributes']['comp_name'];
							} else {
								$match_comp_name = get_field( 'type' );
							}

							if (isset($match['@attributes']['comp_id'])) {
								$match_comp_id = $match['@attributes']['comp_id'];
							} else {
								$match_comp_id = str_replace(" ","_",strtolower(get_field( 'type' )));
							}

							if (strpos($match_comp_name, 'T20') !== false):
								$team_type = "rapids";
							elseif(isset($match['ID'])):
								$team_type = get_field( 'team_playing' );
							else:
								$team_type = "firstxi";
							endif;

							if (isset($match['@attributes']['game_date'])) {
								$match_game_date = $match['@attributes']['game_date'];
							} else {
								$match_game_date = get_field( 'start_date' );
							}

							if (isset($match['@attributes']['game_date'])) {
								$match_game_date_code = date("j/m/Y", strtotime($match['@attributes']['game_date']));
							} else {
								$match_game_date_code = date("j/m/Y", strtotime(get_field( 'start_date' )));
							}
							
							if (isset($match['@attributes']['game_date_string'])) {
								$match_game_date_string = date("j/m/Y", strtotime( $match['@attributes']['game_date'] ));
							} else {
								$match_game_date_string = date("j/m/Y", strtotime(get_field( 'start_date' )));
							}

							if (isset($match['@attributes']['game_date_string'])) {
								$match_live_game = $match['@attributes']['live_game'];
							} else {
								$match_live_game = 0;
							}
							
							$match_live_game_class = null;
							if ($match_live_game > 0) {
								$match_live_game_class = 'live-game';
							}

							if (isset($match['@attributes']['time'])) {
								$match_time = date("H:i", strtotime($match['@attributes']['time']));
							} else {
								$match_time = date("H:i", strtotime(get_field( 'start_time' )));
							}

							if (isset($match['@attributes']['venue'])) {
								$match_venue = $match['@attributes']['venue'];
							} else {
								$match_venue = get_field( 'venue' );
							}
							?>
							<div class="row match result <?php echo $match_live_game_class; ?>" data-game-id="<?php echo $match_id; ?>" data-compid="comp-<?php echo $match_comp_id; ?>" data-event-date="<?php echo $match_game_date_code; ?>" data-team="<?php echo $team_type; ?>">

								<div class="team home">

									<?php if(strtolower($match_home_team) !== 'worcestershire' && strtolower($match_home_team) !== 'rapids' ) { ?>
										
										<?php if (strpos($match_comp_name, 'T20') !== false): ?>
										<img src="<?php echo team_image( t20_name($match_home_team) ); ?>">
										<?php else: ?>
										<img src="<?php echo team_image($match_home_team); ?>">
										<?php endif; ?>

									<?php } ?>

									<?php if (strtolower($match_away_team) !== 'worcestershire' && strtolower($match_away_team) !== 'rapids' ) { ?>
										
										<?php if (strpos($match_comp_name, 'T20') !== false): ?>
										<img src="<?php echo team_image( t20_name($match_away_team) ); ?>">
										<?php else: ?>
										<img src="<?php echo team_image($match_away_team); ?>">
										<?php endif; ?>

									<?php } ?>
									
									<div class="name">

										<h3>
											<?php if (strpos($match_comp_name, 'T20') !== false): ?>
											<?php echo t20_name($match_home_team_name); ?>
											<?php else: ?>
											<?php echo $match_home_team_name; ?>
											<?php endif; ?>

											<small>vs</small> 

											<?php if (strpos($match_comp_name, 'T20') !== false): ?>
											<?php echo t20_name($match_away_team_name); ?>
											<?php else: ?>
											<?php echo $match_away_team_name; ?>
											<?php endif; ?>
											
										</h3>
										<h4><?php echo $result_text; ?></h4>
										<p><span><?php echo $match_venue; ?></span> | <span><?php echo $match_game_date_string; ?></span> | <span><?php echo $match_comp_name; ?></span></p>
									</div>
								</div>

								<div class="link">

									<?php if (get_field( 'match_link' )): ?>
										<a class="matchlink" target="_blank" href="<?php echo get_field( 'match_link' ); ?>">Match Report</a>
									<?php else: ?>
										<a class="matchlink" href="<?php echo get_the_permalink(  ); ?>">Match Report</a>
									<?php endif; ?>

								</div>
							</div>
							<?php
							endwhile; 
						wp_reset_postdata(); 
						endif; 
						?>

						</div>
					</div>
				</div>
			</div>

		</main><!-- #main -->

	</div><!-- #primary -->

	<?php 
		get_template_part( 'partials/social', 'tweets' );
	?>

	<?php 
		get_template_part( 'partials/sponsor', 'boxes' );
	?>

<?php
get_footer();

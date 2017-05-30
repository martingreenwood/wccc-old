<?php
/**
 * Template Name: Fixtures
 *
 * The template for displaying fixtures
 *
 * @package wccc
 */

// use latest fixtures file
$today = date('Ymd', strtotime('now')); 
$dates = array();
$matches = array();
$prev = NULL;
$comp = NULL;

$fixture_files = preg_grep('~^EDC.*\.(xml)$~', scandir(FEED_DIR, 1));
$fixture_file = array_pop($fixture_files);

if (file_exists(FEED_DIR .'/'. $fixture_file)):
	$fixtures_xml = simplexml_load_file(FEED_DIR .'/'. $fixture_file);
	$fixtures_json = json_encode($fixtures_xml);
	$fixtures_array = json_decode($fixtures_json,TRUE);
	$fixtures = $fixtures_array['fixture'];
endif;

foreach ($fixtures as $fixture):
	$match_game_date = $fixture['@attributes']['game_date']; 
	$match_away_team = $fixture['@attributes']['away_team'];
	$match_home_team = $fixture['@attributes']['home_team'];
	// Worcester Only Games
	if ( $match_game_date > $today ) {
		if ($match_away_team == '56' || $match_home_team == '56' ) {
			$matches[] = $fixture;
		}
	}
endforeach;


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
	
	$start = 1;
	$target = 58;

	if(!is_dir(BADGE_DIR)) {
		mkdir(BADGE_DIR);
	}

	foreach (range($start, $target) as $i) {
		
		if (!file_exists(BADGE_DIR . '/'.$i.'.png')) {
			$content = file_get_contents('http://images.akamai.opta.net/cricket/team/badges_150/'.$i.'.png');
			file_put_contents(BADGE_DIR . '/'.$i.'.png', $content);
		}
	}


	?>
	<section id="jumbrotron">
		<div class="overlay" style="background-image: url(<?php echo $bannerimage; ?>)"></div>

		<div class="news" style="background-image: url(<?php echo $top_image; ?>)">
			<div class="table"><div class="cell middle">
				<div class="container">
					<div class="span6">
						&nbsp;
						<h1><?php the_title(); ?></h1>
					</div>
					<div class="span6">
					</div>
				</div>
			</div></div>
		</div>
	</section>

	<div id="filter">
		<div class="container">
			<div class="row">
				<div class="span6">
					<h3>Filter by Team</h3>
					<form>
						<ul>
							<li>
								<label for="first">First XI</label>
								<input type="radio" name="first" value="first">
							</li>
							<li>
								<label for="second">Second XI</label>
								<input type="radio" name="second" value="second">
							</li>
							<li>
								<label for="rapids">Rapids</label>
								<input type="radio" name="rapids" value="rapids">
							</li>
							<li>
								<label for="acadamy">Acadamy</label>
								<input type="radio" name="acadamy" value="acadamy">
							</li>
						</ul>
					</form>
				</div>
				<div class="span6">
					<h3>By Competition</h3>
					<form>
						<ul>
							<li>
								<label for="">County Championship</label>
								<input type="radio" name="comp" value="comp-1969">
							</li>
							<li>
								<label for="">One Day Cup</label>
								<input type="radio" name="comp" value="comp-1970">
							</li>
							<li>
								<label for="">T20 Blast</label>
								<input type="radio" name="comp" value="comp-1971">
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

			<div id="vs">
			<?php if(get_field( 'fixture_type' ) == 'manual'):			
				if( have_rows('fixtures') ): while ( have_rows('fixtures') ) : the_row(); ?>
					<div class="row">

						<div class="tab">
							<span><?php the_sub_field('start_date'); ?></span>
							<span><?php the_sub_field('start_time'); ?></span>
						</div>

						<div class="link">
							<p><?php the_sub_field('venue'); ?></p>
							<p><?php the_sub_field('result'); ?></p>
							<a href="<?php the_sub_field('match_report_link'); ?>" class="Opta-Ext">Match page</a>
						</div>

						<div class="team home">
							<img src="//placehold.it/100x100">
							<div class="name">
								<h3><?php the_sub_field('away_team'); ?></h3>
							</div>
						</div>
						<div class="mid"><p>VS</p></div>
						<div class="team away">
							<div class="name">
								<h3><?php the_sub_field('away_team'); ?></h3>
							</div>
							<img src="//placehold.it/100x100">
						</div>

					</div>
					<?php endwhile; ?>

				<?php endif; ?>

			<?php else: // not manual so get "live" data 

				foreach ($matches as $match):
					$match_id = $match['@attributes']['id']; 
					$match_away_team = $match['@attributes']['away_team']; 
					$match_away_team_name = $match['@attributes']['away_team_name']; 
					$match_collection_detail_id = $match['@attributes']['collection_detail_id']; 
					$match_comp_name = $match['@attributes']['comp_name'];

					$match_description = $match['@attributes']['description']; // blank
					$match_game_date = $match['@attributes']['game_date']; 
					$match_game_date_string = $match['@attributes']['game_date_string'];
					$match_game_date_time = $match['@attributes']['game_date_time'];
					$match_game_type_id = $match['@attributes']['game_type_id'];
					$match_gmt_offset = $match['@attributes']['gmt_offset'];
					$match_group_name = $match['@attributes']['group_name'];
					$match_home_team = $match['@attributes']['home_team'];
					$match_home_team_name = $match['@attributes']['home_team_name'];
					$match_live_game = $match['@attributes']['live_game'];
					if ($match_live_game === 1) {
						$match_live_game = 'live-game';
					}
					$match_order = $match['@attributes']['order'];
					$match_time = $match['@attributes']['time'];
					$match_tour_id = $match['@attributes']['tour_id'];
					$match_venue = $match['@attributes']['venue'];
					$match_venue_city = $match['@attributes']['venue_city'];
					$match_venue_country = $match['@attributes']['venue_country'];
					$match_venue_id = $match['@attributes']['venue_id'];

					$match_month = date("F", strtotime($match_game_date));

					if ($match_month != $prev) { ?>
						<h2 id="<?php echo strtolower($match_month); ?>"><?php echo $match_month; ?></h2>
						<?php 
						$prev = $match_month;
					}
					?>
				<div class="row <?php echo $match_live_game; ?>" data-game-id="<?php echo $match_id; ?>">

					<div class="team home">
						<?php if ($match_away_team !== '56') { ?>
							<img src="<?php echo team_image($match_away_team); ?>">
						<?php } ?>
						<?php if($match_home_team !== '56' ) { ?>
							<img src="<?php echo team_image($match_home_team); ?>">
						<?php } ?>

						<div class="name">

							<h3>
								<?php if (strpos($competition_name, 'T20') !== false): ?>
								<?php echo t20_name($match_home_team_name); ?>
								<?php else: ?>
								<?php echo $match_home_team_name; ?>
								<?php endif; ?>

								<small>vs</small> 
								<?php echo $match_away_team_name; ?>
							</h3>
							<h4><span><?php echo $match_game_date_string; ?></span> <span><?php echo date('g:iA', strtotime($match_time)); ?></span></h4>
							<p><span><?php echo $match_venue; ?></span> <span><?php echo $match_comp_name; ?></span></p>
						</div>
					</div>

					<div class="link">
						<?php $args = array( 'post_type' => 'matches', 'meta_query' => array( array('key' => '_wcc_feed_id', 'value' => $match_id, 'compare' => '=' )));
						$match_query = new WP_Query( $args );
						if ( $match_query->have_posts() ) : while ( $match_query->have_posts() ):
						$match_query->the_post();
						?>
						<a class="matchlink" href="<?php echo the_permalink(); ?>">Match Report</a>
						<?php endwhile; wp_reset_postdata(); endif; ?>
						<?php if ( $match_game_date > $today ): ?>
						<a class="ticketlink" href="#">Buy Tickets</a>
						<?php endif; ?>
					</div>

					

				</div>
				<?php endforeach; ?>
			<?php endif; ?>
			</div>

		</main><!-- #main -->

	</div><!-- #primary -->

<?php
get_footer();

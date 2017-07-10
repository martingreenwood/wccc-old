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
$matches_played = array();
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

foreach ($results as $result):
	$result_game_date = $result['@attributes']['game_date']; 
	$result_away_team = $result['@attributes']['away_team'];
	$result_home_team = $result['@attributes']['home_team'];
	
	// Worcester Only Games
	if ($result_away_team == '56' || $result_home_team == '56' ) {
		$matches_played[] = $result;
	}
endforeach;
$matches_played = array_reverse($matches_played);

foreach ($matches_played as $match_played):
	$match_comp_name = $match_played['@attributes']['comp_name'];
	$match_comp_id = $match_played['@attributes']['comp_id'];
	$all_comp[] = $match_comp_id ."_". $match_comp_name;
endforeach;
$comps = array_unique($all_comp);

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
								<input class="teamfilter" type="checkbox" name="team" value="rapids">
								<label for="rapids">Rapids</label>
							</li>
						</ul>
					</form>
				</div>
				<div class="choice">
					<h3>By Competition</h3>
					<form>
						<ul>
						<?php
						foreach ($comps as $comp):
							$comp_data = explode("_", $comp)
							?>
							<li>
								<input class="compfilter" type="checkbox" name="comp-<?php echo $comp_data[0]; ?>" value="comp-<?php echo $comp_data[0]; ?>">
								<label for="comp-<?php echo $comp_data[0]; ?>"><?php echo $comp_data[1]; ?></label>
							</li>
							<?php 
						endforeach;
						?>
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

						<div id="results" class="active tab">
							<?php 
							$prev = null;
							foreach ($matches_played as $match_played):
							$match_id = $match_played['@attributes']['id']; 
							$match_away_team = $match_played['@attributes']['away_team']; 
							$match_away_team_name = $match_played['@attributes']['away_team_name']; 
							$match_comp_name = $match_played['@attributes']['comp_name'];
							$match_comp_id = $match_played['@attributes']['comp_id'];

							$match_game_date = $match_played['@attributes']['game_date']; 
							$match_game_date_string = $match_played['@attributes']['game_date_string'];

							$match_home_team = $match_played['@attributes']['home_team'];
							$match_home_team_name = $match_played['@attributes']['home_team_name'];

							$match_time = $match_played['@attributes']['time'];
							$match_venue = $match_played['@attributes']['venue'];
							
							$result_text = $match_played['@attributes']['result_text'];

							$match_month = date("F Y", strtotime($match_game_date));
							if ($match_month != $prev) { ?>
								<h2 id="<?php echo strtolower($match_month); ?>"><?php echo $match_month; ?></h2>
								<?php 
								$prev = $match_month;
							}
							?>

							<div 
								class="row match result" 

								<?php if ( $match_game_date >= $today ): ?>
								data-match-type="fixture" 
								<?php else: ?>
								data-match-type="result"
								<?php endif; ?>

								data-game-id="<?php echo $match_id; ?>" 

								data-compid="comp-<?php echo $match_comp_id; ?>" 
								
								<?php if (strpos($match_comp_name, 'T20') !== false): ?>
								data-team="rapids"
								<?php else: ?>
								data-team="firstxi" 
								<?php endif; ?>
								>

								<div class="team home">
									<?php if ($match_away_team !== '56') { ?>
										<img src="<?php echo team_image($match_away_team); ?>">
									<?php } ?>
									<?php if($match_home_team !== '56' ) { ?>
										<img src="<?php echo team_image($match_home_team); ?>">
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
										<p><span><?php echo $match_venue; ?></span> <span><?php echo $match_comp_name; ?></span> <span><?php echo $match_game_date_string; ?></span> <span><?php echo date('g:iA', strtotime($match_time)); ?></span></p>
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
								</div>
							</div>
							<?php endforeach; ?>					
						</div>
					</div>
				</div>
			</div>

		</main><!-- #main -->

	</div><!-- #primary -->

<?php
get_footer();

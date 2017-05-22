<?php
/**
 * Template Name: Fixtures
 *
 * The template for displaying fixtures
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


	<div id="primary" class="content-area container">
		<main id="main" class="site-main span9" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->

		<div id="Opta_n" class="Opta Opta-Normal">
			<div class="Opta_W Opta_C_F Opta_C Opta_C_F_N">
				<div class="Opta-js-main">
					<div class="Opta-Cf Opta-fixtures-list">
						<table class="Opta-Crested">

						<?php if(get_field( 'fixture_type' ) == 'manual'): ?>
						
							<?php
							if( have_rows('fixtures') ):
							while ( have_rows('fixtures') ) : the_row();
							?>

							<tbody class="Opta-Fixture Opta-Match-41311 Opta-Odd">
								<tr>
									<td colspan="5" class="Opta-title">
										<h3><span><?php the_sub_field('start_date'); ?></span></h3>
									</td>
								</tr>
								<tr class="Opta-Fixture-Header">
									<td rowspan="4" class="Opta-Crest Opta-Team Opta-Team-52 Opta-Home">
										<span class="Opta-Image-Holder Opta-Image-Team Opta-Image-Team-52 Opta-Image-Medium">
											<span class="Opta-Image-Holder  Opta-Image-Team Opta-Image-Team-52 Opta-Image-Large">
												<img src="http://omo.akamai.opta.net/image.php?h=omo.akamai.opta.net&amp;sport=cricket&amp;entity=team&amp;description=badges&amp;dimensions=150&amp;id=52" alt="Glamorgan" class=" Opta-Image-Team-Medium">
											</span>
										</span>
									</td>
									<td class="Opta-TeamName Opta-Team Opta-Team-52 Opta-Home"><?php the_sub_field('home_team'); ?></td>
									<td class="Opta-Match-Result"><div><?php the_sub_field('start_time'); ?></div></td>
									<td class="Opta-TeamName Opta-Team Opta-Team-56 Opta-Away"><?php the_sub_field('away_team'); ?></td>
									<td rowspan="4" class="Opta-Crest Opta-Team Opta-Team-56 Opta-Away">
										<span class="Opta-Image-Holder Opta-Image-Team Opta-Image-Team-56 Opta-Image-Medium">
											<span class="Opta-Image-Holder  Opta-Image-Team Opta-Image-Team-56 Opta-Image-Large">
												<img src="//placeholder.it/56x56" alt="">
											</span>
										</span>
									</td>
								</tr>
								<tr>
									<td colspan="3">
										<div class="Opta-Matchdata">
											<dl class="Opta-Venue">
												<dt>Venue</dt>
												<dd><?php the_sub_field('venue'); ?></dd>
											</dl>
										</div>
									</td>
								</tr>
								<tr class="Opta-Fixture-Scoreline">
									<td colspan="3"><?php the_sub_field('result'); ?></td>
								</tr>
								<tr class="Opta-Match-Link">
									<td colspan="3">
										<a href="<?php the_sub_field('match_report_link'); ?>" class="Opta-Ext">Match page</a>
									</td>
								</tr>
							</tbody>

							<?php
							endwhile;
							endif;
							?>


						<?php else: ?>


							<?php if (file_exists(FEED_DIR . '/EDC.fixtures.20170511000003.xml')): ?>
							
							<?php $xml = simplexml_load_file(FEED_DIR . '/EDC.fixtures.20170511000003.xml'); ?>

							<?php 
								$json = json_encode($xml);
								$array = json_decode($json,TRUE);
								$fixtures = $array['fixture'];
							?>

							<?php foreach ($fixtures as $fixture): ?>

							<?php 
							$match_id = $fixture['@attributes']['id']; 
							$match_away_team = $fixture['@attributes']['away_team']; 
							$match_away_team_name = $fixture['@attributes']['away_team_name']; 
							$match_collection_detail_id = $fixture['@attributes']['collection_detail_id']; 
							$match_description = $fixture['@attributes']['description']; // blank
							$match_game_date = $fixture['@attributes']['game_date']; 
							$match_game_date_custom = date("D dS M Y", strtotime($match_game_date));
							$match_game_date_string = $fixture['@attributes']['game_date_string'];
							$match_game_date_time = $fixture['@attributes']['game_date_time'];
							$match_game_type_id = $fixture['@attributes']['game_type_id'];
							$match_gmt_offset = $fixture['@attributes']['gmt_offset'];
							$match_group_name = $fixture['@attributes']['group_name'];
							$match_home_team = $fixture['@attributes']['home_team'];
							$match_home_team_name = $fixture['@attributes']['home_team_name'];
							$match_live_game = $fixture['@attributes']['live_game'];
							if ($match_live_game) {
								$match_live_game = 'live-game';
							}
							$match_order = $fixture['@attributes']['order'];
							$match_time = $fixture['@attributes']['time'];
							$match_tour_id = $fixture['@attributes']['tour_id'];
							$match_venue = $fixture['@attributes']['venue'];
							$match_venue_city = $fixture['@attributes']['venue_city'];
							$match_venue_country = $fixture['@attributes']['venue_country'];
							$match_venue_id = $fixture['@attributes']['venue_id'];

							if (filesize(BADGE_DIR . $match_away_team . '.png' > 0)) {
								$match_away_img = BADGE_DIR . $match_away_team . '.png';
							} else {
								$match_away_img = 'http://placehold.it/150x150';
							}
							
							if (filesize(BADGE_DIR . $match_home_team . '.png' > 0)) {
								$match_home_img = BADGE_DIR . $match_home_team . '.png';
							} else {
								$match_home_img = 'http://placehold.it/150x150';
							}

							?>

							<tbody class="<?php echo $match_live_game; ?> Opta-Fixture Opta-Match-<?php echo $match_id; ?>">
								<tr>
									<td colspan="5" class="Opta-title">
										<h3><span><?php echo $match_game_date_string; ?></span></h3>
									</td>
								</tr>
								<tr class="Opta-Fixture-Header">
									<td rowspan="4" class="Opta-Crest Opta-Team Opta-Team-52 Opta-Home">
										<span class="Opta-Image-Holder Opta-Image-Team Opta-Image-Team-52 Opta-Image-Medium">
											<span class="Opta-Image-Holder  Opta-Image-Team Opta-Image-Team-52 Opta-Image-Large">
												<img src="<?php echo $match_home_img; ?>" alt="">
											</span>
										</span>
									</td>
									<td class="Opta-TeamName Opta-Team Opta-Team-52 Opta-Home">
										<?php echo $match_home_team_name; ?>
									</td>
									<td class="Opta-Match-Result">
										<div><?php echo date('g;iA', strtotime($match_time)); ?></div>
									</td>
									<td class="Opta-TeamName Opta-Team Opta-Team-56 Opta-Away">
										<?php echo $match_away_team_name; ?>
									</td>
									<td rowspan="4" class="Opta-Crest Opta-Team Opta-Team-56 Opta-Away">
										<span class="Opta-Image-Holder Opta-Image-Team Opta-Image-Team-56 Opta-Image-Medium">
											<span class="Opta-Image-Holder  Opta-Image-Team Opta-Image-Team-56 Opta-Image-Large">
												<img src="<?php echo $match_home_img; ?>" alt="">
											</span>
										</span>
									</td>
								</tr>
								<tr>
									<td>
										<div class="Opta-Matchdata">
											<dl class="Opta-Venue">
												<dt>Venue</dt>
												<dd><?php echo $match_venue; ?></dd>
											</dl>
										</div>
									</td>
								</tr>
								<tr class="Opta-Fixture-Scoreline">
									<td>
										<?php the_sub_field('result'); ?>
									</td>
								</tr>
								<tr class="Opta-Match-Link">
									<td>
										<a href="" class="Opta-Ext">Match page</a>
									</td>
								</tr>
							</tbody>

							<?php endforeach; ?>

								<?php //print_r($fixtures); ?>
							
							<?php else: ?>
								<p class="error">Failed to open xml file.</p>
							<?php endif; ?>

						<?php endif; ?>

						</table>
					</div>
				</div>
			</div>
		</div>

	</div><!-- #primary -->

<?php
get_footer();

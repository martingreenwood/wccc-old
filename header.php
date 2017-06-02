<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wccc
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>
<?php $enable_t20_mode = null; if (get_field( 'enable_t20_mode', 'option' )): $enable_t20_mode = 't20'; endif; ?>
<body <?php body_class($enable_t20_mode); ?>>
<div id="page" class="site">

	<div id="loader">
		<div id="loading">
			<div id="progstat"></div>
			<div id="progress"></div>
		</div>
	</div>

	<header id="masthead">

		<div class="site-header container">

			<div class="row">
			
				<div class="branding">
					<a href="<?php echo home_url('/'); ?>">
						<?php if (get_field( 'enable_t20_mode', 'option' )): ?>
							<img src="<?php echo get_template_directory_uri(); ?>/assets/images/rapids-logo.svg" width="133" alt="Rapds Logo">
						<?php else: ?>
							<img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.svg" width="415" alt="WCCC Logo">
						<?php endif; ?>
					</a>
				</div>

				<nav id="site-navigation" class="main-navigation" role="navigation">
					
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">MENU</button>
					<?php if (!is_page( 'pitchview' )): ?>
						<a href="<?php echo home_url( 'pitchview' ); ?>" class="live-view">LIVE VIEW</a>
					<?php endif ?>

					<div class="main-menu-container">
						<div class="container">
							
							<ul class="menu" id="primary-menu">
								
								<li>
									<a id="home" href="<?php echo home_url(); ?>">Home</a>
								</li>

								<li>
									<a id="cricket" data-tab="cricket" href="<?php echo home_url('cricket'); ?>">Cricket</a>
								</li>

								<li>
									<a id="news" data-tab="news" href="<?php echo home_url('news'); ?>">News</a>
								</li>

								<li>
									<a id="club" data-tab="club" href="<?php echo home_url('the-club'); ?>">The Club</a>
								</li>

								<li>
									<a id="visitors" data-tab="visitors" href="<?php echo home_url('visitor-info'); ?>">Visitors</a>
								</li>

								<li>
									<a id="members" data-tab="members" href="<?php echo home_url('memberships'); ?>">Memberships</a>
								</li>

								<li>
									<a id="commercal" data-tab="commercal" href="<?php echo home_url('commercial'); ?>">Commercial</a> 
								</li>

								<li>
									<a id="shop" data-tab="shop" href="https://www.hogeweb1002.co.uk/event_listing.aspx" target="_blank">Shop</a> 
								</li>

								<li>
									<a id="whatson" data-tab="whatson" href="<?php echo home_url('whats-on'); ?>">Whats On</a>
								</li>

								<li>
									<a id="contact" data-tab="contact" href="<?php echo home_url('contact'); ?>">Contact</a>
								</li>

								<li>
									<a id="newroad" data-tab="newroad" href="//www.wccc.co.uk/newroadevents/" target="_blank">New Road</a>
								</li>

							</ul>

							<div class="menu-childs">

								<div id="home" class="child open">
									
									<div class="fixtures span6">
										<h2>Tables</h2>

										<div class="tabs">
											<ul class="tab-links">
												<li class="active"><a href="#tab1">County Championship</a></li>
												<li><a href="#tab2">One Day Cup</a></li>
												<li><a href="#tab3">T20 Blast</a></li>
											</ul>

											<div class="tab-content">
												<div id="tab1" class="tab active">
													<opta-widget sport="cricket" widget="standings" template="normal" live="false" competition="1969" season="0" team="56" navigation="none" default_nav="1" show_key="false" show_crests="false" points_in_first_column="true" competition_naming="full" team_naming="full" sorting="false" show_live="true" show_logo="false" show_title="false" breakpoints="400, 700"></opta-widget>
												</div>

												<div id="tab2" class="tab">
													<opta-widget sport="cricket" widget="standings" template="normal" live="false" competition="1970" season="0" team="56" navigation="none" default_nav="1" show_key="false" show_crests="false" points_in_first_column="true" competition_naming="full" team_naming="full" sorting="false" show_live="true" show_logo="false" show_title="false" breakpoints="400, 700"></opta-widget>
												</div>

												<div id="tab3" class="tab">
													<opta-widget sport="cricket" widget="standings" template="normal" live="false" competition="1971" season="0" team="56" navigation="none" default_nav="1" show_key="false" show_crests="false" points_in_first_column="true" competition_naming="full" team_naming="full" sorting="false" show_live="true" show_logo="false" show_title="false" breakpoints="400, 700"></opta-widget>
												</div>
											</div>
										</div>

									</div>

									<div class="results span3">

										<?php
										// oldest fixture file
										$resultscount = 0;
										$today = date('Ymd', strtotime('now')); 
										$past_dates = array();
										$past_matches = array();
										$results_files = preg_grep('~^EDC.results.*\.(xml)$~', scandir(FEED_DIR, SCANDIR_SORT_ASCENDING));
										$results_file = array_pop($results_files);

										if (file_exists(FEED_DIR .'/'. $results_file)):
											$results_xml = simplexml_load_file(FEED_DIR .'/'. $results_file);
											$results_json = json_encode($results_xml);
											$results_array = json_decode($results_json,TRUE);
											$p_fixtures = $results_array['results'];
											$p_fixtures = array_reverse($p_fixtures);
										endif;

										foreach ($p_fixtures as $p_fixture):

											if ($p_fixture['@attributes']['away_team'] == '56' || $p_fixture['@attributes']['home_team'] == '56' ) {
												$past_matches[] = $p_fixture;
												$past_dates[] = $p_fixture['@attributes']['game_date'] .'_'. $p_fixture['@attributes']['id'];
											}

										endforeach;
										?>
										
										<h2>Results</h2>

										<?php foreach ($past_matches as $past_match): ?>
										<div class="match-info">
											<p class="date-time">
												<?php echo date("d/m/Y", strtotime($past_match['@attributes']['game_date'])); ?>
											</p>

											<p class="match">
												<?php echo $past_match['@attributes']['home_team_name']; ?> <span>VS</span> <?php echo $past_match['@attributes']['away_team_name']; ?>
											</p>

											<p class="links">
												<?php $args = array( 'post_type' => 'matches', 'meta_query' => array( array('key' => '_wcc_feed_id', 'value' => $past_match['@attributes']['id'], 'compare' => '=' )));
												$match_query = new WP_Query( $args );
												if ( $match_query->have_posts() ) : while ( $match_query->have_posts() ):
												$match_query->the_post();
												?>
												<a class="info" href="<?php echo the_permalink(); ?>#report">
													<?php 
													if (file_exists(FEED_DIR . '/crml-'.$past_match['@attributes']['id'] .'.xml')){
														$xml = simplexml_load_file(FEED_DIR . '/crml-'.$past_match['@attributes']['id'].'.xml');
														$json = json_encode($xml);
														$matchinfo = json_decode($json,TRUE);
														$result = $matchinfo['MatchDetail']['@attributes']['result']; 
													}
													else {
														$result = "Match Report";
													}
													echo $result;
													?>
												</a>
												<?php endwhile; wp_reset_postdata(); endif; ?>
											</p>
											
										</div>
										<?php $resultscount++; if ($resultscount == 4 ) { break; } endforeach; ?>

									</div>

									<div class="latest-news span3">
										
										<h2>News</h2>
										<?php 
										$loop = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => 4 ) );
										while ( $loop->have_posts() ) : $loop->the_post(); 
											?>
											<div class="match-info">
												<p class="date-time">
													<?php echo the_date( ); ?>
												</p>

												<p class="match">
													<?php the_title( ); ?>
												</p>

												<p class="links">
													<a class="info" href="<?php echo the_permalink(); ?>">Read More</a>
												</p>
												
											</div>
											<?php 
										endwhile; 
										wp_reset_query(); 
										?>


									</div>

								</div><!-- END TAB -->

								<div id="cricket" class="child">
								</div><!-- END TAB -->

								<div id="news" class="child">
								</div><!-- END TAB -->

								<div id="theclub" class="child">
								</div><!-- END TAB -->

								<div id="visitors" class="child">
								</div><!-- END TAB -->

								<div id="memberships" class="child">
								</div><!-- END TAB -->

								<div id="commercial" class="child">
								</div><!-- END TAB -->

								<div id="shop" class="child">
								</div><!-- END TAB -->

								<div id="whatson" class="child">
								</div><!-- END TAB -->

								<div id="contact" class="child">
								</div><!-- END TAB -->

							</div>

						</div>
					</div>

				</nav>

			</div>
		</div>

	</header>

	<div id="content" class="site-content">

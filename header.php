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

<div id="page" class="site <?php echo $pagename; ?>">

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
									<a id="default" data-tab="default" href="<?php echo home_url(); ?>">Home</a>
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
									<a id="members" data-tab="memberships" href="<?php echo home_url('membership'); ?>">Memberships</a>
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

								<div id="default" class="child open">
									
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
												<?php endwhile; wp_reset_query(); wp_reset_postdata(); endif; ?>
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
										wp_reset_query(); wp_reset_postdata();
										?>


									</div>

								</div><!-- END TAB -->

								<div id="cricket" class="child">

									<div class="span3 menu-sub-menu">
										<h2>CRIICKET</h2>
										<div class="clear"></div>
										<?php
										$cricketPID = get_id_by_slug('cricket');
										$children = wp_list_pages( 'title_li=&child_of='.$cricketPID.'&echo=0' );
										if ( $children) : ?>
										<ul>
											<?php echo $children; ?>
										</ul>
										<?php endif; ?>
									</div>

									<div class="span9 players">
										<h2>The Squad</h2>
										<div class="row">
										<?php
										$i = 1;
										$args = array( 
											'post_type' 		=> 'players',
											'posts_per_page' 	=> -1,
											'tax_query'   => [
												[
													'taxonomy' => 'filter',
													'field'    => 'slug',
													'terms'    => 'senior-squad '
												]
											]
										);
										$match_query = new WP_Query( $args );
										$filter = null;
										if ( $match_query->have_posts() ) : 
											while ( $match_query->have_posts() ): $match_query->the_post();
											$filter = get_the_terms( get_the_id(), 'filter');
											$filter = current($filter);
											?>
											<div class="person <?php echo $filter->slug; ?>">
												<a href="<?php the_permalink(); ?>">
													<?php the_post_thumbnail( 'thumbnail' ); ?>
													<div class="info">
														<div class="table"><div class="cell middle">
														<h2><?php the_title(); ?></h2>
														</div></div>
													</div>
												</a>
											</div>
											<?php if ( $i % 6 == 0 ) : ?>
											</div>
											<div class="row">
											<?php endif;
											$i++; endwhile; 
											wp_reset_query(); wp_reset_postdata(); 
										endif; 
										?>
										</div>
									</div>

								</div><!-- END TAB -->

								<div id="news" class="child">
								
							    	<h2>Latest News</h2>
							    	<div class="row">
                                    <?php 
                                    $i = 0;
                                    $loop = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => 4 ) );
                                    while ( $loop->have_posts() ) : $loop->the_post(); 
                                        ?>
                                        <div class="match-info span3">

                                        	<?php 
											if (has_post_thumbnail()) 
											{
												the_post_thumbnail( 'poster' ); 
											} 
											else 
											{
												echo "<img src='".get_stylesheet_directory_uri()."/assets/images/poster-holder.jpg'>";
											}
											?>

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
                                    wp_reset_query(); wp_reset_postdata();
                                    ?>
                                    </div>
								
								</div><!-- END TAB -->

								<div id="theclub" class="child">
								</div><!-- END TAB -->

								<div id="visitors" class="child">
								</div><!-- END TAB -->

								<div id="memberships" class="child">

									<div class="span3 menu-sub-menu">
										<h2>Downloads</h2>
										<?php 
										$downloadspage = get_id_by_slug('downloads');
										if( have_rows('downloads', $downloadspage) ): ?>
										<ul>
										<?php while ( have_rows('downloads', $downloadspage) ) : the_row(); $file = get_sub_field( 'files' ); ?>
											<li><a href="<?php echo $file['url']; ?>"><?php echo $file['title']; ?></a></li>
										<?php endwhile; ?>
										</il>
										<?php endif; ?>
									</div>

									<div class="memberships span9">
										<h2>Memberships</h2>
										<div class="packages">
											<?php 
											$args = array( 
												'post_type' => 'memberships',
												'posts_per_page' => 4,
												'order'   => 'ASC',
											);
											$query = new WP_Query( $args );
											if ( $query->have_posts() ) : while ( $query->have_posts() ):
											$query->the_post();
											?>
											<div class="package">
												<?php the_post_thumbnail( ); ?>
												<div class="copy">
													<h3><?php the_title( ); ?></h3>
													<h4><?php the_field('price'); ?></h4>
												</div>
												<div class="links">
													<a target="_blank" href="<?php the_field( 'purchase_link' ); ?>">Buy Membership</a>
												</div>
											</div>
											<?php endwhile; wp_reset_query(); wp_reset_postdata(); endif; ?>
										</div>
										<a class="viewall" href="<?php echo home_url( '/downloads' ); ?>">View All Memberships</a>
									</div>

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

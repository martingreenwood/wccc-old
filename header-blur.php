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
<?php $enable_alt_mode = null; 
if (get_field( 'enable_t20_mode', 'option' )): $enable_alt_mode = 't20'; endif;
if (get_field( 'enable_classic_mode', 'option' )): $enable_alt_mode = 'classic'; endif;
?>
<body <?php body_class($enable_alt_mode); ?>>

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
						<?php elseif (get_field( 'enable_classic_mode', 'option' )): ?>
							<img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-white.svg" width="415" alt="WCCC Logo">
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
										
										<h2>Results</h2>
										<!-- RESULTS -->

									</div>

									<div class="latest-news span3">
										
										<h2>News</h2>
										<!-- NEWS -->

									</div>

								</div>

							</div>

						</div>
					</div>

				</nav>

			</div>
		</div>

	</header>

	<div id="content" class="site-content blur">

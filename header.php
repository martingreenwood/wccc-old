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
					<a class="live-view">LIVE VIEW</a>

					<div class="main-menu-container">
						<div class="container">
							<ul class="menu" id="primary-menu">
								
								<li>
									<a id="livescroe" href="<?php echo home_url('live-score'); ?>">Live Score</a>
								</li>

								<li>
									<a id="teams" href="<?php echo home_url('teams'); ?>">Teams</a>
								</li>

								<li>
									<a id="news" href="<?php echo home_url('news'); ?>">News</a>
								</li>

								<li>
									<a id="members" href="<?php echo home_url('memberships'); ?>">Memberships</a>
								</li>

								<li>
									<a id="hospitality" href="<?php echo home_url('hospitality'); ?>">Hospitality</a>
								</li>

								<li>
									<a id="tickets" href="<?php echo home_url('tickets'); ?>">Tickets</a>
								</li>

								<li>
									<a id="commercal" href="<?php echo home_url('commercial'); ?>">Commercial</a> 
								</li>

							</div>
						</div>
					</div>

				</nav>

			</div>
		</div>

	</header>

	<div id="content" class="site-content">

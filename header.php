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

?>
<!-- 
 Built by
 Martin Greenwood, Lead Developer @WEAREBEARD
-->
<!DOCTYPE html>
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

	<div id="turnmeon">
		<div class="table">
			<div class="cell middle">
				<center>
					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/rotate-phone.svg">
					Please Use Portrait Mode
				</center>
			</div>
		</div>
	</div>

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
							<div class="wccc logo">
								<img src="<?php echo get_template_directory_uri(); ?>/assets/images/wccc-logo.png" width="150" alt="WCCC Logo">
							</div>
							<div class="nr logo">
								<img src="<?php echo get_template_directory_uri(); ?>/assets/images/nr-logo.png" width="130" alt="WCCC Logo">
							</div>
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

							<?php
								wp_nav_menu( array(
									'theme_location' => 'menu-1',
									'menu_id'        => 'primary-menu',
								) );
							?>

						</div>

					</div>

				</nav>

			</div>
		</div>

	</header>

	<div id="content" class="site-content">

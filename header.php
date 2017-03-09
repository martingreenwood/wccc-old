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

<body <?php body_class(); ?>>
<div id="page" class="site">

	<header id="masthead">

		<div class="topbar">
			<div class="container">
				<div class="span12">
					<?php wp_nav_menu( array( 'theme_location' => 'menu-3', 'menu_id' => 'top-menu' ) ); ?>
				</div>
			</div>
		</div>

		<div class="site-header">
			<div class="container">
				<nav id="primary-navigation" class="primary-navigation span4" role="navigation">
					<?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_id' => 'primary-menu' ) ); ?>
				</nav><!-- #site-navigation -->

				<div class="branding span4">
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				</div><!-- .site-branding -->

				<nav id="secondary-navigation" class="secondary-navigation span4" role="navigation">
					<?php wp_nav_menu( array( 'theme_location' => 'menu-2', 'menu_id' => 'secondary-menu' ) ); ?>
				</nav>
			</div>
		</div>
	</header>

	<div id="content" class="site-content">

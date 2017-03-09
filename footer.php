<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wccc
 */

?>

	</div>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info container">
			
			<div class="row">
				<div class="menu span12">
					<?php wp_nav_menu( array( 'theme_location' => 'menu-4', 'menu_id' => 'footer-menu' ) ); ?>
				</div>
			</div>

			<div class="row">
				<div class="copyright span6">
					<p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
				</div>
				<div class="creditwhereitsdue span6">
					<p class="alignright">Designed &amp; Built by <a rel="credit follow" target="_blank" href="http://wearebeard.com/">We are Beard</a>.</p>
				</div>
			</div>

		</div>
	</footer>

</div>

<?php wp_footer(); ?>

</body>
</html>

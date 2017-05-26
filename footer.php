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

	<section id="signup">
		<div class="container">
			<div class="row" style="padding-top: 30px">
				<div class="span12">

					<h3>Sign Up to our Newsletter</h3>
					<form action="https://ventutec.createsend.com/t/r/s/tdtutid/" method="post" id="subForm">
						<p>
							<input id="fieldName" name="cm-name" type="text" placeholder="Your name" />
						</p>
						<p>
							<input id="fieldEmail" name="cm-tdtutid-tdtutid" type="email" required placeholder="Your email" />
						</p>
						<p>
							<button type="submit">Sign Up</button>
						</p>
					</form>
				</div>
				</div>
			</div>
		</div>
	</section>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info container">
			
			<div class="row">
				<div class="menu span2half">
					<h3>Quick Links</h3>
					<?php wp_nav_menu( array( 'theme_location' => 'menu-2', 'menu_id' => 'footer-quick-links' ) ); ?>
				</div>
				<div class="menu span2half">
					<h3>Tickets</h3>
					<?php wp_nav_menu( array( 'theme_location' => 'menu-3', 'menu_id' => 'footer-tickets' ) ); ?>
				</div>
				<div class="menu span2half">
					<h3>Commercial</h3>
					<?php wp_nav_menu( array( 'theme_location' => 'menu-4', 'menu_id' => 'footer-comercial' ) ); ?>
				</div>
				<div class="menu span2half">
					<h3>Footer</h3>
					<?php wp_nav_menu( array( 'theme_location' => 'menu-5', 'menu_id' => 'footer-shop' ) ); ?>
				</div>
				<div class="menu span2half">
					<h3>Contact</h3>
					<?php wp_nav_menu( array( 'theme_location' => 'menu-6', 'menu_id' => 'footer-contact' ) ); ?>
				</div>
			</div>

		</div>
	</footer>

	<footer id="copyright" class="copyright-footer">
		<div class="container">

			<div class="row">
				<div class="copyright span6">
					<p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
				</div>
				<div class="creditwhereitsdue span6">
					<p class="alignright">Website by <a target="_blank" href="http://wearebeard.com/">WEAREBEARD</a>.</p>
				</div>
			</div>

		</div>
	</footer>

</div>

<?php wp_footer(); ?>

</body>
</html>

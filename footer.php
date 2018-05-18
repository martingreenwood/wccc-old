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

					<form id="subForm" class="js-cm-form" action="https://www.createsend.com/t/subscribeerror?description=" method="post" data-id="5B5E7037DA78A748374AD499497E309E4408B1CCA2E1C43D5855F3C79FFA38E2797762376BA377990ACC74A88078A37D9CDEA3353051ACA2060E352E31ACE3CF">

						<p>
							<input id="fieldName" name="cm-name" placeholder="Your Name" type="text" />
						</p>
						<p>
							<input id="fieldEmail" class="js-cm-email-input" name="cm-tdtiuui-tdtiuui" type="email" placeholder="Your Email" required /> 
						</p>
						<p>
							<button class="js-cm-submit-button button" type="submit">Subscribe</button> 
						</p>

					</form>
					<script type="text/javascript" src="https://js.createsend1.com/javascript/copypastesubscribeformlogic.js"></script>

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
					<h3>Shop</h3>
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

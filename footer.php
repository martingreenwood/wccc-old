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

					<!-- Begin MailChimp Signup Form -->
					<div id="mc_embed_signup">
						<form action="https://wccc.us16.list-manage.com/subscribe/post?u=a86308683637e5d7bf8d84cfc&amp;id=59abcaddea" method="post" id="subForm" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
							<div id="mc_embed_signup_scroll">

								<!-- <div class="indicates-required"><span class="asterisk">*</span> indicates required</div> -->
								<div id="mce-responses" class="clear">
									<div class="response" id="mce-error-response" style="display:none"></div>
									<div class="response" id="mce-success-response" style="display:none"></div>
								</div>

								<div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_a86308683637e5d7bf8d84cfc_59abcaddea" tabindex="-1" value=""></div>

								<p class="mc-field-group">
									<input type="text" value="" placeholder="First Name" name="FNAME" class="" id="mce-FNAME">
								</p><!--
								--><p class="mc-field-group">
									<input type="text" value="" placeholder="Last Name" name="LNAME" class="" id="mce-LNAME">
								</p><!--
								--><p class="mc-field-group">
									<input type="email" value="" placeholder="Email Address" name="EMAIL" class="required email" id="mce-EMAIL">
								</p><!--
								--><p>
									<input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button">
								</p><!--
							--></div>
						</form>
					</div>

					<!--End mc_embed_signup-->

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

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

					<div id="mc_embed_signup">
						<form action="//wccc.us16.list-manage.com/subscribe/post?u=a86308683637e5d7bf8d84cfc&amp;id=004757c1c4" method="post" id="subForm" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
							<p>
								<input placeholder="First Name" type="text" value="" name="FAME" class="" id="mce-FNAME">
							</p>
							<p>
								<input placeholder="Email" type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
							</p>
					    	<div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_a86308683637e5d7bf8d84cfc_004757c1c4" tabindex="-1" value=""></div>
							<p>
								<input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button">
							</p>
						</form>
					</div>
					<script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
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

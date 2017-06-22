<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package wccc
 */

get_header(); ?>

	<?php 
	if (get_field( 'enable_t20_mode', 'option' )):
		$bannerimage = get_template_directory_uri() . "/assets/images/rapids-banner.png";
	else: 
		$bannerimage = get_template_directory_uri() ."/assets/images/banner.png";
	endif; 

	//if (get_field( 'top_image' )) {
		//$top_image = get_field( 'top_image', get_the_id() ); 
	//} else {
		$top_image = get_template_directory_uri() ."/assets/images/player.png";
	//}

	?>
	<section id="jumbrotron">
		<div class="overlay" style="background-image: url(<?php echo $bannerimage; ?>)"></div>

		<div class="news" style="background-image: url(<?php echo $top_image; ?>)">
			<div class="table"><div class="cell bottom
			.">
				<div class="container">
					<div class="span6">
						<h1><span>Latest</span><br>
						News</h1>
					</div>
				</div>
			</div></div>
		</div>
	</section>

	<div id="primary" class="content-area container">
		
		<div class="row">
			<?php get_sidebar('archive'); ?>
		</div>

		<div class="row">
			<main id="main" class="site-main" role="main">

			<div class="row">
			<?php
			$i = 1;
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'box' );

				if ( $i % 4 == 0 ) : ?>
				</div>
				<div class="row">
				<?php endif;

			$i++; endwhile; // End of the loop.
			?>
			</div>

			</main>
		</div>

	</div>

<?php
get_footer();

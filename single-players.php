<?php
/**
 * The template for displaying all single players
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package wccc
 */

get_header(); ?>

	<?php 
	if (get_field( 'enable_t20_mode', 'option' )):
		$bannerimage = get_template_directory_uri() . "/assets/images/rapids-banner.png";

		$top_image_array = array();
		$top_t20_images = get_field( 'header_images_t20', 'option' );

		foreach ($top_t20_images as $top_t20_image) {
			$top_image_array[] = $top_t20_image['url'];
		}
		$ri = array_rand($top_image_array);
		$top_image = $top_image_array[$ri];
	else: 
		$bannerimage = get_template_directory_uri() ."/assets/images/banner.png";

		$top_image_array = array();
		$top_images = get_field( 'header_images', 'option' );
		foreach ($top_images as $top_image) {
			$top_image_array[] = $top_image['url'];
		}
		$ri = array_rand($top_image_array);
		$top_image = $top_image_array[$ri];
	endif; 

	$terms = get_the_terms( get_the_id(), 'filter' );
	$terms = current($terms);

	?>
	<section id="jumbrotron">
		<div class="overlay" style="background-image: url(<?php echo $bannerimage; ?>)"></div>

		<div class="news" style="background-image: url(<?php echo $top_image; ?>)">
			<div class="table"><div class="cell middle">
				<div class="container">
					<div class="span6">
						<h1><?php echo $terms->name; ?> Bio:<br>
						<span><?php the_title(); ?></span></h1>
					</div>
					<div class="span6">
					</div>
				</div>
			</div></div>
		</div>
	</section>

	<div id="primary" class="content-area container">
		<main id="main" class="site-main span9" role="main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', 'player' );

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->

		<?php get_sidebar('pages'); ?>
	</div>

	<?php 
		get_template_part( 'partials/social', 'tweets' );
	?>

	<?php 
		get_template_part( 'partials/sponsor', 'boxes' );
	?>

<?php
get_footer();

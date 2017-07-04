<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
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

	?>
	<section id="jumbrotron">
		<div class="overlay" style="background-image: url(<?php echo $bannerimage; ?>)"></div>

		<div class="news" style="background-image: url(<?php echo $top_image; ?>)">
			<div class="table"><div class="cell middle">
				<div class="container">
					<div class="span6">
						<h1>Category:<br>
						<span><?php the_archive_title(); ?></span></h1>
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
			<main id="main" class="site-main span12" role="main">

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
		get_template_part( 'partials/social', 'tweets' );
	?>

	<?php 
		get_template_part( 'partials/famous', 'four' );
	?>

	<?php 
		get_template_part( 'partials/sponsor', 'boxes' );
	?>

<?php
get_footer();

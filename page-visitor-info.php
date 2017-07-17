<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
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
						<?php if (get_field( 'has_custom_title' )): ?>
							<h1><?php the_field( 'custom_title' ); ?></h1>
						<?php else: ?>
							<h1><?php the_title(); ?></h1>
						<?php endif; ?>
					</div>
					<div class="span6">
					</div>
				</div>
			</div></div>
		</div>
	</section>

	<div id="topnavbar" class="pagenav">
		<div class="container">
		<?php get_sidebar('top'); ?>
		</div>
	</div>

	<div id="primary" class="content-area container">
		<main id="main" class="site-main span23" role="main">

			<center>
			<h1><?php the_title(); ?></h1>
			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

			endwhile; // End of the loop.
			?>
			</center>

		</main><!-- #main -->

		<!-- <?php get_sidebar('pages'); ?> -->
	</div>

	<?php if( have_rows('sections') ): ?>
	<section id="parts">

	    <?php while ( have_rows('sections') ) : the_row(); ?>
		<div class="section">
			<div class="container">
				<div class="row">
				
				    <?php while ( have_rows('column') ) : the_row(); ?>
					<div class="column <?php the_sub_field( 'column_with' ); ?>">

					<?php
					if( have_rows('column_content') ):
					    while ( have_rows('column_content') ) : the_row();

					        if( get_row_layout() == 'content' ):

					        	the_sub_field('content');

					        elseif( get_row_layout() == 'image' ): 

					        	$image = get_sub_field('image');
					        	echo "<img src='".$image["url"]."'>";


							elseif( get_row_layout() == 'video' ): 

					        	the_sub_field('video');

					        endif;

					    endwhile;
					endif;
					?>

					</div>
					<?php endwhile; ?>
					
				</div>
			</div>
		</div>
		<?php endwhile; ?>

	</section>
	<?php endif; ?>

	<?php 
	$location = get_field('location', 'options');
	if( !empty($location) ): ?>
	<section id="location">
		<div class="map">
			<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
		</div>
	</section>
	<?php endif; ?>

	<?php 
		get_template_part( 'partials/sponsor', 'boxes' );
	?>

<?php
get_footer();

<?php
/**
 * The front page template file
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
		$top_t20_images = get_field( 'top_t20_image', 'option' );

		foreach ($top_t20_images as $top_t20_image) {
			$top_image_array[] = $top_t20_image['url'];
		}
		$ri = array_rand($top_image_array);
		$top_image = $top_image_array[$ri];
	else: 
		$bannerimage = get_template_directory_uri() ."/assets/images/banner.png";

		$top_image_array = array();
		$top_images = get_field( 'top_image', 'option' );
		foreach ($top_images as $top_image) {
			$top_image_array[] = $top_image['url'];
		}
		$ri = array_rand($top_image_array);
		$top_image = $top_image_array[$ri];
	endif; 
	?>

	<section id="jumbrotron">
		<div class="overlay" style="background-image: url(<?php echo $bannerimage; ?>)"></div>

		<div class="info" style="background-image: url(<?php echo $top_image; ?>)">
			<div class="table"><div class="cell middle">
				<div class="container">
					<div class="span6">
						<h2>
							<?php the_field( 'Hompage_title', 'option' ); ?>
						</h2>
						<p>
							<?php the_field( 'hompage_intro', 'option' ); ?>
						</p>
						<a href="<?php the_field( 'hompage_link', 'option' ); ?>"><?php the_field( 'hompage_link_text', 'option' ); ?></a>
					</div>
				</div>
			</div></div>
		</div>
		<div class="stories">
			<div class="container">
				<div class="slides">
				<?php 
				$loop = new WP_Query( 
					array( 
						'post_type' => 'post', 
						'posts_per_page' => 6 ,
						'meta_query' => array( 
							array(
								// Require post to have Featured Image
								'key' => '_thumbnail_id'
							),
							array(
								// Key = ACF Field Name (True/False field)
								'key' => 'feature_on_homepage',
								// Value = 1, so 'True' radio button is selected 
								'value' => '1'
							),
						)
					)
				);
				while ( $loop->have_posts() ) : $loop->the_post(); 
					?>
					<div class="slide">
						<a href="<?php the_permalink(); ?>">
							<div class="image">
								<?php 
								if (has_post_thumbnail()) {
									the_post_thumbnail( 'slide-thumb' ); 
								}
								else {
									if (get_field( 'enable_t20_mode', 'option' )):
										echo "<img src='".get_stylesheet_directory_uri()."/assets/images/thumb-holder-t20.jpg'>";
									else:
										echo "<img src='".get_stylesheet_directory_uri()."/assets/images/thumb-holder.jpg'>";
									endif;
								}
								?>
							</div>
							<div class="content">
								<h3><small><?php echo date("j/m/Y", strtotime(get_the_date())); ?></small><br>
								<?php the_title( ); ?></h3>
							</div>
						</a>
					</div>
					<?php 
				endwhile; 
				wp_reset_query(); 
				?>
				</div>
			</div>
		</div>
	</section>

	<?php 
		get_template_part( 'partials/home', 'latest-score' ); 
	?>

	<?php 
		get_template_part( 'partials/home', 'next-prev' ); 
	?>

	<?php 
		get_template_part( 'partials/social', 'tweets' );
	?>

	<?php 
		get_template_part( 'partials/famous', 'four' );
	?>

	<?php 
		get_template_part( 'partials/sponsor', 'boxes' );
	?>

	<div id="primary" class="content-area container">
		<main id="main" class="site-main animated fadeIn delay" role="main">

		<?php
		if ( have_posts() ) :
			while ( have_posts() ) : the_post();
				get_template_part( 'template-parts/content', 'page' );
			endwhile;
		endif; ?>

		</main>

	</div>

<?php
get_footer();

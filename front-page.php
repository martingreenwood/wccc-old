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
		$top_image = get_field( 'top_t20_image', 'option' ); 
		$top_image = $top_image['url']; 
	else: 
		$bannerimage = get_template_directory_uri() ."/assets/images/banner.png";
		$top_image = get_field( 'top_image', 'option' ); 
		$top_image = $top_image['url']; 
	endif; 

	?>

	<section id="jumbrotron">
		<div class="overlay" style="background-image: url(<?php echo $bannerimage; ?>)"></div>

		<div class="info" style="background-image: url(<?php echo $top_image; ?>)">
			<div class="table"><div class="cell middle">
				<div class="container">
					<div class="span6">
						<h2><span>WCCC</span> <small>VS</small><br>
						NORTHANTS</h2>
						<p>Day 2 saw Worcestershire facing a stubborn tail end of Northants still at the crease but boweler friendly conditions in front of them.</p>
						<a href="#">Read More</a>
					</div>
				</div>
			</div></div>
		</div>
		<div class="stories">
			<div class="container">
				<div class="slides">
				<?php 
				$loop = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => 6 ) );
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
									echo "<img src='".get_stylesheet_directory_uri()."/assets/images/slide-holder.jpg'>";
								}
								?>
							</div>
							<div class="content">
								<h3><?php the_title( ); ?></h3>
								<a class="more" href="<?php the_permalink(); ?>">Read More</a>
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

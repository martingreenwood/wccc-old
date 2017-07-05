<?php
/**
 * The template file for whats-on
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
						<h1>What’s on this year<br>at New Road</h1>
					</div>
				</div>
			</div></div>
		</div>
	</section>

	<div id="primary" class="content-area container">

		<div class="row">
			<main id="main" class="site-main" role="main">

			<div class="row">
			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

			endwhile; // End of the loop.
			?>
			</div>

			<div class="row">

				<?php 
				$today = date("Ymd", strtotime('today UTC'));

				$i = 1;
				$args = array( 
					'post_type' => 'events',
					'posts_per_page' => -1,
					'order'   => 'ASC',
					'meta_query' => array(
						array(
							'key'     => 'event_date',
							'value'   => $today, // in da future
							'compare' => '>',
						),
					),
				);
				$query = new WP_Query( $args );
				if ( $query->have_posts() ) : while ( $query->have_posts() ):
				$query->the_post();
				?>
				<div class="package span3">
					<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail( thumbnail ); ?>
						<header>
							<h3><?php the_title( ); ?><br>
							<small><?php echo date("dS F Y", strtotime(get_field( 'event_date' ))); ?></small></h3>
						</header>
					</a>
				</div>

				<?php if ( $i % 4 == 0 ) : ?>
				</div>
				<div class="row">
				<?php endif;

				$i++; endwhile; wp_reset_postdata(); endif; ?>

			</div>

			</main>
		</div>

	</div>

<?php
get_footer();

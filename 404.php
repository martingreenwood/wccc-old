<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
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
						<h1><span>well,</span><br>
						I'm stumped</h1>
					</div>
				</div>
			</div></div>
		</div>
	</section>


	<div id="primary" class="content-area container">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				
				<div class="row">

					<article class="span12">
						<h2><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'wccc' ); ?></h2>
						<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below.', 'wccc' ); ?></p>
					</article>

				</div>

				<div class="row page-content">

					<div class="span6">
					<?php
						the_widget( 'WP_Widget_Recent_Posts' );
					?>
					</div>

					<div class="widget widget_categories span6">
						<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'wccc' ); ?></h2>
						<ul>
						<?php
							wp_list_categories( array(
								'orderby'    => 'count',
								'order'      => 'DESC',
								'show_count' => 1,
								'title_li'   => '',
								'number'     => 10,
							) );
						?>
						</ul>
					</div>

				</div>
			</section>

		</main>

	</div>

<?php
get_footer();

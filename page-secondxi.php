<?php
/**
 * Template Name: Second XI Results
 *
 * The template for displaying fixtures
 *
 * @package wccc
 */

// use latest fixtures file
$today = date('Ymd', strtotime('now')); 
$dates = array();
$matches = array();
$all_comp = array();

$prev = NULL;

$fixture_files = preg_grep('~^EDC.fixtures.*\.(xml)$~', scandir(FEED_DIR, SCANDIR_SORT_ASCENDING));
$fixture_file = array_pop($fixture_files);

if (file_exists(FEED_DIR .'/'. $fixture_file)):
	$fixtures_xml = simplexml_load_file(FEED_DIR .'/'. $fixture_file);
	$fixtures_json = json_encode($fixtures_xml);
	$fixtures_array = json_decode($fixtures_json,TRUE);
	$fixtures = $fixtures_array['fixture'];
endif;

// NON OPTA
$args = array( 
	'post_type' => 'matches',
	'posts_per_page' => -1,
	'meta_key' 			=> 'start_date',
	'orderby' 			=> 'meta_value',
	'order'      		=> 'ASC',
	'meta_query' => array(
		array(
			'key'     => 'start_date',
			'value'   => $today, // in da past
			'compare' => '>=',
		),
	),
);
$match_query = new WP_Query( $args );


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
	
	$start = 1;
	$target = 58;

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

	<?php /*
	<div id="filter">
		<div class="container">
			<div class="row">
				<div class="choice">
					<h3>Filter by Team</h3>
					<form>
						<ul>
							<li>
								<input class="teamfilter" type="checkbox" name="team" value="firstxi">
								<label for="first">First XI</label>
							</li>
							<li>
								<input class="teamfilter" type="checkbox" name="team" value="secondxi">
								<label for="second">Second XI</label>
							</li>
						</ul>
					</form>
				</div>
				<div class="choice">
					<h3>By Competition</h3>
					<form>
						<ul>
						 	<?php 
							$match_comp = array();
							if ( $match_query->have_posts() ) : 
								while ( $match_query->have_posts() ): $match_query->the_post();

									if (isset($match['@attributes']['comp_id'])) {
										if (isset($match['@attributes']['comp_name'])) {
											$match_comp[] = $match['@attributes']['comp_name']."|".$match['@attributes']['comp_id'];
										}
									} else {
										$match_comp[] = get_field( 'type' ) ."|". str_replace(" ","_",strtolower(get_field( 'type' )));
									}

								endwhile; 
							wp_reset_postdata(); 
							endif;
							$match_comp = array_unique($match_comp);
							?>
							<!-- <pre>
								<?php print_r($match_comp); ?>
							</pre> -->
							<?php foreach ($match_comp as $mcomp ): 
								$mcomp = explode("|", $mcomp);
								?>

								<li>
						 			<input class="compfilter" type="checkbox" name="comp-<?php echo $mcomp[1]; ?>" value="comp-<?php echo $mcomp[1]; ?>">
						 			<label for="comp-<?php echo $mcomp[1]; ?>"><?php echo $mcomp[0]; ?></label>
						 		</li>
								
							<?php endforeach ?>
						</ul>
					</form>
				</div>
			</div>
		</div>
	</div>
	*/ ?>

	<div id="primary" class="content-area container">
		<main id="main" class="site-main span12" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

			endwhile; // End of the loop.
			?>

			<div id="fixres">

				<div class="tabs">
					<ul class="tab-links">
						<li><a href="<?php echo home_url( 'cricket/fixtures' ); ?>">Fixtures</a></li>
						<li><a href="<?php echo home_url( 'cricket/results' ); ?>">1st XI Results</a></li>
						<li class="active"><a href="<?php echo home_url( 'cricket/secondxi' ); ?>">2nd XI Results</a></li>
						<li ><a href="<?php echo home_url( 'cricket/highlights' ); ?>">Video Highlights</a></li>
					</ul>

					<div class="tab-content">
						<div class="tab active">

							<nvplay 
							customer-id="6860C067-D421-4B6F-A131-18A8E60E08EE"
							widget="match-list"
							days="180"
							poll-seconds="60"      
							source="nvplay"
							> 
							</nvplay>
						 
						</div>
					</div>
				</div>

			</div>

		</main><!-- #main -->

	</div><!-- #primary -->

	<?php 
		get_template_part( 'partials/social', 'tweets' );
	?>

	<?php 
		get_template_part( 'partials/sponsor', 'boxes' );
	?>

<?php
get_footer();

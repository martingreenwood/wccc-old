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
	else: 
		$bannerimage = get_template_directory_uri() ."/assets/images/banner.png";
	endif; 
	?>
	<section id="jumbrotron" style="background-image: url(<?php echo $bannerimage; ?>)">
		<div class="info">
			<div class="table"><div class="cell middle">
				<div class="container">
					<div class="span6">
						<h2><span>WCCC</span> <small>VS</small><br>
						ORTHANTS</h2>
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
				$loop = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => -1 ) );
				while ( $loop->have_posts() ) : $loop->the_post(); 
					?>
					<div class="slide">
						<div class="image">
							<?php the_post_thumbnail( 'slide-thumb' ); ?>
						</div>
						<div class="content">
							<h3><?php the_title( ); ?></h3>
							<p><?php echo substr(get_the_excerpt(), 0, 80); ?></p>
							<a href="<?php the_permalink(); ?>">Read More</a>
						</div>
					</div>
					<?php 
				endwhile; 
				wp_reset_query(); 
				?>
				</div>
			</div>
		</div>
	</section>

	<section id="vs">
		<div class="container">
			<div class="row">
				<div class="tab">Larest Score</div>

				<div class="team one">
					<img src="http://placehold.it/96x96" alt="">
					<div class="name">
						<h3>Yorkshire Vikings</h3>
						<h4>170 All Out</h4>
					</div>
				</div>
				<div class="mid">
					<p>VS</p>
				</div>
				<div class="team two">
					<div class="name">
						<h3>Worcestershire Rapids</h3>
						<h4>170 / 3</h4>
					</div>
					<img src="http://placehold.it/96x96" alt="">
				</div>

				<div class="link"><a href="#">View Scorecard</a></div>

			</div>
		</div>
	</section>

	<section style="background-color: black; padding: 200px 0;">
		<p style="text-align-last: center; color: white; font-weight: 600;">OPTA WIDGET</p>
	</section>

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

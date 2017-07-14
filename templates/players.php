<?php
/**
 * Template Name: Players
 *
 * The template for displaying the squad page
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
		<main id="main" class="site-main span12" role="main">

			<center>
			<h1><?php the_title(); ?></h1>
			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

			endwhile; // End of the loop.
			?>
			</center>
			
			<div class="squadies">
				
				<div class="row">
				<?php
				$i = 1;
				$prev = null;
				$args = array( 
					'post_type' 		=> 'players',
					'posts_per_page' 	=> -1,
					'tax_query'   => [
						[
							'taxonomy' => 'filter',
							'field'    => 'term_id',
							'terms'    => get_field( 'show_team' )
						]
					]
				);
				$match_query = new WP_Query( $args );

				if ( $match_query->have_posts() ) : 
					while ( $match_query->have_posts() ): $match_query->the_post();
					$filter = get_terms( 'filter', $args );
					?>
					<div class="person span3" data-filter="<?php echo $filter->slug; ?>">
					
						<?php	
						if (get_field( 'enable_t20_mode', 'option' )):
							if (get_field( 't20shot' )) {
								$t2oimage = get_field( 't20shot' );
								echo "<img src='".$t2oimage['sizes']['poster']."'>";
							} else {
								the_post_thumbnail( 'poster' );
							}
						else: 
							the_post_thumbnail( 'poster' );
						endif; 
						?>

						

						<h2><?php the_title(); ?></h2>

						<div class="info">
							<h3><?php the_title(); ?></h3>
							<h4>Stats</h4>
							
							<dl>
								<dt>Role:</dt>
								<dd>
									<?php echo str_replace("-", " ", get_field( 'role' )); ?>
								</dd>
							</dl>

							<?php if (get_field( 'bats' )): ?>
							<dl>
								<dt>Bats:</dt>
								<dd>
									<?php the_field( 'bats' ); ?>
								</dd>
							</dl>
							<?php endif; ?>

							<?php if (get_field( 'bowls' )): ?>
							<dl>
								<dt>Bowls:</dt>
								<dd>
									<?php echo implode(', ', get_field( 'bowls' )); ?>
								</dd>
							</dl>
							<?php endif; ?>

							<?php if (get_field( 'shirt_number' )): ?>
							<dl>
								<dt>Shirt No:</dt>
								<dd>
									<?php the_field( 'shirt_number' );?>
								</dd>
							</dl>
							<?php endif; ?>

							<a href="<?php the_permalink(); ?>">Read More</a>
						</div>
					</div>

					<?php if ( $i % 4 == 0 ) : ?>
					</div>
					<div class="row">
					<?php endif;

					$i++; endwhile; 
					wp_reset_postdata(); 
				endif; 
				?>
				</div>
				
			</div>

		</main><!-- #main -->

	</div><!-- #primary -->

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
get_footer();

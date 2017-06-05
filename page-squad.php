<?php
/**
 * The template for displaying the squad page
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

	if (get_field( 'top_image' )) {
		$top_image = get_field( 'top_image' ); 
		$top_image = $top_image['url']; 
	} else {
		$top_image = get_template_directory_uri() ."/assets/images/player.png";
	}

	?>
	<section id="jumbrotron">
		<div class="overlay" style="background-image: url(<?php echo $bannerimage; ?>)"></div>

		<div class="news" style="background-image: url(<?php echo $top_image; ?>)">
			<div class="table"><div class="cell middle">
				<div class="container">
					<div class="span6">
						&nbsp;
						<h1><?php the_title(); ?></h1>
					</div>
					<div class="span6">
					</div>
				</div>
			</div></div>
		</div>
	</section>

	<div id="filter">
		<div class="container">
			<div class="row">
				<div class="choice">
					<h3>Filter by Team</h3>
					<form>
						<ul>
						<?php
						$terms = get_terms( 'filter', array(
    						'hide_empty' => true,
						) );
						foreach( $terms as $term ) : 
							?>
							<li>
								<input class="personfilter" type="checkbox" name="team" value="<?php echo $term->slug; ?>">
								<label for="<?php echo $term->slug; ?>"><?php echo $term->name; ?></label>
							</li>
							<?php
						endforeach;
						?>
						</ul>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div id="primary" class="content-area container">
		<main id="main" class="site-main span12" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

			endwhile; // End of the loop.
			?>
			
			<div class="squad">
				
				<?php
				$prev = null;
				$args = array( 
					'post_type' 		=> 'players',
					'posts_per_page' 	=> -1,
				);
				$match_query = new WP_Query( $args );

				if ( $match_query->have_posts() ) : 
					while ( $match_query->have_posts() ): $match_query->the_post();
					$filter = get_terms( 'filter', $args );
					?>
					<div class="person" data-filter="<?php echo $filter->slug; ?>">
						<?php the_post_thumbnail( 'poster' ); ?>
						<h2><?php the_title(); ?></h2>

						<div class="info">
							<h3><?php the_title(); ?></h3>
							<h4>Stats</h4>
							<ul>
								<li>
									<span>Role</span>
									<?php echo str_replace("-", " ", get_field( 'role' )); ?>
								</li>
								<li>
									<span>Bats</span>
									<?php the_field( 'bats' ); ?>
								</li>
								<?php if (get_field( 'bowls' )): ?>
								<li>
									<span>Bowls</span>
									<?php echo implode(', ', get_field( 'bowls' )); ?>
								</li>
								<?php endif; ?>
								<li>
									<span>Shirt No.</span>
									<?php the_field( 'shirt_number' );?>
								</li>
							</ul>
							<a href="<?php the_permalink(); ?>">Read More</a>
						</div>
					</div>
					<?php 
					endwhile; 
					wp_reset_postdata(); 
				endif; 
				?>
				
			</div>

		</main><!-- #main -->

	</div><!-- #primary -->

<?php
get_footer();

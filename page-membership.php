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
		$clubname = "The Rapids";
	else: 
		$bannerimage = get_template_directory_uri() ."/assets/images/banner.png";

		$top_image_array = array();
		$top_images = get_field( 'header_images', 'option' );
		foreach ($top_images as $top_image) {
			$top_image_array[] = $top_image['url'];
		}
		$ri = array_rand($top_image_array);
		$top_image = $top_image_array[$ri];
		$clubname = "The Pears";
	endif; 
	?>
	<section id="jumbrotron">
		<div class="overlay" style="background-image: url(<?php echo $bannerimage; ?>)"></div>

		<div class="news" style="background-image: url(<?php echo $top_image; ?>)">
			<div class="table"><div class="cell middle">
				<div class="container">
					<div class="span6">
						<h1>Join <?php echo $clubname; ?>
						<br><?php echo date('Y'); ?> Memberships On Sale</h1>
					</div>
					<div class="span6">
					</div>
				</div>
			</div></div>
		</div>
	</section>


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

			<?php if( have_rows('downloads') ): ?>
			<div class="downloads">
				<h3>DOWNLOADS</h3>
				<?php while ( have_rows('downloads') ) : the_row(); $file = get_sub_field( 'files' ); ?>
				<a href="<?php echo $file['url']; ?>"><?php echo $file['title']; ?></a>
				<?php endwhile; ?>
			</div>
			<?php endif; ?>


			<div class="memberships">
				<?php 
				$args = array( 
					'post_type' => 'memberships',
					'posts_per_page' => -1,
					'order'   => 'ASC',
				);
				$query = new WP_Query( $args );
				if ( $query->have_posts() ) : while ( $query->have_posts() ):
				$query->the_post();
				?>
				<div class="package">
					<?php the_post_thumbnail( ); ?>
					<div class="copy">
						<h3><?php the_title( ); ?></h3>
						<h4><?php the_field('price'); ?></h4>
						<ul>
						<?php
						if( have_rows('benefits') ):
						    while ( have_rows('benefits') ) : the_row();
							?>
							<li>
					        	<i class="fa fa-check" aria-hidden="true"></i>
					        	<?php the_sub_field('benefit'); ?>
							</li>
							<?php
						    endwhile;
						endif;
						?>
						</ul>
					</div>
					<div class="links">
						<a href="#" class="more">Read More</a>
						<a target="_blank" href="<?php the_field( 'purchase_link' ); ?>">Buy Membership</a>
					</div>
				</div>
				<?php endwhile; wp_reset_postdata(); endif; ?>
			</div>

		</main><!-- #main -->

		<!-- <?php get_sidebar('pages'); ?> -->
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
